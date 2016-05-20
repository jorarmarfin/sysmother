<?php

namespace App\Http\Controllers\Cuentas;

use App\Transaccion;
use App\TransaccionDetalle;
use App\Catalogo;
use App\Cliente;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CuentasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Catalogo::IdCatalogo('TIPO TRANSACCION','Cuentas');
        $Lista = Transaccion::getTransaccion($id);
        foreach ($Lista as $row)$row->Total=$row->Total;
        return view('admin.cuentas.list',compact('Lista'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientes = Cliente::orderBy('nombres')->get()->lists('nombres','id')->toarray();
        $lugar = Catalogo::Combo('LUGAR')->get()->lists('nombre','id')->toarray();
        return view('admin.cuentas.create',compact('clientes','lugar'));
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
        $data['idtipo']=24;
        $data['idestado']=15;

        $transaction = new Transaccion($data);
        $transaction->save();
        return redirect()->route('cuentas.list')->with('success','Se ha registrado satisfactoriamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cuentas = Transaccion::findOrFail($id);
        $Estado = Catalogo::findOrFail($cuentas->idestado);
        if ($Estado->nombre=='Cerrado') {
            return redirect()->route('cuentas.list')->with('success','No puede editar una cuenta cerrada');
        }else{
            $lugar = Catalogo::Combo('LUGAR')->get()->lists('nombre','id')->toarray();
            $clientes = Cliente::orderBy('nombres')->get()->lists('nombres','id')->toarray();
            return view('admin.cuentas.edit',compact('clientes','cuentas','lugar'));
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
        $cuentas = Transaccion::findOrFail($id);
        $cuentas->fill(\Request::all());
        $cuentas->save();
        return redirect()->route('cuentas.list')->with('success','Se ha editado satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
