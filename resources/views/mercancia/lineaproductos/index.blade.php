@extends('layouts.appAdmin')

@section('content')

<a href=" {{route('lineaproducto.create')}}" class="btn btn-info" style="text-align:right">CREAR</a>
<br>
<br>
<br>

<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Codigo</th>
      <th scope="col">Nombre</th>
      <th scope="col">Creado</th>
      <th scope="col">Actulizado</th>
      <th colspan="2">Acciones</th>
    </tr>
  </thead>
  <tbody>
    @foreach($lineas as $linea)
    <tr>
      <td>{{$linea->id}}</td>
      <td>{{$linea->nombre}}</td>
      <td>{{substr($linea->fregistro,0,10)}}</td>
      <td>{{substr($linea->factualizado,0,10)}}</td>

      <td>
        @if (Auth::guard('usuarios')->user()->variables(2)->editar==1)
        <button>
          <a href=" {{route('lineaproducto.edit',$linea->id)}}" class="btn btn-info" style="text-align:right">editar</a>
        </button>
        @endif
        @if (Auth::guard('usuarios')->user()->variables(2)->eliminar==1)
        <form action=" {{route('lineaproducto.destroy',$linea->id)}}" method="POST">
          @csrf
          @method('DELETE')
          <button class="btn btn-info" style="text-align:right">eliminar</button>
        </form>
        @endif
      </td>
    </tr>
    @endforeach

  </tbody>
</table>

@endsection