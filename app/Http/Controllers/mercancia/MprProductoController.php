<?php

namespace App\Http\Controllers\mercancia;

use App\Http\Controllers\Controller;
use App\Models\mercancia\productos\MprProducto;
use App\Models\mercancia\proveedores\MprProveedor;
use App\Models\mercancia\categorias\MprCategoria;
use App\Models\ventas\MveCarrito;
use App\Models\ventas\MveDetCarrito;
use App\Models\mercancia\MprLinea;
use Illuminate\Http\Request;

class MprProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = MprProducto::all();
        $proveedores = MprProveedor::all();
        $lineas = MprLinea::all();
        $categorias = MprCategoria::all();
        return view('mercancia.productos.index', compact('productos','proveedores','lineas','categorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $proveedores = MprProveedor::all();
        $lineas = MprLinea::all();
        $categorias = MprCategoria::all();

        return view('mercancia.productos.crear', compact('proveedores','lineas','categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        MprProducto::create([
            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'iva' => $request->iva,
            'descuento' => $request->descuento,
            'existencia' => $request->existencia,
            'estilo' => $request->estilo,
            'dimension' => $request->dimension,
            'peso' => $request->peso,
            'material' => $request->material,
            'color' => $request->color,
            'tipopintura' => $request->tipopintura,
            'Acabado' => $request->acabado,
            'imagen' => $request->imagen,
            'detalle' => $request->detalle,
            'garantia' => $request->garantia,
            'Proveedor' => $request->proveedor,
            'linea' => $request->linea,
            'categoria' => $request->categoria,
            'estado' => "1",
            'vista' => "0",
            'compra' => "0",
        ]);
        return redirect()->route('productos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $proveedores = MprProveedor::all();
        $lineas = MprLinea::all();
        $categorias = MprCategoria::all();

        $producto = MprProducto::findOrFail($id);
        
        return view ('mercancia.productos.ver', compact('producto','proveedores','lineas','categorias'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $proveedores = MprProveedor::all();
        $lineas = MprLinea::all();
        $categorias = MprCategoria::all();

        $producto = MprProducto::findOrFail($id);
        return view ('mercancia.productos.editar', compact('producto','proveedores','lineas','categorias'));
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
        $datos = $request->all();
        $producto = MprProducto::findOrFail($id);
        $producto->update($datos);

        return redirect('productos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Producto = MprProducto::findOrFail($id);
        $Producto->estado = "0";
        $Producto->save();
        return redirect('productos');
    }

    public function carrito($id)
    {
        
        $producto = MprProducto::findOrFail($id);

        $carrito = new MveCarrito();
        $carrito->cliente = "1";
        $carrito->estado = "1";
        $carrito->save();

        $detalle = new MveDetCarrito();
        $detalle->cantidad = "1";
        $detalle->producto = $producto->id;
        $detalle->carrito = $carrito->id;
        $detalle->estado = "1";
        $detalle->save();
        return redirect('productos');
    }
    
}
