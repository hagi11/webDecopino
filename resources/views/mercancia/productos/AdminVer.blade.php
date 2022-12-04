@extends('layouts.appAdmin')

@section('content')

<button><a href=" {{route('adminProducto')}}" class="btn btn-info" style="text-align:right">volver</a></button>
@if (Auth::guard('usuarios')->user()->variables(2)->editar==1)
<button><a href=" {{route('productos.edit',$producto->id)}}" class="btn btn-info" style="text-align:right">editar</a></button>
@endif
<br>
<br>
<h3>Informacion general</h3>
<table class="table table-striped">
  <thead>
    <tr>
      <th>
        categoria
      </th>
      <th>
        valor
      </th>
<th></th>
    
    </tr>

  </thead>
  <tbody> 
    <tr>
      <th scope="col">Codigo</th>
      <td>{{$producto->id}}</td>
    </tr>
    <tr>
      <th scope="col">nombre</th>
      <td>{{$producto->nombre}}</td>

    </tr>
    <tr>
      <th scope="col">precio</th>
      <td>{{$producto->precio}}</td>

    </tr>
    <tr>
      <th scope="col">iva</th>
      <td>{{$producto->iva}}</td>

    </tr>
    <tr>

      <th scope="col">descuento</th>
      <td>{{$producto->descuento}}</td>

    </tr>
    <tr>
      <th scope="col">existencia</th>
      <td>{{$producto->existencia}}</td>


    </tr>
    <tr>
      <th scope="col">estilo</th>
      <td>{{$producto->estilo}}</td>

    </tr>
    <tr>
      <th scope="col">dimension</th>
      <td>{{$producto->dimension}}</td>
    </tr>
    <tr>
      <th scope="col">peso</th>
      <td>{{$producto->peso}}</td>


    </tr>
    <tr>
      <th scope="col">material</th>
      <td>{{$producto->material}}</td>

    </tr>
    <tr>
      <th scope="col">color</th>
      <td>{{$producto->color}}</td>

    </tr>
    <tr>
      <th scope="col">tipo pintura</th>
      <td>{{$producto->tipopintura}}</td>

    </tr>
    <tr>
      <th scope="col">acabado</th>
      <td>{{$producto->acabado}}</td>

    </tr>
    <tr>
      <th scope="col">detalle</th>
      <td>{{$producto->detalle}}</td>
    </tr>
    <tr>
      <th scope="col">vista</th>
      <td>{{$producto->vista}}</td>

    </tr>
    <tr>
      <th scope="col">compra</th>
      <td>{{$producto->compra}}</td>

    </tr>
    <tr>
      <th scope="col">garantia</th>
      <td>{{$producto->garantia}}</td>

    </tr>

    <tr>
      <th scope="col">proveedor</th>
      <td>{{$proveedor[0]->nombre}}</td>

    </tr>
    <tr>
      <th scope="col">linea</th>
      <td>{{$linea[0]->nombre}}</td>

    </tr>
    <tr>
      <th scope="col">categoria</th>
      <td>{{$categoria[0]->nombre}}</td>
    </tr>
  </tbody>
</table>
<br>
<h3>Imagenes</h3>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">codigo</th>
      <th scope="col">ruta</th>
      <th scope="col">imagen</th>
    </tr>
  </thead>
  <tbody>
    @foreach($imagenes as $imagen)
    <tr>
      <td>{{$imagen->id}}</td>
      <td>{{$imagen->ruta}}</td>
      <td><img src="{{asset($imagen->ruta)}}"> </td>
    </tr>
    @endforeach
  </tbody>
</table>

<h3>Comentarios</h3>
<table class="table table-striped">
  <thead>
    <tr>

      <th scope="col">Codigo</th>
      <th scope="col">Comentario</th>
      <th scope="col">Acción</th>
<th></th>

    </tr>
  </thead>
  <tbody>
    @foreach($comentarios as $comentario)
    <tr>
      <td>{{$comentario->id}}</td>
      <td>{{$comentario->comentario}}</td>
      <td>
      <form action="{{route('comentarios.destroy',$comentario->id)}}" method="post">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger" onclick="return confirm('¿Quiere eliminar este comentario?')">
                                Eliminar
                            </button>
                        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection