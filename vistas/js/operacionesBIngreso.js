async function validacionParaGuardar() {
    var familia = 0;
    var e = document.getElementById("regimenPoliza");
    var indexValue = e.options[e.selectedIndex].value;
    var indexText = e.options[e.selectedIndex].text;
    if (isNaN(indexValue) || indexValue == 0) {
        $("#regimenPoliza").removeClass("is-valid");
        $("#regimenPoliza").addClass("is-invalid");
        return false;
    }
    var cartaDeCupo = document.getElementById("cartaDeCupo").value;
    var cantContenedores = document.getElementById("cantContenedores").value;
    var dua = document.getElementById("dua").value;
    var bl = document.getElementById("bl").value;
    var poliza = document.getElementById("poliza").value;
    if (poliza == "" || poliza == 0) {
        $("#poliza").removeClass("is-valid");
        $("#poliza").addClass("is-invalid");
        return false;
    }
    var bultosIngreso = document.getElementById("bultosIngreso").value;
    if (isNaN(bultosIngreso) || bultosIngreso == 0) {
        Swal.fire({
            position: 'top-center',
            type: 'error',
            title: '¡No selecciono el botton consolidado!',
            showConfirmButton: false,
            timer: 3000
        })
        return false;
    }
    var puertoOrigen = document.getElementById("puertoOrigen").value;
    if (puertoOrigen == "" || puertoOrigen == 0) {
        $("#puertoOrigen").removeClass("is-valid");
        $("#puertoOrigen").addClass("is-invalid");
        return false;
    }
    var cantClientes = document.getElementById("cantClientes").value;
    if (cantClientes == 0 || cantClientes == "") {
        $("#cantClientes").removeClass("is-valid");
        $("#cantClientes").addClass("is-invalid");
        return false;
    }
    var producto = document.getElementById("producto").value;
    if (producto == 0 || producto == "") {
        $("#producto").removeClass("is-valid");
        $("#producto").addClass("is-invalid");

        return false;
    }
    var pesoIng = document.getElementById("pesoIng").value;
    if (pesoIng == 0 || pesoIng == "" || isNaN(pesoIng)) {
        $("#pesoIng").removeClass("is-valid");
        $("#pesoIng").addClass("is-invalid");

        return false;
    }
    var valorTotalAduana = document.getElementById("valorTotalAduana").value;
    if (valorTotalAduana == 0 || valorTotalAduana == "" || isNaN(valorTotalAduana)) {
        $("#valorTotalAduana").removeClass("is-valid");
        $("#valorTotalAduana").addClass("is-invalid");


        return false;
    }
    var tipoDeCambio = document.getElementById("tipoDeCambio").value;
    if (tipoDeCambio == 0 || tipoDeCambio == "" || isNaN(tipoDeCambio)) {
        $("#tipoDeCambio").removeClass("is-valid");
        $("#tipoDeCambio").addClass("is-invalid");


        return false;
    }
    var totalValorCif = document.getElementById("totalValorCif").value;
    if (totalValorCif == 0 || totalValorCif == "" || isNaN(totalValorCif)) {
        $("#totalValorCif").removeClass("is-valid");
        $("#totalValorCif").addClass("is-invalid");


        return false;
    }
    var valorImpuesto = document.getElementById("valorImpuesto").value;
    if (valorImpuesto == 0 || valorImpuesto == "" || isNaN(valorImpuesto)) {
        $("#valorImpuesto").removeClass("is-valid");
        $("#valorImpuesto").addClass("is-invalid");
        return false;
    }
    var hiddenDateTimeVal = document.getElementById("hiddenDateTimeVal").value;
    if (hiddenDateTimeVal == "") {
        Swal.fire({
            position: 'top-center',
            type: 'error',
            title: '¡No selecciono la fecha de ingreso!',
            showConfirmButton: false,
            timer: 3000
        })


        return false;
    }
    var sel2 = document.getElementById("sel2").value;
    if (sel2 == "" || sel2 == "Seleccione tipo de cliente") {
        $("#sel2").removeClass("is-valid");
        $("#sel2").addClass("is-invalid");

        return false;
    }
    var servicioTarifa = document.getElementById("servicioTarifa").value;
    if (isNaN(servicioTarifa) || servicioTarifa == 0 || servicioTarifa == "") {
        $("#servicioTarifa").removeClass("is-valid");
        $("#servicioTarifa").addClass("is-invalid");


        return false;
    }
    var regimenPoliza = document.getElementById("regimenPoliza").value;
    if (isNaN(regimenPoliza) || regimenPoliza == 0 || regimenPoliza == "") {
        $("#regimenPoliza").removeClass("is-valid");
        $("#regimenPoliza").addClass("is-invalid");

        return false;
    }
    if ($("#btnConsolidado")) {
        var btnConsolidado = $("#btnConsolidado").attr("estado");
        var btnConsulTarifa = $("#btnConsulTarifa").attr("estado");
        var btnConsolidado = patternPregNumEntero(btnConsolidado);
        var btnConsulTarifa = patternPregNumEntero(btnConsulTarifa);
    } else {
        var btnConsolidado = 1;
        var btnConsulTarifa = 1;
        swal({
            type: "error",
            title: "Error selección consolidado",
            text: "De los botones azul y rojo seleccione una opción",
            showConfirmButton: true,
            confirmButtonText: "cerrar",
            closeConfirm: true
        });
    }
    var numeroLicencia = document.getElementById("numeroLicencia").value;
    var numeroMarchamo = document.getElementById("numeroMarchamo").value;
    var nombrePiloto = document.getElementById("nombrePiloto").value;
    var numeroPlaca = document.getElementById("numeroPlaca").value;
    var numeroContenedor = document.getElementById("numeroContenedor").value;
    var txtNitEmpresa = document.getElementById("txtNitEmpresa").value;

    if (cantClientes >= 1 && pesoIng > 0 && valorTotalAduana > 0 && tipoDeCambio >= 0.001 && totalValorCif > 0 && cantContenedores >= 1 && bultosIngreso >= 1 && valorImpuesto > 0) {
        /**
         * --------------------------------------------------------------------------------------------------------------------
         *
         * 28.11.19 AUGUSTO RUFINO GOMEZ CONCUAN: VALIDACION DE DATOS PROPORCIONADOS POR EL USUARIO
         *
         * --------------------------------------------------------------------------------------------------------------------
         */

        var cartaDeCupo = patternPreg(cartaDeCupo);
        if (indexText == "TO" || indexText == "DUT" || indexText == "FAUCA") {
            var cartaDeCupo = 1;
        }
        if (cantContenedores >= 1) {
            var cantContenedores = patternPregNumEntero(cantContenedores);
        } else if (cantContenedores == 0) {
            var cantContenedores = 0;

        }
        if (indexText == "DUT" || indexText == "FAUCA") {
            var dua = 1;
            var bl = 1;
            document.getElementById("dua").value = 0;
            document.getElementById("bl").value = 0;
        } else if (indexText != "DUT" || indexText != "FAUCA") {
            if (dua == "" || dua == 0 || bl == 0 || bl == "") {
                var dua = 0;
                var bl = 0;
            } else {
                var dua = patternPreg(dua);
                var bl = patternPreg(bl);
            }
        }
        var poliza = patternPregSinG(poliza);
        var bultosIngreso = patternPregNum(bultosIngreso);
        var puertoOrigen = patternCharsetNumProduc(puertoOrigen);
        if (cantClientes >= 1) {
            var cantClientes = patternPregNumEntero(cantClientes);
        } else if (cantClientes == 0) {
            var cantClientes = 0;
        }
        var producto = patternCharsetNumProduc(producto);
        if (producto == 0) {
            $("#producto").removeClass('is-valid');
            $("#producto").addClass('is-invalid');
        }
        var pesoIng = patternPregNum(pesoIng);
        if (pesoIng == 0) {
            $("#pesoIng").removeClass('is-valid');
            $("#pesoIng").addClass('is-invalid');
        }
        var valorTotalAduana = patternPregNum(valorTotalAduana);
        if (valorTotalAduana == 0) {
            $("#valorTotalAduana").removeClass('is-valid');
            $("#valorTotalAduana").addClass('is-invalid');
        }
        var tipoDeCambio = patternPregNum(tipoDeCambio);
        if (tipoDeCambio == 0) {
            $("#tipoDeCambio").removeClass('is-valid');
            $("#tipoDeCambio").addClass('is-invalid');
        }
        var totalValorCif = patternPregNum(totalValorCif);
        if (totalValorCif == 0) {
            $("#totalValorCif").removeClass('is-valid');
            $("#totalValorCif").addClass('is-invalid');
        }
        var valorImpuesto = patternPregNum(valorImpuesto);
        if (valorImpuesto == 0) {
            $("#valorImpuesto").removeClass('is-valid');
            $("#valorImpuesto").addClass('is-invalid');
        }
        var hiddenDateTimeVal = validarFecha(hiddenDateTimeVal);
        if (valorImpuesto == 0) {
            $("#hiddenDateTimeVal").removeClass('is-valid');
            $("#hiddenDateTimeVal").addClass('is-invalid');
        }
        var sel2 = patternPregSpaceSG(sel2);
        if (sel2 == 0) {
            $("#sel2").removeClass('is-valid');
            $("#sel2").addClass('is-invalid');
        }
        var servicioTarifa = patternPregNumEntero(servicioTarifa);
        if (servicioTarifa == 0) {
            $("#servicioTarifa").removeClass('is-valid');
            $("#servicioTarifa").addClass('is-invalid');
        }
        var buttonPilotoExtranejero = $("#buttonPilotoExtranejero").val();
        var valTextLicExt = $("#numeroLicencia").attr("type");
        if (valTextLicExt == "number") {
            var numeroLicencia = patternPregNumEntero(numeroLicencia);
            if (numeroLicencia == 0) {
                $("#numeroLicencia").removeClass('is-valid');
                $("#numeroLicencia").addClass('is-invalid');
            }
        } else {
            var valTextLicExt = $("#numeroLicencia").val();
            if (valTextLicExt.length <= 5) {
                Swal.fire({
                    position: 'top-center',
                    type: 'error',
                    title: 'Numero de licencia no es valida',
                    showConfirmButton: false,
                    timer: 3000
                })
            } else {
                var respValida = await patternPreg(valTextLicExt);
                if (respValida == 1) {
                    $(this).removeClass("is-invalid");
                    $(this).addClass("is-valid");
                    document.getElementById("nombrePiloto").readOnly = false;
                    var numeroLicencia = 1;
                } else {
                    $(this).removeClass("is-valid");
                    $(this).addClass("is-invalid");
                    document.getElementById("nombrePiloto").readOnly = true;
                    document.getElementById("nombrePiloto").readOnly = "";
                    $("#nombrePiloto").val();
                }
            }
        }
        var numeroMarchamo = patternPregSinG(numeroMarchamo);
        if (numeroMarchamo == 0) {
            $("#numeroMarchamo").removeClass('is-valid');
            $("#numeroMarchamo").addClass('is-invalid');
        }
        var nombrePiloto = patternPregSpaceSG(nombrePiloto);
        if (nombrePiloto == 0) {
            $("#nombrePiloto").removeClass('is-valid');
            $("#nombrePiloto").addClass('is-invalid');
        }
        var numeroPlaca = patternPregSinG(numeroPlaca);
        if (numeroPlaca == 0) {
            $("#numeroPlaca").removeClass('is-valid');
            $("#numeroPlaca").addClass('is-invalid');
        }
        var numeroContenedor = patternPregSinG(numeroContenedor);
        if (numeroContenedor == 0) {
            $("#numeroContenedor").removeClass('is-valid');
            $("#numeroContenedor").addClass('is-invalid');
        }
        if (indexText == "DUT" || indexText == "FAUCA") {
            var dua = 1;
            var bl = 1;
        }
        console.log(indexText);
        console.log(cartaDeCupo);
        console.log(cantContenedores);
        console.log(dua);
        console.log(bl);
        console.log(poliza);
        console.log(bultosIngreso);
        console.log(puertoOrigen);
        console.log(cantClientes);
        console.log(producto);
        console.log(pesoIng);
        console.log(valorTotalAduana);
        console.log(tipoDeCambio);
        console.log(totalValorCif);
        console.log(valorImpuesto);
        console.log(hiddenDateTimeVal);
        console.log(sel2);
        console.log(servicioTarifa);
        console.log(numeroLicencia);
        console.log(numeroMarchamo);
        console.log(nombrePiloto);
        console.log(numeroPlaca);
        console.log(numeroContenedor);

        var suma = (cartaDeCupo + cantContenedores + dua + bl + poliza + bultosIngreso + puertoOrigen + cantClientes + producto + pesoIng + valorTotalAduana + tipoDeCambio + totalValorCif + valorImpuesto + hiddenDateTimeVal + sel2 + servicioTarifa + numeroLicencia + numeroMarchamo + nombrePiloto + numeroPlaca + numeroContenedor);

        if (suma >= 22) {
            if (document.getElementById("btnConsolidado")) {
                document.getElementById("btnConsolidado").disabled = true;
                document.getElementById("btnConsulTarifa").disabled = true;
            }
            return true;
        } else {
            return false;
        }
        /**
         * --------------------------------------------------------------------------------------------------------------------
         *
         * FIN DE LA VALIDACION
         *
         * --------------------------------------------------------------------------------------------------------------------
         **/
    } else {
        return false;
    }
}

$(document).on("change", "#txtNitEmpresa", async function () {
    if ($(this).val() == "") {
        $("#txtNitEmpresa").removeClass("is-valid");
        $("#txtNitEmpresa").addClass("is-invalid");
        Swal.fire({
            position: 'top-center',
            type: 'error',
            title: '¡El nit ingresado es invalido, revise!',
            showConfirmButton: true
        })
        borrarDatosCliente();
        return false;
    }
    document.getElementById("hiddenTipoTar").value = 0;
    var datoBuscado = $(this).val();
    var verGuiones = await patternPregSinG(datoBuscado);
    if (verGuiones == 0) {
        borrarDatosCliente();
        Swal.fire({
            position: 'top-center',
            type: 'error',
            title: '¡El nit ingresado es invalido los guiones no son aceptados, revise!',
            showConfirmButton: false,
            timer: 3000
        })

    } else {
        var valNit = await validar_nit(datoBuscado);
        if (valNit) {
            $("#txtNitEmpresa").removeClass("is-invalid");
            $("#txtNitEmpresa").addClass("is-valid");
            var esperandoRes = await funcionBuscarNit(datoBuscado);
            if (esperandoRes) {
                Swal.fire({
                    position: 'top-end',
                    type: 'info',
                    title: 'Seleccione la fecha real de ingreso en garita',
                    showConfirmButton: false,
                    timer: 5000
                })

                document.getElementById("dateTime").focus();
            }
        } else {

            borrarDatosCliente();
            $("#txtNitEmpresa").removeClass("is-valid");
            $("#txtNitEmpresa").addClass("is-invalid");
            Swal.fire({
                position: 'top-center',
                type: 'error',
                title: '¡El nit ingresado es invalido, revise!',
                showConfirmButton: true
            })
        }
    }
});


/*
 $(document).on("click", ".btnGuardaIngresoB", function() {
 var idRegPol = document.getElementById("regimenPoliza").value;
 var consolidado = 0;
 var idUsuarioCliente = document.getElementById("lblIdMostrar").value;
 var cartaDeCupo = document.getElementById("cartaDeCupo").value;
 var poliza = document.getElementById("poliza").value;
 var cantContenedores = document.getElementById("cantContenedores").value;
 var dua = document.getElementById("dua").value;
 var bl = document.getElementById("bl").value;
 var puertoOrigen = document.getElementById("puertoOrigen").value;
 var producto = document.getElementById("producto").value;
 var cantClientes = document.getElementById("cantClientes").value;
 var peso = document.getElementById("pesoIng").value;
 var bultos = document.getElementById("bultosIngreso").value;
 var valorTotalAduana = document.getElementById("valorTotalAduana").value;
 var tipoDeCambio = document.getElementById("tipoDeCambio").value;
 var totalValorCif = document.getElementById("totalValorCif").value;
 var valorImpuesto = document.getElementById("valorImpuesto").value;
 var idUsuarioCliente = document.getElementById("lblIdMostrar").value;
 var idNitCliente = document.getElementById("lblClienteId").value;
 var dependencia = document.getElementById("dependencia").value;
 var hiddenIdBod = document.getElementById("hiddenIdBod").value;
 var hiddenDateTime = document.getElementById("hiddenDateTime").value;
 var servicioTarifa = document.getElementById("servicioTarifa").value;
 /*DATOS DE UNIDAD DE TRANSPORTE*/
/*  var numeroLicencia = document.getElementById("numeroLicencia").value;
 var nombrePiloto = document.getElementById("nombrePiloto").value;
 var numeroPlaca = document.getElementById("numeroPlaca").value;
 var numeroContenedor = document.getElementById("numeroContenedor").value;
 var numeroMarchamo = document.getElementById("numeroMarchamo").value;
 /*FIN DATOS UNIDAD DE TRANSPORTE*/
/*  var datos = new FormData();
 datos.append("cartaDeCupo", cartaDeCupo);
 datos.append("poliza", poliza);
 datos.append("cantContenedores", cantContenedores);
 datos.append("dua", dua);
 datos.append("bl", bl);
 datos.append("puertoOrigen", puertoOrigen);
 datos.append("producto", producto);
 datos.append("cantClientes", cantClientes);
 datos.append("peso", peso);
 datos.append("bultos", bultos);
 datos.append("valorTotalAduana", valorTotalAduana);
 datos.append("tipoDeCambio", tipoDeCambio);
 datos.append("totalValorCif", totalValorCif);
 datos.append("valorImpuesto", valorImpuesto);
 datos.append("idUsuarioCliente", idUsuarioCliente);
 datos.append("idNitCliente", idNitCliente);
 datos.append("dependencia", dependencia);
 datos.append("consolidado", consolidado);
 datos.append("hiddenIdBod", hiddenIdBod);
 datos.append("numeroLicencia", numeroLicencia);
 datos.append("nombrePiloto", nombrePiloto);
 datos.append("numeroPlaca", numeroPlaca);
 datos.append("numeroContenedor", numeroContenedor);
 datos.append("numeroMarchamo", numeroMarchamo);
 datos.append("hiddenDateTime", hiddenDateTime);
 datos.append("servicioTarifa", servicioTarifa);
 datos.append("idRegPol", idRegPol);
 $.ajax({
 url: "ajax/operacionesBIngreso.ajax.php",
 method: "POST",
 data: datos,
 cache: false,
 contentType: false,
 processData: false,
 dataType: "json",
 success: function(respuesta) {
 console.log(respuesta);
 document.getElementById("hiddenIdentity").value = respuesta[0]["Identity"];
 },
 error: function(respuesta) {
 console.log(respuesta);
 }
 });
 swal({
 title: "Creado Correctamente",
 text: "El ingreso fue creado exitosamente...",
 type: "success"
 }).then(okay => {
 if (okay) {
 document.getElementById("cartaDeCupo").readOnly = true;
 document.getElementById("cantContenedores").readOnly = true;
 document.getElementById("dua").readOnly = true;
 document.getElementById("bl").readOnly = true;
 document.getElementById("poliza").readOnly = true;
 document.getElementById("bultosIngreso").readOnly = true;
 document.getElementById("puertoOrigen").disabled = true;
 document.getElementById("cantClientes").readOnly = true;
 document.getElementById("producto").readOnly = true;
 document.getElementById("pesoIng").readOnly = true;
 document.getElementById("valorTotalAduana").readOnly = true;
 document.getElementById("tipoDeCambio").readOnly = true;
 document.getElementById("totalValorCif").readOnly = true;
 document.getElementById("valorImpuesto").readOnly = true;
 document.getElementById("divAcciones").innerHTML = "";
 document.getElementById("divAcciones").innerHTML = '<div class="btn-group btn-group-lg" id="divMasButtons"><button type="button" class="btn btn-warning btnEditarIngreso" id="editarData" estado=0>Editar</button><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#guardarEmpresas" id="gDetalles">Cargar Empresas</button><button type="button" class="btn btn-info" data-toggle="modal" data-target="#plusPilotos">Agregar mas pilotos </i class="fa fa-plus"></i></button></div>';
 
 }
 });
 });*/
$(document).on("click", ".btnEditarIngreso", function () {



    if (document.getElementById("btnConsolidado")) {
        document.getElementById("btnConsolidado").disabled = true;
        document.getElementById("btnConsulTarifa").disabled = true;
    }
    if (document.getElementById("btnNoAplica")) {
        document.getElementById("btnNoAplica").disabled = true;
    }
    var estado = $(this).attr("estado");
    if (estado == 0) {
        $(this).removeClass('btn-warning');
        $(this).addClass('btn-primary');
        $(this).html('Guardar Cambios');
        $(this).attr('estado', 1);
        document.getElementById("servicioTarifa").disabled = false;
        document.getElementById("cartaDeCupo").readOnly = false;
        document.getElementById("cantContenedores").readOnly = false;
        document.getElementById("dua").readOnly = false;
        document.getElementById("bl").readOnly = false;
        document.getElementById("poliza").readOnly = false;
        document.getElementById("bultosIngreso").readOnly = false;
        document.getElementById("puertoOrigen").disabled = false;
        document.getElementById("cantClientes").readOnly = false;
        document.getElementById("producto").readOnly = false;
        document.getElementById("pesoIng").readOnly = false;
        document.getElementById("valorTotalAduana").readOnly = false;
        document.getElementById("tipoDeCambio").readOnly = false;
        document.getElementById("totalValorCif").readOnly = false;
        document.getElementById("valorImpuesto").readOnly = false;
        document.getElementById("dateTime").readOnly = false;
        document.getElementById("sel2").disabled = false;
        if (!document.getElementById("lblIdMostrar")) {
            if (document.getElementById("btnConsolidado")) {
                document.getElementById("btnConsolidado").disabled = false;
                document.getElementById("btnConsulTarifa").disabled = false;
            }
        }
        document.getElementById("servicioTarifa").disabled = false;
        document.getElementById("regimenPoliza").disabled = false;
        document.getElementById("numeroLicencia").readOnly = false;
        document.getElementById("numeroMarchamo").readOnly = false;
        document.getElementById("nombrePiloto").readOnly = false;
        document.getElementById("numeroPlaca").readOnly = false;
        document.getElementById("numeroContenedor").readOnly = false;
        document.getElementById("regimenPoliza").readOnly = false;
        document.getElementById("txtNitEmpresa").readOnly = false;
    } else if (estado = 1) {
        $(this).removeClass('btn-primary');
        $(this).addClass('btn-warning');
        $(this).html('Editar');
        $(this).attr('estado', 0);
        document.getElementById("cartaDeCupo").readOnly = true;
        document.getElementById("cantContenedores").readOnly = true;
        document.getElementById("dua").readOnly = true;
        document.getElementById("bl").readOnly = true;
        document.getElementById("poliza").readOnly = true;
        document.getElementById("bultosIngreso").readOnly = true;
        document.getElementById("puertoOrigen").disabled = true;
        document.getElementById("cantClientes").readOnly = true;
        document.getElementById("producto").readOnly = true;
        document.getElementById("pesoIng").readOnly = true;
        document.getElementById("valorTotalAduana").readOnly = true;
        document.getElementById("tipoDeCambio").readOnly = true;
        document.getElementById("totalValorCif").readOnly = true;
        document.getElementById("valorImpuesto").readOnly = true;
        document.getElementById("dateTime").readOnly = true;
        document.getElementById("sel2").disabled = true;
        document.getElementById("servicioTarifa").disabled = true;
        document.getElementById("regimenPoliza").disabled = true;
        document.getElementById("numeroLicencia").readOnly = true;
        document.getElementById("numeroMarchamo").readOnly = true;
        document.getElementById("nombrePiloto").readOnly = true;
        document.getElementById("numeroPlaca").readOnly = true;
        document.getElementById("numeroContenedor").readOnly = true;
        document.getElementById("regimenPoliza").readOnly = true;
        document.getElementById("txtNitEmpresa").readOnly = true;
        if (document.getElementById("lblIdMostrar")) {
            var idUsuarioClienteEditar = document.getElementById("lblIdMostrar").value;
            var consolidadoEditar = 0;
        } else {
            var idUsuarioClienteEditar = 0;
            var consolidadoEditar = 1;
        }
        var identity = document.getElementById("hiddenIdentity").value;
        var lblEmpresaEditar = document.getElementById("lblEmpresa").innerHTML;
        var sel2Editar = document.getElementById("sel2").value;
        var idRegPolEditar = document.getElementById("regimenPoliza").value;
        var cartaDeCupoEditar = document.getElementById("cartaDeCupo").value;
        var polizaEditar = document.getElementById("poliza").value;
        var regimenPolizaEditar = document.getElementById("regimenPoliza").value;
        var cantContenedoresEditar = document.getElementById("cantContenedores").value;
        var duaEditar = document.getElementById("dua").value;
        var blEditar = document.getElementById("bl").value;
        var puertoOrigenEditar = document.getElementById("puertoOrigen").value;
        var productoEditar = document.getElementById("producto").value;
        var cantClientesEditar = document.getElementById("cantClientes").value;
        var pesoEditar = document.getElementById("pesoIng").value;
        var bultosEditar = document.getElementById("bultosIngreso").value;
        var valorTotalAduanaEditar = document.getElementById("valorTotalAduana").value;
        var tipoDeCambioEditar = document.getElementById("tipoDeCambio").value;
        var totalValorCifEditar = document.getElementById("totalValorCif").value;
        var valorImpuestoEditar = document.getElementById("valorImpuesto").value;
        /**ESTUDIAR LA BASE DE DATOS VER LA REDUNDANCIA DE DATA  */
        var idNitClienteEditar = document.getElementById("lblClienteId").value;
        var dependenciaEditar = document.getElementById("dependencia").value;
        var hiddenIdBodEditar = document.getElementById("hiddenIdBod").value;
        var hiddenDateTimeEditar = document.getElementById("hiddenDateTime").value;
        var servicioTarifaEditar = document.getElementById("servicioTarifa").value;
        /*DATOS DE UNIDAD DE TRANSPORTE*/
        var numeroLicenciaEditar = document.getElementById("numeroLicencia").value;
        var nombrePilotoEditar = document.getElementById("nombrePiloto").value;
        var numeroPlacaEditar = document.getElementById("numeroPlaca").value;
        var numeroContenedorEditar = document.getElementById("numeroContenedor").value;
        var numeroMarchamoEditar = document.getElementById("numeroMarchamo").value;
        var datos = new FormData();
        datos.append("lblEmpresaEditar", lblEmpresaEditar);
        datos.append("sel2Editar", sel2Editar);
        datos.append("idRegPolEditar", idRegPolEditar);
        datos.append("cartaDeCupoEditar", cartaDeCupoEditar);
        datos.append("polizaEditar", polizaEditar);
        datos.append("cantContenedoresEditar", cantContenedoresEditar);
        datos.append("duaEditar", duaEditar);
        datos.append("blEditar", blEditar);
        datos.append("puertoOrigenEditar", puertoOrigenEditar);
        datos.append("productoEditar", productoEditar);
        datos.append("cantClientesEditar", cantClientesEditar);
        datos.append("pesoEditar", pesoEditar);
        datos.append("bultosEditar", bultosEditar);
        datos.append("valorTotalAduanaEditar", valorTotalAduanaEditar);
        datos.append("tipoDeCambioEditar", tipoDeCambioEditar);
        datos.append("totalValorCifEditar", totalValorCifEditar);
        datos.append("valorImpuestoEditar", valorImpuestoEditar);
        datos.append("idNitClienteEditar", idNitClienteEditar);
        datos.append("dependenciaEditar", dependenciaEditar);
        datos.append("hiddenIdBodEditar", hiddenIdBodEditar);
        datos.append("hiddenDateTimeEditar", hiddenDateTimeEditar);
        datos.append("servicioTarifaEditar", servicioTarifaEditar);
        datos.append("numeroLicenciaEditar", numeroLicenciaEditar);
        datos.append("nombrePilotoEditar", nombrePilotoEditar);
        datos.append("numeroPlacaEditar", numeroPlacaEditar);
        datos.append("numeroContenedorEditar", numeroContenedorEditar);
        datos.append("numeroMarchamoEditar", numeroMarchamoEditar);
        datos.append("regimenPolizaEditar", regimenPolizaEditar);
        datos.append("identity", identity);
        datos.append("idUsuarioClienteEditar", idUsuarioClienteEditar);
        datos.append("consolidadoEditar", consolidadoEditar);
        $.ajax({
            url: "ajax/operacionesBIngreso.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (respuesta) {
                if (respuesta == "EXITO") {
                    Swal.fire({
                        position: 'top-center',
                        type: 'success',
                        title: 'Ingreso con numero de ingreso  se edito con exito',
                        showConfirmButton: false,
                        timer: 2500
                    })
                }
            },
            error: function (respuesta) {
                console.log(respuesta);
            }
        })
    }
})
/*
 $(document).on("click", ".btnAnular", function() {
 var identityAnular = document.getElementById("hiddenIdentity").value;
 var datos = new FormData();
 datos.append("identityAnular", identityAnular);
 $.ajax({
 url: "ajax/operacionesBIngreso.ajax.php",
 method: "POST",
 data: datos,
 cache: false,
 contentType: false,
 processData: false,
 dataType: "json",
 success: function(respuesta) {
 if (respuesta == "ANULADOOPF") {
 Swal.fire({
 position: 'top-center',
 type: 'warning',
 title: 'Ingreso con numero de ingreso  Se anulo',
 showConfirmButton: false,
 timer: 5000
 })
 document.getElementById("divAcciones").innerHTML = "";
 }
 },
 error: function(respuesta) {}
 })
 })
 $(document).ready(function() {
 $("#selectConsolidado").change(function() {
 var consolidado = document.getElementById("selectConsolidado").value;
 if (consolidado == "Consolidado Simple") {
 var cantClientes = document.getElementById("cantClientes").value;
 if (cantClientes > 1) {
 document.getElementById("valueClientes").value = cantClientes;
 var tipoBusqueda = document.getElementById("tipoBusqueda").value;
 }
 } else if (consolidado == "Consolidado Polizas") {
 var cantClientes = document.getElementById("cantClientes").value;
 document.getElementById("diveGuardaEmpresa").innerHTML = '';
 document.getElementById("diveGuardaEmpresa").innerHTML = `
 <div class="col-12">
 <label>CONSOLIDADO SIMPLE</label>
 <input type="hidden" id="valueClientes" name="valueClientes" value="">
 <input type="hidden" id="cantVsClientes" name="cantVsClientes" value="0">
 </div>
 <div class="col-3">
 <div class="form-group">
 <label>Numero de poliza</label>
 <input type="text" class="form-control" id="tipoBusqueda" name="tipoBusqueda" placeholder="Ingrese Nombre de empresa">
 </div>
 </div>
 <div class="col-3">
 <div class="form-group">
 <label>Nombre de empresa</label>
 <input type="text" class="form-control" id="tipoBusqueda" name="tipoBusqueda" placeholder="Ingrese Nombre de empresa">
 </div>
 </div>
 <div class="col-3">
 <div class="form-group">
 <label>Cantidad de bultos</label>
 <input type="text" class="form-control" id="bultosAgregados" name="bultosAgregados" placeholder="Ingrese cantidad de bultos">
 </div>
 </div>
 <div class="col-3">
 <div class="form-group">
 <label>Valor Peso</label>
 <input type="text" class="form-control" id="pesoAgregado" name="pesoAgregado" placeholder="Ingrese peso">
 </div>
 </div>
 <div class="col-4">
 <div class="btn-group" role="group" aria-label="Basic example">
 <button type="button" class="btn btn-success btnAgregarEmpresa" btnAgrega=0>Agregar Empresa</button>
 </div>
 <div class="col-4">
 <div class="btn-group" role="group" aria-label="Basic example">
 <button type="button" class="btn btn-success btnAgregarEmpresa" btnAgrega=0>Agregar Empresa</button>
 </div>
 
 </div>
 `;
 }
 })
 })*/
$(document).on("click", ".btnCancelaCarga", function () {
    document.getElementById("diveGuardaEmpresa").innerHTML = '';
    document.getElementById("diveGuardaEmpresa").innerHTML = '<!--===================================== MODAL Agregar Empresa ======================================--> <!--ialog"> <div class="modal-dialog modal-lg"> <!-- Modal content--> <div class="modal-content"> <div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button> </div><div class="modal-body"><!--===================================== INICIO FORM======================================--> <div class="col-md-12"> <!-- Horizontal Form --><div class="card card-info"><div class="card-header"> <h3 class="card-title">Edicion de usuarios</h3> </div><!--campos formularios --><form role="form" method="post" id="divGuardaDetalle"><div class="form-horizontal"> <div class="card-body"> <div class="row" id="diveGuardaEmpresa"><div class="col-md-12"> <div class="form-group"><label> Minimal </label><select class="form-control select2" id="selectConsolidado" name="selectConsolidado" style="width: 100%;"><option selected="selected">Selecciona consolidado</option> <option>Consolidado Simple</option> <option>Consolidado Polizas </option> </select> </div></div></div><!--===================================== FIN FORM======================================--> </div></div></div></form> </div></div></div></div></div>';
})

