@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tienda</div>

                <div class="border-end bg-white" id="sidebar-wrapper">
                    <div class="list-group list-group-flush">
                        <!-- <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{url('/combos')}}">Combos</a> -->
                        <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{route('combo.index')}}">Combos</a>
                        <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{url('/productos')}}">Productos</a>
                        <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{url('/articulos')}}">Articulos</a>
                    </div>
                </div>



            </div>
        </div>
    </div>
</div>
@endsection