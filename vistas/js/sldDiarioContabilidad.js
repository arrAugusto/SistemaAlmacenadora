$(document).on("click", ".btnHistoriaSaldos", async function () {
    document.getElementById("divSaldosCif").innerHTML = '<table id="tableSaldosCif" style="font-size:14px;" class="table dt-responsive table-hover table-sm table-striped table-responsible"></table>';
    document.getElementById("divImpuesto").innerHTML = '<table id="tableSaldosImpts" style="font-size:14px;" class="table dt-responsive table-hover table-sm table-striped table-responsible"></table>';

    var idEmpresa = $(this).attr("btnverhistoria");
    var nomVar = "viewHistorialCif";
    var respHistoriaCif = await funcionHistorial(nomVar, idEmpresa);
    console.log(respHistoriaCif);
    var numero = 0;
    listaCif = [];
    for (var i = 0; i < respHistoriaCif.length; i++) {
        var numero = numero + 1;
        var tipo = 0;
        if (respHistoriaCif[i].operacion == "INICIAL") {
            var fechaMov = respHistoriaCif[i].tipoTransaccion;
            var debe = "";
            var haber = "";
            var saldoInicial = respHistoriaCif[i].saldo;
            var saldoInicial = parseFloat(saldoInicial).toFixed(2);
            var saldo = new Intl.NumberFormat("en-GT").format(saldoInicial);



        } else {
            var fechaMov = respHistoriaCif[i].fecha;
            var fechaMov = formato(fechaMov);
            if (respHistoriaCif[i].concepto == "HABER") {
                var debe = "";
                var montoHaber = respHistoriaCif[i].monto;

                var montoHaber = parseFloat(montoHaber).toFixed(2);
                var haber = new Intl.NumberFormat("en-GT").format(montoHaber);

            } else {
                var montoDebe = respHistoriaCif[i].monto;
                var montoDebe = parseFloat(montoDebe).toFixed(2);
                var debe = new Intl.NumberFormat("en-GT").format(montoDebe);


                var haber = "";
            }
            var saldoInicial = respHistoriaCif[i].saldo;

            var saldoInicial = parseFloat(saldoInicial).toFixed(2);
            var saldo = new Intl.NumberFormat("en-GT").format(saldoInicial);



        }
        var accion = '<button type="button" class="btn btn-outline-danger btnVerPoliza btn-sm" fechareporte="' + fechaMov + '" entidad="1">Pól<i class="fa fa-file-pdf-o"></i></button>';
        listaCif.push([numero, fechaMov, debe, haber, saldo, accion]);
    }


    $('#tableSaldosCif').DataTable({
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
        data: listaCif,
        columns: [{
                title: "#"
            }, {
                title: "Día"
            }, {
                title: "Debe"
            }, {
                title: "Haber"
            }, {
                title: "Saldo"
            }, {
                title: "Acciones"
            }]
    });


    console.log(listaCif);
    var nomVar = "viewHistorialImpts";
    var respHistoriaImpts = await funcionHistorial(nomVar, idEmpresa);
    var numero = 0;
    listaImpts = [];
    for (var i = 0; i < respHistoriaImpts.length; i++) {
        var numero = numero + 1;
        var tipo = 0;
        if (respHistoriaImpts[i].operacion == "INICIAL") {
            var fechaMov = respHistoriaImpts[i].tipoTransaccion;
            var debe = "";
            var haber = "";
            var saldoInicial = respHistoriaImpts[i].saldo;
            var saldoInicial = parseFloat(saldoInicial).toFixed(2);
            var saldo = new Intl.NumberFormat("en-GT").format(saldoInicial);

        } else {
            var fechaMov = respHistoriaImpts[i].fecha;
            var fechaMov = formato(fechaMov);
            if (respHistoriaImpts[i].concepto == "HABER") {
                var debe = "";
                var montoHaber = respHistoriaImpts[i].monto;
                var montoHaber = parseFloat(montoHaber).toFixed(2);
                var haber = new Intl.NumberFormat("en-GT").format(montoHaber);
            } else {
                var montoDebe = respHistoriaImpts[i].monto;
                var montoDebe = parseFloat(montoDebe).toFixed(2);
                var debe = new Intl.NumberFormat("en-GT").format(montoDebe);


                var haber = "";
            }
            var saldoInicial = respHistoriaImpts[i].saldo;

            var saldoInicial = parseFloat(saldoInicial).toFixed(2);
            var saldo = new Intl.NumberFormat("en-GT").format(saldoInicial);



        }
        var accion = '<button type="button" class="btn btn-outline-danger btnVerPoliza btn-sm" fechareporte="' + fechaMov + '" entidad="1">Pól<i class="fa fa-file-pdf-o"></i></button>';

        listaImpts.push([numero, fechaMov, debe, haber, saldo, accion]);
    }
    $('#tableSaldosImpts').DataTable({
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
        data: listaImpts,
        columns: [{
                title: "#"
            }, {
                title: "Día"
            }, {
                title: "Debe"
            }, {
                title: "Haber"
            }, {
                title: "Saldo"
            }, {
                title: "Acciones"
            }]
    });




})


