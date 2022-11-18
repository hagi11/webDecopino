@extends('layouts.appAdmin')

@section('content')

<a href="mprmarcas/create" class="btn btn-outline-primary float-end btn-sm m-2">Nuevo</a>

<table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">Codigo</th>
        <th scope="col">Nombre</th>
        <th scope="col">Fecha de creacion</th>
        <th scope="col">Editar</th>
        <th scope="col">Eliminar</th>
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
            {{$marca->fregistro}}
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
