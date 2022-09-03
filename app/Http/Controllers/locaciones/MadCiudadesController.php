<?php

namespace App\Http\Controllers\locaciones;

use App\Http\Controllers\Controller;
use App\Models\locaciones\MadCiudad;
use Illuminate\Http\Request;

class MadCiudadesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function departamentos(Request $request)
    {
        $ciudades = MadCiudad::where('estado', '=', '1')
        ->where('departamento', '=', $request->depa)
        ->get();
         return $ciudades;
        // return $request->depa;
    }

    public function ciudades (Request $request)
    {
        $ciudades = MadCiudad::where('estado', '=', '1')
       ->where('departamento', '=', $request->ciu)
       ->get();
        return $ciudades;
    }
    public function identificacion(Request $request)
    {
        return $request->identify;
    }
}
