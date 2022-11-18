<?php

namespace App\Http\Controllers\mercancia;

use App\Http\Controllers\Controller;
use App\Models\mercancia\MprLinea;
use Illuminate\Http\Request;

class MprLineaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lineas = MprLinea::all()->where('estado',1);
        return view('mercancia.lineaproductos.index', compact('lineas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mercancia.lineaproductos.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        MprLinea::create([
            'nombre' => $request->nombre,
            'estado' => "1",
        ]);
        return redirect()->route('lineaproducto.index');
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
        $linea = MprLinea::findOrFail($id);
        return view ('mercancia.lineaproductos.editar', compact('linea'));
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
        $linea = MprLinea::findOrFail($id);
        $linea->update($datos);

        return redirect('lineaproducto');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $linea = MprLinea::findOrFail($id);
        $linea->estado = "0";
        $linea->save();
        return redirect('lineaproducto');
    }
}
