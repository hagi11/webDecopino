@extends('layouts.app')

@section('content')

<!-- Start Cart  -->
<div class="cart-box-main">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-lg-6 mb-3">
                <div class="checkout-address">
                    <div class="title-left">
                        <h3>Dirección de Envio</h3>
                    </div>
                    <form class="needs-validation" action="{{url('factura')}}" id="generarCompra" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="address">Dirección</label>
                            <input type="text" name="direccion" value="{{$direccion}}" class="form-control" id="address" placeholder="" required>
                            <div class="invalid-feedback"> Please enter your shipping address. </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="country">Pais</label>
                                <select class="wide w-100" id="country" disabled>
                                    <option value="1" data-display="Select">Colombia</option>
                                </select>

                            </div>
                            <div class="col-md-5 mb-3">
                                <label for="state">Departamento</label>
                                <select class="wide w-100" id="state" disabled>
                                    <option data-display="Select">Valle del cauca</option>
                                </select>

                            </div>
                            <div class="col-md-5 mb-3">
                                <label for="state">Ciudad</label>
                                <select class="wide w-100" id="state" disabled>
                                    <option data-display="Select">Santiago de cali</option>
                                </select>

                            </div>

                        </div>
                        <hr class="mb-4">
                        <div class="title"> <span>Metodo de pago</span> </div>
                        <div class="d-block my-3">
                            @foreach($metodos_pago as $metodo_pago)
                            <div class="custom-control custom-radio">
                                <input id="metodo{{$metodo_pago->id}}" name="metodoPago" onclick="vermetododepago({{$metodo_pago->id}})" value="{{$metodo_pago->id}}" type="radio" class="custom-control-input" checked required>
                                <label class="custom-control-label" for="metodo{{$metodo_pago->id}}">{{$metodo_pago->nombre}}</label>
                            </div>
                            @endforeach
                        </div>
                        <hr class="mb-1">
                        <div id="tipopago2">
                            <div class="title-left"><span>Otros metodos de pago</span></div>
                            <h3>Puede pagar por Nequi, una vez realice su pago debera sacar el comprabante.
                                <br> <br> Una vez terminado el proceso podra pasar a la siguiente pagina donde podra adjuntar o enviar el comprabante.
                                </h4>
                                <div class="title-left"> <span>Pago por nequi</span> </div>
                                <img src="https://www.ocu.org/-/media/ta/images/qr-code.png?rev=2e1cc496-40d9-4e21-a7fb-9e2c76d6a288&hash=AF7C881FCFD0CBDA00B860726B5E340B&mw=960" alt="QR NEQUI" width="200" height="200">
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-sm-6 col-lg-6 mb-3">
                <div class="row">
                    <div class="col-md-12 col-lg-12">

                    </div>
                    <div class="col-md-12 col-lg-12">
                        <div class="odr-box">
                            <div class="title-left">
                                <h3>Carrito</h3>
                            </div>
                            <div class="rounded p-2 bg-light">
                                @for ($i = 0; $i < count($datos); $i++) <div class="media mb-2 border-bottom">
                                    @if ($datos[$i]['tipo'] == 'combo')
                                    <div class="media-body"> <a href="{{route('combo.show',$datos[$i]['id'])}}">
                                            @elseif ($datos[$i]['tipo'] == 'producto')
                                            <div class="media-body"> <a href="{{route('productos.show',$datos[$i]['id'])}}">
                                                    @else
                                                    <div class="media-body"> <a href="{{route('mprarticulos.show',$datos[$i]['id'])}}">
                                                            @endif
                                                            {{$datos[$i]['nombre']}}
                                                        </a>
                                                        <div class="small text-muted">Price unidad: {{$datos[$i]['precio']}} <span class="mx-2">|</span> Cantidad: {{$datos[$i]['cantidad']}} <span class="mx-2">|</span> <span class="subTotal">Subtotal: {{$datos[$i]['precio']*$datos[$i]['cantidad']}}</span></div>
                                                    </div>
                                            </div>
                                            @endfor
                                    </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <div class="order-box">
                                <div class="title-left">
                                    <h3>Tu orden</h3>
                                </div>
                                <hr>
                                <div class="d-flex gr-total">
                                    <h5>Total</h5>
                                    <div class="ml-auto h5"> $ {{$subtotal}} </div>
                                </div>
                                <hr>
                            </div>
                        </div>
                        <div class="col-12 d-flex shopping-box"> <a class="ml-auto btn hvr-hover" id="relizarCompra" style="color: white;">Realizar pedido</a> </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        function vermetododepago(id){
            if (id == 14) {
                document.getElementById('tipopago2').style.display = 'block';
            }else{
                document.getElementById('tipopago2').style.display = 'none';
            }
        }
    </script>
    <!-- End Cart -->
    @endsection


    @section('js')
    <script>
        $('#relizarCompra').on("click", function() {
            // console.log('hia')
            document.getElementById('generarCompra').submit();
        });
    </script>


    @endsection