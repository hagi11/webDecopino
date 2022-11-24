@extends('layouts.appAdmin')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.css">
@endsection

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


<form action="{{route('mprimagenes.update',$combo->id)}}" method="POST" class="dropzone" id="my-awesome-dropzone" enctype="multipart/form-data">
    {{ csrf_field() }}
    @method('PUT')
    <input type="hidden" name="tipo" value="combo">
</form>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Imagenes cargadas</h3>
    </div>
    <div class="panel-body">
        <table class="table table-primary" id='imagenesCargadas'>
            <thead>
                <tr>
                    <th scope="col">Codigo</th>
                    <th scope="col">Ruta</th>
                    <th scope="col">Imagen</th>
                    <th scope="col">Quitar</th>
                </tr>
            </thead>

            <tbody>
            </tbody>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.js"></script>
<script>
    var habilitar = 0;
    Dropzone.options.myAwesomeDropzone = {
        paramName: "imagen", // Las imágenes se van a usar bajo este nombre de parámetro
        maxFilesize: 4000, // Tamaño máximo en MB
        dictDefaultMessage: "Arrastre una imagen al recuadro para subirla",
        acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg,.jfif",
        maxFiles: 5,
        timeout: 10000,
        success: function() {
            load_images();
        },
        init: function() {
            load_images();
        },
    }

    function load_images() {
        habilitar = 0;
        $.ajax({
            type: "post",
            url: "{{route('cargarImagenes')}}",
            data: {
                id: "{{$combo->id}}",
                tipo: "combo",
                '_token': $("meta[name='csrf-token']").attr("content")
            },

            success: function(res) {
                $("#imagenesCargadas tbody").remove();
                $("#imagenesCargadas").append("<tbody></tbody>");
                for (var i = 0; i < res.length; i++) {
                    habilitar = 1;
                    var code = "<tr id='img" + res[i]['id'] + "'><td>" + res[i]['id'] + "</td> <td>" + res[i]['ruta'] + "</td><td> <img src='{{asset('aqui')}}'/></td><td><button  value='" + res[i]['id'] + "' class='btn btn-outline-danger' onclick='eliminarDelImg(" + res[i]['id'] + ")'>Quitar</button> </td> </tr>";
                    code = code.replace('aqui', res[i]['ruta']);
                    $("#imagenesCargadas tbody").append(code);
                }
            }
        });
    }

    function eliminarDelImg(eliminarId) {
        let url = "{{route('mprimagenes.destroy',1)}}";
        url = url.replace('1', eliminarId);
        $.ajax({
            type: "DELETE",
            url: url,
            data: {
                '_token': $("meta[name='csrf-token']").attr("content")
            },
            success: function(res) {
                load_images();
            }

        });
    }

    var encombo = {
        datos: []
    };
    var numLista = 0;
    var valorCombo = 0;
    var descuento = 0;

    $("#selecionadosEnCombo .trDatosPro").each(function() {
        numLista = numLista + 1;
        var id = parseInt($(this).attr("id"));
        encombo.datos.push({
            'numList': numLista,
            'tipo': 'producto',
            'mercancia': {
                'id': id,
                'nombre': ($('#productname' + id).text()),
                'detalle': ($('#productdet' + id).text()),
                'precio': parseInt($('#productval' + id).text()),
            },
            'cantidad': parseInt($('#productcan' + id).text()),
        });
    });

    $("#selecionadosEnCombo .trDatosArt").each(function() {
        numLista = numLista + 1;
        var id = parseInt($(this).attr("id"));
        encombo.datos.push({
            'numList': numLista,
            'tipo': 'articulo',
            'mercancia': {
                'id': id,
                'nombre': ($('#articuloname' + id).text()),
                'descripcion': ($('#articulodes' + id).text()),
                'precio': parseInt($('#articuloval' + id).text()),
            },
            'cantidad': parseInt($('#articulocan' + id).text()),
        });


    });


    valorDelCombo();
    ArmarTabla();


    $('#AgregarArticulo td button').click(function() {

        var selecionado = JSON.parse($(this).val());
        let nuevoEnCombo = 1;
        let posicionProducto = 0;
        let cantidad = 1;


        for (var i = 0; i < encombo.datos.length; i++) {
            if (encombo.datos[i]['mercancia']['id'] == selecionado['id'] && encombo.datos[i]['tipo'] == "articulo") {
                nuevoEnCombo = 0;
                posicionProducto = i;
            }
        }

        if (nuevoEnCombo == 1) {
            numLista = numLista + 1;
            encombo.datos.push({
                'numList': numLista,
                'tipo': 'articulo',
                'mercancia': selecionado,
                'cantidad': cantidad,

            });
        } else {
            encombo.datos[posicionProducto]['cantidad'] = encombo.datos[posicionProducto]['cantidad'] + 1;
        }

        ArmarTabla();
    });

    $('#AgregarProducto td button').click(function() {

        var selecionado = JSON.parse($(this).val());

        let nuevoEnCombo = 1;
        let posicionProducto = 0;
        let cantidad = 1;


        for (var i = 0; i < encombo.datos.length; i++) {
            if (encombo.datos[i]['mercancia']['id'] == selecionado['id'] && encombo.datos[i]['tipo'] == "producto") {
                nuevoEnCombo = 0;
                posicionProducto = i;
            }
        }

        if (nuevoEnCombo == 1) {
            numLista = numLista + 1;
            encombo.datos.push({
                'numList': numLista,
                'tipo': 'producto',
                'mercancia': selecionado,
                'cantidad': cantidad,

            });
        } else {
            encombo.datos[posicionProducto]['cantidad'] = encombo.datos[posicionProducto]['cantidad'] + 1;
        }

        ArmarTabla();
    });


    function eliminarDelGrupo(num) {

        if (encombo.datos[num - 1]['cantidad'] < 2) {
            encombo.datos[num - 1]['cantidad'] = 0;
        } else {
            encombo.datos[num - 1]['cantidad'] = encombo.datos[num - 1]['cantidad'] - 1;
        }
        ArmarTabla();
    };

    function ArmarTabla() {

        $("#selecionadosEnCombo tbody").remove();
        $("#selecionadosEnCombo").append("<tbody></tbody>");
        for (var i = 0; i < encombo.datos.length; i++) {
            if (encombo.datos[i]['cantidad'] != 0) {
                if (encombo.datos[i]['tipo'] == "producto") {

                    $("#selecionadosEnCombo tbody").append("<tr id='enCombo" + encombo.datos[i]['numList'] + "'><td>" + encombo.datos[i]['numList'] + "</td> <td>" + encombo.datos[i]['mercancia']['nombre'] + "</td><td>" + encombo.datos[i]['cantidad'] + "</td><td>" + encombo.datos[i]['mercancia']['detalle'] + "</td><td>" + encombo.datos[i]['mercancia']['precio'] + "</td><td> <button  value='" + encombo.datos[i]['numList'] + "' class='btn btn-outline-danger' onclick='eliminarDelGrupo(" + encombo.datos[i]['numList'] + ")'>Quitar</button> </td> </tr>");
                } else {
                    $("#selecionadosEnCombo tbody").append("<tr id='enCombo" + encombo.datos[i]['numList'] + "'><td>" + encombo.datos[i]['numList'] + "</td> <td>" + encombo.datos[i]['mercancia']['nombre'] + "</td><td>" + encombo.datos[i]['cantidad'] + "</td><td>" + encombo.datos[i]['mercancia']['descripcion'] + "</td><td>" + encombo.datos[i]['mercancia']['precio'] + "</td><td> <button  value='" + encombo.datos[i]['numList'] + "' class='btn btn-outline-danger' onclick='eliminarDelGrupo(" + encombo.datos[i]['numList'] + ")'>Quitar</button> </td> </tr>");
                }
            }
        }
        valorDelCombo()
    }

    function valorDelCombo() {
        valorCombo = 0;
        for (var i = 0; i < encombo.datos.length; i++) {
            if (encombo.datos[i]['cantidad'] != 0) {
                valorCombo = valorCombo + (encombo.datos[i]['mercancia']['precio']) * (encombo.datos[i]['cantidad']);
            }
        }
        descuento = ($('#descuentoCombo').val());

        valorCombo = valorCombo - ((valorCombo * descuento) * 0.01).toFixed(0);
        $('#valorCombo').text(valorCombo);
    }
    // focusout
    $('#descuentoCombo').change(function() {
        valorDelCombo();
    });

    $('#btnEnvioDato').click(function() {
        var id = parseInt($("#selecionadosEnCombo thead").attr("id"));
        let verificarCantidad = 0;
        let validar = 1;
        let nombreCombo = $('#NombreCombo').val();
        if (nombreCombo == '') {
            alert("Ingrese un nombre al combo");
            validar = 0;
        }
        for (var i = 0; i < encombo.datos.length; i++) {
            verificarCantidad = encombo.datos[i]['cantidad'] + verificarCantidad;

        }
        if (verificarCantidad == 0) {
            alert("Minimo dos elementos para crear un combo");
            validar = 0;
        }

        if (encombo.datos.length == 0) {
            alert("Minimo dos elementos para crear un combo");
            validar = 0;
        }

        if (descuento < 0 || descuento > 100) {
            alert("Descuento fuera de rango");
            validar = 0;
        }

        if (validar == 1) {
            $.ajax({

                type: "PUT",
                url: "{{route('combo.update',$combo->id)}}",
                data: {
                    id: id,
                    nombre: nombreCombo,
                    datos: encombo.datos,
                    valor: valorCombo,
                    descuento: descuento,
                    '_token': $("meta[name='csrf-token']").attr("content"),
                },
                success: function(res) {
                    if (res == 1) {
                        location.href = "{{route('verComboAdmin',$combo->id)}}";
                    } else {
                        alert(res);
                    }
                },
            });

        }
    });
</script>
@endsection