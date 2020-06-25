$(function () {
    $('#dateTimeConta').daterangepicker({
        timePicker: true,
        startDate: moment().startOf('hour'),
        singleDatePicker: true,
        endDate: moment().startOf('hour').add(32, 'hour'),
        locale: {
            format: 'DD-MM-YYYY'
        }
    }, function (start, end, label) {
        var tiempoVal = start.format('YYYY-MM-DD');
        var tiempoVal = start.format('DD-MM-YYYY');
        document.getElementById("hiddenDateTime").value = tiempoVal;
        swal({
            type: "success",
            title: "Fecha Seleccionada",
            text: "Reporte generado del dia " + tiempoVal,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar'
        });
    });
});

$(document).on("click", ".btnGenerarPolizaContable", async function () {
    var fecha = document.getElementById("hiddenDateTime").value;
    var generarPolizas = await generarPolizaContable(fecha);
})

function generarPolizaContable(fecha) {
    let estado;
    var datos = new FormData();
    datos.append("fechaContable", fecha);
    $.ajax({
        async: false,
        url: "ajax/polizasDiarias.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            if (respuesta != "SD") {
                document.getElementById("divTableContabilidad").innerHTML = ' <table id="tableContabilidad" class="table table-hover table-striped dt-responsive table-sm"></table>';
                cuentaDefinitiva = [];
                indexTable = [];
                /*
                 * CUENTA POLIZA DEFINITIVA 802103.0102
                 */
                var numero = 1;
                var ctapolDefitiva = respuesta[0].ctapolDefitiva;
                var polDefitiva = respuesta[0].polDefitiva;
                var valCif = respuesta[0].valCif;
                var haber = "-";
                var acciones = "-";

                cuentaDefinitiva.push([numero, ctapolDefitiva, polDefitiva, valCif, haber, acciones]);
                /*
                 * CUENTA POLIZA IMPUESTO MERCA 801109.01
                 */
                var numero = 1;
                var ctaImptsMerV = respuesta[0].ctaImptsMerV;
                var ImptsMerV = respuesta[0].ImptsMerV;
                var valImpuesto = respuesta[0].valImpuesto;
                var haber = "-";
                var acciones = "-";
                cuentaDefinitiva.push([numero, ctaImptsMerV, ImptsMerV, valImpuesto, haber, acciones]);
                /*
                 * CUENTA POLIZA CUENTAS POR CONTRA CIF 888888
                 */
                var numero = 1;
                var ctaContra = respuesta[0].ctaContra;
                var Contra = respuesta[0].Contra;
                var debe = "-";
                var valCif = respuesta[0].valCif;
                var acciones = '';
                cuentaDefinitiva.push([numero, ctaContra, Contra, debe, valCif, acciones]);
                /*
                 * CUENTA POLIZA CUENTAS POR CONTRA IMPUESTO 888888
                 */
                var numero = 1;
                var ctaContra = respuesta[0].ctaContra;
                var Contra = respuesta[0].Contra;
                var debe = "-";
                var valImpuesto = respuesta[0].valImpuesto;
                var acciones = '';
                cuentaDefinitiva.push([numero, ctaContra, Contra, debe, valImpuesto, acciones]);

                /*
                 * Totales
                 */

                var numero = '<strong>1</strong>';
                var ctaContra = '<strong>TOTAL</strong>';
                var Contra = '<strong>INGRESOS DE CIF E IMPUESTOS EN ZONA ADUANERA DE BODEGAS Y PREDIOS DE VEHÍCULOS</stron>';

                var totalDebe = '<strong>'+respuesta[0].total+'</strong>';
                var totalHaber = '<strong>'+respuesta[0].total+'</strong>';
                //   var acciones = '<button type="button" class="btn btn-primary">Ver Reporte</button>';
                var acciones = '<button type="button" class="btn btn-primary">Ver Reporte</button>';
                cuentaDefinitiva.push([numero, ctaContra, Contra, totalDebe, totalHaber, acciones]);
                    $('#tableContabilidad').DataTable({
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
                    },
                    data: cuentaDefinitiva,
                    columns: [{
                            title: "#"
                        }, {
                            title: "Cuenta"
                        }, {
                            title: "Nombre De Cuenta"
                        }, {
                            title: "Debe"
                        }, {
                            title: "Haber"
                        }, {
                            title: "Acciones"
                        }]
                });



            }

            console.log(respuesta);
        }, error: function (respuesta) {
            console.log(respuesta);
        }
    });
    return estado;
}