$(document).on("click", ".btnAgregarEmpresa", async function () {
    if ($("#tableConsolidadoPoliza").length == 0) {
        var hiddenIdentityIngPeso = document.getElementById("hiddenIdentity").value;

    }
    if ($("#tableConsolidadoPoliza").length > 0) {
        var hiddenIdentityIngPeso = document.getElementById("idIngManiElegido").value;
    }
    console.log(hiddenIdentityIngPeso);

    var poliza = document.getElementById("poliza").value;

    if ($("#tableConsolidadoPoliza").length >= 1 && $(".btnEliminarDetalleIng").length == 0) {
        Swal.fire({
            title: 'Seguro quiere hacer cambio de cliente?',
            text: "Si hace el cambio tiene que cuadrar el manifiesto contra poliza!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            allowOutsideClick: false,
            confirmButtonText: 'Si, hacer cambio!'
        }).then(async function (result) {
            if (result.value) {
                var nomVar = "deleteDetalle";
                var respDelete = await revisarVehUsados(nomVar, hiddenIdentityIngPeso);
                console.log(respDelete);
                if (respDelete[0]["resp"] == 1) {
                    Swal.fire({
                        title: 'Eliminado con exito',
                        text: "Cuadre el nuevo manifiesto",
                        type: 'success',
                        confirmButtonColor: '#3085d6',
                        allowOutsideClick: false,
                        confirmButtonText: 'Ok!'
                    }).then(async function (result) {
                        if (result.value) {

                            var cantidadClientes = document.getElementById("cantClientes").value;
                            var paragraphsPesoIng = Array.from(document.querySelectorAll("#TextpesoIng"));
                            if (paragraphsPesoIng.length > 0) {
                                var paragraphsBltsIng = Array.from(document.querySelectorAll("#TextBltsIng"));
                                var cantClt = 0;
                                for (var i = 0; i < paragraphsBltsIng.length; i++) {
                                    var cantClt = cantClt + 1

                                }
                            }
                            if (cantClt == cantidadClientes) {
                                Swal.fire({
                                    title: 'Descuadre en clientes',
                                    text: "La cantidad de empresas tiene que ser igual a los clientes detallados!",
                                    type: 'error',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Ok!'
                                }).then((result) => {
                                    if (result.value) {
                                        return false;
                                    }
                                })
                            } else {
                                var hiddenIdentityIngPeso = document.getElementById("hiddenIdentity").value;
                                var tipoBusqueda = document.getElementById("tipoBusqueda").value;
                                var bultosAgregados = document.getElementById("bultosAgregados").value;
                                var bultosAgregados = parseInt(bultosAgregados);
                                var pesoAgregado = document.getElementById("pesoAgregado").value;
                                var pesoAgregado = pesoAgregado * 1;
                                var pesoAgregado = parseFloat(pesoAgregado).toFixed(2);
                                var totalBultos = 0;
                                var totalPeso = 0;
                                var paragraphsPesoIng = Array.from(document.querySelectorAll("#TextpesoIng"));

                                if (paragraphsPesoIng.length >= 1) {
                                    var paragraphsBltsIng = Array.from(document.querySelectorAll("#TextBltsIng"));
                                    var totalBultos = 0;
                                    for (var i = 0; i < paragraphsBltsIng.length; i++) {
                                        var bultosIng = paragraphsBltsIng[i].attributes[3].value;
                                        var bultosIng = parseInt(bultosIng);
                                        var totalBultos = totalBultos + bultosIng;

                                    }
                                    var totalBultos = totalBultos + bultosAgregados;
                                    var totalBultos = parseInt(totalBultos);
                                    var totalPeso = pesoAgregado * 1;
                                    var paragraphsPesoIng = Array.from(document.querySelectorAll("#TextpesoIng"));
                                    for (var j = 0; j < paragraphsPesoIng.length; j++) {
                                        var pesoIng = paragraphsPesoIng[j].attributes[3].value;
                                        var pesoIng = parseFloat(pesoIng).toFixed(2);
                                        var pesoIng = pesoIng * 1;
                                        var totalPeso = totalPeso + pesoIng;
                                    }
                                    var totalPeso = totalPeso;
                                    var totalPeso = parseFloat(totalPeso).toFixed(2);

                                    var cantidadClientes = document.getElementById("cantClientes").value;
                                    var bultosIngPol = document.getElementById("bultosIngreso").value;
                                    var bultosIngPol = parseInt(bultosIngPol);

                                    var saldoNuevoCruceBlts = bultosIngPol - totalBultos;
                                    var saldoNuevoCruceBlts = parseInt(saldoNuevoCruceBlts);


                                    var pesoIngPol = document.getElementById("pesoIng").value;
                                    var pesoIngPol = parseFloat(pesoIngPol).toFixed(2);
                                    var saldoNuevoCrucePeso = pesoIngPol - totalPeso;
                                    var saldoNuevoCrucePeso = parseFloat(saldoNuevoCrucePeso).toFixed(2);

                                    if (saldoNuevoCruceBlts >= 0 && saldoNuevoCrucePeso >= 0) {
                                        $("#divEmpresasAgregadasMani").append('<div class="col-12"><div class="input-group mb-3"><div class="input-group-prepend" id="dataManifiesto"><button type="button" class="btn btn-danger btnEliminarDetalleIng"><i class="fa fa-trash"></i></button></div><input type="text" class="form-control" value="' + tipoBusqueda + '" id="nomEmpresa" readOnly="readOnly"><input type="number" class="form-control" id="TextBltsIng" value="' + bultosAgregados + '" readOnly="readOnly"><input type="number"  class="form-control" id="TextpesoIng"  value="' + pesoAgregado + '"  readOnly="readOnly"></div></div>');

                                    } else {
                                        Swal.fire(
                                                'Sobregiro!',
                                                'El detalle por agregar sobregira los saldos revise de bultos o peso!',
                                                'error'
                                                )
                                        return false;
                                    }

                                } else {
                                    var totalBultos = totalBultos + bultosAgregados;
                                    var totalPeso = totalPeso + pesoAgregado;

                                    var bultosIngPol = document.getElementById("bultosIngreso").value;
                                    var bultosIngPol = parseInt(bultosIngPol);
                                    var pesoIngPol = document.getElementById("pesoIng").value;
                                    var pesoIngPol = parseFloat(pesoIngPol).toFixed(2);
                                    var saldoNuevoCruceBlts = bultosIngPol - totalBultos;
                                    var saldoNuevoCruceBlts = parseInt(saldoNuevoCruceBlts);
                                    var saldoNuevoCrucePeso = pesoIngPol - totalPeso;
                                    var saldoNuevoCrucePeso = parseFloat(saldoNuevoCrucePeso).toFixed(2);
                                    console.log(saldoNuevoCrucePeso);
                                    console.log(saldoNuevoCruceBlts);

                                    if (saldoNuevoCruceBlts >= 0 && saldoNuevoCrucePeso >= 0) {
                                        $("#divEmpresasAgregadasMani").append('<div class="col-12"><div class="input-group mb-3"><div class="input-group-prepend" id="dataManifiesto"><button type="button" class="btn btn-danger btnEliminarDetalleIng"><i class="fa fa-trash"></i></button></div><input type="text" class="form-control" value="' + tipoBusqueda + '" id="nomEmpresa" readOnly="readOnly"><input type="number" class="form-control" id="TextBltsIng" value="' + bultosAgregados + '" readOnly="readOnly"><input type="number"  class="form-control" id="TextpesoIng"  value="' + pesoAgregado + '"  readOnly="readOnly"></div></div>');
                                    } else {
                                        Swal.fire(
                                                'Sobregiro!',
                                                'El detalle por agregar sobregira los saldos revise de bultos o peso!',
                                                'error'
                                                )

                                        return false;
                                    }

                                }


                                if ($("#TextpesoIng").length >= 1) {
                                    var paragraphsBltsIng = Array.from(document.querySelectorAll("#TextBltsIng"));
                                    var totalBultos = 0;
                                    for (var i = 0; i < paragraphsBltsIng.length; i++) {
                                        var bultosIng = paragraphsBltsIng[i].attributes[3].value;
                                        var bultosIng = parseInt(bultosIng);
                                        var totalBultos = totalBultos + bultosIng;
                                        var totalBultos = parseInt(totalBultos);

                                    }
                                    var paragraphsPesoIng = Array.from(document.querySelectorAll("#TextpesoIng"));
                                    var totalPeso = 0;
                                    for (var j = 0; j < paragraphsPesoIng.length; j++) {
                                        var pesoIng = paragraphsPesoIng[j].attributes[3].value;
                                        var pesoIng = parseFloat(pesoIng).toFixed(2);
                                        var pesoIng = pesoIng * 1;
                                        var totalPeso = totalPeso + pesoIng;
                                    }
                                    var totalPeso = parseFloat(totalPeso).toFixed(2);
                                    console.log(totalPeso);

                                    if ($("#cantClientes").length >= 1) {
                                        var cantidadClientes = document.getElementById("cantClientes").value;
                                        var bultosIngPol = document.getElementById("bultosIngreso").value;
                                        var bultosIngPol = parseInt(bultosIngPol);

                                        var saldoNuevoCruceBlts = bultosIngPol - totalBultos;
                                        var saldoNuevoCruceBlts = parseInt(saldoNuevoCruceBlts);

                                        document.getElementById("saldoIngNblts").innerHTML = bultosIngPol;
                                        document.getElementById("saldoNuevoblts").innerHTML = totalBultos;
                                        document.getElementById("bltsRetirados").innerHTML = saldoNuevoCruceBlts;


                                        var pesoIngPol = document.getElementById("pesoIng").value;
                                        var pesoIngPol = parseFloat(pesoIngPol).toFixed(2);
                                        var saldoNuevoCrucePeso = pesoIngPol - totalPeso;
                                        var saldoNuevoCrucePeso = parseFloat(saldoNuevoCrucePeso).toFixed(2);


                                        document.getElementById("saldoIngNPeso").innerHTML = pesoIngPol;
                                        document.getElementById("pesoNuevoblts").innerHTML = totalPeso;
                                        document.getElementById("pesoRetirados").innerHTML = saldoNuevoCrucePeso;


                                        document.getElementById("tipoBusqueda").value = "";
                                        $("#tipoBusqueda").removeClass("is-valid");
                                        $("#tipoBusqueda").addClass("is-invalid");

                                        document.getElementById("bultosAgregados").value = "";
                                        $("#bultosAgregados").removeClass("is-valid");
                                        $("#bultosAgregados").addClass("is-invalid");

                                        document.getElementById("pesoAgregado").value = "";
                                        $("#pesoAgregado").removeClass("is-valid");
                                        $("#pesoAgregado").addClass("is-invalid");

                                        var clientes = paragraphsBltsIng.length;

                                        document.getElementById("contadorClientes").innerHTML = clientes;
                                        if (saldoNuevoCrucePeso == 0 && saldoNuevoCruceBlts == 0) {
                                            document.getElementById("btnGuardarDetallesIng").disabled = false;
                                            $("#btnGuardarDetallesIng").removeClass("btn-default");
                                            $("#btnGuardarDetallesIng").addClass("btn-primary");
                                            Swal.fire(
                                                    'Manifiesto Cuadrado!',
                                                    'Haga click en guardar detalles!',
                                                    'info'
                                                    )
                                        } else {
                                            document.getElementById("tipoBusqueda").focus();

                                        }

                                    }
                                }

                            }

                        }
                    })
                }
            }
        })
    } else {


        var cantidadClientes = document.getElementById("cantClientes").value;
        var paragraphsPesoIng = Array.from(document.querySelectorAll("#TextpesoIng"));
        if (paragraphsPesoIng.length > 0) {
            var paragraphsBltsIng = Array.from(document.querySelectorAll("#TextBltsIng"));
            var cantClt = 0;
            for (var i = 0; i < paragraphsBltsIng.length; i++) {
                var cantClt = cantClt + 1

            }
        }
        if (cantClt == cantidadClientes) {
            Swal.fire({
                title: 'Descuadre en clientes',
                text: "La cantidad de empresas tiene que ser igual a los clientes detallados!",
                type: 'error',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ok!'
            }).then((result) => {
                if (result.value) {
                    return false;
                }
            })
        } else {
            var hiddenIdentityIngPeso = document.getElementById("hiddenIdentity").value;
            var tipoBusqueda = document.getElementById("tipoBusqueda").value;
            var bultosAgregados = document.getElementById("bultosAgregados").value;
            var bultosAgregados = parseInt(bultosAgregados);
            var pesoAgregado = document.getElementById("pesoAgregado").value;
            var pesoAgregado = pesoAgregado * 1;
            var pesoAgregado = parseFloat(pesoAgregado).toFixed(2);
            /*
             var respuestaSaldoPeso = await saldoPesoIng(hiddenIdentityIngPeso, bultosAgregados, pesoAgregado);
             console.log(respuestaSaldoPeso);
             
             if (respuestaSaldoPeso == "Ok") {
             var revisar = await fucionRevisarConsolidado();
             console.log(revisar);
             if (revisar == 3) {
             var tipoBusqueda = document.getElementById("tipoBusqueda").value;
             var bultosAgregados = document.getElementById("bultosAgregados").value;
             var pesoAgregado = document.getElementById("pesoAgregado").value;
             if (tipoBusqueda == "") {
             alert("existe un dato vacio favor revise");
             } else {
             */
            /*if ($("#divTableFail").length == 0) {
             document.getElementById('colorDiv').setAttribute('class', "small-box bg-success");
             document.getElementById("clientesRegs").innerHTML = "Clientes agregados";
             document.getElementById("gDetalles").innerHTML = "Agregar o revisar";
             var cantVsClientes = document.getElementById("cantVsClientes").value;
             document.getElementById('gDetalles').setAttribute('class', "btn btn-info");
             var valueClientes = document.getElementById("valueClientes").value;
             cantVsClientes = parseInt(cantVsClientes) + 1;
             document.getElementById("contadorH3").innerHTML = cantVsClientes;
             document.getElementById("contadorClientes").innerHTML = cantVsClientes;
             }*/
            var totalBultos = 0;
            var totalPeso = 0;
            var paragraphsPesoIng = Array.from(document.querySelectorAll("#TextpesoIng"));

            if (paragraphsPesoIng.length >= 1) {
                var paragraphsBltsIng = Array.from(document.querySelectorAll("#TextBltsIng"));
                var totalBultos = 0;
                for (var i = 0; i < paragraphsBltsIng.length; i++) {
                    var bultosIng = paragraphsBltsIng[i].attributes[3].value;
                    var bultosIng = parseInt(bultosIng);
                    var totalBultos = totalBultos + bultosIng;

                }
                var totalBultos = totalBultos + bultosAgregados;
                var totalBultos = parseInt(totalBultos);
                var totalPeso = pesoAgregado * 1;
                var paragraphsPesoIng = Array.from(document.querySelectorAll("#TextpesoIng"));
                for (var j = 0; j < paragraphsPesoIng.length; j++) {
                    var pesoIng = paragraphsPesoIng[j].attributes[3].value;
                    var pesoIng = parseFloat(pesoIng).toFixed(2);
                    var pesoIng = pesoIng * 1;
                    var totalPeso = totalPeso + pesoIng;
                }
                var totalPeso = totalPeso;
                var totalPeso = parseFloat(totalPeso).toFixed(2);

                var cantidadClientes = document.getElementById("cantClientes").value;
                var bultosIngPol = document.getElementById("bultosIngreso").value;
                var bultosIngPol = parseInt(bultosIngPol);

                var saldoNuevoCruceBlts = bultosIngPol - totalBultos;
                var saldoNuevoCruceBlts = parseInt(saldoNuevoCruceBlts);


                var pesoIngPol = document.getElementById("pesoIng").value;
                var pesoIngPol = parseFloat(pesoIngPol).toFixed(2);
                var saldoNuevoCrucePeso = pesoIngPol - totalPeso;
                var saldoNuevoCrucePeso = parseFloat(saldoNuevoCrucePeso).toFixed(2);

                if (saldoNuevoCruceBlts >= 0 && saldoNuevoCrucePeso >= 0) {
                    $("#divEmpresasAgregadasMani").append('<div class="col-12"><div class="input-group mb-3"><div class="input-group-prepend" id="dataManifiesto"><button type="button" class="btn btn-danger btnEliminarDetalleIng"><i class="fa fa-trash"></i></button></div><input type="text" class="form-control" value="' + tipoBusqueda + '" id="nomEmpresa" readOnly="readOnly"><input type="number" class="form-control" id="TextBltsIng" value="' + bultosAgregados + '" readOnly="readOnly"><input type="number"  class="form-control" id="TextpesoIng"  value="' + pesoAgregado + '"  readOnly="readOnly"></div></div>');

                } else {
                    Swal.fire(
                            'Sobregiro!',
                            'El detalle por agregar sobregira los saldos revise de bultos o peso!',
                            'error'
                            )
                    return false;
                }

            } else {
                var totalBultos = totalBultos + bultosAgregados;
                var totalPeso = totalPeso + pesoAgregado;

                var bultosIngPol = document.getElementById("bultosIngreso").value;
                var bultosIngPol = parseInt(bultosIngPol);
                var pesoIngPol = document.getElementById("pesoIng").value;
                var pesoIngPol = parseFloat(pesoIngPol).toFixed(2);
                var saldoNuevoCruceBlts = bultosIngPol - totalBultos;
                var saldoNuevoCruceBlts = parseInt(saldoNuevoCruceBlts);
                var saldoNuevoCrucePeso = pesoIngPol - totalPeso;
                var saldoNuevoCrucePeso = parseFloat(saldoNuevoCrucePeso).toFixed(2);
                console.log(saldoNuevoCrucePeso);
                console.log(saldoNuevoCruceBlts);

                if (saldoNuevoCruceBlts >= 0 && saldoNuevoCrucePeso >= 0) {
                    $("#divEmpresasAgregadasMani").append('<div class="col-12"><div class="input-group mb-3"><div class="input-group-prepend" id="dataManifiesto"><button type="button" class="btn btn-danger btnEliminarDetalleIng"><i class="fa fa-trash"></i></button></div><input type="text" class="form-control" value="' + tipoBusqueda + '" id="nomEmpresa" readOnly="readOnly"><input type="number" class="form-control" id="TextBltsIng" value="' + bultosAgregados + '" readOnly="readOnly"><input type="number"  class="form-control" id="TextpesoIng"  value="' + pesoAgregado + '"  readOnly="readOnly"></div></div>');
                } else {
                    Swal.fire(
                            'Sobregiro!',
                            'El detalle por agregar sobregira los saldos revise de bultos o peso!',
                            'error'
                            )

                    return false;
                }

            }


            if ($("#TextpesoIng").length >= 1) {
                var paragraphsBltsIng = Array.from(document.querySelectorAll("#TextBltsIng"));
                var totalBultos = 0;
                for (var i = 0; i < paragraphsBltsIng.length; i++) {
                    var bultosIng = paragraphsBltsIng[i].attributes[3].value;
                    var bultosIng = parseInt(bultosIng);
                    var totalBultos = totalBultos + bultosIng;
                    var totalBultos = parseInt(totalBultos);

                }
                var paragraphsPesoIng = Array.from(document.querySelectorAll("#TextpesoIng"));
                var totalPeso = 0;
                for (var j = 0; j < paragraphsPesoIng.length; j++) {
                    var pesoIng = paragraphsPesoIng[j].attributes[3].value;
                    var pesoIng = parseFloat(pesoIng).toFixed(2);
                    var pesoIng = pesoIng * 1;
                    var totalPeso = totalPeso + pesoIng;
                }
                var totalPeso = parseFloat(totalPeso).toFixed(2);
                console.log(totalPeso);

                if ($("#cantClientes").length >= 1) {
                    var cantidadClientes = document.getElementById("cantClientes").value;
                    var bultosIngPol = document.getElementById("bultosIngreso").value;
                    var bultosIngPol = parseInt(bultosIngPol);

                    var saldoNuevoCruceBlts = bultosIngPol - totalBultos;
                    var saldoNuevoCruceBlts = parseInt(saldoNuevoCruceBlts);

                    document.getElementById("saldoIngNblts").innerHTML = bultosIngPol;
                    document.getElementById("saldoNuevoblts").innerHTML = totalBultos;
                    document.getElementById("bltsRetirados").innerHTML = saldoNuevoCruceBlts;


                    var pesoIngPol = document.getElementById("pesoIng").value;
                    var pesoIngPol = parseFloat(pesoIngPol).toFixed(2);
                    var saldoNuevoCrucePeso = pesoIngPol - totalPeso;
                    var saldoNuevoCrucePeso = parseFloat(saldoNuevoCrucePeso).toFixed(2);


                    document.getElementById("saldoIngNPeso").innerHTML = pesoIngPol;
                    document.getElementById("pesoNuevoblts").innerHTML = totalPeso;
                    document.getElementById("pesoRetirados").innerHTML = saldoNuevoCrucePeso;


                    document.getElementById("tipoBusqueda").value = "";
                    $("#tipoBusqueda").removeClass("is-valid");
                    $("#tipoBusqueda").addClass("is-invalid");

                    document.getElementById("bultosAgregados").value = "";
                    $("#bultosAgregados").removeClass("is-valid");
                    $("#bultosAgregados").addClass("is-invalid");

                    document.getElementById("pesoAgregado").value = "";
                    $("#pesoAgregado").removeClass("is-valid");
                    $("#pesoAgregado").addClass("is-invalid");

                    var clientes = paragraphsBltsIng.length;

                    document.getElementById("contadorClientes").innerHTML = clientes;
                    if (saldoNuevoCrucePeso == 0 && saldoNuevoCruceBlts == 0) {
                        document.getElementById("btnGuardarDetallesIng").disabled = false;
                        $("#btnGuardarDetallesIng").removeClass("btn-default");
                        $("#btnGuardarDetallesIng").addClass("btn-primary");
                        Swal.fire(
                                'Manifiesto Cuadrado!',
                                'Haga click en guardar detalles!',
                                'info'
                                )
                    } else {
                        document.getElementById("tipoBusqueda").focus();

                    }

                }
            }

            /* var llaveConsulta = document.getElementById("hiddenIdentity").value;
             var datos = new FormData();
             datos.append("llaveConsulta", llaveConsulta);
             datos.append("tipoBusqueda", tipoBusqueda);
             datos.append("bultosAgregados", bultosAgregados);
             datos.append("pesoAgregado", pesoAgregado);
             $.ajax({
             url: "ajax/operacionesBIngreso.ajax.php",
             method: "POST",
             data: datos,
             cache: false,
             contentType: false,
             processData: false,
             dataType: "json",
             success: function (respuesta) {
             console.log(respuesta);
             if (respuesta == "sobreGiro") {
             swal({
             type: "error",
             title: "Bultos Ingresados",
             text: "Los bultos ingresados, sobre pasa los limites de lo que reporto en el ingreso",
             showConfirmButton: true,
             confirmButtonText: "cerrar",
             closeConfirm: true
             });
             }
             console.log(790);
             if (respuesta["estado"] == "OK") {
             console.log(respuesta["estado"]);
             if ($("#divTableFail").length == 0) {
             
             
             document.getElementById('colorDiv').setAttribute('class', "small-box bg-success");
             document.getElementById("clientesRegs").innerHTML = "Clientes agregados";
             document.getElementById("gDetalles").innerHTML = "Agregar o revisar";
             var cantVsClientes = document.getElementById("cantVsClientes").value;
             document.getElementById('gDetalles').setAttribute('class', "btn btn-info");
             var valueClientes = document.getElementById("valueClientes").value;
             cantVsClientes = parseInt(cantVsClientes) + 1;
             document.getElementById("contadorH3").innerHTML = cantVsClientes;
             document.getElementById("contadorClientes").innerHTML = cantVsClientes;
             }
             $("#divEmpresasAgregadasMani").append('<div id="divNumero' + respuesta["resultado"][0]["Identity"] + '" class="col-12"><div class="input-group mb-3"> <div class="input-group-prepend"><button type="button" class="btn btn-danger btnEliminarDetalle" numeroButtonTrash="' + respuesta["resultado"][0]["Identity"] + '" numBtnEliminar="' + cantVsClientes + '"><i class="fa fa-trash"></i></button><button type="button" class="btn btn-warning btnEditar" buttonEditar=' + respuesta["resultado"][0]["Identity"] + ' numBtnEditar="' + cantVsClientes + '" btnEstadoEdicion=0><i class="fa fa-edit"></i></button> </div><input type="text" class="form-control" value="' + tipoBusqueda + '" id="nomEmpresa' + cantVsClientes + '" numTxtEmpresa="' + cantVsClientes + '" readOnly="readOnly"><input type="text" class="form-control" value="' + bultosAgregados + '" id="bltsEmpresa' + cantVsClientes + '" numTxtBultos="' + cantVsClientes + '" readOnly="readOnly"><input type="text"  class="form-control" value="' + pesoAgregado + '"  id="pesoEmpresa' + cantVsClientes + '" numTxtPeso="' + cantVsClientes + '" readOnly="readOnly"></div></div>');
             
             document.getElementById("cantVsClientes").value = cantVsClientes;
             
             document.getElementById("tipoBusqueda").value = '';
             document.getElementById("tipoBusqueda").value = '';
             document.getElementById("bultosAgregados").value = '';
             document.getElementById("pesoAgregado").value = '';
             
             $("#tipoBusqueda").removeClass("is-valid");
             $("#tipoBusqueda").addClass("is-invalid");
             $("#bultosAgregados").removeClass("is-valid");
             $("#bultosAgregados").addClass("is-invalid");
             $("#pesoAgregado").removeClass("is-valid");
             $("#pesoAgregado").addClass("is-invalid");
             document.getElementById("tipoBusqueda").focus();
             } else if (respuesta == "No") {
             alert("existen bultos");
             } else if (respuesta["estado"] == "Okk") {
             swal({
             title: "Operación Exitosa",
             text: "Toda la transacción fue operada correctamente",
             type: "success"
             }).then(okay => {
             if (okay) {
             if ($("#divTableFail").length == 0) {
             document.getElementById('colorDiv').setAttribute('class', "small-box bg-primary");
             document.getElementById("clientesRegs").innerHTML = 'TODOS LOS CLIENTES FUERON AGREGADOS';
             document.getElementById("gDetalles").innerHTML = "Editar Clientes";
             document.getElementById('gDetalles').setAttribute('class', "btn btn-success");
             var valueClientes = document.getElementById("valueClientes").value;
             var cantVsClientes = document.getElementById("cantVsClientes").value;
             cantVsClientes = parseInt(cantVsClientes) + 1;
             document.getElementById("contadorH3").innerHTML = cantVsClientes;
             document.getElementById("contadorClientes").innerHTML = cantVsClientes;
             }
             $("#divEmpresasAgregadasMani").append('<div id="divNumero' + respuesta["resultado"][0]["Identity"] + '" class="col-12"><div class="input-group mb-3"> <div class="input-group-prepend"><button type="button" class="btn btn-danger btnEliminarDetalle" numeroButtonTrash="' + respuesta["resultado"][0]["Identity"] + '" numBtnEliminar="' + cantVsClientes + '"><i class="fa fa-trash"></i></button><button type="button" class="btn btn-warning btnEditar" buttonEditar=' + respuesta["resultado"][0]["Identity"] + ' numBtnEditar="' + cantVsClientes + '" btnEstadoEdicion=0><i class="fa fa-edit"></i></button> </div><input type="text" class="form-control" value="' + tipoBusqueda + '" id="nomEmpresa' + cantVsClientes + '" numTxtEmpresa="' + cantVsClientes + '" readOnly="readOnly"><input type="text" class="form-control" value="' + bultosAgregados + '" id="bltsEmpresa' + cantVsClientes + '" numTxtBultos="' + cantVsClientes + '" readOnly="readOnly"><input type="text"  class="form-control" value="' + pesoAgregado + '"  id="pesoEmpresa' + cantVsClientes + '" numTxtPeso="' + cantVsClientes + '" readOnly="readOnly"></div></div>');
             document.getElementById("cantVsClientes").value = cantVsClientes;
             
             document.getElementById("tipoBusqueda").value = '';
             document.getElementById("bultosAgregados").value = '';
             document.getElementById("pesoAgregado").value = '';
             document.getElementById("saldoIngN").innerHTML = respuesta["saldo"];
             $(".close").click();
             
             }
             });
             }
             },
             error: function (respuesta) {
             console.log(respuesta);
             }
             })*/
            /*    }
             } else {
             console.log("no se puede guardar porque no existe un campo erroneo");
             }
             } else {
             swal({
             type: "error",
             title: "Sobregiro",
             text: "La operación realizada sobregira el stock en bultos o peso, por favor revise",
             showConfirmButton: true,
             confirmButtonText: "cerrar",
             closeConfirm: true
             });
             }*/
        }
    }
})
$(document).on("change", "#tipoDeCambio", function () {
    var tipoDeCambio = document.getElementById("tipoDeCambio").value;
    var valorTotalAduana = document.getElementById("valorTotalAduana").value;
    var valorCif = multiplicacion(tipoDeCambio, valorTotalAduana);


    if (valorCif > 0) {
        document.getElementById("totalValorCif").value = valorCif;
        $("#totalValorCif").removeClass("is-invalid");
        $("#totalValorCif").addClass("is-valid");
        document.getElementById("totalValorCif").readOnly = true;
        document.getElementById("valorImpuesto").focus();

    } else if (valorCif == 0) {
        document.getElementById("totalValorCif").value = '';
        $("#totalValorCif").removeClass("is-valid");
        $("#totalValorCif").addClass("is-invalid");
        document.getElementById("totalValorCif").readOnly = false;

    }
})
$(document).on("change", "#valorTotalAduana", function () {
    var tipoDeCambio = document.getElementById("tipoDeCambio").value;
    var valorTotalAduana = document.getElementById("valorTotalAduana").value;
    var valorCif = multiplicacion(tipoDeCambio, valorTotalAduana);
    if (valorCif > 0) {
        document.getElementById("totalValorCif").value = valorCif;
        $("#totalValorCif").removeClass("is-invalid");
        $("#totalValorCif").addClass("is-valid");
        document.getElementById("totalValorCif").readOnly = true;
        document.getElementById("valorImpuesto").focus();


    } else if (valorCif == 0) {
        document.getElementById("totalValorCif").value = '';
        $("#totalValorCif").removeClass("is-valid");
        $("#totalValorCif").addClass("is-invalid");
        document.getElementById("totalValorCif").readOnly = false;

    }
})
$(document).on("click", ".btnEliminarDetalle", function () {
    var llaveAnular = $(this).attr("numeroButtonTrash");
    var datos = new FormData();
    datos.append("llaveAnular", llaveAnular);
    $.ajax({
        url: "ajax/operacionesBIngreso.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            if (respuesta == "Anulado") {

                swal({
                    title: "Aviso",
                    text: "Se anulo el detalle del ingreso",
                    type: "success"
                }).then(okay => {
                    if (okay) {
                        $("#divNumero" + llaveAnular).remove();
                    }
                });
            } else if (respuesta == "ConDetalleBodega") {
                swal({
                    type: "error",
                    title: "Anulación Interrumpida",
                    text: "Comuniquese con El personal de bodega para modificar, ya existe detalle de este cliente.",
                    showConfirmButton: true,
                    confirmButtonText: "cerrar",
                    closeConfirm: true
                });
            }
        },
        error: function (respuesta) {
            console.log(respuesta);
        }
    });
});
$(document).on("click", ".btnEditar", function () {

    var estadobuttonedit = $(this).attr("btnEstadoEdicion");
    var llaveConsultaEdit = document.getElementById("hiddenIdentity").value;
    var botonGuardar = $(this).attr("numbtneditar");
    var nomEmpresa = "nomEmpresa" + botonGuardar;
    var bltsEmpresa = "bltsEmpresa" + botonGuardar;
    var pesoEmpresa = "pesoEmpresa" + botonGuardar;
    if (estadobuttonedit == 0) {
        $(this).removeClass('btn-warning');
        $(this).addClass('btn-primary');
        $(this).html('<i class="fa fa-save"></i>');
        $(this).attr('btnEstadoEdicion', 1);
        document.getElementById(nomEmpresa).readOnly = false;
        document.getElementById(bltsEmpresa).readOnly = false;
        document.getElementById(pesoEmpresa).readOnly = false;
    } else if (estadobuttonedit == 1) {
        $(this).removeClass('btn-primary');
        $(this).addClass('btn-warning');
        $(this).html('<i class="fa fa-edit"></i>');
        $(this).attr('btnEstadoEdicion', 0);
        if ($("#divEdiciones").length == 0) {


            var textnomEmpresa = document.getElementById(nomEmpresa).value;
            var textbltsEmpresa = document.getElementById(bltsEmpresa).value;
            var textpesoEmpresa = document.getElementById(pesoEmpresa).value;
            var buttonEditar = $(this).attr("numbtneditar");
            var textbltsEmpresa = parseInt(textbltsEmpresa);
            var textbltsEmpresa = textbltsEmpresa * 1;

            var textpesoEmpresa = parseFloat(textpesoEmpresa).toFixed(2);
            var textpesoEmpresa = textpesoEmpresa * 1;

            var llaveConsultaEdit = parseInt(llaveConsultaEdit);
            var llaveConsultaEdit = llaveConsultaEdit * 1;
            var buttonEditar = parseInt(buttonEditar);
            var buttonEditar = buttonEditar * 1;
            var datos = new FormData();
            datos.append("buttonEditar", buttonEditar);
            datos.append("textnomEmpresa", textnomEmpresa);
            datos.append("textbltsEmpresa", textbltsEmpresa);
            datos.append("textpesoEmpresa", textpesoEmpresa);
            datos.append("llaveConsultaEdit", llaveConsultaEdit);
            $.ajax({
                url: "ajax/operacionesBIngreso.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (respuesta) {
                    console.log(respuesta);
                    if (respuesta[0].resp == 1) {
                        swal({
                            type: "success",
                            title: "Editado satisfactoriamente",
                            text: "El detalle Fue Editado Con Éxito, el ingreso fue guardado exitosamente",
                            showConfirmButton: true,
                            confirmButtonText: "cerrar",
                            closeConfirm: true
                        });
                        return true;

                    } else {
                        swal({
                            type: "error",
                            title: "No se edito",
                            text: "Hubo un error desconocido no se pudo editar",
                            showConfirmButton: true,
                            confirmButtonText: "cerrar",
                            closeConfirm: true
                        });
                        return false;
                    }
                    return false;
                    if (respuesta == "conDetCorregido") {
                        swal({
                            type: "warning",
                            title: "Se edito empresa y peso, bultos no se pueden editar porque bodega ya opero transacciones",
                            showConfirmButton: true,
                            confirmButtonText: "cerrar",
                            closeConfirm: true
                        });

                    }
                    if (respuesta["Tipo"] == "ConDetalleBodega") {
                        swal({
                            title: "Error",
                            text: "La edición fue Interrumpida, comuquese con bodega para editar",
                            type: "error"
                        }).then(okay => {
                            if (okay) {
                                document.getElementById(nomEmpresa).value = respuesta['datos'][0]['empresa'];
                                document.getElementById(bltsEmpresa).value = respuesta['datos'][0]['bultos'];
                                document.getElementById(pesoEmpresa).value = respuesta['datos'][0]['peso'];
                                document.getElementById(nomEmpresa).readOnly = true;
                                document.getElementById(bltsEmpresa).readOnly = true;
                                document.getElementById(pesoEmpresa).readOnly = true;
                            }
                        });
                    }
                    if (respuesta == "corregido") {
                        swal({
                            type: "success",
                            title: "Editado satisfactoriamente",
                            text: "El detalle Fue Editado Con Éxito",
                            showConfirmButton: true,
                            confirmButtonText: "cerrar",
                            closeConfirm: true
                        });
                    } else if (respuesta == "bultosExcede") {
                        swal({
                            type: "error",
                            title: "Exceso de bultos",
                            text: "Sobre pasa el limite de los bultos detallados en el ingreso",
                            showConfirmButton: true,
                            confirmButtonText: "cerrar",
                            closeConfirm: true
                        });
                    }
                    if (respuesta == "corregidoFinalizarlo") {
                        swal({
                            type: "success",
                            title: "Editado satisfactoriamente",
                            text: "El detalle Fue Editado Con Éxito, el ingreso fue guardado exitosamente",
                            showConfirmButton: true,
                            confirmButtonText: "cerrar",
                            closeConfirm: true
                        });
                        if ($("#divTableFail").length == 0) {


                            document.getElementById('colorDiv').setAttribute('class', "small-box bg-primary");
                            document.getElementById("clientesRegs").innerHTML = 'TODOS LOS CLIENTES FUERON AGREGADOS';
                            if ($("#gDetalles").length>0) {
                                document.getElementById("gDetalles").innerHTML = "Editar Clientes";
                                document.getElementById('gDetalles').setAttribute('class', "btn btn-success");
                            }

                            //                    document.getElementById("divMasButtons").innerHTML += '<button type="button" class="btn btn-info btnPlusPilotos">Agregar mas pilotos <i class="fa fa-plus"></i></button>';
                            var valueClientes = document.getElementById("valueClientes").value;
                            var cantVsClientes = document.getElementById("cantVsClientes").value;
                            cantVsClientes = parseInt(cantVsClientes) + 1;
                            document.getElementById("contadorH3").innerHTML = cantVsClientes;
                            document.getElementById("contadorClientes").innerHTML = cantVsClientes;
                        }
                        $("#divEmpresasAgregadas").append('<div id="divNumero' + respuesta["resultado"][0]["Identity"] + '" class="col-12"><div class="input-group mb-3"> <div class="input-group-prepend"><button type="button" class="btn btn-danger btnEliminarDetalle" numeroButtonTrash="' + respuesta["resultado"][0]["Identity"] + '" numBtnEliminar="' + cantVsClientes + '"><i class="fa fa-trash"></i></button><button type="button" class="btn btn-warning btnEditar" buttonEditar=' + respuesta["resultado"][0]["Identity"] + ' numBtnEditar="' + cantVsClientes + '" btnEstadoEdicion=0><i class="fa fa-edit"></i></button> </div><input type="text" class="form-control" value="' + tipoBusqueda + '" id="nomEmpresa' + cantVsClientes + '" numTxtEmpresa="' + cantVsClientes + '" readOnly="readOnly"><input type="text" class="form-control" value="' + bultosAgregados + '" id="bltsEmpresa' + cantVsClientes + '" numTxtBultos="' + cantVsClientes + '" readOnly="readOnly"><input type="text"  class="form-control" value="' + pesoAgregado + '"  id="pesoEmpresa' + cantVsClientes + '" numTxtPeso="' + cantVsClientes + '" readOnly="readOnly"></div></div>');
                        document.getElementById("cantVsClientes").value = cantVsClientes;

                        document.getElementById("tipoBusqueda").value = '';
                        document.getElementById("bultosAgregados").value = '';
                        document.getElementById("pesoAgregado").value = '';
                    }
                },
                error: function (respuesta) {
                    console.log(respuesta);
                }
            })
        }
    }
})
$(document).on("click", ".btnConsolidado", function () {
    $(this).removeClass('btn-danger');
    $(this).addClass('btn-info');
    $(this).attr("estado", 1);
    $(this).html('Asignado como tarifa general&nbsp;&nbsp;<i class="fa fa-thumbs-up"></i>');
    document.getElementById("divEjecutivo").innerHTML = '<div class="alert alert-warning" role="alert"><strong>Asignado como tarifa general : </strong><br/>Significa que todos los calculos y cobros de almacenaje se registraran con tarifa generales en ZA o AF, segun su regimen.</div>';
    var btnConsulTarifa = $("#btnConsulTarifa").attr("estado");
    if (btnConsulTarifa == 1) {
        $("#btnConsulTarifa").removeClass('btn-info');
        $("#btnConsulTarifa").addClass('btn-primary');
        $("#btnConsulTarifa").attr("estado", 0);
        $("#btnConsulTarifa").html('Notificación a ejecutivos');
    }
    //  document.getElementById("divAcciones").innerHTML = '<button type="button" class="btn btn-primary btn-block btnIngresoSinTarifa" id="idBtnIngresoSinTarifa" estado=0>Guardar Cambios</button></div></div></div></div>';

});
$(document).on("click", ".btnConsulTarifa", function () {
    var estadoConsolidado = $(this).attr("estado");
    $(this).removeClass('btn-primary');
    $(this).addClass('btn-info');
    $(this).attr("estado", 1);
    $(this).html('Se notificara a ejecutivos de ventas&nbsp;&nbsp;<i class="fa fa-thumbs-up"></i>');
    document.getElementById("divEjecutivo").innerHTML = '<div class="alert alert-warning" role="alert"><strong>Se notificara a ejecutivos de ventas : </strong><br/>Significa que se asignará una tarea a el ejecutivo de ventas para determinar una tarifa especial.<br/>Continue su operación de ingreso, parcialmente se asigno tarifa general para calculos y cobros de almacenaje, hasta que la tarifa sea configurada.</div>';

    var btnConsolidado = $("#btnConsolidado").attr("estado");
    if (btnConsolidado == 1) {
        $("#btnConsolidado").removeClass('btn-info');
        $("#btnConsolidado").addClass('btn-danger');
        $("#btnConsolidado").attr("estado", 0);
        $("#btnConsolidado").html('Registrar como tarifa general');
    }
    document.getElementById("divAcciones").innerHTML = '<button type="button" class="btn btn-primary btn-block btnIngresoSinTarifa" id="idBtnIngresoSinTarifa" estado=0>Guardar Cambios</button></div></div></div></div>';
});

