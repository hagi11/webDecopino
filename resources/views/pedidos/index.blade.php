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
            <th>ID</th>
            <th>TOTAL</th>
            <th>CLIENTE</th>
            <th>ESTADOENVIO</th>
            <th>ESTADO</th>
            <th>FREGISTRO</th>
            <th>FACTUALIZADO</th>
            <th>METODODEPAGO</th>
            <th>EDITAR</th>
            <th>ELIMINAR</th>

        </thead>
        <tbody>
            @foreach($pedidos as $pedido)
            <tr>
                <td>
                    {{$pedido->id}}

                </td>
                
                <td>
                    {{$pedido->total}}

                </td>
                <td>
                    {{$pedido->cliente}}

                </td>
                <td>
                    {{$pedido->estadoenvio}}
                </td>

                <td>
                    {{$pedido->estado}}

                </td>

                <td>
                    {{$pedido->fregistro}}

                </td>

                <td>
                    {{$pedido->factualizado}}

                </td>

                <td>
                    {{$pedido->metodo_pago}}

                </td>

                
                   

                
                <td>
                   <a href="{{ route ('pedidos.edit',$pedido->id) }}"
                   class="btn btn-success">
                    
                    <img src="{{url('img/img2.png')}}" width="30">
                   </a>

                </td>
                
                <td>
                    <form action="{{ route ('pedidos.destroy',$pedido->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" onclick="return confirm('¿Quiere eliminar este registro?')">
                            <img src="{{url('img/img4.png')}}" width="30">
                        </button>

                    </form>
                 </td>
            </tr>
            @endforeach
        </tbody>
    </table>


@endsection
