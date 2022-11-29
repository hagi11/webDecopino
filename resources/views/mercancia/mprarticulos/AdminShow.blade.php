@extends('layouts.appAdmin')

@section('content')

<button><a href=" {{route('adminArticulos')}}" class="btn btn-info" style="text-align:right">volver</a></button>
@if (Auth::guard('usuarios')->user()->variables(2)->editar==1)
<button><a href=" {{ route('mprarticulos.edit', $articulos->id)}}" class="btn btn-info" style="text-align:right">editar</a></button>
@endif

<br>
<br>
<h3>Informacion general</h3>
<table class="table table-striped">
  <thead>
    <tr>
      <th>
        categoria
      </th>
      <th>
        valor
      </th>
      <th></th>

    </tr>

  </thead>
  <tbody>
    <tr>
      <th scope="col">Codigo</th>
      <td>{{$articulos->id}}</td>
    </tr>
    <tr>
      <th scope="col">nombre</th>
      <td>{{$articulos->nombre}}</td>
    </tr>
    <tr>
      <th scope="col">precio</th>
      <td>{{$articulos->precio}}</td>

    </tr>
    <tr>
      <th scope="col">existencia</th>
      <td>{{$articulos->existencia}}</td>

    </tr>
    <tr>
      <th scope="col">descripcion</th>
      <td>{{$articulos->descripcion}}</td>
    </tr>
    <tr>
      <th scope="col">vista</th>
      <td>{{$articulos->vista}}</td>

    </tr>
    <tr>
      <th scope="col">compra</th>
      <td>{{$articulos->compra}}</td>
    </tr>
  </tbody>
</table>
<br>
<h3>Imagenes</h3>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">codigo</th>
      <th scope="col">ruta</th>
      <th scope="col">imagen</th>
    </tr>
  </thead>
  <tbody>
    @foreach($imagenes as $imagen)
    <tr>
      <td>{{$imagen->id}}</td>
      <td>{{$imagen->ruta}}</td>
      <td><img src="{{asset($imagen->ruta)}}"> </td>
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
      <th scope="col">Acción</th>
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
@endsection