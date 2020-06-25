$(document).on("click", ".btnCalculos", function () {
    document.getElementById("detalleCalculo").innerHTML = `
                    <table id="DetalleCalculosFiscales" role="grid" class="table table-hover table-striped table-bordered display table-sm" cellspacing="0" >
                      </table>
                      <br/>
                      <br/>`;
    var buttonidingreso = $(this).attr("buttonidingreso");
    var datos = new FormData();
    datos.append("buttonidingreso", buttonidingreso);
    $.ajax({
        url: "ajax/calcAlmacenajeF.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            Swal.fire({
                imageUrl: 'https://i.pinimg.com/originals/78/e8/26/78e826ca1b9351214dfdd5e47f7e2024.gif',
                html: 'Presione Ok para ver calculo'
            }).then((result) => {
                if (result.value) {
                    if (respuesta != "ST") {

                        if (respuesta["reciboCobrado"] == "reciboCobrado") {
                            Swal.fire({
                                type: 'error',
                                title: 'Recibo Cobrado',
                                text: 'No se puede facturar, fue facturado con recibo:  ' + respuesta["recibo"] + ',  el dia de hoy: ' + respuesta["fecha"],
                            });
                        } else {
                            document.getElementById("divInfo").innerHTML = "";
                            document.getElementById("divBottons").innerHTML = "";
                            document.getElementById("detallePol").innerHTML = respuesta["results"][0].poliza + '<br/>' + respuesta["results"][0].ingreso + '<br/>' + respuesta["results"][0].fIngreso;
                            document.getElementById("detalleVal").innerHTML = respuesta["results"][0].blts + '<br/>' + respuesta["results"][0].cif + '<br/>' + respuesta["results"][0].imputs;
                            document.getElementById("detalleEspace").innerHTML = respuesta["results"][0].blts + '<br/>' + respuesta["results"][0].mts + '<br/>' + respuesta["results"][0].pos;
                            var resultIdIng = respuesta["results"][0].idIng;
                            var lista = [];
                            for (var i = 0; i < respuesta["resCalSaldoDiarioBaseDiaria"].length; i++) {
                                if (respuesta["resCalSaldoDiarioBaseDiaria"][i].posSaldo >= 1) {
                                    if (i == 0) {
                                        var fechaIngreso = respuesta["resCalSaldoDiarioBaseDiaria"][i].fechaIn;
                                        var sumaContAlmacenaje = 0;
                                        var sumaContSeguro = 0;
                                        var totaACobrar = 0;
                                    }


                                    var numero = (i + 1);
                                    var poliza = respuesta["resCalSaldoDiarioBaseDiaria"][i].poliza;
                                    var valorTarifa = respuesta["resCalSaldoDiarioBaseDiaria"][i].valorTarifa;
                                    var fechaIn = respuesta["resCalSaldoDiarioBaseDiaria"][i].fechaIn;
                                    var fechaCorte = respuesta["resCalSaldoDiarioBaseDiaria"][i].fechaCorte;
                                    var dias = respuesta["resCalSaldoDiarioBaseDiaria"][i].dias;
                                    var unidades = respuesta["resCalSaldoDiarioBaseDiaria"][i].posSaldo;
                                    var cifImpuestos = parseFloat(respuesta["resCalSaldoDiarioBaseDiaria"][i].cifImpuestos).toFixed(2);
                                    var almacenaje = respuesta["resCalSaldoDiarioBaseDiaria"][i].almacenaje;
                                    var tipoMov = respuesta["resCalSaldoDiarioBaseDiaria"][i].tipoMov;
                                    if (respuesta["tipo"] != "noFacturado") {


                                        if (tipoMov == "movCobrado") {
                                            var buttonMov = '<button type="button" class="btn btn-outline-success btn-sm">Cobrado</button>';
                                        } else if (tipoMov == "pendiente") {
                                            var buttonMov = '<button type="button" class="btn btn-outline-danger btn-sm">Pendiente</button>';
                                        }
                                    } else {
                                        var buttonMov = '<button type="button" class="btn btn-outline-danger btn-sm">Pendiente</button>';
                                    }
                                    if (i == 0) {
                                        var cantToneladas = respuesta["resCalSaldoDiarioBaseDiaria"][i].toneladas;
                                        var cantPesoCalculo = respuesta["resCalSaldoDiarioBaseDiaria"][i].pesoCalculo;
                                        var cantCalcGstAdmin = respuesta["resCalSaldoDiarioBaseDiaria"][i].calcGstAdmin;
                                    }
                                    var toneladas = respuesta["resCalSaldoDiarioBaseDiaria"][i].toneladas;
                                    var pesoCalculo = respuesta["resCalSaldoDiarioBaseDiaria"][i].pesoCalculo;
                                    var calcGstAdmin = respuesta["resCalSaldoDiarioBaseDiaria"][i].calcGstAdmin;
                                    var totalAlmacenaje = respuesta["resCalSaldoDiarioBaseDiaria"][i].totalAlmacenaje;
                                    var resSeguro = respuesta["resCalSaldoDiarioBaseDiaria"][i].resSeguro
                                    var sumaContAlmacenaje = (sumaContAlmacenaje + almacenaje);
                                    var parseAlmacenaje = parseFloat(sumaContAlmacenaje).toFixed(2);
                                    var sumaContSeguro = (sumaContSeguro + resSeguro);
                                    var parseSeguro = parseFloat(sumaContSeguro).toFixed(2);
                                    if (i == 0) {
                                        var manejo = pesoCalculo;
                                        var gstsAd = calcGstAdmin;
                                    }

                                    var numRow = respuesta["resCalSaldoDiarioBaseDiaria"].length;
                                    var fechaInicio = respuesta["resCalSaldoDiarioBaseDiaria"][0].fechaIn;
                                    var fechaFin = respuesta["resCalSaldoDiarioBaseDiaria"][i].fechaCorte;

                                    $("#divDetallePoliza").html(`
            <div class="info-box">
              <span class="info-box-icon bg-warning"><i class="fa fa-archive"></i></span>

              <div class="info-box-content">
                <span class="info-box-text nomPolTablaIterada">Poliza : <b style="color:red;">` + respuesta["results"][0].poliza + `</b> </span>
                <span class="info-box-number polizaIterada"> Del ` + fechaInicio + ` Al ` + fechaCorte + `</span>
              </div>
            </div>`);
                                    lista.push([numero, fechaIn, fechaCorte, dias, unidades, cifImpuestos, almacenaje, toneladas, pesoCalculo, resSeguro, calcGstAdmin, totalAlmacenaje, buttonMov]);
                                }
                            }
                            var totaACobrar = (parseFloat(parseAlmacenaje) + parseFloat(parseSeguro) + parseFloat(manejo) + parseFloat(gstsAd));
                            var persetotaACobrar = parseFloat(totaACobrar).toFixed(2);
                            $('#DetalleCalculosFiscales').DataTable({
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
                                        title: "Del."
                                    }, {
                                        title: "Al."
                                    }, {
                                        title: "Dias"
                                    }, {
                                        title: "Posiciones"
                                    }, {
                                        title: "Cif + impts"
                                    }, {
                                        title: "Almacenaje"
                                    }, {
                                        title: "Toneladas"
                                    }, {
                                        title: "Manejo"
                                    }, {
                                        title: "Seguro"
                                    }, {
                                        title: "T. Elect"
                                    }, {
                                        title: "Total"

                                    }, {
                                        title: "Estado"

                                    }]
                            });
                            $('#DetalleCalculosFiscales').append(`<th colspan="6"><center><label>Totales Generado</label></center></th>
                                                      <th>Q.  ` + parseAlmacenaje + `</th>
                                                      <th>  ` + cantToneladas + `</th>
                                                      <th>Q.  ` + cantPesoCalculo + `</th>
                                                      <th>Q.  ` + parseSeguro + `</th>
                                                      <th>Q.  ` + cantCalcGstAdmin + `</th>
                
                                                      <th>Q.  ` + persetotaACobrar + `</th>
                    <th></th>`
                                    );
                            document.getElementById("divBottons").innerHTML = `
                                                                <div class="btn-group">
                                                                <div class="btn btn-outline-info btn-lg" data-toggle="modal" data-target="#plusOtrosServicios">
                                    <i class="fa fa-plus fa-lg mr-2" aria-hidden="true"></i>                                     
                                    Otros : <span class="badge badge-primary" style="font-size: 15px;"><b>Q&nbsp;&nbsp;</b><b id="spanOtro">0.00</b></span>
                                </div>
                <div class="btn btn-outline-info btn-lg" data-toggle="modal" data-target="#plusServiciosDefalult">
                                    <i class="fa fa-plus fa-lg mr-2" aria-hidden="true"></i>      
                                    Servicios : <span class="badge badge-primary" style="font-size: 15px;"><b>Q&nbsp;&nbsp;</b><b id="spanServicios">0.00</b></span>
                                </div>
   <div class="btn btn-outline-info btn-lg btnDescuentoFiscal">
                                    <i class="fa fa-minus-circle fa-lg mr-2" aria-hidden="true"></i>      
                                    Descuentos : <span class="badge badge-primary" style="font-size: 15px;"><b>Q&nbsp;&nbsp;</b><b id="spanDescuentos">0.00</b></span>
                                </div>
   <div class="btn btn-outline-danger btn-lg btnImprimirRecFiscal">
                                    <i class="fa fa-print fa-lg mr-2" aria-hidden="true"></i>
                                        Imprimir Recibo
                                </div>
                                                                </div>
                                                                    <input type="hidden" id="resultIdIng" value =` + resultIdIng + `
                                                                <br/>
                                                                <br/>
                                                                <br/>`;
                            //AGREGANDO LOS SERVICIOS PARA VISTA DEL USUARIO
                            document.getElementById("hiddenManejo").value = manejo;
                            document.getElementById("hiddenGstosAdmin").value = gstsAd;
                            document.getElementById("hiddenSeguro").value = parseSeguro;
                            document.getElementById("hiddenAlmacenaje").value = parseAlmacenaje;
                            document.getElementById("hiddenTotalCobrar").value = persetotaACobrar;
                            document.getElementById("hiddenresultIdIngreso").value = buttonidingreso;
                        }
                    } else {
                        Swal.fire({
                            type: 'error',
                            title: 'Tarifa',
                            text: '¡La poliza no tiene tarifa autoriazada para este servicio.',
                        });
                    }
                }
            })
        },
        error: function (respuesta) {
            console.log(respuesta);
        }
    });
});
$(document).on("click", ".btnPreparaFact", function () {
    var resultIdIngreso = document.getElementById("resultIdIng").value;
    document.getElementById("hiddenresultIdIngreso").value = resultIdIngreso;
    var datos = new FormData();
    datos.append("resultIdIngreso", resultIdIngreso);
    $.ajax({
        url: "ajax/calcAlmacenajeF.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            document.getElementById("hiddenIdentyFact").value = respuesta[0]["identy"];
            document.getElementById("textNit").value = respuesta[0]["nt"];
            document.getElementById("textEmpresa").value = respuesta[0]["empresa"];
            document.getElementById("textDereccion").value = respuesta[0]["direccion"];
            document.getElementById("datosEjecutivo").innerHTML = 'Ejecutivo : ' + respuesta[0]["nom"] + ' ' + respuesta[0]["ape"] + '<br/> Tel.: ' + respuesta[0]["telefono"];
            document.getElementById("hiddenIdenty").value = respuesta[0]["identy"];
            document.getElementById("hiddenNit").value = respuesta[0]["nt"];
            document.getElementById("hiddenEmpresas").value = respuesta[0]["empresa"];
            document.getElementById("hiddenDireccion").value = respuesta[0]["direccion"];
        }, error: function (respuesta) {
            console.log(respuesta);
        }
    });
    var parseAlmacenaje = document.getElementById("parseAlmacenaje").value;
    var manejo = document.getElementById("manejo").value;
    var gstsAd = document.getElementById("gstsAd").value;
    var parseSeguro = document.getElementById("parseSeguro").value;
    var totalAlmacenaje = document.getElementById("persetotaACobrar").value;
    document.getElementById("detalleParseAlmacenaje").innerHTML = parseAlmacenaje;
    document.getElementById("detalleManejo").innerHTML = manejo;
    document.getElementById("detalleGstsAd").innerHTML = gstsAd;
    document.getElementById("detalleParseSeguro").innerHTML = parseSeguro;
    document.getElementById("totalFacturar").innerHTML = totalAlmacenaje;
    $("#detalleManejo").number(true, 2);
    $("#detalleParseAlmacenaje").number(true, 2);
    $("#detalleGstsAd").number(true, 2);
    $("#detalleParseSeguro").number(true, 2);
    $("#totalFacturar").number(true, 2);
});
$(document).on("click", ".btnCambioDes", function () {
    var estado = $(this).attr("estado");
    if (estado == 0) {
        var txtValDesc = document.getElementById("txtValDesc").value;
        $(this).removeClass('btn-danger');
        $(this).addClass('btn-warning');
        $(this).attr("estado", 1);
        $('#percentQuet').html('Q');
    } else if (estado == 1) {
        $(this).removeClass('btn-warning');
        $(this).addClass('btn-danger');
        $(this).attr("estado", 0);
        $('#percentQuet').html('%');
    }
});
$(document).on("click", ".btnAgregarOtros", function () {
    var estado = $(this).attr("estado");
    if (estado == 0) {
        $(this).attr("estado", 1);
    }
    var valor = document.getElementById("valOtros").value;
    if (valor == "") {
        Swal.fire({
            type: 'error',
            title: 'Sin Valor',
            text: '¡Favor especifique el valor de del servicio',
        });
    } else if (isNaN(valor)) {
        Swal.fire({
            type: 'error',
            title: 'Dato no Adminitido',
            text: '¡Ingrese el valor del servicio',
        });
    } else if (valor >= 1) {
        var servicio = document.getElementById("agregarMasServicios").value;
        var str_esc = escape(servicio);
        var resultIdIng = document.getElementById("resultIdIng").value;
        console.log(resultIdIng);
        /*    var data = JSON.parse(divListaOtros);*/
        lista = [];
        lista.push({"servicio": str_esc, "valor": valor});
        document.getElementById("divOtros").innerHTML += `<input type="hidden" id="hiddenArrayOtros" value= ` + (JSON.stringify(lista)) + `>`;
        if (estado == 0) {
            document.getElementById("totalOtros").innerHTML = '<span id="spantotalOtros" class="badge badge-warning" onmouseover="capturarOtros()">' + valor + '</span>';
            document.getElementById("hiddenTotalesOtros").value = valor;
            document.getElementById("detalleOtros").innerHTML = valor;
            var valOtroF = document.getElementById("hiddenTotalesOtros").value;
            var tipoOpe = 3;
            var val = funcionSumaAlgebraica(valOtroF, tipoOpe);
            document.getElementById("totalFacturar").innerHTML = val;
            formatNumber("detalleOtros");
            formatNumber("spantotalOtros");
        } else if (estado == 1) {
            var tipoOpe = 1;
            var val = funcionSumaAlgebraica(valor, tipoOpe);
            document.getElementById("spantotalOtros").innerHTML = val;
            document.getElementById("hiddenTotalesOtros").value = val;
            document.getElementById("detalleOtros").innerHTML = val;
            var valOtroF = document.getElementById("hiddenTotalesOtros").value;
            var tipoOpe = 3;
            var val = funcionSumaAlgebraica(valOtroF, tipoOpe);
            document.getElementById("totalFacturar").innerHTML = val;
            formatNumber("detalleOtros");
            formatNumber("spantotalOtros");
        }
    }
});
$(document).on("click", ".btnCerrarOtros", function () {
    $("#tipOtros").css("display", "none");
});
$(document).on("click", "#otrosTooltip", function () {
    var spanDescuento = document.getElementById("hiddenDescuentoRest").value;
    var spanDescuento = parseFloat(spanDescuento).toFixed(2);
    var convspanDescuento = (spanDescuento * 1);
    var numArray = $(this).attr("numArray");
    alert(numArray);
    $(this).parent().parent().remove();
    dataListaNueva = [];
    var paragraphs = document.getElementById("hiddenArrayOt").value;
    var data = JSON.parse(paragraphs);
    dataListaNueva.push(data);
    console.log(dataListaNueva);
    var valor = dataListaNueva[0][numArray]["valor"];
    console.log(valor);
    var tipoOpe = 2;
    var val = funcionSumaAlgebraica(valor, tipoOpe);
    document.getElementById("totalOtros").innerHTML = '<span id="spantotalOtros" class="badge badge-warning" onmouseover="capturarOtros()">' + val + '</span>';
    document.getElementById("hiddenTotalesOtros").value = val;
    document.getElementById("detalleOtros").innerHTML = val;
    formatNumber("hiddenTotalesOtros");
    formatNumber("spantotalOtros");
    formatNumber("detalleOtros");
    dataListaNueva[0].splice(numArray, 1);
    listaDefinitiva = [];
    for (var i = 0; i < data.length; i++) {
        var servicioOtro = data[i]["servicio"];
        var valorOtro = data[i]["valor"];
        listaDefinitiva.push({"servicio": servicioOtro, "valor": valorOtro});
    }
    console.log(listaDefinitiva);
    document.getElementById("listaEditada").innerHTML = '<input type="hidden" id="listDifinitiva" value=' + JSON.stringify(listaDefinitiva) + '>';
    document.getElementById("divOtros").innerHTML = "";
    $("#tipOtros").css("display", "none");
    var valOtroF = document.getElementById("hiddenTotalesOtros").value;
    var tipoOpe = 3;
    var val = funcionSumaAlgebraica(valOtroF, tipoOpe);
    document.getElementById("totalFacturar").innerHTML = val;
    formatNumber("detalleOtros");
    formatNumber("spantotalOtros");
});

