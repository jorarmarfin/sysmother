<?php

namespace App\Http\Controllers\CuentasDetalles;

use App\Transaccion;
use App\Catalogo;
use App\Cliente;
use App\TransaccionDetalle;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CuentasDetallesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        Session::put('id', $id);
        $Lista = Transaccion::getDetalleCuentas($id);
        $Resumen = Transaccion::getTotalDetalleCuentas($id);
        return view('admin.cuentasdetalles.list',compact('Lista','Resumen'));
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
        $data['hora']=$date->toTimeString();;
        $transactionDetails = new TransaccionDetalle($data);
        $transactionDetails->save();

        $this->UpdateTotalTransaccion(Session::get('id'));
        return redirect()->back()->with('success','Se ha registrado la cuenta satisfactoriamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cuentasdetalles = TransaccionDetalle::findOrFail($id);
        return view('admin.cuentasdetalles.delete',compact('cuentasdetalles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cuentasdetalles = TransaccionDetalle::findOrFail($id);
        return view('admin.cuentasdetalles.edit',compact('cuentasdetalles'));
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
        $cuentasdetalles = TransaccionDetalle::findOrFail($id);
        $cuentasdetalles->fill($request->all());
        $cuentasdetalles->save();

        $this->UpdateTotalTransaccion(Session::get('id'));
        return redirect()->route('cuentasdetalles.list',$cuentasdetalles->idtransaccion)
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
        TransaccionDetalle::destroy($id);

        $this->UpdateTotalTransaccion(Session::get('id'));
        return redirect()->route('cuentasdetalles.list',Session::get('id'))
                         ->with('success','Se ha Eliminado satisfactoriamente');
    }
    /**
     * Actualiza total de la transaccion
     * @param [type] $id [description]
     */
    public function UpdateTotalTransaccion($id)
    {
        $Resumen = Transaccion::getTotalDetalleCuentas($id);
        $Transaction = Transaccion::findOrFail($id);
        $Transaction->monto = $Resumen[0]['sumventa']-$Resumen[0]['sumcobro'];
        $Transaction->save();
    }
}
