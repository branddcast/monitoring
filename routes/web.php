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
Route::get('bitacora/ultimos_registros', 'BitacoraController@ultimos_registros');
//Route::post('/validar_usuario', 'BitacoraController@validar_hash')->name('validar_usuario');
Route::post('/datos_generales', 'MonitoreoController@datosGenerales');
Route::post('/usuarios/agregar_usuario', 'UserController@agregarUsuario');
Route::get('/usuarios/huella_usuario/{usuario}', 'UserController@huella_usuario');
Route::post('/usuarios/huella_eliminar', 'UserController@huella_eliminar');
Route::get('/usuarios/all', 'UserController@getAll');
Route::get('/usuarios/usuario/{id}', 'UserController@getUser');
Route::post('/usuarios/auth_user', 'UserController@auth_user');
Route::post('/usuarios/eliminar_usuario', 'UserController@deleteUser');
Route::post('/usuarios/actualizar_usuario', 'UserController@updateUser');
Route::get('/roles/all', function(){
	$roles = \DB::table('roles')->select('id', 'Nombre')->get();
	$response = array();
	foreach ($roles as $rol) {
		$response[] = array('id' => $rol->id , 'nombre' => $rol->Nombre);
	}
	return response()->json($response);
});
Route::post('/consumo_electrico/all', 'ConsumoElectricoController@getAll');