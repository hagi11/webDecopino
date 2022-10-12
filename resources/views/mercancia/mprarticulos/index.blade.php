@extends('layouts.app')

@section('content')

<a href="{{ url('home')}}" class="btn btn-outline-primary float-left btn-sm m-2">Volver</a>

<a href="mprarticulos/create" class="btn btn-outline-primary float-end btn-sm m-2">Nuevo</a>

<table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">NOMBRE</th>
        <th scope="col">DESCRIPTION</th>
        <th scope="col">IMAGEN</th>
        <th scope="col">PRECIO</th>
        <th scope="col">EXISTENCIA</th>
        <th scope="col">MARCA</th>
        <th scope="col">TIPO DE ARTICULO</th>
        <th scope="col">ESTADO</th>
        <th scope="col">FECHA DE REGISTRO</th>
        <th scope="col">FECHA DE ACTUALZIACION</th>
        <th scope="col">CARRITO</th>
        <th scope="col">DETALLE</th>
        <th scope="col">EDITAR</th>
        <th scope="col">ELIMINAR</th>
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
              {{$articulo->imagen}}
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
          <td>
              {{$articulo->estado == "1" ? "ACTIVO" : "INACTIVO"}}
          </td>
          <td>
            {{$articulo->fregistro}}
        </td>
        <td>
            {{$articulo->factualizado}}
        </td>
        <td>
            <center><a href="{{ route('carrito', $articulo->id) }}"  class="btn btn-info">
            <img src="{{url('imagenes/carrito.png')}}" height="35" width="35">
            </a></center>
        </td>
        <td>
            <center><a href="{{ route('mprarticulos.show', $articulo->id) }}"  class="btn btn-success">
            <img src="{{url('imagenes/detalle.png')}}" height="35" width="35">
            </a></center>
        </td>
        <td>
              <center><a href="{{ route('mprarticulos.edit', $articulo->id) }}" class="btn btn-warning">
              <img src="{{url('imagenes/editar.png')}}" height="35" width="35">
              </a></center>
          </td>
          <td>
              <form action="{{ route('mprarticulos.destroy',$articulo->id) }}" method="POST">
              @csrf
              @method('DELETE')
              <center><button class="btn btn-danger" onclick="return confirm('¿Quiere Eliminar este registro?')">
              <img src="{{url('imagenes/eliminar.png')}}" height="35" width="35">
              </button></center>
              </form>
          </td>
      </tr>
      @endforeach
    </tbody>
  </table>
@endsection
