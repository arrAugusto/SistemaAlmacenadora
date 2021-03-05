$(document).on("click", ".btnDetalleRetBod", function () {
    var idIngreso = $(this).attr("idIngreso");
    var idRetiro = $(this).attr("idretiro");
    var idDetalle = $(this).attr("iddetalle");
    $("#btnPreparaSalida").attr("idRetiro", idRetiro);
    document.getElementById("hiddenidIngreso").value = idIngreso;
    document.getElementById("hiddenidRetiro").value = idRetiro;
    var datos = new FormData();
    datos.append("idIngreso", idIngreso);
    datos.append("idRetiro", idRetiro);
    $.ajax({
        url: "ajax/retiroBod.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            var cantidadDetalle = respuesta[0].length;
            if (cantidadDetalle == 1) {
                document.getElementById("detPolRet").innerHTML = 'Detalles poliza de retiro ::  ' + respuesta[0][0].polRet;
                document.getElementById("txtPolizaIng").innerHTML = respuesta[0][0].polIng;
                document.getElementById("empresasPosiciones").innerHTML += '<span class="badge badge-primary" style="font-size: 12px; text-align: justify;">' + respuesta[0][0].empresa + ' / Posiciones ' + respuesta[0][0].posUnid + ' / Metros ' + respuesta[0][0].mtsUnd + '</span>&nbsp;&nbsp;'
                document.getElementById("empresasPosiciones").innerHTML = "";
                document.getElementById("divUbicacionesRet").innerHTML = "";
                for (var i = 0; i < respuesta[0].length; i++) {
                    if (i == 0) {
                        document.getElementById("txtEmpresaRet").innerHTML = respuesta[0][i].empresa;
                        document.getElementById("txtBultosRet").innerHTML = respuesta[0][i].numeroBultos;
                        document.getElementById("txtPesoKg").innerHTML = respuesta[0][i].valPeso;
                        document.getElementById("txtDescripcionRet").innerHTML = respuesta[0][i].empresa + ' : ' + respuesta[0][i].descMerca + '<br/>';
                    } else if (i >= 1) {
                        document.getElementById("txtEmpresaRet").innerHTML = '/' + respuesta[0][i].empresa;
                        document.getElementById("txtBultosRet").innerHTML = '/' + respuesta[0][i].numeroBultos;
                        document.getElementById("txtPesoKg").innerHTML = '/' + respuesta[0][i].valPeso;
                        document.getElementById("txtDescripcionRet").innerHTML = '/' + respuesta[0][i].empresa + ' : ' + respuesta[0][i].descMerca + '<br/>';
                    }
                }
                if (respuesta[1][0] == "SD") {
                    /*
                    console.log(respuesta[0][1]);
                    document.getElementById("bltsActuales").innerHTML = '<label class="badge bg-info" style="font-size: 13px;">Ingreso : &nbsp;&nbsp;' + respuesta[1]["Ing"][0].bultos + '</label>';
                    document.getElementById("posActuales").innerHTML = '<label class="badge bg-info" style="font-size: 13px;">Ingreso : &nbsp;&nbsp;' + respuesta[1]["Ing"][0].pos + '</label>';
                    document.getElementById("mtsActuales").innerHTML = '<label class="badge bg-info" style="font-size: 13px;">Ingreso : &nbsp;&nbsp;' + respuesta[1]["Ing"][0].mts + '</label>';
                    */for (var i = 0; i < respuesta["Ubicaciones"].length; i++) {
                        var pasillo = respuesta["Ubicaciones"][i].pasillo;
                        var columna = respuesta["Ubicaciones"][i].columna;
                        document.getElementById("divUbicacionesRet").innerHTML = '<span class="badge badge-primary" style="font-size: 15px;">P' + pasillo + 'C' + columna + '</span>&nbsp;&nbsp;';
                    }
                } else {
                    /*
                    console.log(respuesta[1]);
                    document.getElementById("bltsActuales").innerHTML = '<label class="badge bg-info" style="font-size: 13px;">Ingreso : &nbsp;&nbsp;' + respuesta[0][0].bltsIngreso + '</label><br/><label class="badge bg-info" style="font-size: 13px;">Retiro : &nbsp;&nbsp;' + respuesta[0][0].bultosRetirados + '</label></br><label class="badge bg-danger" style="font-size: 20px;">Saldo : &nbsp;&nbsp;' + respuesta[0][0].nuevoSaldo + '</label>';
                    document.getElementById("posActuales").innerHTML = '<label class="badge bg-info" style="font-size: 13px;">Ingreso : &nbsp;&nbsp;' + respuesta[0][0].ingresoPos + '</label><br/><label class="badge bg-info" style="font-size: 13px;">Retiro : &nbsp;&nbsp;' + respuesta[0][0].PosRetirdas + '</label></br><label class="badge bg-danger" style="font-size: 20px;">Saldo : &nbsp;&nbsp;' + respuesta[0][0].saldoPos + '</label>';
                    document.getElementById("mtsActuales").innerHTML = '<label class="badge bg-info" style="font-size: 13px;">Ingreso : &nbsp;&nbsp;' + respuesta[0][0].mtsIngresados + '</label><br/><label class="badge bg-info" style="font-size: 13px;">Retiro : &nbsp;&nbsp;' + respuesta[0][0].mtsRetirados + '</label></br><label class="badge bg-danger" style="font-size: 20px;">Saldo : &nbsp;&nbsp;' + respuesta[0][0].stockMts + '</label>';
                    */for (var i = 0; i < respuesta[1].length; i++) {
                        var pasillo = respuesta[1][i].pasillo;
                        var columna = respuesta[1][i].columna;
                        document.getElementById("divUbicacionesRet").innerHTML += '<span class="badge badge-primary" style="font-size: 15px;">P' + pasillo + 'C' + columna + '</span>&nbsp;&nbsp;';
                    }
                }
            } else {
                document.getElementById("divUbicacionRetBod").innerHTML = "";
                console.log(respuesta[0]);
                $("#divDetallesRetBod").removeClass("col-md-9");
                $("#divDetallesRetBod").addClass("col-md-12");
                document.getElementById("divDetallesRetBod").value = respuesta[0][0].nombres + ' ' + respuesta[0][0].apellidos;
                document.getElementById("divDetallesRetBod").innerHTML = '<table id="tableDivDetallesRetBod" class="table dt-responsive table-hover table-sm"></table><input type="hidden" id="hiddenListaDeta" value="">';
                var listaTable = [];
                var listaDetalles = [];
                for (var i = 0; i < respuesta[0].length; i++) {
                    var num = i + 1;
                    var empresa = respuesta[0][i].empresa;
                    var bultos = respuesta[0][i].numeroBultos;
                    var valPeso = respuesta[0][i].valPeso;
                    var descricpion = respuesta[0][i].descMerca;
                    var idDetalles = respuesta[0][i].idDet;
                    var detalles = '<label id="lblSpan' + idDetalles + '"></label>';
                    var posiciones = '<label id="lblPos' + idDetalles + '"></label>';
                    var metros = '<label id="lblMts' + idDetalles + '"></label>';
                    listaTable.push([num, empresa, bultos, valPeso, descricpion, detalles, posiciones, metros]);
                    listaDetalles.push([idDetalles]);
                }
                var listaDet = JSON.stringify(listaDetalles);
                $('#tableDivDetallesRetBod').DataTable({
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
                    data: listaTable,
                    columns: [{
                            title: "#"
                        }, {
                            title: "Empresa"
                        }, {
                            title: "Bultos"
                        }, {
                            title: "Peso"
                        }, {
                            title: "Descripcion"
                        }, {
                            title: "Detalles"
                        }, {
                            title: "Posiciones"
                        }, {
                            title: "Metros"
                        }
                    ]
                });
                fncMostrarUbicaciones(listaDet);
            }






        }, error: function (respuesta) {
            console.log(respuesta);
        }
    });
});
$(document).on("click", ".btnGdCambiosRet", function () {

    Swal.fire({
        title: '¿Quiere guardar cambios?',
        text: "Se registrara el retiro, como valido y sus datos se utilizaran para cobro de Almacenaje",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
    }).then((result) => {
        if (result.value) {
            var hiddenidIngreso = document.getElementById("hiddenidIngreso").value;
            var hiddenidRetiro = document.getElementById("hiddenidRetiro").value;
            var txtPosicioensRet = document.getElementById("txtPosicioensRet").value;
            var txtMetrosRet = document.getElementById("txtMetrosRet").value;
            var datos = new FormData();
            datos.append("hiddenidIngreso", hiddenidIngreso);
            datos.append("hiddenidRetiro", hiddenidRetiro);
            datos.append("txtPosicioensRet", txtPosicioensRet);
            datos.append("txtMetrosRet", txtMetrosRet);
            $.ajax({
                url: "ajax/retiroBod.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (respuesta) {
                    console.log(respuesta);
                    if (respuesta["respuestaOpe"] == "ok" && respuesta["estado"] == "liquidado") {
                        swal({
                            title: "Guardado",
                            text: "Se guardo con éxito",
                            type: "success"
                        }).then(okay => {
                            if (okay) {
                                location.reload();
                            }
                        });


                    } else if (respuesta["respuestaOpe"] == "ok" && respuesta["estado"] !== "liquidado") {
                        swal({
                            title: "Guardado",
                            text: "Se guardo con éxito el saldo de esta poliza es de : " + respuesta["estado"][0]["stock"] + ' bulto(s) ',
                            type: "success"
                        }).then(okay => {
                            if (okay) {
                                location.reload();
                            }
                        });
                    }
                }, error: function (respuesta) {
                    console.log(respuesta);
                }
            });
        }
    });
});
$(document).on("click", ".btnPreparacionSaldia", async function () {
    var valIdRet = $(this).attr("idRetiro");
    var tipoing = $(this).attr("tipoing");
    console.log("cargando el ajax");
    var respuesta = await ajaxSolicInfo(valIdRet, tipoing);
    console.log("esperandoRespuesta");
    if (respuesta == "Ok") {
        console.log("continuando...");

    }

})


