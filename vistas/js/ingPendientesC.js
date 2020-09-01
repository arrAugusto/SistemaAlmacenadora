$(document).on("click", ".btnContabilizar", async function () {
    var estado = $(".btnMatenerFecha").attr("estado");
    if (estado == 0) {
        Swal.fire(
                'Fecha contabilidad!',
                'Selecciona fecha contable y luego haz click en el boton verde!',
                'error'
                )
        return false;
    } else {
        var fechaCongeladaConta = localStorage.getItem('fechaCongeladaConta');
        var buttonid = $(this).attr("buttonid");
        Swal.fire({
            title: '¿Desea Contabilizar?',
            text: "El ingreso Contabilizado, se reportara con fecha, " + fechaCongeladaConta,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            allowOutsideClick: false,
            cancelButtonText: 'No, Contabilizar!',
            confirmButtonText: 'Sí, Contabilizar!'
        }).then(async function (result) {
            if (result.value) {
                var respuesta = await contabilizar(buttonid, fechaCongeladaConta);
                if (respuesta[0].resp == 1) {
                    Swal.fire({
                        title: 'Actualizado con éxito',
                        text: "Ingreso contabilizado!",
                        type: 'success',
                        showCancelButton: true,
                        allowOutsideClick: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ok!'
                    }).then((result) => {
                        if (result.value) {
                            location.reload();
                        }
                    })
                }

            }
        })
    }
})



function contabilizar(buttonid, fechaCongeladaConta) {
    let estado;
    var datos = new FormData();
    datos.append("idContabilizar", buttonid);
    datos.append("fechaCongeladaConta", fechaCongeladaConta);
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
            console.log(respuesta);
            estado = respuesta;
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

    var estado = $(".btnMatenerFecha").attr("estado");
    if (estado == 0) {
        Swal.fire(
                'Fecha contabilidad!',
                'Selecciona fecha contable y luego haz click en el boton verde!',
                'error'
                )
        return false;
    } else {
        var fechaCongeladaConta = localStorage.getItem('fechaCongeladaConta');
        var buttonid = $(this).attr("buttonid");
        Swal.fire({
            title: '¿Desea Contabilizar?',
            text: "El ingreso Contabilizado, se reportara con fecha, " + fechaCongeladaConta,
            type: 'warning',
            showCancelButton: true,
            allowOutsideClick: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            allowOutsideClick: false,
            cancelButtonText: 'No, Contabilizar!',
            confirmButtonText: 'Sí, Contabilizar!'
        }).then(async function (result) {
            if (result.value) {
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
                    var respuesta = await contabilizar(buttonid, fechaCongeladaConta);
                    if (respuesta[0].resp == 1) {
                        var contador = contador + 1;
                    }
                }
                if (contador == listaIng.length) {
                    Swal.fire({
                        title: 'Operacion Exitosa',
                        text: "Fueron Contabilizados los ingresos seleccionados",
                        type: 'success',
                        allowOutsideClick: false,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Sí, Contabilizar!'
                    }).then((result) => {
                        if (result.value) {
                            location.reload();
                        }
                    })
                }
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

$(document).on("click", ".btnImprimirReporteContable", async function () {
    var tipoReporte = "Ingreso";
    var idingreporte = $(this).attr("idingreporte");
    window.open("extensiones/tcpdf/pdf/ReporteDeIngresos.php?tipoReporte=" + tipoReporte + '&idBodega=' + idingreporte, "_blank");
})



function contabilizarReportes(nomVar, tipoReporte) {
    let estado;
    var datos = new FormData();
    datos.append(nomVar, tipoReporte);
    $.ajax({
        async: false,
        url: "ajax/ingContaReportar.ajax.php",
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


$(document).on("click", ".btnMatenerFecha", async function () {
    var estado = $(".btnMatenerFecha").attr("estado");
    if (estado == 0) {


        var fechaCongeladaConta = document.getElementById("dateTime").value;
        /*Guardando los datos en el LocalStorage*/
        localStorage.setItem("fechaCongeladaConta", fechaCongeladaConta);
        $(this).removeClass("btn-success");
        $(this).addClass("btn-dark");
        $(this).html("Fecha Congelada");
        $(this).attr("estado", 1);
        swal({
            type: "success",
            title: "Fecha Contabilidad",
            text: "Fecha para registrar contabilidad :  " + fechaCongeladaConta,
            showConfirmButton: true,
            confrimButtonText: "cerrar",
            closeConfirm: true
        });
    }
});

$(document).on("click", ".btnDescontableIng", async function () {
    var idIng = $(this).attr("idIng");
    var idRet = $(this).attr("idRet");
    swal({
        title: "¿Quiere revertir el ingreso contable?",
        text: 'Presione "Revertir", para guardar la transacción',
        type: "info",
        showCancelButton: true,
        confirmButtonText: 'Revertir',
        allowOutsideClick: false,
        confirmButtonColor: '#642EFE',
        allowOutsideClick: false,
        cancelButtonColor: '#DF0101'
    }).then(async function (result) {
        if (result.value) {
            var nomVar = "descontabilizaIng";
            var respuesta = await contabilizarReportes(nomVar, idIng);
            if (respuesta[0].resp == 1) {
                Swal.fire({
                    title: 'Ingreso revertido',
                    text: "La contabilizacion del ingreso fue revertida!",
                    type: 'warning',
                    confirmButtonColor: '#3085d6',
                    allowOutsideClick: false,
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        location.reload();
                    }
                })
            }
        }
    })
})