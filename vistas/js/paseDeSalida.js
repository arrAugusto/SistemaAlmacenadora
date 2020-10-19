function ajaxGuardarChasisVeh(idRetCal, listaJson) {
    let respFunc;
    var datos = new FormData();
    datos.append("idRetChas", idRetCal);
    datos.append("listaChasis", listaJson);    
    $.ajax({
        async: false,
        url: "ajax/paseDeSalida.ajax.php",
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
    });
    return respFunc;
}

$(document).on("click", ".btnImprimirRecibo", async function () {
    let polizaRetiroRev;
    
    document.getElementById("divOtrosServicios").innerHTML = "";
    var button = $(this);
    
    if ($(".btnTomarDatRet").length>=1) {
        
  
    var valTotalCif = document.getElementById("cif").value;
    var valTotalCif = Number.parseFloat(valTotalCif).toFixed(2);
    var valTotalCif = valTotalCif * 1;

    var impuestos = document.getElementById("impuestos").value;
    var impuestos = Number.parseFloat(impuestos).toFixed(2);
    var impuestos = impuestos * 1;

    var total = valTotalCif + impuestos;
    var total = Number.parseFloat(total).toFixed(2);
    var total = total * 1;
    listaChasis = [];
    if ($(".valTextTotal").length >= 1) {
        var paragraphsTotal = Array.from(document.querySelectorAll(".valTextTotal"));
        for (var i = 0; i < paragraphsTotal.length; i++) {
            var idDom = paragraphsTotal[i].id;
            var idChasis = $("#" + idDom).attr("idchasis");
            var valTotal = document.getElementById(idDom).value;
            var valTotal = Number.parseFloat(valTotal).toFixed(2);
            var valTotal = valTotal * 1;
            listaChasis.push({"idChasis": idChasis, "valTotal": valTotal});
        }
    }
    console.log(listaChasis);
    if (total == valTotal) {
        var idRetCal = button.attr("idRet");
        var listaJson = JSON.stringify(listaChasis);
        var GDchasisGeneral = await ajaxGuardarChasisVeh(idRetCal, listaJson);
    }

}
    if ($("#hiddenDateTimeVal").length >= 1 && $("#hiddenDateTimeVal").val() != "") {
        var hiddenDateTimeVal = document.getElementById("hiddenDateTimeVal").value;
    } else {
        var hiddenDateTimeVal = "NA";
    }
    var hiddenvalorDoll = document.getElementById("hiddenvalorDoll").value;
    var hiddentCambio = document.getElementById("hiddentCambio").value;
    var hiddencif = document.getElementById("hiddencif").value;
    var hiddencif = parseFloat(hiddencif).toFixed(2);
    var hiddenimpuestos = document.getElementById("hiddenimpuestos").value;
    var hiddenbultos = document.getElementById("hiddenbultos").value;
    var hiddenpeso = document.getElementById("hiddenpeso").value;
    var valorDoll = document.getElementById("valorDoll").value;
    var tCambio = document.getElementById("tCambio").value;
    var cif = document.getElementById("cif").value;
    var cif = parseFloat(cif).toFixed(2);
    var impuestos = document.getElementById("impuestos").value;
    var bultos = document.getElementById("bultos").value;
    var peso = document.getElementById("peso").value;
    if (valorDoll > 0 && cif > 0 && impuestos > 0 && bultos > 0 && peso > 0) {
        var $contador = 0;
    } else {
        var $contador = 1;
    }
    if ($contador == 0) {
        var idRetCal = button.attr("idRet");
        var respRemplazoValRet = await remplazoDataRet(idRetCal);
        if (respRemplazoValRet[0]["resp"] == 1) {
            if ($contador == 0) {
                if ($("#tableVeh").length == 0) {
                    document.getElementById("divCalculoHistoria").innerHTML = ``;
                    var idIngresoCal = $(this).attr("idIngreso");
                    var datos = new FormData();
                    datos.append("idRetDatosGen", idRetCal);
                    //datos.append("hiddenDateTimeVal", hiddenDateTimeVal);
                    $.ajax({
                        async: false,
                        url: "ajax/paseDeSalida.ajax.php",
                        method: "POST",
                        data: datos,
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: "json",
                        success: function (respuestaDetalle) {
                            var empresaIngreso = respuestaDetalle[0]["nombreEmpresa"];
                            var nitEmpresa = respuestaDetalle[0]["nitEmpresaIng"];
                            var numeroPoliza = respuestaDetalle[0]["numPol"];
                            var fechaIng = respuestaDetalle[0]["fechaIng"];
                            var polizaRetiro = respuestaDetalle[0]["polRetiro"];
                            var fechaSalida = respuestaDetalle[0]["fechaSalida"];
                            var polizaRetiroRev = respuestaDetalle[0]["polRetiro"];
                            var datos = new FormData();
                            datos.append("idRetCal", idRetCal);
                            datos.append("idIngresoCal", idIngresoCal);
                            datos.append("hiddenDateTimeVal", hiddenDateTimeVal);
                            $.ajax({
                                async: false,
                                url: "ajax/paseDeSalida.ajax.php",
                                method: "POST",
                                data: datos,
                                cache: false,
                                contentType: false,
                                processData: false,
                                dataType: "json",
                                success: async function (respuesta) {
                                    console.log(respuesta);
                                    if (respuesta == "SD") {
                                        Swal.fire(
                                                'Cliente sin tarifa',
                                                'Este cliente no tiene tarifa especial!',
                                                'error'
                                                );
                                        return false;
                                    }
                                    var respValRet = await funcGuardarValRet();
                                    listaPushDefault = [];
                                    var tiempoTotal = respuesta['tiempoTotal'];
                                    var zonaAduana = respuesta['zonaAduanMSuperior'];
                                    var almacenaje = respuesta['almaMSuperior'];
                                    var manejo = respuesta['calculoManejo'];
                                    var gstosAdmin = respuesta['gtoAdminMSuperior'];
                                    var marchElectro = respuesta['marchElectro'];
                                    var marchElectro = parseFloat(marchElectro).toFixed(2);
                                    var fechaCorte = respuesta['fechaCorte'];
                                    var tdGTOAcuse = ""
                                    var hiddenGTOAcuse = 0;
                                    if (respuesta['serAcuse'] != "SD") {
                                        for (var i = 0; i < respuesta['serAcuse'].length; i++) {
                                            var selectOtrosServ = respuesta['serAcuse'][i].idServicio;
                                            var selected = respuesta['serAcuse'][i].otrosServicios;
                                            var montoOtroServicio = respuesta['serAcuse'][i].montoExtra / respuesta['cantClientes'];
                                            var montoOtroServicio = montoOtroServicio * 1;
                                            var montoOtroServicio = Math.ceil(montoOtroServicio / 5) * 5;
                                            console.log(montoOtroServicio);
                                            var hiddenGTOAcuse = hiddenGTOAcuse + montoOtroServicio;
                                            $("#divOtrosServicios").append('<div id="divNumero" class="col-12"><div class="input-group mb-3"><div class="input-group-prepend"><button type="button" class="btn btn-info btnEliminarOtroServ" id="valueCombo' + selectOtrosServ + '" idValue="' + selectOtrosServ + '"><i class="fa fa-trash"></i></button></div><input type="text" class="form-control" readOnly="readOnly" value="' + selected + '" /><input type="number"  class="form-control textOtros" id="montoServicioText' + selectOtrosServ + '" value="' + montoOtroServicio + '" /></div></div>');
                                        }
                                        var hiddenGTOAcuse = parseFloat(hiddenGTOAcuse).toFixed(2);
                                        var tdGTOAcuse = `
                                            <tr>
                                            <th>Gastos de Descarga:</th>
                                            <td id="calcGTODescarga">` + hiddenGTOAcuse + `</td>
                                            </tr>
                                            <tr>`;


                                    }
                                    if (!isNaN(respuesta['revCuad'])) {

                                        var revCuad = respuesta['revCuad'];
                                        var revCuad = parseFloat(revCuad).toFixed(2);
                                        var revCuad = new Intl.NumberFormat("en-GT").format(revCuad);

                                    } else {
                                        var revCuad = 0;
                                    }

                                    var total = respuesta['zonaAduanMSuperior'] + respuesta['almaMSuperior'] + respuesta['calculoManejo'] + respuesta['gtoAdminMSuperior'] + revCuad;
                                    document.getElementById("divCalculoHistoria").innerHTML = `
                        <div class="col-4">
                                <div class="row"">
                                    <div class="col-12">
                                        <p class="lead">Detalle de calculo de almacenaje <br/>
                                                Nit :  ` + nitEmpresa + `</br>
                                            Empresa: ` + empresaIngreso + `</br>
                                            Poliza ingreso: ` + numeroPoliza + `&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Poliza retiro : ` + polizaRetiro + `</br>
                                            Fecha ingreso : ` + fechaIng + ` &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp ` + tiempoTotal + `&nbsp;dias<br/>Fecha salida : <div class="input-group input-group">
                                    <input type="text" id="dateTime" class="form-control">
                                    <span class="input-group-append">
                                       <button type="button" class="btn btn-warning btnImprimirRecibo pull-left" id="btnCalculoAlm" idret="` + idRetCal + `" idingreso="` + idIngresoCal + `">Calcular Almacenaje <i class="fa fa-calculator" aria-hidden="true"></i></button>
                                        
                                    </span>
                                    <input type="hidden" id="hiddenDateTimeVal" value="" />
                                    
                                    <input type="hidden" id="hiddenNumeroPoliza" value="" />
                                    
                                    </p>

                                </div>
                                    
                                        </p>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody><tr>
                                            <th style="width:50%">Zona aduanera:</th>
                                            <td id="ZonaAd">` + zonaAduana + `</td>
                                            </tr>
                                            <tr>
                                            <th>Almacenaje:</th>
                                            <td id="AlmNormal">` + almacenaje + `</td>
                                            </tr>
                                            <tr>
                                            <th>Manejo:</th>
                                            <td id="calcmanejo">` + manejo + `</td>
                                            </tr>
                                            <tr>
                                            <th>Gastos administrativos:</th>
                                            <td id="calcGstAdmin">` + gstosAdmin + `</td>
                                            </tr>
                                            <tr>
                                            <th>Marchamo Electronico : </th>
                                            <td id="calcMarchEle">` + marchElectro + `</td>
                                            </tr>                            
                                            <tr>
                                            <th>Revisión:</th>
                                            <td>` + revCuad + `</td>
                                            </tr>
                                            <tr>
                                            ` + tdGTOAcuse + `
                                            <th>Otros gastos:</th>
                                              <td id="detalleOtros">0</td>
                                            </tr>
                                            <tr>
                                            <th>Alteración de servicios :</th>
                                              <td id="thAlteracion">0</td>
                                            </tr>
                                            <tr>
                                          
                                            <tr id="trDescuento">

                                            </tr>

                                            <tr>                        
                                            <th>Total Cobrar:</th>
                                              <td id="totaTh"></td>
                                            </tr>                        
                                    </tbody></table>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="card card-widget widget-user-2">
                                    <!-- Add the bg color to the header using any of the bg-* classes -->
                                    <div class="widget-user-header bg-success-gradient">
                                        <h3 class="widget-user-username">Datos de Retiros Fiscales</h3>
                                        <h5 class="widget-user-desc">Piloto(s) y Unidad(es)</h5>
                                    </div>
                                    <div class="card-footer p-0">
                                    <div class="card-body" id="ListaSelect">
                            
                                    </div>
                                </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-lg-3"><button type="button" class="btn btn-outline-dark"  data-toggle="modal" data-target="#plusOtrosServicios">Otros : <span class="badge badge-primary" style="font-size: 15px;"><b>Q&nbsp;&nbsp;</b><b id="spanOtro"></b></span></button></div>
                                    <div class="col-sm-12 col-lg-3"><button type="button" class="btn btn-outline-dark"  data-toggle="modal" data-target="#plusServiciosDefalult">Servicios : <span class="badge badge-primary" style="font-size: 15px;"><b>Q&nbsp;&nbsp;</b><b id="spanServicios"></b></span></button></div>
                                    <div class="col-sm-12 col-lg-3"><button type="button" class="btn btn-outline-dark btnDescuento">Descuentos : <span class="badge badge-primary" style="font-size: 15px;"><b>Q&nbsp;&nbsp;</b><b id="spanDescuentos"></b></span></button></div>
                                    <div class="col-sm-12 col-lg-3"><button type="button" class="btn btn-outline-danger">Total : <span class="badge badge-primary" style="font-size: 15px;"><b>Q&nbsp;&nbsp;</b><b id="spanTotalC"></b></span></button></div>
                                    <div class="col-sm-12 col-lg-4 mt-4">                                <div class="btn btn-primary btn-lg btn-flat btnVerPreImpreso"  data-toggle="modal" data-target="#modalPreImpresoRecibo" idRet= ` + idRetCal + `>
                                        <i class="fa fa-calculator fa-lg mr-2"></i>
                                        Iniciar Cobro
                                    </div>
                                    </div>
                        
                                    <div class="col-sm-12 col-lg-4 mt-4">
                                 <div class="btn btn-success btn-lg btn-flat"  id="imprimirRetiroAlmacenaje" idRet= ` + idRetCal + `>
                                    <i class="fa fa-print fa-lg mr-2"></i>
                                    Imprimir Retiro
                                </div>  
                                </div>
                                <div class="col-sm-12 col-lg-4 mt-4">
                                <div class="btn btn-success btn-lg btn-flat btnMasPilotos" id="idbtnMasPilotos" estado="0"  idRet= ` + idRetCal + ` idMasPilotos= ` + idRetCal + `   data-toggle="modal" data-target="#plusPilotos">
                                    Nueva Unidad&nbsp;&nbsp;&nbsp;<i class="fa fa-plus" style="font-size:20px" aria-hidden="true"></i>
                                </div>                        
                            </div>    
                            <div class="col-12 mt-4">
                                <button type="button" class="btn btn-success btn-block btnExcelRetSal" idRet= ` + idRetCal + `>Descarga Excel <i class="fa fa-file-excel-o"></i></button>
                            </div>
                                </div>
                        </div>`;
                                    //imprimirReciboAlmacenaje
                                    $(function () {
                                        $('#dateTime').daterangepicker({
                                            singleDatePicker: true,
                                            locale: {
                                                format: 'DD-MM-YYYY'
                                            }
                                        }, function (start, end, label) {
                                            var tiempo = start.format('YYYY-MM-DD hh:mm A');
                                            var tiempoVal = start.format('DD-MM-YYYY');
                                            document.getElementById("hiddenDateTimeVal").value = tiempoVal;

                                            $("#dateTime").val(fechaCorte);
                                        });
                                    });

                                    setTimeout(function () {
                                        $("#dateTime").val(fechaCorte);
                                    }, 1000);
                                    document.getElementById("hiddenRevision").value = revCuad;

                                    document.getElementById("hiddenZonaAduana").value = respuesta['zonaAduanMSuperior'];
                                    document.getElementById("hiddenAlmacenaje").value = respuesta['almaMSuperior'];
                                    document.getElementById("hiddenManejo").value = respuesta['calculoManejo'];
                                    document.getElementById("hiddenGstosAdmin").value = respuesta['gtoAdminMSuperior'];
                                    document.getElementById("hiddenresultIdIngreso").value = idIngresoCal;
                                    document.getElementById("hiddenMarchElect").value = marchElectro;
                                    document.getElementById("hiddenGTOAcuse").value = hiddenGTOAcuse;

                                    formatNumber("factTNormal");
                                    formatNumber("ZonaAd");
                                    formatNumber("AlmNormal");
                                    formatNumber("calcmanejo");
                                    formatNumber("calcGstAdmin");
                                    $('.select2').select2();
                                    totalCobrar();
                                    $(".close").click();
                                    Swal.fire({
                                        title: "Asignacion Fecha Hoy",
                                        text: "¡Cambie de fecha si necesita hacerlo !",
                                        type: 'warning',
                                        allowOutsideClick: false,
                                        confirmButtonColor: '#3085d6',
                                        confirmButtonText: 'Ok',
                                    }).then(async function (result) {
                                        if (result.value) {
                                            $("#dateTime").val(fechaCorte);
                                            var idMasPilotos = idRetCal;
                                            var nomVar = "todasUnidades";
                                            var estado = 0;
                                            var respTodosPlt = await verPltsRet(nomVar, idMasPilotos, estado);
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
                                        }
                                    })
                                },
                                error: function (respuesta) {
                                    console.log(respuesta);
                                }
                            });
                        },
                        error: function (respuesta) {
                            console.log(respuesta);
                        }
                    });
                    var revDato = await revDatosExtras(polizaRetiroRev);
                    console.log(revDato);
                    /*if (revDato == false) {
                     toastr.options = {
                     "closeButton": false,
                     "debug": false,
                     "newestOnTop": false,
                     "progressBar": false,
                     "positionClass": "toast-top-full-width",
                     "preventDuplicates": true,
                     "onclick": null,
                     "showDuration": "400",
                     "hideDuration": "2000",
                     "timeOut": "8000",
                     "extendedTimeOut": "1000",
                     "showEasing": "swing",
                     "hideEasing": "linear",
                     "showMethod": "fadeIn",
                     "hideMethod": "fadeOut"
                     }
                     Command: -toastr["error"]("¡ Error existen datos con diferencia en la difitacion revise !");
                     }*/
                    if (revDato == true) {
                        formatNumber("ZonaAdCalculo");
                        formatNumber("AlmNormalCalculo");
                        formatNumber("calcmanejoCalculo");
                        formatNumber("calcGstAdminCalculo");
                        formatNumber("detalleOtrosCalculo");
                        formatNumber("totalCobrarCalc");
                        var TotalDescuento = "";
                        if (revDato != "SD") {
                            if (revDato.descuentoCalc != 0) {
                                var desc = revDato.descuentoCalc[0].descuento;
                                if (revDato.descuentoCalc[0].tipoOp == 0) {
                                    document.getElementById("hiddenTipoOP").value = 0;
                                    document.getElementById("hiddenDescuento").value = revDato.descuentoCalc[0].descuentoPercent;
                                    document.getElementById("valDescuento").value = desc;
                                    document.getElementById("spanDescuentos").innerHTML = desc;
                                }
                                if (revDato.descuentoCalc[0].tipoOp == 1) {
                                    document.getElementById("hiddenTipoOP").value = 1;
                                    document.getElementById("hiddenDescuento").value = revDato.descuentoCalc[0].descuentoPercent;
                                    document.getElementById("valDescuento").value = desc;
                                    document.getElementById("spanDescuentos").innerHTML = desc;
                                }
                            }
                            if (revDato.descuentoCalc != 0) {
                                var desc = revDato.descuentoCalc[0].descuento;
                                if (revDato.descuentoCalc[0].tipoOp == 0) {
                                    document.getElementById("trDescuento").innerHTML = `
                    
                                                     
                                                <th>Descuentos :</th>
                                                   <td id="thDescuento" style="color:red;">(` + desc + `)</td>
                                           `;

                                }
                                if (revDato.descuentoCalc[0].tipoOp == 1) {
                                    document.getElementById("trDescuento").innerHTML = `
                                        
                                                   
                                                <th>Descuentos :</th>
                                                   <td id="thDescuento" style="color:red;">(` + desc + `)</td>
                                            `;
                                }
                            }
                            var totalOtros = 0;
                            var serviciosExtras = 0;
                            var montoDefault = 0;
                            document.getElementById("divOtrosServicios").innerHTML = "";
                            document.getElementById("divServiciosDefault").innerHTML = "";
                            var contadorSer = 0;
                            var contador = 0;

                            for (var i = 0; i < revDato.servPrestados.length; i++) {
                                var selectOtrosServ = revDato.servPrestados[i].idServicio;
                                var montoOtroServicio = revDato.servPrestados[i].montoServicio;
                                if (revDato.servPrestados[i].tipo == 0) {
                                    var contadorSer = contadorSer + 1;
                                    var selected = revDato.servPrestados[i].otrosServicios;
                                    var selected = Math.ceil(selected / 5) * 5;
                                    console.log(selected);
                                    var serviciosExtras = serviciosExtras + revDato.servPrestados[i].montoServicio;

                                    $("#divOtrosServicios").append('<div id="divNumero" class="col-12"><div class="input-group mb-3"> <div class="input-group-prepend"><button type="button" class="btn btn-danger btnEliminarOtroServ" id="valueCombo' + selectOtrosServ + '" idValue="' + selectOtrosServ + '"><i class="fa fa-trash"></i></button></div><input type="text" class="form-control" readOnly="readOnly" value="' + selected + '" /><input type="number"  class="form-control textOtros" id="montoServicioText' + selectOtrosServ + '" value="' + montoOtroServicio + '" /></div></div>');
                                }
                                if (revDato.servPrestados[i].tipo == 1) {
                                    var contador = contador + 1;
                                    var selected = revDato.servPrestados[i].servicioDefault;
                                    var selected = Math.ceil(selected / 5) * 5;
                                    console.log(selected);
                                    $("#divServiciosDefault").append('<div id="divNumero" class="col-12"><div class="input-group mb-3"> <div class="input-group-prepend"><button type="button" class="btn btn-danger btnEliminarServDefault" id="valueCombo' + selectOtrosServ + '" idValue="' + selectOtrosServ + '"><i class="fa fa-trash"></i></button></div><input type="text" class="form-control" readOnly="readOnly" value="' + selected + '" /><input type="number"  class="form-control textOtros" id="montoSerDefaultText' + selectOtrosServ + '" value="' + montoOtroServicio + '" /></div></div>');
                                    var montoDefault = montoDefault + revDato.servPrestados[i].montoServicio;
                                }
                            }
                            document.getElementById("spanServicios").innerHTML = montoDefault;
                            var hiddenGTOAcuse = document.getElementById("hiddenGTOAcuse").value;
                            if (hiddenGTOAcuse == "") {
                                hiddenGTOAcuse = 0;
                            }
                            var hiddenGTOAcuse = hiddenGTOAcuse * 1;
                            var serviciosExtras = serviciosExtras + hiddenGTOAcuse;
                            document.getElementById("spanOtro").innerHTML = serviciosExtras;
                            document.getElementById("thAlteracion").innerHTML = montoDefault;
                            document.getElementById("detalleOtros").innerHTML = serviciosExtras;
                            document.getElementById("hiddenOtros").value = serviciosExtras;
                            document.getElementById("serviciosDefTotal").value = montoDefault;
                            totalCobrar();
                        }
                    } else {
                        var hiddenGTOAcuse = document.getElementById("hiddenGTOAcuse").value;
                        var hiddenGTOAcuse = hiddenGTOAcuse * 1;

                        document.getElementById("spanOtro").innerHTML = hiddenGTOAcuse;
                    }
                
            } else {


                 Swal.fire({
                 title: 'Desea imprimir?',
                 text: "Se generará una forma de retiro de vehículos nuevos!",
                 type: 'info',
                 showCancelButton: true,
                 allowOutsideClick: false,
                 confirmButtonColor: '#3085d6',
                 cancelButtonColor: '#d33',
                 confirmButtonText: 'Si, imprimir',
                 cancelButtonText: 'No, cancelar'
                 }).then(async function (result) {
                 if (result.value) {
                 var nomVar = "retiroVehN";
                 var resp = await AjaxUnParam(idRetCal, nomVar);
                 if (resp[0]["resp"] == 1) {
                 Swal.fire({
                 title: 'Desea imprimir retiro?',
                 text: "Se generará un PDF!",
                 type: 'success',
                 showCancelButton: true,
                 confirmButtonColor: '#3085d6',
                 cancelButtonColor: '#d33',
                 confirmButtonText: 'Yes, delete it!'
                 }).then((result) => {
                 if (result.value) {
                 window.open("extensiones/tcpdf/pdf/Retiro-fiscal.php?codigo=" + idRetCal, "_blank");
                 
                 }
                 })
                 }
                 }
                 })
            }
        }}
    }

});

