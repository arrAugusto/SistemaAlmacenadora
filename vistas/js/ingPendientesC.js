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
    lista = [];
    // Guardar listaString en el localstorage
    var data = localStorage.getItem("listaString", listaString);
    if (data) {


        var data = JSON.parse(data);

        if (data.length > 0) {
            lista.push(data);
        }
        var idret = $(this).attr("buttonid");
        data.push(idret);
        var listaString = JSON.stringify(data);
    } else {

        var idret = $(this).attr("buttonid");
        lista.push(idret);
        var listaString = JSON.stringify(lista);
    }
    console.log(lista);


    // Guardar listaString en el localstorage
    localStorage.setItem("listaString", listaString);


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
        console.log(fechaCongeladaConta);

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

                // Guardar listaString en el localstorage
                var data = localStorage.getItem("listaString");
                var listaIng = JSON.parse(data);
                console.log(fechaCongeladaConta);
                var contador = 0;
                for (var i = 0; i < listaIng.length; i++) {
                    var buttonid = listaIng[i];
                    var buttonid = buttonid * 1;
                    console.log(buttonid);

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
    var estado = $(this).attr("estado");
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


$(document).ready(function () {
    localStorage.removeItem("listaString");
    localStorage.removeItem("fechaCongeladaConta");
    localStorage.removeItem("listaStringRet");
})

$(document).on("click", ".btnDescargaExcelIngRep", async function () {
    var estadoRep = $(this).attr("estadoRep");
    Swal.fire({
        title: 'Quiere descarga el reporte en excel?',
        text: "Esto puede tardar unos segundos!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        allowOutsideClick: false,
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Descargar!'
    }).then(async function (result) {
        if (result.value) {
            var descarga = estadoRep;
            if (descarga == 4) {
                var nombreReporte = "REPORTE DE INGRESOS PENDIENTES DE CONTABILIZAR";
            }
            if (descarga == 5) {
                var nombreReporte = "REPORTE DE INGRESOS CONTABILIZADOS";
            }

            var nomVar = "descagarReporte";
            var resp = await contabilizarReportes(nomVar, descarga);

            var nombreEncabezado = "DescargaReporteExcel";
            var nombreFile = "ReporteDeIngresos_";
            var creaExcel = await JSONToCSVDescargaExcel(resp, nombreEncabezado, nombreReporte, nombreFile, true);
            console.log(resp);
        }
    })
})

function JSONToCSVDescargaExcel(JSONData, ReportTitle, nombreReporte, nombreFile, ShowLabel) {


    //If JSONData is not an object then JSON.parse will parse the JSON string in an Object
    var arrData = typeof JSONData != 'object' ? JSON.parse(JSONData) : JSONData;

    var CSV = '';
    //Set Report title in first row or line

    CSV += "ALMACENADORA INTEGRADA S A" + '\r\n';
    CSV += nombreReporte + ' \r\n\n';

    //This condition will generate the Label/Header
    if (ShowLabel) {
        var row = "";

        //This loop will extract the label from 1st index of on array
        for (var index in arrData[0]) {

            //Now convert each value to string and comma-seprated
            row += index + '|';
        }

        row = row.slice(0, -1);

        //append Label row with line break
        CSV += row + '\r\n';
    }

    //1st loop is to extract each row
    for (var i = 0; i < arrData.length; i++) {
        var row = "";

        //2nd loop will extract each column and convert it in string comma-seprated
        for (var index in arrData[i]) {
            row += '"' + arrData[i][index] + '"|';
        }

        row.slice(0, row.length - 1);

        //add a line break after each row
        CSV += row + '\r\n';
    }

    if (CSV == '') {
        alert("Invalid data");
        return;
    }

    //Generate a file name
    var fileName = nombreFile;
    //this will remove the blank-spaces from the title and replace it with an underscore
    fileName += ReportTitle.replace(/ /g, "_");

    //Initialize file format you want csv or xls
    var uri = 'data:application/vnd.ms-excel;charset=utf-8,' + escape(CSV);

    // Now the little tricky part.
    // you can use either>> window.open(uri);
    // but this will not work in some browsers
    // or you will not get the correct file extension    

    //this trick will generate a temp <a /> tag
    var link = document.createElement("a");
    link.href = uri;

    //set the visibility hidden so it will not effect on your web-layout
    link.style = "visibility:hidden";
    link.download = fileName + ".xls";

    //this part will append the anchor tag and remove it after automatic click
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