function funcionHistorial(nomVar, idEmpresa) {
    let respHistorial;
    var datos = new FormData();
    datos.append(nomVar, idEmpresa);
    $.ajax({
        async: false,
        url: "ajax/sldDiarioContabilidad.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            respHistorial = respuesta;
        }, error: function (respuesta) {
            console.log(respuesta);
        }});
    return respHistorial;
}

$(document).on("click", ".btnCorteContaPendt", async function () {
    document.getElementById("divDiasPendContables").innerHTML = '<table id="tableDiasPendtConta" style="font-size:14px;" class="table dt-responsive table-hover table-striped table-responsible"></table>';
    var cortePendiente = $(this).attr("btncortescontables");
    var nomVar = "cortesPendientes";
    var respHistoriaImpts = await funcionHistorial(nomVar, cortePendiente);
    console.log(respHistoriaImpts);
    lstFechaCorte = [];
    var numero = 0;
    for (var i = 0; i < respHistoriaImpts.length; i++) {
        var numero = numero + 1;
        var fechaCorte = respHistoriaImpts[i].fechaPendiente;
        var fecha = await formato(fechaCorte);
        var idEmpresa = respHistoriaImpts[i].idEmpresa;
        var button = '<div class="btn-group"><button type="button" class="btn btn-outline-danger btnVerPoliza btn-sm" fechaReporte="' + fechaCorte + '" entidad="' + cortePendiente + '">Pól<i class="fa fa-file-pdf-o"></i></button><button type="button" class="btn btn-outline-success btn-sm btnReportesDia" fechaReporte="' + fechaCorte + '" entidad="' + cortePendiente + '">Rep </button><button type="button" class="btn btn-outline-primary btn-sm btnCorteDiario" fechaReporte="' + fechaCorte + '" entidad="' + cortePendiente + '">Corte</button></div>';
        lstFechaCorte.push([numero, fecha, button]);
    }
    $('#tableDiasPendtConta').DataTable({
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
        data: lstFechaCorte,
        columns: [{
                title: "#"
            }, {
                title: "Día"
            }, {
                title: "Acciones"
            }]
    });

})

$(document).on("click", ".btnVerPoliza", async function () {
    var fechareporte = $(this).attr("fechareporte");
    var entidad = $(this).attr("entidad");

    Swal.fire({
        title: 'Verificar Pól',
        text: "¿Quiere revisar póliza contable?",
        type: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, revisar!'
    }).then((result) => {
        if (result.value) {
            window.open("extensiones/tcpdf/pdf/polizaContable.php?fechaPoliza=" + fechareporte + '&entidad=' + entidad, "_blank");

        }
    })

});

$(document).on("click", ".btnInicialFiscal", async function () {
    var cifInicial = $("#cifInicial").val();
    var impuestoInicial = $("#impuestoInicial").val();
    var btninicia = $(this).attr("btninicia");
    if (cifInicial > 0 && impuestoInicial > 0) {
        var respuesta = await funcionNuevoSaldoContable(btninicia, cifInicial, impuestoInicial);
        if (respuesta[0].resp == 1) {
            Swal.fire({
                title: 'Actualizado con éxito',
                text: "Su nuevo saldo fue agregado con exito!",
                type: 'success',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ok!'
            }).then((result) => {
                if (result.value) {
                    location.reload();
                }
            })
        }
    }

})

$(document).on("change", "#cifInicial", async function () {
    if ($(this).val() > 0) {
        $(this).removeClass("is-invalid");
        $(this).addClass("is-valid");
    }
})

$(document).on("change", "#impuestoInicial", async function () {
    if ($(this).val() > 0) {
        $(this).removeClass("is-invalid");
        $(this).addClass("is-valid");
    }
})


