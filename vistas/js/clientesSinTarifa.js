$(document).on("click", ".btnAsinarEje", function () {
    var estado = $(this).attr("estado");
    if (estado == 0) {
        $(this).attr("estado", 1);
        $(this).removeClass("btn-success");
        $(this).addClass("btn-danger");
        $(this).html('<i class="fas fa-user-check"></i>');
        var hiddenIdUsST = $(this).attr("idregistrocliente");
        var idregistrocliente = document.getElementById("hiddenIdUs").value;

        var datos = new FormData();
        datos.append("hiddenIdUsST", hiddenIdUsST);
        datos.append("idregistrocliente", idregistrocliente);
        $.ajax({
            url: "ajax/clientesSinTarifa.ajax.php",
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

    }
});

$(document).on("click", ".btnSinTarifa", function () {
    var idregistroCDown = $(this).attr("idregistrocliente");

    var datos = new FormData();
    datos.append("idregistroCDown", idregistroCDown);

    $.ajax({
        url: "ajax/clientesSinTarifa.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            if (respuesta == "oK") {

                swal({
                    title: "Sin Tarifa",
                    text: "Proceso finalizado sin ninguna tarifa especial",
                    type: "success"
                }).then(okay => {
                    if (okay) {
                        location.reload();
                    }
                });




            }
        }, error: function (respuesta) {
            console.log(respuesta);
        }
    })

})


$(document).on("click", "#btnEjecutivoAsg", async function () {
    var idNitCliente = $(this).attr("indentyNit");
    if (idNitCliente >= 1) {
        var respEjecutivo = await consultarEjecutivoTarifa(idNitCliente);
    }
});
