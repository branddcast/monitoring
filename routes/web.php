<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/monitoreo', 'MonitoreoController@index');
Route::get('/bitacora', 'BitacoraController@index');
Route::get('/bitacora/ultimos_registros', 'BitacoraController@ultimos_registros');
Route::post('/validar_usuario', 'BitacoraController@validar_hash')->name('validar_usuario');
Route::post('/datos_generales', 'MonitoreoController@datosGenerales');