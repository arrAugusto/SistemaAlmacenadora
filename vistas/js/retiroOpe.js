$(document).on("click", ".btnBuscaRetiro", function () {
    if ($("#tdDatosGenerales").length == 0) {
        document.getElementById("dataRetiro").innerHTML = "";
        document.getElementById("dataRetiro").innerHTML = '<table id="tablaMerRetiro" class="table table-hover table-sm"></table><input type="hidden" id="hiddenListaDeta" value="">';
        var datoSearchPol = document.getElementById("textParamBusqRet").value;
        datoSearchPol.toLowerCase();
        console.log(datoSearchPol);
        if (datoSearchPol == "") {
            Swal.fire('Campo vacio', 'No ingreso ningun digito, escriba la poliza, contenedor, nit, nombre de la poliza', 'error');
            invalidar("textParamBusqRet");
        } else if (datoSearchPol !== "") {
            var datos = new FormData();
            datos.append("datoSearchPol", datoSearchPol);
            $.ajax({
                url: "ajax/retiroOpe.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (respuesta) {
                    console.log(respuesta);
                    if (respuesta == "SD") {
                        Swal.fire('Sin coincidencia', 'No se encontraron ingresos para mostrar', 'error');
                        invalidar("textParamBusqRet");
                    } else {
                        $("#textParamBusqRet").removeClass("is-invalid");
                        $("#textParamBusqRet").addClass("is-valid");
                        var lista = [];
                        var contador = 1;
                        for (var i = 0; i < respuesta.length; i++) {
                            var datPoliza = respuesta[i].Poliza;
                            var datconsolidado = respuesta[i].Empresa;
                            var datblts = respuesta[i].blts;
                            var datdimPeso = respuesta[i].pesokg + " kg";
                            if (respuesta[i].familiaPoliza == 1) {
                                if (respuesta[i].tipo == "AF") {
                                    var acciones = '<div class="btn-group"><button type="button" class="btn btn-danger btnListaSelect btn-sm" id="buttonDisparoDetalle" idIngSelectDetOpe=' + respuesta[i]["idIng"] + ' id="select' + [i] + '" empresa="' + datconsolidado + '" poliza="' + datPoliza + '" numeroButt=' + [i] + ' idDeBodega=' + respuesta[i].idIng + '  id="buttonDetalleRet">Selec AF</button><button type="button" class="btn btn-info btnVerSaldos btn-sm" id="trasladoFiscal" idIngSelectDetOpe=' + respuesta[i]["idIng"] + ' id="select' + [i] + '" empresa="' + datconsolidado + '" poliza="' + datPoliza + '" numeroButt=' + [i] + ' idDeBodega=' + respuesta[i].idIng + '  id="buttonDetalleRet">Ver Saldos</button></div>';
                                }
                                if (respuesta[i].tipo == "ZA" || respuesta[i].tipo == 1) {
                                    var acciones = '<div class="btn-group"><button type="button" class="btn btn-primary btnListaSelect btn-sm" id="buttonDisparoDetalle" idIngSelectDetOpe=' + respuesta[i]["idIng"] + ' id="select' + [i] + '" empresa="' + datconsolidado + '" poliza="' + datPoliza + '" numeroButt=' + [i] + ' idDeBodega=' + respuesta[i].idIng + '  id="buttonDetalleRet">Selec ZA</button><button type="button" class="btn btn-warning btnTrasladoFiscal btn-sm" id="trasladoFiscal" idIngSelectDetOpe=' + respuesta[i]["idIng"] + ' id="select' + [i] + '" empresa="' + datconsolidado + '" poliza="' + datPoliza + '" numeroButt=' + [i] + ' idDeBodega=' + respuesta[i].idIng + '  id="buttonDetalleRet">Traslado Fiscal</button></div>';
                                }

                            } else {
                                var acciones = '<div class="btn-group"><button type="button" class="btn btn-primary btnListaSelect btn-sm" id="buttonDisparoDetalle" idIngSelectDetOpe=' + respuesta[i]["idIng"] + ' id="select' + [i] + '" empresa="' + datconsolidado + '" poliza="' + datPoliza + '" numeroButt=' + [i] + ' idDeBodega=' + respuesta[i].idIng + '  id="buttonDetalleRet">Seleccionar</button></div>';
                            }
                            lista.push([datPoliza, datconsolidado, datblts, datdimPeso, acciones]);
                        }
                        $('#tablaMerRetiro').DataTable({
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
                                    title: "Numero Poliza"
                                }, {
                                    title: "Consolidado/Empresa"
                                }, {
                                    title: "Cantidad Bultos"
                                }, {
                                    title: "Peso kg"
                                }, {
                                    title: "Acciones"
                                }]
                        });
                    }
                },
                error: function (respuesta) {
                    console.log(respuesta);
                }
            });
        }
    }
});
$(document).on("change", "#txtNitSalida", function () {
    var txtNitSalida = $(this).val();
    if (txtNitSalida == "") {
        $("#txtNitSalida").removeClass("is-valid");
        $("#txtNitSalida").addClass("is-invalid");
        $("#txtNombreSalida").removeClass("is-valid");
        $("#txtNombreSalida").addClass("is-invalid");
        $("#txtDireccionSalida").removeClass("is-valid");
        $("#txtDireccionSalida").addClass("is-invalid");
        $("#txtNombreSalida").val('');
        $("#txtDireccionSalida").val('');
        $("#txtNitSalida").focus();
    } else {
        var datos = new FormData();
        datos.append("txtNitSalida", txtNitSalida);
        $.ajax({
            url: "ajax/retiroOpe.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (respuesta) {
                console.log(respuesta);
                if (respuesta == "SD") {
                    //agregar nuevo nit

                    Swal.fire({
                        title: 'Agregar Nit',
                        text: "Agrega el nuevo numero de nit",
                        type: 'error',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        cancelButtonText: 'Cancelar',
                        confirmButtonText: 'Agregar'
                    }).then((result) => {
                        if (result.value) {
                            $("#txtNitSalida").removeClass("is-valid");
                            $("#txtNitSalida").addClass("is-invalid");
                            document.getElementById("txtNitSalida").value = "";
                            Swal.fire(
                                    'Agregar Nit',
                                    'Vaya ala barra superior azul, y haga click en agregar nuevos datos',
                                    'info'
                                    )
                        }
                    })


                    respuestaData = false;
                    $("#txtNitSalida").removeClass("is-valid");
                    $("#txtNitSalida").addClass("is-invalid");
                    $("#txtNombreSalida").removeClass("is-valid");
                    $("#txtNombreSalida").addClass("is-invalid");
                    $("#txtDireccionSalida").removeClass("is-valid");
                    $("#txtDireccionSalida").addClass("is-invalid");
                    $("#txtNombreSalida").val('');
                    $("#txtDireccionSalida").val('');
                    $("#txtNitSalida").focus();
                } else {
                    $("#txtNitSalida").removeClass("is-invalid");
                    $("#txtNitSalida").addClass("is-valid");
                    $("#txtNombreSalida").removeClass("is-invalid");
                    $("#txtNombreSalida").addClass("is-valid");
                    $("#txtDireccionSalida").removeClass("is-invalid");
                    $("#txtDireccionSalida").addClass("is-valid");
                    $("#polizaRetiro").focus();
                    $("#txtNitSalida").attr("dataretiro", respuesta[0]["nt"]);
                    if ($("#txtNombreSalida").length > 0) {
                        document.getElementById("txtNombreSalida").value = respuesta[0].nombre;
                        document.getElementById("txtDireccionSalida").value = respuesta[0].direccion;
                        document.getElementById("polizaRetiro").focus();

                    }
                    if ($("#tdDatosGenerales").length > 0) {
                        var nitEmpresa = document.getElementById("txtNitSalida").value;
                        var nombreRet = respuesta[0].nombre;
                        var direSal = respuesta[0].direccion;
                        var idNit = respuesta[0]["nt"];
                        Swal.fire({
                            title: 'Desea el NIT con el que se emitirá el recibo',
                            type: 'warning',
                            allowOutsideClick: false,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Si, cambiar NIT!'
                        }).then((result) => {
                            if (result.value) {
                                document.getElementById("tdDatosGenerales").innerHTML = ` 
                <div class="row">
                    <div class="col-11">
                        <input type="hidden" id="hiddenIdNitFact" value=` + idNit + ` />
                        <p class="lead">
                        &nbsp;Nit :  <strong style="color: #1976d2">` + nitEmpresa + `</strong><br/>
                        &nbsp;Empresa : <strong style="color: #1976d2">` + nombreRet + `</strong><br/>
                        &nbsp;Dirección : <strong style="color: #1976d2">` + direSal + `</strong></p>
                    </div>
                </div>
    `;

                            }
                        })





                    }
                }
            },
            error: function (respuesta) {
                console.log(respuesta);
            }
        });
    }
});
$(document).on("click", ".btnListaSelect", async function () {
    var idBut = $(this);
    var idIngOpDet = $(this).attr("idingselectdetope");
    var respSaldos = await funcRevSaldosAF(idIngOpDet);
    console.log(respSaldos);
    var verSaldo = 0;
    if (respSaldos != "SD") {
        if (respSaldos[0].tipo == "AF") {
            var nomVar = "idIngEditOp";
            var respData = await dataIngTraslado(nomVar, idIngOpDet);
            console.log(respData);
            //SALDO BULTOS
            var bultos = respData["dataIng"][0]["bultos"];
            var bultos = parseInt(bultos);
            var sldBlts = respSaldos[0].saldoBultos;
            var sldBlts = parseInt(sldBlts);
            var retiroBlts = bultos - sldBlts;
            //SALDO CIF
            var valCif = respData["dataIng"][0]["valCif"];
            var valCif = parseFloat(valCif).toFixed(2);
            var valCifNumb = new Intl.NumberFormat("en-GT").format(valCif);

            var cif = respSaldos[0].saldoValorCif;
            var cif = parseFloat(cif).toFixed(2);
            var cifNumber = new Intl.NumberFormat("en-GT").format(cif);

            var cifRetiro = valCif - cif;
            var cifRetiro = parseFloat(cifRetiro).toFixed(2);
            var cifRetiroNumb = new Intl.NumberFormat("en-GT").format(cifRetiro);

            //SALDO IMPUESTOS
            var valImpuesto = respData["dataIng"][0]["valImpuesto"];
            var valImpuesto = parseFloat(valImpuesto).toFixed(2);
            var valImpuestoNumb = new Intl.NumberFormat("en-GT").format(valImpuesto);


            var sldImpt = respSaldos[0].saldoValorImpuesto;
            var sldImpt = parseFloat(sldImpt).toFixed(2);
            var sldImptNumber = new Intl.NumberFormat("en-GT").format(sldImpt);

            var imptsRet = valImpuesto - sldImpt;
            var imptsRet = parseFloat(imptsRet).toFixed(2);
            var imptsRetNumb = new Intl.NumberFormat("en-GT").format(imptsRet);


            document.getElementById("ListaSelect").innerHTML = `

            <div class="card-footer mt-4">
        <div class="row">
            <div class="col-sm-4 col-6">
                <div class="description-block border-right">
                    <h5 class="description-header">Saldo Bultos <i class="fa fa-box-open"></i></h5>
                    <span class="description-text" id="bltsIng"><label class="badge bg-info" style="font-size: 13px;">Ing :&nbsp;` + bultos + `</label><br><label class="badge bg-info" style="font-size: 13px;">Retiro : &nbsp;` + retiroBlts + `</label><br><label class="badge bg-danger" style="font-size: 20px;">Saldo : &nbsp;` + sldBlts + `</label></span>
                </div>
            </div>
            <div class="col-sm-4 col-6">
                <div class="description-block border-right">
                    <h5 class="description-header">Saldo Cif (Q)</h5>
                    <span class="description-text" id="cifIng"><label class="badge bg-info" style="font-size: 13px;">ING : &nbsp;` + valCif + `</label><br><label class="badge bg-info" style="font-size: 13px;">RET : &nbsp;` + cifRetiroNumb + `</label><br><label class="badge bg-danger" style="font-size: 20px;">Saldo : &nbsp;` + cifNumber + `</label></span>
                </div>
            </div>
            <div class="col-sm-4 col-6">
                <div class="description-block border-right">
                    <h5 class="description-header">Saldo Impuesto (Q)</h5>
                    <span class="description-text" id="imptIng"><label class="badge bg-info" style="font-size: 13px;">Ing : &nbsp;` + valImpuestoNumb + `</label><br><label class="badge bg-info" style="font-size: 13px;">Ret : &nbsp;` + imptsRetNumb + `</label><br><label class="badge bg-danger" style="font-size: 20px;">Saldo : &nbsp;` + sldImptNumber + `</label></span>
                </div>
            </div>

        </div>
    </div>`;
        }
    }

    document.getElementById("hiddenIdentificador").value = idIngOpDet;
    document.getElementById("hiddeniddeingreso").value = idIngOpDet;
    if ($("#idChasAnt").length > 0) {
        if ($("#idChasAnt").value != idIngOpDet) {
            Swal.fire('Error DA', 'La póliza seleccionada no es igual a la del chasis que decea hacer reversión', 'error');
        }
    }
    var idBod = idBut.attr("iddebodega");
    var empresa = idBut.attr("empresa");
    var poliza = idBut.attr("poliza");
    var idIngSelectDet = $("#buttonDisparoDetalle").attr("idIngSelectDetOpe");
    var servicio = await functionVerServicio(idIngOpDet);
    console.log(servicio);
    if (servicio.respTipo == "vehM" || servicio.respTipo == "vehUs") {
        document.getElementById("hiddenGdVehMerc").value = servicio.respTipo;
        if ($("#hiddenGdVehMerc").length > 0) {
            document.getElementById("hiddenGdVehMerc").value = servicio.respTipo;
        }
        document.getElementById("dataRetiro").innerHTML = "";
        document.getElementById("dataRetiro").innerHTML = '<table id="tablaMerRetiro" class="table table-hover dt-responsive table-sm"></table><input type="hidden" id="hiddenListaDeta" value="">';
        console.log(idIngOpDet);
        var idingopdet = $(this).attr("idingselectdet");
        var datos = new FormData();
        datos.append("idIngOpDet", idIngOpDet);
        $.ajax({
            url: "ajax/retiroOpe.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (respuestaDetIng) {
                console.log(respuestaDetIng);
                if (respuestaDetIng.respTipo == "vehN") {
                    document.getElementById("hiddenTipoRet").value = "vehN";
                    console.log(173);
                } else if (respuestaDetIng.respTipo == "vehM" || servicio.respTipo == "vehUs") {
                    if (servicio.respTipo == "vehUs") {
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


                    }
                    if (respuestaDetIng.data == "sinRet") {
                        Swal.fire('Sin datos', 'La poliza consultada no cuenta con historial de retiros', 'success');
                        document.getElementById("dataRetiro").innerHTML = '<div class="col-12"><div class="alert alert-primary" role="alert">¡Actualmente no cuenta con retiros esta poliza!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div></div>';
                    } else {
                        /*
                         console.log(respuesta);
                         document.getElementById("divSaldos").innerHTML = '<div class="col-4"><small class="text-success mr-1">Bultos Ingreso : &nbsp;&nbsp; ' + respuesta["sumIng"][0].bultos + '</small></div><div class="col-4"><small class="text-success mr-1">Cif Ingreso :&nbsp;&nbsp; ' + respuesta["sumIng"][0].totalValorCif + '</small></div><div class="col-4"><small class="text-success mr-1">Impuestos Ingreso : &nbsp;&nbsp; ' + respuesta["sumIng"][0].calculoValorImpuesto + '</small></div><br/>';
                         document.getElementById("divSaldosRet").innerHTML = '<div class="col-4"><small class="text-primary mr-1">Bultos Retiro : &nbsp;&nbsp; ' + respuesta["sumRet"][0].sumaBultos + '</small></div><div class="col-4"><small class="text-primary mr-1">Cif retiros :&nbsp;&nbsp; ' + respuesta["sumRet"][0].sumaCif + '</small></div><div class="col-4"><small class="text-primary mr-1">Impuestos Retiro : &nbsp;&nbsp; ' + respuesta["sumRet"][0].sumaImpts + '</small></div><br/>';
                         document.getElementById("divSaldoActual").innerHTML = '<div class="col-4"><small class="text-danger mr-1">Bultos Saldo : &nbsp;&nbsp; ' + respuesta["saldos"].sldBultos + '</small></div><div class="col-4"><small class="text-danger mr-1">Cif Saldo :&nbsp;&nbsp; ' + respuesta["saldos"].sldCif + '</small></div><div class="col-4"><small class="text-danger mr-1">Impuestos Saldo : &nbsp;&nbsp; ' + respuesta["saldos"].sldImpuesto + '</small></div><br/>';
                         */
                        console.log(respuestaDetIng.data.resHistorial);
                        listaHistorial = [];
                        for (var i = 0; i < respuestaDetIng.data.resHistorial.length; i++) {
                            var polizaRetiro = respuestaDetIng.data.resHistorial[i].polizaRetiro;
                            var regimen = respuestaDetIng.data.resHistorial[i].regimenSalida;
                            var bultos = respuestaDetIng.data.resHistorial[i].bultos;
                            var valorCif = respuestaDetIng.data.resHistorial[i].totalValorCif;
                            var calculoValorImpuesto = respuestaDetIng.data.resHistorial[i].valorImpuesto;
                            var fechaRetiro = respuestaDetIng.data.resHistorial[i].fechaRetiro;
                            listaHistorial.push([polizaRetiro, fechaRetiro, regimen, bultos, valorCif, calculoValorImpuesto]);
                        }
                        console.log(listaHistorial);
                        $('#tablaMerRetiro').DataTable({
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
                            data: listaHistorial,
                            columns: [{
                                    title: "polizaRetiro"
                                }, {
                                    title: "Fecha de Retiro"
                                }, {
                                    title: "regimen"
                                }, {
                                    title: "bultos"
                                }, {
                                    title: "valorCif"
                                }, {
                                    title: "calculoValorImpuesto"
                                }]
                        });
                    }
                    var hiddenStockIngreso = document.getElementById("hiddenStockIngreso").value;
                    Swal.fire('Historial de retiros', 'Se muestra a continuacion todos los retiros emitidos... saldo del Ingreso ' + hiddenStockIngreso + ' bulto(s)', 'success')
                    var datos = new FormData();
                    datos.append("idBod", idBod);
                    $.ajax({
                        url: "ajax/retiroOpe.ajax.php",
                        method: "POST",
                        data: datos,
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: "json",
                        success: function (respuesta) {
                            console.log(respuesta);
                            var hiddenTipoOP = document.getElementById("hiddenTipoOP").value;
                            if (hiddenTipoOP == "retiro") {
                                /*
                                 document.getElementById("ListaSelect").innerHTML = '<div class="card card-widget widget-user-2">  <div class="widget-user-header bg-warning"><div class="card-tools pull-right">	<button type="button" class="btn bg-dark btn-sm" id="buttonMinius" data-widget="collapse">	<i class="fa fa-minus"></i>	</button>	<button type="button" class="btn bg-dark btn-sm" data-widget="remove">	<i class="fa fa-times"></i>	</button>	</div><h3 class="widget-user-username"><b>Retiro de Mercadería </b><br/> Empresa : ' + empresa + ' <br/>Poliza : ' + poliza + ' </h3>    </div><div class="card-footer p-0">  <ul class="nav flex-column">  <li class="nav-item">  <a id="spanRegOpe" class="nav-link">  </a>  </li>  <li class="nav-item">  <a id="spanRegBod" class="nav-link">  </a>  </li>   <li class="nav-item">  <a id="spanAutorizado" class="nav-link"></a></li><li class="nav-item"><a class="nav-link"><div class="row" id="divSaldos"></div></a></i><li class="nav-item"><a class="nav-link"><div class="row" id="divSaldosRet"></div></a></i><li class="nav-item"><a class="nav-link"><div class="row" id="divSaldoActual"></div></a></i></ul></div>';
                                 var contador = 0;
                                 if (respuesta[0]["estadoOperacion"] == 1) {
                                 document.getElementById("spanRegOpe").innerHTML = 'Registrado Operaciones <span class="float-right badge bg-success"><i class="fa fa-check"></span>';
                                 contador = contador + 1;
                                 } else if (respuesta[0]["estadoOperacion"] !== 1) {
                                 document.getElementById("spanRegOpe").innerHTML = 'Registrado Operaciones <span class="float-right badge bg-danger"><i class="fa fa-close"></span>';
                                 }
                                 if (respuesta[0]["estadoDesUbica"] == 1) {
                                 document.getElementById("spanRegBod").innerHTML = 'Descargado y ubicado Bodega <span class="float-right badge bg-success"><i class="fa fa-check"></span>';
                                 var contador = contador + 1;
                                 } else if (respuesta[0]["estadoDesUbica"] !== 1) {
                                 document.getElementById("spanRegBod").innerHTML = 'Descargado y ubicado Bodega <span class="float-right badge bg-danger"><i class="fa fa-close"></span>';
                                 }
                                 if (contador >= 2) {
                                 document.getElementById("spanAutorizado").innerHTML = 'Autorizado <span class="float-right badge bg-success"><i class="fa fa-check"></i></span>';
                                 } else if (contador <= 1) {
                                 document.getElementById("spanAutorizado").innerHTML = 'Autorizado <span class="float-right badge bg-danger"><i class="fa fa-close"></i></span>';
                                 }*/
                            } else if (hiddenTipoOP == "calculo") {
                                document.getElementById("ListaSelect").innerHTML = '<table id="tablaMostrarEmpresaCalculo" class="table table-hover"></table>';
                                var idIngresoCalculo = document.getElementById("hiddeniddeingreso").value;
                                /*
                                 var datos = new FormData();
                                 datos.append("idIngresoCalculo", idIngresoCalculo);
                                 $.ajax({
                                 url: "ajax/calculoDeAlmacenaje.ajax.php",
                                 method: "POST",
                                 data: datos,
                                 cache: false,
                                 contentType: false,
                                 processData: false,
                                 dataType: "json",
                                 success: function (respuesta) {
                                 console.log(respuesta);
                                 }, error: function (respuesta){
                                 console.log(respuesta);
                                 }
                                 });*/
                            }


                            document.getElementById("tableMostrarEmpresa").innerHTML = "";
                            document.getElementById("tableMostrarEmpresa").innerHTML = '<table id="tablaMostrarEmpresa" class="table dt-responsive table-hover table-sm></table><input type="hidden" id="hiddenListaDeta" value="">';
                            var datos = new FormData();
                            console.log(idIngSelectDet);
                            datos.append("idIngSelectDet", respuesta[0].id);
                            $.ajax({
                                url: "ajax/retiroOpe.ajax.php",
                                method: "POST",
                                data: datos,
                                cache: false,
                                contentType: false,
                                processData: false,
                                dataType: "json",
                                success: function (respuesta) {
                                    console.log(respuesta);
                                    var polizaDRRev = 0;
                                    var revDR = 0;
                                    if ("listaDR" in localStorage) {
                                        var revDR = 1;
                                        var polizaIngSelect = respuesta["respuestaDetalle"][0].numeroPoliza;
                                        var jsonStorageDR = localStorage.getItem("listaDR");
                                        var jsonStorageDR = JSON.parse(jsonStorageDR);
                                        for (var i = 0; i < jsonStorageDR.length; i++) {
                                            if (jsonStorageDR[i].poliza == polizaIngSelect) {
                                                var polizaDRRev = 1;
                                            }
                                        }

                                    }
                                    if (polizaDRRev == 0 && revDR == 0 || polizaDRRev == 1 && revDR == 1) {
                                        lista = [];
                                        for (var i = 0; i < respuesta["respuestaDetalle"].length; i++) {
                                            var polizaIngSelect = respuesta["respuestaDetalle"][i].numeroPoliza;

                                            var empresa = respuesta["respuestaDetalle"][i].empresa;
                                            var descripcion = respuesta["respuestaDetalle"][i].descripcionMercaderia;
                                            var bultos = respuesta["respuestaDetalle"][i].bultos;
                                            var peso = respuesta["respuestaDetalle"][i].peso + ' kg';
                                            var accion = '<div class="input-group input-group-sm"><input type="text" class="form-control" id="textDetalle' + respuesta["respuestaDetalle"][i].identificadorDet + '" value=""/><span class="input-group-append"><button type="button" class="btn btn-info btn-flat btnAceptaDetalle" id="btnAceptarDet' + respuesta["respuestaDetalle"][i].identificadorDet + '" idDetalle=' + respuesta["respuestaDetalle"][i].identificadorDet + '  idIngSelectDet=' + respuesta["respuestaDetalle"][i].identificadorIng + ' idPolIng=' + polizaIngSelect + '>Ok!</button></span></div>';
                                            lista.push([empresa, descripcion, bultos, peso, accion]);
                                        }
                                        if (respuesta["respuestaStock"][0].nombreConsolidado == 0) {
                                            var corte = "Sin ningun recibo emitido";
                                        } else {
                                            var corte = "Ultimo recibo Facturado   " + respuesta["respuestaStock"][0].numCorte;
                                        }
                                        document.getElementById("hiddenStockIngreso").value = respuesta["respuestaStock"][0].stock;
                                        document.getElementById("modalRebajaMercaOpStock").innerHTML = '<h5>' + empresa + '&nbsp;&nbsp;Saldo de poliza : &nbsp;&nbsp;' + respuesta["respuestaStock"][0].stock + '&nbsp;&nbsp; bultos   &nbsp;&nbsp;' + corte + '</h5>';
                                        $('#tablaMostrarEmpresa').DataTable({
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
                                                    title: "Empresa"
                                                }, {
                                                    title: "Descripción"
                                                }, {
                                                    title: "Bultos"
                                                }, {
                                                    title: "Peso"
                                                }, {
                                                    title: "Seleccionar"
                                                }]
                                        });
                                    } else {
                                        Swal.fire({
                                            type: 'error',
                                            title: 'Póliza DA',
                                            text: 'La poliza seleccinada no concide con ninguna del detalle de pólizas DR!',

                                        })
                                    }
                                },
                                error: function (respuesta) {
                                    console.log(respuesta);
                                }
                            });
                        }
                    });
                }
            },
            error: function (respuesta) {
                console.log(respuesta);
            }
        });
    } else {
        document.getElementById("descMercaderia").value = "VEHICULOS NUEVOS";
        $("#descMercaderia").trigger('change');
        document.getElementById("hiddeniddeingreso").value = idIngSelectDet;
        document.getElementById("hiddenIdentificador").value = idIngOpDet;
        console.log(servicio.dataRetiro);
        if (servicio.dataRetiro == "sinRet") {
            Swal.fire('Sin datos', 'La poliza consultada no cuenta con historial de retiros', 'success');
            document.getElementById("dataRetiro").innerHTML = '<div class="col-12"><div class="alert alert-primary" role="alert">¡Actualmente no cuenta con retiros esta poliza!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div></div>';
        }
        document.getElementById("hiddenGdVehMerc").value = servicio.respTipo;
        $("#divPlaca").append().remove();
        $("#divCont").append().remove();
        document.getElementById("tableVeh").innerHTML = '<table id="tableVehNuevos" class="table table-hover dt-responsive table-sm"></table><input type="hidden" id="hiddenListaDeta" value="">';
        listaVehN = [];
        console.log(servicio.data[0].estado);
        for (var i = 0; i < servicio.data.length; i++) {
            if (servicio.data[i].estado == 1) {

                var idChas = servicio.data[i].id;
                var numero = i + 1;
                var chasis = servicio.data[i].chasis;
                var tipoVehiculo = servicio.data[i].tipoVehiculo;
                var linea = servicio.data[i].linea;
                var predio = servicio.data[i].predio;
                var descripcion = servicio.data[i].descripcion;
                if ($("#divVehRegresion").length > 0) {
                    var button = '<button type="button" class="btn btn-outline-primary btn-sm btnRegresionChas" id="btnOrigen' + idChas + '" idChas="' + idChas + '" chasisVehNew="' + chasis + '"><i class="fa fa-close"></i></button>';
                } else {
                    var button = '<button type="button" class="btn btn-outline-danger btn-sm btnSelectChasSal" id="btnOrigen' + idChas + '" idChas="' + idChas + '"><i class="fa fa-close"></i></button>';
                }
                listaVehN.push([numero, chasis, tipoVehiculo, linea, predio, descripcion, button]);
            }
        }
        $('#tableVehNuevos').DataTable({
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
            data: listaVehN,
            columns: [{
                    title: "#"
                }, {
                    title: "Chasis"
                }, {
                    title: "Tipo Veh"
                }, {
                    title: "Linea Veh"
                }, {
                    title: "Predio"
                }, {
                    title: "Descripcion"
                }, {
                    title: "Acciones"
                }]
        });
    }
});


