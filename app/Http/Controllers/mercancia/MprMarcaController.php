<?php

namespace App\Http\Controllers\mercancia;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\mercancia\MprMarca;

class MprMarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $articulos = MprArticulo::all();
        $marcas = MprMarca::where('estado',1)->get();
        return view('mercancia.mprmarcas.index',compact('marcas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('mercancia.mprmarcas.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        MprMarca::create ([
            'nombre' => $request -> nombre,
            'estado' => "1"
        ]);
        return redirect() ->route ('mprmarcas.index');
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
        $marcas = MprMarca::findOrFail($id);
        return view ('mercancia.mprmarcas.editar',compact('marcas'));
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
        $marcas = MprMarca::findOrFail($id);
        $marcas->update($datos);
        return redirect('mprmarcas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $datos = MprMarca::findOrFail($id);
        $datos['estado']=0;
        $datos->save();
        return redirect('mprarticulos');
    }
}
