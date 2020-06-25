$(document).on("click", ".btnVerCalculo", async function () {
    var idCalculo = $(this).attr("idcalculo");
    var nomVar = "viewCalculo";
    var idIng = $(this).attr("idIng");
    var nomVarD = "viewIng";
    var calculoPolizaRetiro = $(this).attr("polizaSal");
    var respCalc = await funcionesHistorialCalculo(nomVar, idCalculo, nomVarD, idIng, calculoPolizaRetiro);
    if (respCalc) {
        $(".btnRecalculaHistoria").attr("idCalculo", idCalculo);
        $(".btnRecalculaHistoria").attr("iding", idIng);
        $(".btnRecalculaHistoria").attr("polizaSal", calculoPolizaRetiro);
    }
});
function funcionesHistorialCalculo(nomVar, idCalculo, nomVarD, idIng, calculoPolizaRetiro) {
    let todoMenus;
    var datos = new FormData();
    datos.append(nomVar, idCalculo);
    datos.append(nomVarD, idIng);
    $.ajax({
        async: false,
        url: "ajax/historialCalculo.ajax.php",
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
                var mensaje = "El calculo con los campos digitados, se guardo correctamente, si existe un dato erroneo unicamente coloque el dato correcto donde corresponda y recalcule...";
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
                      
                                </div>
                                </div>

                        
                `;
            }
            document.getElementById("retRecalcRet").value = idCalculo;
            document.getElementById("retRecalcIng").value = idIng;
            document.getElementById("retPoliza").value = calculoPolizaRetiro;
            formatNumber("ZonaAdCalculo");
            formatNumber("AlmNormalCalculo");
            formatNumber("calcmanejoCalculo");
            formatNumber("calcGstAdminCalculo");
            formatNumber("detalleOtrosCalculo");
            formatNumber("totalCobrarCalc");
            var TotalDescuento = "";
            if (respuesta.descuentoCalc != 0) {
                var desc = respuesta.descuentoCalc[0].descuento;
                if (respuesta.descuentoCalc[0].tipoOp == 0) {
                    document.getElementById("hiddenTipoOP").value = 0;
                    document.getElementById("hiddenDescuento").value = respuesta.descuentoCalc[0].descuentoPercent;
                    document.getElementById("valDescuento").value = desc;
                    document.getElementById("spanDescuentos").innerHTML = desc;
                }
                if (respuesta.descuentoCalc[0].tipoOp == 1) {
                    document.getElementById("hiddenTipoOP").value = 1;
                    document.getElementById("hiddenDescuento").value = respuesta.descuentoCalc[0].descuentoPercent;
                    document.getElementById("valDescuento").value = desc;
                    document.getElementById("spanDescuentos").innerHTML = desc;

                }
                console.log(TotalDescuento);
            }
            var totalOtros = 0;
            var serviciosExtras = 0;
            var montoDefault = 0;
            document.getElementById("divOtrosServicios").innerHTML = "";
            document.getElementById("divServiciosDefault").innerHTML = "";
            var contadorSer = 0;
            var contador = 0;
            for (var i = 0; i < respuesta.servPrestados.length; i++) {
                var selectOtrosServ = respuesta.servPrestados[i].id;
                var montoOtroServicio = respuesta.servPrestados[i].montoServicio;
                if (respuesta.servPrestados[i].tipo == 0) {
                    var contadorSer = contadorSer + 1;
                    var selected = respuesta.servPrestados[i].otrosServicios;
                    var serviciosExtras = serviciosExtras + respuesta.servPrestados[i].montoServicio;
                    $("#divOtrosServicios").append('<div id="divNumero" class="col-12"><div class="input-group mb-3"><button type="button" class="btn btn-success">' + contadorSer + '</button><div class="input-group-prepend"></div><input type="text" class="form-control" readOnly="readOnly" value="' + selected + '" /><input type="number"  class="form-control textOtros" id="montoServicioText' + selectOtrosServ + '" value="' + montoOtroServicio + '" /></div></div>');
                }
                if (respuesta.servPrestados[i].tipo == 1) {
                    var contador = contador + 1;
                    var selected = respuesta.servPrestados[i].servicioDefault;
                    $("#divServiciosDefault").append('<div id="divNumeroDefatult" class="col-12"><div class="input-group mb-3"><button type="button" class="btn btn-success">' + contador + '</button><div class="input-group-prepend"></div><input type="text" class="form-control textPlusServicios" readOnly="readOnly" value="' + selected + '" /><input type="number"  class="form-control textDefaultSer" id="montoSerDefaultText' + selectOtrosServ + '" value="' + montoOtroServicio + '" /></div></div>');
                    var montoDefault = montoDefault + respuesta.servPrestados[i].montoServicio;
                }
            }
            document.getElementById("spanServicios").innerHTML = montoDefault;
            document.getElementById("spanOtro").innerHTML = serviciosExtras;
            document.getElementById("thAlteracion").innerHTML = montoDefault;
            document.getElementById("detalleOtros").innerHTML = serviciosExtras;
            document.getElementById("hiddenOtros").value = serviciosExtras;
            document.getElementById("serviciosDefTotal").value = montoDefault;
            totalCobrar();

        }, error: function (respuesta) {
            console.log(respuesta);
        }
    });
    return todoMenus;
}
$(document).on("click", ".btnRecalculaHistoria", async function () {
    var hiddenDateTime = document.getElementById("hiddenDateTime").value;
    var retRecalcRet = document.getElementById("retRecalcRet").value;
    var retRecalcIng = document.getElementById("retRecalcIng").value;
    var calculoPolizaRetiro = document.getElementById("retPoliza").value;
    var funcionResp = await funcionesHistorialCalculoRecalc(hiddenDateTime, retRecalcRet, retRecalcIng, calculoPolizaRetiro);
})


function funcionesHistorialCalculoRecalc(hiddenDateTime, retRecalcRet, retRecalcIng, calculoPolizaRetiro) {
    let todoMenus;
    var datos = new FormData();
    datos.append("fechRecalc", hiddenDateTime);
    datos.append("idRetCalc", retRecalcRet);
    datos.append("idIngCalc", retRecalcIng);
    $.ajax({
        async: false,
        url: "ajax/historialCalculo.ajax.php",
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
                var mensaje = "El calculo con los campos digitados, se guardo correctamente, si existe un dato erroneo unicamente coloque el dato correcto donde corresponda y recalcule...";
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

                    console.log(TotalDescuento);
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

                                </div>
                `;
            }
            formatNumber("ZonaAdCalculo");
            formatNumber("AlmNormalCalculo");
            formatNumber("calcmanejoCalculo");
            formatNumber("calcGstAdminCalculo");
            formatNumber("detalleOtrosCalculo");
            formatNumber("totalCobrarCalc");
            var TotalDescuento = "";
            if (respuesta.descuentoCalc != 0) {
                var desc = respuesta.descuentoCalc[0].descuento;
                if (respuesta.descuentoCalc[0].tipoOp == 0) {
                    document.getElementById("hiddenTipoOP").value = 0;
                    document.getElementById("hiddenDescuento").value = respuesta.descuentoCalc[0].descuentoPercent;
                    document.getElementById("valDescuento").value = desc;
                    document.getElementById("spanDescuentos").innerHTML = desc;
                }
                if (respuesta.descuentoCalc[0].tipoOp == 1) {
                    document.getElementById("hiddenTipoOP").value = 1;
                    document.getElementById("hiddenDescuento").value = respuesta.descuentoCalc[0].descuentoPercent;
                    document.getElementById("valDescuento").value = desc;
                    document.getElementById("spanDescuentos").innerHTML = desc;

                }

            }
            var totalOtros = 0;
            var serviciosExtras = 0;
            var montoDefault = 0;
            document.getElementById("divOtrosServicios").innerHTML = "";
            document.getElementById("divServiciosDefault").innerHTML = "";
            var contadorSer = 0;
            var contador = 0;
            for (var i = 0; i < respuesta.servPrestados.length; i++) {
                var selectOtrosServ = respuesta.servPrestados[i].id;
                var montoOtroServicio = respuesta.servPrestados[i].montoServicio;
                if (respuesta.servPrestados[i].tipo == 0) {
                    var contadorSer = contadorSer + 1;
                    var selected = respuesta.servPrestados[i].otrosServicios;
                    var serviciosExtras = serviciosExtras + respuesta.servPrestados[i].montoServicio;
                    $("#divOtrosServicios").append('<div id="divNumero" class="col-12"><div class="input-group mb-3"><button type="button" class="btn btn-success">' + contadorSer + '</button><div class="input-group-prepend"></div><input type="text" class="form-control" readOnly="readOnly" value="' + selected + '" /><input type="number"  class="form-control textOtros" id="montoServicioText' + selectOtrosServ + '" value="' + montoOtroServicio + '" /></div></div>');
                }
                if (respuesta.servPrestados[i].tipo == 1) {
                    var contador = contador + 1;
                    var selected = respuesta.servPrestados[i].servicioDefault;
                    $("#divServiciosDefault").append('<div id="divNumeroDefatult" class="col-12"><div class="input-group mb-3"><button type="button" class="btn btn-success">' + contador + '</button><div class="input-group-prepend"></div><input type="text" class="form-control textPlusServicios" readOnly="readOnly" value="' + selected + '" /><input type="number"  class="form-control textDefaultSer" id="montoSerDefaultText' + selectOtrosServ + '" value="' + montoOtroServicio + '" /></div></div>');
                    var montoDefault = montoDefault + respuesta.servPrestados[i].montoServicio;
                }
            }
            document.getElementById("spanServicios").innerHTML = montoDefault;
            document.getElementById("spanOtro").innerHTML = serviciosExtras;
            document.getElementById("thAlteracion").innerHTML = montoDefault;
            document.getElementById("detalleOtros").innerHTML = serviciosExtras;
            document.getElementById("hiddenOtros").value = serviciosExtras;
            document.getElementById("serviciosDefTotal").value = montoDefault;
            totalCobrar();
        }, error: function (respuesta) {
            console.log(respuesta);
        }
    })

    return todoMenus;
}