function funcRevSaldosAF(tipoIng) {
    let todoMenus;
    var datos = new FormData();
    datos.append("saldosAF", tipoIng);
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
            todoMenus = respuesta;
        }, error: function (respuesta) {
            console.log(respuesta);
        }
    })
    return todoMenus;
}
$(document).on("click", ".btnGuardarRetiro", async function () {
    if ($("#hiddenDR").length > 0) {
        var estado = document.getElementById("hiddenDR").value;
    }
    var tipoIng = document.getElementById("hiddenGdVehMerc").value;
    var hiddeniddeingreso = document.getElementById("hiddeniddeingreso").value;
    var respSaldos = await funcRevSaldosAF(hiddeniddeingreso);
    console.log(respSaldos);
    var verSaldo = 0;
    if (respSaldos != "SD") {
        if (respSaldos[0].tipo == "AF") {
            var verSaldo = 1;
        }
    }
    var numPolizaRev = $("#polizaRetiro").val();
    var revPoliza = await revPolizasIngreso(numPolizaRev);
    if (revPoliza == "Duplicada" && estado == 0) {
        Swal.fire('Poliza ya existe', 'La poliza declarada actualmente ya se encuentra gestionada en sistema.', 'error');
        $("#polizaRetiro").removeClass("is-valid");
        $("#polizaRetiro").addClass("is-invalid");
    } else {
        var validarForm = await validarFormRet();
        if (validarForm) {
            var estado = 0;
            if (tipoIng == "vehM" || tipoIng == "vehUs") {
                var paragraphsButton = Array.from(document.querySelectorAll("#buttonTrash"));
                listaIdButton = [];
                for (var i = 0; i < paragraphsButton.length; i++) {
                    var estadoDet = 1;
                    var idButton = paragraphsButton[i].attributes.numorigen.textContent;
                    var cantBultos = document.getElementById("texToBultosVal" + idButton).value;
                    console.log(cantBultos);
                    if ($("#textPosEdit" + idButton).length > 0) {
                        var textPosEdit = document.getElementById("textPosEdit" + idButton).value;
                        console.log(textPosEdit);
                        var textPosEdit = document.getElementById("textMtsEdit" + idButton).value;
                        console.log(textPosEdit);
                    }
                    listaIdButton.push({
                        "idDetalles": idButton,
                        "cantBultos": cantBultos,
                        "estadoDet": estadoDet
                    });
                }
                if (listaIdButton.length == 0) {
                    estado = 1;
                } else {
                    estado = 2;
                }
            }
            if (estado > 0 && estado == 1) {
                alert("no selecciono ningun cliente");
            } else if (estado == 0 || estado == 2) {
                var hiddenIdUs = document.getElementById("hiddenIdUs").value;
                var hiddenIdBod = document.getElementById("hiddenIdBod").value;
                if (hiddeniddeingreso !== "" || hiddenIdUs !== "") {
                    var idNit = $("#txtNitSalida").attr("dataRetiro");
                    var cantBultos = document.getElementById("cantBultos").value;
                    var polizaRetiro = document.getElementById("polizaRetiro").value;
                    var regimen = document.getElementById("regimen").value;
                    var tipoCambio = document.getElementById("cambio").value;
                    var valorTotalAduana = document.getElementById("valorTAduana").value;
                    var valorCif = document.getElementById("valorCif").value;
                    var calculoValorImpuesto = document.getElementById("calculoValorImpuesto").value;
                    var pesoKg = document.getElementById("pesoKg").value;
                    var descMercaderia = document.getElementById("descMercaderia").value;
                    if (tipoIng == "vehM" || tipoIng == "vehUs") {
                        console.log("521");
                        if (tipoIng == "vehUs") {
                            var placa = "";
                            var contenedor = "";
                        } else {

                            var placa = document.getElementById("numeroPlaca").value;
                            var contenedor = document.getElementById("contenedor").value;
                        }
                        $("#arrayListDetalle").val(JSON.stringify(listaIdButton));
                        var listaDetalles = document.getElementById("arrayListDetalle").value;
                        var totalBultos = 0;
                        for (var i = 0; i < listaIdButton.length; i++) {
                            var bultos = listaIdButton[i].cantBultos * 1;
                            var totalBultos = bultos + totalBultos;
                        }
                    } else {
                        listaVehiculos = [];
                        var paragraphsButton = Array.from(document.querySelectorAll("#buttonTrashVeh"));
                        for (var i = 0; i < paragraphsButton.length; i++) {
                            var numOrigen = paragraphsButton[i].attributes.numorigen.value;
                            listaVehiculos.push([numOrigen]);
                            var totalBultos = i + 1;
                            console.log(numOrigen);
                        }
                        var listaVehiculos = JSON.stringify(listaVehiculos);
                    }
                    if (tipoIng == "vehUs") {
                        var licencia = "";
                        var piloto = "";
                        var hiddenIdentificador = "";
                        var hiddenDateTime = document.getElementById("hiddenDateTime").value;
                    } else {
                        var licencia = document.getElementById("numeroLicencia").value;
                        var piloto = document.getElementById("nombrePiloto").value;
                        var hiddenIdentificador = document.getElementById("hiddenIdentificador").value;
                        var hiddenDateTime = document.getElementById("hiddenDateTime").value;
                    }

                    var bltsSaldo = 3;
                    var condicion = 3;
                    if (verSaldo == 0) {
                        var bltsSaldo = 0;
                        var condicion = 0;
                    }

                    if (verSaldo == 1) {
                        var bultsResp = totalBultos * 1;
                        var bultsResp = parseInt(totalBultos);
                        var parseBlts = respSaldos[0].saldoBultos * 1;
                        var parseBlts = parseInt(parseBlts);
                        var bultsRespSld = (parseBlts - bultsResp);
                        console.log(bultsRespSld);

                        var respSaldImpt = respSaldos[0].saldoValorImpuesto * 1;
                        var respSaldImpt = parseFloat(respSaldImpt).toFixed(2);
                        var calculoValorImpuesto = calculoValorImpuesto * 1;
                        var calculoValorImpuesto = parseFloat(calculoValorImpuesto).toFixed(2);
                        var respSaldImptSld = (respSaldImpt - calculoValorImpuesto);

                        var respSaldCif = respSaldos[0].saldoValorCif * 1;
                        var respSaldCif = parseFloat(respSaldCif).toFixed(2);
                        var valorCif = valorCif * 1;
                        var valorCif = parseFloat(valorCif).toFixed(2);
                        var respSaldCifSld = (respSaldCif - valorCif);
                        //condicion si se liquida
                        if (respSaldos[0].saldoBultos == bultsResp) {
                            var bltsSaldo = 1;
                            if (respSaldCifSld == 0 || respSaldImptSld == 0) {
                                var condicion = 1;
                            }
                        } else {
                            if (bultsRespSld > 0 && respSaldCifSld > 0 && respSaldImptSld > 0) {
                                var bltsSaldo = 2;
                                var condicion = 2;
                            }
                        }
                    }
                    console.log(bltsSaldo);
                    console.log(condicion);
                    if (verSaldo == 0 || verSaldo == 1) {
                        if (bltsSaldo == 0 && condicion == 0 || bltsSaldo == 1 && condicion == 1 || bltsSaldo == 2 && condicion == 2) {
                            if (totalBultos == cantBultos) {
                                if (tipoIng == "vehM" || tipoIng == "vehUs") {
                                    var jsonStringDR = "SD";
                                    var valDR = 0;
                                    if ("listaDR" in localStorage) {
                                        var valDR = 1;
                                        var revDR = 1;
                                        var bltsSumFinal = 0;
                                        var jsonStorageDR = localStorage.getItem("listaDR");
                                        var jsonStorageDR = JSON.parse(jsonStorageDR);
                                        for (var i = 0; i < jsonStorageDR.length; i++) {
                                            var bltsSumFinal = bltsSumFinal + jsonStorageDR[i].bltsSumFinal;
                                        }
                                        var jsonStringDR = JSON.stringify(jsonStorageDR);
                                    }
                                    if (bltsSumFinal == totalBultos || valDR == 0) {

                                        console.log(jsonStringDR);
                                        var guardarRetMerca = await guardarRetiroMercaderia(
                                                listaDetalles, hiddeniddeingreso, hiddenIdUs, idNit, polizaRetiro, regimen, tipoCambio,
                                                valorTotalAduana, valorCif, calculoValorImpuesto, pesoKg, placa, contenedor, licencia, piloto,
                                                hiddenIdBod, cantBultos, hiddenIdentificador, hiddenDateTime, descMercaderia, tipoIng, jsonStringDR);
                                    } else {
                                        Swal.fire(
                                                'Bultos póliza DR?',
                                                'La cantidadde bultos del detalle póliza DR, no coincide con la cantidad de bultos total',
                                                'error'
                                                )
                                    }
                                } else {
                                    var guardaRetVeh = await guardarRetVehehiculos(
                                            hiddeniddeingreso, hiddenIdUs, idNit, polizaRetiro, regimen, tipoCambio, valorTotalAduana,
                                            valorCif, calculoValorImpuesto, pesoKg, licencia, piloto, hiddenIdBod, cantBultos, hiddenIdentificador,
                                            hiddenDateTime, listaVehiculos, descMercaderia,
                                            );
                                    if (guardaRetVeh["tipoResp"]) {
                                        Swal.fire('Retiro', 'Guardado éxitosamente', 'success');
                                        document.getElementById("divBottoneraAccion").innerHTML = `
         <div class="btn-group">
         <button type="button" class="btn btn-warning btn-block btnEditarRetiroVeh" idRet=${guardaRetVeh["idRet"]} id="editRetiroFVeh" estado=0 >Editar&nbsp;&nbsp;&nbsp;<i class="fa fa-edit" style="font-size:20px" aria-hidden="true"></i></button>
         </div>`;
                                    } else {
                                        Swal.fire('Retiro', 'No se guardo correctamente', 'error');
                                    }
                                }
                            } else {
                                Swal.fire('Diferencia bultos', 'En el formulario declaro ' + cantBultos + ' bultos y en detalles ud declaro ' + totalBultos + ' bultos.', 'error');
                            }
                        } else {
                            if (respSaldos[0].saldoBultos == bultsResp) {
                                Swal.fire({
                                    title: 'Diferencia de saldos',
                                    text: "Por ser ultimo retiro parcial, puede aplicar los valores del sistema si lo desea, sino revise los saldos rebajados!",
                                    type: 'info',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Si, Aplicar Val. Sistema!'
                                }).then((result) => {
                                    if (result.value) {
                                        var dol = respSaldos[0].saldoValorTAduana;
                                        var dol = parseFloat(dol).toFixed(2);
                                        var dol = dol * 1;
                                        var cif = respSaldos[0].saldoValorCif;
                                        var cif = parseFloat(cif).toFixed(2);
                                        var cif = cif * 1;
                                        var cambio = (cif / dol);
                                        var cambio = parseFloat(cambio).toFixed(4);
                                        var cambio = cambio * 1;
                                        var impuesto = respSaldos[0].saldoValorImpuesto;
                                        var impuesto = parseFloat(impuesto).toFixed(2);
                                        var impuesto = impuesto * 1;
                                        document.getElementById("cambio").value = 1;
                                        document.getElementById("valorTAduana").value = cif;
                                        document.getElementById("valorCif").value = cif;
                                        document.getElementById("calculoValorImpuesto").value = impuesto;
                                        $("#cambio").trigger('change');
                                        $("#valorTAduana").trigger('change');
                                        $("#valorCif").trigger('change');
                                        $("#calculoValorImpuesto").trigger('change');
                                        Swal.fire(
                                                'Aplicados!',
                                                'Los valores del sistema fueron aplicados en el ultimo retiro fiscal',
                                                'success'
                                                )
                                    }
                                })
                            } else {
                                console.log(bltsSaldo);
                                console.log(condicion);
                                Swal.fire('Diferencias saldos', 'Ultimo retiro almacen fiscal, no cuadra con valores del sistema ', 'error');
                            }

                        }
                    }
                } else {
                    Swal.fire('Error de formulario', 'El formulario declarado es incorrecto revise', 'error');
                }
            }
        }
    }/*else{
     
     }*/
});


