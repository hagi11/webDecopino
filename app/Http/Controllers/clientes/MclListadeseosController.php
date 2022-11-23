<?php

namespace App\Http\Controllers\clientes;

use App\Http\Controllers\Controller;
use App\Models\clientes\mclListaDeseos;
use App\Models\mercancia\MprProducto;
use App\Models\mercancia\MprArticulo;
use App\Models\mercancia\mprcombo;
use App\Models\mercancia\MprImagen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MclListadeseosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listadeseo =mclListaDeseos::where('estado',1) 
        ->get();
       
        return view('listadedeseo.listadd',compact('listadeseo'));
    }

    public function indexCliente($id)
    {
        if (Auth::user()) {

        $listadeseo =mclListaDeseos::where('estado',1)
        ->where('cliente',$id) 
        ->get();
        
        $mercancias = [];

        foreach ($listadeseo as $lista) {
            if ($lista->combo != null) {
                $combo = MprCombo::all()->where('id', $lista->combo)->first();

                $imagen = MprImagen::select('id', 'ruta', 'combo')
                    ->where('combo', $combo->id)
                    ->where('estado', 1)
                    ->first();

                $mercancias[$lista->id] = ['tipo' => 'combo', 'id' => $combo->id, 'nombre' => $combo->nombre, 'precio' => $combo->total, 'ruta' => $imagen->ruta];
            } elseif ($lista->producto != null) {
                $producto = MprProducto::all()->where('id', $lista->producto)->first();
                $imagen = MprImagen::select('id', 'ruta', 'producto')
                    ->where('producto', $producto->id)
                    ->where('estado', 1)
                    ->first();
                $precio = $producto->precio - ($producto->precio* $producto->descuento/100);
                $mercancias[$lista->id] = ['tipo' => 'producto', 'id' => $producto->id, 'nombre' => $producto->nombre, 'precio' => $precio, 'ruta' => $imagen->ruta];

            } else {
                $articulo = MprArticulo::all()->where('id', $lista->articulo)->first();
                $imagen = MprImagen::select('id', 'ruta', 'articulo')
                    ->where('articulo', $articulo->id)
                    ->where('estado', 1)
                    ->first();

                $mercancias[$lista->id] = ['tipo' => 'articulo', 'id' => $articulo->id, 'nombre' => $articulo->nombre, 'precio' => $articulo->precio, 'ruta' => $imagen->ruta];
            }
        }
        


        return view('listadedeseo.listadd',compact('listadeseo','mercancias'));
    }
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

        if (isset($request['producto'])) {

            $idcliente = null;
            if(Auth::guard('usuarios')->user()){
                $idcliente = Auth::guard('usuarios')->user()->id;
            }elseif(Auth::user()){
                $idcliente = Auth::user()->id;
            }
            $confirsi =mclListaDeseos::all()
            ->where('estado',1)
            ->where('producto',$request->producto) 
            ->count();
            
            if($confirsi == 0 ){
                mclListaDeseos::create ([
                    'cliente' => $idcliente,
                    'estado' => "1",
                    'producto' => $request -> producto 
                ]);
            }
          
        }
        
        elseif(isset($request['combo'])){
            
            $idcliente = null;
            if(Auth::guard('usuarios')->user()){
                $idcliente = Auth::guard('usuarios')->user()->id;
            }elseif(Auth::user()){
                $idcliente = Auth::user()->id;
            }
            $confirsi =mclListaDeseos::all()
            ->where('estado',1)
            ->where('combo',$request->combo) 
            ->count();
            
            if($confirsi == 0 ){
                mclListaDeseos::create ([
                    'cliente' => $idcliente,
                    'estado' => "1",
                    'combo' => $request -> combo 
                ]);

            }
       

        }
        elseif(isset($request['articulo'])){
            
            $idcliente = null;
            if(Auth::guard('usuarios')->user()){
                $idcliente = Auth::guard('usuarios')->user()->id;
            }elseif(Auth::user()){
                $idcliente = Auth::user()->id;
            }
            $confirsi =mclListaDeseos::all()
            ->where('estado',1)
            ->where('articulo',$request->articulo) 
            ->count();
            
            if($confirsi == 0 ){
                mclListaDeseos::create ([
                    'cliente' => $idcliente,
                    'estado' => "1",
                    'articulo' => $request -> articulo 
                ]);
            }
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $listadeseo = mclListaDeseos::all();

        $combo = mprcombo::where('nombre',$id)
        ->where('estado',1)
        ->get();

        return view('listadedeseo.listadd', compact('combo','listadeseo'));
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
        $lista = MclListadeseos::findOrFail($id);
        $lista->estado = 0;
        $lista->save();
        return back();

    }
}
