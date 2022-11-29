<?php

namespace App\Http\Controllers\mercancia;

use App\Http\Controllers\administracion\musUsuarioController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MprFechaUpdateContoller;
use App\Models\administracion\MadComentario;
use Illuminate\Http\Request;
use App\Models\mercancia\MprArticulo;
use App\Models\mercancia\MprImagen;
use App\Models\mercancia\MprMarca;
use App\Models\mercancia\MprtpArticulo;
use Illuminate\Support\Facades\Auth;

class MprArticuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $articulos = MprArticulo::all();
        $articulos = MprArticulo::where('estado', 1)->get();

        $tipo_articulo = MprtpArticulo::all()
            ->where('estado', 1);

        foreach ($articulos as $articulo) {
            $imagenes[$articulo->id] = MprImagen::select('id', 'ruta', 'articulo')
                ->where('articulo', $articulo->id)
                ->where('estado', 1)
                ->first();
        }
        return view('mercancia.mprarticulos.index', compact('articulos', 'tipo_articulo', 'imagenes'));
    }

    public function adminArticulos()
    {
        if (Auth::guard('usuarios')->user()) {
            $ctru = new musUsuarioController();
            if ($ctru->getPermisoInv()->leer == 1) {
                $articulos = MprArticulo::where('estado', 1)->get();
            
                for ($i=0; $i < count($articulos); $i++) { 
                   if( strlen($articulos[$i]->descripcion)>30){
                    $articulos[$i]->descripcion = substr( $articulos[$i]->descripcion , 0, 20) . "...";
                   }
                }
                return view('mercancia.mprarticulos.AdminArticulos', compact('articulos'));
            }
        }
        return redirect()->route('homeAdmin');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::guard('usuarios')->user()) {
            $ctru = new musUsuarioController();
            if ($ctru->getPermisoInv()->crear == 1) {
                $tmarticulos =  MprMarca::all();
                $tparticulos = MprtpArticulo::all();
                return view('mercancia.mprarticulos.crear', compact('tmarticulos', 'tparticulos'));
            }
        }
        return redirect()->route('homeAdmin');
    }





    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::guard('usuarios')->user()) {
            $ctru = new musUsuarioController();
            if ($ctru->getPermisoInv()->crear == 1) {
                $nuevo = MprArticulo::create([
                    'nombre' => $request->nombre,
                    'descripcion' => $request->descripcion,
                    'precio' => $request->precio,
                    'existencia' => $request->existencia,
                    'marca' => $request->marca,
                    'vista' => "0",
                    'tipoarticulo' => $request->tipoarticulo,
                    'estado' => "1"
                ]);

                $comboImg = MprImagen::where('estado', 2)->get();
                for ($i = 0; $i < count($comboImg); $i++) {
                    $comboImg[$i]->articulo = $nuevo->id;
                    $comboImg[$i]->estado = 1;
                    $comboImg[$i]->save();
                }
                return redirect()->route('adminArticulos');
            }
        }
        return redirect()->route('homeAdmin');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $articulo = MprArticulo::findOrFail($id);
        if (Auth::user()) {
            $articulo->vistas = $articulo['vistas'] + 1;
        }
        $articulo->update();
        $marca = MprMarca::findOrFail($articulo->marca);
        $tparticulos = MprtpArticulo::findOrFail($articulo->tipoarticulo);
        $relacionados = MprArticulo::select('id', 'nombre', 'precio')
            ->where('tipoarticulo', $articulo->tipoarticulo)
            ->where('id', '<>', $id)
            ->where('estado', 1)->get();

        foreach ($relacionados as $relArticulo) {
            $relImagenes[$relArticulo->id] = MprImagen::select('id', 'ruta', 'articulo')
                ->where('articulo', $relArticulo->id)
                ->where('estado', 1)
                ->first();
        }
        $imagenes = MprImagen::where('articulo', $id)
            ->where('estado', 1)
            ->get();

        $comentarios = MadComentario::where('articulo', $id)
            ->where('estado', 1)
            ->get();

        return view('mercancia.mprarticulos.show', compact('articulo', 'marca', 'tparticulos', 'comentarios', 'relacionados', 'relImagenes', 'imagenes'));
    }

    public function showAdmin($id)
    {

        if (Auth::guard('usuarios')->user()) {
            $ctru = new musUsuarioController();
            if ($ctru->getPermisoInv()->mostrar == 1) {
                $articulos = MprArticulo::findOrFail($id);
                $tmarticulos = MprMarca::all();
                $tparticulos = MprtpArticulo::all();
                $imagenes = MprImagen::where('articulo', $id)
                    ->where('estado', 1)
                    ->get();
                $comentarios = MadComentario::where('articulo', $id)
                    ->where('estado', 1)
                    ->get();

                return view('mercancia.mprarticulos.AdminShow', compact('articulos', 'tmarticulos', 'tparticulos', 'imagenes', 'comentarios'));
            }
        }
        return redirect()->route('homeAdmin');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        if (Auth::guard('usuarios')->user()) {
            $ctru = new musUsuarioController();
            if ($ctru->getPermisoInv()->editar == 1) {
                $articulos = MprArticulo::findOrFail($id);
                $tmarticulos = MprMarca::all();
                $tparticulos = MprtpArticulo::all();
                return view('mercancia.mprarticulos.editar', compact('articulos', 'tmarticulos', 'tparticulos'));
            }
        }
        return redirect()->route('homeAdmin');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if (Auth::guard('usuarios')->user()) {
            $ctru = new musUsuarioController();
            if ($ctru->getPermisoInv()->editar == 1) {
                $fechaActulizacion = new MprFechaUpdateContoller();

                $datos = $request->all();
                $articulos = MprArticulo::findOrFail($id);
                $articulos->update($datos);
                $articulos->factualizado = $fechaActulizacion->fecha();
                $articulos->save();
                return redirect("adminVerArtidulo/$id");
            }
        }
        return redirect()->route('homeAdmin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {

        if (Auth::guard('usuarios')->user()) {
            $ctru = new musUsuarioController();
            if ($ctru->getPermisoInv()->eliminar == 1) {
                $datos = MprArticulo::findOrFail($id);
                $fechaActulizacion = new MprFechaUpdateContoller();

                $imagenes = MprImagen::select('id', 'ruta', 'estado')->where('estado', 1)->where('articulo', $id)->get();

                foreach ($imagenes as $imagen) {
                    $ctri = new MprImagenController();
                    $ctri->destroy($imagen->id);
                }

                $datos['factualizado'] = $fechaActulizacion->fecha();
                $datos['estado'] = 0;
                $datos->save();

                return redirect()->route('adminArticulos');
            }
        }
        return redirect()->route('homeAdmin');
    }
}
