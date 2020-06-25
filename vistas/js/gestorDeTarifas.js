$(document).on("click", ".btnView", function () {
    var idMostrar = $(this).attr("idMostrar");
    console.log(idMostrar);
    var numerotarifa = $(this).attr("numerotarifa");
    console.log(numerotarifa);
    var datos = new FormData();
    datos.append("idMostrar", idMostrar);
    datos.append("numerotarifa", numerotarifa);
    $.ajax({
        url: "ajax/gestorDeTarifas.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            if (respuesta == "SD" || respuesta == "sd") {
                alert("SIN DATA");
            } else if (respuesta !== "SD" || respuesta !== "sd") {
                console.log(respuesta);
                document.getElementById("divServicio").innerHTML = "";
                for (var i = 0; i < respuesta.length; i++) {
                    var servicioAlmacenaje = respuesta[i]['servicio'];
                    var baseAlmacenaje = respuesta[i]['Base de Calculo Almacenaje'];
                    var calculoSobreAlmacenaje = respuesta[i]['calculoSobre Almacenaje'];
                    var periodoCalculoAlmacenaje = respuesta[i]['PeriodoCalculo Almacenaje'];
                    var monedaAlmacenaje = respuesta[i]['Moneda Almacenaje'];
                    var valorAlmacenaje = respuesta[i]['Valor Almacenaje'];
                    if (baseAlmacenaje == null) {
                        baseAlmacenaje = "Sin Servicio de Almaceanje";
                        calculoSobreAlmacenaje = "**";
                        periodoCalculoAlmacenaje = "**";
                        monedaAlmacenaje = "**";
                        valorAlmacenaje = "**";
                    }
                    var servicioSeguro = "Seguro";
                    var baseSeguro = respuesta[i]['Base seguro'];
                    var calculoSobreSeguro = respuesta[i]['Calculo Sobre Seguro'];
                    var periodoCalculoSeguro = respuesta[i]['Periodo calculo seguro'];
                    var monedaSeguro = respuesta[i]['Moneda Seguro'];
                    var valorSeguro = respuesta[i]['Valor seguro'];
                    if (baseSeguro == null) {
                        baseSeguro = "Sin Servicio de Seguro";
                        calculoSobreSeguro = "**";
                        periodoCalculoSeguro = "**";
                        monedaSeguro = "**";
                        valorSeguro = "**";
                    }
                    var servicioManejo = "Manejo";
                    var baseManejo = respuesta[i]['Base manejo'];
                    var calculoSobreManejo = "No Aplica";
                    var periodoCalculoManejo = "No Aplica";
                    var monedaManejo = respuesta[i]['Moneda Calculo manejo'];
                    var valorManejo = respuesta[i]['Valor manejo'];
                    if (baseManejo == null) {
                        baseManejo = "Sin Servicio de Manejo";
                        calculoSobreManejo = "**";
                        periodoCalculoManejo = "**";
                        monedaManejo = "**";
                        valorManejo = "**";
                    }
                    var servicioAdmin = "Gastos Administración";
                    var baseAdmin = respuesta[i]['Base Gastos Admin'];
                    var calculoSobreAdmin = "No Aplica";
                    var periodoCalculoAdmin = "No Aplica";
                    var monedaAdmin = respuesta[i]['Moneda Gastos Admin'];
                    var valorAdmin = respuesta[i]['Valor Gastos Admin'];
                    if (baseAdmin == null) {
                        baseAdmin = "Sin Servicio de Gastos Admin";
                        calculoSobreAdmin = "**";
                        periodoCalculoAdmin = "**";
                        monedaAdmin = "**";
                        valorAdmin = "**";
                    }
                    var servicioOtrosGts = "Gastos Administración";
                    var baseOtrosGts = respuesta[i]['Base otros gastos'];
                    var calculoSobreOtrosGts = "No Aplica";
                    var periodoCalculoOtrosGts = "No Aplica";
                    var monedaOtrosGts = respuesta[i]['Moneda otros gastos'];
                    var valorOtrosGts = respuesta[i]['Valor otros gastos'];
                    if (baseOtrosGts == null) {
                        baseOtrosGts = "Sin Servicio de Otros Gastos";
                        calculoSobreOtrosGts = "**";
                        periodoCalculoOtrosGts = "**";
                        monedaOtrosGts = "**";
                        valorOtrosGts = "**";
                    }
                    document.getElementById("divServicio").innerHTML += '<div class="card"><div class="card-header"> <h3 class="card-title">' + respuesta[i]["servicio"] + '</h3> <div class="card-tools"><button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i> </button></div></div><div class="card-body p-0"> <ul class="products-list product-list-in-card pl-2 pr-2"> <li class="item"><div class="product-info"><div class="alert alert-primary" role="alert"><div class="row"> <div class="col-12" style=" border-style: ridge; border-width: 2px; border-color: #60D13F; bord"> <label>Base de Almacenaje ::</label><label id="lblBaseAlmacenaje' + i + '" style="color:#B96AD2;"style="color:#B96AD2;" numBaseAlmacenaje="numBaseAlmacenaje' + i + '"></label></br> <label>Tipo Almacenaje ::</label><label id="lblTipoAlmacenaje' + i + '" style="color:#B96AD2;"numTipoAlmacenaje="numTipoAlmacenaje' + i + '"></label></br><label>Periodo Almacenaje ::</label><label id="lblPeriodoAlmacenaje' + i + '" style="color:#B96AD2;"numPeriodoAlmacenaje="numPeriodoAlmacenaje' + i + '"></label></br><label>Moneda Almacenaje ::</label><label id="lblMonedaAlmacenaje' + i + '" style="color:#B96AD2;"numMonedaAlmacenaje="numMonedaAlmacenaje' + i + '"></label></br><label>Valor Almacenaje ::</label><label id="lblValorAlmacenaje' + i + '" style="color:#B96AD2;"numValorAlmacenaje="numValorAlmacenaje' + i + '"></label></br></div><div class="col-6" style=" border-style: ridge; border-width: 2px; border-color: #60D13F; bord"><label>Base de Seguro ::</label><label id="lblBaseSeguro' + i + '" style="color:#B96AD2;"numBaseSeguro="numBaseSeguro' + i + '"></label></br> <label>Tipo Seguro ::</label><label id="lblTipoSeguro' + i + '" style="color:#B96AD2;"numTipoSeguro="numTipoSeguro' + i + '"></label></br><label>Periodo Seguro ::</label><label id="lblPeriodoSeguro' + i + '" style="color:#B96AD2;"numPeriodoSeguro="numPeriodoSeguro' + i + '"></label></br><label>Valor Seguro ::</label><label id="lblValorSeguro' + i + '" style="color:#B96AD2;"numValorSeguro="numValorSeguro' + i + '"></label></br><label>Moneda Seguro ::</label><label id="lblMonedaSeguro' + i + '" style="color:#B96AD2;"numMonedaSeguro="numMonedaSeguro' + i + '"></label></br></div><div class="col-6" style=" border-style: ridge; border-width: 2px; border-color: #60D13F; bord"><label>Base de Manejo ::</label><label id="lblBaseManejo' + i + '" style="color:#B96AD2;"numBaseManejo="numBaseManejo' + i + '"></label></br> <label>Tipo Manejo ::</label><label id="lblTipoManejo' + i + '" style="color:#B96AD2;"numTipoManejo="numTipoManejo' + i + '"></label></br><label>Periodo Manejo ::</label><label id="lblPeriodoManejo' + i + '" style="color:#B96AD2;"numPeriodoManejo="numPeriodoManejo' + i + '"></label></br><label>Valor Manejo ::</label><label id="lblValorManejo' + i + '" style="color:#B96AD2;"numValorManejo="numValorManejo' + i + '"></label></br><label>Moneda Manejo ::</label><label id="lblMonedaManejo' + i + '" style="color:#B96AD2;"numMonedaManejo="numMonedaManejo' + i + '"></label></br></div><div class="col-6" style=" border-style: ridge; border-width: 2px; border-color: #60D13F; bord"><label>Base de Gastos Admin ::</label><label id="lblBaseAdmin' + i + '" style="color:#B96AD2;"numBaseAdmin="numBaseAdmin' + i + '"></label></br><label>Tipo Gastos Admin ::</label><label id="lblTipoAdmin' + i + '" style="color:#B96AD2;"numTipoAdmin="numTipoAdmin' + i + '"></label></br> <label>Periodo Gastos Admin ::</label><label id="lblPeriodoAdmin' + i + '" style="color:#B96AD2;"numPeriodoAdmin="numPeriodoAdmin' + i + '"></label></br> <label>Valor Gastos Admin ::</label><label id="lblValorAdmin' + i + '" style="color:#B96AD2;"numValorAdmin="numValorAdmin' + i + '"></label></br> <label>Moneda Gastos Admin ::</label><label id="lblMonedaAdmin' + i + '" style="color:#B96AD2;"numMonedaAdmin="numMonedaAdmin' + i + '"></label></br> </div><div class="col-6" style=" border-style: ridge; border-width: 2px; border-color: #60D13F; bord"><label>Base de Otros Gastos ::</label><label id="lblBaseGastos' + i + '" style="color:#B96AD2;"numBaseGastos="numBaseGastos' + i + '"></label></br> <label>Tipo Otros Gastos ::</label><label id="lblTipoGastos' + i + '" style="color:#B96AD2;"numTipoGastos="numTipoGastos' + i + '"></label></br><label>Periodo Otros Gastos ::</label><label id="lblPeriodoGastos' + i + '" style="color:#B96AD2;"numPeriodoGastos="numPeriodoGastos' + i + '"></label></br><label>Valor Otros Gastos ::</label><label id="lblValorGastos' + i + '" style="color:#B96AD2;"numValorGastos="numValorGastos' + i + '"></label></br><label>Moneda Otros Gastos ::</label><label id="lblMonedaGastos' + i + '" style="color:#B96AD2;"numMsonedaGastos="numMsonedaGastos' + i + '"></label></br> </div></div></div></span> </div></li> </ul> </div></div>';
                    document.getElementById("lblBaseAlmacenaje" + i).innerHTML = baseAlmacenaje;
                    document.getElementById("lblTipoAlmacenaje" + i).innerHTML = calculoSobreAlmacenaje;
                    document.getElementById("lblPeriodoAlmacenaje" + i).innerHTML = periodoCalculoAlmacenaje;
                    document.getElementById("lblMonedaAlmacenaje" + i).innerHTML = monedaAlmacenaje;
                    document.getElementById("lblValorAlmacenaje" + i).innerHTML = valorAlmacenaje;
                    document.getElementById("lblBaseSeguro" + i).innerHTML = baseSeguro;
                    document.getElementById("lblTipoSeguro" + i).innerHTML = calculoSobreSeguro;
                    document.getElementById("lblPeriodoSeguro" + i).innerHTML = periodoCalculoSeguro;
                    document.getElementById("lblValorSeguro" + i).innerHTML = monedaSeguro;
                    document.getElementById("lblMonedaSeguro" + i).innerHTML = valorSeguro;
                    document.getElementById("lblBaseManejo" + i).innerHTML = baseManejo;
                    document.getElementById("lblTipoManejo" + i).innerHTML = calculoSobreManejo;
                    document.getElementById("lblPeriodoManejo" + i).innerHTML = periodoCalculoManejo;
                    document.getElementById("lblValorManejo" + i).innerHTML = monedaManejo;
                    document.getElementById("lblMonedaManejo" + i).innerHTML = valorManejo;
                    document.getElementById("lblBaseAdmin" + i).innerHTML = baseAdmin;
                    document.getElementById("lblTipoAdmin" + i).innerHTML = calculoSobreAdmin;
                    document.getElementById("lblPeriodoAdmin" + i).innerHTML = periodoCalculoAdmin;
                    document.getElementById("lblValorAdmin" + i).innerHTML = monedaAdmin;
                    document.getElementById("lblMonedaAdmin" + i).innerHTML = valorAdmin;
                    document.getElementById("lblBaseGastos" + i).innerHTML = baseOtrosGts;
                    document.getElementById("lblTipoGastos" + i).innerHTML = calculoSobreOtrosGts;
                    document.getElementById("lblPeriodoGastos" + i).innerHTML = periodoCalculoOtrosGts;
                    document.getElementById("lblValorGastos" + i).innerHTML = monedaOtrosGts;
                    document.getElementById("lblMonedaGastos" + i).innerHTML = valorOtrosGts;
                }
            }
        },
        error: function (respuesta) {
            console.log(respuesta);
        }
    })
})
$(document).on("click", ".btnActivarTarifa", async function () {
    var button = $(this);
    var idClt = $(this).attr("idClt");
    var estado = $(this).attr("estado");
    var nomVar = "estadoTarifa";
    var nomVar2 = "idClt";
    console.log(estado);
    if (estado == 0) {
        var estado = 1;
        $(this).removeClass('btn-outline-success');
        $(this).addClass('btn-outline-danger');
        $(this).html('Inactiva&nbsp;');
        $(this).attr('estado', 1);
            var activarTarifa = await activacionTarifa(nomVar, estado, nomVar2, idClt);
            return true;
    } 
    if (estado == 1) {
        var estado = 2;
        $(this).removeClass('btn-outline-success');
        $(this).addClass('btn-outline-dark');
            $(this).html('Anulada');
        $(this).attr('estado', 2);
            var activarTarifa = await activacionTarifa(nomVar, estado, nomVar2, idClt);
                        return true;
    }
    console.log(estado);
        if (estado == 2) {
        var estado = 1;
        $(this).removeClass('btn-outline-dark');
        $(this).addClass('btn-outline-success');
        $(this).html('Activa&nbsp;&nbsp;&nbsp;');
        $(this).attr('estado', 1);
            var activarTarifa = await activacionTarifa(nomVar, estado, nomVar2, idClt);
                        return true;
    }

    if (activarTarifa.resp == true && activarTarifa.success[0]["resp"] == 1) {
        
    } else {
       location.reload();
    }
})


function activacionTarifa(nomVar, estado, nomVar2, idClt) {
    let respFunc;
    var datos = new FormData();
    datos.append(nomVar, estado);
    datos.append(nomVar2, idClt);
    $.ajax({
        async: false,
        url: "ajax/gestorDeTarifas.ajax.php",
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
        }
    })
    return respFunc;
}


$(document).on("click", ".btnPDFGTarifa", function () {
      var idclt = $(this).attr("idclt");
      console.log(idclt);
    window.open("extensiones/tcpdf/pdf/Tarifa-Servicios.php?tarifaCodigo=" + idclt, "_blank");  
})

