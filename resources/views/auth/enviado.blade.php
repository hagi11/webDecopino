@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h1>{{ __('Correo Enviado') }}</h1></div>

                <div class="card-body">
                    <p>Se ha enviado un correo a 
                        @if ($tipo == 'cliente')  
                            <p  style="color: blue">{{$correo}}</p>
                        @else
                            <p style="color: blue">{{$correo2}}</p>
                        @endif
                        ingrese a su correo y verifique el mensaje con sus nuevas credenciales, recuerde verificar en spam. <br> <br>
                        Este proceso puede tardar un poco si en 5 minutos no ha llegado ningun correo intentelo de nuevo, 
                        <a href="{{route('recuperarContraseña.index')}}" style="color: blue">Aqui</a> <br>
                        en caso de no recordar su correo ni contraseña pongase en contacto con la empresa encargada.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection