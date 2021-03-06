<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', [
	 'uses' => 'Auth\AuthController@getLogin',
	 'as' => 'login'
	]);

/**
 * Rutas de Cuentas
 */
Route::group(['prefix'=>'cuentas','namespace'=>'Cuentas','middleware'=> 'auth'],function(){

	Route::get('list', ['uses' => 'CuentasController@index','as' => 'cuentas.list']);
});

Route::group(['middleware'=> 'auth'],function(){
	Route::resource('cuentas','Cuentas\CuentasController');
});

/**
 * Rutas de Cuentas detalles
 */
Route::group(['prefix'=>'cuentasdetalles','namespace'=>'CuentasDetalles','middleware'=> 'auth'],function(){

	Route::get('list/{id}', ['uses' => 'CuentasDetallesController@index','as' => 'cuentasdetalles.list']);
	Route::get('vendo', ['uses' => 'CuentasDetallesController@vendo','as' => 'cuentasdetalles.vendo']);
	Route::get('cobro', ['uses' => 'CuentasDetallesController@cobro','as' => 'cuentasdetalles.cobro']);
});

Route::group(['middleware'=> 'auth'],function(){
	Route::resource('cuentasdetalles','CuentasDetalles\CuentasDetallesController');
});

/**
 * Rutas de Prestamo
 */
Route::group(['prefix'=>'prestamo','namespace'=>'Prestamo','middleware'=> 'auth'],function(){

	Route::get('list', ['uses' => 'PrestamoController@index','as' => 'prestamo.list']);
});

Route::group(['middleware'=> 'auth'],function(){
	Route::resource('prestamo','Prestamo\PrestamoController');
});

/**
 * Rutas de Ahorro
 */
Route::group(['prefix'=>'ahorro','namespace'=>'Ahorro','middleware'=> 'auth'],function(){

	Route::get('list', ['uses' => 'AhorroController@index','as' => 'ahorro.list']);
	Route::get('cierre', ['uses' => 'AhorroController@cierre','as' => 'ahorro.cierre']);
	Route::get('apertura', ['uses' => 'AhorroController@apertura','as' => 'ahorro.apertura']);
});

Route::group(['middleware'=> 'auth'],function(){
	Route::resource('ahorro','Ahorro\AhorroController');
});

/**
 * Rutas de Cuotas
 */
Route::group(['prefix'=>'cuotas','namespace'=>'Cuotas','middleware'=> 'auth'],function(){

	Route::get('list/{id}', ['uses' => 'CuotasController@index','as' => 'cuotas.list']);
});

Route::group(['middleware'=> 'auth'],function(){
	Route::resource('cuotas','Cuotas\CuotasController');
});

/**
 * Rutas de Amortizacion
 */
Route::group(['prefix'=>'amortizacion','namespace'=>'Amortizacion','middleware'=> 'auth'],function(){

	Route::get('list/{id}', ['uses' => 'AmortizacionController@index','as' => 'amortizacion.list']);
});

Route::group(['middleware'=> 'auth'],function(){
	Route::resource('amortizacion','Amortizacion\AmortizacionController');
});

/**
 * Rutas del home
 */
Route::group(['middleware'=> 'auth'], function() {
	Route::get('home', [
	'uses' =>'HomeController@index',
	'as' => 'home'
	]);

});

/**
 * Rutas de Clientes
 */
Route::group(['prefix'=>'cliente','namespace'=>'Cliente','middleware'=> 'auth'],function(){

	Route::get('list', ['uses' => 'ClienteController@index','as' => 'cliente.list']);
	Route::get('mostrar/{id}', ['uses' => 'ClienteController@mostrar','as' => 'cliente.mostrar']);
});

Route::group(['middleware'=> 'auth'],function(){
	Route::resource('cliente','Cliente\ClienteController');
});

/**
 * Rutas de Ventas
 */
Route::group(['prefix'=>'venta','namespace'=>'Venta','middleware'=> 'auth'],function(){

	Route::get('list', ['uses' => 'VentaController@index','as' => 'venta.list']);
	Route::get('mostrar/{id}', ['uses' => 'VentaController@mostrar','as' => 'venta.mostrar']);
});

Route::group(['middleware'=> 'auth'],function(){
	Route::resource('venta','Venta\VentaController');
});

/**
 * Rutas de Venta Detalle
 */
Route::group(['prefix'=>'ventadetalle','namespace'=>'VentaDetalle','middleware'=> 'auth'],function(){

	Route::get('list/{id}', ['uses' => 'VentaDetalleController@index','as' => 'ventadetalle.list']);
	Route::get('imprimir', ['uses' => 'VentaDetalleController@imprimir','as' => 'ventadetalle.imprimir']);
	Route::get('showpdf', ['uses' => 'VentaDetalleController@showpdf','as' => 'ventadetalle.showpdf']);
});

Route::group(['middleware'=> 'auth'],function(){
	Route::resource('ventadetalle','VentaDetalle\VentaDetalleController');
});

/**
 * Rutas de Pagos
 */
Route::group(['prefix'=>'pagos','namespace'=>'Pagos','middleware'=> 'auth'],function(){

	Route::get('list/{id}', ['uses' => 'PagosController@index','as' => 'pagos.list']);
});

Route::group(['middleware'=> 'auth'],function(){
	Route::resource('pagos','Pagos\PagosController');
});

/**
 * Rutas de Producto
 */
Route::group(['prefix'=>'producto','namespace'=>'Producto','middleware'=> 'auth'],function(){

	Route::get('list', ['uses' => 'ProductoController@index','as' => 'producto.list']);
	Route::get('estado/{id}', ['uses' => 'ProductoController@estado','as' => 'producto.estado']);
});

Route::group(['middleware'=> 'auth'],function(){
	Route::resource('producto','Producto\ProductoController');
});

// Authentication routes...
Route::get('login', [
	 'uses' => 'Auth\AuthController@getLogin',
	 'as' => 'login'
	]);
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', [
	'uses' => 'Auth\AuthController@getLogout',
	'as'   => 'logout'
	]);

// Registration routes...
Route::get('register', [
	'uses' => 'Auth\AuthController@getRegister',
	'as'   => 'register'
	]);
Route::post('register', 'Auth\AuthController@postRegister');

Route::get('confirmation/{token}',[
	'uses'=> 'Auth\AuthController@getConfirmation',
	'as'=> 'confirmation'
	]);

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');