function ajaxSolicInfo(valIdRet, tipoing, polizaretiro, idIngreso) {

    let todoMenus;
    var datos = new FormData();
    datos.append("valIdRet", valIdRet);
    console.log(valIdRet);
    $.ajax({
        async: false,
        url: "ajax/retiroBod.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
           
            console.log(respuesta);

            if (respuesta == "SD") {
                alert(respuesta);
                return true;
            } else {
                document.getElementById("divTablePilotos").innerHTML = '<table id="tablePilotlos" class="table  table-hover table-sm dt-responsive"></table><input type="hidden" id="hiddenListaDeta" value="">';
                document.getElementById("divTableRetiraBodega").innerHTML = '<table id="tableSalidaBodega" class="table table-hover table-sm dt-responsive"></table><input type="hidden" id="hiddenListaDeta" value="">';
                document.getElementById("divPOSMetraje").innerHTML = '<table id="tablePosMetraje" class="table table-hover table-sm dt-responsive"></table><input type="hidden" id="hiddenListaDeta" value="">';

                console.log("hola mundo");
                //
                if (tipoing != "vehiculoUsado") {
                    if (respuesta[2] != "SD") {
                        var nombre = respuesta[2][0].nombres;
                        var apellidos = respuesta[2][0].apellidos;
                        var email = respuesta[2][0].email;
                        var telefono = respuesta[2][0].telefono;
                        var idOperacion = respuesta[2][0].id;
                        var foto = respuesta[2][0].foto;
                        if (foto == "NA") {
                            var foto = 'vistas/img/usuarios/default/anonymous.png';

                        }
                        $("#divRetiroOperacion").append(`

        <div class="info-box bg-warning">
            <span class="info-box-icon"><img class="img-circle elevation-2 imgMontarguisdivTableRetiraBodegata" src="` + foto + `" user=` + idOperacion + ` alt="User Avatar"></span>
            <div class="info-box-content">
                <span class="info-box-text">` + nombre + ` ` + apellidos + `</span>
                <span class="info-box-number">Correo : ` + email + `</span>
            <span class="info-box-number">Teleno : ` + telefono + ` - Auxiliar Operación</span>
            </div>
        </div>
    `);
                    }
                    console.log(respuesta[3][0]);
                    var listaPilotos = [];
                    var contador = 0;
                    for (var i = 0; i < respuesta[3].length; i++) {
                        var contador = contador + 1;
                        var idPiloto = respuesta[3][i].Identity;
                        var contenedor = respuesta[3][i].contenedorUnidad;
                        var placaUnidad = respuesta[3][i].placaUnidad;

                        var numMarchamo = respuesta[3][i].numMarchamo;
                        var licPiloto = respuesta[3][i].licPiloto;
                        var nombrePiloto = respuesta[3][i].nombrePiloto;

                        if (respuesta[3][i].estadoUnidad == 1) {
                            var inputMarchamo = '<div class="input-group input-group-sm"><input type="number" class="form-control is-invalid" id=MarchamoPlt' + idPiloto + ' value="" /></div>';
                            var button = '<div class="btn-group" id="divButtonsPlt' + idPiloto + '"><button type="button" class="btn btn-info btn-sm btnGdPiloto"  id="btnAccMarchamo' + idPiloto + '"idPlt=' + idPiloto + ' idRet=' + valIdRet + '><i class="fa fa-save"></i></button><button type="button" class="btn btn-danger btn-sm btnGdPiloto"  id="btnAccMarchamo' + idPiloto + '"idPlt=' + idPiloto + '><i class="fa fa-trash"></i></button></div>';
                        }
                        if (respuesta[3][i].estadoUnidad == 2) {

                            var inputMarchamo = '<div class="input-group input-group-sm"><input type="number" class="form-control is-valid" id=MarchamoPlt' + idPiloto + ' value="' + numMarchamo + '" readOnly="true" /></div>';
                            var button = '<div class="btn-group" id="divButtonsPlt' + idPiloto + '"><button type="button" class="btn btn-warning btn-sm btnEditarPlt" id="EditarPlt' + idPiloto + '" estado=0 idPlt=' + idPiloto + ' idRet=' + valIdRet + '><i class="fa fa-edit"></i></button><button type="button" class="btn btn-danger btn-sm btnTrashPiloto" id="TrashPiloto' + idPiloto + '" idPlt=' + idPiloto + '><i class="fa fa-trash"></i></button></div>';
                        }
                        if (respuesta[3][i].estadoUnidad == 3) {
                            var inputMarchamo = '<div class="input-group input-group-sm"><input type="number" class="form-control is-invalid" id=MarchamoPlt' + idPiloto + ' value="" /></div>';
                            var button = '<div class="btn-group" id="divButtonsPlt' + idPiloto + '"><button type="button" class="btn btn-dark btn-sm btnGdPiloto"  id="btnAccMarchamo' + idPiloto + '"idPlt=' + idPiloto + ' idRet=' + valIdRet + '>Restaurar</div>';
                        }
                        listaPilotos.push([contador, nombrePiloto + ' - ' + licPiloto + ' - ' + placaUnidad + ' - ' + contenedor, inputMarchamo, button]);

                    }
                    $('#tablePilotlos').DataTable({
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
                        data: listaPilotos,
                        columns: [{
                                title: "#"
                            }, {
                                title: "Piloto"
                            }, {
                                title: "Marchamo"
                            }, {
                                title: "Acciones"
                            }]
                    });
                }

                var listaSalidaBodega = [];
                var listaPOSM = [];
                for (var i = 0; i < respuesta[1].length; i++) {
                    //TOMANDO VALORES GENERALES DE BULTOS Y DETALLE
                    var num = i + 1;
                    var empresa = respuesta[1][i].empresa;
                    var bultos = respuesta[1][i].bultos;
                    var estockBults = respuesta[1][i].estockBults;
                    var numeroPoliza = respuesta[1][i].numeroPoliza;
                    listaSalidaBodega.push([num, empresa, numeroPoliza, polizaretiro, bultos, estockBults]);
                    //IDDETALLE 
                    var idDetalle = respuesta[1][i].idDetalle;

                    //TOMANDO DETALLES PARA REBAJA DE BULTOS Y POSICIONES

                    console.log(respuesta[1][i][0]);
                    var numContador = 0;
                    for (var j = 0; j < respuesta[1][i][0].length; j++) {
                        numContador = numContador + 1;
                        var polInterna = respuesta[1][i][0][j].numeroPoliza;
                        var nombreArea = respuesta[1][i][0][j].nombreArea;
                        var stockPOSM = respuesta[1][i][0][j].stockPOSM;
                        var stockMetraje = respuesta[1][i][0][j].stockMetraje;
                        var idPOSM = respuesta[1][i][0][j].idPOSM;
                        


                        var inventarioExecel = '<button type="button" buttonid="' + idIngreso + '" class="btn btn-outline-success btnGeneracionExcel btn-sm">Hist. Retiros <i class="fa fa-file-excel-o"></i></button>';

                        if (stockPOSM== 0) {
                            var textPos = '<div class="input-group input-group-sm"><input type="number" class="form-control is-valid" id="posDet' + [j] + '" value="' + stockPOSM + '" readOnly="readOnly" /></div>';
                            var textBultos = '<div class="input-group input-group-sm"><input type="number" class="form-control is-valid" id="mtsDet' + [j] + '" value="' + stockMetraje + '" readOnly="readOnly"  /></div>';
                            var botonera = '<div id="botoneraPosMts"><button type="button" class="btn btn-warning btn-sm btnEditarDetallePosM" id="btnEditarDetallePos' + [j] + '" idDeta="' + idDetalle + ' " estado="0" idRet=' + valIdRet + ' idRetItera=' + valIdRet + ' idFila=' + [j] + '>Editar <i class="fa fa-edit"></i></button></div>';
                            listaPOSM.push([numContador, polInterna, nombreArea, stockPOSM, stockMetraje, textPos, textBultos, botonera]);
                        } else if (stockPOSM > 0) {
                            var textPos = '<div class="input-group input-group-sm"><input type="number" class="form-control input-group-sm is-invalid" id="posDet' + [j] + '" value="" /></div>';
                            var textBultos = '<div class="input-group input-group-sm"><input type="number" class="form-control input-group-sm is-invalid" id="mtsDet' + [j] + '" value="" /></div>';
                            var botonera = '<div class="btn-group" id="botoneraPosMts"><button type="button" class="btn btn-info btn-sm btnGuardarCambioDet" id="btnGuardarCambioDet' + [j] + '"  idDeta="' + idDetalle + '" idPOSM="'+ idPOSM+'" idRet=' + valIdRet + ' idRetItera=' + valIdRet + ' idFila=' + [j] + '>Guardar <i class="fa fa-save"></i></button>' + inventarioExecel + '</div>';
                            listaPOSM.push([numContador, polInterna, nombreArea, stockPOSM, stockMetraje, textPos, textBultos, botonera]);


                        }

                    }

                }

                //enviando array ala tabla de metros o posiciones de retiro
                InittablePosMetraje(listaPOSM);

                $('#tableSalidaBodega').DataTable({
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
                    data: listaSalidaBodega,
                    columns: [{
                            title: "#"
                        }, {
                            title: "Empresa"
                        }, {
                            title: "Poliza Ingreso"
                        }, {
                            title: "Poliza Retiro"
                        }, {
                            title: "Bultos Retiro"
                        }, {
                            title: "Stock Bultos"
                        }]
                });

            }

            todoMenus = "Ok";

        }, error: function (respuesta) {
            console.log(respuesta);
        }
    });
    return todoMenus;
}

