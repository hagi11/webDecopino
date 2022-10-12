@extends('layouts.app')

@section('content')

<div class="container-lg w-25 border p-4 mt-2 mb-2">
    <form action=" {{ route('mprarticulos.update',$articulos->id) }}"  method="POST">
        @csrf
        @method('PUT')
        <br>
        <div class="col-lg-11">
            <label for="nombre" class="form-label">NOMBRE</label>
            <input type="text" name="nombre" class="form-control form-control-sm m-2" value="{{ old('nombre',$articulos->nombre) }}">
        </div>

        <div class="col-lg-11">
            <label for="descripcion" class="form-label">DESCRIPTION</label>
            <input type="text" name="descripcion" class="form-control form-control-sm m-2" value="{{ old('descripcion',$articulos->descripcion) }}">
        </div>

        <div class="col-lg-11">
            <label for="imagen" class="form-label">IMAGEN</label>
            <input type="text" name="imagen" class="form-control form-control-sm m-2" value="{{ old('imagen',$articulos->imagen) }}">
        </div>

        <div class="col-lg-11">
            <label for="precio" class="form-label">PRECIO</label>
            <input type="number" name="precio" class="form-control form-control-sm m-2" value="{{ old('precio',$articulos->precio) }}">
        </div>

        <div class="col-lg-11">
            <label for="existencia" class="form-label">EXISTENCIA</label>
            <input type="number" name="existencia" class="form-control form-control-sm m-2" value="{{ old('existencia',$articulos->existencia) }}">
        </div>

        <div class="col-lg-8">
            <label for="marca" class="form-label">MARCA</label><br>
            <select name="marca" name="marca" class="form-control form-control-sm m-2">
                <option value="">Seleccione Marca Del Producto</option>
                    @foreach ($tmarticulos as $marca)
                        @if($marca->id == $articulos->marca)
                            <option value=" {{ $marca->id }}" selected>{{ $marca->nombre }}</option>
                        @else
                            <option value=" {{ $marca->id }}">{{ $marca->nombre }}</option>
                        @endif
                    @endforeach
            </select>
        </div>

        <div class="col-lg-11">
            <label for="tipoarticulo" class="form-label">TYPE/ARTICLE</label><br>
            <select name="tipoarticulo" name="tipoarticulo" class="form-control form-control-sm m-2">
                <option value="">Seleccione Tipo De Articulo Del Producto</option>
                @foreach ($tparticulos as $tparticulos)
                        @if($tparticulos->id == $tparticulos->tparticulos)
                            <option value=" {{ $tparticulos->id }}" selected>{{ $tparticulos->nombre }}</option>
                        @else
                            <option value=" {{ $tparticulos->id }}">{{ $tparticulos->nombre }}</option>
                        @endif
                    @endforeach
            </select>
        </div>

        <div class="col-lg-11">
            <label for="estado" class="form-label">ESTADO</label>
            <input type="number" name="estado" class="form-control form-control-sm m-2" value="{{ old('estado',$articulos->estado) }}">
        </div>

        <div class="col-lg-11">
            <label for="factualizado" class="form-label">FECHA DE ACTUALZIACION</label>
            <input type="date" name="factualizado" class="form-control form-control-sm m-2" value="{{ old('factualizado',$articulos->factualizado) }}">
        </div>

        <div class="col-lg-11">
            <input type="submit" name="" class="btn btn-outline-success btn-sm m-2">
            <a href="{{ url('mprarticulos')}}" class="btn btn-outline-danger btn-sm m-2">Cancelar</a>
        </div>

@endsection