function funcGuardarValRet() {
    var valDoll = document.getElementById("hiddenvalorDoll").value;
    var tCambio = document.getElementById("hiddentCambio").value;
    var cif = document.getElementById("hiddencif").value;
    var impts = document.getElementById("hiddenimpuestos").value;
    var cantBultos = document.getElementById("hiddenbultos").value;
    var peso = document.getElementById("hiddenpeso").value;

}


function revDatosExtras(polizaRetiroRev) {
    let resp;
    var datos = new FormData();
    datos.append("revExtrasPol", polizaRetiroRev);

    $.ajax({
        async: false,
        url: "ajax/paseDeSalida.ajax.php",
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
            resp = respuesta;
        }
    });
    return resp;
}

$(document).on("click", ".btnConsultDataConfirm", async function () {
    document.getElementById("valorDoll").value = "";
    document.getElementById("tCambio").value = "";
    document.getElementById("cif").value = "";
    document.getElementById("impuestos").value = "";
    document.getElementById("bultos").value = "";
    document.getElementById("peso").value = "";

    $("#valorDoll").removeClass('is-valid');
    $("#valorDoll").addClass('is-invalid');

    $("#tCambio").removeClass('is-valid');
    $("#tCambio").addClass('is-invalid');

    $("#cif").removeClass('is-valid');
    $("#cif").addClass('is-invalid');

    $("#impuestos").removeClass('is-valid');
    $("#impuestos").addClass('is-invalid');

    $("#bultos").removeClass('is-valid');
    $("#bultos").addClass('is-invalid');

    $("#peso").removeClass('is-valid');
    $("#peso").addClass('is-invalid');
    var idNumRetConsult = $(this).attr("idret");
    var idNumIng = $(this).attr("idIngreso");
    document.getElementById("divButtonPase").innerHTML = '<button type="button" class="btn btn-warning btnImprimirRecibo pull-left" id="btnCalculoAlm" idRet =' + idNumRetConsult + ' idIngreso=' + idNumIng + '>Calcular Almacenaje <i class="fa fa-calculator"></i></button>';
    var datos = new FormData();
    datos.append("idNumRetConsult", idNumRetConsult);
    $.ajax({
        url: "ajax/paseDeSalida.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            document.getElementById("polizaIngreso").value = respuesta[0].polIng;
            document.getElementById("polizaRetiro").value = respuesta[0].polRet;
            document.getElementById("numeroRetiro").value = respuesta[0].numRet;
            /*
             
             document.getElementById("valorDoll").value = respuesta[0].valDoll;
             document.getElementById("tCambio").value = respuesta[0].tCambio;
             document.getElementById("cif").value = respuesta[0].cif;
             document.getElementById("impuestos").value = respuesta[0].impts;
             document.getElementById("bultos").value = respuesta[0].cantBultos;
             document.getElementById("peso").value = respuesta[0].peso;
             
             */
            var valDol = parseFloat(respuesta[0].valDoll).toFixed(2);
            var valTCambio = parseFloat(respuesta[0].tCambio).toFixed(4);
            var valCif = parseFloat(respuesta[0].cif).toFixed(2);
            var valImpts = parseFloat(respuesta[0].impts).toFixed(2);
            var valBultos = parseInt(respuesta[0].cantBultos);
            var valPeso = parseFloat(respuesta[0].peso).toFixed(2);

            document.getElementById("hiddenvalorDoll").value = valDol;
            document.getElementById("hiddentCambio").value = valTCambio;
            document.getElementById("hiddencif").value = valCif;
            document.getElementById("hiddenimpuestos").value = valImpts;
            document.getElementById("hiddenbultos").value = valBultos;
            document.getElementById("hiddenpeso").value = valPeso;

            document.getElementById("spanvalorDoll").innerHTML = valDol;
            document.getElementById("spantCambio").innerHTML = valTCambio;
            document.getElementById("spancif").innerHTML = valCif;
            document.getElementById("spanimpuestos").innerHTML = valImpts;
            document.getElementById("spanbultos").innerHTML = valBultos;
            document.getElementById("spanpeso").innerHTML = valPeso;

            $("#spanvalorDoll").attr("style", "display:none;");
            $("#spantCambio").attr("style", "display:none;");
            $("#spancif").attr("style", "display:none;");
            $("#spanimpuestos").attr("style", "display:none;");
            $("#spanbultos").attr("style", "display:none;");
            $("#spanpeso").attr("style", "display:none;");
        },
        error: function (respuesta) {
            console.log(respuesta);
        }
    })

});