function guardarRetVehehiculos(hiddeniddeingreso, hiddenIdUs, idNit, polizaRetiro, regimen, tipoCambio, valorTotalAduana,
        valorCif, calculoValorImpuesto, pesoKg, licencia, piloto, hiddenIdBod, cantBultos, hiddenIdentificador,
        hiddenDateTime, listaVehiculos, descMercaderia
        ) {
    let guardarRetV;
    console.log(listaVehiculos);
    var datos = new FormData();
    datos.append("hiddeniddeingresoVeh", hiddeniddeingreso);
    datos.append("hiddenIdUsVeh", hiddenIdUs);
    datos.append("idNitVeh", idNit);
    datos.append("polizaRetiroVeh", polizaRetiro);
    datos.append("regimenVeh", regimen);
    datos.append("tipoCambioVeh", tipoCambio);
    datos.append("valorTotalAduanaVeh", valorTotalAduana);
    datos.append("valorCifVeh", valorCif);
    datos.append("calculoValorImpuestoVeh", calculoValorImpuesto);
    datos.append("pesoKgVeh", pesoKg);
    datos.append("licenciaVeh", licencia);
    datos.append("pilotoVeh", piloto);
    datos.append("hiddenIdBodVeh", hiddenIdBod);
    datos.append("cantBultosVeh", cantBultos);
    datos.append("hiddenIdentificadorVeh", hiddenIdentificador);
    datos.append("hiddenDateTimeVeh", hiddenDateTime);
    datos.append("listaVehiculos", listaVehiculos);
    datos.append("descMercaderiaVeh", descMercaderia);
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
            guardarRetV = respuesta;
        }, error: function (respuesta) {
            console.log(respuesta);
        }
    })
    return guardarRetV;
}


function guardarRetiroMercaderia(
        listaDetalles, hiddeniddeingreso, hiddenIdUs, idNit, polizaRetiro, regimen, tipoCambio,
        valorTotalAduana, valorCif, calculoValorImpuesto, pesoKg, placa, contenedor, licencia, piloto,
        hiddenIdBod, cantBultos, hiddenIdentificador, hiddenDateTime, descMercaderia, tipoIng, jsonStringDR) {
    let respuestaFun;

    var datos = new FormData();
    datos.append("listaDetalles", listaDetalles);
    datos.append("hiddeniddeingreso", hiddeniddeingreso);
    datos.append("hiddenIdUs", hiddenIdUs);
    datos.append("idNit", idNit);
    datos.append("polizaRetiro", polizaRetiro);
    datos.append("regimen", regimen);
    datos.append("tipoCambio", tipoCambio);
    datos.append("valorTotalAduana", valorTotalAduana);
    datos.append("valorCif", valorCif);
    datos.append("calculoValorImpuesto", calculoValorImpuesto);
    datos.append("pesoKg", pesoKg);
    datos.append("placa", placa);
    datos.append("contenedor", contenedor);
    datos.append("descMercaderia", descMercaderia);
    datos.append("licencia", licencia);
    datos.append("piloto", piloto);
    datos.append("hiddenIdBod", hiddenIdBod);
    datos.append("cantBultos", cantBultos);
    datos.append("hiddenIdentificador", hiddenIdentificador);
    datos.append("hiddenDateTime", hiddenDateTime);
    datos.append("tipoIng", tipoIng);
    datos.append("jsonStringDR", jsonStringDR);

    console.log(tipoIng);
    $.ajax({
        url: "ajax/retiroOpe.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            if (respuesta.exito == "exito") {
                var tipo = 0;
                desbloqueBloque(tipo);
                Swal.fire('Guardado exitosamente', 'El retiro fue guardado con exito', 'success');
                document.getElementById("divBottoneraAccion").innerHTML = `
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-warning btnEditarRetiro" id="editRetiroF" estado=0 idRetiroBtn= ` + respuesta["valIdRetiro"] + `>Editar&nbsp;&nbsp;&nbsp;<i class="fa fa-edit" style="font-size:20px" aria-hidden="true"></i></button>
             <button type="button" class="btn btn-info btnMasPilotos" id="idbtnMasPilotos" estado=0 idMasPilotos= ` + respuesta["valIdRetiro"] + `  data-toggle="modal" data-target="#plusPilotos">Nueva Unidad&nbsp;&nbsp;&nbsp;<i class="fa fa-plus" style="font-size:20px" aria-hidden="true"></i></button>

         </div>`;
            } else {
                Swal.fire(
                        'Error Interno!',
                        'La transaccion no se finalizo',
                        'success'
                        )
            }
        },
        error: function (respuesta) {
            console.log(respuesta);
        }
    });
    return respuestaFun;
}

