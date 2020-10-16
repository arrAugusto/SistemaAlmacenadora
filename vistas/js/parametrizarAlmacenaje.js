//BUSQUEDA DE DATOS CLIENTES
$(document).on("change", "#consultaNit", async function () {
    var idDato = $(this).val();
    if (idDato == "") {
        limpiarFormParmAlm();
        swal({
            type: "error",
            title: "Selección",
            text: "Selección de nit incorrecta",
            showConfirmButton: true,
            confrimButtonText: "cerrar",
            closeConfirm: true
        })
    } else {
        var consulta = await dataNitCliente(idDato);
        console.log(consulta);
        if (consulta.resp) {

            var llave = false;
            var lleveAlm = false;
            if (consulta.success[0]["estadoTarifa"] == 0 && $("#divParamAlm").length >= 1) {
                lleveAlm = true;
            } else if (consulta.success[0]["estadoTarifa"] == 1 && $("#divParamAlm").length >= 1) {
                lleveAlm = false;
                swal({
                    title: "Tarifa Finalizada",
                    text: "Tarifa vigente, no puede parametrizar",
                    type: "error"
                }).then(okay => {
                    if (okay) {
                        window.location = "detallesTarifa";

                    }
                });
            }
            
            if (consulta.success[0]["estadoTarifa"] == 0 && $("#formDinamic1").length >= 1) {
                var llave = true;
            } else if (consulta.success[0]["estadoTarifa"] == 1 && $("#formDinamic1").length >= 1) {
                llave = false;
            }
            if (consulta.success[0]["estadoTarifa"] == 0 && $("#divTableAccTar").length >= 1) {
                var llave = false;
                redireccion = true;
            } else if (consulta.success[0]["estadoTarifa"] == 1 && $("#divTableAccTar").length >= 1) {
                llave = true;
            }
            
                    document.getElementById("lblCliente").value = consulta.success[0]["usuarioID"];
   
                console.log(53);
                document.getElementById("lblNit").innerHTML = consulta.success[0]["nitEmpresa"];
                document.getElementById("lblEmpresa").innerHTML = consulta.success[0]["razonSocial"];
                document.getElementById("lblDireccion").innerHTML = consulta.success[0]["direccionFiscal"];
                document.getElementById("lblDireccionCobro").innerHTML = consulta.success[0]["direccionRec"];
                document.getElementById("lblTelefono").innerHTML = consulta.success[0]["tel"];
                if ($("#formDinamic1").length >= 1) {
                    var idNit = consulta.success[0]["idNit"];
                    var nomVar = "valorNit";
                    var respForm = await consultGeneralesCliente(nomVar, idDato);
                    console.log(respForm);
                    if (respForm.resp) {
                        var nombreEmpresa = document.getElementById("lblEmpresa").innerHTML;
                        var nitEmpres = document.getElementById("lblNit").innerHTML;
                        document.getElementById('btnLimpiar').innerHTML = '<button type="submit" class="btn btn-warning">Limpiar Pantalla <i class="fa fa-paint-brush"></i></button>';
                        document.getElementById('btnLimpiar').innerHTML += '<button type="button" class="btn btn-primary btnActi">Activar Tarifa <i class="fa fa-paint-brush"></i></button>';
                        document.getElementById("lblCantServicios").innerHTML = respForm.success.length;
                        for (var i = 0; i < respForm.success.length; i++) {
                            var contador = i + 1;
                            var divCl = '<div class="card card-info card-outline" id="';
                            var divCl1 = 'div' + contador;
                            var divCl2 = divCl + divCl1 + '">';
                            var form = 'formDinamic';
                            var form1 = form + contador;
                            document.getElementById(form1).innerHTML = divCl2;
                            document.getElementById(divCl1).innerHTML += '<div class="card-header"><h3 class="card-title" id="h3">Servicio ' + respForm.success[i]['servicio'] + ' / ' + nombreEmpresa + ' / Nit :' + nitEmpres + '</h3><div class="card-tools"><button type="button" class="btn btn-tool btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button><button type="button" class="btn btn-tool btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button></div>';
                            document.getElementById(divCl1).innerHTML += '<div class="card-body" style=" border-style: ridge; border-color: #0CA3AB; bord"></h3><div class="row"><div class="col-md-4"><label>Calculo sobre</label><select class="form-control select2" id="calculoSobreSeguro' + contador + '" name="calculoSobreSeguro' + contador + '"><option>Saldo Diario</option><option>Saldo Anticipado</option></select><span class="fa fa-edit"></span></div><div class="col-md-4"><label>Base de calculo</label><select class="form-control select2" id="baseCalculo' + contador + '" name="baseCalculo' + contador + '" style="width: 100%;" disabled="disabled"><option>Porcentaje</option></select><span class="fa fa-percent"></span></div><div class="col-md-4"><label>Periodo de calculo</label><select class="form-control select2" id="periodoCalculo' + contador + '" name="periodoCalculo' + contador + '" style="width: 100%;"><option>Diario</option><option>Mensual</option><option>Anual</option></select><span class="fa fa-edit"></span></div><div class="col-md-4"><label>Moneda</label><select class="form-control select2" id="monedaSeguro' + contador + '" name="monedaSeguro' + contador + '" style="width: 100%;"><option>Quetzales</option><option>Dolares $</option></select><span class="fa fa-edit"></span></div><div class="col-md-4"><label>Valor Seguro</label><div class="input-group mb-3"><input type="number" class="form-control input-lg"placeholder="Ejemplo : 0.75" id="valorSeguro' + contador + '" name="valorSeguro' + contador + '"><span class="input-group-append" id="divbutton' + contador + 1 + '"></span></div></div><div class="col-md-4"></div></div><h3 class="card-title" id="h3Title">Peso de Mercadería</h3><div class="row"><div class="col-md-4"><label>Calculo de peso</label><select class="form-control select2" id="basePeso' + contador + '" name="basePeso' + contador + '" style="width: 100%;"><option>Tonelada</option><option>Movimiento</option><option>Cobro kg</option><option>Cobro lb</option></select><span class="fa fa-edit"></span></div><div class="col-md-4"><label>Moneda</label><select class="form-control select2" id="monedaPeso' + contador + '" name="monedaPeso' + contador + '" style="width: 100%;"><option>Quetzales</option><option>Dolares $</option></select><span class="fa fa-edit"></span></div><div class="col-md-4"><label>Valor Manejo</label><div class="input-group mb-3"><input type="number" class="form-control input-lg" placeholder="Ejemplo : 70" id="valorPeso' + contador + '" name="valorPeso' + contador + '"><span class="input-group-append" id="divbutton' + contador + 2 + '"></span></div></div></div><h3 class="card-title" id="h3Title">Gastos Administración</h3><div class="row"><div class="col-md-4"><label>Calculo de gastos administración</label><select class="form-control select2" id="valorGastosAdmin' + contador + '" name="valorGastosAdmin' + contador + '" style="width: 100%;"><option>Individual</option><option>Consolidado</option><option>Por retiro</option></select><span class="fa fa-edit"></span></div><div class="col-md-4"><label>Moneda</label><select class="form-control select2" id="monedaGtsAdmin' + contador + '" name="monedaGtsAdmin' + contador + '" style="width: 100%;"><option>Quetzales</option><option>Dolares $</option></select><span class="fa fa-edit"></span></div><div class="col-md-4"><label>Valor Administracion</label><div class="input-group mb-3"><input type="number" class="form-control input-lg" placeholder="Ejemplo : 100" id="valorGtosA' + contador + '" name="valorGtosA' + contador + '" ><span class="input-group-append" id="divbutton' + contador + 3 + '"></span></div></div></div><h3 class="card-title" id="h3Title">Otros Gastos</h3><div class="row"><div class="col-md-4"><label>Calculo de otros Gastos</label><select class="form-control select2" id="calculoOtrosGastos' + contador + '" name="calculoOtrosGastos' + contador + '" style="width: 100%;"><option>Cuadrilla carga</option><option>Cuadrilla descarga</option></select><span class="fa fa-edit"></span></div><div class="col-md-4"><label>Moneda</label><select class="form-control select2" id="monedaOtrosGastos' + contador + '" name="monedaOtrosGastos' + contador + '" style="width: 100%;"><option>Quetzales</option><option>Dolares $</option></select><span class="fa fa-edit"></span></div><div class="col-md-4"><label>Valor Otros Gastos</label><div class="input-group mb-3"><input type="number" class="form-control input-lg" placeholder="Ejemplo : 875" id="valorOtrosGastos' + contador + '" name="valorOtrosGastos' + contador + '" ><span class="input-group-append" id="divbutton' + contador + 4 + '"></span></div></div></div><div class="card-footer" id="endfooter' + contador + '"><div class="btn-group" ><button type="button"  idServicio=' + respForm.success[i]['idTarifa'] + ' idServicioAlmacenadora=' + respForm.success[i]['idServicio'] + '  idContador=' + contador + ' class="btn btn-primary btnSegundaCarga">Guardar Servicios de ' + respForm.success[i]['servicio'] + '</button><button type="button" class="btn btn-danger"data-widget="remove"data-toggle="tooltip"title="Remove">Desactivar Servicio de ' + respForm.success[i]['servicio'] + '</button></div></div></div></div>';
                        }
                    } else if (!respForm.resp) {
                        swal({
                            title: 'No parametrizo el servicio de almacenaje, hagalo para continuar en este formaulario',
                            type: "info"
                        }).then(okay => {
                            if (okay) {
                                window.location = "parametrizarAlmacenaje";
                            }
                        });
                    }
                }
                if ($("#divTableAccTar").length >= 1) {
                    document.getElementById("divTableAccTar").innerHTML = "";
                    document.getElementById("btnActivaImpreme").innerHTML = "";
                    document.getElementById("divTableAccTar").innerHTML = '<table id="tableAccionesTarifa" class="table table-hover"></table>';
                    document.getElementById("lblCorreo").innerHTML = consulta.success[0]["correo"];
                    document.getElementById("lblCliente").value = consulta.success[0]["usuarioID"];
                    document.getElementById("lblNombreEjecutivo").innerHTML = consulta.success[0]["ejecutivo"];
                    document.getElementById("lblTelefonoE").innerHTML = consulta.success[0]["celEje"];
                    document.getElementById("lblCorreoE").innerHTML = consulta.success[0]["correoEje"];
                    var idNit = consulta.success[0]["idNit"];
                    var ActivarTar = "ActivarTar";
                    var respActivar = await consultGeneralesCliente(ActivarTar, idDato);
                    if (respActivar.resp) {
                        var maquetar = await maquetarTarifaAutorizada(respActivar.success, idDato);
                    } else if (respActivar.resp == false && respActivar.error == "sinConcidencia") {
                        swal({
                            title: 'El nit no tiene una tarifa especial parametrizada',
                            type: "error"
                        }).then(okay => {
                            if (okay) {
                                location.reload();
                            }
                        });
                    
                }
            }
        } else if (!consulta.resp && consulta.error == "nitSinTarifa") {
            swal({
                title: 'El nit no tiene una tarifa especial',

                type: "error"
            }).then(okay => {
                if (okay) {
                    location.reload();
                }
            });
        } else if (!consulta.resp && consulta.error == "errorDato") {
            swal({
                title: 'No selecciono nit del cliente',
                type: "error"
            }).then(okay => {
                if (okay) {
                    location.reload();
                }
            });
        } else if (!consulta.resp && consulta.error == "inconcistenica") {
            swal({
                title: 'Comuníquese con soporte técnico Error : ' + consulta.descripcion,
                type: "error"
            }).then(okay => {
                if (okay) {
                    location.reload();
                }
            });
        }
    }
});
//ACTIVAR OTROS SERVICIOS
$(document).on("click", ".btnAct", function () {
    window.location = "activarOtrosServicios";
});
/*
$(document).ready(function () {
    var datos = new FormData();
    datos.append("idNit", 0);
    $.ajax({
        url: "ajax/activarOtrosServicios.ajax.php",
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
        }
    })
})*/
//AJAX BUSCA DATA
function dataNitCliente(idDato) {
    let respuestaFunc;
    var datos = new FormData();
    datos.append("idNit", idDato);
    $.ajax({
        async: false,
        url: "ajax/activarOtrosServicios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            if (respuesta.resp == false || respuesta.resp == true) {
                respuestaFunc = respuesta;
            }
        }, error: function (respuesta) {
            console.log(respuesta);
        }
    })
    return respuestaFunc;
}

