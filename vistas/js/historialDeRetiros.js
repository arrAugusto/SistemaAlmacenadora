/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).on("click", ".btnAnularOperacion", async function () {
    var idpoliza = $(this).attr("idpoliza");
    var idret = $(this).attr("idret");
    /* inputOptions can be an object or Promise */
    const inputOptions = new Promise((resolve) => {
        setTimeout(() => {
            resolve({
                'Recibo': 'Recibo',
                'Retiro': 'Retiro',
            })
        }, 1000)
    })

    const {value: tipoAnulacion} = await Swal.fire({
        title: 'Tipo de Anulacion',
        input: 'radio',
        inputOptions: inputOptions,
        allowOutsideClick: false,
        inputValidator: (value) => {
            if (!value) {
                return 'No selecciono una opción!'
            }
        }
    })

    if (tipoAnulacion) {
        console.log(tipoAnulacion);
        document.getElementById("idTAnula").innerHTML = 'ANULACIÓN DE : ' + tipoAnulacion.toUpperCase();
        document.getElementById("numeroPoliza").value = idpoliza;
        if (tipoAnulacion == "Recibo") {

            $("#anulacionSistemaRetRec").attr("idTrans", 0);
        } else {
            $("#anulacionSistemaRetRec").attr("idTrans", 1);

        }
        $("#anulacionSistemaRetRec").attr("tipoAnula", tipoAnulacion.toUpperCase());
        $("#anulacionSistemaRetRec").attr("idOperacion", idret);
        $("#anulacionSistemaRetRec").html("ANULAR " + tipoAnulacion.toUpperCase() + '&nbsp;&nbsp;<i class="fa fa-trash"></i>');
        Swal.fire({html: `Selecciono : ${tipoAnulacion}`})
    }
})

$(document).on("click", "#anulacionSistemaRetRec", function () {
    var tipoAnula = $(this).attr("tipoAnula");
    var idtrans = $(this).attr("idtrans");
    var idoperacion = $(this).attr("idoperacion");
    var textMotivo = document.getElementById("textMotivoAnulacion").value;
    var motivoAnula = textMotivo.substring(19, textMotivo.length);

    //}).then(async function (result) {
    Swal.fire({
        title: '¿Seguro que desea anular?',
        text: "Quiere anular el " + tipoAnula + " !",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Anular!'
    }).then(async function (result) {
        if (result.value) {
            var datos = new FormData();
            datos.append("idtrans", idtrans);
            datos.append("idoperacion", idoperacion);
            datos.append("motivoAnula", motivoAnula);
            $.ajax({
                async: false,
                url: "ajax/retiroOpe.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (respuesta) {
                    console.log(respuesta);
                    if (respuesta[0].resp == 1) {
                        swal({
                            title: "Anulado",
                            text: "El ingreso se anulo correctamente",
                            type: "success"
                        }).then(okay => {
                            if (okay) {
                                location.reload();
                            }
                        });
                    } else {
                        Swal.fire({
                            position: 'top-center',
                            type: 'error',
                            title: 'Error interno consulte a sitema',
                            showConfirmButton: false,
                            closeConfirm: true

                        });
                    }
                }, error: function (respuesta) {
                    console.log(respuesta);
                }
            });
        }
    })
});





$(document).on("click", ".btnHistoriaExcelRec", async function () {
    var estadoRet = $(this).attr("estadorep");
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


            var nomVar = "generateRecHistoria";
            var resp = await reporteRecibosExcel(nomVar, estadoRet);
            var nombreReporte = 'HISTORIAL DE RETIROS, ESTADOS DE INGRESO: "-1 ANULADO :: 1 REGISTRADO OPERACIONES :: 2,3 PENDIENTE CULMINAR BODEGA :: 4 FINALIZADO CON NUMERO CORRELATIVO Y PENDIENTE DE CONTABILIZAR :: 5 POR CONTABILIZAR EN EL REPORTE :: 6 CONTABILIZADO"';
            var nombreEncabezado = "DescargaReporteExcel";
            var nombreFile = "ReporteDeIngresos_";
            var creaExcel = await JSONToCSVDescargaExcel(resp, nombreEncabezado, nombreReporte, nombreFile, true);
            console.log(resp);
        }
    })
})

function reporteRecibosExcel(nomVar, estadoRet) {
    let respFunc;
    var datos = new FormData();
    datos.append(nomVar, estadoRet);
    $.ajax({
        async: false,
        url: "ajax/historiaIngresosFisacales.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);

            respFunc = respuesta;
        }, error: function (respuesta) {
            console.log(respuesta);
            respFunc = respuesta;
        }})
    return respFunc;
}

$(document).on("click", ".btnHistoriaExcelRet", async function () {
    var estadoRet = $(this).attr("estadorep");
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


            var nomVar = "generateRetHistoria";
            var resp = await reporteRecibosExcel(nomVar, estadoRet);
            var nombreReporte = 'HISTORIAL DE RETIROS, ESTADOS DE INGRESO: "-1 ANULADO :: 1 REGISTRADO OPERACIONES :: 2,3 PENDIENTE CULMINAR BODEGA :: 4 FINALIZADO CON NUMERO CORRELATIVO Y PENDIENTE DE CONTABILIZAR :: 5 POR CONTABILIZAR EN EL REPORTE :: 6 CONTABILIZADO"';
            var nombreEncabezado = "DescargaReporteExcel";
            var nombreFile = "ReporteDeIngresos_";
            var creaExcel = await JSONToCSVDescargaExcel(resp, nombreEncabezado, nombreReporte, nombreFile, true);
            console.log(resp);
        }
    })
})

