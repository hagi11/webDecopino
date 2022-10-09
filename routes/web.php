<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\administracion\MadPersonaController;
use App\Http\Controllers\mercancia\MprLineaController;
use App\Http\Controllers\mercancia\MprProductoController;

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


Route::post('/logueo', [App\Http\Controllers\LoginPropio::class, 'authenticate'])->name('micontrolador');

Route::get('/persona', [App\Http\Controllers\administracion\MadPersonaController::class, 'index'])->name('personas'); //->middleware(['auth'=> 'auth:usuarios']);   --> Proteger una clase


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/departamentos', [App\Http\Controllers\locaciones\MadCiudadesController::class, 'departamentos'])->name('apidepa');
Route::get('/ciudades', [App\Http\Controllers\locaciones\MadCiudadesController::class, 'ciudades'])->name('apiciud');

Route::resource('combo',App\Http\Controllers\mercancia\mprcombosController::class);
 

Route::get('/carrito/{id}', [App\Http\Controllers\mercancia\MprProductoController::class, 'carrito'])->name('carrito');
Route::resource('lineaproducto', MprLineaController::class)->names('lineaproducto');
Route::resource('productos', MprProductoController::class)->names('productos');

Route::resource('comentarios', MadComentarioController::class)->names('comentarios');



Route::get('/login-google', function () {
    return Socialite::driver('google')->redirect();
})->name('login_gmail');
 
Route::get('/google-callback', function () {
    $user = Socialite::driver('google')->user();
    dd($user);
    // $user->token
});