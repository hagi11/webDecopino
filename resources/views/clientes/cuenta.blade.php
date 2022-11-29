@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h1>{{ __('Mi Cuenta: ') }}</h1>
                <div class="card-body">
                    <a href="{{route('misdatos', Auth::user()->cliente->id)}}"><h2>Mis Datos</h2></a>
                </div>
                <div class="card-body">
                    <a href="{{route('factura.index')}}"><h2>Mis Compras</h2></a>
                </div>
                
                </div>   
            </div>
        </div>
    </div>
</div>
@endsection