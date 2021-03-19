$(document).on("click", ".btnAgregarDetalles", function () {
    var tipoIng = $(this).attr("tipoing");
    var hiddenIngV = '<input type="hidden" id="hiddenTipoIng" value="' + tipoIng + '" />';
    var numeroIdIng = $(this).attr("numeroOrden");
    var numeroButton = $(this).attr("numeroButton");
    var numeroCliente = $(this).attr("cliente");
    var numeroorden = $(this).attr("numeroorden");
    var lblEmpresa = "lblEmpresa" + numeroButton;
    var lblNit = "lblNit" + numeroButton;
    var lblPoliza = "lblPoliza" + numeroButton;
    var lblBultos = "lblBultos" + numeroButton;
    var lblcliente = "cliente" + numeroButton;
    var empresa = document.getElementById(lblEmpresa).innerHTML;
    var nit = document.getElementById(lblNit).innerHTML;
    var poliza = document.getElementById(lblPoliza).innerHTML;
    var bultos = document.getElementById(lblBultos).innerHTML;
    if (tipoIng != "VEHICULOS NUEVOS") {
        var css = "display: block;";
        document.getElementById("divMontarguist").setAttribute("style", css);
    }
    document.getElementById("agregarDetalles").innerHTML = '<div class="alert alert-primary">' + hiddenIngV + '<input type="hidden" id="cliente" name="cliente" value="' + numeroCliente + '"><input type="hidden" id="idOrdenIng" name="idOrdenIng" value="' + numeroorden + '"><input type="hidden" id="numeroIdIng" name="numeroIdIng" value="' + numeroIdIng + '"><label id="lblEmpresaGuardar"><b>Empresa : </b> <strong>' + empresa + '</strong></label><br><label id="lblPolizaGuardar">Nit : ' + nit + '</label><br><label id="lblBultosGuardar">Bultos : ' + bultos + '</label><br><label id="lblPolizaGuardar">Poliza : ' + poliza + '</label><br><button type="button" class="btn btn-primary btnVerDetalles" id="btnDetallesMerca" estado=0 data-toggle="modal" data-target="#agrDetalles">Agregar Detalles</button></div>';
    document.getElementById("divDetallesMerca").innerHTML = ` 
                <div class="card card-danger card-outline">
                    <div class="card-body">
                        <div class="row">
                                <div class="col-md-3 col-sm-6 col-12" id="montacargas">
                            </div>
                        <div class="col-12" id="divContenidoDetalle">
                        </div>
                    </div>
                </div>
            </div>`;
});
$(document).on("click", ".btnVerDetalles", async function () {
    var tipoIng = document.getElementById("hiddenTipoIng").value;
    if (tipoIng != "VEHICULOS NUEVOS" && tipoIng != "vehiculoUsado") {
        $("#selectUbicacion").empty();
        var prom = 0;
        if ("promedioTarima" in localStorage) {
            var promedioLocal = localStorage.getItem("promedioTarima");
            ;
            var prom = 1;
        }
        var promedioPorTarima = document.getElementById("proTarima").value;
        console.log(promedioPorTarima);
        if (prom == 0) {
            Swal.fire({
                title: "Promedio por tarima",
                text: "Configure el promedio en tarima y guarde antes de finalizar la operación",
                type: "error",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if (result.value) {
                    $(".btnPromedioTarima").removeClass("btn-info");
                    $(".btnPromedioTarima").addClass("btn-danger");
                    document.getElementById("btnPromedioTarima").focus();
                }
            })
        } else {
            Swal.fire({
                title: "Promedio de tarima anterior " + promedioLocal + " MTS",
                type: "success",
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar',
                allowOutsideClick: false

            }).then((result) => {
                if (result.value) {
                    if ($("#hiddenTipoIng").length >= 1) {
                        var tipoIng = document.getElementById("hiddenTipoIng").value;
                        document.getElementById("proTarima").value = promedioLocal;
                        if (tipoIng == "VEHICULOS NUEVOS") {
                            document.getElementById("datoEmpresa").innerHTML = "";
                            document.getElementById("datoBltsEmp").innerHTML = "";
                            document.getElementById("datoPesoEmp").innerHTML = "";
                            document.getElementById("mdStandarTarima").innerHTML = "";
                            document.getElementById("newTxtBtn").innerHTML = '';
                            document.getElementById("newTxtBtn").innerHTML = '';
                            document.getElementById("divUbicacionMerc").innerHTML = "";
                            document.getElementById("divObserva").innerHTML = "";
                            $("#divUbicacionMerc").removeClass("col-4");
                            $("#divUbicacionMerc").addClass("col-6");
                            document.getElementById("divUbicacionMerc").innerHTML = `
                                                         <div class="form-group has-error" id="selectSucces">
                                                                <label>Ubicación de Vehiculos</label>
                                                                <select  class="select2" style="width: 100%;" id="vehiculosUbicaN">
                                                                    <option selected="selected" disabled="disabled">Seleccione predio</option>   
                                                                </select>
                                                            </div>`;
                            document.getElementById("divObserva").innerHTML = `

                                                <div class="card-footer">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div id="divAcciones">
                                                                <button type="button" class="btn btn-primary btn-block btnGdChasVehN">Registrar Vehículos Seleccionados</button>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                </div>
                                            `;
                            $('#vehiculosUbicaN').select2();
                        }
                    }
                } else {
                    $(".btnPromedioTarima").removeClass("btn-info");
                    $(".btnPromedioTarima").addClass("btn-danger");
                    document.getElementById("btnPromedioTarima").focus();
                }

            })
        }
        var estado = $(this).attr("estado");
        if (estado == 0) {

            if ($("#cantidadPosiciones").length > 0) {


                document.getElementById("cantidadPosiciones").innerHTML = "";
                document.getElementById("Metraje").innerHTML = "";


                $(".btnVerDetalles").attr("estado", 1);
            }
        } else if (estado == 1) {
            if ($("#hiddenTipoIng").length == 0) {
                document.getElementById("cantidadPosiciones").innerHTML = "";
                document.getElementById("Metraje").innerHTML = "";
            }
        }

    } else {
        if ($("#hiddenTipoIng").length >= 1) {

            if (tipoIng == "vehiculoUsado") {
                document.getElementById("newTxtBtn").innerHTML = `
                <input type="number" id="cantidadPosicionesVeh" name="cantidadPosiciones" class="form-control" placeholder="Cantidad de posiciones" style="text-align: center;" value="" />
                                                                <input type="number" id="MetrajeVeh" name="Metraje" class="form-control" placeholder="Cantidad de Metros" style="text-align: center;" value="" />
                                                                <div class="input-group-append">
                                                                    <button type="button" estadoBoton=0 id="GuardarIngBod" idIngresoPB=0 idDetalle=0 class="btn btn-primary btnADetalle">Aceptar</button>
                                                                </div>
                                                                <!-- /btn-group -->
                `;
                if ($("#proTarima").length>0){
                    document.getElementById("proTarima").value = 1.3;
                    document.getElementById("proTarima").readOnly = true; 
                }
                if ($("#btnPromedioTarima").length>0){
                    document.getElementById("btnPromedioTarima").remove();

                }
                if ($("#cantidadPosicionesVeh".length > 0)) {
                    document.getElementById("cantidadPosicionesVeh").readOnly = true;

                }
                document.getElementById("chasisVeh").innerHTML = '<button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#modalCarousel">Detalles Vehiculos <i class="fa fa-briefcase"></i></button>';
            }
            if (tipoIng == "VEHICULOS NUEVOS") {
                var tipoIng = document.getElementById("hiddenTipoIng").value;
                document.getElementById("datoEmpresa").innerHTML = "";
                document.getElementById("datoBltsEmp").innerHTML = "";
                document.getElementById("datoPesoEmp").innerHTML = "";
                document.getElementById("mdStandarTarima").innerHTML = "";
                document.getElementById("newTxtBtn").innerHTML = '';
                document.getElementById("newTxtBtn").innerHTML = '';
                document.getElementById("divUbicacionMerc").innerHTML = "";
                document.getElementById("divObserva").innerHTML = "";
                $("#divUbicacionMerc").removeClass("col-4");
                $("#divUbicacionMerc").addClass("col-6");
                document.getElementById("divUbicacionMerc").innerHTML = `
                                                         <div class="form-group has-error" id="selectSucces">
                                                                <label>Ubicación de Vehiculos</label>
                                                                <select  class="select2" style="width: 100%;" id="vehiculosUbicaN">
                                                                    <option selected="selected" disabled="disabled">Seleccione predio</option>   
                                                                </select>
                                                            </div>`;
                document.getElementById("divObserva").innerHTML = `

                                                <div class="card-footer">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div id="divAcciones">
                                                                <button type="button" class="btn btn-primary btn-block btnGdChasVehN">Registrar Vehículos Seleccionados</button>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                </div>
                                            `;
                $('#vehiculosUbicaN').select2();


            }
        }
    }

    var indexValue = document.getElementById("personaSeleccionada").value;
    if (tipoIng == "VEHICULOS NUEVOS" || tipoIng == "vehiculoUsado") {
        indexValue = 1;
    }
    if (indexValue >= 1) {
        document.getElementById("tableMercaderia").innerHTML = '';
        document.getElementById("tableMercaderia").innerHTML = '<table id="tableDetallesMerca" class="table table-hover table-sm"></table>';
        var numeroIdIng = document.getElementById("numeroIdIng").value;
        console.log(numeroIdIng);
        var datos = new FormData();
        datos.append("numeroIdIng", numeroIdIng);
        $.ajax({
            url: "ajax/registroIngresoBodega.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (respuesta) {
                console.log(respuesta);
                var tipoPos = 0;
                if (tipoIng != "VEHICULOS NUEVOS") {
                    var tipoPos = 1;
                }
                if (tipoIng != "vehiculoUsado") {
                    var tipoPos = 1;
                }
                if (tipoIng == 0) {
                    if ($("#hiddenTipoIng").length == 0) {
                        document.getElementById("descripcionMerca").innerHTML = "OBSERVACIONES :";
                        document.getElementById("Metraje").value = "";
                        document.getElementById("divTarPrivarMts").value = "";
                        document.getElementById("divTarPrivar").innerHTML = "";
                        document.getElementById("Metraje").innerHTML = "";
                    }
                    var base = respuesta[0].base;
                    if (base == "Posiciones") {
                        document.getElementById("Metraje").readOnly = false;
                        document.getElementById("cantidadPosiciones").readOnly = false;
                        document.getElementById("divTarPrivar").innerHTML = `<label id="lblTipoServ">Ingrese :` + base + `</label>`;
                        document.getElementById("Metraje").readOnly = true;
                        document.getElementById("cantidadPosiciones").value = "";
                        document.getElementById("Metraje").value = "";
                        $("#cantidadPosiciones").attr("estado", 1);
                    } else if (base == "Metros²" || base == "Metros³") {
                        document.getElementById("Metraje").readOnly = false;
                        document.getElementById("cantidadPosiciones").readOnly = false;
                        document.getElementById("divTarPrivarMts").innerHTML = `<label id="lblTipoServ">Ingrese :` + base + `</label>`;
                        document.getElementById("cantidadPosiciones").readOnly = true;
                        document.getElementById("Metraje").value = "";
                        document.getElementById("cantidadPosiciones").value = "";
                        $("#Metraje").attr("estado", 1);
                    } else {
                        if ($("#hiddenTipoIng").length == 0) {
                            document.getElementById("Metraje").readOnly = false;
                            document.getElementById("cantidadPosiciones").readOnly = false;
                            document.getElementById("divTarPrivar").innerHTML = `<label id="lblTipoServ">Ingrese : Posiciones</label>`;
                            document.getElementById("Metraje").readOnly = true;
                            document.getElementById("cantidadPosiciones").value = "";
                            document.getElementById("Metraje").value = "";
                            $("#cantidadPosiciones").attr("estado", 1);
                        }
                    }
                }
                if (respuesta[0] != "UpdateHis") {

                    var lista = [];
                    var numero = 0;
                    if (tipoIng != "VEHICULOS NUEVOS" && tipoIng != "vehiculoUsado") {

                        for (var i = 0; i < respuesta[0].length; i++) {
                            var numero = numero + 1;
                            var numeroLabel = '<label>' + numero + '</label>'
                            var empresa = '<label>' + respuesta[0][i]["empresa"] + '</label>';
                            var bultos = '<label>' + respuesta[0][i]["bultos"] + '</label>';
                            var peso = '<label>' + respuesta[0][i]["peso"] + '</label>';
                            var acciones = '<div class="btn-group"><button type="button" class="btn btn-success btnUsarFila btn-sm" buttonUsarId=' + respuesta[0][i]["id"] + '><i class="fa fa-thumbs-up">&nbsp;&nbsp;Seleccionar</i></button></div>';

                            lista.push([numeroLabel, empresa, bultos, peso, acciones]);
                        }
                        /**
                         *BUSCANDO TODAS LAS AREAS DE BODEGA 
                         ***/
                        var nomVar = "idBodAreasBod";
                        var idBod = true;
                        var resp = funcionRevVehUsados(nomVar, idBod);
                        $("#selectUbicacion ").append('<option selected="selected">Selecione Ubicación</option>');
                        for (var i = 0; i < resp.length; i++) {
                            console.log(resp[i]);
                            $("#selectUbicacion ").append('<option value=' + resp[i].id + ' readOnly="reaondly">' + resp[i].nombreArea + '</option>');

                        }
                    } else {
                        for (var i = 0; i < respuesta[0].length; i++) {

                            var numero = numero + 1;
                            var numeroLabel = '<label>' + numero + '</label>'
                            var empresa = '<label>' + respuesta[0][i]["empresa"] + '</label>';
                            var bultos = '<label>' + respuesta[0][i]["bultos"] + '</label>';
                            var peso = '<label>' + respuesta[0][i]["peso"] + '</label>';
                            if (tipoIng == "VEHICULOS NUEVOS") {
                                var acciones = '<div class="btn-group"><button type="button" class="btn btn-success btnMsVehiculos btn-sm" idIngVehiculosN=' + numeroIdIng + '><i class="fa fa-thumbs-up">&nbsp;&nbsp;Mostrar Vehículos</i></button></div>';
                            } else {
                                var acciones = '<div class="btn-group"><button type="button" class="btn btn-success btnUsarFila btn-sm" buttonUsarId=' + respuesta[0][i]["id"] + '><i class="fa fa-thumbs-up">&nbsp;&nbsp;Seleccionar</i></button></div>';

                            }

                            lista.push([numeroLabel, empresa, bultos, peso, acciones]);
                        }
                    }
                    $('#tableDetallesMerca').DataTable({
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
                            title: "Empresa"
                        }, {
                            title: "Bultos"
                        }, {
                            title: "Peso"
                        }, {
                            title: "Accciones"
                        }]
                    });
                }
            },
            error: function (respuesta) {
                console.log(respuesta);
            }
        })
    }

});
$(document).on("click", ".btnUsarFila", async function () {
    var idUsarFila = $(this).attr("buttonusarid");
    var nomVar = "verIdDetVehUsados";
    var resp = await funcionRevVehUsados(nomVar, idUsarFila);
    if (resp[0].vehiUSado >= 1) {
        var select = document.getElementById("selectUbicacion");
        var length = select.options.length;
        for (var i = 0; i < length + 1; i++) {
            select.remove(i);
        }
        select.remove(0);
        var nomVar = "prediosVehUsados";
        var respPredios = await funcionRevVehUsados(nomVar, idUsarFila);
        $("#selectUbicacion").append('<option selected="selected" disabled="disabled">Seleccione Ubicación</option>');
        for (var i = 0; i < respPredios.length; i++) {
            $("#selectUbicacion").append('<option value=' + respPredios[i].id + '> Vehiculo Usado   Predio ' + respPredios[i].numeroIdentidad + '</option>');
        }

    }
    var datos = new FormData();
    datos.append("idUsarFila", idUsarFila);
    $.ajax({
        async: false,
        url: "ajax/registroIngresoBodega.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            if (respuesta != "SD") {
                $('#GuardarIngBod').attr('idDetalle', idUsarFila);
                document.getElementById("nombreEmpresa").value = respuesta[0]["empresa"];
                document.getElementById("cantidadBultos").value = respuesta[0]["bultos"];
                document.getElementById("pesoKg").value = respuesta[0]["peso"];
                document.getElementById("nombreEmpresa").disabled = true;
                document.getElementById("cantidadBultos").disabled = true;
                document.getElementById("pesoKg").disabled = true;
                Swal.fire({
                    type: 'success',
                    title: 'Empresa seleccionada ',
                    text: respuesta[0]["empresa"] + ', Agregue ubicación, detalle, metros o ubicaciones. ',
                })

            }
        },
        error: function (respuesta) {
            console.log(respuesta);
        }
    });
});

