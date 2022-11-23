$('.store').mouseenter(function() {
    $("body").css("cursor", "pointer");
});

$('.store').mouseleave(function() {
    $("body").css("cursor", "auto");
});

function enviarCarrito(lista, tipo) {
    if (tipo == 1) {
        $.ajax({
            type: 'post',
            url: '{{route("carrito.store")}}',
            data: {
                combo: lista,
                '_token': $("meta[name='csrf-token']").attr("content"),
            },

            success: function(res) {
                console.log(res);
            },

        });
    }

    if (tipo == 2) {
        $.ajax({
            type: 'post',
            url: '{{route("carrito.store")}}',
            data: {
                producto: lista,
                '_token': $("meta[name='csrf-token']").attr("content"),
            },

            success: function(res) {
                console.log(res);
            },

        });
    }

    if (tipo == 3) {
        $.ajax({
            type: 'post',
            url: '{{route("carrito.store")}}',
            data: {
                articulo: lista,
                '_token': $("meta[name='csrf-token']").attr("content"),
            },

            success: function(res) {
                console.log(res);
            },

        });
    }



}