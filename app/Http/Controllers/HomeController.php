<?php

namespace App\Http\Controllers;

use App\Transaccion;
use App\Producto;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$cntVentas = Transaccion::getCantidad('Venta','Debe')->toArray()[0]['cnt'];
    	$cntPrestamos = Transaccion::getCantidad('Prestamo','Debe')->toArray()[0]['cnt'];
    	$cntAhorros = Transaccion::getCantidad('Ahorro','Abierto')->toArray()[0]['cnt'];
    	$products = Producto::where('activo','1')->orderBy('id','desc')->take(5)->get();
    	// dd($cntVentas);
        return view('admin.index',compact('cntVentas','cntPrestamos','cntAhorros','products'));
    }



}
