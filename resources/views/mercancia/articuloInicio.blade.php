@extends('layouts.appAdmin')

@section('content')

<button>
<a href="{{url('/adminArticulos')}}"> <span class="las la-clipboard-list"></span>
 <span>Articulos</span> </a>
</button>

<button><a href="{{url('/mprtparticulos')}}">Tipo de articulos</a></button>

<button><a href="{{url('/mprmarcas')}}">Marcas</a></button>


@endsection