function revisarPoliza(numeroDePoliza) {
    let respFunc;
    var datos = new FormData();
    datos.append("numPolRev", numeroDePoliza);
    $.ajax({
        async: false,
        url: "ajax/operacionesBIngreso.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            respFunc = respuesta;
        }, error: function (respuesta) {

        }})
    return respFunc;
}
$(document).on("click", ".btnIngresoSinTarifa", async function () {
    var tipoOperacion = document.getElementById("servicioTarifa");
    var indexValue = tipoOperacion.options[tipoOperacion.selectedIndex].value;
    var indexText = tipoOperacion.options[tipoOperacion.selectedIndex].text;
    if (indexText == "VEHICULOS NUEVOS") {
        document.getElementById("colorDiv").innerHTML = "";
        document.getElementById("divAccionesValidacion").innerHTML = `
 
 <div class="container">
 <h2>Validación e ingreso de chasis</h2>
 <p>En el siguiente campo, tiene que ingresar cada uno de los chasis delimitados por el simbolo pai " | "</p>
 <div class="form-group">
 <label for="comment">Ingresa los chasis de vehiculos:</label>
 <textarea class="form-control" rows="15" id="chasisDelimitados" name="text"></textarea>
 </div>
<div class="btn-group" id="buttonsChasis">
 <button type="button" class="btn btn-info btnValidarChasis" id="buttonChasis" estado=0>Validar Chasis <i class="fa fa-wrench"></i></button>
</div> 
</div>
<input type="hidden" id="hiddenJsonVehiculos" value="" />
<input type="hidden" id="hiddenGuardarDB" value="" />
`;


    }
    var numeroDePoliza = document.getElementById("poliza").value;
    var revisarPol = await revisarPoliza(numeroDePoliza);
    ///
    var datos = new FormData();
    datos.append("numPolRev", numeroDePoliza);
    $.ajax({
        url: "ajax/operacionesBIngreso.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: async function (respuesta) {
            console.log(respuesta);
            if (respuesta["datIng"][0].resultado == 0) {
                var tipo = 0;
                const val = await validacionParaGuardar();
                console.log(val);
                if (val) {
                    var selectSucces = $("#puertoOrigen").val();
                    if (selectSucces != "") {
                        var guardar = await guardarSinTarifa(tipo);
                        console.log(guardar);
                        if (guardar == true) {
                            swal({
                                title: "Guardado Correctamente",
                                text: "El ingreso fue guardado exitosamente...",
                                type: "success"
                            }).then(okay => {
                                if (okay) {
                                    document.getElementById("cartaDeCupo").readOnly = true;
                                    document.getElementById("cantContenedores").readOnly = true;
                                    document.getElementById("dua").readOnly = true;
                                    document.getElementById("bl").readOnly = true;
                                    document.getElementById("poliza").readOnly = true;
                                    document.getElementById("bultosIngreso").readOnly = true;
                                    document.getElementById("puertoOrigen").disabled = true;
                                    document.getElementById("cantClientes").readOnly = true;
                                    document.getElementById("producto").readOnly = true;
                                    document.getElementById("pesoIng").readOnly = true;
                                    document.getElementById("valorTotalAduana").readOnly = true;
                                    document.getElementById("tipoDeCambio").readOnly = true;
                                    document.getElementById("totalValorCif").readOnly = true;
                                    document.getElementById("valorImpuesto").readOnly = true;
                                    document.getElementById("dateTime").readOnly = true;
                                    document.getElementById("sel2").disabled = true;
                                    document.getElementById("servicioTarifa").disabled = true;
                                    document.getElementById("regimenPoliza").disabled = true;
                                    document.getElementById("numeroLicencia").readOnly = true;
                                    document.getElementById("numeroMarchamo").readOnly = true;
                                    document.getElementById("nombrePiloto").readOnly = true;
                                    document.getElementById("numeroPlaca").readOnly = true;
                                    document.getElementById("numeroContenedor").readOnly = true;
                                    document.getElementById("txtNitEmpresa").readOnly = true;

                                    var valTipoConso = $("#sel2 option:selected").text();
                                    if (valTipoConso == "Cliente consolidado") {
                                        document.getElementById("divAcciones").innerHTML = '';
                                        document.getElementById("divAcciones").innerHTML = '<div class="btn-group btn-group-lg" id="divMasButtons"><button type="button" class="btn btn-warning btnEditarIngreso" id="editarData" estado=0>Editar</button></button><button type="button" class="btn btn-dark btnMasPilotos" id="masPilotos" estado="0" data-toggle="modal" data-target="#plusPilotos">Agregar mas pilotos</button><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#gdrManifiestos" id="gDetallesManifiesto">Cargar Empresas</button></div>';
                                        if ($("#gDetalles").length>0) {
                                        document.getElementById("gDetalles").click();
                                            
                                        }
                                    }
                                    if (valTipoConso == "Cliente consolidado poliza") {

                                        if (tipo == 0) {
                                            var lblNit = document.getElementById("lblNit").innerHTML;
                                            var lblEmpresa = document.getElementById("lblEmpresa").innerHTML;
                                            document.getElementById("divPlusClientes").innerHTML = '<button type="button" class="btn btn-primary btnAgregarPoliza" id="btnPlusEmpresas" data-toggle="modal" data-target="#gdarEmpresasPolConso"><i class="fa fa-plus"></i></button><button type="button" class="btn btn-dark btnMasPilotos" id="masPilotos" estado="0" data-toggle="modal" data-target="#plusPilotos">Agregar mas pilotos</button>';
                                            document.getElementById("divAcciones").innerHTML = '<div class="btn-group btn-group-lg" id="divMasButtons"><button type="button" class="btn btn-warning btnEditarIngreso" id="editarData" estado=0>Editar</button></div>';
                                            document.getElementById("hiddenContadorPolizas").value = 1;
                                            if ($(".tableIngFail").length == 0) {
                                                $("#divAccionesValidacion").removeClass("col-4");
                                                $("#divAccionesValidacion").addClass("col-8");
                                                $("#divRelleno").removeClass("col-4");
                                                $("#divRelleno").addClass("col-0");
                                            }


                                            document.getElementById("divAccionesValidacion").innerHTML = `
              <table id="tableConsolidadoPoliza" class="table table-hover table-sm">
            </table>
              <input type="hidden" id="hiddenListaDeta" value="">`;
                                            var numero = 1;
                                            var contadorH3 = document.getElementById("contadorH3").innerHTML;
                                            var contadorH3 = contadorH3 + 1;
                                            document.getElementById("contadorH3").innerHTML = "";
                                            document.getElementById("contadorH3").innerHTML = contadorH3;
                                            document.getElementById("contadorClientes").innerHTML = "";
                                            document.getElementById("contadorClientes").innerHTML = cantVsClientes;
                                            var idIdenty = document.getElementById("hiddenIdentity").value;
                                            var acciones = '<div class="btn-group"><button type="button" class="btn btn-success btn-sm btnAcuseConsoli" id="btnConsol" idIng=' + idIdenty + '>Acuse</button><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#gdrManifiestos" id="gDetalles" idIng=' + idIdenty + '>Cargar Empresas</button></div>';
                                            var listaDataPoliza = [];
                                            var poliza = document.getElementById("poliza").value;
                                            var pesoIng = document.getElementById("pesoIng").value;
                                            var bultosIngreso = document.getElementById("bultosIngreso").value;
                                            listaDataPoliza.push([numero, poliza, lblNit, lblEmpresa, bultosIngreso, pesoIng, acciones]);

                                            $('#tableConsolidadoPoliza').DataTable({
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
                                                data: listaDataPoliza,
                                                columns: [{
                                                        title: "#"
                                                    }, {
                                                        title: "Poliza"
                                                    }, {
                                                        title: "Nit"
                                                    }, {
                                                        title: "Empresa"
                                                    }, {
                                                        title: "Bultos"
                                                    }, {
                                                        title: "Peso kg"
                                                    }, {
                                                        title: "Acciones"
                                                    }]
                                            });
                                            document.getElementById("divAccionesVehiculos").innerHTML = '';
                                        }
                                    }
                                    if (valTipoConso == "Cliente individual") {
                                        $("#sel2").removeClass("is-valid");
                                        $("#sel2").addClass("is-invalid");
                                        document.getElementById("divAcciones").innerHTML = '<div class="btn-group btn-group-lg" id="divMasButtons"><button type="button" class="btn btn-warning btnEditarIngreso" id="editarData" estado=0>Editar</button><button type="button" class="btn btn-dark btnMasPilotos" id="masPilotos" estado=0  data-toggle="modal" data-target="#plusPilotos">Agregar mas pilotos</button><button type="button" class="btn btn-success btnImpresionAcuse" id="ImprimirAcuse" estado=0>Imprimir Acuse</button></div>';
                                        Swal.fire({
                                            type: 'info',
                                            title: 'Transacción exitosa',
                                            text: 'Se guardo de manera exitosa el ingreso, operación finalizada',
                                            footer: '<a href="operacionesBIngreso">ElaborarNuevo Ingreso</a>'
                                        })
                                    }
                                }

                            });
                        }
                    } else {
                        swal({
                            type: "error",
                            title: "Formulario no valido",
                            text: "Puerto de origen no seleccionado",
                            showConfirmButton: true,
                            confirmButtonText: "cerrar",
                            closeConfirm: true
                        });
                    }
                } else {
                    swal({
                        type: "error",
                        title: "Formulario no valido",
                        text: "Los datos del formulario no son validos, revise en los campos que se marquen en rojo, no pueden estar vacios o con digitos no adminitos",
                        showConfirmButton: true,
                        confirmButtonText: "cerrar",
                        closeConfirm: true
                    });
                }
            } else {
                swal({
                    type: "error",
                    title: "Poliza existe",
                    text: "La poliza que se desea guardar ya existe, revise si la poliza detallada es correcta",
                    showConfirmButton: true,
                    confirmButtonText: "cerrar",
                    closeConfirm: true,
                    footer: 'Edite diregiendose a Historial de ingresos.'
                });
            }
        },
        error: function (respuesta) {
            console.log(respuesta);
        }
    });

});

function multiplicacion(tipoDeCambio, valorTotalAduana) {

    if (isNaN(tipoDeCambio) || isNaN(valorTotalAduana)) {
        alert("agregueNumeros");
    } else {
        var totalCif = (tipoDeCambio * valorTotalAduana);
        var total = totalCif.toFixed(2);
        return total;
    }
}

$(document).on("click", ".btnValidarChasis", function () {
    document.getElementById("divRelleno").innerHTML = "";
    document.getElementById("divChaisesNoEncontrados").innerHTML = "";
    document.getElementById("hiddenGuardarDB").innerHTML = "";
    var cantidadDeVehiculos = document.getElementById("bultosIngreso").value;

    var estado = $(this).attr("estado");
    if (estado == 0) {
        var iteraciones = 3;
        var chasisDelimitados = document.getElementById("chasisDelimitados").value;
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
                var chasis = cadenaArray[i];
                var tipoVeh = cadenaArray[i + 1];
                var lineaVeh = cadenaArray[i + 2];
                if (chasis == "" || tipoVeh == "" || lineaVeh == "") {
                    var denegacion = 1;
                    var mensaje = 'Debe ingresar Chasis, tipo vehiculo y linea del vehiculo, por cada vehiculo revise si el detalle proporcionado es correcto, tambien revise si el simbolo " | " no se encuentra al final del ultimo detalle...';
                    var tipo = "error";
                    alertaToast(mensaje, tipo);
                    break;
                }
                var i = (i + 2);
                lista.push([numFila, chasis, tipoVeh, lineaVeh]);
            }
            console.log(cantidadDeVehiculos);
            console.log(cadenaArray.length / 3)
            if (cantidadDeVehiculos != (cadenaArray.length / 3)) {
                swal({
                    type: "error",
                    title: "Diferencia de vehÍculos",
                    text: "La diferencia de vehciulos no es igual a lo declarado, revise si agrego vehiculos de mas o menos",
                    showConfirmButton: true,
                    confirmButtonText: "cerrar",
                    closeConfirm: true
                });
            } else {
                document.getElementById("buttonsChasis").innerHTML = '<button type="button" class="btn btn-info btnValidarChasis" id="buttonChasis" estado="0">Validar Chasis <i class="fa fa-wrench" aria-hidden="true"></i></button><button type="button" class="btn btn-success btnGuradarChasVeh">Guardar Chasises </button>';
            }
            var listaValidacion = JSON.stringify(lista);
            var datos = new FormData();
            datos.append("listaValidacion", listaValidacion);
            $.ajax({
                url: "ajax/operacionesBIngreso.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (respuesta) {
                    console.log(respuesta);
                    document.getElementById("divChaisesNoEncontrados").innerHTML = "";
                    if ($("#tableChasisNoEncotrados").length) {
                        document.getElementById("tableChasisNoEncotrados").innerHTML = "";
                    }


                    var listaEstado = [];
                    var listaOkValidacion = [];
                    var listaDB = [];

                    var listaOkRev = [];
                    var chasisNoEncontrado = 0;
                    for (var i = 0; i < respuesta.length; i++) {
                        var chasisErroneo = 0;
                        var numero = (i + 1);
                        var chasis = respuesta[i].chasis;
                        var tipoVehiculo = respuesta[i].TipoVehiculo;
                        var lineaVehiculo = respuesta[i].lineaVehiculo;
                        var estado = respuesta[i].estado;
                        if (estado == 0) {
                            console.log(estado);
                            console.log(chasis);
                            var buttonEstado = '<button type="button" class="btn btn-danger btn-sm"><i class="fa fa-window-close"></i></button>';
                            var chasisErroneo = chasisErroneo + 1;
                            listaEstado.push([chasis, tipoVehiculo, lineaVehiculo, estado]);
                        } else if (estado == 1) {
                            console.log(estado);
                            console.log(chasis);

                            var buttonEstado = '<button type="button" class="btn btn-success btn-sm"><i class="fa fa-check-square"></i></button>';
                        } else if (estado == 2) {
                            console.log(estado);
                            console.log(chasis);

                            var chasisErroneo = 0;
                            var buttonEstado = '<button type="button" class="btn btn-warning btn-sm"><i class="fa fa-check-square"></i></button>';
                            listaEstado.push([chasis, tipoVehiculo, lineaVehiculo, estado]);
                        }

                        listaOkValidacion.push([numero, chasis, tipoVehiculo, lineaVehiculo, buttonEstado]);
                        listaOkRev.push([numero, chasis, tipoVehiculo, lineaVehiculo, estado]);
                        listaDB.push([chasis, tipoVehiculo, lineaVehiculo]);

                    }

                    if (chasisErroneo >= 1) {
                        listaDataRevNoEn = [];
                        listaDBNoEnc = [];
                        console.log(listaEstado);
                        for (chasisNoEn = 0; chasisNoEn < listaEstado.length; chasisNoEn++) {
                            var numeralChasis = chasisNoEn + 1;
                            var tipo = listaEstado[chasisNoEn][1];
                            var linea = listaEstado[chasisNoEn][2];
                            var estado = listaEstado[chasisNoEn][3];
                            if (estado == 0) {
                                var buttton = '<button type="button" class="btn btn-danger btnVeirfLinea" tipoLinea="' + tipo + ' - ' + linea + '" tipoVeh=' + tipo + ' lineaVeh=' + linea + '><i class="fa fa-close"></i></button>';
                            }
                            if (estado == 1 || estado == 2) {
                                var buttton = '<button type="button" class="btn btn-warning btnVeirfLinea" tipoLinea="' + tipo + ' - ' + linea + '" tipoVeh=' + tipo + ' lineaVeh=' + linea + '><i class="fa fa-close"></i></button>';
                            }
                            if (chasisNoEn == 0) {
                                listaDataRevNoEn.push([numeralChasis, tipo, linea, buttton]);
                            } else {
                                for (listaCreada = 0; listaCreada < listaDataRevNoEn.length; listaCreada++) {
                                    var estadoNuevo = 0;
                                    if (tipo == listaDataRevNoEn[listaCreada][1] && linea == listaDataRevNoEn[listaCreada][2]) {
                                        var estadoNuevo = 1;
                                    }
                                }
                                if (estadoNuevo == 0) {
                                    listaDataRevNoEn.push([numeralChasis, tipo, linea, buttton]);
                                    listaDBNoEnc.push([tipo, linea, 0]);

                                }
                            }
                        }
                        console.log(listaDataRevNoEn);
                        document.getElementById("divChaisesNoEncontrados").innerHTML = "";
                        document.getElementById("divChaisesNoEncontrados").innerHTML = '<table id="tableChasisNoEncotrados" class="table table-hover table-sm"></table>';
                        document.getElementById("buttonsChasis").innerHTML = '<button type="button" class="btn btn-info btnValidarChasis" id="buttonChasis" estado="0">Validar Chasis <i class="fa fa-wrench" aria-hidden="true"></i></button><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#verChasisNoEncon">Ver lineas no encotradas</button>'

                        $('#tableChasisNoEncotrados').DataTable({
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
                            data: listaDataRevNoEn,
                            columns: [{
                                    title: "#"
                                }, {
                                    title: "Tipo de vehículo"
                                }, {
                                    title: "Linea vehículo"
                                }, {
                                    title: "Estado vehículo"
                                }]
                        });
                        document.getElementById("hiddenGuardarDB").value = JSON.stringify(listaDBNoEnc);

                    }
                    if (denegacion == 0) {
                        console.log(chasisErroneo);
                        if (chasisErroneo == 0) {
                            var mensaje = "Se cargo el listado exitosamente todos los vehiculos";
                            var tipo = "success";
                            alertaToast(mensaje, tipo);
                        } else {
                            swal({
                                type: "error",
                                title: "Error detalle de chasis",
                                text: "Los detalles, tipo de veh    iculo o linea del vehiculo que ud. proporcionan no existen en la base de datos, revisrevise los chasis con error",
                                showConfirmButton: true,
                                confirmButtonText: "cerrar",
                                closeConfirm: true
                            });
                        }
                        document.getElementById("hiddenJsonVehiculos").value = JSON.stringify(listaDB);

                        if ($(".tableIngFail").length == 0) {
                            $("#divRelleno").addClass('col-8');
                        }
                        document.getElementById("divRelleno").innerHTML = "";
                        document.getElementById("divRelleno").innerHTML = '<table id="tableChasis" class="table table-hover table-sm"></table><input type="hidden" id="hiddenListaDeta" value="">';
                        $('#tableChasis').DataTable({
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
                            data: listaOkValidacion,
                            columns: [{
                                    title: "#"
                                }, {
                                    title: "Chasis"
                                }, {
                                    title: "Tipo de vehículo"
                                }, {
                                    title: "Linea de vehículo"
                                }, {
                                    title: "Estado validación"
                                }]
                        });
                    }
                },
                error: function (respuesta) {
                    console.log(respuesta);
                }
            });
        }
    } else if (validarIter != validarIterInt) {
        var mensaje = 'Debe ingresar Chasis, tipo vehiculo y linea del vehiculo, por cada vehiculo revise si el detalle proporcionado es correcto, tambien revise si el simbolo " | " no se encuentra al final del ultimo detalle...';
        var tipo = "error";
        alertaToast(mensaje, tipo);
    } else if (intValueInt != intValue) {
        var mensaje = "Existe un error en la carga de los detalles de chasis... revise si coloco todos los parametros solicitados";
        var tipo = "error";
        alertaToast(mensaje, tipo);
        //$(this).attr("estado", 1);
    } else if (estado == 1) {
    }
});
$(document).on("click", ".btnConsolidadoPoliza", function () {
    var iteraciones = 3;
    var detallePolizaConsolida = document.getElementById("detallePolizaConsolida").value;
    var detallePolizaConsolida = detallePolizaConsolida.trim();
    var sin_salto = detallePolizaConsolida.split("\n").join("");
    var cadenaArray = sin_salto.split("|");
    var validacion = cadenaArray.length;
    var validarIter = (validacion / iteraciones);
    var validarIterInt = parseInt(validarIter);
    if (iteraciones == validarIterInt) {
    } else if (iteraciones != validarIterInt) {
        alert("error");
    }
});
/**
 function funcionRev(e) {
 if (e.id == "nombrePiloto") {} else if (e.id != "nombrePiloto") {
 var valorIdinty = $("#" + e.id);
 var valorId = $("#" + e.id).val();
 var hiddenValorId = "hidden" + e.id;
 if (valorId == 0 || valorId == "-" || valorId == "NA" || valorId == "na" || valorId == "" || valorId == " ") {
 var valueHidden = document.getElementById(hiddenValorId).value;
 console.log(valueHidden);
 if (valueHidden == 0) {}
 if (valueHidden >= 1) {
 document.getElementById(hiddenValorId).value = "";
 }
 var mensaje = "No puede ingresar en los campos valores vacios o con 0, ingrese el dato correcto";
 var tipo = "error";
 alertaToast(mensaje, tipo);
 } else if (valorId != 0 || valorId != "-" || valorId != "NA" || valorId != "na" || valorId != "" || valorId != " ") {
 if (valorId.length <= 5) {
 document.getElementById(hiddenValorId).value = "";
 document.getElementById(hiddenValorId).value = 1;
 var mensaje = "El campo es parace un dato erroneo revise";
 var tipo = "warning";
 alertaToast(mensaje, tipo);
 } else if (valorId.length >= 6) {
 document.getElementById(hiddenValorId).value = "";
 document.getElementById(hiddenValorId).value = 1;
 var mensaje = "Campo valido";
 var tipo = "success";
 alertaToast(mensaje, tipo);
 valorIdinty.removeClass("is-invalid");
 valorIdinty.addClass("is-valid");
 }
 }
 }
 }
 
 function funcionRevNumber(e) {
 console.log(e.id);
 if (e.id == "numeroLicencia") {} else if (e.id != "numeroLicencia") {
 var valorIdinty = $("#" + e.id);
 var valorId = $("#" + e.id).val();
 console.log(valorId);
 var hiddenValorId = "hidden" + e.id;
 if (valorId <= 0 || isNaN(valorId)) {
 var valueHidden = document.getElementById(hiddenValorId).value;
 console.log(valueHidden);
 if (valueHidden == 0) {} else if (valueHidden == 1) {
 document.getElementById(hiddenValorId).value = "";
 }
 valorIdinty.addClass("is-invalid");
 valorIdinty.removeClass("is-valid");
 var mensaje = "No puede ingresar en los campos valores vacios, textos, o el valor 0, ingrese el dato correcto";
 var tipo = "error";
 alertaToast(mensaje, tipo);
 } else if (valorId != 0 || !isNaN(valorId)) {
 document.getElementById(hiddenValorId).value = "";
 document.getElementById(hiddenValorId).value = 1;
 var mensaje = "Campo valido";
 var tipo = "success";
 alertaToast(mensaje, tipo);
 valorIdinty.removeClass("is-invalid");
 valorIdinty.addClass("is-valid");
 }
 }
 }*/
$(document).on("change", "#ClientPoltxtNitSalida", function () {
    var ClientPoltxtNitSalida = $(this).val();
    var datos = new FormData();
    datos.append("txtNitSalida", ClientPoltxtNitSalida);
    $.ajax({
        url: "ajax/retiroOpe.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            if (respuesta != "SD") {
                document.getElementById("hiddenClientPoltxtNombreSalida").value = 1;
                document.getElementById("hiddenClientPoltxtDireccionSalida").value = 1;
                document.getElementById("hiddenClientPoltxtNitSalida").value = 1;
                document.getElementById("ClientPoltxtNombreSalida").value = respuesta[0].nombre;
                document.getElementById("ClientPoltxtDireccionSalida").value = respuesta[0].direccion;
                document.getElementById("hiddenNitIdenty").value = respuesta[0].nt;
                $("#ClientPoltxtNitSalida").removeClass("is-invalid");
                $("#ClientPoltxtNitSalida").addClass("is-valid");
                $("#ClientPoltxtNombreSalida").removeClass("is-invalid");
                $("#ClientPoltxtNombreSalida").addClass("is-valid");
                $("#ClientPoltxtDireccionSalida").removeClass("is-invalid");
                $("#ClientPoltxtDireccionSalida").addClass("is-valid");
                document.getElementById("ClPolDua").focus();
            } else if (respuesta == "SD") {
                $("#ClientPoltxtNitSalida").addClass("is-invalid");
                $("#ClientPoltxtNitSalida").removeClass("is-valid");
                $("#ClientPoltxtNombreSalida").addClass("is-invalid");
                $("#ClientPoltxtNombreSalida").removeClass("is-valid");
                $("#ClientPoltxtDireccionSalida").addClass("is-invalid");
                $("#ClientPoltxtDireccionSalida").removeClass("is-valid");
                document.getElementById("ClientPoltxtNombreSalida").value = "";
                document.getElementById("ClientPoltxtDireccionSalida").value = "";
                document.getElementById("ClientPoltxtNitSalida").value = "";
                document.getElementById("hiddenClientPoltxtNombreSalida").value = "";
                document.getElementById("hiddenClientPoltxtDireccionSalida").value = "";
                document.getElementById("hiddenClientPoltxtNitSalida").value = "";
                document.getElementById("ClientPoltxtNitSalida").focus();

//agregar nuevo nit

            }
        },
        error: function (respuesta) {
            console.log(respuesta);
        }
    });
});
$(document).on("click", ".bntGuardarPolCons", async function () {
    var numeroDePoliza = document.getElementById("poliza").value;
    /*Buscar nit*/

    /*CONTINUA */
    var datoBuscado = $("#ClientPoltxtNitSalida").val();
    document.getElementById("txtNitEmpresa").value = datoBuscado;
    var buscandoNit = await funcionBuscarNit(datoBuscado);

    if (buscandoNit) {
        var hiddenNitIdenty = document.getElementById("hiddenNitIdenty").value;
        var ClientPoltxtNitSalida = document.getElementById("ClientPoltxtNitSalida").value;
        var ClientPoltxtNombreSalida = document.getElementById("ClientPoltxtNombreSalida").value;
        var ClientPoltxtDireccionSalida = document.getElementById("ClientPoltxtDireccionSalida").value;
        var ClPolDua = document.getElementById("ClPolDua").value;
        var ClPolBL = document.getElementById("ClPolBL").value;
        var ClPolPoliza = document.getElementById("ClPolPoliza").value;
        var ClPolBultos = document.getElementById("ClPolBultos").value;
        var ClPolPeso = document.getElementById("ClPolPeso").value;
        var ClPolTAduana = document.getElementById("ClPolTAduana").value;
        var ClPolCambio = document.getElementById("ClPolCambio").value;
        var ClPolCif = document.getElementById("ClPolCif").value;
        var ClPolImpuesto = document.getElementById("ClPolImpuesto").value;
        var datoBuscado = document.getElementById("ClientPoltxtNitSalida").value;


        document.getElementById("dua").value = ClPolDua;
        document.getElementById("bl").value = ClPolBL;
        document.getElementById("poliza").value = ClPolPoliza;
        document.getElementById("bultosIngreso").value = ClPolBultos;
        document.getElementById("pesoIng").value = ClPolPeso;
        document.getElementById("valorTotalAduana").value = ClPolTAduana;
        document.getElementById("tipoDeCambio").value = ClPolCambio;
        document.getElementById("totalValorCif").value = ClPolCif;
        document.getElementById("valorImpuesto").value = ClPolImpuesto;


        const val = await validacionParaGuardar();
        if (val) {
            var tipo = 1;
            var guardar = await guardarSinTarifa(tipo);
            console.log(guardar);
            if (guardar) {
                var idIdenty = document.getElementById("hiddenIdentity").value;

                var acciones = '<div class="btn-group"><button type="button" class="btn btn-success btn-sm btnAcuseConsoli" id="btnConsol" idIng=' + idIdenty + '>Acuse</button><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#gdrManifiestos" id="gDetalles" idIng=' + idIdenty + '>Cargar Empresas</button></div>';
                var tableConPol = $('#tableConsolidadoPoliza').DataTable();
                //Create some data and insert it
                var rowData = [];
                //Tomando el numero de fila para agregar orden
                var info = tableConPol.page.info();
                //Contador y agregar fila
                rowData.push(info.recordsTotal + 1);
                rowData.push(ClPolPoliza);
                rowData.push(ClientPoltxtNitSalida);
                rowData.push(ClientPoltxtNombreSalida);
                rowData.push(ClPolBultos);
                rowData.push(ClPolPeso);
                rowData.push(acciones);
                tableConPol.row.add(rowData).draw(false);
                document.getElementById("dua").readOnly = true;
                document.getElementById("bl").readOnly = true;
                document.getElementById("poliza").readOnly = true;
                document.getElementById("bultosIngreso").readOnly = true;
                document.getElementById("pesoIng").readOnly = true;
                document.getElementById("valorTotalAduana").readOnly = true;
                document.getElementById("tipoDeCambio").readOnly = true;
                document.getElementById("totalValorCif").readOnly = true;
                document.getElementById("valorImpuesto").readOnly = true;
                $("#ClientPoltxtNitSalida").removeClass("is-valid");
                $("#ClientPoltxtNombreSalida").removeClass("is-valid");
                $("#ClientPoltxtDireccionSalida").removeClass("is-valid");
                $("#ClPolDua").removeClass("is-valid");
                $("#ClPolBL").removeClass("is-valid");
                $("#ClPolPoliza").removeClass("is-valid");
                $("#ClPolBultos").removeClass("is-valid");
                $("#ClPolPeso").removeClass("is-valid");
                $("#ClPolTAduana").removeClass("is-valid");
                $("#ClPolCambio").removeClass("is-valid");
                $("#ClPolCif").removeClass("is-valid");
                $("#ClPolImpuesto").removeClass("is-valid");
                $("#txtNitEmpresa").removeClass("is-valid");
                $("#ClPolProducto").removeClass("is-valid");
                $("#ClientPoltxtNitSalida").addClass("is-invalid");
                $("#ClientPoltxtNombreSalida").addClass("is-invalid");
                $("#ClientPoltxtDireccionSalida").addClass("is-invalid");
                $("#ClPolDua").addClass("is-invalid");
                $("#ClPolBL").addClass("is-invalid");
                $("#ClPolPoliza").addClass("is-invalid");
                $("#ClPolBultos").addClass("is-invalid");
                $("#ClPolPeso").addClass("is-invalid");
                $("#ClPolTAduana").addClass("is-invalid");
                $("#ClPolCambio").addClass("is-invalid");
                $("#ClPolCif").addClass("is-invalid");
                $("#ClPolImpuesto").addClass("is-invalid");
                $("#txtNitEmpresa").addClass("is-invalid");
                $("#ClPolProducto").addClass("is-invalid");
                document.getElementById("hiddenNitIdenty").value = "";
                document.getElementById("ClientPoltxtNitSalida").value = "";
                document.getElementById("ClientPoltxtNombreSalida").value = "";
                document.getElementById("ClientPoltxtDireccionSalida").value = "";
                document.getElementById("ClPolDua").value = "";
                document.getElementById("ClPolBL").value = "";
                document.getElementById("ClPolPoliza").value = "";
                document.getElementById("ClPolBultos").value = "";
                document.getElementById("ClPolPeso").value = "";
                document.getElementById("ClPolTAduana").value = "";
                document.getElementById("ClPolCambio").value = "";
                document.getElementById("ClPolCif").value = "";
                document.getElementById("ClPolImpuesto").value = "";
                document.getElementById("txtNitEmpresa").value = "";
                document.getElementById("ClPolProducto").value = "";
            } else {
                console.log("errorGuardado");
            }
        } else {
            console.log("no se puede guardar ");
        }

    }
});
$(document).on("click", ".btnAgregarPoliza", function () {
    document.getElementById("cartaDeCupo").readOnly = false;
    document.getElementById("txtNitEmpresa").readOnly = false;
});

function valConsolPolizas() {
    var hiddenClientPoltxtNitSalida = document.getElementById("hiddenClientPoltxtNitSalida").value;
    var hiddenClientPoltxtNombreSalida = document.getElementById("hiddenClientPoltxtNombreSalida").value;
    var hiddenClientPoltxtDireccionSalida = document.getElementById("hiddenClientPoltxtDireccionSalida").value;
    var hiddenClPolDua = document.getElementById("hiddenClPolDua").value;
    var hiddenClPolBL = document.getElementById("hiddenClPolBL").value;
    var hiddenClPolPoliza = document.getElementById("hiddenClPolPoliza").value;
    var hiddenClPolBultos = document.getElementById("hiddenClPolBultos").value;
    var hiddenClPolProducto = document.getElementById("hiddenClPolProducto").value;
    var hiddenClPolPeso = document.getElementById("hiddenClPolPeso").value;
    var hiddenClPolTAduana = document.getElementById("hiddenClPolTAduana").value;
    var hiddenClPolCambio = document.getElementById("hiddenClPolCambio").value;
    var hiddenClPolCif = document.getElementById("hiddenClPolCif").value;
    var hiddenClPolImpuesto = document.getElementById("hiddenClPolImpuesto").value;
    var hiddenClientPoltxtNitSalida = (hiddenClientPoltxtNitSalida * 1);
    var hiddenClientPoltxtNombreSalida = (hiddenClientPoltxtNombreSalida * 1);
    var hiddenClientPoltxtDireccionSalida = (hiddenClientPoltxtDireccionSalida * 1);
    var hiddenClPolDua = (hiddenClPolDua * 1);
    var hiddenClPolBL = (hiddenClPolBL * 1);
    var hiddenClPolPoliza = (hiddenClPolPoliza * 1);
    var hiddenClPolBultos = (hiddenClPolBultos * 1);
    var hiddenClPolProducto = (hiddenClPolProducto * 1);
    var hiddenClPolPeso = (hiddenClPolPeso * 1);
    var hiddenClPolTAduana = (hiddenClPolTAduana * 1);
    var hiddenClPolCambio = (hiddenClPolCambio * 1);
    var hiddenClPolCif = (hiddenClPolCif * 1);
    var hiddenClPolImpuesto = (hiddenClPolImpuesto * 1);
    var totalHidden = (hiddenClientPoltxtNitSalida + hiddenClientPoltxtNombreSalida + hiddenClientPoltxtDireccionSalida + hiddenClPolDua + hiddenClPolBL + hiddenClPolPoliza + hiddenClPolBultos + hiddenClPolProducto + hiddenClPolPeso + hiddenClPolTAduana + hiddenClPolCambio + hiddenClPolCif + hiddenClPolImpuesto)
    if (totalHidden <= 12) {
        return true;
    } else if (totalHidden == 13) {
        return false;
    }
}

function valConsolidados(valTipoConso, cantClientes) {
    let respValCons;
    if (valTipoConso == "Cliente consolidado") {
        if (cantClientes == 1 || cantClientes == 0) {
            respValCons = false;
        } else if (cantClientes >= 2) {
            respValCons = true;
        }
    } else if (valTipoConso == "Cliente individual") {

        $("#sel2").removeClass("is-valid");
        $("#sel2").addClass("is-invalid");

        var e = document.getElementById("servicioTarifa");
        var indexValue = e.options[e.selectedIndex].value;
        var indexText = e.options[e.selectedIndex].text;

        if (cantClientes == 0) {
            respValCons = false;
        } else if (cantClientes == 1 || indexText == "VEHICULOS NUEVOS") {
            respValCons = true;
        }
    }
    if (valTipoConso == "Cliente consolidado poliza") {
        if (cantClientes == 1 || cantClientes == 0) {
            respValCons = false;
        } else if (cantClientes >= 2) {
            respValCons = true;
        }
    }
    return respValCons;
}
async function guardarSinTarifa(tipo) {
    let respGST;

    if ($("#btnConsolidado").length > 0) {
        var btnConsolidado = $("#btnConsolidado").attr("estado");
    } else {
        var btnConsolidado = 1;
    }
    console.log(btnConsolidado);
    let llaveIndet;
    var valTipoConso = $("#sel2 option:selected").text();
    var cantClientes = document.getElementById("cantClientes").value;
    var validacionCons = await valConsolidados(valTipoConso, cantClientes);
    console.log(validacionCons);

    if (!validacionCons) {
        swal({
            type: "error",
            title: "Especificación de clientes",
            text: "Los clientes que ud. esta detallando no son correctos segun el tipo de consolidado, por favor corriga la cantidad de clientes para continuar...",
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar'
        });
    } else if (validacionCons) {
        if (document.getElementById("lblIdMostrar")) {
            var consolidado = 0;
            var idUsuarioCliente = document.getElementById("lblIdMostrar").value;
            if (idUsuarioCliente == 0) {
                var consolidado = 1;
                var idUsuarioCliente = 0;
            }
        } else {
            var consolidado = 1;
            var idUsuarioCliente = 0;
        }

        var etiquetaNumBod = document.getElementById("numBodIdent").value;
        var idUs = document.getElementById("hiddenIdUs").value;
        var busquedaConsolidado = document.getElementById("hiddenConsolidado").value;
        var ClientPoltxtNitSalida = $("#ClientPoltxtNitSalida").val();
        var hiddenIdUsser = document.getElementById("hiddenIdUs").value;
        var lblEmpresa = document.getElementById("lblEmpresa").innerHTML;
        var sel2 = document.getElementById("sel2").value;
        var idRegPol = document.getElementById("regimenPoliza").value;
        var cartaDeCupo = document.getElementById("cartaDeCupo").value;
        var poliza = document.getElementById("poliza").value;
        var cantContenedores = document.getElementById("cantContenedores").value;
        var dua = document.getElementById("dua").value;
        var bl = document.getElementById("bl").value;
        var puertoOrigen = document.getElementById("puertoOrigen").value;
        var producto = document.getElementById("producto").value;
        var cantClientes = document.getElementById("cantClientes").value;
        var peso = document.getElementById("pesoIng").value;
        var bultos = document.getElementById("bultosIngreso").value;
        var valorTotalAduana = document.getElementById("valorTotalAduana").value;
        var tipoDeCambio = document.getElementById("tipoDeCambio").value;
        var totalValorCif = document.getElementById("totalValorCif").value;
        var valorImpuesto = document.getElementById("valorImpuesto").value;
        /**ESTUDIAR LA BASE DE DATOS VER LA REDUNDANCIA DE DATA  */
        var idNitCliente = document.getElementById("lblClienteId").value;
        var dependencia = document.getElementById("dependencia").value;
        var hiddenIdBod = document.getElementById("hiddenIdBod").value;
        var hiddenDateTime = document.getElementById("hiddenDateTime").value;
        var servicioTarifa = document.getElementById("servicioTarifa").value;
        /*DATOS DE UNIDAD DE TRANSPORTE*/
        var numeroLicencia = document.getElementById("numeroLicencia").value;
        var nombrePiloto = document.getElementById("nombrePiloto").value;
        var numeroPlaca = document.getElementById("numeroPlaca").value;
        var numeroContenedor = document.getElementById("numeroContenedor").value;
        var numeroMarchamo = document.getElementById("numeroMarchamo").value;

        if (ClientPoltxtNitSalida != "") {
            var lblEmpresa = document.getElementById("ClientPoltxtNombreSalida").value;
            var idNitCliente = document.getElementById("hiddenNitIdenty").value;
        }

        var e = document.getElementById("servicioTarifa");
        var indexValue = e.options[e.selectedIndex].value;
        var indexText = e.options[e.selectedIndex].text;

        /*FIN DATOS UNIDAD DE TRANSPORTE*/
        var datos = new FormData();
        datos.append("cartaDeCupo", cartaDeCupo);
        datos.append("poliza", poliza);
        datos.append("cantContenedores", cantContenedores);
        datos.append("dua", dua);
        datos.append("bl", bl);
        datos.append("puertoOrigen", puertoOrigen);
        datos.append("producto", producto);
        datos.append("cantClientes", cantClientes);
        datos.append("peso", peso);
        datos.append("bultos", bultos);
        datos.append("valorTotalAduana", valorTotalAduana);
        datos.append("tipoDeCambio", tipoDeCambio);
        datos.append("totalValorCif", totalValorCif);
        datos.append("valorImpuesto", valorImpuesto);
        datos.append("idUsuarioCliente", idUsuarioCliente);
        datos.append("idNitCliente", idNitCliente);
        datos.append("dependencia", dependencia);
        datos.append("consolidado", consolidado);
        datos.append("hiddenIdBod", hiddenIdBod);
        datos.append("numeroLicencia", numeroLicencia);
        datos.append("nombrePiloto", nombrePiloto);
        datos.append("numeroPlaca", numeroPlaca);
        datos.append("numeroContenedor", numeroContenedor);
        datos.append("numeroMarchamo", numeroMarchamo);
        datos.append("hiddenDateTime", hiddenDateTime);
        datos.append("servicioTarifa", servicioTarifa);
        datos.append("idRegPol", idRegPol);
        datos.append("sel2", sel2);
        datos.append("lblEmpresa", lblEmpresa);
        datos.append("hiddenIdUsser", hiddenIdUsser);
        datos.append("busquedaConsolidadoGrd", busquedaConsolidado);
        datos.append("idUs", idUs);
        datos.append("etiquetaNumBod", etiquetaNumBod);


        $.ajax({
            async: false,
            url: "ajax/operacionesBIngreso.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (respuesta) {
                console.log(respuesta);
                llaveIndet = respuesta.Identity;

                if (llaveIndet >= 1) {

                    document.getElementById("hiddenIdentity").value = llaveIndet;
                    respGST = true;


                } else {
                    respGST = false;
                }
            },
            error: function (respuesta) {
                console.log(respuesta);
            }
        });
    }
    return respGST;
}

function funcionBuscarNit(datoBuscado) {
    let respuestaData;
    document.getElementById("lblNit").innerHTML = "";
    document.getElementById("lblClienteId").value = "";
    document.getElementById("lblEmpresa").innerHTML = "";
    document.getElementById("lblDireccion").innerHTML = "";
    var consultaEmpresa = datoBuscado;
    var datos = new FormData();
    datos.append("consultaEmpresa", consultaEmpresa);
    $.ajax({
        async: false,
        url: "ajax/operacionesBIngreso.ajax.php",
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
                        $("#txtNitEmpresa").removeClass("is-valid");
                        $("#txtNitEmpresa").addClass("is-invalid");
                        document.getElementById("txtNitEmpresa").value = "";
                        Swal.fire(
                                'Agregar Nit',
                                'Vaya ala barra superior azul, y haga click en agregar nuevos datos',
                                'info'
                                )
                    }
                })


                respuestaData = false;


            } else {
                respuestaData = true;
                console.log("procesando...");
                document.getElementById("lblNit").innerHTML = respuesta[0]['nitEmpresa'];
                document.getElementById("lblClienteId").value = respuesta[0]["idNitEmp"];
                document.getElementById("lblEmpresa").innerHTML = respuesta[0]['nombreEmpresa'];
                document.getElementById("lblDireccion").innerHTML = respuesta[0]['direccionEmpresa'];
                $(function () {
                    $('#datepicker').datepicker({
                        onSelect: function () { // When cal is opened execute
                            var currentDate = new Date($("#datepicker").datepicker("getDate"));
                            var strDateTime = currentDate.getDate() + "/" + (currentDate.getMont() + 1) + "/" + currentDate.getFullYear();
                            startDatabaseQueries(strDateTime);
                        }
                    });
                });


                if (respuesta[0].idUs == 0) {
                    //     if (document.getElementById("editarData")) {
                    if ($(".btnAcuseConsoli").length == 0) {
                        serviciosSeleccion(consultaEmpresa);
                    }
                    document.getElementById("divContacto").innerHTML = "";
                    document.getElementById("divEjecutivo").innerHTML = "";
                    document.getElementById("divContacto").innerHTML = `<div class="alert alert-primary" role="alert"><storng>Cliente sin tarifa autorizada</strong><br/><br/></div>`;
                    document.getElementById("hiddenTipoTar").value = 1;
                    //   }
                } else if (respuesta[0].idUs >= 1) {
                    document.getElementById("divContacto").innerHTML = `

                       <b>
                    Datos de contacto
                </b>
                <br/>
                    <br/>
                        <b>
                            Contacto:
                        </b>
                        <label id="lblNombreContacto" style="font-weight: normal;">` + respuesta[0]["nombreContacto"] + `

                        </label>
                        <br/>
                            <b>
                                Telefono:
                            </b>
                            <label id="lblTelefonoC" style="font-weight: normal;">` + respuesta[0]["telefonoContacto"] + `

                            </label>
                            <br/>
                                <b>
                                    Correo:
                                </b>
                                <label id="lblCorreoC" style="font-weight: normal;">` + respuesta[0]["CorreoContacto"] + `

                                </label>
                                <br/>
                                    <b>
                                        # Tarifa:
                                    </b>
                                    <label id="lblNumerotarifa" style="font-weight: normal;">` + respuesta[0]["numeroTarifa"] + `

                                    </label>
                                    <input id="lblIdMostrar" name="idMostrar" type="hidden" value="2">` + respuesta[0]["numCliente"] + `
                                        <br/>
                                            <div id="divVerTarifa">
                                                <button class="btn btn-info btnView" data-target="#MostrarTodoServicio" data-toggle="modal" idmostrar="737852" numerotarifa="2" type="button">
                                                    <i aria-hidden="true" class="fa fa-eye">
                                                    </i>
                                                </button>
                                            </div>
                                            <br/>
                                        <br/>
                                    </input>
                                <br/>
                            <br/>
                        <br/>
                    <br/>
                <br/>`;
                    document.getElementById("divEjecutivo").innerHTML = `


                        <b>
                    Datos Ejecutivo
                </b>
                <br/>
                    <input id="lblEjecutivo" name="lblEjecutivo" type="hidden" value="` + respuesta[0]["numEjecutivo"] + `">
                        <br/>
                            <b>
                                Ejecutivo:
                            </b>
                            <label id="lblNombreEjecutivo" style="font-weight: normal;"> ` + respuesta[0]["usuarioNom"] + "  " + respuesta[0]["usuarioAp"] + `

                            </label>
                            <br/>
                                <b>
                                    Telefono:
                                </b>
                                <label id="lblTelefonoE" style="font-weight: normal;">` + respuesta[0]["telefonoEjecutivo"] + `

                                </label>
                                <br/>
                                    <b>
                                        Correo:
                                    </b>
                                    <label id="lblCorreoE" style="font-weight: normal;">` + respuesta[0]["correoEjecutivo"] + `

                                    </label>
                                    <br/>
                                        <b>
                                            Departamento:
                                        </b>
                                        <label id="lblDeptoE" style="font-weight: normal;">` + respuesta[0]["depto"] + `

                                        </label>
                                        <br/>
                                    <br/>
                                <br/>
                            <br/>
                        <br/>
                      <br/>
`;

                    var tarifaId = document.getElementById("lblNumerotarifa").innerHTML;
                    var idCliente = document.getElementById("lblIdMostrar").value;
                    document.getElementById("divVerTarifa").innerHTML = '<button type="button" class="btn btn-outline-danger btn-sm btnPDFGTarifa" idclt="' + respuesta[0]["idUs"] + '"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>';

                    if ($(".btnAcuseConsoli").length == 0) {
                        serviciosSeleccion(consultaEmpresa);
                    }


                }
                respuestaData = true;
            }

        },
        error: function (respuesta) {
            console.log(respuesta);
        }
    });
    console.log("finalizando Proceso...");
    return respuestaData;
}


function guardarSinTarifaS(tipo) {
    return new Promise((resolve, reject) => {
        var valTipoConso = $("#sel2 option:selected").text();
        var cantClientes = document.getElementById("cantClientes").value;
        if (valTipoConso == "Cliente consolidado") {
            if (cantClientes == 1 || cantClientes == 0) {
                var cantClientes = 0;
            } else if (cantClientes >= 2) {
                var cantClientes = 1;
            }
        } else if (valTipoConso == "Cliente individual") {
            if (cantClientes == 0) {
                var cantClientes = 0;
            } else if (cantClientes == 1) {
                var cantClientes = 1;
            }
        }
        if (valTipoConso == "Cliente consolidado poliza") {
            if (cantClientes == 1 || cantClientes == 0) {
                var cantClientes = 0;
            } else if (cantClientes >= 2) {
                var cantClientes = 1;
            }
        }
        if (cantClientes == 0) {
            swal({
                type: "error",
                title: "Especificación de clientes",
                text: "Los clientes que ud. esta detallando no son correctos segun el tipo de consolidado, por favor corriga la cantidad de clientes para continuar...",
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar'
            });
        } else if (cantClientes == 1) {
            var lblEmpresa = document.getElementById("lblEmpresa").innerHTML;
            var sel2 = document.getElementById("sel2").value;
            var idRegPol = document.getElementById("regimenPoliza").value;
            var consolidado = 1;
            var cartaDeCupo = document.getElementById("cartaDeCupo").value;
            var poliza = document.getElementById("poliza").value;
            var cantContenedores = document.getElementById("cantContenedores").value;
            var dua = document.getElementById("dua").value;
            var bl = document.getElementById("bl").value;
            var puertoOrigen = document.getElementById("puertoOrigen").value;
            var producto = document.getElementById("producto").value;
            var cantClientes = document.getElementById("cantClientes").value;
            var peso = document.getElementById("pesoIng").value;
            var bultos = document.getElementById("bultosIngreso").value;
            var valorTotalAduana = document.getElementById("valorTotalAduana").value;
            var tipoDeCambio = document.getElementById("tipoDeCambio").value;
            var totalValorCif = document.getElementById("totalValorCif").value;
            var valorImpuesto = document.getElementById("valorImpuesto").value;
            /**ESTUDIAR LA BASE DE DATOS VER LA REDUNDANCIA DE DATA  */
            var idUsuarioCliente = 0;
            var idNitCliente = document.getElementById("lblClienteId").value;
            var dependencia = document.getElementById("dependencia").value;
            var hiddenIdBod = document.getElementById("hiddenIdBod").value;
            var hiddenDateTime = document.getElementById("hiddenDateTime").value;
            var servicioTarifa = document.getElementById("servicioTarifa").value;
            /*DATOS DE UNIDAD DE TRANSPORTE*/
            var numeroLicencia = document.getElementById("numeroLicencia").value;
            var nombrePiloto = document.getElementById("nombrePiloto").value;
            var numeroPlaca = document.getElementById("numeroPlaca").value;
            var numeroContenedor = document.getElementById("numeroContenedor").value;
            var numeroMarchamo = document.getElementById("numeroMarchamo").value;
            var hiddenIdUsser = document.getElementById("hiddenIdUs").value;
            /*FIN DATOS UNIDAD DE TRANSPORTE*/
            var datos = new FormData();
            datos.append("cartaDeCupo", cartaDeCupo);
            datos.append("poliza", poliza);
            datos.append("cantContenedores", cantContenedores);
            datos.append("dua", dua);
            datos.append("bl", bl);
            datos.append("puertoOrigen", puertoOrigen);
            datos.append("producto", producto);
            datos.append("cantClientes", cantClientes);
            datos.append("peso", peso);
            datos.append("bultos", bultos);
            datos.append("valorTotalAduana", valorTotalAduana);
            datos.append("tipoDeCambio", tipoDeCambio);
            datos.append("totalValorCif", totalValorCif);
            datos.append("valorImpuesto", valorImpuesto);
            datos.append("idUsuarioCliente", idUsuarioCliente);
            datos.append("idNitCliente", idNitCliente);
            datos.append("dependencia", dependencia);
            datos.append("consolidado", consolidado);
            datos.append("hiddenIdBod", hiddenIdBod);
            datos.append("numeroLicencia", numeroLicencia);
            datos.append("nombrePiloto", nombrePiloto);
            datos.append("numeroPlaca", numeroPlaca);
            datos.append("numeroContenedor", numeroContenedor);
            datos.append("numeroMarchamo", numeroMarchamo);
            datos.append("hiddenDateTime", hiddenDateTime);
            datos.append("servicioTarifa", servicioTarifa);
            datos.append("idRegPol", idRegPol);
            datos.append("sel2", sel2);
            datos.append("lblEmpresa", lblEmpresa);
            datos.append("hiddenIdUsser", hiddenIdUsser);
            $.ajax({
                url: "ajax/operacionesBIngreso.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (respuesta) {
                    console.log(respuesta);
                    document.getElementById("hiddenIdentity").value = respuesta[0]["Identity"];
                    var btnConsulTarifa = $("#btnConsulTarifa").attr("estado");
                    var estadoConsolidado = $(this).attr("estado");
                    if (btnConsulTarifa == 1) {
                        var idIngresoST = respuesta[0]["Identity"];
                        var hiddenIdBodST = hiddenIdBod;
                        var hiddenIdUsST = document.getElementById("hiddenIdUs").value;
                        var idNitClienteST = idNitCliente;
                        var datos = new FormData();
                        datos.append("idIngresoST", idIngresoST);
                        datos.append("hiddenIdBodST", hiddenIdBodST);
                        datos.append("hiddenIdUsST", hiddenIdUsST);
                        datos.append("idNitClienteST", idNitClienteST);
                        $.ajax({
                            url: "ajax/operacionesBIngreso.ajax.php",
                            method: "POST",
                            data: datos,
                            cache: false,
                            contentType: false,
                            processData: false,
                            dataType: "json",
                            success: function (respuesta) {
                                console.log(respuesta);
                            },
                            error: function (respuesta) {
                                console.log(respuesta);
                            }
                        })
                    }
                },
                error: function (respuesta) {
                    console.log(respuesta);
                }
            });
            swal({
                title: "Creado Correctamente",
                text: "El ingreso fue creado exitosamente...",
                type: "success"
            }).then(okay => {
                if (okay) {
                    document.getElementById("cartaDeCupo").readOnly = true;
                    document.getElementById("cantContenedores").readOnly = true;
                    document.getElementById("dua").readOnly = true;
                    document.getElementById("bl").readOnly = true;
                    document.getElementById("poliza").readOnly = true;
                    document.getElementById("bultosIngreso").readOnly = true;
                    document.getElementById("puertoOrigen").disabled = true;
                    document.getElementById("cantClientes").readOnly = true;
                    document.getElementById("producto").readOnly = true;
                    document.getElementById("pesoIng").readOnly = true;
                    document.getElementById("valorTotalAduana").readOnly = true;
                    document.getElementById("tipoDeCambio").readOnly = true;
                    document.getElementById("totalValorCif").readOnly = true;
                    document.getElementById("valorImpuesto").readOnly = true;
                    document.getElementById("dateTime").readOnly = true;
                    document.getElementById("sel2").disabled = true;
                    document.getElementById("servicioTarifa").disabled = true;
                    document.getElementById("regimenPoliza").disabled = true;
                    document.getElementById("numeroLicencia").readOnly = true;
                    document.getElementById("numeroMarchamo").readOnly = true;
                    document.getElementById("nombrePiloto").readOnly = true;
                    document.getElementById("numeroPlaca").readOnly = true;
                    document.getElementById("numeroContenedor").readOnly = true;
                    document.getElementById("regimenPoliza").readOnly = true;
                    document.getElementById("txtNitEmpresa").readOnly = true;
                    var valTipoConso = $("#sel2 option:selected").text();
                    if (valTipoConso == "Cliente consolidado") {
                        document.getElementById("diveGuardaEmpresa").innerHTML = '';
                        document.getElementById("diveGuardaEmpresa").innerHTML = `<div class="col-12"><label>CONSOLIDADO SIMPLE</label><input type="hidden" id="valueClientes" name="valueClientes" value=""><input type="hidden" id="cantVsClientes" name="cantVsClientes" value="0"></div><div class="col-md-4 autocompletar">
  <label>Empresa</label>

<input type="text" class="form-control" name="tipoBusqueda" id="tipoBusqueda" placeholder="Busqueda" />
</div><div class="col-4"><div class="form-group"><label>Cantidad de bultos</label><input type="text" class="form-control" id="bultosAgregados" name="bultosAgregados" placeholder="Ingrese cantidad de bultos"></div></div><div class="col-4"><div class="form-group"><label>Valor Peso</label><input type="text" class="form-control" id="pesoAgregado" name="pesoAgregado" placeholder="Ingrese peso"></div></div> <div class="col-4"><div class="btn-group" role="group" aria-label="Basic example"><button type="button" class="btn btn-success btnAgregarEmpresa" btnAgrega=0>Agregar Empresa</button></div></div><div class="col-4"><div class="info-box"><span class="info-box-icon bg-primary"><i class="fa fa-calculator"></i></span><div class="info-box-content"><span class="info-box-text">Saldo Bultos</span><h1>9000</h1></div><!-- /.info-box-content --></div><!-- /.info-box --></div><div class="col-4"><div class="info-box"><span class="info-box-icon bg-primary"><i class="fa fa-calculator"></i></span><div class="info-box-content"><span class="info-box-text">Saldo Peso</span><h3>3</h3></div><!-- /.info-box-content --></div><!-- /.info-box --></div></div>`;
                        document.getElementById("divAcciones").innerHTML = '<div class="btn-group btn-group-lg" id="divMasButtons"><button type="button" class="btn btn-warning btnEditarIngreso" id="editarData" estado=0>Editar</button><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#gdrManifiestos" id="gDetalles" idIng=' + idIdenty + '>Cargar Empresas</button></div>';
                        if ($("#gDetalles").length>0) {
                        document.getElementById("gDetalles").click();
                            
                        }
                    } else if (valTipoConso == "Cliente consolidado poliza") {
                        if (tipo == 0) {
                            var lblNit = document.getElementById("lblNit").innerHTML;
                            var lblEmpresa = document.getElementById("lblEmpresa").innerHTML;
                            document.getElementById("divAcciones").innerHTML = '';
                            document.getElementById("hiddenContadorPolizas").value = 1;
                            if ($(".tableIngFail").length == 0) {
                                $("#divAccionesValidacion").removeClass("col-4");
                                $("#divAccionesValidacion").addClass("col-8");
                                $("#divRelleno").removeClass("col-4");
                                $("#divRelleno").addClass("col-0");
                            }
                            document.getElementById("divAccionesValidacion").innerHTML = `
              <table id="tableConsolidadoPoliza" class="table table-hover table-sm">
            </table>
              <input type="hidden" id="hiddenListaDeta" value="">`;
                            var acciones = '<div class="btn-group"><button type="button" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button><button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></div>';
                            var numero = 1;
                            var contadorH3 = document.getElementById("contadorH3").innerHTML;
                            var contadorH3 = contadorH3 + 1;
                            document.getElementById("contadorH3").innerHTML = "";
                            document.getElementById("contadorH3").innerHTML = contadorH3;
                            document.getElementById("contadorClientes").innerHTML = "";
                            document.getElementById("contadorClientes").innerHTML = cantVsClientes;
                            var listaDataPoliza = [];
                            listaDataPoliza.push([numero, poliza, lblNit, lblEmpresa, bultos, peso, acciones]);
                            $('#tableConsolidadoPoliza').DataTable({
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
                                data: listaDataPoliza,
                                columns: [{
                                        title: "#"
                                    }, {
                                        title: "Poliza"
                                    }, {
                                        title: "Nit"
                                    }, {
                                        title: "Empresa"
                                    }, {
                                        title: "Bultos"
                                    }, {
                                        title: "Peso kg"
                                    }, {
                                        title: "Acciones"
                                    }]
                            });
                        }
                    } else if (valTipoConso == "Cliente individual") {
                        $("#sel2").removeClass("is-invalid");
                        $("#sel2").addClass("is-valid");
                        document.getElementById("divAcciones").innerHTML = '';
                        document.getElementById("divAcciones").innerHTML = '<div class="btn-group btn-group-lg" id="divMasButtons"><button type="button" class="btn btn-warning btnEditarIngreso" id="editarData" estado=0>Editar</button><button type="button" class="btn btn-dark btnMasPilotos" id="masPilotos" estado=0  data-toggle="modal" data-target="#plusPilotos">Agregar mas pilotos</button><button type="button" class="btn btn-success btnImpresionAcuse" id="ImprimirAcuse" estado=0>Imprimir Acuse</button></div>';

                        Swal.fire({
                            type: 'info',
                            title: 'Transacción exitosa',
                            text: 'Se guardo de manera exitosa el ingreso, operación finalizada',
                            footer: '<a href="operacionesBIngreso">ElaborarNuevo Ingreso</a>'
                        })
                    }
                }
            });
            resolve(true);
        }
    })
}

