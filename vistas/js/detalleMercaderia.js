$(document).ready(function () {
    $(function () {
        $('#nav-images').click(function () { });
    });
});
$(document).on("click", ".btnADetalle", async function () {

    var estadoBoton = $(this).attr("estadoBoton");
    var idDetalle = $(this).attr("idDetalle");
    var idOrdenIng = document.getElementById("idOrdenIng").value;

    var paragraphsPos = Array.from(document.querySelectorAll("#cantidadPosiciones"));
    var contadorParam = 0;

    var tipoIng = document.getElementById("hiddenTipoIng").value;
    var tipOp = 0;

    if (tipoIng == "VEHICULOS NUEVOS" || tipoIng == "vehiculoUsado") {
        tipOp = 1;
    }
    var ejecucion = 0;
    if (tipOp == 0) {
        for (var i = 0; i < paragraphsPos.length; i++) {
            var areaBodega = paragraphsPos[i].attributes.areabod.nodeValue;
            if (areaBodega in localStorage) {
                contadorParam = contadorParam + 1;
            }
        }
        if (contadorParam != paragraphsPos.length) {
            Swal.fire({
                title: 'Faltan Ubicaciones',
                text: "No selecciono las ubicaciones de la mercader�a !",
                type: 'error',
                allowOutsideClick: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ok!'
            }).then((result) => {
                if (result.value) {

                    ejecucion = 1;
                }
            })
            return false;
        }


    }

    var resvResp = await revisarFormulario();
    console.log(tipOp);
    console.log(resvResp);
    console.log(paragraphsPos.length);


    if (tipOp == 0 && resvResp == paragraphsPos.length || tipoIng == "VEHICULOS NUEVOS" || tipoIng == "vehiculoUsado") {

        var empresa = document.getElementById("nombreEmpresa").value;
        var bultos = document.getElementById("cantidadBultos").value;
        var pesoKg = document.getElementById("pesoKg").value;
        var descripcionMerca = document.getElementById("descripcionMerca").value;
        var cantidadPosiciones = "";
        var Metraje = "";
        var revForm = 0;
        if ($("#cantidadPosicionesVeh").length) {
            var cantidadPosiciones = document.getElementById("cantidadPosicionesVeh").value;
        }
        if ($("#MetrajeVeh").length) {
            var Metraje = document.getElementById("MetrajeVeh").value;
        }

        if (tipoIng == "VEHICULOS NUEVOS" || tipoIng == "vehiculoUsado") {
            if (pesoKg == "" || bultos == "" || empresa == "" || isNaN(pesoKg) || isNaN(bultos) || Metraje == "" || Metraje == 0 || cantidadPosiciones == 0 || cantidadPosiciones == "" || descripcionMerca == "" || descripcionMerca == "OBSERVACIONES :" || descripcionMerca == "OBSERVACIONES : " || descripcionMerca == "OBSERVACIONES :  " || descripcionMerca == "OBSERVACIONES : 0" || isNaN(Metraje) || isNaN(cantidadPosiciones)) {
                revForm = 1;


            }
        } else {
            if (pesoKg == "" || bultos == "" || empresa == "" || isNaN(pesoKg) || isNaN(bultos) || descripcionMerca == "" || descripcionMerca == "OBSERVACIONES :" || descripcionMerca == "OBSERVACIONES : " || descripcionMerca == "OBSERVACIONES :  " || descripcionMerca == "OBSERVACIONES : 0" || isNaN(Metraje) || isNaN(cantidadPosiciones)) {
                revForm = 1;
            }
        }

        console.log(revForm);
        if (revForm == 1) {
            Swal.fire({
                title: "Formulario Detalle Bodega",
                text: "Existen Campos vacios o en posiciones y metros no coloco un numero valido.",
                type: 'error',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ok!'
            }).then((result) => {
                if (result.value) {

                }
            })
            return false;
        }

        if (tipoIng != "VEHICULOS NUEVOS" && tipoIng != "vehiculoUsado") {
            var ejecucion = 0;
            /*
             var paragraphs = Array.from(document.querySelectorAll("#spanUbiG"));
             listaUbDB = [];
             for (i = 0; i < paragraphs.length; i++) {
             var dataUbY = paragraphs[i].attributes.pasy.value;
             var dataUbX = paragraphs[i].attributes.colx.value;
             listaUbDB.push({"ubicacionY": dataUbY, "ubicacionX": dataUbX});
             }
             if (listaUbDB.length == 0) {
             Swal.fire({
             position: 'top-center',
             type: 'error',
             title: 'No selecciono ninguna ubicaci�n, favor agregue las ubicaciones correspondientes',
             showConfirmButton: false,
             timer: 3000
             })
             return false;
             } else {
             $("#hiddenLista").val(JSON.stringify(listaUbDB));
             }
             
             */

            /**
             * 
             * EL SIGUIENTE CODIGO TOMA LOCAL STORAGE DE UBICACIONES Y VALIDA SI EXISTEN CAMPOS VACIOS DE METROS O
             * POSCIONES EN EL FORMULARIO AUGUSTO GOMEZ 04.02.2021
             * 
             * **/



            var paragraphsPos = Array.from(document.querySelectorAll("#cantidadPosiciones"));
            var paragraphsMts = Array.from(document.querySelectorAll("#Metraje"));
            listaDB = [];

            for (var i = 0; i < paragraphsPos.length; i++) {
                var areaBodega = paragraphsPos[i].attributes.areabod.nodeValue;
                var CantPos = $(".cantidadPosiciones" + areaBodega).val();
                var CantMts = $(".Metraje" + areaBodega).val();
                var idArea = $(".cantidadPosiciones" + areaBodega).attr("idarea");
                if (areaBodega in localStorage) {
                    var promedioLocal = localStorage.getItem("promedioTarima");

                    var ubicaciones = localStorage.getItem(areaBodega);
                    var areaBod = JSON.parse(ubicaciones);
                    listaDB.push([idArea, areaBodega, CantPos, CantMts, promedioLocal, areaBod]);
                    console.log(listaDB);
                } else {
                    Swal.fire({
                        title: 'Faltan Ubicaciones',
                        text: "No selecciono las ubicaciones de la mercaderia en " + areaBodega + " !",
                        type: 'error',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok!'
                    }).then((result) => {
                        if (result.value) {
                            return false;
                            ejecucion = 1;
                        }
                    })

                }

                if (CantPos * 1 > 0 && CantMts * 1 > 0) {
                    var hiddenLista = JSON.stringify(listaDB);
                    console.log(hiddenLista);
                    //localStorage.removeItem(areaBodega);
                } else {
                    Swal.fire({
                        title: 'Campos vacios',
                        text: "La cantidad de posiciones o metros de las ubicaciones en " + areaBodega + " estan vacias!",
                        type: 'error',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok!'
                    }).then((result) => {
                        if (result.value) {
                            return false;
                        }

                    })
                }

                localStorage.removeItem(areaBodega);

            }


            /**
             * 
             * SI NO EXISTEN CAMPOS VACIOS DE METROS O
             * POISCIONES EN EL FORMULARIO, CONTINUA AUGUSTO GOMEZ 04.02.2021
             * 
             * **/
        }



        if (estadoBoton == 0) {
            document.getElementById("tableDinamicIngBod").innerHTML = "";
            var divtableDinamicIngBod = document.getElementById("tableDinamicIngBod");
            divtableDinamicIngBod.remove("col-8");
            document.getElementById('divAgregandoDetalles').setAttribute('class', "col-12");
            $(this).attr('estadoBoton', 1);
        }
        var idChequeBodega = document.getElementById("hiddenIdUs").value;
        var montacarga = document.getElementById("personaSeleccionada").value;
        var montargaSelect = Array.from(document.querySelectorAll(".imgMontarguista"));
        var listaMontarga = [];
        for (var i = 0; i < montargaSelect.length; i++) {
            var montacargaSel = montargaSelect[0]["attributes"]["user"].value;
            listaMontarga.push({"montacarguistaSele": montacargaSel});
        }
        listaMontarga = JSON.stringify(listaMontarga);

        if (idChequeBodega >= 1 && montacarga >= 1) {
            if (tipoIng != "VEHICULOS NUEVOS" && tipoIng != "vehiculoUsado") {
                var hiddenLista = hiddenLista;
            } else {
                var hiddenLista = tipoIng;

            }
            console.log(hiddenLista);
            if ($("#nombreEmpresa").length > 0) {
                var nombreEmpresa = document.getElementById("nombreEmpresa").value;
            }
            if ($("#cantidadBultos").length > 0) {

                var cantidadBultos = document.getElementById("cantidadBultos").value;
            }
            if ($("#selectUbicacion").length > 0) {
                var selectUbicacion = document.getElementById("selectUbicacion").value;

            }
            if ($("#descripcionMerca").length > 0) {
                var descripcionMerca = document.getElementById("descripcionMerca").value;

            }
            if ($("#cantidadPosicionesVeh").length > 0) {
                var cantidadPosiciones = document.getElementById("cantidadPosicionesVeh").value;

            }
            if ($("#MetrajeVeh").length > 0) {
                var Metraje = document.getElementById("MetrajeVeh").value;

            }
            var datos = new FormData();
            datos.append("idDetalle", idDetalle);
            datos.append("idOrdenIng", idOrdenIng);
            datos.append("selectUbicacion", selectUbicacion);
            datos.append("descripcionMerca", descripcionMerca);
            datos.append("cantidadPosiciones", cantidadPosiciones);
            datos.append("Metraje", Metraje);
            datos.append("hiddenLista", hiddenLista);
            datos.append("idChequeBodega", idChequeBodega);
            datos.append("montacarga", listaMontarga);
            $.ajax({
                url: "ajax/registroIngresoBodega.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (respuesta) {
                    console.log(respuesta);
                    /*=============================================
                     ACTUALIZANDO TABLE
                     =============================================*/
                    document.getElementById("tableMercaderia").innerHTML = '';
                    document.getElementById("tableMercaderia").innerHTML = '<table id="tableDetallesMerca"  class="table table-hover"></table>';
                    var numeroIdIng = document.getElementById("numeroIdIng").value;
                    var datos = new FormData();
                    datos.append("numeroIdIng", numeroIdIng);
                    $.ajax({
                        url: "ajax/registroIngresoBodega.ajax.php",
                        method: "POST",
                        data: datos,
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: "json",
                        success: function (respuesta) {
                            console.log(respuesta);
                            if (respuesta[0] == "finDetalle" || respuesta == "finDetalle") {
                                var ordenIng = document.getElementById("numeroIdIng").value;
                                document.getElementById("agregarDetalles").innerHTML = '<div class="btn-group"><button type="button" class="btn btn-success btnRecarga" id="recargaBtn">Ver otros ingresos<i class="fa fa-retweet"></i></button><button type="button" class="btn btn-sm btn-primary bntSalidaRapida" idcliente="' + ordenIng + '" data-toggle="modal" data-target="#modalSalidaRapida">Generar Pase <i class="fa fa-print" aria-hidden="true"></i></button></div><br/><br/><br/>';
                                swal({
                                    title: "Detalles agregados correctamente",
                                    type: "success"
                                }).then(okay => {
                                    if (okay) {
                                        $("#buttonMin").click();

                                    }
                                });

                            } else {
                                var lista = [];
                                if ($("#descripcionMerca").length > 0) {
                                    document.getElementById("descripcionMerca").value = "OBSERVACIONES :";
                                }

                                if ($("#nombreEmpresa").length > 0) {
                                    var nombreEmpresa = document.getElementById("nombreEmpresa").value;
                                }
                                if ($("#cantidadBultos").length > 0) {

                                    var cantidadBultos = document.getElementById("cantidadBultos").value;
                                }
                                if ($("#selectUbicacion").length > 0) {
                                    var selectUbicacion = document.getElementById("selectUbicacion").value;

                                }
                                if ($("#descripcionMerca").length > 0) {
                                    var descripcionMerca = document.getElementById("descripcionMerca").value;

                                }
                                if ($("#cantidadPosiciones").length > 0) {
                                    var cantidadPosiciones = document.getElementById("cantidadPosiciones").value;

                                }
                                if ($("#Metraje").length > 0) {
                                    var Metraje = document.getElementById("Metraje").value;

                                }
                                if ($("#pesoKg").length > 0) {
                                    var Metraje = document.getElementById("pesoKg").value;

                                }



                                var lista = [];
                                var numero = 0;
                                if (tipoIng != "VEHICULOS NUEVOS" && tipoIng != "vehiculoUsado") {

                                    for (var i = 0; i < respuesta[0].length; i++) {
                                        var numero = numero + 1;
                                        var numeroLabel = '<label>' + numero + '</label>'
                                        var empresa = '<label>' + respuesta[0][i]["empresa"] + '</label>';
                                        var bultos = '<label>' + respuesta[0][i]["bultos"] + '</label>';
                                        var peso = '<label>' + respuesta[0][i]["peso"] + '</label>';
                                        var acciones = '<div class="btn-group"><button type="button" class="btn btn-success btnUsarFila btn-sm" buttonUsarId=' + respuesta[0][i]["id"] + '><i class="fa fa-thumbs-up">&nbsp;&nbsp;Seleccionar</i></button></div>';

                                        lista.push([numeroLabel, empresa, bultos, peso, acciones]);
                                    }
                                } else {
                                    for (var i = 0; i < respuesta[0].length; i++) {

                                        var numero = numero + 1;
                                        var numeroLabel = '<label>' + numero + '</label>'
                                        var empresa = '<label>' + respuesta[0][i]["empresa"] + '</label>';
                                        var bultos = '<label>' + respuesta[0][i]["bultos"] + '</label>';
                                        var peso = '<label>' + respuesta[0][i]["peso"] + '</label>';
                                        if (tipoIng == "VEHICULOS NUEVOS") {
                                            var acciones = '<div class="btn-group"><button type="button" class="btn btn-success btnMsVehiculos btn-sm" idIngVehiculosN=' + numeroIdIng + '><i class="fa fa-thumbs-up">&nbsp;&nbsp;Mostrar Veh�culos</i></button></div>';
                                        } else {
                                            var acciones = '<div class="btn-group"><button type="button" class="btn btn-success btnUsarFila btn-sm" buttonUsarId=' + respuesta[0][i]["id"] + '><i class="fa fa-thumbs-up">&nbsp;&nbsp;Seleccionar</i></button></div>';

                                        }

                                        lista.push([numeroLabel, empresa, bultos, peso, acciones]);
                                    }
                                }
                                console.log(lista);
                                $('#tableDetallesMerca').DataTable({
                                    "language": {
                                        "sProcessing": "Procesando...",
                                        "sLengthMenu": "Mostrar _MENU_ registros",
                                        "sZeroRecords": "No se encontraron resultados",
                                        "sEmptyTable": "Ning�n dato disponible en esta tabla",
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
                                            "sLast": "�ltimo",
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
                                            title: "Empresa"
                                        }, {
                                            title: "Bultos"
                                        }, {
                                            title: "Peso"
                                        }, {
                                            title: "Accciones"
                                        }]
                                });
                            }
                        },
                        error: function (respuesta) {
                            console.log(respuesta);
                        }
                    })
                },
                error: function (respuesta) {
                    console.log(respuesta);
                }
            });
            if (tipoIng != "VEHICULOS NUEVOS" && tipoIng != "vehiculoUsado") {
                $("#divContenidoDetalle").append('<div id="divNum' + idDetalle + '" class="row"><div class="col-3"><div class="form-group"><label>Empresa</label><div class="input-group mb-1"><div class="input-group-prepend"><button idButtonDetalle="' + idDetalle + '" class="btn btn-danger btnQuitarDetalle" type="button"><i class="fa fa-close"></i></button><button idButtonDetalleEdit="' + idDetalle + '" class="btn btn-warning bntEditarDetalle" type="button" estado=0><i class="fa fa-edit"></i></button></div><!-- /btn-group --><input class="form-control" type="text" id="IdTextEmpresa' + idDetalle + '" value="' + nombreEmpresa + '" readOnly="readOnly"></div></div></div><div class="col-1"><div class="form-group"><label>Bultos</label><input class="form-control" placeholder="Numero de bultos" type="text" id="IdTextBultos' + idDetalle + '" value="' + cantidadBultos + '" readOnly="readOnly"></div></div><div class="col-2"><!-- /btn-group --> <label> Posiciones y metraje</label><div class="input-group"><input class="form-control" style="text-align: center;" type="text" id="IdTextPosiciones' + idDetalle + '" value="' + cantidadPosiciones + '" readOnly="readOnly"><b>||</b><input class="form-control" style="text-align: center;" type="text" id="IdTextMetraje' + idDetalle + '" value="' + Metraje + '"  readOnly="readOnly"><input id="selectUbicacionHid" name="" type="hidden" value="Piso"  readOnly="readOnly"><input  name="" type="hidden" value=""  readOnly="readOnly"><div class="input-group-append"></div></div></div><div class="col-1"><div class="form-group"><label>Ubicaci�n</label><select class="form-control select2" id="selectConsolidado" name="selectConsolidado" style="width: 100%;" disabled="disabled"><option selected="selected">' + selectUbicacion + '</option><option>Piso</option><option>Rack</option><option>Predio Vehiculos Usados</option><option>Fuera de bodega</option><option>Predio Vehiculos Nuevos</option></select></div></div><div class="col-4"><div class="form-group"><label>Descripci�n de ingreso</label><div class="input-group input-group"><input class="form-control" placeholder="Descripcion de ingreso" type="text" id="IdDescIngreso' + idDetalle + '" value="' + descripcionMerca + '" readOnly="readOnly"></div></div></div>');
                document.getElementById("rackPisoData").innerHTML = "";
            }
            if (tipoIng == "VEHICULOS NUEVOS" || tipoIng == "vehiculoUsado") {
                $("#selectUbicacion").append('<option selected="selected" disabled="disabled">Seleccione Ubicación</option>');


            }
            /***/
            if ($("#ubicacionesSelect").length) {
                document.getElementById("ubicacionesSelect").innerHTML = "";
            }
            if ($("#textDetalleVeh").length) {
                document.getElementById("textDetalleVeh").innerHTML = "";
            }

            if ($("#textDetalleVeh").length) {
                document.getElementById("textDetalleVeh").innerHTML = "";
            }

            document.getElementById("descripcionMerca").value = "OBSERVACIONES :";
            document.getElementById("nombreEmpresa").value = "";
            document.getElementById("cantidadBultos").value = "";
            document.getElementById("pesoKg").value = "";




            if ($("#MetrajeVeh".length > 0)) {
                document.getElementById("MetrajeVeh").value = "";

            }


            if ($("#cantidadPosicionesVeh".length > 0)) {
                document.getElementById("cantidadPosicionesVeh").value = "";

            }

            $(".divDetalleVehUsaLlave").removeAttr("disabled");
            $(".divDetalleVehUsaBat").removeAttr("disabled");
            $(".divDetalleVehUsaRad").removeAttr("disabled");
            $(".divDetalleVehUsaLlanta").removeAttr("disabled");
            $(".divDetalleVehUsaTr").removeAttr("disabled");
            $("#btnUbica").attr("estado", 0);
            var mensaje = "Detalle Registrado Correctamente";
            var tipo = "success";
            alertaToast(mensaje, tipo);
        } else {
            alert("el montacarguita no lo selecciono");
        }


        if ($("#rackPisoData").length > 0) {
            document.getElementById("rackPisoData").innerHTML = "";
        }
    } else {
        Swal.fire({
            title: 'Error en la transacción',
            text: "No selecciono ubicaciones o no agrego las posiciones de la mercaderia!",
            type: 'error',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok!'
        }).then((result) => {
            if (result.value) {

            }
        })
        return false;
    }

    //limpiando el formulario cuando es un vehiculo usado
});
$(document).on("click", ".btnQuitarDetalle", function () {
    //*    $(this).parent().parent().parent().parent().parent().remove();
    var idDetalleButton = $(this).attr("idButtonDetalle");
    console.log(idDetalleButton);
    var datos = new FormData();
    datos.append("idDetalleButton", idDetalleButton);
    $.ajax({
        url: "ajax/registroIngresoBodega.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            if (respuesta == "Anulado") {
                swal({
                    title: "Aviso",
                    text: "Se anulo el detalle del ingreso",
                    type: "success"
                }).then(okay => {
                    if (okay) {
                        $("#divNum" + idDetalleButton).remove();
                    }
                });
            }
        },
        error: function (respuesta) {
            console.log(respuesta);
        }
    });
    //**$(this).parent().parent().parent().parent().parent().remove();
});
$(document).on("click", ".bntPDFDetalleBodega", function () {
    var numeroIdIng = document.getElementById("numeroIdIng").value;
    var cliente = document.getElementById("cliente").value;
    var datos = new FormData();
    datos.append("codigo", numeroIdIng);
    $.ajax({
        url: "ajax/registroIngresoBodega.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log("data", respuesta);
            if (respuesta == "ok") {
                window.open("extensiones/tcpdf/pdf/Ingreso-bodega.php?codigo=" + numeroIdIng + "&cliente=" + cliente, "_blank");
            } else {
                swal({
                    type: "error",
                    title: "Error",
                    text: "Los detalles de la poliza estan incompletos revise",
                    showConfirmButton: true,
                    confrimButtonText: "cerrar",
                    closeConfirm: true
                });
            }
        },
        error: function (respuesta) {
            console.log(respuesta);
        }
    })
})
$(document).on("click", ".bntEditarDetalle", async function () {
    var llaveDetalleEdit = $(this).attr("idButtonDetalleEdit");
    var estado = $(this).attr("estado");
    if (estado == 0) {
        $(this).attr("estado", 1);
        $(this).html('<i class="fa fa-save"></i>');
        $(this).removeClass("btn-warning");
        $(this).addClass("btn-primary");
        //IdTextEmpresa
        //IdTextBultos
        document.getElementById("IdTextPosiciones" + llaveDetalleEdit).readOnly = false;
        document.getElementById("IdTextMetraje" + llaveDetalleEdit).readOnly = false;
        document.getElementById("IdDescIngreso" + llaveDetalleEdit).readOnly = false;
    } else if (estado == 1) {
        $(this).attr("estado", 0);
        $(this).html('<i class="fa fa-edit"></i>');
        $(this).removeClass("btn-primary");
        $(this).addClass("btn-warning");
        document.getElementById("IdTextPosiciones" + llaveDetalleEdit).readOnly = true;
        document.getElementById("IdTextMetraje" + llaveDetalleEdit).readOnly = true;
        document.getElementById("IdDescIngreso" + llaveDetalleEdit).readOnly = true;
        var IdTextPosiciones = document.getElementById("IdTextPosiciones" + llaveDetalleEdit).value;
        var IdTextMetraje = document.getElementById("IdTextMetraje" + llaveDetalleEdit).value;
        var IdDescIngreso = document.getElementById("IdDescIngreso" + llaveDetalleEdit).value;
        var editar = await editarBodegaDesc(IdTextPosiciones, IdTextMetraje, IdDescIngreso, llaveDetalleEdit);
        console.log(editar);
        if (editar == "Ok") {
            Swal.fire({
                position: 'top-center',
                type: 'success',
                title: 'Se modifico con exito el campo.',
                showConfirmButton: false,
                timer: 3000
            })
        } else if (editar == "restringido") {
            Swal.fire({
                position: 'top-center',
                type: 'error',
                title: 'No se puede modificar el campo, porque actualmente ya no cuenta con saldo en sistema.',
                showConfirmButton: false,
                timer: 6000
            })
        }
    }
})
function editarBodegaDesc(IdTextPosiciones, IdTextMetraje, IdDescIngreso, llaveDetalleEdit) {
    let todoMenus;
    var datos = new FormData();
    datos.append("editarIdDet", llaveDetalleEdit);
    datos.append("IdTextPosiciones", IdTextPosiciones);
    datos.append("IdTextMetraje", IdTextMetraje);
    datos.append("IdDescIngreso", IdDescIngreso);
    $.ajax({
        async: false,
        url: "ajax/registroIngresoBodega.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            if (respuesta[0].tipoRes == 1) {
                todoMenus = "Ok";
            } else {
                todoMenus = "restringido";
            }
        }, error: function (respuesta) {
            todoMenus = "error";
        }
    });
    return todoMenus;
}
function comprovarValorCasella(casella) {
    var paragraphs = Array.from(document.querySelectorAll("#btnElimin"));
    if (casella == "Area1") {
        document.getElementById("tablaUbica").innerHTML = '<tr><td id="pas-1 col-1" class= "casilla" valCas=0 onClick="comprovarValorcasilla(' + "'pas-1 col-1'" + ')"><b style="font-size:medium">pas-1 col-1</b></td><td id="pas-2 col-1" class= "casilla" valCas=0 onClick="comprovarValorcasilla(' + "'pas-2 col-1'" + ')"><b style="font-size:medium">pas-2 col-1</b></td></tr><tr><td id="pas-1 col-2" class="casilla" valCas=0 onClick="comprovarValorcasilla(' + "'pas-1 col-2'" + ')"><b style="font-size:medium">pas-1 col-2</b></td><td id="pas-2 col-2" class= "casilla" valCas=0 onClick="comprovarValorcasilla(' + "'pas-2 col-2'" + ')"><b style="font-size:medium">pas-2 col-2</b></td></tr><tr><td id="pas-1 col-3" class= "casilla" valCas=0 onClick="comprovarValorcasilla(' + "'pas-1 col-3'" + ')"><b style="font-size:medium">pas-1 col-2</b></td><td id="pas-2 col-3" class= "casilla" valCas=0 onClick="comprovarValorcasilla(' + "'pas-2 col-3'" + ')"><b style="font-size:medium">pas-2 col-3</b></td></tr><tr><td id="pas-1 col-4" class= "casilla" valCas=0 onClick="comprovarValorcasilla(' + "'pas-1 col-4'" + ')"><b style="font-size:medium">pas-1 col-4</b></td><td id="pas-2 col-4" class= "casilla" valCas=0 onClick="comprovarValorcasilla(' + "'pas-2 col-4'" + ')"><b style="font-size:medium">pas-2 col-4</b></td></tr><tr><td id="pas-1 col-5" class= "casilla" valCas=0 onClick="comprovarValorcasilla(' + "'pas-1 col-5'" + ')"><b style="font-size:medium">pas-1 col-5</b></td><td id="pas-2 col-5" class= "casilla" valCas=0 onClick="comprovarValorcasilla(' + "'pas-2 col-5'" + ')"><b style="font-size:medium">pas-2 col-5</b></td></tr><tr><td id="pas-1 col-6" class= "casilla" valCas=0 onClick="comprovarValorcasilla(' + "'pas-1 col-6'" + ')"><b style="font-size:medium">pas-1 col-6</b></td><td id="pas-2 col-6" class= "casilla" valCas=0 onClick="comprovarValorcasilla(' + "'pas-2 col-6'" + ')"><b style="font-size:medium">pas-2 col-6</b></td></tr><tr><td id="pas-1 col-7" class= "casilla" valCas=0 onClick="comprovarValorcasilla(' + "'pas-1 col-7'" + ')"><b style="font-size:medium">pas-1 col-7</b></td><td id="pas-2 col-7" class= "casilla" valCas=0 onClick="comprovarValorcasilla(' + "'pas-2 col-7'" + ')"><b style="font-size:medium">pas-2 col-7</b></td></tr><tr><td id="pas-1 col-8" class= "casilla" valCas=0 onClick="comprovarValorcasilla(' + "'pas-1 col-8'" + ')"><b style="font-size:medium">pas-1 col-8</b></td><td id="pas-2 col-8" class= "casilla" valCas=0 onClick="comprovarValorcasilla(' + "'pas-2 col-8'" + ')"><b style="font-size:medium">pas-2 col-8</b></td></tr><tr><td id="pas-1 col-9" class= "casilla" valCas=0 onClick="comprovarValorcasilla(' + "'pas-1 col-9'" + ')"><b style="font-size:medium">pas-1 col-9</b></td><td id="pas-2 col-9" class= "casilla" valCas=0 onClick="comprovarValorcasilla(' + "'pas-2 col-9'" + ')"><b style="font-size:medium">pas-2 col-9</b></td></tr><tr><td id="pas-1 col-10" class= "casilla" valCas=0 onClick="comprovarValorcasilla(' + "'pas-1 col-10'" + ')"><b style="font-size:medium">pas-1 col-10</b></td><td id="pas-2 col-10" class= "casilla" valCas=0 onClick="comprovarValorcasilla(' + "'pas-2 col-10'" + ')"><b style="font-size:medium">pas-2 col-10</b></td></tr><tr><td id="pas-1 col-11" class= "casilla" valCas=0 onClick="comprovarValorcasilla(' + "'pas-1 col-11'" + ')"><b style="font-size:medium">pas-1 col-11</b></td><td id="pas-2 col-11" class= "casilla" valCas=0 onClick="comprovarValorcasilla(' + "'pas-2 col-11'" + ')"><b style="font-size:medium">pas-2 col-11</b></td></tr><tr><td id="pas-1 col-12" class= "casilla" valCas=0 onClick="comprovarValorcasilla(' + "'pas-1 col-12'" + ')"><b style="font-size:medium">pas-1 col-12</b></td><td id="pas-2 col-12" class= "casilla" valCas=0 onClick="comprovarValorcasilla(' + "'pas-2 col-12'" + ')"><b style="font-size:medium">pas-2 col-12</b></td></tr>';
    }
}
function comprovarValorcasilla(casilla) {
    var intro = document.getElementById(casilla);
    intro.style.backgroundColor = '#d1c4e9';
    document.getElementById("new-event").value = casilla;
}


