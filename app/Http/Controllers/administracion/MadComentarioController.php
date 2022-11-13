<?php

namespace App\Http\Controllers\administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\mercancia\productos\MprProducto;
use App\Models\mercancia\mprcombo;
use App\Models\administracion\MadComentario;

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

     
        if (isset($request['producto'])) {
       
            $producto = MprProducto::findOrFail($request->id);

            
            MadComentario::create([
                'comentario' => $request->comentario,
                'clientes' => "1",
                'estado' => "1",
                'producto' => $producto
            ]);
            return redirect()->route('mercancia.productos.index');
        }
        elseif(isset($request['combo'])){
        
        MadComentario::create ([
            'comentario' => $request -> comentario,
            'clientes' => "1",
            'estado' => "1",
            'combo' => $request -> combo 
     
        ]);
        return redirect(route('combo.show',$request->combo));
        }
        elseif(isset($request['articulo'])){
            
        MadComentario::create ([
            'comentario' => $request -> comentario,
            'cliente' => $request -> cliente,
            'estado' => "1"
        ]);
        return redirect() ->route ('mercancia.mprarticulos.index');
        //$comentariosesion = auth()->id;
        };
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
    }
}
