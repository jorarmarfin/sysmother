<?php

namespace App\Http\Controllers\Prestamo;

use App\Transaccion;
use App\TransaccionDetalle;
use App\Catalogo;
use App\Cliente;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\TransactionRequest;
use App\Http\Controllers\Controller;

class PrestamoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Catalogo::IdCatalogo('TIPO TRANSACCION','Prestamo');
        $Lista = Transaccion::getTransaccion($id);
        foreach ($Lista as $row)$row->Total=$row->Total;
        return view('admin.prestamo.list',compact('Lista'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientes = Cliente::all()->lists('nombres','id')->toarray();
        $lugar = Catalogo::Combo('LUGAR')->get()->lists('nombre','id')->toarray();
        return view('admin.prestamo.create',compact('clientes','lugar'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransactionRequest $request)
    {
        $data = $request->all();
        $data['idtipo']=10;
        $data['idestado']=13;

        $transaction = new Transaccion($data);
        $transaction->save();
        return redirect()->route('prestamo.list')->with('success','Se ha registrado satisfactoriamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prestamo = Transaccion::findOrFail($id);
        $Estado = Catalogo::findOrFail($prestamo->idestado);
        if ($Estado->nombre=='Debe') {
            return redirect()->route('prestamo.list')->with('success','No puede eliminar un Prestamo que no ha sido pagado');
        }else{
            $clientes = Cliente::all()->lists('nombres','id')->toarray();
            return view('admin.prestamo.delete',compact('clientes','prestamo'));
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
        $prestamo = Transaccion::findOrFail($id);
        $Estado = Catalogo::findOrFail($prestamo->idestado);
        if ($Estado->nombre=='Pagado') {
            return redirect()->route('prestamo.list')->with('success','No puede editar un Prestamo pagado');
        }else{
            $lugar = Catalogo::Combo('LUGAR')->get()->lists('nombre','id')->toarray();
            $clientes = Cliente::all()->lists('nombres','id')->toarray();
            return view('admin.prestamo.edit',compact('clientes','prestamo','lugar'));
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
        $prestamo = Transaccion::findOrFail($id);
        $prestamo->fill(\Request::all());
        $prestamo->save();
        return redirect()->route('prestamo.list')->with('success','Se ha editado satisfactoriamente');

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
            return redirect()->route('prestamo.list')->with('success','Se ha eliminado el prestamo');
        } else {
            return redirect()->route('prestamo.list')->with('success','Este prestamo tiene cuotas no se puede eliminar');
        }
    }
}