$(document).on("click", ".btnSalidaBodega", async function () {
    document.getElementById("divRetiroOperacion").innerHTML = "";
    var valIdRet = $(this).attr("idRetiro");
    var polizaretiro = $(this).attr("polizaretiro");
    var tipoing = $(this).attr("tipoing");
    var idIngreso = $(this).attr("idIngreso");
    console.log("cargando el ajax");
    var respuesta = await ajaxSolicInfo(valIdRet, tipoing, polizaretiro, idIngreso);
    console.log("esperandoRespuesta");
    if (respuesta == "Ok") {
        console.log("continuando...");
    }

})

$(document).on("click", ".btnGuardarCambioDet", async function () {
    var button = $(this);
    var idfila = $(this).attr("idFila");

    var idRet = $(this).attr("idRet");
        var idDeta = $(this).attr("idDeta");
    var idPosm = $(this).attr("idPosm");
    var idRetitera = $(this).attr("idRetitera");
    var valPosSalida = document.getElementById("posDet" + idfila).value;
    var valMtsSalida = document.getElementById("mtsDet" + idfila).value;
    if (valPosSalida == "" || valMtsSalida == "" || valPosSalida < 0 || valMtsSalida < 0) {
        Swal.fire(
                'Sin Posiciones o Metros',
                'Agregue Metros o Posiciones de Esta Rebaja',
                'error'
                )
    } else if (valPosSalida == 0 || valMtsSalida == 0) {
        Swal.fire({
            title: 'Metros y posiciones es igual a 0',
            text: "Esta seguro de continuar!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, continuar!'
        }).then(async function (result) {
            if (result.value) {
                $("#posDet" + idRet).removeClass("is-invalid");
                $("#posDet" + idRet).addClass("is-valid");
                $("#mtsDet" + idRet).removeClass("is-invalid");
                $("#mtsDet" + idRet).addClass("is-valid");
                var tipoAth = 0;
                var guardDet = await ajaxGuadarDet(idDeta, idPosm, idRet, valPosSalida, valMtsSalida, tipoAth, idPosm);
                console.log(guardDet);
                if (guardDet == "puedeEditar") {
                    button.removeClass("btnGuardarCambioDet");
                    button.addClass("btnEditarDetallePosM");
                    button.removeClass("btn-info");
                    button.addClass("btn-warning");
                    button.html("Editar");
                    $("#posDet" + idfila).removeClass("is-invalid");
                    $("#posDet" + idfila).addClass("is-valid");
                    $("#mtsDet" + idfila).removeClass("is-invalid");
                    $("#mtsDet" + idfila).addClass("is-valid");
                    Swal.fire(
                            'Transacción Exitosa',
                            'Se Guardo Correctamente los Metros y Posiciones',
                            'success'
                            )
                }
                if (guardDet == "exito") {

                    button.removeClass("btnGuardarCambioDet");
                    button.addClass("btnEditarDetallePosM");

                    button.removeClass("btn-info");
                    button.addClass("btn-success");

                    button.html("Guardado");


                    $("#posDet" + idfila).removeClass("is-invalid");
                    $("#posDet" + idfila).addClass("is-valid");

                    $("#mtsDet" + idfila).removeClass("is-invalid");
                    $("#mtsDet" + idfila).addClass("is-valid");

                    button.attr("disabled", "disabled");
                    $("#mtsDet" + idfila).attr("readOnly", true);
                    $("#posDet" + idfila).attr("readOnly", true);

                    Swal.fire(
                            'Transacción Exitosa',
                            'Se Guardo Correctamente los Metros y Posiciones',
                            'success'
                            )

                }
                if (guardDet == "sobreGirara") {
                    Swal.fire(
                            'Sobregira Metros y Posiciones',
                            'Saldo de bultos en bodega es cero, tiene que rebajar las posiciones a cero también',
                            'error'
                            );
                }

                console.log("esperando...");
            }
        })
    } else if (!isNaN(valPosSalida) || !isNaN(valMtsSalida)) {

        $("#posDet" + idRet).removeClass("is-invalid");
        $("#posDet" + idRet).addClass("is-valid");
        $("#mtsDet" + idRet).removeClass("is-invalid");
        $("#mtsDet" + idRet).addClass("is-valid");
        var tipoAth = 0;
        var guardDet = await ajaxGuadarDet(idDeta, idPosm, idRet, valPosSalida, valMtsSalida, tipoAth, idPosm);
        console.log(guardDet);
        if (guardDet == "puedeEditar") {
            $("#btnGuardarCambioDet" + idfila).removeClass("btnGuardarCambioDet");
            $("#btnGuardarCambioDet" + idfila).addClass("btnEditMarchamo");
            $("#btnGuardarCambioDet" + idfila).removeClass("btn-info");
            $("#btnGuardarCambioDet" + idfila).addClass("btn-warning");
            $("#btnGuardarCambioDet" + idfila).html("Editar");
            $("#posDet" + idfila).removeClass("is-invalid");
            $("#posDet" + idfila).addClass("is-valid");
            $("#mtsDet" + idfila).removeClass("is-invalid");
            $("#mtsDet" + idfila).addClass("is-valid");
            Swal.fire(
                    'Transacción Exitosa',
                    'Se Guardo Correctamente los Metros y Posiciones',
                    'success'
                    )
        }
        if (guardDet == "exito") {

            $("#btnGuardarCambioDet" + idfila).removeClass("btnGuardarCambioDet");
            $("#btnGuardarCambioDet" + idfila).addClass("btnEditMarchamo");

            $("#btnGuardarCambioDet" + idfila).removeClass("btn-info");
            $("#btnGuardarCambioDet" + idfila).addClass("btn-success");

            $("#btnGuardarCambioDet" + idfila).html("Guardado");


            $("#posDet" + idfila).removeClass("is-invalid");
            $("#posDet" + idfila).addClass("is-valid");

            $("#mtsDet" + idfila).removeClass("is-invalid");
            $("#mtsDet" + idfila).addClass("is-valid");

            $("#btnGuardarCambioDet" + idfila).attr("disabled", "disabled");
            $("#mtsDet" + idfila).attr("readOnly", true);
            $("#posDet" + idfila).attr("readOnly", true);

            Swal.fire(
                    'Transacción Exitosa',
                    'Se Guardo Correctamente los Metros y Posiciones',
                    'success'
                    )

        }
        if (guardDet == "sobreGirara") {
            Swal.fire({
                title: 'Cantidad de bultos cero',
                text: "Saldo de bultos en bodega es cero, tiene que rebajar las posiciones a cero también!",
                type: 'warning',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ok!'
            }).then(async function (result) {
                if (result.value) {
                    var tipoAth = 1;
                    var guardDet = await ajaxGuadarDet(idDeta, idPosm, idRet, valPosSalida, valMtsSalida, tipoAth, idPosm);
                    console.log(guardDet);
                    if (guardDet == "exito") {

                        $("#btnGuardarCambioDet" + idfila).removeClass("btnGuardarCambioDet");
                        $("#btnGuardarCambioDet" + idfila).addClass("btnEditMarchamo");

                        $("#btnGuardarCambioDet" + idfila).removeClass("btn-info");
                        $("#btnGuardarCambioDet" + idfila).addClass("btn-success");

                        $("#btnGuardarCambioDet" + idfila).html("Guardado");


                        $("#posDet" + idfila).removeClass("is-invalid");
                        $("#posDet" + idfila).addClass("is-valid");

                        $("#mtsDet" + idfila).removeClass("is-invalid");
                        $("#mtsDet" + idfila).addClass("is-valid");

                        $("#btnGuardarCambioDet" + idfila).attr("disabled", "disabled");
                        $("#mtsDet" + idfila).attr("readOnly", true);
                        $("#posDet" + idfila).attr("readOnly", true);

                        Swal.fire(
                                'Transacción Exitosa',
                                'Se Guardo Correctamente los Metros y Posiciones',
                                'success'
                                )

                    }
                                    if (guardDet == "puedeEditar") {
                    button.removeClass("btnGuardarCambioDet");
                    button.addClass("btnEditarDetallePosM");
                    button.removeClass("btn-info");
                    button.addClass("btn-warning");
                    button.html("Editar");
                    $("#posDet" + idfila).removeClass("is-invalid");
                    $("#posDet" + idfila).addClass("is-valid");
                    $("#mtsDet" + idfila).removeClass("is-invalid");
                    $("#mtsDet" + idfila).addClass("is-valid");
                    Swal.fire(
                            'Transacción Exitosa',
                            'Se Guardo Correctamente los Metros y Posiciones',
                            'success'
                            )
                }
                }
            })



        }

        console.log("esperando...");

    }

})

