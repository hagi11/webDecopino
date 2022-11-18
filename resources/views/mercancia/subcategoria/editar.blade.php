@extends('layouts.appAdmin')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hola</title>
</head>
<body>

<div class="form">
    <form action="{{route('subCategoria.update',$sucategorium->id)}}" method="POST">
    @csrf
    @method('PUT')
    <label for="nombre">Sub Categoria</label>
    <input type="text" name="nombre"  value="{{old('nombre',$sucategorium->nombre)}}" autofocus><br><br>
    <label for="categoria">Categoria</label>
    <select name="categoria"  id="">
            @foreach($datos2 as $categoria)
            @if($sucategorium->categoria == $categoria->id)
            <option value="{{$categoria->id}}"  selected>{{$categoria->nombre}}</option>
            @else
            <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
            @endif
            @endforeach
    </select>
    
    <input type="hidden" name="estado" value="1"><br>
    
    <input type="submit" value="Editar">
    <tr><td><a class="btn btn-info" href="{{url('subCategoria')}}">Cancelar</a></td></tr>
    </form>

</div>

</body>
</html>

@endsection