$(document).on("change", "#calculoTxtNitSalida", function () {
    var txtNitSalida = $(this).val();
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
            } else {
                $("#txtNitSalida").attr("dataretiro", respuesta[0]["nt"]);
                document.getElementById("calculoTxtNombreSalida").value = respuesta[0].nombre;
                document.getElementById("calculoTxtDireccionSalida").value = respuesta[0].direccion;
                document.getElementById("hiddenIdNitSalida").value = respuesta[0].nt;
                document.getElementById("calculoPolizaRetiro").focus();
                $("#calculoTxtNitSalida").removeClass("is-invalid");
                $("#calculoTxtNombreSalida").removeClass("is-invalid");
                $("#calculoTxtDireccionSalida").removeClass("is-invalid");
                $("#calculoTxtNitSalida").addClass("is-valid");
                $("#calculoTxtNombreSalida").addClass("is-valid");
                $("#calculoTxtDireccionSalida").addClass("is-valid");
                $("#hiddenTxtNitSalida").val(1);
                $("#hiddenTxtNombreSalida").val(1);
                $("#hiddenTxtDireccionSalida").val(1);
            }
        },
        error: function (respuesta) {
            console.log(respuesta);
        }
    });

});

$(document).on("click", ".btnCalcularAlmacenaje", async function () {
    var hiddenTxtNitSalida = document.getElementById("hiddenTxtNitSalida").value;
    var hiddenTxtNitSalida = parseFloat(hiddenTxtNitSalida).toFixed(2);
    var hiddenTxtNitSalida = (hiddenTxtNitSalida * 1);
    var hiddenTxtNombreSalida = document.getElementById("hiddenTxtNombreSalida").value;
    var hiddenTxtNombreSalida = parseFloat(hiddenTxtNombreSalida).toFixed(2);
    var hiddenTxtNombreSalida = (hiddenTxtNombreSalida * 1);
    var hiddenTxtDireccionSalida = document.getElementById("hiddenTxtDireccionSalida").value;
    var hiddenTxtDireccionSalida = parseFloat(hiddenTxtDireccionSalida).toFixed(2);
    var hiddenTxtDireccionSalida = (hiddenTxtDireccionSalida * 1);
    var hiddenPolizaRetiro = document.getElementById("hiddenPolizaRetiro").value;
    var hiddenPolizaRetiro = parseFloat(hiddenPolizaRetiro).toFixed(2);
    var hiddenPolizaRetiro = (hiddenPolizaRetiro * 1);
    var hiddenRegimen = document.getElementById("hiddenRegimen").value;
    var hiddenRegimen = parseFloat(hiddenRegimen).toFixed(2);
    var hiddenRegimen = (hiddenRegimen * 1);
    var hiddenValorTAduana = document.getElementById("hiddenValorTAduana").value;
    var hiddenValorTAduana = parseFloat(hiddenValorTAduana).toFixed(2);
    var hiddenValorTAduana = (hiddenValorTAduana * 1);
    var hiddenCambio = document.getElementById("hiddenCambio").value;
    var hiddenCambio = parseFloat(hiddenCambio).toFixed(2);
    var hiddenCambio = (hiddenCambio * 1);
    var hiddenValorCif = document.getElementById("hiddenValorCif").value;
    var hiddenValorCif = parseFloat(hiddenValorCif).toFixed(2);
    var hiddenValorCif = (hiddenValorCif * 1);
    var hiddenValorImpuesto = document.getElementById("hiddenValorImpuesto").value;
    var hiddenValorImpuesto = parseFloat(hiddenValorImpuesto).toFixed(2);
    var hiddenValorImpuesto = (hiddenValorImpuesto * 1);
    var hiddenPesoKg = document.getElementById("hiddenPesoKg").value;
    var hiddenPesoKg = parseFloat(hiddenPesoKg).toFixed(2);
    var hiddenPesoKg = (hiddenPesoKg * 1);
    var hiddenCantBultos = document.getElementById("hiddenCantBultos").value;
    var hiddenCantBultos = parseFloat(hiddenCantBultos).toFixed(2);
    var hiddenCantBultos = (hiddenCantBultos * 1);
    var totalHidden = (hiddenTxtNitSalida + hiddenTxtNombreSalida + hiddenTxtDireccionSalida + hiddenPolizaRetiro + hiddenRegimen + hiddenValorTAduana + hiddenCambio + hiddenValorCif + hiddenValorImpuesto + hiddenPesoKg + hiddenCantBultos);
    if (totalHidden == 11) {
        var idCalculoAlmacenaje = document.getElementById("hiddeniddeingreso").value;
        if (idCalculoAlmacenaje == "") {
            Swal.fire(
                    'Poliza no seleccionada',
                    'No selecciono ninguna poliza de ingreso porfavor seleccione para poder, brindarle un calculo',
                    'error'
                    );
        } else if (!isNaN(idCalculoAlmacenaje)) {
            var hiddenEstadoCalculo = document.getElementById("hiddenEstadoCalculo").value
            var hiddenDateTime = document.getElementById("hiddenDateTime").value;
            var hiddenIdNitSalida = document.getElementById("hiddenIdNitSalida").value;
            var calculoTxtNitSalida = document.getElementById("calculoTxtNitSalida").value;
            var calculoTxtNombreSalida = document.getElementById("calculoTxtNombreSalida").value;
            var calculoTxtDireccionSalida = document.getElementById("calculoTxtDireccionSalida").value;
            var calculoPolizaRetiro = document.getElementById("calculoPolizaRetiro").value;
            var calculoRegimen = document.getElementById("calculoRegimen").value;
            var calculoValorTAduana = document.getElementById("calculoValorTAduana").value;
            var calculoCambio = document.getElementById("calculoCambio").value;
            var calculoValorCif = document.getElementById("calculoValorCif").value;
            var calculoValorImpuesto = document.getElementById("calculoValorImpuesto").value;
            var calculoPesoKg = document.getElementById("calculoPesoKg").value;
            var calculoCantBultos = document.getElementById("calculoCantBultos").value;
            var hiddenIdentificador = document.getElementById("hiddenIdentificador").value;
            var datos = new FormData();
            datos.append("idCalculoAlmacenaje", idCalculoAlmacenaje);
            datos.append("hiddenIdNitSalida", hiddenIdNitSalida);
            datos.append("calculoTxtNitSalida", calculoTxtNitSalida);
            datos.append("calculoTxtNombreSalida", calculoTxtNombreSalida);
            datos.append("calculoTxtDireccionSalida", calculoTxtDireccionSalida);
            datos.append("calculoPolizaRetiro", calculoPolizaRetiro);
            datos.append("calculoRegimen", calculoRegimen);
            datos.append("calculoValorTAduana", calculoValorTAduana);
            datos.append("calculoCambio", calculoCambio);
            datos.append("calculoValorCif", calculoValorCif);
            datos.append("calculoValorImpuesto", calculoValorImpuesto);
            datos.append("calculoPesoKg", calculoPesoKg);
            datos.append("calculoCantBultos", calculoCantBultos);
            datos.append("hiddenDateTime", hiddenDateTime);
            datos.append("hiddenIdentificador", hiddenIdentificador);
            datos.append("hiddenEstadoCalculo", hiddenEstadoCalculo);
            $.ajax({
                async: false,
                url: "ajax/calculoDeAlmacenaje.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (respuesta) {
                    console.log(respuesta);
                    
                    if (respuesta.tipoOPCalc == "OkModificcion") {
                        var mensaje = "Almacenaje recalculado";
                        var tipo = "warning";
                        alertaToast(mensaje, tipo);
                    } else if (respuesta.tipoOPCalc == "OkNuevo") {
                        var mensaje = "El calculo con los campos digitados, se guardo correctamente, si existe un dato erroneo unicamente coloque el dato correcto donde corresponda y recalcule..";
                        var tipo = "info";
                        alertaToast(mensaje, tipo);
                    }
                    if (respuesta !== "SD") {
                        var nit = respuesta["datosCalculo"]["respuestaData"].nit;
                        var empresa = respuesta["datosCalculo"]["respuestaData"].empresa;
                        var polizaIng = respuesta["datosCalculo"]["respuestaData"].polizaIng;
                        var fechaIng = respuesta["datosCalculo"]["respuestaData"].fechaIng;
                        var tiempo = respuesta["datosCalculo"]["respuestaData"].tiempo;
                        var ZonaAdCalculo = respuesta["datosCalculo"]["datos"].zonaAduanMSuperior;
                        var AlmNormalCalculo = respuesta["datosCalculo"]["datos"].almaMSuperior;
                        var calcmanejoCalculo = respuesta["datosCalculo"]["datos"].calculoManejo;
                        var calcGstAdminCalculo = respuesta["datosCalculo"]["datos"].gtoAdminMSuperior;
                        var fechaRetiro = respuesta["datosCalculo"]["respuestaData"].fechaRetiro;
                        var total = respuesta["datosCalculo"]["datos"].cobrar;

                        document.getElementById("hiddenZonaAduana").value = respuesta["datosCalculo"]["datos"].zonaAduanMSuperior;
                        document.getElementById("hiddenAlmacenaje").value = respuesta["datosCalculo"]["datos"].almaMSuperior;
                        document.getElementById("hiddenManejo").value = respuesta["datosCalculo"]["datos"].calculoManejo;
                        document.getElementById("hiddenGstosAdmin").value = respuesta["datosCalculo"]["datos"].gtoAdminMSuperior;

                        //   document.getElementById("hiddenresultIdIngreso").value = idIngresoCal;


                        if (respuesta["datosCalculo"]["mensaje"] == 1) {
                            var mensaje = '<div class="alert alert-warning mt-4" role="alert">Se genero el calculo con tarifa general, sin embargo <strong>tiene asignación pendiente de tarifa especial </strong>por el ejecutivo de ventas, comuniquese y consulte con el departamento de ventas o bien consulte con su superior.</div>'
                        } else {
                            var mensaje = '';
                        }

                        var TotalDescuento = "";
                        if (respuesta.descuentoCalc != 0) {
                            var desc = respuesta.descuentoCalc[0].descuento;
                            if (respuesta.descuentoCalc[0].tipoOp == 0) {
                                var TotalDescuento = `<tr>
<th>Total Descuentos :</th>
<td id="thDescuento" style="color:red;">(` + desc + `)</td>
</tr>  `;


                            }
                            if (respuesta.descuentoCalc[0].tipoOp == 1) {
                                var TotalDescuento = `<tr>
<th>Total Descuentos :</th>
<td id="thDescuento" style="color:red;">(` + desc + `)</td>
</tr>  `
                            }

          
                        }



                        $(".divCalculoDetalle").attr("style", "display:block;");
                        document.getElementById("divCalculoDetalle").innerHTML = `
                        
                        <div class="row">

                                                    <div class="col-7 mt-4">
                                                    <p><div id="divAlerta"></div></p>
                                                    <p class="lead">Detalle de calculo de almacenaje <br>
                                                            Nit :  ` + nit + `<br>
                                                            Empresa: ` + empresa + `<br>
                                                            Poliza ingreso: ` + polizaIng + `&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Poliza retiro : ` + calculoPolizaRetiro + `<br>
                                                            <b style="color: #1E66BD;">Fecha ingreso : ` + fechaIng + ` &nbsp;&nbsp;&nbsp;&nbsp;Calculo hasta :  ` + fechaRetiro + `&nbsp;&nbsp; ` + tiempo + `&nbsp;dias</b>
                                                        </p>
                                                        <p>
                                                        <div class="btn-group">
                                                        <button type="button" class="btn btn-outline-dark"  data-toggle="modal" data-target="#plusOtrosServicios">Otros : <span class="badge badge-primary" style="font-size: 15px;"><b>Q&nbsp;&nbsp;</b><b id="spanOtro"></b></span></button>
                                                        <button type="button" class="btn btn-outline-dark"  data-toggle="modal" data-target="#plusServiciosDefalult">Servicios : <span class="badge badge-primary" style="font-size: 15px;"><b>Q&nbsp;&nbsp;</b><b id="spanServicios"></b></span></button>
                                                        <button type="button" class="btn btn-outline-dark btnDescuento">Descuentos : <span class="badge badge-primary" style="font-size: 15px;"><b>Q&nbsp;&nbsp;</b><b id="spanDescuentos"></b></span></button>
                                                        <button type="button" class="btn btn-outline-danger">Total : <span class="badge badge-primary" style="font-size: 15px;"><b>Q&nbsp;&nbsp;</b><b id="spanTotalC"></b></span></button>
                                                    </div>
                                                        
                                                        </p>
                                                        <p>` + mensaje + `</p>
                                                    </div>
                                                    <div class="col-5 mt-4">
                                                        <div class="table-responsive">
                                                            <table class="table">
                                                                <tbody><tr>
                                                                    <th style="width:50%">Zona aduanera:</th>
                                                                    <td id="ZonaAdCalculo">` + ZonaAdCalculo + `</td>
                                                                    </tr>
                                                                    <tr>
                                                                    <th>Almacenaje:</th>
                                                                    <td id="AlmNormalCalculo">` + AlmNormalCalculo + `</td>
                                                                    </tr>
                                                                    <tr>
                                                                    <th>Manejo:</th>
                                                                    <td id="calcmanejoCalculo">` + calcmanejoCalculo + `</td>
                                                                    </tr>
                                                                    <tr>
                                                                    <th>Gastos administrativos:</th>
                                                                    <td id="calcGstAdminCalculo">` + calcGstAdminCalculo + `</td>
                                                                    </tr>
                                                                    <tr>
                                                                    <th>Otros gastos:</th>
                                                                    <td id="detalleOtros"></td>
                                                                    </tr>
                                                                    <tr>
                                                                    <th>Alteración de servicios :</th>
                                                                    <td id="thAlteracion"></td>
                                                                    </tr>
                                                                    ` + TotalDescuento + `
                                                                    <tr>
                                                                    <th style="color:red;">Total calculado:</th>
                                                                    <td style="color:red;"><strong id="totaTh">` + total + `</strong></"td>
                                                                    </tr>
                                                                </tbody></table>
                                                        </div>
                                                    </div>
                        <div class="col-12 mt-4" id="divBtnOtros">
                        <div class="card-footer">
                        <button type="button" class="btn btn-primary btn-block btnGdOtrosSer" estado="0">Guardar Otros Servicios Prestados</button
                    </div>
                        </div>
                        </div>
        `;
                    }


                    formatNumber("ZonaAdCalculo");
                    formatNumber("AlmNormalCalculo");
                    formatNumber("calcmanejoCalculo");
                    formatNumber("calcGstAdminCalculo");
                    formatNumber("detalleOtrosCalculo");
                    formatNumber("totalCobrarCalc");

                    if (respuesta.descuentoCalc != 0 || respuesta.servPrestados.length >= 1) {
                        document.getElementById("divBtnOtros").innerHTML = `
                        <div class="card-footer">
                        <button type="button" class="btn btn-warning btn-block btnGdOtrosSer" estado="1">Editar Rubros / Agregar Nuevos Rubros</button
                    </div>`;

                    }
                    if (respuesta.descuentoCalc != 0) {
                        var desc = respuesta.descuentoCalc[0].descuento;
                        if (respuesta.descuentoCalc[0].tipoOp == 0) {
                            document.getElementById("hiddenTipoOP").value = 0;
                            document.getElementById("hiddenDescuento").value = respuesta.descuentoCalc[0].descuentoPercent;
                            document.getElementById("valDescuento").value = desc;
                            document.getElementById("spanDescuentos").innerHTML = desc;

                            document.getElementById("divAlerta").innerHTML = `
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                             <strong style="color: white;">¡Esta autorizando un descuento!</strong> del ` + respuesta.descuentoCalc[0].descuentoPercent + `% / monto  Q ` + desc + `
                             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                             </button>
                           </div>`;

                            totalCobrar();
                        }
                        if (respuesta.descuentoCalc[0].tipoOp == 1) {
                            document.getElementById("hiddenTipoOP").value = 1;
                            document.getElementById("hiddenDescuento").value = respuesta.descuentoCalc[0].descuentoPercent;
                            document.getElementById("valDescuento").value = desc;
                            document.getElementById("spanDescuentos").innerHTML = desc;
                            document.getElementById("divAlerta").innerHTML = `
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                             <strong style="color: white;">¡Esta autorizando un descuento!</strong> del ` + respuesta.descuentoCalc[0].descuentoPercent + `% / monto  Q ` + desc + `
                             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                             </button>
                           </div>`;

                            totalCobrar();
                        }
                        var totalOtros = 0;
                        var serviciosExtras = 0;
                        var montoDefault = 0;
                        if ($("#montoOtroServicio").lista >= 1) {


                            document.getElementById("montoOtroServicio").innerHTML = "";
                            document.getElementById("montoOtroServicioDefault").innerHTML = "";
                            document.getElementById("divOtrosServicios").innerHTML = "";
                            document.getElementById("divServiciosDefault").innerHTML = "";
                        }
                        if (respuesta.servPrestados.length >= 1) {
                            for (var i = 0; i < respuesta.servPrestados.length; i++) {
                                var selectOtrosServ = respuesta.servPrestados[i].id;
                                var selected = respuesta.servPrestados[i].otrosServicios;
                                var montoOtroServicio = respuesta.servPrestados[i].montoServicio;
                                var idServicioSer = respuesta.servPrestados[i].idServicio;
                                if (respuesta.servPrestados[i].tipo == 0) {
                                    var serviciosExtras = serviciosExtras + respuesta.servPrestados[i].montoServicio;
                                    $("#divOtrosServicios").append('<div id="divNumero" class="col-12"><div class="input-group mb-3"> <div class="input-group-prepend"><button type="button" class="btn btn-danger btnEliminarOtroServ" id="valueCombo' + idServicioSer + '" idValue="' + idServicioSer + '"><i class="fa fa-trash"></i></button></div><input type="text" class="form-control" readOnly="readOnly" value="' + selected + '" /><input type="number"  class="form-control textOtros" id="montoServicioText' + idServicioSer + '" value="' + montoOtroServicio + '" /></div></div>');
                                }
                                if (respuesta.servPrestados[i].tipo == 1) {
                                    var selectedServicioDefault = respuesta.servPrestados[i].servicioDefault;

                                    $("#divServiciosDefault").append('<div id="divNumeroDefatult" class="col-12"><div class="input-group mb-3"> <div class="input-group-prepend"><button type="button" class="btn btn-danger btnEliminarServDefault" id="valueComboDefault' + idServicioSer + '" idValue="' + idServicioSer + '"><i class="fa fa-trash"></i></button></div><input type="text" class="form-control textPlusServicios" readOnly="readOnly" value="' + selectedServicioDefault + '" /><input type="number"  class="form-control textDefaultSer" id="montoSerDefaultText' + idServicioSer + '" value="' + montoOtroServicio + '" /></div></div>');
                                    var montoDefault = montoDefault + respuesta.servPrestados[i].montoServicio;
                                }
                            }
                            document.getElementById("spanServicios").innerHTML = montoDefault;
                            document.getElementById("spanOtro").innerHTML = serviciosExtras;
                            document.getElementById("thAlteracion").innerHTML = montoDefault;
                            document.getElementById("detalleOtros").innerHTML = serviciosExtras;
                            document.getElementById("hiddenOtros").value = serviciosExtras;
                            document.getElementById("serviciosDefTotal").value = montoDefault;

                        }
                    }
                    totalCobrar();
                }, error: function (respuesta) {
                    console.log(respuesta);
                }
            });
        } else if (isNaN(idCalculoAlmacenaje)) {
            Swal.fire(
                    'Poliza no seleccionada',
                    'No selecciono ninguna poliza de ingreso porfavor seleccione para poder, brindarle un calculo',
                    'error'
                    );
        }
    } else if (totalHidden <= 10) {
        Swal.fire(
                'Formulario invalido',
                'Existe un campo, con datos no adminitidos, busque los campos marcados con color rojo y corrijalo para continuar..',
                'error'
                );
    }
});