function remplazoDataRet(idNumRetConsult) {
    let resp;
    var valorDoll = document.getElementById("valorDoll").value;
    var tCambio = document.getElementById("tCambio").value;
    var cif = document.getElementById("cif").value;
    var impuestos = document.getElementById("impuestos").value;
    var bultos = document.getElementById("bultos").value;
    var peso = document.getElementById("peso").value;
    var datos = new FormData();
    datos.append("valorDollReplace", valorDoll);
    datos.append("tCambioReplace", tCambio);
    datos.append("cifReplace", cif);
    datos.append("impuestosReplace", impuestos);
    datos.append("bultosReplace", bultos);
    datos.append("pesoReplace", peso);
    datos.append("idNumRetConsultReplace", idNumRetConsult);

    $.ajax({
        async: false,
        url: "ajax/paseDeSalida.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            resp = respuesta;
            console.log(respuesta);
        }, error: function (respuesta) {
            console.log(respuesta);
        }

    })
    return resp;

}
$(document).on("change", "#valorDoll", function () {
    var valDolIngresado = $(this).val();
    var valIng = parseFloat(valDolIngresado);
    var valIng = valIng * 1;
    if (isNaN(valIng)) {
        Swal.fire(
                'Valor digitado',
                'En este formulario debe ingresar unicamente, valores numericos.',
                'error'
                )
    } else if (!isNaN(valIng)) {
        var valDolComprobar = document.getElementById("hiddenvalorDoll").value;
        var comprobarValDoll = parseFloat(valDolComprobar).toFixed(2);
        var comprobarValDoll = comprobarValDoll * 1;
        var rest = (comprobarValDoll - valIng);
        console.log(rest);
        if (rest == 0) {
            $("#valorDoll").removeClass('is-invalid');
            $("#valorDoll").addClass('is-valid');
            document.getElementById("valorDoll").value = parseFloat(valDolIngresado).toFixed(2);
            $("#spanvalorDoll").attr("style", "display:none;");
            if ($("#tCambio").val() > 0) {

                var totalCif = $("#valorDoll").val() * $("#tCambio").val();
                var totalCif = parseFloat(totalCif).toFixed(2);
                var cif = $("#hiddencif").val();
                var cif = parseFloat(cif).toFixed(2);
                if (cif == totalCif) {
                    $("#cif").removeClass('is-invalid');
                    $("#cif").addClass('is-valid');

                    document.getElementById("cif").readOnly = true;
                    document.getElementById("impuestos").focus();
                    $("#spancif").attr("style", "display:none;");
                    document.getElementById("cif").value = totalCif;

                } else {
                    $("#spancif").attr("style", "display:block;");
                    $("#cif").removeClass('is-invalid');
                    $("#cif").addClass('is-valid');
                }
            } else {
                $("#cif").removeClass('is-valid');
                $("#cif").addClass('is-invalid');
                $("#spancif").attr("style", "display:none;");

            }


        } else {
            $("#valorDoll").removeClass('is-valid');
            $("#valorDoll").addClass('is-invalid');
            $("#spanvalorDoll").attr("style", "display:block;");
        }
    }
});
$(document).on("change", "#tCambio", function () {
    var tCambio = $(this).val();
    var valIng = parseFloat(tCambio);
    var valIng = valIng * 1;
    if (isNaN(valIng)) {
        alert("error");
    } else if (!isNaN(valIng)) {
        var valDolComprobar = document.getElementById("hiddentCambio").value;
        var comprobarValDoll = parseFloat(valDolComprobar);
        var comprobarValDoll = comprobarValDoll * 1;
        document.getElementById("tCambio").value = parseFloat(tCambio).toFixed(4);

        var rest = (comprobarValDoll - valIng);
        console.log(rest);
        if (rest == 0) {
            $("#tCambio").removeClass('is-invalid');
            $("#tCambio").addClass('is-valid');
            $("#spantCambio").attr("style", "display:none;");

            if ($("#valorDoll").val() > 0) {
                var totalCif = $("#valorDoll").val() * $("#tCambio").val();
                var totalCif = parseFloat(totalCif).toFixed(2);
                var cif = $("#hiddencif").val();
                var cif = parseFloat(cif).toFixed(2);
                if (cif == totalCif) {
                    $("#cif").removeClass('is-invalid');
                    $("#cif").addClass('is-valid');
                    document.getElementById("impuestos").focus();
                    $("#spancif").attr("style", "display:none;");
                    document.getElementById("cif").value = totalCif;

                } else {
                    $("#spancif").attr("style", "display:block;");
                    $("#cif").removeClass('is-invalid');
                    $("#cif").addClass('is-valid');
                }
            } else {
                $("#cif").removeClass('is-valid');
                $("#cif").addClass('is-invalid');
                $("#spancif").attr("style", "display:none;");

            }



        } else {
            $("#tCambio").removeClass('is-valid');
            $("#tCambio").addClass('is-invalid');
            $("#spantCambio").attr("style", "display:block;");
        }
    }
});
$(document).on("change", "#cif", function () {
    var cif = $(this).val();
    var valIng = parseFloat(cif).toFixed(2);
    var valIng = valIng * 1;
    if (isNaN(valIng)) {
        alert("error");
    } else if (!isNaN(valIng)) {

        var valDolComprobar = document.getElementById("hiddencif").value;
        var comprobarValDoll = parseFloat(valDolComprobar);
        var comprobarValDoll = comprobarValDoll * 1;
        var rest = (comprobarValDoll - valIng);
        console.log(rest);
        if (rest == 0) {
            $("#cif").removeClass('is-invalid');
            $("#cif").addClass('is-valid');
            document.getElementById("cif").value = parseFloat(cif).toFixed(2);

            $("#spancif").attr("style", "display:none;");

        } else {
            $("#cif").removeClass('is-valid');
            $("#cif").addClass('is-invalid');
            $("#spancif").attr("style", "display:block;");

        }
    }
});
$(document).on("change", "#impuestos", function () {
    var impuestos = $(this).val();
    var valIng = parseFloat(impuestos);
    var valIng = valIng * 1;
    if (isNaN(valIng)) {
        alert("error");
    } else if (!isNaN(valIng)) {
        var valDolComprobar = document.getElementById("hiddenimpuestos").value;
        var comprobarValDoll = parseFloat(valDolComprobar);
        var comprobarValDoll = comprobarValDoll * 1;
        var rest = (comprobarValDoll - valIng);
        console.log(rest);
        if (rest == 0) {
            $("#impuestos").removeClass('is-invalid');
            $("#impuestos").addClass('is-valid');
            document.getElementById("impuestos").value = parseFloat(impuestos).toFixed(2);

            $("#spanimpuestos").attr("style", "display:none;");
        } else {
            $("#impuestos").removeClass('is-valid');
            $("#impuestos").addClass('is-invalid');
            $("#spanimpuestos").attr("style", "display:block;");
        }
    }
});
$(document).on("change", "#bultos", function () {
    var bultos = $(this).val();
    var valIng = parseFloat(bultos);
    var valIng = valIng * 1;
    if (isNaN(valIng)) {
        alert("error");
    } else if (!isNaN(valIng)) {
        var valDolComprobar = document.getElementById("hiddenbultos").value;
        var comprobarValDoll = parseFloat(valDolComprobar);
        var comprobarValDoll = comprobarValDoll * 1;
        var rest = (comprobarValDoll - valIng);
        console.log(rest);
        if (rest == 0) {
            $("#bultos").removeClass('is-invalid');
            $("#bultos").addClass('is-valid');
            document.getElementById("bultos").value = parseInt(bultos);

            $("#spanbultos").attr("style", "display:none;");
        } else {
            $("#bultos").removeClass('is-valid');
            $("#bultos").addClass('is-invalid');
            $("#spanbultos").attr("style", "display:block;");
        }
    }
});
$(document).on("change", "#peso", function () {
    var peso = $(this).val();
    var valIng = parseFloat(peso);
    var valIng = valIng * 1;
    if (isNaN(valIng)) {
        alert("error");
    } else if (!isNaN(valIng)) {
        var valDolComprobar = document.getElementById("hiddenpeso").value;
        var comprobarValDoll = parseFloat(valDolComprobar);
        var comprobarValDoll = comprobarValDoll * 1;
        var rest = (comprobarValDoll - valIng);
        console.log(rest);
        if (rest == 0) {
            $("#peso").removeClass('is-invalid');
            $("#peso").addClass('is-valid');
            document.getElementById("peso").value = parseFloat(peso).toFixed(2);

            $("#spanpeso").attr("style", "display:none;");
        } else {
            $("#peso").removeClass('is-valid');
            $("#peso").addClass('is-invalid');
            $("#spanpeso").attr("style", "display:block;");
        }
    }
});

