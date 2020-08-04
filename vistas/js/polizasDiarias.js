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

                var totalDebe = '<strong>' + respuesta[0].total + '</strong>';
                var totalHaber = '<strong>' + respuesta[0].total + '</strong>';
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

$(document).on("click", ".btnGenerarPolizaContable", async function () {
    if ($(".btnViewContabilidad").length == 0 && $(".btnViewContabilidadRet").length == 0 && $(".btnViewAjustes").length == 0) {
        Swal.fire({
            title: 'Sin Contabilidad',
            text: "No existe contabilidad para reportar!",
            type: 'error',
            confirmButtonColor: '#3085d6',
            allowOutsideClick: false,
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value) {
                location.reload();
                return 0;
            }
        })
    } else {
        var nomVar = "ultimaData";
        var data = 1;
        var respUltimaDate = await funcionContabilizarPoliza(nomVar, data);
        if (respUltimaDate != "SD") {
            var fechaMaxima = respUltimaDate;
        } else {
            var fechaMaxima = new Date('YYYY-MM-DD');
        }
        console.log(respUltimaDate);
        Swal.fire({
            title: 'Seleccione Fecha  ' + '<i class="fa fa-calendar"></i>',
            text: 'Something went wrong!',
            html: '<input type="text" id="dateTime" class="form-control" />',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirm',
            cancelButtonText: 'Cancel',
            onOpen: function () {
                $('#dateTime').daterangepicker({
                    timePicker: false,
                    startDate: moment().startOf('hour'),
                    singleDatePicker: true,
                    endDate: moment().startOf('hour').add(32, 'hour'),
                    minDate: (fechaMaxima),
                    locale: {
                        format: 'YYYY-MM-DD'
                    }
                });
            },
        }).then(async function (result) {
            if (result.value) {
                var dateTime = document.getElementById("dateTime").value;
                if (dateTime != "") {
                    Swal.fire({
                        title: '¿Seguro quiere contabiliza con fecha : ' + dateTime + '?',
                        type: 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, contabilizar!'
                    }).then(async function (result) {
                        if (result.value) {
                            var nomVar = "cotabilizarFecha";
                            var respContabilizar = await funcionContabilizarPoliza(nomVar, dateTime);
                            if (respContabilizar == 0) {
                                Swal.fire({
                                    title: 'No hay saldo anterior',
                                    text: "Se le rediccionara a un formulario, donde debe agregar saldos anteriores de contablidad.",
                                    type: 'warning',
                                    confirmButtonColor: '#3085d6',
                                    allowOutsideClick: false,
                                    confirmButtonText: 'Ok'
                                }).then((result) => {
                                    if (result.value) {
                                        window.location = 'sldDiarioContabilidad';
                                    }
                                })
                            } else {


                                if (respContabilizar) {
                                    Swal.fire({
                                        title: '¿Desea Imprimir?',
                                        text: "Desea imprimir la poliza contable del dia",
                                        type: 'success',
                                        showCancelButton: true,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'Si, Imprimir!'
                                    }).then((result) => {
                                        if (result.value) {
                                            window.open("extensiones/tcpdf/pdf/polizaContable.php?fechaPoliza=" + dateTime + '&entidad=1', "_blank");
                                            location.reload();

                                        }
                                    })
                                }
                            }
                        }
                    })
                } else {
                    Swal.fire(
                            'Fecha incorrecta',
                            'La fecha seleccionada no es correcta!',
                            'error'
                            )
                }
            }
        });
    }

});

function funcionContabilizarPoliza(nomVar, dateTime) {
    let respEdicion;
    var datos = new FormData();
    datos.append(nomVar, dateTime);
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
            console.log(respuesta);
            respEdicion = respuesta;
        }, error: function (respuesta) {
            console.log(respuesta);
        }});
    return respEdicion;
}



$(document).on("click", ".btnViewAjustes", async function () {
    document.getElementById("divReporteIngresosView").innerHTML = '';
    document.getElementById("divReporteIngresosView").innerHTML = '<table id="tbAjustesContables" class="table table-hover table-sm"></table>';
    var paragraphs = Array.from(document.querySelectorAll(".btnViewContabilidad"));
    var listaDB = [];
    for (var i = 0; i < paragraphs.length; i++) {
        var idNumber = paragraphs[i].attributes.btnviewconta.value;
        listaDB.push([idNumber]);
    }
    var listaDBConsult = JSON.stringify(listaDB);
    console.log(listaDBConsult);
    var nomVar = "mstAjustesConta";
    var numero = 0;
    var respDataAjustes = await funcionContabilizarRet(nomVar, listaDBConsult);
    var listaAjustesDB = [];
    for (var i = 0; i < respDataAjustes.length; i++) {

        var numero = numero + 1;
        var idIng = respDataAjustes[i].idIng;

        var numeroPoliza = respDataAjustes[i].numeroPoliza;
        var nitEmpresa = respDataAjustes[i].nitEmpresa;
        var fecha = respDataAjustes[i].fecha;
        var fechaSet = await formato(fecha);
        var nombreEmpresa = respDataAjustes[i].nombreEmpresa;

        var saldoValorCif = respDataAjustes[i].saldoValorCif;
        var saldoValorImpuesto = respDataAjustes[i].saldoValorImpuesto;

        var cifNumber = new Intl.NumberFormat("en-GT").format(saldoValorCif);
        var impuestoNumber = new Intl.NumberFormat("en-GT").format(saldoValorImpuesto);
        var button = '<button type="button" class="btn btn-danger btn-sm btnPrintIng" idIngPrint=' + idIng + '><i class="fas fa-file-pdf"></i></button>';
        var area = respDataAjustes[i].empresa + ' ' + respDataAjustes[i].areasAutorizadas + ' ' + respDataAjustes[i].numeroIdentidad;
        listaAjustesDB.push([numero, numeroPoliza, fechaSet, nitEmpresa, nombreEmpresa, area, saldoValorCif, saldoValorImpuesto, button]);

    }
    $('#tbAjustesContables').DataTable({
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
        data: listaAjustesDB,
        columns: [{
                title: "#"
            }, {
                title: "Poliza"
            }, {
                title: "Fecha"
            }, {
                title: "Nit"
            }, {
                title: "Nombre Empresa"
            }, {
                title: "Area"
            }, {
                title: "Cif"
            }, {
                title: "Impuesto"
            }, {
                title: "Acciones"
            }]

    });

});