function serviciosSeleccion(consultaEmpresa) {
    var datos = new FormData();
    datos.append("MostrarServicios", consultaEmpresa);
    $.ajax({
        url: "ajax/operacionesBIngreso.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            $("#servicioTarifa").append('<option selected="selected" disabled="disabled">Seleccione Servicio</option>');

            if (respuesta.length == 1) {
                if (respuesta[0]["servicio"] == "ZONA ADUANERA" || respuesta[0]["servicio"] == "CUARTO REFRIGERADO" || respuesta[0]["servicio"] == "CUARTO CONGELADO" || respuesta[0]["servicio"] == "VEHICULOS NUEVOS") {
                    $("#servicioTarifa").append('<option value=' + respuesta[0]['identy'] + ' disabled="disabled"  readOnly="reaondly">' + respuesta[0]["servicio"] + '</option>');
                }
            } else if (respuesta.length >= 2) {

                for (var i = 0; i < respuesta.length; i++) {
                    if (respuesta[i]["servicio"] == "ZONA ADUANERA" || respuesta[i]["servicio"] == "CUARTO REFRIGERADO" || respuesta[i]["servicio"] == "CUARTO CONGELADO" || respuesta[i]["servicio"] == "VEHICULOS NUEVOS") {
                        $("#servicioTarifa").append('<option value=' + respuesta[i]['identy'] + '>' + respuesta[i]["servicio"] + '</option>');
                    }
                }
            }
        },
        error: function (respuesta) {
            console.log(respuesta);
        }
    });
    return true;
}
$(document).on("change", "#regimenPoliza", function () {
    $(this).removeClass("is-invalid");
    $(this).addClass("is-valid");
    var tipoRegimen = $(this).val();
    var e = document.getElementById("regimenPoliza");
    var indexValue = e.options[e.selectedIndex].value;
    var indexText = e.options[e.selectedIndex].text;
    var datos = new FormData();
    datos.append("tipoRegimenConsult", tipoRegimen);
    $.ajax({
        url: "ajax/operacionesBIngreso.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            if (respuesta[0].familia == 2 && respuesta[0].regimen != ["DUT"] && respuesta[0].regimen != ["FAUCA"]) {
                document.getElementById("divCartaCupo").innerHTML = `

<div class="col-12">
<label>Número de Carta Cupo</label>
<div class="input-group">
                  <input class="form-control is-invalid" type="text" placeholder="Ejemplo : AI-12-2485-20..." id="cartaDeCupo" onkeyup="javascript:this.value = this.value.toUpperCase();" value="0" readOnly="true" />
                  <span class="input-group-append">
                    <button type="button" class="btn btn-info btn-flat" id="btnAplicaCartaC">Si tiene carta de cupo</button>
                  </span>
                </div>

</div>
`;
                document.getElementById("dua").value = "";
                document.getElementById("bl").value = "";
                $("#cartaDeCupo").removeClass("is-invalid");
                $("#cartaDeCupo").addClass("is-valid");
                $("#bl").removeClass("is-valid");
                $("#bl").addClass("is-invalid");
                $("#dua").removeClass("is-valid");
                $("#dua").addClass("is-invalid");
            } else if (respuesta[0].familia == 2 && respuesta[0].regimen != ["TO"]) {
                document.getElementById("divCartaCupo").innerHTML = `

<div class="col-12">
<label>Número de Carta Cupo</label>
<div class="input-group">
                  <input class="form-control is-invalid" type="text" placeholder="Ejemplo : AI-12-2485-20..." id="cartaDeCupo" onkeyup="javascript:this.value = this.value.toUpperCase();" value="0" readOnly="true" />
                  <span class="input-group-append">
                    <button type="button" class="btn btn-info btn-flat">No aplica</button>
                  </span>
                </div>
`;
                $("#dua").val(0);
                $("#bl").val(0);
                $("#cartaDeCupo").removeClass("is-invalid");
                $("#cartaDeCupo").addClass("is-valid");
                $("#bl").removeClass("is-invalid");
                $("#bl").addClass("is-valid");
                $("#dua").removeClass("is-invalid");
                $("#dua").addClass("is-valid");
            } else if (respuesta[0].familia == 1) {
                document.getElementById("dua").value = "";
                document.getElementById("bl").value = "";
                $("#cartaDeCupo").removeClass("is-valid");
                $("#cartaDeCupo").addClass("is-invalid");
                $("#bl").removeClass("is-valid");
                $("#bl").addClass("is-invalid");
                $("#dua").removeClass("is-valid");
                $("#dua").addClass("is-invalid");
                document.getElementById("divCartaCupo").innerHTML = `
                <div class="form-group">
                                                        <label>Número de Carta Cupo</label>
                                                        <input class="form-control is-invalid" type="text" placeholder="Ejemplo : AI-12-2485-20..." id="cartaDeCupo" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                                                    </div>`;
            }
        },
        error: function (respuesta) {
            console.log(respuesta);
        }
    });
})

$(document).on("change", "#sel2", async function () {
    var selectChang = $(this);
    var clientes = document.getElementById("cantClientes").value;
    var tipoReg = $(this).val();
    if (clientes == 0 || isNaN(clientes)) {
        document.getElementById("sel2").selectedIndex = "Seleccione tipo de cliente";
        $(this).removeClass("is-valid");
        $(this).addClass("is-invalid");
        swal({
            type: "error",
            title: "Cantidad de clientes",
            text: "La cantidad de clientes no puede ser mayor a 1 o igual a 0...",
            showConfirmButton: true,
            confirmButtonText: "cerrar",
            closeConfirm: true
        });

    }
    if (tipoReg == "Cliente individual") {

        if (clientes >= 2) {
            document.getElementById("sel2").selectedIndex = "Seleccione tipo de cliente";
            swal({
                type: "error",
                title: "Cantidad de clientes",
                text: "La cantidad de clientes no puede ser mayor a 1 o igual a 0...",
                showConfirmButton: true,
                confirmButtonText: "cerrar",
                closeConfirm: true
            });

        } else {
            $("#sel2").removeClass("is-invalid");
            $("#sel2").addClass("is-valid");
        }
    }
    /*
     if (tipoReg == "Cliente individual" && clientes == 1) {
     if (clientes == 1) {
     console.log(clientes);
     $(this).removeClass("is-invalid");
     $(this).addClass("is-valid");
     const {value: valFob} = await Swal.fire({
     title: 'Ingresa el valor impuesto',
     input: 'text',
     inputPlaceholder: 'Ingrese el valor fob'
     })
     
     if (valFob) {
     
     
     if (!isNaN(valFob) && valFob >0) {
     var guardarValFob = crearValFob(valFob);
     } else {
     Swal.fire(`Valor no admitido, se acepta solo numeros : ${valFob}`)
     document.getElementById("sel2").selectedIndex = "Seleccione tipo de cliente";
     $(this).removeClass("is-valid");
     $(this).addClass("is-invalid");
     }
     }
     }
     }*/

    if (tipoReg == "Cliente consolidado" || tipoReg == "Cliente consolidado poliza") {

        if (clientes == 1) {
            document.getElementById("sel2").selectedIndex = "Seleccione tipo de cliente";
            $(this).removeClass("is-valid");
            $(this).addClass("is-invalid");
            swal({
                type: "error",
                title: "Cantidad de clientes",
                text: "La cantidad de clientes no puede ser mayor a 1 o igual a 0...",
                showConfirmButton: true,
                confirmButtonText: "cerrar",
                closeConfirm: true
            });

        }
    }
    if (tipoReg == "Cliente consolidado" || tipoReg == "Cliente consolidado poliza") {
        if (clientes >= 2) {
            $(this).removeClass("is-invalid");
            $(this).addClass("is-valid");
            if (tipoReg == "Cliente consolidado poliza") {
                document.getElementById("buttonMostrarCons").click();
            }
        }
    }
})


function validarConsolidado(busquedaConsolidado) {
    let todoMenus;
    var datos = new FormData();
    datos.append("busquedaConsolidado", busquedaConsolidado);
    $.ajax({
        async: false,
        url: "ajax/operacionesBIngreso.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            todoMenus = "ok";

        }, error: function (respuesta) {
            console.log(respuesta);
        }
    });
    return todoMenus;
}

$(document).on("keyup", "#nombrePiloto", async function () {
    var dato = $(this).val();
    var resp = await patternCharsetNum(dato);
    if (resp == 0) {
        $(this).removeClass('is-valid');
        $(this).addClass('is-invalid');
    } else {
        $(this).removeClass('is-invalid');
        $(this).addClass('is-valid');
    }

});

function patternCharsetNumProduc(dato) {
    const pattern = new RegExp('^[A-Z0-9/n\r\n\t\f\u00D1\u00F1\ \u00C1\u00C9\u00CD\u00D3\u00DA\u00E1\u00E9\u00ED\u00F3\u00FA\u00f1\u00d1\@#%&()$\-\s\.\,\*]+$', 'i');
    if (!pattern.test(dato)) {
        return 0;
    } else {
        return 1;
    }
}


function patternCharsetNum(dato) {
    const pattern = new RegExp('^[A-ZN/n\r\n\t\f\u00D1\u00F1\ \u00C1\u00C9\u00CD\u00D3\u00DA\u00E1\u00E9\u00ED\u00F3\u00FA\u00f1\u00d1]+$', 'i');
    if (!pattern.test(dato)) {
        return 0;
    } else {
        return 1;
    }
}


/*
 function patternCharsetNum(dato) {
 const pattern = new RegExp(/[^A-Za-z0-9 \\ /-|.()N/n\r\n\t\f ]/g);
 console.log(pattern);
 if (!pattern.test(dato)) {
 return 0;
 } else {
 return 1;
 }
 }*/

$(document).on("change", "#numeroLicencia", async function () {
    var valType = $(this).attr("type");
    if (valType == "text") {
        var valTextLicExt = $(this).val();
        if (valTextLicExt.length <= 5) {
            Swal.fire({
                position: 'top-center',
                type: 'error',
                title: 'Numero de licencia no es valida',
                showConfirmButton: false,
                timer: 3000
            })
        } else {
            var respValida = await patternPreg(valTextLicExt);
            if (respValida == 1) {
                $(this).removeClass("is-invalid");
                $(this).addClass("is-valid");
                document.getElementById("nombrePiloto").readOnly = false;
            } else {
                $(this).removeClass("is-valid");
                $(this).addClass("is-invalid");
                document.getElementById("nombrePiloto").readOnly = true;
                document.getElementById("nombrePiloto").readOnly = "";
                $("#nombrePiloto").val();
            }
        }
    }
    if (valType == "number") {
        if ($("#nombrePiloto").length >= 1) {

            document.getElementById("nombrePiloto").value = "";
            $("#nombrePiloto").removeClass("is-valid");
            $("#nombrePiloto").addClass("is-invalid");
            var dato = $(this).val();
            var resp = cuiIsValid(dato);
            if (resp) {
                var datos = new FormData();
                datos.append("datoDpiConsult", dato);
                $.ajax({
                    url: "ajax/operacionesBIngreso.ajax.php",
                    method: "POST",
                    data: datos,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function (respuesta) {
                        console.log(respuesta);
                        if (respuesta != "SD") {
                            $("#nombrePiloto").removeClass("is-invalid");
                            $("#nombrePiloto").addClass("is-valid");
                            document.getElementById("nombrePiloto").value = respuesta[0].nombrePLT;

                            document.getElementById("numeroPlaca").focus();
                        } else {
                            document.getElementById("nombrePiloto").value = "";
                        }
                    },
                    error: function (respuesta) {
                        console.log(respuesta);
                    }
                })
            } else if (!resp) {
                $("#numeroLicencia").removeClass("is-valid");
                $("#numeroLicencia").addClass("is-invalid");
                document.getElementById("nombrePiloto").readOnly = true;
                if ($("#sel2").length >= 1) {


                    document.getElementById("divPilotoExt").innerHTML = "";
                    document.getElementById("divPilotoExt").innerHTML = `
<label>¿Es un piloto extranjero?</label><br/>
<button type="button" class="btn btn-info btn-flat btnExtranjero" id="buttonPilotoExtranejero" estado="0">Es piloto extranjero</button>`;
                    document.getElementById("buttonPilotoExtranejero").focus();
                } else {
                    if ($(".btnExtranjero").length == 0) {
                        document.getElementById("divDataPiloto").innerHTML += '<button type="button" class="btn btn-info btn-flat btnExtranjero" id="buttonPilotoExtranejero" estado="0">Es piloto extranjero</button>';
                    }
                }
            }
        }
    }
});
$(document).on("click", ".btnPilotoExtranjero", function () {
    var numLic = document.getElementById("numeroLicencia").value;
    if (isNaN(numLic)) {
        var mensaje = "Ud esta incluyendo un dato no numerico, revise bien el numero de licencia.";
        var tipo = "error";
        document.getElementById("nombrePiloto").readOnly = true;
        document.getElementById("numeroLicencia").focus();
    } else if (!isNaN(numLic)) {
        document.getElementById("nombrePiloto").readOnly = false;
        document.getElementById("nombrePiloto").focus();
    }
});


function patternPreg(dato) {
    const pattern = new RegExp('^[A-Z0-9\u00D1\u00F1\-]+$', 'i');
    if (!pattern.test(dato)) {
        return 0;
    } else {
        return 1;
    }
}

function patternPregSinG(dato) {
    const pattern = new RegExp('^[A-Z0-9\u00D1\u00F1]+$', 'i');
    if (!pattern.test(dato)) {
        return 0;
    } else {
        return 1;
    }
}

function patternPregNum(dato) {
    if (!isNaN(dato)) {
        return 1;
    } else {
        return 0;
    }
}

function patternPregNumEntero(dato) {
    var patron = /^\d*$/; //Expresión regular para aceptar solo números enteros
    if (patron.test(dato)) {
        return 1;
    } else {
        return 0;
    }
}

function patternPregSpace(dato) {
    const pattern = new RegExp('^[A-Z\u00D1\u00F1\ \-]+$', 'i');
    if (!pattern.test(dato)) {
        return 0;
    } else {
        return 1;
    }
}

function patternPregSpaceSG(dato) {
    const pattern = new RegExp('^[A-Z\u00D1\ \u00F1]+$', 'i');
    if (!pattern.test(dato)) {
        return 0;
    } else {
        return 1;
    }
}

function patternPregSpaceSGProducto(dato) {
    const pattern = new RegExp('^[A-Z0-9\u00D1\ \u00F1\%]+$', 'i');
    if (!pattern.test(dato)) {
        return 0;
    } else {
        return 1;
    }
}

function patternPregSpaceSGPunto(dato) {
    const pattern = new RegExp('^[A-Z0-9.()&,\u00D1\ \u00F1\&]+$', 'i');
    if (!pattern.test(dato)) {
        return 0;
    } else {
        return 1;
    }
}

function patternPregSpaceSGApostPunto(dato) {
    const pattern = new RegExp('^[A-Z\u00D1\ \u00F1\u0027]+$', 'i');
    if (!pattern.test(dato)) {
        return 0;
    } else {
        return 1;
    }
}

function validarFecha(fecha) {
    try {
        var fecha = fecha.split("-");
        var dia = fecha[0];
        var mes = fecha[1];
        var ano = fecha[2];
        var estado = 1;
        if ((dia.length == 2) && (mes.length == 2) && (ano.length == 4)) {
            switch (parseInt(mes)) {
                case 1:
                    dmax = 31;
                    break;
                case 2:
                    if (ano % 4 == 0)
                        dmax = 29;
                    else
                        dmax = 28;
                    break;
                case 3:
                    dmax = 31;
                    break;
                case 4:
                    dmax = 30;
                    break;
                case 5:
                    dmax = 31;
                    break;
                case 6:
                    dmax = 30;
                    break;
                case 7:
                    dmax = 31;
                    break;
                case 8:
                    dmax = 31;
                    break;
                case 9:
                    dmax = 30;
                    break;
                case 10:
                    dmax = 31;
                    break;
                case 11:
                    dmax = 30;
                    break;
                case 12:
                    dmax = 31;
                    break;
            }
            dmax != "" ? dmax : dmax = -1;
            if ((dia >= 1) && (dia <= dmax) && (mes >= 1) && (mes <= 12)) {
                for (var i = 0; i < fecha[0].length; i++) {
                    diaC = fecha[0].charAt(i).charCodeAt(0);
                    (!((diaC > 47) && (diaC < 58))) ? estado = false : '';
                    mesC = fecha[1].charAt(i).charCodeAt(0);
                    (!((mesC > 47) && (mesC < 58))) ? estado = false : '';
                }
            }
            for (var i = 0; i < fecha[2].length; i++) {
                anoC = fecha[2].charAt(i).charCodeAt(0);
                (!((anoC > 47) && (anoC < 58))) ? estado = false : '';
            }
        } else
            estado = 0;
        return estado;
    } catch (err) {
        alert("Error fechas");
    }
}
/*
 async function consultaEmpresaAwait(consultaEmpresa) {
 document.getElementById("lblNit").innerHTML = "";
 document.getElementById("lblClienteId").value = "";
 document.getElementById("lblEmpresa").innerHTML = "";
 document.getElementById("lblDireccion").innerHTML = "";
 var datos = new FormData();
 datos.append("consultaEmpresa", consultaEmpresa);
 $.ajax({
 url: "ajax/operacionesBIngreso.ajax.php",
 method: "POST",
 data: datos,
 cache: false,
 contentType: false,
 processData: false,
 dataType: "json",
 const resp = await success: function(respuesta) {
 console.log(respuesta);
 if (respuesta == "SD") {
 $("#divNitNuevo").removeClass("form-group");
 $("#divNitNuevo").addClass("input-group");
 document.getElementById("divNitNuevo").innerHTML = "";
 document.getElementById("divNitNuevo").innerHTML = `
 <div class="col-12">
 <label>
 Valor Peso
 </label>
 <div class="input-group">
 
 <input class="form-control" type="text" placeholder="Ingrese el numero de nit" id="txtNitEmpresa" />
 <span class="input-group-append">
 <button btnagrega="0" class="btn btn-info btn-flat btnAgregarNitNuevo is-invalid" id="agregarNuevoNit" type="button"  data-toggle="modal" data-target="#agregarNit">Agregar Nit</button>
 </span>
 </div>
 </div>`;
 $("#agregarNuevoNit").click();
 setTimeout(function() {
 document.getElementById("nuevoNit").focus();
 }, 500);
 } else if (respuesta != "SD") {
 document.getElementById("lblNit").innerHTML = respuesta[0]['nitEmpresa'];
 document.getElementById("lblClienteId").value = respuesta[0]["id"];
 document.getElementById("lblEmpresa").innerHTML = respuesta[0]['nombreEmpresa'];
 document.getElementById("lblDireccion").innerHTML = respuesta[0]['direccionEmpresa'];
 }
 },
 error: function(respuesta) {}
 });
 return true;
 }*/
function buscandoTarifas() {
    var numeroIdNitCliente = document.getElementById("lblClienteId").value;
    var datos = new FormData();
    datos.append("numeroIdNitCliente", numeroIdNitCliente);
    $.ajax({
        url: "ajax/operacionesBIngreso.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            var respuestaAwait = respuesta;
            if (respuesta == "sinTarifra") {
                document.getElementById("divContacto").innerHTML = "";
                document.getElementById("divEjecutivo").innerHTML = "";
                document.getElementById("divContacto").innerHTML = `<div class="alert alert-primary" role="alert">¿ Es consolidado?  <br/><br/><div class="btn-group">
                                                                                    <button type="button" class="btn btn-danger btnConsolidado" id="btnConsolidado" estado=0>Consolidado - Individual</button>
                                                                                    
                                                                                    </div></div>`;
            } else if (respuesta[0] == "tarifaEspecial") {
                document.getElementById("divContacto").innerHTML = `

                           <b>
                        Datos de contacto
                    </b>
                    <br/>
                        <br/>
                            <b>
                                Contacto:
                            </b>
                            <label id="lblNombreContacto" style="font-weight: normal;">

                            </label>
                            <br/>
                                <b>
                                    Telefono:
                                </b>
                                <label id="lblTelefonoC" style="font-weight: normal;">

                                </label>
                                <br/>
                                    <b>
                                        Correo:
                                    </b>
                                    <label id="lblCorreoC" style="font-weight: normal;">

                                    </label>
                                    <br/>
                                        <b>
                                            # Tarifa:
                                        </b>
                                        <label id="lblNumerotarifa" style="font-weight: normal;">

                                        </label>
                                        <input id="lblIdMostrar" name="idMostrar" type="hidden" value="2">
                                            <br/>
                                                <div id="divVerTarifa">
    
                                                <button class="btn btn-info btnView" data-target="#MostrarTodoServicio" data-toggle="modal" idmostrar="737852" numerotarifa="2" type="button">
                                                        <i aria-hidden="true" class="fa fa-eye">
                                                        </i>
                                                    </button>
                                                </div>
                                                <br/>
                                            <br/>
                                        </input>
                                    <br/>
                                <br/>
                            <br/>
                        <br/>
                    <br/>`;
                document.getElementById("divEjecutivo").innerHTML = `


                            <b>
                        Datos Ejecutivo
                    </b>
                    <br/>
                        <input id="lblEjecutivo" name="lblEjecutivo" type="hidden" value="">
                            <br/>
                                <b>
                                    Ejecutivo:
                                </b>
                                <label id="lblNombreEjecutivo" style="font-weight: normal;">

                                </label>
                                <br/>
                                    <b>
                                        Telefono:
                                    </b>
                                    <label id="lblTelefonoE" style="font-weight: normal;">

                                    </label>
                                    <br/>
                                        <b>
                                            Correo:
                                        </b>
                                        <label id="lblCorreoE" style="font-weight: normal;">

                                        </label>
                                        <br/>
                                            <b>
                                                Departamento:
                                            </b>
                                            <label id="lblDeptoE" style="font-weight: normal;">

                                            </label>
                                            <br/>
                                        <br/>
                                    <br/>
                                <br/>
                            <br/>
                          <br/>
    `;
                document.getElementById("lblNombreContacto").innerHTML = respuesta[1][0]["nombreContacto"];
                document.getElementById("lblTelefonoC").innerHTML = respuesta[1][0]["telefonoContacto"];
                document.getElementById("lblCorreoC").innerHTML = respuesta[1][0]["CorreoContacto"];
                document.getElementById("lblEjecutivo").value = respuesta[1][0]["numEjecutivo"];
                document.getElementById("lblNumerotarifa").innerHTML = respuesta[1][0]["numeroTarifa"];
                document.getElementById("lblIdMostrar").value = respuesta[1][0]["numCliente"];
            }
        }
    });
    return true;
}
$(function () {
    $('#datepicker').datepicker({
        onSelect: function () { // When cal is opened execute
            var currentDate = new Date($("#datepicker").datepicker("getDate"));
            var strDateTime = currentDate.getDate() + "/" + (currentDate.getMonth() + 1) + "/" + currentDate.getFullYear();
            startDatabaseQueries(strDateTime);
        }
    });
});
async function fucionRevisarConsolidado() {
    var tipoBusqueda = $("#tipoBusqueda").val();
    var bultosAgregados = $("#bultosAgregados").val();
    var pesoAgregado = $("#pesoAgregado").val();
    var val = 0;
    var empresaBuscada = await patternPregSpaceSGPunto(tipoBusqueda);
    if (empresaBuscada == 1) {
        var bultosAgregados = await patternPregNum(bultosAgregados);
        val = val + 1;
        if (bultosAgregados == 1) {
            var empresaBuscada = await patternPregNum(empresaBuscada);
            val = val + 1;
            if (empresaBuscada == 1) {
                val = val + 1;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    } else {
        return 0;
    }
    return val;
}

function borrarDatosCliente() {
    document.getElementById("divSeleccionDeServicios").innerHTML = `
<label>Selecciona Servicio</label>
    <select class="form-control" id="servicioTarifa" name="servicioTarifa"></select>
`;
    document.getElementById("lblNit").innerHTML = "";
    document.getElementById("lblClienteId").value = "";
    document.getElementById("lblEmpresa").innerHTML = "";
    document.getElementById("lblDireccion").innerHTML = "";
    document.getElementById("divContacto").innerHTML = `

                       <b>
                    Datos de contacto
                </b>
                <br/>
                    <br/>
                        <b>
                            Contacto:
                        </b>
                        <label id="lblNombreContacto" style="font-weight: normal;">

                        </label>
                        <br/>
                            <b>
                                Telefono:
                            </b>
                            <label id="lblTelefonoC" style="font-weight: normal;">

                            </label>
                            <br/>
                                <b>
                                    Correo:
                                </b>
                                <label id="lblCorreoC" style="font-weight: normal;">

                                </label>
                                <br/>
                                    <b>
                                        # Tarifa:
                                    </b>
                                    <label id="lblNumerotarifa" style="font-weight: normal;">

                                    </label>
                                    <input id="lblIdMostrar" name="idMostrar" type="hidden" value="2">
                                        <br/>
                                            <div id="divVerTarifa">
                                                <button class="btn btn-info btnView" data-target="#MostrarTodoServicio" data-toggle="modal" idmostrar="737852" numerotarifa="2" type="button">
                                                    <i aria-hidden="true" class="fa fa-eye">
                                                    </i>
                                                </button>
                                            </div>
                                            <br/>
                                        <br/>
                                    </input>
                                <br/>
                            <br/>
                        <br/>
                    <br/>
                <br/>`;
    document.getElementById("divEjecutivo").innerHTML = `


                        <b>
                    Datos Ejecutivo
                </b>
                <br/>
                    <input id="lblEjecutivo" name="lblEjecutivo" type="hidden" value="">
                        <br/>
                            <b>
                                Ejecutivo:
                            </b>
                            <label id="lblNombreEjecutivo" style="font-weight: normal;">

                            </label>
                            <br/>
                                <b>
                                    Telefono:
                                </b>
                                <label id="lblTelefonoE" style="font-weight: normal;">

                                </label>
                                <br/>
                                    <b>
                                        Correo:
                                    </b>
                                    <label id="lblCorreoE" style="font-weight: normal;">

                                    </label>
                                    <br/>
                                        <b>
                                            Departamento:
                                        </b>
                                        <label id="lblDeptoE" style="font-weight: normal;">

                                        </label>
                                        <br/>
                                    <br/>
                                <br/>
                            <br/>
                        <br/>
                      <br/>
`;
}

function saldoPesoIng(hiddenIdentityIngPeso, bultosAgregados, pesoAgregado) {
    let todoMenus;
    var datos = new FormData();
    datos.append("hiddenIdentityIngPeso", hiddenIdentityIngPeso);
    datos.append("bultosAgregados", bultosAgregados);
    datos.append("pesoAgregado", pesoAgregado);
    $.ajax({
        async: false,
        url: "ajax/operacionesBIngreso.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            if (respuesta["estadoSaldo"] == "denegado") {
                todoMenus = "denegado";
                if (respuesta.saldos.bultosSal != 0) {
                    document.getElementById("bultosSobregiro").innerHTML = respuesta.saldos.bultosSal;
                }
                if (respuesta.saldos.pesoSalida != 0) {
                    document.getElementById("pesoSobregiro").innerHTML = respuesta.saldos.pesoSalida;
                }

                document.getElementById("bultosSobregiro").innerHTML = "";
                document.getElementById("pesoSobregiro").innerHTML = "";
                document.getElementById("saldoIngNblts").innerHTML = respuesta.saldos.bultosIng;
                document.getElementById("bltsRetirados").innerHTML = respuesta.saldos.bultosSal;
                document.getElementById("saldoNuevoblts").innerHTML = respuesta.saldos.bultos;
                document.getElementById("saldoIngNPeso").innerHTML = respuesta.saldos.pesoIng;
                document.getElementById("pesoRetirados").innerHTML = respuesta.saldos.pesoSalida;
                document.getElementById("pesoNuevoblts").innerHTML = respuesta.saldos.pesoStock;
                formatNumber("saldoIngNPeso");
                formatNumber("pesoRetirados");
                formatNumber("pesoNuevoblts");

            } else {
                document.getElementById("bultosSobregiro").innerHTML = "";
                document.getElementById("pesoSobregiro").innerHTML = "";
                document.getElementById("saldoIngNblts").innerHTML = respuesta.saldos.bultosIng;
                document.getElementById("bltsRetirados").innerHTML = respuesta.saldos.bultosSal;
                document.getElementById("saldoNuevoblts").innerHTML = respuesta.saldos.bultos;
                document.getElementById("saldoIngNPeso").innerHTML = respuesta.saldos.pesoIng;
                document.getElementById("pesoRetirados").innerHTML = respuesta.saldos.pesoSalida;
                document.getElementById("pesoNuevoblts").innerHTML = respuesta.saldos.pesoStock;
                formatNumber("saldoIngNPeso");
                formatNumber("pesoRetirados");
                formatNumber("pesoNuevoblts");
                todoMenus = "Ok";
            }

        }, error: function (respuesta) {
            console.log(respuesta);
        }
    });
    return todoMenus;
}
/*
 $(document).on("change", "#busquedaConsolidado", async function () {
 $(".close").click();
 Swal.fire({
 position: 'top-right',
 type: 'success',
 title: 'Consolidado seleccionado',
 showConfirmButton: false,
 timer: 3000
 })
 const {value: valFob} = await Swal.fire({
 title: 'Ingresa el valor impuesto',
 input: 'text',
 inputPlaceholder: 'Ingrese el valor fob'
 })
 
 if (valFob) {
 
 
 if (!isNaN(valFob) && valFob >0) {
 var guardarValFob = crearValFob(valFob);
 } else {
 Swal.fire(`Valor no admitido, se acepta solo numeros : ${valFob}`)
 document.getElementById("sel2").selectedIndex = "Seleccione tipo de cliente";
 $("#sel2").removeClass("is-valid");
 $("#sel2").addClass("is-invalid");
 }
 }
 })*/
$(document).on("change", "#ClPolTAduana", function () {
    var tipoDeCambio = document.getElementById("ClPolCambio").value;
    var valorTotalAduana = document.getElementById("ClPolTAduana").value;
    var valorCif = multiplicacion(tipoDeCambio, valorTotalAduana);
    if (valorCif > 0) {
        document.getElementById("ClPolCif").value = valorCif;
        $("#ClPolCif").removeClass("is-invalid");
        $("#ClPolCif").addClass("is-valid");
        document.getElementById("ClPolCif").readOnly = true;
        document.getElementById("ClPolImpuesto").focus();
    } else if (valorCif == 0) {
        document.getElementById("ClPolCif").value = '';
        $("#ClPolCif").removeClass("is-valid");
        $("#ClPolCif").addClass("is-invalid");
        document.getElementById("ClPolCif").readOnly = false;
    }
})

$(document).on("change", "#ClPolCambio", function () {
    var tipoDeCambio = document.getElementById("ClPolCambio").value;
    var valorTotalAduana = document.getElementById("ClPolTAduana").value;
    var valorCif = multiplicacion(tipoDeCambio, valorTotalAduana);
    if (valorCif > 0) {
        document.getElementById("ClPolCif").value = valorCif;
        $("#ClPolCif").removeClass("is-invalid");
        $("#ClPolCif").addClass("is-valid");
        document.getElementById("ClPolCif").readOnly = true;
        document.getElementById("ClPolImpuesto").focus();
    } else if (valorCif == 0) {
        document.getElementById("ClPolCif").value = '';
        $("#ClPolCif").removeClass("is-valid");
        $("#ClPolCif").addClass("is-invalid");
        document.getElementById("ClPolCif").readOnly = false;

    }
})

$(document).on("click", ".btnImpresionAcuse", function () {
    if (document.getElementById("hiddenIdentity").value >= 1) {
        var idIngreso = document.getElementById("hiddenIdentity").value;
        window.open("extensiones/tcpdf/pdf/Ingreso-Acuse-Recibo.php?Ingreso=" + idIngreso, "_blank");
    }
})


