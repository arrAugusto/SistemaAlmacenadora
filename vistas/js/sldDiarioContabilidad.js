$(document).on("click", ".btnHistoriaSaldos", async function () {
    document.getElementById("divSaldosCif").innerHTML = '<table id="tableSaldosCif" style="font-size:14px;" class="table dt-responsive table-hover table-sm table-striped table-responsible"></table>';
    document.getElementById("divImpuesto").innerHTML = '<table id="tableSaldosImpts" style="font-size:14px;" class="table dt-responsive table-hover table-sm table-striped table-responsible"></table>';

    var idEmpresa = $(this).attr("btnverhistoria");
    var nomVar = "viewHistorialCif";
    var respHistoriaCif = await funcionHistorial(nomVar, idEmpresa);
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
        listaCif.push([numero, fechaMov, debe, haber, saldo]);
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
        listaImpts.push([numero, fechaMov, debe, haber, saldo]);
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
    lstFechaCorte = [];
    var numero = 0;
    for (var i = 0; i < respHistoriaImpts.length; i++) {
        var numero = numero + 1;
        var fechaCorte = respHistoriaImpts[i].fechaPendiente;
        var fecha = await formato(fechaCorte);
        var button = '<div class="btn-group"><button type="button" class="btn btn-outline-danger btnVerPoliza btn-sm" fechaReporte="' + fecha + '" entidad="' + cortePendiente + '">Póliza<i class="fa fa-file-pdf-o"></i></button><button type="button" class="btn btn-outline-success btn-sm btnVerReportes" fechaReporte="' + fecha + '" entidad="' + cortePendiente + '">Reportes </button></div>';
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
        title: 'Verificar Póliza',
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

$(document).on("click", ".btnVerReportes", async function () {
    
})

