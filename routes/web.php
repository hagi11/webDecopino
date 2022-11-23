<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\administracion\MadPersonaController;
use App\Http\Controllers\mercancia\MprLineaController;
use App\Http\Controllers\mercancia\MprProductoController;
use App\Http\Controllers\mercancia\MprArticuloController;
use App\Http\Controllers\mercancia\MprtpArticuloController;
use App\Http\Controllers\clientes\MclClienteController;
use App\Http\Controllers\mercancia\MprMarcaController;
use App\Http\Controllers\mercancia\mprcombosController;
use App\Http\Controllers\pedidos\MprPedidoController;
use App\Http\Controllers\administracion\MadComentarioController;
use App\Http\Controllers\carrito\mvecarritoController;
use App\Http\Controllers\mercancia\MprBannerController;
use App\Http\Controllers\mercancia\MprImagenController;
use App\Http\Controllers\mercancia\MprCategoriaController;
use App\Http\Controllers\mercancia\MprSubCategoriaContoller;
use App\Http\Controllers\clientes\MclListadeseosController;


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
Route::get('/homeAdmin', [App\Http\Controllers\HomeController::class, 'indexAdmin'])->name('homeAdmin');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/homeAdmin', [App\Http\Controllers\HomeController::class, 'indexAdmin'])->name('homeAdmin')->middleware(['auth'=> 'auth:usuarios']) ;
Route::get('/departamentos', [App\Http\Controllers\locaciones\MadCiudadesController::class, 'departamentos'])->name('apidepa');
Route::get('/ciudades', [App\Http\Controllers\locaciones\MadCiudadesController::class, 'ciudades'])->name('apiciud');

Route::resource('combo',mprcombosController::class);
Route::get('/adminCombo', [App\Http\Controllers\mercancia\mprcombosController::class, 'indexAdmin'])->name('indexAdmin')->middleware(['auth'=> 'auth:usuarios']);
Route::get('/verComboAdmin/{id}', [App\Http\Controllers\mercancia\mprcombosController::class, 'showAdmin'])->name('verComboAdmin')->middleware(['auth'=> 'auth:usuarios']);


// Route::get('/carrito/{id}', [App\Http\Controllers\mercancia\MprProductoController::class, 'carrito'])->name('carrito');

Route::resource('comentarios', MadComentarioController::class)->names('comentarios');

Route::resource('productos', MprProductoController::class)->names('productos');
Route::get('/adminProducto', [App\Http\Controllers\mercancia\MprProductoController::class, 'adminProducto'])->name('adminProducto')->middleware(['auth'=> 'auth:usuarios']);
Route::get('/adminVerProducto/{id}', [App\Http\Controllers\mercancia\MprProductoController::class, 'showAdmin'])->name('adminVerProducto')->middleware(['auth'=> 'auth:usuarios']);
Route::get('/productoHome', function () {
    return view('mercancia.productoInicio');
});
Route::resource('lineaproducto', MprLineaController::class)->names('lineaproducto')->middleware(['auth'=> 'auth:usuarios']);
Route::resource('categoria', MprCategoriaController::class)->names('categoria')->middleware(['auth'=> 'auth:usuarios']);
Route::resource('subCategoria', MprSubCategoriaContoller::class)->names('subCategoria')->middleware(['auth'=> 'auth:usuarios']);


//Route::resource('comentarios', MadComentarioController::class)->names('comentarios');

Route::resource('mprarticulos', MprArticuloController::class)->names('mprarticulos');
Route::resource('mprtparticulos', MprtpArticuloController::class)->names('mprtparticulos');
Route::resource('mprmarcas', MprMarcaController::class)->names('mprmarcas');
Route::get('/adminArticulos', [App\Http\Controllers\mercancia\MprArticuloController::class, 'adminArticulos'])->name('adminArticulos')->middleware(['auth'=> 'auth:usuarios']);
Route::get('/adminVerArtidulo/{id}', [App\Http\Controllers\mercancia\MprArticuloController::class, 'showAdmin'])->name('adminVerArtidulo')->middleware(['auth'=> 'auth:usuarios']);
Route::get('/articuloHome', function () {
    return view('mercancia.articuloInicio');
});


Route::resource('mprimagenes', MprImagenController::class)->names('mprimagenes')->middleware(['auth'=> 'auth:usuarios']); // aqui

Route::get('/showImg', [App\Http\Controllers\mercancia\MprImagenController::class, 'showImg'])->name('showImg')->middleware(['auth'=> 'auth:usuarios']);

Route::POST('/preStore', [App\Http\Controllers\mercancia\MprImagenController::class, 'preStore'])->name('preStore')->middleware(['auth'=> 'auth:usuarios']);
Route::post('/cargarImagenes', [App\Http\Controllers\mercancia\MprImagenController::class, 'cargarImagenes'])->name('cargarImagenes')->middleware(['auth'=> 'auth:usuarios']);

Route::resource('listaDeseos', MclListadeseosController::class)->names('listaDeseos');
Route::get('/listaDeseosCliente/{id}', [App\Http\Controllers\clientes\MclListadeseosController::class, 'indexCliente'])->name('listaDeseos')->middleware(['auth'=> 'auth:web']);


Route::resource('pedidos', MprPedidoController::class)->names('pedidos')->middleware(['auth'=> 'auth:usuarios']);

Route::resource('mprbanners', MprBannerController::class)->names('mprbanners')->middleware(['auth'=> 'auth:usuarios']);

Route::resource('carrito', mvecarritoController::class)->names('carrito');
Route::get('/carritoCliente/{id}', [mvecarritoController::class, 'indexCliente'])->name('carritoCliente')->middleware(['auth'=> 'auth:web']);


Route::get('/login-google', function () {
    return Socialite::driver('google')->redirect();
})->name('login_gmail');
 
Route::get('/google-callback', function () {
    $user = Socialite::driver('google')->user();
    dd($user);
    // $user->token
});

Route::get('/contactenos', function () {
    return view('inf_general.contactenos');
});

Route::get('/nosotros', function () {
    return view('inf_general.sobreNosotros');
});