$(document).on("change", "#numeroLicenciaPlus", async function () {
    document.getElementById("nombrePilotoPlusUn").value = "";
    $("#numeroLicenciaPlus").removeClass("is-valid");
    $("#numeroLicenciaPlus").addClass("is-invalid");
    $("#nombrePilotoPlusUn").removeClass("is-valid");
    $("#nombrePilotoPlusUn").addClass("is-invalid");
    var datoCui = $(this).val();
    var resp = await cuiIsValid(datoCui);
    if (resp) {
        var consCui = await consultaPiloto(datoCui);
        if (consCui == "Ok") {
            $("#numeroLicenciaPlus").removeClass("is-invalid");
            $("#numeroLicenciaPlus").addClass("is-valid");
            if ($("#hiddenIdentity").length > 0) {
                var hiddenIdentityRevPlt = document.getElementById("hiddenIdentity").value;
            }
            if ($("#imprimirRetiroAlmacenaje").length > 0) {
                var hiddenIdentityRevPlt = $("#imprimirRetiroAlmacenaje").attr("idret");
            }
            var nombrePilotoPlusUn = document.getElementById("numeroLicenciaPlus").value;
            var valRespuesta = await revisionNuevoPilotos(nombrePilotoPlusUn, hiddenIdentityRevPlt);
            if (valRespuesta == "Ok") {

            } else if (valRespuesta == "Duplicate") {
                document.getElementById("numeroLicenciaPlus").value = "";
                document.getElementById("nombrePilotoPlusUn").value = "";
                $("#numeroLicenciaPlus").removeClass("is-valid");
                $("#numeroLicenciaPlus").addClass("is-invalid");

                $("#nombrePilotoPlusUn").removeClass("is-valid");
                $("#nombrePilotoPlusUn").addClass("is-invalid");
                Swal.fire({
                    position: 'top-center',
                    type: 'error',
                    title: 'No puede agregar dos veces a un mismo piloto',
                    showConfirmButton: false,
                    timer: 3000
                })
            }
        }
        //     revisionNuevoPilotos(datoCui, hiddenIdentityRevPlt);

        /*if (revisionNuevoPiloto=="Duplicate") {
         alert("no puede registrar este piloto porque esta duplicando la unidad")
         }else{
         
         var datoCui = await buscarPiloto(datoCui);
         if (datoCui == "Ok") {
         document.getElementById("numeroPlacaPlusUn").focus();
         $("#nombrePilotoPlusUn").removeClass("is-invalid");
         $("#nombrePilotoPlusUn").addClass("is-valid");
         } else if (datoCui == "OkSP") {
         document.getElementById("numeroPlacaPlusUn").focus();
         $("#nombrePilotoPlusUn").removeClass("is-valid");
         $("#nombrePilotoPlusUn").addClass("is-invalid");
         $("#nombrePilotoPlusUn").val();
         
         }
         
         }*/
    }
});




function consultaPiloto(datoDpiConsult) {
    let todoMenus;
    var datos = new FormData();
    datos.append("datoDpiConsult", datoDpiConsult);
    $.ajax({
        async: false,
        url: "ajax/operacionesBIngreso.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            if (respuesta != "SD") {
                $("#nombrePilotoPlusUn").removeClass("is-invalid");
                $("#nombrePilotoPlusUn").addClass("is-valid");
                document.getElementById("nombrePilotoPlusUn").value = respuesta[0].nombrePLT;
                if ($("#hidenPilotosPlus").length >= 1) {
                    document.getElementById("hidenPilotosPlus").value = respuesta[0].pltId;
                }
                document.getElementById("numeroPlacaPlusUn").focus();
                todoMenus = "Ok";
            } else {
                document.getElementById("nombrePilotoPlusUn").value = "";
                todoMenus = "Ok";
            }

        },
        error: function (respuesta) {
            console.log(respuesta);
        }
    })
    return todoMenus;
}
function revisionNuevoPilotos(datoCui, hiddenIdentityRevPlt) {
    let todoMenus;
    var datos = new FormData();
    datos.append("revisionCui", datoCui);
    datos.append("hiddenIdentityRevPlt", hiddenIdentityRevPlt);
    $.ajax({
        async: false,
        url: "ajax/operacionesBIngreso.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            if (respuesta[0].countPilotos >= 1) {
                todoMenus = "Duplicate";
            } else if (respuesta[0].countPilotos == 0) {
                todoMenus = "Ok";
            }
        }, error: function (respuesta) {
            console.log(respuesta);
        }
    });
    return todoMenus;

}


function buscarPiloto(datoCui) {
    let todoMenus;
    var datos = new FormData();
    datos.append("datoDpiConsult", datoCui);
    $.ajax({
        async: false,
        url: "ajax/operacionesBIngreso.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            if (respuesta != "SD") {
                document.getElementById("nombrePilotoPlusUn").value = respuesta[0]["piloto"];
                todoMenus = "Ok";
            } else {
                todoMenus = "OkSP";
            }
        }, error: function (respuesta) {
            console.log(respuesta);
        }
    });
    return todoMenus;
}


$(document).on("change", "#numeroPlacaPlusUn", async function () {
    var cartaDeCupo = $(this).val();

    var cartaDeCupoVal = await patternPregSinG(cartaDeCupo);

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
})


$(document).on("change", "#numeroContenedorPlusUn", async function () {
    var cartaDeCupo = $(this).val();
    var cartaDeCupoVal = await patternPregSinG(cartaDeCupo);
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
})

$(document).on("keyup", "#numeroMarchamoPlusUn", async function () {
    var cartaDeCupo = $(this).val();
    var cartaDeCupoVal = await patternPregSinG(cartaDeCupo);
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
})

$(document).on("click", ".btnGuardaNuevaUnidadPlus", async function () {
    var numeroLicenciaPlus = document.getElementById("numeroLicenciaPlus").value;
    var nombrePilotoPlusUn = document.getElementById("nombrePilotoPlusUn").value;
    var numeroPlacaPlusUn = document.getElementById("numeroPlacaPlusUn").value;
    var numeroContenedorPlusUn = document.getElementById("numeroContenedorPlusUn").value;

    if ($("#buttonMostrarCons").length == 0) {
        var hiddenIdentity = $(".btnMasPilotos").attr("idMasPilotos");
        var tipo = 2;
        var numeroMarchamoPlusUn = document.getElementById("numeroMarchamoPlusUn").value;
        if (numeroMarchamoPlusUn == "") {
            var numeroMarchamoPlusUn = 0;
        }

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
    if ($("#buttonMostrarCons").length == 0) {
        var hiddenIdentity = $(".btnMasPilotos").attr("idMasPilotos");


    } else {
        var hiddenIdentity = document.getElementById("hiddenIdentity").value;
    }
    var sumTotal = (numeroLicenciaPlusG + nombrePilotoPlusUnG + numeroPlacaPlusUnG + numeroContenedorPlusUnG + numeroMarchamoPlusUnG);

    if (sumTotal == 5) {
        console.log("hola mundo");
        var revisionFormDB = await revisionForm(numeroLicenciaPlus, nombrePilotoPlusUn, numeroPlacaPlusUn, numeroContenedorPlusUn, numeroMarchamoPlusUn, hiddenIdentity, tipo);
        console.log(revisionFormDB);
        if (revisionFormDB != "Duplicate") {

            var numeroLicenciaPlus = document.getElementById("numeroLicenciaPlus").value;
            var nombrePilotoPlusUn = document.getElementById("nombrePilotoPlusUn").value;
            var numeroPlacaPlusUn = document.getElementById("numeroPlacaPlusUn").value;

            var guardarUnidadesPlus = await ajaxGuardarUnidadesPlus(numeroLicenciaPlus, nombrePilotoPlusUn, numeroPlacaPlusUn, numeroContenedorPlusUn, numeroMarchamoPlusUn, hiddenIdentity, tipo);
            console.log(guardarUnidadesPlus);
            if (guardarUnidadesPlus != false) {
                document.getElementById("numeroLicenciaPlus").value = "";
                document.getElementById("nombrePilotoPlusUn").value = "";
                document.getElementById("numeroPlacaPlusUn").value = "";
                document.getElementById("numeroContenedorPlusUn").value = "";
                document.getElementById("numeroContenedorPlusUn").value = "";
                if ($("#numeroMarchamoPlusUn").length >= 1) {
                    document.getElementById("numeroMarchamoPlusUn").value = "";
                }

                $("#numeroLicenciaPlus").removeClass("is-valid");
                $("#nombrePilotoPlusUn").removeClass("is-valid");
                $("#numeroPlacaPlusUn").removeClass("is-valid");
                $("#numeroContenedorPlusUn").removeClass("is-valid");
                $("#numeroContenedorPlusUn").removeClass("is-valid");
                $("#numeroMarchamoPlusUn").removeClass("is-valid");
                $("#numeroLicenciaPlus").addClass("is-invalid");
                $("#nombrePilotoPlusUn").addClass("is-invalid");
                $("#numeroPlacaPlusUn").addClass("is-invalid");
                $("#numeroContenedorPlusUn").addClass("is-invalid");
                $("#numeroContenedorPlusUn").addClass("is-invalid");
                $("#numeroMarchamoPlusUn").addClass("is-invalid");
                if ($("#ListaSelect").length >= 1) {
                    $("#ListaSelect").append(`<div class="input-group mb-3" id="divUnidadExt` + guardarUnidadesPlus[0].Identity + `">
                  <div class="input-group-prepend">
                    <button type="button" class="btn btn-danger btn-sm" id="btnTrashPiloto" idRet=` + guardarUnidadesPlus[0].Identity + `  idUniDetTrash="` + guardarUnidadesPlus[0].Identity + `"><i class="fa fa-trash"></i></button>
                    <button type="button" class="btn btn-warning btn-sm" id="btnEditPiloto" idRet=` + guardarUnidadesPlus[0].Identity + ` idUniDetEdit="` + guardarUnidadesPlus[0].Identity + `"  data-toggle="modal" data-target="#plusPilotos"><i class="fa fa-edit" data-toggle="modal" data-target="#plusPilotos"></i></button>
                  </div>
                  <!-- /btn-group -->
                  <input type="text" class="form-control" id="texToEmpresaVal` + guardarUnidadesPlus[0].Identity + `" value="` + nombrePilotoPlusUn + ` - ` + numeroLicenciaPlus + ` - ` + numeroPlacaPlusUn + ` - ` + numeroContenedorPlusUn + `" />
                </div>`);
                }
                $("#close").click();
            }

        } else {
            Swal.fire({
                position: 'top-center',
                type: 'error',
                title: 'Existe un dato duplicado, Licencia, placa, contenedor o marchamo. por favor revise',
                showConfirmButton: false,
                timer: 3000
            })
        }
    } else {
        Swal.fire({
            position: 'top-center',
            type: 'error',
            title: 'No se puede guardar revise si lleno bien el formulario',
            showConfirmButton: false,
            timer: 3000
        })
    }

});

function revisionForm(numeroLicenciaPlus, nombrePilotoPlusUn, numeroPlacaPlusUn, numeroContenedorPlusUn, numeroMarchamoPlusUn, hiddenIdentity, tipo) {
    let todoMenus;
    var datos = new FormData();
    datos.append("numeroLicenciaPlusRev", numeroLicenciaPlus);
    datos.append("nombrePilotoPlusUnRev", nombrePilotoPlusUn);
    datos.append("numeroPlacaPlusUnRev", numeroPlacaPlusUn);
    datos.append("numeroContenedorPlusUnRev", numeroContenedorPlusUn);
    datos.append("numeroMarchamoPlusUnRev", numeroMarchamoPlusUn);
    datos.append("hiddenIdentityPlusRev", hiddenIdentity);
    datos.append("tipoPlus", tipo);

    $.ajax({
        async: false,
        url: "ajax/operacionesBIngreso.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            if (respuesta[0].resultRevision == 0) {
                todoMenus = respuesta;
            } else {
                todoMenus = "Duplicate";
            }
        }, error: function (respuesta) {
            console.log(respuesta);
        }
    });
    return todoMenus;
}
function ajaxGuardarUnidadesPlus(numeroLicenciaPlus, nombrePilotoPlusUn, numeroPlacaPlusUn, numeroContenedorPlusUn, numeroMarchamoPlusUn, hiddenIdentity, tipo) {
    let todoMenus;
    var datos = new FormData();
    datos.append("numeroLicenciaPlus", numeroLicenciaPlus);
    datos.append("nombrePilotoPlusUn", nombrePilotoPlusUn);
    datos.append("numeroPlacaPlusUn", numeroPlacaPlusUn);
    datos.append("numeroContenedorPlusUn", numeroContenedorPlusUn);
    datos.append("numeroMarchamoPlusUn", numeroMarchamoPlusUn);
    datos.append("hiddenIdentityPlus", hiddenIdentity);
    datos.append("hiddenTipo", tipo);
    $.ajax({
        async: false,
        url: "ajax/operacionesBIngreso.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            if (respuesta != "SD") {
                todoMenus = respuesta;
                Swal.fire({
                    position: 'top-center',
                    type: 'success',
                    title: 'La unidad fue agregada con exito',
                    showConfirmButton: false,
                    timer: 3000
                })
            } else {
                todoMenus = false;
                Swal.fire({
                    position: 'top-center',
                    type: 'error',
                    title: 'No se guardo',
                    showConfirmButton: false,
                    timer: 3000
                })
            }
        }, error: function (respuesta) {
            console.log(respuesta);
        }
    });
    return todoMenus;
}

function crearValFob(valorFob) {
    document.getElementById("hiddenValFob").value = valorFob;
    return true;
}

$(document).on("click", ".btnNuevaEmpresa", async function () {
    var nuevoNit = document.getElementById("nuevoNit").value;
    var nuevoNit = nuevoNit.trim();
    var nuevaEmpresa = document.getElementById("nuevaEmpresa").value;
    var nuevaEmpresa = nuevaEmpresa.trim()
    var nuevaDireccion = document.getElementById("nuevaDireccion").value;
    var nuevaDireccion = nuevaDireccion.trim();
    var valNit = validar_nit(nuevoNit);
    if (valNit) {
        var respuestaEmpresa = ajaxNuevaEmpresa(nuevoNit, nuevaEmpresa, nuevaDireccion);
    }
})


function ajaxNuevaEmpresa(nuevoNit, nuevaEmpresa, nuevaDireccion) {
    let todoMenus;
    var datos = new FormData();
    datos.append("nuevoNit", nuevoNit);
    datos.append("nuevaEmpresa", nuevaEmpresa);
    datos.append("nuevaDireccion", nuevaDireccion);
    $.ajax({
        async: false,
        url: "ajax/operacionesBIngreso.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            if (respuesta[0].respuesta == "Ok") {
                swal({
                    title: "Agregado",
                    text: "La empresa fue agregada correctamente...",
                    type: "success"
                }).then(okay => {
                    if (okay) {
                        if (document.getElementById("btnPlusEmpresas")) {
                            $(".close").click();
                        }
                    }
                });
            } else if (respuesta[0].respuesta == "Duplicate") {
                swal({
                    title: "Error",
                    text: "La empresa ya existe actualemente...",
                    type: "error"
                }).then(okay => {
                    if (okay) {
                        if (document.getElementById("btnPlusEmpresas")) {
                            $(".close").click();
                        } else {
                            location.reload();
                        }
                    }
                });
            }
        }, error: function (respuesta) {
            console.log(respuesta);
        }
    });
    return todoMenus;
}

$(document).on("click", ".btnExtranjero", async function () {
    document.getElementById("nombrePiloto").readOnly = false;
    $("#numeroLicencia").removeAttr('type');
    $("#numeroLicencia").attr('type', 'text');
})


$(document).on("click", ".btnAcuseConsoli", async function () {
    if (document.getElementById("hiddenIdentity").value >= 1) {
        var idIngreso = $(this).attr("idIng");
        window.open("extensiones/tcpdf/pdf/Ingreso-Acuse-Recibo.php?Ingreso=" + idIngreso, "_blank");
    }

});

$(document).on("click", "#btnConsultaEjec", async function () {

    var idNitCliente = document.getElementById("lblClienteId").value;
    if (idNitCliente >= 1) {
        var respEjecutivo = await consultarEjecutivoTarifa(idNitCliente);

    }
});

function consultarEjecutivoTarifa(idNitCliente) {
    let todoMenus;
    var datos = new FormData();
    datos.append("idNitCltEje", idNitCliente);
    $.ajax({
        async: false,
        url: "ajax/operacionesBIngreso.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {

            if (respuesta != "SD") {

                document.getElementById("fotoPerfil").innerHTML = '<img class="profile-user-img img-fluid img-circle" src="' + respuesta[0]["picture"] + '"" alt="User profile picture">';
                document.getElementById("nombreEjecutivo").innerHTML = respuesta[0]["nmbre"] + ' ' + respuesta[0]["appell"];
                document.getElementById("funcion").innerHTML = respuesta[0]["depto"];
                document.getElementById("email").innerHTML = respuesta[0]["correo"];
                document.getElementById("cel").innerHTML = respuesta[0]["cel"];

            }
            console.log(respuesta);
            todoMenus = "ok";

        }, error: function (respuesta) {
            console.log(respuesta);
        }
    });
    return todoMenus;
}


$(document).on("click", "#btnAplicaCartaC", async function () {
    document.getElementById("cartaDeCupo").readOnly = false;
})



$(document).on("change", "#cartaDeCupo", async function () {
    var cartaDeCupo = $(this).val();
    if (cartaDeCupo.length >= 15) {
        var e = document.getElementById("regimenPoliza");
        var indexValue = e.options[e.selectedIndex].value;
        var indexText = e.options[e.selectedIndex].text;
        var cartaDeCupoVal = await patternPreg(cartaDeCupo);
        if (cartaDeCupoVal == 0) {
            var dato = 'cartaDeCupo';
            invalidar(dato);
        } else if (cartaDeCupoVal == 1) {
            var dato = 'cartaDeCupo';
            validar(dato);
        }
        if (indexText == "TO" || indexText == "DUT" || indexText == "FAUCA") {
            var cartaDeCupoVal = 1;
        }
        if (cartaDeCupoVal == 0) {
            var mensaje = "Carta De Cupo únicamente acepta, valores alfanumericos y guiones.";
            msgErrorCampo(mensaje);
        }
    }
})






$(document).on("change", "#cantContenedores", async function () {

    var cantidadContenedores = $(this).val();
    //  document.getElementById("infoCantidadCont").innerHTML = ``;
    if (cantidadContenedores >= 1) {
        var cantidadContenedoresVal = await patternPregNumEntero(cantidadContenedores);
        if (cantidadContenedoresVal == 0) {
            var dato = 'cantContenedores';
            invalidar(dato);
            var mensaje = "Cantidad de contenedores, tiene que ser un número mayor a : 0";
            msgErrorCampo(mensaje);
            //   document.getElementById("infoCantidadCont").innerHTML = ``;
        } else if (cantidadContenedoresVal == 1) {
            var dato = 'cantContenedores';
            validar(dato);
            //  document.getElementById("infoCantidadCont").innerHTML = ``;
        }
    } else {
        var dato = 'cantContenedores';
        invalidar(dato);
        var mensaje = "Cantidad de contenedores, tiene que ser un número mayor a : 0";
        msgErrorCampo(mensaje);
        // document.getElementById("infoCantidadCont").innerHTML = ``;
    }
})





$(document).on("change", "#dua", async function () {
    var numeroDua = $(this).val();
    if (numeroDua.length >= 10) {
        var e = document.getElementById("regimenPoliza");
        var indexValue = e.options[e.selectedIndex].value;
        var indexText = e.options[e.selectedIndex].text;
        var numeroDuaVal = await patternPreg(numeroDua);
        if (indexText == "DUT" || indexText == "FAUCA") {
            var numeroDuaVal = 1;
        }
        if (numeroDuaVal == 0) {
            invalidar("dua");
            var mensaje = "Número de DUA únicamente acepta valores alfanuméricos.";
            msgErrorCampo(mensaje);
        } else if (numeroDuaVal == 1) {
            validar("dua");
        }
    } else if (numeroDuaVal.length <= 10 || numeroDuaVal == 0) {
        invalidar("dua");
        var mensaje = "Ingrese de manera correcta el número de DUA";
        msgErrorCampo(mensaje);
    }
})


$(document).on("change", "#bl", async function () {
    var bl = $(this).val();
    if (bl.length >= 7) {
        var e = document.getElementById("regimenPoliza");
        var indexValue = e.options[e.selectedIndex].value;
        var indexText = e.options[e.selectedIndex].text;
        var blVal = await patternPregSinG(bl);
        if (indexText == "DUT" || indexText == "FAUCA") {
            var blVal = 1;
        }
        if (blVal == 0) {
            invalidar("bl");
            var mensaje = "Ingrese de manera correcta el número de BL, carta porte, factura comercial.";
            msgErrorCampo(mensaje);
        } else if (blVal == 1) {
            validar("bl");
        }
    } else if (bl.length <= 6) {
        invalidar("bl");
        var mensaje = "Ingrese de manera correcta el número de BL, carta porte, factura comercial.";
        msgErrorCampo(mensaje);
    }
})









$(document).on("change", "#bultosIngreso", async function () {

    var bultosIngreso = $(this).val();

    if (bultosIngreso >= 1) {
        var bultosIngresoVal = await patternPregNumEntero(bultosIngreso);
        if (bultosIngreso == 0) {
            var dato = 'bultosIngreso';
            invalidar(dato);
            var mensaje = "Cantidad de bultos, tiene que ser un número mayor a : 0";
            msgErrorCampo(mensaje);
            //   document.getElementById("infoCantidadCont").innerHTML = ``;
        } else if (bultosIngreso >= 1) {
            var dato = 'bultosIngreso';
            validar(dato);
            //  document.getElementById("infoCantidadCont").innerHTML = ``;
        }
    } else {
        var dato = 'bultosIngreso';
        invalidar(dato);
        var mensaje = "Cantidad de bultos, tiene que ser un número mayor a : 0";
        msgErrorCampo(mensaje);
        // document.getElementById("infoCantidadCont").innerHTML = ``;
    }
})




$(document).on("change", "#cantClientes", async function () {
    var cantidadClientes = $(this).val();
    if (cantidadClientes >= 1) {
        var cantidadClientesVal = await patternPregNumEntero(cantidadClientes);
        if (cantidadClientesVal == 0) {
            invalidar('cantClientes');
            var mensaje = "Cantidad de clientes tiene que mayor o igual a 1";
            var tipo = "error";
            alertValNoAdm(mensaje, tipo);
        } else if (cantidadClientesVal == 1) {
            validar('cantClientes');


            var e = document.getElementById("servicioTarifa");
            var indexValue = e.options[e.selectedIndex].value;
            var indexText = e.options[e.selectedIndex].text;

            if (indexText == "VEHICULOS NUEVOS") {

                document.getElementById("sel2").value = "Cliente individual";
                $("#sel2").removeClass("is-invalid");
                $("#sel2").addClass("is-valid");
                document.getElementById("sel2").disabled = true;

            }



        }
    } else {
        var mensaje = "Cantidad de clientes tiene que mayor o igual a 1";
        msgErrorCampo(mensaje);
    }
})


$(document).on("change", "#producto", async function () {
    var producto = $(this).val();
    if (producto == 0 || producto == "") {
        var mensaje = 'La descripción, no debe contener simbolos de comilla simple y doble, si desea definir pulgadas escriba la palabra PULGADA, se acepta los siguientes simbolos    @#%&()$-_.,*';
        msgErrorCampo(mensaje);
    } else {
        var productoVal = await patternCharsetNumProduc(producto);

        if (productoVal == 0) {
            invalidar('producto');
            var mensaje = 'La descripción, no debe contener simbolos de comilla simple y doble, si desea definir pulgadas escriba la palabra PULGADA, se acepta los siguientes simbolos    @#%&()$-_.,*';
            msgErrorCampo(mensaje);
        } else if (productoVal == 1) {
            validar('producto');
        }
    }

})


$(document).on("change", "#pesoIng", async function () {
    var pesoIng = $(this).val();
    var pesoIngDosD = parseFloat(pesoIng).toFixed(2);
    $(this).val(pesoIngDosD);
    var pesoIng = pesoIngDosD;
    if (pesoIng >= .01) {
        var pesoIngVal = await patternPregNum(pesoIng);
        if (pesoIngVal == 0) {
            invalidar('pesoIng');
            var mensaje = "Peso Bruto Total KG debe de ser mayor a 0, tampoco puede dejar vacio el valor.";
            var tipo = "error";
            alertValNoAdm(mensaje, tipo);
        } else if (pesoIngVal == 1) {
            validar('pesoIng');

        }
    } else if (pesoIng == 0 || pesoIng == "") {
        var mensaje = "Peso Bruto Total KG debe de ser mayor a 0, tampoco puede dejar vacio el valor.";
        msgErrorCampo(mensaje);
    } else if (isNaN(pesoIng)) {
        var mensaje = "El valor ingresado no es numerico.";
        var tipo = "error";
        alertValNoAdm(mensaje, tipo);
    }
})



$(document).on("change", "#valorTotalAduana", async function () {
    var valorTotalAduana = $(this).val();
    var valorTAduana = parseFloat(valorTotalAduana).toFixed(2);
    $(this).val(valorTAduana);
    var valorTotalAduana = valorTAduana;

    if (valorTotalAduana == 0 || valorTotalAduana == "") {
        var mensaje = "Valor en Aduana Total, debe de ser mayor a 0 y no puede dejar vacio campo.";
        msgErrorCampo(mensaje);
    } else {


        if (valorTotalAduana >= .01) {
            var valorTotalAduanaVal = await patternPregNum(valorTotalAduana);
            if (valorTotalAduanaVal == 0) {
                invalidar('valorTotalAduana');
                var mensaje = "Valor en Aduana Total, debe de ser mayor a 0 y no puede dejar vacio campo.";
                msgErrorCampo(mensaje);
            } else if (valorTotalAduanaVal == 1) {
                validar('valorTotalAduana');
            }
        } else if (isNaN(valorTotalAduana)) {
            invalidar('valorTotalAduana');
            var mensaje = "Valor en Aduana Total, debe de ser mayor a 0 y no puede dejar vacio campo.";
            msgErrorCampo(mensaje);
        }
    }
})



$(document).on("change", "#tipoDeCambio", async function () {
    var tipoDeCambio = $(this).val();
    if (tipoDeCambio == 0 || tipoDeCambio == "") {
        var mensaje = "Tasa de cambio, debe de ser mayor a 0 y no puede dejar vacio campo.";
        msgErrorCampo(mensaje);
    } else {
        if (tipoDeCambio >= .01) {
            var tipoDeCambioVal = await patternPregNum(tipoDeCambio);
            if (tipoDeCambioVal == 0) {
                invalidar('tipoDeCambio');
                var mensaje = "Tasa de cambio, debe de ser mayor a 0 y no puede dejar vacio campo.";
                msgErrorCampo(mensaje);
            } else if (tipoDeCambioVal == 1) {
                validar('tipoDeCambio');
            }
        } else if (isNaN(tipoDeCambio)) {
            invalidar('tipoDeCambio');
            var mensaje = "Tasa de cambio, debe de ser mayor a 0 y no puede dejar vacio campo.";
            msgErrorCampo(mensaje);
        }
    }
})







$(document).on("change", "#totalValorCif", async function () {
    var totalValorCif = $(this).val();
    if (totalValorCif == 0 || totalValorCif == "") {
        var mensaje = "Total Val Aduana * T. Cambio, debe de ser mayor a 0 y no puede dejar vacio campo.";
        msgErrorCampo(mensaje);
    } else {
        if (totalValorCif >= .01) {
            var totalValorCifVal = await patternPregNum(totalValorCif);
            if (totalValorCifVal == 0) {
                invalidar('totalValorCif');
                var mensaje = "Total Val Aduana * T. Cambio, debe de ser mayor a 0 y no puede dejar vacio campo.";
                msgErrorCampo(mensaje);
            } else if (totalValorCifVal == 1) {
                validar('totalValorCif');
            }
        } else if (isNaN(totalValorCif)) {
            invalidar('totalValorCif');
            var mensaje = "Total Val Aduana * T. Cambio, debe de ser mayor a 0 y no puede dejar vacio campo.";
            msgErrorCampo(mensaje);
        }
    }
})




$(document).on("change", "#valorImpuesto", async function () {
    var valorImpuesto = $(this).val();

    var valorImps = parseFloat(valorImpuesto).toFixed(2);
    $(this).val(valorImps);
    var valorImpuesto = valorImps;

    if (valorImpuesto == 0 || valorImpuesto == "") {
        var mensaje = "Total General (DAI+IVA), debe de ser mayor a 0 y no puede dejar vacio campo.";
        msgErrorCampo(mensaje);
    } else {
        if (valorImpuesto >= .01) {
            var valorImpuestoVal = await patternPregNum(valorImpuesto);
            if (valorImpuestoVal == 0) {
                invalidar('valorImpuesto');
                var mensaje = "Total General (DAI+IVA), debe de ser mayor a 0 y no puede dejar vacio campo.";
                msgErrorCampo(mensaje);
            } else if (valorImpuestoVal == 1) {
                validar('valorImpuesto');
            }
        } else if (isNaN(valorImpuesto)) {
            invalidar('valorImpuesto');
            var mensaje = "Total General (DAI+IVA), debe de ser mayor a 0 y no puede dejar vacio campo.";
            msgErrorCampo(mensaje);
        }
    }
})



$(document).on("change", "#numeroPlaca", async function () {
    var numeroPlaca = $(this).val();
    var numeroPlacaVal = await patternPregSinG(numeroPlaca);
    if (numeroPlaca == 0 || numeroPlaca == "" || numeroPlaca.length <= 2) {
        invalidar('numeroPlaca');
        var mensaje = "Número de placa, acepta solo valores alfanuméricos, no puede escribir guiones.";
        msgErrorCampo(mensaje);
    } else {


        if (numeroPlacaVal == 0) {
            invalidar('numeroPlaca');
            var mensaje = "Número de placa, acepta solo valores alfanuméricos, no puede escribir guiones.";
            msgErrorCampo(mensaje);
        } else if (numeroPlacaVal == 1) {
            validar('numeroPlaca');
        } else {
            invalidar('numeroPlaca');
            var mensaje = "Número de placa, acepta solo valores alfanuméricos, no puede escribir guiones.";
            msgErrorCampo(mensaje);
        }
    }
})

$(document).on("change", "#puertoOrigen", async function () {
    $("#selectSucces").removeClass('has-error');
    $("#selectSucces").addClass('has-success');
});

$(document).on("change", "#servicioTarifa", async function () {
    validar('servicioTarifa');
    var e = document.getElementById("servicioTarifa");
    var indexValue = e.options[e.selectedIndex].value;
    var indexText = e.options[e.selectedIndex].text;

    if (indexText == "VEHICULOS NUEVOS") {

        document.getElementById("sel2").value = "Cliente individual";
        $("#sel2").removeClass("is-invalid");
        $("#sel2").addClass("is-valid");
        document.getElementById("sel2").disabled = true;
    } else {
        document.getElementById("sel2").value = "Seleccion ubicación";
        $("#sel2").removeClass("is-valid");
        $("#sel2").addClass("is-invalid");
        document.getElementById("sel2").disabled = false;

    }


});




function invalidar(dato) {
    $('#' + dato).removeClass("is-valid");
    $('#' + dato).addClass("is-invalid");
}

function validar(dato) {
    $('#' + dato).removeClass("is-invalid");
    $('#' + dato).addClass("is-valid");
}
function msgErrorCampo(mensaje) {
    Swal.fire({
        position: 'top-center',
        type: 'error',
        title: mensaje,
        showConfirmButton: true,
        confirmButtonText: "Cerrar",
        closeConfirm: true
    })
}


$(document).on("keyup", "#nombrePilotoPlusUn", async function () {
    var dato = $(this).val();
    var resp = await patternCharsetNum(dato);
    if (resp == 0) {
        $(this).removeClass('is-valid');
        $(this).addClass('is-invalid');
    } else {
        $(this).removeClass('is-invalid');
        $(this).addClass('is-valid');
    }

});

$(document).on("change", "#numChasisVehUs", async function () {
    document.getElementById("comprobarChasis").innerHTML = "";
    var numChasisVehUs = $(this).val();
    var valNumChasisVehUs = await patternPregSinG(numChasisVehUs);
    if (valNumChasisVehUs == 1) {



        var chasisVehiculo = document.getElementById("numChasisVehUs").value;
        if (chasisVehiculo != "" || chasisVehiculo != 0) {
            $(this).removeClass("is-invalid");
            $(this).addClass("is-valid");
            var lista = [];
            for (var i = 0; i < chasisVehiculo.length; i++) {
                lista.push([i]);
                setTimeout(function () {
                    var dato = lista[0];
                    document.getElementById("comprobarChasis").innerHTML += chasisVehiculo[dato];
                    dimeChasis(chasisVehiculo[dato]);
                    lista.shift();
                }, 1300 * i);
            }
        }
    } else {
        $(this).removeClass("is-valid");
        $(this).addClass("is-invalid");
        dimeChasis("Dato no admitido");
    }
});

function dimeChasis(textoHablar) {
    speechSynthesis.speak(new SpeechSynthesisUtterance(textoHablar));
}