function ajaxGuadarDet(idDeta, idPosm, idRet, valPosSalida, valMtsSalida, tipoAth, idPosm) {
    console.log(idRet);
    let todoMenus;
    var datos = new FormData();
    datos.append("idRetGD", idRet);
    datos.append("idDetaGD", idDeta);
    datos.append("valPosSalidaGD", valPosSalida);
    datos.append("valMtsSalidaGD", valMtsSalida);
    datos.append("tipoAth", tipoAth);
    datos.append("idPosm", idPosm);
    

    $.ajax({
        async: false,
        url: "ajax/retiroBod.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            todoMenus = respuesta;
        }, error: function (respuesta) {
            console.log(respuesta);
        }
    });
    return todoMenus;
}

$(document).on("click", ".btnEditarDetallePosM", async function () {
    var button = $(this);
    var idfila = $(this).attr("idFila");
    console.log("hola mundo");
    console.log(idfila);
    var idRetEdit = $(this).attr("dRet");
    var idDeta = $(this).attr("idDeta");
    var estado = $(this).attr("estado");
    if (estado == 0) {
        var valPosSalida = document.getElementById("posDet" + idfila).value;
        var valMtsSalida = document.getElementById("mtsDet" + idfila).value;
        button.removeClass("btn-warning");
        button.addClass("btn-primary");
        button.html('Guaradar <i class="fa fa-save"></i>');
        button.attr("estado", 1);
        document.getElementById("posDet" + idRetEdit).readOnly = false;
        document.getElementById("mtsDet" + idRetEdit).readOnly = false;
    } else if (estado == 1) {
        var valPosSalida = document.getElementById("posDet" + idRetEdit).value;
        var valMtsSalida = document.getElementById("mtsDet" + idRetEdit).value;
        console.log(valPosSalida);
        console.log(valMtsSalida);
        if (valPosSalida == "" || valMtsSalida == "") {
        } else if (isNaN(valPosSalida) || isNaN(valMtsSalida)) {
        } else if (!isNaN(valPosSalida) || !isNaN(valMtsSalida)) {

            $("#posDet" + idRetEdit).removeClass("is-invalid");
            $("#posDet" + idRetEdit).addClass("is-valid");
            $("#mtsDet" + idRetEdit).removeClass("is-invalid");
            $("#mtsDet" + idRetEdit).addClass("is-valid");
            $(this).removeClass("btn-primary");
            $(this).addClass("btn-warning");
            $(this).html('Editar <i class="fa fa-edit"></i>');
            $(this).attr("estado", 1);
            var guardDet = await ajaxEditPosMts(idDeta, idRetEdit, valPosSalida, valMtsSalida);
            console.log(guardDet);
            if (guardDet == "puedeEditar") {

                $("#btnGuardarCambioDet" + idfila).removeClass("btnGuardarCambioDet");
                $("#btnGuardarCambioDet" + idfila).addClass("btnEditMarchamo");
                $("#btnGuardarCambioDet" + idfila).removeClass("btn-info");
                $("#btnGuardarCambioDet" + idfila).addClass("btn-warning");
                $("#btnGuardarCambioDet" + idfila).html("Editar");
                $("#posDet" + idfila).removeClass("is-invalid");
                $("#posDet" + idfila).addClass("is-valid");
                $("#mtsDet" + idfila).removeClass("is-invalid");
                $("#mtsDet" + idfila).addClass("is-valid");

                Swal.fire(
                        'Transacción Exitosa',
                        'Se Guardo Correctamente los Metros y Posiciones',
                        'success'
                        )

            }
            /* if (guardDet == "puedeEditar") {
             $("#btnGuardarCambioDet" + idfila).removeClass("btn-info");
             $("#btnGuardarCambioDet" + idfila).addClass("btn-primary");
             $("#btnGuardarCambioDet" + idfila).html("Guardado");
             $("#btnGuardarCambioDet" + idfila).attr("disabled", "disabled");
             
             }*/
            if (guardDet == "sobreGirara") {
                Swal.fire(
                        'Transacción Interrumpida',
                        'Error en Metros y Posiciones, Verifique el Saldo Actualy Continue...',
                        'error'
                        );
            }
            console.log(guardDet);


        }
    }

})

