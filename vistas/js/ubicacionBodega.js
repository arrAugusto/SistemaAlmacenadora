function capturar(e) {
    toastr.clear();
    var dataId = "#" + e.id;
    console.log(dataId);
    var idSpan = e.id;
    var idBodegaAttr = $(dataId).attr("idbodega");
    console.log(idBodegaAttr);
    var hiddenIdBod = document.getElementById("listaUbicaciones").value;
    var obj = JSON.parse(hiddenIdBod);
    console.log(obj);
    for (var i = 0; i < obj.length; i++) {
        if (obj[i]["idBodega"] == idBodegaAttr) {
            var identifica = obj[i]["identifica"];
            listaRepetidas = [];
            var repetir = 0;
            for (var repeat = 0; repeat < obj.length; repeat++) {
                if (obj[repeat]["identifica"] == identifica) {
                    var repetir = repetir + 1;
                    var pasy = obj[repeat]["pasillo"];
                    var pasx = obj[repeat]["columna"];
                    var pasyx = "elemento" + pasy + pasx + obj[repeat]["idBodega"];
                    listaRepetidas.push({
                        "elemento": pasyx
                    });
                }
            }
            console.log(listaRepetidas);
            /*     document.getElementById("numIng").innerHTML = "";
             document.getElementById("numPoliza").innerHTML = "";
             document.getElementById("Nomempresa").innerHTML = "";
             document.getElementById("cantBultos").innerHTML = "";
             document.getElementById("CantpesoKg").innerHTML = "";
             document.getElementById("descripcion").innerHTML = "";
             document.getElementById("posiciones").innerHTML = "";
             document.getElementById("metros").innerHTML = "";
             document.getElementById("numPoliza").innerHTML = "Numero de Poliza : " + obj[i]["poliza"];
             document.getElementById("Nomempresa").innerHTML = "Empresa : " + obj[i]["clienteEmpresa"];
             document.getElementById("cantBultos").innerHTML = "Bultos : " + obj[i]["blts"];
             document.getElementById("CantpesoKg").innerHTML = "Peso kg : " + obj[i]["dimPeso"];
             document.getElementById("descripcion").innerHTML = "Descripción  :  " + obj[i]["detalleM"];
             document.getElementById("posiciones").innerHTML = "Posiciones  : " + obj[i]["pos"];
             document.getElementById("metros").innerHTML = "Metros  : " + obj[i]["mts"];*/
            var idDetalle = obj[i]["idDetalle"];
            var poliza = obj[i]["poliza"];
            var empresa = obj[i]["clienteEmpresa"];
            var bultos = obj[i]["blts"];
            var peso = obj[i]["dimPeso"];
            var descripcion = obj[i]["detalleM"];
            var posiciones = obj[i]["pos"];
            var metros = obj[i]["mts"];
            var Idincidencia = obj[i]["Idincidencia"];
            var pasillo = obj[i]["pasillo"];
            var columna = obj[i]["columna"];

            var tipo = 0;
            if ($(".btnCambiarUbicaciones").length >= 1) {
                var tipo = 1;
            }
            console.log(tipo);
            alertaUbicacion(poliza, empresa, bultos, peso, descripcion, posiciones, metros, idDetalle, Idincidencia, idSpan, tipo);


        }
    }

    /* var x = event.clientX;
     var y = event.clientY;
     $("#tip2").css("left", x + 30);
     $("#tip2").css("top", y - 270);
     $("#tip2").css("display", "inline-block");
     */


    if (repetir >= 2) {
        for (var mostList = 0; mostList < listaRepetidas.length; mostList++) {
            var mostrarLista = listaRepetidas[mostList]["elemento"];
            console.log(mostrarLista);
            document.getElementById(mostrarLista).setAttribute("style", "color: #0FF913; font-size:4px;");
        }
    }
}

