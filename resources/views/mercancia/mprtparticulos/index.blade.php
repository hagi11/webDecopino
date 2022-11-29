@extends('layouts.appAdmin')

@section('content')

<a href="{{ url('home')}}" class="btn btn-outline-primary float-left btn-sm m-2">Volver</a>

<a href="mprtparticulos/create" class="btn btn-outline-primary float-end btn-sm m-2">Nuevo</a>

<table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">NOMBRE</th>
        <th>Creado</th>
        <th>Actulizado</th>
        <th scope="col">Acciones</th>
      </tr>
    </thead>

    <tbody>
      @foreach($tparticulos as $tparticulo)
      <tr>
          <td>
              {{$tparticulo->id}}
          </td>
          <td>
              {{$tparticulo->nombre}}
          </td>
          <td> {{substr($tparticulo->fregistro,0,10)}} </td>
      <td>{{substr($tparticulo->factualizado,0,10)}}</td>

        <td>
          @if (Auth::guard('usuarios')->user()->variables(2)->editar==1)
          <button>
            <a href="{{ route('mprtparticulos.edit', $tparticulo->id) }}" class="btn btn-warning">
              <img src="{{asset('img/icons/edit.png')}}" height="35" width="35">
            </a>
          </button>
          @endif
          @if (Auth::guard('usuarios')->user()->variables(2)->eliminar==1)
          <form action="{{ route('mprtparticulos.destroy', $tparticulo->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" onclick="return confirm('¿Quiere Eliminar este registro?')">
              <img src="{{asset('img/icons/delete.png')}}" height="35" width="35">
            </button>
          </form>
          @endif
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
@endsection