function totalAlmDescuentoNormal() {
    document.getElementById("divDescuentoNormal").innerHTML = `
                          <div class="info-box">
                                <span class="info-box-icon bg-primary elevation-1"><i class="fa fa-user-minus"></i></span>
                                <div class="info-box-content">
                                      <span id="spanTotalCobro" class="info-box-text">Descuento autorizado</span>
                                      <div id="totalAlmacenaje">

                                      </div>
                                </div>
                            </div>`;
    var estadoBtnDescuento = document.getElementById("percentQueTNormal").textContent;
    var txtValDescNormal = document.getElementById("txtValDescNormal").value;
    var txtValDescNormal = parseFloat(txtValDescNormal).toFixed(2);
    var hiddenAlmacenaje = document.getElementById("hiddenAlmacenaje").value;
    var hiddenAlmacenaje = parseFloat(hiddenAlmacenaje).toFixed(2);
    var hiddenAlmacenaje = (hiddenAlmacenaje * 1);
    var hiddenZonaAduana = document.getElementById("hiddenZonaAduana").value;
    var hiddenZonaAduana = parseFloat(hiddenZonaAduana).toFixed(2);
    var hiddenZonaAduana = (hiddenZonaAduana * 1);
    var hiddenManejo = document.getElementById("hiddenManejo").value;
    var hiddenManejo = parseFloat(hiddenManejo).toFixed(2);
    var hiddenManejo = (hiddenManejo * 1);
    var hiddenGstosAdmin = document.getElementById("hiddenGstosAdmin").value;
    var hiddenGstosAdmin = parseFloat(hiddenGstosAdmin).toFixed(2);
    var hiddenGstosAdmin = (hiddenGstosAdmin * 1);
    if (estadoBtnDescuento == "%") {
        var totalDescuento = (txtValDescNormal / 100) * hiddenAlmacenaje;
        if (totalDescuento >= 0.25) {
        }
        document.getElementById("totalAlmacenaje").innerHTML = `<span id="descuento" style="color: red">Descuento:&nbsp;<b id="descuentoQP">` + totalDescuento + `</b>&nbsp;Nuevo Almacenaje:&nbsp;&nbsp;<b id="nuevoAlm">` + (hiddenAlmacenaje - totalDescuento) + `</b></span>`;
        var totalACobrar = (hiddenAlmacenaje + hiddenZonaAduana + hiddenManejo + hiddenGstosAdmin) - totalDescuento;
        var totalACobrarFac = parseFloat(totalACobrar).toFixed(2);
        var totalACobrarFac = (totalACobrarFac * 1);
        document.getElementById("factTNormalRec").innerHTML = totalACobrarFac;
    } else if (estadoBtnDescuento == "Q") {
        document.getElementById("totalAlmacenaje").innerHTML = `<span id="descuento" style="color: red">Descuento:&nbsp;<b id="descuentoQP">` + txtValDescNormal + `</b>&nbsp;Nuevo Almacenaje:&nbsp;&nbsp;<b id="nuevoAlm">` + (hiddenAlmacenaje - txtValDescNormal) + `</b></span>`;
        var totalACobrar = (hiddenAlmacenaje + hiddenZonaAduana + hiddenManejo + hiddenGstosAdmin) - txtValDescNormal;
        var totalACobrarFac = parseFloat(totalACobrar).toFixed(2);
        var totalACobrarFac = (totalACobrarFac * 1);
        document.getElementById("factTNormalRec").innerHTML = totalACobrarFac;
    }
}
$(document).on("click", ".btnCambioDesNormal", function () {
    var estado = $(this).attr("estado");
    if (estado == 0) {
        var txtValDesc = document.getElementById("txtValDescNormal").value;
        $(this).removeClass('btn-danger');
        $(this).addClass('btn-warning');
        $(this).attr("estado", 1);
        $('#percentQueTNormal').html('Q');
    } else if (estado == 1) {
        $(this).removeClass('btn-warning');
        $(this).addClass('btn-danger');
        $(this).attr("estado", 0);
        $('#percentQueTNormal').html('%');
    }
});
$(document).on("click", ".btnAgregarOtrosNormal", function () {
    var estado = $(this).attr("estado");
    if (estado == 0) {
        $(this).attr("estado", 1);
    }
    var valor = document.getElementById("valOtros").value;
    if (valor == "") {
        Swal.fire({
            type: 'error', allowOutsideClick: false,
            title: 'Sin Valor',
            text: '¡Favor especifique el valor de del servicio',
        });
    } else if (isNaN(valor)) {
        Swal.fire({
            type: 'error', allowOutsideClick: false,
            title: 'Dato no Adminitido',
            text: '¡Ingrese el valor del servicio',
        });
    } else if (valor >= 1) {
        var servicio = document.getElementById("agregarMasServicios").value;
        var str_esc = escape(servicio);
        /*    var data = JSON.parse(divListaOtros);*/
        lista = [];
        lista.push({
            "servicio": str_esc,
            "valor": valor
        });
        document.getElementById("divOtros").innerHTML += `<input type="hidden" id="hiddenArrayOtros" value= ` + (JSON.stringify(lista)) + `>`;
        if (estado == 0) {
            document.getElementById("totalOtros").innerHTML = '<span id="spantotalOtros" class="badge badge-warning" onmouseover="capturarOtrosNormalD()">' + valor + '</span>';
            document.getElementById("hiddenTotalesOtros").value = valor;
            document.getElementById("detalleOtros").innerHTML = valor;
            var valOtroF = document.getElementById("hiddenTotalesOtros").value;
            var tipoOpe = 3;
            var val = funcionSumaAlgebraicaNormal(valOtroF, tipoOpe);
            console.log(val);
            document.getElementById("factTNormalRec").innerHTML = val;
            formatNumber("detalleOtros");
            formatNumber("spantotalOtros");
        } else if (estado == 1) {
            var tipoOpe = 1;
            var val = funcionSumaAlgebraicaNormal(valor, tipoOpe);
            document.getElementById("spantotalOtros").innerHTML = val;
            document.getElementById("hiddenTotalesOtros").value = val;
            document.getElementById("detalleOtros").innerHTML = val;
            var valOtroF = document.getElementById("hiddenTotalesOtros").value;
            var tipoOpe = 3;
            var val = funcionSumaAlgebraicaNormal(valOtroF, tipoOpe);
            document.getElementById("factTNormalRec").innerHTML = val;
            formatNumber("detalleOtros");
            formatNumber("spantotalOtros");
            formatNumber("factTNormalRec");
        }
    }
})

