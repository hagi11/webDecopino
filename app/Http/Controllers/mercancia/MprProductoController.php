<?php

namespace App\Http\Controllers\mercancia;

use App\Http\Controllers\Controller;
use App\Models\mercancia\productos\MprProducto;
use App\Models\administracion\MadComentario;
use App\Models\clientes\MclCliente;
use App\Models\mercancia\proveedores\MprProveedor;
use App\Models\mercancia\categorias\MprSubCategoria;
use App\Models\mercancia\MprImagen;
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

    public function adminProducto()
    {
        $productos = MprProducto::where('estado', 1)->get();
        return view('mercancia.productos.AdminProductos', compact('productos'));
    }

    public function index()
    {
        $productos = MprProducto::all()
        ->where('estado',1);

        $proveedores = MprProveedor::all()
        ->where('estado',1);
        
        $lineas = MprLinea::all()
        ->where('estado',1);

        $categorias = MprSubCategoria::all()
        ->where('estado',1);

        foreach($productos as $producto){
            $imagenes[$producto->id] = MprImagen::select('id','ruta','producto')
            ->where('producto',$producto->id)
            ->where('estado',1)
            ->first();
        }

        return view('mercancia.productos.index', compact('productos', 'proveedores', 'lineas', 'categorias','imagenes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $proveedores = MprProveedor::select('mprproveedores.id', 'nombre')
        ->where('mprproveedores.estado', 1)
        ->join('madpersonas', 'madpersonas.id', 'mprproveedores.persona')
            ->get();
        $lineas = MprLinea::all()->where('estado',1);
        $categorias = MprSubCategoria::all()->where('estado',1);

        return view('mercancia.productos.crear', compact('proveedores', 'lineas', 'categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nuevo = MprProducto::create([
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
            'acabado' => $request->acabado,
            'detalle' => $request->detalle,
            'garantia' => $request->garantia,
            'Proveedor' => $request->proveedor,
            'linea' => $request->linea,
            'categoria' => $request->categoria,
            'estado' => "1",
            'vista' => "0",
            'compra' => "0",
        ]);
        $comboImg = MprImagen::where('estado', 2)->get();
        for ($i = 0; $i < count($comboImg); $i++) {
            $comboImg[$i]->producto = $nuevo->id;
            $comboImg[$i]->estado = 1;
            $comboImg[$i]->save();
        }

        return redirect()->route('adminProducto');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $producto = MprProducto::findOrFail($id);
        $proveedor = MprProveedor::select('nombre')
            ->join('madpersonas', 'madpersonas.id', 'mprproveedores.persona')
            ->where('mprproveedores.id', $producto->proveedor)
            ->where('mprproveedores.estado', 1)
            ->get();
        $linea = MprLinea::select('nombre')
        ->where('id',$producto->linea)
        ->where('estado',1)
        ->get();

        $relacionados = MprProducto::select('id','nombre','precio','descuento')
        ->where('categoria',$producto->categoria)
        ->where('estado',1)->get();
       
        foreach($relacionados as $relProducto){
            $relImagenes[$relProducto->id] = MprImagen::select('id','ruta','producto')
            ->where('producto',$relProducto->id)
            ->where('estado',1)
            ->first();
        }

        $categoria = MprSubCategoria::select('nombre')
        ->where('id',$producto->categoria)
        ->where('estado',1)
        ->get();
        $comentarios = MadComentario::where('producto', $id)
        ->where('estado',1)
        ->get();
        
        $imagenes = MprImagen::where('producto', $id)
            ->where('estado', 1)
            ->get();
        return view('mercancia.productos.ver', compact('comentarios', 'producto', 'proveedor', 'linea', 'categoria', 'imagenes','relacionados','relImagenes'));
       
    }

    public function showAdmin($id)
    {
        $producto = MprProducto::findOrFail($id);
        $proveedor = MprProveedor::select('nombre')
            ->join('madpersonas', 'madpersonas.id', 'mprproveedores.persona')
            ->where('mprproveedores.id', $producto->proveedor)
            ->where('mprproveedores.estado', 1)
            ->get();
        $linea = MprLinea::select('nombre')
        ->where('id',$producto->linea)
        ->where('estado',1)
        ->get();

        $categoria = MprSubCategoria::select('nombre')
        ->where('id',$producto->categoria)
        ->where('estado',1)
        ->get();
        $comentarios = MadComentario::where('producto', $id)
        ->where('estado',1)
        ->get();
        
        $imagenes = MprImagen::where('producto', $id)
            ->where('estado', 1)
            ->get();
        return view('mercancia.productos.AdminVer', compact('comentarios', 'producto', 'proveedor', 'linea', 'categoria', 'imagenes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        // $proveedores = MprProveedor::all();
        $proveedores = MprProveedor::select('mprproveedores.id','madpersonas.id as idper','nombre')
            ->join('madpersonas', 'madpersonas.id', 'mprproveedores.persona')
            ->where('mprproveedores.estado', 1)
            ->get();
        
        $lineas = MprLinea::all()->where('estado',1);
        $categorias = MprSubCategoria::all()->where('estado',1);
        $producto = MprProducto::findOrFail($id);
        return view('mercancia.productos.editar', compact('producto', 'proveedores', 'lineas', 'categorias'));
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

        return redirect("adminVerProducto/$id");
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
