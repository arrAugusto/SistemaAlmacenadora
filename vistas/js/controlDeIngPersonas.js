$(document).on("click", "#btnCapturarQRCtrPersonal", async function () {
    $(".swal2-input").focus();
    Swal.mixin({
        input: 'text',
        confirmButtonText: 'Siguiente &rarr;',
        progressSteps: ['1']
    }).queue([
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
            var barcodeLic = result.value[0];
            var answers = JSON.stringify(result.value);
            Swal.fire({
                title: 'Codigos Escaneados!',
                allowOutsideClick: false,
                type: 'success',
                text: 'Revise los datos del formulario',
                confirmButtonText: 'Ok!'
            })
            console.log(barcodeLic);
            console.log(barcodeLic.length);

            if (barcodeLic.length >= 85 && barcodeLic.length <= 120) {
                var cantidadLlaves = 0;
                for (var i = 0; i < barcodeLic.length; i++) {
                    if (barcodeLic.charAt(i) == ";") {
                        var cantidadLlaves = cantidadLlaves + 1;
                    }
                }
                var codeLic = barcodeLic.trim();
                var sin_salto = codeLic.split("\n").join("");
                var cadenaArray = sin_salto.split(";");
                console.log(cadenaArray);
                var dpi = cadenaArray[0];
                var dpi = dpi.trim();
                var dpiSub = dpi.substring(5, 14);
                var dpiSub1 = dpi.substring(15, 19);
                var licPilotoCodbar = dpiSub+dpiSub1;
                console.log(licPilotoCodbar);
                var nombre = cadenaArray[7];
                var apellido = cadenaArray[5];
                var upperStrNombre = nombre.toUpperCase().replace(/\d/g, "");
                
                var upperStrApellido = apellido.toUpperCase().replace(/\d/g, "");
                var nombrePiloto = upperStrNombre+' '+upperStrApellido;
                $("#datosDeVisitantes").append('<div class="input-group-prepend mt-4"><input type="text" class="form-control classNVistas" id="' + licPilotoCodbar + '" value="' + licPilotoCodbar + '" /><input type="text" class="form-control" id="nombre' + licPilotoCodbar + '" value="' + nombrePiloto + '" /></div>');
                
            }
            if (barcodeLic.length >= 121) {

                alert("licencia");

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
                    var nombrePiloto = nombrePiloto.toLocaleUpperCase();
                    $("#datosDeVisitantes").append('<div class="input-group-prepend mt-4"><input type="text" class="form-control classNVistas" id="' + licPilotoCodbar + '" value="' + licPilotoCodbar + '" /><input type="text" class="form-control" id="nombre' + licPilotoCodbar + '" value="' + nombrePiloto + '" /></div>');
                }
            }
        }
    })
})
$(document).on("click", ".gdVisitaExterna", async function () {
    var procedencia = document.getElementById("procedencia").value;
    var destino = document.getElementById("destino").value;
    var placa = document.getElementById("placa").value;

    var datosVisitantes = Array.from(document.querySelectorAll(".classNVistas"));
    listaVistantes = [];
    for (var i = 0; i < datosVisitantes.length; i++) {
        var idText = datosVisitantes[i].attributes[2].value;
        var licDpi = document.getElementById(idText).value;
        var nombre = document.getElementById("nombre" + idText).value;
        console.log(licDpi);
        console.log(nombre);
        listaVistantes.push([licDpi, nombre]);
    }
    var listaVistantes = JSON.stringify(listaVistantes);
    console.log(listaVistantes);
    $(".swal2-input").focus();
    Swal.mixin({
        input: 'text',
        confirmButtonText: 'Siguiente &rarr;',
        progressSteps: ['1']
    }).queue([

        {
            title: 'Numero de gafete',
            text: 'Escane o ingrese el numero de gafete',
            imageWidth: 400,
            imageHeight: 200,
            allowOutsideClick: false,
            imageAlt: 'Custom image',

        }
    ]).then(async function (result) {
        if (result.value) {
            var barcodeGafete = result.value[0];
            var respGDVisita = ajaxGuardarVisita(procedencia, destino, placa, listaVistantes, barcodeGafete);
            if (respGDVisita == "Exito") {

                Swal.fire({
                    title: 'Visita creada con éxito!',
                    text: 'Entrega el gafete No. ' + barcodeGafete,
                    type: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok!'
                }).then((result) => {
                    if (result.value) {
                        location.reload();
                    }
                })
            }

        }
    })
})
$(document).on("click", "#btnCapturarQRCtrPersonalDPI", async function () {
    $(".swal2-input").focus();
    Swal.mixin({
        input: 'text',
        confirmButtonText: 'Siguiente &rarr;',
        progressSteps: ['1']
    }).queue([
        {
            title: 'Datos DPI',
            text: 'Escaneé el codigo marcado con color rojo del dpi',
            imageUrl: 'vistas/img/plantilla/renapDPI.png',
            imageWidth: 400,
            imageHeight: 200,
            allowOutsideClick: false,
            imageAlt: 'Custom image',

        }
    ]).then(async function (result) {
        if (result.value) {
            var barcodeLic = result.value[0];
            var answers = JSON.stringify(result.value);
            Swal.fire({
                title: 'Codigos Escaneados!',
                allowOutsideClick: false,
                type: 'success',
                text: 'Revise los datos del formulario',
                confirmButtonText: 'Ok!'
            })
            console.log(barcodeLic);
            console.log(barcodeLic.length);

            if (barcodeLic.length >= 85 && barcodeLic.length <= 120) {
                var cantidadLlaves = 0;
                for (var i = 0; i < barcodeLic.length; i++) {
                    if (barcodeLic.charAt(i) == ";") {
                        var cantidadLlaves = cantidadLlaves + 1;
                    }
                }
                var codeLic = barcodeLic.trim();
                var sin_salto = codeLic.split("\n").join("");
                var cadenaArray = sin_salto.split(";");
                console.log(cadenaArray);
                var dpi = cadenaArray[0];
                var dpi = dpi.trim();
                var dpiSub = dpi.substring(5, 14);
                var dpiSub1 = dpi.substring(15, 19);
                var licPilotoCodbar = dpiSub+dpiSub1;
                console.log(licPilotoCodbar);
                var nombre = cadenaArray[7];
                var apellido = cadenaArray[5];
                var upperStrNombre = nombre.toUpperCase().replace(/\d/g, "");
                
                var upperStrApellido = apellido.toUpperCase().replace(/\d/g, "");
                var nombrePiloto = upperStrNombre+' '+upperStrApellido;
                $("#datosDeVisitantes").append('<div class="input-group-prepend mt-4"><input type="text" class="form-control classNVistas" id="' + licPilotoCodbar + '" value="' + licPilotoCodbar + '" /><input type="text" class="form-control" id="nombre' + licPilotoCodbar + '" value="' + nombrePiloto + '" /></div>');
                
            }
            if (barcodeLic.length >= 121) {

                alert("licencia");

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
                    var nombrePiloto = nombrePiloto.toLocaleUpperCase();
                    $("#datosDeVisitantes").append('<div class="input-group-prepend mt-4"><input type="text" class="form-control classNVistas" id="' + licPilotoCodbar + '" value="' + licPilotoCodbar + '" /><input type="text" class="form-control" id="nombre' + licPilotoCodbar + '" value="' + nombrePiloto + '" /></div>');
                }
            }
        }
    })
})

function ajaxGuardarVisita(procedencia, destino, placa, listaVistantes, barcodeGafete) {
    let respFunc;
    var datos = new FormData();
    datos.append("procedencia", procedencia);
    datos.append("destino", destino);
    datos.append("placaVisita", placa);
    datos.append("listaVisitas", listaVistantes);
    datos.append("gafete", barcodeGafete);
    $.ajax({
        async: false,
        url: "ajax/controlDeIngPersonas.ajax.php",
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