function funcionSumaAlgebraicaNormal(valor, tipoOpe) {
    var spanTotales = document.getElementById("hiddenTotalesOtros").value;
    var spanTotales = parseFloat(spanTotales).toFixed(2);
    var convSpanTotales = (spanTotales * 1);
    var convValor = (valor * 1);
    var hiddenAlmacenaje = document.getElementById("hiddenAlmacenaje").value;
    var hiddenAlmacenaje = parseFloat(hiddenAlmacenaje).toFixed(2);
    var hiddenAlmacenaje = (hiddenAlmacenaje * 1);
    var hiddenZonaAduana = document.getElementById("hiddenZonaAduana").value;
    var hiddenZonaAduana = parseFloat(hiddenZonaAduana).toFixed(2);
    var hiddenZonaAduana = (hiddenZonaAduana * 1);
    var hiddenManejo = document.getElementById("hiddenManejo").value;
    var hiddenManejo = parseFloat(hiddenManejo).toFixed(2);
    var hiddenManejo = (hiddenManejo * 1);
    var hiddenGstosAdmin = document.getElementById("hiddenGstosAdmin").value;
    var hiddenGstosAdmin = parseFloat(hiddenGstosAdmin).toFixed(2);
    var hiddenGstosAdmin = (hiddenGstosAdmin * 1);
    var almacenaje = (hiddenAlmacenaje + hiddenZonaAduana + hiddenManejo + hiddenGstosAdmin);
    var hiddenTotalesOtros = document.getElementById("hiddenTotalesOtros").value;
    var hiddenTotalesOtros = parseFloat(hiddenTotalesOtros).toFixed(2);
    var otrosSuma = (hiddenTotalesOtros * 1);
    var spanDescuento = document.getElementById("hiddenDescuentoRest").value;
    var spanDescuento = parseFloat(spanDescuento).toFixed(2);
    var convspanDescuento = (spanDescuento * 1);
    if (tipoOpe == 1) {
        var convtotalOtros = (convSpanTotales + convValor - convspanDescuento);
    } else if (tipoOpe == 2) {
        var convtotalOtros = (convSpanTotales - convValor - convspanDescuento);
    } else if (tipoOpe == 3) {
        var convtotalOtros = (almacenaje + convValor - convspanDescuento);
    } else if (tipoOpe == 4) {
        var convtotalOtros = (almacenaje - convValor - convspanDescuento);
    } else if (tipoOpe == 5) {
        var convtotalOtros = otrosSuma + convValor;
    }
    var convtotalOtros = parseFloat(convtotalOtros).toFixed(2);
    return convtotalOtros;
}

function capturarOtrosNormalD(e) {
    document.getElementById("divCrearListOtros").innerHTML = '';
    if ($("#listDifinitiva").length >= 1) {
        var listaDef = document.getElementById("listDifinitiva").value;
        var listaDef = JSON.parse(listaDef);
        console.log(listaDef);
        var listaNuevaOtros = [];
        for (var i = 0; i < listaDef.length; i++) {
            var servicioOtro = listaDef[i]["servicio"];
            var valorOtro = listaDef[i]["valor"];
            document.getElementById("divCrearListOtros").innerHTML += `
                <ul class="nav flex-column">
                  <li class="nav-item">
                    <a href="#" class="nav-link" style="cursor: default;">
                        ` + servicioOtro + ` <span class="float-right badge bg-danger"style="cursor: default;">` + valorOtro + `&nbsp;&nbsp;<i class="fa fa-close" numArray = ` + [i] + ` id="otrosTooltip" style="cursor: pointer;"></i></span>
                    </a>
                  </li>
                </ul>
`;
            listaNuevaOtros.push({
                "numerador": [i],
                "servicio": servicioOtro,
                "valor": valorOtro
            });
        }
        document.getElementById("divCrearListOtros").innerHTML += '<input type="hidden" id="hiddenArrayOt" value=' + JSON.stringify(listaDef) + '>';
        var x = event.clientX;
        var y = event.clientY;
        $("#tipOtros").css("left", x - 250);
        $("#tipOtros").css("top", y - 150);
        $("#tipOtros").css("display", "inline-block");
    } else {
        document.getElementById("divCrearListOtros").innerHTML = '';
        var paragraphs = Array.from(document.querySelectorAll("#hiddenArrayOtros"));
        listaArray = [];
        for (var i = 0; i < paragraphs.length; i++) {
            var dataServi = paragraphs[i].value;
            var data = JSON.parse(dataServi);
            listaArray.push(data);
        }
        listaNuevaOtros = [];
        for (var i = 0; i < listaArray.length; i++) {
            var servicioOtro = listaArray[i][0]["servicio"];
            var valorOtro = listaArray[i][0]["valor"];
            listaNuevaOtros.push({
                "numerador": [i],
                "servicio": servicioOtro,
                "valor": valorOtro
            });
            document.getElementById("divCrearListOtros").innerHTML += `
                <ul class="nav flex-column">
                  <li class="nav-item">
                    <a href="#" class="nav-link" style="cursor: default;">
                        ` + servicioOtro + ` <span class="float-right badge bg-danger"style="cursor: default;">` + valorOtro + `&nbsp;&nbsp;<i class="fa fa-close" numArray = ` + [i] + ` id="otrosTooltip" style="cursor: pointer;"></i></span>
                    </a>
                  </li>
                </ul>
`;
        }
        document.getElementById("divCrearListOtros").innerHTML += '<input type="hidden" id="hiddenArrayOt" value=' + (JSON.stringify(listaNuevaOtros)) + '>';
        var x = event.clientX;
        var y = event.clientY;
        $("#tipOtros").css("left", x - 250);
        $("#tipOtros").css("top", y - 150);
        $("#tipOtros").css("display", "inline-block");
    }
}
$(document).on("click", ".btnNuevoServicios", function () {
    var selectOtrosServ = document.getElementById("selectOtrosServ").value;
    var montoOtroServicio = document.getElementById("montoOtroServicio").value;
    if (!isNaN(selectOtrosServ) && !isNaN(montoOtroServicio) && montoOtroServicio >= 0.01 && selectOtrosServ >= 1) {
        var selectOtrosServText = document.getElementById("selectOtrosServ");
        var selected = selectOtrosServText.options[selectOtrosServText.selectedIndex].text;
        console.log(selected);
        selectOtrosServ.disabled = false;
        if ($('#valueCombo' + selectOtrosServ).length == 0) {
            document.getElementById("montoOtroServicio").value = "";
            $("#divOtrosServicios").append('<div id="divNumero" class="col-12"><div class="input-group mb-3"> <div class="input-group-prepend"><button type="button" class="btn btn-danger btnEliminarOtroServ" id="valueCombo' + selectOtrosServ + '" idValue="' + selectOtrosServ + '"><i class="fa fa-trash"></i></button></div><input type="text" class="form-control" readOnly="readOnly" value="' + selected + '" /><input type="number"  class="form-control textOtros" id="montoServicioText' + selectOtrosServ + '" value="' + montoOtroServicio + '" /></div></div>');
            var paragraphs = Array.from(document.querySelectorAll(".textOtros"));
            console.log(paragraphs);
            var dataOtrosSum = 0;
            for (var i = 0; i < paragraphs.length; i++) {
                var dataOtrosSum = dataOtrosSum + paragraphs[i].valueAsNumber;
            }
            if ($("#spanOtro").length >= 1) {


                document.getElementById("spanOtro").innerHTML = dataOtrosSum;
                document.getElementById("detalleOtros").innerHTML = dataOtrosSum;
                document.getElementById("hiddenOtros").value = dataOtrosSum;
                formatNumber("spanOtro");
                formatNumber("detalleOtros");
                totalCobrar();
            }
        } else {
            Swal.fire({
                title: 'Detalle agregado anteriormente',
                text: "Esta incluyendo nuevamente un servicio que ya fue agregado, ¿Desea continuar?",
                type: 'warning', allowOutsideClick: false,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Si, Deseo continuar!'
            }).then((result) => {
                if (result.value) {



                    var agregado = document.getElementById('montoServicioText' + selectOtrosServ).value;
                    var valueTotal = (agregado * 1) + (montoOtroServicio * 1);
                    console.log(agregado);
                    document.getElementById('montoServicioText' + selectOtrosServ).value = valueTotal;
                    Swal.fire('Agregado', 'Su operación fue realizada con exito', 'success')
                    var paragraphs = Array.from(document.querySelectorAll(".textOtros"));
                    console.log(paragraphs);
                    var dataOtrosSum = 0;
                    for (var i = 0; i < paragraphs.length; i++) {
                        var dataOtrosSum = dataOtrosSum + paragraphs[i].valueAsNumber;
                    }
                    if ($("#spanOtro").length >= 1) {
                        document.getElementById("spanOtro").innerHTML = dataOtrosSum;
                        document.getElementById("detalleOtros").innerHTML = dataOtrosSum;
                        document.getElementById("hiddenOtros").value = dataOtrosSum;
                        formatNumber("spanOtro");
                        formatNumber("detalleOtros");
                        totalCobrar();
                    }
                }
            })
        }
    } else {
        Swal.fire('Campos vacios', 'No coloco cuanto es el monto o no agrego ningun servicio, favor revice', 'error')
        document.getElementById("montoOtroServicio").value = "";
    }
})

function totalCobrar() {
    var hiddenGTOAcuse = document.getElementById("hiddenGTOAcuse").value;
    if (hiddenGTOAcuse == "") {
        hiddenGTOAcuse = 0;
    }
    var hiddenRevision = document.getElementById("hiddenRevision").value;
    var hiddenZonaAduana = document.getElementById("hiddenZonaAduana").value;
    var hiddenAlmacenaje = document.getElementById("hiddenAlmacenaje").value;
    var hiddenManejo = document.getElementById("hiddenManejo").value;
    var hiddenGstosAdmin = document.getElementById("hiddenGstosAdmin").value;
    var hiddenOtros = document.getElementById("hiddenOtros").value;
    var serviciosDefTotal = document.getElementById("serviciosDefTotal").value;
    var hiddenMarchElect = document.getElementById("hiddenMarchElect").value;
    var valDescuento = document.getElementById("valDescuento").value;


    var sumTotal = (hiddenRevision * 1 + hiddenZonaAduana * 1 + hiddenAlmacenaje * 1 + hiddenManejo * 1 + hiddenGstosAdmin * 1 + hiddenOtros * 1 + serviciosDefTotal * 1 + hiddenMarchElect * 1 + hiddenGTOAcuse * 1) - valDescuento;
    document.getElementById("spanTotalC").innerHTML = sumTotal;
    document.getElementById("totaTh").innerHTML = sumTotal;
    document.getElementById("hiddenTotalCobrar").value = sumTotal;
    formatNumber("spanTotalC");
    formatNumber("totaTh");
}
$(document).on("click", ".btnServiciosDefault", function () {
    var selectOtrosServDefault = document.getElementById("selectOtrosServDefault").value;
    var montoOtroServicioDefault = document.getElementById("montoOtroServicioDefault").value;
    if (!isNaN(selectOtrosServDefault) && !isNaN(montoOtroServicioDefault) && montoOtroServicioDefault >= 0.01 && selectOtrosServDefault >= 1) {
        var selectOtrosServDefaultText = document.getElementById("selectOtrosServDefault");
        var selected = selectOtrosServDefaultText.options[selectOtrosServDefaultText.selectedIndex].text;
        console.log(selected);
        selectOtrosServDefault.disabled = false;
        if ($('#valueComboDefault' + selectOtrosServDefault).length == 0) {
            document.getElementById("montoOtroServicioDefault").value = "";
            $("#divServiciosDefault").append('<div id="divNumeroDefatult" class="col-12"><div class="input-group mb-3"> <div class="input-group-prepend"><button type="button" class="btn btn-danger btnEliminarServDefault" id="valueComboDefault' + selectOtrosServDefault + '" idValue="' + selectOtrosServDefault + '"><i class="fa fa-trash"></i></button></div><input type="text" class="form-control textPlusServicios" readOnly="readOnly" value="' + selected + '" /><input type="number"  class="form-control textDefaultSer" id="montoSerDefaultText' + selectOtrosServDefault + '" value="' + montoOtroServicioDefault + '" /></div></div>');
            var paragraphs = Array.from(document.querySelectorAll(".textDefaultSer"));
            console.log(paragraphs);
            var dataOtrosSum = 0;
            for (var i = 0; i < paragraphs.length; i++) {
                var dataOtrosSum = dataOtrosSum + paragraphs[i].valueAsNumber;
            }
            document.getElementById("spanServicios").innerHTML = dataOtrosSum;
            document.getElementById("serviciosDefTotal").value = dataOtrosSum;
            document.getElementById("thAlteracion").innerHTML = dataOtrosSum;
            formatNumber("spanServicios");
            totalCobrar();
        } else {
            Swal.fire({
                title: 'Detalle agregado anteriormente',
                text: "Esta incluyendo nuevamente un servicio que ya fue agregado, ¿Desea continuar?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Si, Deseo continuar!'
            }).then((result) => {
                if (result.value) {
                    var agregado = document.getElementById('montoSerDefaultText' + selectOtrosServDefault).value;
                    var valueTotal = (agregado * 1) + (montoOtroServicioDefault * 1);
                    console.log(agregado);
                    document.getElementById('montoSerDefaultText' + selectOtrosServDefault).value = valueTotal;
                    Swal.fire('Agregado', 'Su operación fue realizada con exito', 'success')
                    var paragraphs = Array.from(document.querySelectorAll(".textDefaultSer"));
                    console.log(paragraphs);
                    var dataOtrosSum = 0;
                    for (var i = 0; i < paragraphs.length; i++) {
                        var dataOtrosSum = dataOtrosSum + paragraphs[i].valueAsNumber;
                    }
                    document.getElementById("spanServicios").innerHTML = dataOtrosSum;
                    document.getElementById("serviciosDefTotal").value = dataOtrosSum;
                    document.getElementById("thAlteracion").innerHTML = dataOtrosSum;
                    formatNumber("spanServicios");
                    totalCobrar();
                }
            })
        }
    } else {
        Swal.fire('Campos vacios', 'No coloco cuanto es el monto o no agrego ningun servicio, favor revice', 'error')
        document.getElementById("montoOtroServicioDefault").value = "";
    }
})

