@extends('layouts.app')

@section('content')
<!-- Start Slider -->
<div id="slides-shop" class="cover-slides">
    <ul class="slides-container">

        @foreach($banners as $banner)
        <li class="text-center">
            <img src="{{asset($banner->ruta)}}" alt="">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="m-b-20"><strong>Bienvenido a <br> Decoraciones los pinos</strong></h1>
                        <p class="m-b-40"> {{$banner->nombre}}<br>{{$banner->descripcion}}</p>
                        @if ($banner->producto != null)
                        <p><a class="btn hvr-hover" href="{{route('productos.show',$banner->producto)}}">Ver</a></p>
                        @elseif ($banner->combo != null)
                        <p><a class="btn hvr-hover" href="{{route('combo.show',$banner->combo)}}">Ver</a></p>
                        @endif

                    </div>
                </div>
            </div>
        </li>
        @endforeach

    </ul>
    <div class="slides-navigation">
        <a href="#" class="next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
        <a href="#" class="prev"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
    </div>
</div>
<!-- End Slider -->



<!-- Start Categories  productos-->
<div class="categories-shop">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-xs-12">
                <div class="title-all text-center">
                    <h1>TIENDA</h1>

                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="shop-cat-box">
                    <img class="img-fluid" src="{{url('img/card_categoria/categories_img_02.jpg')}}">
                    <form id="tipoCom" action="{{route('tienda.store')}}" method="post">
                        @csrf
                        <input type="hidden" name="tipo" value="3">
                        <a class="btn hvr-hover" onclick="enviarForm(3)" style="color: white;">Combos</a>
                    </form>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="shop-cat-box">
                    <img class="img-fluid" src="{{url('img/card_categoria/categories_img_02.jpg')}}">
                    <form id="tipoPro" action="{{route('tienda.store')}}" method="post">
                        @csrf
                        <input type="hidden" name="tipo" value="1">
                        <a class="btn hvr-hover" onclick="enviarForm(1)" style="color: white;">Productos</a>
                    </form>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="shop-cat-box">
                    <img class="img-fluid" src="{{url('img/card_categoria/categories_img_02.jpg')}}" alt="" />
                    <form id="tipoArt" action="{{route('tienda.store')}}" method="post">
                        @csrf
                        <input type="hidden" name="tipo" value="2">
                        <a class="btn hvr-hover" onclick="enviarForm(2)" style="color: white;">Articulos</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Categories -->

<!-- Nuevos productos  -->
<div class="latest-blog">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="title-all text-center">
                    <h1>Ultimos productos añadidos</h1>
                </div> 
            </div>
        </div>
        <div class="row">
            @foreach ($productos as $producto)
            <div class="col-md-6 col-lg-4 col-xl-4">
                <div class="blog-box">
                    <div class="blog-img">
                        <center>
                            <img class="img-fluid" style="background-size:cover;" src="{{asset($producto['imagen'])}}" alt="{{$producto['nombre']}}" />
                        </center>
                    </div>
                    <div class="blog-content">
                        <div class="title-blog">
                            <h3>{{$producto['nombre']}}</h3>
                            <p>{{$producto['detalle']}}.</p>
                        </div>
                        <ul class="option-blog">
                            @php
                                $id = $producto['id'];
                            @endphp
                            <li><a href="{{route('productos.show',$producto['id'])}}"><i class="far fa-heart"></i></a></li>
                            <li onclick="fun('{{$id}}',2)" ><a style="color: white;"><i class="fas fa-eye"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>                
            @endforeach

        </div>
    </div>
</div>
<!-- End Nuevo  -->
@endsection
@section('js')
<script>
    function enviarForm(i){
        if(i==1){
            document.getElementById('tipoPro').submit();
        }
        if(i==2){
            document.getElementById('tipoArt').submit();
        }
        if(i==3){
            document.getElementById('tipoCom').submit();
        }
        
    }

    function fun(id, num) {
                if (num == 2) {
                    $.ajax({
                        type: 'post',
                        url: '{{ route("listaDeseos.store") }}',
                        data: {
                            producto: id,
                            '_token': $("meta[name='csrf-token']").attr("content"),
                        },

                        success: function(e) {
                            console.log(e);
                        }
                    });

                }
        
            }
        
            
</script>
@endsection
