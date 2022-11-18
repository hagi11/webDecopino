@extends('layouts.appAdmin')

@section('content')
  

<div class="card-body">
  <form method="POST" action="{{ route('lineaproducto.update', $linea->id) }}">
      @csrf
      @method('PUT')

      <div class="row mb-3">
          <label for="nombre" class="col-md-4 col-form-label text-md-end">{{ __('Nombre de la Linea') }}</label>

          <div class="col-md-6">
              <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre', $linea->nombre) }}" required autocomplete="nombre" autofocus>

              @error('nombre')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
          </div>
      </div>

      
      <div class="row mb-0">
        
          <div class="col-md-6 offset-md-4">
            <a href=" {{route('lineaproducto.index')}}" class="btn btn-danger" style="text-align:right">Volver</a></td>
              <button type="submit" class="btn btn-primary">
                  {{ __('Crear') }}
              </button>
          </div>
      </div>
  </form>
</div>

    

@stop