$(document).on("mouseover", ".btnDescuento", async function () {
    if ($("#hiddenAlmacenaje").val() == 0) {
        Swal.fire({
            position: 'top-end',
            type: 'error', allowOutsideClick: false,
            title: 'No puede hacer descuento porque el valor de almacenaje es 0',
            showConfirmButton: false,
            timer: 4500

        })
    }

})
$(document).on("click", ".btnDescuento", async function () {
    const {
        value: tipoDescuento
    } = await Swal.fire({
        title: 'Select field validation',
        input: 'select',
        inputOptions: {
            Porcentaje: 'Descuento porcentaje',
            Quetzales: 'Descuento quetzales',
        },
        inputPlaceholder: 'Seleccione el tipo de descuento',
        showCancelButton: true,
        inputValidator: (value) => {
            console.log(value);
            return new Promise((resolve) => {
                if (value === 'Quetzales') {
                    resolve()
                } else if (value === 'Porcentaje') {
                    resolve()
                } else {
                    resolve('No selecciono ningun descuento')
                }
            })
        }
    })
    if ($("#hiddenAlmacenaje").val() != 0) {

        if (tipoDescuento) {
            var paragraphs = Array.from(document.querySelectorAll(".textDefaultSer"));
            var paragraphsS = Array.from(document.querySelectorAll(".textPlusServicios"));
            var valServicio = 0;
            var dataOtrosSum = 0;
            for (var i = 0; i < paragraphs.length; i++) {
                var nombreDeServicio = paragraphsS[i].value;
                if (nombreDeServicio == "Almacenaje") {
                    var valServicio = valServicio + paragraphs[i].valueAsNumber;
                }
            }

            if (tipoDescuento == "Quetzales") {
                const {
                    value: valDescuentoQP
                } = await Swal.fire({
                    title: 'Ingresa el valor del descuento en quetzales',
                    input: 'text',
                    inputPlaceholder: 'Ingrese el descuento ejemplo : 250'
                })




                if (valDescuentoQP) {
                    if (!isNaN(valDescuentoQP) && valDescuentoQP >= 0.01) {

                        var resp = await registroDescuentosQ(valDescuentoQP, valServicio);
                    }
                }
            }
            if (tipoDescuento == "Porcentaje") {
                const {
                    value: valDescuentoQP
                } = await Swal.fire({
                    title: 'Ingresa el valor del descuento en porcentaje',
                    input: 'text',
                    inputPlaceholder: 'Ingrese el descuento ejemplo : 0.025'
                })
                if (valDescuentoQP) {
                    if (!isNaN(valDescuentoQP) && valDescuentoQP >= 0.0001) {
                        var numDesPQ = valDescuentoQP.toFixed(5);
                        var resp = await registrarDescuentoPercent(valDescuentoQP, valServicio);
                    }
                }
            }
        }
    } else {
        Swal.fire(
                'Descuento Bloqueado',
                'No puede hacer descuento porque el valor de almacenaje es 0',
                'error'
                )
    }
})
$(document).on("click", ".imprimirReciboAlmacenaje", async function () {
    //Retiro
    var idNitFact = document.getElementById("hiddenIdNitFact").value;
    if (idNitFact >= 1) {


        var idRet = $(this).attr("idRet");
        var nomVar = "paseSalRetVal";
        var resp = await AjaxUnParam(idRet, nomVar);
        console.log(resp);
        if (resp[0].cantidadPlt >= 1) {
            //Ingreso 
            var hiddenresultIdIngreso = document.getElementById("hiddenresultIdIngreso").value;
            //Otros servicios
            var paragraphs = Array.from(document.querySelectorAll(".btnEliminarOtroServ"));
            listaOtros = [];
            listaServiciosDefault = [];
            if (paragraphs.length == 0) {
                var otrosValores = 0;
            } else {
                for (var i = 0; i < paragraphs.length; i++) {
                    var servicioOtro = paragraphs[i].attributes.idvalue.value;
                    var valOtro = document.getElementById("montoServicioText" + servicioOtro).value;
                    listaOtros.push({
                        "serviciosOtros": servicioOtro,
                        "valorOtros": valOtro
                    });
                }
                // Recorrido de listas y descuentos para mostra al cliente.
                // Recorrido otros servicios Ejemplo: Tomas electricas, fotocopias, desechos de madera, tiempos extraOrdinarios, etc...
                var otrosValores = 0;
                for (var i = 0; i < listaOtros.length; i++) {
                    var otrosValores = (listaOtros[i].valorOtros * 1) + otrosValores;
                }
                var listaOtros = JSON.stringify(listaOtros);
            }
            //Servicios default
            var paragraphs = Array.from(document.querySelectorAll(".btnEliminarServDefault"));

            if (paragraphs.length == 0) {
                console.log("no hay");
                var valServicio = 0.00;
            } else {
                for (var i = 0; i < paragraphs.length; i++) {
                    var servicioDef = paragraphs[i].attributes.idvalue.value;
                    var valServicios = document.getElementById("montoSerDefaultText" + servicioDef).value;
                    listaServiciosDefault.push({
                        "serviciosDefault": servicioDef,
                        "valServicios": valServicios
                    });
                }
                // Recorrido de aumento a servicios base: Zona aduanera, Almacenaje, Manejo, Gastos administrativos...
                var valServicio = 0;
                for (var i = 0; i < listaServiciosDefault.length; i++) {
                    var valServicio = (listaServiciosDefault[i].valServicios) * 1 + valServicio;
                }
                var listaServiciosDefault = JSON.stringify(listaServiciosDefault);
            }
            //Descuento 
            var valDescuento = document.getElementById("valDescuento").value;
            var hiddenDescuento = document.getElementById("hiddenDescuento").value;
            // Valor calculado 
            var valCalculado = await totalCobrar();
            valCalculado = parseFloat(valCalculado).toFixed(2);
            //Total a cobrar 
            var hiddenTotalCobrar = (valCalculado + otrosValores + valServicio) - valDescuento;
            console.log(valDescuento);
            //Total a cobrar 
            var hiddenTotalCobrar = document.getElementById("hiddenTotalCobrar").value;
            // Valor calculado 
            var valCalculado = await totalCalculado();
            if (valCalculado > 0) {
                const {
                    value: tipoDescuento
                } = await Swal.fire({
                    type: 'info',
                    allowOutsideClick: false,
                    title: '¿Desea guardar cambios?',
                    html: '<strong>¡Se generará un pdf con el recibo de almacenaje!</strong><br/><br/><b>Servicios Calculado : </b>Q. ' + valCalculado + '<br/><b>Aumento en servicios : </b>Q. ' + valServicio + '<br/><b>Otros Servicios :</b>Q. ' + otrosValores + '<br/><b>Descuento del ' + hiddenDescuento + ' % : </b>Q. ' + valDescuento + '<br/>___________________________________<br/><br/><strong>Total a Facutrar Q. ' + hiddenTotalCobrar + '</strong>',
                    showCancelButton: true,
                    inputValidator: (value) => {
                        console.log(value);
                        return new Promise((resolve) => {
                            resolve();
                        });
                    }
                });
                if (tipoDescuento) {
                    if ($("#dateTime").val() == "") {
                        var hiddenDateTimeVal = "NA";
                    } else {
                        var hiddenDateTimeVal = $("#dateTime").val();
                    }

                    var guardarRecibo = await guardarRecibosAlmacenaje(idRet, hiddenresultIdIngreso, listaOtros, listaServiciosDefault, valDescuento, hiddenDescuento, hiddenDateTimeVal, idNitFact);
                    if (guardarRecibo == "ARegistrado") {
                        Swal.fire({
                            title: 'Recibo Creado',
                            text: "¿Desea Imprimir?",
                            type: 'warning', allowOutsideClick: false,
                            allowOutsideClick: false,
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Si, Imprimir'
                        }).then((result) => {
                            if (result.value) {
                                window.open("extensiones/tcpdf/pdf/Recibo-fiscal.php?codigo=" + idRet, "_blank");

                            }
                        });
                    } else if (guardarRecibo === "ok") {
                        window.open("extensiones/tcpdf/pdf/Recibo-fiscal.php?codigo=" + idRet, "_blank");

                    }
                }
            }
        } else {
            Swal.fire({
                title: 'Retiro sin piloto',
                text: "No se registro ningun transporte en el retiro, registre el piloto",
                type: 'warning', allowOutsideClick: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ok!'
            }).then((result) => {
                $("#idbtnMasPilotos").click();

            })
        }
    } else {
        document.getElementById("hiddenIdNitFact").value = "";
        Swal.fire({
            title: 'Error nit',
            text: "Intente escribir nuevamentae el numero de nit",
            type: 'warning', allowOutsideClick: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok!'
        })
    }
});