function ajaxEditPosMts(tipoEdit, idDeta, idRet, valPosSalida, valMtsSalida) {
    console.log(idRet);
    console.log(tipoEdit);
    let todoMenus;
    var datos = new FormData();
    datos.append("tipoEditG", tipoEdit);
    datos.append("idRetEdit", idRet);
    datos.append("idDetaEdit", idDeta);
    datos.append("valPosSalidaEdit", valPosSalida);
    datos.append("valMtsSalidaEdit", valMtsSalida);
    $.ajax({
        async: false,
        url: "ajax/retiroBod.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            if (respuesta == "oksReb") {
                todoMenus = "OkReb";
            } else if (respuesta == "UnoPendiente") {
                todoMenus = "UnoPendiente";
            } else if (respuesta == "faltanDetalles") {
                todoMenus = "faltanDetalles";
            }


        }, error: function (respuesta) {
            console.log(respuesta);
        }
    });
    return todoMenus;
}

$(document).on("click", ".btnMasServiciosConsumidos", async function () {
    alert("hola mundo estoy en el javascript");
});

function fncMostrarUbicaciones(listaDetalles) {
    let todoMenus;
    var listaDet = JSON.parse(listaDetalles);
    for (var i = 0; i < listaDet.length; i++) {
        var idDetalle = listaDet[i][0];
        var datos = new FormData();
        datos.append("idDetalle", idDetalle);
        $.ajax({
            async: false,
            url: "ajax/retiroBod.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (respuesta) {
                console.log(respuesta);
                for (var i = 0; i < respuesta["ubicaciones"].length; i++) {
                    var idLbl = "lblSpan" + idDetalle;
                    var pasillo = respuesta["ubicaciones"][i].pasillo;
                    var columna = respuesta["ubicaciones"][i].columna;
                    document.getElementById(idLbl).innerHTML += '<span class="badge badge-primary" style="font-size: 15px;">P' + pasillo + 'C' + columna + '</span>&nbsp;&nbsp;';
                }
                for (var i = 0; i < respuesta["mostrarPos"].length; i++) {
                    var idPos = "lblPos" + idDetalle;
                    var idMst = "lblMts" + idDetalle;
                    var pos = respuesta["mostrarPos"][i].stockPosocicion;
                    var mts = respuesta["mostrarPos"][i].stockMetros;
                    document.getElementById(idPos).innerHTML += '<center><span class="badge badge-success" style="font-size: 15px;">' + pos + '</span>&nbsp;&nbsp;</center>';
                    document.getElementById(idMst).innerHTML += '<center><span class="badge badge-warning" style="font-size: 15px;">' + mts + '</span>&nbsp;&nbsp;</center>';
                }
            }, error: function (respuesta) {
                console.log(respuesta);
            }
        });
    }
    return todoMenus;
}

