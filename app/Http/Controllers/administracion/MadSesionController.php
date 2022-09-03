<?php

namespace App\Http\Controllers;

use App\Models\administracion\MadSesion;
use App\Http\Requests\StoreMadSesionRequest;
use App\Http\Requests\UpdateMadSesionRequest;

class MadSesionController extends Controller
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
     * @param  \App\Http\Requests\StoreMadSesionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMadSesionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\administracion\MadSesion  $madSesion
     * @return \Illuminate\Http\Response
     */
    public function show(MadSesion $madSesion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\administracion\MadSesion  $madSesion
     * @return \Illuminate\Http\Response
     */
    public function edit(MadSesion $madSesion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMadSesionRequest  $request
     * @param  \App\Models\administracion\MadSesion  $madSesion
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMadSesionRequest $request, MadSesion $madSesion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\administracion\MadSesion  $madSesion
     * @return \Illuminate\Http\Response
     */
    public function destroy(MadSesion $madSesion)
    {
        //
    }
}
