<?php

namespace App\Http\Controllers\mercancia;

use App\Http\Controllers\administracion\musUsuarioController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\mercancia\MprtpArticulo;
use Illuminate\Support\Facades\Auth;

class MprtpArticuloController extends Controller
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
        
        // $articulos = MprArticulo::all();
        $tparticulos = MprtpArticulo::where('estado',1)->get();
        return view('mercancia.mprtparticulos.index',compact('tparticulos'));
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
        
        return view ('mercancia.mprtparticulos.crear');
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
        
        MprtpArticulo::create ([
            'nombre' => $request -> nombre,
            'estado' => "1"
        ]);
        return redirect() ->route ('mprtparticulos.index');
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
        
        $tparticulos = MprtpArticulo::findOrFail($id);
        return view ('mercancia.mprtparticulos.editar',compact('tparticulos'));
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
        $tparticulos = MprtpArticulo::findOrFail($id);
        $tparticulos->update($datos);
        return redirect('mprtparticulos');
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
        
        $datos = MprtpArticulo::findOrFail($id);
        $datos['estado']=0;
        $datos->save();
        return redirect('mprarticulos');
    }
}