function  guardarRecibosAlmacenaje(idRet, hiddenresultIdIngreso, listaOtros, listaServiciosDefault, valDescuento, hiddenDescuento, hiddenDateTimeVal, idNitFact) {
    let gdRecibo;
    var datos = new FormData();
    console.log(listaOtros);
    console.log(listaServiciosDefault);
    console.log(valDescuento);
    console.log(listaOtros);
    console.log(listaServiciosDefault);
    console.log(hiddenDateTimeVal);
    console.log(idNitFact);

    datos.append("idRetGdRec", idRet);
    datos.append("hiddenresultIdIngresoGdRec", hiddenresultIdIngreso);
    datos.append("listaOtrosGdRec", listaOtros);
    datos.append("listaServiciosDefaultGdRec", listaServiciosDefault);
    datos.append("valDescuentoGdRec", valDescuento);
    datos.append("hiddenDescuentoGdRec", hiddenDescuento);
    datos.append("hiddenDateTimeValRecEle", hiddenDateTimeVal);
    datos.append("idNitFact", idNitFact);
    $.ajax({
        async: false,
        url: "ajax/paseDeSalida.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            if (respuesta == "ARegistrado") {
                gdRecibo = "ARegistrado";
            } else if (respuesta == "Oks") {
                gdRecibo = "ok";
            }
        }, error: function (respuesta) {
            console.log(respuesta);
        }});
    return gdRecibo;
}

function totalCalculado() {
    var hiddenZonaAduana = document.getElementById("hiddenZonaAduana").value;
    var hiddenZonaAduana = hiddenZonaAduana * 1;
    var hiddenAlmacenaje = document.getElementById("hiddenAlmacenaje").value;
    var hiddenAlmacenaje = hiddenAlmacenaje * 1;
    var hiddenManejo = document.getElementById("hiddenManejo").value;
    var hiddenManejo = hiddenManejo * 1;
    var hiddenGstosAdmin = document.getElementById("hiddenGstosAdmin").value;
    var hiddenGstosAdmin = hiddenGstosAdmin * 1;

    var hiddenMarchElect = document.getElementById("hiddenMarchElect").value;
    var hiddenMarchElect = hiddenMarchElect * 1;

    var hiddenRevision = document.getElementById("hiddenRevision").value;
    var hiddenRevision = hiddenRevision * 1;

    var result = (hiddenZonaAduana + hiddenAlmacenaje + hiddenManejo + hiddenGstosAdmin + hiddenRevision + hiddenMarchElect);
    return result;
}

function ajaxImpresionRecibo(idRet, hiddenresultIdIngreso, listaOtros, listaServiciosDefault, valDescuento, hiddenDescuento) {
    console.log(idRet);
    console.log(hiddenresultIdIngreso);
    console.log(listaOtros);
    console.log(listaServiciosDefault);
    console.log(valDescuento);
    console.log(hiddenDescuento);
}

function limpiarValoresDigitados() {
    document.getElementById("valorDoll").value = "";
    document.getElementById("tCambio").value = "";
    document.getElementById("cif").value = "";
    document.getElementById("impuestos").value = "";
    document.getElementById("peso").value = "";
    document.getElementById("bultos").value = "";
    $("#valorDoll").removeClass('is-valid');
    $("#tCambio").removeClass('is-valid');
    $("#cif").removeClass('is-valid');
    $("#impuestos").removeClass('is-valid');
    $("#peso").removeClass('is-valid');
    $("#bultos").removeClass('is-valid');
    $("#valorDoll").removeClass('is-invalid');
    $("#tCambio").removeClass('is-invalid');
    $("#cif").removeClass('is-invalid');
    $("#impuestos").removeClass('is-invalid');
    $("#peso").removeClass('is-invalid');
    $("#bultos").removeClass('is-invalid');
}

$(document).on("click", "#imprimirRetiroAlmacenaje", async function () {
    //Retiro
    var idRet = $(this).attr("idret");
    console.log(idRet);
    var nomVar = "paseSalRetVal";
    var resp = await AjaxUnParam(idRet, nomVar);
    console.log(resp);
    if (resp[0].cantidadPlt >= 1) {
        var nomVar = "idRetAutorizado";
        Swal.fire({
            title: '¿Desea Autorizar Salida?',
            text: "Si autoriza el retiro el piloto podra salir de la almacenadora",
            type: 'warning', allowOutsideClick: false,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'No, Cancelar',
            confirmButtonText: 'Si, Autorizo!'
        }).then(async function (result) {
            if (result.value) {
                resp = await guardarRetiroRegistroSal(idRet, nomVar);
            }


        })
    } else {
        Swal.fire({
            title: 'Retiro sin piloto',
            text: "No se registro ningun transporte en el retiro, registre el piloto",
            type: 'warning', allowOutsideClick: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok!'
        }).then((result) => {
            $("#idbtnMasPilotos").click();

        })
    }
})

async function guardarRetiroRegistroSal(idRet, nomVar) {
    var respActivacionRet = await AjaxUnParam(idRet, nomVar);
    console.log(respActivacionRet);
    if (respActivacionRet != false) {
        console.log(respActivacionRet[0].resp);
        document.getElementById("numeroRetiro").innerHTML = '<div id="right"><h3 class="s2class"><span>No. de Retiro :</span><span class="su">' + respActivacionRet[0].resp + '</span></h3>';
        Swal.fire({
            title: "¿Desea Imprimir Retiro Fiscal?",
            text: "El retiro se registro con exito, imprima PDF",
            type: 'success', allowOutsideClick: false,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'No Imprimir',
            confirmButtonText: 'Si, Imprimir!'
        }).then((result) => {
            if (result.value) {
                window.open("extensiones/tcpdf/pdf/Retiro-fiscal.php?codigo=" + idRet, "_blank");
            }
        })
    }
}

function AjaxUnParam(idRet, nomVar) {
    let respFunc;
    var datos = new FormData();
    datos.append(nomVar, idRet);
    //   datos.append("hiddenDateTimeVal", hiddenDateTimeVal);
    $.ajax({
        async: false,
        url: "ajax/paseDeSalida.ajax.php",
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
    });
    return respFunc;
}



async function registroDescuentosQ(valDescuentoQP, valServicio) {
    var hiddenAlmacenaje = document.getElementById("hiddenAlmacenaje").value;
    var hiddenAlmacenaje = hiddenAlmacenaje * 1;
    var desTotaTh = document.getElementById("hiddenTotalCobrar").value;
    var porcentajeAlm = ((hiddenAlmacenaje + valServicio) * 1 / 100);
    var porcentaje = (valDescuentoQP / porcentajeAlm);
    var nuevoValTotal = ((hiddenAlmacenaje + valServicio) - valDescuentoQP);
    var nuevoValTotal = Math.trunc(nuevoValTotal);
    var desTotaThDef = (desTotaTh - valDescuentoQP);
    var desTotaThDef = Math.trunc(desTotaThDef);
    var decimales = 5;

    var flotante = parseFloat(porcentaje);
    var resultadoPercent = Math.round(flotante * Math.pow(10, decimales)) / Math.pow(10, decimales);



    Math.trunc(nuevoValTotal);
    if (porcentaje <= 20) {
        document.getElementById("divAlerta").innerHTML = `
 <div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>¡Esta autorizando un descuento!</strong> del ` + resultadoPercent + `% y monto de  Q ` + valDescuentoQP + ` almacenaje con descuento ` + nuevoValTotal + `
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>`;
    } else if (porcentaje >= 20.01) {
        document.getElementById("divAlerta").innerHTML = `
 <div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>¡Estas autorizando un descuento!</strong> del ` + resultadoPercent + `% y monto de  Q ` + valDescuentoQP + ` almacenaje con descuento Q. ` + nuevoValTotal + `
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>`;
    }
    console.log(valDescuentoQP);
    document.getElementById("hiddenTipoOP").value = 0;
    document.getElementById("hiddenDescuento").value = resultadoPercent;
    document.getElementById("valDescuento").value = valDescuentoQP;
    document.getElementById("spanDescuentos").innerHTML = valDescuentoQP;
    totalCobrar();
}


function registrarDescuentoPercent(valDescuentoQP, valServicio) {
    var valPorcentaje = (valDescuentoQP / 100);
    var hiddenAlmacenaje = document.getElementById("hiddenAlmacenaje").value;
    var hiddenAlmacenaje = hiddenAlmacenaje * 1;
    var desTotaTh = document.getElementById("hiddenTotalCobrar").value;
    var valDescuentoQPS = ((hiddenAlmacenaje + valServicio) * 1 * valPorcentaje);
    var valDescuento = Math.trunc((hiddenAlmacenaje + valServicio) * 1 - valDescuentoQPS);
    var nuevoValTotal = Math.trunc(valDescuentoQPS);
    var desTotaThDef = (desTotaTh - valDescuentoQPS);
    var desTotaThDef = Math.trunc(desTotaThDef);
    var valResult = nuevoValTotal + valDescuento;
    if (hiddenAlmacenaje != valResult) {
        if (hiddenAlmacenaje >= valResult) {
            var cuadre = (hiddenAlmacenaje - valResult);
            var valDescuento = valDescuento + cuadre;
        } else if (hiddenAlmacenaje <= valResult) {
            var cuadre = (valResult - hiddenAlmacenaje);
            var valDescuento = valDescuento + cuadre;
        }
    }
    if (valDescuentoQP <= 0.25) {
        document.getElementById("divAlerta").innerHTML = `
 <div class="alert alert-primary alert-dismissible fade show" role="alert">
  <strong>¡Estas autorizando un descuento!</strong> del ` + valDescuentoQP + `% y monto de  Q ` + nuevoValTotal + ` almacenaje con descuento ` + valDescuento + `
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
                        `;
    } else {
        document.getElementById("divAlerta").innerHTML = `
 <div class="alert alert-primary alert-dismissible fade show" role="alert">
  <strong>¡Estas autorizando un descuento!</strong> del ` + valDescuentoQP + `% y monto de  Q ` + nuevoValTotal + ` almacenaje con descuento ` + valDescuento + `
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
                        `;
    }
    document.getElementById("hiddenTipoOP").value = 1;
    document.getElementById("hiddenDescuento").value = valDescuentoQP;
    document.getElementById("valDescuento").value = nuevoValTotal;
    document.getElementById("spanDescuentos").innerHTML = nuevoValTotal;

    totalCobrar();
}

