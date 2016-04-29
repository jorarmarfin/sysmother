<?php

namespace App\Http\Controllers\VentaDetalle;

use App\VentaDetalle;
use App\Producto;
use App\Transaccion;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class VentaDetalleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        Session::put('id', $id);
        $transaction = Transaccion::findOrFail($id);
        $idtipo = $transaction->idtipo;
        $Lista = Transaccion::getVentaDetalle($idtipo,$id);
        $resumen = VentaDetalle::getTotalVenta($id);
        $products = Producto::all()->lists('nombre','id')->toarray();
        // dd($Lista->toArray());
        return view('admin.ventadetalle.list',compact('Lista','resumen','products'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $date = Carbon::now();
        $data = $request->all();
        $data['idtransaccion']=Session::get('id');
        $data['fecha']=$date->toDateString('d-m-Y');;
        $data['hora']=$date->toTimeString();
        $ventadetalle = new VentaDetalle($data);
        $ventadetalle->save();
        $venta = Transaccion::findOrFail(Session::get('id'));
        $venta->idestado=13;
        $venta->save();
        return redirect()->back()->with('success','Se ha registrado la venta satisfactoriamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ventadetalle = VentaDetalle::findOrFail($id);
        $products = Producto::all()->lists('nombre','id')->toarray();
        return view('admin.ventadetalle.delete',compact('ventadetalle','products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $products = Producto::all()->lists('nombre','id')->toarray();
        $ventadetalle = VentaDetalle::findOrFail($id);
        return view('admin.ventadetalle.edit',compact('ventadetalle','products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ventadetalle = VentaDetalle::findOrFail($id);
        $ventadetalle->fill($request->all());
        $ventadetalle->save();
        $venta = Transaccion::findOrFail(Session::get('id'));
        return redirect()->route('ventadetalle.list',$ventadetalle->idtransaccion)
                         ->with('success','Se ha editado satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ventadetalle::destroy($id);
        return redirect()->route('ventadetalle.list',Session::get('id'))
                         ->with('success','Se ha eliminado satisfactoriamente');
    }
}
