$(document).on("click", ".bntImprimir", function () {
    var buttonid = $(this).attr("buttonid");
    window.open("extensiones/tcpdf/pdf/Ingreso-oficina-fiscal.php?codigo=" + buttonid, "_blank");
})

$(document).on("click", ".btnEditOp", function () {
    var valEstaod = $(this).attr("estado");
    console.log(valEstaod);
    document.getElementById("cartaDeCupoEditOp").value = '';
    document.getElementById("cantContenedoresEditOp").value = '';
    document.getElementById("duaEditOp").value = '';
    document.getElementById("blEditOp").value = '';
    document.getElementById("polizaEditOp").value = '';
    document.getElementById("bultosEditOp").value = '';
    document.getElementById("puertoOrigenEditOp").value = '';
    document.getElementById("cantClientesEditOp").value = '';
    document.getElementById("productoEditOp").value = '';
    document.getElementById("pesoIngEditOp").value = '';
    document.getElementById("valorTotalAduanaEditOp").value = '';
    document.getElementById("tipoDeCambioEditOp").value = '';
    document.getElementById("totalValorCifEditOp").value = '';
    document.getElementById("valorImpuestoEditOp").value = '';
    var idIngEditOp = $(this).attr("btnEditOp");
    document.getElementById("hiddenIdentity").value = idIngEditOp;
    var datos = new FormData();
    datos.append("idIngEditOp", idIngEditOp);
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
            var cCupo = respuesta["dataIng"][0].cCupo;
            var cantContenedores = respuesta["dataIng"][0].cantContenedores;
            var numDua = respuesta["dataIng"][0].numDua;
            var BLEmbarque = respuesta["dataIng"][0].BLEmbarque;
            var numPoliza = respuesta["dataIng"][0].numPoliza;
            var bultos = respuesta["dataIng"][0].bultos;
            var puertoOrigen = respuesta["dataIng"][0].puertoOrigen;
            var cantClientes = respuesta["dataIng"][0].cantClientes;
            var tipoProducto = respuesta["dataIng"][0].tipoProducto;
            var totalAduana = respuesta["dataIng"][0].totalAduana;
            var totalAduana = respuesta["dataIng"][0].totalAduana;
            var tCambio = respuesta["dataIng"][0].tCambio;
            var valCif = respuesta["dataIng"][0].valCif;
            var cantPeso = respuesta["dataIng"][0].cantPeso;
            var valImpuesto = respuesta["dataIng"][0].valImpuesto;
            var identReg = respuesta["dataIng"][0].identReg;
            var servicioIng = respuesta["dataIng"][0].servicioIng;
            var fechaIngreso = respuesta["dataIng"][0]["fechaRealFormat"];
            document.getElementById("regimenPolizaEditOp").value = identReg;
            document.getElementById("dateTimes").value = fechaIngreso;
            document.getElementById("hiddenDateTime").value = fechaIngreso;
            document.getElementById("serviciosEditOp").value = servicioIng;
            document.getElementById("cartaDeCupoEditOp").value = cCupo;
            document.getElementById("cantContenedoresEditOp").value = cantContenedores;
            document.getElementById("duaEditOp").value = numDua;
            document.getElementById("blEditOp").value = BLEmbarque;
            document.getElementById("polizaEditOp").value = numPoliza;
            document.getElementById("bultosEditOp").value = bultos;
            document.getElementById("puertoOrigenEditOp").value = puertoOrigen;
            document.getElementById("cantClientesEditOp").value = cantClientes;
            document.getElementById("productoEditOp").value = tipoProducto;
            document.getElementById("pesoIngEditOp").value = cantPeso;
            document.getElementById("valorTotalAduanaEditOp").value = totalAduana;
            document.getElementById("tipoDeCambioEditOp").value = tCambio;
            document.getElementById("totalValorCifEditOp").value = valCif;
            document.getElementById("valorImpuestoEditOp").value = valImpuesto;
            document.getElementById("hiddenTipoCalcelDate").value = 1;
            let tipoOpcion = respuesta.tipo;
            var objTipo = new Object();
            objTipo.objTipoOpcion = tipoOpcion;

            if (objTipo.objTipoOpcion == 0) {
                document.getElementById("divAcciones").innerHTML = '<div class="btn-group"><button type="button" class="btn btn-warning btnEdicionIngreso" idIngresoEditado=' + idIngEditOp + ' estado=0>Editar Ingreso&nbsp;&nbsp;<i class="fa fa-edit"></i></button></div>';

            }
            if (objTipo.objTipoOpcion == 1) {
                document.getElementById("divAcciones").innerHTML = '<div class="btn-group"><button type="button" class="btn btn-warning btnEdicionIngreso" idIngresoEditado=' + idIngEditOp + ' estado=0>Editar Ingreso&nbsp;&nbsp;<i class="fa fa-edit"></i></button><button type="button" class="btn btn-success btnMasRubrosIngGeneral" data-toggle="modal" data-target="#modalNuevosServicios" idIngresoExtra=' + idIngEditOp + '>Servicio Extra</button></div>';

            }
        }, error: function (respuesta) {
            console.log(respuesta);
        }
    });

    var css = "display: block;";
    document.getElementById("divEdiciones").setAttribute("style", css);
    if (valEstaod >= 1 || valEstaod <= 3) {
        var datos = new FormData();
        datos.append("idIngClientesPlt", idIngEditOp);
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
                if (respuesta.dataDet.tipoDet == "Vehiculos") {
                    document.getElementById("divEdicionClientes").innerHTML = '';
                    document.getElementById("divEdicionClientes").innerHTML = '<table id="tableClientesEdit" class="table dt-responsive table-sm table-hover">';
                    var lista = [];
                    var numero = 0;
                    for (var i = 0; i < respuesta.dataDet.respuestaClientes.length; i++) {
                        var numero = numero + 1;
                        var idChas = respuesta.dataDet.respuestaClientes[i].id;
                        var chasis = respuesta.dataDet.respuestaClientes[i].chasis;
                        var tipoVehiculo = respuesta.dataDet.respuestaClientes[i].tipoVehiculo;
                        var linea = respuesta.dataDet.respuestaClientes[i].linea;
                        var accion = '<button type="button" class="btn btn-warning btn-block btnEditChasis" data-toggle="modal" data-target="#modalChasisEdit" idChasis=' + idChas + ' chasis=' + chasis + ' tipoV=' + tipoVehiculo + ' linea=' + linea + '><i class="fa fa-edit"></i></button>';
                        lista.push([numero, chasis, tipoVehiculo, linea, accion]);
                    }
                    console.log(lista);
                    $('#tableClientesEdit').DataTable({
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
                                title: "Chasis"
                            }, {
                                title: "Tipo vehículo"
                            }, {
                                title: "Linea Vehículo"
                            }, {
                                title: "Edición"
                            }]
                    });
                    return 0;
                }
                if (respuesta.dataDet.tipoDet == "Mercaderia") {
                    document.getElementById("divEdicionClientes").innerHTML = '';
                    document.getElementById("divEdicionClientes").innerHTML = '<table id="tableClientesEdit" class="table dt-responsive table-sm table-hover">';
                    var lista = [];
                    console.log(respuesta);
                    let tipoOpcion = respuesta.tipo;
                    var objTipo = new Object();
                    objTipo.objTipoOpcion = tipoOpcion;

                    for (var i = 0; i < respuesta["dataDet"]["respuestaClientes"].length; i++) {
                        var numero = i + 1;
                        var identi = respuesta["dataDet"]["respuestaClientes"][i].identi;
                        var nombreEmpresa = '<input type="text" class="form-control" value="' + respuesta["dataDet"]["respuestaClientes"][i].nombreEmpresa + '" id=nomEmpresa' + identi + ' readonly="readOnly">';
                        var cantBultos = '<input type="text" class="form-control"  value="' + respuesta["dataDet"]["respuestaClientes"][i].cantBultos + '" id=bltsEmpresa' + identi + ' readonly="readOnly">';
                        var cantPeso = '<input type="text" class="form-control" value="' + respuesta["dataDet"]["respuestaClientes"][i].cantPeso + '" id="pesoEmpresa' + identi + '" readonly="readOnly">';
                        if (valEstaod <= 2) {
                            if (respuesta["dataDet"]["respuestaClientes"].length >= 2) {
                                if (objTipo.objTipoOpcion == 0) {
                                    var accion = '<div class="input-group-prepend"><button type="button" class="btn btn-danger btnEliminarDetalle" numerobuttontrash="' + identi + '" numbtneliminar="' + identi + '"><i class="fa fa-trash"></i></button><button type="button" class="btn btn-warning btnEditar" buttonEditar=' + idIngEditOp + ' numbtneditar=' + identi + ' btnestadoedicion="0"><i class="fa fa-edit" aria-hidden="true"></i></button> </div>';

                                }
                                if (objTipo.objTipoOpcion == 1) {
                                    var accion = '<div class="input-group-prepend"><button type="button" class="btn btn-danger btnEliminarDetalle" numerobuttontrash="' + identi + '" numbtneliminar="' + identi + '"><i class="fa fa-trash"></i></button><button type="button" class="btn btn-warning btnEditar" buttonEditar=' + idIngEditOp + ' numbtneditar=' + identi + ' btnestadoedicion="0"><i class="fa fa-edit" aria-hidden="true"></i></button><button type="button" class="btn btn-success btnNewServDeta" data-toggle="modal" data-target="#modalNuevosServicios" buttonServDet=' + identi + '>Servicio Extra</button></div>';

                                }
                            } else {
                                var accion = '<div class="input-group-prepend"><button type="button" class="btn btn-danger btnEliminarDetalle" numerobuttontrash="' + identi + '" numbtneliminar="' + identi + '"><i class="fa fa-trash"></i></button><button type="button" class="btn btn-warning btnEditar" buttonEditar=' + idIngEditOp + ' numbtneditar=' + identi + ' btnestadoedicion="0"><i class="fa fa-edit" aria-hidden="true"></i></button> </div>';

                            }

                        } else {
                            if (respuesta["dataDet"]["respuestaClientes"].length >= 2) {
                                if (objTipo.objTipoOpcion == 0) {
                                    var accion = '<div class="input-group-prepend"><button type="button" class="btn btn-warning btnEditar" buttonEditar=' + idIngEditOp + ' numbtneditar=' + identi + ' btnestadoedicion="0"><i class="fa fa-edit" aria-hidden="true"></i></button></div>';

                                }
                                if (objTipo.objTipoOpcion == 1) {
                                    var accion = '<div class="input-group-prepend"><button type="button" class="btn btn-warning btnEditar" buttonEditar=' + idIngEditOp + ' numbtneditar=' + identi + ' btnestadoedicion="0"><i class="fa fa-edit" aria-hidden="true"></i></button><button type="button" class="btn btn-success btnNewServDeta" data-toggle="modal" data-target="#modalNuevosServicios" buttonServDet=' + identi + '>Servicio Extra</button> </div>';

                                }
                            } else {
                                var accion = '<div class="input-group-prepend"><button type="button" class="btn btn-warning btnEditar" buttonEditar=' + idIngEditOp + ' numbtneditar=' + identi + ' btnestadoedicion="0"><i class="fa fa-edit" aria-hidden="true"></i></button></div>';
                            }



                        }


                        lista.push([numero, nombreEmpresa, cantBultos, cantPeso, accion]);
                    }


                    $('#tableClientesEdit').DataTable({
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
                                title: "nombreEmpresa"
                            }, {
                                title: "cantBultos"
                            }, {
                                title: "cantPeso"
                            }, {
                                title: "accion"
                            }]
                    });
                    /*
                     document.getElementById("divEdicionUnidades").innerHTML = '';
                     document.getElementById("divEdicionUnidades").innerHTML = '<table id="tablePilotoEdit" class="table dt-responsive table-sm table-hover">';
                     var listaPilotos = [];
                     /*       for (var i = 0; i < respuesta["respuestaPiloto"].length; i++) {
                     var numero = i+1;
                     var piloto = respuesta["respuestaPiloto"][i].piloto;
                     var licencia = respuesta["respuestaPiloto"][i].licencia;
                     var placa = respuesta["respuestaPiloto"][i].placa;
                     var contenedor = respuesta["respuestaPiloto"][i].contenedor;
                     var marchamoIng = respuesta["respuestaPiloto"][i].marchamoIng;
                     var accion = '<div class="btn-group"><button type="button" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button><button type="button" class="btn btn-danger btn-sm"><i class="fa fa-close"></i></button></div>';
                     
                     listaPilotos.push([numero, piloto, licencia, placa, contenedor, marchamoIng, accion]);
                     }
                     
                     
                     $('#tablePilotoEdit').DataTable({
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
                     title: "piloto"
                     }, {
                     title: "licencia"
                     }, {
                     title: "placa"
                     }, {
                     title: "contenedor"
                     }, {
                     title: "marchamoIng"
                     }, {
                     title: "Acciones"
                     }]
                     });
                     */
                }
            }, error: function (respuesta) {
                console.log(respuesta);


            }
        });

    }
});



