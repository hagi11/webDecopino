<?php

namespace App\Http\Controllers\pedidos;

use App\Http\Controllers\administracion\musUsuarioController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\pedidos\MprPedido;
use App\Models\administracion\MadParametro;
use App\Models\administracion\MadPersona;
use App\Models\facturas\MveComprobantes;
use App\Models\facturas\MveDetFacturas;
use App\Models\facturas\MveFacturas;
use Illuminate\Support\Facades\Auth;

class MprPedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::guard('usuarios')->user()){
            $ctru = new musUsuarioController();
             if($ctru->getPermisoFac()->leer != 1){
                return redirect()->route('homeAdmin');  
             }
        }
        if (Auth::guard('usuarios')) {
            $facturasDatos = MveFacturas::all();
            $facturas = [];
            $i = 0;
            foreach ($facturasDatos as $facturasDato) {

                $facturas[$i]['cliente'] = $facturasDato->cliente;
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
                $facturas[$i]['estadoenvio'] = $facturasDato->estadoenvio;

                $i = $i + 1;
            }


            return view('pedidos.index', compact('facturas', 'estadosEnvio'));
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
        if(Auth::guard('usuarios')->user()){
            $ctru = new musUsuarioController();
             if($ctru->getPermisoFac()->mostrar != 1){
                return redirect()->route('homeAdmin');  
             }
        }
        
        if (Auth::guard('usuarios')) {
            $nombre = [];
            $detalle = [];
            $factura = MveFacturas::all()
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

                $cliente = MadPersona::select('nombre', 'identificacion')->where('id', $factura->cliente)->first();
                return view('pedidos.show', compact('factura', 'detFacturas', 'nombre', 'detalle', 'cliente', 'metodo', 'estadoEnvio'));
            }

            return redirect()->route('pedidos.index');
        } else {
            return redirect()->route('homeAdmin');
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
        if(Auth::guard('usuarios')->user()){
            $ctru = new musUsuarioController();
             if($ctru->getPermisoFac()->editar != 1){
                return redirect()->route('homeAdmin');  
             }
        }

        $comprobante = MveComprobantes::select('archivo')->where('estado', 1)->where('factura', $id)->first();
        $pathtoFile = public_path()."/".$comprobante->archivo;
        return response()->download($pathtoFile);
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
             if($ctru->getPermisoFac()->editar != 1){
                return redirect()->route('homeAdmin');  
             }
        }

        $factura = MveFacturas::findOrFail($id);
        $factura->estadoenvio = $request->estadoenvio;
        $factura->save();
        return redirect('pedidos');
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
}
