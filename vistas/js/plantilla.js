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


$(document).ready(function () {
toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": false,
  "progressBar": false,
  "positionClass": "toast-bottom-full-width",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "15000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
Command: toastr["warning"]('Revise finalizaciones de descarga!&nbsp;&nbsp;&nbsp;')
})
