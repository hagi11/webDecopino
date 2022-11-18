@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-white" style="background-color: #b0b435; font-size: 0.5cm">{{ __('REGISTRO') }}</div>

                <div class="card-body" >
                    <form method="POST" action="{{ route('register') }}">
                        @csrf


                        <div class="row mb-3">
                            <label for="tidentificacion" class="col-md-4 col-form-label text-md-end">{{ __('Tipo de Identificacion') }}</label>

                            <div class="col-md-6">
                                <select  id="tidentificacion" name="tidentificacion" class="form-control form-select-lg mb-3" aria-label=".form-select-lg example">

                                    @foreach($identificaciones as $identificacion)
                                        <option value="{{$identificacion->id}}" {{$identificacion->nombre == "cedula" ? "selected" : "" }}> {{$identificacion->nombre}}</option>
                                    @endforeach
                                </select>

                                @error('tidentificacion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>                        


                        <div class="row mb-3">
                            <label for="identificacion" class="col-md-4 col-form-label text-md-end">{{ __('Identificacion') }}</label>

                            <div class="col-md-6">
                                <input id="identificacion" type="text" class="form-control @error('identificacion') is-invalid @enderror" name="identificacion" value="{{ old('identificacion') }}" required autocomplete="identificacion" autofocus>

                                @error('identificacion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="row mb-3">
                            <label for="nombre" class="col-md-4 col-form-label text-md-end">{{ __('Nombres') }}</label>

                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" required autocomplete="nombre" autofocus>

                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="apellido" class="col-md-4 col-form-label text-md-end">{{ __('Apellidos') }}</label>

                            <div class="col-md-6">
                                <input id="apellido" type="text" class="form-control @error('apellido') is-invalid @enderror" name="apellido" value="{{ old('apellido') }}" required autocomplete="apellido" autofocus>

                                @error('apellido')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="telefono" class="col-md-4 col-form-label text-md-end">{{ __('Telefono') }}</label>

                            <div class="col-md-6">
                                <input id="telefono" type="text" class="form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{ old('telefono') }}" required autocomplete="telefono" autofocus>

                                @error('telefono')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="direccion" class="col-md-4 col-form-label text-md-end">{{ __('Direccion') }}</label>

                            <div class="col-md-6">
                                <input id="direccion" type="text" class="form-control @error('direccion') is-invalid @enderror" name="direccion" value="{{ old('direccion') }}" required autocomplete="direccion" autofocus>

                                @error('direccion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>                        


                        <div class="row mb-3">
                            <label for="departamento" class="col-md-4 col-form-label text-md-end">{{ __('Seleccion Departamento') }}</label>

                            <div class="col-md-6">
                                <select id="departamento" name="departamento" class="form-control form-select-lg mb-3" aria-label=".form-select-lg example">

                                    @foreach($departamentos as $departamento)
                                        <option value="{{$departamento->id}}" {{$departamento->departamento == "VALLE DEL CAUCA" ? "selected" : "" }}> {{$departamento->departamento}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="ciudad" class="col-md-4 col-form-label text-md-end">{{ __('Seleccion Ciudad') }}</label>
                    
                            <div class="col-md-6">
                                <select  id="ciudad" name="ciudad" class="form-control form-select-lg mb-3" aria-label=".form-select-lg example">
                    
                                    @foreach($ciudades as $ciudad)
                                        <option value="{{$ciudad->id}}" {{$ciudad->ciudad == "Calí" ? "selected" : "" }}> {{$ciudad->ciudad}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="correo" class="col-md-4 col-form-label text-md-end">{{ __('Correo') }}</label>

                            <div class="col-md-6">
                                <input id="correo" type="email" class="form-control @error('correo') is-invalid @enderror" name="correo" value="{{ old('correo') }}" required autocomplete="correo">

                                @error('correo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="contrasenia" class="col-md-4 col-form-label text-md-end">{{ __('Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="contrasenia" type="password" class="form-control @error('contrasenia') is-invalid @enderror" name="contrasenia" required autocomplete="new-contrasenia">

                                @error('contrasenia')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="contrasenia-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirmar Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="contrasenia-confirm" type="password" class="form-control" name="contrasenia_confirmation" required autocomplete="new-contrasenia">
                            </div>
                        </div>


                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Registrarse') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('js')

<script>

$('#departamento').change(function(){
   let departamento = $('#departamento').val();

   $.ajax({
    type: "GET",
    url: "{{route('apidepa')}}",
    data: {
        depa : departamento,
      
    },
    success: function(res){
       console.log(res);
       $('#ciudad').empty();
       $.each(res,function(key,value){
        $('#ciudad').prepend("<option value='"+value['id']+"'>"+value['ciudad']+"</option>");
       });


    },

    });

});

$('#ciudad').change(function(){
       let ciudad = $('#ciudad').val();
    
       $.ajax({
        type: "GET",
        url: "{{route('apiciud')}}",
        data: {
            ciu : ciudad,
            id : 1
        },
        success: function(res){
           console.log(res);
        },
    
        });
    
    });



</script>

@endsection