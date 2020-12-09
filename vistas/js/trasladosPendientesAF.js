//CARGAR DATATABLE HISTORIAL DE INGRESOS FISCALES CON DATOS JSON
$(document).ready(function () {
    if ($("#tbTrasladosAf").length >= 1) {
        $.ajax({
            url: "ajax/datatableTrasladosAF.ajax.php",
            "bServerSide": true,
            success: function (respuesta) {
            }

        })
    }
})

$(document).ready(function () {
    if ($("#tbTrasladosAf").length >= 1) {
        $('#tbTrasladosAf').DataTable({
            "bProcessing": true,
            "sAjaxSource": "ajax/datatableTrasladosAF.ajax.php",
            "deferRender": true,
            "language": {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
                "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "Busqueda:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }

            }
        });
    }
});

$(document).on("click", ".btnHacerTrasladoDefinitivo", async function () {
    var idIng = $(this).attr("idIng");
    var nomVar = "trasladoDefAf";
    var resp = await trasladarIngFiscal(nomVar, idIng)
    if (resp[0]["resp"] == 1) {
        Swal.fire({
            title: 'Traslado exitoso',
            allowOutsideClick: false,
            text: "El traslado a Almacen Fiscal fue exitoso!",
            type: 'success',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok!'
        }).then((result) => {
            if (result.value) {
                location.reload();
            }
        })
    }
})

