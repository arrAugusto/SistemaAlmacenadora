$(document).on("click", ".btnGeneracionExcel", function () {
    var idIngreso = $(this).attr("buttonid");
    console.log(idIngreso);
    var datos = new FormData();
    datos.append("idIngresoExcel", idIngreso);
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
            var nombreEncabezado = "archivoDEDB";
            var movimientos = respuesta["moviminetos"];
            var detalles = respuesta["detalles"];
            JSONToCSVConvertor(movimientos, detalles, nombreEncabezado, true);
        }, errror: function (respuesta) {
            console.log(respuesta);
        }});

})

function JSONToCSVConvertor(JSONData, detalles, ReportTitle, ShowLabel) {
    //If JSONData is not an object then JSON.parse will parse the JSON string in an Object
    var arrData = typeof JSONData != 'object' ? JSON.parse(JSONData) : JSONData;

    //If JSONData is not an object then JSON.parse will parse the JSON string in an Object
    var arrayDetalles = typeof JSONData != 'object' ? JSON.parse(detalles) : detalles;

    var CSV = '';
    //Set Report title in first row or line

    CSV += "ALMACENADORA INTEGRADA S A" + '\r\n\n\n';
    CSV += "MOVIMIENTO DE" + '\r\n';
    CSV += "INGRESOS Y RETIROS" + '\r\n';
    //This condition will generate the Label/Header
    if (ShowLabel) {
        var row = "";

        //This loop will extract the label from 1st index of on array
        for (var index in arrData[0]) {

            //Now convert each value to string and comma-seprated
            row += index + ',';
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
            row += '"' + arrData[i][index] + '",';
        }

        row.slice(0, row.length - 1);

        //add a line break after each row
        CSV += row + '\r\n';
    }
    CSV += '\r\n';
    CSV += '\r\n';
    CSV += "STOCK DE DETALLES" + '\r\n\n';

    /***************************************************************************************************************/

    if (ShowLabel) {
        var row = "";

        //This loop will extract the label from 1st index of on array
        for (var index in arrayDetalles[0]) {

            //Now convert each value to string and comma-seprated
            row += index + ',';
        }

        row = row.slice(0, -1);

        //append Label row with line break
        CSV += row + '\r\n';
    }

    //1st loop is to extract each row
    for (var i = 0; i < arrayDetalles.length; i++) {
        var row = "";

        //2nd loop will extract each column and convert it in string comma-seprated
        for (var index in arrayDetalles[i]) {
            row += '"' + arrayDetalles[i][index] + '",';
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
    var fileName = "RegistroMovimientos_";
    //this will remove the blank-spaces from the title and replace it with an underscore
    fileName += ReportTitle.replace(/ /g, "_");

    //Initialize file format you want csv or xls
    var uri = 'data:text/csv;charset=utf-8,' + escape(CSV);

    // Now the little tricky part.
    // you can use either>> window.open(uri);
    // but this will not work in some browsers
    // or you will not get the correct file extension    

    //this trick will generate a temp <a /> tag
    var link = document.createElement("a");
    link.href = uri;

    //set the visibility hidden so it will not effect on your web-layout
    link.style = "visibility:hidden";
    link.download = fileName + ".csv";

    //this part will append the anchor tag and remove it after automatic click
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}


$(document).on("click", ".btnEditBod", async function () {
    var valIdIng = $(this).attr("btnEditBod");
    var detalles = await mostrarEdicionesBodega(valIdIng);
    var css = "display: block;";
    document.getElementById("divEdicionesBodega").setAttribute("style", css);
        var css = "display: none;";
    document.getElementById("divTableUbi").setAttribute("style", css);  
})



function mostrarEdicionesBodega(valIdIng) {

    let todoMenus;
    var datos = new FormData();
    datos.append("idIngEdicionBod", valIdIng);

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
            console.log(respuesta);
            if (respuesta != "SD") {
                document.getElementById("divContenidoEdicionBodega").innerHTML = "";
                for (var i = 0; i < respuesta.length; i++) {

                    document.getElementById("divContenidoEdicionBodega").innerHTML += `

                <div id="divNum5" class="row">
                	<div class="col-3">
                		<div class="form-group">
                			<label>Empresa</label>
                			<div class="input-group mb-1">
                				<div class="input-group-prepend">
                					<button idbuttondetalle="` + respuesta[i].idDetalle + `" class="btn btn-danger btnQuitarDetalle" type="button"><i class="fa fa-close" aria-hidden="true"></i></button>
                					<button idbuttondetalleedit="` + respuesta[i].idDetalle + `" class="btn btn-warning bntEditarDetalle" type="button" estado="0"><i class="fa fa-edit" aria-hidden="true"></i></button>
                				</div><!-- /btn-group -->
                				<input class="form-control" type="text" id="IdTextEmpresa` + respuesta[i].idDetalle + `" value="` + respuesta[i].Empresa + `" readonly="readOnly">
                			</div>
                		</div>
                	</div>
                	<div class="col-1">
                		<div class="form-group">
                			<label>Bultos</label>
                			<input class="form-control" placeholder="Numero de bultos" type="text" id="IdTextBultos` + respuesta[i].idDetalle + `" value="` + respuesta[i].stock_Bultos + `" readonly="readOnly">
                		</div>
                	</div>
                	<div class="col-2"><!-- /btn-group -->
                		<label> Posiciones y metraje</label>
                		<div class="input-group">
                			<input class="form-control" style="text-align: center;" type="text" id="IdTextPosiciones` + respuesta[i].idDetalle + `" value="` + respuesta[i].stock_Posiciones + `" readonly="readOnly"><b>||</b><input class="form-control" style="text-align: center;" type="text" id="IdTextMetraje` + respuesta[i].idDetalle + `" value="` + respuesta[i].stock_Metros + `" readonly="readOnly">
                		</div>
                	</div>
      
                	<div class="col-4">
                		<div class="form-group">
                			<label>Descripción de ingreso</label>
                			<div class="input-group input-group">
                				<input class="form-control" placeholder="Descripcion de ingreso" type="text" id="IdDescIngreso` + respuesta[i].idDetalle + `" value="` + respuesta[i].Descripción + `" readonly="readOnly"><span class="input-group-append">
                					<button type="button" class="btn btn-info btn-flat btnCambiarUbicaciones" idDet="` + respuesta[i].idDetalle + `">Opciones de Ubicación</button>
                				</span>
                			</div>
                		</div>
                	</div>
                </div>


`;
                }
            }


            todoMenus = "Ok";


        }, errror: function (respuesta) {
            console.log(respuesta);
        }});
    return todoMenus;
}

