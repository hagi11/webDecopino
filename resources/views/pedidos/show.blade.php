@extends('layouts.appAdmin')

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
                    <br>
                

                    <div class="title-left">
                        <h3>Cliente</h3>
                        <div class="small text-muted">Nombre: {{$cliente->nombre}}</div>
                        <div class="small text-muted">Identificación: {{$cliente->identificacion}}</div>
                    </div>                    
                    <hr>
                    <br>


                    <div class="title-left">
                        <h3>Factura</h3>
                        <div class="small text-muted">Estado de envio: {{$estadoEnvio}}</div>
                        <div class="small text-muted">Metodo de pago: {{$metodo}}</div>
                        <div class="small text-muted">Direccion de entrega: {{$factura->direccion}}</div>
                    </div>   
                    
                    <hr>
                    <br>
                    <h3>Detalles</h3>
                    @foreach ($detFacturas as $detFactura)
                    <div class="rounded p-2 bg-light">
                        <div class="media mb-2 border-bottom">
                            <div class="media-body"> {{$nombre[$detFactura->id]}}</div>
                                <div class="small text-muted">{{$detalle[$detFactura->id]}}</div>
                                <div class="small text-muted">Price unidad: ${{$detFactura->preciounidad}}<span class="mx-2">|</span> Cantidad: {{$detFactura->cantidad}}<span class="mx-2">|</span> <span class="subTotal">Subtotal: ${{$detFactura->subtotal}}</span><span class="mx-2">|</span> <span class="subTotal">Impuesto: @if($detFactura->impuesto!=0) {{$detFactura->impuesto}}% @else 0% @endif </span><span class="mx-2">|</span> <span class="subTotal">Descuento: {{$detFactura->descuento}}%</span></div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    @endforeach

                    <br>
                    <h3>Valor</h3>
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