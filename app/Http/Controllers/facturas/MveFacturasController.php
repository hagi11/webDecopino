<?php

namespace App\Http\Controllers\facturas;

use App\Http\Controllers\carrito\mvecarritoController;
use App\Http\Controllers\Controller;
use App\Models\administracion\MadParametro;
use App\Models\administracion\MadPersona;
use App\Models\carrito\mvecarrito;
use App\Models\carrito\mvedetcarrito;
use App\Models\facturas\MveComprobantes;
use App\Models\facturas\MveDetFacturas;
use App\Models\facturas\MveFacturas;
use App\Models\mercancia\MprArticulo;
use App\Models\mercancia\MprCombo;
use App\Models\mercancia\MprComProducto;
use App\Models\mercancia\productos\MprProducto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MveFacturasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()) {

            $facturasDatos = MveFacturas::all()->where('cliente', Auth::user()->id);
            $facturas = [];
            $i = 0;
            foreach ($facturasDatos as $facturasDato) {
                $facturas[$i]['id'] = $facturasDato->id;
                $facturas[$i]['total'] = $facturasDato->total;
                $facturas[$i]['fecha'] = substr($facturasDato->fregistro, 0, 10);

                $metodosP = MadParametro::select('id', 'nombre')->where('tiparametro', 3)->get();
                foreach ($metodosP as $metodoP) {
                    if ($facturasDato->metodo_pago == $metodoP->id) {
                        $facturas[$i]['metodo'] = $metodoP->nombre;
                    }
                }
                $estadosEnvio = MadParametro::select('id', 'nombre')->where('tiparametro', 4)->get();
                foreach ($estadosEnvio as $estEnvio) {
                    if ($facturasDato->estadoenvio == $estEnvio->id) {
                        $facturas[$i]['estadoenvio']  = $estEnvio->nombre;
                    }
                }

                $detalles = "";
                $detFacturas = MveDetFacturas::select('detalles')->where('factura', $facturasDato->id)->get();

                foreach ($detFacturas as $detFactura) {
                    $detalles = $detalles . " " . $detFactura->detalles;
                }

                $facturas[$i]['detalles'] = substr($detalles, 0, 20) . "...";
                if ($facturasDato->direccion != "") {
                    $facturas[$i]['direccion'] = $facturasDato->direccion;
                } else {
                    $facturas[$i]['direccion'] = "Entrega en local";
                }


                $i = $i + 1;
            }
            return view('facturas.misCompras', compact('facturas'));
        } else {
            return redirect()->route('home');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()) {

            $ctrC = new mvecarritoController();
            $resultado = $ctrC->show(1);
            if ($resultado != 0) {


                $datos = $resultado['mercancia'];
                $subtotal = 0;

                for ($i = 0; $i < count($datos); $i++) {
                    $subtotal = $subtotal + ($datos[$i]['precio'] * $datos[$i]['cantidad']);
                }

                $dire = MadPersona::select('direccion')->where('id', Auth::user()->persona)->first();
                $direccion = $dire['direccion'];

                $metodos_pago = MadParametro::select('id', 'nombre')->where('tiparametro', 3)->get();

                return view('facturas.crear', compact('datos', 'subtotal', 'direccion', 'metodos_pago'));
            } else {
                return redirect()->route('carritoCliente',Auth::user()->id);
            }
        } else {
            return back();
        }
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
            $ctrC = new mvecarritoController();
            $resultado = $ctrC->show(1);
            $datos = $resultado['mercancia'];
            $subtotal = 0;

            for ($i = 0; $i < count($datos); $i++) {
                $subtotal = $subtotal + ($datos[$i]['precio'] * $datos[$i]['cantidad']);
            }
            $factura = new MveFacturas();
            $factura->cliente = Auth::user()->id;
            $factura->total = $subtotal;
            // dar la opcion de si recoge el pedio o si es fuera de cali
            $factura->direccion = $request->direccion;
            $factura->precio_envio = 20000;

            $factura->estadoenvio = 9;
            $factura->estado = 1;
            $factura->metodo_pago = $request->metodoPago;
            $factura->save();

            for ($i = 0; $i < count($datos); $i++) {
                $carrito = mvecarrito::select('id')->where('cliente', Auth::user()->id)->first();
                $detFactura = new MveDetFacturas();
                $detFactura->subtotal = $datos[$i]['precio'] * $datos[$i]['cantidad'];
                $detFactura->cantidad = $datos[$i]['cantidad'];
                $detFactura->factura = $factura->id;
                $detFactura->carrito = $carrito->id;

                if ($datos[$i]['tipo'] == 'combo') {
                    $datosMer = MprCombo::all()->where('id', $datos[$i]['id'])->first();

                    $detFactura->descuento = $datosMer->descuento;
                    $detFactura->combo = $datosMer->id;

                    $nombre = $datosMer->nombre . ";";

                    $precio = 0;
                    $comArts = MprComProducto::where('combo', $datosMer->id)
                        ->join('mprarticulos', 'mprarticulos.id', 'mprcomproductos.articulo')
                        ->where('mprcomproductos.estado', 1)
                        ->get();

                    foreach ($comArts as $comArt) {
                        $nombre = $nombre . $comArt->cantidad . " " . $comArt->nombre . ", ";
                        $precio = $precio + $comArt->precio;
                    }

                    $comPros = MprComProducto::where('combo', $datosMer->id)
                        ->join('mprproductos', 'mprproductos.id', 'mprcomproductos.producto')
                        ->where('mprcomproductos.estado', 1)
                        ->get();

                    foreach ($comPros as $comPro) {
                        $nombre = $nombre . $comPro->cantidad . " " . $comPro->nombre . ", ";
                        $precio = $precio + $comPro->precio;
                    }

                    $nombre = substr($nombre, 0, -2);
                    $detFactura->detalles = $nombre;
                    $detFactura->preciounidad = $precio;
                } elseif ($datos[$i]['tipo'] == 'producto') {
                    $datosMer = MprProducto::all()->where('id', $datos[$i]['id'])->first();

                    $detFactura->impuesto = $datosMer->iva;
                    $detFactura->descuento = $datosMer->descuento;
                    $detFactura->detalles = $datosMer->nombre . ";" . $datosMer->detalle;
                    $detFactura->preciounidad = $datosMer->precio;
                    $detFactura->producto = $datosMer->id;
                } else {
                    $datosMer = MprArticulo::all()->where('id', $datos[$i]['id'])->first();
                    $detFactura->descuento = 0;
                    $detFactura->detalles = $datosMer->nombre . ";" . $datosMer->descripcion;
                    $detFactura->preciounidad = $datosMer->precio;
                    $detFactura->articulo = $datosMer->id;
                }
                $detFactura->save();
            }
            $detCarritos = mvedetcarrito::select('id')->where('carrito', $carrito->id)->get();
            foreach ($detCarritos as $detCarrito) {
                $detCarrito->delete();
            }
            return redirect()->route('factura.edit',$factura->id);
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
            $nombre = [];
            $detalle = [];
            $factura = MveFacturas::all()
                ->where('cliente', Auth::user()->id)
                ->where('id', $id)->first();
            if ($factura != null) {
                $detFacturas = MveDetFacturas::all()->where('factura', $factura->id);


                foreach ($detFacturas as $detFactura) {
                    $info = explode(";", $detFactura->detalles);
                    $nombre[$detFactura->id] = $info[0];
                    $detalle[$detFactura->id] = $info[1];
                }

                $metodo = "";
                $estadoEnvio = "";
                $metodosP = MadParametro::select('id', 'nombre')->where('tiparametro', 3)->get();
                foreach ($metodosP as $metodoP) {
                    if ($factura->metodo_pago == $metodoP->id) {
                        $metodo = $metodoP->nombre;
                    }
                }
                $estadosEnvio = MadParametro::select('id', 'nombre')->where('tiparametro', 4)->get();
                foreach ($estadosEnvio as $estEnvio) {
                    if ($factura->estadoenvio == $estEnvio->id) {
                        $estadoEnvio = $estEnvio->nombre;
                    }
                }

                return view('facturas.detalleCompra', compact('factura', 'detFacturas', 'nombre', 'detalle', 'metodo', 'estadoEnvio'));
            }

            return redirect()->route('factura.index');
        } else {
            return redirect()->route('home');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('facturas.soporte', compact('id'));
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
        if (isset($request->subir)) {
            $file = $request->file('imagen');
            $extension = $request->file('imagen')->getClientOriginalExtension();
            $nombre = 'Comprobante_' . $id . '_' . Auth::user()->id . '.' . $extension;
            $ruta = "soportes/pagos/" . $nombre;
          

            copy($file, public_path() . "/" . $ruta);
            $nuevo = new MveComprobantes();
            $nuevo->estado = 1;
            $nuevo->factura = $id;
            $nuevo->archivo = $ruta;
            $nuevo->save();
            $factura = MveFacturas::findOrFail($id);
            $factura->estadoenvio = 10;
            $factura->save();
            return redirect()->route('factura.index');
        }
        if (isset($request->descargar)) {
            $comprobante = MveComprobantes::select('archivo')->where('estado', 1)->where('factura', $id)->first();
            $pathtoFile = public_path() . "/" . $comprobante->archivo;
            return response()->download($pathtoFile);
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
        $factura = MveFacturas::findOrFail($id);
            $factura->estadoenvio = 13;
            $factura->save();
            return redirect()->route('factura.index');
    }
}