$(document).on("click", ".btnCambiarUbicaciones", async function () {
    
    var css = "display: block;";
    document.getElementById("divTableUbi").setAttribute("style", css);    
    var idDet = $(this).attr("idDet");
    console.log(idDet);
    
    var ubicacionEdicion = await mapaEdicionUbicacion(idDet);
    console.log(ubicacionEdicion);
})


function mapaEdicionUbicacion(idDet) {

    let todoMenus;
    var datos = new FormData();
    datos.append("iddetEdicionUbica", idDet);

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
            console.log(respuesta);
            document.getElementById("listaUbicaciones").value = "";
            document.getElementById("listaUbicaciones").value = JSON.stringify(respuesta["listaUbicaciones"]);
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

                document.getElementById(pasillo + columna).innerHTML += '<br/>&nbsp;&nbsp;<i class="fa fa-circle element" columnaX="'+respuesta["respuestaUbicas"][resUbica].columna+'" pasilloY="'+respuesta["respuestaUbicas"][resUbica].pasillo+'" id="elemento' + pasilloUnic + columnaUnic + idBod + '" idbodega="' + idBod + '" onmouseover="capturar(' + "elemento" + pasilloUnic + columnaUnic + idBod + ')" onmouseout="desmarcar(' + "elemento" + pasilloUnic + columnaUnic + idBod + ')" style="font-size:5px"></i>';
            }


        }, errror: function (respuesta) {
            console.log(respuesta);
        }});
    return todoMenus;
}

