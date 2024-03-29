/*=============================================
 SUBIENDO fotoGRAFIA USUARIO
 =============================================*/
$(document).ready(function () {
    $(".nuevaFoto").change(function () {
        var imagen = this.files[0];
        console.log(this.files);
        /*=============================================
         VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
         =============================================*/
        if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {
            $(".nuevaFoto").val("");
            swal({
                type: "error",
                title: "FORMATO NO ADMITIDO",
                text: "La imagen debe estar en formato PNG o JPG, vuelva a intentar",
                showConfirmButton: true,
                confrimButtonText: "cerrar",
                closeConfirm: true
            });
        } else if (imagen["size"] > 2000000) {
            $(".nuevaFoto").val("");
            swal({
                type: "error",
                title: "EXCEDE LOS PARAMETROS",
                text: "Su imagen excede los 200mb, intente con otra imagen",
                showConfirmButton: true,
                confrimButtonText: "cerrar",
                closeConfirm: true
            });
        } else {
            var datosImagen = new FileReader;
            datosImagen.readAsDataURL(imagen);
            $(datosImagen).on("load", function (event) {
                var rutaImagen = event.target.result;
                $(".previsualizar").attr("src", rutaImagen);
            });
            swal({
                type: "success",
                title: "Selección Satisfactoria",
                text: "Selecciono con exito la fotografá",
                showConfirmButton: true,
                confrimButtonText: "Aceptar",
                closeConfirm: true
            });
        }
    });
});
/*=============================================
 ACTUALIZANDO DATOS
 =============================================*/
$(document).ready(function () {
    $(".btnEditarUsuario").click(function () {
        var idUsuario = $(this).attr("idUsuario");
        var datos = new FormData();
        datos.append("idUsuario", idUsuario);
        $.ajax({
            url: "ajax/usuarios.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (respuesta) {
                console.log(respuesta);
                document.getElementById("editarUsuario").value = respuesta[0]["usuarios"];
                document.getElementById("editarTelefono").value = respuesta[0]["telefono"];
                document.getElementById("editarEmail").value = respuesta[0]["email"];

                document.getElementById("telefonoActual").value = respuesta[0]["telefono"];
                document.getElementById("emailActual").value = respuesta[0]["email"];

                document.getElementById("passwordAcutal").value = respuesta[0]["contra"];

                if (respuesta["foto"] != "") {
                    $(".previsualizar").attr("src", respuesta[0]["foto"]);
                }
                /*
                 
                 $("#editarTelefono").val(respuesta["telefono"]);
                 $("#emailActual").val(respuesta["email"]);
                 $("#editarEmail").val(respuesta["email"]);
                 $("#editarUsuario").val(respuesta["usuario"]);
                 $("#fotoActual").val(respuesta["foto"]);
                 $("#passwordAcutal").val(respuesta["contraseña"]);
                 
                 
                 */
            }, error: function (respuesta) {
                console.log(respuesta);
            }
        })
    });
});
$(document).on("click", ".btnActivar", function () {
    var idUsuario = $(this).attr("idUsuario");
    var estadoUsuario = $(this).attr("estadoUsuario");
    console.log(idUsuario);
    console.log(estadoUsuario);
    var button = $(this);
    var datos = new FormData();
    datos.append("activarIdCliente", idUsuario);
    datos.append("activarUsuarioCliente", estadoUsuario);
    $.ajax({
        async: false,
        url: "ajax/usuarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            if (respuesta[0].resp == 1) {
                if (estadoUsuario == 0) {
                    button.removeClass('btn-success');
                    button.addClass('btn-danger');
                    button.html('Desactivado');
                    button.attr('estadoUsuario', 1);
                } else {
                    button.removeClass('btn-danger');
                    button.addClass('btn-success');
                    button.html('Activado');
                    button.attr('estadoUsuario', 0);
                }
                swal({
                    type: "success",
                    title: "Operación exitosa",
                    showConfirmButton: true,
                    confrimButtonText: "Aceptar",
                    closeConfirm: true
                });
            } else {
                swal({
                    type: "warning",
                    title: "Por alguna razon no se finalizo la operación, vuelva intentarlo",

                    showConfirmButton: true,
                    confrimButtonText: "Aceptar",
                    closeConfirm: true
                });
            }
        }, error: function (respuesta) {
            console.log(respuesta);
        }
    })

})
$(document).ready(function () {
    $("#nitTarifaEspecial").change(function () {
        var combo = document.getElementById("nitTarifaEspecial");
        var selected = combo.options[combo.selectedIndex].text;

        var idNitEspecial = $(this).val();
        console.log(idNitEspecial);
        var datos = new FormData();
        datos.append("idNitEspecial", idNitEspecial);
        $.ajax({
            url: "ajax/usuarios.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (respuesta) {
                console.log(respuesta);
                document.getElementById("razonSocial").value = respuesta[0]["nombreEmpresa"];
                document.getElementById("nombreComercial").value = respuesta[0]["nombreEmpresa"];
                document.getElementById("direccionFiscal").value = respuesta[0]["direccionEmpresa"];
                document.getElementById("direccionDeRecibos").value = respuesta[0]["direccionEmpresa"];
            }
        })
    })
})

$(document).on("click", ".btnCambiaDataEdicion", function () {
    var editarTelefono = $("#editarTelefono").val();
    var editarEmail = $("#editarEmail").val();

    var telefonoActual = $("#telefonoActual").val();
    var emailActual = $("#emailActual").val();

    if (editarTelefono != telefonoActual || emailActual != editarEmail) {

    } else {
        Swal.fire(
                'No existen cambios',
                'No se detecta cambios de telefono o correo',
                'error'
                )
    }


})

$(document).on("click", ".btnChangePass", async function () {
    var colabora = document.getElementById("colabora").value;
    var resp = await change(colabora);

    if (resp[0].resp == 1) {
        Swal.fire({
            title: 'PassWord cambiado con exito',
            text: "Pedir que el usuario cambie la contraseña!",
            type: 'success',
            allowOutsideClick: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok!'
        }).then((result) => {
            if (result.value) {
                location.reload();
            }
        })
    }else{
        window.location="salir";
    }
})



function change(colabora) {
    let respFunc;
    var datos = new FormData();
    datos.append("colabora", colabora);
    $.ajax({
        async: false,
        url: "ajax/usuarios.ajax.php",
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
