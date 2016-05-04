<?php

namespace App\Http\Controllers\Producto;

use App\Producto;
use App\VentaDetalle;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Lista = Producto::orderBy('id','desc')->get();
        foreach ($Lista as $row)$row->Estado=$row->Estado;
        return view('admin.producto.list',compact('Lista'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.producto.create');
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
        $data['activo']=true;
        $data['idcategoria']=1;
        $product = new Producto($data);
        $product->save();
        return redirect()->route('producto.list')->with('success','Se ha registrado satisfactoriamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $producto = Producto::findOrFail($id);
        return view('admin.producto.delete',compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        return view('admin.producto.edit',compact('producto'));
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
        $producto = Producto::findOrFail($id);
        $producto->fill($request->all());
        $producto->save();
        return redirect()->route('producto.list')->with('success','Se ha editado satisfactoriamente');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * no se debe poder eliminar un  producto que y aesta siendo usado
     */
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $cntVD = VentaDetalle::where('idproducto',$id)->count();
        if ($cntVD==0) {
            $producto->delete();
            return redirect()->route('producto.list')->with('success','Se ha eliminado el producto');
        }else{
            return redirect()->route('producto.list')->with('warning','No puedo eliminar un producto que se ha vendido');
        }
    }

    public function estado($id)
    {
        $product = Producto::findOrFail($id);
        $retVal = ($product->estado=='Activo') ? 0 : 1 ;
        $product->activo=$retVal;
        $product->save();
        return redirect()->route('producto.list');
    }
}
