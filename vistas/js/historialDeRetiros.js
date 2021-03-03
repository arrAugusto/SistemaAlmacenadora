$(document).on("click", ".btnAnularRetiro_recibo", async function () {
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
        title: 'Tipo de anulación',
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
        if (tipoAnulacion == "Retiro") {

            const {value: text} = await Swal.fire({
                title: 'Motivo de anulación',
                input: 'textarea',
                inputLabel: 'Message',
                allowOutsideClick: false,
                inputPlaceholder: 'Ejemplo : Mala rebaja en el inventario',
                inputAttributes: {
                    'aria-label': 'Ejemplo : Mala rebaja en el inventario'
                },
                showCancelButton: true
            })

            if (text) {
                var resp = await anulacionDeRetiro(idret, text);
                if (resp[0]["resp"] == 1) {
                    Swal.fire({
                        title: 'Retiro de vehículos nuevos anulado correctamente',
                        type: 'success',
                        allowOutsideClick: false,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok!'
                    }).then((result) => {
                        if (result.value) {
                            location.reload();
                        }
                    })
                }
            }
        }
    }
})

function anulacionDeRetiro(idret, text) {
    let respFunc;
    var datos = new FormData();
    datos.append("AnularRetiro", idret);
    datos.append("motvAnulacion", text);
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
        title: 'Tipo de edición',
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
        if (tipoAnulacion == "Retiro") {
            document.getElementById("divListaDetalles").innerHTML = "";
            setTimeout(function () {
                $("#buttonDisparoDetalle").click();
            }, 2500);

            $("#divEdicionRetiro").removeClass("divOculto");
            $("#divEdicionRetiro").removeClass("visuallyHidden");
            if ($("#divDataPiloto").length > 0) {
                $("#divDataPiloto").remove();
            }

            if ($("#divDataLic").length > 0) {
                $("#divDataLic").remove();
            }

            if ($("#divPlaca").length > 0) {
                $("#divPlaca").remove();
            }

            if ($("#divCont").length > 0) {
                $("#divCont").remove();
            }

            var consulta = "Retiro";
            var respuesta = await ajaxEdicionRetiroOpe(consulta, idret);
            console.log(respuesta);
            console.log(respuesta[1]);
            document.getElementById("hiddeniddeingreso").value = respuesta[0][0].idIng;
            if (respuesta[1] != "SD") {
                document.getElementById("hiddenGdVehMerc").value = "vehN";
            } else if (respuesta[0][0].countChasUsados > 0) {
                document.getElementById("hiddenGdVehMerc").value = "vehUs";
            } else {
                document.getElementById("hiddenGdVehMerc").value = "vehM";
            }
            if (respuesta != "SD") {
                document.getElementById("txtNitSalida").value = respuesta[0][0].nitEmpresa;
                $("#txtNitSalida").trigger('change');

                document.getElementById("polizaRetiro").value = respuesta[0][0].polizaRetiro;
                $("#polizaRetiro").trigger('change');

                document.getElementById("regimen").value = respuesta[0][0].regimenSalida;
                $("#regimen").trigger('change');

                document.getElementById("valorTAduana").value = respuesta[0][0].valorTotalAduana;
                $("#valorTAduana").trigger('change');

                document.getElementById("cambio").value = respuesta[0][0].tipoCambio;
                $("#cambio").trigger('change');

                document.getElementById("calculoValorImpuesto").value = respuesta[0][0].valorImpuesto;
                $("#calculoValorImpuesto").trigger('change');

                document.getElementById("pesoKg").value = respuesta[0][0].peso;
                $("#pesoKg").trigger('change');

                document.getElementById("cantBultos").value = respuesta[0][0].bultos;
                $("#cantBultos").trigger('change');

                document.getElementById("descMercaderia").value = respuesta[0][0].descripcion;
                $("#descMercaderia").trigger('change');

                document.getElementById("textParamBusqRet").value = respuesta[0][0].numeroPoliza;
                $("#textParamBusqRet").trigger('change');
                $(".btnBuscaRetiro").click();

                if (respuesta[1] == "SD") {

                    var json = JSON.parse(respuesta[0][0].detallesRebajados);
                    console.log(json);


                    for (var i = 0; i < json.length; i++) {
                        var idDetalle = json[i].idDetalles;
                        var nomVar = "idDetRevEd";
                        var respuesta = await datosDetallesEdicionRet(nomVar, idDetalle)

                        var buttonDR = `<button type="button" class="btn btn-primary" id="buttonStock">` + respuesta[0].stock + `</button>`;
                        var dataChas = "Mercaderia";
                        var valTextDet = json[i].cantBultos;
                        var empresa = respuesta[0].empresa;
                        var idPoling = respuesta[0].numeroPoliza;
                        var valPosSalidaEdit = json[i].valPosSalidaEdit;
                        var valMtsSalidaEdit = json[i].valMtsSalidaEdit;
                        var estadoDet = 0;
                        if (json[i].estadoDet == 2) {
                            var estadoDet = estadoDet + 1;
                            document.getElementById("divListaDetalles").innerHTML += `<div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <button type="button" class="btn btn-danger" id="buttonTrash" numOrigen=` + idDetalle + `><i class="fa fa-trash"></i></button>
                        ` + buttonDR + `
                        <button type="button" class="btn btn-warning btnPolUbica" idDet=` + idDetalle + ` estado=0>Pól. ` + idPoling + `</button>                    
                      </div>
                      <!-- /btn-group -->
                   
                      <input type="text" class="form-control" id="texToEmpresaVal` + idDetalle + `" value="` + empresa + `" readOnly="readOnly" />
                        <span class="badge bg-danger pull-right" style="display:block;">BLTS</span>
                      <input type="number" class="form-control" id="texToBultosVal` + idDetalle + `" value="` + valTextDet + `" />
                        <span class="badge bg-danger pull-right" style="display:block;">POS.</span>
                      <input type="number" class="form-control" id="textPosEdit` + idDetalle + `" value="` + valPosSalidaEdit + `" />
                        <span class="badge bg-danger pull-right" style="display:block;">MTS.</span>
                      <input type="number" class="form-control" id="textMtsEdit` + idDetalle + `" value="` + valMtsSalidaEdit + `" />
                    </div>`;
                        } else {
                            document.getElementById("divListaDetalles").innerHTML += `<div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <button type="button" class="btn btn-danger" id="buttonTrash" numOrigen=` + idDetalle + `><i class="fa fa-trash"></i></button>
                        ` + buttonDR + `
                        <button type="button" class="btn btn-warning btnPolUbica" idDet=` + idDetalle + ` estado=0>Pól. ` + idPoling + `</button>                    
                      </div>
                      <!-- /btn-group -->
                      <input type="text" class="form-control" id="texToEmpresaVal` + idDetalle + `" value="` + empresa + `" readOnly="readOnly" />
                      <input type="numeric" class="form-control" id="texToBultosVal` + idDetalle + `" value="` + valTextDet + `" />
                    </div>`;
                        }


                    }

                } else {
                    for (var i = 0; i < respuesta[1].length; i++) {
                        var idChas = respuesta[1][i].id;
                        var dataChas = 'CHASIS : ' + respuesta[1][i].chasis + ' - ' + respuesta[1][i].tipoVehiculo + ' - ' + respuesta[1][i].linea;
                        document.getElementById("tableMostrarEmpresa").innerHTML += `
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-danger btn-sm" id="buttonTrashVeh" numOrigen="` + idChas + `"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                </div>
                                <!-- /btn-group -->
                                <input type="text" class="form-control" id="textSalVeh" value="` + dataChas + `" readOnly="readOnly">
                            </div>
                            `;

                    }
                }
                document.getElementById("divBottoneraAccion").innerHTML = `
                <div class="btn-group">
                    <button type="button" class="btn btn-warning btnEditarRetiro" id="editRetiroF" estado=0 idRetiroBtn= ` + idret + ` estadoDetalles=` + estadoDet + `>Editar&nbsp;&nbsp;&nbsp;<i class="fa fa-edit" style="font-size:20px" aria-hidden="true"></i></button>
                    <button type="button" class="btn btn-info btnMasPilotos" id="idbtnMasPilotos" estado=0 idMasPilotos= ` + idret + `  data-toggle="modal" data-target="#plusPilotos">Nueva Unidad&nbsp;&nbsp;&nbsp;<i class="fa fa-plus" style="font-size:20px" aria-hidden="true"></i></button>
                </div>`;
            }
        }
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-center',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            type: 'success',
            title: 'Espere unos segundos'
        })


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
            var nombreReporte = 'HISTORIAL DE CORRELATIVO, ESTADOS DE INGRESO: "-1 ANULADO :: 1 REGISTRADO OPERACIONES :: 2,3 PENDIENTE CULMINAR BODEGA :: 4 FINALIZADO CON NUMERO CORRELATIVO Y PENDIENTE DE CONTABILIZAR :: 5 POR CONTABILIZAR EN EL REPORTE :: 6 CONTABILIZADO"';
            var nombreEncabezado = "DescargaReporteExcel";
            var nombreFile = "ReporteDeCorrelativo_";
            var creaExcel = await JSONToCSVDescargaExcel(resp, nombreEncabezado, nombreReporte, nombreFile, true);
            var nomVar = "generateRecExHistoria";
            var respEx = await reporteRecibosExcel(nomVar, estadoRet);
            var nombreReporte = 'HISTORIAL DE RECIBOS COBROS DE SERVICIOS EXTRAS FISCALES';
            var nombreEncabezado = "DescargaReporteExcel";
            var nombreFile = "ReporteDeRecSerExtra_";
            var creaExcel = await JSONToCSVDescargaExcel(respEx, nombreEncabezado, nombreReporte, nombreFile, true);

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