function funcionRevVehUsados(nomVar, idDetalle) {
    let respEdicion;
    var datos = new FormData();
    datos.append(nomVar, idDetalle);
    $.ajax({
        async: false,
        url: "ajax/registroIngresoBodega.ajax.php",
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
        }
    });
    return respEdicion;
}


$(document).on("click", ".btnPaseDeSalidaVacio", function () {
    var valUnidad = $(this).attr("idUnidad");
    var datos = new FormData();
    datos.append("valUnidad", valUnidad);
    $.ajax({
        url: "ajax/registroIngresoBodega.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta)
            if (respuesta == "creado") {

                swal({
                    title: "Pase de salida creado, exitosamente",
                    type: "success"
                }).then(okay => {
                    if (okay) {
                        window.open("extensiones/tcpdf/pdf/Pase-vacio-fiscal.php?unidad=" + valUnidad, "_blank");
                        location.reload();
                    }
                });
            }
        }, error: function (respuesta) {
            console.log(respuesta);
        }
    });
})



$(document).on("click", ".btnPromedioTarima", function () {
    var promedioTarima = document.getElementById("proTarima").value;
    /*Guardando los datos en el LocalStorage*/
    localStorage.setItem("promedioTarima", promedioTarima);
    $(this).removeClass("btn-danger");
    $(this).addClass("btn-info");
    swal({
        type: "success",
        title: "Promedio por tarima",
        text: "El nuevo promedio por tarima es de :  " + promedioTarima + " MT2",
        showConfirmButton: true,
        confrimButtonText: "cerrar",
        closeConfirm: true
    });
});
/*
 $(document).ready(function () {
 if (document.getElementById("proTarima")) {
 var promedioT = localStorage.getItem('promedioTarima');
 if (promedioT >= 0.01) {
 document.getElementById("proTarima").value = promedioT;
 swal({
 type: "success",
 title: "Promedio por tarima",
 text: "El promedio establecido anteriomente, fue de " + promedioT + " MT2",
 showConfirmButton: true,
 confrimButtonText: "cerrar",
 closeConfirm: true
 });
 } else {
 swal({
 type: "warning",
 title: "Promedio por tarima",
 text: "Actualmente no se ha configurado, el promedio general por tarima.",
 showConfirmButton: true,
 confrimButtonText: "cerrar",
 closeConfirm: true
 });
 }
 }
 });
 */

 $(document).on("keyup", "#cantidadPosiciones", async function () {
    var cantPos = $(this).val();
    
    var respuesta = await CheckTextbox('cantidadPosiciones');
    if (respuesta) {



        var PromedioTarima = document.getElementById("proTarima").value;
        var funcCalculo = await validaCalculoPosMtsMerca(cantPos, PromedioTarima);
        console.log(funcCalculo);
    }

});

