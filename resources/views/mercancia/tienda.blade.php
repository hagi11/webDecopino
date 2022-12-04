@extends('layouts.app')

@section('content')

<!-- Start Shop Page  -->
<div class="shop-box-inner">
    <div class="container">
        <div class="row">
            <div class="col-xl-9 col-lg-9 col-sm-12 col-xs-12 shop-content-right">
                <div class="right-product-box">
                    <div class="product-item-filter row">
                        <div class="col-12 col-sm-8 text-center text-sm-left">
                            <div class="toolbar-sorter-right">
                                <form id="ordenar" action="{{route('tienda.store')}}" method="post">
                                    @csrf
                                    <span>Ordenar</span>
                                    <select name="orden" id="orden" onchange="ordenarPor()" class="selectpicker show-tick form-control" data-placeholder="$ USD">
                                        @if ($parametro == 1)
                                        <option value="1" selected>none</option>
                                        @else
                                        <option value="1">none</option>
                                        @endif
                                        @if ($parametro == 2)
                                        <option value="2" selected>Mas reciente</option>
                                        @else
                                        <option value="2">Mas Reciente</option>
                                        @endif
                                        @if ($parametro == 3)
                                        <option value="3" selected>Mas populares</option>
                                        @else
                                        <option value="3">Mas populares</option>
                                        @endif
                                        @if ($parametro == 4)
                                        <option value="4" selected>Mayor a menor precio</option>
                                        @else
                                        <option value="4">Mayor a menor precio</option>
                                        @endif
                                        @if ($parametro == 5)
                                        <option value="5" selected>Menor a mayor precio</option>
                                        @else
                                        <option value="5">Menor a mayor precio</option>
                                        @endif
                                        @if ($parametro == 6)
                                        <option value="6" selected>Mas vendidos</option>
                                        @else
                                        <option value="6">Mas vendidos</option>
                                        @endif
                                    </select>
                                    <div id="extra">

                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4 text-center text-sm-right">
                            <ul class="nav nav-tabs ml-auto">
                                <li>
                                    <a class="nav-link active" href="#grid-view" data-toggle="tab"> <i class="fa fa-th"></i> </a>
                                </li>
                                <li>
                                    <a class="nav-link" href="#list-view" data-toggle="tab"> <i class="fa fa-list-ul"></i> </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="product-categorie-box">
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade show active" id="grid-view">
                                <div class="row">
                                    @foreach ($mercancias as $mercancia)
                                    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                        <div class="products-single fix">
                                            <div class="box-img-hover">
                                                <img src="{{asset($mercancia['imagen'])}}" class="img-fluid rounded " alt="{{$mercancia['nombre']}}">
                                                <div class="mask-icon">
                                                    <ul>
                                                        @php
                                                        $id=$mercancia['id'];
                                                        @endphp

                                                        @if ($mercancia['tipo'] == "combo")
                                                        <li><a href="{{route('combo.show',$mercancia['id'])}}" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                                        @if(Auth::user())
                                                        <li onclick="fun('{{$id}}',1)"><a style="color: white;" data-toggle="tooltip" data-placement="right" title="Lista de deseos"><i class="far fa-heart"></i></a></li>
                                                        @endif
                                                        @elseif ($mercancia['tipo'] == "producto")
                                                        <li><a href="{{route('productos.show',$mercancia['id'])}}" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                                        @if(Auth::user())
                                                        <li onclick="fun('{{$id}}',2)"><a style="color: white;" data-toggle="tooltip" data-placement="right" title="Lista de deseos"><i class="far fa-heart"></i></a></li>
                                                        @endif
                                                        @else
                                                        <li><a href="{{route('mprarticulos.show',$mercancia['id'])}}" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                                        @if(Auth::user())
                                                        <li onclick="fun('{{$id}}',3)"><a style="color: white;" data-toggle="tooltip" data-placement="right" title="Lista de deseos"><i class="far fa-heart"></i></a></li>
                                                        @endif
                                                        @endif
                                                    </ul>
                                                    @if(Auth::user())
                                                    @if ($mercancia['tipo'] == "combo")
                                                    <a class="cart store" onclick="enviarCarrito('{{$id}}',1)">Enviar al carrito</a>
                                                    @elseif ($mercancia['tipo'] == "producto")
                                                    <a class="cart store" onclick="enviarCarrito('{{$id}}',2)">Enviar al carrito</a>
                                                    @else
                                                    <a class="cart store" onclick="enviarCarrito('{{$id}}',3)">Enviar al carrito</a>
                                                    @endif
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="why-text">
                                                <h4>{{$mercancia['nombre']}}</h4>
                                                <h5>${{$mercancia['precio']}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="list-view">
                                @foreach ($mercancias as $mercancia)
                                <div class="list-view-box">
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                            <div class="products-single fix">
                                                <div class="box-img-hover">
                                                    <div class="type-lb">
                                                        <p class="sale">Sale</p>
                                                    </div>
                                                    <img src="{{asset($mercancia['imagen'])}}" class="img-fluid" alt="{{$mercancia['nombre']}}">
                                                    <div class="mask-icon">
                                                        <ul>
                                                            @php
                                                            $id=$mercancia['id'];
                                                            @endphp

                                                            @if ($mercancia['tipo'] == "combo")
                                                            <li><a href="{{route('combo.show',$mercancia['id'])}}" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                                            @if(Auth::user())
                                                            <li onclick="fun('{{$id}}',1)"><a style="color: white;" data-toggle="tooltip" data-placement="right" title="Lista de deseos"><i class="far fa-heart"></i></a></li>
                                                            @endif
                                                            @elseif ($mercancia['tipo'] == "producto")
                                                            <li><a href="{{route('productos.show',$mercancia['id'])}}" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                                            @if(Auth::user())
                                                            <li onclick="fun('{{$id}}',2)"><a style="color: white;" data-toggle="tooltip" data-placement="right" title="Lista de deseos"><i class="far fa-heart"></i></a></li>
                                                            @endif
                                                            @else
                                                            <li><a href="{{route('mprarticulos.show',$mercancia['id'])}}" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                                            @if(Auth::user())
                                                            <li onclick="fun('{{$id}}',3)"><a style="color: white;" data-toggle="tooltip" data-placement="right" title="Lista de deseos"><i class="far fa-heart"></i></a></li>
                                                            @endif
                                                            @endif
                                                        </ul>
                                                        @if(Auth::user())
                                                        @if ($mercancia['tipo'] == "combo")
                                                        <a class="cart store" onclick="enviarCarrito('{{$id}}',1)">Enviar al carrito</a>
                                                        @elseif ($mercancia['tipo'] == "producto")
                                                        <a class="cart store" onclick="enviarCarrito('{{$id}}',2)">Enviar al carrito</a>
                                                        @else
                                                        <a class="cart store" onclick="enviarCarrito('{{$id}}',3)">Enviar al carrito</a>
                                                        @endif
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-lg-8 col-xl-8">
                                            <div class="why-text full-width">
                                                <h4>{{$mercancia['nombre']}}</h4>
                                                @if ($mercancia['descuento'] !=0)
                                                <h5><del>{{$mercancia['precio']}}</del>{{ $mercancia['precio'] - ($mercancia['precio'] * ($mercancia['descuento']/100))}}</h5>
                                                @else
                                                <h5>{{$mercancia['precio']}}</h5>
                                                @endif
                                                <p>{{$mercancia['descripcion']}}</p>
                                                @if(Auth::user())
                                                <a class="btn hvr-hover store" onclick="enviarCarrito('{{$id}}')">Enviar al carrito</a>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-sm-12 col-xs-12 sidebar-shop-left">
                <div class="product-categori">
                    <div class="search-product">
                        <input class="form-control" id="textFiltro" value="{{$texto}}" placeholder="Buscar..." type="text">
                        <button type="buttom" onclick="ordenarPor()"> <i class="fa fa-search"></i> </button>
                    </div>
                    <div class="filter-sidebar-left">
                        <div class="title-left">
                            <h3>Categories</h3>
                        </div>
                        <div class="list-group list-group-collapse list-group-sm list-group-tree" id="list-group-men" data-children=".sub-men">
                            @foreach ($categorias as $categoria)                                
                            <div class="list-group-collapse sub-men">
                                <a class="list-group-item list-group-item-action" href="#sub-men{{$categoria->id}}" data-toggle="collapse" aria-expanded="true" aria-controls="{{$categoria->id}}"> {{ $categoria->nombre}} </a>
                                <div class="collapse" id="sub-men{{$categoria->id}}" data-parent="#list-group-men">
                                    <div class="list-group">
                                        @foreach ($subCategorias[$categoria->id] as $subCategoria)
                                        @if ( $subCategoria->id == $cateSel)
                                        <a class="list-group-item list-group-item-action active mouse" >{{$subCategoria->nombre}} <small class="text-muted">({{$contSubCate[$subCategoria->id]}})</small></a>
                                        @else
                                        @if ($contSubCate[$subCategoria->id] > 0)
                                        <a onclick="cateCall('{{$subCategoria->id}}')" class="list-group-item list-group-item-action mouse" >{{$subCategoria->nombre}} <small class="text-muted">({{$contSubCate[$subCategoria->id]}})</small></a>  
                                        @else
                                        <a class="list-group-item list-group-item-action mouse" >{{$subCategoria->nombre}} <small class="text-muted">({{$contSubCate[$subCategoria->id]}})</small></a>  
                                        @endif
                                        @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <a class="list-group-item list-group-item-action mouse" onclick="cateCall('0')"> Todos </a>
                        </div>
                        <div class="title-left">
                            <h3>Lineas</h3>
                        </div>
                        <div class="list-group list-group-collapse list-group-sm list-group-tree" id="list-group-men" data-children=".sub-men">
                            <div class="list-group-collapse sub-men">
                                @foreach ($lineas as $linea)
                                @if ($linea->id == $lineaSel)
                                <a class="list-group-item list-group-item-action mouse"  style="color: #fbb714;" onclick="lineaCall('{{$linea->id}}')"> {{$linea->nombre}} <small class="text-muted">({{$numLinea[$linea->id]}})</small> </a>
                                @else
                                @if ($numLinea[$linea->id]>0)
                                <a class="list-group-item list-group-item-action mouse" onclick="lineaCall('{{$linea->id}}')"> {{$linea->nombre}} <small class="text-muted">({{$numLinea[$linea->id]}})</small> </a>
                                @else
                                <a class="list-group-item list-group-item-action mouse"> {{$linea->nombre}} <small class="text-muted">({{$numLinea[$linea->id]}})</small> </a>
                                @endif
                                @endif
                                @endforeach
                                <a class="list-group-item list-group-item-action mouse" onclick="lineaCall('0')"> Todos </a>
                            </div>
                        </div>
                        <div class="title-left">
                            <h3>Tipo</h3>
                        </div>
                        <div class="list-group list-group-collapse list-group-sm list-group-tree" id="list-group-men" data-children=".sub-men">
                            <div class="list-group-collapse sub-men">
                                @if($contPro >0)
                                    @if($checkPro == 1)
                                <a class="list-group-item list-group-item-action mouse" style="color: #fbb714;"> Productos <small class="text-muted">({{$contPro}})</small> </a>
                                @else
                                <a class="list-group-item list-group-item-action mouse" onclick="prodCall()"> Productos <small class="text-muted">({{$contPro}})</small> </a>
                                @endif
                                @endif

                                
                                @if($contArt >0)
                                @if($checkArt == 1)
                                <a class="list-group-item list-group-item-action mouse" style="color: #fbb714;"> Articulos <small class="text-muted">({{$contArt}})</small> </a>
                                @else
                                <a class="list-group-item list-group-item-action mouse" onclick="artiCall()"> Articulos <small class="text-muted">({{$contArt}})</small> </a>
                                @endif
                                @endif
                                
                                @if($contCom >0)
                                @if($checkCom == 1)
                                <a class="list-group-item list-group-item-action mouse" style="color: #fbb714;" > Combos <small class="text-muted">({{$contCom}})</small> </a>
                                @else
                                <a class="list-group-item list-group-item-action mouse" onclick="combCall()"> Combos <small class="text-muted">({{$contCom}})</small> </a>
                                @endif
                                @endif
                                
                                @if(($checkPro == 0) && ($checkArt == 0) && ($checkCom == 0))
                                <a class="list-group-item list-group-item-action mouse" style="color: #fbb714;"> Todos <small class="text-muted">({{$contCom+$contArt+$contPro}})</small> </a>
                                @else
                                <a class="list-group-item list-group-item-action mouse" onclick="todoCall()"> Todos <small class="text-muted">({{$contCom+$contArt+$contPro}})</small> </a>
                                @endif
                            </div>
                        </div>
                        <br>
                        <div class="filter-price-left">

                            <div class="title-left">
                                <h3>Price</h3>
                            </div>
                            <div>
                                <div class="price-box-slider">
                                  
                                        <label style="  margin-left: 22px; margin-right: 3px;" for="minPrecio">min </label> <input style="width:100px; color:black; font-weight:bold;" id="minPrecio" type="number"> <br>
                                        <label style="  margin-left: 22px" for="maxPrecio">max</label> <input style="width:100px; color:black; font-weight:bold;" id="maxPrecio" type="number"> <br>
                                  
                                    <br>
                                    <button class="btn hvr-hover float-righ" onclick="ordenarPor()" type="submit">Filter</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- End Shop Page -->



        @endsection

        @section('js')
        <script src="{{asset('js/jquery-ui.js')}}"></script>
        <script src="{{asset('js/jquery.nicescroll.min.js')}}"></script>
        <script>
            var tipo =  0;
            var linea =  0;
            var cate =  0;

            $('.mouse').mouseenter(function() {
                $("body").css("cursor", "pointer");
            });

            $('.mouse').mouseleave(function() {
                $("body").css("cursor", "auto");
            });

            function prodCall(){
                tipo = 1;
                ordenarPor();
            }

            function artiCall(){
                tipo = 2;
                ordenarPor();
            }

            function combCall(){
                tipo = 3;
                ordenarPor();
            }
            function todoCall(){
                tipo =0;
                ordenarPor();
            }

            function lineaCall(id){
                linea = id;
                ordenarPor();
            }

            function cateCall(id){
                cate = id;
                ordenarPor();
            }

            


            function ordenarPor() {
                var text = $('#textFiltro').val();
                var minimo = $('#minPrecio').val();
                var maximo = $('#maxPrecio').val();

                $('#extra div').remove();
                add = '<div><input type="hidden" name="texto" value="' + text + '"/></div>';
                max = '<div><input type="hidden" name="precioMin" value="' + minimo + '"/></div>';
                min = '<div><input type="hidden" name="precioMax" value="' + maximo + '"/></div>';
                tipo = '<div><input type="hidden" name="tipo" value="' + tipo + '"/></div>';
                linea = '<div><input type="hidden" name="linea" value="' + linea + '"/></div>';
                cate = '<div><input type="hidden" name="cate" value="' + cate + '"/></div>';
                
                $('#extra').append(add);
                $('#extra').append(max);
                $('#extra').append(min);
                $('#extra').append(tipo);
                $('#extra').append(linea);
                $('#extra').append(cate);

                document.getElementById('ordenar').submit();
            }

            $('.store').mouseenter(function() {
                $("body").css("cursor", "pointer");
            });

            $('.store').mouseleave(function() {
                $("body").css("cursor", "auto");
            });

            function enviarCarrito(id, num) {
                if (num == 1) {
                    $.ajax({
                        type: 'post',
                        url: '{{route("carrito.store")}}',
                        data: {
                            combo: id,
                            '_token': $("meta[name='csrf-token']").attr("content"),
                        },

                        success: function(res) {
                            ajustarCarrito();
                            console.log(res);
                        },

                    });
                }
                if (num == 2) {
                    $.ajax({
                        type: 'post',
                        url: '{{route("carrito.store")}}',
                        data: {
                            producto: id,
                            '_token': $("meta[name='csrf-token']").attr("content"),
                        },

                        success: function(res) {
                            ajustarCarrito();
                            console.log(res);
                        },

                    });
                }
                if (num == 3) {
                    $.ajax({
                        type: 'post',
                        url: '{{route("carrito.store")}}',
                        data: {
                            articulo: id,
                            '_token': $("meta[name='csrf-token']").attr("content"),
                        },

                        success: function(res) {
                            ajustarCarrito();
                            console.log(res);
                        },

                    });

                }
            }

            function fun(id, num) {
                if (num == 1) {
                    $.ajax({
                        type: 'post',
                        url: '{{ route("listaDeseos.store") }}',
                        data: {
                            combo: id,
                            '_token': $("meta[name='csrf-token']").attr("content"),
                        },

                        complete: function(e) {
                            console.log(e);
                        }
                    });
                }
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
                if (num == 3) {
                    $.ajax({
                        type: 'post',
                        url: '{{ route("listaDeseos.store") }}',
                        data: {
                            articulo: id,
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