//CARGAR DATATABLE HISTORIAL DE INGRESOS FISCALES CON DATOS JSON
$(document).ready(function () {
    if ($("#tbCuadreKardexMerca").length >= 1) {
        $.ajax({
            url: "ajax/cuadreKardex.ajax.php",
            "bServerSide": true,
            success: function (respuesta) {
                console.log(respuesta);
            }

        })
    }
})

$(document).ready(function () {
    if ($("#tbCuadreKardexMerca").length >= 1) {
        $('#tbCuadreKardexMerca').DataTable({
            "bProcessing": true,
            "sAjaxSource": "ajax/cuadreKardex.ajax.php",
            "deferRender": true,
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

            }
        });
    }
});

$(document).on("click", ".faPlusData", async function () {

    var verDataPoliza = await dataPoliza('3220716996');
    document.getElementById("cardCuadre").innerHTML = `
<div class="row">
    <div class="col-5 mt-1">
        <label>Numero Poliza</label>    
        <input type="text" class="form-control is-valid" id="polizaRet" value="" readOnly="readOnly" />
        <input type="hidden" id="identRet" value="" />
    </div>

    <div class="col-3 mt-1">
        <label>Pól Ret</label>    
        <input type="text" class="form-control is-valid" id="regimenSalida" value="" readOnly="readOnly" />
    </div>
    <div class="col-4 mt-1">
        <label>Blts</label>    
        <input type="text" class="form-control is-valid" id="bultos" value="" readOnly="readOnly" />
    </div>
    <div class="col-6 mt-1">
        <label>Val Cif</label>    
        <input type="text" class="form-control is-valid" id="cif" value="" readOnly="readOnly" />
    </div>
    <div class="col-6 mt-1">
        <label>Val Impuestos</label>    
        <input type="text" class="form-control is-valid" id="impuestos" value="" readOnly="readOnly" />
    </div>

    <div class="col-6 mt-1">
        <label>Pól Ing</label>    
        <input type="text" class="form-control is-valid" id="numeroPoliza" value="" readOnly="readOnly" />
    </div>
    <div class="col-6 mt-1">
        <label>Emitido</label>    
        <input type="text" class="form-control is-valid" id="nombres" value="" readOnly="readOnly" />
    </div>
    <div class="col-6 mt-1">
        <label>Emisión</label>    
        <input type="text" class="form-control is-valid" id="fechaEmision" value="" readOnly="readOnly" />
    </div>
    <div class="col-6 mt-1">
        <label>Nit </label>    
        <input type="text" class="form-control is-valid" id="nitEmpresa" value="" readOnly="readOnly" />
    </div>
    <div class="col-12 mt-1">
        <label>Nombre Empresa</label>    
        <input type="text" class="form-control is-valid" id="nombreEmpresa" value="" readOnly="readOnly" />
    </div>
    <div class="col-12 mt-3 divDetalleSelect">
        
    </div>    
    <div class="col-12 mt-3">
        <div class="btn-group btn-block">
            <button type="button" class="btn btn-outline-primary btn-sm" id="btnReimprimeRec" idret=` + verDataPoliza[0].identRet + `>Rec.</button>
            <button type="button" class="btn btn-outline-info btn-sm" id="btnReimprimeRet" idret=` + verDataPoliza[0].identRet + `>Ret.</button>
        </div>
    </div>

</div>            
`;

    console.log(verDataPoliza);
    document.getElementById("polizaRet").value = verDataPoliza[0].polizaRetiro;
    document.getElementById("regimenSalida").value = verDataPoliza[0].regimenSalida;
    document.getElementById("bultos").value = verDataPoliza[0].bultos;
    document.getElementById("numeroPoliza").value = verDataPoliza[0].numeroPoliza;
    document.getElementById("nombres").value = verDataPoliza[0].nombres;
    document.getElementById("fechaEmision").value = verDataPoliza[0].fechaEmision;
    document.getElementById("nitEmpresa").value = verDataPoliza[0].nitEmpresa;
    document.getElementById("nombreEmpresa").value = verDataPoliza[0].nombreEmpresa;

    document.getElementById("cif").value = verDataPoliza[0].totalValorCif;
    document.getElementById("impuestos").value = verDataPoliza[0].valorImpuesto;
    document.getElementById("identRet").value = verDataPoliza[0].identRet;

    /*
     const {value: text} = await Swal.fire({
     input: 'textarea',
     imageUrl: 'vistas/img/plantilla/ejemploPoliza.png',
     imageWidth: 400,
     showCancelButton: true,
     allowOutsideClick: false,
     imageHeight: 200,
     imageAlt: 'Custom image',
     inputLabel: 'textQR',
     inputPlaceholder: 'Escanea el Quick response ("QR)"',
     inputAttributes: {
     'aria-label': 'Escanea el Quick response ("QR)"'
     },
     showCancelButton: true
     })
     
     if (text) {
     var resp = await qrBarcodePol(text);
     var data = JSON.stringify(resp);
     if (resp != "SD") {
     localStorage.setItem("listaCuadreKardex", data);
     var verDataPoliza = await dataPoliza(resp[0][2]);
     document.getElementById("cardCuadre").innerHTML = `
     <div class="row">
     <div class="col-6">
     <label>Numero Poliza</label>    
     <input type="text" class="form-control is-valid" value="` + resp[0][2] + `" readOnly="readOnly" />
     </div>
     <div class="col-6">
     <label>Numero Poliza</label>    
     <input type="text" class="form-control is-valid" value="` + resp[0][2] + `" readOnly="readOnly" />
     </div>
     </div>            
     `;
     
     }
     
     }*/
});

