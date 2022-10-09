@extends('layouts.app')

@section('content')

<a href=" {{route('lineaproducto.create')}}" class="btn btn-info" style="text-align:right">CREAR</a>
    <br>
    <br>
    <br>

    <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">nombre</th>
            <th scope="col">estado</th>
            <th colspan="2">ACCIONES</th>
          </tr>
        </thead>
        <tbody>
            @foreach($lineas as $linea)
        <tr>
            <td>{{$linea->id}}</td>
            <td>{{$linea->nombre}}</td>
            <td>{{$linea->estado == "1" ? "activo" : "inactivo"}}</td>
            <td><a href=" {{route('lineaproducto.edit',$linea->id)}}" class="btn btn-info" style="text-align:right">editar</a></td>
            <td>
            <form action=" {{route('lineaproducto.destroy',$linea->id)}}" method="POST">
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