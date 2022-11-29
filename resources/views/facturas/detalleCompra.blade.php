@extends('layouts.app')

@section('content')
<!-- Start Cart  -->
<div class="cart-box-main">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="odr-box">

                    <div class="title-left">
                        <h3>Codigo de compra # {{$factura->id}}</h3>
                    </div>
                    
                    <div class="title-left">
                        <div class="text-muted">{{$metodo}}</div>
                        <div class="text-muted">{{$estadoEnvio}}</div>                        
                    </div>
                    @foreach ($detFacturas as $detFactura)
                    <div class="title-left">
                        <div class="media mb-2 border-bottom" style="font-size: 1.5vw;">
                            @if ($detFactura->combo != null)
                            <div class="media-body"> <a href="{{route('combo.show',$detFactura->combo)}}">{{$nombre[$detFactura->id]}}</a>
                                @elseif($detFactura->producto != null)
                                <div class="media-body"> <a href="{{route('productos.show',$detFactura->producto)}}">{{$nombre[$detFactura->id]}}</a>
                                    @elseif($detFactura->articulo != null)
                                    <div class="media-body"> <a href="{{route('mprarticulos.show',$detFactura->articulo)}}">{{$nombre[$detFactura->id]}}</a>
                                        @endif
                                        <div class="small text-muted">{{$detalle[$detFactura->id]}}</div>
                                        <div class="small text-muted">Price unidad: ${{$detFactura->preciounidad}}<span class="mx-2">|</span> Cantidad: {{$detFactura->cantidad}}<span class="mx-2">|</span> <span class="subTotal">Subtotal: ${{$detFactura->subtotal}}</span><span class="mx-2">|</span> <span class="subTotal">Impuesto: @if($detFactura->impuesto!=0) {{$detFactura->impuesto}}% @else 0% @endif </span><span class="mx-2">|</span> <span class="subTotal">Descuento: {{$detFactura->descuento}}%</span></div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                            <div class="d-flex gr-total">
                                <div class="h5"> $ {{$factura->total}} </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Cart -->

    @endsection