//AJAX FORMULARIOS DINAMICOS
function consultGeneralesCliente(nomVar, idDato) {

    let esperaFormD;
    var datos = new FormData();
    datos.append(nomVar, idDato);
    $.ajax({
        async: false,
        url: "ajax/activarOtrosServicios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            esperaFormD = respuesta;

        }, error: function (respuesta) {
            console.log(respuesta);
        }
    })
    return esperaFormD;
}
//MAQUETAR TABLE DE TARIFAS 
function maquetarTarifaAutorizada(respuesta, idCliente) {

    console.log(respuesta);
    var respuesta = "";
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
            console.log(respuesta);
            var lista = [];
            for (var i = 0; i < respuesta.length; i++) {
                if (respuesta[i]['claveAlmacenaje'] == null) {
                    var resBotonAlmacenaje = 'ALMACENAJE <button type="button" class="btn btn-danger btnServicios" BotonAlmacenaje=BotonAlmacenaje' + i + '><i class="fa fa-close"></i></button>';
                } else {
                    var resBotonAlmacenaje = 'ALMACENAJE <button type="button" class="btn btn-info btnServicios" BotonAlmacenaje=BotonAlmacenaje' + i + ' idServicioCliente=' + respuesta[i]['claveAlmacenaje'] + ' data-toggle="modal" data-target="#UpdateServiciosAlmacenajes"><i class="fa fa-check"></i></button>';
                }
                if (respuesta[i]['claveSeguro'] == null) {
                    var resBotonSeguro = 'SEGURO <button type="button" class="btn btn-danger btnServiciosSeguro" BotonSeguro=BotonSeguro' + i + '><i class="fa fa-close"></i></button>';
                } else {
                    var resBotonSeguro = 'SEGURO <button type="button" class="btn btn-info btnServiciosSeguro" BotonSeguro=BotonSeguro' + i + ' id=' + respuesta[i]['claveSeguro'] + ' data-toggle="modal" data-target="#UpdateServiciosSeguro"><i class="fa fa-check"></i></button>';
                }
                if (respuesta[i]['claveManejo'] == null) {
                    var resBotonManejo = 'MANEJO <button type="button" class="btn btn-danger btnServiciosManejo" BotonManejo=BotonManejo' + i + '><i class="fa fa-close"></i></button>';
                } else {
                    var resBotonManejo = 'MANEJO <button type="button" class="btn btn-info btnServiciosManejo" BotonManejo=BotonManejo' + i + ' idServicioClienteManejo=' + respuesta[i]['claveManejo'] + ' data-toggle="modal" data-target="#UpdateServiciosManejo"><i class="fa fa-check"></i></button>';
                }
                if (respuesta[i]['claveGtosAdmin'] == null) {
                    var resBotonGtosAdmin = 'GASTOS ADMIN <button type="button" class="btn btn-danger btnGastosAdmin" BotonGstsAdmin=BotonGstsAdmin' + i + ' ><i class="fa fa-close"></i></button>';
                } else {
                    var resBotonGtosAdmin = 'GASTOS ADMIN <button type="button" class="btn btn-info btnGastosAdmin" BotonGstsAdmin=BotonGstsAdmin' + i + ' idGastosAdministracion=' + respuesta[i]['claveGtosAdmin'] + ' data-toggle="modal" data-target="#UpdateGastosAdministracion"><i class="fa fa-check"></i></button>';
                }
                if (respuesta[i]['claveOtrosGtos'] == null) {
                    var resBotonOtrosGastos = 'OTROS GASTOS <button type="button" class="btn btn-danger btnOtrosGastos" BotonOtrosGts=BotonOtrosGts' + i + '><i class="fa fa-close"></i></button>';
                } else {
                    var resBotonOtrosGastos = 'OTROS GASTOS <button type="button" class="btn btn-info btnOtrosGastos" BotonOtrosGts=BotonOtrosGts' + i + ' idOtrosGastos=' + respuesta[i]['claveOtrosGtos'] + '  data-toggle="modal" data-target="#UpdateOtrosGastos"><i class="fa fa-check"></i></button>';
                }
                lista.push([resBotonAlmacenaje, resBotonSeguro, resBotonManejo, resBotonGtosAdmin, resBotonOtrosGastos, '<button type="button" class="btn btn-danger btn-sm btnEliminarFila" id=' + respuesta[i]["claveAlmacenaje"] + ' idClienteFila=' + idCliente + ' BotonElminarFila=0><i class="fa fa-trash" aria-hidden="true"></i></button>']);
            }
            
            
            
                            if (respuesta[0]["estadoTarifa"] == 1) {
        document.getElementById('btnActivaImpreme').innerHTML = '<button type="button" class="btn btn-success btn-sm btnActivacion" numeroParaActivar=0>Activa</button><button type="button" class="btn btn-warning btn-sm btnAnulacionTotal" numeroParaActivar=0>Anular toda la tarifa</button>';
    } else {
        document.getElementById('btnActivaImpreme').innerHTML = '<button type="button" class="btn btn-danger btn-sm btnActivacion" numeroParaActivar=1>Inactiva</i></button><button type="button" class="btn btn-warning btn-sm btnAnulacionTotal" numeroParaActivar=0>Anular toda la tarifa</button>';
    }
            
            
            $('#tableAccionesTarifa').DataTable({
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

        }
    })
}



