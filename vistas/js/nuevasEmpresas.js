$(document).on("change", "#txtNewNit", async function () {
    var numNit = $(this).val();
    if (numNit == "") {
        $(this).removeClass('is-valid');
        $(this).addClass('is-invalid');
        return false;
    }
    var respNit = await validar_nit(numNit);
    if (respNit) {
        $(this).removeClass('is-invalid');
        $(this).addClass('is-valid');

    } else {
        $(this).removeClass('is-valid');
        $(this).addClass('is-invalid');
    }
})

//    

$(document).on("change", "#txtNewNombre", async function () {
    var empresa = $(this).val();
    var respEmpresa = await patternEmpresa(empresa);
    console.log(respEmpresa);
    if (respEmpresa) {
        $(this).removeClass('is-invalid');
        $(this).addClass('is-valid');

    } else {
        $(this).removeClass('is-valid');
        $(this).addClass('is-invalid');
    }
})


$(document).on("change", "#txtNewDireccion", async function () {
    var direccion = $(this).val();
    var respDireccion = await patternDireccion(direccion);

    if (respDireccion) {
        $(this).removeClass('is-invalid');
        $(this).addClass('is-valid');

    } else {
        $(this).removeClass('is-valid');
        $(this).addClass('is-invalid');
    }
})


$(document).on("change", "#txtNewTelefono", async function () {
    var telefono = $(this).val();
    var respTelefono = await patternTelefono(telefono);
    console.log(respTelefono);
    if (respTelefono) {
        $(this).removeClass('is-invalid');
        $(this).addClass('is-valid');

    } else {
        $(this).removeClass('is-valid');
        $(this).addClass('is-invalid');
    }
})

function patternEmpresa(dato) {

    const pattern = new RegExp('^[A-Z0-9.()&,\u00D1\ \u00F1\&]+$', 'i');
    if (!pattern.test(dato)) {
        return false;
    } else {
        return true;
    }
}
function patternDireccion(dato) {

    const pattern = new RegExp('^[A-Z0-9.()&,-\u00D1\ \u00F1\&]+$', 'i');
    if (!pattern.test(dato)) {
        return false;
    } else {
        return true;
    }
}



//patternPregNumEntero(dato):
function patternTelefono(dato) {
    const pattern = new RegExp('^[0-9\-]+$', 'i');
    if (!pattern.test(dato)) {
        return false;
    } else {
        return true;
    }
}

//    
function validarEmail(valor) {
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3,4})+$/.test(valor)) {
        alert("La dirección de email " + valor + " es correcta.");
    } else {
        alert("La dirección de email es incorrecta.");
    }
}

$(document).on("click", ".btnEditarEmpresa", async function () {
    var idbtnedit = $(this).attr("idbtnedit");

    var nomVar = "idEditarEmpresa";
    var respEditar = await  funcionEditarEmpresaNew(nomVar, idbtnedit);
    if (respEditar != "SD") {
        document.getElementById("txtNewNitEdit").value = respEditar[0].nit;
        document.getElementById("txtNewNombreEdit").value = respEditar[0].empresa;
        document.getElementById("txtNewDireccionEdit").value = respEditar[0].direccion;
        document.getElementById("EmailEdit").value = respEditar[0].email;
        document.getElementById("txtNewTelefonoEdit").value = respEditar[0].telefono;
        document.getElementById("hiddenFotoActual").value = respEditar[0].logo;
        document.getElementById("hiddenIdEmpresa").value = respEditar[0].id;

        $(".previsualizar").attr("src", respEditar[0].logo);
        $("#txtNewNitEdit").removeClass("is-invalid");
        $("#txtNewNombreEdit").removeClass("is-invalid");
        $("#txtNewDireccionEdit").removeClass("is-invalid");
        $("#EmailEdit").removeClass("is-invalid");
        $("#txtNewTelefonoEdit").removeClass("is-invalid");

        $("#txtNewNitEdit").addClass("is-valid");
        $("#txtNewNombreEdit").addClass("is-valid");
        $("#txtNewDireccionEdit").addClass("is-valid");
        $("#EmailEdit").addClass("is-valid");
        $("#txtNewTelefonoEdit").addClass("is-valid");


    }
})



function funcionEditarEmpresaNew(nomVar, idbtnEdit) {
    let respEdicion;
    var datos = new FormData();
    datos.append(nomVar, idbtnEdit);
    $.ajax({
        async: false,
        url: "ajax/nuevasEmpresas.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            respEdicion = respuesta;
        }, error: function (respuesta) {
            console.log(respuesta);
        }});
    return respEdicion;
}

$(document).on("click", ".btnCancelEmpresa", async function () {
    var idbtncancel = $(this).attr("idbtncancel");
    var nomVar = "cancelarEmpresa";

    swal({
        title: "¿Seguro de cancelar empresa?",
        text: 'Presione "Si, Seguro(a)", Para cancelar la operación de la empresa',
        type: "info",
        showCancelButton: true,
        allowOutsideClick: false, // prevent close on click anywhere/outside
        confirmButtonText: 'Si, Seguro(a)',
        confirmButtonColor: '#642EFE',
        cancelButtonColor: '#DF0101'
    }).then(async function (result) {
        console.log(result);
        if (result.value) {
            var respEditar = await  funcionEditarEmpresaNew(nomVar, idbtncancel);
            if (respEditar[0].resp == 1) {
                location.reload();
            }

        }
    })


})

$(document).on("click", ".btnActivaEmpresa", async function () {
    var idbtnActiva = $(this).attr("idbtnActiva");
    var nomVar = "activaEmpresa";

    swal({
        title: "¿Seguro de cancelar empresa?",
        text: 'Presione "Si, Seguro(a)", Para cancelar la operación de la empresa',
        type: "info",
        showCancelButton: true,
        allowOutsideClick: false, // prevent close on click anywhere/outside
        confirmButtonText: 'Si, Seguro(a)',
        confirmButtonColor: '#642EFE',
        cancelButtonColor: '#DF0101'
    }).then(async function (result) {
        console.log(result);
        if (result.value) {
            var respActivar = await  funcionEditarEmpresaNew(nomVar, idbtnActiva);
            if (respActivar[0].resp == 1) {
                location.reload();
            }

        }
    })


})

