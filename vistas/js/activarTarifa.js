/*=====================================
 CARGAR LA TABLA DINAMICA DE SERVICIOS
 ======================================= --*/
$(document).ready(function () {
    $("#consultaNit2").change(function () {
      var idNit = $(this).val();

        if (idNit == "") {
            document.getElementById("lblNit").innerHTML = "";
            document.getElementById("lblEmpresa").innerHTML = "";
            document.getElementById("lblDireccion").innerHTML = "";
            document.getElementById("lblDireccionCobro").innerHTML = "";
            document.getElementById("lblTelefono").innerHTML = "";
            swal({
                type: "error",
                title: "Selección",
                text: "Selección de nit incorrecta",
                showConfirmButton: true,
                confrimButtonText: "cerrar",
                closeConfirm: true
            });

        } else {
            var datos = new FormData();
            datos.append("idNit", idNit);
            $.ajax({
                url: "ajax/usuarios.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (respuesta) {
                    document.getElementById("lblClienteId").value = respuesta["id"];
                    document.getElementById("lblNit").innerHTML = respuesta["nit"];
                    document.getElementById("lblEmpresa").innerHTML = respuesta["razonSocial"];
                    document.getElementById("lblDireccion").innerHTML = respuesta["direccionFiscal"];
                    document.getElementById("lblDireccionCobro").innerHTML = respuesta["direccionFiscal"];
                    document.getElementById("lblTelefono").innerHTML = respuesta["telefono"];
                    document.getElementById("lblCorreo").innerHTML = respuesta["email"];
                    document.getElementById("lblEjecutivo").value = respuesta["ejecutivo"];
                    var ejecutivo = document.getElementById("lblEjecutivo").value;
                    var datos = new FormData();
                    datos.append("ejecutivo", ejecutivo);
                    $.ajax({
                        url: "ajax/activarTarifa.ajax.php",
                        method: "POST",
                        data: datos,
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: "json",
                        success: function (respuesta) {
                            document.getElementById("lblNombreEjecutivo").innerHTML = respuesta[0]['nombres'] + ' ' + respuesta[0]['apellidos'];
                            document.getElementById("lblTelefonoE").innerHTML = respuesta[0]['telefono'];
                            document.getElementById("lblCorreoE").innerHTML = respuesta[0]['email'];
                            var idCliente = document.getElementById("lblClienteId").value;
                            var datos = new FormData();
                            datos.append("idCliente", idCliente);
                            $.ajax({
                                url: "ajax/activarTarifa.ajax.php",
                                method: "POST",
                                data: datos,
                                cache: false,
                                contentType: false,
                                processData: false,
                                dataType: "json",
                                success: function (respuesta) {
                                    if (respuesta == "SD") {
                                        alert("SIN DATA");
                                        return "sin datos detencion de ejecucion";
                                        document.getElementById('btnActivaImpreme').innerHTML = '';
                                    } else if (respuesta !== "SD") {
                                        var lista = [];
                                        for (var i = 0; i < respuesta.length; i++) {
                                            if (respuesta[i]['claveAlmacenaje'] == null) {
                                                var resBotonAlmacenaje = '<button type="button" class="btn btn-danger btnServicios" BotonAlmacenaje=BotonAlmacenaje' + i + '><i class="fa fa-close"></i></button>';
                                            } else {
                                                var resBotonAlmacenaje = '<button type="button" class="btn btn-info btnServicios" BotonAlmacenaje=BotonAlmacenaje' + i + ' idServicioCliente=' + respuesta[i]['claveAlmacenaje'] + ' data-toggle="modal" data-target="#UpdateServiciosAlmacenajes"><i class="fa fa-check"></i></button>';
                                            }
                                            if (respuesta[i]['claveSeguro'] == null) {
                                                var resBotonSeguro = '<button type="button" class="btn btn-danger btnServiciosSeguro" BotonSeguro=BotonSeguro' + i + '><i class="fa fa-close"></i></button>';
                                            } else {
                                                var resBotonSeguro = '<button type="button" class="btn btn-info btnServiciosSeguro" BotonSeguro=BotonSeguro' + i + ' id=' + respuesta[i]['claveSeguro'] + ' data-toggle="modal" data-target="#UpdateServiciosSeguro"><i class="fa fa-check"></i></button>';
                                            }
                                            if (respuesta[i]['claveManejo'] == null) {
                                                var resBotonManejo = '<button type="button" class="btn btn-danger btnServiciosManejo" BotonManejo=BotonManejo' + i + '><i class="fa fa-close"></i></button>';
                                            } else {
                                                var resBotonManejo = '<button type="button" class="btn btn-info btnServiciosManejo" BotonManejo=BotonManejo' + i + ' idServicioClienteManejo=' + respuesta[i]['claveManejo'] + ' data-toggle="modal" data-target="#UpdateServiciosManejo"><i class="fa fa-check"></i></button>';
                                            }
                                            if (respuesta[i]['claveGtosAdmin'] == null) {
                                                var resBotonGtosAdmin = '<button type="button" class="btn btn-danger btnGastosAdmin" BotonGstsAdmin=BotonGstsAdmin' + i + ' ><i class="fa fa-close"></i></button>';
                                            } else {
                                                var resBotonGtosAdmin = '<button type="button" class="btn btn-info btnGastosAdmin" BotonGstsAdmin=BotonGstsAdmin' + i + ' idGastosAdministracion=' + respuesta[i]['claveGtosAdmin'] + ' data-toggle="modal" data-target="#UpdateGastosAdministracion"><i class="fa fa-check"></i></button>';
                                            }
                                            if (respuesta[i]['claveOtrosGtos'] == null) {
                                                var resBotonOtrosGastos = '<button type="button" class="btn btn-danger btnOtrosGastos" BotonOtrosGts=BotonOtrosGts' + i + '><i class="fa fa-close"></i></button>';
                                            } else {
                                                var resBotonOtrosGastos = '<button type="button" class="btn btn-info btnOtrosGastos" BotonOtrosGts=BotonOtrosGts' + i + ' idOtrosGastos=' + respuesta[i]['claveOtrosGtos'] + '  data-toggle="modal" data-target="#UpdateOtrosGastos"><i class="fa fa-check"></i></button>';
                                            }
                                            lista.push([respuesta[i]['servicio'] + resBotonAlmacenaje, "Seguro " + resBotonSeguro, "Manejo " + resBotonManejo, "Gastos Administración " + resBotonGtosAdmin, "Otros Gastos " + resBotonOtrosGastos, '<button type="button" class="btn btn-danger btn-sm btnEliminarFila" id=' + respuesta[i]["claveAlmacenaje"] + ' idClienteFila=' + idCliente + ' BotonElminarFila=0><i class="fa fa-trash" aria-hidden="true"></i></button>']);
                                        }
                                        $('#example').DataTable({
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
                                                    title: "Almacenaje"
                                                }, {
                                                    title: "Seguro"
                                                }, {
                                                    title: "Manejo"
                                                }, {
                                                    title: "Gastos Administración"
                                                }, {
                                                    title: "Otros Gastos"
                                                }, {
                                                    title: "Eliminar"
                                                }]
                                        });
                                        if (respuesta["estadoTarifa"] == 1) {
                                            document.getElementById('btnActivaImpreme').innerHTML += '<button type="button" class="btn btn-success btn-sm btnActivacion" numeroParaActivar=0>Activa</button><button type="button" class="btn btn-warning btn-sm btnAnulacionTotal" numeroParaActivar=0>Anular toda la tarifa</button>';
                                        } else {
                                            document.getElementById('btnActivaImpreme').innerHTML += '<button type="button" class="btn btn-danger btn-sm btnActivacion" numeroParaActivar=1>Inactiva</i></button><button type="button" class="btn btn-warning btn-sm btnAnulacionTotal" numeroParaActivar=0>Anular toda la tarifa</button>';
                                        }
                                    }
                                },
                                error: function (respuesta) {}
                            })
                        },
                        error: function (respuesta) {}
                    });
                    if (respuesta["numeroTarifa"] == "SN") {
                        var numeroCliente = document.getElementById("lblClienteId").value;
                        var nit = document.getElementById("lblNit").innerHTML;
                        var aleatorio = Math.round(Math.random() * 999);
                        if (aleatorio <= 9) {
                            var aleatorio = aleatorio + 10 * 2;
                        }
                        var serieTarifa = nit.substr(1, 2) + aleatorio + numeroCliente;
                        document.getElementById("lblNumeroSerie").innerHTML = serieTarifa;
                        var numeroCliente = document.getElementById("lblClienteId").value;
                        var datos = new FormData();
                        datos.append("numeroCliente", numeroCliente);
                        datos.append("serieTarifa", serieTarifa);
                        $.ajax({
                            url: "ajax/activarTarifa.ajax.php",
                            method: "POST",
                            data: datos,
                            cache: false,
                            contentType: false,
                            processData: false,
                            dataType: "json",
                            success: function (respuesta) {
                                Swal.fire({
                                    position: 'center',
                                    type: 'success',
                                    title: 'El numero de cotización es :' + serieTarifa,
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            }
                        });
                    } else {
                        document.getElementById("lblNumeroSerie").innerHTML = respuesta["numeroTarifa"];
                        Swal.fire({
                            position: 'center',
                            type: 'success',
                            title: 'El numero de cotización es :' + respuesta["numeroTarifa"],
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                }
            });
        }
    });
});
$(document).on("click", ".btnActivacion", function () {
    var idParaActivar = $(this).attr("numeroParaActivar");
    console.log(idParaActivar);
    var numeroSerie = document.getElementById("lblNumeroSerie").innerHTML;
    var idNuevaTarifa = document.getElementById("lblCliente").value;
    console.log(idNuevaTarifa);
    var datos = new FormData();
    datos.append("idNuevaTarifa", idNuevaTarifa);
    datos.append("numeroSerie", numeroSerie);
    datos.append("idParaActivar", idParaActivar);
    $.ajax({
        url: "ajax/activarTarifa.ajax.php",
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
    if (idParaActivar == 0) {
        $(this).removeClass('btn-success');
        $(this).addClass('btn-danger');
        $(this).html('Inactiva');
        $(this).attr('numeroParaActivar', 1);
        var estado = "Desactivada";
    } else {
        $(this).removeClass('btn-danger');
        $(this).addClass('btn-success');
        $(this).html('Activada');
        $(this).attr('numeroParaActivar', 0);
        var estado = "Activada";
    }
    Swal.fire({
        position: 'center',
        type: 'success',
        title: 'Tarifa' + estado,
        showConfirmButton: false,
        timer: 2000
    })
});
$(document).on("click", ".btnServicios", function () {
    var idServicioCliente = $(this).attr("idServicioCliente");
    var datos = new FormData();
    datos.append("idServicioCliente", idServicioCliente);
    $.ajax({
        url: "ajax/activarTarifa.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            document.getElementById('divServicios').innerHTML = '';
            document.getElementById('divServicios').innerHTML += '<div class="col-12"><label>Calculado Sobre</label><div class="input-group mb-3"><div class="input-group-prepend"><button type="button" class="btn btn-danger bntEditarServicio" numeroId=' + idServicioCliente + ' numeroParaActivar=0 numeroServicio=1>Sin Modificar</button></div><select class="form-control" disabled="disabled" id="servicio1" name="servicio1"><option>Saldo Diario</option><option>Saldo Anticipado</option></select></div></div>';
            document.getElementById('divServicios').innerHTML += '<div class="col-12"><label>Base de Calculo</label><div class="input-group mb-3"><div class="input-group-prepend"><button type="button" class="btn btn-danger bntEditarServicio" numeroId=' + idServicioCliente + ' numeroParaActivar=0 numeroServicio=2>Sin Modificar</button></div><select class="form-control" disabled="disabled" id="servicio2" name="servicio2"><option>Posiciones</option><option>Porcentaje</option><option>Metros²</option><option>Metros³</option><option>Unidad</option></select></div></div><div class="col-12"><label>Periodo de Calculo</label><div class="input-group mb-3"><div class="input-group-prepend"><button type="button" class="btn btn-danger bntEditarServicio" numeroId=' + idServicioCliente + ' numeroParaActivar=0 numeroServicio=3>Sin Modificar</button></div><select class="form-control" disabled="disabled" id="servicio3" name="servicio3"><option>Diario</option><option>Mensual</option><option>Anual</option></select></div></div><div class="col-12"><label>Tipo Moneda, Q; $; %</label><div class="input-group mb-3"><div class="input-group-prepend"><button type="button" class="btn btn-danger bntEditarServicio" numeroId=' + idServicioCliente + ' numeroParaActivar=0 numeroServicio=4>Sin Modificar</button></div><select class="form-control" disabled="disabled" id="servicio4" name="servicio4"><option>Quetzales</option><option>Porcentaje %</option><option>Dolares $</option></select></div></div><div class="col-12"><label>Valor de Tarifa</label><div class="input-group mb-3"><div class="input-group-prepend"><button type="button" class="btn btn-danger bntEditarServicio" numeroId=' + idServicioCliente + ' numeroParaActivar=0 numeroServicio=5>Sin Modificar</button><input type="text" class="form-control input-lg" placeholder="Valor" id="servicio5" name="servicio5" readOnly="readOnly"></div></div></div>';
            $("#servicio1").val(respuesta[0]["calculoSobre"]);
            $("#servicio2").val(respuesta[0]["baseCalculo"]);
            $("#servicio3").val(respuesta[0]["periodoCalculo"]);
            $("#servicio4").val(respuesta[0]["Moneda"]);
            $("#servicio5").val(respuesta[0]["valorTarifa"]);
        },
        error: function (respuesta) {}
    })
})
$(document).on("click", ".bntEditarServicio", function () {
    var numeroServicio = $(this).attr("numeroServicio");
    var idParaActivar = $(this).attr("numeroParaActivar");
    var servicioId = "servicio" + numeroServicio;
    var servicioId1 = document.getElementById(servicioId).value;
    var numeroId = $(this).attr("numeroId");
    var servicio = "servicio" + numeroServicio;
    if (idParaActivar == 0) {
        $(this).removeClass('btn-danger');
        $(this).addClass('btn-primary');
        $(this).html('Sin guardar');
        $(this).attr('numeroParaActivar', 1);
        if (servicioId !== "servicio5") {
            document.getElementById(servicio).disabled = false;
        } else {
            document.getElementById(servicio).readOnly = false;
        }
    } else if (idParaActivar == 1) {
        var datos = new FormData();
        datos.append("numeroServicio", numeroServicio);
        datos.append("numeroId", numeroId);
        datos.append("servicioId", servicioId1);
        $.ajax({
            url: "ajax/activarTarifa.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            success: function (respuesta) {},
            error: function (respuesta) {}
        })
        $(this).removeClass('btn-primary');
        $(this).addClass('btn-warning');
        $(this).html('Modificado');
        $(this).attr('numeroParaActivar', 3);
        if (servicioId !== "servicio5") {
            document.getElementById(servicio).disabled = false;
        } else {
            document.getElementById(servicio).readOnly = false;
        }
    } else if (idParaActivar == 3) {
        $(this).removeClass('btn-warning');
        $(this).addClass('btn-primary');
        $(this).html('Sin guardar');
        $(this).attr('numeroParaActivar', 1);
        if (servicioId !== "servicio5") {
            document.getElementById(servicio).disabled = false;
        } else {
            document.getElementById(servicio).readOnly = false;
        }
    }
})
$(document).on("click", ".btnServiciosSeguro", function () {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 5000
    });
    Toast.fire({
        type: 'success',
        title: 'Formulario de modificaciones'
    })
    var idParaActivar = $(this).attr("numeroParaActivar");
    var idServicioClienteSeguro = $(this).attr("id");
    var datos = new FormData();
    datos.append("idServicioClienteSeguro", idServicioClienteSeguro);
    $.ajax({
        url: "ajax/activarTarifa.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            document.getElementById("divServiciosSeguro").innerHTML = "";
            document.getElementById("divServiciosSeguro").innerHTML += '<div class="col-12"><label>Calculado Sobre</label><div class="input-group mb-3"><div class="input-group-prepend"><button type="button" class="btn btn-danger btnSeguro"   numeroParaActivarSeguro=0 numeroIdTarifa=' + idServicioClienteSeguro + ' numeroServicioSeguro=1>Sin Modificar</button></div><select class="form-control" disabled="disabled" id="servicioSeguro1" name="servicioSeguro1"> <option>Saldo Diario</option> <option>Saldo Anticipado</option> </select> </div></div><div class="col-12"><label>Base de seguro</label> <div class="input-group mb-3"><div class="input-group-prepend"> <button type="button" class="btn btn-secondary">No Modificable</button></div><select class="form-control" disabled="disabled"> <option>Porcentaje</option> </select> </div></div><div class="col-12"><label>Periodo de Calculo</label> <div class="input-group mb-3"><div class="input-group-prepend"> <button type="button" class="btn btn-danger btnSeguro"   numeroParaActivarSeguro=0 numeroIdTarifa=' + idServicioClienteSeguro + '   numeroServicioSeguro=3>Sin Modificar</button></div><select class="form-control" disabled="disabled" id="servicioSeguro3" name="servicioSeguro3"> <option>Diario</option> <option>Mensual</option><option>Anual</option></select> </div></div><div class="col-12"><label>Tipo Moneda, Q; $; %</label> <div class="input-group mb-3"><div class="input-group-prepend"><button type="button" class="btn btn-danger btnSeguro"   numeroParaActivarSeguro=0 numeroIdTarifa=' + idServicioClienteSeguro + '   numeroServicioSeguro=4>Sin Modificar</button></div><select class="form-control" disabled="disabled" id="servicioSeguro4" name="servicioSeguro4"> <option>Quetzales</option><option>Dolares $</option></select> </div></div><div class="col-12"><label>Valor de Tarifa</label><div class="input-group mb-3"><div class="input-group-prepend"> <button type="button" class="btn btn-danger btnSeguro"   numeroParaActivarSeguro=0 numeroIdTarifa=' + idServicioClienteSeguro + '   numeroServicioSeguro=5>Sin Modificar</button><input type="text" class="form-control input-lg" placeholder="Valor" id="servicioSeguro5" name="servicioSeguro5" readOnly="readOnly"> </div></div></div>';
            document.getElementById('divServiciosSeguro').innerHTML += '</div>';
            $("#servicioSeguro1").val(respuesta[0]["periodSeguro"]);
            $("#servicioSeguro3").val(respuesta[0]["periodoCalculo"]);
            $("#servicioSeguro4").val(respuesta[0]["monedaCalculo"]);
            $("#servicioSeguro5").val(respuesta[0]["valorSeguro"]);
        },
        error: function (respuesta) {}
    })
})
$(document).on("click", ".btnSeguro", function () {
    var idParaActivar = $(this).attr("numeroParaActivarSeguro");
    var numeroServicio = $(this).attr("numeroservicioseguro");
    var servicioId = "servicioSeguro" + numeroServicio;
    var servicioId1 = document.getElementById(servicioId).value;
    var numeroidtarifa = $(this).attr("numeroidtarifa");
    var numeroServicioSeguro = "servicioSeguro" + numeroServicio;
    if (idParaActivar == 0) {
        $(this).removeClass('btn-danger');
        $(this).addClass('btn-primary');
        $(this).html('Sin guardar');
        $(this).attr('numeroParaActivarSeguro', 1);
        if (servicioId !== "servicioSeguro5") {
            document.getElementById(numeroServicioSeguro).disabled = false;
        } else {
            document.getElementById(numeroServicioSeguro).readOnly = false;
        }
    } else if (idParaActivar == 1) {
        $(this).removeClass('btn-primary');
        $(this).addClass('btn-warning');
        $(this).html('Modificado');
        $(this).attr('numeroParaActivarSeguro', 2);
        if (servicioId !== "servicioSeguro5") {
            document.getElementById(numeroServicioSeguro).disabled = true;
        } else {
            document.getElementById(numeroServicioSeguro).readOnly = true;
        }
        var datos = new FormData();
        datos.append("numeroidtarifa", numeroidtarifa);
        datos.append("servicioId1", servicioId1);
        datos.append("numeroServicio", numeroServicio);
        $.ajax({
            url: "ajax/activarTarifa.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (respuesta) {},
            error: function (respuesta) {}
        })
    } else if (idParaActivar == 2) {
        $(this).removeClass('btn-warning');
        $(this).addClass('btn-primary');
        $(this).html('Sin guardar');
        $(this).attr('numeroParaActivarSeguro', 0);
        if (servicioId !== "servicioSeguro5") {
            document.getElementById(numeroServicioSeguro).disabled = false;
        } else {
            document.getElementById(numeroServicioSeguro).readOnly = false;
        }
    }
});
$(document).on("click", ".btnServiciosManejo", function () {
    var idServicioClienteManejo = $(this).attr("idServicioClienteManejo");
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 5000
    });
    Toast.fire({
        type: 'success',
        title: 'Formulario de modificaciones'
    })
    var datos = new FormData();
    datos.append("idServicioClienteManejo", idServicioClienteManejo);
    $.ajax({
        url: "ajax/activarTarifa.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            document.getElementById("divServiciosManejo").innerHTML = '';
            document.getElementById("divServiciosManejo").innerHTML += '<div class="col-12"><label>Calculo Manejo</label> <div class="input-group mb<-3"><div class="input-group-prepend"> <button type="button" class="btn btn-danger btnManejo" numeroParaActivarManejo=0 numeroIdTarifa=' + idServicioClienteManejo + ' numeroServicioManejo=1>Sin Modificar</button> </div><select class="form-control" disabled="disabled" id="servicioManejo1" name="servicioManejo1"> <option>Tonelada</option> <option>Movimiento</option> <option>Cobro Kg</option><option>Cobro Lb</option> </select> </div></div> <div class="col-12"><label>Moneda Calculo Manejo</label> <div class="input-group mb-3"> <div class="input-group-prepend"> <button type="button" class="btn btn-danger btnManejo" numeroParaActivarManejo=0 numeroIdTarifa=' + idServicioClienteManejo + ' numeroServicioManejo=2>Sin Modificar</button> </div><select class="form-control" disabled="disabled" id="servicioManejo2" name="servicioManejo2"> <option>Quetzales</option><option>Dolares $</option></select></div></div><div class="col-12"> <label>Valor de Manejo</label><div class="input-group mb-3"><div class="input-group-prepend"><button type="button" class="btn btn-danger btnManejo" numeroParaActivarManejo=0 numeroIdTarifa=' + idServicioClienteManejo + ' numeroServicioManejo=3>Sin Modificar</button> <input type="text" class="form-control input-lg" placeholder="Valor" id="servicioManejo3" name="servicioManejo3" readOnly="readOnly"> </div></div> </div>';
            document.getElementById('divServiciosManejo').innerHTML += '</div>';
            $("#servicioManejo1").val(respuesta[0]["baseManejo"]);
            $("#servicioManejo2").val(respuesta[0]["monedaCalculo"]);
            $("#servicioManejo3").val(respuesta[0]["valorManejo"]);
        },
        error: function (respuesta) {}
    })
})
$(document).on("click", ".btnManejo", function () {
    var numeroTarifaManejo = $(this).attr("numeroidtarifa");
    var numeroServicioManejo = $(this).attr("numeroServicioManejo");
    var servicioManejo = "servicioManejo" + numeroServicioManejo;
    var numeroParaActivarManejo = $(this).attr("numeroParaActivarManejo");
    var nombreServicioManejo = document.getElementById(servicioManejo).value;
    if (numeroParaActivarManejo == 0) {
        $(this).removeClass('btn-danger');
        $(this).addClass('btn-primary');
        $(this).html('Sin guardar');
        $(this).attr('numeroparaactivarmanejo', 1);
        if (servicioManejo !== "servicioManejo3") {
            document.getElementById(servicioManejo).disabled = false;
        } else {
            document.getElementById(servicioManejo).readOnly = false;
        }
    } else if (numeroParaActivarManejo == 1) {
        $(this).removeClass('btn-primary');
        $(this).addClass('btn-warning');
        $(this).html('Modificado');
        $(this).attr('numeroparaactivarmanejo', 2);
        if (servicioManejo !== "servicioManejo3") {
            document.getElementById(servicioManejo).disabled = true;
        } else {
            document.getElementById(servicioManejo).readOnly = true;
        }
        var datos = new FormData();
        datos.append("numeroServicioManejo", numeroServicioManejo);
        datos.append("nombreServicioManejo", nombreServicioManejo);
        datos.append("numeroTarifaManejo", numeroTarifaManejo);
        $.ajax({
            url: "ajax/activarTarifa.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (respuesta) {},
            error: function (respuesta) {}
        })
    } else if (numeroParaActivarManejo == 2) {
        $(this).removeClass('btn-warning');
        $(this).addClass('btn-primary');
        $(this).html('Sin Guardar');
        $(this).attr('numeroparaactivarmanejo', 1);
        if (servicioManejo !== "servicioManejo3") {
            document.getElementById(servicioManejo).disabled = false;
        } else {
            document.getElementById(servicioManejo).readOnly = false;
        }
    }
})
$(document).on("click", ".btnGastosAdmin", function () {
    var idServicioClienteGtsAdmin = $(this).attr("idGastosAdministracion");
    var datos = new FormData();
    datos.append("idServicioClienteGtsAdmin", idServicioClienteGtsAdmin);
    $.ajax({
        url: "ajax/activarTarifa.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            if (respuesta == "vacio") {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 5000
                });
                Toast.fire({
                    type: 'error',
                    title: 'Sin Servicio'
                })
                document.getElementById("divServiciosGastosAdmin").innerHTML = '';
                document.getElementById("divServiciosGastosAdmin").innerHTML += '<h1 style="color:blue;">No existe servicio de Gastos de Adminsitración para mostarle</h1>';
            } else {
                document.getElementById("divServiciosGastosAdmin").innerHTML = '';
                document.getElementById("divServiciosGastosAdmin").innerHTML += '<div class="col-12"><label>Gastos Administración</label> <div class="input-group mb-3"><div class="input-group-prepend"><button type="button" class="btn btn-danger btnGtsAdmin" numeroparaActivarGtsAdmin=0 numeroIdTarifa=' + idServicioClienteGtsAdmin + ' numeroServicioGtsAdmin=1>Sin Modificar</button> </div><select class="form-control" disabled="disabled" id="servicioGtsAdmin1" name="servicioGtsAdmin1"><option>Individual</option> <option>Consolidado</option> <option>Por Retiro</option> </select></div></div> <div class="col-12"> <label>Moneda Calculo GtsAdmin</label> <div class="input-group mb-3"> <div class="input-group-prepend"> <button type="button" class="btn btn-danger btnGtsAdmin" numeroparaActivarGtsAdmin=0 numeroIdTarifa=' + idServicioClienteGtsAdmin + ' numeroServicioGtsAdmin=2>Sin Modificar</button> </div><select class="form-control" disabled="disabled" id="servicioGtsAdmin2" name="servicioGtsAdmin2"><option>Quetzales</option><option>Dolares $</option></select> </div></div><div class="col-12"> <label>Valor de Gastos Administracion</label><div class="input-group mb-3"> <div class="input-group-prepend"><button type="button" class="btn btn-danger btnGtsAdmin" numeroparaActivarGtsAdmin=0 numeroIdTarifa=' + idServicioClienteGtsAdmin + ' numeroServicioGtsAdmin=3>Sin Modificar</button> <input type="text" class="form-control input-lg" placeholder="Valor" id="servicioGtsAdmin3" name="servicioGtsAdmin3" readOnly="readOnly"> </div></div> </div>';
                document.getElementById('divServiciosGastosAdmin').innerHTML += '</div>';
                $("#servicioGtsAdmin1").val(respuesta[0]["basegastosAdmin"]);
                $("#servicioGtsAdmin2").val(respuesta[0]["monedaCalculo"]);
                $("#servicioGtsAdmin3").val(respuesta[0]["valorgastosAdmin"]);
            }
        }
    })
})
$(document).on("click", ".btnGtsAdmin", function () {
    var numeroTarifaGtsAdmin = $(this).attr("numeroidtarifa");
    var numeroServicioGtsAdmin = $(this).attr("numeroServicioGtsAdmin");
    var servicioGtsAdmin = "servicioGtsAdmin" + numeroServicioGtsAdmin;
    var numeroparaActivarGtsAdmin = $(this).attr("numeroparaActivarGtsAdmin");
    var nombreServicioGtsAdmin = document.getElementById(servicioGtsAdmin).value;
    if (numeroparaActivarGtsAdmin == 0) {
        $(this).removeClass('btn-danger');
        $(this).addClass('btn-primary');
        $(this).html('Sin guardar');
        $(this).attr('numeroparaActivarGtsAdmin', 1);
        if (servicioGtsAdmin !== "servicioGtsAdmin3") {
            document.getElementById(servicioGtsAdmin).disabled = false;
        } else {
            document.getElementById(servicioGtsAdmin).readOnly = false;
        }
    } else if (numeroparaActivarGtsAdmin == 1) {
        $(this).removeClass('btn-primary');
        $(this).addClass('btn-warning');
        $(this).html('Modificado');
        $(this).attr('servicioGtsAdmin', 2);
        if (servicioGtsAdmin !== "servicioGtsAdmin3") {
            document.getElementById(servicioGtsAdmin).disabled = true;
        } else {
            document.getElementById(servicioGtsAdmin).readOnly = true;
        }
        var datos = new FormData();
        datos.append("numeroServicioGtsAdmin", numeroServicioGtsAdmin);
        datos.append("nombreServicioGtsAdmin", nombreServicioGtsAdmin);
        datos.append("numeroTarifaGtsAdmin", numeroTarifaGtsAdmin);
        $.ajax({
            url: "ajax/activarTarifa.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (respuesta) {},
            error: function (respuesta) {}
        })
    }
})
$(document).on("click", ".btnOtrosGastos", function () {
    var idOtrosGastos = $(this).attr("idOtrosGastos");
    if (idOtrosGastos == "null") {
        swal({
            type: "error",
            title: "Sin servicio",
            text: "No tiene servicios parametrizados de Otros gastos",
            showConfirmButton: true,
            confrimButtonText: "cerrar",
            closeConfirm: true
        });
        document.getElementById("divServiciosOtrosGastos").innerHTML = '';
        document.getElementById("divServiciosOtrosGastos").innerHTML += '<h1 style="color:blue;">No existe servicio de Gastos de Adminsitración para mostarle</h1>';
    } else {
        var datos = new FormData();
        datos.append("idOtrosGastos", idOtrosGastos);
        $.ajax({
            url: "ajax/activarTarifa.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (respuesta) {
                document.getElementById("divServiciosOtrosGastos").innerHTML = '';
                document.getElementById("divServiciosOtrosGastos").innerHTML += '<div class="col-12"><label>Base Otros Gastos</label><div class="input-group mb-3"><div class="input-group-prepend"> <button type="button" class="btn btn-danger btnOtrosGastosIndividual" numeroParaActivarOtrosGastos=0 numeroIdTarifa=' + idOtrosGastos + ' numeroServicioOtrosGastos=1>Sin Modificar</button> </div><select class="form-control" disabled="disabled" id="servicioOtrosGastos1" name="servicioOtrosGastos1"> <option>Cuadrilla carga</option> <option>Cuadrilla descarga</option> </select> </div></div> <div class="col-12"> <label>Moneda Otros Gastos</label> <div class="input-group mb-3"> <div class="input-group-prepend"><button type="button" class="btn btn-danger btnOtrosGastosIndividual" numeroParaActivarOtrosGastos=0 numeroIdTarifa=' + idOtrosGastos + ' numeroServicioOtrosGastos=2>Sin Modificar</button></div><select class="form-control" disabled="disabled" id="servicioOtrosGastos2" name="servicioOtrosGastos2"><option>Quetzales</option><option>Dolares $</option></select></div></div><div class="col-12"> <label>Valor de Otros Gastos</label><div class="input-group mb-3"> <div class="input-group-prepend"><button type="button" class="btn btn-danger btnOtrosGastosIndividual" numeroParaActivarOtrosGastos=0 numeroIdTarifa=' + idOtrosGastos + ' numeroServicioOtrosGastos=3>Sin Modificar</button><input type="text" class="form-control input-lg" placeholder="Valor" id="servicioOtrosGastos3" name="servicioOtrosGastos3" readOnly="readOnly"></div></div></div>';
                document.getElementById('divServiciosOtrosGastos').innerHTML += '</div>';
                $("#servicioOtrosGastos1").val(respuesta[0]["baseotrosGastos"]);
                $("#servicioOtrosGastos2").val(respuesta[0]["monedaCalculo"]);
                $("#servicioOtrosGastos3").val(respuesta[0]["valorotrosGastos"]);
            }
        })
    }
})
$(document).on("click", ".btnOtrosGastosIndividual", function () {
    var numeroParaActivarOtrosGastos = $(this).attr("numeroParaActivarOtrosGastos");
    var numeroTarifaOtrosGastos = $(this).attr("numeroidtarifa");
    var numeroServicioOtrosGastos = $(this).attr("numeroServicioOtrosGastos");
    var servicioOtrosGastos = "servicioOtrosGastos" + numeroServicioOtrosGastos;
    var nombreServicioOtrosGastos = document.getElementById(servicioOtrosGastos).value;
    if (numeroParaActivarOtrosGastos == 0) {
        $(this).removeClass('btn-danger');
        $(this).addClass('btn-primary');
        $(this).html('Sin guardar');
        $(this).attr('numeroParaActivarOtrosGastos', 1);
        if (servicioOtrosGastos !== "servicioOtrosGastos3") {
            document.getElementById(servicioOtrosGastos).disabled = false;
        } else {
            document.getElementById(servicioOtrosGastos).readOnly = false;
        }
    } else if (numeroParaActivarOtrosGastos == 1) {
        $(this).removeClass('btn-primary');
        $(this).addClass('btn-warning');
        $(this).html('Modificado');
        $(this).attr('numeroParaActivarOtrosGastos', 2);
        if (servicioOtrosGastos !== "servicioOtrosGastos3") {
            document.getElementById(servicioOtrosGastos).disabled = true;
        } else {
            document.getElementById(servicioOtrosGastos).readOnly = true;
        }
        var datos = new FormData();
        datos.append("numeroServicioOtrosGastos", numeroServicioOtrosGastos);
        datos.append("nombreServicioOtrosGastos", nombreServicioOtrosGastos);
        datos.append("numeroTarifaOtrosGastos", numeroTarifaOtrosGastos);
        $.ajax({
            url: "ajax/activarTarifa.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (respuesta) {},
            error: function (respuesta) {}
        })
    }
})
$(document).on("click", ".btnEliminarFila", function () {
    var botonelminarfila = $(this).attr("botonelminarfila");
    if (botonelminarfila == 0) {
        $(this).removeClass('btn-danger');
        $(this).addClass('btn-secondary');
        $(this).html('Restaurar');
        $(this).attr('botonelminarfila', 1);
        Swal.fire({
            position: 'center',
            type: 'error',
            title: 'Servicio Anulado, para restaurar valores presione el boton restaurar',
            showConfirmButton: false,
            timer: 1500000
        })
    } else {
        $(this).removeClass('btn-secondary');
        $(this).addClass('btn-primary');
        $(this).html('Restaurado');
        $(this).attr('botonelminarfila', 0);
        Swal.fire({
            position: 'center',
            type: 'success',
            title: 'Servicio Restaurado',
            showConfirmButton: false,
            timer: 1500
        })
    }
    var idNumeroServicio = $(this).attr("id");
    var idNumeroFilaCliente = $(this).attr("idclientefila");
    var datos = new FormData();
    datos.append("idNumeroServicio", idNumeroServicio);
    datos.append("idNumeroFilaCliente", idNumeroFilaCliente);
    datos.append("botonelminarfila", botonelminarfila);
    $.ajax({
        url: "ajax/activarTarifa.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {},
        error: function (respuesta) {}
    })
})
$(document).on("click", ".btnAnulacionTotal", function () {
    var lblClienteIdAnularTotal = document.getElementById("lblClienteId").value;
    var lblNitAnularTotal = document.getElementById("lblNumeroSerie").innerHTML;
    var datos = new FormData();
    datos.append("lblClienteIdAnularTotal", lblClienteIdAnularTotal);
    datos.append("lblNitAnularTotal", lblNitAnularTotal);
    $.ajax({
        url: "ajax/activarTarifa.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            swal({
                title: "Anulada Correctamente",
                type: "success"
            }).then(okay => {
                if (okay) {
                    window.location = "activar";
                }
            });
        },
        error: function (respuesta) {}
    })
})

function printDiv(imprimirCotizacion) {
    var contenido = document.getElementById(imprimirCotizacion).innerHTML;
    var contenidoOriginal = document.body.innerHTML;
    document.body.innerHTML = contenido;
    window.print();
    document.body.innerHTML = contenidoOriginal;
}