function mapaEdicionUbicacionModificar(idDet) {

    let todoMenus;
    var datos = new FormData();
    datos.append("iddetEdicionUbica", idDet);

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
            console.log(respuesta);
            //<td id="P2C1" pasycolx="P2C1" pasy="2" colx="1" estado="0" onclick="congelarCeldas('P2C1')">P2C1</td>///

            document.getElementById("listaUbicaciones").value = "";
            document.getElementById("listaUbicaciones").value = JSON.stringify(respuesta["listaUbicaciones"]);
            datoY = respuesta["respuestaDibuja"][0].pasillos;
            datoX = respuesta["respuestaDibuja"][0].columnas;
            for (var i = 1; i < datoY + 1; i++) {
                for (var j = 1; j < datoX + 1; j++) {
                    var pasilloY = "P" + i;
                    var columnaX = "C" + j;
                    document.getElementById(pasilloY + columnaX).innerHTML = "";
                    document.getElementById(pasilloY + columnaX).innerHTML = pasilloY + columnaX;
                    var elementAtributes = document.getElementById(pasilloY + columnaX);
                    elementAtributes.setAttribute("pasycolx", pasilloY + columnaX);
                    elementAtributes.setAttribute("pasy", i);
                    elementAtributes.setAttribute("colx", j);
                    elementAtributes.setAttribute("estado", 0);
                    elementAtributes.setAttribute("estado", 0);
                    var atributoFucnion = "congelarCeldas('" + pasilloY + columnaX + "')";
                    elementAtributes.setAttribute("onclick", atributoFucnion);
                }
            }
            for (var resUbica = 0; resUbica < respuesta["respuestaUbicas"].length; resUbica++) {
                var pasillo = "P" + respuesta["respuestaUbicas"][resUbica].pasillo;
                var pasilloUnic = respuesta["respuestaUbicas"][resUbica].pasillo;
                var columna = "C" + respuesta["respuestaUbicas"][resUbica].columna;
                var columnaUnic = respuesta["respuestaUbicas"][resUbica].columna;
                var idBod = respuesta["respuestaUbicas"][resUbica].idBodega;

                document.getElementById(pasillo + columna).innerHTML += '<br/>&nbsp;&nbsp;<i class="fa fa-circle element" id="elemento' + pasilloUnic + columnaUnic + idBod + '" style="font-size:10px; color:#FFFAFA;"></i>';
                congelarCeldas(pasillo + columna);
            }


        }, errror: function (respuesta) {
            console.log(respuesta);
        }});
    return todoMenus;
}

$(document).on("mouseover", ".btnEliminarUbicacion", async function () {
var dataid = $(this).attr("dataid");
document.getElementById(dataid).setAttribute("style", "color: red; font-size:14px;");

})


$(document).on("click", ".btnEliminarUbicacion", async function () {
var dataid = $(this).attr("dataid");
var idIncidencia = $(this).attr("idincidencia");
var pasilloY = $("#" + dataid).attr("pasilloY");
var columnaX = $("#" + dataid).attr("columnaX");
var respuesta = await eleminarUbicacion(pasilloY, columnaX, idIncidencia);
console.log(respuesta);
    if (respuesta=="Ok") {
toastr.clear();
        document.getElementById('P'+pasilloY+'C'+columnaX).innerHTML = 'P'+pasilloY+'C'+columnaX;
        Swal.fire('Eliminada', 'La ubicación fue eliminada con exito', 'success');
    }else if (respuesta=="Denegado") {
        Swal.fire('No se anulo', 'Primero debe elegir la nueva ubicacion y luego anular', 'error');
        
    }
})


function eleminarUbicacion(pasilloY, columnaX, idIncidencia){
     let todoMenus;
    var datos = new FormData();
    datos.append("pasilloYTrash", pasilloY);
    datos.append("columnaXTrash", columnaX);
    datos.append("idIncidenciaTrash", idIncidencia);    
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
            console.log(respuesta);
            if (respuesta=="Denegado") {
                todoMenus = "Denegado";
            }else{
                    todoMenus = "Ok";
            }
        }, errror: function (respuesta) {
            console.log(respuesta);
        }});
    return todoMenus;   
}