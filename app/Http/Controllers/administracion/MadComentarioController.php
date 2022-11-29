<?php

namespace App\Http\Controllers\administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\mercancia\productos\MprProducto;
use App\Models\mercancia\mprcombo;
use App\Models\administracion\MadComentario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MadComentarioController extends Controller
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

            $validator = Validator::make($request->all(), [
            'comentario' => 'required|max:500',
            ],[
                'comentario.max' => 'El maximo permitido de caracteres es 500.',
                'comentario.required' => 'Por favor escriba su comentario.'
            ]);
    
            if($validator -> fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }


        if (isset($request['producto'])) {
            MadComentario::create([
                'comentario' => $request->comentario,
                'clientes' => $request->cliente,
                'estado' => "1",
                'producto' => $request->producto
            ]);
            return redirect(route('productos.show', $request->producto));
        } elseif (isset($request['combo'])) {

            MadComentario::create([
                'comentario' => $request->comentario,
                'clientes' => $request->cliente,
                'estado' => "1",
                'combo' => $request->combo

            ]);
            return redirect(route('combo.show', $request->combo));
        } elseif (isset($request['articulo'])) {

            MadComentario::create([
                'comentario' => $request->comentario,
                'clientes' => $request->cliente,
                'estado' => "1",
                'articulo' => $request->articulo
            ]);
            return redirect(route('mprarticulos.show', $request->articulo));
            //$comentariosesion = auth()->id;

            //
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
        $comentario = MadComentario::findOrFail($id);
        $comentario->estado = 0;
        $comentario->save();

        return back();
    }
}
