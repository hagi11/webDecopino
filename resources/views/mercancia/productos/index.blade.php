@extends('layouts.app')

@section('content')

<a href=" {{route('productos.create')}}" class="btn btn-info" style="text-align:right">CREAR</a>
    <br>
    <br>
    <br>

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
            <th colspan="2">ACCIONES</th>
          </tr>
        </thead>
        <tbody>
            @foreach($productos as $producto)
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
            <td><a href=" {{route('productos.edit',$producto->id)}}" class="btn btn-info" style="text-align:right">editar</a></td>

            <td><a href=" {{route('carrito', $producto->id)}}" class="btn btn-info" style="text-align:right">carrito</a></td>
            
            <td><a href=" {{route('productos.show',$producto->id)}}" class="btn btn-info" style="text-align:right">ver</a></td>

            <td>
              <input type= "hidden" name= "producto"> 

            </td>


            <td>
            <form action=" {{route('productos.destroy',$producto->id)}}" method="POST">
            @csrf 
            @method('DELETE')   
            <button class="btn btn-info" style="text-align:right">eliminar</button>
            </form>
            </td>
        </tr>
            @endforeach

        </tbody>
      </table>

@endsection