$(document).on("change", "#cantidadPosicionesVeh", async function () {
    var areabod = $(this).attr("areabod");
    console.log(areabod);
    var respuesta = await CheckTextboxPos('cantidadPosicionesVeh');
    console.log(respuesta);
    if (respuesta) {


        var cantPos = $("#cantidadPosicionesVeh").val();
        console.log(cantPos);
        var PromedioTarima = document.getElementById("proTarima").value;
        var funcCalculo = await validaCalculoPosMts(cantPos, PromedioTarima, areabod);
    }

});
/*
 $(document).on("keyup", "#proTarima", async function () {
 var PromedioTarima = $(this).val();
 if ($("#cantidadPosiciones").attr("estado") == 1) {
 var cantPos = $("#cantidadPosiciones").val();
 if (cantPos >= 0.001 && PromedioTarima >= 0.001) {
 var funcCalculo = await validaCalculoPosMts(cantPos, PromedioTarima);
 }
 
 } else if ($("#Metraje").attr("estado") == 1) {
 var cantMts = $("#Metraje").val();
 if (cantMts >= 0.001 && PromedioTarima >= 0.001) {
 var respMts = await validaCalculoMts(cantMts, PromedioTarima);
 }
 }
 
 })
 */

async function validaCalculoPosMts(cantPos, PromedioTarima, areabod) {
    var resNum = await patternPregNumEntero(cantPos);
    console.log(cantPos);
    console.log(resNum);
    if (cantPos >= 1) {


        if (resNum == 1) {
            var nuevoPos = cantPos;
        } else if (resNum <= 0) {
            var mensaje = "Cantidad de Posiciones, tiene que ser un número mayor a : 0 y de tipo entero";
            var tipo = "error";
            alertValNoAdm(mensaje, tipo);
            $(".Metraje" + areabod).val(metrosConvert);

            $(".cantidadPosiciones" + areabod).val("");
        }
        if (!isNaN(cantPos)) {
            if (cantPos >= 1) {
                if (PromedioTarima >= 0.001) {

                    var metrosConvert = Math.ceil(PromedioTarima * nuevoPos);
                    $(".Metraje" + areabod).val(metrosConvert);

                } else {
                    document.getElementById("proTarima").focus();
                    swal({
                        type: "warning",
                        title: "Promedio por tarima",
                        text: "Actualmente no se ha configurado, el promedio general por tarima, ingrese el promedio por tarima.",
                        showConfirmButton: true,
                        confrimButtonText: "cerrar",
                        closeConfirm: true
                    });
                }
            }
        }
    } else {
        var mensaje = "Cantidad de Posiciones, tiene que ser un número mayor a : 0 y de tipo entero";
        var tipo = "error";
        alertValNoAdm(mensaje, tipo);
        if ($("#MetrajeVeh").length>0){
            document.getElementById("MetrajeVeh").value = "";

        }
        if ($("#cantidadPosicionesVeh").length>0){

            document.getElementById("cantidadPosicionesVeh").value = "";

        }


    }
}
async function validaCalculoPosMtsMerca(cantPos, PromedioTarima, areabod) {
    var resNum = await patternPregNumEntero(cantPos);
    var btn = $(this);
    if (cantPos >= 1) {


        if (resNum == 1) {
            var nuevoPos = cantPos;
        } else if (resNum <= 0) {
            var mensaje = "Cantidad de Posiciones, tiene que ser un número mayor a : 0 y de tipo entero";
            var tipo = "error";
            alertValNoAdm(mensaje, tipo);
            btn.val(metrosConvert);

            btn.val("");
        }
        if (!isNaN(cantPos) && cantPos > 0) {
            
                if (PromedioTarima > 0) {

                    var metrosConvert = Math.ceil(PromedioTarima * nuevoPos);
                    btn.val(metrosConvert);

                } else {
                    document.getElementById("proTarima").focus();
                    swal({
                        type: "warning",
                        title: "Promedio por tarima",
                        text: "Actualmente no se ha configurado, el promedio general por tarima, ingrese el promedio por tarima.",
                        showConfirmButton: true,
                        confrimButtonText: "cerrar",
                        closeConfirm: true
                    });
                }
            
        }
    } else {
        var mensaje = "Cantidad de Posiciones, tiene que ser un número mayor a : 0 y de tipo entero";
        var tipo = "error";
        alertValNoAdm(mensaje, tipo);
        if (btn.length>0){
            document.getElementById("MetrajeVeh").value = "";

        }
        if (btn.length>0){

            btn.val("");

        }


    }
}


