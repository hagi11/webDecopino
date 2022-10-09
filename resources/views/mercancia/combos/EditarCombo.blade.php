@extends('layouts.app')

@section('content')

<div class="container">
    <h2>Selecionados para el combo</h2>
</div>


<div class="container overflow-auto">
    <div class="table-responsive">

        <input class="form-control" id="NombreCombo" type="text" placeholder="Ingrese Un Nombre al combo" value="{{$combo->nombre}}">
        <br>
        <table class="table table-primary" id="selecionadosEnCombo">
            <thead id="{{$combo->id}}">
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
                @foreach ($prosEnCombo as $comPro)
                <tr id='{{$comPro -> idproduct}}' class="trDatosPro">
                    <td id="productid{{$comPro -> idproduct}}">{{$comPro -> idproduct}}</td>
                    <td id="productname{{$comPro -> idproduct}}">{{$comPro -> nombre}}</td>
                    <td id="productcan{{$comPro -> idproduct}}">{{$comPro -> cantidad}}</td>
                    <td id="productdet{{$comPro -> idproduct}}">{{$comPro -> detalle}}</td>
                    <td id="productval{{$comPro -> idproduct}}">{{$comPro -> valor}}</td>
                    <td id="productbut{{$comPro -> idproduct}}"> <button value="{{$comPro}}" class='btn btn-outline-danger' onclick='eliminarDelGrupo("{{$comPro -> producto}}")'>Quitar</button> </td>
                </tr>
                @endforeach
                @foreach ($artsEnCombo as $comPro)
                <tr id='{{$comPro -> idarticulo}}' class="trDatosArt">
                    <td id="articuloid{{$comPro -> idarticulo}}">{{$comPro -> idarticulo}}</td>
                    <td id="articuloname{{$comPro -> idarticulo}}">{{$comPro -> nombre}}</td>
                    <td id="articulocan{{$comPro -> idarticulo}}">{{$comPro -> cantidad}}</td>
                    <td id="articulodes{{$comPro -> idarticulo}}">{{$comPro -> descripcion}}</td>
                    <td id="articuloval{{$comPro -> idarticulo}}">{{$comPro -> valor}}</td>
                    <td id="articulobut{{$comPro -> idarticulo}}"> <button value="{{$comPro}}" class='btn btn-outline-danger' onclick='eliminarDelGrupo("{{$comPro -> producto}}")'>Quitar</button> </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="1">
                        <p>Descuento:</p>
                    </th>
                    <th colspan="1">
                        <input class="form-control" id="descuentoCombo" type="number" value="{{$combo->descuento}}">
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
                        <button id="btnEnvioDato" class="btn btn-primary"> Guardar </button>
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
<script src="{{asset('js/EditarCombo.js')}}"></script>
@endsection

@endsection