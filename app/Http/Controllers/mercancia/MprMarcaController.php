<?php

namespace App\Http\Controllers\mercancia;

use App\Http\Controllers\administracion\musUsuarioController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\mercancia\MprMarca;
use Illuminate\Support\Facades\Auth;

class MprMarcaController extends Controller
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
        $marcas = MprMarca::where('estado',1)->get();
        return view('mercancia.mprmarcas.index',compact('marcas'));
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
        
        return view ('mercancia.mprmarcas.crear');
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
        
        MprMarca::create ([
            'nombre' => $request -> nombre,
            'estado' => "1"
        ]);
        return redirect() ->route ('mprmarcas.index');
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
        
        $marcas = MprMarca::findOrFail($id);
        return view ('mercancia.mprmarcas.editar',compact('marcas'));
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
        $marcas = MprMarca::findOrFail($id);
        $marcas->update($datos);
        return redirect('mprmarcas');
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
        
        $datos = MprMarca::findOrFail($id);
        $datos['estado']=0;
        $datos->save();
        return redirect('mprarticulos');
    }
}