$(document).on("change", "#MetrajeVeh", async function () {
    var areabod = $(this).attr("areabod");
    var respuesta = await CheckTextboxPos('MetrajeVeh');
    console.log(respuesta);
    if (respuesta) {

        var cantMts = $(this).val();
        var PromedioTarima = document.getElementById("proTarima").value;
        if (PromedioTarima == 0 || PromedioTarima == "") {
            document.getElementById("proTarima").focus();
            swal({
                type: "warning",
                title: "Promedio por tarima",
                text: "Actualmente no se ha configurado, el promedio general por tarima, ingrese el promedio por tarima.",
                showConfirmButton: true,
                confrimButtonText: "cerrar",
                closeConfirm: true
            });
        } else {
            var funcCalculoMts = await validaCalculoMts(cantMts, PromedioTarima, areabod);
        }

    }
});
$(document).on("keyup", "#MetrajeVeh", async function () {
    var areabod = $(this).attr("areabod");
    var respuesta = await CheckTextboxPos('MetrajeVeh');
    console.log(respuesta);
    if (respuesta) {

        var cantMts = $(this).val();
        var PromedioTarima = document.getElementById("proTarima").value;
        if (PromedioTarima == 0 || PromedioTarima == "") {
            document.getElementById("proTarima").focus();
            swal({
                type: "warning",
                title: "Promedio por tarima",
                text: "Actualmente no se ha configurado, el promedio general por tarima, ingrese el promedio por tarima.",
                showConfirmButton: true,
                confrimButtonText: "cerrar",
                closeConfirm: true
            });
        } else {
            var funcCalculoMts = await validaCalculoMts(cantMts, PromedioTarima, areabod);
        }

    }
});