$(document).on("click", ".btnTodosRetFi", async function () {
    document.getElementById("tableRetirosHistoria").innerHTML = "";
    document.getElementById("tableRetirosHistoria").innerHTML = '<table id="tablasHistRetiro" class="table table-hover table-sm"></table>';
    var estadoRet = $(this).attr("estadorep");
    Swal.fire({
        title: 'Quiere consultar todos los retiros?',
        text: "Esto puede tardar unos segundos!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        allowOutsideClick: false,
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Mostrar todo!'
    }).then(async function (result) {
        Swal.fire({
            title: 'Espera unos segundos!',
            text: 'Cuando la tabla cargue los datos puedes consultar.',
            imageUrl: 'vistas/img/plantilla/loading.gif',
            imageWidth: 300,
            imageHeight: 150,
            imageAlt: 'Custom image',
        })

        if (result.value) {
            var nomVar = "generateTodosLosRetiros";
            var resp = await datosDetallesEdicionRet(nomVar, estadoRet);

            var lista = await preparaListaRetiros(resp[0], resp[1]);

            $('#tablasHistRetiro').DataTable({
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
                data: lista,
                columns: [{
                        title: "#"
                    }, {
                        title: "Nit"
                    }, {
                        title: "Empresa"
                    }, {
                        title: "F. Emisión"
                    }, {
                        title: "Póliza ing"
                    }, {
                        title: "Póliza ret"
                    }, {
                        title: "Numero ret"
                    }, {
                        title: "Bultos"
                    }, {
                        title: "Cif"
                    }, {
                        title: "Impuestos"
                    }, {
                        title: "Acciones"
                    }]
            });

        }
    })
})