$(document).on("change", "#tVehiculoUs", async function () {
    var tVehiculoUs = $(this).val();
    if (tVehiculoUs == 0 || tVehiculoUs == "") {
        var mensaje = 'La descripción, no debe contener simbolos de comilla simple y doble, si desea definir pulgadas escriba la palabra PULGADA, se acepta los siguientes simbolos    @#%&()$-_.,*';
        msgErrorCampo(mensaje);
    } else {
        var tVehiculoUsVal = await patternCharsetNumProduc(tVehiculoUs);

        if (tVehiculoUsVal == 0) {
            invalidar('tVehiculoUs');
            var mensaje = 'La descripción, no debe contener simbolos de comilla simple y doble, si desea definir pulgadas escriba la palabra PULGADA, se acepta los siguientes simbolos    @#%&()$-_.,*';
            msgErrorCampo(mensaje);
        } else if (tVehiculoUsVal == 1) {
            validar('tVehiculoUs');
        }
    }

})


$(document).on("change", "#marcaVeh", async function () {
    var marcaVeh = $(this).val();
    if (marcaVeh == 0 || marcaVeh == "") {
        var mensaje = 'La descripción, no debe contener simbolos de comilla simple y doble, si desea definir pulgadas escriba la palabra PULGADA, se acepta los siguientes simbolos    @#%&()$-_.,*';
        msgErrorCampo(mensaje);
    } else {
        var marcaVehVal = await patternCharsetNumProduc(marcaVehVal);

        if (marcaVehVal == 0) {
            invalidar('marcaVeh');
            var mensaje = 'La descripción, no debe contener simbolos de comilla simple y doble, si desea definir pulgadas escriba la palabra PULGADA, se acepta los siguientes simbolos    @#%&()$-_.,*';
            msgErrorCampo(mensaje);
        } else if (marcaVehVal == 1) {
            validar('marcaVeh');
        }
    }

})


$(document).on("change", "#lineaVeh", async function () {
    var lineaVeh = $(this).val();
    if (lineaVeh == 0 || lineaVeh == "") {
        var mensaje = 'La descripción, no debe contener simbolos de comilla simple y doble, si desea definir pulgadas escriba la palabra PULGADA, se acepta los siguientes simbolos    @#%&()$-_.,*';
        msgErrorCampo(mensaje);
    } else {
        var lineaVehVal = await patternCharsetNumProduc(lineaVehVal);

        if (lineaVehVal == 0) {
            invalidar('lineaVeh');
            var mensaje = 'La descripción, no debe contener simbolos de comilla simple y doble, si desea definir pulgadas escriba la palabra PULGADA, se acepta los siguientes simbolos    @#%&()$-_.,*';
            msgErrorCampo(mensaje);
        } else if (lineaVehVal == 1) {
            validar('lineaVeh');
        }
    }
})

$(document).on("change", "#modeloVeh", async function () {
    var modeloVeh = $(this).val();
    var modeloVehVal = await patternPregSinG(modeloVeh);
    if (modeloVehVal == 0) {
        $(this).removeClass("is-valid");
        $(this).addClass("is-invalid");
    } else if (modeloVehVal == 1) {
        $(this).removeClass("is-invalid");
        $(this).addClass("is-valid");
    } else {
        $(this).removeClass("is-valid");
        $(this).addClass("is-invalid");
    }
})


$(document).on("keyup", "#pesoVehiculoUs", async function () {
    var pesoVehiculoUs = $(this).val();
    if (pesoVehiculoUs >= .01) {
        var pesoVehiculoUsVal = await patternPregNum(pesoVehiculoUs);
        if (pesoVehiculoUsVal == 0) {
            invalidar('pesoVehiculoUs');
            var mensaje = "Peso Bruto Total KG debe de ser mayor a 0, tampoco puede dejar vacio el valor.";
            var tipo = "error";
            alertValNoAdm(mensaje, tipo);
        } else if (pesoVehiculoUsVal == 1) {
            validar('pesoVehiculoUs');

        }
    }
})

$(document).on("click", ".btnGVehciuloUs", async function () {
    var chasisUsado = document.getElementById("numChasisVehUs").value;
    var tipoVehiculo = document.getElementById("tVehiculoUs").value;
    var marcaVeh = document.getElementById("lineaVeh").value;
    var modeloVeh = document.getElementById("modeloVeh").value;

    var llaveConsulta = document.getElementById("hiddenIdentity").value;
    var tipoBusqueda = document.getElementById("numChasisVehUs").value;
    var bultosAgregados = 1;
    var pesoAgregado = document.getElementById("pesoVehiculoUs").value;
    var respuestaSaldoPeso = await saldoPesoIng(llaveConsulta, bultosAgregados, pesoAgregado);
    console.log(respuestaSaldoPeso);
    if ($(".tableIngFail").length == 0) {
        var cantVsClientes = document.getElementById("cantVsClientes").value;
        if ($("#gDetalles").length>0) {
            document.getElementById('gDetalles').setAttribute('class', "btn btn-info");
        }
        var valueClientes = document.getElementById("valueClientes").value;
        cantVsClientes = parseInt(cantVsClientes) + 1;
        document.getElementById("contadorH3").innerHTML = cantVsClientes;
        document.getElementById("contadorClientes").innerHTML = cantVsClientes;
    }



    var verificarDuplicados = await verificarDuplVehUs(llaveConsulta, tipoBusqueda);
    if (verificarDuplicados) {


        var guardarDetalle = guardarVehUSados(llaveConsulta, tipoBusqueda, bultosAgregados, pesoAgregado);
        console.log(guardarDetalle);
        if (guardarDetalle[0] >= 1) {
            var idDet = guardarDetalle[0];
            var tipoVeh = document.getElementById("tVehiculoUs").value;
            var marcaVeh = document.getElementById("marcaVeh").value;
            var lineaVeh = document.getElementById("lineaVeh").value;
            var anioVehiculo = document.getElementById("modeloVeh").value;
            var detalles = await guardarDetVeUsados(llaveConsulta, idDet, tipoVeh, marcaVeh, lineaVeh, anioVehiculo);
            if (detalles) {
                var cantVsClientes = document.getElementById("cantVsClientes").value;
                cantVsClientes = parseInt(cantVsClientes) + 1;
                $("#divChaisVehiculosUS").append('<div id="divNumero' + guardarDetalle + '" class="col-12"><div class="input-group mb-3"> <div class="input-group-prepend"><button type="button" class="btn btn-danger btnEliminarDetalle" numeroButtonTrash="' + guardarDetalle + '" numBtnEliminar="' + cantVsClientes + '"><i class="fa fa-trash"></i></button><button type="button" class="btn btn-warning btnEditar" buttonEditar=' + guardarDetalle + ' numBtnEditar="' + cantVsClientes + '" btnEstadoEdicion=0><i class="fa fa-edit"></i></button> </div><input type="text" class="form-control" value="' + tipoBusqueda + '" id="nomEmpresa' + cantVsClientes + '" numTxtEmpresa="' + cantVsClientes + '" readOnly="readOnly"><input type="text" class="form-control" value="' + bultosAgregados + '" id="bltsEmpresa' + cantVsClientes + '" numTxtBultos="' + cantVsClientes + '" readOnly="readOnly"><input type="text"  class="form-control" value="' + pesoAgregado + '"  id="pesoEmpresa' + cantVsClientes + '" numTxtPeso="' + cantVsClientes + '" readOnly="readOnly"></div></div>');
                if (guardarDetalle[1] == "Okk") {
                    Swal.fire(
                            'Agregado',
                            'Transacción exitosa, todos los vehículos fueron agregados',
                            'info'
                            )
                } else {
                    document.getElementById("numChasisVehUs").value = "";
                    document.getElementById("tVehiculoUs").value = "";
                    document.getElementById("marcaVeh").value = "";
                    document.getElementById("lineaVeh").value = "";
                    document.getElementById("modeloVeh").value = "";
                    document.getElementById("pesoVehiculoUs").value = "";
                    document.getElementById("comprobarChasis").value = "";
                    $("#numChasisVehUs").removeClass("is-valid");
                    $("#tVehiculoUs").removeClass("is-valid");
                    $("#marcaVeh").removeClass("is-valid");
                    $("#lineaVeh").removeClass("is-valid");
                    $("#modeloVeh").removeClass("is-valid");
                    $("#pesoVehiculoUs").removeClass("is-valid");

                    $("#numChasisVehUs").addClass("is-invalid");
                    $("#tVehiculoUs").addClass("is-invalid");
                    $("#marcaVeh").addClass("is-invalid");
                    $("#lineaVeh").addClass("is-invalid");
                    $("#modeloVeh").addClass("is-invalid");
                    $("#pesoVehiculoUs").addClass("is-invalid");
                    Swal.fire(
                            'Agregado',
                            'Transacción exitosa',
                            'success'
                            )
                }
            }
        }
    } else {
        Swal.fire(
                'Duplicado',
                'El vehiculo ya fue agregado anteriormente',
                'error'
                )
    }
});
function verificarDuplVehUs(llaveConsulta, tipoBusqueda) {
    let resp;

    var datos = new FormData();
    datos.append("idIngRevVeh", llaveConsulta);
    datos.append("chasisRevVeh", tipoBusqueda);

    $.ajax({
        async: false,
        url: "ajax/operacionesBIngreso.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            if (respuesta[0].contChasis == 0) {
                resp = true;
            } else {
                resp = false;
            }
        }, error: function (respuesta) {
            console.log(respuesta);
        }
    })
    return resp;
}
function guardarDetVeUsados(llaveConsulta, idDet, tipoVeh, marcaVeh, lineaVeh, anioVehiculo) {
    let resp;
    var datos = new FormData();
    datos.append("idIngVehUs", llaveConsulta);
    datos.append("idDetVehUs", idDet);
    datos.append("tipoVeh", tipoVeh);
    datos.append("marcaVeh", marcaVeh);
    datos.append("lineaVeh", lineaVeh);
    datos.append("anioVehiculo", anioVehiculo);
    $.ajax({
        async: false,
        url: "ajax/operacionesBIngreso.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            if (respuesta) {
                resp = true;
            } else {
                resp = false;
            }

        }, error: function (respuesta) {
            console.log(respuesta);
        }
    });


    return resp;
}

function guardarVehUSados(llaveConsulta, tipoBusqueda, bultosAgregados, pesoAgregado) {
    let resp;
    var datos = new FormData();
    datos.append("llaveConsulta", llaveConsulta);
    datos.append("tipoBusqueda", tipoBusqueda);
    datos.append("bultosAgregados", bultosAgregados);
    datos.append("pesoAgregado", pesoAgregado);
    $.ajax({
        async: false,
        url: "ajax/operacionesBIngreso.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            if (respuesta.estado == "OK" || respuesta.estado == "Okk") {
                resp = ([respuesta["resultado"][0].Identity, respuesta.estado]);
            } else {
                resp = false;
            }
        }, error: function (respuesta) {
            console.log(respuesta);
        }
    });
    return resp;
}


$(document).on("click", ".btnVeirfLinea", async function () {
    var tipoLinea = $(this).attr("tipoLinea");

    var tVehiculo = $(this).attr("tipoveh");

    var lVehiculo = $(this).attr("lineaveh");
    document.getElementById("divCompararChasis").innerHTML = `
<div class="form-group">
<label>Vehiculo no encontrado</label>
<input type="text" class="form-control" id="textoRevChas" value="` + tipoLinea + `" txtTpVeh="` + tVehiculo + `"  txtLnVeh="` + lVehiculo + `" readOnly="readOnly" />
</div>

`;
    document.getElementById("divButtonsCompara").innerHTML = '<button type="button" class="btn btn-warning btn-block btnCompara">Cambiar Linea  <i class="fa fa-exchange"></i></button>'

})


$(document).on("click", ".btnCompara", async function () {
    var selectVeh = document.getElementById("selectVehiculos");
    var indexValue = selectVeh.options[selectVeh.selectedIndex].value;
    var indexText = selectVeh.options[selectVeh.selectedIndex].text;
    var textoRevChas = document.getElementById("textoRevChas").value;

    var txtTpVeh = $("#textoRevChas").attr("txtTpVeh");
    var txtLnVeh = $("#textoRevChas").attr("txtLnVeh");

    if (!isNaN(indexValue) && indexValue >= 1) {
        if (indexText > textoRevChas) {
            var limite = indexText.length;
        } else {
            var limite = textoRevChas.length;
        }
        var contador = 0;
        for (i = 0; i < limite; i++) {
            var letraNuevo = textoRevChas[i];
            var letraDB = indexText[i];
            if (letraNuevo == letraDB) {
                var contador = contador + 1;
            }
        }

        var porcentaje = (100 / limite);
        var porcentajeCalc = (porcentaje * contador);
        var porcentajeCalc = parseFloat(porcentajeCalc).toFixed(2);
        if (porcentajeCalc >= 90) {
            Swal.fire({
                title: '¿Desea realizar el cambio de linea al vehiculo?',
                text: 'El vehiculo cuenta con un portaje de ' + porcentajeCalc + ' %',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hacer cambio',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.value) {
                    cambiarLinea(indexValue, txtTpVeh, txtLnVeh)
                }
            })



        } else {
            Swal.fire({
                position: 'top-center',
                type: 'error',
                title: 'Revise bien la linea no tiene considencia, el porcentaje es de:' + porcentajeCalc + ' %',
                showConfirmButton: false,
                timer: 4000
            })
        }


    } else {
        Swal.fire({
            position: 'top-center',
            type: 'error',
            title: '¡Busque el vehiculo!',
            showConfirmButton: false,
            timer: 4000
        })

    }

})

function cambiarLinea(indexValue, txtTpVeh, txtLnVeh) {
    var datos = new FormData();
    datos.append("indexValue", indexValue);
    $.ajax({
        async: false,
        url: "ajax/operacionesBIngreso.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);

            var iteraciones = 3;
            var chasisDelimitados = document.getElementById("chasisDelimitados").value;
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

                document.getElementById("chasisDelimitados").value = "";
                for (var i = 0; i < cadenaArray.length; i++) {
                    var registro = 0;
                    var numFila = numFila + 1;
                    var chasis = cadenaArray[i];

                    var tipoVeh = cadenaArray[i + 1];
                    if (txtTpVeh == tipoVeh) {
                        var tipoVeh = respuesta[0].tipoVeh;

                    }
                    var lineaVeh = cadenaArray[i + 2];
                    if (txtLnVeh == lineaVeh) {
                        var lineaVeh = respuesta[0].lineaVeh;

                    }

                    if (i + 3 != cadenaArray.length) {
                        var registro = chasis + '|' + tipoVeh + '|' + lineaVeh + '|\n';

                        document.getElementById("chasisDelimitados").value += registro;
                    }
                    if (i + 3 == cadenaArray.length) {

                        var registro = chasis + '|' + tipoVeh + '|' + lineaVeh;

                        document.getElementById("chasisDelimitados").value += registro;

                    }
                    //             document.getElementById("chasisDelimitados").innerHTML += chasis+'|'+tipoVeh+'|'+lineaVeh+'|';
                    var i = i + 2;
                    lista.push([numFila, chasis, tipoVeh, lineaVeh]);
                }
                var listaValidacion = JSON.stringify(lista);
                document.getElementById("divCompararChasis").innerHTML = "";
                document.getElementById("divButtonsCompara").innerHTML = "";
                document.getElementById("hiddenJsonVehiculos").value = listaValidacion;

                $("#buttonChasis").click();

            }
            console.log(cadenaArray);
        }, error: function (respuesta) {
            console.log(respuesta);
        }
    });
}


$(document).on("click", ".btnGuradarChasVeh", async function () {
    if ($(".btnGuradarChasVeh").attr("estado") == 1) {
        Swal.fire({
            position: 'top-center',
            type: 'error',
            title: '¡Vehiculos ya registrados!',
            showConfirmButton: false,
            timer: 3000
        })
    } else {
        var chasisDelimitados = document.getElementById("chasisDelimitados").value;
        var chasisTrim = chasisDelimitados.trim();
        var sin_salto = chasisTrim.split("\n").join("");
        var cadenaArray = sin_salto.split("|");
        var cantidadBultos = document.getElementById("bultosIngreso").value;
        if (cantidadBultos == cadenaArray.length / 3) {
            var hiddenIdnetyIngV = document.getElementById("hiddenIdentity").value;
            var jsonVehiculosG = document.getElementById("hiddenJsonVehiculos").value;
            console.log(jsonVehiculosG);

            var respuestaVehN = guardarChasisVehiculosNuevos(hiddenIdnetyIngV, jsonVehiculosG);
            console.log(respuestaVehN);
            if (respuestaVehN) {
                $(".btnGuradarChasVeh").removeClass("btn-success");
                $(".btnGuradarChasVeh").addClass("btn-warning");
                $(".btnGuradarChasVeh").attr("disabled", "disabled");
                $(".btnGuradarChasVeh").attr("estado", 1);
                $(".btnGuradarChasVeh").html("Vehiculos Guardados");
                $(".btnValidarChasis").attr("disabled", "disabled");

                swal({
                    position: 'top-center',
                    type: 'success',
                    title: '¡Chasises guardados correctamente!',
                }).then(okay => {
                    return 0;
                })

            } else if (respuestaVehN[0]["estado"] == true) {
                $(".btnGuradarChasVeh").removeClass("btn-success");
                $(".btnGuradarChasVeh").addClass("btn-warning");
                $(".btnGuradarChasVeh").attr("disabled", "disabled");
                $(".btnGuradarChasVeh").attr("estado", 1);
                $(".btnGuradarChasVeh").html("Vehiculos Guardados");
                $(".btnValidarChasis").attr("disabled", "disabled");

                swal({
                    position: 'top-center',
                    type: 'success',
                    title: '¡Chasises guardados correctamente!',
                }).then(okay => {
                    location.reload();
                    return 0;
                })

            } else {
                swal({
                    position: 'top-center',
                    type: 'error',
                    title: '¡Chasises duplicados!',
                }).then(okay => {
                    location.reload();
                    return 0;
                })
            }
        }
    }
})

function guardarChasisVehiculosNuevos(hiddenIdnetyIngV, jsonVehiculosG) {
    let todoMenus;
    var datos = new FormData();
    datos.append("hiddenIdnetyIngV", hiddenIdnetyIngV);
    datos.append("jsonVehiculosG", jsonVehiculosG);
    $.ajax({
        async: false,
        url: "ajax/operacionesBIngreso.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);

            if (respuesta) {
                todoMenus = true;
            } else {
                todoMenus = respuesta;

            }

        }, error: function (respuesta) {
            console.log(respuesta);
        }
    });
    return todoMenus;
}


$(document).on("click", ".btnCgrDetallePorFail", async function () {
    var idIngEdintity = $(this).attr("idIngOp");
    document.getElementById("hiddenIdentity").value = idIngEdintity;
})

$(document).on("click", ".btnVehiculosNuevos", async function () {
    var bultosIng = $(this).attr("bultosIng");
    var idingop = $(this).attr("idingop");
    document.getElementById("bultosIngreso").value = bultosIng;
    document.getElementById("hiddenIdentity").value = idingop;
})


$(document).on("change", "#busquedaConsolidado", async function () {
    var valorIdCons = $(this).val();
    console.log(valorIdCons);
    document.getElementById("hiddenConsolidado").value = valorIdCons;

})


$(document).on("change", "#ClPolBultos", async function () {

    var ClPolBultos = $(this).val();
    console.log(ClPolBultos);
    if (ClPolBultos >= 1) {
        var ClPolBultosVal = await patternPregNumEntero(ClPolBultos);
        if (ClPolBultos == 0) {
            var dato = 'ClPolBultos';
            invalidar(dato);
            var mensaje = "Cantidad de bultos, tiene que ser un número mayor a : 0";
            msgErrorCampo(mensaje);
            //   document.getElementById("infoCantidadCont").innerHTML = ``;
        } else if (ClPolBultos >= 1) {
            var dato = 'ClPolBultos';
            validar(dato);
            //  document.getElementById("infoCantidadCont").innerHTML = ``;
        }
    } else {
        var dato = 'ClPolBultos';
        invalidar(dato);
        var mensaje = "Cantidad de bultos, tiene que ser un número mayor a : 0";
        msgErrorCampo(mensaje);
        // document.getElementById("infoCantidadCont").innerHTML = ``;
    }
})

$(document).on("change", "#numeroMarchamo", async function () {
    var cartaDeCupo = $(this).val();
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
})


$(document).on("change", "#numeroContenedor", async function () {
    var numeroContenedor = $(this).val();
    var numeroContenedorVal = await patternPregSinG(numeroContenedor);
    if (numeroContenedor == 0 || numeroContenedor.length <= 2) {
        invalidar('numeroContenedor');
        var mensaje = "Número de placa, acepta solo valores alfanuméricos, no puede escribir guiones.";
        msgErrorCampo(mensaje);
    } else {


        if (numeroContenedorVal == 0) {
            invalidar('numeroContenedor');
            var mensaje = "Número de placa, acepta solo valores alfanuméricos, no puede escribir guiones.";
            msgErrorCampo(mensaje);
        } else if (numeroContenedorVal == 1) {
            validar('numeroContenedor');
        } else {
            invalidar('numeroContenedor');
            var mensaje = "Número de placa, acepta solo valores alfanuméricos, no puede escribir guiones.";
            msgErrorCampo(mensaje);
        }
    }
})


$(document).on("change", "#poliza", async function () {
    var numPolRev = $(this).val();
    var datos = new FormData();
    datos.append("numPolRev", numPolRev);
    $.ajax({
        url: "ajax/operacionesBIngreso.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: async function (respuesta) {
            console.log(respuesta);
            if (respuesta.datIng[0].resultado >= 1) {
                $('#poliza').removeClass('is-valid');
                $('#poliza').addClass('is-invalid');
                Swal.fire({
                    position: 'top-center',
                    type: 'error',
                    title: 'Esta poliza ya existen en el sistema.',
                    showConfirmButton: true,
                    timer: 2500
                })
            } else {
                if (respuesta.datIng[0].resultado == -1) {
                    var val = respuesta.datIng[0].nitEmpresa;
                    var resp = await cambiarServicio(val);
                    var identIng = respuesta.datIng[0].identIng;
                    document.getElementById("hiddenIdentity").value = identIng;
                    var idConsol = respuesta.datUnidad[0].idConsolidado;
                    setTimeout(async function () {

                        var valSer = respuesta.datIng[0].servicio;
                        document.getElementById("servicioTarifa").value = valSer;

                        $("#servicioTarifa").trigger('change');
                        document.getElementById("cartaDeCupo").value = respuesta.datIng[0].idCartaCupo;
                        $("#cartaDeCupo").trigger('change');
                        document.getElementById("dua").value = respuesta.datIng[0].dua;
                        $("#dua").trigger('change');

                        document.getElementById("bl").value = respuesta.datIng[0].bl;
                        $("#bl").trigger('change');

                        document.getElementById("busquedaConsolidado").value = idConsol;
                        $("#busquedaConsolidado").trigger('change');



                        document.getElementById("sel2").value = 'Cliente consolidado poliza';
                        $("#sel2").trigger('change');

                        document.getElementById("numeroLicencia").value = respuesta.datUnidad[0].licencia;
                        $("#numeroLicencia").trigger('change');

                        document.getElementById("nombrePiloto").value = respuesta.datUnidad[0].piloto;
                        $("#nombrePiloto").trigger('change');
                        $("#nombrePiloto").removeClass('is-invalid');
                        $("#nombrePiloto").addClass('is-valid');
                        document.getElementById("numeroPlaca").value = respuesta.datUnidad[0].placa;
                        $("#numeroPlaca").trigger('change');

                        document.getElementById("numeroContenedor").value = respuesta.datUnidad[0].contenedor;
                        $("#numeroContenedor").trigger('change');

                        document.getElementById("numeroMarchamo").value = respuesta.datUnidad[0].marchamo;
                        $("#numeroMarchamo").trigger('change');


                        document.getElementById("cartaDeCupo").readOnly = true;
                        document.getElementById("cantContenedores").readOnly = true;
                        document.getElementById("dua").readOnly = true;
                        document.getElementById("bl").readOnly = true;
                        document.getElementById("poliza").readOnly = true;
                        document.getElementById("bultosIngreso").readOnly = true;
                        document.getElementById("puertoOrigen").disabled = true;
                        document.getElementById("cantClientes").readOnly = true;
                        document.getElementById("producto").readOnly = true;
                        document.getElementById("pesoIng").readOnly = true;
                        document.getElementById("valorTotalAduana").readOnly = true;
                        document.getElementById("tipoDeCambio").readOnly = true;
                        document.getElementById("totalValorCif").readOnly = true;
                        document.getElementById("valorImpuesto").readOnly = true;
                        document.getElementById("dateTime").readOnly = true;
                        document.getElementById("sel2").disabled = true;
                        document.getElementById("servicioTarifa").disabled = true;
                        document.getElementById("regimenPoliza").disabled = true;
                        document.getElementById("numeroLicencia").readOnly = true;
                        document.getElementById("numeroMarchamo").readOnly = true;
                        document.getElementById("nombrePiloto").readOnly = true;
                        document.getElementById("numeroPlaca").readOnly = true;
                        document.getElementById("numeroContenedor").readOnly = true;
                        document.getElementById("txtNitEmpresa").readOnly = true;

                        var valTipoConso = $("#sel2 option:selected").text();


                        var lblNit = document.getElementById("lblNit").innerHTML;
                        var lblEmpresa = document.getElementById("lblEmpresa").innerHTML;
                        document.getElementById("divPlusClientes").innerHTML = '<button type="button" class="btn btn-primary btnAgregarPoliza" id="btnPlusEmpresas" data-toggle="modal" data-target="#gdarEmpresasPolConso"><i class="fa fa-plus"></i></button><button type="button" class="btn btn-dark btnMasPilotos" id="masPilotos" estado="0" data-toggle="modal" data-target="#plusPilotos">Agregar mas pilotos</button>';
                        document.getElementById("divAcciones").innerHTML = '<div class="btn-group btn-group-lg" id="divMasButtons"><button type="button" class="btn btn-warning btnEditarIngreso" id="editarData" estado=0>Editar</button></div>';
                        document.getElementById("hiddenContadorPolizas").value = 1;
                        if ($(".tableIngFail").length == 0) {
                            $("#divAccionesValidacion").removeClass("col-4");
                            $("#divAccionesValidacion").addClass("col-8");
                            $("#divRelleno").removeClass("col-4");
                            $("#divRelleno").addClass("col-0");



                            document.getElementById("divAccionesValidacion").innerHTML = `
              <table id="tableConsolidadoPoliza" class="table table-hover table-sm">
            </table>
              <input type="hidden" id="hiddenListaDeta" value="">`;
                            var numero = 1;
                            var contadorH3 = document.getElementById("contadorH3").innerHTML;
                            var contadorH3 = contadorH3 + 1;
                            document.getElementById("contadorH3").innerHTML = "";
                            document.getElementById("contadorH3").innerHTML = contadorH3;
                            document.getElementById("contadorClientes").innerHTML = "";
                            document.getElementById("contadorClientes").innerHTML = cantVsClientes;
                            var idIdenty = document.getElementById("hiddenIdentity").value;
                            var acciones = '<div class="btn-group"><button type="button" class="btn btn-success btn-sm btnAcuseConsoli" id="btnConsol" idIng=' + idIdenty + '>Acuse</button><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#gdrManifiestos" id="gDetalles" idIng=' + idIdenty + '>Cargar Empresas</button></div>';
                            var listaDataPoliza = [];
                            var poliza = document.getElementById("poliza").value;
                            var pesoIng = document.getElementById("pesoIng").value;
                            var bultosIngreso = document.getElementById("bultosIngreso").value;
                            listaDataPoliza.push([numero, poliza, lblNit, lblEmpresa, bultosIngreso, pesoIng, acciones]);

                            $('#tableConsolidadoPoliza').DataTable({
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
                                data: listaDataPoliza,
                                columns: [{
                                        title: "#"
                                    }, {
                                        title: "Poliza"
                                    }, {
                                        title: "Nit"
                                    }, {
                                        title: "Empresa"
                                    }, {
                                        title: "Bultos"
                                    }, {
                                        title: "Peso kg"
                                    }, {
                                        title: "Acciones"
                                    }]
                            });
                            document.getElementById("divAccionesVehiculos").innerHTML = '';
                        }

                    }, 5000);

                    document.getElementById("regimenPoliza").value = respuesta.datIng[0].regimenPol;
                    $("#regimenPoliza").trigger('change');



                    document.getElementById("cantContenedores").value = respuesta.datIng[0].cantidadContenedores;
                    $("#cantContenedores").trigger('change');

                    document.getElementById("bultosIngreso").value = respuesta.datIng[0].bultos;
                    $("#bultosIngreso").trigger('change');

                    document.getElementById("puertoOrigen").value = respuesta.datIng[0].origenPuerto;
                    $("#puertoOrigen").trigger('change');

                    document.getElementById("cantClientes").value = respuesta.datIng[0].cantidadClientes;
                    $("#cantClientes").trigger('change');

                    document.getElementById("producto").value = respuesta.datIng[0].producto;
                    $("#producto").trigger('change');

                    document.getElementById("pesoIng").value = respuesta.datIng[0].peso;
                    $("#pesoIng").trigger('change');

                    document.getElementById("valorTotalAduana").value = respuesta.datIng[0].valorTotalAduana;
                    $("#valorTotalAduana").trigger('change');

                    document.getElementById("tipoDeCambio").value = respuesta.datIng[0].tipoCambio;
                    $("#tipoDeCambio").trigger('change');

                    document.getElementById("valorImpuesto").value = respuesta.datIng[0].valorImpuesto;
                    $("#valorImpuesto").trigger('change');
                    $("#numeroLicencia").attr("type", "text");



                    $('#poliza').removeClass('is-invalid');
                    $('#poliza').addClass('is-valid');
                } else {
                    $('#poliza').removeClass('is-invalid');
                    $('#poliza').addClass('is-valid');

                }
            }
        },
        error: function (respuesta) {
            console.log(respuesta);
        }
    });
})

$(document).on("change", "#ClPolPoliza", function () {
    var numPolRev = $(this).val();
    var datos = new FormData();
    datos.append("numPolRev", numPolRev);
    $.ajax({
        url: "ajax/operacionesBIngreso.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            var estadoBtnDupl = $(".btnDuplicaCons").attr("estado");
            if (estadoBtnDupl == 0) {


                if (respuesta["datIng"][0].resultado >= 1) {
                    $('#ClPolPoliza').removeClass('is-valid');
                    $('#ClPolPoliza').addClass('is-invalid');
                    Swal.fire({
                        position: 'top-center',
                        type: 'error',
                        title: 'Esta poliza ya existen en el sistema.',
                        showConfirmButton: true,
                        timer: 2500
                    })
                } else {
                    $('#ClPolPoliza').removeClass('is-invalid');
                    $('#ClPolPoliza').addClass('is-valid');
                }
            } else if (estadoBtnDupl == 1) {
                Swal.fire({
                    position: 'top-center',
                    type: 'info',
                    title: 'Boton de pólizas duplicadas activas',
                    showConfirmButton: true,
                    timer: 2500
                })
                $('#ClPolPoliza').removeClass('is-invalid');
                $('#ClPolPoliza').addClass('is-valid');
            }
        },
        error: function (respuesta) {
            console.log(respuesta);
        }
    });
})

$(document).on("click", ".btnGuardarNuevasLineas", async function () {
    var iteraciones = 3;
    var chasisDelimitados = document.getElementById("chasisDelimitados").value;
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
            var chasis = cadenaArray[i];
            var tipoVeh = cadenaArray[i + 1];
            var lineaVeh = cadenaArray[i + 2];
            if (chasis == "" || tipoVeh == "" || lineaVeh == "") {
                var denegacion = 1;
                var mensaje = 'Debe ingresar Chasis, tipo vehiculo y linea del vehiculo, por cada vehiculo revise si el detalle proporcionado es correcto, tambien revise si el simbolo " | " no se encuentra al final del ultimo detalle...';
                var tipo = "error";
                alertaToast(mensaje, tipo);
                break;
            }
            var i = (i + 2);
            lista.push([numFila, chasis, tipoVeh, lineaVeh]);
        }
    }
    var listaValidacion = JSON.stringify(lista);
    var nomVar = "listaValidacion";
    var respIng = await revisarVehUsados(nomVar, listaValidacion);
    var chasisNoEncontrado = [];
    for (var i = 0; i < respIng.length; i++) {
        var tipoVehiculo = respIng[i].TipoVehiculo;
        var lineaVehiculo = respIng[i].lineaVehiculo;
        var estado = respIng[i].estado;
        if (estado == 0) {
            chasisNoEncontrado.push([tipoVehiculo, lineaVehiculo]);
        }
    }
    var nomVar = "listaNoEncontrada";
    var listaNoEncontrada = JSON.stringify(chasisNoEncontrado);

    var respIng = await revisarVehUsados(nomVar, listaNoEncontrada);
    if (respIng != "SD") {
        $(".btnValidarChasis").click();
    }

});

function revisarVehUsados(nomVar, listaValidacion) {
    let respFunc;
    var datos = new FormData();
    datos.append(nomVar, listaValidacion);
    $.ajax({
        async: false,
        url: "ajax/operacionesBIngreso.ajax.php",
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
            respFunc = respuesta;
        }})
    return respFunc;
}

