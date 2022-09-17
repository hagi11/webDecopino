<?php

namespace App\Http\Controllers\mercancia;

use App\Http\Controllers\Controller;
use App\Models\mercancia\MprComProducto;
use App\Models\mercancia\MprCombo;
use App\Models\mercancia\MprArticulo;
use App\Models\mercancia\MprProducto;
use Illuminate\Http\Request;

class mprcombosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $combos=MprCombo::where('estado',1)->get();
        return view('mercancia.combos.AdminCombos',compact('combos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productos = MprProducto::select('id','nombre','detalle','precio')
        ->where('estado',1)->get();
        $articulos = MprArticulo::select('id','nombre','descripcion','precio')
        ->where('estado',1)->get();

        return view('mercancia.combos.AgregarCombo',compact('productos','articulos'));
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
        $combo = MprCombo::findOrFail($id);
        $prosEnCombo = MprComProducto::select('mprcomproductos.id as idcombo','mprproductos.id as idproduct','valor','cantidad','nombre','detalle','precio')
        ->join('mprproductos','mprproductos.id',"=","mprcomproductos.producto")
        ->where('combo',$id)
        ->where('mprcomproductos.estado','1')
        ->where('mprcomproductos.producto','!=','')->get();
        $artsEnCombo = MprComProducto::select('mprcomproductos.id as idcombo','mprarticulos.id as idarticulo','valor','cantidad','nombre','descripcion','precio')
        ->join('mprarticulos','mprarticulos.id',"=","mprcomproductos.articulo")
        ->where('combo',$id)
        ->where('mprcomproductos.estado','1')
        ->where('mprcomproductos.articulo','!=','')->get();

        $productos = MprProducto::select('id','nombre','detalle','precio')
        ->where('estado',1)->get();
        $articulos = MprArticulo::select('id','nombre','descripcion','precio')
        ->where('estado',1)->get();

        return view('mercancia.combos.EditarCombo',compact('productos','articulos','combo','prosEnCombo','artsEnCombo'));

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
        $combo = MprCombo::find($id);
        $combo->estado=0;
        $combo->update();
        return redirect(route('combo.index'));
    }

}
