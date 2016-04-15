<?php

namespace App\Http\Controllers\Cliente;

use App\Cliente;
use App\Transaccion;

use Storage;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ClienteController extends Controller
{

    public function mostrar($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('admin.cliente.show',compact('cliente'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Lista = Cliente::orderBy('nombres')->get();
        return view('admin.cliente.list',compact('Lista'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cliente.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cliente = new Cliente($request->all());
        $cliente->save();
        return redirect()->route('cliente.list')->with('success','Se ha registrado satisfactoriamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cnttransaction = Transaccion::where('idcliente',$id)->count();
        if ($cnttransaction>0) {
            return redirect()->back()->with('danger','No puede eliminar un cliente que tiene transacciones');
        } else {
            $cliente = Cliente::findOrFail($id);
            return view('admin.cliente.delete',compact('cliente'));
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
        $cliente = Cliente::findOrFail($id);
        return view('admin.cliente.edit',compact('cliente'));
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
        $cliente = Cliente::findOrFail($id);
        $cliente->fill($request->all());
        $cliente->save();
        return redirect()->route('cliente.list')->with('success','Se ha editado satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Cliente::destroy($id);
        return redirect()->route('cliente.list')->with('success','Se ha eliminado el prestamo');
    }
}
