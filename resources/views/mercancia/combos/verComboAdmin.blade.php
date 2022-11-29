@extends('layouts.appAdmin')

@section('content')


<div class="container">
    <h2>{{$combo->nombre}} ${{$combo->total}}</h2>
    <td colspan="1">
        <a href="{{route('indexAdmin')}}" class="btn btn-primary">volver</a>
        @if (Auth::guard('usuarios')->user()->variables(2)->editar==1)
        <a href="{{route('combo.edit',$combo->id)}}" class="btn btn-info">editar Combo</a>
        @endif
        <hr>
        <br>
        <h3>Imagenes</h3>
        <table class="table table-primary" id='imagenesCargadas'>
            <thead>
                <tr>
                    <th scope="col">Codigo</th>
                    <th scope="col">Ruta</th>
                    <th scope="col">Imagen</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($imagenes as $imagen)
                <tr>
                    <td>{{$imagen->id}}</td>
                    <td>{{$imagen->ruta}}</td>
                    <td><img src="{{asset($imagen->ruta)}}"> </td>
                </tr>
                @endforeach

            </tbody>

        </table>
        <br>

        <h3>Productos</h3>
        <table class="table table-primary">
            <thead>
                <tr>
                    <th scope="col">codigo</th>
                    <th scope="col">producto</th>
                    <th scope="col">valor</th>
                    <th scope="col">cantidad</th>
                    <th scope="col">existencia</th>
                    <th scope="col">detalle</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($comPros as $comPro)
                <tr>
                    <td>{{$comPro -> id}}</td>
                    <td>{{$comPro -> nombre}}</td>
                    <td>${{$comPro -> valor}}</td>
                    <td>{{$comPro -> cantidad}}</td>
                    <td>{{$comPro -> existencia}}</td>
                    <td>{{$comPro -> detalle}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <br>
        <h3>Articulos</h3>
        <table class="table table-primary">
            <thead>
                <tr>
                    <th scope="col">codigo</th>
                    <th scope="col">articulo</th>
                    <th scope="col">valor</th>
                    <th scope="col">cantidad</th>
                    <th scope="col">existencia</th>
                    <th scope="col">detalle</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($comArts as $comArt)
                <tr>
                    <td>{{$comArt -> id}}</td>
                    <td>{{$comArt -> nombre}}</td>
                    <td>${{$comArt -> precio}}</td>
                    <td>{{$comArt -> cantidad}}</td>
                    <td>{{$comArt -> existencia}}</td>
                    <td>{{$comArt -> descripcion}}</td>

                </tr>
                @endforeach
            </tbody>
        </table>

        <br>
        <h3>Comentarios</h3>
        <table class="table table-striped">
            <thead>
                <tr>

                    <th scope="col">Codigo</th>
                    <th scope="col">Comentario</th>
                    <th>Accion</th>
                </tr>
            </thead>
            <tbody>
                @foreach($comentarios as $comentario)
                <tr>
                    <td>{{$comentario->id}}</td>
                    <td>{{$comentario->comentario}}</td>
                    <td>
                        <form action="{{route('comentarios.destroy',$comentario->id)}}" method="post">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger" onclick="return confirm('¿Quiere eliminar este comentario?')">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>


</div>

@endsection