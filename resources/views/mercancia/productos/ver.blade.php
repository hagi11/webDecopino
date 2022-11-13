@extends('layouts.app')

@section('content')
  
<table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">nombre</th>
            <th scope="col">precio</th>
            <th scope="col">iva</th>
            <th scope="col">descuento</th>
            <th scope="col">existencia</th>
            <th scope="col">estilo</th>
            <th scope="col">dimension</th>
            <th scope="col">peso</th>
            <th scope="col">material</th>
            <th scope="col">color</th>
            <th scope="col">tipo pintura</th>
            <th scope="col">acabado</th>
            <th scope="col">imagen</th>
            <th scope="col">detalle</th>
            <th scope="col">vista</th>
            <th scope="col">compra</th>
            <th scope="col">garantia</th>
            <th scope="col">proveedor</th>
            <th scope="col">linea</th>
            <th scope="col">categoria</th>
            <th scope="col">estado</th>
            
          </tr>
        </thead>
        <tbody>
            
        <tr>
            <td>{{$producto->id}}</td>
            <td>{{$producto->nombre}}</td>
            <td>{{$producto->precio}}</td>
            <td>{{$producto->iva}}</td>
            <td>{{$producto->descuento}}</td>
            <td>{{$producto->existencia}}</td>
            <td>{{$producto->estilo}}</td>
            <td>{{$producto->dimension}}</td>
            <td>{{$producto->peso}}</td>
            <td>{{$producto->material}}</td>
            <td>{{$producto->color}}</td>
            <td>{{$producto->tipopintura}}</td>
            <td>{{$producto->Acabado}}</td>
            <td>{{$producto->imagen}}</td>
            <td>{{$producto->detalle}}</td>
            <td>{{$producto->vista}}</td>
            <td>{{$producto->compra}}</td>
            <td>{{$producto->garantia}}</td>
            <td>{{$producto->Proveedor}}</td>
            <td>{{$producto->linea}}</td>
            <td>{{$producto->categoria}}</td>
            <td>{{$producto->estado == "1" ? "activo" : "inactivo"}}</td>
            </tr>




            <!-- <div class="card-body">
      <form method="POST" action="{{ route('comentarios.store') }}">
      @csrf
          <input type= "hidden" name= "producto" value ="{{$producto->id}}"> 
        <div class="row mb-3">
          <label for="comentario" class="col-md-4 col-form-label text-md-end">{{ __('Comentario') }}</label>

            <div class="col-md-6">
              <input id="comentario" type="text" class="form-control @error('comentario') is-invalid @enderror" name="comentario" required autocomplete="comentario" autofocus>

              @error('comentario')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>

            <div class="submit-button text-center">
                                        <button class="btn hvr-hover" id="submit" type="submit">Enviar Comentario</button>
                                        <div id="msgSubmit" class="h3 text-center hidden"></div>
                                        <div class="clearfix"></div>
                                    </div>
        </div> -->
      <table class="table table-striped">
        <thead>
          <tr>
            
            <th scope="col">Producto</th>
            <th scope="col">Su comentario</th>
            

          </tr>
        </thead>
        <tbody>
            @foreach($comentarios as $comentario)
            <tr>
            <td>{{$comentario->producto}}</td>         
            <td>{{$comentario->comentario}}</td>
            </tr>
            @endforeach

        </tbody>
      </table>
@endsection