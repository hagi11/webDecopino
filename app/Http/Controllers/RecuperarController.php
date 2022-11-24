<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\RecuperarContraseña;
use App\Models\clientes\MclCliente;
use App\Models\usuarios\MusUsuario;
use Error;
use Illuminate\Support\Facades\Validator;

class RecuperarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bandera = 0;
        return view('auth.RecuperarContraseña', compact('bandera'));
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
        $correo = "";                          //Variable para String Cliente
        $correo2 = "";                         //Variable para String Usuario
        $tipo = "";

        $datos = MclCliente::select('login')  // Trae correos de Clientes
            ->where('login', $request->login)
            ->where('estado', 1)->get();

        $datos2 = MusUsuario::select('login')   // Trae correos de Usuarios
            ->where('login', $request->login)
            ->where('estado', 1)->get();

        $destinatario = $request->login;        //Correo del formulario
        

        foreach ($datos as $correos) {         //Convierte de Array a String clientes
            $correo = $correos->login; 
        }
        foreach ($datos2 as $correos2) {       //Convierte de Array a String Usuarios
            $correo2 = $correos2->login;
        }

        if ($destinatario == $correo) { //Proceso de envio del correo.
            $tipo = "cliente";
            $recuperar = new RecuperarContraseña($correo, $tipo);
            Mail::to($destinatario)->send($recuperar);
            return view('auth.enviado', compact('correo', 'tipo'));
        } else if ($destinatario == $correo2){                                                      //No existe el Correo.
            $tipo = "usuario";
            $recuperar = new RecuperarContraseña($correo2, $tipo);
            Mail::to($destinatario)->send($recuperar);
            return view('auth.enviado', compact('correo2', 'tipo'));
        }else{
            $bandera = 1;
            return view('auth.RecuperarContraseña',compact('bandera'));
        }
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