async function validaCalculoMts(cantMts, PromedioTarima, areabod) {
    var resNumMts = await patternPregNumEntero(cantMts);
    if (resNumMts == 1) {
        var nuevoMts = cantMts;
    } else {
        var mensaje = "Se aproximo el espacio en metros digitado";
        var tipo = "success";
        alertValNoAdm(mensaje, tipo);
        var nuevoMts = Math.ceil(cantMts);
        $("#MetrajeVeh").val(nuevoMts);
    }
    if (!isNaN(cantMts)) {
        if (nuevoMts >= 1) {
            if (PromedioTarima > 0) {
                var cantPos = Math.ceil(nuevoMts / PromedioTarima);
                $("#cantidadPosicionesVeh").val(cantPos);
            }
        }
    }
}
$(document).on("click", ".btnConsCadena", async function () {
    var ingreso = $(this).attr("ingreso");
    var operacion = $(this).attr("idunidadcadena");
    var cadena = $(this).attr("cadena");
    var tipo = $(this).attr("estado");
    console.log(operacion);
    console.log(tipo);
    console.log(cadena);

    var respuesta = await guardarPaseVacio(operacion, tipo, cadena);
    console.log(respuesta);
    if (respuesta == "creado") {
        $(this).removeClass("btn-outline-danger");
        $(this).addClass("btn-outline-info");
        $(this).removeClass("btnConsCadena");
        $(this).addClass("btnImpAutorizado");
        $(this).html("Autorizado");
        if ($(".btnRecarga").length >= 1) {
            document.getElementById("recargaBtn").disabled = false;
        }

        //
        Swal.fire({
            title: "Operación Exitosa, Piloto Autorizado",
            text: "¿Desea imprimir pase de salida del piloto?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#5cb85c',
            cancelButtonColor: '#d33',
            cancelButtonText: '¡No, Imprimir!',
            confirmButtonText: '¡Si, Imprimir!'
        }).then((result) => {
            if (result.value) {
                window.open("extensiones/tcpdf/pdf/Pase-vacio-fiscal.php?unidad=" + ingreso, "_blank");
            }
        })

        //        
    }
    if (respuesta == "creadoFin") {
        $("#salidaRapida" + ingreso).removeClass("btn-primary");
        $("#salidaRapida" + ingreso).addClass("btn-success");
        $("#salidaRapida" + ingreso).attr("estado", 1);
        $("#salidaRapida" + ingreso).html('Imprimir <i class="fa fa-print"></i>');
        $(this).removeClass("btn-outline-danger");
        $(this).addClass("btn-outline-info");
        $(this).removeClass("btnConsCadena");
        $(this).addClass("btnImpAutorizado");
        $(this).html("Autorizado");
        if ($(".btnRecarga").length >= 1) {
            document.getElementById("recargaBtn").disabled = false;
        }
        //
        Swal.fire({
            title: "Operación Exitosa, Pilotos Autorizados",
            text: "¿Desea imprimir pase de salida de lo(s) piloto(s)?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#5cb85c',
            cancelButtonColor: '#d33',
            cancelButtonText: '¡No, Imprimir!',
            confirmButtonText: '¡Si, Imprimir!'
        }).then((result) => {
            if (result.value) {
                window.open("extensiones/tcpdf/pdf/Pase-vacio-fiscal.php?unidad=" + ingreso, "_blank");
            }
        })

        //
    }
})


function guardarPaseVacio(operacion, tipo, cadena) {
    let todoMenus;
    var datos = new FormData();
    datos.append("operacionOpPs", operacion);
    datos.append("tipoOpPS", tipo);
    datos.append("cadena", cadena);
    $.ajax({
        async: false,
        url: "ajax/registroIngresoBodega.ajax.php",
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
    });
    return todoMenus;
}

$(document).on("click", ".bntSalidaRapida", function () {
    var idCliente = $(this).attr("idCliente");
    console.log(idCliente);
    var datos = new FormData();
    datos.append("idClientePaseRapido", idCliente);
    $.ajax({
        url: "ajax/registroIngresoBodega.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            document.getElementById("tablePilotos").innerHTML = '';
            document.getElementById("tablePilotos").innerHTML = '<table id="tablePilotosSalida" class="table dt-responsive table-hover table-sm" style="width: 100%"></table>';
            listaPilotos = [];
            for (var i = 0; i < respuesta.length; i++) {
                var cadenaPase = respuesta[i]["cadenaPase"];
                var numero = i + 1;
                var operacion = respuesta[i]["operacion"];
                var licencia = respuesta[i]["licencia"];
                var piloto = respuesta[i]["piloto"];
                var marchamo = respuesta[i]["marchamo"];
                var placa = respuesta[i]["placa"];
                var contenedor = respuesta[i]["contenedor"];
                var estado = respuesta[i].estadoOperacion;
                if (respuesta[i].cadenaPase >= 1) {

                    if (respuesta[i].estadoOperacion == 1 && respuesta[i].unidad >= 1) {

                        if ($(".btnRecarga").length >= 1) {
                            document.getElementById("recargaBtn").disabled = false;
                        }
                        var accion = '<button type="button" class="btn btn-outline-info btnImpAutorizado" idUnidadCadena=' + operacion + ' cadena=' + cadenaPase + ' ingreso=' + idCliente + ' estado="0">Autorizado</button>';
                    } else {
                        var accion = '<button type="button" class="btn btn-outline-danger btnConsCadena" idUnidadCadena=' + operacion + ' cadena=' + cadenaPase + ' ingreso=' + idCliente + '  estado="0">Generar Pase  <i class="fa fa-print"></i></button>';
                    }
                } else {
                    if (respuesta[i].unidad >= 1) {

                        if ($(".btnRecarga").length >= 1) {
                            document.getElementById("recargaBtn").disabled = false;
                        }
                        var accion = '<button type="button" class="btn btn-outline-info btnImpAutorizado" idUnidadCadena=' + operacion + ' ingreso=' + idCliente + ' estado="1">Autorizado</button>';
                    } else {
                        var accion = '<button type="button" class="btn btn-outline-danger btnConsCadena" idUnidadCadena=' + operacion + ' ingreso=' + idCliente + ' cadena="0" estado="1">Generar Pase  <i class="fa fa-print"></i></button>';
                    }
                }
                listaPilotos.push([numero, licencia, piloto, placa, contenedor, marchamo, accion]);
            }
            $('#tablePilotosSalida').DataTable({
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
                data: listaPilotos,
                columns: [{
                    title: "#"
                }, {
                    title: "Licencia"
                }, {
                    title: "Nombre de Piloto"
                }, {
                    title: "Placa"
                }, {
                    title: "Contenedor"
                }, {
                    title: "Marchamo"
                }, {
                    title: "Acción"
                }]
            });
            /*    document.getElementById("pSalidaPiloto").value = respuesta[0]["piloto"];
             document.getElementById("pSalidaLicencia").value = respuesta[0]["licencia"];
             document.getElementById("pSalidaMarchamo").value = respuesta[0]["marchamo"];
             document.getElementById("pSalidaPlaca").value = respuesta[0]["placa"];
             document.getElementById("pSalidaContenedor").value = respuesta[0]["contenedor"];
             document.getElementById("pSalidaPoliza").value = respuesta[0]["numeroPoliza"];
             $("#paseDeSalidaVacio").attr("idUnidad", respuesta[0]["operacion"]);*/

        }, error: function (respuesta) {
            console.log(respuesta);
        }

    });
});
$(document).on("change", "#cantidadPosiciones", function () {
    document.getElementById("GuardarIngBod").focus();
});
$(document).on("change", "#Metraje", function () {
    document.getElementById("GuardarIngBod").focus();
});
function CheckTextbox(text) {
    var textbox = $("#" + text);
    if (textbox.readOnly) {
        // If disabled, do this 
        return false;
    } else {
        // Enter code here
        return true;
    }
}
function CheckTextboxPos(text) {
    var textbox = $("#" + text);
    if (textbox.readOnly) {
        // If disabled, do this 
        return false;
    } else {
        // Enter code here
        return true;
    }
}

