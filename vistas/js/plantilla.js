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


