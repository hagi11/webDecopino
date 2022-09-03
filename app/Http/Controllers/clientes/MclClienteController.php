<?php

namespace App\Http\Controllers;

use App\Models\clientes\MclCliente;
use App\Http\Requests\StoreMclClienteRequest;
use App\Http\Requests\UpdateMclClienteRequest;

class MclClienteController extends Controller
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
     * @param  \App\Http\Requests\StoreMclClienteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMclClienteRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clientes\MclCliente  $mclCliente
     * @return \Illuminate\Http\Response
     */
    public function show(MclCliente $mclCliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\clientes\MclCliente  $mclCliente
     * @return \Illuminate\Http\Response
     */
    public function edit(MclCliente $mclCliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMclClienteRequest  $request
     * @param  \App\Models\clientes\MclCliente  $mclCliente
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMclClienteRequest $request, MclCliente $mclCliente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clientes\MclCliente  $mclCliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(MclCliente $mclCliente)
    {
        //
    }
}
