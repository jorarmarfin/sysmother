<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Catalogo;
use Session;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Lista = User::Lista()->get();
        return view('admin.users.list',compact('Lista'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Roles = Catalogo::Combo('ROL USUARIO')->lists('nombre','id');
        return view('admin.users.create',compact('Roles'));
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
        $user = new User($data);
        $user->save();
        $Roles = Catalogo::Combo('ROL USUARIO')->lists('nombre','id');
        $msj='Se ha guardado el registro satisfactoriamente ';
        Session::flash('message-success',$msj);
        return view('admin.users.create',compact('Roles'));
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
        $user = User::findOrFail($id);
        $Roles = Catalogo::Combo('ROL USUARIO')->lists('nombre','id');
        return view('admin.users.edit',compact('user','Roles'));
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
        $user = User::findOrFail($id);
        $user->fill(\Request::all());
        $user->save();
        Session::flash('message-success','Se ha actualizado el registro satisfactoriamente ');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        $msj='El usuario '.$user->name.' fue eliminado';
        Session::flash('message-success',$msj);
        return redirect()->route('admin.user.index');
    }
}
