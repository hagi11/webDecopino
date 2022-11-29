@extends('layouts.appAdmin')

@section('content')
<h3>Productos</h3>
@if (Auth::guard('usuarios')->user()->variables(2)->crear==1)
<a href=" {{route('productos.create')}}" class="btn btn-info" style="text-align:right">Agregar producto</a>
@endif
<hr>
<br>
<br>

<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">nombre</th>
      <th scope="col">precio</th>
      <th scope="col">iva</th>
      <th scope="col">descuento</th>
      <th scope="col">existencia</th>
      <th scope="col">detalle</th>
      <th scope="col">vista</th>
      <th scope="col">compra</th>
      <th scope="col">creado</th>
      <th scope="col">actualizado</th>
      <th colspan="2">acciones</th>
    </tr>
  </thead>
  <tbody>
    @foreach($productos as $producto)
    <tr>
      <td>{{$producto->id}}</td>
      <td>{{$producto->nombre}}</td>
      <td>{{$producto->precio}}</td>
      <td>{{$producto->iva}}</td>
      <td>{{$producto->descuento}}</td>
      <td>{{$producto->existencia}}</td>
      <td>{{$producto->detalle}}</td>
      <td>{{$producto->vista}}</td>
      <td>{{$producto->compra}}</td>
      <td> {{substr($producto->fregistro,0,10)}} </td>
      <td>{{substr($producto->factualizado,0,10)}}</td>
      <td>
        @if (Auth::guard('usuarios')->user()->variables(2)->ver==1)
        <button><a href=" {{route('adminVerProducto',$producto->id)}}" class="btn btn-info" style="text-align:right">ver</a></button>
        @endif
        @if (Auth::guard('usuarios')->user()->variables(2)->editar==1)
        <button><a href=" {{route('productos.edit',$producto->id)}}" class="btn btn-info" style="text-align:right">editar</a></button>
        @endif
        @if (Auth::guard('usuarios')->user()->variables(2)->eliminar==1)
        <form action=" {{route('productos.destroy',$producto->id)}} " method="POST">
          @csrf
          @method('DELETE')
          <button class="btn btn-info" style="text-align:right" onclick="return confirm('¿Quiere Eliminar este registro?')">eliminar</button>
        </form>
        @endif
      </td>
    </tr>
    @endforeach

  </tbody>
</table>

@endsection