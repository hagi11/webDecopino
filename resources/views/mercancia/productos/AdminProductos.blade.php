@extends('layouts.appAdmin')

@section('content')
<h3>Productos</h3>

<a href=" {{route('productos.create')}}" class="btn btn-info" style="text-align:right">Agregar producto</a>
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
            <td>
              <a href=" {{route('adminVerProducto',$producto->id)}}" class="btn btn-info" style="text-align:right">ver</a>

            <form action=" {{route('productos.destroy',$producto->id)}}" method="POST">
            @csrf 
            @method('DELETE')   
            <button class="btn btn-info" style="text-align:right">eliminar</button>
            </form>
            </td>
        </tr>
            @endforeach

        </tbody>
      </table>

@endsection