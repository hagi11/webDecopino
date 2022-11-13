<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Decoracion los pinos</title>

    <!-- ICONS -->
    @yield('css')
    
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="{{asset('css/stilo.css')}}">

    

</head>

<body>
    <input type="checkbox" id="nav-toggle">
    <div class="sidebar">
        <div class="sidebar-brand">
            <h2><img src="{{asset('img/LogoDeco2.png')}}" alt=""> <span>Decopino</span></h2>
            <div class="search-wrapper" id="searnat">
                <span class="las la-search" id="lupa"></span>
                <input type="search" placeholder="Busca Aqui">
            </div>
        </div>

        <div class="sidebar-menu" id="ocultar">
            <ul>
                <li class="active">
                    <a href="{{url('/homeAdmin')}}"> <span class="las la-igloo"></span>
                        <span>Inicio</span> </a>
                </li>
                <li class="active">
                    <a href="{{url('home')}}"> <span class="las la-users"></span>
                        <span>Tienda</span> </a>
                </li>
                <li class="active">
                    <a href="{{url('/adminCombo')}}"> <span class="las la-clipboard-list"></span>
                        <span>Combos</span> </a>
                </li>
                <li class="active">
                    <a href="{{url('/adminProducto')}}"> <span class="las la-clipboard-list"></span>
                        <span>Productos</span> </a>
                </li>
                <li class="active">
                    <a href="{{url('/adminArticulos')}}"> <span class="las la-clipboard-list"></span>
                        <span>Articulos</span> </a>
                </li>
                <li class="active">
                    <a href=""> <span class="las la-receipt"></span>
                        <span>Banner</span> </a>
                </li>
                <li class="active">
                    <a href=""> <span class="las la-user-circle"></span>
                        <span>Comentarios</span> </a>
                </li>

                <li class="active">
                    <a href=""> <span class="las la-clipboard-list"></span>
                        <span>Facturas</span> </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-content">
        <header>
            <h2>
                <label for="nav-toggle">
                    <span class="las la-bars" id="btn-menu"></span>
                </label>
                Dashboard
            </h2>

            <div id="heasearh">
            </div>
            <div class="user-wrapper">
                <img src="{{asset('img/banner-01.jpg')}}" width="30px" height="30px" alt="">
                <div>
                    @if(Auth::guard('usuarios'))
                    <h4>{{ Auth::guard('usuarios')->user()->cliente->apellido}}</h4>
                    @endif
                    <small>Administrador</small>
                    <br>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <small> {{ __('Salir') }}</small>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>

                </div>
            </div>
        </header>

        <div class="container-fluid">
            <main class="py-4">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    @yield('js')
</body>


</html>