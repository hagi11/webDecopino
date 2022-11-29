@extends('layouts.appAdmin')

@section('content')
<div class="container">
    <h2 class="text-center mt-5 mb-5">Pedidos</h2>
    @if(session('type'))
    <div class="alert alert-{{session('type')}} alert-dismissible fade show" role="alert">
        <strong>Mensaje: </strong>{{session('message')}}.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif


    <table class="table table-stripped table-hover table-bordered mt-5">
        <thead>
            <th>Codigo</th>
            <th>Valor de compra</th>
            <th>Cod. Cliente</th>
            @if (Auth::guard('usuarios')->user()->variables(3)->editar==1)
            <th>Estado de envio</th>
            @endif
            <th>Fecha compra</th>
            <th>Metodo de Pago</th>
            @if (Auth::guard('usuarios')->user()->variables(3)->mostrar==1)
            <th>Detalles</th>
            @endif


        </thead>
        <tbody>
            @foreach($facturas as $factura)
            <tr>
                <td> {{$factura['id']}} </td>
                <td> {{$factura['total']}} </td>
                <td> {{$factura['cliente']}} </td>
                @if (Auth::guard('usuarios')->user()->variables(3)->editar==1)
                <td>
                    <form id="cambiarEstado" action="{{route('pedidos.update',$factura['id'])}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="col-md-6">
                            <select name="estadoenvio" onchange="cambiar()" class="form-control form-select-lg mb-3" aria-label=".form-select-lg example">
                                @foreach ($estadosEnvio as $estadoE)
                                @if($factura['estadoenvio'] == $estadoE->id)
                                <option value="{{$estadoE->id}}" selected> {{$estadoE->nombre}} </option>
                                @else
                                <option value="{{$estadoE->id}}"> {{$estadoE->nombre}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </form>
                </td>
                @endif
                <td> {{$factura['fecha']}}</td>

                <td>
                    <div class="col-md-6">
                        {{$factura['metodo']}}
                    </div>

                </td>
                @if (Auth::guard('usuarios')->user()->variables(3)->mostrar==1)
                <td>
                    <a href="{{route('pedidos.show',$factura['id'])}}" class="btn btn-success">
                        <img src="{{asset('img/icons/lupa.png')}}" style="width: 40px;">
                    </a>
                </td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>


    @endsection
    @section('js')
    <script>
        function cambiar(){
            confirm('¿Desea cambiar el esta de la compra?')
            document.getElementById('cambiarEstado').submit();
        }
    </script>
    @endsection