@extends('layouts.app')

@section('content')

<div class="container">
    <h2>Selecionados para el combo</h2>
</div>


<div class="container overflow-auto">
    <div class="table-responsive">

        <input class="form-control" id="NombreCombo" type="text" placeholder="Ingrese Un Nombre al combo">
<br>
        <table class="table table-primary" id="selecionadosEnCombo">
            <thead>
                <tr>
                    <th scope="col">codigo</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Decripcion</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="1">
                        <p>Descuento:</p>
                    </th>
                    <th colspan="1">
                        <input class="form-control" id="descuentoCombo" type="number" value="0">
                    </th>
                    <th colspan="1">
                    
                    </th>
                    
                    <th colspan="1">
                        <p>Precio Total</p>
                    </th>
                    <th colspan="1">
                        <p><span id="valorCombo">0</span></p>
                    </th>
                    
                    <th colspan="1">
                        <button id="btnEnvioDato" class="btn btn-primary"> Crear </button>
                    </th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>





<div class="container">
    <h2>Selecione los productos para el Combo</h2>
</div>


<div class="container overflow-auto">
    <div class="table-responsive">
        <table class="table table-primary" id='AgregarProducto'>
            <thead>
                <tr>
                    <th scope="col">codigo</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Decripcion</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            </thead>
            <tbody>
                @foreach ($productos as $producto)

                <tr id='producto{{$producto -> id}}'>
                    <td>{{$producto -> id}}</td>
                    <td>{{$producto -> nombre}}</td>
                    <td>{{$producto -> detalle}}</td>
                    <td>{{$producto -> precio}}</td>
                    <td>
                        <button type="button" value="{{$producto}}" class="btn btn-outline-primary">agregar</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="container">
    <h2>Selecione los Articulos para el Combo</h2>
</div>


<div class="container overflow-auto">
    <div class="table-responsive">
        <table class="table table-primary" id='AgregarArticulo'>
            <thead>
                <tr>
                    <th scope="col">codigo</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Decripcion</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            </thead>
            <tbody>
                @foreach ($articulos as $articulo)

                <tr id='{{$articulo -> id}}'>
                    <td>{{$articulo -> id}}</td>
                    <td>{{$articulo -> nombre}}</td>
                    <td>{{$articulo -> descripcion}}</td>
                    <td>{{$articulo -> precio}}</td>
                    <td>
                        <button type="button" value="{{$articulo}}" class="btn btn-outline-primary">agregar</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>





@endsection


@section('js')
<!-- <script src="/resouces/js/crearCombo.js"></script> -->
<script src="../../resources/js/crearCombo.js"></script>
@endsection