$(document).ready(function () {
    $("#textNit").change(function () {
        var textNitFactura = $(this).val();
        var respuesta = buscarNit(textNitFactura);
    });
});


$(document).on("click", ".btnNitFact", function () {
    var textNitFactura = $(this).val();
    var respuesta = buscarNit(textNitFactura);
});

function capturarOtros(e) {
    document.getElementById("divCrearListOtros").innerHTML = '';
    if ($("#listDifinitiva").length > 0) {
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
                        ` + servicioOtro + ` <span class="float-right badge bg-danger"style="cursor: default;">` + valorOtro + `&nbsp;&nbsp;<i class="fas fa-close" numArray = ` + [i] + ` id="otrosTooltip" style="cursor: pointer;"></i></span>
                    </a>
                  </li>
                </ul>
`;
            listaNuevaOtros.push({"numerador": [i], "servicio": servicioOtro, "valor": valorOtro});
        }
        document.getElementById("divCrearListOtros").innerHTML += '<input type="hidden" id="hiddenArrayOt" value=' + JSON.stringify(listaDef) + '>';
        var x = event.clientX;
        var y = event.clientY;
        $("#tipOtros").css("left", x - 750);
        $("#tipOtros").css("top", y - 255);
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

            listaNuevaOtros.push({"numerador": [i], "servicio": servicioOtro, "valor": valorOtro});
            document.getElementById("divCrearListOtros").innerHTML += `
                <ul class="nav flex-column">
                  <li class="nav-item">
                    <a href="#" class="nav-link" style="cursor: default;">
                        ` + servicioOtro + ` <span class="float-right badge bg-danger"style="cursor: default;">` + valorOtro + `&nbsp;&nbsp;<i class="fas fa-close" numArray = ` + [i] + ` id="otrosTooltip" style="cursor: pointer;"></i></span>
                    </a>
                  </li>
                </ul>
`;
        }
        document.getElementById("divCrearListOtros").innerHTML += '<input type="hidden" id="hiddenArrayOt" value=' + (JSON.stringify(listaNuevaOtros)) + '>';
        var x = event.clientX;
        var y = event.clientY;
        $("#tipOtros").css("left", x - 750);
        $("#tipOtros").css("top", y - 255);
        $("#tipOtros").css("display", "inline-block");
    }
}

function funcionSumaAlgebraica(valor, tipoOpe) {
    var spanTotales = document.getElementById("hiddenTotalesOtros").value;
    var spanTotales = parseFloat(spanTotales).toFixed(2);
    var convSpanTotales = (spanTotales * 1);
    var convValor = (valor * 1);
    var totalAlmacenaje = document.getElementById("persetotaACobrar").value;
    var totalAlmacenaje = parseFloat(totalAlmacenaje).toFixed(2);
    var almacenaje = (totalAlmacenaje * 1);
    console.log(almacenaje);
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

function formatNumber(nomberId) {
    $('#' + nomberId).number(true, 2);
}


function totalAlmDescuento() {
    document.getElementById("divDescuento").innerHTML = `
                          <div class="info-box">
                                <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-user-minus"></i></span>
                                <div class="info-box-content">
                                      <span id="spanTotalCobro" class="info-box-text">Total descuento</span>
                                      <div id="totalAlmacenaje">

                                      </div>
                                </div>
                            </div>
`;
    var parseAlmacenaje = document.getElementById("parseAlmacenaje").value;
    var manejo = document.getElementById("manejo").value;
    var gstsAd = document.getElementById("gstsAd").value;
    var parseSeguro = document.getElementById("parseSeguro").value;
    var totalAlmacenaje = document.getElementById("persetotaACobrar").value;
    var txtValDesc = document.getElementById("txtValDesc").value;
    var percentQuet = document.getElementById("percentQuet").textContent;
    document.getElementById("spanTotalCobro").innerHTML = 'Total a cobrar:';
    var txtDesc = parseFloat(txtValDesc).toFixed(2);
    var txtVal = parseFloat(parseAlmacenaje).toFixed(2);
    if (percentQuet == "%") {
        if (txtDesc == 0) {
            document.getElementById("divDescuento").innerHTML = "";
            var valOtroF = document.getElementById("hiddenTotalesOtros").value;
            var tipoOpe = 3;
            var val = funcionSumaAlgebraica(valOtroF, tipoOpe);
            document.getElementById("totalFacturar").innerHTML = val;
            formatNumber("detalleOtros");
            formatNumber("spantotalOtros");
        } else if (txtDesc !== 0) {
            var txtDesc = (txtDesc / 100);
            var descuento = (txtVal * txtDesc);
            var descuento = parseFloat(descuento).toFixed(2);
            var ConDescuento = (txtVal - descuento);
            var ConDescuento = parseFloat(ConDescuento).toFixed(2);
            var hiddenTotalesOtros = document.getElementById("hiddenTotalesOtros").value;
            var hiddenTotalesOtros = parseFloat(hiddenTotalesOtros).toFixed(2);
            var cobrar = (totalAlmacenaje - descuento).toFixed(2);
            var tipoOpe = 5;
            var val = funcionSumaAlgebraica(cobrar, tipoOpe);
            document.getElementById("hiddenDescuentoRest").value = descuento;
            document.getElementById("totalFacturar").innerHTML = val;
            document.getElementById("totalAlmacenaje").innerHTML = "";
            document.getElementById("totalAlmacenaje").innerHTML = `<span id="descuento" style="color: red">Descuento:&nbsp;<b id="descuentoQP">` + descuento + `</b>&nbsp;Nuevo Almacenaje:&nbsp;&nbsp;<b id="nuevoAlm">` + ConDescuento + `</b></span>`;
            if (txtDesc >= 0.25) {
                document.getElementById("spanTotalCobro").innerHTML = 'Total a cobrar: SUPERA UN 25% REVISE';
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-full-width",
                    "preventDuplicates": true,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "25000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
                Command: toastr["error"]("¡El descuento es mayor a 25%!");
            }
        }
    } else if (percentQuet == "Q") {

        if (txtValDesc >= 1) {
            var almacenaje = parseFloat(parseAlmacenaje).toFixed(2)
            var almacenaje = (almacenaje * 1);
            var valIngresado = parseFloat(txtValDesc).toFixed(2)
            var valIngresado = (valIngresado * 1);
            var valAlmQ = (almacenaje - valIngresado);
            console.log(valAlmQ);
            document.getElementById("hiddenDescuentoRest").value = valIngresado;
            var hiddenTotalesOtros = document.getElementById("hiddenTotalesOtros").value;
            var hiddenTotalesOtros = parseFloat(hiddenTotalesOtros).toFixed(2);
            var hiddenTotalesOtros = document.getElementById("hiddenTotalesOtros").value;
            var hiddenTotalesOtros = parseFloat(hiddenTotalesOtros).toFixed(2);
            var otrosTotal = (hiddenTotalesOtros * 1);
            var totalAlmDesc = (otrosTotal + totalAlmacenaje - valIngresado);
            console.log(totalAlmDesc);
            document.getElementById("totalFacturar").innerHTML = totalAlmDesc;
            document.getElementById("totalAlmacenaje").innerHTML = `<span id="descuento" style="color: red">Descuento:&nbsp;<b id="descuentoQP">` + txtValDesc + `</b>&nbsp;Nuevo Almacenaje:&nbsp;&nbsp;<b id="nuevoAlm">` + valAlmQ + `</b></span>`;
        } else {
            alert("el descuento no debe ser meno a el valor de ALMACENAJE");
        }
    }
    $("#totalFacturar").number(true, 2);
    $("#descuentoQP").number(true, 2);
    $("#nuevoAlm").number(true, 2);
    formatNumber("hiddenTotalesOtros");
    formatNumber("spantotalOtros");
    formatNumber("detalleOtros");
    formatNumber("totalFacturar");
    formatNumber("descuentoQP");
    formatNumber("nuevoAlm");
}
function buscarNit(textNitFactura) {
    var datos = new FormData();
    datos.append("textNitFactura", textNitFactura);
    $.ajax({
        url: "ajax/calcAlmacenajeF.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            if (respuesta !== "SD") {
                document.getElementById("textEmpresa").value = respuesta[0][0]["nombre"];
                document.getElementById("textDereccion").value = respuesta[0][0]["direccion"];
                document.getElementById("hiddenIdentyFact").value = respuesta[0][0]["nt"];
                if (respuesta[1] !== "sinEjecutivo") {
                    document.getElementById("datosEjecutivo").innerHTML = 'Ejecutivo : ' + respuesta[1][0]["nom"] + ' ' + respuesta[1][0]["ape"] + '<br/> Tel.: ' + respuesta[1][0]["telefono"];

                } else {

                }
                Swal.fire({
                    position: 'top-end',
                    type: 'success',
                    title: 'Nit cambiado con éxito',
                    showConfirmButton: false,
                    timer: 2000
                })
            } else {
                var hiddenNit = document.getElementById("hiddenNit").value;
                var hiddenEmpresas = document.getElementById("hiddenEmpresas").value;
                var hiddenDireccion = document.getElementById("hiddenDireccion").value;
                var hiddenIdenty = document.getElementById("hiddenIdenty").value;
                document.getElementById("textNit").value = hiddenNit;
                document.getElementById("textEmpresa").value = hiddenEmpresas;
                document.getElementById("textDereccion").value = hiddenDireccion;
                document.getElementById("hiddenIdentyFact").value = hiddenIdenty;
                Swal.fire({
                    type: 'error',
                    title: 'Nit no existe',
                    text: 'El nit que especifico no existe',
                });
            }
        }, error: function (respuesta) {
            console.log(respuesta);
        }
    });
}


$(document).on("click", ".bntFactRegistro", function () {
    var hiddenresultIdIngreso = document.getElementById("hiddenresultIdIngreso").value;
    var datos = new FormData();
    datos.append("hiddenresultIdIngreso", hiddenresultIdIngreso);
    $.ajax({
        url: "ajax/calcAlmacenajeF.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            location.reload();
        }, error: function (respuesta) {
            console.log(respuesta);
        }
    });

});
$(document).on("click", ".btnEspecifCobro", function () {
    alert("opcion no habilitada");
});

$(document).on("click", ".btnDescuentoFiscal", async function () {
    var almacenajeIteradoTotal = document.getElementById("hiddenAlmacenaje").value;
    console.log(almacenajeIteradoTotal);
    if (isNaN(almacenajeIteradoTotal) || almacenajeIteradoTotal == 0 || almacenajeIteradoTotal == "") {
        Swal.fire('No autorizado', 'El valor de almacenaje es 0, no puede hacer descuento en almacenaje', 'error')
    } else {
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
                    if (value == 'Quetzales') {
                        resolve()
                    } else if (value == 'Porcentaje') {
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
                console.log(paragraphs);
                console.log(paragraphsS);
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
                            var hiddenAlmacenaje = document.getElementById("hiddenAlmacenaje").value;
                            var hiddenAlmacenaje = hiddenAlmacenaje * 1;
                            var desTotaTh = document.getElementById("hiddenTotalCobrar").value;
                            var porcentajeAlm = ((hiddenAlmacenaje + valServicio) * 1 / 100);
                            var porcentaje = (valDescuentoQP / porcentajeAlm);
                            var nuevoValTotal = ((hiddenAlmacenaje + valServicio) - valDescuentoQP);
                            var nuevoValTotal = Math.trunc(nuevoValTotal);
                            var desTotaThDef = (desTotaTh - valDescuentoQP);
                            var desTotaThDef = Math.trunc(desTotaThDef);
                            var porRound = Math.trunc(porcentaje);
                            Math.trunc(nuevoValTotal);
                            if (porcentaje <= 20) {
                                document.getElementById("divAlerta").innerHTML = `
 <div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>¡Esta autorizando un descuento!</strong> del ` + porRound + `% y monto de  Q ` + valDescuentoQP + ` almacenaje con descuento ` + nuevoValTotal + `
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>`;
                            } else if (porcentaje >= 20.01) {
                                document.getElementById("divAlerta").innerHTML = `
 <div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>¡Estas autorizando un descuento!</strong> del ` + porRound + `% y monto de  Q ` + valDescuentoQP + ` almacenaje con descuento Q. ` + nuevoValTotal + `
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>`;
                            }
                            document.getElementById("hiddenDescuento").value = porRound;
                            document.getElementById("valDescuento").value = valDescuentoQP;
                            document.getElementById("spanDescuentos").innerHTML = valDescuentoQP;
                            totalCobrar();
                        }
                    }
                } else if (tipoDescuento == "Porcentaje") {
                    const {
                        value: valDescuentoQP
                    } = await Swal.fire({
                        title: 'Ingresa el valor del descuento en porcentaje',
                        input: 'text',
                        inputPlaceholder: 'Ingrese el descuento ejemplo : 0.025'
                    })
                    if (valDescuentoQP) {
                        if (!isNaN(valDescuentoQP) && valDescuentoQP >= 0.0001) {
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
</div>`;
                            } else {
                                document.getElementById("divAlerta").innerHTML = `
 <div class="alert alert-primary alert-dismissible fade show" role="alert">
  <strong>¡Estas autorizando un descuento!</strong> del ` + valDescuentoQP + `% y monto de  Q ` + nuevoValTotal + ` almacenaje con descuento ` + valDescuento + `
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>`;
                            }
                            document.getElementById("hiddenDescuento").value = valDescuentoQP;
                            document.getElementById("valDescuento").value = nuevoValTotal;
                            document.getElementById("spanDescuentos").innerHTML = nuevoValTotal;
                            totalCobrar();
                        }
                    }
                }
            }
        }
    }
});

