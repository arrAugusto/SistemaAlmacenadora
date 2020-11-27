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
    } else {
        alert("no puede continuar");
    }
})

$(document).on("click", ".btnGPOEmpresasNew", async function () {
    var dato = document.getElementById("textEmpresaGPO").value;
    var dato = dato.trim();
    var nomVar = "gdEmpresaPrimary";
    var respuesta = await correoChasis(nomVar, dato);
    if (respuesta != "SD") {
        if (respuesta[0]["resp"] == 0) {
            Swal.fire({
                title: 'Actualizado correctamente',
                text: "Se cargo la nueva empresa como primaria para grupos de vehículos!",
                type: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ok!'
            }).then((result) => {
                if (result.value) {
                    location.reload();
                }
            })
        } else {
            Swal.fire({
                title: 'Esta duplicando la empresa',
                text: "La empresa ya existe en el registro no puede ingresarla dos veces, revise!",
                type: 'error',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ok!'
            })
        }
    } else {
        Swal.fire({
            title: 'Ocurrio un error',
            text: "No se pudo guardar intente de nuevo!",
            type: 'error',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok!'
        }).then((result) => {
            if (result.value) {
                location.reload();
            }
        })
    }
})


$(document).on("click", ".bntGPOEmpresa", async function () {
    document.getElementById("bntGPOEmpresa").innerHTML = '';

    var idEmpresaGPO = $(this).attr("idbutton");
    var nomVar = "idEmpresaGPO";
    var respuesta = await correoChasis(nomVar, idEmpresaGPO);
    if (respuesta != "SD") {
        document.getElementById("divEmpresasGPO").innerHTML = `
            <div class="input-group">
                    <input type="text" id="textBusquedaNit" placeholder="Escriba el nit de la empresa" class="form-control is-invalid buscando" onkeyup="javascript:this.value = this.value.toUpperCase();">
                <span class="input-group-append">
                    <button type="button" class="btn btn-primary btn-block btnNitEmpresaGropVeh" idUnionEmpresa=` + idEmpresaGPO + `><i class="fa fa-search"></i></button>
                </span>
             </div>

`;

        document.getElementById("bntGPOEmpresa").innerHTML = '<table id="tableEmpresasGrupo" class="table table-hover table-sm"></table>';
        var numero = 0;
        lista = [];
        for (var i = 0; i < respuesta.length; i++) {
            var numero = numero + 1;
            var nombreGrupo = respuesta[i].nombreGrupo;
            var nitEmpresa = respuesta[i].nitEmpresa;
            var nombreEmpresa = respuesta[i].nombreEmpresa;
            var direccionEmpresa = respuesta[i].direccionEmpresa;
            lista.push([numero, nombreGrupo, nitEmpresa, nombreEmpresa, direccionEmpresa]);

        }

        $('#tableEmpresasGrupo').DataTable({
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
            data: lista,
            columns: [{
                    title: "#"
                }, {
                    title: "Nombre Grupo"
                }, {
                    title: "Empresa"
                }, {
                    title: "Nit"
                }, {
                    title: "Direccion"
                }]
        });

    } else {
        Swal.fire(
                'Sin empresas!',
                'Esta empresa primaria no tiene ningun vinculo con ninguna otra empresa!',
                'warning'
                )
        document.getElementById("divEmpresasGPO").innerHTML = `
            <div class="input-group">
                    <input type="text" id="textBusquedaNit" placeholder="Escriba el nit de la empresa" class="form-control is-invalid buscando" onkeyup="javascript:this.value = this.value.toUpperCase();">
                <span class="input-group-append">
                    <button type="button" class="btn btn-primary btn-block btnNitEmpresaGropVeh" idUnionEmpresa=` + idEmpresaGPO + `><i class="fa fa-search"></i></button>
                </span>
             </div>

`;
    }
})

$(document).on("click", ".btnNitEmpresaGropVeh", async function () {
    var idUnionEmpresa = $(this).attr("idUnionEmpresa");

    var nitNewCons = document.getElementById("textBusquedaNit").value;
    var nomVar = "consultaEmpresa";
    var resp = await revisarVehUsados(nomVar, nitNewCons);

    if (resp != "SD") {
        var nitEmpresa = resp[0].nitEmpresa;
        var nombreEmpresa = resp[0].nombreEmpresa;
        var direccionEmpresa = resp[0].direccionEmpresa;
        var idNitEmp = resp[0].idNitEmp;
        document.getElementById("empresaGrupoVeh").innerHTML =
                `
            <label>
                Datos del Cliente
            </label>
            <address>
                <b>
                    Nit:
                </b>
                <label id="lblNit" style="font-weight: normal;">` + nitEmpresa + `</label>
                <br />
                <b>
                    Empresa:
                </b>
                <label id="lblEmpresa" style="font-weight: normal;">` + nombreEmpresa + `</label>
                <br />
                <b>
                    Direccion:
                </b>
                <label id="lblDireccion" style="font-weight: normal;">` + direccionEmpresa + `</label>
                <br />
                <button type="button" class="btn btn-warning btn-block bntHacerUnionEmpresa" idUnionEmpresa="` + idUnionEmpresa + `" idNit="` + idNitEmp + `">Hacer vinculo Nuevo Consolidado</button>
                <br />
            </address>

`;
    }
})


$(document).on("click", ".bntHacerUnionEmpresa", async function () {
    var idEmpresaUnion = $(this).attr("idunionempresa");
    var idNitUnion = $(this).attr("idnit");
    var resp = await ajaxParamsNewParam(idNitUnion, idEmpresaUnion);
    if (resp == true) {
        Swal.fire(
                'Agregado!',
                'Se agrego la poliza al grupo!',
                'success'
                )
    }
})

function ajaxParamsNewParam(idNitUnion, idEmpresaUnion) {
    let estado;
    var datos = new FormData();
    datos.append("idNitUnion", idNitUnion);
    datos.append("idEmpresaUnion", idEmpresaUnion);
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

$(document).on("click", ".btnVerCorreos", async function () {
    var idGrupo = $(this).attr("idbutton");
    window.open("extensiones/tcpdf/pdf/Ingreso-Acuse-Recibo.php?Ingreso=" + idGrupo, "_blank");
})

