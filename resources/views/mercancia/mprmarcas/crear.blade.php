@extends('layouts.appAdmin')

@section('content')

<div class="container-lg w-25 border p-4 mt-2 mb-2">
    <form action=" {{ route('mprmarcas.store') }}"  method="POST">
        @csrf
        <br>
        <div class="col-lg-11">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control form-control-sm m-2" value="{{ old('nombre') }}">
        </div>

        <div class="col-lg-11">
            <input type="submit" name="" class="btn btn-outline-success btn-sm m-2">
            <a href="{{ url('mprmarcas')}}" class="btn btn-outline-danger btn-sm m-2">Cancelar</a>
        </div>


@endsection