$(function () {

    var today = new Date();
    $('#daterangeRetiros').daterangepicker({
        timePicker: false,
        startDate: moment().startOf('hour'),
        singleDatePicker: false,
        endDate: moment().startOf('hour').add(32, 'hour'),
        maxDate: (today),
        locale: {
            format: 'DD-MM-YYYY'
        }
    }, async function (start, end, label) {
        var tiempo = start.format('YYYY-MM-DD');
        var tiempoEnd = end.format('YYYY-MM-DD');
        var tiempoVal = start.format('DD-MM-YYYY');
        var tiempoValEnd = end.format('DD-MM-YYYY');

        document.getElementById("hiddenDateTime").value = tiempo;
        document.getElementById("hiddenDateTimeVal").value = tiempoVal;
        console.log(tiempo);
        console.log(tiempoEnd);

        var resp = await filtroPorFechas(tiempo, tiempoEnd);
        if (resp != "SD") {


            var lista = await await preparaListaRetiros(resp[0], resp[1]);
            document.getElementById("tableRetirosHistoria").innerHTML = "";
            document.getElementById("tableRetirosHistoria").innerHTML = '<table id="tablasHistRetiro" class="table table-hover table-sm"></table>';
            $('#tablasHistRetiro').DataTable({
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
                data: lista,
                columns: [{
                        title: "#"
                    }, {
                        title: "Nit"
                    }, {
                        title: "Empresa"
                    }, {
                        title: "F. Emisión"
                    }, {
                        title: "Póliza ing"
                    }, {
                        title: "Póliza ret"
                    }, {
                        title: "Numero ret"
                    }, {
                        title: "Bultos"
                    }, {
                        title: "Cif"
                    }, {
                        title: "Impuestos"
                    }, {
                        title: "Acciones"
                    }]
            });


            swal({
                type: "success",
                title: "Fecha Seleccionada",
                text: "Del " + tiempoVal + " Al " + tiempoValEnd,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar'
            });
        } else {
            Swal.fire(
                    'No se encontraron retiros en la busqueda, el parametro de fechas no cuenta con retiros',
                    '',
                    'error'
                    )

        }
    });
});