$(document).ready(function () {
    $("#selectUbicacion").change(function () {

        var tipoIng = document.getElementById("hiddenTipoIng").value;
        if (tipoIng != "VEHICULOS NUEVOS" && tipoIng != "vehiculoUsado") {


            var e = document.getElementById("selectUbicacion");
            var indexValue = e.options[e.selectedIndex].value;
            var indexText = e.options[e.selectedIndex].text;
            console.log(indexValue);
            console.log(indexText);

            if (indexValue * 1 > 0) {
                if ($("#cantidadPosiciones" + indexText).length == 0) {
                    $("#rackPisoData").append(
                            `
                    <div class="input-group mt-2">
                        <input type="number" id="cantidadPosiciones" name="cantidadPosiciones" class="form-control cantidadPosiciones` + indexText + `" idArea="` + indexValue + `" areaBod="` + indexText + `" placeholder="Cantidad de posiciones en ` + indexText + `" style="text-align: center;" value="">
                        <input type="number" id="Metraje" name="Metraje" class="form-control Metraje` + indexText + `" areaBod="` + indexText + `" placeholder="Cantidad de Metros ` + indexText + `" style="text-align: center;" value="">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-success" id="btnUbica" estado=0 data-toggle="modal" data-target="#MyagrUbicacion"  idArea="` + indexValue + `" tipoAreaBod="` + indexText + `">Ubicación en ` + indexText + `&nbsp;&nbsp;<i class="fa fa-map-marker"></i></button>           
                            <button type="button" class="btn btn-outline-danger btnTrashUbSelec" tipoAreaBod="` + indexText + `">` + indexText + `&nbsp;&nbsp;<i class="fa fa-trash"></i></button>                       
                        </div>
                        <!-- /btn-group -->
                    </div>
                    `);
                } else {
                    Swal.fire(
                            'Area duplicada ',
                            'Esta area ya fue seleccionada una vez',
                            'error'
                            )
                }

            } else {
                document.getElementById("divFueraMotivo").innerHTML = '<div class="form-group tooltips"><label>Pasillo</label><br><button type="button" class="btn btn-primary" id="btnUbica" estado=0 idPredio=' + indexText + ' data-toggle="modal" data-target="#MyagrUbicacion"><i class="fa fa-map-marker"></i></button><span>Seleccione ubicación</span></div>';
            }
        }
    })
})
$(document).on("click", "#btnUbica", function () {
    var tipoAreaBod = $(this).attr("tipoAreaBod");
    var idarea = $(this).attr("idarea");

    document.getElementById("hiddenAreaBod").value = tipoAreaBod;
    document.getElementById("idAreaBod").value = idarea;
    var estadoButton = $(this).attr("estado");

    if (estadoButton == 0) {
        document.getElementById("buttonMin").click();
        var idPredio = $(this).attr("idPredio");
        if (idPredio >= 1) {
            var hiddenIdBod = idPredio;
        } else {
            var hiddenIdBod = document.getElementById("hiddenIdBod").value;
        }
        console.log(hiddenIdBod);

        var datos = new FormData();
        datos.append("hiddenIdBod", hiddenIdBod);
        $.ajax({
            url: "ajax/registroIngresoBodega.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (respuesta) {
                document.getElementById("mapeandoUbicaciones").innerHTML = "";
                document.getElementById("mapeandoAcciones").innerHTML = "";
                console.log(respuesta);
                var tabla = document.createElement("table");
                var tblBody = document.createElement("tbody");   // Crea las celdas
                for (var i = 0; i < respuesta["TCordenadas"][0]["pasillos"]; i++) {    // Crea las hileras de la tabla           
                    var hilera = document.createElement("tr");
                    for (var j = 0; j < respuesta["TCordenadas"][0]["columnas"]; j++) {      // Crea un elemento <td> y un nodo de texto, haz que el nodo de
                        // texto sea el contenido de <td>, ubica el elemento <td> al final
                        // de la hilera de la tabla                 
                        var celda = document.createElement("td");
                        pasY = respuesta["TCordenadas"][0]["pasillos"] - i;
                        colX = j + 1;
                        celda.setAttribute("id", "P" + pasY + "C" + colX);
                        celda.setAttribute("pasYcolX", "P" + pasY + "C" + colX);
                        celda.setAttribute("pasY", pasY);
                        celda.setAttribute("colX", colX);
                        celda.setAttribute("estado", 0);
                        celda.setAttribute("onClick", "congelarCeldas('P" + pasY + "C" + colX + "')");
                        var textoCelda = document.createTextNode("P" + pasY + "C" + colX);
                        celda.appendChild(textoCelda);
                        hilera.appendChild(celda);
                    }     // agrega la hilera al final de la tabla (al final del elemento tblbody)           
                    tblBody.appendChild(hilera);
                }   // posiciona el <tbody> debajo del elemento <table>     
                tabla.appendChild(tblBody);  // appends <table> into <body>
                document.getElementById("mapeandoUbicaciones").appendChild(tabla);   // modifica el atributo "border" de la tabla y lo fija a "2";
                tabla.setAttribute("id", "tablaScrolling");
                tabla.setAttribute("width", "100%");
                console.log(respuesta);
                if (respuesta["TCordenadasIn"] != "SD") {


                    for (var i = 0; i < respuesta["TCordenadasIn"].length; i++) {
                        var pasilloY = 'P' + respuesta["TCordenadasIn"][i]["pasilloY"];

                        var columnaX = 'C' + respuesta["TCordenadasIn"][i]["columnaX"];


                        var pasColInact = pasilloY + columnaX;

                        document.getElementById(pasColInact).setAttribute('style', 'background-color: #424242; color: white');
                        $('#' + pasColInact).attr('estado', 2);
                        $("#btnUbica").attr("estado", 1);
                    }
                }
            }, error: function (resepuesta) {
                console.log(respuesta);
            }
        })
    } else {
        document.getElementById("buttonMin").click();
        var hiddenIdBod = document.getElementById("hiddenIdBod").value;
    }
});
$(document).on("click", ".btnTra", function () {
    var value = $(this).attr("ubicaDatParent");
    var intro = document.getElementById(value);
    intro.style.backgroundColor = '#29b6f6';
    $(intro).attr("valCas", 0);
    $(this).parent().parent().parent().remove();
    var paragraphs = Array.from(document.querySelectorAll("#textPos"));
    console.log(paragraphs.length);
    lista = [];
    for (i = 0; i < paragraphs.length; i++) {
        var dataUbica = paragraphs[i]["defaultValue"];
        lista.push({
            "data": dataUbica
        });
    }
})
$(document).on("click", ".casilla", function () {
    var casillaVal = $(this).attr("valCas");
    if (casillaVal == 0) {
        document.getElementById("add-new-event").disabled = false;
        document.getElementById("add-new-event").click();
        $(this).attr("valCas", 1);
        document.getElementById("add-new-event").disabled = true;
    } else {
    }
})
$(document).on("click", ".btnGuardaUbic", function () {
    var paragraphs = Array.from(document.querySelectorAll("#textPos"));
    listaDb = [];
    for (i = 0; i < paragraphs.length; i++) {
        var dataUbica = paragraphs[i]["defaultValue"];
        listaDb.push({
            "ubicacion": dataUbica
        });
    }
    $(".close").click();
    $(".btnVerDetalles").click();
    for (i = 0; i < listaDb.length; i++) {
        if (i == 0) {
            document.getElementById("ubicacionesSelect").innerHTML = '';
            $("#btnUbica").attr("estado", 0);
        }
        var pariN = (i / 2).toFixed(0) * 2;
        if (i == pariN) {
            var dat = listaDb[i]["ubicacion"];
            document.getElementById("ubicacionesSelect").innerHTML += '<button type="button" id="btnElimin" eliminar="' + dat + '" class="btn btn-outline-success btn-sm"><i id="fatrash"class="fa fa-trash btnEliminaUbica"> <label> ' + dat + '<label></i></button>';
        } else {
            var dat = listaDb[i]["ubicacion"];
            document.getElementById("ubicacionesSelect").innerHTML += '<button type="button" id="btnElimin" eliminar="' + dat + '" class="btn btn-outline-danger btn-sm"><i id="fatrash"class="fa fa-trash btnEliminaUbica"> <label> ' + dat + '<label></i></button>';
        }
    }
})

$(document).on("click", ".btnGuardaUbicacion", function () {
    var paragraphs = Array.from(document.querySelectorAll(".resetCeldas"));
    var hiddenAreaBod = document.getElementById("hiddenAreaBod").value;
    var idAreaBod = document.getElementById("idAreaBod").value;
    listaUbInactiva = [];
    for (var i = 0; i < paragraphs.length; i++) {
        var datoY = paragraphs[i].attributes.ejeY.value;
        var datoX = paragraphs[i].attributes.ejeX.value;
        listaUbInactiva.push({
            "idAreaBod": idAreaBod,
            "hiddenAreaBod": hiddenAreaBod,
            "datoY": datoY,
            "datoX": datoX
        })
    }

    if (hiddenAreaBod in localStorage) {
        localStorage.removeItem(hiddenAreaBod);
    }
    var listaUbInactiva = JSON.stringify(listaUbInactiva);
    localStorage.setItem(hiddenAreaBod, listaUbInactiva);
    console.log("#btnVerUbica" + hiddenAreaBod);
    $("#btnVerUbica" + hiddenAreaBod).removeClass("btn-outline-danger");
    $("#btnVerUbica" + hiddenAreaBod).addClass("btn-info");

    /* document.getElementById("ubicacionesSelect").innerHTML = '';
     for (var i = 0; i < listaUbInactiva.length; i++) {
     var pasillo = listaUbInactiva[i]["datoY"];
     var columna = listaUbInactiva[i]["datoX"];
     var pasCol = 'P' + pasillo + 'C' + columna;
     document.getElementById("ubicacionesSelect").innerHTML += '<span id="spanUbiG" pasY=' + pasillo + ' colX=' + columna + ' class="badge badge-warning float-right">' + pasCol + '&nbsp;&nbsp;&nbsp;&nbsp;</span>';
     }*/
    $(".close").click();
    $('.btnVerDetalles').click();
})
$(document).on("click", ".btnAudioDescr", async function () {
    let rec;
    if (!("webkitSpeechRecognition" in window)) {
        alert("Su navegador no soporta, la api.")
    } else {
        rec = new webkitSpeechRecognition();
        rec.lang = "es-GT";
        rec.continuos = true;
        rec.interim = true;
        rec.addEventListener("result", iniciar);

    }
    function iniciar(event) {
        for (i = event.resultIndex; i < event.results.length; i++) {
            var cadenaAudio = event.results[i][0].transcript;
            console.log(cadenaAudio);
            document.getElementById('descripcionMerca').value = "OBSERVACIONES : " + cadenaAudio.toUpperCase();
        }
    }
    rec.start();

})
function comprovarValorcasilla(casilla) {
    var intro = document.getElementById(casilla);
    intro.style.backgroundColor = '#d1c4e9';
    document.getElementById("new-event").value = casilla;
}
function congelarCeldas(casilla) {
    console.log(casilla);
    var intro = document.getElementById(casilla);
    console.log(intro);
    var pasEjeY = $(intro).attr("pasY");
    var pasEjeX = $(intro).attr("colx");
    var estado = $(intro).attr("estado");
    if (estado == 0) {
        intro.style.backgroundColor = '#005b9f';
        intro.style.color = "white";
        $(intro).attr("estado", 1);
        $("#mapeandoAcciones").append('<label id="resetCeldas' + casilla + '" ejeY=' + pasEjeY + ' ejeX=' + pasEjeX + ' resetCeldas="' + casilla + '" class="resetCeldas"> <i class="fa fa-trash" style="color:white"> ' + casilla + '</i></label>');
    } else if (estado == 1) {
        intro.style.backgroundColor = '#6cb3e6';
        intro.style.color = "white";
        $(intro).attr("estado", 0);
        console.log("resetCeldas" + casilla);
        document.getElementById("resetCeldas" + casilla).remove();
    }
    if (estado == 2) {
        intro.style.backgroundColor = '#004c40';
        intro.style.color = "white";
        $(intro).attr("estado", 3);
        $("#mapeandoAcciones").append('<label id="resetCeldas' + casilla + '" ejeY=' + pasEjeY + ' ejeX=' + pasEjeX + ' resetCeldas="' + casilla + '" class="resetCeldas"> <i class="fa fa-trash" style="color:white"> ' + casilla + '</i></label>');
    } else if (estado == 3) {
        intro.style.backgroundColor = '#424242';
        intro.style.color = "white";
        $(intro).attr("estado", 2);
        console.log("resetCeldas" + casilla);
        document.getElementById("resetCeldas" + casilla).remove();
    }
}
$(document).on("click", ".resetCeldas", function () {
    var elementoY = $(this).attr("ejey");
    var elementoX = $(this).attr("ejex");
    var casilla = "P" + elementoY + "C" + elementoX;
    congelarCeldas(casilla);
})

