<?php

use App\Http\Controllers\Admin\CancionesController;
use App\Http\Controllers\Admin\ExportarCancionesController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PuntajesController;
use Illuminate\Support\Facades\Route;

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

Route::get('admin', [HomeController::class, 'index']);
Route::get('admin/getPersonas', [HomeController::class, 'getPersonas']);
Route::post('admin/insertPersona', [HomeController::class, 'insertPersona']);
Route::post('admin/eliminarPersona', [HomeController::class, 'eliminarPersona']);
Route::post('admin/editarPersona', [HomeController::class, 'editarPersona']);
Route::get('admin/getDatosPersona', [HomeController::class, 'getDatosPersona']);

//EXPORTAR CANCIONES
Route::get('exportarCanciones', [ExportarCancionesController::class, 'index']);
Route::get('exportarCanciones/getSongs', [ExportarCancionesController::class, 'getSongs']);
Route::post('exportarCanciones/download', [ExportarCancionesController::class, 'download']);

//CANCIONES
Route::get('canciones', [CancionesController::class, 'index']);
Route::get('canciones/getCanciones', [CancionesController::class, 'getCanciones']);
Route::get('canciones/create', [CancionesController::class, 'create']);
Route::post('canciones/store', [CancionesController::class, 'store']);

//PUNTAJES
Route::get('puntajes', [PuntajesController::class, 'index']);