$(document).on("click", ".btnImprimirRecFiscal", async function () {
    var hiddenresultIdIngreso = document.getElementById("hiddenresultIdIngreso").value;
    //Otros servicios
    var paragraphs = Array.from(document.querySelectorAll(".btnEliminarOtroServ"));
    listaOtros = [];
    if (paragraphs.length == 0) {
        console.log("no hay");
        var otrosValores = 0;
        var listaOtros = 0;
    } else {

        for (var i = 0; i < paragraphs.length; i++) {
            var servicioOtro = paragraphs[i].attributes.idvalue.value;
            var valOtro = document.getElementById("montoServicioText" + servicioOtro).value;
            listaOtros.push({
                "serviciosOtros": servicioOtro,
                "valorOtros": valOtro
            });
        }
        console.log(listaOtros);
        // Recorrido de listas y descuentos para mostra al cliente.
        // Recorrido otros servicios Ejemplo: Tomas electricas, fotocopias, desechos de madera, tiempos extraOrdinarios, etc...
        var otrosValores = 0;
        for (var i = 0; i < listaOtros.length; i++) {
            var otrosValores = (listaOtros[i].valorOtros * 1) + otrosValores;
        }
    }
    //Servicios default
    var paragraphs = Array.from(document.querySelectorAll(".btnEliminarServDefault"));
    listaServiciosDefault = [];
    if (paragraphs.length == 0) {
        console.log("no hay");
        var valServicio = 0.00;
        var listaServiciosDefault = 0;
    } else {

        for (var i = 0; i < paragraphs.length; i++) {
            var servicioDef = paragraphs[i].attributes.idvalue.value;
            var valServicios = document.getElementById("montoSerDefaultText" + servicioDef).value;
            listaServiciosDefault.push({
                "serviciosDefault": servicioDef,
                "valServicios": valServicios
            });
        }
        console.log(listaServiciosDefault);
        // Recorrido de aumento a servicios base: Zona aduanera, Almacenaje, Manejo, Gastos administrativos...
        var valServicio = 0;
        for (var i = 0; i < listaServiciosDefault.length; i++) {
            var valServicio = (listaServiciosDefault[i].valServicios) * 1 + valServicio;
        }
    }
    //Descuento 
    var valDescuento = document.getElementById("valDescuento").value;
    var hiddenDescuento = document.getElementById("hiddenDescuento").value;
    // Valor calculado 
    var valCalculado = await totalCalculadoFiscal();
    valCalculado = parseFloat(valCalculado).toFixed(2);
    //Total a cobrar 
    var hiddenTotalCobrar = (valCalculado + otrosValores + valServicio) - valDescuento;
    console.log(valDescuento);
    if (valCalculado >= 1) {
        const {
            value: tipoRespuesta
        } = await Swal.fire({
            type: 'info',
            title: '¿Desea guardar cambios?',
            html: '<strong>¡Se generara un pdf con el recibo de almacenaje!</strong><br/><br/><b>Servicios Calculado : </b>Q. ' + valCalculado + '<br/><b>Aumento en servicios : </b>Q. ' + valServicio + '<br/><b>Otros Servicios :</b>Q. ' + otrosValores + '<br/><b>Descuento del ' + hiddenDescuento + ' % : </b>Q. ' + valDescuento + '<br/>___________________________________<br/><br/><strong>Total a Facutrar Q. ' + hiddenTotalCobrar + '</strong>',
            showCancelButton: true,
            inputValidator: (value) => {
                console.log(value);
                return new Promise((resolve) => {
                    resolve()
                })
            }
        })
        var listaOtros = JSON.stringify(listaOtros);
        var listaServiciosDefault = JSON.stringify(listaServiciosDefault);
        console.log(tipoRespuesta);
        if (tipoRespuesta) {
            var hiddenDateTimeValCorte = document.getElementById("hiddenDateTimeVal").value;
            var guardarRecFiscal = await guardarAlmacenajeFiscal(hiddenresultIdIngreso, listaServiciosDefault, listaOtros, valDescuento, hiddenDescuento, hiddenDateTimeValCorte);
            console.log(guardarRecFiscal);
            Swal.fire({
                title: 'Recibo Creado',
                text: "¿Desea Imprimir?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, imprimir'
            }).then((result) => {
                if (result.value) {
                    //   window.open("extensiones/tcpdf/pdf/Recibo-fiscal-Especial.php?codigo=" + hiddenresultIdIngreso, "_blank");
                }
            })

        }


    }
})
//imprimirRetiroAlmacenaje
function totalCalculadoFiscal() {
    var hiddenZonaAduana = document.getElementById("hiddenZonaAduana").value;
    var hiddenZonaAduana = hiddenZonaAduana * 1;
    var hiddenAlmacenaje = document.getElementById("hiddenAlmacenaje").value;
    var hiddenAlmacenaje = hiddenAlmacenaje * 1;
    var hiddenManejo = document.getElementById("hiddenManejo").value;
    var hiddenManejo = hiddenManejo * 1;
    var hiddenGstosAdmin = document.getElementById("hiddenGstosAdmin").value;
    var hiddenGstosAdmin = hiddenGstosAdmin * 1;
    var hiddenSeguro = document.getElementById("hiddenSeguro").value;
    var hiddenSeguro = hiddenSeguro * 1;
    var result = (hiddenZonaAduana + hiddenAlmacenaje + hiddenManejo + hiddenGstosAdmin + hiddenSeguro);
    return result;
}

