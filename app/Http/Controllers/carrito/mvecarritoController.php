<?php

namespace App\Http\Controllers\carrito;

use App\Http\Controllers\Controller;
use App\Models\carrito\mvecarrito;
use App\Models\carrito\mvedetcarrito;
use App\Models\mercancia\MprArticulo;
use App\Models\mercancia\MprCombo;
use App\Models\mercancia\MprImagen;
use App\Models\mercancia\MprProducto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class mvecarritoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function indexCliente($id)
    {

        if (Auth::user()) {
            $numero = mvecarrito::all()->where('cliente', $id)->count();

            if ($numero == 0) {
                $carrito = new mvecarrito();
                $carrito->cliente = $id;
                $carrito->estado = 1;
                $carrito->save();
            } else {
                $carrito = mvecarrito::FindOrFail($id);
            }

            $num = mvedetcarrito::all()->where('estado', 1)->where('carrito', $carrito->id)->count();
            if ($num != 0) {
                $detCarritos = mvedetcarrito::select('id', 'cantidad', 'combo', 'producto', 'articulo')->where('estado', 1)->where('carrito', $carrito->id)->get();

                foreach ($detCarritos as $detCarrito) {
                    if ($detCarrito->combo != null) {
                        $combo = MprCombo::all()->where('id', $detCarrito->combo)->where('estado', 1)->first();


                        $imagen = MprImagen::select('id', 'ruta', 'combo')
                            ->where('combo', $combo->id)
                            ->where('estado', 1)
                            ->first();

                        $mercancias[$detCarrito->id] = ['tipo' => 'combo', 'id' => $combo->id, 'nombre' => $combo->nombre, 'precio' => $combo->total, 'ruta' => $imagen->ruta];
                    } elseif ($detCarrito->producto != null) {
                        $producto = MprProducto::all()->where('id', $detCarrito->producto)->where('estado', 1)->first();
                        $imagen = MprImagen::select('id', 'ruta', 'producto')
                            ->where('producto', $producto->id)
                            ->where('estado', 1)
                            ->first();
                        $precio = $producto->precio - ($producto->precio * $producto->descuento / 100);
                        $mercancias[$detCarrito->id] = ['tipo' => 'producto', 'id' => $producto->id, 'nombre' => $producto->nombre, 'precio' => $precio, 'ruta' => $imagen->ruta];
                    } else {
                        $articulo = MprArticulo::all()->where('id', $detCarrito->articulo)->where('estado', 1)->first();
                        $imagen = MprImagen::select('id', 'ruta', 'articulo')
                            ->where('articulo', $articulo->id)
                            ->where('estado', 1)
                            ->first();

                        $mercancias[$detCarrito->id] = ['tipo' => 'articulo', 'id' => $articulo->id, 'nombre' => $articulo->nombre, 'precio' => $articulo->precio, 'ruta' => $imagen->ruta];
                    }
                }

                return view('carrito.indexCliente', compact('detCarritos', 'mercancias'));
            } else {
                $detCarritos = [];
                return view('carrito.indexCliente', compact('detCarritos'));
            }
        } else {
            return back();
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
        if (Auth::user()) {

            $numero = mvecarrito::all()->where('cliente', Auth::user()->id)->count();

            if ($numero == 0) {
                $carrito = new mvecarrito();
                $carrito->cliente = Auth::user()->id;
                $carrito->estado = 1;
                $carrito->save();
            } else {
                $carrito = mvecarrito::FindOrFail(Auth::user()->id);
            }

            if (isset($request['producto'])) { 

                $cantidad = mvedetcarrito::all()
                ->where('producto', $request->producto)
                ->where('carrito',$carrito->id)->count();
                
                if ($cantidad == 0) {
                    $detCarrito = new mvedetcarrito();
                    $detCarrito->producto = $request->producto;
                    $detCarrito->cantidad = 1;
                    $detCarrito->carrito = $carrito->id;
                    $detCarrito->estado = 1;
                    $detCarrito->save();
                } else {
                    $detCarrito = mvedetcarrito::all()
                        ->where('producto', $request->producto)
                        ->where('estado', 1)
                        ->where('carrito', $carrito->id)->first();

                    $detCarrito->cantidad = $detCarrito['cantidad'] + 1;
                    $detCarrito->save();
                }
            } elseif (isset($request['combo'])) {
                $cantidad = mvedetcarrito::all()->where('combo', $request->combo)->where('carrito',$carrito->id)->count();

                if ($cantidad == 0) {
                    $detCarrito = new mvedetcarrito();
                    $detCarrito->combo = $request->combo;
                    $detCarrito->cantidad = 1;
                    $detCarrito->carrito = $carrito->id;
                    $detCarrito->estado = 1;

                    $detCarrito->save();
                } else {

                    $detCarrito = mvedetcarrito::all()
                        ->where('combo', $request->combo)
                        ->where('estado', 1)
                        ->where('carrito', $carrito->id)->first();

                    $detCarrito->cantidad = $detCarrito['cantidad'] + 1;
                    $detCarrito->save();
                }
            } elseif (isset($request['articulo'])) {
                $cantidad = mvedetcarrito::all()->where('articulo', $request->articulo)->where('carrito',$carrito->id)->count();
                if ($cantidad == 0) {
                    $detCarrito = new mvedetcarrito();
                    $detCarrito->articulo = $request->articulo;
                    $detCarrito->cantidad = 1;
                    $detCarrito->carrito = $carrito->id;
                    $detCarrito->estado = 1;
                    $detCarrito->save();
                } else {

                    $detCarrito = mvedetcarrito::all()
                        ->where('articulo', $request->articulo)
                        ->where('estado', 1)
                        ->where('carrito', $carrito->id)->first();


                    $detCarrito->cantidad = $detCarrito['cantidad'] + 1;
                    $detCarrito->save();
                }
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::user()) {
            $numero = mvecarrito::all()->where('cliente', $id)->count();

            if ($numero == 0) {
                $carrito = new mvecarrito();
                $carrito->cliente = $id;
                $carrito->estado = 1;
                $carrito->save();
            } else {
                $carrito = mvecarrito::FindOrFail($id);
            }
            $resultado = [];

            $resultado['num'] = mvedetcarrito::all()->where('estado', 1)->where('carrito', $carrito->id)->count();

            if ($resultado['num'] != 0) {
                $detCarritos = mvedetcarrito::select('id', 'cantidad', 'combo', 'producto', 'articulo')->where('estado', 1)->where('carrito', $carrito->id)->get();
                $i=0;
                foreach ($detCarritos as $detCarrito) {


                    if ($detCarrito->combo != null) {
                        $combo = MprCombo::all()->where('id', $detCarrito->combo)->where('estado', 1)->first();


                        $imagen = MprImagen::select('id', 'ruta', 'combo')
                            ->where('combo', $combo->id)
                            ->where('estado', 1)
                            ->first();

                        $mercancias[$i] = ['tipo' => 'combo', 'id' => $combo->id, 'nombre' => $combo->nombre, 'precio' => $combo->total, 'ruta' => $imagen->ruta, 'cantidad'=> $detCarrito->cantidad];
                    } elseif ($detCarrito->producto != null) {
                        $producto = MprProducto::all()->where('id', $detCarrito->producto)->where('estado', 1)->first();
                        $imagen = MprImagen::select('id', 'ruta', 'producto')
                            ->where('producto', $producto->id)
                            ->where('estado', 1)
                            ->first();
                        $precio = $producto->precio - ($producto->precio * $producto->descuento / 100);
                        $mercancias[$i] = ['tipo' => 'producto', 'id' => $producto->id, 'nombre' => $producto->nombre, 'precio' => $precio, 'ruta' => $imagen->ruta, 'cantidad'=> $detCarrito->cantidad];
                    } else {
                        $articulo = MprArticulo::all()->where('id', $detCarrito->articulo)->where('estado', 1)->first();
                        $imagen = MprImagen::select('id', 'ruta', 'articulo')
                            ->where('articulo', $articulo->id)
                            ->where('estado', 1)
                            ->first();

                        $mercancias[$i] = ['tipo' => 'articulo', 'id' => $articulo->id, 'nombre' => $articulo->nombre, 'precio' => $articulo->precio, 'ruta' => $imagen->ruta,'cantidad'=> $detCarrito->cantidad];
                    }
                    $i = $i + 1;
                    $resultado['mercancia'] = $mercancias;                    
                }
            }else{
                $resultado['mercancia'] = "noData";
            }
        }
        return $resultado;
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
        $request->validate([
            'cantidad' => 'required|min:1|max:200|numeric'
        ]);
        if (Auth::user()) {
            if (isset($request['cantidad'])) {
                $detCarrito = mvedetcarrito::FindOrFail($id);
                $detCarrito->cantidad = $request->cantidad;
                $detCarrito->save();
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()) {
            $detCarrito = mvedetcarrito::FindOrFail($id);
            $detCarrito->delete();
        }
        return redirect()->route('carritoCliente', Auth::user()->id);
    }
}