$(document).on("click", ".btnImpAutorizado", function () {

    var ingreso = $(this).attr("ingreso");
    Swal.fire({
        title: "Impresion de pase de salida vacio",
        text: "¿Desea imprimir pase de salida del piloto?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#5cb85c',
        cancelButtonColor: '#d33',
        cancelButtonText: '¡No, Imprimir!',
        confirmButtonText: '¡Si, Imprimir!'
    }).then((result) => {
        if (result.value) {
            window.open("extensiones/tcpdf/pdf/Pase-vacio-fiscal.php?unidad=" + ingreso, "_blank");
        }
    })

});
$(document).on("click", ".btnMsVehiculos", async function () {
    var dependencia = document.getElementById("hiddenIdDependencia").value;

    var listPredios = await cargarPrediosDeEmpresa(dependencia);
    console.log(listPredios);

    if (listPredios != false) {
        for (var i = 0; i < listPredios.length; i++) {
            $("#vehiculosUbicaN").append('<option value=' + listPredios[i].idPredio + '> Predio ' + listPredios[i].pred + ' - ' + listPredios[i].descP + '</option>');
        }
        var idIng = $(this).attr("idIngVehiculosN");
        console.log(idIng);
        if (idIng >= 1) {
            console.log(idIng);
            document.getElementById("chasisVeh").innerHTML = '';
            document.getElementById("chasisVeh").innerHTML = '<table id="tableChasisVehiculos" class="table table-hover"></table>';
            var respFinVeh = await finalizarChasis(idIng);
            console.log(respFinVeh);
            if (respFinVeh != false) {
                listaChasis = [];
                for (var i = 0; i < respFinVeh.length; i++) {
                    var numero = i + 1;
                    var identyChasis = respFinVeh[i].identyChasis;
                    var chasis = respFinVeh[i].chasisVe;
                    var tipoV = respFinVeh[i].tipoV;
                    var lineaV = respFinVeh[i].lineaV;
                    var ubica = respFinVeh[i].ubica;
                    if (ubica == 0) {
                        var btnubica = '<button type="button" class="btn btn-danger" disabled="disabled">S-P</button>';
                    } else {
                        var btnubica = '<button type="button" class="btn btn-danger" disabled="disabled">' + ubica + '</button>';
                    }
                    var estadoVeh = respFinVeh[i].estadoVeh;
                    if (estadoVeh == 0) {
                        var button = '<div class="btn-group btn-group-sm"><button type="button" class="btn btn-outline-warning btn-sm"><i class="fa fa-comment"></i></button><button type="button" class="btn btn-outline-danger btn-sm btnSinUbicacion" id="btnDataid' + identyChasis + '" identyChasis=' + identyChasis + ' estado=0><i class="fa fa-close"></i></button></div>';
                    } else {
                        var button = '<div class="btn-group btn-group-sm"><button type="button" class="btn btn-outline-warning btn-sm"><i class="fa fa-comment"></i></button><button type="button" class="btn btn-outline-success btn-sm" disabled="false"><i class="fa fa-circle"></i></button></div>';
                    }
                    listaChasis.push([numero, chasis, tipoV, lineaV, btnubica, button]);
                }
                $('#tableChasisVehiculos').DataTable({
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
                    data: listaChasis,
                    columns: [{
                        title: "#"
                    }, {
                        title: "Chasis"
                    }, {
                        title: "Tipo"
                    }, {
                        title: "Linea"
                    }, {
                        title: "Ubicación"
                    }, {
                        title: "Acciones"
                    }]
                });
            }
        }
    }
})

function finalizarChasis(idIng) {
    console.log(idIng);
    let todoMenus;
    var datos = new FormData();
    datos.append("idIngMstV", idIng);
    $.ajax({
        async: false,
        url: "ajax/registroIngresoBodega.ajax.php",
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
            } else {
                todoMenus = false;
            }



        }, error: function (respuesta) {
            console.log(respuesta);
        }
    });
    return todoMenus;
}

$(document).on("click", ".btnSinUbicacion", async function () {
    var estado = $(this).attr("estado");
    if (estado == 0) {
        $(this).removeClass("btn-outline-danger");
        $(this).addClass("btn-outline-primary");
        $(this).html('<i class="fa fa-close"></i>');
        $(this).html('<i class="fa fa-check"></i>');
        $(this).attr("estado", 1);
    } else {
        $(this).removeClass("btn-outline-primary");
        $(this).addClass("btn-outline-danger");
        $(this).html('<i class="fa fa-check"></i>');
        $(this).html('<i class="fa fa-close"></i>');
        $(this).attr("estado", 0);
    }
})


function cargarPrediosDeEmpresa(dependencia) {
    let todoMenus;
    var datos = new FormData();
    datos.append("consultarPredio", dependencia);
    $.ajax({
        async: false,
        url: "ajax/registroIngresoBodega.ajax.php",
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
            } else {
                todoMenus = false;
            }

        }, error: function (respuesta) {
            console.log(respuesta);
        }
    });
    return todoMenus;
}

$(document).on("click", ".btnGdChasVehN", async function () {
    var selectUbica = document.getElementById("vehiculosUbicaN").value;
    if (!isNaN(selectUbica) && selectUbica >= 1) {
        var paragraphsNChasis = Array.from(document.querySelectorAll(".btnSinUbicacion"));
        lista = [];
        for (var i = 0; i < paragraphsNChasis.length; i++) {
            var idChass = paragraphsNChasis[i].attributes.identychasis.value;
            var estado = paragraphsNChasis[i].attributes.estado.value;
            if (estado == 1) {
                lista.push([idChass]);
            }
        }
        if (lista.length >= 1) {
            var listaValida = JSON.stringify(lista);
            var vehiculosUbicaN = document.getElementById("vehiculosUbicaN").value;
            var gdUbVehN = await guardarUbicacionesVehN(vehiculosUbicaN, listaValida);
            console.log(gdUbVehN);
            if (gdUbVehN.estadoIng == 1) {
                $(".btnMsVehiculos").click();
                document.getElementById("divUbicacionMerc").innerHTML = "";
                document.getElementById("divUbicacionMerc").innerHTML = `
                                                         <div class="form-group has-error" id="selectSucces">
                                                                <label>Ubicación de Vehiculos</label>
                                                                <select  class="select2" style="width: 100%;" id="vehiculosUbicaN">
                                                                    <option selected="selected" disabled="disabled">Seleccione predio</option>   
                                                                </select>
                                                            </div>`;
                $('#vehiculosUbicaN').select2();
                Swal.fire({
                    position: 'top-center',
                    type: 'success',
                    title: 'La todos los vehículos fueron ubicados',
                    showConfirmButton: false,
                    timer: 5000
                })

            } else {
                $(".btnMsVehiculos").click();
                document.getElementById("divUbicacionMerc").innerHTML = "";
                document.getElementById("divUbicacionMerc").innerHTML = `
                                                         <div class="form-group has-error" id="selectSucces">
                                                                <label>Ubicación de Vehiculos</label>
                                                                <select  class="select2" style="width: 100%;" id="vehiculosUbicaN">
                                                                    <option selected="selected" disabled="disabled">Seleccione predio</option>   
                                                                </select>
                                                        </div>`;
                $('#vehiculosUbicaN').select2();
                Swal.fire({
                    position: 'top-center',
                    type: 'info',
                    title: 'Lote de vehículos ubicados correctamente',
                    showConfirmButton: false,
                    timer: 5000
                });

            }
        }
    } else {
        Swal.fire({
            position: 'top-center',
            type: 'error',
            title: 'Seleccione el predio del vehiculo',
            showConfirmButton: false,
            timer: 5000
        });
    }

});