$(document).on("click", ".btnRecarga", function () {
    location.reload();
})

$(document).on("click", "#buttonMin", function () {
    if ($(".btnRecarga").length >= 1) {
        $(".bntSalidaRapida").click();
    }
})

$(document).on("change", "#personaSeleccionada", async function () {
    var montarcarguista = $(this).val();
    var respMontarga = await mostrarMontarguistasCuliminar(montarcarguista);

    if (respMontarga != "SD") {

        var nombre = respMontarga[0]["nombres"];
        var apellidos = respMontarga[0]["apellidos"];
        var email = respMontarga[0]["email"];
        var telefono = respMontarga[0]["telefono"];
        var foto = respMontarga[0]["foto"];
        var idMontarcaga = respMontarga[0]["idMontarcaga"];
        if (foto == "") {
            var foto = 'vistas/img/usuarios/default/anonymous.png';
        }
        console.log(nombre);
        $("#montacargas").append(
                `
    <div class="info-box bg-warning" id="idMont` + idMontarcaga + `">
        
        <span class="info-box-icon"><img class="img-circle elevation-2 imgMontarguista" src="` + foto + `" user=` + idMontarcaga + ` alt="User Avatar"></span>
               
        <div class="info-box-content">
            <span class="info-box-text">` + nombre + ` ` + apellidos + `</span>
            <span class="info-box-number">Correo : ` + email + `</span>
        <span class="info-box-number">Tel�fono : ` + telefono + `  Montarguista</span>
        </div>
        <button type="button" id="closeMontacarg" idMont="idMont` + idMontarcaga + `" class="closeMont" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">X</span>
                                    </button>
    </div>
`);
    }
})