$(document).on("click", ".btnAceptaDetalle", function () {
    var estadoDetalles = $("#editRetiroF").attr("estadodetalles");
    var idIngOpDet = $(this).attr("idIngSelectdet");
    var idPoling = $(this).attr("idpoling");
    var idDetalle = $(this).attr("idDetalle");
    var valTextDet = document.getElementById("textDetalle" + idDetalle).value;
    var btnDR = 0;
    var polizaDRRev = 0;
    var revDR = 0;
    if ("listaDR" in localStorage) {
        var revDR = 1;
        var polizaIngSelect = idPoling;
        var jsonStorageDR = localStorage.getItem("listaDR");
        var jsonStorageDR = JSON.parse(jsonStorageDR);
        for (var i = 0; i < jsonStorageDR.length; i++) {
            if (jsonStorageDR[i].poliza == polizaIngSelect) {
                if (jsonStorageDR[i].bltsSumFinal == valTextDet) {
                    var polizaDRRev = 1;
                    var btnDR = 1;
                }
            }
        }
    }
    if (polizaDRRev == 0 && revDR == 0 || polizaDRRev == 1 && revDR == 1) {

        var datos = new FormData();
        datos.append("textoValDet", valTextDet);
        datos.append("idOpDetTraer", idDetalle);
        $.ajax({
            url: "ajax/retiroOpe.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (respuesta) {
                console.log(respuesta);
                if (respuesta == "SinSaldo") {
                    alert("no existe saldo del dato");
                } else if (respuesta == "Denegado") {
                    alert("su operacion sobregira el stock");
                } else if (respuesta != "Denegado") {

                    if (isNaN(valTextDet) || valTextDet == "") {
                        Swal.fire('Error cantidad de bultos', 'Para seleccionar tiene que especificar la cantidad de bultos, no puede dejar vacio el campo', 'error')
                    } else {

                        if (document.getElementById("hiddenGdVehMerc").value == "vehUs") {
                            document.getElementById("descMercaderia").value = 'VEHICULO USADO  ' + respuesta[0].empresa;
                            $("#descMercaderia").removeClass("is-invalid");
                            $("#descMercaderia").addClass("is-valid");
                        }
                        if (btnDR == 0) {
                            var buttonDR = ``;

                        } else {
                            var buttonDR = `<button type="button" class="btn btn-primary" id="buttonStock">` + respuesta[0].stock + `</button>`;

                        }
                        document.getElementById("btnAceptarDet" + idDetalle).disabled = true;
                        document.getElementById("textDetalle" + idDetalle).readOnly = true;
                        if (estadoDetalles > 0) {
                            document.getElementById("divListaDetalles").innerHTML += `
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <button type="button" class="btn btn-danger" id="buttonTrash" numOrigen=` + idDetalle + `><i class="fa fa-trash"></i></button>
                        ` + buttonDR + `
                        <button type="button" class="btn btn-warning btnPolUbica" idDet=` + idDetalle + ` estado=0>Pól. ` + idPoling + `</button>                    
                      </div>
                      <!-- /btn-group -->
                      <input type="text" class="form-control" id="texToEmpresaVal" value="` + respuesta[0].empresa + `" readOnly="readOnly" />
                      <input type="number" class="form-control" id="texToBultosVal` + idDetalle + `" value="` + valTextDet + `">
                      <input type="number" class="form-control" id="textPosEdit` + idDetalle + `" value="" placeholder="Posiciones">
                      <input type="number" class="form-control" id="textMtsEdit` + idDetalle + `" value="" placeholder="Metros">
                    </div>`;
                        } else {
                            document.getElementById("divListaDetalles").innerHTML += `<div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <button type="button" class="btn btn-danger" id="buttonTrash" numOrigen=` + idDetalle + `><i class="fa fa-trash"></i></button>
                        ` + buttonDR + `
                        <button type="button" class="btn btn-warning btnPolUbica" idDet=` + idDetalle + ` estado=0>Pól. ` + idPoling + `</button>                    
                      </div>
                      <!-- /btn-group -->
                      <input type="text" class="form-control" id="texToEmpresaVal" value="` + respuesta[0].empresa + `" readOnly="readOnly" />
                      <input type="number" class="form-control" id="texToBultosVal` + idDetalle + `" value="` + valTextDet + `" />
                    </div>`;
                        }
                    }
                }
            },
            error: function (respuesta) {
                console.log(respuesta);
            }
        });
    } else {
        Swal.fire(
                'Diferencia de bultos?',
                'La cantidad de bultos de la poliza no es igual al declarado en el detalle de póliza DR!',
                'error'
                )
    }
});
/*
 $(document).on("change", "#cantBultos", function () {
 var idIngresoCantBultos = document.getElementById("hiddeniddeingreso").value;
 var cantBultosVal = document.getElementById("cantBultos").value;
 if (idIngresoCantBultos == "") {
 Swal.fire('Selección vacia', 'No há seleccionado una poliza de ingreso, seleccione la da porfavor', 'error')
 
 } else if (idIngresoCantBultos !== "") {
 
 
 var datos = new FormData();
 datos.append("cantBultosVal", cantBultosVal);
 datos.append("idIngresoCantBultos", idIngresoCantBultos);
 $.ajax({
 url: "ajax/retiroOpe.ajax.php",
 method: "POST",
 data: datos,
 cache: false,
 contentType: false,
 processData: false,
 dataType: "json",
 success: function (respuesta) {
 console.log(respuesta);
 if (respuesta == "ok") {
 toastr.options = {
 "closeButton": false,
 "debug": false,
 "newestOnTop": false,
 "progressBar": false,
 "positionClass": "toast-top-right",
 "preventDuplicates": false,
 "onclick": null,
 "showDuration": "300",
 "hideDuration": "1000",
 "timeOut": "5000",
 "extendedTimeOut": "1000",
 "showEasing": "swing",
 "hideEasing": "linear",
 "showMethod": "fadeIn",
 "hideMethod": "fadeOut"
 }
 Command: toastr["success"]("¡ Bultos ingresados  : " + cantBultosVal + '!');
 } else if ("SobreGiro") {
 document.getElementById("cantBultos").focus();
 document.getElementById("cantBultos").value = "";
 Swal.fire('Excedente Bultos', 'Los bultos ingresados, sobregiran el stock revise bien el numero de bultos ingresado, revise retiros anteriores.', 'error')
 
 }
 }, error: function (respuesta) {
 console.log(respuesta);
 }
 });
 }
 });
 */
$(document).on("change", "#contenedor", async function () {
    var cartaDeCupo = $(this).val();
    console.log(cartaDeCupo);
    if (cartaDeCupo == 0) {
        $(this).removeClass("is-valid");
        $(this).addClass("is-invalid");
    } else {
        console.log(cartaDeCupo.length);
        var cartaDeCupoVal = await patternPregSinG(cartaDeCupo);
        console.log(cartaDeCupoVal);
        if (cartaDeCupoVal == 0) {
            $(this).removeClass("is-valid");
            $(this).addClass("is-invalid");
        } else if (cartaDeCupoVal == 1) {
            $(this).removeClass("is-invalid");
            $(this).addClass("is-valid");
        } else {
            $(this).removeClass("is-valid");
            $(this).addClass("is-invalid");
        }
    }
})



async function validarFormRet() {
    /*------------------------------------------------------------------/
     *  FUNCION EVALUANDO DATOS REGISTRADOS POR EL USUARIO...           |
     *                                                                  |
     *-----------------------------------------------------------------*/

    var valNit = document.getElementById("txtNitSalida").value;
    var txtNombreSalida = document.getElementById("txtNombreSalida").value;
    var txtDireccionSalida = document.getElementById("txtDireccionSalida").value;
    if (valNit == "" || valNit == 0 || txtNombreSalida == "" || txtNombreSalida == 0 || txtDireccionSalida == "" || txtDireccionSalida == 0) {
        $("#txtNitSalida").removeClass("is-valid");
        $("#txtNitSalida").addClass("is-invalid");
        $("#txtNombreSalida").removeClass("is-valid");
        $("#txtNombreSalida").addClass("is-invalid");
        $("#txtDireccionSalida").removeClass("is-valid");
        $("#txtDireccionSalida").addClass("is-invalid");
        $("#txtNombreSalida").removeClass("is-valid");
        $("#txtNombreSalida").addClass("is-invalid");
        $("#txtDireccionSalida").removeClass("is-valid");
        $("#txtDireccionSalida").addClass("is-invalid");
        return false;
    } else {
        var polizaRetiro = document.getElementById("polizaRetiro").value;
        var polizaRetiro = await patternPregSinG(polizaRetiro);
        if (polizaRetiro == 0) {
            invalidar("polizaRetiro");
            return false;
        }
        var regimen = document.getElementById("regimen").value;
        var regimen = await patternPregSinG(regimen);
        if (regimen == 0) {
            invalidar("regimen");
            return false;
        }
        var valorTAduana = document.getElementById("valorTAduana").value;
        if (valorTAduana > 0) {
            var valorTAduanaAwait = await patternPregNum(valorTAduana);
            if (valorTAduanaAwait == 0) {
                invalidar("valorTAduana");
                return false;
            }
        } else {
            invalidar("valorTAduana");
            return false;
        }
        var cambio = document.getElementById("cambio").value;
        var cambio = Number.parseFloat(cambio).toFixed(5);
        var cambio = cambio * 1;
        if (cambio > 0) {
            var cambioAwait = await patternPregNum(cambio);
            console.log(cambioAwait);
            if (cambioAwait == 0) {
                invalidar("cambio");
                return false;
            }
        } else {
            invalidar("cambio");
            return false;
        }
        var valorCif = document.getElementById("valorCif").value;
        if (valorCif > 0) {
            var valorCifAwait = await patternPregNum(valorCif);
            if (valorCifAwait == 0) {
                invalidar("valorCif");
                return false;
            }
        } else {
            invalidar("valorCif");
            return false;
        }
        var calculoValorImpuesto = document.getElementById("calculoValorImpuesto").value;
        if (calculoValorImpuesto > 0) {
            var calculoValorImpuestoAwait = await patternPregNum(valorCif);
            if (calculoValorImpuestoAwait == 0) {
                invalidar("calculoValorImpuesto");
                return false;
            }
        } else {
            invalidar("calculoValorImpuesto");
            return false;
        }
        var pesoKg = document.getElementById("pesoKg").value;
        if (pesoKg > 0) {
            var pesoKgAwait = await patternPregNum(pesoKg);
            if (pesoKgAwait == 0) {
                invalidar("pesoKg");
                return false;
            }
        } else {
            invalidar("pesoKg");
            return false;
        }
        var cantBultos = document.getElementById("cantBultos").value;
        if (cantBultos > 0) {
            var cantBultosAwait = await patternPregNumEntero(cantBultos);
            if (cantBultosAwait == 0) {
                invalidar("cantBultos");
                return false;
            }
        } else {
            invalidar("cantBultos");
            return false;
        }
        var descMercaderia = document.getElementById("descMercaderia").value;
        if (descMercaderia == "" || descMercaderia == " " || descMercaderia == 0) {
            return false;
        } else {
            var descMercaderiaAwait = await patternPregSpaceSGProducto(descMercaderia);
            if (descMercaderiaAwait == 0) {
                invalidar("descMercaderia");
                return false;
            }
        }

        if ($("#numeroPlaca").length > 0) {
            var numeroPlaca = document.getElementById("numeroPlaca").value;
            if (numeroPlaca == "" || numeroPlaca == 0 || numeroPlaca == " ") {
                invalidar("numeroPlaca");
                return false;
            } else {
                var numeroPlacaAwait = await patternPregSinG(numeroPlaca);
                if (numeroPlacaAwait == 0) {
                    invalidar("numeroPlaca");
                    return false;
                }
            }

        }
        if ($("#contenedor").length > 0) {
            var contenedor = document.getElementById("contenedor").value;
            if (contenedor == "" || contenedor == 0 || contenedor == " ") {
                invalidar("contenedor");
                return false;
            } else {
                var contenedorAwait = await patternPregSinG(contenedor);
                if (contenedorAwait == 0) {
                    invalidar("contenedor");
                    return false;
                }
            }
        }


        return true;
    }
}

function invalidar(nombreId) {
    $("#" + nombreId).removeClass("is-valid");
    $("#" + nombreId).addClass("is-invalid");
}


function desbloquear() {
    let desbloqueo;
    document.getElementById("textParamBusqRet").readOnly = false;
    document.getElementById("txtNitSalida").readOnly = false;
    document.getElementById("txtNombreSalida").readOnly = false;
    document.getElementById("txtDireccionSalida").readOnly = false;
    document.getElementById("polizaRetiro").readOnly = false;
    document.getElementById("regimen").readOnly = false;
    document.getElementById("valorTAduana").readOnly = false;
    document.getElementById("cambio").readOnly = false;
    document.getElementById("valorCif").readOnly = false;
    document.getElementById("calculoValorImpuesto").readOnly = false;
    document.getElementById("pesoKg").readOnly = false;
    document.getElementById("cantBultos").readOnly = false;
    document.getElementById("descMercaderia").readOnly = false;

    if ($("#numeroLicencia").length > 0) {
        document.getElementById("numeroLicencia").readOnly = false;
    }
    if ($("#nombrePiloto").length > 0) {
        document.getElementById("nombrePiloto").readOnly = false;
    }


    if ($("#numeroPlaca").length > 0) {
        document.getElementById("numeroPlaca").readOnly = false;
    }
    if ($("#contenedor").length > 0) {
        document.getElementById("contenedor").readOnly = false;
    }

    desbloqueo = "Ok";
    return desbloqueo;
}

$(document).on("click", "#editRetiroF", async function () {
    var idRetiroBtn = $(this).attr("idRetiroBtn");
    console.log(idRetiroBtn);
    var estado = $(this).attr("estado");
    if (estado == 0) {
        var esperaDesbloqueo = await desbloquear();
        if (esperaDesbloqueo == "Ok") {
            $(this).removeClass("btn btn-warning");
            $(this).addClass("btn btn-success");
            $(this).html('Guardar Edición <i class="fa fa-save"></i>');
            $(this).attr("estado", 1);
        }
    } else if (estado == 1) {
        $(this).removeClass("btn btn-success");
        $(this).addClass("btn btn-warning");
        $(this).html('Editar Retiro <i class="fa fa-edit"></i>');
        $(this).attr("estado", 0);
        var validarForm = await validarFormRet();
        if (validarForm) {
            var tipoEdicion = "Merca";
            var dataEdit = await editarRetiroOpFis(idRetiroBtn);
            console.log(dataEdit);
        }
    }
})

