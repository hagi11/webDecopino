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
    <form action="{{url('categoria')}}" method="POST">
    @csrf
    <label for="nombre">Categoria</label>
    <input type="text" name="nombre"  value="{{old('nombre')}}" autofocus><br><br>

    
    <input type="hidden" name="estado" value="1"><br>
    
    <input type="submit" value="Crear">
    <tr><td><a class="btn btn-info" href="{{url('categoria')}}">Cancelar</a></td></tr>
    </form>

</div>

</body>
</html>

@endsection