/*=============================================
 DATA TABLES
 =============================================*/
$(document).ready(function () {
    var table = $('#tablas').DataTable({
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

    // Apply the search
    table.columns().every(function () {
        var that = this;
        $('input', this.header()).on('keyup change', function () {
            if (that.search() !== this.value) {
                that.search(this.value).draw();
            }
        });
    });
    //Add row button
    $('.dt-add').each(function () {
        $(this).on('click', function (evt) {
            //Create some data and insert it
            var rowData = [];
            //Tomando el numero de fila para agregar orden
            var info = table.page.info();
            //Contador y agregar fila
            rowData.push(info.recordsTotal + 1);
            var idServicio = $(this).attr("idServicio");
            rowData.push(idServicio);
            rowData.push('<select class="form-control select2" style="width: 100%;" name="dependencia"><option>Saldo Diario</option><option>Saldo Anticipado</option></select>');
            rowData.push('<select class="form-control select2" style="width: 100%;" name="dependencia"><option>Posiciones</option><option>Porcentaje</option><option>Metros²</option><option>Metros³</option><option>Unidad</option></select>');
            rowData.push('<select class="form-control select2" style="width: 100%;" name="dependencia"><option>Diario</option><option>Mensual</option><option>Anual</option></select>');
            rowData.push('<select class="form-control select2" style="width: 100%;" name="dependencia"><option>Quetzales</option><option>Porcentaje %</option><option>Dolares $</option></select>');
            rowData.push('<input type="text" class="form-control" style="width: 100%;" placeholder="Valor">');
            rowData.push('<div class="btn-group"><button  type="button" data-func="dt-add" class="btn btn-outline-danger dt-add"><i class="fa fa-plus"></i></button><button  type="button" data-func="dt-add" class="btn btn-outline-danger dt-add"><i class="fa fa-cloud-upload"></i></button></div>');
            //INSERT THE ROW
            table.row.add(rowData).draw(false);
            //iCheck for checkbox and radio inputs
            $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
            })
            //Red color scheme for iCheck
            $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
                checkboxClass: 'icheckbox_minimal-red',
                radioClass: 'iradio_minimal-red'
            })
            //Flat red color scheme for iCheck
            $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            })
            //Initialize Select2 Elements
            $('.select2').select2()
        });
    });
    /*
     $('#tablas td').attr('role', 'gridcell');
     $('#tablas tr').attr('role', 'row');
     $('#tablas th').attr('role', 'gridcell');
     $('#tablas table').attr('role', 'grid');
     $('#tablas td:nth-of-type(7)').attr('contenteditable', 'true');
     
     $('#tablas td:nth-of-type(13)').attr('contenteditable', 'true');
     */
    $(document).on("click", ".btnGuardar", function () {
        var id = $(this).attr("idServicio");
        var estadoUsuario = $(this).attr("estadoUsuario");
        var calculosobre = "#calculoSobre";
        calculosobre += estadoUsuario;
        var baseCalculo = "#baseCalculo";
        baseCalculo += estadoUsuario;
        var periodoCobro = "#periodoCobro";
        periodoCobro += estadoUsuario;
        var moneda = "#moneda";
        moneda += estadoUsuario;
        var valorAlmacenaje = "#valorAlmacenaje";
        valorAlmacenaje += estadoUsuario;
        var nit = document.getElementById("lblCliente").value;
        if (nit == "") {
            swal({
                type: "error",
                title: "Selección",
                text: "Seleccione el cliente para continuar",
                showConfirmButton: true,
                confrimButtonText: "cerrar",
                closeConfirm: true
            });
        } else {
            var dato1 = table.$(calculosobre).val();
            var dato2 = table.$(baseCalculo).val();
            var dato3 = table.$(periodoCobro).val();
            var dato4 = table.$(moneda).val();
            var dato5 = table.$(valorAlmacenaje).val();
            if (dato5 == "") {
                swal({
                    type: "error",
                    title: "Monto",
                    text: "El valor de calculo no puede ser vacia ingrese el valor correcto",
                    showConfirmButton: true,
                    confrimButtonText: "cerrar",
                    closeConfirm: true
                });
            } else {
                var datos = new FormData();
                datos.append("idServicio", id);
                datos.append("idNit", nit);
                datos.append("calculosobre", dato1);
                datos.append("baseCalculo", dato2);
                datos.append("periodoCobro", dato3);
                datos.append("moneda", dato4);
                datos.append("valorAlmacenaje", dato5);
                $.ajax({
                    url: "ajax/activarTarifa.ajax.php",
                    method: "POST",
                    data: datos,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function (respuesta) {
                        console.log(respuesta)
                    },
                    error: function (respuesta) {
                        console.log(respuesta);
                    }
                })
                var selectCalculoSobre = ('<select class="form-control select2" style="width: 100%;" name="dependencia" disabled="disabled"><option>');
                selectCalculoSobre += dato1;
                selectCalculoSobre += ('</option></select>');
                var selectBaseCalculo = ('<select class="form-control select2" style="width: 100%;" name="dependencia" disabled="disabled"><option>');
                selectBaseCalculo += dato2;
                selectBaseCalculo += ('</option></select>');
                var selectPeriodoCalculo = ('<select class="form-control select2" style="width: 100%;" name="dependencia" disabled="disabled"><option>');
                selectPeriodoCalculo += dato3;
                selectPeriodoCalculo += ('</option></select>');
                var selectMoneda = ('<select class="form-control select2" style="width: 100%;" name="dependencia" disabled="disabled"><option>');
                selectMoneda += dato4;
                selectMoneda += ('</option></select>');
                var selectMoneda = ('<select class="form-control select2" style="width: 100%;" name="dependencia" disabled="disabled"><option>');
                selectMoneda += dato4;
                selectMoneda += ('</option></select>');
                var txtValor = ('<input type="text" class="form-control" style="width: 100%;" value="');
                txtValor += dato5;
                txtValor += ('" readonly>');
                //Crear lista de datos datatable.
                var rowData = [];
                //Tomando el numero de fila para agregar orden
                var info = table.page.info();
                //Contador y agregar fila
                rowData.push(info.recordsTotal + 1);
                var servicioAlmacenaje = $(this).attr("servicioAlmacenaje");
                rowData.push(servicioAlmacenaje);
                rowData.push(selectCalculoSobre);
                rowData.push(selectBaseCalculo);
                rowData.push(selectPeriodoCalculo);
                rowData.push(selectMoneda);
                rowData.push(txtValor);
                rowData.push('<button type="button" class="btn btn-danger btnEliminar">Otros Servicios</button>');
                //INSERT THE ROW
                table.row.add(rowData).draw(false);
                swal({
                    type: "success",
                    title: "SERVICIO ACTUALIZADO",
                    text: "El servicio fue actualizado correctamente",
                    showConfirmButton: true,
                    confrimButtonText: "cerrar",
                    closeConfirm: true
                });
                $(this).removeClass('btn btn-outline-success');
                $(this).addClass('btn btn-warning');
                $(this).html('Servicio Agregada');
            }
        }
    });
    $(document).on("click", ".btnEliminar", function () {
        Swal.fire({
            position: 'center',
            type: 'info',
            title: '¡Para eliminar este servicio vaya configuracion de tarifas!',
            showConfirmButton: false,
            timer: 5000
        })
    });
});
