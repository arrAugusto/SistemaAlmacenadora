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
                    console.log(respuesta[0][1]);
                    document.getElementById("bltsActuales").innerHTML = '<label class="badge bg-info" style="font-size: 13px;">Ingreso : &nbsp;&nbsp;' + respuesta[1]["Ing"][0].bultos + '</label>';
                    document.getElementById("posActuales").innerHTML = '<label class="badge bg-info" style="font-size: 13px;">Ingreso : &nbsp;&nbsp;' + respuesta[1]["Ing"][0].pos + '</label>';
                    document.getElementById("mtsActuales").innerHTML = '<label class="badge bg-info" style="font-size: 13px;">Ingreso : &nbsp;&nbsp;' + respuesta[1]["Ing"][0].mts + '</label>';
                    for (var i = 0; i < respuesta["Ubicaciones"].length; i++) {
                        var pasillo = respuesta["Ubicaciones"][i].pasillo;
                        var columna = respuesta["Ubicaciones"][i].columna;
                        document.getElementById("divUbicacionesRet").innerHTML = '<span class="badge badge-primary" style="font-size: 15px;">P' + pasillo + 'C' + columna + '</span>&nbsp;&nbsp;';
                    }
                } else {
                    console.log(respuesta[1]);
                    document.getElementById("bltsActuales").innerHTML = '<label class="badge bg-info" style="font-size: 13px;">Ingreso : &nbsp;&nbsp;' + respuesta[0][0].bltsIngreso + '</label><br/><label class="badge bg-info" style="font-size: 13px;">Retiro : &nbsp;&nbsp;' + respuesta[0][0].bultosRetirados + '</label></br><label class="badge bg-danger" style="font-size: 20px;">Saldo : &nbsp;&nbsp;' + respuesta[0][0].nuevoSaldo + '</label>';
                    document.getElementById("posActuales").innerHTML = '<label class="badge bg-info" style="font-size: 13px;">Ingreso : &nbsp;&nbsp;' + respuesta[0][0].ingresoPos + '</label><br/><label class="badge bg-info" style="font-size: 13px;">Retiro : &nbsp;&nbsp;' + respuesta[0][0].PosRetirdas + '</label></br><label class="badge bg-danger" style="font-size: 20px;">Saldo : &nbsp;&nbsp;' + respuesta[0][0].saldoPos + '</label>';
                    document.getElementById("mtsActuales").innerHTML = '<label class="badge bg-info" style="font-size: 13px;">Ingreso : &nbsp;&nbsp;' + respuesta[0][0].mtsIngresados + '</label><br/><label class="badge bg-info" style="font-size: 13px;">Retiro : &nbsp;&nbsp;' + respuesta[0][0].mtsRetirados + '</label></br><label class="badge bg-danger" style="font-size: 20px;">Saldo : &nbsp;&nbsp;' + respuesta[0][0].stockMts + '</label>';
                    for (var i = 0; i < respuesta[1].length; i++) {
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
    console.log("cargando el ajax");
    var respuesta = await ajaxSolicInfo(valIdRet);
    console.log("esperandoRespuesta");
    if (respuesta == "Ok") {
        console.log("continuando...");
    }

})


