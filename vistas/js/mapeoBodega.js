$(document).on("click", ".btnMapeando", function () {
    var cantPasillos = document.getElementById("cantPasillos").value;
    var cantColumnas = document.getElementById("cantColumnas").value;
    if (cantPasillos == null || cantColumnas == null && cantPasillos == "" || cantColumnas == "") {
        alert("ingrese valores para crear el mapa");
    } else {
        if (isNaN(cantPasillos || cantColumnas)) {
            alert("estas ingresando textos");
        } else {
            var ejeY = (490 / cantPasillos).toFixed(4);
            var ejeX = (1600 / cantColumnas).toFixed(4);
            /*
             var table = document.createElement('table');
             table.innerHTML="<tr><td style="+'background-color:#29b6f6 width:500px height:140px text-align:center border: 1px solid #666 td:hover{background-color: #7986cb};'+">123</td><td>456</td></tr>"
             document.getElementById("mapeandoUbicaciones").appendChild(table);
             */
            var tabla = genera_tabla(cantPasillos, cantColumnas);
        }
    }
})

function genera_tabla(cantPasillos, cantColumnas) {
    var paranPasillo = parseInt(cantPasillos);
    var paranColumna = parseInt(cantColumnas);  // Obtener la referencia del elemento body     
    var body = document.getElementsByTagName("body")[0];   // Crea un elemento <table> y un elemento <tbody>
    var tabla   = document.createElement("table"); 
    var tblBody = document.createElement("tbody");   // Crea las celdas
    for (var i = 0; i < paranPasillo; i++) {    // Crea las hileras de la tabla           
        var hilera = document.createElement("tr");    
        for (var j = 0; j < paranColumna; j++) {      // Crea un elemento <td> y un nodo de texto, haz que el nodo de
                  // texto sea el contenido de <td>, ubica el elemento <td> al final
                  // de la hilera de la tabla                 
            var celda = document.createElement("td");
            pasY = i + 1;
            colX = j + 1;
            celda.setAttribute("id", "P" + pasY + "C" + colX);
            celda.setAttribute("pasYcolX", "P" + pasY + "C" + colX);
            celda.setAttribute("pasY", pasY);
            celda.setAttribute("colX", colX);
            celda.setAttribute("estado", 0);
            celda.setAttribute("onClick", "congelarCelda('P" + pasY + "C" + colX + "')");   
            var textoCelda = document.createTextNode("P" + pasY + "C" + colX);     
            celda.appendChild(textoCelda);    
            hilera.appendChild(celda); 
        }     // agrega la hilera al final de la tabla (al final del elemento tblbody)
           
        tblBody.appendChild(hilera); 
    }   // posiciona el <tbody> debajo del elemento <table>
     
    tabla.appendChild(tblBody);  // appends <table> into <body>
    document.getElementById("mapeandoUbicaciones").appendChild(tabla);   // modifica el atributo "border" de la tabla y lo fija a "2";
    tabla.setAttribute("id", "tablaScrolling");
    tabla.setAttribute("width", "100%");
}

function congelarCelda(casilla) {
    var intro = document.getElementById(casilla);
    var pasEjeY = $(intro).attr("pasY");
    var pasEjeX = $(intro).attr("colx");
    var estado = $(intro).attr("estado");
    if (estado == 0) {
        intro.style.backgroundColor = '#EB3FF3';
        intro.style.color = "white";
        $(intro).attr("estado", 1);
        $("#mapeandoAcciones").append('<label id="resetCelda' + casilla + '" ejeY=' + pasEjeY + ' ejeX=' + pasEjeX + ' resetCelda="' + casilla + '" class="resetCelda"> <i class="fa fa-trash" style="color:white"> ' + casilla + '</i></label>');
    } else if (estado == 1) {
        intro.style.backgroundColor = '#673ab7';
        intro.style.color = "white";
        $(intro).attr("estado", 0);
        console.log("resetCelda" + casilla);
        document.getElementById("resetCelda" + casilla).remove();
    }
}
$(document).on("click", ".resetCelda", function () {
    var ubi = $(this).attr("resetcelda");
    var reset = document.getElementById(ubi);
    reset.style.backgroundColor = '#673ab7';
    $(reset).attr("estado", 0);
    $(this).remove();
})
$(document).on("click", ".btnGuardarMapa", function () {
    var paragraphs = Array.from(document.querySelectorAll(".resetCelda"));
    listaUbInactiva = [];
    for (var i = 0; i < paragraphs.length; i++) {
        var datoY = paragraphs[i].attributes.ejeY.value;
        var datoX = paragraphs[i].attributes.ejeX.value;
        listaUbInactiva.push({
            "datoY": datoY,
            "datoX": datoX
        })
    }
    $("#hiddenArray").val(JSON.stringify(listaUbInactiva));
    var pasillos = document.getElementById("cantPasillos").value;
    var columnas = document.getElementById("cantColumnas").value;
    var nuevArea = document.getElementById("nuevArea").value;
    var nuevDependencia = document.getElementById("nuevDependencia").value;

    var numeroBodega = document.getElementById("numeroBodega").value;
    var listaUbInactiva = document.getElementById("hiddenArray").value;
    var datos = new FormData();
    datos.append("pasillos", pasillos);
    datos.append("columnas", columnas);
    datos.append("nuevArea", nuevArea);
    datos.append("nuevDependencia", nuevDependencia);
    datos.append("numeroBodega", numeroBodega);
    datos.append("listaUbInactiva", listaUbInactiva);
    $.ajax({
        url: "ajax/mapeo.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta);
            if (respuesta == "fin") {
                swal({
                    title: "Creada Con exito",
                    text: "La bodega fue creada exitosamente...",
                    type: "success"
                }).then(okay => {
                    if (okay) {
                        window.location = "mapeoBodega";
                    }
                });
            } else if (respuesta == "Existe") {
                swal({
                    title: "Mapa existente",
                    text: "El mapa que ud quiere crear ya existe",
                    type: "error"
                }).then(okay => {
                    if (okay) {
                    }
                });
            }
            console.log(respuesta);
        },
        error: function (respuesta) {
            console.log(respuesta);
        }
    })
})
