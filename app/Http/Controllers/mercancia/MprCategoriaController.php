<?php

namespace App\Http\Controllers\mercancia;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MprFechaUpdateContoller;
use App\Models\mercancia\categorias\MprCategoria;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class MprCategoriaController extends Controller
{
    public function index()
    {
        $datos = Mprcategoria::all()->where('estado',1);
        return view('mercancia.categoria.index',compact('datos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mercancia.categoria.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMprcategoriaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nombre' => 'required|max:50',
            'estado' => 'required|max:1'
        ]);
        if ($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        $datos = $request->all();
        Mprcategoria::create($datos);

        return redirect('categoria');

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
        $datos = Mprcategoria::all();
        return view('mercancia.categoria.editar',compact('categorium','datos'));
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
        $validator = Validator::make($request->all(),[
            'nombre' => 'required|max:50',
            'estado' => 'required|max:1'
        ]);
        if ($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        $fechaActulizacion = new MprFechaUpdateContoller();
        
        $categorium->nombre = $request->nombre;
        $categorium->factualizado = $fechaActulizacion->fecha();
        $categorium->save();
        

        return redirect('categoria');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mprcategoria  $mprcategoria
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $datos = MprCategoria::findOrFail($id);
        $fechaActulizacion = new MprFechaUpdateContoller();

        $datos['factualizado'] = $fechaActulizacion->fecha();
        $datos['estado']=0;
        $datos->save();
        return redirect('categoria');
       
    }
}
