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
                                <th>Codigo</th>
                                <th>Compra</th>
                                <th>Valor</th>
                                <th>Estado envio</th>
                                <th>Metodo de pago</th>
                                <th>Fecha de compra</th>
                                <th>Lugar de entrega</th>
                                <th>Detalles</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($facturas as $factura)
                            <tr>
                                <td class="name-pr">
                                    {{$factura['id']}}
                                </td>
                                <td class="name-pr">
                                    {{$factura['detalles']}}
                                </td>
                                <td class="name-pr">
                                    {{$factura['total']}}
                                </td>
                               
                                <td class="name-pr">
                                    {{$factura['estadoenvio']}}
                                </td>
                                <td class="name-pr">
                                    {{$factura['metodo']}}
                                </td>
                                <td class="name-pr">
                                    {{$factura['fecha']}}
                                </td>
                               
                                <td class="name-pr">
                                    {{$factura['direccion']}}
                                </td>
                                <td class="name-pr">
                                <a href="{{route('factura.show',$factura['id'])}}">
                                <i><img src="{{asset('img/icons/lupa.png')}}" alt="lupa"></i>
                                </a>

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
<!-- End Cart -->

@endsection