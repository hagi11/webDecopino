<?php

namespace App\Http\Controllers\mercancia;

use App\Http\Controllers\Controller;
use App\Models\mercancia\categorias\MprCategoria;
use App\Models\mercancia\categorias\MprSubCategoria;
use App\Models\mercancia\MprArticulo;
use App\Models\mercancia\MprCombo;
use App\Models\mercancia\MprComProducto;
use App\Models\mercancia\MprImagen;
use App\Models\mercancia\MprLinea;
use App\Models\mercancia\productos\MprProducto;
use Illuminate\Http\Request;

class MprTiendaController extends Controller
{
    public $parametroOrden;
    public $precioMin = 0;
    public $precioMax = 10000000000;
    public $filtroTexto;
    public $showCom = 0;
    public $showPro = 0;
    public $showArt = 0;
    public $lineaSelect = 0;
    public $cateSelect = 0;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        if($this->lineaSelect != 0){
            $this->showPro = 1;
        }

        if($this->cateSelect != 0){
            $this->showPro = 1;
        }



        $mostrar = 0;
        $contCom = MprCombo::where('estado', 1)->count();
        $contPro = MprProducto::where('estado', 1)->count();
        $contArt = MprArticulo::where('estado', 1)->count();


        if ($this->showPro == 0 && $this->showArt == 0 && $this->showCom == 0) {
            $mostrar = 1;
        }

        if (($this->showCom == 1 || $mostrar == 1) ) {
            $combos = MprCombo::where('estado', 1)
                ->where('nombre', 'like', '%' . $this->filtroTexto . '%')
                ->where('total', '>', $this->precioMin)
                ->where('total', '<', $this->precioMax)
                ->get();
        }

        if (($this->showPro == 1 || $mostrar == 1))  {
            if($this->lineaSelect != 0){
                $productos = MprProducto::Where('nombre', 'like', '%' . $this->filtroTexto . '%')
                ->where('precio', '>=', $this->precioMin)
                ->where('precio', '<=', $this->precioMax)
                ->where('linea', $this->lineaSelect)
                ->where('estado', 1)
                ->get();
            }elseif($this->cateSelect != 0){
                $productos = MprProducto::Where('nombre', 'like', '%' . $this->filtroTexto . '%')
                ->where('precio', '>=', $this->precioMin)
                ->where('precio', '<=', $this->precioMax)
                ->where('categoria', $this->cateSelect)
                ->where('estado', 1)
                ->get();
            }else{
                $productos = MprProducto::Where('nombre', 'like', '%' . $this->filtroTexto . '%')
                ->where('precio', '>=', $this->precioMin)
                ->where('precio', '<=', $this->precioMax)
                ->where('estado', 1)
                ->get();

               
            }
            
        }

        if ($this->showArt == 1 || $mostrar == 1) {
            $articulos = MprArticulo::where('estado', 1)
                ->where('nombre', 'like', '%' . $this->filtroTexto . '%')
                ->where('precio', '>=', $this->precioMin)
                ->where('precio', '<=', $this->precioMax)
                ->get();
        }

        $nombre = "";

        $mercancias = [];
        $i = 0;

        if ($this->showArt == 1 || $mostrar == 1) {
            foreach ($articulos as $articulo) {
                $mercancias[$i]['id'] = $articulo->id;
                $mercancias[$i]['nombre'] = $articulo->nombre;
                $mercancias[$i]['tipo'] = "articulo";
                $mercancias[$i]['precio'] = $articulo->precio;
                $mercancias[$i]['descuento'] = 0;
                $mercancias[$i]['descripcion'] = $articulo->descripcion;
                $mercancias[$i]['vistas'] = $articulo->vista;
                $mercancias[$i]['compras'] = $articulo->compra;
                $mercancias[$i]['fecha'] = $articulo->fregistro;

                $mercancias[$i]['imagen'] = MprImagen::select('ruta')
                    ->where('articulo', $articulo->id)
                    ->where('estado', 1)
                    ->first()->ruta;
                $i = $i + 1;
            }
        }
        if ($this->showPro == 1 || $mostrar == 1) {
            foreach ($productos as $producto) {

                $mercancias[$i]['id'] = $producto->id;
                $mercancias[$i]['nombre'] = $producto->nombre;
                $mercancias[$i]['tipo'] = "producto";
                $mercancias[$i]['precio'] = $producto->precio;
                $mercancias[$i]['descuento'] = $producto->descuento;
                $mercancias[$i]['descripcion'] = $producto->detalle;
                $mercancias[$i]['vistas'] = $producto->vista;
                $mercancias[$i]['compras'] = $producto->compra;
                $mercancias[$i]['fecha'] = $producto->fregistro;


                $mercancias[$i]['imagen'] = MprImagen::select('ruta')
                    ->where('producto', $producto->id)
                    ->where('estado', 1)
                    ->first()->ruta;
                $i = $i + 1;
            }
        }
        if ($this->showCom == 1 || $mostrar == 1) {
            foreach ($combos as $combo) {
                $mercancias[$i]['id'] = $combo->id;
                $mercancias[$i]['nombre'] = $combo->nombre;
                $mercancias[$i]['tipo'] = "combo";
                $mercancias[$i]['precio'] = $combo->total + ($combo->total * ($combo->descuento / 100));
                $mercancias[$i]['descuento'] = $combo->descuento;
                $mercancias[$i]['vistas'] = $combo->vistas;
                $mercancias[$i]['compras'] = $combo->compras;
                $mercancias[$i]['fecha'] = $combo->fregistro;


                $mercancias[$i]['imagen'] = MprImagen::select('ruta')
                    ->where('combo', $combo->id)
                    ->where('estado', 1)
                    ->first()->ruta;

                $comArts = MprComProducto::select('nombre', 'cantidad')->where('combo', $combo->id)
                    ->join('mprarticulos', 'mprarticulos.id', 'mprcomproductos.articulo')
                    ->where('mprcomproductos.estado', 1)
                    ->get();

                foreach ($comArts as $comArt) {
                    $nombre = $comArt->cantidad . " " . $comArt->nombre . ", " . $nombre;
                }

                $comPros = MprComProducto::select('nombre', 'cantidad')->where('combo', $combo->id)
                    ->join('mprproductos', 'mprproductos.id', 'mprcomproductos.producto')
                    ->where('mprcomproductos.estado', 1)
                    ->get();

                foreach ($comPros as $comPro) {
                    $nombre = $comPro->cantidad . " " . $comPro->nombre . ", " . $nombre;
                }

                $nombre = substr($nombre, 0, -2);
                $mercancias[$i]['descripcion'] = $nombre;
                $nombre = "";
                $i = $i + 1;
            }
        }
        $lineas= MprLinea::select('nombre','id')->where('estado',1)->get();
        $numLinea=[];
        foreach($lineas as $linea){
            $numLinea[$linea->id] = MprProducto::where('linea', $linea->id)
                ->where('estado', 1)
                ->count();
        }
        $lineaSel = $this->lineaSelect;

