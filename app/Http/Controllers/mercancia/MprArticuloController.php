<?php

namespace App\Http\Controllers\mercancia;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\mercancia\MprArticulo;
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
        return view('mercancia.mprarticulos.index',compact('articulos'));

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
        MprArticulo::create ([
            'nombre' => $request -> nombre,
            'descripcion' => $request -> descripcion,
            'imagen' => $request -> imagen,
            'precio' => $request -> precio,
            'existencia' => $request -> existencia,
            'marca' => $request -> marca,
            'tipoarticulo' => $request -> tipoarticulo,
            'estado' => "1"
        ]);
        return redirect() ->route ('mercancia.mprarticulos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $articulos = MprArticulo::findOrFail($id);
        $tmarticulos = MprMarca::all();
        $tparticulos = MprtpArticulo::all();
        return view ('mercancia.mprarticulos.show',compact('articulos','tmarticulos','tparticulos'));
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
        $datos = $request->all();
        $articulos = MprArticulo::findOrFail($id);
        $articulos->update($datos);
        return redirect('mprarticulos');
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
        $datos['estado']=0;
        $datos->save();
        return redirect('mprarticulos');
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