function qrBarcodePol(barcodePolizaIng) {
    let lista = [];
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
    } else {
        return "SD";
    }
    lista.push([nitTrim, duca, polizaIng, peso, valDolares, tipoCambio, impuestos]);
    return lista;
}

function dataPoliza(poliza) {
    let respFunc;
    var datos = new FormData();
    datos.append("polizaData", poliza);
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

            respFunc = respuesta;
        }, error: function (respuesta) {
            console.log(respuesta);
            respFunc = respuesta;
        }})
    return respFunc;
}

$(document).on("click", ".faRevision", async function () {
    var idDetalle = $(this).attr("idDetalle");
    var idRet = document.getElementById("identRet").value;
    const {value: text} = await Swal.fire({
        input: 'text',
        imageWidth: 400,
        showCancelButton: true,
        allowOutsideClick: false,
        imageHeight: 200,
        imageAlt: 'Custom image',
        inputLabel: 'textQR',
        inputPlaceholder: 'Ingrese cantidad de bultos',
        inputAttributes: {
            'aria-label': 'Ingrese cantidad de bultos'
        },
        showCancelButton: true
    })
    if (text) {
        var bultos = parseInt(text);
        if (bultos > 0) {


            $(".divDetalleSelect").append(
                    `
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <button type="button" class="btn btn-danger" id="buttonTrash" idDetalle=` + idDetalle + `><i class="fa fa-trash"></i></button>
                    </div>
                        <!-- /btn-group -->
                        <input type="text" class="form-control" id="texToEmpresaVal" value="AGENCIA DE VEHICULOS KENWORTH DE CENTROAMERICA, S.A." readonly="readOnly">
                        <input type="number" class="form-control" id="revDetalleBlts" value=` + bultos + `>
                </div>
                `);


            var buttonTrash = Array.from(document.querySelectorAll("#buttonTrash"));
            var paragraphsBultos = Array.from(document.querySelectorAll("#revDetalleBlts"));
            console.log(buttonTrash);
            var totalBultos = 0;
            var listaVehiculos = [];
            for (var i = 0; i < paragraphsBultos.length; i++) {
                var bultosRev = paragraphsBultos[i].attributes[3].value;
                var idDet = buttonTrash[i].attributes[3].value;

                var parseBlts = parseInt(bultosRev);
                var totalBultos = totalBultos + parseBlts;
                listaVehiculos.push([idRet, idDet, bultosRev]);

            }
            var bltsIng = document.getElementById("bultos").value;
            var bltsIng = parseInt(bltsIng);
            if (totalBultos > bltsIng) {
                Swal.fire({
                    title: 'Cantidad de bultos no cuadra',
                    text: "La cantidad de bultos ingresados, es mayor a lo que se declaro en el retiro!",
                    type: 'error',
                    allowOutsideClick: false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok!'
                }).then((result) => {
                    if (result.value) {
                        return false;
                    }
                })

            }
            console.log(bultos);
            console.log(bltsIng);

            if (totalBultos < bltsIng) {
                Swal.fire({
                    title: 'Cantidad de bultos',
                    text: "La cantidad de bultos ingresados, es menor a lo que se declaro en el retiro!",
                    type: 'warning',
                    allowOutsideClick: false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok!'
                }).then((result) => {
                    if (result.value) {
                        return false;
                    }
                })

            }
            if (totalBultos == bltsIng) {
                console.log(listaVehiculos);
                var listaVehiculos = JSON.stringify(listaVehiculos);
                var resp = await revisionDeRetiroAndPol(listaVehiculos);
                if (resp==false) {
                Swal.fire({
                    title: 'Detalle Erróneo',
                    text: "El detalle que seleccionaste es erroneo o la cantidad de bultos no coincide aún!",
                    type: 'error',
                    allowOutsideClick: false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok!'
                }).then((result) => {
                    if (result.value) {
                        return false;
                    }
                })                    
                    $(".validacionKardex").html('<i class="fa fa-times-circle" style="font-size: 75px; color: red;"></i>');
                    return false;
                }
                if (resp[0].resp==1) {
                Swal.fire({
                    title: 'Transacción exitosa',
                    text: "La póliza cuadra en el sistema puede continuar.!",
                    type: 'success',
                    allowOutsideClick: false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok!'
                }).then((result) => {
                    if (result.value) {
                        return false;
                    }
                })                         
                    $(".validacionKardex").html('<i class="fa fa-check-circle" style="font-size: 75px; color: green;"></i>');
                    return true;
                    
                }
            }


        }
    }
})

