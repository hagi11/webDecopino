@extends('layouts.appAdmin')

@section('content')


<div class="container">
    <h2>{{$combo->nombre}} ${{$combo->total}}</h2>
    <td colspan="1">
        <a href="{{route('indexAdmin')}}" class="btn btn-primary">volver</a>
        <a href="{{route('combo.edit',$combo->id)}}" class="btn btn-info">editar Combo</a>
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
<th></th>
    </tr>
  </thead>
  <tbody>
    @foreach($comentarios as $comentario)
    <tr>
      <td>{{$comentario->id}}</td>
      <td>{{$comentario->comentario}}</td>
      <td></td>
    </tr>
    @endforeach
  </tbody>
</table>


</div>

@endsection