$(document).on("click", ".btnVerPreImpreso", async function () {
    var idretPreImp = $(this).attr("idret");
    $(".imprimirReciboAlmacenaje").attr("idret", idretPreImp);
    var nomVar = "idretPreImp";
    var resp = await AjaxUnParam(idretPreImp, nomVar);
    if (resp != "SD") {
        var nitEmpresa = resp[0].nitEmpresa;
        var nombreRet = resp[0].nombreRet;
        var direSal = resp[0].direSal;
        var idNit = resp[0].idNitRet;
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
        //Retiro
        var idRet = $(this).attr("idRet");
        var nomVar = "paseSalRetVal";
        var resp = await AjaxUnParam(idRet, nomVar);
        console.log(resp);
        if (resp[0].cantidadPlt >= 1) {
            //Ingreso 
            var hiddenresultIdIngreso = document.getElementById("hiddenresultIdIngreso").value;
            //Otros servicios
            var paragraphs = Array.from(document.querySelectorAll(".btnEliminarOtroServ"));
            listaOtros = [];
            listaServiciosDefault = [];
            if (paragraphs.length == 0) {
                var otrosValores = 0;
            } else {
                for (var i = 0; i < paragraphs.length; i++) {
                    var servicioOtro = paragraphs[i].attributes.idvalue.value;
                    var valOtro = document.getElementById("montoServicioText" + servicioOtro).value;
                    listaOtros.push({
                        "serviciosOtros": servicioOtro,
                        "valorOtros": valOtro
                    });
                }
                // Recorrido de listas y descuentos para mostra al cliente.
                // Recorrido otros servicios Ejemplo: Tomas electricas, fotocopias, desechos de madera, tiempos extraOrdinarios, etc...
                var otrosValores = 0;
                for (var i = 0; i < listaOtros.length; i++) {
                    var otrosValores = (listaOtros[i].valorOtros * 1) + otrosValores;
                }
                var listaOtros = JSON.stringify(listaOtros);
            }
            //Servicios default
            var paragraphs = Array.from(document.querySelectorAll(".btnEliminarServDefault"));

            if (paragraphs.length == 0) {
                console.log("no hay");
                var valServicio = 0.00;
            } else {
                for (var i = 0; i < paragraphs.length; i++) {
                    var servicioDef = paragraphs[i].attributes.idvalue.value;
                    var valServicios = document.getElementById("montoSerDefaultText" + servicioDef).value;
                    listaServiciosDefault.push({
                        "serviciosDefault": servicioDef,
                        "valServicios": valServicios
                    });
                }
                // Recorrido de aumento a servicios base: Zona aduanera, Almacenaje, Manejo, Gastos administrativos...
                var valServicio = 0;
                for (var i = 0; i < listaServiciosDefault.length; i++) {
                    var valServicio = (listaServiciosDefault[i].valServicios) * 1 + valServicio;
                }
                var listaServiciosDefault = JSON.stringify(listaServiciosDefault);
            }
            //Descuento 
            var valDescuento = document.getElementById("valDescuento").value;
            if (valDescuento == "") {
                var valDescuento = 0;
            }
            var hiddenDescuento = document.getElementById("hiddenDescuento").value;
            // Valor calculado 
            var valCalculado = await totalCobrar();
            valCalculado = parseFloat(valCalculado).toFixed(2);
            //Total a cobrar 
            var hiddenTotalCobrar = (valCalculado + otrosValores + valServicio) - valDescuento;
            console.log(valDescuento);
            //Total a cobrar 
            var hiddenTotalCobrar = document.getElementById("hiddenTotalCobrar").value;
            // Valor calculado 
            var valCalculado = await totalCalculado();
            var valCalculados = parseFloat(valCalculado).toFixed(2);
            var valCalculados = new Intl.NumberFormat("en-GT").format(valCalculados);

            var valServicios = parseFloat(valServicio).toFixed(2);
            var valServicios = new Intl.NumberFormat("en-GT").format(valServicios);

            var otrosValor = parseFloat(otrosValores).toFixed(2);
            var otrosValor = new Intl.NumberFormat("en-GT").format(otrosValor);

            var valDescuento = parseFloat(valDescuento).toFixed(2);
            var valDescuento = new Intl.NumberFormat("en-GT").format(valDescuento);

            var hiddenTotalCobrar = parseFloat(hiddenTotalCobrar).toFixed(2);
            var hiddenTotalCobrar = new Intl.NumberFormat("en-GT").format(hiddenTotalCobrar);
            console.log("hola mundo");
            document.getElementById("tableDetalleConsumo").innerHTML = `
            <tr><td>1</td>
            <td>Servicios Calculados</td>
            <td><center>` + valCalculados + `</center></td></tr>
            <tr><td>2</td>
            <td>Aumento en servicios</td>
            <td><center>` + valServicios + `</center></td></tr>
            <tr><td>3</td>
            <td>Otros Servicios</td>
            <td><center>` + otrosValor + `</center></td></tr>
            <tr><td>4</td>
            <td>Descuento del ` + hiddenDescuento + `  % : </td>
            <td><center>` + valDescuento + `</center></td></tr>          
        `;

            document.getElementById("totalCobro").innerHTML = '<center>' + hiddenTotalCobrar + '</center>';

        } else {
            Swal.fire({
                title: 'Retiro sin piloto',
                text: "No se registro ningun transporte en el retiro, registre el piloto",
                type: 'warning', allowOutsideClick: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ok!'
            }).then((result) => {
                $("#idbtnMasPilotos").click();

            })
        }
    }
});

$(document).on("click", ".btnExcelRetSal", async function () {
    var idRet = $(this).attr("idRet");
    console.log(idRet);
    var nomVar = "idRetFEx";
    var respuesta = await AjaxUnParam(idRet, nomVar);
    var nombreEncabezado = "DescargaReporteExcel";
    var nombreFile = "datosRetiros_";
    var nombreReporte = "RetirosFiscales";
    var creaExcel = await JSONToCSVDescargaExcel(respuesta, nombreEncabezado, nombreReporte, nombreFile, true);
    console.log(resp);
})

$(document).on("click", "#btnVehNew", async function () {
    document.getElementById("tableVehUsados").innerHTML = "";
    document.getElementById("tableVehUsados").innerHTML = '<table id="tablaMerRetiroVeh" class="table table-hover table-sm"></table><input type="hidden" id="hiddenListaDeta" value="">';

    var idRet = $(this).attr("idRet");
    var nomVar = "idRetVehN";
    var respuesta = await AjaxUnParam(idRet, nomVar);
    listVeh = [];

    for (var i = 0; i < respuesta.length; i++) {
        var idChas = respuesta[i].id;
        var polizaRetiro = respuesta[i].polizaRetiro;
        var chasis = respuesta[i].chasis;
        var tipoVehiculo = respuesta[i].tipoVehiculo;
        var linea = respuesta[i].linea;
        var predio = respuesta[i].predio;
        var aduanaV = '<input type="number" class="form-control form-control-sm is-invalid textValAduana" id="textValAd' + i + '" idNum=' + i + ' value="" />';
        var cif = '<input type="number" class="form-control form-control-sm is-invalid textTCambio" id="textValTcambio' + i + '" idNum=' + i + ' value="" />';
        var impuesto = '<input type="number" class="form-control form-control-sm is-invalid textImpuesto" id="textValImpt' + i + '" idNum=' + i + ' value="" />';
        var total = '<input type="number" class="form-control form-control-sm is-invalid valTextTotal" idChasis =' + idChas + '  id="textValTotal' + i + '" idNum=' + i + ' value="" />';

        listVeh.push([chasis, tipoVehiculo, linea, predio, aduanaV, cif, impuesto, total]);

    }
    $('#tablaMerRetiroVeh').DataTable({
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
        data: listVeh,
        columns: [{
                title: "Chasis"
            }, {
                title: "Tipo Vehiculo"
            }, {
                title: "Linea"
            }, {
                title: "Predio"
            }, {
                title: "Val. Aduana"
            }, {
                title: "CIF"
            }, {
                title: "Impuestos"
            }, {
                title: "Total Vehiculo"
            }]
    });
})

$(document).on("change", ".textValAduana", async function () {
    var idNum = $(this).attr("idNum");
    var costeo = await valTotalCosteo(idNum);
    var textValTotal = "textValTotal" + idNum;
    document.getElementById(textValTotal).value = costeo;
    $("#textValAd" + idNum).removeClass("is-invalid");
    $("#textValAd" + idNum).addClass("is-valid");
    if (costeo > 0) {
        $("#valTextTotal" + idNum).removeClass("is-invalid");
        $("#valTextTotal" + idNum).addClass("is-valid");
    }

})

$(document).on("change", ".textTCambio", async function () {
    var idNum = $(this).attr("idNum");
    var costeo = await valTotalCosteo(idNum);
    var textValTotal = "textValTotal" + idNum;
    document.getElementById(textValTotal).value = costeo;
    $("#textValTcambio" + idNum).removeClass("is-invalid");
    $("#textValTcambio" + idNum).addClass("is-valid");
    if (costeo > 0) {
        $("#textValTotal" + idNum).removeClass("is-invalid");
        $("#textValTotal" + idNum).addClass("is-valid");
    }
})

$(document).on("change", ".textImpuesto", async function () {
    var idNum = $(this).attr("idNum");
    var costeo = await valTotalCosteo(idNum);
    var textValTotal = "textValTotal" + idNum;
    document.getElementById(textValTotal).value = costeo;
    $("#textValImpt" + idNum).removeClass("is-invalid");
    $("#textValImpt" + idNum).addClass("is-valid");
    if (costeo > 0) {
        $("#textValTotal" + idNum).removeClass("is-invalid");
        $("#textValTotal" + idNum).addClass("is-valid");
    }
})



function valTotalCosteo(idNum) {
    var textValAd = "textValAd" + idNum;
    var textValTcambio = "textValTcambio" + idNum;
    var textValImpt = "textValImpt" + idNum;

    var valDol = document.getElementById(textValAd).value;
    var valDol = Number.parseFloat(valDol).toFixed(5);
    var valDol = valDol * 1;


    var valTcambio = document.getElementById(textValTcambio).value;
    var valTcambio = Number.parseFloat(valTcambio).toFixed(4);
    var valTcambio = valTcambio * 1;

    var valImpuesto = document.getElementById(textValImpt).value;
    var valImpuesto = Number.parseFloat(valImpuesto).toFixed(2);
    var valImpuesto = valImpuesto * 1;

    var total = (valDol * valTcambio) + valImpuesto;
    var total = Number.parseFloat(total).toFixed(2);
    var total = total * 1;
    if (total > 0) {
        $("#textValTotal" + idNum).removeClass("is-invalid");
        $("#textValTotal" + idNum).addClass("is-valid");
    }
    return total;

}

$(document).on("click", ".btnTomarDatRet", async function () {
    var paragraphs = Array.from(document.querySelectorAll(".valTextTotal"));
    if (paragraphs.length == 1) {
        var valorDoll = document.getElementById("valorDoll").value;
        var tCambio = document.getElementById("tCambio").value;
        var cif = document.getElementById("cif").value;
        var impuestos = document.getElementById("impuestos").value;
        var peso = document.getElementById("peso").value;
        var bultos = document.getElementById("bultos").value;
        if (valorDoll > 0 && tCambio > 0 && cif > 0 && impuestos > 0 && peso > 0 && bultos > 0) {
            document.getElementById("textValAd0").value = valorDoll;
            $("#textValAd0").trigger('change');

            document.getElementById("textValTcambio0").value = tCambio;
            $("#textValTcambio0").trigger('change');

            document.getElementById("textValImpt0").value = impuestos;
            $("#textValImpt0").trigger('change');

            document.getElementById("textValTotal0").value = valorDoll;
            $("#textValTotal0").trigger('change');

        }
    }


})