function funcionNuevoSaldoContable(btninicia, cifInicial, impuestoInicial) {
    let respHistorial;
    var datos = new FormData();
    datos.append("idEmpInicalConta", btninicia);
    datos.append("sldContableCif", cifInicial);
    datos.append("sldContableImpts", impuestoInicial);
    $.ajax({
        async: false,
        url: "ajax/sldDiarioContabilidad.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {

            respHistorial = respuesta;
        }, error: function (respuesta) {
            console.log(respuesta);
        }});
    return respHistorial;

}
$(document).on("click", ".btnReportesDia", async function () {
    document.getElementById("divTableReportes").innerHTML = '<table id="tableReportesD" style="font-size:14px;" class="table dt-responsive table-hover table-sm table-striped table-responsible"></table>';
    var fechareporte = $(this).attr("fechareporte");
    var nomVar = "fechaReporteria";
    var resp = await funcionHistorial(nomVar, fechareporte);
    if (resp.idIngRep != "SD") {
        var numero = 0;
        listaGeneral = [];
        for (var i = 0; i < resp.idIngReportes.length; i++) {
            var numero = numero + 1;
            var tipo = '<span class="badge bg-warning">INGRESO</span>';
            var button = '<button type="button" class="btn btn-success" idIng="' + resp.idIngReportes[i].id + '"> Reporte Ingresos <i class="fa fa-file-pdf-o"></i></button>';
            listaGeneral.push([numero, tipo, fechareporte, button]);
        }
    }

    if (resp.idIngRep != "SD") {
        listaGeneral = [];
        for (var i = 0; i < resp.idIngReportes.length; i++) {
            var numero = numero + 1;
            var tipo = '<span class="badge bg-warning">INGRESOS</span>';
            var button = '<button type="button" class="btn btn-success btn-sm btnIngReport" idBod="' + resp.idIngReportes[i].id + '" fechaReporte="' + fechareporte + '"> Reporte <i class="fa fa-file-pdf-o"></i></button>';
            listaGeneral.push([numero, tipo, fechareporte, button]);
        }
    }
    if (resp.idRetRep != "SD") {

        for (var i = 0; i < resp.idRetReportes.length; i++) {
            var numero = numero + 1;
            var tipo = '<span class="badge bg-warning">RETIROS</span>';
            var button = '<button type="button" class="btn btn-success btn-sm btnRetiroReport" idBodRet="' + resp.idRetReportes[i].id + '" fechaReporte="' + fechareporte + '"> Reporte <i class="fa fa-file-pdf-o"></i></button>';
            listaGeneral.push([numero, tipo, fechareporte, button]);
        }
    }

    if (resp.ajustes != "SD") {
        var numero = 0;
        for (var i = 0; i < resp.ajustes.length; i++) {
            var numero = numero + 1;
            var tipo = '<span class="badge bg-warning">AJUSTES</span>';
            var button = '<button type="button" class="btn btn-success btn-sm btnAjusteReport" idBodega="' + resp.ajustes[i].id + '" fechaReporte="' + fechareporte + '"   data-toggle="modal" data-target="#modalAjustes"> Reporte <i class="fa fa-file-pdf-o"></i></button>';
            listaGeneral.push([numero, tipo, fechareporte, button]);
        }
    }
//

    $('#tableReportesD').DataTable({
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
        data: listaGeneral,
        columns: [{
                title: "#"
            }, {
                title: "Tipo"
            }, {
                title: "Fecha"
            }, {
                title: "Acciones"
            }]
    });

})
$(document).on("click", ".btnRetiroReport", async function () {
    var fecha = $(this).attr("fechareporte");
    var idBodega = $(this).attr("idBodRet");
    window.open("extensiones/tcpdf/pdf/ReporteDeRetiros.php?tipoReporte=" + fecha + '&idBodega=' + idBodega, "_blank");

})

$(document).on("click", ".btnIngReport", async function () {
    var fecha = $(this).attr("fechareporte");
    var idBodega = $(this).attr("idBod");
    window.open("extensiones/tcpdf/pdf/ReporteDeIngresos.php?tipoReporte=" + fecha + '&idBodega=' + idBodega, "_blank");

})

$(document).on("click", ".btnAjusteReport", async function () {
    document.getElementById("divViewAjuste").innerHTML = '<table id="tbAjustesContables" class="table table-hover table-sm"></table>';

    var idBodega = $(this).attr("idBodega");
    var fechaReport = $(this).attr("fechaReporte");

    var respDataAjustes = await funcAjustes(idBodega, fechaReport);
    var listaAjustesDB = [];
    var numero = 0;
    for (var i = 0; i < respDataAjustes.length; i++) {

        var numero = numero + 1;
        var idIng = respDataAjustes[i].idIng;

        var numeroPoliza = respDataAjustes[i].numeroPoliza;
        var nitEmpresa = respDataAjustes[i].nitEmpresa;
        var fecha = respDataAjustes[i].fecha;
        var fechaSet = await formato(fecha);
        var nombreEmpresa = respDataAjustes[i].nombreEmpresa;

        var saldoValorCif = respDataAjustes[i].ajusteCif;
        var saldoValorImpuesto = respDataAjustes[i].ajusteImpuesto;

        var cifNumber = new Intl.NumberFormat("en-GT").format(saldoValorCif);
        var impuestoNumber = new Intl.NumberFormat("en-GT").format(saldoValorImpuesto);
        var button = '<button type="button" class="btn btn-danger btn-sm btnPrintIng" idIngPrint=' + idIng + '><i class="fafa-file-pdf"></i></button>';
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


})

function funcAjustes(idBodega, fechaReport) {
    let respHistorial;
    var datos = new FormData();
    datos.append("idBodegaAjuste", idBodega);
    datos.append("fechaReportAjuste", fechaReport);
    $.ajax({
        async: false,
        url: "ajax/sldDiarioContabilidad.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {

            respHistorial = respuesta;
        }, error: function (respuesta) {
            console.log(respuesta);
        }});
    return respHistorial;
}
$(document).on("click", ".btnajusteIngreso", async function () {
    var estado = $(this).attr("estado");
    if (estado == 0) {
        $(this).attr("estado", 1);
        $(this).removeClass('btn-primary');
        $(this).addClass('btn-success');

        document.getElementById("btnajusteIngresos").disabled = true;

    }

})


