@extends('layouts.appAdmin')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Su categoria</title>
</head>
<body>
@if (Auth::guard('usuarios')->user()->variables(2)->crear==1)
<tr><td><a class="btn btn-info" href="{{route('subCategoria.create')}}">Crear</a></td></tr>
@endif
<br><br>

<table >
   <thead>
    <tr>
        <!-- <th>ID</th> -->
        <th class="in">nombre</th>
        <th class="in">Categoria</th>
        <th class="in">Creado</th>
        <th class="in">Atualizado</th>
        <!-- <th>estado</th> -->
        <th class="in">Acciones</th>

    </tr>
   </thead>

   <tbody>
    @foreach($datos as $sucategorium)
    <tr>
        <!-- <td>{{$sucategorium->id}}</td> -->
        <td>{{$sucategorium->nombre}}</td>
        <!-- CATEGORIA -->
       @foreach($datos2 as $categoria)
       @if($sucategorium->categoria == $categoria->id )
       <td>{{$categoria->nombre}}</td> 
       @endif
       @endforeach
        <!-- END CATEGORIA -->
        <!-- <td>{{$sucategorium->estado}}</td> -->
        
      <td> {{substr($sucategorium->fregistro,0,10)}} </td>

            <td>{{substr($sucategorium->factualizado,0,10)}}</td>
     

        <td>
@if (Auth::guard('usuarios')->user()->variables(2)->editar==1)
            <button class="btn"><a href="{{route('subCategoria.edit',$sucategorium->id)}}">Editar</a></button>
        @endif
@if (Auth::guard('usuarios')->user()->variables(2)->eliminar==1)
            <form action="{{route('subCategoria.destroy',$sucategorium->id)}}" method="POST">
        @csrf  
        @method('DELETE')
        <button class="btn" onclick="return confirm('Desea Eliminar Esta categoria?')">Eliminar</button>
        </form>
    @endif
    </td>
    </tr>
    @endforeach
   </tbody>
</table>

</body>
</html>

@endsection