$(document).on("click", ".btnCambiarFechaRever", function () {
    var fechaAnterior = document.getElementById("dateTimes").value;
    document.getElementById("divReverse").innerHTML = `
                                    <input type="text" id ="dateTimes" class="form-control is-valid" readOnly="" value="` + fechaAnterior + `">
                                    <span class="input-group-append">
                                        <button type="button" class="btn btn-warning btn-flat btnCambiarFecha" estado=0>Cambiar Fecha</button>
                                    </span>`;
    var cssEditOp = "display: none";
    document.getElementById("divFechaNuevaEditOP").setAttribute("style", cssEditOp);
    document.getElementById("hiddenDateTime").value = fechaAnterior;
});

$(document).on("click", ".btnCambiarFecha", function () {
    var estado = $(this).attr("estado");
    if (estado == 0) {
        var cssEditOp = "display: block;";
        document.getElementById("divFechaNuevaEditOP").setAttribute("style", cssEditOp);
        $(this).removeClass("btn-warning");
        $(this).addClass("btn-success");
        $(this).html("Restablecer Fecha Anterior");
        $(this).attr("estado", 1);
        $(this).parent().remove();
        $("#dateTimes").removeClass("is-valid");
        $("#dateTimes").addClass("is-invalid");
        $("#dateTime").addClass("is-valid");
        var fechaNueva = document.getElementById("dateTime").value;
        $("#hiddenDateTime").val(fechaNueva);
        Swal.fire('Configure su nueva fecha',
                'Fecha asignada hoy : ' + fechaNueva,
                'info');
    } else if (estado == 1) {
        var cssEditOp = "display: none;";
        document.getElementById("divFechaNuevaEditOP").setAttribute("style", cssEditOp);
        $(this).removeClass("btn-success");
        $(this).addClass("btn-warning");
        $(this).html("Cambiar fecha");
        $(this).attr("estado", 0);
        $("#dateTimes").removeClass("is-invalid ");
        $("#dateTimes").addClass("is-valid");
        var fechaNueva = document.getElementById("dateTimes").value;
        $("#hiddenDateTime").val(fechaNueva);
    }
});