$(document).on("change", "#calculoTextParamBusqRet", function () {
    var calculoTextParamBusqRet = $(this).val();

    document.getElementById("dataRetiro").innerHTML = "";
    document.getElementById("dataRetiro").innerHTML = '<table id="tableClientesEditar" class="table table-hover table-sm"></table><input type="hidden" id="hiddenListaDeta" value="">';
    var datos = new FormData();
    datos.append("calculoTextParamBusqRet", calculoTextParamBusqRet);
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
            if (respuesta == "SD") {
                Swal.fire(
                        'Registro no existe',
                        'Busqueda sin considencia',
                        'error'
                        );
            } else {
                if (respuesta["resp"] == "VNT" || respuesta["resp"] == "VNST") {
                    if (respuesta["resp"] == "VNT") {
                        Swal.fire(
                                'Calculo no autorizado',
                                'No puede dar calculo de almacenaje de esta póliza, comuniquese jefe inmediato',
                                'warning'
                                );
                    }
                    if (respuesta["resp"] == "VNST") {
                        Swal.fire(
                                'Calculo no autorizado',
                                'No puede dar calculo de almacenaje de esta póliza, comuniquese jefe inmediato / cliente sin tarifa de vehículo',
                                'error'
                                );
                    }

                } else {



                    if (respuesta["resp"] == "TN") {
                        var lista = [];
                        var contador = 1;
                        for (var i = 0; i < respuesta["bloque"].length; i++) {
                            var datPoliza = respuesta["bloque"][i].Poliza;
                            var datconsolidado = respuesta["bloque"][i].Empresa;
                            var datblts = respuesta["bloque"][i].blts;
                            var datdimPeso = respuesta["bloque"][i].pesokg + " kg";
                            var acciones = '<div class="btn-group">' + '<button type="button" class="btn btn-primary btnListaSelect" idIngSelectDetOpe=' + respuesta["bloque"][i]["idIng"] + ' id="select' + [i] + '" empresa="' + datconsolidado + '" poliza="' + datPoliza + '" numeroButt=' + [i] + ' idDeBodega=' + respuesta["bloque"][i].idIng + '  id="buttonDetalleRet">Seleccionar</button></div>';
                            lista.push([datPoliza, datconsolidado, datblts, datdimPeso, acciones]);
                        }
                        $('#tableClientesEditar').DataTable({
                            "language": {
                                "sProcessing": "Procesando..",
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
                                "sLoadingRecords": "Cargando..",
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
                                    title: "nombreEmpresa"
                                }, {
                                    title: "cantBultos"
                                }, {
                                    title: "cantPeso"
                                }, {
                                    title: "accion"
                                }]
                        });
                    } else if (respuesta["resp"] == "TE") {
                        Swal.fire({
                            title: 'Dato buscado ' + calculoTextParamBusqRet,
                            text: "Cliente con tarifa especial,  ¿Esta seguro que el dato buscado es correcto?",
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            cancelButtonText: 'No, Cancelar',
                            confirmButtonText: 'Si, Continuar'
                        }).then((result) => {
                            if (result.value) {
                                window.location = "calcAlmacenajeF";
                            } else {
                                window.location = "calculosDeAlmacenaje";
                            }
                        })
                    } else if (respuesta["resp"] == "TP") {
                    }
                }
            }
        }, error: function (respuesta) {
            console.log(respuesta);
        }
    });
});

