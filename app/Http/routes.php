<?php
/**
 * Control del front
 */
Route::get('/','FrontController@login');
Route::get('admin','FrontController@index');

/**
 * Rutas del Login
 */
Route::group(['prefix'=>'auth','namespace'=>'Auth'],function(){
	Route::resource('login','LoginController');
	Route::get('logout','LoginController@logout');
});
/**
 * Rutas del Administrador
 */
Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){

	Route::resource('user','UserController');
	Route::resource('catalogo','CatalogoController');

});
/**
 * Ruta de pruebas
 */
