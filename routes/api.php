<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {

    return $request->user();
});

Route::apiResource('user', 'API\UserController');
Route::get('findUser', 'API\UserController@search');
Route::get('profile', 'API\UserController@profile');
Route::put('profile', 'API\UserController@updateProfile');

Route::apiResource('persona', 'API\PersonaController');

Route::apiResource('empleado', 'API\EmpleadoController');
Route::get('findEmple', 'API\EmpleadoController@search');

Route::apiResource('ente', 'API\EnteController');
Route::get('findEnte', 'API\EnteController@search');




Route::apiResource('movimiento', 'API\MovimientoController');
Route::get('findMovimiento', 'API\MovimientoController@search');

Route::apiResource('movimiento_recurso', 'API\Movimiento_recursoController');




Route::apiResource('recurso', 'API\RecursoController');

Route::apiResource('articulo', 'API\ArticuloController');
Route::get('findArticulo', 'API\ArticuloController@search');

Route::apiResource('equipo', 'API\EquipoController');
Route::get('findEquipo', 'API\EquipoController@search');

Route::apiResource('maquinaria', 'API\MaquinariaController');
Route::get('findMaquinaria', 'API\MaquinariaController@search');

Route::apiResource('vehiculo', 'API\VehiculoController');
Route::get('findVehiculo', 'API\VehiculoController@search');