function guardarUbicacionesVehN(vehiculosUbicaN, listaValida) {
    let todoMenus;
    var datos = new FormData();
    datos.append("vehiculosUbicaN", vehiculosUbicaN);
    datos.append("listaValida", listaValida);
    $.ajax({
        async: false,
        url: "ajax/registroIngresoBodega.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            if (respuesta.tipoRes) {
                todoMenus = respuesta;
            }
        }, error: function (respuesta) {
            console.log(respuesta);
        }
    });
    return todoMenus;
}

$(document).on("click", ".btnMostrarDetOpIng", async function () {
    var numeroIdIng = $(this).attr("idIng");
    document.getElementById("tableMrcDiffMani").innerHTML = '';
    document.getElementById("tableMrcDiffMani").innerHTML = '<table id="tableDiffBodMan" class="table dt-responsive nowrap table-striped table-bordered display"></table>';
    var datos = new FormData();
    datos.append("numeroIdIng", numeroIdIng);
    $.ajax({
        url: "ajax/registroIngresoBodega.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            if (respuesta[1] != "SD") {

                if (respuesta[0] != "finDetalle") {


                    if (respuesta[0] != "UpdateHis") {

                        var lista = [];
                        console.log(respuesta);
                        for (var i = 0; i < respuesta[0].length; i++) {
                            var numero = i + 1;
                            var numeroLabel = '<label>' + numero + '</label>'
                            var empresa = '<label>' + respuesta[0][i]["empresa"] + '</label>';
                            var bultos = '<label>' + respuesta[0][i]["bultos"] + '</label>';
                            var peso = '<label>' + respuesta[0][i]["peso"] + '</label>';
                            lista.push([numeroLabel, empresa, bultos, peso]);
                        }
                        $('#tableDiffBodMan').DataTable({
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
                                title: "Empresa"
                            }, {
                                title: "Bultos"
                            }, {
                                title: "Peso"
                            }]
                        });
                    }
                } else {

                    Swal.fire(
                        'Ingreso sin detalle',
                        'El ingreso no tiene detalle por mostrar',
                        'info'
                    )
                    $(".close").click();
                }
            } else {

                Swal.fire(
                    'Ingreso sin detalle',
                    'El ingreso no tiene detalle por mostrar',
                    'info'
                )
                $(".close").click();
            }
        }, error: function (respuesta) {
            console.log(respuesta);
        }
    })
})

$(document).on("click", ".spanCopyVinc", async function () {
    var idIngCons = $(this).attr("idingcons");
    var vinculo = $(this).attr("vinculo");
    document.getElementById("hiddCopy").value = idIngCons;

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 8000,
        timerProgressBar: true,
        onOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    Toast.fire({
        type: 'success',
        title: 'Vinculo copiado : ' + vinculo
    })
});


$(document).on("click", ".spanVincular", async function () {
    var hiddCopy = document.getElementById("hiddCopy").value;
    var hiddCopy = parseInt(hiddCopy);
    var idIngPaste = $(this).attr("idingcons");
    if (hiddCopy >= 1) {
        Swal.fire({
            title: 'Quiere asociar o vincular?',
            text: "Vincular ingresos consolidados por poliza!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            allowOutsideClick: false,
            confirmButtonText: 'Si, Vincular!'
        }).then(async function (result) {
            if (result.value) {
                var resp = await funcCambioVinculo(hiddCopy, idIngPaste);
                if (resp[0].resp == 1) {
                    Swal.fire({
                        title: 'Vinculo Guardado',
                        text: "Se vinculo con éxito ambos ingresos!",
                        type: 'success',
                        confirmButtonColor: '#3085d6',
                        allowOutsideClick: false,
                        confirmButtonText: 'Ok!'
                    }).then(async function (result) {
                        if (result.value) {
                            location.reload();

                        }
                    })
                }
            }
        })


    } else {
        Swal.fire({
            title: 'No se puede cambiar vinculo',
            text: "No copio el vinculo del ingreso",
            type: 'error',
            confirmButtonColor: '#3085d6',
            allowOutsideClick: false,
            confirmButtonText: 'OK'
        })

    }
});



function funcCambioVinculo(hiddCopy, idIngPaste) {
    let estado;
    var datos = new FormData();
    datos.append("hiddCopy", hiddCopy);
    datos.append("idIngPaste", idIngPaste);
    $.ajax({
        async: false,
        url: "ajax/registroIngresoBodega.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            estado = respuesta;
        }, error: function (respuesta) {
            console.log(respuesta);
        }
    });
    return estado;
}


$(document).on("click", "#divDetalleVehUsa", async function () {
    var data = $(this).text();
    var btn = $(this);
    Swal.fire({
        title: 'TRAE ' + data + '?',
        type: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si trae',
        cancelButtonText: 'No trae'
    }).then((result) => {
        if (result.value) {

            btn.attr('disabled', true);
            data.trim();

            data.replace(" ", "");
            var dataText = data;
            if (result.value) {
                document.getElementById("textDetalleVeh").innerHTML += 'TRAE ' + data + ', ';
            } else {
                document.getElementById("textDetalleVeh").innerHTML += 'NO TRAE ' + data + ', ';
            }
            var dataDescr = document.getElementById("textDetalleVeh").value;
            var cant = dataDescr.length;
            var dataResp = dataDescr.substring(0, cant - 2);
            document.getElementById("descripcionMerca").value = "OBSERVACIONES : " + dataResp;
        }
    })

})
$(document).on("change", ".montacarguista", function () {
    $("#divMontarguist").removeClass('has-error');
    $("#divMontarguist").addClass('has-success');
})

