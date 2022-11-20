@extends('layouts.appAdmin')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<tr><td><a class="btn btn-info" href="{{route('categoria.create')}}">Crear</a></td></tr>
<br><br>

<table class="tbl">
   <thead>
    <tr>
        <!-- <th>ID</th> -->
        <th class="in">nombre</th>
        <!-- <th class="in">estado</th> -->
        <th class="in">Editar</th>
        <th class="in">Eliminar</th>
        <th>agregado</th>
        <th>actulizado</th>
    </tr>
   </thead>

   <tbody>
    @foreach($datos as $categorium)
    <tr>
        <!-- <td>{{$categorium->id}}</td> -->
        <td>{{$categorium->nombre}}</td>
        <!-- <td>{{$categorium->estado}}</td> -->
        <td><button class="btn"><a href="{{route('categoria.edit',$categorium->id)}}">Editar</a></button></td>
        <td><form action="{{route('categoria.destroy',$categorium->id)}}" method="POST">
        @csrf  
        @method('DELETE')
        <button class="btn" onclick="return confirm('Desea Eliminar Esta categoria?')">Eliminar</button>
        </form></td>

        <td>{{substr($categorium->fregistro,0,10)}}</td>
        <td>{{substr($categorium->factualizado,0,10)}}</td>

    </tr>
    @endforeach
   </tbody>
</table>

</body>
</html>

@endsection