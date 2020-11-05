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
        if (tipoAnulacion == "Retiro") {
            $("#divEdicionRetiro").removeClass("divOculto");
            $("#divEdicionRetiro").removeClass("visuallyHidden");
            var consulta = "Retiro";
            var respuesta = await ajaxEdicionRetiroOpe(consulta, idret);
            if (respuesta!="SD") {
                document.getElementById("txtNitSalida").value = respuesta[0].nitEmpresa;
                $("#txtNitSalida").trigger('change');
                
                document.getElementById("polizaRetiro").value = respuesta[0].polizaRetiro;
                $("#polizaRetiro").trigger('change');
                
                document.getElementById("regimen").value = respuesta[0].regimenSalida;
                $("#regimen").trigger('change');
                
                document.getElementById("valorTAduana").value = respuesta[0].valorTotalAduana;
                $("#valorTAduana").trigger('change');
                
                document.getElementById("cambio").value = respuesta[0].tipoCambio;
                $("#cambio").trigger('change');
                
                document.getElementById("calculoValorImpuesto").value = respuesta[0].valorTotalAduana;
                $("#calculoValorImpuesto").trigger('change');

                document.getElementById("pesoKg").value = respuesta[0].peso;
                $("#pesoKg").trigger('change');

                document.getElementById("cantBultos").value = respuesta[0].bultos;
                $("#cantBultos").trigger('change');

                document.getElementById("descMercaderia").value = respuesta[0].descripcion;
                $("#descMercaderia").trigger('change');           
                
                document.getElementById("textParamBusqRet").value = respuesta[0].numeroPoliza;
                $("#textParamBusqRet").trigger('change');   
                $(".btnBuscaRetiro").click(); 
                
                 
                setTimeout(function(){ $("#buttonDisparoDetalle").click(); }, 2000);
                var json = JSON.parse(respuesta[0].detallesRebajados);

                console.log(json);
                document.getElementById("divBottoneraAccion").innerHTML = `
         <div class="btn-group">
         <button type="button" class="btn btn-warning btn-block btnEditarRetiroVeh" idRet=${idret} id="editRetiroFVeh" estado=0 >Editar&nbsp;&nbsp;&nbsp;<i class="fa fa-edit" style="font-size:20px" aria-hidden="true"></i></button>
         </div>`;
                for (var i = 0; i < json.length; i++) {
                    var idDetalle = json[i].idDetalles;
                    var nomVar = "idDetRevEd";
                    var respuesta = await datosDetallesEdicionRet(nomVar, idDetalle)
                    console.log(respuesta);
                    var buttonDR = `<button type="button" class="btn btn-primary" id="buttonStock">` + respuesta[0].stock + `</button>`;
                    var dataChas = "Mercaderia";
                    var valTextDet = json[i].cantBultos;
                    var empresa = respuesta[0].empresa;
                    var idPoling = respuesta[0].numeroPoliza;
                        document.getElementById("divListaDetalles").innerHTML += `<div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <button type="button" class="btn btn-danger" id="buttonTrash" numOrigen=` + idDetalle + `><i class="fa fa-trash"></i></button>
                        ` + buttonDR + `
                        <button type="button" class="btn btn-warning btnPolUbica" idDet=`+idDetalle+` estado=0>Pól. ` + idPoling + `</button>                    
                      </div>
                      <!-- /btn-group -->
                      <input type="text" class="form-control" id="texToEmpresaVal" value="` + empresa + `" readOnly="readOnly" />
                      <input type="numeric" class="form-control" id="texToBultosVal" value="` + valTextDet + `" />
                    </div>`;
                }
            }
        }
        Swal.fire({html: `Selecciono : ${tipoAnulacion}`})
    }
})

function datosDetallesEdicionRet(nomVar, estadoRet) {
    let respFunc;
    var datos = new FormData();
    datos.append(nomVar, estadoRet);
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
            respFunc = respuesta;
        }, error: function (respuesta) {
            console.log(respuesta);
            respFunc = respuesta;
        }})
    return respFunc;
}

function ajaxEdicionRetiroOpe(consulta, idret) {
    let respFunc;
    var datos = new FormData();
    datos.append("tipoConsulRet", consulta);
    datos.append("idRetConsul", idret);

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
            if (respuesta != "SD") {
                respFunc = respuesta;
            } else {
                respFunc = false;

            }
        }, error: function (respuesta) {
            console.log(respuesta);
        }
    })
    return respFunc;
}

$(document).on("click", "#anulacionSistemaRetRec", function () {
    var tipoAnula = $(this).attr("tipoAnula");
    var idtrans = $(this).attr("idtrans");
    var idoperacion = $(this).attr("idoperacion");
    var textMotivo = document.getElementById("textMotivoAnulacion").value;
    var motivoAnula = textMotivo.substring(19, textMotivo.length);
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
// DATATABLE JQUERY PAGINACION CON AJAX Y JSON
// PAGINACION PARA EVITAR TIEMPO DE ESPERA Y MALA EXPERIENCIA AL USUARIO

//CARGAR DATATABLE HISTORIAL DE INGRESOS FISCALES CON DATOS JSON

$(document).ready(function () {

    if ($("#tablasHistRetiro").length >= 1) {

        $.ajax({

            url: "ajax/datatableHistorialRetiros.ajax.php",

            success: function (respuesta) {
                console.log(respuesta);
            }

        })
    }
})

$(document).ready(function () {
    if ($("#tablasHistRetiro").length >= 1) {
        $('#tablasHistRetiro').DataTable({
            "bProcessing": true,
            "sAjaxSource": "ajax/datatableHistorialRetiros.ajax.php",
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