async function editarRetiroOpFis(idRetiroBtn) {
    let todoMenus;
    var estadodetalles = $("#editRetiroF").attr("estadodetalles");

    var tipoIng = document.getElementById("hiddenGdVehMerc").value;
    if (tipoIng == "vehM" || tipoIng == "vehUs") {


        var paragraphsButton = Array.from(document.querySelectorAll("#buttonTrash"));
        console.log(paragraphsButton);

        listaIdButton = [];
        for (var i = 0; i < paragraphsButton.length; i++) {

            var idButton = paragraphsButton[i].attributes.numorigen.textContent;
            console.log(idButton);

            var idButton = paragraphsButton[i].attributes.numorigen.textContent;
            var idButton = Number.parseInt(idButton);

            var cantBultos = document.getElementById("texToBultosVal" + idButton).value;

            var textPosEdit = document.getElementById("textPosEdit" + idButton).value;

            var textMtsEdit = document.getElementById("textMtsEdit" + idButton).value;

            if (estadodetalles == 0) {
                listaIdButton.push({
                    "idDetalles": idButton,
                    "cantBultos": cantBultos,
                    "estadoDet": 1,
                    "tipoDet": estadodetalles
                });
            }
            if (estadodetalles > 0) {
                listaIdButton.push({
                    "idDetalles": idButton,
                    "cantBultos": cantBultos,
                    "valPosSalidaEdit": textPosEdit,
                    "valMtsSalidaEdit": textMtsEdit,
                    "estadoDet": 2,
                    "tipoDet": estadodetalles
                });
            }


            if (estadodetalles > 0) {
                if (textPosEdit == "" || textMtsEdit == "") {
                    Swal.fire(
                            'Error!',
                            'Las posiciones y metros del detalle no son validos, si no rebajará posiciones y ubicaciones coloque cero en los campos solicitados!',
                            'error'
                            )
                    return false;

                }
                if (textPosEdit == 0 || textMtsEdit == 0) {
                    Swal.fire(
                            'Guardar Nuevo Detalle!',
                            'Esta seguro quiere guardar este detalle!',
                            'info'
                            )
                }
            }


        }
        if (listaIdButton.length == 0) {
            alert("no selecciono ningun cliente");
        } else if (listaIdButton.length > 0) {
            console.log("estoy cerca");
            $("#arrayListDetalle").val(JSON.stringify(listaIdButton));
            var listaDetalles = document.getElementById("arrayListDetalle").value;
            console.log(listaDetalles);
            var totalBultos = 0;
            for (var i = 0; i < listaIdButton.length; i++) {
                var bultos = listaIdButton[i].cantBultos * 1;
                var totalBultos = bultos + totalBultos;
            }
        }
    } else {
        listaVehiculos = [];
        var paragraphsButton = Array.from(document.querySelectorAll("#buttonTrashVeh"));
        for (var i = 0; i < paragraphsButton.length; i++) {
            var numOrigen = paragraphsButton[i].attributes.numorigen.value;
            listaVehiculos.push([numOrigen]);
            var totalBultos = i + 1;
            console.log(numOrigen);
        }
        var listaVehiculos = JSON.stringify(listaVehiculos);
    }



    var hiddeniddeingreso = document.getElementById("hiddeniddeingreso").value;
    var hiddenIdUs = document.getElementById("hiddenIdUs").value;
    var hiddenIdBod = document.getElementById("hiddenIdBod").value;
    if (hiddeniddeingreso !== "" || hiddenIdUs !== "") {
        var idNit = $("#txtNitSalida").attr("dataRetiro");
        var cantBultos = document.getElementById("cantBultos").value;
        var polizaRetiro = document.getElementById("polizaRetiro").value;
        var regimen = document.getElementById("regimen").value;
        var tipoCambio = document.getElementById("cambio").value;
        var valorTotalAduana = document.getElementById("valorTAduana").value;
        var valorCif = document.getElementById("valorCif").value;
        var calculoValorImpuesto = document.getElementById("calculoValorImpuesto").value;
        var pesoKg = document.getElementById("pesoKg").value;
        var descMercaderia = document.getElementById("descMercaderia").value;
        if ($("#numeroPlaca").length > 0) {
            var placa = document.getElementById("numeroPlaca").value;
        }
        if ($("#contenedor").length > 0) {
            var contenedor = document.getElementById("contenedor").value;
        }
        var licencia = 0;
        var piloto = 0;

        if ($("#numeroLicencia").length > 0) {
            var licencia = document.getElementById("numeroLicencia").value;
        }
        if ($("#nombrePiloto").length > 0) {
            var piloto = document.getElementById("nombrePiloto").value;
        }



        var hiddenIdentificador = document.getElementById("hiddenIdentificador").value;
        var hiddenDateTime = document.getElementById("hiddenDateTime").value;

        if (totalBultos == cantBultos) {
            if (tipoIng == "vehM" || tipoIng == "vehUs") {
                var respuestaEdita = await funcEditRetMerca(idRetiroBtn, listaDetalles, hiddeniddeingreso, hiddenIdUs, idNit, polizaRetiro,
                        regimen, tipoCambio, valorTotalAduana, valorCif, calculoValorImpuesto, pesoKg, placa, contenedor, descMercaderia,
                        licencia, piloto, hiddenIdBod, cantBultos, hiddenIdentificador, hiddenDateTime);
            } else {
                var EditarVeh = await funcEditarVeh(
                        listaVehiculos, hiddeniddeingreso, hiddenIdUs, idNit, polizaRetiro, regimen, tipoCambio,
                        valorTotalAduana, valorCif, calculoValorImpuesto, pesoKg, licencia, piloto,
                        hiddenIdBod, cantBultos, hiddenIdentificador, hiddenDateTime, descMercaderia);
                console.log(EditarVeh);
            }

        } else {
            Swal.fire('Diferencia bultos', 'En el formulario declaro ' + cantBultos + ' bultos y en detalles ud declaro ' + totalBultos + ' bultos.', 'error');
        }

    }

    return todoMenus;
}

function funcEditRetMerca(idRetiroBtn, listaDetalles, hiddeniddeingreso, hiddenIdUs, idNit, polizaRetiro,
        regimen, tipoCambio, valorTotalAduana, valorCif, calculoValorImpuesto, pesoKg, placa, contenedor, descMercaderia,
        licencia, piloto, hiddenIdBod, cantBultos, hiddenIdentificador, hiddenDateTime) {
    var datos = new FormData();
    datos.append("idRetiroBtn", idRetiroBtn);
    datos.append("listaDetallesEdit", listaDetalles);
    datos.append("hiddeniddeingresoEdit", hiddeniddeingreso);
    datos.append("hiddenIdUsEdit", hiddenIdUs);
    datos.append("idNitEdit", idNit);
    datos.append("polizaRetiroEdit", polizaRetiro);
    datos.append("regimenEdit", regimen);
    datos.append("tipoCambioEdit", tipoCambio);
    datos.append("valorTotalAduanaEdit", valorTotalAduana);
    datos.append("valorCifEdit", valorCif);
    datos.append("calculoValorImpuestoEdit", calculoValorImpuesto);
    datos.append("pesoKgEdit", pesoKg);
    datos.append("placaEdit", placa);
    datos.append("contenedorEdit", contenedor);
    datos.append("descMercaderiaEdit", descMercaderia);
    datos.append("licenciaEdit", licencia);
    datos.append("pilotoEdit", piloto);
    datos.append("hiddenIdBodEdit", hiddenIdBod);
    datos.append("cantBultosEdit", cantBultos);
    datos.append("hiddenIdentificadorEdit", hiddenIdentificador);
    datos.append("hiddenDateTimeEdit", hiddenDateTime);
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
            if (respuesta == "Editado") {
                Swal.fire('Edicion Éxitosa', 'La edicion se hizo de manera correcta', 'success');
                var tipo = 1;
                desbloqueBloque(tipo);
            } else if (respuesta == "sobregiro") {
                Swal.fire('Sobre giro', 'La operacion Sobregira, el inventario', 'error');
            } else {
                Swal.fire('Error de formulario', 'El formulario declarado es incorrecto revise', 'error');
            }
        },
        error: function (respuesta) {
            console.log(respuesta);
        }
    });
}

function funcEditarVeh(listaVehiculos, hiddeniddeingreso, hiddenIdUs, idNit, polizaRetiro, regimen, tipoCambio,
        valorTotalAduana, valorCif, calculoValorImpuesto, pesoKg, licencia, piloto,
        hiddenIdBod, cantBultos, hiddenIdentificador, hiddenDateTime, descMercaderia) {

    var datos = new FormData();
    datos.append("listaVehiculosVEd", listaVehiculos);
    datos.append("hiddeniddeingresoVEd", hiddeniddeingreso);
    datos.append("hiddenIdUsVEd", hiddenIdUs);
    datos.append("idNitVEd", idNit);
    datos.append("polizaRetiroVEd", polizaRetiro);
    datos.append("regimenVEd", regimen);
    datos.append("tipoCambioVEd", tipoCambio);
    datos.append("valorTotalAduanaVEd", valorTotalAduana);
    datos.append("valorCifVEd", valorCif);
    datos.append("calculoValorImpuestoVEd", calculoValorImpuesto);
    datos.append("pesoKgVEd", pesoKg);
    datos.append("licenciaVEd", licencia);
    datos.append("pilotoVEd", piloto);
    datos.append("hiddenIdBodVEd", hiddenIdBod);
    datos.append("cantBultosVEd", cantBultos);
    datos.append("hiddenIdentificadorVEd", hiddenIdentificador);
    datos.append("hiddenDateTimeVEd", hiddenDateTime);
    datos.append("descMercaderiaVEd", descMercaderia);
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
        }, error: function (respuesta) {
            console.log(respuesta);
        }
    })


}
function desbloqueBloque(tipo) {
    if (tipo == 0) {
        document.getElementById("textParamBusqRet").readOnly = true;
        document.getElementById("txtNitSalida").readOnly = true;
        document.getElementById("txtNombreSalida").readOnly = true;
        document.getElementById("txtDireccionSalida").readOnly = true;
        document.getElementById("polizaRetiro").readOnly = true;
        document.getElementById("regimen").readOnly = true;
        document.getElementById("valorTAduana").readOnly = true;
        document.getElementById("cambio").readOnly = true;
        document.getElementById("valorCif").readOnly = true;
        document.getElementById("calculoValorImpuesto").readOnly = true;
        document.getElementById("pesoKg").readOnly = true;
        document.getElementById("cantBultos").readOnly = true;
        document.getElementById("descMercaderia").readOnly = true;
        if ($("#numeroLicencia").length > 0) {
            document.getElementById("numeroLicencia").readOnly = true;
        }
        if ($("#nombrePiloto").length > 0) {
            document.getElementById("nombrePiloto").readOnly = true;
        }
        if ($("#numeroPlaca").length > 0) {
            document.getElementById("numeroPlaca").readOnly = true;
        }
        if ($("#contenedor").length > 0) {
            document.getElementById("contenedor").readOnly = true;
        }


    } else if (tipo == 1) {
        document.getElementById("textParamBusqRet").readOnly = true;
        document.getElementById("txtNitSalida").readOnly = true;
        document.getElementById("txtNombreSalida").readOnly = true;
        document.getElementById("txtDireccionSalida").readOnly = true;
        document.getElementById("polizaRetiro").readOnly = true;
        document.getElementById("regimen").readOnly = true;
        document.getElementById("valorTAduana").readOnly = true;
        document.getElementById("cambio").readOnly = true;
        document.getElementById("valorCif").readOnly = true;
        document.getElementById("calculoValorImpuesto").readOnly = true;
        document.getElementById("pesoKg").readOnly = true;
        document.getElementById("cantBultos").readOnly = true;
        document.getElementById("descMercaderia").readOnly = true;
        if ($("#numeroLicencia").length > 0) {
            document.getElementById("numeroLicencia").readOnly = true;
        }
        if ($("#nombrePiloto").length > 0) {
            document.getElementById("nombrePiloto").readOnly = true;
        }
        if ($("#numeroPlaca").length > 0) {
            document.getElementById("numeroPlaca").readOnly = true;
        }
        if ($("#contenedor").length > 0) {
            document.getElementById("contenedor").readOnly = true;
        }
    }
}

$(document).on("change", "#polizaRetiro", async function () {

    var dato = $(this).val();
    var nomVar = "verPoliza";
    var poliza = await revisionPolRet(nomVar, dato);
    console.log(poliza[0]);
    if (poliza != false) {
        document.getElementById("divExiste").innerHTML = `
    <input type="hidden" id="hiddenRegimenExiste" value=""/>
    <input type="hidden" id="hiddenValorTAduanaExiste" value=""/>
    <input type="hidden" id="hiddenCambioExiste" value=""/>
    <input type="hidden" id="hiddenValorCifExiste" value=""/>
    <input type="hidden" id="hiddenValorImpuestoExiste" value=""/>
    <input type="hidden" id="hiddenPesoKgExiste" value=""/>
    <input type="hidden" id="hiddenCantBultosExiste" value=""/>
    `;
        document.getElementById("hiddenRegimenExiste").value = poliza[0].regimen;
        document.getElementById("hiddenValorTAduanaExiste").value = poliza[0].valorAduanT;
        document.getElementById("hiddenCambioExiste").value = poliza[0].tipoCambio;
        document.getElementById("hiddenValorCifExiste").value = poliza[0].valorCif;
        document.getElementById("hiddenValorImpuestoExiste").value = poliza[0].valorImpuesto;
        document.getElementById("hiddenPesoKgExiste").value = poliza[0].pesoKG;
        document.getElementById("hiddenCantBultosExiste").value = poliza[0].cantidadBultos;
        if (dato == "") {
            var mensaje = "Este campo es obligatorio";
            var tipo = "error";
            alertaToast(mensaje, tipo);
            $(this).removeClass("is-valid");
            $(this).addClass("is-invalid");
            $("#hiddenPolizaRetiro").val(0);
        } else {
            $(this).removeClass("is-invalid");
            $(this).addClass("is-valid");
            $("#hiddenPolizaRetiro").val(1);
        }
    } else {
        document.getElementById("divExiste").innerHTML = ``;
        if (dato == "") {
            var mensaje = "Este campo es obligatorio";
            var tipo = "error";
            alertaToast(mensaje, tipo);
            $(this).removeClass("is-valid");
            $(this).addClass("is-invalid");
            $("#hiddenPolizaRetiro").val(0);
        } else {
            $(this).removeClass("is-invalid");
            $(this).addClass("is-valid");
            $("#hiddenPolizaRetiro").val(1);
        }
    }

})

function revPolizasIngreso(numPolizaRev) {
    let todoMenus;
    var datos = new FormData();
    datos.append("numPolizaRev", numPolizaRev);
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
            if (respuesta[0].poliza == 1) {
                todoMenus = "Duplicada";
            }

        }, error: function (respuesta) {
            console.log(respuesta);
        }
    })
    return todoMenus;
}

function functionVerServicio(idIngOpDet) {
    let todoMenus;
    var datos = new FormData();
    datos.append("idIngOpDet", idIngOpDet);
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
            todoMenus = respuesta;
        }, error: function (respuesta) {
            console.log(respuesta);
        }
    })
    return todoMenus;
}

$(document).on("click", ".btnSelectChasSal", async function () {
    var idChas = $(this).attr("idChas");
    var respChas = await consultChasis(idChas);
    var dataChas = 'CHASIS : ' + respChas[0].chasis + ' - ' + respChas[0].tipoVehiculo + ' - ' + respChas[0].linea;
    document.getElementById("tableMostrarEmpresa").innerHTML += `
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <button type="button" class="btn btn-danger btn-sm" id="buttonTrashVeh" numOrigen="` + idChas + `"><i class="fa fa-trash" aria-hidden="true"></i></button>
        </div>
        <!-- /btn-group -->
        <input type="text" class="form-control" id="textSalVeh" value="` + dataChas + `" readOnly="readOnly">
    </div>
    `;
    $(this).attr("disabled", "disabled");
    $(this).removeClass("btn-outline-danger");
    $(this).addClass("btn-success");
    $(this).html('<i class="fa fa-check"></i>');
})

function consultChasis(idChas) {
    let todoMenus;
    var datos = new FormData();
    datos.append("idChasVer", idChas);
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
            todoMenus = respuesta;
        }, error: function (respuesta) {
            console.log(respuesta);
        }
    })
    return todoMenus;
}