function revisionDeRetiroAndPol(listaVehiculos) {
    let respFunc;
    var datos = new FormData();
    datos.append("objRevPol", listaVehiculos);
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

            respFunc = respuesta;
        }, error: function (respuesta) {
            console.log(respuesta);
            respFunc = respuesta;
        }})
    return respFunc;
}


//CARGAR DATATABLE HISTORIAL DE INGRESOS FISCALES CON DATOS JSON
$(document).ready(function () {

    if ($("#tbCuadreKardexVeh").length >= 1) {
        $.ajax({
            url: "ajax/cuadreKardexVeh.ajax.php",
            "bServerSide": true,
            success: function (respuesta) {
                console.log(respuesta);
            }

        })
    }
})

$(document).ready(function () {
    if ($("#tbCuadreKardexVeh").length >= 1) {
        $('#tbCuadreKardexVeh').DataTable({
            "bProcessing": true,
            "sAjaxSource": "ajax/cuadreKardexVeh.ajax.php",
            "deferRender": true,
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

            }
        });
    }
});

$(document).on("click", ".faRevisionVeh", async function () {
    var idDetalle = $(this).attr("idDetalle");
    var idRet = document.getElementById("identRet").value;
    const {value: text} = await Swal.fire({
        input: 'text',
        imageWidth: 400,
        showCancelButton: true,
        allowOutsideClick: false,
        imageHeight: 200,
        imageAlt: 'Custom image',
        inputLabel: 'textQR',
        inputPlaceholder: 'Ingrese cantidad de bultos',
        inputAttributes: {
            'aria-label': 'Ingrese cantidad de bultos'
        },
        showCancelButton: true
    })
    if (text) {
        var bultos = parseInt(text);
        if (bultos > 0) {


            $(".divDetalleSelect").append(
                    `
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <button type="button" class="btn btn-danger" id="buttonTrash" idDetalle=` + idDetalle + `><i class="fa fa-trash"></i></button>
                    </div>
                        <!-- /btn-group -->
                        <input type="text" class="form-control" id="texToEmpresaVal" value="AGENCIA DE VEHICULOS KENWORTH DE CENTROAMERICA, S.A." readonly="readOnly">
                        <input type="number" class="form-control" id="revDetalleBlts" value=` + bultos + `>
                </div>
                `);


            var buttonTrash = Array.from(document.querySelectorAll("#buttonTrash"));
            var paragraphsBultos = Array.from(document.querySelectorAll("#revDetalleBlts"));
            console.log(buttonTrash);
            var totalBultos = 0;
            var listaVehiculos = [];
            for (var i = 0; i < paragraphsBultos.length; i++) {
                var bultosRev = paragraphsBultos[i].attributes[3].value;
                var idDet = buttonTrash[i].attributes[3].value;

                var parseBlts = parseInt(bultosRev);
                var totalBultos = totalBultos + parseBlts;
                listaVehiculos.push([idRet, idDet, bultosRev]);

            }
            var bltsIng = document.getElementById("bultos").value;
            var bltsIng = parseInt(bltsIng);
            if (totalBultos > bltsIng) {
                Swal.fire({
                    title: 'Cantidad de bultos no cuadra',
                    text: "La cantidad de bultos ingresados, es mayor a lo que se declaro en el retiro!",
                    type: 'error',
                    allowOutsideClick: false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok!'
                }).then((result) => {
                    if (result.value) {
                        return false;
                    }
                })

            }
            console.log(bultos);
            console.log(bltsIng);

            if (totalBultos < bltsIng) {
                Swal.fire({
                    title: 'Cantidad de bultos',
                    text: "La cantidad de bultos ingresados, es menor a lo que se declaro en el retiro!",
                    type: 'warning',
                    allowOutsideClick: false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok!'
                }).then((result) => {
                    if (result.value) {
                        return false;
                    }
                })

            }
            if (totalBultos == bltsIng) {
                console.log(listaVehiculos);
                var listaVehiculos = JSON.stringify(listaVehiculos);
                var resp = await revisionDeRetiroAndPol(listaVehiculos);
                if (resp==false) {
                Swal.fire({
                    title: 'Detalle Erróneo',
                    text: "El detalle que seleccionaste es erroneo o la cantidad de bultos no coincide aún!",
                    type: 'error',
                    allowOutsideClick: false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok!'
                }).then((result) => {
                    if (result.value) {
                        return false;
                    }
                })                    
                    $(".validacionKardex").html('<i class="fa fa-times-circle" style="font-size: 75px; color: red;"></i>');
                    return false;
                }
                if (resp[0].resp==1) {
                Swal.fire({
                    title: 'Transacción exitosa',
                    text: "La póliza cuadra en el sistema puede continuar.!",
                    type: 'success',
                    allowOutsideClick: false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok!'
                }).then((result) => {
                    if (result.value) {
                        return false;
                    }
                })                         
                    $(".validacionKardex").html('<i class="fa fa-check-circle" style="font-size: 75px; color: green;"></i>');
                    return true;
                    
                }
            }


        }
    }
})

