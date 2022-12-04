<?php

namespace App\Http\Controllers\mercancia;

use App\Http\Controllers\administracion\musUsuarioController;
use App\Http\Controllers\Controller;
use App\Models\mercancia\MprImagen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MprImagenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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

    public function preStore(Request $request)
    {
       
        if(Auth::guard('usuarios')->user()){
            $ctru = new musUsuarioController();
             if($ctru->getPermisoInv()->crear == 1){
                $request->validate([
                    'imagen' => 'required|image',
                ]);
                $consulta = MprImagen::select('id')
                    ->orderBy('id', 'desc')
                    ->first();
        
                $valor = $consulta->id + 1;
        
                // $ruta = public_path("img/post/");
                
                $file = $request->file('imagen');
                $nombre = $valor . $_FILES['imagen']['name'];
                $ruta = "img/" . $nombre;
                
        
                if (isset($_POST['producto'])) {
                    $ruta = "img/productos/" . $nombre;
                }
        
                if (isset($_POST['combo'])) {
                    $ruta = "img/combos/" . $nombre;
                }
        
                if (isset($_POST['articulo'])) {
                    $ruta = "img/articulos/" . $nombre;
                }
                
                
                copy($file, public_path() . "/" . $ruta);
        
                $nuevo = new MprImagen();
                $nuevo->estado = 2;
                $nuevo->ruta = $ruta;
                $nuevo->save();        
             }
        }
        return redirect()->route('homeAdmin');   
    }

    public function store(Request $request)
    {
        if(Auth::guard('usuarios')->user()){
            $ctru = new musUsuarioController();
             if($ctru->getPermisoInv()->crear != 1){
                return redirect()->route('homeAdmin');  
             }
        }

        if ($request->tipo == 'combo') {
            $comboImg = MprImagen::select('id', 'ruta')
                ->where('estado', 2)
                ->get();
            for ($i = 0; $i < count($comboImg); $i++) {
                $comboImg[$i]->combo = $request->id;
                $comboImg[$i]->estado = 1;
                $comboImg[$i]->save();
            }
        }
    }

    public function showImg()
    {
        $comboImg = MprImagen::select('id', 'ruta')
            ->where('estado', 2)
            ->get();

        return $comboImg;
    }

    public function cargarImagenes(Request $request)
    {
        if(Auth::guard('usuarios')->user()){
            $ctru = new musUsuarioController();
             if($ctru->getPermisoInv()->crear != 1){
                return redirect()->route('homeAdmin');  
             }
        }

        if ($request->tipo == "producto") {
            $comboImg = MprImagen::select('id', 'ruta')
                ->where('estado', 1)
                ->where('producto', $request->id)
                ->get();
        }

        if ($request->tipo == "articulo") {
            $comboImg = MprImagen::select('id', 'ruta')
                ->where('estado', 1)
                ->where('articulo', $request->id)
                ->get();
        }


        if ($request->tipo == "combo") {
            $comboImg = MprImagen::select('id', 'ruta')
                ->where('estado', 1)
                ->where('combo', $request->id)
                ->get();
        }

        return $comboImg;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(request $id)
    {
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
        if(Auth::guard('usuarios')->user()){
            $ctru = new musUsuarioController();
             if($ctru->getPermisoInv()->editar != 1){
                return redirect()->route('homeAdmin');  
             }
        }
        $request->validate([
            'imagen' => 'required|image',
        ]);

        $consulta = MprImagen::select('id')
            ->orderBy('id', 'desc')
            ->first();

        $valor = $consulta->id + 1;

        $ruta = public_path("img/post/");
        $file = $request->file('imagen');
        $nombre = $valor . $_FILES['imagen']['name'];
        $ruta = "img/" . $nombre;

        if ($request->tipo == "producto") {
            $ruta = "img/productos/" . $nombre;
        }

        if ($request->tipo == "combo") {
            $ruta = "img/combos/" . $nombre;
        }

        if ($request->tipo == "articulo") {
            $ruta = "img/articulos/" . $nombre;
        }

        copy($file, public_path("/").$ruta);

        $nuevo = new MprImagen();
        $nuevo->ruta = $ruta;
        if ($request->tipo == "producto") {
            $nuevo->producto = $id;
        }
        if ($request->tipo == "articulo") {
            $nuevo->articulo = $id;
        }
        if ($request->tipo == "combo") {
            $nuevo->combo = $id;
        }
        $nuevo->estado = 1;
        $nuevo->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $imagen = MprImagen::findOrFail($id);
        $imagen->estado = "0";
        $imagen->save();
        $ruta = public_path() . '/' . $imagen->ruta;
        if (file_exists($ruta)) {
            unlink($ruta);
        }
    }
}
