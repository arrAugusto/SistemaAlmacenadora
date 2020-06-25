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
        url: "ajax/historiaIngresosFisacales.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            var cCupo = respuesta[0].cCupo;
            var cantContenedores = respuesta[0].cantContenedores;
            var numDua = respuesta[0].numDua;
            var BLEmbarque = respuesta[0].BLEmbarque;
            var numPoliza = respuesta[0].numPoliza;
            var bultos = respuesta[0].bultos;
            var puertoOrigen = respuesta[0].puertoOrigen;
            var cantClientes = respuesta[0].cantClientes;
            var tipoProducto = respuesta[0].tipoProducto;
            var totalAduana = respuesta[0].totalAduana;
            var totalAduana = respuesta[0].totalAduana;
            var tCambio = respuesta[0].tCambio;
            var valCif = respuesta[0].valCif;
            var cantPeso = respuesta[0].cantPeso;
            var valImpuesto = respuesta[0].valImpuesto;
            var identReg = respuesta[0].identReg;
            var servicioIng = respuesta[0].servicioIng;
            var fechaIngreso = respuesta[0]["fechaRealFormat"];
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
            document.getElementById("divAcciones").innerHTML = '<div class="btn-group"><button type="button" class="btn btn-warning btnEdicionIngreso" idIngresoEditado=' + idIngEditOp + ' estado=0>Editar Ingreso&nbsp;&nbsp;<i class="fas fa-edit"></i></button></div>';
        }, error: function (respuesta) {
            console.log(respuesta);
        }
    });

    var css = "display: block;";
    document.getElementById("divEdiciones").setAttribute("style", css);
    if (valEstaod == 2 || valEstaod == 3) {
        var datos = new FormData();
        datos.append("idIngClientesPlt", idIngEditOp);
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
                document.getElementById("divEdicionClientes").innerHTML = '';
                document.getElementById("divEdicionClientes").innerHTML = '<table id="tableClientesEdit" class="table dt-responsive table-sm table-hover">';
                var lista = [];
                console.log(respuesta);
                for (var i = 0; i < respuesta["respuestaClientes"].length; i++) {
                    var numero = i + 1;
                    var identi = respuesta["respuestaClientes"][i].identi;
                    var accion = '<div class="input-group-prepend"><button type="button" class="btn btn-danger btnEliminarDetalle" numerobuttontrash="7" numbtneliminar="1"><i class="fa fa-trash" aria-hidden="true"></i></button><button type="button" class="btn btn-warning btnEditar" buttonEditar=' + idIngEditOp + ' numbtneditar=' + identi + ' btnestadoedicion="0"><i class="fa fa-edit" aria-hidden="true"></i></button> </div>';
                    var nombreEmpresa = '<input type="text" class="form-control" value="' + respuesta["respuestaClientes"][i].nombreEmpresa + '" id=nomEmpresa' + identi + ' readonly="readOnly">';
                    var cantBultos = '<input type="text" class="form-control"  value="' + respuesta["respuestaClientes"][i].cantBultos + '" id=bltsEmpresa' + identi + ' readonly="readOnly">';
                    var cantPeso = '<input type="text" class="form-control" value="' + respuesta["respuestaClientes"][i].cantPeso + '" id="pesoEmpresa' + identi + '" readonly="readOnly">';
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
                 var accion = '<div class="btn-group"><button type="button" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button><button type="button" class="btn btn-danger btn-sm"><i class="fas fa-close"></i></button></div>';
                 
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
    var datos = new FormData();
    datos.append("idIngresoAnulacion", idIngresoAnulacion);

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
            if (respuesta == "SinAnulacion") {
                swal({
                    type: "error",
                    title: "Ingreso no anulado",
                    text: "Para anular comuniquese con bodega...",
                    showConfirmButton: true,
                    confrimButtonText: "cerrar",
                    closeConfirm: true
                });
            } else if (respuesta == "Anulado") {

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
})
$(document).on("keyup", ".btnPendiente", function () {
    var mensaje = "No puede anular hasta que ponga una descripcion valida";
    var tipo = "error";
    alertaToast(mensaje, tipo);

})

