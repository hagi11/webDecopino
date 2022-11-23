@extends('layouts.app')

@section('content')


<!-- Start Cart  -->
<div class="cart-box-main">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-main table-responsive">
                    <table id="tabla" class="table" style="text-align: center">
                        <thead>
                            <tr>
                                <th>Images</th>
                                <th>Producto</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Total</th>
                                <th>Remove</th>
                            </tr>
                        </thead> 
                        <tbody>
                            @foreach ($detCarritos as $detCarrito)
                            <tr>
                                <td class="thumbnail-img">
                                    @if ($mercancias[$detCarrito->id]['tipo'] == 'combo')
                                    <a href="{{route('combo.show',$mercancias[$detCarrito->id]['id'])}}">
                                        @elseif ($mercancias[$detCarrito->id]['tipo'] == 'producto')
                                        <a href="{{route('productos.show',$mercancias[$detCarrito->id]['id'])}}">
                                            @else
                                            <a href="{{route('mprarticulos.show',$mercancias[$detCarrito->id]['id'])}}">
                                                @endif

                                                <img class="img-fluid" src="{{asset($mercancias[$detCarrito->id]['ruta'])}}" alt="{{$mercancias[$detCarrito->id]['nombre']}}" />
                                            </a> 
                                </td>
                                <td class="name-pr">
                                @if ($mercancias[$detCarrito->id]['tipo'] == 'combo')
                                    <a href="{{route('combo.show',$mercancias[$detCarrito->id]['id'])}}">
                                        @elseif ($mercancias[$detCarrito->id]['tipo'] == 'producto')
                                        <a href="{{route('productos.show',$mercancias[$detCarrito->id]['id'])}}">
                                            @else
                                            <a href="{{route('mprarticulos.show',$mercancias[$detCarrito->id]['id'])}}">
                                                @endif
                                        {{$mercancias[$detCarrito->id]['nombre']}}
                                    </a>
                                </td>
                                <td class="price-pr">
                                    @php
                                    $precio = $mercancias[$detCarrito->id]['precio'];
                                    @endphp
                                    <p id="precio{{$detCarrito->id}}">$ {{$precio}}</p>
                                </td>
                                <td class="quantity-box"><input id="cantidad{{$detCarrito->id}}" type="number" size="4" onchange="cantidad('{{$detCarrito->id}}')" value="{{$detCarrito->cantidad}}" min="1" step="1" class="c-input-text qty text"></td>
                                <td class="total-pr">
                                    <p id="valor{{$detCarrito->id}}">{{$precio * $detCarrito->cantidad}}</p>
                                </td>
                                <td class="remove-pr">

                                    <form id="formQuitar{{$detCarrito->id}}" action="{{ route('carrito.destroy',$detCarrito->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <i onclick="document.getElementById('formQuitar{{$detCarrito->id}}').submit();" class="fas fa-times store"></i>
                                </td>
                            </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class="row my-5">
            <div class="col-lg-8 col-sm-12"></div>
            <div class="col-lg-4 col-sm-12">
                <div class="order-box">
                    <div class="d-flex gr-total">
                        <h5>Total</h5>
                        <div id="valCompra" class="ml-auto h5"> $ </div>
                    </div>
                    <hr>
                </div>
            </div>
            <div class="col-12 d-flex shopping-box"><a href="#" class="ml-auto btn hvr-hover">Comprar</a> </div>
        </div>

    </div>
</div>
<!-- End Cart -->

@endsection

@section('js')
<script src="{{asset('js/jquery-ui.js')}}"></script>
<script src="{{asset('js/jquery.nicescroll.min.js')}}"></script>

<script>
    $('.store').mouseenter(function() {
        $("body").css("cursor", "pointer");
    });

    $('.store').mouseleave(function() {
        $("body").css("cursor", "auto");
    });

    total();

    function cantidad(detCar) {
        numero = $('#cantidad' + detCar).val();
        precio = $('#precio' + detCar).text().substr(2);
        $('#valor' + detCar).text(numero * precio);
        total();
        let url = "{{route('carrito.update',1)}}";
        url = url.replace('1', detCar);
        $.ajax({
            type: "PUT",
            url: url,
            data: {
                cantidad: numero,
                '_token': $("meta[name='csrf-token']").attr("content"),
            },

        });
    }

    function total() {
        let filas = $('#tabla').find('tbody tr').length;
        valtotal = 0;
        for (var i = 0; i < filas; i++) {
            var valor = $("tbody .total-pr p")[i].innerHTML;
            valtotal = valtotal + parseInt(valor);
        }

        $('#valCompra').text("$ " + valtotal);

    }
</script>


@endsection