$(document).on("click", ".btnEdicionIngreso", function () {

    var estado = $(this).attr("estado");
    var idIngresoEditado = $(this).attr("idIngresoEditado");
    if (estado == 0) {
        $("#btnCancelDateSinglePick").removeClass("cancelBtn");
        $("#btnCancelDateSinglePick").addClass("btnSingleMod");
        $(this).removeClass("btn-warning");
        $(this).addClass("btn-primary");
        $(this).html("Guardar");
        $(this).attr("estado", 1);
        document.getElementById("cartaDeCupoEditOp").readOnly = false;
        document.getElementById("cantContenedoresEditOp").readOnly = false;
        document.getElementById("duaEditOp").readOnly = false;
        document.getElementById("blEditOp").readOnly = false;
        document.getElementById("polizaEditOp").readOnly = false;
        document.getElementById("bultosEditOp").readOnly = false;
        document.getElementById("puertoOrigenEditOp").readOnly = false;
        document.getElementById("cantClientesEditOp").readOnly = false;
        document.getElementById("productoEditOp").readOnly = false;
        document.getElementById("pesoIngEditOp").readOnly = false;
        document.getElementById("valorTotalAduanaEditOp").readOnly = false;
        document.getElementById("tipoDeCambioEditOp").readOnly = false;
        document.getElementById("totalValorCifEditOp").readOnly = false;
        document.getElementById("valorImpuestoEditOp").readOnly = false;
        document.getElementById("regimenPolizaEditOp").disabled = false;
        document.getElementById("serviciosEditOp").disabled = false;
    } else if (estado == 1) {
        Swal.fire({
            title: '¿Desea Guardar Cambios?',
            text: "Sus cambios serviran para cobros de almacenaje",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Deseo Guardar cambios'
        }).then((result) => {
            if (result.value) {

                var regimenPolizaEditOp = document.getElementById("regimenPolizaEditOp").value;
                var cartaDeCupoEditOp = document.getElementById("cartaDeCupoEditOp").value;
                var cantContenedoresEditOp = document.getElementById("cantContenedoresEditOp").value;
                var duaEditOp = document.getElementById("duaEditOp").value;
                var blEditOp = document.getElementById("blEditOp").value;
                var polizaEditOp = document.getElementById("polizaEditOp").value;
                var bultosEditOp = document.getElementById("bultosEditOp").value;
                var puertoOrigenEditOp = document.getElementById("puertoOrigenEditOp").value;
                var cantClientesEditOp = document.getElementById("cantClientesEditOp").value;
                var productoEditOp = document.getElementById("productoEditOp").value;
                var pesoIngEditOp = document.getElementById("pesoIngEditOp").value;
                var valorTotalAduanaEditOp = document.getElementById("valorTotalAduanaEditOp").value;
                var tipoDeCambioEditOp = document.getElementById("tipoDeCambioEditOp").value;
                var totalValorCifEditOp = document.getElementById("totalValorCifEditOp").value;
                var valorImpuestoEditOp = document.getElementById("valorImpuestoEditOp").value;
                var fechaIngEditOp = document.getElementById("hiddenDateTime").value;
                console.log(fechaIngEditOp);
                var serviciosEditOp = document.getElementById("serviciosEditOp").value;
                var datos = new FormData();
                datos.append("idIngresoEditado", idIngresoEditado);
                datos.append("cartaDeCupoEditOp", cartaDeCupoEditOp);
                datos.append("cantContenedoresEditOp", cantContenedoresEditOp);
                datos.append("duaEditOp", duaEditOp);
                datos.append("blEditOp", blEditOp);
                datos.append("polizaEditOp", polizaEditOp);
                datos.append("bultosEditOp", bultosEditOp);
                datos.append("puertoOrigenEditOp", puertoOrigenEditOp);
                datos.append("cantClientesEditOp", cantClientesEditOp);
                datos.append("productoEditOp", productoEditOp);
                datos.append("pesoIngEditOp", pesoIngEditOp);
                datos.append("valorTotalAduanaEditOp", valorTotalAduanaEditOp);
                datos.append("tipoDeCambioEditOp", tipoDeCambioEditOp);
                datos.append("totalValorCifEditOp", totalValorCifEditOp);
                datos.append("valorImpuestoEditOp", valorImpuestoEditOp);
                datos.append("regimenPolizaEditOp", regimenPolizaEditOp);
                datos.append("fechaIngEditOp", fechaIngEditOp);
                datos.append("serviciosEditOp", serviciosEditOp);

                $.ajax({
                    url: "ajax/historiaIngresosFisacales.ajax.php",
                    method: "POST",
                    data: datos,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function (respuesta) {
                        console.log(respuesta);
                        if (respuesta == "Okk") {
                            document.getElementById("cartaDeCupoEditOp").readOnly = true;
                            document.getElementById("cantContenedoresEditOp").readOnly = true;
                            document.getElementById("duaEditOp").readOnly = true;
                            document.getElementById("blEditOp").readOnly = true;
                            document.getElementById("polizaEditOp").readOnly = true;
                            document.getElementById("bultosEditOp").readOnly = true;
                            document.getElementById("puertoOrigenEditOp").readOnly = true;
                            document.getElementById("cantClientesEditOp").readOnly = true;
                            document.getElementById("productoEditOp").readOnly = true;
                            document.getElementById("pesoIngEditOp").readOnly = true;
                            document.getElementById("valorTotalAduanaEditOp").readOnly = true;
                            document.getElementById("tipoDeCambioEditOp").readOnly = true;
                            document.getElementById("totalValorCifEditOp").readOnly = true;
                            document.getElementById("valorImpuestoEditOp").readOnly = true;
                            document.getElementById("regimenPolizaEditOp").disabled = true;
                            document.getElementById("serviciosEditOp").disabled = true;
                            Swal.fire({
                                position: 'top-center',
                                type: 'success',
                                title: 'Se hicieron las ediciones, en la base de datos',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    }, error: function (respuesta) {
                        console.log(respuesta);
                    }
                });
            }
        });
    }
});

function capturaConversion(e) {
    var tAduana = document.getElementById("valorTotalAduanaEditOp").value;
    var tCambio = document.getElementById("tipoDeCambioEditOp").value;
    if (!isNaN(tAduana) && !isNaN(tCambio)) {
        var valCif = (tAduana * tCambio);
        var valCif = parseFloat(valCif).toFixed(2);
        document.getElementById("totalValorCifEditOp").value = valCif;
    } else if (isNaN(tAduana) || isNaN(tCambio)) {
        Swal.fire('Dato no admitido',
                'No puede ingresar digitos de tipo texto',
                'error');
    }
}


$(document).ready(function () {
    $('.tableClientesEdit').dataTable();
});

$(document).on("click", ".btnAnularIngreso", function () {
    var idIngresoAnulacion = $(this).attr("numeroIdIngreso");
    var textMotivo = document.getElementById("textMotivoAnulacion").value;
    var motivoAnula = textMotivo.substr(19, textMotivo.length);
    console.log(motivoAnula);
    var datos = new FormData();
    datos.append("idIngresoAnulacion", idIngresoAnulacion);
    datos.append("motivoAnula", motivoAnula);


    $.ajax({
        url: "ajax/historiaIngresosFisacales.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            if (respuesta[0]["resp"] == 1) {
                swal({
                    title: "Anulado",
                    text: "El ingreso se anulo correctamente",
                    type: "success"
                }).then(okay => {
                    if (okay) {
                        location.reload();
                    }
                });

            } else {
                Swal.fire({
                    position: 'top-center',
                    type: 'error',
                    title: 'Error el ingreso no se pudo anular revise el ingreso que quiere anular',
                    showConfirmButton: false,
                    closeConfirm: true

                });
            }
        }, error: function (respuesta) {
            console.log(respuesta);
        }
    });
});

$(document).on("click", ".btnAnularMostModal", function () {
    var buttonId = $(this).attr("buttonId");
    var buttonId = parseInt(buttonId);
    console.log(buttonId);
    $("#anulacionDefinitiva").attr("numeroIdIngreso", buttonId);
    var numIng = (buttonId + 10000);
    document.getElementById("numeroIngreso").value = numIng;
})

$(document).on("keyup", "#textMotivoAnulacion", function () {
    const carateres = 150;

    var Motivo = $(this).val();
    var MotivoMayusc = $(this).val().toUpperCase();
    $(this).val(MotivoMayusc);
    var lenghtMotivo = Motivo.length;
    var totalCaracteres = (lenghtMotivo - 20);
    var caracteresMostrado = carateres - totalCaracteres;

    if (totalCaracteres <= -1) {
        $(this).removeClass("is-valid");
        $(this).addClass("is-invalid");
        $(this).val("SE ANULO DEBIDO A :");
        $("#anulacionDefinitiva").removeClass("btnAnularIngreso");
        $("#anulacionDefinitiva").addClass("btnPendiente");
        document.getElementById("anulacionDefinitiva").disabled = true;
    } else if (totalCaracteres >= 5) {

        document.getElementById("conteoCaracteres").innerHTML = caracteresMostrado;
        $(this).removeClass("is-invalid");
        $(this).addClass("is-valid");
        $("#anulacionDefinitiva").addClass("btnAnularIngreso");
        document.getElementById("anulacionDefinitiva").disabled = false;
    } else if (totalCaracteres <= 4) {
        $(this).removeClass("is-valid");
        $(this).addClass("is-invalid");
        $("#anulacionDefinitiva").removeClass("btnAnularIngreso");
        $("#anulacionDefinitiva").addClass("btnPendiente");
        document.getElementById("anulacionDefinitiva").disabled = true;
    }
});


$(document).on("click", ".btnMasRubrosIngGeneral", async function () {
    document.getElementById("divOtrosServicios").innerHTML = "";
    var idingresoextra = $(this).attr("idingresoextra");
    $(".bntNewRegister").attr("tipo", 1);
    $(".bntNewRegister").attr("idingresoextra", idingresoextra);
    var nomVar = "verCobrado";
    var respuesta = await insertNuevoServicio(nomVar, idingresoextra);
    if (respuesta == "SD") {
        Swal.fire({
            title: 'Sin servicios Agregados',
            text: "No tiene declarado ningun servicio extra por cobrar!",
            type: 'info',
            confirmButtonColor: '#3085d6',
            allowOutsideClick: false,
            confirmButtonText: 'Ok'
        })
    } else {
        //divOtrosServicios

        for (var i = 0; i < respuesta.length; i++) {
            var selectOtrosServ = respuesta[i].idServicio;
            var idCobro = respuesta[i].id;
            var selected = respuesta[i].otrosServicios;
            var montoOtroServicio = respuesta[i].montoExtra;
            $("#divOtrosServicios").append('<div id="divNumero" class="col-12"><div class="input-group mb-3"><div class="input-group-prepend"><button type="button" class="btn btn-info btnEliminarOtroServ" id="valueCombo' + selectOtrosServ + '" idValue="' + idCobro + '"><i class="fa fa-trash"></i></button></div><input type="text" class="form-control" readOnly="readOnly" value="' + selected + '" /><input type="number"  class="form-control textOtros" id="montoServicioText' + selectOtrosServ + '" value="' + montoOtroServicio + '" /></div></div>');

        }
    }

});
$(document).on("click", ".btnNuevoServicioEx", async function () {
    var nomVar = "nuevoServicio";
    var nuevoServicio = document.getElementById("textParamNuevoServicio").value;
    var resp = await insertNuevoServicio(nomVar, nuevoServicio);
    if (resp[0].resp == 1) {
        Swal.fire({
            title: 'Transacción satisfactoria',
            text: "Se guardo con éxito el nuevo servicio!",
            type: 'success',
            confirmButtonColor: '#3085d6',
            allowOutsideClick: false,
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value) {
                location.reload();
            }
        });
    }
});