function ajaxSolicInfo(valIdRet) {
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
                return;
            } else {
                if (respuesta[2] != "SD") {
                    var nombre = respuesta[2][0].nombres;
                    var apellidos = respuesta[2][0].apellidos;
                    var email = respuesta[2][0].email;
                    var telefono = respuesta[2][0].telefono;
                    var idOperacion = respuesta[2][0].id;
                    var foto = respuesta[2][0].foto;

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
                document.getElementById("divTablePilotos").innerHTML = '<table id="tablePilotlos" class="table  table-hover table-sm dt-responsive"></table><input type="hidden" id="hiddenListaDeta" value="">';
                document.getElementById("divTableRetiraBodega").innerHTML = '<table id="tableSalidaBodega" class="table table-hover table-sm dt-responsive"></table><input type="hidden" id="hiddenListaDeta" value="">';
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


                var listaSalidaBodega = [];
                for (var i = 0; i < respuesta[1].length; i++) {
                    var num = i + 1;
                    var empresa = respuesta[1][i].empresa;
                    var bultos = respuesta[1][i].bultos;
                    var stockPos = respuesta[1][i].pos;
                    var stockMts = respuesta[1][i].mts;
                    var idDetalle = respuesta[1][i].idDetalle;
                    console.log(respuesta[1][i].estadoDet);
                    if (respuesta[1][i].estadoDet == 0) {
                        var textPos = '<div class="input-group input-group-sm"><input type="number" class="form-control is-valid" id="posDet' + [i] + '" value="' + stockPos + '" readOnly="readOnly" /></div>';
                        var textBultos = '<div class="input-group input-group-sm"><input type="number" class="form-control is-valid" id="mtsDet' + [i] + '" value="' + stockMts + '" readOnly="readOnly"  /></div>';
                        var botonera = '<div id="botoneraPosMts"><button type="button" class="btn btn-warning btn-sm btnEditarDetallePosM" id="btnEditarDetallePos' + [i] + '" idDeta="' + idDetalle + ' " estado="0" idRet=' + valIdRet + ' idRetItera=' + valIdRet + [i] + ' idFila=' + [i] + '>Editar <i class="fas fa-edit"></i></button></div>';
                        listaSalidaBodega.push([num, empresa, bultos, stockPos, stockMts, textPos, textBultos, botonera]);

                    } else if (respuesta[1][i].estadoDet == 1) {
                        var textPos = '<div class="input-group input-group-sm"><input type="number" class="form-control input-group-sm is-invalid" id="posDet' + [i] + '" value="" /></div>';
                        var textBultos = '<div class="input-group input-group-sm"><input type="number" class="form-control input-group-sm is-invalid" id="mtsDet' + [i] + '" value="" /></div>';
                        var botonera = '<div id="botoneraPosMts"><button type="button" class="btn btn-info btn-sm btnGuardarCambioDet" id="btnGuardarCambioDet' + [i] + '" idDeta="' + idDetalle + '" idRet=' + valIdRet + ' idRetItera=' + valIdRet + [i] + ' idFila=' + [i] + '>Guardar <i class="fas fa-save"></i></button></div>';
                        listaSalidaBodega.push([num, empresa, bultos, stockPos, stockMts, textPos, textBultos, botonera]);

                    }
                }
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
                            title: "Bultos"
                        }, {
                            title: "Stock Posiciones"
                        }, {
                            title: "Stock Metros"
                        }, {
                            title: "Posiciones"
                        }, {
                            title: "Metros"
                        }, {
                            title: "Acciones"
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
    console.log("cargando el ajax");
    var respuesta = await ajaxSolicInfo(valIdRet);
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
    var idRetitera = $(this).attr("idRetitera");
    var valPosSalida = document.getElementById("posDet" + idfila).value;
    var valMtsSalida = document.getElementById("mtsDet" + idfila).value;
    if (valPosSalida == "" || valMtsSalida == "" || valPosSalida <= 0 || valMtsSalida <= 0) {
        Swal.fire(
                'Sin Posiciones o Metros',
                'Agregue Metros o Posiciones de Esta Rebaja',
                'error'
                )
    } else if (isNaN(valPosSalida) || isNaN(valMtsSalida)) {

    } else if (!isNaN(valPosSalida) || !isNaN(valMtsSalida)) {
        if (valPosSalida >= 1 && valMtsSalida >= 1) {
            $("#posDet" + idRet).removeClass("is-invalid");
            $("#posDet" + idRet).addClass("is-valid");
            $("#mtsDet" + idRet).removeClass("is-invalid");
            $("#mtsDet" + idRet).addClass("is-valid");
            var guardDet = await ajaxGuadarDet(idDeta, idRet, valPosSalida, valMtsSalida);
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
                Swal.fire(
                        'Transacción Interrumpida',
                        'Error en Metros y Posiciones, Verifique el Saldo Actualy Continue...',
                        'error'
                        );
            }

            console.log("esperando...");
            /*  if (respuestaAjax == "Ok") {
             console.log("entrando...");
             var tipo = 0;
             var respuestaActualStock = await ajaxEditPosMts(tipo, idDeta, idRet, valPosSalida, valMtsSalida);
             console.log(respuestaActualStock);
             if (respuestaActualStock == "OkReb") {
             Swal.fire({
             title: 'Operacion Exitosa',
             text: "Se rebajo exitosamente, todo el ingreso.",
             icon: 'info',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             confirmButtonText: 'Si, es correcto',
             canceButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             cancelButtonText: '¡Cancelar, Incorrecta!'
             }).then((result) => {
             if (result.value) {
             swal({
             title: "Guardado",
             text: "Tu dato sera utilizado para cobros de almacenaje",
             type: "success"
             }).then(okay => {
             if (okay) {
             Swal.fire(
             'Agregue Marchamos A los vehiculos',
             'success'
             )
             }
             });
             } else {
             swal({
             title: "Modificación",
             text: "Modifica las posiciones y metros para luego guardar.",
             type: "info"
             }).then(okay => {
             if (okay) {
             document.getElementById("botoneraPosMts").innerHTML = '<button type="button" class="btn btn-warning btnEditarDetallePosM" id="btnEditarDetallePos">Editar <i class="fas fa-edit"></i></button>';
             
             }
             });
             
             }
             })
             /*idDeta="' + idDetalle + ' " estado="0" idRet=' + valIdRet + ' idRetItera=' + valIdRet + [i] + ' */


            /*     } else if (respuestaActualStock == "UnoPendiente") {
             
             document.getElementById("botoneraPosMts").innerHTML = '<button type="button" class="btn btn-warning btnEditarDetallePosM" id="btnEditarDetallePos">Editar <i class="fas fa-edit"></i></button>';
             document.getElementById("posDet" + idfila).readOnly = true;
             document.getElementById("mtsDet" + idfila).readOnly = true;
             
             
             Swal.fire(
             'Rebaja pendiente',
             'Rebaje la ultima opearción',
             'info'
             )
             } else if (respuestaActualStock == "faltanDetalles") {
             document.getElementById("botoneraPosMts").innerHTML = '<button type="button" class="btn btn-warning btnEditarDetallePosM" id="btnEditarDetallePos">Editar <i class="fas fa-edit"></i></button>';
             document.getElementById("posDet" + idfila).readOnly = true;
             document.getElementById("mtsDet" + idfila).readOnly = true;
             
             
             Swal.fire(
             'Rebajas pendientes',
             'Tiene mas de 2 rebajas pendientes',
             'info'
             )
             }
             
             }*/
        } else {

        }
    }

})

