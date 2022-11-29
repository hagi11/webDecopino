<?php

namespace App\Http\Controllers\mercancia;

use App\Http\Controllers\administracion\musUsuarioController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\mercancia\categorias\MprCategoria;
use App\Models\mercancia\categorias\MprSubCategoria;
use Illuminate\Support\Facades\Auth;
// use App\Http\Requests\StoreMprSubCategoriaRequest;
// use App\Http\Requests\UpdateMprSubCategoriaRequest;
use Illuminate\Support\Facades\Validator;





class MprSubCategoriaContoller extends Controller
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
        
        $datos = MprSubCategoria::all()->where('estado',1);
        $datos2 = Mprcategoria::all()->where('estado',1);
        return view ('mercancia.subcategoria.index',compact('datos','datos2'));
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
        
        $datos = MprSubCategoria::all();
        $datos2 = Mprcategoria::all()->where('estado',1);
          return view('mercancia.subcategoria.crear',compact('datos','datos2'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMprSubCategoriaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
            $ctru = new musUsuarioController();
             if($ctru->getPermisoInv()->crear != 1){
                return redirect()->route('homeAdmin');  
             }
        
        $validator = Validator::make($request->all(),[
            'nombre' => 'required|max:50',
            'categoria' => 'required|max:50',
            'estado' => 'required|max:1'
        ]);
        if ($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        $datos = $request->all();
        MprSubCategoria::create($datos);

        return redirect()->route('subCategoria');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MprSubCategoria  $MprSubCategoria
     * @return \Illuminate\Http\Response
     */
    public function show(MprSubCategoria $MprSubCategoria)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MprSubCategoria  $MprSubCategoria
     * @return \Illuminate\Http\Response
     */
    public function edit(MprSubCategoria $subCategoria)
    {
        
            $ctru = new musUsuarioController();
             if($ctru->getPermisoInv()->editar != 1){
                return redirect()->route('homeAdmin');  
             }
        
        $datos = MprSubCategoria::all();
        $datos2 = Mprcategoria::all()->where('estado',1);
        return view('mercancia.subcategoria.editar',compact('subCategoria','datos','datos2'));
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMprSubCategoriaRequest  $request
     * @param  \App\Models\MprSubCategoria  $MprSubCategoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MprSubCategoria $subCategoria)
    {
        
            $ctru = new musUsuarioController();
             if($ctru->getPermisoInv()->editar != 1){
                return redirect()->route('homeAdmin');  
             }
        
        $validator = Validator::make($request->all(),[
            'nombre' => 'required|max:50',
            'categoria' => 'required|max:50',
             
        ]);
        if ($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        $datos = $request->all();
        $subCategoria->update($datos);

        return redirect()->route('subCategoria');
        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MprSubCategoria  $MprSubCategoria
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
            $ctru = new musUsuarioController();
             if($ctru->getPermisoInv()->eliminar != 1){
                return redirect()->route('homeAdmin');  
             }
        
        $datos = MprSubCategoria::findOrFail($id);
        $datos['estado']=0;
        $datos->save();
        return redirect()->route('subCategoria');
    }
}


