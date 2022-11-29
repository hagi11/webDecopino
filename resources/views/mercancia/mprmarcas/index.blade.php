@extends('layouts.appAdmin')

@section('content')

<a href="mprmarcas/create" class="btn btn-outline-primary float-end btn-sm m-2">Nuevo</a>

<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">Codigo</th>
      <th scope="col">Nombre</th>
      <th scope="col">Creado</th>
      <th scope="col">Actualizado</th>
      <th scope="col">Acciones</th>

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
      <td> {{substr($marca->fregistro,0,10)}} </td>
      <td>{{substr($marca->factualizado,0,10)}}</td>
      <td>
      @if (Auth::guard('usuarios')->user()->variables(2)->editar==1)
      <button>      <a href="{{ route('mprmarcas.edit', $marca->id) }}" class="btn btn-warning">
        <img src="{{asset('img/icons/edit.png')}}" height="35" width="35">
      </a>
      </button>

      @endif
      @if (Auth::guard('usuarios')->user()->variables(2)->eliminar==1)
      <form action="{{ route('mprmarcas.destroy',$marca->id) }}" method="POST">
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