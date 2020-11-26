//CARGAR DATATABLE HISTORIAL DE INGRESOS FISCALES CON DATOS JSON
$(document).ready(function () {
    if ($("#tableHistChasisVehN").length >= 1) {
        $.ajax({
            url: "ajax/datatableHistorialChasis.ajax.php",
            "bServerSide": true,
            success: function (respuesta) {
            }

        })
    }
})

$(document).ready(function () {
    if ($("#tableHistChasisVehN").length >= 1) {
        $('#tableHistChasisVehN').DataTable({
            "bProcessing": true,
            "sAjaxSource": "ajax/datatableHistorialChasis.ajax.php",
            "deferRender": true,
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
    }
});

$(document).on("click", ".btnCorreoDeSolicitud", async function () {

    const {value: text} = await Swal.fire({
        input: 'textarea',
        inputLabel: 'Message',
        inputPlaceholder: 'Ingresa los chasis que necesita preparar...',
        inputAttributes: {
            'aria-label': 'Type your message here'
        },
        showCancelButton: true
    })

    if (text) {
        localStorage.removeItem("listaCorreoChas");
        var sin_salto = text.split("\n").join("");
        var cadenaArray = sin_salto.split("|");
        lista = [];
        for (var i = 0; i < cadenaArray.length; i++) {
            if (i == 0) {
                lista.push([cadenaArray[i]]);
            }
            if (i > 0) {
                var count = 0;
                for (var j = 0; j < lista.length; j++) {
                    if (lista[j] == cadenaArray[i]) {
                        var count = count + 1;
                    }
                }
                if (count == 0) {
                    lista.push([cadenaArray[i]]);
                }
            }
        }
        var listaData = JSON.stringify(lista);
        var chasisCorreo = listaData;
        var nomVar = "chasisCorreo";
        var respuesta = await correoChasis(nomVar, listaData);

        var contador = 0;
        document.getElementById("tableChasisCorreoPreVisual").innerHTML = '<table id="tableChasPrevisual" class="table dt-responsive table-sm table-hover">';
        //tableChasPrevisual
        listaPrevisual = [];
        listaCorreo = [];
        for (var i = 0; i < respuesta.length; i++) {

            var contador = contador + 1;
            var idIng = respuesta[i].idIng;
            var idRet = respuesta[i].idRet;
            var idChasSalida = respuesta[i].idChasSalida;
            var nitEmpresa = respuesta[i].nitEmpresa;
            var empresa = respuesta[i].nombreEmpresa;
            var tipoVehiculo = respuesta[i].tipoVehiculo;
            var linea = respuesta[i].linea;
            var chasis = respuesta[i].chasis;
            var acciones = '<div class="btn-group btn-sm"><button type="button" buttonid="' + idIng + '" class="btn btn-outline-info bntImprimir btn-sm">Ing. <i class="fa fa-print"></i></button><button type="button" class="btn btn-outline-primary btn-sm" id="btnReimprimeRet" idret="' + idRet + '">Ret. <i class="fa fa-print"></i></button></div>';
            listaPrevisual.push([contador, nitEmpresa, empresa, chasis, tipoVehiculo, linea, acciones]);
            listaCorreo.push([idChasSalida]);
        }
                    var listaData = JSON.stringify(listaCorreo);
            // Guardar listaStringRet en el localstorage
            localStorage.setItem("listaCorreoChas", listaData);
        $('#tableChasPrevisual').DataTable({
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
            data: listaPrevisual,
            columns: [{
                    title: "#"
                }, {
                    title: "Nit"
                }, {
                    title: "Empresa"
                }, {
                    title: "Chasis"
                }, {
                    title: "Linea"
                }, {
                    title: "Tipo Veh."
                }, {
                    title: "Acciones"
                }]
        });


    }
})

function correoChasis(nomVar, chasisCorreo) {
    let estado;
    var datos = new FormData();
    datos.append(nomVar, chasisCorreo);
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
            estado = respuesta;
        }, error: function (respuesta) {
            console.log(respuesta);
        }
    });
    return estado;

}

$(document).ready(function () {
    localStorage.removeItem("listaCorreoChas");
})

$(document).on("click", ".btnGuardarCorreoChasis", async function () {
    if ("listaCorreoChas" in localStorage) {
        var data = localStorage.getItem("listaCorreoChas");


        var nomVar = "guardarCorreo";
        var respuesta = await correoChasis(nomVar, data);
        console.log(data);
    }else{
        alert("no puede continuar");
    }
})
