@extends('layouts.appAdmin')

@section('content')

<h3>Articulos</h3>
@if (Auth::guard('usuarios')->user()->variables(2)->crear==1)
<a href="mprarticulos/create" class="btn btn-outline-primary float-end btn-sm m-2">Agregar articulo</a>
@endif
<hr>
<br>
<br>
<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">codigo</th>
            <th scope="col">nombre</th>
            <th scope="col">descripcion</th>
            <th scope="col">precio</th>
            <th scope="col">existencia</th>
            <th scope="col">marca</th>
            <th scope="col">tipo de articulo</th>
            <th>Creado</th>
            <th>Actulizar</th>
            <th scope="col">Acciones</th>

        </tr>
    </thead>

    <tbody>
        @foreach($articulos as $articulo)
        <tr>
            <td>
                {{$articulo->id}}
            </td>
            <td>
                {{$articulo->nombre}}
            </td>
            <td>
                {{$articulo->descripcion}}
            </td>
            <td>
                {{$articulo->precio}}
            </td>
            <td>
                {{$articulo->existencia}}
            </td>
            <td>
                {{$articulo->marca}}
            </td>
            <td>
                {{$articulo->tipoarticulo}}
            </td>
            <td>{{substr($articulo->fregistro,0,10)}}</td>
        <td>{{substr($articulo->factualizado,0,10)}}</td>
            <td>

                <center>
                    @if (Auth::guard('usuarios')->user()->variables(2)->mostrar==1)
                    <button>
                        <a href="{{ route('adminVerArtidulo', $articulo->id) }}" class="btn btn-warning">
                            ver
                        </a>
                    </button>
                    @endif
                    @if (Auth::guard('usuarios')->user()->variables(2)->editar==1)
                    <button><a href=" {{ route('mprarticulos.edit', $articulo->id)}}" class="btn btn-info" style="text-align:right">editar</a></button>
                    @endif

                    @if (Auth::guard('usuarios')->user()->variables(2)->eliminar==1)
                    <form action="{{ route('mprarticulos.destroy',$articulo->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" onclick="return confirm('¿Quiere Eliminar este registro?')">
                            eliminar
                        </button>
                    </form>
                    @endif
                </center>
            </td>
            
        </tr>
        @endforeach
    </tbody>
</table>
@endsection