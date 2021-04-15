function alertaToast(mensaje, tipo) {
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "8000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    Command: toastr[tipo](mensaje);
}

function alertaToastConfi(mensaje, tipo, posicion) {
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": posicion,
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "10000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    Command: toastr[tipo](mensaje);
}

function alertaUbicacion(poliza, empresa, bultos, peso, descripcion, posiciones, metros, idDetalle, Idincidencia, idSpan, tipo) {
    console.log(idSpan);
    var paragraphs = Array.from(document.querySelectorAll(".noBodega"));
    if (paragraphs.length >= 1) {
        var btnCambiaUbica = "";
        Command: toastr["success"]("Poliza : " + poliza + "<br/>Empresa : " + empresa + " <br/>Bultos : " + bultos + " <br/>Peso kg : " + peso + "<br/>Descripción : " + descripcion + "<br/>Posiciones : " + posiciones + "<br/>Metros : " + metros);
    } else {
        btnCambiaUbica = '<button type="button" class="btn btn-primary bntCambioUbN">Cambiar Ubicaciones</button>';
        if (tipo == 1) {
            var btnCambiaUbica =
                    `
        <div class="btn-group btn-group-sm">
  <button type="button" class="btn btn-warning btnModificarUbica" idDetModificar="` + idDetalle + `" Idincidencia="` + Idincidencia + `">Agregar <i class="fa fa-plus"></i></button>
  <button type="button" class="btn btn-danger btnEliminarUbicacion" idDetallElim=` + idDetalle + `" Idincidencia="` + Idincidencia + `" dataId="` + idSpan + `">Eliminar <i class="fa fa-trash"></i></button>
  
</div>`;
        }
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": 0,
            "extendedTimeOut": 0,
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut",
            "tapToDismiss": false
        }
        Command: toastr["info"]("Poliza : " + poliza + "<br/>Empresa : " + empresa + " <br/>Bultos : " + bultos + " <br/>Peso kg : " + peso + "<br/>Descripción : " + descripcion + "<br/>Posiciones : " + posiciones + "<br/>Metros : " + metros + "<br/><strong>Opciones de Ubicación</strong>" + btnCambiaUbica);
    }
}

function alertValNoAdm(mensaje, tipo) {
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-center",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "8000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    Command: toastr[tipo](mensaje);
}
$(document).ready(function () {
    $('#tablasGeneral').DataTable({
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
})

$(function () {
    var today = new Date();
    $('#dateTime').daterangepicker({
        timePicker: true,
        startDate: moment().startOf('hour'),
        singleDatePicker: true,
        endDate: moment().startOf('hour').add(32, 'hour'),
        maxDate: (today),
        locale: {
            format: 'DD-MM-YYYY hh:mm A'
        }
    }, function (start, end, label) {
        var tiempo = start.format('YYYY-MM-DD hh:mm A');
        var tiempoVal = start.format('DD-MM-YYYY');
        document.getElementById("hiddenDateTime").value = tiempo;
        document.getElementById("hiddenDateTimeVal").value = tiempoVal;
        swal({
            type: "success",
            title: "Fecha Seleccionada",
            text: "Hora de ingreso " + tiempo,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar'
        });
    });
});

$(function () {

    $('#dateTimeCalculo').daterangepicker({
        timePicker: true,
        startDate: moment().startOf('hour'),
        singleDatePicker: true,
        endDate: moment().startOf('hour').add(32, 'hour'),

        locale: {
            format: 'DD-MM-YYYY hh:mm A'
        }
    }, function (start, end, label) {
        var tiempo = start.format('YYYY-MM-DD hh:mm A');
        var tiempoVal = start.format('DD-MM-YYYY');
        document.getElementById("hiddenDateTime").value = tiempo;
        document.getElementById("hiddenDateTimeVal").value = tiempoVal;
        swal({
            type: "success",
            title: "Fecha Seleccionada",
            text: "Hora de ingreso " + tiempo,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar'
        });
    });
});

$(document).on("click", ".btnValidarLLave", async function () {
    var llave = document.getElementById("codigoValidate").value;
    var nomVar = "validarIngOP";
    var resp = await  validarLlaveDeIngreso(nomVar, llave);
    if (resp[0]["validateToken"] == 1) {
        $("#codigoValidate").removeClass("is-invalid");
        $("#codigoValidate").addClass("is-valid");
        document.getElementById("alertCodigoSistema").innerHTML = `
                
        <div class="alert alert-success" role="alert">
        ¡ Codigo valido  ` + llave + ` ! <i class="fa fa-check" style="font-size:48px;color:white"></i>
        </div>  
                `;
    } else {
        $("#codigoValidate").removeClass("is-valid");
        $("#codigoValidate").addClass("is-invalid");

        document.getElementById("alertCodigoSistema").innerHTML = `
                
        <div class="alert alert-danger" role="alert">
          ¡ Codigo no valido  ` + llave + ` 
        </div>
                `;
    }
})

//validando llave en el controlador

function validarLlaveDeIngreso(nomVar, idIngEditOp) {
    let resp;
    var datos = new FormData();
    datos.append(nomVar, idIngEditOp);
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
            resp = respuesta;
        }, error: function (respuesta) {
            console.log(respuesta);
        }
    })
    return resp;
}

$(document).on("click", ".btnQRValidateIng", async function () {
    var llave = document.getElementById("codigoValidate").value;
    if (llave != "") {


        if (!llave.isArray) {
            console.log("escaneado");
        } else {
            console.log("no escaneado");
        }

    }
})

$(document).ready(function () {
    var estado = 0;
    if ("promedioTarima" in localStorage) {
        var estado = 1
        var promedioLocal = localStorage.getItem("promedioTarima");
        localStorage.setItem("promedioTarima", promedioLocal);
    }
    localStorage.clear();
    if (estado == 1) {
        localStorage.setItem("promedioTarima", promedioLocal);
    }
})

$(document).on("click", ".btnRebajaCorregida", async function () {
    var idBitacora = $(this).attr("idBitacora");
    Swal.fire({
        title: 'La deficiencia fue corregida?',
        text: "Si no fue corregida, se volvera a mostrar esta notificación!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!'
    }).then(async function (result) {
        if (result.value) {
            var nomVar = "corregirIncidencia";
            var resp = await  validarLlaveDeIngreso(nomVar, idBitacora);
            if (!resp) {

                Window.location = "salir";
            } else {


                Swal.fire(
                        'Eliminada!',
                        'Esta incidencia fue eliminada de la vista.',
                        'success'
                        )
            }
        }
    })
})

$(document).on("mouseover", ".infoDeIncidencia", async function () {
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-center",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "8000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    Command: toastr['warning']('Para corregir esta transacción, vaya a historial de retiros y edite la cantidad de bultos rebajados en el detalle...', '¡¡ Incidencia de mala rebaja !!');

})

