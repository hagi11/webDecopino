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
                    <h1>CATEGORIAS</h1>

                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="shop-cat-box">
                    <img class="img-fluid" src="{{url('img/card_categoria/categories_img_02.jpg')}}">
                    <a class="btn hvr-hover" href="{{route('combo.index')}}">Combos</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="shop-cat-box">
                    <img class="img-fluid" src="{{url('img/card_categoria/categories_img_02.jpg')}}">
                    <a class="btn hvr-hover" href="{{route('productos.index')}}">Productos</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="shop-cat-box">
                    <img class="img-fluid" src="{{url('img/card_categoria/categories_img_02.jpg')}}" alt="" />
                    <a class="btn hvr-hover" href="{{route('mprarticulos.index')}}">Articulos</a>
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
                    <h1>Nuevos Productos</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-4 col-xl-4">
                <div class="blog-box">
                    <div class="blog-img">
                        <img class="img-fluid" src="{{asset('img/blog-img-01.jpg')}}" alt="" />
                    </div>
                    <div class="blog-content">
                        <div class="title-blog">
                            <h3>Fusce in augue non nisi fringilla</h3>
                            <p>Nulla ut urna egestas, porta libero id, suscipit orci. Quisque in lectus sit amet urna dignissim feugiat. Mauris molestie egestas pharetra. Ut finibus cursus nunc sed mollis. Praesent laoreet lacinia elit id lobortis.</p>
                        </div>
                        <ul class="option-blog">
                            <li><a href="#"><i class="far fa-heart"></i></a></li>
                            <li><a href="#"><i class="fas fa-eye"></i></a></li>
                            <li><a href="#"><i class="far fa-comments"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 col-xl-4">
                <div class="blog-box">
                    <div class="blog-img">
                        <img class="img-fluid" src="{{asset('img/blog-img-02.jpg')}}" alt="" />
                    </div>
                    <div class="blog-content">
                        <div class="title-blog">
                            <h3>Fusce in augue non nisi fringilla</h3>
                            <p>Nulla ut urna egestas, porta libero id, suscipit orci. Quisque in lectus sit amet urna dignissim feugiat. Mauris molestie egestas pharetra. Ut finibus cursus nunc sed mollis. Praesent laoreet lacinia elit id lobortis.</p>
                        </div>
                        <ul class="option-blog">
                            <li><a href="#"><i class="far fa-heart"></i></a></li>
                            <li><a href="#"><i class="fas fa-eye"></i></a></li>
                            <li><a href="#"><i class="far fa-comments"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 col-xl-4">
                <div class="blog-box">
                    <div class="blog-img">
                        <img class="img-fluid" src="{{asset('img/blog-img-03.jpg')}}" alt="" />
                    </div>
                    <div class="blog-content">
                        <div class="title-blog">
                            <h3>Fusce in augue non nisi fringilla</h3>
                            <p>Nulla ut urna egestas, porta libero id, suscipit orci. Quisque in lectus sit amet urna dignissim feugiat. Mauris molestie egestas pharetra. Ut finibus cursus nunc sed mollis. Praesent laoreet lacinia elit id lobortis.</p>
                        </div>
                        <ul class="option-blog">
                            <li><a href="#"><i class="far fa-heart"></i></a></li>
                            <li><a href="#"><i class="fas fa-eye"></i></a></li>
                            <li><a href="#"><i class="far fa-comments"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Nuevo  -->





@endsection