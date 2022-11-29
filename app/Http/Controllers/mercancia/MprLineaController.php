<?php

namespace App\Http\Controllers\mercancia;

use App\Http\Controllers\administracion\musUsuarioController;
use App\Http\Controllers\Controller;
use App\Models\mercancia\MprLinea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MprLineaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
            $ctru = new musUsuarioController();
             if($ctru->getPermisoInv()->leer != 1){
                return redirect()->route('homeAdmin');  
             }
        
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
        
            $ctru = new musUsuarioController();
             if($ctru->getPermisoInv()->crear != 1){
                return redirect()->route('homeAdmin');  
             }
        
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
        
            $ctru = new musUsuarioController();
             if($ctru->getPermisoInv()->crear != 1){
                return redirect()->route('homeAdmin');  
             }
        
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
        
            $ctru = new musUsuarioController();
             if($ctru->getPermisoInv()->editar != 1){
                return redirect()->route('homeAdmin');  
             }
        
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
        
            $ctru = new musUsuarioController();
             if($ctru->getPermisoInv()->editar != 1){
                return redirect()->route('homeAdmin');  
             }
        
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
            $ctru = new musUsuarioController();
             if($ctru->getPermisoInv()->eliminar != 1){
                return redirect()->route('homeAdmin');  
             }
        $linea = MprLinea::findOrFail($id);
        $linea->estado = "0";
        $linea->save();
        return redirect('lineaproducto');
    }
}
