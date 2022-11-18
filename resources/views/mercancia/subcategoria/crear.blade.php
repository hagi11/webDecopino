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

<div class="form">
    <form action="{{url('subCategoria')}}" method="POST">
    @csrf
    <label for="nombre">Sub Categoria</label>
    <input type="text" name="nombre"  value="{{old('nombre')}}" autofocus><br><br>
    <label for="categoria">Categoria</label>
    <select name="categoria" value="{{old('categoria')}}" id="">
    <option value="">Seleccione el Categoria...</option>
        
        @foreach($datos2 as $categoria)
        <option value="{{$categoria->id}}">{{$categoria->nombre}}  </option>
        @endforeach
    </select>
    
    <input type="hidden" name="estado" value="1"><br>
    
    <input type="submit" value="Crear">
    <tr><td><a class="btn btn-info" href="{{url('subCategoria')}}">Cancelar</a></td></tr>
    </form>

</div>

</body>
</html>

@endsection