@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-white" style="background-color: #b0b435; font-size: 0.5cm">{{ __('INICIAR SESION') }}</div>

                <div class="card-body">
                    {{-- <form method="POST" action="{{ route('login') }}"> --}}
                        <form method="POST" action="{{ route('micontrolador') }}">
                            @csrf

                            <div class="row mb-3">

                                <label for="login" class="col-md-4 col-form-label text-md-end">{{ __('Correo / Email')
                                    }}</label>

                                <div class="col-md-6">
                                    <input id="login" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="login"
                                        value="{{ old('login') }}" required autocomplete="login" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="contrasenia" class="col-md-4 col-form-label text-md-end">{{
                                    __('Contraseña') }}</label>

                                <div class="col-md-6">
                                    <input id="contrasenia" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-contrasenia">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-success">
                                        {{ __('Ingresar') }}
                                    </button>
                                    <a class="btn btn-primary" style="margin-left: 10%" href="{{route('login_gmail')}}">
                                        <img src="{{asset('img/icons/logo-google.png')}}" alt=""
                                            style="width: 30px; height: 30px;">
                                        Ingresar con Google
                                    </a>





                                   
                                    <a class="btn btn-link" href="{{ route('recuperarContraseña.index') }}">
                                        {{ __('¿Olvidaste tu contraseña o correo?') }}
                                    </a>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection