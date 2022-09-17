<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('combo',App\Http\Controllers\mercancia\mprcombosController::class);
Route::resource('comProducto',App\Http\Controllers\mercancia\MprComProductoController::class);
Route::get('/crearCombo', [App\Http\Controllers\mercancia\MprComProductoController::class, 'crearCombo'])->name('crearCombo');
Route::get('/editarCombo', [App\Http\Controllers\mercancia\MprComProductoController::class, 'editarCombo'])->name('editarCombo');
Route::get('/verCombo/{id}', [App\Http\Controllers\mercancia\MprComProductoController::class, 'index'])->name('verCombo');

// Route::get('/agregarcombo',[App\Http\Controllers\mercancia\mprcombosController::class,'selecionencombo'])->name('agregarcombo');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/departamentos', [App\Http\Controllers\locaciones\MadCiudadesController::class, 'departamentos'])->name('apidepa');
Route::get('/ciudades', [App\Http\Controllers\locaciones\MadCiudadesController::class, 'ciudades'])->name('apiciud');


