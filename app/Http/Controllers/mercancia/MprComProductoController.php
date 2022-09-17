<?php

namespace App\Http\Controllers\mercancia;

use App\Http\Controllers\Controller;
use App\Models\mercancia\MprComProducto;
use App\Models\mercancia\MprCombo;
use App\Models\mercancia\MprArticulo;
use App\Models\mercancia\MprProducto;
use Illuminate\Http\Request;

class MprComProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $combo = MprCombo::find($id);
        $combo->vistas = $combo['vistas'] + 1;
        $combo->update();
        $comPros = MprComProducto::where('combo', $id)->get();
        // $comPros->vistas=$comPros['vistas']+1;

        return view('mercancia.combos.verCombo', compact('comPros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productos = MprProducto::select('id', 'nombre', 'detalle', 'precio')
            ->where('estado', 1)->get();
        $articulos = MprArticulo::select('id', 'nombre', 'descripcion', 'precio')
            ->where('estado', 1)->get();

        return view('mercancia.combos.AgregarCombo', compact('productos', 'articulos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function crearCombo(Request $request)
    {
        $crearCombo = new MprCombo();
        $crearCombo->nombre = $request['nombre'];
        $crearCombo->total = $request['valor'];
        $crearCombo->descuento = $request['descuento'];
        $crearCombo->estado = 1;
        $crearCombo->save();
        

        for ($i = 0; $i <= count($request['datos']) - 1; $i++) {
            if ($request['datos'][$i]['cantidad'] > 0) {
                $comProductos = new MprComProducto();
                $comProductos->valor = $request['datos'][$i]['mercancia']['precio'];
                $comProductos->cantidad = $request['datos'][$i]['cantidad'];
                $comProductos->combo = $crearCombo->id;
                if ($request['datos'][$i]['tipo'] == 'producto') {
                    $comProductos->producto = $request['datos'][$i]['mercancia']['id'];
                } else {
                    $comProductos->articulo = $request['datos'][$i]['mercancia']['id'];
                }
                $comProductos->estado = 1;
                $comProductos->save();
            }
        }
    }

    public function editarCombo(Request $request)
    {
        $combo = MprCombo::find($request->id);
        $combo->nombre = $request->nombre;
        $combo->total = $request->valor;
        $combo->descuento = $request->descuento;
        $combo->update();

        date_default_timezone_set('America/Bogota');
        $fechaActulizacion = date('Y-m-d h:i:s a', time());

        $comProductos = MprComProducto::where('combo', $combo->id)
            ->where('estado', 1)->get();

        for ($j = 0; $j <= count($request['datos']) - 1; $j++) {

            if ($request['datos'][$j]['tipo'] == 'producto') {
                $agregarElemento = 1;
                $elementoNuevo = $request['datos'][$j];
                for ($i = 0; $i < count($comProductos); $i++) {
                    if ($comProductos[$i]['producto'] != '') {
                        if ($comProductos[$i]['producto'] == $request['datos'][$j]['mercancia']['id']) {
                            $agregarElemento = 0;
                            if ($request['datos'][$j]['cantidad'] > 0) {

                                $comProductos[$i]->valor = $request['datos'][$j]['mercancia']['precio'];
                                $comProductos[$i]->cantidad = $request['datos'][$j]['cantidad'];
                                $comProductos[$i]->estado = 1;
                                $comProductos[$i]->factualizado = $fechaActulizacion;
                                $comProductos[$i]->update();
                            } else {
                                $comProductos[$i]->estado = 0;
                                $comProductos[$i]->factualizado = $fechaActulizacion;
                                $comProductos[$i]->update();
                            }
                        }
                    }
                }
                if ($agregarElemento == 1) {
                    $nuevo = new MprComProducto();
                    $nuevo->valor = $elementoNuevo['mercancia']['precio'];
                    $nuevo->cantidad = $elementoNuevo['cantidad'];
                    $nuevo->combo = $combo->id;
                    $nuevo->producto = $elementoNuevo['mercancia']['id'];
                    $nuevo->estado = 1;
                    $nuevo->save();
                }
            } else {
                $agregarElemento = 1;
                $elementoNuevo = $request['datos'][$j];
                for ($i = 0; $i < count($comProductos); $i++) {
                    if ($comProductos[$i]['articulo'] != '') {
                        if ($comProductos[$i]['articulo'] == $request['datos'][$j]['mercancia']['id']) {
                            $agregarElemento = 0;
                            if ($request['datos'][$j]['cantidad'] > 0) {

                                $comProductos[$i]->valor = $request['datos'][$j]['mercancia']['precio'];
                                $comProductos[$i]->cantidad = $request['datos'][$j]['cantidad'];
                                $comProductos[$i]->estado = 1;
                                $comProductos[$i]->factualizado = $fechaActulizacion;
                                $comProductos[$i]->update();
                            } else {
                                $comProductos[$i]->estado = 0;
                                $comProductos[$i]->factualizado = $fechaActulizacion;
                                $comProductos[$i]->update();
                            }
                        }
                    }
                }
                if ($agregarElemento == 1) {
                    $nuevo = new MprComProducto();
                    $nuevo->valor = $elementoNuevo['mercancia']['precio'];
                    $nuevo->cantidad = $elementoNuevo['cantidad'];
                    $nuevo->combo = $combo->id;
                    $nuevo->articulo = $elementoNuevo['mercancia']['id'];
                    $nuevo->estado = 1;
                    $nuevo->save();
                }
            }
        }
    }
}