$(document).on("click", ".btnGdPiloto", async function () {
    var button = $(this);
    var idPlt = $(this).attr("idplt");
    var idRet = $(this).attr("idRet");

    var marchamo = document.getElementById("MarchamoPlt" + idPlt).value;
    if (isNaN(marchamo) || marchamo == "") {
        Swal.fire(
                'Sin Marchamo!',
                'Ingrese el Numero de Marchamo!',
                'error'
                );
    } else {

        var respMarchamo = await ajaxGuardarMarchamo(idPlt, marchamo, idRet);
        if (respMarchamo == true) {
            button.removeClass("btn-info");
            button.removeClass("btn-dark");
            button.addClass("btn-warning");
            button.html('<i class="fa fa-edit"></i>');
            $("#MarchamoPlt" + idPlt).removeClass("is-invalid");
            $("#MarchamoPlt" + idPlt).addClass("is-valid");
            $("#MarchamoPlt" + idPlt).removeClass("is-invalid");
            $("#MarchamoPlt" + idPlt).addClass("is-valid");
            $("#btnAccMarchamo" + idPlt).removeClass("btnGdPiloto");
            $("#btnAccMarchamo" + idPlt).addClass("btnEditarPlt");
            $("#btnAccMarchamo" + idPlt).attr("estado", 0);
            if ($("#btnTrashPiloto" + idPlt).length == 0) {
                button.remove();
                document.getElementById("divButtonsPlt" + idPlt).innerHTML = '<button type="button" class="btn btn-warning btn-sm btnEditarPlt" id="EditarPlt' + idPlt + '" estado=0 idPlt=' + idPlt + ' idRet=' + idRet + '><i class="fa fa-edit"></i></button><button type="button" class="btn btn-danger btn-sm btnTrashPiloto" id="TrashPiloto' + idPlt + '" idPlt=' + idPlt + '><i class="fa fa-trash"></i></button>';
            }
            Swal.fire(
                    'Transacción Exitosa',
                    'El Marchamo se Guardo con Exito',
                    'success'
                    )
        }
    }
});



