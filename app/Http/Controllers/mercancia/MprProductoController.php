<?php

namespace App\Http\Controllers\mercancia;

use App\Http\Controllers\administracion\musUsuarioController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MprFechaUpdateContoller;
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
use Illuminate\Support\Facades\Auth;

class MprProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function adminProducto()
    {

        if(Auth::guard('usuarios')->user()){
            $ctru = new musUsuarioController();
             if($ctru->getPermisoInv()->leer == 1){
                 $productos = MprProducto::where('estado', 1)->get();
                 return view('mercancia.productos.AdminProductos', compact('productos'));
             }
        }
        return redirect()->route('homeAdmin');  
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

        if(Auth::guard('usuarios')->user()){
            $ctru = new musUsuarioController();
             if($ctru->getPermisoInv()->crear == 1){
                

                 $proveedores = MprProveedor::select('mprproveedores.id', 'nombre')
                 ->where('mprproveedores.estado', 1)
                 ->join('madpersonas', 'madpersonas.id', 'mprproveedores.persona')
                     ->get();
                 $lineas = MprLinea::all()->where('estado',1);
                 $categorias = MprSubCategoria::all()->where('estado',1);
         
                 return view('mercancia.productos.crear', compact('proveedores', 'lineas', 'categorias'));
             }
        }
        return redirect()->route('homeAdmin');  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if(Auth::guard('usuarios')->user()){
            $ctru = new musUsuarioController();
             if($ctru->getPermisoInv()->crear == 1){
                

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
        }
        return redirect()->route('homeAdmin');  
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
        if (Auth::user()) {
            $producto->vistas = $producto['vistas'] + 1;
        }
        $producto->update();
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
        ->where('id', '<>',$id)
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

        
        if(Auth::guard('usuarios')->user()){
            $ctru = new musUsuarioController();
             if($ctru->getPermisoInv()->mostrar == 1){
                

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
        }
        return redirect()->route('homeAdmin');  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        
        if(Auth::guard('usuarios')->user()){
            $ctru = new musUsuarioController();
             if($ctru->getPermisoInv()->editar == 1){
                

                 $proveedores = MprProveedor::select('mprproveedores.id','madpersonas.id as idper','nombre')
                     ->join('madpersonas', 'madpersonas.id', 'mprproveedores.persona')
                     ->where('mprproveedores.estado', 1)
                     ->get();
                 
                 $lineas = MprLinea::all()->where('estado',1);
                 $categorias = MprSubCategoria::all()->where('estado',1);
                 $producto = MprProducto::findOrFail($id);
                 return view('mercancia.productos.editar', compact('producto', 'proveedores', 'lineas', 'categorias'));
             }
        }
        return redirect()->route('homeAdmin');  
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
             if($ctru->getPermisoInv()->editar == 1){
                

                 $datos = $request->all();
                 $producto = MprProducto::findOrFail($id);
                 $producto->update($datos);
         
                 return redirect("adminVerProducto/$id");
             }
        }
        return redirect()->route('homeAdmin');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        if(Auth::guard('usuarios')->user()){
            $ctru = new musUsuarioController();
             if($ctru->getPermisoInv()->eliminar == 1){
                

                 $fechaActulizacion = new MprFechaUpdateContoller();
                 $imagenes = MprImagen::select('id','ruta','estado')->where('estado',1)->where('producto',$id)->get();
         
                 foreach ($imagenes as $imagen){
                     $ctri = new MprImagenController();
                     $ctri->destroy($imagen->id);
                 }
                 $Producto = MprProducto::findOrFail($id);
                 $Producto->estado = "0";
                 $Producto->factualizado = $fechaActulizacion->fecha();
                 $Producto->save();
                 return redirect('adminProducto');
             }
        }
        return redirect()->route('homeAdmin');  
    }

}
