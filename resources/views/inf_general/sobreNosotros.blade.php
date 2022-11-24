@extends('layouts.app')

@section('content') 

    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>ABOUT US</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
                        <li class="breadcrumb-item active">ABOUT US</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start About Page  -->
    <div class="about-box-main">
        <div class="container">
            <div class="row">
				<div class="col-lg-6">
                    <div class="banner-frame"> <img class="img-fluid" src="{{asset('img/icons/grove-summer.jpg')}}" alt="" />
                    </div>
                </div>
                <div class="col-lg-6">
                    <h3 class="noo-sh-title-top">Decoraciones los pinos</h3>
                    <p>Decoraciones los pinos fue fundada el 22 de marzo del año 2001 
                        su nombre inicial fue Arte Y Diseño Los Pinos hasta el año 2013,
                        luego pasó a ser razon social como Decoracion Los Pinos.
                        </p>
                    <p>Actualmente contamos con diseños propios, estilos personalizados y 
                        variedad de articulos fabricados en pino chileno de alta calidad
                        con 5 años de garantia.</p>
					
                </div>
            </div>
   
        <br>
        </div>
    </div>
    <!-- End About Page -->

    @endsection