function ajaxGuardarMarchamo(idPlt, marchamo, idRet) {
    console.log(idPlt);
    let todoMenus;
    var datos = new FormData();
    datos.append("idRetPltNew", idPlt);
    datos.append("marchamoSalNew", marchamo);
    datos.append("idRetNewMarc", idRet);
    $.ajax({
        async: false,
        url: "ajax/retiroBod.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            todoMenus = respuesta;
        }, error: function (respuesta) {
            console.log(respuesta);
        }
    });
    return todoMenus;
}

$(document).on("click", ".btnEditarPlt", async function () {
    var button = $(this);
    var idplt = $(this).attr("idPlt");
    var estado = $(this).attr("estado");
    var idRet = $(this).attr("idret");
    if (estado == 0) {


        swal({
            type: 'warning',
            title: 'Desea editar el numero de marchamo',
            showCancelButton: true,
            confirmButtonText: "Si Editar!",
            cancelButtonText: "Cancelar",
            confirmButtonColor: '#2E9AFE',
            cancelButtonColor: '#d33',
            allowOutsideClick: false,
            allowEscapeKey: false
        }).then(async function (result) {
            if (result) {
                button.removeClass("btn-warning");
                button.addClass("btn-outline-dark");
                button.html('<i class="fa fa-save"></i>');
                document.getElementById("MarchamoPlt" + idplt).readOnly = false;
                button.attr("estado", 1);
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 5000,
                    timerProgressBar: true,
                    onOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

                Toast.fire({
                    type: 'success',
                    title: 'Ingrese el numero de marchamo correcto'
                })

            }
        });
    } else if (estado == 1) {

        swal({
            type: 'warning',
            title: 'Editara el numero marchamo?',
            showCancelButton: true,
            confirmButtonText: "Si Editar!",
            cancelButtonText: "Cancelar",
            confirmButtonColor: '#2E9AFE',
            cancelButtonColor: '#d33',
            allowOutsideClick: false,
            allowEscapeKey: false
        }).then(async function (result) {

            var marchamoEdit = document.getElementById("MarchamoPlt" + idplt).value;
            var respEditMarchamo = await ajaxEditarMarchamo(idRet, idplt, marchamoEdit);
            if (respEditMarchamo == true) {

                button.removeClass("btn-outline-dark");
                button.addClass("btn-warning");
                button.html('<i class="fa fa-edit"></i>');
                document.getElementById("MarchamoPlt" + idplt).readOnly = true;
                button.attr("estado", 0);

                Swal.fire(
                        'Transacción Exitosa',
                        'Se edito correctamente el numero de marchamo',
                        'success'
                        );
            }
        });
    }
});