$(document).on("click", ".btnAjusteRetF", async function () {
    var estado = $(this).attr("estado");
    if (estado == 0) {
        $(this).attr("estado", 1);
        $(this).removeClass('btn-primary');
        $(this).addClass('btn-success');

        document.getElementById("btnAjusteRetFs").disabled = true;

    }

})

$(document).on("click", ".btnCifAjuste", async function () {
    var estado = $(".btnajusteIngreso").attr("estado");
    if (estado == 1) {
        document.getElementById("btnAjusteRetCifFs").disabled = false;
        document.getElementById("btnCifAjustes").disabled = true;
        $(".btnCifAjuste").attr("estado", 1);
        $(".btnCifAjuste").removeClass('btn-outline-dark');
        $(".btnCifAjuste").addClass('btn-dark');

        $(".btnAjusteCifRetF").removeClass('btn-dark');
        $(".btnAjusteCifRetF").addClass('btn-outline-dark');
        $(".btnAjusteCifRetF").attr("estado", 0);

    }
})

$(document).on("click", ".btnAjusteCifRetF", async function () {
    var estado = $(".btnAjusteRetF").attr("estado");
    if (estado == 1) {

        document.getElementById("btnAjusteRetCifFs").disabled = true;
        document.getElementById("btnCifAjustes").disabled = false;
        $(".btnAjusteCifRetF").attr("estado", 1);
        $(".btnAjusteCifRetF").removeClass('btn-outline-dark');
        $(".btnAjusteCifRetF").addClass('btn-dark');

        $(".btnCifAjuste").removeClass('btn-dark');
        $(".btnCifAjuste").addClass('btn-outline-dark');
        $(".btnCifAjuste").attr("estado", 0);


    }
})

$(document).on("click", ".btnImptsAjuste", async function () {
    var estado = $(".btnajusteIngreso").attr("estado");
    if (estado == 1) {

        $(".btnImptsAjuste").attr("estado", 1);
        $(".btnImptsAjuste").removeClass('btn-outline-dark');
        $(".btnImptsAjuste").addClass('btn-dark');
        $(".btnAjusteImptsRetF").removeClass('btn-dark');
        $(".btnAjusteImptsRetF").addClass('btn-outline-dark');
        $(".btnAjusteImptsRetF").attr("estado", 0);
        document.getElementById("btnImptsAjustes").disabled = true;
        document.getElementById("btnAjusteRetImprsF").disabled = false;


    }
})


$(document).on("click", ".btnAjusteImptsRetF", async function () {
    var estado = $(".btnAjusteRetF").attr("estado");
    if (estado == 1) {

        $(".btnAjusteImptsRetF").attr("estado", 1);
        $(".btnAjusteImptsRetF").removeClass('btn-outline-dark');
        $(".btnAjusteImptsRetF").addClass('btn-dark');
        $(".btnImptsAjuste").removeClass('btn-dark');
        $(".btnImptsAjuste").addClass('btn-outline-dark');
        $(".btnImptsAjuste").attr("estado", 0);
        document.getElementById("btnImptsAjustes").disabled = false;
        document.getElementById("btnAjusteRetImprsF").disabled = true;


    }
})

