<?php

namespace App\Http\Controllers\mercancia;

use App\Http\Controllers\administracion\musUsuarioController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MprFechaUpdateContoller;
use App\Models\mercancia\categorias\MprCategoria;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MprCategoriaController extends Controller
{
    public function index()
    {

        if (Auth::guard('usuarios')->user()) {
            $ctru = new musUsuarioController();
            if ($ctru->getPermisoInv()->leer == 1) {
                $datos = Mprcategoria::all()->where('estado', 1);
                return view('mercancia.categoria.index', compact('datos'));
            }
        }
        return redirect()->route('homeAdmin');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        if(Auth::guard('usuarios')->user()){
            $ctru = new musUsuarioController();
             if($ctru->getPermisoInv()->crear == 1){
            
             return view('mercancia.categoria.crear');
             }
        }
        return redirect()->route('homeAdmin');   
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMprcategoriaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        if(Auth::guard('usuarios')->user()){
            $ctru = new musUsuarioController();
             if($ctru->getPermisoInv()->crear == 1){
                $validator = Validator::make($request->all(), [
                    'nombre' => 'required|max:50',
                    'estado' => 'required|max:1'
                ]);
                if ($validator->fails()) {
                    return back()->withErrors($validator)->withInput();
                }
                $datos = $request->all();
                Mprcategoria::create($datos);
        
                return redirect('categoria');
                        

             }
        }
        return redirect()->route('homeAdmin');   
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mprcategoria  $mprcategoria
     * @return \Illuminate\Http\Response
     */
    public function show(Mprcategoria $mprcategoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mprcategoria  $mprcategoria
     * @return \Illuminate\Http\Response
     */
    public function edit(Mprcategoria $categorium)
    {
        
        if(Auth::guard('usuarios')->user()){
            $ctru = new musUsuarioController();
             if($ctru->getPermisoInv()->editar == 1){
                 $datos = Mprcategoria::all();
                 return view('mercancia.categoria.editar', compact('categorium', 'datos'));
             }
        }
        return redirect()->route('homeAdmin');   
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMprcategoriaRequest  $request
     * @param  \App\Models\Mprcategoria  $mprcategoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mprcategoria $categorium)
    {
        
        if(Auth::guard('usuarios')->user()){
            $ctru = new musUsuarioController();
             if($ctru->getPermisoInv()->editar == 1){
                 
                     $validator = Validator::make($request->all(), [
                         'nombre' => 'required|max:50',
                         'estado' => 'required|max:1'
                     ]);
                     if ($validator->fails()) {
                         return back()->withErrors($validator)->withInput();
                     }
                     $fechaActulizacion = new MprFechaUpdateContoller();
             
                     $categorium->nombre = $request->nombre;
                     $categorium->factualizado = $fechaActulizacion->fecha();
                     $categorium->save();
             
             
                     return redirect('categoria');
             }
        }
        return redirect()->route('homeAdmin');   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mprcategoria  $mprcategoria
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        if(Auth::guard('usuarios')->user()){
            $ctru = new musUsuarioController();
             if($ctru->getPermisoInv()->eliminar == 1){
                $datos = MprCategoria::findOrFail($id);
                $fechaActulizacion = new MprFechaUpdateContoller();
        
                $datos['factualizado'] = $fechaActulizacion->fecha();
                $datos['estado'] = 0;
                $datos->save();
                return redirect('categoria');
        

             }
        }
        return redirect()->route('homeAdmin');   
    
    }
}