function ajaxGuadarDet(idDeta, idRet, valPosSalida, valMtsSalida) {
    console.log(idRet);
    let todoMenus;
    var datos = new FormData();
    datos.append("idRet", idRet);
    datos.append("idDeta", idDeta);
    datos.append("valPosSalida", valPosSalida);
    datos.append("valMtsSalida", valMtsSalida);
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
        }});
    return todoMenus;
}

$(document).on("click", ".btnEditarDetallePosM", async function () {
    var button = $(this);
    var idfila = $(this).attr("idFila");
    console.log(idfila);
    var idRetEdit = $(this).attr("dRet");
    var idDeta = $(this).attr("idDeta");
    var estado = $(this).attr("estado");
    if (estado == 0) {
        var valPosSalida = document.getElementById("posDet" + idfila).value;
        var valMtsSalida = document.getElementById("mtsDet" + idfila).value;
        $(this).removeClass("btn-warning");
        $(this).addClass("btn-primary");
        $(this).html('Guaradar <i class="fas fa-save"></i>');
        $(this).attr("estado", 1);
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
            if (valPosSalida >= 1 && valMtsSalida >= 1) {
                $("#posDet" + idRetEdit).removeClass("is-invalid");
                $("#posDet" + idRetEdit).addClass("is-valid");
                $("#mtsDet" + idRetEdit).removeClass("is-invalid");
                $("#mtsDet" + idRetEdit).addClass("is-valid");
                $(this).removeClass("btn-primary");
                $(this).addClass("btn-warning");
                $(this).html('Editar <i class="fas fa-edit"></i>');
                $(this).attr("estado", 1);
                var guardDet = await ajaxGuadarDet(idDeta, idRetEdit, valPosSalida, valMtsSalida);
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
                if (guardDet == "puedeEditar") {
                    $("#btnGuardarCambioDet" + idfila).removeClass("btn-info");
                    $("#btnGuardarCambioDet" + idfila).addClass("btn-primary");
                    $("#btnGuardarCambioDet" + idfila).html("Guardado");
                    $("#btnGuardarCambioDet" + idfila).attr("disabled", "disabled");

                }
                if (guardDet == "sobreGirara") {
                    Swal.fire(
                            'Transacción Interrumpida',
                            'Error en Metros y Posiciones, Verifique el Saldo Actualy Continue...',
                            'error'
                            );
                }
                console.log(guardDet);
                /*if (guardDet == "Ok") {
                 console.log("entrando...");
                 var tipo = 1;
                 var respuestaActualStock = await ajaxEditPosMts(tipo, idDeta, idRetEdit, valPosSalida, valMtsSalida);
                 console.log(respuestaActualStock);
                 console.log("finalizado.")
                 }*/
            } else {
                $("#posDet" + idRetEdit).removeClass("is-valid");
                $("#posDet" + idRetEdit).addClass("is-invalid");

                $("#mtsDet" + idRetEdit).removeClass("is-valid");
                $("#mtsDet" + idRetEdit).addClass("is-invalid");
            }
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
        }});
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
            }});
    }
    return todoMenus;
}

$(document).on("click", ".btnGdPiloto", async function () {
    var button = $(this);
    var idPlt = $(this).attr("idplt");
    var idRet = $(this).attr("idRet");

    var marchamo = document.getElementById("MarchamoPlt" + idPlt).value;
    if (isNaN(marchamo) || marchamo == "" || marchamo <= 0) {
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
        }});
    return todoMenus;
}

$(document).on("click", ".btnEditarPlt", async function () {
    var button = $(this);
    var idplt = $(this).attr("idPlt");
    var estado = $(this).attr("estado");
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
            var respEditMarchamo = await ajaxEditarMarchamo(idplt, marchamoEdit);
            if (respEditMarchamo[0].resp == 1) {

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


function ajaxEditarMarchamo(idPlt, marchamo) {
    console.log(idPlt);
    let respTran;
    var datos = new FormData();
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
        }});
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
        }});
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


