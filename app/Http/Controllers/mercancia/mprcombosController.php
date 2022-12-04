<?php

namespace App\Http\Controllers\mercancia;

use App\Http\Controllers\administracion\musUsuarioController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MprFechaUpdateContoller;
use App\Models\mercancia\MprComProducto;
use App\Models\mercancia\MprCombo;
use App\Models\administracion\MadComentario;
use App\Models\mercancia\MprArticulo;
use App\Models\mercancia\MprImagen;
use App\Models\mercancia\MprProducto;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class mprcombosController extends Controller
{
    public function __construct()
    {
        //$this->middleware(['auth'=> 'auth:web,usuarios']);  //--> Proteger Todos los metodos.
        // $this->middleware(['auth'=> 'auth:web,usuarios'])->except(['index', 'show']); // --> Proteger algunos metodos.
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $combos = MprCombo::where('estado', 1)->get();
        $nombre = "";
        foreach ($combos as $combo) {
            $imagenes[$combo->id] = MprImagen::select('id', 'ruta', 'combo')
                ->where('combo', $combo->id)
                ->where('estado', 1)
                ->first();

            $comArts = MprComProducto::where('combo', $combo->id)
                ->join('mprarticulos', 'mprarticulos.id', 'mprcomproductos.articulo')
                ->where('mprcomproductos.estado', 1)
                ->get();

            foreach ($comArts as $comArt) {
                $nombre = $comArt->cantidad . " " . $comArt->nombre . ", " . $nombre;
            }

            $comPros = MprComProducto::where('combo', $combo->id)
                ->join('mprproductos', 'mprproductos.id', 'mprcomproductos.producto')
                ->where('mprcomproductos.estado', 1)
                ->get();

            foreach ($comPros as $comPro) {
                $nombre = $comPro->cantidad . " " . $comPro->nombre . ", " . $nombre;
            }

            $nombre = substr($nombre, 0, -2);
            $lista[$combo->id] = $nombre;
            $nombre = "";
        }
        return view('mercancia.combos.ListaCombos', compact('combos', 'imagenes', 'lista'));
    }

    public function indexAdmin()
    {

        if (Auth::guard('usuarios')->user()) {
            $ctru = new musUsuarioController();
            if ($ctru->getPermisoInv()->leer == 1) {

                $combos = MprCombo::where('estado', 1)->get();
                return view('mercancia.combos.AdminCombos', compact('combos'));
            }
        }
        return redirect()->route('homeAdmin');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {

        if (Auth::guard('usuarios')->user()) {
            $ctru = new musUsuarioController();
            if ($ctru->getPermisoInv()->crear == 1) {

                $valor = MprCombo::select('id')
                    ->orderBy('id', 'desc')
                    ->first();
                $id = $valor->id + 1;

                $productos = MprProducto::select('id', 'nombre', 'detalle', 'precio')
                    ->where('estado', 1)->get();
                $articulos = MprArticulo::select('id', 'nombre', 'descripcion', 'precio')
                    ->where('estado', 1)->get();

                return view('mercancia.combos.AgregarCombo', compact('productos', 'articulos', 'id'));
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

        if (Auth::guard('usuarios')->user()) {
            $ctru = new musUsuarioController();
            if ($ctru->getPermisoInv()->crear == 1) {

                $validator = Validator::make($request->all(), [
                    'nombre' => 'required|max:30',
                    'valor' => 'numeric|required|min:100|max:9999999999',
                    'descuento' => 'numeric|required|min:0|max:99',
                    'datos' => 'required',
                ]);

                if ($validator->fails()) {
                    return "Informacion del combo invalidad";
                }

                $cant = 0;
                for ($i = 0; $i <= count($request['datos']) - 1; $i++) {
                    if ($request['datos'][$i]['cantidad'] > 0) {
                        $cant = $cant + $request['datos'][$i]['cantidad'];
                    }
                }

                if ($cant <= 1) {
                    return "Minimo dos elementos para crear un combo";
                }

                $nameValid = MprCombo::select('id')->where('nombre', $request['nombre'])->count();
                if ($nameValid > 0) {
                    return "Este nombre ya esta asignado a otro combo";
                }


                $crearCombo = new MprCombo();
                $crearCombo->nombre = $request['nombre'];
                $crearCombo->total = $request['valor'];
                $crearCombo->descuento = $request['descuento'];
                $crearCombo->estado = 1;
                $crearCombo->save();

                for ($i = 0; $i <= count($request['datos']) - 1; $i++) {
                    if ($request['datos'][$i]['cantidad'] > 1) {
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
                $comboImg = MprImagen::where('estado', 2)->get();
                for ($i = 0; $i < count($comboImg); $i++) {
                    $comboImg[$i]->combo = $crearCombo->id;
                    $comboImg[$i]->estado = 1;
                    $comboImg[$i]->save();
                }

                return 1;
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
        $combo = MprCombo::find($id);
        $comProImgs = [];
        $comArtImgs = [];
        $nombre = "";
        if (!Auth::guard('usuarios')->user()) {
            $combo->vistas = $combo['vistas'] + 1;
        }
        $combo->update();
        $imagenes = MprImagen::select('id', 'ruta', 'combo')
            ->where('combo', $combo->id)
            ->where('estado', 1)
            ->get();

        $comPros = MprComProducto::select('mprproductos.id', 'mprproductos.nombre', 'mprcomproductos.cantidad', 'mprproductos.existencia', 'mprproductos.precio', 'mprproductos.descuento', 'mprcomproductos.producto')
            ->join('mprproductos', 'mprproductos.id', 'mprcomproductos.producto')
            ->where('combo', $id)
            ->where('mprcomproductos.estado', 1)
            ->get();

        foreach ($comPros as $comPro) {
            $comProImgs[$comPro->id] = MprImagen::select('id', 'ruta', 'producto')
                ->where('producto', $comPro->producto)
                ->where('estado', 1)
                ->first();
            $nombre = $comPro->cantidad . " " . $comPro->nombre . ", " . $nombre;
        }



        $comArts = MprComProducto::select('mprarticulos.id', 'mprarticulos.nombre', 'mprcomproductos.cantidad', 'mprarticulos.existencia', 'mprarticulos.precio', 'mprcomproductos.articulo')->where('combo', $id)
            ->join('mprarticulos', 'mprarticulos.id', 'mprcomproductos.articulo')
            ->where('mprcomproductos.estado', 1)
            ->get();
        foreach ($comArts as $comArt) {
            $comArtImgs[$comArt->id] = MprImagen::select('id', 'ruta', 'articulo')
                ->where('articulo', $comArt->articulo)
                ->where('estado', 1)
                ->first();
            $nombre = $comArt->cantidad . " " . $comArt->nombre . ", " . $nombre;
        }
        // $comPros->vistas=$comPros['vistas']+1;
        $comentarios = MadComentario::where('combo', $id)
            ->where('estado', 1)
            ->get();



        $nombre = substr($nombre, 0, -2);
        return view('mercancia.combos.verCombo', compact('comentarios', 'comPros', 'combo', 'comArts', 'comProImgs', 'comArtImgs', 'nombre', 'imagenes'));
    }

    public function showAdmin($id)
    {

        if (Auth::guard('usuarios')->user()) {
            $ctru = new musUsuarioController();
            if ($ctru->getPermisoInv()->mostrar == 1) {

                $combo = MprCombo::find($id);
                if (false) {
                    $combo->vistas = $combo['vistas'] + 1;
                }
                $combo->update();
                $comPros = MprComProducto::where('combo', $id)
                    ->join('mprproductos', 'mprproductos.id', 'mprcomproductos.producto')
                    ->where('mprcomproductos.estado', 1)
                    ->get();

                $comArts = MprComProducto::where('combo', $id)
                    ->join('mprarticulos', 'mprarticulos.id', 'mprcomproductos.articulo')
                    ->where('mprcomproductos.estado', 1)
                    ->get();
                $comentarios = MadComentario::where('combo', $id)
                    ->where('estado', 1)
                    ->get();
                $imagenes = MprImagen::where('combo', $id)
                    ->where('estado', 1)
                    ->get();
                return view('mercancia.combos.verComboAdmin', compact('comPros', 'combo', 'comArts', 'imagenes', 'comentarios'));
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

        if (Auth::guard('usuarios')->user()) {
            $ctru = new musUsuarioController();
            if ($ctru->getPermisoInv()->editar == 1) {

                $combo = MprCombo::findOrFail($id);
                $prosEnCombo = MprComProducto::select('mprcomproductos.id as idcombo', 'mprproductos.id as idproduct', 'valor', 'cantidad', 'nombre', 'detalle', 'precio')
                    ->join('mprproductos', 'mprproductos.id', "=", "mprcomproductos.producto")
                    ->where('combo', $id)
                    ->where('mprcomproductos.estado', '1')
                    ->where('mprcomproductos.producto', '!=', '')->get();
                $artsEnCombo = MprComProducto::select('mprcomproductos.id as idcombo', 'mprarticulos.id as idarticulo', 'valor', 'cantidad', 'nombre', 'descripcion', 'precio')
                    ->join('mprarticulos', 'mprarticulos.id', "=", "mprcomproductos.articulo")
                    ->where('combo', $id)
                    ->where('mprcomproductos.estado', '1')
                    ->where('mprcomproductos.articulo', '!=', '')->get();

                $productos = MprProducto::select('id', 'nombre', 'detalle', 'precio')
                    ->where('estado', 1)->get();
                $articulos = MprArticulo::select('id', 'nombre', 'descripcion', 'precio')
                    ->where('estado', 1)->get();

                return view('mercancia.combos.EditarCombo', compact('productos', 'articulos', 'combo', 'prosEnCombo', 'artsEnCombo'));
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
    public function update($id, Request $request)
    {

        if (Auth::guard('usuarios')->user()) {
            $ctru = new musUsuarioController();
            if ($ctru->getPermisoInv()->editar == 1) {

                if (Auth::guard('usuarios')->user()) {


                    $validator = Validator::make($request->all(), [
                        'nombre' => 'required|max:30',
                        'valor' => 'numeric|required|min:100|max:9999999999',
                        'descuento' => 'numeric|required|min:0|max:99',
                        'datos' => 'required',
                    ]);

                    if ($validator->fails()) {
                        return "Información del combo invalidad";
                    }

                    $cant = 0;
                    for ($i = 0; $i <= count($request['datos']) - 1; $i++) {
                        if ($request['datos'][$i]['cantidad'] > 0) {
                            $cant = $cant + $request['datos'][$i]['cantidad'];
                        }
                    }

                    if ($cant <= 1) {
                        return "Minimo dos elementos para crear un combo";
                    }

                    $nameValid = MprCombo::select('id')->where('nombre', $request['nombre'])->where('id', '<>', $id)->count();
                    if ($nameValid > 0) {
                        return "Este nombre ya esta asignado a otro combo";
                    }

                    date_default_timezone_set('America/Bogota');
                    $fechaActulizacion = date('Y-m-d h:i:s a', time());

                    $combo = MprCombo::find($request->id);
                    $combo->nombre = $request->nombre;
                    $combo->total = $request->valor;
                    $combo->descuento = $request->descuento;
                    $combo->factualizado = $fechaActulizacion;
                    $combo->update();


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
                    return 1;
                }
                return "no existe usuario";
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

        if (Auth::guard('usuarios')->user()) {
            $ctru = new musUsuarioController();
            if ($ctru->getPermisoInv()->eliminar == 1) {


                $fechaActulizacion = new MprFechaUpdateContoller();
                $imagenes = MprImagen::select('id', 'ruta', 'estado')->where('estado', 1)->where('combo', $id)->get();

                foreach ($imagenes as $imagen) {
                    $ctri = new MprImagenController();
                    $ctri->destroy($imagen->id);
                }

                $combo = MprCombo::find($id);
                $combo->estado = 0;
                $combo->factualizado = $fechaActulizacion->fecha();
                $combo->update();
                return redirect(route('indexAdmin'));
            }
        }
        return redirect()->route('homeAdmin');
    }
}