function mostrarMontarguistasCuliminar(montarcarguista) {
    let respMont;
    var datos = new FormData();
    datos.append("montarcarguista", montarcarguista);
    console.log(montarcarguista);
    $.ajax({
        async: false,
        url: "ajax/registroIngresoBodega.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            respMont = respuesta;

        }, error: function (error) {
            console.log(error);
            respMont = error;
        }
    });

    return respMont;

}


$(document).on("keyup", "#descripcionMerca", function () {
    for (var i = 0; i < 350; i++) {
        var e = $(this).val();
        let contenido = e;
        $(this).val(contenido.toUpperCase().replace("  ", " "));
    }
})
$(document).on("change", "#descripcionMerca", function () {
    for (var i = 0; i < 350; i++) {
        var e = $(this).val();
        let contenido = e;
        $(this).val(contenido.toUpperCase().replace("  ", " "));
    }
})

$(document).on("click", "#closeMontacarg", function () {
    var divMont = $(this).attr('idMont');
    $("#" + divMont).remove();
})


$(document).on("click", ".btnTrashUbSelec", function () {
    var tipoAreaBod = $(this).attr("tipoAreaBod");
    if (tipoAreaBod in localStorage) {
        localStorage.removeItem(tipoAreaBod);
    }
    $(this).parent().parent().remove();
})
function revisarFormulario() {
    var contadorParam = 0;
    if ($("#cantidadPosiciones").length) {
        var paragraphsPos = Array.from(document.querySelectorAll("#cantidadPosiciones"));

        for (var i = 0; i < paragraphsPos.length; i++) {

            var areaBodega = paragraphsPos[i].attributes.areabod.nodeValue;
            var CantPos = $(".cantidadPosiciones" + areaBodega).val();
            var CantMts = $(".Metraje" + areaBodega).val();
            if (areaBodega in localStorage && CantPos * 1 > 0 && CantMts * 1 > 0) {
                contadorParam = contadorParam + 1;
            }
        }
        return contadorParam;
    } else {
        return false;
    }

}   