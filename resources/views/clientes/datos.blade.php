@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Scrpt -->
    <title>Document</title>
    <style>
        #ocul{
            display: none;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>{{ __('Mi Cuenta:') }}</h1>
                    <div class="card-body">

                        <form action="{{route('cuenta.update',Auth::user()->cliente->id)}}" method="post">
                            @csrf
                            @method('PUT')
                           
                            <div class="row mb-3">
                                <label for="tidentificacion" class="col-md-4 col-form-label text-md-end">{{ __('Tip identificacion: ') }}</label>
    
                                <div class="col-md-6">
                                    <select  id="tidentificacion"  name="tidentificacion" class="form-control form-select-lg mb-3" aria-label=".form-select-lg example" onchange="mostrar()">
    
                                        @foreach($identificaciones as $identificacion)
                                            <option value="{{$identificacion->id}}" {{$identificacion->nombre == "cedula" ? "selected" : "" }}> {{$identificacion->nombre}}</option>
                                        @endforeach
                                    </select>
    
                                    {{-- @error('tidentificacion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror --}}
                                </div>
    
                                <div class="row mb-3">
                                    <label for="indentificacion" class="col-md-4 col-form-label text-md-end">{{ __('Identificacion: ') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="identificacion" type="text" class="form-control @error('identificacion') is-invalid @enderror" name="identificacion" value="{{ $datos2->identificacion}}" required autocomplete="identificacion" autofocus onchange="mostrar()">
        
                                        @error('identificacion')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
    
                                <div class="row mb-3">
                                    <label for="Nombre" class="col-md-4 col-form-label text-md-end">{{ __('Nombre: ') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="Nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ $datos2->nombre }}" required autocomplete="nombre" autofocus onchange="mostrar()">
        
                                        @error('Nombre')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
    
                                <div class="row mb-3">
                                    <label for="apellido" class="col-md-4 col-form-label text-md-end">{{ __('Apellido: ') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="apellido" type="text" class="form-control @error('apellido') is-invalid @enderror" name="apellido" value="{{ $datos2->apellido }}" required autocomplete="apellido" autofocus onchange="mostrar()">
        
                                        @error('apellido')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="correo" class="col-md-4 col-form-label text-md-end">{{ __('Correo: ') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="correo" disabled type="email" class="form-control @error('correo') is-invalid @enderror" name="correo" value="{{ $datos2->correo }}" required autocomplete="correo" autofocus onchange="mostrar()">
        
                                        @error('correo')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                
    
    
                                <div class="row mb-3">
                                    <label for="telefono" class="col-md-4 col-form-label text-md-end">{{ __('Telefono: ') }}</label>
        
                                    <div class="col-md-6">
                                        <input  id="telefono" type="text" class="form-control @error('telefono') is-invalid @enderror" id="cl" name="telefono" value="{{ $datos2->telefono}}" required autocomplete="telefono" autofocus onchange="mostrar()">
        
                                        @error('telefono')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
    
                                <div class="row mb-3">
                                    <label for="direcion" class="col-md-4 col-form-label text-md-end">{{ __('Direccion: ') }}</label>
        
                                    <div class="col-md-6">
                                        <input  id="direccion" type="text" class="form-control @error('direccion') is-invalid @enderror" name="direccion" value="{{ $datos2->direccion}}" required autocomplete="direccion" autofocus onchange="mostrar()">
        
                                        @error('direccion')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
    
    
    
                                <div class="row mb-3">
                                    <label for="ciudad" class="col-md-4 col-form-label text-md-end">{{ __('Seleccion Ciudad') }}</label>
                            
                                    <div class="col-md-6">
                                        <select   id="ciudad" name="ciudad" class="form-control form-select-lg mb-3" aria-label=".form-select-lg example" onchange="mostrar()">
                            
                                            @foreach($ciudades as $ciudad)
                                                <option value="{{$ciudad->id}}" {{$ciudad->ciudad == "Calí" ? "selected" : "" }}> {{$ciudad->ciudad}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                
    
                            </div>
                        <button type="submit" class="btn btn-primary" id="ocul" >Editar</button>
                        <hr>
                            
                        </form>
                        <button class="btn btn-danger">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="cli">
        <h1>Mañana No Hay Clases</h1>
        
    </div>
    <button id="cl">hols</button>
</div>
<script  src="{{asset('js/cuentaDatos.js')}}"> 
</script>
</body>

</html>
@endsection