//CARGAR DATATABLE HISTORIAL DE INGRESOS FISCALES CON DATOS JSON
$(document).ready(function () {
    if ($("#tablasChasisNew").length >= 1) {
        $.ajax({
            url: "ajax/chasisVehiculosNuevos.ajax.php",
            success: function (respuesta) {
                console.log(respuesta);
            }

        })
 }   
})

$(document).ready(function () {
    if ($("#tablasChasisNew").length >= 1) {
        $('#tablasChasisNew').DataTable({
            "bProcessing": true,
            "sAjaxSource": "ajax/chasisVehiculosNuevos.ajax.php",
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

$(document).on("click", ".btnDescargaExcelVehNew", async function () {
    Swal.fire({
        title: 'Quiere descarga el reporte en excel?',
        text: "Esto puede tardar unos segundos!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        allowOutsideClick: false,
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Descargar!'
    }).then(async function (result) {
        if (result.value) {
            var tipoOp = 1;

            var nomVar = "generateExcelVehiNew";
            var resp = await insertNuevoServicio(nomVar, tipoOp);
            var nombreReporte = 'HISTORIAL DE CHASIS VEHÍCULOS USADOS';
            var nombreEncabezado = "DescargaReporteExcel";
            var nombreFile = "ReporteDeIngresosVehUs_";
            var creaExcel = await JSONToCSVDescargaExcel(resp, nombreEncabezado, nombreReporte, nombreFile, true);
            console.log(resp);
        }
    })
})

$(document).on("click", "#btnImprimirRetPil", async function () {
    alert("holka mundi");
    
})