function desmarcar(e) {
    var dataId = "#" + e.id;
    var idBodegaAttr = $(dataId).attr("idbodega");
    var hiddenIdBod = document.getElementById("listaUbicaciones").value;
    var obj = JSON.parse(hiddenIdBod);
    console.log(obj);
    for (var i = 0; i < obj.length; i++) {
        if (obj[i]["idBodega"] == idBodegaAttr) {
            var identifica = obj[i]["identifica"];
            listaRepetidas = [];
            var repetir = 0;
            for (var repeat = 0; repeat < obj.length; repeat++) {
                if (obj[repeat]["identifica"] == identifica) {
                    var repetir = repetir + 1;
                    var pasy = obj[repeat]["pasillo"];
                    var pasx = obj[repeat]["columna"];
                    var pasyx = "elemento" + pasy + pasx + obj[repeat]["idBodega"];
                    listaRepetidas.push({
                        "elemento": pasyx
                    });
                }
            }
            document.getElementById("numIng").innerHTML = "";
            document.getElementById("numPoliza").innerHTML = "";
            document.getElementById("Nomempresa").innerHTML = "";
            document.getElementById("cantBultos").innerHTML = "";
            document.getElementById("CantpesoKg").innerHTML = "";
            document.getElementById("descripcion").innerHTML = "";
            document.getElementById("posiciones").innerHTML = "";
            document.getElementById("metros").innerHTML = "";
        }
    }
    // $("#tip2").css("display", "none");
    if (repetir >= 2) {
        for (var mostList = 0; mostList < listaRepetidas.length; mostList++) {
            var mostrarLista = listaRepetidas[mostList]["elemento"];
            document.getElementById(mostrarLista).setAttribute("style", "color: #000C46; font-size:4px;");
        }
    }
}
$(document).on("click", ".btnSearch", function () {
    document.getElementById("detalleSeleccionado").innerHTML = "";
    var datoSearch = document.getElementById("textParamBusq").value;
    console.log(datoSearch);
    var hiddenIdBodega = document.getElementById("hiddenIdBod").value;
    console.log(hiddenIdBodega);
    datoSearch.toLowerCase();
    if (datoSearch == "") {
        Swal.fire('Sin datos', 'No ingreso datos, escriba la poliza, contenedor, nit, nombre de la poliza', 'error');
    } else if (datoSearch !== "") {
        var datos = new FormData();
        datos.append("datoSearch", datoSearch);
        datos.append("hiddenIdBodega", hiddenIdBodega);
        $.ajax({
            url: "ajax/ubicacionBodega.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (respuesta) {
                console.log(respuesta);
                if (respuesta == "SD") {
                    Swal.fire('Sin datos', 'No se encontro ninguna coincidencia con el dato : ' + datoSearch + ' sea mas específico', 'error')
                } else {

                    document.getElementById("detalleSeleccionado").innerHTML = "";
                    document.getElementById("detalleSeleccionado").innerHTML = '<table id="tableDetallesIngMap" class="table table-hover table-sm"></table>';
                    var listaDataDetalle = [];
                    var contador = 0;
                    console.log(respuesta["detallesIngs"].length);
                    console.log(respuesta["detallesIngs"][0].length);
                    var listaDataDetalles = [];
                    console.log(respuesta["respuestaUbicas"]);
                    console.log(respuesta["detallesIngs"]);

                    for (var i = 0; i < respuesta["detallesIngs"].length; i++) {
                        for (var j = 0; j < respuesta["detallesIngs"][i].length; j++) {
                            var contador = contador + 1;
                            var cosolidado = respuesta["detallesIngs"][i][j].consolidado;
                            var pol = respuesta["detallesIngs"][i][j].pol;
                            var empresa = respuesta["detallesIngs"][i][j].empresa;
                            var merca = respuesta["detallesIngs"][i][j].merca;
                            var bultos = respuesta["detallesIngs"][i][j].bultos;
                            var pesoKG = respuesta["detallesIngs"][i][j].pesoKG;
                            var stockP = respuesta["detallesIngs"][i][j].stockP;
                            var stockM = respuesta["detallesIngs"][i][j].stockM;
                            var acciones = '<button class="btn btn-info btnVista" id="buttonVista' + respuesta["detallesIngs"][i][j].idDet + '" idDetalle=' + respuesta["detallesIngs"][i][j].idDet + ' idIng=' + respuesta["detallesIngs"][i][j].idIng + ' merca = "' + merca + '" peso="' + pesoKG + '"><i class="fas fa-eye"></i></button>';
                            listaDataDetalle.push([contador, cosolidado, pol, empresa, merca, bultos, pesoKG, stockP, stockM, acciones]);
                        }
                    }
                    $('#tableDetallesIngMap').DataTable({
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
                        },
                        data: listaDataDetalle,
                        columns: [{
                                title: "#"
                            }, {
                                title: "Consolidado"
                            }, {
                                title: "Poliza Ingreso"
                            }, {
                                title: "Consignatario"
                            }, {
                                title: "Descripción"
                            }, {
                                title: "Bultos"
                            }, {
                                title: "Peso KG"
                            }, {
                                title: "Stock Posiciones"
                            }, {
                                title: "Stock Metros"
                            }, {
                                title: "Acciones"
                            }]
                    });

                    document.getElementById("listaUbicaciones").value = "";
                    document.getElementById("listaUbicaciones").value = JSON.stringify(respuesta["respuestaUbicas"]);
                    datoY = respuesta["respuestaDibuja"][0].pasillos;
                    datoX = respuesta["respuestaDibuja"][0].columnas;
                    for (var i = 1; i < datoY + 1; i++) {
                        for (var j = 1; j < datoX + 1; j++) {
                            var pasilloY = "P" + i;
                            var columnaX = "C" + j;
                            document.getElementById(pasilloY + columnaX).innerHTML = pasilloY + columnaX;
                        }
                    }
                    for (var resUbica = 0; resUbica < respuesta["respuestaUbicas"].length; resUbica++) {
                        var pasillo = "P" + respuesta["respuestaUbicas"][resUbica].pasillo;
                        var pasilloUnic = respuesta["respuestaUbicas"][resUbica].pasillo;
                        var columna = "C" + respuesta["respuestaUbicas"][resUbica].columna;
                        var columnaUnic = respuesta["respuestaUbicas"][resUbica].columna;
                        var idBod = respuesta["respuestaUbicas"][resUbica].idBodega;

                        document.getElementById(pasillo + columna).innerHTML += '<br/>&nbsp;&nbsp;<i class="fa fa-circle element" id="elemento' + pasilloUnic + columnaUnic + idBod + '" idbodega="' + idBod + '" onmouseover="capturar(' + "elemento" + pasilloUnic + columnaUnic + idBod + ')" onmouseout="desmarcar(' + "elemento" + pasilloUnic + columnaUnic + idBod + ')" style="font-size:5px"></i>';
                    }
                }
            },
            error: function (respuesta) {
                console.log(respuesta);
            }
        });
    }
});