$(document).on("change", "#calculoPolizaRetiro", async function () {
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
});

function revisionPolRet(nomVar, dato) {
    let respFunc;
    var datos = new FormData();
    datos.append(nomVar, dato);
    $.ajax({
        async: false,
        url: "ajax/calculoDeAlmacenaje.ajax.php",
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


$(document).on("change", "#calculoRegimen", function () {
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

$(document).on("change", "#calculoValorTAduana", function () {
    var dato = $(this).val();
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
            if ($("#calculoCambio").val() >= 0.001) {
                var valCalculo = $("#calculoCambio").val();
                var conversion = parseFloat(dato * valCalculo).toFixed(2);
                document.getElementById("calculoValorCif").value = conversion;
                document.getElementById("calculoValorCif").readOnly = true;
                document.getElementById("hiddenValorCif").value = 1;
                document.getElementById("calculoValorImpuesto").focus();
                $("#calculoValorCif").removeClass('is-invalid');
                $("#calculoValorCif").addClass('is-valid');


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

$(document).on("change", "#calculoCambio", function () {
    var dato = $(this).val();
    console.log(dato);
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

        if ($("#calculoValorTAduana").val() >= 0.001) {
            var valCalculo = $("#calculoValorTAduana").val();
            var conversion = parseFloat(dato * valCalculo).toFixed(2);
            document.getElementById("calculoValorCif").value = conversion;
            document.getElementById("calculoValorCif").readOnly = true;
            document.getElementById("hiddenValorCif").value = 1;
            $("#calculoValorCif").removeClass('is-invalid');
            $("#calculoValorCif").addClass('is-valid');
            $("#calculoValorCif").attr('readOnly', true);
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

$(document).on("change", "#calculoValorCif", function () {
    var dato = $(this).val();
    console.log(dato);
    if (dato == "") {
        var mensaje = "Este campo es obligatorio";
        var tipo = "error";
        alertaToast(mensaje, tipo);
        $(this).removeClass("is-valid");
        $(this).addClass("is-invalid");
        $("#hiddenValorCif").val(0);
    } else if (!isNaN(dato)) {
        $(this).removeClass("is-invalid");
        $(this).addClass("is-valid");
        $("#hiddenValorCif").val(1);
    } else if (isNaN(dato)) {
        var mensaje = "Este campo es obligatorio";
        var tipo = "error";
        alertaToast(mensaje, tipo);
        $(this).removeClass("is-valid");
        $(this).addClass("is-invalid");
        $("#hiddenValorCif").val(0);
    }
});

$(document).on("change", "#calculoValorImpuesto", function () {
    var dato = $(this).val();
    console.log(dato);
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

$(document).on("change", "#calculoPesoKg", function () {
    var dato = $(this).val();
    console.log(dato);
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

$(document).on("change", "#calculoCantBultos", function () {
    var dato = $(this).val();
    console.log(dato);
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

$(document).on("click", ".btnGdOtrosSer", async function () {
    var btnAction = $(this);
    var estado = btnAction.attr("estado");

    var paragraphs = Array.from(document.querySelectorAll(".btnEliminarOtroServ"));
listaOtros = [];
listaServiciosDefault = [];
    if (paragraphs.length == 0) {
        var otrosValores = 0;
    } else {

        for (var i = 0; i < paragraphs.length; i++) {
            console.log(paragraphs[i].attributes.idvalue.nodeValue);
            var servicioOtro = paragraphs[i].attributes.idvalue.nodeValue;
            var valOtro = document.getElementById("montoServicioText" + servicioOtro).value;
            listaOtros.push({
                "serviciosOtros": servicioOtro,
                "valorOtros": valOtro
            });
        }
    }
    var paragraphs = Array.from(document.querySelectorAll(".btnEliminarServDefault"));
    console.log(paragraphs);
    if (paragraphs.length == 0) {
        console.log("no hay");
        var valServicio = 0.00;
    } else {

        for (var i = 0; i < paragraphs.length; i++) {
            console.log(paragraphs[i].attributes);
            var servicioDef = paragraphs[i].attributes.idvalue.textContent;
            console.log(servicioDef);
            var valServicios = document.getElementById("montoSerDefaultText" + servicioDef).value;
            listaServiciosDefault.push({
                "serviciosDefault": servicioDef,
                "valServicios": valServicios
            });
        }
    }
    //Descuento 
    var valDescuento = document.getElementById("valDescuento").value;
    var hiddenDescuento = document.getElementById("hiddenDescuento").value;
    var hiddenTipoOP = document.getElementById("hiddenTipoOP").value;
    //Total a cobrar 
    var hiddenTotalCobrar = document.getElementById("hiddenTotalCobrar").value;
    // Valor calculado 
    var valCalculado = await totalCalculado();
    var calculoPolizaRetiro = document.getElementById("calculoPolizaRetiro").value;
    if (listaOtros.length>=1) {
            listaOtrosJSON = JSON.stringify(listaOtros);
    }else{
        listaOtrosJSON = [];
    }
    if (listaServiciosDefault.length>=1) {
           listaServiciosDefaultJSON = JSON.stringify(listaServiciosDefault); 
    }else{
        listaServiciosDefaultJSON = [];
    }
    if (listaOtros.length >= 1 || listaServiciosDefault.length >= 1 || valDescuento > 0) {
        var gdServiciosExtra = await guardarDataRubrosExtras(listaOtrosJSON, listaServiciosDefaultJSON, hiddenDescuento, valDescuento, calculoPolizaRetiro, hiddenTipoOP);
        if (gdServiciosExtra) {
            if (estado == 0) {
                btnAction.removeClass("btn-primary");
                btnAction.addClass("btn-warning");

                btnAction.html("Editar Rubros / Agregar Nuevos Rubros");

                Swal.fire(
                        'Transacción Satisfactoria',
                        'Se guardaron con exito los rubros extras en el calculo para posterior cobro',
                        'success'
                        );
            } else {
                Swal.fire(
                        'Transacción Satisfactoria',
                        'Edito y/o Agrego Nuevos Rubros al Calculo',
                        'success'
                        );

            }
        }
    }else{
    swal("Sin Selección", "Servicios Extras no seleccionados revise!", "error");
    }

});

function guardarDataRubrosExtras(listaOtrosJSON, listaServiciosDefaultJSON, hiddenDescuento, valDescuento, calculoPolizaRetiro, hiddenTipoOP) {
    let respFunc;
    var datos = new FormData();
    datos.append("otrosExtra", listaOtrosJSON);
    datos.append("listaDefaultExtra", listaServiciosDefaultJSON);
    datos.append("hiddenDescuento", hiddenDescuento);
    datos.append("polizaExtraSer", calculoPolizaRetiro);
    datos.append("valCalculado", valDescuento);
    datos.append("hiddenTipoOP", hiddenTipoOP);
    $.ajax({
        async: false,
        url: "ajax/calculoDeAlmacenaje.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            respFunc = respuesta;
            console.log(respuesta);
        }, error: function (respuesta) {
            console.log(respuesta);
        }
    })
    return respFunc;
}