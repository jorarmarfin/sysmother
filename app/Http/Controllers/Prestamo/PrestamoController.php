<?php

namespace App\Http\Controllers\Prestamo;

use App\Transaccion;
use App\Catalogo;
use App\Cliente;

use Illuminate\Http\Request;

use App\Http\Requests;
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
        // $result = Transaccion::all();
        // foreach ($result as $row)$row->Final=$row->Final;
        // dd($result->toArray());
        // $id = Catalogo::IdCatalogo('TIPO TRANSACCION','Prestamo');
        // $Lista = Transaccion::getPrestamos($id);
        // foreach ($Lista as $row)$row->Total=$row->Total;
        // return view('admin.prestamo.list',compact('Lista'));
        $result = Transaccion::find(10)->with('transacciondetalle')->get();
        dd($result->toArray());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientes = Cliente::all()->lists('nombres','id')->toarray();
        return view('admin.prestamo.create',compact('clientes'));
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
        $user->save();
        // dd($data);
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
        //
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
        //
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