$(document).on("click", ".btnLimpiarPan", function () {
    location.reload();
});

$(document).on("mouseover", ".btnVista", async function () {
    var idDetView = $(this).attr("iddetalle");
    var tipo = 0;
    var merca = $(this).attr("merca");
    var peso = $(this).attr("peso");
    var ubicaciones = await ajaxMostrarUbicacion(tipo, idDetView, merca, peso);

    console.log(ubicaciones);

});

$(document).on("mouseout", ".btnVista", async function () {
    var idDetView = $(this).attr("iddetalle");
    var tipo = 1;
    var merca = $(this).attr("merca");
    var peso = $(this).attr("peso");
    var ubicaciones = await ajaxMostrarUbicacion(tipo, idDetView, merca, peso);
    console.log(ubicaciones);

});


function ajaxMostrarUbicacion(tipo, idDetView, merca, peso) {
    let todoMenus;
    var datos = new FormData();
    datos.append("idDetView", idDetView);
    $.ajax({
        async: false,
        url: "ajax/ubicacionBodega.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: async function (respuesta) {

            console.log(respuesta);
            if (respuesta != "SD") {
                var color = await getRandomColor();

                for (var i = 0; i < respuesta.length; i++) {
                    var colX = respuesta[i].columnaX;
                    var pasY = respuesta[i].pasilloY;
                    var idUbi = respuesta[i].idUbi;
                    var ubica = 'elemento' + pasY + colX + idUbi;
                    console.log(tipo);
                    if (tipo == 0) {
                        console.log(ubica);
                        document.getElementById(ubica).setAttribute("style", "color:" + color + "; font-size:20px;");
                        var button = document.getElementById("buttonVista" + idDetView);
                        button.style.backgroundColor = color;
                    } else if (tipo == 1) {
                        var descongelar = await descongelarConTiempo(ubica, idDetView);
                    }
                }
            }


            todoMenus = "Ok";


        }, errror: function (respuesta) {
            console.log(respuesta);
        }});
    return todoMenus;
}


