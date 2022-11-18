var encombo = {
    datos: []
};
var numLista = 0;
var valorCombo = 0;
var descuento = 0;
$('#AgregarArticulo td button').click(function() {

    var selecionado = JSON.parse($(this).val());
    console.log(selecionado);
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
            'cantidad': cantidad
        });
    } else {
        encombo.datos[posicionProducto]['cantidad'] = encombo.datos[posicionProducto]['cantidad'] + 1;
    }

    ArmarTabla();
});

$('#AgregarProducto td button').click(function() {

    var selecionado = JSON.parse($(this).val());
    console.log(selecionado);
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
            'cantidad': cantidad
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
            valorCombo = valorCombo + (encombo.datos[i]['mercancia']['precio']);
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
    let validar = 1;
    let nombreCombo = $('#NombreCombo').val();
    if (nombreCombo == '') {
        alert("Ingrese un nombre al combo");
        validar = 0;
    }
    if (encombo.datos.length == 0) {
        alert("Selecione al menos un elemento");
        validar = 0;
    }

    if (descuento < 0 || descuento > 100) {
        alert("Descuento fuera de rango");
        validar = 0;
    }


    console.log(encombo.datos[0]);
    if (validar == 1) {
        console.log($("meta[name='csrf-token']").attr("content"));


        $.ajax({
            type: 'post',
            dataType: 'json',
            url: '{{route("combo.store")}}',
            data: {
                nombre: nombreCombo,
                datos: encombo.datos,
                valor: valorCombo,
                descuento: descuento,
                '_token': $("meta[name='csrf-token']").attr("content"),
            },

            error: function(res) {

                location.href = '{{route("indexAdmin")}}';
            },

        });


    }
});