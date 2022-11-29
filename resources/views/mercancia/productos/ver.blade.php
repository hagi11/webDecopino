@extends('layouts.app')

@section('content')


<!-- Start Shop Detail  -->
<div class="shop-detail-box-main">
  <div class="container">
    <div class="row">
      <div class="col-xl-5 col-lg-5 col-md-6">
        <div id="carousel-example-1" class="single-product-slider carousel slide" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
            <div class="carousel-item active"> <img class="d-block w-100" src="{{asset($imagenes[0]->ruta)}}" alt="$producto->nombre"> </div>
            @for ($i = 1; $i < sizeof($imagenes); $i++) <div class="carousel-item"> <img class="d-block w-100" src="{{asset($imagenes[$i]->ruta)}}" alt="$producto->nombre">
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
        <h2>{{$producto->nombre}}</h2>
        @if ($producto->descuento !=0)
        <h5> <del>$ {{$producto->precio}}</del>$ {{$producto->precio - ($producto->precio* $producto->descuento/100)}}</h5>
        @else
        <h5> $ {{$producto->precio}}</h5>
        @endif
        <p class="available-stock"><span> {{$producto->existencia}} unidades disponibles</span>
        <p>
        <h4>Descripción:</h4>
        <p>
          {{$producto->detalle}}. <br>
          Dimenciones: {{$producto->dimension}} Peso: {{$producto->peso}}. <br>
          Material: {{$producto->material}}. <br>
          Color: Este diseño se encuentra en {{$producto->color}}, el tipo de pintura es {{$producto->tipopintura}} y tiene un acabado en {{$producto->acabado}}. <br>
          Garantia: {{$producto->garantia}} <br>
        </p>

        <ul>
          <li>
            <div class="form-group quantity-box">
              <label class="control-label">Quantity</label>
              <input class="form-control" value="0" min="0" max="{{$producto->existencia}}" type="number">
            </div>
          </li>
        </ul> 

        <div class="price-box-bar">
          <div class="cart-and-bay-btn">
            <a class="btn hvr-hover" style="color: white ;" onclick="comprar('{{$producto->id}}')">Comprar</a>

            <a class="btn hvr-hover store" style="color: white;" onclick="enviarCarrito('{{$producto->id}}') ">Enviar al carrito</a>
            <a class="btn hvr-hover store" style="color: white;" onclick="fun('{{$producto->id}}')"><i class="far fa-heart"></i> Añadir a favoritos</a>
          </div>
        </div>


      </div>
    </div>
  </div>

  <br>
  <br>
  @if(Auth::user())
  <form method="POST" action="{{ route('comentarios.store') }}">
    @csrf
    <input type="hidden" name="producto" value="{{$producto->id}}">

    <input type="hidden" name="cliente" value="{{Auth::user()->id}}">


    <div class="col-md-12">
      <div class="form-group">
        <label for="comentario" class="col-md-4 col-form-label text-md-end">{{ __('Comentario') }}</label>
        <textarea class="form-control @error('comentario') is-invalid @enderror" id="comentario" name="comentario" placeholder="Escriba su comentario" rows="4"></textarea>
        @error ('comentario')
        <p><strong>{{$message}}</strong></p>
        @enderror 
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






  <div class="row my-5">
    <div class="col-lg-12">
      <div class="title-all text-center">
        <h1>Productos relacionados</h1>
      </div>
      <div class="featured-products-box owl-carousel owl-theme">
        @foreach ($relacionados as $relProducto)

        <div class="item">
          <div class="products-single fix">
            <div class="box-img-hover">
              <img src="{{asset($relImagenes[$relProducto->id]->ruta)}}" class="img-fluid" alt="Image">
              <div class="mask-icon">
                <ul>
                  <li><a href="{{route('productos.show',$relProducto->id)}}" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                  @if(Auth::user())
                  <li onclick="fun('{{$relProducto->id}}')"><a style="color: white;" data-toggle="tooltip" data-placement="right" title="Lista de deseos"><i class="far fa-heart"></i></a></li>
                  @endif
                </ul>
                <a class="cart store" onclick="enviarCarrito('{{$relProducto->id}}')">Enviar al carrito</a>

              </div>
            </div>
            <div class="why-text">
              <h4>{{$relProducto->nombre}}</h4>
              <h5>{{$relProducto->precio -($relProducto->precio*$relProducto->descuento/100)}}</h5>
            </div>
          </div>
        </div>


        @endforeach


      </div>
    </div>
  </div>
</div>
</div>
<!-- End Cart -->

@endsection

@section('js')
<script>
  $('.store').mouseenter(function() {
    $("body").css("cursor", "pointer");
  });

  $('.store').mouseleave(function() {
    $("body").css("cursor", "auto");
  });

  function fun(id) {
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

  function enviarCarrito(id) {

    $.ajax({
      type: 'post',
      url: '{{route("carrito.store")}}',
      data: {
        producto: id,
        '_token': $("meta[name='csrf-token']").attr("content"),
      },

      success: function(res) {
        ajustarCarrito();
      },

    });
  }

  function comprar(id) {
    $.ajax({
      type: 'post',
      url: '{{route("carrito.store")}}',
      data: {
        producto: id,
        '_token': $("meta[name='csrf-token']").attr("content"),
      },

      success: function(res) {
        ajustarCarrito();
        $(location).attr('href',"{{url('/carritoCliente',Auth::user()->id)}}");
      },

    });
}

</script>


@endsection