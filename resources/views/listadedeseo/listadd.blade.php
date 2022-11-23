@extends('layouts.app')

@section('content')
<div class="wishlist-box-main">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-main table-responsive">
                    <table class="table" style="text-align: center">
                        <thead>

                            <tr>
                                <th>Images</th>
                                <th>Prodcto</th>
                                <th>Precio Unidad</th>
                                <th>Enviar al Carrtio</th>
                                <th>Quitar</th>
                            </tr>

                        </thead>
                        <tbody>
                            @foreach ($listadeseo as $lista)
                            <tr>
                                <td class="thumbnail-img">
                                    @if ($mercancias[$lista->id]['tipo'] == 'combo')
                                    <a href="{{ route('combo.show', $mercancias[$lista->id]['id']) }}">
                                        @elseif ($mercancias[$lista->id]['tipo'] == 'producto')
                                        <a href="{{ route('productos.show', $mercancias[$lista->id]['id']) }}">
                                            @else
                                            <a href="{{ route('mprarticulos.show', $mercancias[$lista->id]['id']) }}">
                                                @endif

                                                <img class="img-fluid" src="{{ asset($mercancias[$lista->id]['ruta']) }}" alt="{{ $mercancias[$lista->id]['nombre'] }}" />
                                            </a>
                                </td>
                                <td class="name-pr">
                                    @if ($mercancias[$lista->id]['tipo'] == 'combo')
                                    <a href="{{ route('combo.show', $mercancias[$lista->id]['id']) }}">
                                        @elseif ($mercancias[$lista->id]['tipo'] == 'producto')
                                        <a href="{{ route('productos.show', $mercancias[$lista->id]['id']) }}">
                                            @else
                                            <a href="{{ route('mprarticulos.show', $mercancias[$lista->id]['id']) }}">
                                                @endif

                                                {{ $mercancias[$lista->id]['nombre'] }}
                                            </a>
                                </td>
                                <td class="price-pr">
                                    <p>{{ $mercancias[$lista->id]['precio'] }}</p>
                                </td>
                                <td class="add-pr">
                                    @php
                                    $idMer=$mercancias[$lista->id]['id'] ;
                                    @endphp

                                    @if ($mercancias[$lista->id]['tipo'] == 'combo')
                                    <a style="color: white;" onclick="enviarCarrito('{{ $idMer }}',1)" class="btn hvr-hover">Enviar al Carrito</a>
                                    @elseif($mercancias[$lista->id]['tipo'] == 'producto')
                                    <a style="color: white;" onclick="enviarCarrito('{{ $idMer }}',2)" class="btn hvr-hover">Enviar al Carrito</a>
                                    @else
                                    <a style="color: white;" onclick="enviarCarrito('{{ $idMer }}',3)" class="btn hvr-hover">Enviar al Carrito</a>
                                    @endif

                                </td>
                                <td>
                                    <form id="formQuitar{{ $lista->id }}" action="{{ route('listaDeseos.destroy', $lista->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <i onclick="document.getElementById('formQuitar{{ $lista->id }}').submit();" class="fas fa-times store"></i>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Wishlist -->
@endsection
@section('js')

<script>
    $('.store').mouseenter(function() {
        $("body").css("cursor", "pointer");
    });

    $('.store').mouseleave(function() {
        $("body").css("cursor", "auto");
    });

    function enviarCarrito(lista, tipo) {
        console.log(lista);
        if (tipo == 1) {
            $.ajax({
                type: 'post',
                url: '{{route("carrito.store")}}',
                data: {
                    combo: lista,
                    '_token': $("meta[name='csrf-token']").attr("content"),
                },

                success: function(res) {
                    ajustarCarrito();
                    console.log(res);
                },

            });
        }

        if (tipo == 2) {
            $.ajax({
                type: 'post',
                url: '{{route("carrito.store")}}',
                data: {
                    producto: lista,
                    '_token': $("meta[name='csrf-token']").attr("content"),
                },

                success: function(res) {
                    console.log(res);
                },

            });
        }

        if (tipo == 3) {
            $.ajax({
                type: 'post',
                url: '{{route("carrito.store")}}',
                data: {
                    articulo: lista,
                    '_token': $("meta[name='csrf-token']").attr("content"),
                },

                success: function(res) {
                    console.log(res);
                },

            });
        }



    }
</script>

@endsection