$(document).on("click", "#buttonTrashVeh", async function () {
    var numOrigen = $(this).attr("numOrigen");
    $("#btnOrigen" + numOrigen).removeClass("btn-success");
    $("#btnOrigen" + numOrigen).addClass("btn-outline-danger");
    $("#btnOrigen" + numOrigen).html('<i class="fa fa-close"></i>');
    $("#btnOrigen" + numOrigen).removeAttr("disabled");
    $(this).parent().parent().remove();
})

$(document).on("click", "#buttonTrash", async function () {
    var numOrigen = $(this).attr("numOrigen");
    $(this).parent().parent().remove();
    if ($("#textDetalle" + numOrigen).length > 0) {


        document.getElementById("textDetalle" + numOrigen).readOnly = false;
        document.getElementById("textDetalle" + numOrigen).value = "";
        $("#textDetalle" + numOrigen).removeClass("is-invalid");
        $("#textDetalle" + numOrigen).addClass("is-valid");
        document.getElementById("btnAceptarDet" + numOrigen).disabled = false;
    }
})

$(document).on("click", ".btnEditarRetiroVeh", async function () {
    var idRet = $(this).attr("idRet");
    var validarForm = await validarFormRet();
    if (validarForm) {
        var dataEdit = await editarRetiroOpFis(idRet);
    }
})



$(document).on("change", "#regimen", function () {
    var dato = $(this).val();
    console.log(dato);
    if (dato == "") {
        var mensaje = "Este campo es obligatorio";
        var tipo = "error";
        alertaToast(mensaje, tipo);
        $(this).removeClass("is-valid");
        $(this).addClass("is-invalid");
        $("#hiddenRegimen").val(0);
    } else {

        $("#hiddenRegimen").val(1);
        if ($("#hiddenRegimenExiste").length > 0 && $("#hiddenRegimenExiste").val() != dato) {
            $("#spanPoliza").attr("style", "display: block;");
            $(this).removeClass("is-valid");
            $(this).addClass("is-invalid");
            document.getElementById("spanPoliza").innerHTML = 'Dato Guardado: ' + $("#hiddenRegimenExiste").val();
        } else {
            $("#spanPoliza").attr("style", "display: none;");
            document.getElementById("spanPoliza").innerHTML = '';
            $(this).removeClass("is-invalid");
            $(this).addClass("is-valid");
        }
    }
});


$(document).on("change", "#valorTAduana", function () {
    var dato = $(this).val();
    var parseDato = parseFloat(dato).toFixed(2);
    $(this).val(parseDato);
    if (dato == "") {
        var mensaje = "Este campo es obligatorio";
        var tipo = "error";
        alertaToast(mensaje, tipo);
        $(this).removeClass("is-valid");
        $(this).addClass("is-invalid");
        $("#hiddenValorTAduana").val(0);
    } else if (!isNaN(dato)) {
        $("#hiddenValorTAduana").val(1);
        if ($("#hiddenValorTAduanaExiste").length > 0 && $("#hiddenValorTAduanaExiste").val() != dato) {
            $("#spanCalculoValorTAduana").attr("style", "display: block;");
            $(this).removeClass("is-valid");
            $(this).addClass("is-invalid");
            document.getElementById("spanCalculoValorTAduana").innerHTML = 'Dato Guardado: ' + $("#hiddenValorTAduanaExiste").val();
        } else {
            $("#spanCalculoValorTAduana").attr("style", "display: none;");
            document.getElementById("spanCalculoValorTAduana").innerHTML = '';
            $(this).removeClass("is-invalid");
            $(this).addClass("is-valid");
            if ($("#cambio").val() > 0) {
                var valCalculo = $("#cambio").val();
                var conversion = parseFloat(dato * valCalculo).toFixed(2);
                document.getElementById("valorCif").value = conversion;
                document.getElementById("valorCif").readOnly = true;
                document.getElementById("hiddenValorCif").value = 1;
                document.getElementById("calculoValorImpuesto").focus();
                $("#valorCif").removeClass('is-invalid');
                $("#valorCif").addClass('is-valid');
            }

        }



    } else if (isNaN(dato)) {
        var mensaje = "Este campo es obligatorio";
        var tipo = "error";
        alertaToast(mensaje, tipo);
        $(this).removeClass("is-valid");
        $(this).addClass("is-invalid");
        $("#hiddenValorTAduana").val(0);
    }
});


$(document).on("change", "#cambio", function () {
    var dato = $(this).val();
    if (dato == "") {
        var mensaje = "Este campo es obligatorio";
        var tipo = "error";
        alertaToast(mensaje, tipo);
        $(this).removeClass("is-valid");
        $(this).addClass("is-invalid");
        $("#hiddenCambio").val(0);
    } else if (!isNaN(dato)) {
        $("#hiddenCambio").val(1);
        if ($("#hiddenCambioExiste").length > 0 && $("#hiddenCambioExiste").val() != dato) {
            $("#spanCalculoCambio").attr("style", "display: block;");
            $(this).removeClass("is-valid");
            $(this).addClass("is-invalid");
            document.getElementById("spanCalculoCambio").innerHTML = 'Dato Guardado: ' + $("#hiddenCambioExiste").val();
        } else {
            $("#spanCalculoCambio").attr("style", "display: none;");
            document.getElementById("spanCalculoCambio").innerHTML = '';
            $(this).removeClass("is-invalid");
            $(this).addClass("is-valid");
        }

        if ($("#valorTAduana").val() > 0) {
            var valCalculo = $("#valorTAduana").val();
            var conversion = parseFloat(dato * valCalculo).toFixed(2);
            document.getElementById("valorCif").value = conversion;
            document.getElementById("valorCif").readOnly = true;
            document.getElementById("hiddenValorCif").value = 1;
            $("#valorCif").removeClass('is-invalid');
            $("#valorCif").addClass('is-valid');
            $("#valorCif").attr('readOnly', true);
            document.getElementById("calculoValorImpuesto").focus();
        }
    } else if (isNaN(dato)) {
        var mensaje = "Este campo es obligatorio";
        var tipo = "error";
        alertaToast(mensaje, tipo);
        $(this).removeClass("is-valid");
        $(this).addClass("is-invalid");
        $("#hiddenCambio").val(0);
    }
});

$(document).on("change", "#calculoValorImpuesto", function () {
    var dato = $(this).val();
    var parseDato = parseFloat(dato).toFixed(2);
    $(this).val(parseDato);
    if (dato == "") {
        var mensaje = "Este campo es obligatorio";
        var tipo = "error";
        alertaToast(mensaje, tipo);
        $(this).removeClass("is-valid");
        $(this).addClass("is-invalid");
        $("#hiddenValorImpuesto").val(0);
    } else if (!isNaN(dato)) {
        $("#hiddenValorImpuesto").val(1);
        if ($("#hiddenValorImpuestoExiste").length > 0 && $("#hiddenValorImpuestoExiste").val() != dato) {
            $("#spanCalculoValorImpuesto").attr("style", "display: block;");
            $(this).removeClass("is-valid");
            $(this).addClass("is-invalid");
            document.getElementById("spanCalculoValorImpuesto").innerHTML = 'Dato Guardado: ' + $("#hiddenValorImpuestoExiste").val();
        } else {
            $("#spanCalculoValorImpuesto").attr("style", "display: none;");
            document.getElementById("spanCalculoValorImpuesto").innerHTML = '';
            $(this).removeClass("is-invalid");
            $(this).addClass("is-valid");
        }

    } else if (isNaN(dato)) {

        var mensaje = "Este campo es obligatorio";
        var tipo = "error";
        alertaToast(mensaje, tipo);
        $(this).removeClass("is-valid");
        $(this).addClass("is-invalid");
        $("#hiddenValorImpuesto").val(0);
    }
});


$(document).on("change", "#pesoKg", function () {
    var dato = $(this).val();
    var parseDato = parseFloat(dato).toFixed(2);
    $(this).val(parseDato);
    if (dato == "") {
        var mensaje = "Este campo es obligatorio";
        var tipo = "error";
        alertaToast(mensaje, tipo);
        $("#hiddenPesoKg").val(0);
    } else if (!isNaN(dato)) {
        $("#hiddenPesoKg").val(1);
        if ($("#hiddenPesoKgExiste").length > 0 && $("#hiddenPesoKgExiste").val() != dato) {
            $("#spanCalculoPesoKg").attr("style", "display: block;");
            $(this).removeClass("is-valid");
            $(this).addClass("is-invalid");
            document.getElementById("spanCalculoPesoKg").innerHTML = 'Dato Guardado: ' + $("#hiddenPesoKgExiste").val();
        } else {
            $("#spanCalculoPesoKg").attr("style", "display: none;");
            document.getElementById("spanCalculoPesoKg").innerHTML = '';
            $(this).removeClass("is-invalid");
            $(this).addClass("is-valid");
        }

    } else if (isNaN(dato)) {


        var mensaje = "Este campo es obligatorio";
        var tipo = "error";
        alertaToast(mensaje, tipo);
        $(this).removeClass("is-valid");
        $(this).addClass("is-invalid");
        $("#hiddenPesoKg").val(0);
    }
});



$(document).on("change", "#cantBultos", function () {
    var dato = $(this).val();
    var parseDato = parseInt(dato);
    $(this).val(parseDato);
    if (dato == "") {
        var mensaje = "Este campo es obligatorio";
        var tipo = "error";
        alertaToast(mensaje, tipo);
        $(this).removeClass("is-valid");
        $(this).addClass("is-invalid");
        $("#hiddenCantBultos").val(0);
    } else if (!isNaN(dato)) {
        $("#hiddenCantBultos").val(1);
        if ($("#hiddenCantBultosExiste").length > 0 && $("#hiddenCantBultosExiste").val() != dato) {
            $("#spanCalculoCantBultos").attr("style", "display: block;");
            $(this).removeClass("is-valid");
            $(this).addClass("is-invalid");
            document.getElementById("spanCalculoCantBultos").innerHTML = 'Dato Guardado: ' + $("#hiddenCantBultosExiste").val();
        } else {
            $("#spanCalculoCantBultos").attr("style", "display: none;");
            document.getElementById("spanCalculoCantBultos").innerHTML = '';
            $(this).removeClass("is-invalid");
            $(this).addClass("is-valid");
        }

    } else if (isNaN(dato)) {
        var mensaje = "Este campo es obligatorio";
        var tipo = "error";
        alertaToast(mensaje, tipo);
        $(this).removeClass("is-valid");
        $(this).addClass("is-invalid");
        $("#hiddenCantBultos").val(0);
    }
});

$(document).on("change", "#descMercaderia", async function () {
    var cartaDeCupo = $(this).val();
    console.log(cartaDeCupo.length);
    var cartaDeCupoVal = await patternPregSpaceSGProducto(cartaDeCupo);
    console.log(cartaDeCupoVal);
    if (cartaDeCupoVal == 0) {
        $(this).removeClass("is-valid");
        $(this).addClass("is-invalid");
    } else if (cartaDeCupoVal == 1) {
        $(this).removeClass("is-invalid");
        $(this).addClass("is-valid");
    }
})


$(document).on("click", "#btnEditPiloto", async function () {
    $("#btnGuardaNuevaUnidad").removeClass("btnGuardaNuevaUnidadPlus");
    $("#btnGuardaNuevaUnidad").addClass("btnEditarUnidadPlus");
    var idDatoPlto = $(this).attr("idUniDetEdit");
    var idRet = $(this).attr("idRet");
    var tipoOp = 1;
    var nomVar = "idRetUnidad";
    var respEditUn = await editarPiloto(nomVar, idRet);
    console.log(respEditUn);
    if (respEditUn != "SD") {
        document.getElementById("numeroLicenciaPlus").value = respEditUn[0].licPiloto;
        document.getElementById("nombrePilotoPlusUn").value = respEditUn[0].nombrePiloto;
        document.getElementById("numeroPlacaPlusUn").value = respEditUn[0].placaUnidad;
        document.getElementById("numeroContenedorPlusUn").value = respEditUn[0].contenedorUnidad;
        $("#numeroLicenciaPlus").removeClass("is-invalid");
        $("#nombrePilotoPlusUn").removeClass("is-invalid");
        $("#numeroPlacaPlusUn").removeClass("is-invalid");
        $("#numeroContenedorPlusUn").removeClass("is-invalid");
        $("#numeroLicenciaPlus").addClass("is-valid");
        $("#nombrePilotoPlusUn").addClass("is-valid");
        $("#numeroPlacaPlusUn").addClass("is-valid");
        $("#numeroContenedorPlusUn").addClass("is-valid");
        $(".btnEditarUnidadPlus").attr("idDatoPlto", idDatoPlto);
        $(".btnEditarUnidadPlus").removeClass("btn-info");
        $(".btnEditarUnidadPlus").addClass("btn-warning");
        $(".btnEditarUnidadPlus").html("Editar Unidad");
    }
});
function verPltsRet(nomVar, idRet, estado) {
    let respEdit;
    var datos = new FormData();
    datos.append(nomVar, idRet);
    datos.append("estadoVerPlt", estado);
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
            respEdit = respuesta;
        }, error: function (respuesta) {
            console.log(respuesta);
        }
    });
    return respEdit;
}

function editarPiloto(nomVar, idRet) {
    let respEdit;
    var datos = new FormData();
    datos.append(nomVar, idRet);
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
            respEdit = respuesta;
        }, error: function (respuesta) {
            console.log(respuesta);
        }
    });
    return respEdit;
}

$(document).on("click", ".btnMasPilotos", async function () {
    document.getElementById("ListaSelect").innerHTML = "";
    $("#btnGuardaNuevaUnidad").removeClass("btnGuardaNuevaUnidadPlus");
    $("#btnGuardaNuevaUnidad").removeClass("btnEditarUnidadPlus");
    $("#btnGuardaNuevaUnidad").addClass("btnGuardaNuevaUnidadPlus");
    $("#btnGuardaNuevaUnidad").removeClass("btn-warning");
    $("#btnGuardaNuevaUnidad").removeClass("btn-info");
    $("#btnGuardaNuevaUnidad").addClass("btn-info");
    $("#btnGuardaNuevaUnidad").html("Guardar Nueva Unidad");
    var idMasPilotos = $(this).attr("idMasPilotos");
    var nomVar = "todasUnidades";
    var estado = 0;
    if ($(".btnEditarRetiro").length > 0) {
        var estado = 1;
    }
    var respTodosPlt = await verPltsRet(nomVar, idMasPilotos, estado);
    if (respTodosPlt != "SD") {
        for (var i = 0; i < respTodosPlt.length; i++) {
            var nombrePilotoPlusUn = respTodosPlt[i].nombrePiloto;
            var numeroLicenciaPlus = respTodosPlt[i].licPiloto;
            var numeroPlacaPlusUn = respTodosPlt[i].placaUnidad;
            var numeroContenedorPlusUn = respTodosPlt[i].contenedorUnidad;
            console.log(respTodosPlt[i].Identity);
            if (respTodosPlt[i].estadoUnidad == 0) {
                var button = '<button type="button" class="btn btn-dark btnInactivo" numIdentUn="' + respTodosPlt[i].Identity + '" >Eliminado</button>';
            }
            if (respTodosPlt[i].estadoUnidad == -1 || respTodosPlt[i].estadoUnidad == 1 || respTodosPlt[i].estadoUnidad == 2) {
                var button = `<button type="button" class="btn btn-danger btn-sm" id="btnTrashPiloto" idRet=` + respTodosPlt[i].Identity + `  idUniDetTrash="` + respTodosPlt[i].Identity + `"><i class="fa fa-trash"></i></button><button type="button" class="btn btn-warning btn-sm" id="btnEditPiloto" idRet=` + respTodosPlt[i].Identity + ` idUniDetEdit="` + respTodosPlt[i].Identity + `"  data-toggle="modal" data-target="#plusPilotos"><i class="fa fa-edit" data-toggle="modal" data-target="#plusPilotos"></i></button>`;
            }
            $("#ListaSelect").append(`
                    <div class="input-group mb-3" id="divUnidadExt` + respTodosPlt[0].Identity + `">
                    <div class="input-group-prepend">
               ` + button + `
                    </div>
                      <!-- /btn-group -->
                      <input type="text" class="form-control" id="texToEmpresaVal` + respTodosPlt[0].Identity + `" value="` + nombrePilotoPlusUn + ` - ` + numeroLicenciaPlus + ` - ` + numeroPlacaPlusUn + ` - ` + numeroContenedorPlusUn + `" />
                    </div>`);
        }
    }
});



