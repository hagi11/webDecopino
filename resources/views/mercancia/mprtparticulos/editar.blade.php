@extends('layouts.app')

@section('content')

<div class="container-lg w-25 border p-4 mt-2 mb-2">
    <form action=" {{ route('mprtparticulos.update',$tparticulos->id) }}"  method="POST">
        @csrf
        @method('PUT')
        <br>
        <div class="col-lg-11">
            <label for="nombre" class="form-label">NOMBRE</label>
            <input type="text" name="nombre" class="form-control form-control-sm m-2" value="{{ old('nombre',$tparticulos->nombre) }}">
        </div>

        <div class="col-lg-11">
            <label for="estado" class="form-label">ESTADO</label>
            <input type="number" name="estado" class="form-control form-control-sm m-2" value="{{ old('estado',$tparticulos->estado) }}">
        </div>

        <div class="col-lg-11">
            <label for="factualizado" class="form-label">FECHA DE ACTUALZIACION</label>
            <input type="date" name="factualizado" class="form-control form-control-sm m-2" value="{{ old('factualizado',$tparticulos->factualizado) }}">
        </div>

        <div class="col-lg-11">
            <input type="submit" name="" class="btn btn-outline-success btn-sm m-2">
            <a href="{{ url('mprtparticulos')}}" class="btn btn-outline-danger btn-sm m-2">Cancelar</a>
        </div>

@endsection