function descongelarConTiempo(ubica, idDetView) {
    setTimeout(function () {
        document.getElementById(ubica).setAttribute("style", "color: #000C46; font-size:4px;");
        var button = document.getElementById("buttonVista" + idDetView);
        button.removeAttribute('style');
    }, 10000);


}
function getRandomColor() {
    var letters = '0123456789ABCDEF';
    var color = '#';
    for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}

$(document).on("click", ".btnModificarUbica", async function () {
    var idDet = $(this).attr("idDetModificar");
    var idIncidencia = $(this).attr("idincidencia");
    document.getElementById("mapeandoAcciones").innerHTML = "";
    var ubicacionEdicion = await mapaEdicionUbicacionModificar(idDet);
    document.getElementById("divBotonesAcciones").innerHTML = `<button type="button" class="btn btn-info btn-block btnUbModificadas" idDet=` + idDet + ` idIncidencia=` + idIncidencia + `>Guardar Ubicaciones Modificadas <i class="fas fa-save"><i/></button>`;
    console.log(ubicacionEdicion);
})

$(document).on("click", ".btnUbModificadas", async function () {
    var idDet = $(this).attr("idDet");
    var Idincidencia = $(this).attr("Idincidencia");
    var respuestaGuardaUb = await ajaxGuardarListaModificada(idDet, Idincidencia);
    if (respuestaGuardaUb == "Ok") {
        swal({
            title: "Operación Exitosa",
            text: "Las ubicaciones fueron agregadas correctamente",
            type: "success"
        }).then(okay => {
            if (okay) {
                location.reload();
            }
        });
    }
})


function ajaxGuardarListaModificada(idDet, Idincidencia) {
    let todoMenus;
    var paragraphs = Array.from(document.querySelectorAll(".resetCeldas"));
    GdListaUbModificada = [];
    for (var i = 0; i < paragraphs.length; i++) {
        var datoY = paragraphs[i].attributes.ejeY.value;
        var datoX = paragraphs[i].attributes.ejeX.value;
        GdListaUbModificada.push({
            "datoY": datoY,
            "datoX": datoX
        });
    }
    GdListaUbModificadas = JSON.stringify(GdListaUbModificada);
    console.log(GdListaUbModificadas);
    var datos = new FormData();
    datos.append("GdListaUbModificada", GdListaUbModificadas);
    datos.append("idDet", idDet);
    datos.append("Idincidencia", Idincidencia);
    $.ajax({
        async: false,
        url: "ajax/inventariosFiscales.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            if (respuesta == "fin") {
                todoMenus = "Ok";
            } else {
                todoMenus = "error";

            }



        }, errror: function (respuesta) {
            todoMenus = "error";
        }});
    return todoMenus;
}

$(document).on("click", ".bntCambioUbN", async function () {
    window.location = "inventariosFiscales";
})


$(document).ready(function () {
    if (screen.width < 1024) {
        if ($("#mapEntradaUbic").length >= 1) {
            $("#mapEntradaUbic").remove();
            $("#mapeandoUbica").removeClass("col-10");
            $("#mapeandoUbica").addClass("col-12");
            alert("hola mundo");

        }
    }
    if (screen.width < 1280) {
        $("#mapEntradaUbic").remove();
        $("#mapeandoUbica").removeClass("col-10");
        $("#mapeandoUbica").addClass("col-12");
    }
})