$(document).on("click", ".ancAreasBod", function () {
    var nomVar = "idBodAreasBod";
    var idBod = true;
    var resp = funcionRevVehUsados(nomVar, idBod);
    if (resp == "SD") {
        Swal.fire(
            'Sin areas en bodega!',
            'Esta bodega no tiene configurada ninguna area para almacenar!',
            'warning'
        )
    } else {


        document.getElementById("areasDeMiBodega").innerHTML = '';
        document.getElementById("areasDeMiBodega").innerHTML = '<table id="tableMisAreasBod" class="table table-hover table-sm"></table>';
        listaAreas = [];
        var contador = 0;
        for (var i = 0; i < resp.length; i++) {
            var contador = contador + 1;
            var nombreArea = resp[i].nombreArea;
            var descripcionArea = resp[i].descripcionArea;
            var tiempo = resp[i].tiempo;
            var idArea = resp[i].id;
            var button = '<div class="btn-group"><button type="button" class="btn btn-success btn-sm btnEditarArea" idArea=' + idArea + '>Editar Area</button><button type="button" class="btn btn-danger btn-sm btnDeleteArea" idArea=' + idArea + '>Eliminar</button></div>';
            listaAreas.push([contador, nombreArea, descripcionArea, button]);
        }
        console.log(listaAreas);
        $('#tableMisAreasBod').DataTable({
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
            data: listaAreas,
            columns: [{
                title: "#"
            }, {
                title: "Nombre Area"
            }, {
                title: "Descripción"
            }, {
                title: "Acciones"
            }]
        });
    }
});

$(document).on("click", ".btnNuevaAreaBodega", async function () {


    var idBod = true;
    var nombreArea = document.getElementById("nombreAreaNew").value;
    var descArea = document.getElementById("descArea").value;

    if (nombreArea != null && descArea != null && nombreArea != "" && descArea != "") {


        $("#nombreAreaNew").removeClass("is-invalid");
        $("#descArea").addClass("is-valid");
        var tiempoArea = true;
        var fecha = true;
        var resp = await funcGuardarNewArea(idBod, nombreArea, descArea, tiempoArea, fecha);
        if (resp[0].resp == 1) {
            Swal.fire({
                title: 'Guardado con éxito',
                text: "El area de bodega fue creada exitosamente!",
                type: 'success',
                confirmButtonColor: '#3085d6',
                allowOutsideClick: false,
                confirmButtonText: 'Ok!'
            }).then((result) => {
                if (result.value) {
                    $(".ancAreasBod").click();
                    document.getElementById("nombreAreaNew").value = '';
                    document.getElementById("descArea").value = '';
                }
            })
        }
    } else {
        Swal.fire(
            'Campos vacios',
            'Existen campos vacios',
            'error'
        )
        $("#nombreAreaNew").removeClass("is-valid");
        $("#descArea").addClass("is-invalid");
    }

});



function funcGuardarNewArea(idBod, nombreArea, descArea, tiempoArea, fecha) {
    let respEdicion;
    var datos = new FormData();

    datos.append("idBodNew", idBod);
    datos.append("nomNewArea", nombreArea);
    datos.append("descNewArea", descArea);
    datos.append("tiempoArea", tiempoArea);
    datos.append("fechaVencimiento", fecha);


    $.ajax({
        async: false,
        url: "ajax/registroIngresoBodega.ajax.php",
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
        }
    });
    return respEdicion;
}

$(document).on("click", ".btnEditarArea", async function () {
    var nomVar = "idBodAreasBod";
    var idArea = $(this).attr("idArea");
    var idBod = true;
    var resp = funcionRevVehUsados(nomVar, idArea);
    for (var i = 0; i < resp.length; i++) {
        if (resp[i].id == idArea) {
            document.getElementById("nombreAreaEdit").value = resp[i].nombreArea;
            document.getElementById("descAreaEdit").value = resp[i].descripcionArea;
            $(".btnEditAreaBod").attr("idArea", idArea);
        }
    }

    //        var nombreArea = resp[i].nombreArea;
    //var descripcionArea = resp[i].;
});

$(document).on("click", ".btnEditAreaBod", async function () {
    var idarea = $(this).attr("idArea");
    var idarea = idarea * 1;

    var idBod = true;
    var nombreArea = document.getElementById("nombreAreaEdit").value;
    var descArea = document.getElementById("descAreaEdit").value;

    if (nombreArea != null && descArea != null && nombreArea != "" && descArea != "" && idarea > 0) {
        $("#nombreAreaEdit").removeClass("is-invalid");
        $("#descAreaEdit").addClass("is-valid");


        var tiempoArea = true;
        var fecha = true;
        var resp = await funcGuardarEditArea(idBod, nombreArea, descArea, tiempoArea, fecha, idarea);
        if (resp[0].resp == 1) {
            Swal.fire({
                title: 'Editado con éxito',
                text: "El area de bodega fue editada exitosamente!",
                type: 'success',
                confirmButtonColor: '#3085d6',
                allowOutsideClick: false,
                confirmButtonText: 'Ok!'
            }).then((result) => {
                if (result.value) {
                    $(".ancAreasBod").click();
                    document.getElementById("nombreAreaEdit").value = '';
                    document.getElementById("descAreaEdit").value = '';
                }
            })
        }

    } else {
        Swal.fire(
            'Campos vacios',
            'Existen campos vacios',
            'error'
        )
        $("#nombreAreaEdit").removeClass("is-valid");
        $("#descAreaEdit").addClass("is-invalid");
    }
})

function funcGuardarEditArea(idBod, nombreArea, descArea, tiempoArea, fecha, idarea) {
    let respEdicion;
    var datos = new FormData();

    datos.append("idBodUpdate", idBod);
    datos.append("area", nombreArea);
    datos.append("desc", descArea);
    datos.append("tipoVence", tiempoArea);
    datos.append("fechaVence", fecha);
    datos.append("idAreaEdit", idarea);


    $.ajax({
        async: false,
        url: "ajax/registroIngresoBodega.ajax.php",
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
        }
    });
    return respEdicion;
}

$(document).on("click", ".btnDeleteArea", async function () {
    var idArea = $(this).attr("idArea");
    var idArea = idArea * 1;
    if (idArea > 0) {
        console.log(idArea);
        var nomVar = "idBodAreasBodDelete";
        var resp = funcionRevVehUsados(nomVar, idArea);
        if (resp[0].resp == 1) {
            Swal.fire({
                title: 'Area Eliminada',
                text: "Esta area ya no podra ser visible en bodega!",
                type: 'success',
                confirmButtonColor: '#3085d6',
                allowOutsideClick: false,
                confirmButtonText: 'Ok!'
            }).then((result) => {
                if (result.value) {
                    $(".ancAreasBod").click();
                }
            })
        }
    }
})