function respMSG() {

    Swal.fire({
        title: 'Quire editar marchamo?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Editar!',
        cancelButtonText: 'Cancelar'

    }).then((result) => {
        if (result.value) {
            return true;
        } else {
            return false;
        }
    })
}


function ajaxEditarMarchamo(idRet, idPlt, marchamo) {
    console.log(idPlt);
    let respTran;
    var datos = new FormData();

    datos.append("idRetEditMar", idRet);
    datos.append("idPltEdit", idPlt);
    datos.append("marchamoEdit", marchamo);
    $.ajax({
        async: false,
        url: "ajax/retiroBod.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            respTran = respuesta;
        }, error: function (respuesta) {
            console.log(respuesta);
        }
    });
    return respTran;
}

$(document).on("click", ".btnTrashPiloto", async function () {
    var button = $(this);
    var idPlt = $(this).attr("idPlt");
    var nomVar = "idPltTrash";
    var respCancelar = await ajaxCancelarPlt(idPlt, nomVar);
    if (respCancelar[0]["resp"] == 1) {
        $("#EditarPlt" + idPlt).removeClass("btn-warning");
        $("#EditarPlt" + idPlt).addClass("btn-dark");
        $("#EditarPlt" + idPlt).removeClass("btnEditarPlt");
        $("#EditarPlt" + idPlt).addClass("btnGdPiloto");
        $("#EditarPlt" + idPlt).html('Restaurar');
        document.getElementById("MarchamoPlt" + idPlt).readOnly = false;
        document.getElementById("MarchamoPlt" + idPlt).value = "";
        $("#MarchamoPlt").removeClass("is-valid");
        $("#MarchamoPlt").addClass("is-invalid");
        button.remove();
    }

})


function ajaxCancelarPlt(idPlt, nomVar) {
    console.log(idPlt);
    let respTran;
    var datos = new FormData();
    datos.append(nomVar, idPlt);
    $.ajax({
        async: false,
        url: "ajax/retiroBod.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            respTran = respuesta;
        }, error: function (respuesta) {
            console.log(respuesta);
        }
    });
    return respTran;
}
$(document).on("click", ".btnPilotoInac", async function () {
    var idPlt = $(this).attr("idPlt");
    var nomVar = "idPltActivar";
    var respCancelar = await ajaxCancelarPlt(idPlt, nomVar);
})

$(document).on("click", ".btnLimpiarRetiros", async function () {
    Swal.fire({
        title: 'Si la transacción fue finalizada correctamente se reiniciara la lista de retiros.',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Reiniciar Lista!',
        cancelButtonText: 'Cancelar'

    }).then((result) => {
        if (result.value) {
            location.reload();
        } else {
            Swal.fire(
                    'No se reinicio la lista de retiros',
                    'Puede editar los datos de este retiro',
                    'warning'
                    )
        }
    })
})


//inicianlizando table para el metraje o posiciones del retiro
function InittablePosMetraje(lista) {
    $('#tablePosMetraje').DataTable({
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
                title: "Póliza ing"
            }, {
                title: "Area Bodega"
            }, {
                title: "Stock Posiciones"
            }, {
                title: "Stock Metros"
            }, {
                title: "Stock Posiciones"
            }, {
                title: "Stock Metros"
            }, {
                title: "Acciones"
            }]
    });

}