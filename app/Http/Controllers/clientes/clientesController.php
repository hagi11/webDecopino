<?php

namespace App\Http\Controllers\clientes;

use App\Http\Controllers\Controller;
use App\Models\clientes\MclCliente;
use Illuminate\Http\Request;
use App\Models\administracion\MadPersona;
use App\Models\administracion\MadParametro;
use App\Models\locaciones\MadCiudad;
use Illuminate\Support\Facades\Validator;

class clientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("clientes.cuenta");
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
        $identificaciones = MadParametro::where('tiparametro',1)->get();
        $ciudades = MadCiudad::where('estado',1)->get();
        $datos = MclCliente::all()->where('estado',1)->where('id', $id)->first();
        $datos2 = MadPersona::all()->where('estado',1)->where('id', $datos->persona)->first();

        return view("clientes.datos", compact('datos', 'datos2','identificaciones','ciudades'));
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
        $validator = Validator::make($request->all(),[
            'tidentificacion' => 'required|max:45',
            // 'identificacion' => 'required|max:12',
            'nombre' => 'required|max:45',
            'apellido' => 'required|max:45',
            'correo' => 'required|max:45',
            'telefono' => 'required|max:45',
            'direccion' => 'required|max:100',
            'ciudad' => 'required|max:11',

        ]);

        $personas = MadPersona::findOrFail($id);
        $personas->tidentificacion = $request['tidentificacion'];
        $personas->identificacion = $request['identificacion'];
        $personas->nombre = $request['nombre'];
        $personas->apellido = $request['apellido'];
        $personas->telefono = $request['telefono'];
        $personas->direccion = $request['direccion'];
        $personas->ciudad = $request['ciudad'];
        $personas->save();

        return view("clientes.cuenta");
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
}
