$(document).on("click", ".btnRetVeh", function () {
    var estado = $(this).attr("estado");
    var nomVar = "estado";
    var nomVarChas = "identChas";
    var identChas = $(this).attr("identChas");
    if (estado == 2) {
        Swal.fire({
            title: "Autorización en proceso",
            text: "Si autoriza el vehiculo, este podra ser autorizado para salir de las instalaciones, ¿ESTA SEGURO DE CONTINUAR?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Continuar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) {
                var tipo = 1;
                gestionIngreso(nomVar, estado, nomVarChas, identChas, tipo);
            }
        })
    }
    if (estado == 3) {
        Swal.fire({
            title: "Autorización en proceso",
            text: "El vehiculo seleccionado podra salir de almacenadora, ¿DESEA CONTINUAR?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Continuar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) {
                var tipo = 1;
                gestionIngreso(nomVar, estado, nomVarChas, identChas, tipo);
            }
        })
    }
})

async function gestionIngreso(nomVar, estado, nomVarChas, identChas, tipo) {
    console.log(nomVar);
    var resp = await accionesVehiculosNuevos(nomVar, estado, nomVarChas, identChas, tipo);
    console.log(resp);
    if (resp.resp) {
        swal({
            title: "Operación Exitosa",
            text: "El vehiculo puede ser autorizado para retirarse en cualquier momento",
            type: "success"
        }).then(okay => {
            location.reload();
        })
    }
}

function accionesVehiculosNuevos(nomVar, estado, nomVarChas, identChas, tipo) {

    let respAcc;
    var datos = new FormData();
    datos.append(nomVar, estado);
    datos.append(nomVarChas, identChas);
    datos.append("tipo", tipo);

    $.ajax({
        async: false,
        url: "ajax/retiroVeh.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            respAcc = respuesta;
        }, error: function (respuesta) {
            console.log(respuesta);
        }
    });
    return respAcc;

}

$(document).on("click", ".btnRegresarAnt", function () {
    var estado = $(this).attr("estado");
    var chasisAnular = $(this).attr("chasis");
    var identchas = $(this).attr("identchas");
    document.getElementById("textChasisAnt").value = chasisAnular;
    document.getElementById("idChasAnt").value = identchas;

    var nomVar = "estado";
    var nomVarChas = "identChas";
    var identChas = $(this).attr("identChas");
    if (estado == 4) {
        Swal.fire({
            title: "Cancelara la salida del vehiculo",
            text: "El vehículo no podra retirarse de almacenadora, ¿ESTA SEGURO DE CONTINUAR?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Continuar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) {
                var tipo = 0;
                gestionIngreso(nomVar, estado, nomVarChas, identChas, tipo);
            }
        })
    }
    if (estado == 3) {
        Swal.fire({
            title: "Cancelara la salida autorización",
            text: "El vehículo no podra ser vizualizado por personal de vehiculos, ¿ESTA SEGURO DE CONTINUAR?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Continuar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) {
                var tipo = 0;
                gestionIngreso(nomVar, estado, nomVarChas, identChas, tipo);
            }
        })
    }
    if (estado == 2) {
        Swal.fire({
            title: "Cancelara la rebaja del vehículo",
            text: "Se cancelara la rebaja del vehiculo y estara vigente nuevamente para ser rebajado con otra poliza de liquidación, ¿ESTA SEGURO DE CONTINUAR?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Continuar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) {
                var tipo = 0;

            } else {
                $(".close").click();
            }
        })
    }
})

$(document).on("click", ".btnRegresionChas", function () {
    var idchasNew = $(this).attr("idchas");
    var chasisVehNew = $(this).attr("chasisVehNew");
    document.getElementById("textChasNuevo").value = chasisVehNew;
    document.getElementById("idChasNew").value = idchasNew;

});
$(document).on("click", ".btnRevesionChasis", async function () {
    var idChasNew = document.getElementById("idChasNew").value;
    var nomVar = "idNewChas";
    var idChasAnt = document.getElementById("idChasAnt").value;
    var nomVarChas = "idAntChasis";
    var tipo = 0;

    var accionReversion = await accionesVehiculosNuevos(nomVar, idChasNew, nomVarChas, idChasAnt, tipo);
    console.log(accionReversion);

})