        $categorias = MprCategoria::select('id','nombre')->where('estado',1)->get();
        foreach($categorias as $categoria){
            $subCategorias[$categoria->id] = MprSubCategoria::select('id','nombre')->where('estado',1)->where('categoria',$categoria->id)->get();
            foreach( $subCategorias[$categoria->id] as $subCategoria ){
                $contSubCate[$subCategoria->id] =  MprProducto::where('categoria', $subCategoria->id)
                ->where('estado', 1)
                ->count();
            }
        }

        
        $cateSel = $this->cateSelect;

       

        $contCategoria = MprSubCategoria::select('nombre','id')->where('estado',1)->count();
        $categoria= MprSubCategoria::select('nombre','id')->where('estado',1)->get();

        $parametro = $this->getOrden();
        $texto = $this->filtroTexto;
        $mercancias = $this->ordenar($mercancias, $parametro);
        $checkPro = $this->showPro;
        $checkCom = $this->showCom;
        $checkArt = $this->showArt;

        return view('mercancia.tienda', 
        compact('mercancias', 'parametro', 'texto', 'checkPro', 'checkArt', 'checkCom', 'contCom', 'contArt', 'contPro', 'lineas','lineaSel','numLinea','subCategorias','categorias','cateSel','contSubCate'));
    }

    public function ordenar($arreglo, $parametro)
    {

        $longitud = count($arreglo);
        for ($i = 0; $i < $longitud; $i++) {
            for ($j = 0; $j < $longitud - 1; $j++) {
                if ($parametro == 1 || $parametro == null) {
                    if ($arreglo[$j]['fecha'] > $arreglo[$j + 1]['fecha']) {
                        $temporal = $arreglo[$j];
                        $arreglo[$j] = $arreglo[$j + 1];
                        $arreglo[$j + 1] = $temporal;
                    }
                }
                if ($parametro == 2) {
                    if ($arreglo[$j]['fecha'] < $arreglo[$j + 1]['fecha']) {
                        $temporal = $arreglo[$j];
                        $arreglo[$j] = $arreglo[$j + 1];
                        $arreglo[$j + 1] = $temporal;
                    }
                }
                if ($parametro == 3) {
                    if ($arreglo[$j]['vistas'] < $arreglo[$j + 1]['vistas']) {
                        $temporal = $arreglo[$j];
                        $arreglo[$j] = $arreglo[$j + 1];
                        $arreglo[$j + 1] = $temporal;
                    }
                }
                if ($parametro == 4) {
                    if ($arreglo[$j]['precio'] < $arreglo[$j + 1]['precio']) {
                        $temporal = $arreglo[$j];
                        $arreglo[$j] = $arreglo[$j + 1];
                        $arreglo[$j + 1] = $temporal;
                    }
                }
                if ($parametro == 5) {
                    if ($arreglo[$j]['precio'] > $arreglo[$j + 1]['precio']) {
                        $temporal = $arreglo[$j];
                        $arreglo[$j] = $arreglo[$j + 1];
                        $arreglo[$j + 1] = $temporal;
                    }
                }
                if ($parametro == 6) {
                    if ($arreglo[$j]['compras'] < $arreglo[$j + 1]['compras']) {
                        $temporal = $arreglo[$j];
                        $arreglo[$j] = $arreglo[$j + 1];
                        $arreglo[$j + 1] = $temporal;
                    }
                }
            }
        }
        return $arreglo;
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
        if($request->tipo == 1){
            $this->showPro = 1;
            $this->showArt = 0;
            $this->showCom = 0;

        }elseif($request->tipo == 2){
            $this->showPro = 0;
            $this->showArt = 1;
            $this->showCom = 0;

        }elseif($request->tipo == 3){
            $this->showPro = 0;
            $this->showArt = 0;
            $this->showCom = 1;

        }else{
            $this->showPro = 0;
            $this->showArt = 0;
            $this->showCom = 0;
        }

        if($request->linea != 0){
            $this->lineaSelect = $request->linea;
        }
        if($request->cate != 0){
            $this->cateSelect = $request->cate;
        }

        if ($request->precioMin > 0) {
            $this->precioMin = $request->precioMin;
        }

        if ($request->precioMax > 0) {
            $this->precioMax = $request->precioMax;
        }
        $this->filtroTexto = $request->texto;
        $this->setOrden($request->orden);

        return $this->index();
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function getOrden()
    {
        return $this->parametroOrden;
    }
    public function setOrden($orden)
    {
        $this->parametroOrden = $orden;
    }
}