function insertNuevoServicio(nomVar, listaValidacion) {
    let respFunc;
    var datos = new FormData();
    datos.append(nomVar, listaValidacion);
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

$(document).on("click", ".bntNewRegister", async function () {
    var idingresoextra = $(this).attr("idingresoextra");
    var tipo = $(this).attr("tipo");
//Otros servicios
    var listaOtr = await leerServiciosExtras();
    if (listaOtr != 0) {
        listaOtros = JSON.stringify(listaOtr);

        var respuesta = await nuevosServiciosIng(idingresoextra, listaOtros, tipo);
        if (respuesta[0].resp == 1) {
            Swal.fire({
                title: 'Operación éxitosa',
                text: "Se guardo exitosamente el servicio extra",
                type: 'success',
                confirmButtonColor: '#3085d6',
                allowOutsideClick: false,
                confirmButtonText: 'Ok'
            }).then((result) => {
                if (result.value) {
                    location.reload();
                }
            })
        }

    }

});


function nuevosServiciosIng(idIng, listaServicios, tipo) {
    let respFunc;
    console.log(listaServicios);
    var datos = new FormData();
    datos.append("idIngSerOtr", idIng);
    datos.append("listaServOtr", listaServicios);
    datos.append("tipoOpera", tipo);
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

function leerServiciosExtras() {
    //Otros servicios
    var paragraphs = Array.from(document.querySelectorAll(".btnEliminarOtroServ"));
    listaOtros = [];
    listaServiciosDefault = [];
    var otrosValores = 0;
    if (paragraphs.length == 0) {
        var otrosValores = 1;
        return otrosValores;
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
        return listaOtros;
    }

}


$(document).on("click", ".btnNewServDeta", function () {
    var idingresoextra = $(this).attr("buttonservdet");
    $(".bntNewRegister").attr("tipo", 2);
    $(".bntNewRegister").attr("idingresoextra", idingresoextra);

});

$(document).on("click", ".btnEliminarOtroServ", async function () {
    var identify = $(this).attr("idvalue");
    var button = $(this);
    Swal.fire({
        title: 'Seguro quiere eliminar el servicio?',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: `Eliminar`,
    }).then(async function (result) {
        /* Read more about isConfirmed, isDenied below */
        if (result.value) {

            if ($(".bntNewRegister").length == 0) {

                var id = "montoServicioText" + identify;
                var val = $("#" + id).val();
                var val = val * 1;
                var val = parseFloat(val).toFixed(2);
                var totalOtros = document.getElementById("hiddenOtros").value;
                var totalOtros = totalOtros * 1;
                var totalOtros = parseFloat(totalOtros).toFixed(2);
                var totalOtr = totalOtros - val;
                document.getElementById("hiddenOtros").value = totalOtr;
                document.getElementById("spanOtro").innerHTML = totalOtr;
                document.getElementById("detalleOtros").innerHTML = totalOtr;
                var valCalculado = await totalCobrar();
                button.parent().parent().parent().remove();
            } else {
                var nomVar = "eliminarServicio";
                var respuesta = await insertNuevoServicio(nomVar, identify);
                if (respuesta[0]["resp"] == 1) {
                    button.parent().parent().parent().remove();
                    Swal.fire(
                            'Eliminado!',
                            'El servicio fue eliminado correctamente!',
                            'success'
                            )
                } else {
                    Swal.fire(
                            'Error interno!',
                            'Intente anular nuevamente!',
                            'success'
                            )
                }

            }
        }
    })
})



$(document).on("click", ".btnHistoriaExcelIngRep", async function () {
    Swal.fire({
        title: 'Quiere descarga el reporte en excel?',
        text: "Esto puede tardar unos segundos!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        allowOutsideClick: false,
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Descargar!'
    }).then(async function (result) {
        if (result.value) {
            var tipoOp = 1;

            var nomVar = "generateHistoriaIng";
            var resp = await insertNuevoServicio(nomVar, tipoOp);
            var nombreReporte = 'HISTORIAL DE RETIROS, ESTADOS DE INGRESO: "-1 ANULADO :: 1 REGISTRADO OPERACIONES :: 2,3 PENDIENTE CULMINAR BODEGA :: 4 FINALIZADO CON NUMERO CORRELATIVO Y PENDIENTE DE CONTABILIZAR :: 5 POR CONTABILIZAR EN EL REPORTE :: 6 CONTABILIZADO"';
            var nombreEncabezado = "DescargaReporteExcel";
            var nombreFile = "ReporteDeIngresos_";
            var creaExcel = await JSONToCSVDescargaExcel(resp, nombreEncabezado, nombreReporte, nombreFile, true);
            console.log(resp);
        }
    })
})

$(document).on("click", ".btnImprimirDet", function () {
    var buttonid = $(this).attr("buttonid");
    window.open("extensiones/tcpdf/pdf/Detalle-Ingreso-fiscal.php?codigo=" + buttonid, "_blank");
})


$(document).on("click", ".btnImprimirInforme", async function () {
    var buttonid = $(this).attr("buttonid");
    window.open("extensiones/tcpdf/pdf/Informe-Ingreso-fiscal.php?codigo=" + buttonid, "_blank");

})
//CARGAR DATATABLE HISTORIAL DE INGRESOS FISCALES CON DATOS JSON
$(document).ready(function () {
    if ($("#tableHistorialIng").length >= 1) {
        $.ajax({
            url: "ajax/datatableHistorialIng.ajax.php",
            success: function (respuesta) {

            }

        })
    }
})

$(document).ready(function () {
    if ($("#tableHistorialIng").length >= 1) {
        $('#tableHistorialIng').DataTable({
            "bProcessing": true,
            "sAjaxSource": "ajax/datatableHistorialIng.ajax.php",
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

//CARGAR DATATABLE HISTORIAL DE INGRESOS FISCALES CON DATOS JSON
$(document).ready(function () {
    if ($("#tableHistorialDataExtra").length >= 1) {
        $.ajax({
            url: "ajax/datatableHistorialIngExt.ajax.php",
            success: function (respuesta) {
                console.log(respuesta);
            }

        })
    }
})

$(document).ready(function () {
    if ($("#tableHistorialDataExtra").length >= 1) {
        $('#tableHistorialDataExtra').DataTable({
            "bProcessing": true,
            "sAjaxSource": "ajax/datatableHistorialIngExt.ajax.php",
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

$(document).on("click", ".btnEditChasis", async function () {
    var idChasis = $(this).attr("idChasis");
    var chasis = $(this).attr("chasis");
    var tipov = $(this).attr("tipov");
    var linea = $(this).attr("linea");

    document.getElementById("chasisVeh").value = chasis;
    document.getElementById("chasisModificado").value = chasis;
    document.getElementById("tipoVeh").value = tipov;
    document.getElementById("lineaVeh").value = linea;
    $(".btnModificaVehiculo").attr("chasis", chasis);
    $(".btnModificaVehiculo").attr("chasis", chasis);
    $(".btnModificaVehiculo").attr("tipov", tipov);
    $(".btnModificaVehiculo").attr("idChasis", idChasis);

});


$(document).on("change", ".selectChasisEdit", async function () {
    $("#chasisModificado").removeClass("is-invalid");
    $("#chasisModificado").addClass("is-valid");

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 6000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    Toast.fire({
        type: 'success',
        title: 'Haga click en modificar si esta seguro de hacer el cambio'
    })
})



$(document).on("click", ".btnModificaVehiculo", async function () {
    var idChasis = $(this).attr("idChasis");
    var chasis = document.getElementById("chasisModificado").value;
    var selectChasisEdit = $(".selectChasisEdit").val();
    if (selectChasisEdit > 0) {
        Swal.fire({
            title: 'Desea editar?',
            text: "Editara chasis tipo y linea del vehiculo!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Editar!'
        }).then(async function (result) {
            if (result.value) {
                var dataResp = await editarChasisVeh(idChasis, chasis, selectChasisEdit);
                Swal.fire(
                        'Edición exitosa!',
                        'Se edito de manera correcta los datos del vehículo!',
                        'success\n\
                '
                        )
            }
        })
    } else {
        Swal.fire(
                'Error Selección!',
                'No selecciono el tipo y linea del vehículo!',
                'error'
                )
    }


})

function editarChasisVeh(idChasis, chasis, selectChasisEdit) {
    let respFunc;
    var datos = new FormData();
    datos.append("idChasEdit", idChasis);
    datos.append("chasisNewEdt", chasis);
    datos.append("tipoLineaVeh", selectChasisEdit);
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
