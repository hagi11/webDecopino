@extends('layouts.appAdmin')

@section('content')

<button>
<a href="{{url('/adminProducto')}}"> <span class="las la-clipboard-list"></span>
                        <span>Productos</span> </a>
</button>

<button><a href="{{url('/categoria')}}"> Categorias</a></button>

<button><a href="{{url('/subCategoria')}}"> subCategorias</a></button>

<button><a href="{{url('/lineaproducto')}}">Linea de productos</a></button>



@endsection