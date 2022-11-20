@extends('layouts.app')

@section('content')

<div class="shop-detail-box-main">
    <div class="container">
        <div class="row">
            <div class="col-xl-5 col-lg-5 col-md-6">
                <div id="carousel-example-1" class="single-product-slider carousel slide" data-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active"> <img class="d-block w-100" src="{{asset($imagenes[0]->ruta)}}" alt="$combo->nombre"> </div>
                        @for ($i = 1; $i < sizeof($imagenes); $i++) <div class="carousel-item"> <img class="d-block w-100" src="{{asset($imagenes[$i]->ruta)}}" alt="$articulo->nombre">
                    </div>
                    @endfor
                </div>
                <a class="carousel-control-prev" href="#carousel-example-1" role="button" data-slide="prev">
                    <i class="fa fa-angle-left" aria-hidden="true"></i>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carousel-example-1" role="button" data-slide="next">
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                    <span class="sr-only">Next</span>
                </a>
                <br>
                <ol class="carousel-indicators">
                    @foreach ($imagenes as $imagen)
                    <li data-target="#carousel-example-1" data-slide-to="0" class="active">
                        <img class="d-block w-100 img-fluid" src="{{asset($imagen->ruta)}}" alt="" />
                    </li>
                    @endforeach
                </ol>
            </div>
        </div>
        <div class="col-xl-7 col-lg-7 col-md-6">
            <div class="single-product-details">
                <h2>{{$combo->nombre}}</h2>
                <h5> <del>${{$combo->total}}</del>${{$combo->total - ($combo->total * $combo->descuento)/100}}</h5>
                <h4>Descripción:</h4>
                <p>
                    {{$nombre}}. <br>
                </p>
                <ul>
                    <li>
                        <div class="form-group quantity-box">
                            <label class="control-label">Quantity</label>
                            <input class="form-control" value="0" min="0" max="20" type="number">
                        </div>
                    </li>
                </ul>

                <div class="price-box-bar">
                    <div class="cart-and-bay-btn">
                        <a class="btn hvr-hover" href="#">Comprar</a>
                        <a class="btn hvr-hover" href="#">Añadir al carrito</a>
                        <a class="btn hvr-hover" href="#"><i class="far fa-heart"></i> Añadir a favoritos</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>
    <br>



    <!-- Start Shop Detail  -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-6">
            <div class="single-product-details">
                <h2>Elementos del combo</h2>
            </div>
        </div>
    </div>
    <div class="shop-detail-box-main">
        <div class="container">
            <div role="tabpanel" class="tab-pane fade show active" id="grid-view">
                <div class="row">
                    @foreach ($comPros as $comPro)
                    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                        <div class="products-single fix">
                            <div class="box-img-hover">
                                <div class="type-lb">
                                    <p class="new">New</p>
                                </div>

                                <img src="{{asset($comProImgs[$comPro->id]->ruta)}}" class="img-fluid rounded " alt="{{$comPro -> nombre}}">
                                <div class="mask-icon">
                                    <ul>
                                        <li><a href="{{route('productos.show',$comPro->id)}}" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                        <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                                    </ul>
                                    <a class="cart" href="#">Add to Cart</a>
                                </div>
                            </div>
                            <div class="why-text">
                                <h4>{{$comPro -> nombre}} / {{$comPro -> cantidad}}</h4>
                                <h5>{{$comPro -> precio - ($comPro->precio * $comPro->descuento /100)}}</h5>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @foreach ($comArts as $comArt)
                    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                        <div class="products-single fix">
                            <div class="box-img-hover">
                                <div class="type-lb">
                                    <p class="new">New</p>
                                </div>
                                <img src="{{asset($comArtImgs[$comArt->id]->ruta)}}" class="img-fluid rounded " alt="{{$comArt -> nombre}}">
                                <div class="mask-icon">
                                    <ul>
                                        <li><a href="{{route('mprarticulos.show',$comArt->articulo)}}" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                        <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                                    </ul>
                                    <a class="cart" href="#">Add to Cart</a>
                                </div>
                            </div>
                            <div class="why-text">
                                <h4>{{$comArt -> nombre}} / {{$comArt -> cantidad}}</h4>
                                <h5>{{$comArt -> precio}}</h5>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <br>
  <br>
  @if(Auth::user())
  <form method="POST" action="{{ route('comentarios.store') }}">
    @csrf
    <input type="hidden" name="combo" value="{{$combo->id}}">

   
    <input type="hidden" name="cliente" value="{{Auth::user()->id}}">


    <div class="col-md-12">
      <div class="form-group">
        <label for="comentario" class="col-md-4 col-form-label text-md-end">{{ __('Comentario') }}</label>
        <textarea class="form-control" id="comentario" name="comentario" placeholder="Escriba su comentario" rows="4"></textarea>
        <div class="help-block with-errors"></div>
        <div class="submit-button text-center">
          <br>
          <button class="btn hvr-hover" id="submit" type="submit">Enviar Comentario</button>
          <div id="msgSubmit" class="h3 text-center hidden"></div>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </form>
  @endif

  <div class="card-header">
    <h2>COMENTARIOS</h2>
  </div>

  <div class="card-body">
    @foreach ($comentarios as $comentario)
    <div class="media mb-3">

      <div class="media-body">
        <p>{{$comentario->comentario}}</p>
        <small class="text-muted">{{$comentario->fregistro}}</small>
      </div>
      <div>
        <div class="form-group">
          @if(Auth::guard('usuarios')->user())
          <form action="{{route('comentarios.destroy',$comentario->id)}}" method="post">
            @method('DELETE')
            @csrf
            <button class="btn btn-danger" onclick="return confirm('¿Quiere eliminar este comentario?')">
              Eliminar
            </button>
          </form>
          @elseif(Auth::user())

          @if($comentario->clientes == Auth::user()->id)
          <form action="{{route('comentarios.destroy',$comentario->id)}}" method="post">
            @method('DELETE')
            @csrf
            <button class="btn btn-danger" onclick="return confirm('¿Quiere eliminar este comentario?')">
              Eliminar
            </button>
          </form>
          @endif
          @endif
        </div>
      </div>
    </div>
    <hr>
    @endforeach
  </div>




    @endsection