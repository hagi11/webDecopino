<?php

namespace App\Http\Controllers\mercancia;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MprFechaUpdateContoller;
use App\Models\administracion\MadComentario;
use Illuminate\Http\Request;
use App\Models\mercancia\MprArticulo;
use App\Models\mercancia\MprImagen;
use App\Models\mercancia\MprMarca;
use App\Models\mercancia\MprtpArticulo;
use App\Models\venta\MveCarrito;
use App\Models\venta\MveDetCarrito;


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
        $articulos = MprArticulo::where('estado',1)->get();

        $tipo_articulo = MprtpArticulo::all()
        ->where('estado',1);

        foreach($articulos as $articulo){
            $imagenes[$articulo->id] = MprImagen::select('id','ruta','articulo')
            ->where('articulo',$articulo->id)
            ->where('estado',1)
            ->first();
        }
        return view('mercancia.mprarticulos.index',compact('articulos','tipo_articulo','imagenes'));
    }

    public function adminArticulos()
    {
        // $articulos = MprArticulo::all();
        $articulos = MprArticulo::where('estado',1)->get();
        return view('mercancia.mprarticulos.AdminArticulos',compact('articulos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tmarticulos =  MprMarca::all();
        $tparticulos = MprtpArticulo::all();
        return view ('mercancia.mprarticulos.crear',compact('tmarticulos','tparticulos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nuevo = MprArticulo::create ([
            'nombre' => $request -> nombre,
            'descripcion' => $request -> descripcion,
            'precio' => $request -> precio,
            'existencia' => $request -> existencia,
            'marca' => $request -> marca,
            'vista'=>"0",
            'tipoarticulo' => $request -> tipoarticulo,
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $articulo = MprArticulo::findOrFail($id);
        $marca = MprMarca::findOrFail($articulo->marca);
        $tparticulos = MprtpArticulo::findOrFail($articulo->tipoarticulo);

        $relacionados = MprArticulo::select('id','nombre','precio')
        ->where('tipoarticulo',$articulo->tipoarticulo)
        ->where('estado',1)->get();
       
        foreach($relacionados as $relArticulo){
            $relImagenes[$relArticulo->id] = MprImagen::select('id','ruta','articulo')
            ->where('articulo',$relArticulo->id)
            ->where('estado',1)
            ->first();
        }
        $imagenes = MprImagen::where('articulo', $id)
            ->where('estado', 1)
            ->get();

        $comentarios = MadComentario::where('articulo', $id)
        ->where('estado',1)
        ->get();

        return view ('mercancia.mprarticulos.show',compact('articulo','marca','tparticulos','comentarios','relacionados','relImagenes','imagenes'));
    }

    public function showAdmin($id)
    {
        $articulos = MprArticulo::findOrFail($id);
        $tmarticulos = MprMarca::all();
        $tparticulos = MprtpArticulo::all();
        $imagenes = MprImagen::where('articulo', $id)
        ->where('estado', 1)
        ->get();
        $comentarios = MadComentario::where('articulo', $id)
        ->where('estado',1)
        ->get();

        return view ('mercancia.mprarticulos.AdminShow',compact('articulos','tmarticulos','tparticulos','imagenes','comentarios'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $articulos = MprArticulo::findOrFail($id);
        $tmarticulos = MprMarca::all();
        $tparticulos = MprtpArticulo::all();
        return view ('mercancia.mprarticulos.editar',compact('articulos','tmarticulos','tparticulos'));
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
        $fechaActulizacion = new MprFechaUpdateContoller();
        
        $datos = $request->all();
        $articulos = MprArticulo::findOrFail($id);
        $articulos->update($datos);
        $articulos->factualizado =$fechaActulizacion->fecha();
        $articulos->save();
        return redirect("adminVerArtidulo/$id");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $datos = MprArticulo::findOrFail($id);
        $fechaActulizacion = new MprFechaUpdateContoller();

        $imagenes = MprImagen::select('id','ruta','estado')->where('estado',1)->where('articulo',$id)->get();

        foreach ($imagenes as $imagen){
            $ctri = new MprImagenController();
            $ctri->destroy($imagen->id);
        }

        $datos['factualizado'] = $fechaActulizacion->fecha();
        $datos['estado']=0;
        $datos->save();

        return redirect()->route('adminArticulos');
    }

    public function carrito($id)
    {
        $datos = MprArticulo::findOrFail($id);
        $carrito = new MveCarrito();
        $carrito->cliente="1";
        $carrito->estado="1";
        $carrito->save();

        $detalle  = new MveDetCarrito();
        $detalle->cantidad="1";
        $detalle->articulo=$datos->id;
        $detalle->carrito=$carrito->id;
        $detalle->estado="1";
        $detalle->save();
        return redirect('mprarticulos');
    }
}
