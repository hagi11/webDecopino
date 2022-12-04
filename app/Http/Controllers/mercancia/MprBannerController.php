<?php


namespace App\Http\Controllers\mercancia;

use App\Models\mercancia\MprBanner;
use App\Models\mercancia\productos\MprProducto;
use App\Models\mercancia\MprImagen;
use App\Models\mercancia\MprCombo;
use App\Http\Requests\StoreMprbannerRequest;
use App\Http\Requests\UpdateMprbannerRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MprFechaUpdateContoller;
use Illuminate\Http\Request;

class MprBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $banners  = MprBanner::select('mprbanners.id', 'mprbanners.nombre', 'mprbanners.descripcion', 'mprbanners.producto', 'mprbanners.combo', 'mprimagen.ruta', 'mprbanners.fregistro', 'mprbanners.estado', 'mprbanners.factualizado')
            ->join('mprimagen', 'mprimagen.banner', 'mprbanners.id')
            ->get();


           
        foreach ($banners as $banner) {
            if($banner->producto != null){
                $productos = MprProducto::select('id', 'nombre')
                ->where('estado', 1)
                 ->where('id',$banner->producto)
                ->get();
                $lista[] = ["id"=>$banner->id,"tipo"=>"producto","nombre"=>$productos[0]->nombre];
            }

            if($banner->combo != null){
                $combos = MprCombo::select('id', 'nombre')
                ->where('estado', 1)
                ->where('id',$banner->combo)
                ->get();
              
                $lista[] = ["id"=>$banner->id,"tipo"=>"combo","nombre"=>$combos[0]->nombre];
            }
            }



        return view('mercancia.mprbanners.index', compact('banners', 'lista'));
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

        $banners  = MprBanner::select('mprbanners.id', 'mprbanners.nombre', 'mprbanners.descripcion', 'mprbanners.producto', 'mprbanners.combo', 'mprimagen.ruta', 'mprbanners.fregistro', 'mprbanners.estado', 'mprbanners.factualizado')
            ->join('mprimagen', 'mprimagen.banner', 'mprbanners.id')
            ->where('mprbanners.id', $id)
            ->get();

        $banner = $banners[0];
        $elegido = ['tipo' => 'none', 'id' => 0];
        if ($banner->producto != 0) {
            $elegido = ['tipo' => 'producto', 'id' => $banner->producto];
        }
        if ($banner->combo != 0) {
            $elegido = ['tipo' => 'combo', 'id' => $banner->combo];
        }

        $productos = MprProducto::select('id', 'nombre')
            ->where('estado', 1)
            ->get();
        $combos = MprCombo::select('id', 'nombre')
            ->where('estado', 1)
            ->get();

        foreach ($productos as $producto) {
            $mercancias[] = array("nombre" => $producto->nombre, "tipo" => "producto", "id" => $producto->id);
        }
        foreach ($combos as $combo) {
            $mercancias[] = array("nombre" => $combo->nombre, "tipo" => "combo", "id" => $combo->id);
        }

        return view('mercancia/mprbanners.edit', compact('banner', 'mercancias', 'elegido'));
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
        
        $fechaActulizacion = new MprFechaUpdateContoller();


        $banner = MprBanner::FindOrFail($id);
        $banner->nombre = $request->nombre;
        $banner->descripcion = $request->descripcion;
        $banner->factualizado = $fechaActulizacion->fecha();

        if (substr($request->mercancia, 0, 5) == "produ") {
            $banner->producto = substr($request->mercancia, 8);
            $banner->combo = null;
        } elseif(substr($request->mercancia, 0, 5) == "combo") {
            $banner->producto = null;
            $banner->combo = $banner->combo = substr($request->mercancia, 5);
           
        }else{
            $banner->producto = null;
            $banner->combo = null;
        }

        $banner->save();

        if (isset($request->imagen)) {

            $validator = Validator::make($request->all(), [
                'imagen' => 'required|image|dimensions:min_width=500,min_height=100',
                ],
                
                [
                    'imagen.dimensions' => 'Las dimensiones de la imagen no son validas',
                    'imagen.image' => 'El archivo no es tipo imagen'
                ]);
        
                if($validator -> fails()){
                    return redirect()->back()->withErrors($validator)->withInput();
                }
                $file = $request->file('imagen');
                $imagensize = getimagesize($file);
                $ancho = $imagensize[0];
                $largo = $imagensize[1];
                $ratio = $ancho/$largo;

                
                if($ratio < 1.5){
                    $error="Las dimensiones de la imagen no son validas";
                    return redirect()->back()->withErrors($error)->withInput();
                }



            $file = $request->file('imagen');
            $nombre = $id . $_FILES['imagen']['name'];
            $ruta = "img/banners/" . $nombre;
            copy($file, $ruta);
            $imagen = MprImagen::select('mprimagen.id', 'mprimagen.ruta')
                ->join('mprbanners', 'mprimagen.banner', 'mprbanners.id')
                ->where('mprbanners.id', $id)
                ->get();

            $quitarImagen = public_path() . '/' . $imagen[0]->ruta;
            if (file_exists($quitarImagen)) {
                unlink($quitarImagen);
            } 
            $imagen[0]->ruta = $ruta;
            $imagen[0]->save();
        }


        return redirect('mprbanners');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $numero = MprBanner::all()->where('estado', 1)->count();

        $banner = MprBanner::FindOrFail($id);
        if ($banner->estado == 1) {
            if ($numero > 2) {
                $banner->estado = "0";
            }
        } else {
            $banner->estado = "1";
        }
        $banner->save();

        return redirect()->back();
    }
}