$(document).on("click", ".btnGenerarPolizaConta", async function () {

    var estadoIngCif = $(".btnCifAjuste").attr("estado");
    var estadoIngImpts = $(".btnImptsAjuste").attr("estado");
    var estadoRetCif = $(".btnAjusteCifRetF").attr("estado");
    var estadoRetImpts = $(".btnAjusteImptsRetF").attr("estado");
    if (estadoIngCif == 0 && estadoIngImpts == 0 && estadoRetCif == 0 && estadoRetImpts == 0) {

    } else {
        var nomVar = "ultimaData";
        var data = 1;
        var respUltimaDate = await funcionContabilizarPoliza(nomVar, data);
        if (respUltimaDate != "SD") {
            var fechaMaxima = respUltimaDate;
        } else {
            var fechaMaxima = new Date('DD/MM/YYYY');
        }
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
                        format: 'DD/MM/YYYY'
                    }
                });
            },
        }).then(async function (result) {
            if (result.value) {
                let dateTime = document.getElementById("dateTime").value;
                var fechaObj = new Object();
                fechaObj.timeDate = dateTime;

                var suma = estadoIngCif * 1 + estadoIngImpts * 1 + estadoRetCif * 1 + estadoRetImpts * 1;
                if (suma <= 2) {
                    var nomVar = "cuentasContables";
                    var tipoCuenta = 0;
                    if (estadoIngCif == 1) {
                        var primerValor = "Valor cif ingreso";
                    }
                    if (estadoRetCif == 1) {
                        var primerValor = "Valor cif retiro";
                    }
                    if (estadoIngImpts == 1) {
                        var segundoValor = "Valor impuestos ingreso";
                    }
                    if (estadoRetImpts == 1) {
                        var segundoValor = "Valor impuestos retiro";
                    }
                    var monto1;
                    var monto2;
                    var conceptoRegularizacion;
                    swal.mixin({
                        input: 'text',
                        confirmButtonText: 'Siguiente &rarr;',
                        showCancelButton: true,
                        progressSteps: ['1', '2', '3']
                    }).queue([
                        {
                            title: 'Valor 1',
                            text: 'Ingrese el valor de ' + primerValor,
                            preConfirm: function (value)
                            {
                                monto1 = value;
                            }
                        },
                        {
                            title: 'Valor 2',
                            text: 'Ingrese el valor de ' + segundoValor,
                            preConfirm: function (value)
                            {
                                monto2 = value;
                            }
                        },
                        {
                            title: 'Explicación',
                            html: 'Escriba el motivo de creacion de la póliza <br/> Regularización por : ',
                            preConfirm: function (value)
                            {
                                conceptoRegularizacion = value;
                            }
                        }

                    ]).then(async function (result) {

                        var monto1 = result.value[0] * 1;
                        var monto2 = result.value[1] * 1;

                        var montoParseCFloat = parseFloat(monto1).toFixed(2);
                        var montoParseIFloat = parseFloat(monto2).toFixed(2);



                        var montoParse1 = montoParseCFloat * 1;
                        var montoParse2 = montoParseIFloat * 1;
                        var total = montoParse1 + montoParse2;
                        var montoParse1 = new Intl.NumberFormat("en-GT").format(montoParse1);
                        var montoParse2 = new Intl.NumberFormat("en-GT").format(montoParse2);
                        var total = new Intl.NumberFormat("en-GT").format(total);
                        if (result.value) {
                            console.log(fechaObj.timeDate);
                            document.getElementById('divPolizaAjustes').innerHTML = `
                            <div class="col-12 mx-auto">
                                <h4 class="text-center">AJUSTE CONTABLE FECHA ` + fechaObj.timeDate + `</h4>
                                <table class="table col-12">
                                    <thead class="table-primary">
                                        <tr>
                                        <th scope="col">CUENTA</th>
                                        <th scope="col">NOMBRE DE CUENTA</th>
                                        <th scope="col" style="width: 190px"><center>DEBE</center></th>
                                        <th scope="col" style="width: 190px"><center>HABER</center></th>
                                        </tr>
                                    </thead>
                <tbody id="tableAjustePol">
`;
                            var respsCuentas = await funcionHistorial(nomVar, tipoCuenta);
                            var tipo = 0;
                            /*
                             * SI LA CIF E IMPUESTO SON DE AJUSTE INGRESO SE UTILIZA LA POLIZA DE INGRESO
                             */
                            if (estadoIngCif == 1 && estadoIngImpts == 1) {
                                var cifCuenta = '802103.0102';
                                var cifDebHab = 'DEBE';
                                var impuestoCuenta = '801109.01';
                                var imptDebHab = 'DEBE';
                                var contra = '888888';
                                var contraDebHab = 'HABER';
                            } else if (estadoRetCif == 1 && estadoRetImpts == 1) {//SINO CIF E IMPUESTOS PERTENECEN A RETIRO ES POLIZA DE RETIRO
                                var contra = '888888';
                                var contraDebHab = 'DEBE';
                                var cifCuenta = '802103.0102';
                                var cifDebHab = 'HABER';
                                var impuestoCuenta = '801109.01';
                                var imptDebHab = 'HABER';
                            } else {// SI NO SE MANEJAN Y JUEGAN LAS CUENTAS DEPENDIENDO EL TIPO DE ESTADO
                                var tipo = tipo + 1;
                                if (estadoIngCif == 1) {
                                    var cifCuenta = '802103.0102';
                                    var cifDebHab = 'DEBE';
                                    var contraCif = '888888';
                                    var contraDebHabCif = 'HABER';
                                }
                                if (estadoRetCif == 1) {
                                    var cifCuenta = '802103.0102';
                                    var cifDebHab = 'HABER';
                                    var contraCif = '888888';
                                    var contraDebHabCif = 'DEBE';
                                }

                                if (estadoIngImpts == 1) {
                                    var impuestoCuenta = '801109.01';
                                    var imptDebHab = 'DEBE';
                                    var contraImpts = '888888';
                                    var contraDebHabImpts = 'HABER';
                                }
                                if (estadoRetImpts == 1) {
                                    var impuestoCuenta = '801109.01';
                                    var imptDebHab = 'HABER';
                                    var contraImpts = '888888';
                                    var contraDebHabImpts = 'DEBE';
                                }
                            }
                            if (tipo == 0) {
                                for (var i = 0; i < respsCuentas.length; i++) {
                                    if (respsCuentas[i].cuenta == cifCuenta) {
                                        var nombreCuentaCif = respsCuentas[i].nombreDeCuenta;
                                        var idCif = respsCuentas[i].id;
                                    }
                                }
                                for (var i = 0; i < respsCuentas.length; i++) {
                                    if (respsCuentas[i].cuenta == impuestoCuenta) {
                                        var nombreCuentaImpts = respsCuentas[i].nombreDeCuenta;
                                        var idImpts = respsCuentas[i].id;
                                    }

                                }
                                for (var i = 0; i < respsCuentas.length; i++) {
                                    if (respsCuentas[i].cuenta == contra) {
                                        var nombreContra = respsCuentas[i].nombreDeCuenta;
                                        var idContra = respsCuentas[i].id;
                                    }
                                }
                                if (estadoIngCif == 1 && estadoIngImpts == 1) {
                                    document.getElementById('tableAjustePol').innerHTML += `
                                <tr>
                                    <th scope="row">` + cifCuenta + `</th>
                                    <td>` + nombreCuentaCif + `</td>
                                    <td><h8 class="float-left">Q.</h8><h8 class="float-right">` + montoParse1 + `</h8></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th scope="row">` + impuestoCuenta + `</th>
                                    <td>` + nombreCuentaImpts + `</td>
                                    <td><h8 class="float-left">Q.</h8><h8 class="float-right">` + montoParse2 + `</h8></td>
                                    <td></td>
                                </tr>                        
                                <tr>
                                    <th scope="row">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;` + contra + `</th>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;` + nombreContra + `</td>
                                    <td><h8 class="float-left">Q.</h8><h8 class="float-right"></h8></td>
                                    <td><h8 class="float-left">Q.</h8><h8 class="float-right">` + total + `</h8></td>
                                </tr> 
                                <tr>
                                    <th scope="row"></th>
                                    <td>` + conceptoRegularizacion + `</td>
                                    <td><h8 class="float-left">Q.</h8><h8 class="float-right">` + total + `</h8></td>
                                    <td><h8 class="float-left">Q.</h8><h8 class="float-right">` + total + `</h8></td>
                                </tr>                         
`;

                                    // SI ES UNA POLIZA DE INGRESO EN AJUSTE FIN DE FUNCION

                                    Swal.fire({
                                        width: 280,
                                        height: 150,
                                        title: 'Guardar Poliza',
                                        html: "Desea registrar ajuste contable!",
                                        type: 'info',
                                        position: 'top-end',
                                        allowOutsideClick: false,
                                        showCancelButton: true,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'Si, Guardar!'
                                    }).then(async function (result) {
                                        if (result.value) {
                                            var date = fechaObj.timeDate;
                                            var tipo = "AjusteIngreso";
                                            var resp = await gdPolizaIngresoRetAjuste(date, montoParseCFloat, montoParseIFloat, tipo);
                                            console.log(resp);
                                        }
                                    })
                                }

                                if (estadoRetCif == 1 && estadoRetImpts == 1) {
                                    document.getElementById('tableAjustePol').innerHTML += `
                                <tr>
                                    <th scope="row">` + contra + `</th>
                                    <td>` + nombreContra + `</td>
                                    <td><h8 class="float-left">Q.</h8><h8 class="float-right">` + total + `</h8></td>
                                    <td><h8 class="float-left">Q.</h8><h8 class="float-right"></h8></td>
                                </tr>                             
                                <tr>
                                    <th scope="row">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;` + cifCuenta + `</th>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;` + nombreCuentaCif + `</td>
                                    <td><h8 class="float-left">Q.</h8><h8 class="float-right"></h8></td>
                                    <td><h8 class="float-left">Q.</h8><h8 class="float-right">` + montoParse1 + `</h8></td>
                                </tr>
                                <tr>
                                    <th scope="row">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;` + impuestoCuenta + `</th>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;` + nombreCuentaImpts + `</td>
                                    <td><h8 class="float-left">Q.</h8><h8 class="float-right"></h8></td>
                                    <td><h8 class="float-left">Q.</h8><h8 class="float-right">` + montoParse2 + `</h8></td>
                                </tr>                        
                                <tr>
                                    <th scope="row"></th>
                                    <td>    ` + conceptoRegularizacion + `</td>
                                    <td><h8 class="float-left">Q.</h8><h8 class="float-right">` + total + `</h8></td>
                                    <td><h8 class="float-left">Q.</h8><h8 class="float-right">` + total + `</h8></td>
                                </tr>                         
`;

                                    // SI ES UNA POLIZA DE INGRESO EN AJUSTE FIN DE FUNCION

                                    Swal.fire({
                                        width: 280,
                                        height: 150,
                                        title: 'Guardar Poliza',
                                        html: "Desea registrar ajuste contable!",
                                        type: 'info',
                                        position: 'top-end',
                                        allowOutsideClick: false,
                                        showCancelButton: true,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'Si, Guardar!'
                                    }).then(async function (result) {
                                        if (result.value) {
                                            var date = fechaObj.timeDate;
                                            var tipo = "AjusteRetiro";
                                            var resp = await gdPolizaIngresoRetAjuste(date, montoParseCFloat, montoParseIFloat, tipo);
                                            console.log(resp);
                                        }
                                    })
                                }



                            } else {


                                console.log(estadoIngCif);
                                if (estadoIngCif == 1) {
                                    var cifCuenta = '802103.0102';
                                    for (var i = 0; i < respsCuentas.length; i++) {
                                        if (respsCuentas[i].cuenta == cifCuenta) {
                                            var nombreCuentaCif = respsCuentas[i].nombreDeCuenta;
                                            var idCif = respsCuentas[i].id;
                                        }
                                    }
                                    document.getElementById('tableAjustePol').innerHTML += `
                                <tr>
                                    <th scope="row">` + cifCuenta + `</th>
                                    <td>` + nombreCuentaCif + `</td>
                                    <td><h8 class="float-left">Q.</h8><h8 class="float-right">` + montoParse1 + `</h8></td>
                                    <td></td>
                                </tr>
`;
                                }


                                if (estadoRetCif == 1) {
                                    var contraCif = '888888';
                                    for (var i = 0; i < respsCuentas.length; i++) {
                                        if (respsCuentas[i].cuenta == contraCif) {
                                            var nombreContra = respsCuentas[i].nombreDeCuenta;
                                            var idContra = respsCuentas[i].id;
                                        }

                                    }

                                    document.getElementById('tableAjustePol').innerHTML += `
                                <tr>
                                    <th scope="row">` + contraCif + `</th>
                                    <td>` + nombreContra + `</td>
                                    <td><h8 class="float-left"></h8><h8 class="float-right">` + montoParse1 + `</h8></td>
                                    <td><h8 class="float-left">Q.</h8><h8 class="float-right"></h8></td>
                                </tr>
`;
                                }


                                if (estadoIngImpts == 1) {
                                    var impuestoCuenta = '801109.01';
                                    for (var i = 0; i < respsCuentas.length; i++) {
                                        if (respsCuentas[i].cuenta == impuestoCuenta) {
                                            var nombreCuentaCif = respsCuentas[i].nombreDeCuenta;
                                            var idContra = respsCuentas[i].id;
                                        }

                                    }
                                    document.getElementById('tableAjustePol').innerHTML += `
                                <tr>
                                    <th scope="row">` + impuestoCuenta + `</th>
                                    <td>` + nombreCuentaCif + `</td>
                                    <td><h8 class="float-left">Q.</h8><h8 class="float-right">` + montoParse2 + `</h8></td>
                                    <td></td>
                                </tr>
`;

                                }


                                if (estadoRetImpts == 1) {

                                    var contraImpts = '888888';
                                    for (var i = 0; i < respsCuentas.length; i++) {
                                        if (respsCuentas[i].cuenta == contraImpts) {
                                            var nombreContra = respsCuentas[i].nombreDeCuenta;
                                            var idContra = respsCuentas[i].id;
                                        }

                                    }

                                    document.getElementById('tableAjustePol').innerHTML += `
                                <tr>
                                    <th scope="row">` + contraImpts + `</th>
                                    <td>` + nombreContra + `</td>
                                    <td><h8 class="float-left">Q.</h8><h8 class="float-right">` + montoParse2 + `</h8></td>
                                    <td><h8 class="float-left"></h8><h8 class="float-right"></h8></td>
                                </tr>
`;
                                }
                                if (estadoIngCif == 1) {
                                    var contraCif = '888888';
                                    for (var i = 0; i < respsCuentas.length; i++) {
                                        if (respsCuentas[i].cuenta == contraCif) {
                                            var nombreContra = respsCuentas[i].nombreDeCuenta;
                                            var idContra = respsCuentas[i].id;
                                        }

                                    }
                                    document.getElementById('tableAjustePol').innerHTML += `
                                <tr>
                                    <th scope="row">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;` + contraCif + `</th>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;` + nombreContra + `</td>
                                    <td><h8 class="float-left"></h8><h8 class="float-right"></h8></td>
                                    <td><h8 class="float-left">Q.</h8><h8 class="float-right">` + montoParse1 + `</h8></td>
                                </tr>
`;
                                }
                                if (estadoRetCif == 1) {
                                    var cifCuenta = '802103.0102';
                                    for (var i = 0; i < respsCuentas.length; i++) {
                                        if (respsCuentas[i].cuenta == cifCuenta) {
                                            var nombreCuentaCif = respsCuentas[i].nombreDeCuenta;
                                            var idCif = respsCuentas[i].id;
                                        }
                                    }
                                    document.getElementById('tableAjustePol').innerHTML += `
                                <tr>
                                    <th scope="row">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;` + cifCuenta + `</th>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;` + nombreCuentaCif + `</td>
                                    <td><h8 class="float-left"></h8><h8 class="float-right"></h8></td>
                                    <td><h8 class="float-left">Q.</h8><h8 class="float-right">` + montoParse1 + `</h8></td>
                                </tr>
`;

                                }

                                if (estadoIngImpts == 1) {
                                    var contraImpts = '888888';

                                    for (var i = 0; i < respsCuentas.length; i++) {
                                        if (respsCuentas[i].cuenta == contraImpts) {
                                            var nombreContra = respsCuentas[i].nombreDeCuenta;
                                            var idContra = respsCuentas[i].id;
                                        }

                                    }

                                    document.getElementById('tableAjustePol').innerHTML += `
                                <tr>
                                    <th scope="row">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;` + contraImpts + `</th>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;` + nombreContra + `</td>
                                    <td><h8 class="float-left"></h8><h8 class="float-right"></h8></td>
                                    <td><h8 class="float-left">Q.</h8><h8 class="float-right">` + montoParse2 + `</h8></td>
                                </tr>
`;
                                }



                                if (estadoRetImpts == 1) {
                                    var impuestoCuenta = '801109.01';
                                    for (var i = 0; i < respsCuentas.length; i++) {
                                        if (respsCuentas[i].cuenta == impuestoCuenta) {
                                            var nombreContra = respsCuentas[i].nombreDeCuenta;
                                            var idContra = respsCuentas[i].id;
                                        }

                                    }
                                    document.getElementById('tableAjustePol').innerHTML += `
                                <tr>
                                    <th scope="row">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;` + impuestoCuenta + `</th>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;` + nombreContra + `</td>
                                    <td><h8 class="float-left"></h8><h8 class="float-right"></h8></td>
                                    <td><h8 class="float-left">Q.</h8><h8 class="float-right">` + montoParse2 + `</h8></td>
                                </tr>
`;
                                }

                                document.getElementById('tableAjustePol').innerHTML += `
                                <tr>
                                    <th scope="row"></th>
                                    <td>    ` + conceptoRegularizacion + `</td>
                                    <td><strong style="color:red"><h8 class="float-left">Q.</h8><h8 class="float-right">` + total + `</h8></strong></td>
                                    <td><h8 class="float-left">Q.</h8><h8 class="float-right">` + total + `</h8></td>
                                </tr>     
                                </tbody>
                                </table>
`;

                                // SI ES UNA POLIZA DE INGRESO EN AJUSTE FIN DE FUNCION

                                Swal.fire({
                                    width: 280,
                                    height: 150,
                                    title: 'Guardar Poliza',
                                    html: "Desea registrar ajuste contable!",
                                    type: 'info',
                                    position: 'top-end',
                                    allowOutsideClick: false,
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Si, Guardar!'
                                }).then(async function (result) {
                                    if (result.value) {
                                        var date = fechaObj.timeDate;
                                        var tipo = "AjusteDiferente";
                                        var resp = await gdAjustesMultiple(date, montoParseCFloat, montoParseIFloat, tipo, estadoIngImpts, estadoRetImpts, estadoIngCif, estadoRetCif);
                                        console.log(resp);
                                    }
                                })


                            }
                        }



                    })
                }
            }
        })
    }

})



