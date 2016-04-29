<?php

namespace App\Http\Controllers\Venta;

use App\Transaccion;
use App\TransaccionDetalle;
use App\Catalogo;
use App\Cliente;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\TransactionRequest;
use App\Http\Controllers\Controller;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Catalogo::IdCatalogo('TIPO TRANSACCION','Venta');
        $Lista = Transaccion::getTransaccion($id);
        foreach ($Lista as $row)$row->Total=$row->Total;
        return view('admin.venta.list',compact('Lista'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientes = Cliente::all()->lists('nombres','id')->toarray();
        return view('admin.venta.create',compact('clientes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['idtipo']=11;
        $data['idestado']=13;

        $transaction = new Transaccion($data);
        $transaction->save();
        return redirect()->route('venta.list')->with('success','Se ha registrado satisfactoriamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $venta = Transaccion::findOrFail($id);
        $Estado = Catalogo::findOrFail($venta->idestado);
        if ($Estado->nombre=='Debe') {
            return redirect()->route('venta.list')->with('success','No puede eliminar una venta que no ha sido pagada');
        }else{
            $clientes = Cliente::all()->lists('nombres','id')->toarray();
            return view('admin.venta.delete',compact('clientes','venta'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $venta = Transaccion::findOrFail($id);
        $Estado = Catalogo::findOrFail($venta->idestado);
        if ($Estado->nombre=='Pagado') {
            return redirect()->route('venta.list')->with('success','No puede editar una Venta pagada');
        }else{
            $clientes = Cliente::all()->lists('nombres','id')->toarray();
            return view('admin.venta.edit',compact('clientes','venta'));
        }
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
        $venta = Transaccion::findOrFail($id);
        $venta->fill(\Request::all());
        $venta->save();
        return redirect()->route('venta.list')->with('success','Se ha editado satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $cntPagos = TransaccionDetalle::where('idtransaccion',$id)->count();
        // if ($cntPagos==0) {
            Transaccion::destroy($id);
            return redirect()->route('venta.list')->with('success','Se ha eliminado el prestamo');
        // } else {
        //     return redirect()->route('venta.list')->with('success','Esta venta tiene pagos no se puede eliminar');
        // }
    }
}
