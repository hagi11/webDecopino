<?php

namespace App\Http\Controllers\mercancia;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\mercancia\MprtpArticulo;

class MprtpArticuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $articulos = MprArticulo::all();
        $tparticulos = MprtpArticulo::where('estado',1)->get();
        return view('mercancia.mprtparticulos.index',compact('tparticulos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('mercancia.mprtparticulos.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        MprtpArticulo::create ([
            'nombre' => $request -> nombre,
            'estado' => "1"
        ]);
        return redirect() ->route ('mprtparticulos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tparticulos = MprtpArticulo::findOrFail($id);
        return view ('mercancia.mprtparticulos.editar',compact('tparticulos'));
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
        $tparticulos = MprtpArticulo::findOrFail($id);
        $tparticulos->update($datos);
        return redirect('mprtparticulos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $datos = MprtpArticulo::findOrFail($id);
        $datos['estado']=0;
        $datos->save();
        return redirect('mprarticulos');
    }
}