function gdPolizaIngresoRetAjuste(date, montoParse1, montoParse2, tipo) {
    let respAjust;
    var datos = new FormData();
    datos.append("datePolAjuste", date);
    datos.append("montoCif", montoParse1);
    datos.append("montoImpuesto", montoParse2);
    datos.append("tipoAjuste", tipo);
    $.ajax({
        async: false,
        url: "ajax/sldDiarioContabilidad.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            respAjust = respuesta;
        }, error: function (respuesta) {
            console.log(respuesta);
        }});
    return respAjust;
}

function gdAjustesMultiple(date, montoParseCFloat, montoParseIFloat, tipo, estadoIngImpts, estadoRetImpts, estadoIngCif, estadoRetCif) {
    let respAjust;
    var datos = new FormData();
    datos.append("ajusteMultDate", date);
    datos.append("montoCifMult", montoParseCFloat);
    datos.append("montoImpuestoMult", montoParseIFloat);
    datos.append("tipoAjusteMult", tipo);
    datos.append("estadoIngImptsMult", estadoIngImpts);
    datos.append("estadoIngCifMult", estadoIngCif);
    datos.append("estadoRetCifMult", estadoRetCif);
    datos.append("estadoRetImptsMult", estadoRetImpts);
    $.ajax({
        async: false,
        url: "ajax/sldDiarioContabilidad.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            respAjust = respuesta;
        }, error: function (respuesta) {
            console.log(respuesta);
        }});
    return respAjust;

}
$(document).on("click", ".btnCorteDiario", async function () {
    var fechareporte = $(this).attr("fechareporte");
    var respHistoriaImpts = await funcionCorteDiario(fechareporte);
})


function funcionCorteDiario(fechareporte) {
    let respHistorial;
    var datos = new FormData();
    datos.append("fechaCorteConta", fechareporte);
    $.ajax({
        async: false,
        url: "ajax/sldDiarioContabilidad.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            respHistorial = respuesta;
        }, error: function (respuesta) {
            console.log(respuesta);
        }});
    return respHistorial;
}