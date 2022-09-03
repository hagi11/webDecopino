<?php

namespace App\Http\Controllers;

use App\Models\administracion\MadPersona;
use App\Http\Requests\StoreMadPersonaRequest;
use App\Http\Requests\UpdateMadPersonaRequest;

class MadPersonaController extends Controller
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
     * @param  \App\Http\Requests\StoreMadPersonaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMadPersonaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\administracion\MadPersona  $madPersona
     * @return \Illuminate\Http\Response
     */
    public function show(MadPersona $madPersona)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\administracion\MadPersona  $madPersona
     * @return \Illuminate\Http\Response
     */
    public function edit(MadPersona $madPersona)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMadPersonaRequest  $request
     * @param  \App\Models\administracion\MadPersona  $madPersona
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMadPersonaRequest $request, MadPersona $madPersona)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\administracion\MadPersona  $madPersona
     * @return \Illuminate\Http\Response
     */
    public function destroy(MadPersona $madPersona)
    {
        //
    }
}
