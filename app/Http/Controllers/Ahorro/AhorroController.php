<?php

namespace App\Http\Controllers\Ahorro;

use App\Transaccion;
use App\TransaccionDetalle;
use App\Catalogo;
use App\Cliente;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\TransactionRequest;
use App\Http\Controllers\Controller;

class AhorroController extends Controller
{
    /**
     * Funcion que cierra la scuentas de ahorristas
     * @return route ruta de lista
     */
    public function apertura()
    {
        $id = Catalogo::IdCatalogo('TIPO TRANSACCION','Ahorro');
        $ahorros = Transaccion::where('idtipo',$id)->update(['idestado' => 15]);;
        return redirect()->route('ahorro.list')->with('success','Se ha abierto el banco completamente');
    }

    /**
     * Funcion que cierra la scuentas de ahorristas
     * @return route ruta de lista
     */
    public function cierre()
    {
        $id = Catalogo::IdCatalogo('TIPO TRANSACCION','Ahorro');
        $ahorros = Transaccion::where('idtipo',$id)->update(['idestado' => 16]);;
        return redirect()->route('ahorro.list')->with('success','Se ha cerrado el banco completamente');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Catalogo::IdCatalogo('TIPO TRANSACCION','Ahorro');
        $Lista = Transaccion::getTransaccion($id);
        foreach ($Lista as $row)$row->Total=$row->Total;
        return view('admin.ahorro.list',compact('Lista'));
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
        return view('admin.ahorro.create',compact('clientes','lugar'));
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
        $data['idtipo']=14;
        $data['idestado']=15;

        $transaction = new Transaccion($data);
        $transaction->save();
        return redirect()->route('ahorro.list')->with('success','Se ha registrado satisfactoriamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ahorro = Transaccion::findOrFail($id);
        $Estado = Catalogo::findOrFail($ahorro->idestado);
        if ($Estado->nombre=='Debe') {
            return redirect()->route('ahorro.list')->with('success','No puede eliminar un ahorro que no ha sido pagado');
        }else{
            $clientes = Cliente::all()->lists('nombres','id')->toarray();
            return view('admin.ahorro.delete',compact('clientes','ahorro'));
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
        $ahorro = Transaccion::findOrFail($id);
        $Estado = Catalogo::findOrFail($ahorro->idestado);
        if ($Estado->nombre=='Abierto') {
            return redirect()->route('ahorro.list')->with('success','No puede editar un ahorro abierto');
        }else{
            $clientes = Cliente::all()->lists('nombres','id')->toarray();
            $lugar = Catalogo::Combo('LUGAR')->get()->lists('nombre','id')->toarray();
            return view('admin.ahorro.edit',compact('clientes','ahorro','lugar'));
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
        $ahorro = Transaccion::findOrFail($id);
        $ahorro->fill(\Request::all());
        $ahorro->save();
        return redirect()->route('ahorro.list')->with('success','Se ha editado satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cntCuotas = TransaccionDetalle::where('idtransaccion',$id)->count();
        if ($cntCuotas==0) {
            Transaccion::destroy($id);
            return redirect()->route('ahorro.list')->with('success','Se ha eliminado el ahorro');
        } else {
            return redirect()->route('ahorro.list')->with('success','Este ahorro tiene cuotas no se puede eliminar');
        }
    }
}
