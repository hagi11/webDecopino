@extends('layouts.app')

@section('content')

<a href="{{ url('home')}}" class="btn btn-outline-primary float-left btn-sm m-2">Volver</a>

<a href="mprmarcas/create" class="btn btn-outline-primary float-end btn-sm m-2">Nuevo</a>

<table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">NOMBRE</th>
        <th scope="col">ESTADO</th>
        <th scope="col">FECHA DE REGISTRO</th>
        <th scope="col">FECHA DE ACTUALZIACION</th>
        <th scope="col">EDITAR</th>
        <th scope="col">ELIMINAR</th>
      </tr>
    </thead>

    <tbody>
      @foreach($marcas as $marca)
      <tr>
          <td>
              {{$marca->id}}
          </td>
          <td>
              {{$marca->nombre}}
          </td>
          <td>
              {{$marca->estado}}
          </td>
          <td>
            {{$marca->fregistro}}
        </td>
        <td>
            {{$marca->factualizado}}
        </td>
        <td>
              <center><a href="{{ route('mprmarcas.edit', $marca->id) }}" class="btn btn-warning">
              <img src="{{url('imagenes/editar.png')}}" height="35" width="35">
              </a></center>
          </td>
          <td>
              <form action="{{ route('mprmarcas.destroy',$marca->id) }}" method="POST">
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
