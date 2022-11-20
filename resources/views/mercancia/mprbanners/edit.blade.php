@extends('layouts.appAdmin')

@section('content')

<h2 class="text-center mt-4 mb-3">Ediccion del banners</h2>
<hr>
<a href=" {{ url('mprbanners') }}" class="btn btn-info float-end btn-sm">Volver</a>

<br>
<img src="{{asset($banner->ruta)}}" style="width: 300px;">

<form action="{{ route('mprbanners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">

    @csrf
    @method('PUT')

    <div class="col-lg-4">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" name="nombre" class="form-control form-control-sm m-2" autofocus value="{{ old('nombre', $banner->nombre) }}">

    </div>

    <div class="col-lg-4">
        <label for="imagen" class="form-label">Cambiar imagen</label>
        <div class="form-group">
            <input type="file" name="imagen" id="" accept="image/*">
            <br>
            @error('file')

            <small class="text-danger">{{$message}}</small>

            @enderror
        </div>
    </div>

    <div class="col-lg-4">
        <label for="descripcion" class="form-label">Descripcion</label>
        <input type="text" name="descripcion" class="form-control form-control-sm m-2" value="{{ old('descripcion', $banner->descripcion) }}">
    </div>

    <div class="col-lg-4">
        <label for="mercancia" class="form-label">producto o combo</label>
        <select id="mercancia" name="mercancia" class="form-control form-control-sm m-2" value="{{ old('producto') }}">
            <option value="">None</option>
            @foreach($mercancias as $mercancia)
            @if($mercancia['tipo']==$elegido['tipo'] && $mercancia['id']==$elegido['id'])
            <option value="{{$mercancia['tipo'].$mercancia['id']}}" selected>{{$mercancia['nombre']}}</option>
            @else
            <option value="{{$mercancia['tipo'].$mercancia['id']}}">{{$mercancia['nombre']}}</option>
            @endif
            @endforeach

        </select>
    </div>


    <div class="col-lg-4">

        <input type="submit" name="" class="btn btn-success btn-sm m-2">
        <a href="{{ url('mprbanners') }}" class="btn btn-secondary btn-sm m-2">Cancelar</a>

    </div>
    </div>

    @stop