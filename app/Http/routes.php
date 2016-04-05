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
 * Rutas de Prestamo
 */
Route::group(['prefix'=>'prestamo','namespace'=>'Prestamo','middleware'=> 'auth'],function(){

	Route::get('list', ['uses' => 'PrestamoController@index','as' => 'prestamo.list']);
});

Route::group(['middleware'=> 'auth'],function(){
	Route::resource('prestamo','Prestamo\PrestamoController');
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


Route::group(['middleware'=> 'auth'], function() {
	Route::get('home', [
	'uses' =>'HomeController@index',
	'as' => 'home'
	]);

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