$(document).on("click", ".btnEditarUnidadPlus", async function () {
    var idUnidadEdit = $(this).attr("idDatoPlto");
    var numeroLicenciaPlus = document.getElementById("numeroLicenciaPlus").value;
    var nombrePilotoPlusUn = document.getElementById("nombrePilotoPlusUn").value;
    var numeroPlacaPlusUn = document.getElementById("numeroPlacaPlusUn").value;
    var numeroContenedorPlusUn = document.getElementById("numeroContenedorPlusUn").value;
    if ($("#txtNitSalida").length > 0) {
        var hiddenIdentity = $(".btnMasPilotos").attr("idMasPilotos");
        var tipo = 2;
        var numeroMarchamoPlusUn = 0;
    } else {
        var hiddenIdentity = document.getElementById("hiddenIdentity").value;
        var tipo = 1;
        var numeroMarchamoPlusUn = document.getElementById("numeroMarchamoPlusUn").value;
    }

    var numeroLicenciaPlusG = patternPregNumEntero(numeroLicenciaPlus);
    if (numeroLicenciaPlusG == 0) {
        $("#numeroLicenciaPlus").removeClass('is-valid');
        $("#numeroLicenciaPlus").addClass('is-invalid');
    }
    var nombrePilotoPlusUnG = patternPregSpaceSG(nombrePilotoPlusUn);
    if (nombrePilotoPlusUnG == 0) {
        $("#nombrePilotoPlusUn").removeClass('is-valid');
        $("#nombrePilotoPlusUn").addClass('is-invalid');
    }
    var numeroPlacaPlusUnG = patternPregSinG(numeroPlacaPlusUn);
    if (numeroPlacaPlusUnG == 0) {
        $("#numeroPlacaPlusUn").removeClass('is-valid');
        $("#numeroPlacaPlusUn").addClass('is-invalid');
    }
    var numeroContenedorPlusUnG = patternPregSinG(numeroContenedorPlusUn);
    if (numeroContenedorPlusUnG == 0) {
        $("#numeroContenedorPlusUn").removeClass('is-valid');
        $("#numeroContenedorPlusUn").addClass('is-invalid');
    }
    var numeroMarchamoPlusUnG = patternPregSinG(numeroMarchamoPlusUn);
    if (numeroMarchamoPlusUnG == 0) {
        $("#numeroMarchamoPlusUn").removeClass('is-valid');
        $("#numeroMarchamoPlusUn").addClass('is-invalid');
    }
    console.log(idUnidadEdit);
    var respEditar = await editarVehiculosMercaderia(numeroLicenciaPlus, nombrePilotoPlusUn, numeroPlacaPlusUn, numeroContenedorPlusUn, numeroMarchamoPlusUn, hiddenIdentity, tipo, idUnidadEdit);
    if (respEditar[0].resp == 1) {
        $(".close").click();
        Swal.fire(
                'Transacción Correcta',
                'La Edición se Finalizo con Exito',
                'success'
                )
        document.getElementById("texToEmpresaVal" + idUnidadEdit).value = nombrePilotoPlusUn + ' - ' + numeroLicenciaPlus + ' - ' + numeroPlacaPlusUn + ' - ' + numeroContenedorPlusUn;
    }
});

function editarVehiculosMercaderia(numeroLicenciaPlus, nombrePilotoPlusUn, numeroPlacaPlusUn, numeroContenedorPlusUn, numeroMarchamoPlusUn, hiddenIdentity, tipo, idUnidadEdit) {
    let respEdicion;
    var datos = new FormData();
    datos.append("licEdit", numeroLicenciaPlus);
    datos.append("nombreEdit", nombrePilotoPlusUn);
    datos.append("numeroPlacaEdit", numeroPlacaPlusUn);
    datos.append("numeroContEdit", numeroContenedorPlusUn);
    datos.append("numeroMarchEdit", numeroMarchamoPlusUn);
    datos.append("hiddenIdentEdit", hiddenIdentity);
    datos.append("hiddenTipEdit", tipo);
    datos.append("identiUnidad", idUnidadEdit);
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
            respEdicion = respuesta;
        }, error: function (respuesta) {
            console.log(respuesta);
        }})
    return respEdicion;
}

$(document).on("click", "#btnTrashPiloto", async function () {
    var idUniDetTrash = $(this).attr("idUniDetTrash");
    Swal.fire({
        title: '¿Está Seguro?',
        text: "Borrara la Unidad de Transporte Para El Retiro!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Borrar!',
        cancelButtonText: 'Cancelar'

    }).then((result) => {
        if (result.value) {
            funcAsync(idUniDetTrash);
        }
    })
})

async function funcAsync(idUniDetTrash) {
    document.getElementById("ListaSelect").innerHTML = "";
    var respBorrar = await funcionBorrar(idUniDetTrash);
    if (respBorrar[0].resp == 1) {
        var estado = 0;
        if ($(".btnEditarRetiro").length > 0) {
            var estado = 1;
        }
        var idMasPilotos = $(".btnMasPilotos").attr("idMasPilotos");
        var nomVar = "todasUnidades";
        var respTodosPlt = await verPltsRet(nomVar, idMasPilotos, estado);
        if (respTodosPlt != "SD") {
            for (var i = 0; i < respTodosPlt.length; i++) {
                var nombrePilotoPlusUn = respTodosPlt[i].nombrePiloto;
                var numeroLicenciaPlus = respTodosPlt[i].licPiloto;
                var numeroPlacaPlusUn = respTodosPlt[i].placaUnidad;
                var numeroContenedorPlusUn = respTodosPlt[i].contenedorUnidad;
                console.log(respTodosPlt[i].Identity);
                if (respTodosPlt[i].estadoUnidad == 0) {
                    var button = '<button type="button" class="btn btn-dark btnInactivo" numIdentUn="' + respTodosPlt[i].Identity + '" >Eliminado</button>';
                }
                if (respTodosPlt[i].estadoUnidad == -1 || respTodosPlt[i].estadoUnidad == 1) {
                    var button = `<button type="button" class="btn btn-danger btn-sm" id="btnTrashPiloto" idRet=` + respTodosPlt[i].Identity + `  idUniDetTrash="` + respTodosPlt[i].Identity + `"><i class="fa fa-trash"></i></button><button type="button" class="btn btn-warning btn-sm" id="btnEditPiloto" idRet=` + respTodosPlt[i].Identity + ` idUniDetEdit="` + respTodosPlt[i].Identity + `"  data-toggle="modal" data-target="#plusPilotos"><i class="fa fa-edit" data-toggle="modal" data-target="#plusPilotos"></i></button>`;
                }
                $("#ListaSelect").append(`
                    <div class="input-group mb-3" id="divUnidadExt` + respTodosPlt[0].Identity + `">
                    <div class="input-group-prepend">
               ` + button + `
                    </div>
                      <!-- /btn-group -->
                      <input type="text" class="form-control" id="texToEmpresaVal` + respTodosPlt[0].Identity + `" value="` + nombrePilotoPlusUn + ` - ` + numeroLicenciaPlus + ` - ` + numeroPlacaPlusUn + ` - ` + numeroContenedorPlusUn + `" />
                    </div>`);
            }
        }

        Swal.fire(
                'Borrado',
                'El Pilot fue Anulado del Retiro Con exito',
                'success'
                )
    }
}

function funcionBorrar(idUniDetTrash) {
    let respEdicion;
    var datos = new FormData();
    datos.append("borrarUnidad", idUniDetTrash);
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
            respEdicion = respuesta;
        }, error: function (respuesta) {
            console.log(respuesta);
        }})
    return respEdicion;
}
$(document).on("click", ".btnInactivo", async function () {
    document.getElementById("ListaSelect").innerHTML = "";
    var numIdentUn = $(this).attr("numIdentUn");
    var nomVar = "activarUnidad";
    var respActivar = await editarPiloto(nomVar, numIdentUn);
    var idMasPilotos = $(".btnMasPilotos").attr("idMasPilotos");
    var nomVar = "todasUnidades";
    var respTodosPlt = await editarPiloto(nomVar, idMasPilotos);
    if (respTodosPlt != "SD") {
        for (var i = 0; i < respTodosPlt.length; i++) {
            var nombrePilotoPlusUn = respTodosPlt[i].nombrePiloto;
            var numeroLicenciaPlus = respTodosPlt[i].licPiloto;
            var numeroPlacaPlusUn = respTodosPlt[i].placaUnidad;
            var numeroContenedorPlusUn = respTodosPlt[i].contenedorUnidad;
            console.log(respTodosPlt[i].Identity);
            if (respTodosPlt[i].estadoUnidad == 0) {
                var button = '<button type="button" class="btn btn-dark btnInactivo" numIdentUn="' + respTodosPlt[i].Identity + '" >Eliminado</button>';
            }
            if (respTodosPlt[i].estadoUnidad == -1 || respTodosPlt[i].estadoUnidad == 1) {
                var button = `<button type="button" class="btn btn-danger btn-sm" id="btnTrashPiloto" idRet=` + respTodosPlt[i].Identity + `  idUniDetTrash="` + respTodosPlt[i].Identity + `"><i class="fa fa-trash"></i></button><button type="button" class="btn btn-warning btn-sm" id="btnEditPiloto" idRet=` + respTodosPlt[i].Identity + ` idUniDetEdit="` + respTodosPlt[i].Identity + `"  data-toggle="modal" data-target="#plusPilotos"><i class="fa fa-edit" data-toggle="modal" data-target="#plusPilotos"></i></button>`;
            }
            $("#ListaSelect").append(`
                    <div class="input-group mb-3" id="divUnidadExt` + respTodosPlt[0].Identity + `">
                    <div class="input-group-prepend">
               ` + button + `
                    </div>
                      <!-- /btn-group -->
                      <input type="text" class="form-control" id="texToEmpresaVal` + respTodosPlt[0].Identity + `" value="` + nombrePilotoPlusUn + ` - ` + numeroLicenciaPlus + ` - ` + numeroPlacaPlusUn + ` - ` + numeroContenedorPlusUn + `" />
                    </div>`);
        }
    }

})

$(document).on("click", ".btnTrasladoFiscal", async function () {
    var idIngOpDet = $(this).attr("idingselectdetope");
    document.getElementById("hiddenIdentificador").value = idIngOpDet;
    document.getElementById("hiddeniddeingreso").value = idIngOpDet;
    if ($("#idChasAnt").length > 0) {
        if ($("#idChasAnt").value != idIngOpDet) {
            Swal.fire('Error DA', 'La póliza seleccionada no es igual a la del chasis que decea hacer reversión', 'error');
        }
    }
    var servicio = await functionVerServicio(idIngOpDet);
    if (servicio.respTipo == "vehM" || servicio.respTipo == "vehUs") {
        document.getElementById("hiddenGdVehMerc").value = servicio.respTipo;
        if ($("#hiddenGdVehMerc").length > 0) {
            document.getElementById("hiddenGdVehMerc").value = servicio.respTipo;
        }
        if (servicio.data == "sinRet") {
            var nomVar = "idIngEditOp";
            var respData = await dataIngTraslado(nomVar, idIngOpDet);
            var bultos = respData["dataIng"][0]["bultos"];
            var valCif = respData["dataIng"][0]["valCif"];
            var valImpuesto = respData["dataIng"][0]["valImpuesto"];
            var idIngreso = respData["dataIng"][0]["idIngreso"];
            var bultos = parseInt(bultos);
            var valCif = parseFloat(valCif).toFixed(2);
            var valImpuesto = parseFloat(valImpuesto).toFixed(2);
            var valCifGT = new Intl.NumberFormat("en-GT").format(valCif);
            var valImpuestoGT = new Intl.NumberFormat("en-GT").format(valImpuesto);
            console.log(respData);
            document.getElementById("ListaSelect").innerHTML = `
                <div class="row mt-4">
                      <div class="col-sm-4 border-right">
                        <div class="description-block">
                          <h5 class="description-header"><span class="description-percentage text-success">` + bultos + `</span></h5>
                          <span class="description-text">BULTOS</span>
                        </div>
                        <!-- /.description-block -->
                      </div>
                      <!-- /.col -->
                      <div class="col-sm-4 border-right">
                        <div class="description-block">
                          <h5 class="description-header"><span class="description-percentage text-success">` + valCifGT + `</span></h5>
                          <span class="description-text">CIF</span>
                        </div>
                        <!-- /.description-block -->
                      </div>
                      <!-- /.col -->
                      <div class="col-sm-4">
                        <div class="description-block">
                          <h5 class="description-header"><span class="description-percentage text-success">` + valImpuestoGT + `</span></h5>
                          <span class="description-text">IMPUESTOS</span>
                        </div>
                        <!-- /.description-block -->
                      </div>
                      <!-- /.col -->
                    </div>
                    <div class="card-header">
                    <center><p>VALORES DE TRASLADO A ALMACEN FISCAL</p></center><br/>
                    <button type="button" class="btn btn-danger btn-block trasladoZAAF" idIngTraslado=` + idIngreso + `>Guardar Traslado Fiscal</button>
                    </div>
                `;
        } else {
            alert("no se puede trasladar");
        }
    }
});


function dataIngTraslado(nomVar, idIngEditOp) {
    let resp;
    var datos = new FormData();
    datos.append(nomVar, idIngEditOp);
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
            resp = respuesta;
        }, error: function (respuesta) {
            console.log(respuesta);
        }
    })
    return resp;
}

$(document).on("click", ".trasladoZAAF", async function () {
    var idIngTrasladar = $(this).attr("idingtraslado");
    Swal.fire({
        title: 'Quiere trasladar saldos?',
        text: "Si esta seguro de hacer traslado a Almacen Fiscal!",
        type: 'warning',
        allowOutsideClick: false,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, trasladar!'
    }).then(async function (result) {
        if (result.value) {
            var nomVar = "idIngTrasladar";
            var resp = await trasladarIngFiscal(nomVar, idIngTrasladar);
            if (resp[0]["resp"] == 1) {
                Swal.fire({
                    title: 'Trasladado',
                    text: "Traslado exitoso!",
                    type: 'success',
                    allowOutsideClick: false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'oK'
                }).then((result) => {
                    if (result.value) {
                        location.reload();
                    }
                })

            }
        }
    })


})


