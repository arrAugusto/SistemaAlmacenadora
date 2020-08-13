$(document).on("click", ".btnBuscaRetiro", function () {
    document.getElementById("dataRetiro").innerHTML = "";
    document.getElementById("dataRetiro").innerHTML = '<table id="tablaMerRetiro" class="table table-hover"></table><input type="hidden" id="hiddenListaDeta" value="">';
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
                        var acciones = '<div class="btn-group">' + '<button type="button" class="btn btn-primary btnListaSelect" id="buttonDisparoDetalle" idIngSelectDetOpe=' + respuesta[i]["idIng"] + ' id="select' + [i] + '" empresa="' + datconsolidado + '" poliza="' + datPoliza + '" numeroButt=' + [i] + ' idDeBodega=' + respuesta[i].idIng + '  id="buttonDetalleRet">Seleccionar</button></div>';
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
                    document.getElementById("txtNombreSalida").value = respuesta[0].nombre;
                    document.getElementById("txtDireccionSalida").value = respuesta[0].direccion;
                    document.getElementById("polizaRetiro").focus();
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
    document.getElementById("hiddenIdentificador").value = idIngOpDet;
    document.getElementById("hiddeniddeingreso").value = idIngOpDet;
    if ($("#idChasAnt").length >= 1) {
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
        if ($("#hiddenGdVehMerc").length >= 1) {
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
                    if (servicio.respTipo == "vehUs"){
                        document.getElementById("divDataPiloto").innerHTML = '';
                        document.getElementById("divDataLic").innerHTML = '';
            
                        document.getElementById("divPlaca").innerHTML = '';
                        document.getElementById("divCont").innerHTML = '';
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
                                    lista = [];
                                    for (var i = 0; i < respuesta["respuestaDetalle"].length; i++) {
                                        var empresa = respuesta["respuestaDetalle"][i].empresa;
                                        var descripcion = respuesta["respuestaDetalle"][i].descripcionMercaderia;
                                        var bultos = respuesta["respuestaDetalle"][i].bultos;
                                        var peso = respuesta["respuestaDetalle"][i].peso + ' kg';
                                        var accion = '<div class="input-group input-group-sm"><input type="text" class="form-control" id="textDetalle' + respuesta["respuestaDetalle"][i].identificadorDet + '" value=""/><span class="input-group-append"><button type="button" class="btn btn-info btn-flat btnAceptaDetalle" id="btnAceptarDet' + respuesta["respuestaDetalle"][i].identificadorDet + '" idDetalle=' + respuesta["respuestaDetalle"][i].identificadorDet + '  idIngSelectDet=' + respuesta["respuestaDetalle"][i].identificadorIng + '>Ok!</button></span></div>';
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
                                    ;
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
                if ($("#divVehRegresion").length >= 1) {
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
$(document).on("click", ".btnGuardarRetiro", async function () {
    var tipoIng = document.getElementById("hiddenGdVehMerc").value;
    var numPolizaRev = $("#polizaRetiro").val();
    var revPoliza = await revPolizasIngreso(numPolizaRev);
    if (revPoliza == "Duplicada") {
        Swal.fire('Poliza ya existe', 'La poliza declarada actualmente ya se encuentra gestionada en sistema.', 'error');
        $("#polizaRetiro").removeClass("is-valid");
        $("#polizaRetiro").addClass("is-invalid");
    } else {
        var validarForm = await validarFormRet();
        if (validarForm) {
            var estado = 0;
            if (tipoIng == "vehM" || tipoIng == "vehUs") {
                var paragraphsButton = Array.from(document.querySelectorAll("#buttonTrash"));
                var paragraphsCantidades = Array.from(document.querySelectorAll("#texToBultosVal"));
                listaIdButton = [];
                for (var i = 0; i < paragraphsButton.length; i++) {
                    var estadoDet = 1;
                    idButton = paragraphsButton[i].attributes.numorigen.textContent;
                    cantBultos = paragraphsCantidades[i].value;
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
            if (estado >= 1 && estado == 1) {
                alert("no selecciono ningun cliente");
            } else if (estado == 0 || estado == 2) {
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
                    if (tipoIng == "vehM" || tipoIng == "vehUs") {
                        console.log("521");
                        if (tipoIng == "vehUs"){
                            var placa = "";
                            var contenedor = "";
    
                        }else{
                            
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
                    if (tipoIng == "vehUs"){
                        var licencia = "";
                        var piloto = "";
                        var hiddenIdentificador = "";
                        var hiddenDateTime = "";
    
                    }else{
                        var licencia = document.getElementById("numeroLicencia").value;
                        var piloto = document.getElementById("nombrePiloto").value;
                        var hiddenIdentificador = document.getElementById("hiddenIdentificador").value;
                        var hiddenDateTime = document.getElementById("hiddenDateTime").value;
                            
                    }
                    if (totalBultos == cantBultos) {
                        if (tipoIng == "vehM" || tipoIng == "vehUs")  {
                            var guardarRetMerca = await guardarRetiroMercaderia(
                                    listaDetalles, hiddeniddeingreso, hiddenIdUs, idNit, polizaRetiro, regimen, tipoCambio,
                                    valorTotalAduana, valorCif, calculoValorImpuesto, pesoKg, placa, contenedor, licencia, piloto,
                                    hiddenIdBod, cantBultos, hiddenIdentificador, hiddenDateTime, descMercaderia, tipoIng);
                        } else {
                            console.log("data522 es vehiculo");

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
                    console.log("error 404");
                }
            }
        } else {
            Swal.fire('Error de formulario', 'El formulario declarado es incorrecto revise', 'error');
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
        hiddenIdBod, cantBultos, hiddenIdentificador, hiddenDateTime, descMercaderia, tipoIng) {
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
            if (respuesta["exito"] == "exito") {
                var tipo = 0;
                desbloqueBloque(tipo);
                Swal.fire('Guardado exitosamente', 'El retiro fue guardado con exito', 'success');
                document.getElementById("divBottoneraAccion").innerHTML = `
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-warning btnEditarRetiro" id="editRetiroF" estado=0 idRetiroBtn= ` + respuesta["valIdRetiro"] + `>Editar&nbsp;&nbsp;&nbsp;<i class="fa fa-edit" style="font-size:20px" aria-hidden="true"></i></button>
         <button type="button" class="btn btn-info btnMasPilotos" id="idbtnMasPilotos" estado=0 idMasPilotos= ` + respuesta["valIdRetiro"] + `  data-toggle="modal" data-target="#plusPilotos">Nueva Unidad&nbsp;&nbsp;&nbsp;<i class="fa fa-plus" style="font-size:20px" aria-hidden="true"></i></button>
                                                              
     </div>`;
            }
        },
        error: function (respuesta) {
            console.log(respuesta);
        }
    });
    return respuestaFun;
}

$(document).on("click", ".btnAceptaDetalle", function () {
    var idIngOpDet = $(this).attr("idIngSelectdet");
    console.log(idIngOpDet);
    var idDetalle = $(this).attr("idDetalle");
    var valTextDet = document.getElementById("textDetalle" + idDetalle).value;
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
                    document.getElementById("btnAceptarDet" + idDetalle).disabled = true;
                    document.getElementById("textDetalle" + idDetalle).readOnly = true;
                    document.getElementById("divListaDetalles").innerHTML += `<div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <button type="button" class="btn btn-danger" id="buttonTrash" numOrigen=` + idDetalle + `><i class="fa fa-trash"></i></button>
                          <button type="button" class="btn btn-success" id="buttonStock">` + respuesta[0].stock + `</button>
                  </div>
                  <!-- /btn-group -->
                  <input type="text" class="form-control" id="texToEmpresaVal" value="` + respuesta[0].empresa + `" readOnly="readOnly" />
                  <input type="numeric" class="form-control" id="texToBultosVal" value="` + valTextDet + `" />
                </div>`;
                }
            }
        },
        error: function (respuesta) {
            console.log(respuesta);
        }
    })
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
        if (valorTAduana >= 0.001) {
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
        if (cambio >= 0.001) {
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
        if (valorCif >= 0.001) {
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
        if (calculoValorImpuesto >= 0.001) {
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
        if (pesoKg >= 0.001) {
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
        if (cantBultos >= 1) {
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

        if ($("#numeroPlaca").length >= 1) {
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
        if ($("#contenedor").length >= 1) {
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
    document.getElementById("numeroLicencia").readOnly = false;
    document.getElementById("nombrePiloto").readOnly = false;
    if ($("#numeroPlaca").length >= 1) {
        document.getElementById("numeroPlaca").readOnly = false;
    }
    if ($("#contenedor").length >= 1) {
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
            console.log("hola mundo");
            var tipoEdicion = "Merca";
            var dataEdit = await editarRetiroOpFis(idRetiroBtn);
            console.log(dataEdit);
        }
    }
})

async function editarRetiroOpFis(idRetiroBtn) {
    let todoMenus;
    console.log(idRetiroBtn);
    var tipoIng = document.getElementById("hiddenGdVehMerc").value;
    if (tipoIng == "vehM" || tipoIng == "vehUs") {


        var paragraphsButton = Array.from(document.querySelectorAll("#buttonTrash"));
        var paragraphsCantidades = Array.from(document.querySelectorAll("#texToBultosVal"));
        console.log(paragraphsCantidades);
        listaIdButton = [];
        for (var i = 0; i < paragraphsButton.length; i++) {
            var estadoDet = 0;
            idButton = paragraphsButton[i].attributes.numorigen.textContent;
            cantBultos = paragraphsCantidades[i].value;
            console.log(cantBultos);
            listaIdButton.push({
                "idDetalles": idButton,
                "cantBultos": cantBultos,
                "estadoDet": estadoDet
            });
        }

        if (listaIdButton.length == 0) {
            alert("no selecciono ningun cliente");
        } else if (listaIdButton.length >= 1) {
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
        if ($("#numeroPlaca").length >= 1) {
            var placa = document.getElementById("numeroPlaca").value;
        }
        if ($("#contenedor").length >= 1) {
            var contenedor = document.getElementById("contenedor").value;
        }

        var licencia = document.getElementById("numeroLicencia").value;
        var piloto = document.getElementById("nombrePiloto").value;
        var hiddenIdentificador = document.getElementById("hiddenIdentificador").value;
        var hiddenDateTime = document.getElementById("hiddenDateTime").value;


        console.log(totalBultos);
        if (totalBultos == cantBultos) {
            if (tipoIng == "vehM" || tipoIng == "vehUs") {
                var funcEditRetMerca = await funcEditRetMerca(idRetiroBtn, listaDetalles, hiddeniddeingreso, hiddenIdUs, idNit, polizaRetiro,
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
        document.getElementById("numeroLicencia").readOnly = true;
        document.getElementById("nombrePiloto").readOnly = true;
        document.getElementById("numeroPlaca").readOnly = true;
        document.getElementById("contenedor").readOnly = true;

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
        document.getElementById("numeroLicencia").readOnly = true;
        document.getElementById("nombrePiloto").readOnly = true;
        document.getElementById("numeroPlaca").readOnly = true;
        document.getElementById("contenedor").readOnly = true;
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
        if ($("#hiddenRegimenExiste").length >= 1 && $("#hiddenRegimenExiste").val() != dato) {
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
        if ($("#hiddenValorTAduanaExiste").length >= 1 && $("#hiddenValorTAduanaExiste").val() != dato) {
            $("#spanCalculoValorTAduana").attr("style", "display: block;");
            $(this).removeClass("is-valid");
            $(this).addClass("is-invalid");
            document.getElementById("spanCalculoValorTAduana").innerHTML = 'Dato Guardado: ' + $("#hiddenValorTAduanaExiste").val();
        } else {
            $("#spanCalculoValorTAduana").attr("style", "display: none;");
            document.getElementById("spanCalculoValorTAduana").innerHTML = '';
            $(this).removeClass("is-invalid");
            $(this).addClass("is-valid");
            if ($("#cambio").val() >= 0.001) {
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
        if ($("#hiddenCambioExiste").length >= 1 && $("#hiddenCambioExiste").val() != dato) {
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

        if ($("#valorTAduana").val() >= 0.001) {
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
        if ($("#hiddenValorImpuestoExiste").length >= 1 && $("#hiddenValorImpuestoExiste").val() != dato) {
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
        if ($("#hiddenPesoKgExiste").length >= 1 && $("#hiddenPesoKgExiste").val() != dato) {
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


        if ($("#hiddenCantBultosExiste").length >= 1 && $("#hiddenCantBultosExiste").val() != dato) {
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
    var respTodosPlt = await editarPiloto(nomVar, idMasPilotos);
    console.log(respTodosPlt);
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

});



$(document).on("click", ".btnEditarUnidadPlus", async function () {
    var idUnidadEdit = $(this).attr("idDatoPlto");
    var numeroLicenciaPlus = document.getElementById("numeroLicenciaPlus").value;
    var nombrePilotoPlusUn = document.getElementById("nombrePilotoPlusUn").value;
    var numeroPlacaPlusUn = document.getElementById("numeroPlacaPlusUn").value;
    var numeroContenedorPlusUn = document.getElementById("numeroContenedorPlusUn").value;

    if ($("#txtNitSalida").length >= 1) {
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