function filtroPorFechas(fechaInicio, fechaFin) {
    let respFunc;
    var datos = new FormData();
    datos.append("fechaInicio", fechaInicio);
    datos.append("fechaFin", fechaFin);
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


$(document).on("click", ".btnRetiroPolizaHistorial", async function () {
    var polizaBusqueda = document.getElementById("polizaBusqueda").value;
    if (polizaBusqueda != "") {


        document.getElementById("tableRetirosHistoria").innerHTML = "";
        document.getElementById("tableRetirosHistoria").innerHTML = '<table id="tablasHistRetiro" class="table table-hover table-sm"></table>';

        Swal.fire({
            title: 'Quiere realizar una busqueda por póliza?',
            text: "Esto puede tardar unos segundos!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            allowOutsideClick: false,
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Buscar por póliza!'
        }).then(async function (result) {
            Swal.fire({
                title: 'Espera unos segundos!',
                text: 'Cuando la tabla cargue los datos puedes consultar.',
                imageUrl: 'vistas/img/plantilla/loading.gif',
                imageWidth: 300,
                imageHeight: 150,
                imageAlt: 'Custom image',
            })

            if (result.value) {


                var nomVar = "busquedaPoliza";

                var resp = await datosDetallesEdicionRet(nomVar, polizaBusqueda);
                var lista = await await preparaListaRetiros(resp[0], resp[1]);

                $('#tablasHistRetiro').DataTable({
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
                    data: lista,
                    columns: [{
                            title: "#"
                        }, {
                            title: "Nit"
                        }, {
                            title: "Empresa"
                        }, {
                            title: "F. Emisión"
                        }, {
                            title: "Póliza ing"
                        }, {
                            title: "Póliza ret"
                        }, {
                            title: "Numero ret"
                        }, {
                            title: "Bultos"
                        }, {
                            title: "Cif"
                        }, {
                            title: "Impuestos"
                        }, {
                            title: "Acciones"
                        }]
                });

            }
        })
    } else {
        Swal.fire(
                'EL numero de póliza esta vacía, ingrese el numero de póliza de ingreso o retiro y haga la consulta',
                '',
                'error'
                )
    }
})


//funcion destinada a parcear y preparar histoariles por parametros de fecha, poliza y todo el historial
function preparaListaRetiros(resp, tipo) {
    var contador = 0;
    listaRetiros = [];
    for (var i = 0; i < resp.length; i++) {
        contador = contador + 1;

        var identRet = resp[i]['identRet'];
        var identRet = resp[i]['identRet'];
        //boton por defecto cuando esta en estado negativo es anulado
                    var botoneraAcciones = "<div class='btn-group'><button type='button' class='btn btn-success btn-sm btnExcelRetSal' idRet = '" + identRet + "'><i class='fa fa-file-excel-o'></i></button><button type='button' class='btn btn-outline-primary btn-sm' id='btnReimprimeRec' idRet='" + identRet + "'>Rec.</button><button type='button' class='btn btn-outline-info btn-sm' id='btnReimprimeRet' idRet='" + identRet + "'>Ret.</button><button type='button' class='btn btn-secondary'>Anulado</button></div>";

        if (tipo == "M1") {
            if (resp[i]['estadoRet'] == 2 || resp[i]['estadoRet'] == 1) {
                var botoneraAcciones = "<div class='btn-group'><button type='button' class='btn btn-success btn-sm btnExcelRetSal' idRet = '" + identRet + "'><i class='fa fa-file-excel-o'></i></button></i><button type='button' class='btn btn-warning btn-sm'>Pendiente</button><a href='#divEdicionRetiro' type='button' class='btn btn-outline-danger btnAnularOperacion btn-sm' idPoliza='" + resp[i]['polRet'] + "' idRet='" + resp[i]['identificaRet'] + "' estado=0><i class='fa fa-eraser'></i></a><a href='#divEdicionRetiro' type='button' class='btn btn-outline-danger btnAnularRetiro_recibo btn-sm' idPoliza='" + resp[i]['polRet'] + "' idRet='" + resp[i]['identificaRet'] + "' estado=0><i class='fa fa-close'></i></a><button type='button' class='btn btn-warning btnConsultDataConfirm btn-sm' reciboasignado='0' retiroasignado='0' polizasal='3188511109' correlinicio='100000000' idRet = '" + identRet + "' idniting = '" + resp[i]["idIngOp"] + "' servicio='3' idingreso='583' data-toggle='modal' data-target='#modalPaseSalida'><i class='fa fa-undo'></i></button></div>";
            }
            if (resp[i]['estadoRet'] >= 4) {
                var botoneraAcciones = "<div class='btn-group'><button type='button' class='btn btn-success btn-sm btnExcelRetSal' idRet = '" + identRet + "'><i class='fa fa-file-excel-o'></i></button><button type='button' class='btn btn-outline-primary btn-sm' id='btnReimprimeRec' idRet='" + identRet + "'>Rec.</button><button type='button' class='btn btn-outline-info btn-sm' id='btnReimprimeRet' idRet='" + identRet + "'>Ret.</button><a href='#divEdicionRetiro' type='button' class='btn btn-outline-danger btnAnularOperacion btn-sm' idPoliza='" + resp[i]['polRet'] + "' idRet='" + resp[i]['identificaRet'] + "' estado=0><i class='fa fa-eraser'></i></a><a href='#divEdicionRetiro' type='button' class='btn btn-outline-danger btnAnularRetiro_recibo btn-sm' idPoliza='" + resp[i]['polRet'] + "' idRet='" + resp[i]['identificaRet'] + "' estado=0><i class='fa fa-close'></i></a><button type='button' class='btn btn-warning btnConsultDataConfirm btn-sm' reciboasignado='0' retiroasignado='0' polizasal='3188511109' correlinicio='100000000' idRet = '" + identRet + "' idniting = '" + resp[i]["idIngOp"] + "' servicio='3' idingreso='583' data-toggle='modal' data-target='#modalPaseSalida'><i class='fa fa-undo'></i></button></div>";
            }
            if (resp[i]['estadoRet'] == 3) {
                var botoneraAcciones = "<div class='btn-group'><button type='button' class='btn btn-success btn-sm btnExcelRetSal' idRet = '" + identRet + "'><i class='fa fa-file-excel-o'></i><button type='button' class='btn btn-warning btn-sm'>Pendiente</button><a href='#divEdicionRetiro' type='button' class='btn btn-outline-danger btnAnularOperacion btn-sm' idPoliza='" + resp[i]['polRet'] + "' idRet='" + resp[i]['identificaRet'] + "' estado=0><i class='fa fa-eraser'></i></a><a href='#divEdicionRetiro' type='button' class='btn btn-outline-danger btnAnularRetiro_recibo btn-sm' idPoliza='" + resp[i]['polRet'] + "' idRet='" + resp[i]['identificaRet'] + "' estado=0><i class='fa fa-close'></i></a><button type='button' class='btn btn-warning btnConsultDataConfirm btn-sm' reciboasignado='0' retiroasignado='0' polizasal='3188511109' correlinicio='100000000' idRet = '" + identRet + "' idniting = '" + resp[i]["idIngOp"] + "' servicio='3' idingreso='583' data-toggle='modal' data-target='#modalPaseSalida'><i class='fa fa-undo'></i></button></div>";
            }
            if (resp[i]['estadoRet'] == -1) {
                var botoneraAcciones = "<div class='btn-group'><button type='button' class='btn btn-success btn-sm btnExcelRetSal' idRet = '" + identRet + "'><i class='fa fa-file-excel-o'></i></button><button type='button' class='btn btn-outline-primary btn-sm' id='btnReimprimeRec' idRet='" + identRet + "'>Rec.</button><button type='button' class='btn btn-outline-info btn-sm' id='btnReimprimeRet' idRet='" + identRet + "'>Ret.</button><button type='button' class='btn btn-secondary'>Anulado</button></div>";
            }

        } else {


            if (resp[i]['estadoRet'] == 2 || resp[i]['estadoRet'] == 1) {
                var botoneraAcciones = "<div class='btn-group'><button type='button' class='btn btn-success btn-sm btnExcelRetSal' idRet = '" + identRet + "'><i class='fa fa-file-excel-o'></i><button type='button' class='btn btn-warning btnConsultDataConfirm btn-sm' reciboasignado='0' retiroasignado='0' polizasal='3188511109' correlinicio='100000000' idRet = '" + identRet + "' idniting = '" + resp[i]["idIngOp"] + "' servicio='3' idingreso='583' data-toggle='modal' data-target='#modalPaseSalida'><i class='fa fa-undo'></i></button></div>";
            }
            if (resp[i]['estadoRet'] >= 4) {
                var botoneraAcciones = "<div class='btn-group'><button type='button' class='btn btn-success btn-sm btnExcelRetSal' idRet = '" + identRet + "'><i class='fa fa-file-excel-o'></i></button><button type='button' class='btn btn-outline-primary btn-sm' id='btnReimprimeRec' idRet='" + identRet + "'>Rec.</button><button type='button' class='btn btn-outline-info btn-sm' id='btnReimprimeRet' idRet='" + identRet + "'>Ret.</button><button type='button' class='btn btn-warning btnConsultDataConfirm btn-sm' reciboasignado='0' retiroasignado='0' polizasal='3188511109' correlinicio='100000000' idRet = '" + identRet + "' idniting = '" + resp[i]["idIngOp"] + "' servicio='3' idingreso='583' data-toggle='modal' data-target='#modalPaseSalida'><i class='fa fa-undo'></i></button></div>";
            }
            if (resp[i]['estadoRet'] == 3) {
                var botoneraAcciones = "<div class='btn-group'><button type='button' class='btn btn-success btn-sm btnExcelRetSal' idRet = '" + identRet + "'><i class='fa fa-file-excel-o'></i><button type='button' class='btn btn-warning btn-sm'>Pendiente</button><button type='button' class='btn btn-warning btnConsultDataConfirm btn-sm' reciboasignado='0' retiroasignado='0' polizasal='3188511109' correlinicio='100000000' idRet = '" + identRet + "' idniting = '" + resp[i]["idIngOp"] + "' servicio='3' idingreso='583' data-toggle='modal' data-target='#modalPaseSalida'><i class='fa fa-undo'></i></button></div>";
            }
        }


        listaRetiros.push([contador, resp[i]['numNit'], resp[i]['empresa'], resp[i]['emision'], resp[i]['numPolIng'], resp[i]['polRet'], resp[i]['numeroRetiro'], resp[i]['bultosRet'], resp[i]['totalValorCif'], resp[i]['valorImpuesto'], botoneraAcciones]);
    }
    return listaRetiros;
}



    