$(document).on("click", ".btnContabilizar", async function () {
    var hiddenDateTime = document.getElementById("hiddenDateTime").value;
    var buttonid = $(this).attr("buttonid");
    Swal.fire({
        title: '¿Desea Contabilizar?',
        text: "El ingreso Contabilizado, se reportara con fecha, " + hiddenDateTime,
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'No, Contabilizar!',
        confirmButtonText: 'Sí, Contabilizar!'
    }).then((result) => {
        if (result.value) {
            $(this).removeClass("btn-danger");
            $(this).addClass("btn-primary");
            $(this).html('<i class="fas fa-thumbs-up"></i>');

            contabilizar(buttonid);

        }
    })
})



function contabilizar(buttonid) {
    let estado;
    var datos = new FormData();
    datos.append("idContabilizar", buttonid);
    $.ajax({
        url: "ajax/ingPendientesC.ajax.php",
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
    });
    return estado;
}


$(document).on("click", ".btnSelectMultiple", async function () {
    var estado = $(this).attr("estado");
    if (estado == 0) {
        $(this).attr("estado", 1);
        $(this).removeClass("btn btn-outline-dark");
        $(this).addClass("btn btn-info");
        $(this).html('<i class="fa fa-circle"></i>');

    } else {
        $(this).attr("estado", 0);
        $(this).removeClass("btn btn-outline-info");
        $(this).addClass("btn btn-outline-dark");
        $(this).html('<i class="fa fa-close"></i>');

    }
})

$(document).on("click", ".bntReportarLote", async function () {
    var paragraphs = Array.from(document.querySelectorAll(".btnSelectMultiple "));
    console.log(paragraphs);
    listaIng = [];
    for (var i = 0; i < paragraphs.length; i++) {
        var estado = paragraphs[i].attributes.estado.value;
        var buttonID = paragraphs[i].attributes.buttonid.value;
        if (estado == 1) {
            listaIng.push([buttonID]);

        }
    }
    var contador = 0;
    for (var i = 0; i < listaIng.length; i++) {
        var buttonid = listaIng[i];
        var respuesta = await contabilizarLotes(buttonid);
        if (respuesta == "Ok") {
            var contador = contador + 1;
        }

    }
    console.log(respuesta);
    if (respuesta == "ok") {
        Swal.fire({
            title: 'Operacion Exitosa',
            text: "Fueron Contabilizados los ingresos seleccionados",
            type: 'success',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Sí, Contabilizar!'
        }).then((result) => {
            if (result.value) {
                location.reload();
            }
        })
    }

})


function contabilizarLotes(buttonid) {
    let estado;
    var datos = new FormData();
    datos.append("idContabilizar", buttonid);
    $.ajax({
        async: false,
        url: "ajax/ingPendientesC.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            estado = respuesta;
        }, error: function (respuesta) {
            console.log(respuesta);
        }
    });
    return estado;
}
