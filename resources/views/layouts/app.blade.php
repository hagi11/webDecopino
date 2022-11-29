<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ 'Decoraciones los Pinos' }}</title>

    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!-- Site CSS -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">



</head>

<body>
    <div id="app">
        <!-- Start Main Top -->
        <div class="main-top">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="our-link">
                            <ul>
                                <li><a href="{{route('cuenta.index')}}"><i class="fa fa-user s_color"></i> My Account</a></li>
                                <li><a href="#"><i class="fas fa-location-arrow"></i> Our location</a></li>
                                <li><a href="#"><i class="fas fa-headset"></i> Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="login-box">
                            <!-- Authentication Links -->
                            <div class="our-link">
                                <ul>


                                    @if(Auth::guard('usuarios')->user() || Auth::user())
                                    <li class="dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            @if(Auth::guard('usuarios')->user() )
                                            {{ Auth::guard('usuarios')->user()->cliente->apellido}}
                                            @elseif(Auth::user())
                                            {{ Auth::user()->cliente->apellido}}
                                            @endif
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <li>
                                                <a class="dropdown-item" style="color: black;" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                    {{ __('Logout') }}
                                                </a>

                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                    @csrf
                                                </form>
                                            </li>
                                        </ul>
                                    </li>


                                    @else
                                    <li><a class="nav-link" href="{{ route('register') }}">{{ __('Registrarse') }}</a></li>
                                    <li><a class="nav-link" href="{{ route('login') }}">{{ __('Ingresar') }}</a></li>
                                    @endif

                                    @if(Auth::guard('usuarios')->user())

                                    <li><a class="nav-link" href="{{ route('homeAdmin')}}">Dashboard</a></li>
                                    @endif


                                </ul>
                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Main Top -->


        <header class="main-header">

            <!-- Start Navigation -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-default bootsnav">
                <div class="container">
                    <!-- Start Header Navigation -->
                    <div class="navbar-header">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="fa fa-bars"></i>
                        </button>
                        <a class="navbar-brand" href="{{ url('/home') }}"><img style="width:70%;" src="{{asset('img/LogoDeco2.png')}}" class="logo" alt=""></a>
                    </div>
                    <!-- End Header Navigation -->

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="navbar-menu">
                        <ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">
                            <li class="nav-item active"><a class="nav-link" href="{{ url('/home') }}">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ url('/nosotros') }}">Sobre nosostros</a></li>
                            <li class="dropdown">
                                <a href="#" class="nav-link" data-toggle="dropdown">Tienda</a>
                                <ul class="dropdown-menu">
                                    <li><a href="shop.html">Todo</a></li>
                                    @if(Auth::user())
                                    <li><a href="{{url('/carritoCliente',Auth::user()->id)}}">Carrito</a></li>
                                    @endif

                                    <li><a href="#">Mi cuenta</a></li>
                                    @if(Auth::user())
                                    <li><a href="{{url('/listaDeseosCliente',Auth::user()->id)}}">Lista de deseos</a></li>
                                    @endif
                                </ul>
                            </li>

                            <li class="nav-item"><a class="nav-link" href="{{ url('/contactenos') }}">Contactenos</a></li>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->

                    <!-- Start Atribute Navigation aquie aquie aquei aquie-->
                    @if(Auth::user())
                    <div class="attr-nav">
                        <ul>
                            <li class="search"><a href="#"><i class="fa fa-search"></i></a></li>
                            <li class="side-menu">
                                <a href="#">
                                    <i class="fa fa-shopping-bag"></i>
                                    <span class="badge"></span>
                                    <p>Carrito </p>
                                </a>
                            </li>
                        </ul>
                    </div>
                    @endif
                    <!-- End Atribute Navigation -->
                </div>
                <!-- Start Side Menu -->
                @if(Auth::user())
                <div class="side">
                    <a href="#" class="close-side"><i class="fa fa-times"></i></a>
                    <li class="cart-box">
                        <ul class="cart-list" id="lista">

                        </ul>
                        <ul class="cart-list">
                            <li class="total">
                                <a href="{{url('/carritoCliente',Auth::user()->id)}}" class="btn btn-default hvr-hover btn-cart">Ver Carrito</a>
                                <span class="float-right"><strong>Total</strong><span id="valTotal">: $0.00</span></span>
                            </li>
                        </ul>
                    </li>
                </div>
                @endif
                <!-- End Side Menu -->
            </nav>
            <!-- End Navigation -->
        </header>
        <!-- Start Top Search -->
        <div class="top-search">
            <div class="container">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                    <input type="text" class="form-control" placeholder="Search">
                    <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
                </div>
            </div>
        </div>
        <!-- End Top Search -->




        <main class="py-4">
            @yield('content')
        </main>
    </div>


 <!-- Start Footer  -->
 <footer>
        <div class="footer-main">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="footer-top-box">
                            <h3>Horarios De Atencion</h3>
                            <ul class="list-time">
                                <li>  Lunes - Viernes :  9 : 00 AM - 5 : 30 PM</li>
                                <li> Sabado : 9 : 00 AM - 12 : 00 PM</span></li>
                                <li>Domingo: <span>Cerrado</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="footer-link">
                            <h4>Información</h4>
                            <ul class="list-time">
                                <li><a href="{{ url('/nosotros') }}">Sobre Nosotros </a></li>
                                <li><a href="{{ url('/contactenos') }}">Servicio al Cliente</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="footer-top-box">
                            <h3>Redes Sociales</h3>
                            <p>Encuentranos en :</p>
                            <ul >
                                <li><a href="https://es-la.facebook.com/WWW.decorpinos.wix.co"><i class="fab fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="https://www.instagram.com/accounts/login/?next=%2Fdecorpinos%2F&source=omni_redirect"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
                                <li><a href="https://www.whatsapp.com/catalog/573006620195/?app_absent=0"><i class="fab fa-whatsapp" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                 
                <hr>
                <div class="row">
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="footer-widget">
                            <h4>Acerca de Decoraciones Los Pinos</h4>
                            <p>Decoraciones los pinos fue fundada el 22 de marzo del año 2001 
                                su nombre inicial fue Arte Y Diseño Los Pinos hasta el año 2013,
                                luego pasó a ser razon social como Decoracion Los Pinos.
                               </p>
                            <p> Actualmente contamos con diseños propios, estilos personalizados y 
                                variedad de articulos fabricados en pino chileno de alta calidad
                                con 5 años de garantia. </p>
                        </div>
                    </div>
                
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="footer-link-contact">
                            <h4>Contactos</h4>
                            <ul>
                                <li>
                                    <p><i class="fas fa-map-marker-alt"></i>Dirección : 
                                        calle 10 No 15- 62, barrio Bretaña, Santiago de Cali, Colombia .
                                </li>
                                <li>
                                    <p><i class="fas fa-phone-square"></i>Teléfono: +57-300 6620195</p>
                                </li>
                                <li>
                                    <p><i class="fas fa-envelope"></i>Email: decorpinos@outlook.es</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer  -->

    <!-- Start copyright  -->
    <div class="footer-copyright">
        <p class="footer-company">Derechos reservados . &copy; 2022 Diseñado por:
    ADSI200</a>
        </p>
    </div>
    <!-- End copyright  -->




    <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>

    <script src="{{asset('js/jquery.superslides.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-select.js')}}"></script>
    <script src="{{asset('js/inewsticker.js')}}"></script>
    <script src="{{asset('js/bootsnav.js')}}"></script>
    <script src="{{asset('js/images-loded.min.js')}}"></script>
    <script src="{{asset('js/isotope.min.js')}}"></script>
    <script src="{{asset('js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('js/baguetteBox.min.js')}}"></script>
    <script src="{{asset('js/form-validator.min.js')}}"></script>
    <script src="{{asset('js/contact-form-script.js')}}"></script>
    <script src="{{asset('js/custom.js')}}"></script>

    <script>
        ajustarCarrito();



        function ajustarCarrito() {
            
            
            var url = '{{route("carrito.show",0)}}';

            $.ajax({
                type: 'get',
                url: url,

                success: function(res) {
                    $("#lista li").remove();
                    if(res != 0){
                    $('.badge').text(res['num']);
                    ajustarLista(res['mercancia']);
                    } 
                },

            });

        }

        function ajustarLista(dato) {
            let valTotal = 0;
            for (var i = 0; i < dato.length; i++) {
                valTotal = valTotal + (dato[i]['precio'] * dato[i]['cantidad']);
                let show = "";
                if (dato[i]['tipo'] == 'combo') {
                    show = "{{route('combo.show',1)}}";
                    show = show.replace('1', dato[i]['id']);
                }
                if (dato[i]['tipo'] == 'producto') {
                    show = "{{route('productos.show',1)}}";
                    show = show.replace('1', dato[i]['id']);
                }
                if (dato[i]['tipo'] == 'articulo') {
                    show = "{{route('mprarticulos.show',1)}}";
                    show = show.replace('1', dato[i]['id']);
                }

                let code = '<li><a href="' + show + '" class="photo"><img src="{{asset("imagen")}}" class="cart-thumb" alt="" /></a> <h6><a href="' + show + '">' + dato[i]['nombre'] + ' </a></h6><p>' + dato[i]['cantidad'] + 'x - <span class="price">$ ' + dato[i]['precio'] * dato[i]['cantidad'] + '</span></p></li>';
                code = code.replace('imagen', dato[i]['ruta']);

                $("#lista").append(code);

            }
            $('#valTotal').text(': $' + valTotal);

        }
    </script>
    @yield('js')

</body>

</html>