function guardarAlmacenajeFiscal(hiddenresultIdIngreso, listaServiciosDefault, listaOtros, valDescuento, hiddenDescuento, hiddenDateTimeValCorte) {
    let functRespuesta;
    var datos = new FormData();
    datos.append("idIngAlmacenajeF", hiddenresultIdIngreso);
    datos.append("listaServiciosDefault", listaServiciosDefault);
    datos.append("listaOtros", listaOtros);
    datos.append("valDescuento", valDescuento);
    datos.append("hiddenDescuento", hiddenDescuento);
    datos.append("hiddenDateTimeValCorte", hiddenDateTimeValCorte);
    $.ajax({
        async: false,
        url: "ajax/calcAlmacenajeF.ajax.php",
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
        }});
    return functRespuesta;
}

$(document).on("click", ".btnAlmacenajeEspecial", async function () {
    var fechaCalcEsp = document.getElementById("hiddenDateTimeVal").value;
    var idIngCambio = document.getElementById("hiddenresultIdIngreso").value;
    var recalcularAlm = await recalcularAlmacenaje(fechaCalcEsp, idIngCambio);

})


function recalcularAlmacenaje(fechaCalcEsp, idIngCambio) {
    let functRespuesta;

    var datos = new FormData();
    datos.append("fechaCalcEsp", fechaCalcEsp);
    datos.append("idIngCambio", idIngCambio);
    $.ajax({
        async: false,
        url: "ajax/calcAlmacenajeF.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            if (respuesta != "SD") {
                document.getElementById("detalleCalculo").innerHTML = `
                    <table id="DetalleCalculosFiscales" role="grid" class="table dt-responsive table-hover table-striped table-bordered display table-sm" cellspacing="0" >
                      </table>
                      <br/>
                      <br/>`;

                var lista = [];
                for (var i = 0; i < respuesta["resCalSaldoDiarioBaseDiaria"].length; i++) {
                    if (respuesta["resCalSaldoDiarioBaseDiaria"][i].posSaldo >= 1) {
                        if (i == 0) {
                            var fechaIngreso = respuesta["resCalSaldoDiarioBaseDiaria"][i].fechaIn;
                            var sumaContAlmacenaje = 0;
                            var sumaContSeguro = 0;
                            var totaACobrar = 0;
                        }
                        var numero = (i + 1);
                        var poliza = respuesta["resCalSaldoDiarioBaseDiaria"][i].poliza;
                        var valorTarifa = respuesta["resCalSaldoDiarioBaseDiaria"][i].valorTarifa;
                        var fechaIn = respuesta["resCalSaldoDiarioBaseDiaria"][i].fechaIn;
                        var fechaCorte = respuesta["resCalSaldoDiarioBaseDiaria"][i].fechaCorte;
                        var dias = respuesta["resCalSaldoDiarioBaseDiaria"][i].dias;
                        var unidades = respuesta["resCalSaldoDiarioBaseDiaria"][i].posSaldo;
                        var cifImpuestos = parseFloat(respuesta["resCalSaldoDiarioBaseDiaria"][i].cifImpuestos).toFixed(2);
                        var almacenaje = respuesta["resCalSaldoDiarioBaseDiaria"][i].almacenaje;
                        if (i == 0) {
                            var cantToneladas = respuesta["resCalSaldoDiarioBaseDiaria"][i].toneladas;
                            var cantPesoCalculo = respuesta["resCalSaldoDiarioBaseDiaria"][i].pesoCalculo;
                            var cantCalcGstAdmin = respuesta["resCalSaldoDiarioBaseDiaria"][i].calcGstAdmin;
                        }
                        if (respuesta["tipo"] != "noFacturado") {

                            var tipoMov = respuesta["resCalSaldoDiarioBaseDiaria"][i].tipoMov;

                            if (tipoMov == "movCobrado") {
                                var buttonMov = '<button type="button" class="btn btn-success btn-sm">Cobrado</button>';
                            } else if (tipoMov == "pendiente") {
                                var buttonMov = '<button type="button" class="btn btn-danger btn-sm">Pendiente</button>';
                            }
                        } else {
                            var buttonMov = '<button type="button" class="btn btn-danger btn-sm">Pendiente</button>';
                        }
                        var toneladas = respuesta["resCalSaldoDiarioBaseDiaria"][i].toneladas;
                        var pesoCalculo = respuesta["resCalSaldoDiarioBaseDiaria"][i].pesoCalculo;
                        var calcGstAdmin = respuesta["resCalSaldoDiarioBaseDiaria"][i].calcGstAdmin;
                        var totalAlmacenaje = respuesta["resCalSaldoDiarioBaseDiaria"][i].totalAlmacenaje;
                        var resSeguro = respuesta["resCalSaldoDiarioBaseDiaria"][i].resSeguro
                        var sumaContAlmacenaje = (sumaContAlmacenaje + almacenaje);
                        var parseAlmacenaje = parseFloat(sumaContAlmacenaje).toFixed(2);
                        var sumaContSeguro = (sumaContSeguro + resSeguro);
                        var parseSeguro = parseFloat(sumaContSeguro).toFixed(2);
                        if (i == 0) {
                            var manejo = pesoCalculo;
                            var gstsAd = calcGstAdmin;
                        }

                        var numRow = respuesta["resCalSaldoDiarioBaseDiaria"].length;
                        var fechaInicio = respuesta["resCalSaldoDiarioBaseDiaria"][0].fechaIn;
                        var fechaFin = respuesta["resCalSaldoDiarioBaseDiaria"][i].fechaCorte;
                        lista.push([numero, fechaIn, fechaCorte, dias, unidades, cifImpuestos, almacenaje, toneladas, pesoCalculo, resSeguro, calcGstAdmin, totalAlmacenaje, buttonMov]);
                    }
                }

                var totaACobrar = (parseFloat(parseAlmacenaje) + parseFloat(parseSeguro) + parseFloat(manejo) + parseFloat(gstsAd));
                var persetotaACobrar = parseFloat(totaACobrar).toFixed(2);
                $('#DetalleCalculosFiscales').DataTable({
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
                            title: "Del."
                        }, {
                            title: "Al."
                        }, {
                            title: "Dias"
                        }, {
                            title: "Posiciones"
                        }, {
                            title: "Cif + impts"
                        }, {
                            title: "Almacenaje"
                        }, {
                            title: "Toneladas"
                        }, {
                            title: "Manejo"
                        }, {
                            title: "Seguro"
                        }, {
                            title: "T. Elect"
                        }, {
                            title: "Total"

                        }, {
                            title: "Estado"

                        }]
                });
                $('#DetalleCalculosFiscales').append(`<th colspan="6"><center><label>Totales Generado</label></center></th>
                                                      <th>Q.  ` + parseAlmacenaje + `</th>
                                                      <th>  ` + cantToneladas + `</th>
                                                      <th>Q.  ` + cantPesoCalculo + `</th>
                                                      <th>Q.  ` + parseSeguro + `</th>
                                                      <th>Q.  ` + cantCalcGstAdmin + `</th>
                                                      <th>Q.  ` + persetotaACobrar + `</th>`);
            }
            console.log(respuesta);
        }, error: function (respuesta) {
            console.log(respuesta);
        }});
    return functRespuesta;
}

