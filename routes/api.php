<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//LOGIN
Route::post('/login','ApiAuth\LoginController@login');
Route::post('/registro','ApiAuth\RegistroController@registro');
Route::middleware('auth:sanctum')->delete('/logout','ApiAuth\LoginController@logout');


//USUARIOS
Route::middleware('auth:sanctum')->get('/obtener/usuarios/{id?}', 'ApiInfo\UsuarioController@index')->where("id","[0-9]+");