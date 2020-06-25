$(document).on("click", ".btnAgregar", function () {
// var valor = 1;
//document.getElementById("valor").value = valor;
    var estadoServicio = $(this).attr("estadoServicio");

    if (estadoServicio == 0) {
        $(this).removeClass('btn-primary');
        $(this).addClass('btn-danger');
        $(this).html('<i class="fa fa-close"></i>');
        $(this).attr('estadoServicio', 1);
        var numFila = $(this).attr("numFila");

    } else {
        $(this).removeClass('btn-danger');
        $(this).addClass('btn-primary');
        $(this).html('<i class="fa fa-plus-circle"></i>');
        $(this).attr('estadoServicio', 0);
        var valor = 0;
//document.getElementById("valor").value = valor;

    }

})


$(document).on("click", ".btnOcultar", function () {

    $('#tablas').DataTable().destroy();
    $('#tablas').DataTable({
        "pagingType": "full_numbers",
        "columnDefs": [
            {
                "targets": [2],
                "visible": false,
                "searchable": false
            },
            {
                "targets": [3],
                "visible": false,
                "searchable": false
            },
            {
                "targets": [4],
                "visible": false,
                "searchable": false
            },
            {
                "targets": [5],
                "visible": false,
                "searchable": false
            },
            {
                "targets": [6],
                "visible": false,
                "searchable": false
            },
            {
                "targets": [7],
                "visible": false,
                "searchable": false
            },
        ]
    });
});

$(document).on("click", ".btnMostrar", function () {

    $('#tablas').DataTable().destroy();
    $('#tablas').DataTable({
        "pagingType": "full_numbers",
        "columnDefs": [
            {
                "targets": [2],
                "visible": true,
                "searchable": true
            },
            {
                "targets": [3],
                "visible": true,
                "searchable": true
            },
            {
                "targets": [4],
                "visible": true,
                "searchable": true
            },
            {
                "targets": [5],
                "visible": true,
                "searchable": true
            },
            {
                "targets": [6],
                "visible": true,
                "searchable": true
            }

        ]
    });
});





