$(document).on("click", ".btnContabilizarRet", async function () {
    var idRet = $(this).attr("idRet");
    var fechaCongeladaConta = localStorage.getItem('fechaCongeladaConta');
    if (fechaCongeladaConta != "" || fechaCongeladaConta != "undefined") {
        swal({
            title: "¿Quiere contabilizar?",
            text: 'Presione "Contabilizar", para guardar la transacción',
            type: "info",
            showCancelButton: true,
            confirmButtonText: 'Contabilizar',
            confirmButtonColor: '#642EFE',
            allowOutsideClick: false,              
            cancelButtonColor: '#DF0101'
        }).then(async function (result) {
            console.log(result);
            if (result.value) {
                var nomVar = "idRetContabilidad";
                var resp = await funcionContabilizarRetiro(nomVar, idRet, fechaCongeladaConta);
                if (resp[0]["resp"] == 1) {
                    Swal.fire({
                        title: 'El retiro se contabilizo con exito',
                        type: 'success',
                        allowOutsideClick: false,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        if (result.value) {
                            location.reload();
                        }
                    })
                }
            }
        });
    } else {
        Swal.fire(
                'Fecha contabilidad!',
                'Selecciona fecha contable y luego haz click en el boton verde!',
                'error'
                )
        return false;

    }
});
function funcionContabilizarRetiro(nomVar, idRet, fechaCongeladaConta) {
    let respEdicion;
    var datos = new FormData();
    datos.append(nomVar, idRet);
    datos.append("fechaRetContabi", fechaCongeladaConta);
    $.ajax({
        async: false,
        url: "ajax/contabilidadRetiro.ajax.php",
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
function funcionContabilizarRet(nomVar, idRet) {
    let respEdicion;
    var datos = new FormData();
    datos.append(nomVar, idRet);
    $.ajax({
        async: false,
        url: "ajax/contabilidadRetiro.ajax.php",
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
$(document).on("click", ".btnImpRepContableRet", async function () {
    var retiro = "retiro";
    var idBodega = $(this).attr("idBodega");
    window.open("extensiones/tcpdf/pdf/ReporteDeRetiros.php?tipoReporte=" + retiro + "&idBodega=" + idBodega, "_blank");
});

$(document).on("click", ".btnViewContabilidad", async function () {
    document.getElementById("divReporteIngresosView").innerHTML = '<table id="tableReportIngView" style="font-size:14px;" class="table table-hover table-sm"></table>';
    var numIdentReporte = $(this).attr("btnviewconta");
    var nomVar = "reportContaIdent";
    var respReporte = await funcionContabilizarRet(nomVar, numIdentReporte);
    console.log(respReporte);
    if (respReporte != "SD") {
        listaIng = [];
        var numero = 0;
        var totalBultos = 0;
        var totalCif = 0;
        var totalValImpuesto = 0;
        for (var i = 0; i < respReporte.length; i++) {
            var numero = numero + 1;
            var identIng = respReporte[i].identIng;
            var nitEmpresa = respReporte[i].nitEmpresa;
            var nombreEmpresa = respReporte[i].nombreEmpresa;
            var numeroDeIngreso = respReporte[i].numeroDeIngreso;
            var numeroPoliza = respReporte[i].numeroPoliza;
            var regimen = respReporte[i].regimen;
            var bultos = respReporte[i].bultos;
            var totalValorCif = respReporte[i].totalValorCif;
            var valorImpuesto = respReporte[i].valorImpuesto;

            var totalBultos = totalBultos + bultos;
            var totalCif = totalCif + totalValorCif;
            var totalValImpuesto = totalValImpuesto + valorImpuesto;




            var button = '<button type="button" class="btn btn-danger btn-sm btnPrintIng" idIngPrint=' + identIng + '><i class="fa fa-file-pdf-o"></i></button>';
            listaIng.push([numero, nitEmpresa, nombreEmpresa, numeroDeIngreso, numeroPoliza, regimen, bultos, totalValorCif, valorImpuesto, button]);
        }
        $('#tableReportIngView').DataTable({
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
            data: listaIng,
            columns: [{
                    title: "#"
                }, {
                    title: "Nit"
                }, {
                    title: "Nombre Empresa"
                }, {
                    title: "No. Ingreso"
                }, {
                    title: "Poliza"
                }, {
                    title: "Reg."
                }, {
                    title: "Bultos"
                }, {
                    title: "Cif"
                }, {
                    title: "Impuestos"
                }, {
                    title: "PDF"
                }]
        });
        var totalCif = parseFloat(totalCif).toFixed(2);
        var numberCif = new Intl.NumberFormat("en-GT").format(totalCif);

        var totalValImpuesto = parseFloat(totalValImpuesto).toFixed(2);
        var NumberImpuesto = new Intl.NumberFormat("en-GT").format(totalValImpuesto);

        $("#tableReportIngView").append(`
        <th colspan="6"  style="font-size:17px;" ><center>TOTALES</center></th>
        <th>` + totalBultos + `</th>
        <th>` + numberCif + `</th>
        <th>` + NumberImpuesto + `</th>
        <th></th>
        
`);
    }
});


$(document).on("click", ".btnPrintIng", async function () {
    var identIng = $(this).attr("idingprint");
    window.open("extensiones/tcpdf/pdf/Ingreso-oficina-fiscal.php?codigo=" + identIng, "_blank");
});



$(document).on("click", ".btnViewContabilidadRet", async function () {
    document.getElementById("divReporteIngresosView").innerHTML = '';
    document.getElementById("divReporteIngresosView").innerHTML = '<table id="tbRepeRetContabilidad" style="font-size:12px;" class="table table-hover table-sm"></table>';
    var idIndentRet = $(this).attr("btnviewcontaret");
    var nomVar = "mostrarRepRetiro";


    var respReporteRet = await funcionContabilizarRet(nomVar, idIndentRet);
    var numero = 0;
    var totalBultos = 0;
    var numberCif = 0;
    var NumberImpuesto = 0;
    listaRepRetiro = [];
    for (var i = 0; i < respReporteRet.length; i++) {
        var numero = numero + 1;
        var numNit = respReporteRet[i].numNit;
        var empresa = respReporteRet[i].empresa;
        var numeroRetiro = '<strong>' + respReporteRet[i].numeroRetiro + '</strong>';
        var numeroIngreso = respReporteRet[i].numeroIngreso;
        var polRet = respReporteRet[i].polRet;
        var regimenSalida = respReporteRet[i].regimenSalida;
        var bultosRet = respReporteRet[i].bultosRet;
        var totalValorCif = respReporteRet[i].totalValorCif;
        var valorImpuesto = respReporteRet[i].valorImpuesto;
        var identRet = respReporteRet[i].identRet;
        var identIng = respReporteRet[i].idIngOp;

        var totalCifParse = parseFloat(totalValorCif).toFixed(2);
        var totalImptParse = parseFloat(valorImpuesto).toFixed(2);

        var totalCifNum = new Intl.NumberFormat("en-GT").format(totalCifParse);
        var totalImptNum = new Intl.NumberFormat("en-GT").format(totalImptParse);


        var totalBultos = totalBultos + bultosRet;
        var numberCif = numberCif + totalValorCif;
        var NumberImpuesto = NumberImpuesto + valorImpuesto;
        var button = '<div class="btn-group" role="group"><button type="button" class="btn btn-success btn-sm btnPrintIng" idIngPrint=' + identIng + '>Ing. <i class="fa fa-file-pdf-o"></i></button><button type="button" class="btn btn-danger btn-sm btnViewPDFRet" idRetPrint=' + identRet + '>Ret. <i class="fa fa-file-pdf-o"></i></button></button>';
        listaRepRetiro.push([numero, numNit, empresa, numeroRetiro, numeroIngreso, polRet, regimenSalida, bultosRet, totalCifNum, totalImptNum, button]);

    }
    $('#tbRepeRetContabilidad').DataTable({
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
        data: listaRepRetiro,
        columns: [{
                title: "#"
            }, {
                title: "Nit"
            }, {
                title: "Nombre Empresa"
            }, {
                title: "No. Retiro"
            }, {
                title: "No. Ingreso"
            }, {
                title: "Poliza Retiro"
            }, {
                title: "Reg."
            }, {
                title: "Bultos"
            }, {
                title: "Cif"
            }, {
                title: "Impuestos"
            }, {
                title: "PDF"
            }]
    });

    var numberCifTotal = new Intl.NumberFormat("en-GT").format(numberCif);
    var NumberImpuestoTotal = new Intl.NumberFormat("en-GT").format(NumberImpuesto);
    $("#tbRepeRetContabilidad").append(`
        <th colspan="7"  style="font-size:17px;" ><center>TOTALES</center></th>
        <th>` + totalBultos + `</th>
        <th>` + numberCifTotal + `</th>
        <th>` + NumberImpuestoTotal + `</th>
        <th></th>
        
`);

});

$(document).on("click", ".btnViewPDFRet", async function () {
    var idRetPrint = $(this).attr("idRetPrint");
    window.open("extensiones/tcpdf/pdf/Retiro-fiscal.php?codigo=" + idRetPrint, "_blank");
})


function formato(texto) {
    return texto.replace(/^(\d{4})-(\d{2})-(\d{2})$/g, '$3/$2/$1');
}

$(document).on("click", ".btnDescontabilizar", async function () {
    var idRet = $(this).attr("idRet");
    swal({
        title: "¿Quiere revertir el retiro contable?",
        text: 'Presione "Revertir", para guardar la transacción',
        type: "info",
        showCancelButton: true,
        confirmButtonText: 'Revertir',
        confirmButtonColor: '#642EFE',
        allowOutsideClick: false,
        cancelButtonColor: '#DF0101'
    }).then(async function (result) {
        if (result.value) {
            var nomVar = "descontabilizaRet";
            var respuesta = await funcionContabilizarRet(nomVar, idRet);
            if (respuesta) {
                Swal.fire({
                    title: 'Reversion Exitosa',
                    text: "El retiro fue revertido del reporte!",
                    type: 'success',
                    confirmButtonColor: '#3085d6',
                    allowOutsideClick: false,
                    confirmButtonText: 'Ok!'
                }).then((result) => {
                    if (result.value) {
                        location.reload();
                    }
                })
            }

        }
    })


})
$(document).on("click", "#btnReimprimeRec", async function () {
 var idret = $(this).attr("idret");
 window.open("extensiones/tcpdf/pdf/Recibo-fiscal.php?codigo=" + idret, "_blank");
 
})
$(document).on("click", "#btnReimprimeRet", async function () {
 var idret = $(this).attr("idret");
           window.open("extensiones/tcpdf/pdf/Retiro-fiscal.php?codigo=" + idret, "_blank");
 
})