function trasladarIngFiscal(nomVar, idIngEditOp) {
    let resp;
    var datos = new FormData();
    datos.append(nomVar, idIngEditOp);
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
            resp = respuesta;
        }, error: function (respuesta) {
            console.log(respuesta);
        }
    })
    return resp;
}
$(document).on("click", ".btnVerSaldos", async function () {
    var idBut = $(this);
    var idIngOpDet = $(this).attr("idingselectdetope");
    var respSaldos = await funcRevSaldosAF(idIngOpDet);
    console.log(respSaldos);
    var verSaldo = 0;
    if (respSaldos != "SD") {
        if (respSaldos[0].tipo == "AF") {
            var nomVar = "idIngEditOp";
            var respData = await dataIngTraslado(nomVar, idIngOpDet);

            //SALDO BULTOS
            var bultos = respData["dataIng"][0]["bultos"];
            var bultos = parseInt(bultos);
            var sldBlts = respSaldos[0].saldoBultos;
            var sldBlts = parseInt(sldBlts);
            var retiroBlts = bultos - sldBlts;
            //SALDO CIF
            var valCif = respData["dataIng"][0]["valCif"];
            var valCif = parseFloat(valCif).toFixed(2);
            var valCifNumb = new Intl.NumberFormat("en-GT").format(valCif);

            var cif = respSaldos[0].saldoValorCif;
            var cif = parseFloat(cif).toFixed(2);
            var cifNumber = new Intl.NumberFormat("en-GT").format(cif);

            var cifRetiro = valCif - cif;
            var cifRetiro = parseFloat(cifRetiro).toFixed(2);
            var cifRetiroNumb = new Intl.NumberFormat("en-GT").format(cifRetiro);

            //SALDO IMPUESTOS
            var valImpuesto = respData["dataIng"][0]["valImpuesto"];
            var valImpuesto = parseFloat(valImpuesto).toFixed(2);
            var valImpuestoNumb = new Intl.NumberFormat("en-GT").format(valImpuesto);


            var sldImpt = respSaldos[0].saldoValorImpuesto;
            var sldImpt = parseFloat(sldImpt).toFixed(2);
            var sldImptNumber = new Intl.NumberFormat("en-GT").format(sldImpt);

            var imptsRet = valImpuesto - sldImpt;
            var imptsRet = parseFloat(imptsRet).toFixed(2);
            var imptsRetNumb = new Intl.NumberFormat("en-GT").format(imptsRet);


            document.getElementById("ListaSelect").innerHTML = `

            <div class="card-footer mt-4">
        <div class="row">
            <div class="col-sm-4 col-6">
                <div class="description-block border-right">
                    <h5 class="description-header">Saldo Bultos <i class="fa fa-box-open"></i></h5>
                    <span class="description-text" id="bltsIng"><label class="badge bg-info" style="font-size: 13px;">Ing :&nbsp;` + bultos + `</label><br><label class="badge bg-info" style="font-size: 13px;">Retiro : &nbsp;` + retiroBlts + `</label><br><label class="badge bg-danger" style="font-size: 20px;">Saldo : &nbsp;` + sldBlts + `</label></span>
                </div>
            </div>
            <div class="col-sm-4 col-6">
                <div class="description-block border-right">
                    <h5 class="description-header">Saldo Cif (Q)</h5>
                    <span class="description-text" id="cifIng"><label class="badge bg-info" style="font-size: 13px;">ING : &nbsp;` + valCif + `</label><br><label class="badge bg-info" style="font-size: 13px;">RET : &nbsp;` + cifRetiroNumb + `</label><br><label class="badge bg-danger" style="font-size: 20px;">Saldo : &nbsp;` + cifNumber + `</label></span>
                </div>
            </div>
            <div class="col-sm-4 col-6">
                <div class="description-block border-right">
                    <h5 class="description-header">Saldo Impuesto (Q)</h5>
                    <span class="description-text" id="imptIng"><label class="badge bg-info" style="font-size: 13px;">Ing : &nbsp;` + valImpuestoNumb + `</label><br><label class="badge bg-info" style="font-size: 13px;">Ret : &nbsp;` + imptsRetNumb + `</label><br><label class="badge bg-danger" style="font-size: 20px;">Saldo : &nbsp;` + sldImptNumber + `</label></span>
                </div>
            </div>

        </div>
    </div>`;
        }
    }

});

$(document).on("click", "#btnPolizasDR", async function () {

    var estado = document.getElementById("hiddenDR").value;
    if (estado == 0 || estado == "") {
        Swal.fire({
            title: 'Quiere registrar como DR?',
            text: "Se dejara duplicar la poliza de retiro!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Poliza DR!'
        }).then((result) => {
            if (result.value) {
                document.getElementById("hiddenDR").value = 1;
            }
        })
    }

})

$(document).on("click", ".btnPolizaDR", async function () {
    const {value: text} = await Swal.fire({
        input: 'textarea',
        html:
                `
 <div class="container">
 <h2>Validación y registro de pólizas DR</h2>
 <p>En el siguiente campo, tiene que ingresar cada uno de los chasis delimitados por el simbolo pai " | "</p>
 <div class="form-group">`
        ,
        inputPlaceholder: '2670706243|260219.55|1|260219.55|74943.2304',
        inputAttributes: {
            'aria-label': 'Type your message here'
        },
        showCancelButton: true
    })

    if (text) {
        console.log(text);
        var iteraciones = 5;
        var chasisDelimitados = text;
        var chasisTrim = chasisDelimitados.trim();
        var sin_salto = chasisTrim.split("\n").join("");
        var cadenaArray = sin_salto.split("|");
        var validacion = cadenaArray.length;

        var validarIter = (validacion / iteraciones);
        var validarIterInt = parseInt(validarIter);
        if (validarIter == validarIterInt) {
            var lista = [];
            var denegacion = 0;
            var numFila = 0;
            for (var i = 0; i < cadenaArray.length; i++) {
                var numFila = numFila + 1;
                var polizaDA = cadenaArray[i];
                var valDol = cadenaArray[i + 1];
                var valDol = Number.parseFloat(valDol).toFixed(2);
                var valDol = valDol * 1;

                var bultos = cadenaArray[i + 2];

                var cif = cadenaArray[i + 3];
                var cif = Number.parseFloat(cif).toFixed(2);
                var cif = cif * 1;

                var impuesto = cadenaArray[i + 4];
                var impuesto = Number.parseFloat(impuesto).toFixed(2);
                var impuesto = impuesto * 1;

                var i = (i + 4);
                if (numFila == "" || polizaDA == "" || valDol == "" || bultos == "" || cif == "" || impuesto == "") {
                    Swal.fire(
                            'No pueden existir campos vacios!',
                            'Revisar los datos ingresados!',
                            'error'
                            )
                    var lista = [];
                    var denegacion = 1;
                    break;
                } else {
                    lista.push([numFila, polizaDA, valDol, bultos, cif, impuesto]);
                }
            }

            if (denegacion == 0) {
                var valDolSum = 0;
                var cif = 0;
                var impuesto = 0;
                var bultos = 0;
                var formValDol = document.getElementById("valorTAduana").value;
                var formValDol = Number.parseFloat(formValDol).toFixed(2);
                var formValDol = formValDol * 1;

                var valorCif = document.getElementById("valorCif").value;
                var valorCif = Number.parseFloat(valorCif).toFixed(2);
                var valorCif = valorCif * 1;

                var calculoValorImpuesto = document.getElementById("calculoValorImpuesto").value;
                var calculoValorImpuesto = Number.parseFloat(calculoValorImpuesto).toFixed(2);
                var calculoValorImpuesto = calculoValorImpuesto * 1;

                var cantBultos = document.getElementById("cantBultos").value;
                var cantBultos = Number.parseInt(cantBultos);
                var cantBultos = cantBultos * 1;


                console.log(lista);
                for (var i = 0; i < lista.length; i++) {
                    var valDolLis = lista[i][2];
                    var valDolLis = Number.parseFloat(valDolLis).toFixed(2);
                    var valDolLis = valDolLis * 1;
                    var valDolSum = valDolSum + valDolLis;
                    var valDolSum = Number.parseFloat(valDolSum).toFixed(2);
                    var valDolSum = valDolSum * 1;

                    var cifList = lista[i][4];
                    var cifList = Number.parseFloat(cifList).toFixed(2);
                    var cifList = cifList * 1;
                    var cif = cif + cifList;
                    var cif = Number.parseFloat(cif).toFixed(2);
                    var cif = cif * 1;


                    var impstList = lista[i][5];
                    var impstList = Number.parseFloat(impstList).toFixed(2);
                    var impstList = impstList * 1;
                    var impuesto = impuesto + impstList;
                    var impuesto = Number.parseFloat(impuesto).toFixed(2);
                    var impuesto = impuesto * 1;

                    var bltsList = lista[i][3];
                    var bltsList = Number.parseInt(bltsList);
                    var bltsList = bltsList * 1;
                    var bultos = bultos + bltsList;
                }

                console.log(formValDol);
                console.log(valDolSum);

                console.log(valorCif);
                console.log(cif);

                console.log(calculoValorImpuesto);
                console.log(impuesto);

                console.log(cantBultos);
                console.log(bultos);



                if (formValDol == valDolSum
                        && valorCif == cif
                        && calculoValorImpuesto == impuesto
                        && cantBultos == bultos) {
                    console.log(calculoValorImpuesto);
                    console.log(impuesto);
                    listaDef = [];
                    for (var i = 0; i < lista.length; i++) {
                        var poliza = lista[i][1];

                        if (i == 0) {
                            listaDef.push({poliza});
                        }
                        if (i >= 1) {
                            var tipoRev = 0;
                            for (var j = 0; j < listaDef.length; j++) {
                                if (listaDef[j].poliza == poliza) {
                                    var tipoRev = 1;
                                }
                            }
                            if (tipoRev == 0) {
                                listaDef.push({poliza});
                            }
                        }
                    }
                    listaFinDef = [];
                    var listaFinDefJS = [];

                    console.log(lista);
                    for (var j = 0; j < listaDef.length; j++) {
                        var bltsSum = 0;
                        var valDolSum = 0;
                        var cif = 0;
                        var impuesto = 0;

                        var bltsSumFinal = 0;
                        var valDolSumFinal = 0;
                        var cifFinal = 0;
                        var impuestoFinal = 0;
                        var poliza = listaDef[j].poliza;
                        for (var i = 0; i < lista.length; i++) {
                            if (lista[i][1] == poliza) {

                                var valDolSum = lista[i][2];
                                var valDolSum = Number.parseFloat(valDolSum).toFixed(2);
                                var valDolSum = valDolSum * 1;
                                var valDolSumFinal = valDolSumFinal + valDolSum;

                                var cif = lista[i][4];
                                var cif = Number.parseFloat(cif).toFixed(2);
                                var cif = cif * 1;
                                var cifFinal = cifFinal + cif;

                                var impuesto = lista[i][5];
                                var impuesto = Number.parseFloat(impuesto).toFixed(2);
                                var impuesto = impuesto * 1;
                                var impuestoFinal = impuestoFinal + impuesto;

                                var bltsSum = lista[i][3];
                                var bltsSum = Number.parseFloat(bltsSum).toFixed(2);
                                var bltsSum = bltsSum * 1;
                                var bltsSumFinal = bltsSumFinal + bltsSum;


                            }
                        }

                        var respuesta = await saldosSobreGiros(poliza, bltsSumFinal, cifFinal, impuestoFinal);
                        var bultosSld = respuesta[0].bultos;
                        var cifSld = respuesta[0].cif;
                        var idIngDR = respuesta[0].idIngDR;
                        var tipoServ = respuesta[0].tipo;
                        var saldoImptsSld = respuesta[0].saldoImpts;
                        if (respuesta == "SD") {
                            return false;
                        }
                        if (bultosSld >= 0) {
                            if (tipoServ != 0) {
                                if (bultosSld == 0) {
                                    if (cifSld > 0 && saldoImptsSld > 0) {
                                        return false;
                                    }
                                }
                                var span = '<span class="right badge badge-success">Almacen Fiscal</span>';
                            } else {
                                var span = '<span class="right badge badge-danger">Zona Aduanera</span>';

                            }
                            var divicion = '<button type="button" class="btn btn-outline-info btn-sm btnRevisionDet" idIng=' + idIngDR + ' bultosDRDet=' + bltsSumFinal + '>::-> SALDOS F.</button>';
                            var buttonDR = '<div class="btn-group"><button type="button" buttonid=' + idIngDR + ' class="btn btn-success btnGeneracionExcel btn-sm"><i class="fa fa-file-excel-o"></i></button><button type="button" buttonid=' + idIngDR + ' class="btn btn-primary btn-sm bntImprimir"><i class="fa fa-print"></i> </button><button type="button" buttonPol=' + poliza + ' class="btn btn-outline-info btn-sm btnBsqPolDADR">Poliza DA<i class="fa fa-search"></i> </button></div>';

                            listaFinDef.push([poliza, bltsSumFinal, valDolSumFinal, cifFinal, impuestoFinal, divicion, bultosSld, cifSld, saldoImptsSld, span, buttonDR]);
                            listaFinDefJS.push({poliza, bltsSumFinal, valDolSumFinal, cifFinal, impuestoFinal});

                        }
                    }
                    // Guardar listaStringRet en el localstorage
                    var listaJSONDR = JSON.stringify(listaFinDefJS);
                    localStorage.setItem("listaDR", listaJSONDR);

                    document.getElementById("divPolizasDR").innerHTML = "";
                    document.getElementById("divPolizasDR").innerHTML = '<table id="tablePolizasDR" class="table table-hover table-sm"></table><input type="hidden" id="hiddenListaDeta" value="">';
                    $('#tablePolizasDR').DataTable({
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
                        data: listaFinDef,
                        columns: [{
                                title: "Poliza"
                            }, {
                                title: "Bultos"
                            }, {
                                title: "Valor Dolares"
                            }, {
                                title: "Valor Cif"
                            }, {
                                title: "Valor Impuestos"
                            }, {
                                title: ""
                            }, {
                                title: "Saldo bultos"
                            }, {
                                title: "Saldo cif"
                            }, {
                                title: "Saldo impuestos"
                            }, {
                                title: "Regimen"
                            }, {
                                title: "Acciones"
                            }]
                    });
                } else {
                    Swal.fire(
                            'Error de costeo',
                            'Los bultos, Valor en aduana total, CIF o Impuesto no cuadra contra poliza DR',
                            'error'
                            )
                }
            }
        }
    }
})

$(document).ready(function () {
    localStorage.removeItem("listaDR");
})


function saldosSobreGiros(poliza, bltsSumFinal, cifFinal, impuestoFinal) {
    let todoMenus;
    var datos = new FormData();
    datos.append("polizaIngDR", poliza);
    datos.append("bltsDR", bltsSumFinal);
    datos.append("cifDR", cifFinal);
    datos.append("imptDR", impuestoFinal);
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
            todoMenus = respuesta;
        }, error: function (respuesta) {
            console.log(respuesta);
        }
    })
    return todoMenus;
}

$(document).on("click", ".btnBsqPolDADR", async function () {
    var buttonPol = $(this).attr("buttonPol");
    document.getElementById("textParamBusqRet").value = buttonPol;
    $("#textParamBusqRet").trigger('change');
    $(".btnBuscaRetiro").click();
    $(this).removeClass("btn-outline-info");
    $(this).addClass("btn-secondary");
    $(this).attr("disabled", "disabled");
});