$(document).on("click", ".btnCapturarQRPol", async function () {
    $(".swal2-input").focus();
    Swal.mixin({
        input: 'text',
        confirmButtonText: 'Siguiente &rarr;',
        progressSteps: ['1', '2']
    }).queue([
        {
            title: 'Datos poliza',
            text: 'Escaneé el codigo de barras de la poliza',
            imageUrl: 'vistas/img/plantilla/ejemploPoliza.png',
            imageWidth: 400,
            showCancelButton: true,

            allowOutsideClick: false,
            imageHeight: 200,
            imageAlt: 'Custom image',

        },
        {
            title: 'Datos licencia',
            text: 'Escaneé el codigo de barras de la poliza',
            imageUrl: 'vistas/img/plantilla/licenciaEjemplo.png',
            imageWidth: 400,
            imageHeight: 200,
            allowOutsideClick: false,
            imageAlt: 'Custom image',

        }
    ]).then(async function (result) {
        if (result.value) {
            var barcodePolizaIng = result.value[0];
            var barcodeLic = result.value[1];
            var answers = JSON.stringify(result.value);
            Swal.fire({
                title: 'Codigos Escaneados!',
                allowOutsideClick: false,
                type: 'success',
                text: 'Revise los datos del formulario',
                confirmButtonText: 'Ok!'
            })
            var barcodePolizaIng = barcodePolizaIng.toUpperCase();
            var barcodeLic = barcodeLic.toUpperCase();

            if (barcodeLic.length > 0) {


                var cantidadLlaves = 0;
                for (var i = 0; i < barcodeLic.length; i++) {
                    if (barcodeLic.charAt(i) == "]") {
                        var cantidadLlaves = cantidadLlaves + 1;
                    }
                }
                console.log(barcodeLic);
                if (cantidadLlaves == 10) {
                    var codeLic = barcodeLic.trim();
                    var sin_salto = codeLic.split("\n").join("");
                    var cadenaArray = sin_salto.split("]");
                    console.log(cadenaArray);
                    var licPilotoCodbar = cadenaArray[8];
                    var prNombre = cadenaArray[2];
                    var sgNombre = cadenaArray[3];
                    var prApellido = cadenaArray[4];
                    var sgApellido = cadenaArray[5];
                    var nombrePiloto = prNombre + ' ' + sgNombre + ' ' + prApellido + ' ' + sgApellido;
                }
                if (cantidadLlaves == 9) {
                    var codeLic = barcodeLic.trim();
                    var sin_salto = codeLic.split("\n").join("");
                    var cadenaArray = sin_salto.split("]");
                    console.log(cadenaArray);
                    var licPilotoCodbar = cadenaArray[8];
                    var prNombre = cadenaArray[2];
                    var prApellido = cadenaArray[3];
                    var sgApellido = cadenaArray[4];
                    var nombrePiloto = prNombre + ' ' + prApellido + ' ' + sgApellido;
                }
                if (cantidadLlaves == 8) {
                    var codeLic = barcodeLic.trim();
                    var sin_salto = codeLic.split("\n").join("");
                    var cadenaArray = sin_salto.split("]");
                    var licPilotoCodbar = cadenaArray[8];
                    var prNombre = cadenaArray[2];
                    var sgApellido = cadenaArray[3];
                    var nombrePiloto = prNombre + ' ' + sgApellido;
                }
            }
            if ($("#btnGuardaNuevaUnidad").length > 0) {

                document.getElementById("numeroLicenciaPlus").value = licPilotoCodbar;
                $("#numeroLicenciaPlus").trigger('change');
                setTimeout(function () {
                    document.getElementById("nombrePilotoPlusUn").value = nombrePiloto;
                    $("#nombrePilotoPlusUn").trigger('change');
                }, 3000);
            }
            if (barcodePolizaIng.length == 219) {


                barcodePolizaIng.trim();
                console.log(barcodePolizaIng);
                console.log('1 Clave del agente de aduanas ', barcodePolizaIng.substring(0, 3));
                console.log('2 Numero progresivo de la declaración del agente ', barcodePolizaIng.substring(3, 10));
                console.log('3 Numero de DUA ', barcodePolizaIng.substring(10, 30));
                console.log('4 Fecha de aceptación ', barcodePolizaIng.substring(30, 38));
                console.log('5 Clave de aduana despacho / destino ', barcodePolizaIng.substring(38, 45));
                console.log('6 NIT de importador / exportador ', barcodePolizaIng.substring(45, 70));
                console.log('7 Régimen ', barcodePolizaIng.substring(73, 75));
                console.log('8 Clase ', barcodePolizaIng.substring(75, 78));
                console.log('9 País de procedencia / destino ', barcodePolizaIng.substring(78, 80));
                console.log('10 Modo de transporte ', barcodePolizaIng.substring(80, 81));
                console.log('11 Tipo de cambio ', barcodePolizaIng.substring(81, 89));
                console.log('12 Total de valor en aduana MPI (Q) decimales ', barcodePolizaIng.substring(89, 104));
                console.log('13 Peso total bruto (kgs) ', barcodePolizaIng.substring(104, 120));
                console.log('14 Total FOB USD ', barcodePolizaIng.substring(120, 135));
                console.log('15 Total Flete USD ', barcodePolizaIng.substring(135, 150));
                console.log('16 Total Seguro USD ', barcodePolizaIng.substring(150, 165));
                console.log('17 Total Otros gastos USD ', barcodePolizaIng.substring(165, 180));
                console.log('18 Total a liquidar (efectivo) ', barcodePolizaIng.substring(180, 195));
                console.log('19 Total general ', barcodePolizaIng.substring(195, 210));
                console.log('20 Firma electrónica ', barcodePolizaIng.substring(210, 219));
                if (barcodePolizaIng.length > 0) {
                    var barcodeclaveAduana = barcodePolizaIng.substring(0, 3);
                    var barcodecorrelativoPol = barcodePolizaIng.substring(3, 10);
                    var barcodedua = barcodePolizaIng.substring(10, 30);
                    var barcodefechaAceptacion = barcodePolizaIng.substring(30, 38);
                    var barcodeclaveDespacho = barcodePolizaIng.substring(38, 45);
                    var barcodenit = barcodePolizaIng.substring(45, 70);
                    var barcoderegimen = barcodePolizaIng.substring(73, 75);
                    var barcodeclase = barcodePolizaIng.substring(75, 78);
                    var barcodepaisProcede = barcodePolizaIng.substring(78, 80);
                    var barcodetipoTransportes = barcodePolizaIng.substring(80, 81);
                    var barcodecambio = barcodePolizaIng.substring(81, 89);
                    var barcodecif = barcodecambio.trim();
                    var barcodecambio = barcodecif * 1;
                    var barcodecambio = parseFloat(barcodecambio).toFixed(5);
                    console.log(barcodecambio);
                    var barcodecif = barcodePolizaIng.substring(89, 104);
                    var barcodecif = barcodecif.trim();
                    var barcodecif = barcodecif * 1;
                    var barcodecif = parseFloat(barcodecif).toFixed(2);
                    var barcodepeso = barcodePolizaIng.substring(104, 120);
                    var barcodefob = barcodePolizaIng.substring(120, 135);
                    var barcodeflete = barcodePolizaIng.substring(135, 150);
                    var barcodeseguro = barcodePolizaIng.substring(150, 165);
                    var barcodeotros = barcodePolizaIng.substring(165, 180);
                    var barcodetotalLiquido = barcodePolizaIng.substring(180, 195);
                    var barcodeimpuesto = barcodePolizaIng.substring(195, 210);
                    var barcodefirmaElectro = barcodePolizaIng.substring(210, 219);
                    var polizaIng = barcodeclaveAduana + barcodecorrelativoPol;
                    var duca = barcodedua;
                    var RegimenDat = barcoderegimen.trim();
                    var RegimenDat = RegimenDat.toUpperCase().replace(" ", "");
                    var valDolares = barcodecif / barcodecambio;
                    var valDolares = valDolares * 1;
                    var valDolares = parseFloat(valDolares).toFixed(2);
                    console.log(valDolares);
                    var tipoCambio = barcodecambio;
                    var impuestos = barcodeimpuesto;
                    var impuestos = impuestos.trim();
                    var impuestos = impuestos * 1;
                    var impuestos = parseFloat(impuestos).toFixed(2);

                    var peso = barcodepeso;
                    var peso = peso.trim();
                    var peso = peso * 1;
                    var peso = parseFloat(peso).toFixed(2);
                    var prtCode = barcodedua.substring(5, 7);
                    console.log(prtCode);
                    var nitTrim = barcodenit.trim();

                }
            }
            if ($(".btnAgregarPoliza").length && barcodePolizaIng.length == 219) {
                document.getElementById("ClientPoltxtNitSalida").value = nitTrim;
                $("#ClientPoltxtNitSalida").trigger('change');
                document.getElementById("ClPolDua").value = duca;
                $("#ClPolDua").trigger('change');
                document.getElementById("ClPolPoliza").value = polizaIng;
                $("#ClPolPoliza").trigger('change');
                document.getElementById("ClPolPeso").value = peso;
                $("#ClPolPeso").trigger('change');
                document.getElementById("ClPolTAduana").value = valDolares;
                $("#ClPolTAduana").trigger('change');
                document.getElementById("ClPolCambio").value = tipoCambio;
                $("#ClPolCambio").trigger('change');
                document.getElementById("ClPolImpuesto").value = impuestos;
                $("#ClPolImpuesto").trigger('change');
                return true;
            }
            if ($("#buttonMostrarCons").length >= 1 && barcodePolizaIng.length == 219) {
                console.log(polizaIng);
                document.getElementById("poliza").value = polizaIng;
                $("#poliza").trigger('change');
                var regimen = document.getElementById("regimenPoliza");

                var RegimenDat = RegimenDat.toUpperCase().replace(" ", "");
                // recorremos todos los valores del select
                var estadoReg = 0;
                for (var i = 1; i < regimen.length; i++) {
                    if (regimen.options[i].text == RegimenDat) {
                        // seleccionamos el valor que coincide
                        regimen.selectedIndex = i;
                        $("#regimenPoliza").trigger('change');
                        var estadoReg = estadoReg + 1;
                    }
                }

                document.getElementById("valorTotalAduana").value = valDolares;
                $("#valorTotalAduana").trigger('change');
                document.getElementById("tipoDeCambio").value = tipoCambio;
                $("#tipoDeCambio").trigger('change');
                document.getElementById("valorImpuesto").value = impuestos;
                $("#valorImpuesto").trigger('change');
                document.getElementById("pesoIng").value = peso;
                $("#pesoIng").trigger('change');
                document.getElementById("dua").value = duca;
                $("#dua").trigger('change');
                document.getElementById("puertoOrigen").value = prtCode;
                $("#puertoOrigen").trigger('change');
                document.getElementById("txtNitEmpresa").value = nitTrim;
                $("#txtNitEmpresa").trigger('change');
                document.getElementById("numeroLicencia").value = licPilotoCodbar;
                $("#numeroLicencia").trigger('change');
                setTimeout(function () {
                    document.getElementById("dua").value = duca;
                    $("#dua").trigger('change');

                    document.getElementById("nombrePiloto").value = nombrePiloto;
                    $("#nombrePiloto").trigger('change');
                }, 3000);

            }
            if ($("#calculoTxtNitSalida").length >= 1 && barcodePolizaIng.length == 219) {
                document.getElementById("calculoTxtNitSalida").value = nitTrim;
                $("#calculoTxtNitSalida").trigger('change');
                document.getElementById("calculoPolizaRetiro").value = polizaIng;
                $("#calculoPolizaRetiro").trigger('change');
                document.getElementById("calculoRegimen").value = RegimenDat;
                $("#calculoRegimen").trigger('change');
                document.getElementById("calculoValorTAduana").value = valDolares;
                $("#calculoValorTAduana").trigger('change');
                document.getElementById("calculoCambio").value = tipoCambio;
                $("#calculoCambio").trigger('change');
                document.getElementById("calculoValorImpuesto").value = impuestos;
                $("#calculoValorImpuesto").trigger('change');
                document.getElementById("calculoPesoKg").value = peso;
                $("#calculoPesoKg").trigger('change');

            }

            if ($("#textParamBusqRet").length > 0 && barcodePolizaIng.length == 219) {
                document.getElementById("txtNitSalida").value = nitTrim;
                $("#txtNitSalida").trigger('change');
                document.getElementById("polizaRetiro").value = polizaIng;
                $("#polizaRetiro").trigger('change');
                document.getElementById("regimen").value = RegimenDat;
                $("#regimen").trigger('change');
                document.getElementById("valorTAduana").value = valDolares;
                $("#valorTAduana").trigger('change');
                document.getElementById("cambio").value = tipoCambio;
                $("#cambio").trigger('change');
                document.getElementById("calculoValorImpuesto").value = impuestos;
                $("#calculoValorImpuesto").trigger('change');
                document.getElementById("pesoKg").value = peso;
                $("#pesoKg").trigger('change');
                document.getElementById("numeroLicencia").value = licPilotoCodbar;
                $("#numeroLicencia").trigger('change');

                setTimeout(function () {
                    document.getElementById("nombrePiloto").value = nombrePiloto;
                }, 3000);
            }

            if ($("#polizaRetiro").length >= 1) {
                document.getElementById("valorDoll").value = valDolares;
                $("#valorDoll").trigger('change');
                document.getElementById("tCambio").value = tipoCambio;
                $("#tCambio").trigger('change');
                document.getElementById("impuestos").value = impuestos;
                $("#impuestos").trigger('change');
                document.getElementById("peso").value = peso;
                $("#peso").trigger('change');

            }


        }
    })
})

$(document).on("click", ".btnEliminarDetalleIng", async function () {
    $(this).parent().parent().parent().remove();
})

$(document).on("mouseover", "#nomEmpresa", async function () {
    $(this).attr('readOnly', false);
})

$(document).on("mouseover", "#TextBltsIng", async function () {
    $(this).attr('readOnly', false);
})

$(document).on("mouseover", "#TextpesoIng", async function () {
    $(this).attr('readOnly', false);
})


$(document).on("mouseout", "#nomEmpresa", async function () {
    $(this).attr('readOnly', true);
})

$(document).on("mouseout", "#TextBltsIng", async function () {
    $(this).attr('readOnly', true);
})

$(document).on("mouseout", "#TextpesoIng", async function () {
    $(this).attr('readOnly', true);
})

$(document).on("click", "#btnGuardarDetallesIng", async function () {
    if ($("#tableConsolidadoPoliza").length == 0) {
        var hiddenIdentityIngPeso = document.getElementById("hiddenIdentity").value;

    }
    if ($("#tableConsolidadoPoliza").length > 0) {
        var hiddenIdentityIngPeso = document.getElementById("idIngManiElegido").value;
    }
    console.log(hiddenIdentityIngPeso);
    var tipoBusqueda = document.getElementById("tipoBusqueda").value;
    var bultosAgregados = document.getElementById("bultosAgregados").value;
    var bultosAgregados = parseInt(bultosAgregados);
    var pesoAgregado = document.getElementById("pesoAgregado").value;
    var pesoAgregado = pesoAgregado * 1;
    var pesoAgregado = parseFloat(pesoAgregado).toFixed(2);

    var totalBultos = 0;
    var totalPeso = 0;

    var paragraphsPesoIng = Array.from(document.querySelectorAll("#TextpesoIng"));

    if (paragraphsPesoIng.length >= 1) {
        var paragraphsBltsIng = Array.from(document.querySelectorAll("#TextBltsIng"));
        var totalBultos = 0;
        for (var i = 0; i < paragraphsBltsIng.length; i++) {
            var bultosIng = paragraphsBltsIng[i].attributes[3].value;
            var bultosIng = parseInt(bultosIng);
            var totalBultos = totalBultos + bultosIng;

        }
        var totalPeso = pesoAgregado * 1;
        var paragraphsPesoIng = Array.from(document.querySelectorAll("#TextpesoIng"));
        for (var j = 0; j < paragraphsPesoIng.length; j++) {
            var pesoIng = paragraphsPesoIng[j].attributes[3].value;
            var pesoIng = parseFloat(pesoIng).toFixed(2);
            var pesoIng = pesoIng * 1;
            var totalPeso = totalPeso + pesoIng;
        }
        var totalPeso = totalPeso;
        var totalPeso = parseFloat(totalPeso).toFixed(2);

        var cantidadClientes = document.getElementById("cantClientes").value;
        var bultosIngPol = document.getElementById("bultosIngreso").value;
        var bultosIngPol = parseInt(bultosIngPol);

        var saldoNuevoCruceBlts = bultosIngPol - totalBultos;
        var saldoNuevoCruceBlts = parseInt(saldoNuevoCruceBlts);


        var pesoIngPol = document.getElementById("pesoIng").value;
        var pesoIngPol = parseFloat(pesoIngPol).toFixed(2);
        var saldoNuevoCrucePeso = pesoIngPol - totalPeso;
        var saldoNuevoCrucePeso = parseFloat(saldoNuevoCrucePeso).toFixed(2);
        console.log(saldoNuevoCrucePeso);
        console.log(saldoNuevoCruceBlts);
        if (saldoNuevoCruceBlts == 0 && saldoNuevoCrucePeso == 0) {
            if ($("#tableConsolidadoPoliza").length == 0) {
                var llaveConsulta = document.getElementById("hiddenIdentity").value;

            }
            if ($("#tableConsolidadoPoliza").length > 0) {
                var llaveConsulta = document.getElementById("idIngManiElegido").value;
            }

            var nomVar = "idIngValDet";
            var respSaldos = await revisarVehUsados(nomVar, llaveConsulta);
            console.log(respSaldos);
            if (respSaldos != "SD") {
                var dataIngBlt = respSaldos[0].bultos;
                var dataIngPeso = respSaldos[0].peso;

                var paragraphsManIng = Array.from(document.querySelectorAll("#dataManifiesto"));
                listaGDParagh = [];
                var totalDeBultos = 0;
                var totalDePeso = 0;

                for (var i = 0; i < paragraphsManIng.length; i++) {
                    var llaveConsulta = llaveConsulta;
                    var empresaChild = paragraphsManIng[i].parentNode.children[1].attributes[2].value;
                    var bultosChild = paragraphsManIng[i].parentNode.children[2].attributes[3].value;
                    var bultosChild = parseInt(bultosChild);
                    var bultosChild = bultosChild * 1;
                    var totalDeBultos = totalDeBultos + bultosChild;

                    var pesoChild = paragraphsManIng[i].parentNode.children[3].attributes[3].value;
                    var pesoChild = parseFloat(pesoChild).toFixed(2);
                    var pesoChild = pesoChild * 1;
                    var totalDePeso = totalDePeso + pesoChild;

                    listaGDParagh.push({llaveConsulta, empresaChild, bultosChild, pesoChild});
                }
                var dataIngBlt = parseFloat(dataIngBlt).toFixed(2);
                var totalDeBultos = parseFloat(totalDeBultos).toFixed(2);
                var dataIngPeso = parseFloat(dataIngPeso).toFixed(2);
                var totalDePeso = parseFloat(totalDePeso).toFixed(2);
                console.log(dataIngBlt);
                console.log(totalDeBultos);
                console.log(dataIngPeso);
                console.log(totalDePeso);
                console.log(listaGDParagh);
                var totalRec = 0;
                var totalRecuList = listaGDParagh.length;
                if (dataIngBlt == totalDeBultos && dataIngPeso == totalDePeso) {
                    for (var i = 0; i < listaGDParagh.length; i++) {
                        var empresaChild = listaGDParagh[i].empresaChild;
                        var bultosChild = listaGDParagh[i].bultosChild;
                        var pesoChild = listaGDParagh[i].pesoChild;
                        var respGDDetalle = await guardarDetalleIng(llaveConsulta, empresaChild, bultosChild, pesoChild);
                        if (respGDDetalle.estado == "OK" || respGDDetalle.estado == "Okk") {
                            var totalRec = totalRec + 1;
                        }
                    }
                    if (totalRec == totalRecuList) {
                        Swal.fire({
                            title: 'Transacciones satisfactorias',
                            text: "El manifiesto fue agregado con éxito!",
                            type: 'success',
                            position: 'top-end',
                            allowOutsideClick: false,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ok!'
                        }).then((result) => {
                            if (result.value) {
                                if ($("#tableConsolidadoPoliza").length == 0) {
                                    location.reload();
                                } else {
                                    document.getElementById("divEmpresasAgregadasMani").innerHTML = "";
                                    document.getElementById("btnGuardarDetallesIng").disabled = true;
                                    document.getElementById("saldoIngNblts").innerHTML = "";
                                    document.getElementById("saldoNuevoblts").innerHTML = "";
                                    document.getElementById("bltsRetirados").innerHTML = "";

                                    document.getElementById("saldoIngNPeso").innerHTML = "";
                                    document.getElementById("pesoNuevoblts").innerHTML = "";
                                    document.getElementById("pesoRetirados").innerHTML = "";

                                    document.getElementById("contadorClientes").innerHTML = "";
                                }

                            }
                        })
                    } else {
                        Swal.fire({
                            title: 'Transacciones insatisfactorias',
                            text: "El manifiesto no fue agregado correctamente en ingresos interrumpidos puede agregar el los que no se guardaron!",
                            type: 'success',
                            position: 'top-end',
                            allowOutsideClick: false,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ok!'
                        }).then((result) => {
                            if (result.value) {
                                window.location = "ingresosPendientes";
                            }
                        })
                    }
                }

            }
        } else {
            Swal.fire(
                    'Sobregiro!',
                    'El detalle por agregar sobregira los saldos revise de bultos o peso!',
                    'error'
                    )
            return false;
        }

    } else {
        Swal.fire(
                'Error de manifiesto',
                'No existe manifiesto elaborado!',
                'error'
                )

        return false;
    }




})


function guardarDetalleIng(llaveConsulta, empresa, bultos, peso) {
    let retorno;
    console.log(llaveConsulta);
    console.log(empresa);
    console.log(bultos);
    console.log(llaveConsulta);

    var datos = new FormData();


    datos.append("llaveConsulta", llaveConsulta);
    datos.append("tipoBusqueda", empresa);
    datos.append("bultosAgregados", bultos);
    datos.append("pesoAgregado", peso);
    $.ajax({
        async: false,
        url: "ajax/operacionesBIngreso.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            retorno = respuesta;
        }, error: function (respuesta) {
            console.log(respuesta);
        }
    })
    return retorno;
}


$(document).on("click", ".btnAgregarEmpresaInter", async function () {
    if ($("#tableConsolidadoPoliza").length == 0) {
        var hiddenIdentityIngPeso = document.getElementById("hiddenIdentity").value;

    }
    if ($("#tableConsolidadoPoliza").length > 0) {
        var hiddenIdentityIngPeso = document.getElementById("idIngManiElegido").value;
    }
    var bultosAgregados = document.getElementById("bultosAgregados").value;
    var pesoAgregado = document.getElementById("pesoAgregado").value;

    var respuestaSaldoPeso = await saldoPesoIng(hiddenIdentityIngPeso, bultosAgregados, pesoAgregado);
    console.log(respuestaSaldoPeso);

    if (respuestaSaldoPeso == "Ok") {
        var revisar = await fucionRevisarConsolidado();
        console.log(revisar);
        if (revisar == 3) {
            var tipoBusqueda = document.getElementById("tipoBusqueda").value;
            var bultosAgregados = document.getElementById("bultosAgregados").value;
            var pesoAgregado = document.getElementById("pesoAgregado").value;
            if (tipoBusqueda == "") {
                alert("existe un dato vacio favor revise");
            } else {
                var llaveConsulta = document.getElementById("hiddenIdentity").value;
                var datos = new FormData();
                datos.append("llaveConsulta", llaveConsulta);
                datos.append("tipoBusqueda", tipoBusqueda);
                datos.append("bultosAgregados", bultosAgregados);
                datos.append("pesoAgregado", pesoAgregado);
                $.ajax({
                    url: "ajax/operacionesBIngreso.ajax.php",
                    method: "POST",
                    data: datos,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function (respuesta) {
                        console.log(respuesta);
                        if (respuesta == "sobreGiro") {
                            swal({
                                type: "error",
                                title: "Bultos Ingresados",
                                text: "Los bultos ingresados, sobre pasa los limites de lo que reporto en el ingreso",
                                showConfirmButton: true,
                                confirmButtonText: "cerrar",
                                closeConfirm: true
                            });
                        }
                        console.log(790);
                        if (respuesta["estado"] == "OK") {
                            console.log(respuesta["estado"]);
                            if ($("#divTableFail").length == 0) {


                                document.getElementById('colorDiv').setAttribute('class', "small-box bg-success");
                                document.getElementById("clientesRegs").innerHTML = "Clientes agregados";
                                var cantVsClientes = document.getElementById("cantVsClientes").value;
                                if ($("#gDetalles").length>0) {
                                document.getElementById("gDetalles").innerHTML = "Agregar o revisar";
                                document.getElementById('gDetalles').setAttribute('class', "btn btn-info");
                                    
                                }
                                
                                var valueClientes = document.getElementById("valueClientes").value;
                                cantVsClientes = parseInt(cantVsClientes) + 1;
                                document.getElementById("contadorH3").innerHTML = cantVsClientes;
                                document.getElementById("contadorClientes").innerHTML = cantVsClientes;
                            }
                            $("#divEmpresasAgregadasMani").append('<div id="divNumero' + respuesta["resultado"][0]["Identity"] + '" class="col-12"><div class="input-group mb-3"> <div class="input-group-prepend"><button type="button" class="btn btn-danger btnEliminarDetalle" numeroButtonTrash="' + respuesta["resultado"][0]["Identity"] + '" numBtnEliminar="' + cantVsClientes + '"><i class="fa fa-trash"></i></button><button type="button" class="btn btn-warning btnEditar" buttonEditar=' + respuesta["resultado"][0]["Identity"] + ' numBtnEditar="' + cantVsClientes + '" btnEstadoEdicion=0><i class="fa fa-edit"></i></button> </div><input type="text" class="form-control" value="' + tipoBusqueda + '" id="nomEmpresa' + cantVsClientes + '" numTxtEmpresa="' + cantVsClientes + '" readOnly="readOnly"><input type="text" class="form-control" value="' + bultosAgregados + '" id="bltsEmpresa' + cantVsClientes + '" numTxtBultos="' + cantVsClientes + '" readOnly="readOnly"><input type="text"  class="form-control" value="' + pesoAgregado + '"  id="pesoEmpresa' + cantVsClientes + '" numTxtPeso="' + cantVsClientes + '" readOnly="readOnly"></div></div>');

                            document.getElementById("cantVsClientes").value = cantVsClientes;

                            document.getElementById("tipoBusqueda").value = '';
                            document.getElementById("tipoBusqueda").value = '';
                            document.getElementById("bultosAgregados").value = '';
                            document.getElementById("pesoAgregado").value = '';

                            $("#tipoBusqueda").removeClass("is-valid");
                            $("#tipoBusqueda").addClass("is-invalid");
                            $("#bultosAgregados").removeClass("is-valid");
                            $("#bultosAgregados").addClass("is-invalid");
                            $("#pesoAgregado").removeClass("is-valid");
                            $("#pesoAgregado").addClass("is-invalid");
                            document.getElementById("tipoBusqueda").focus();
                        } else if (respuesta == "No") {
                            alert("existen bultos");
                        } else if (respuesta["estado"] == "Okk") {
                            swal({
                                title: "Operación Exitosa",
                                text: "Toda la transacción fue operada correctamente",
                                type: "success"
                            }).then(okay => {
                                if (okay) {
                                    if ($("#divTableFail").length == 0) {
                                        document.getElementById('colorDiv').setAttribute('class', "small-box bg-primary");
                                        document.getElementById("clientesRegs").innerHTML = 'TODOS LOS CLIENTES FUERON AGREGADOS';
                                        
                                        if ($("#gDetalles").length>0) {
                                        document.getElementById("gDetalles").innerHTML = "Editar Clientes";
                                        document.getElementById('gDetalles').setAttribute('class', "btn btn-success");
                                            
                                        }
                                        
                                        var valueClientes = document.getElementById("valueClientes").value;
                                        var cantVsClientes = document.getElementById("cantVsClientes").value;
                                        cantVsClientes = parseInt(cantVsClientes) + 1;
                                        document.getElementById("contadorH3").innerHTML = cantVsClientes;
                                        document.getElementById("contadorClientes").innerHTML = cantVsClientes;
                                    }
                                    $("#divEmpresasAgregadasMani").append('<div id="divNumero' + respuesta["resultado"][0]["Identity"] + '" class="col-12"><div class="input-group mb-3"> <div class="input-group-prepend"><button type="button" class="btn btn-danger btnEliminarDetalle" numeroButtonTrash="' + respuesta["resultado"][0]["Identity"] + '" numBtnEliminar="' + cantVsClientes + '"><i class="fa fa-trash"></i></button><button type="button" class="btn btn-warning btnEditar" buttonEditar=' + respuesta["resultado"][0]["Identity"] + ' numBtnEditar="' + cantVsClientes + '" btnEstadoEdicion=0><i class="fa fa-edit"></i></button> </div><input type="text" class="form-control" value="' + tipoBusqueda + '" id="nomEmpresa' + cantVsClientes + '" numTxtEmpresa="' + cantVsClientes + '" readOnly="readOnly"><input type="text" class="form-control" value="' + bultosAgregados + '" id="bltsEmpresa' + cantVsClientes + '" numTxtBultos="' + cantVsClientes + '" readOnly="readOnly"><input type="text"  class="form-control" value="' + pesoAgregado + '"  id="pesoEmpresa' + cantVsClientes + '" numTxtPeso="' + cantVsClientes + '" readOnly="readOnly"></div></div>');
                                    document.getElementById("cantVsClientes").value = cantVsClientes;

                                    document.getElementById("tipoBusqueda").value = '';
                                    document.getElementById("bultosAgregados").value = '';
                                    document.getElementById("pesoAgregado").value = '';
                                    document.getElementById("saldoIngN").innerHTML = respuesta["saldo"];
                                    $(".close").click();

                                }
                            });
                        }
                    },
                    error: function (respuesta) {
                        console.log(respuesta);
                    }
                })
            }
        } else {
            console.log("no se puede guardar porque no existe un campo erroneo");
        }
    } else {
        swal({
            type: "error",
            title: "Sobregiro",
            text: "La operación realizada sobregira el stock en bultos o peso, por favor revise",
            showConfirmButton: true,
            confirmButtonText: "cerrar",
            closeConfirm: true
        });
    }
})

$(document).on("click", ".btnBuscaCons", async function () {
    var nitNewCons = document.getElementById("textParamBusqCons").value;
    var nomVar = "consultaEmpresa";
    var resp = await revisarVehUsados(nomVar, nitNewCons);
    if (resp != "SD") {


        var nitEmpresa = resp[0].nitEmpresa;
        var nombreEmpresa = resp[0].nombreEmpresa;
        var direccionEmpresa = resp[0].direccionEmpresa;

        var idNitEmp = resp[0].idNitEmp;

        document.getElementById("empresaElegiConso").innerHTML =
                `
                                        <label>
                                            Datos del Cliente
                                        </label>
                                        <address>
                                            <b>
                                                Nit:
                                            </b>
                                            <label id="lblNit" style="font-weight: normal;">` + nitEmpresa + `</label>
                                            <br />
                                            <b>
                                                Empresa:
                                            </b>
                                            <label id="lblEmpresa" style="font-weight: normal;">` + nombreEmpresa + `</label>
                                            <br />
                                            <b>
                                                Direccion:
                                            </b>
                                            <label id="lblDireccion" style="font-weight: normal;">` + direccionEmpresa + `</label>
                                            <br />
                                            <button type="button" class="btn btn-warning btn-block btnConsolidadoReg" idNit="` + idNitEmp + `">Guardar Nuevo Consolidado</button>
                                            <br />
                                        </address>

`;
    }
})

$(document).on("click", ".btnConsolidadoReg", async function () {
    var idnit = $(this).attr("idnit");
    Swal.fire({
        title: 'Quiere registrar nuevo Consolidado?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Poliza DR!'
    }).then(async function (result) {
        if (result.value) {
            var nomVar = "idNitConsolNew";
            var resp = await revisarVehUsados(nomVar, idnit);
            if (resp[0].resp == 1) {
                Swal.fire({
                    title: 'Nuevo consolidado registrado',
                    type: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok'
                }).then(async function (result) {
                    if (result.value) {
                        location.reload();
                    }
                })
            }
        }
    })
})


function cambiarServicio(val) {
    let resp;
    document.getElementById("txtNitEmpresa").value = val;
    $("#txtNitEmpresa").trigger('change');
    resp = true;
    return resp;
}

$(document).on("click", ".btnDuplicaCons", async function () {
    var estado = $(this).attr("estado");
    if (estado == 0) {
        $(this).removeClass("btn-warning");
        $(this).addClass("btn-danger");
        $(this).html("Duplicar Póliza Activa");
        $(this).attr("estado", 1);
    }
});

$(document).on("click", ".btnSEleccBodega", async function () {
    var idBod = $(this).attr("ident");
    var area = $(this).attr("area");
    Swal.fire({
        title: 'Seguro quiere cambiar la bodega para el ingreso?',
        showDenyButton: true,
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: `Si Cambiar`,
        denyButtonText: `No cambiar`,
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.value) {
            document.getElementById("idBodegEmpresa").innerHTML = area;
            document.getElementById("numBodIdent").value = idBod;
        }
    })

})

$(document).on("click", "#gDetalles", async function () {
    var idIngEliminar = $(this).attr("iding");
    console.log(idIngEliminar);
    document.getElementById("idIngManiElegido").value = idIngEliminar;
})

