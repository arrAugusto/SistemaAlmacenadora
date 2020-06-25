$(document).on("click", ".btnAgregarMedidas", function () {
    var tipoVh = $(this).attr("tipoVh");
    var lineaVh = $(this).attr("lineaVh");
    var identiMedida = $(this).attr("identificaMedida");
    document.getElementById("titleMedidas").innerHTML = 'Capturando medidas del vehículo  : Tipo &nbsp;&nbsp;' + tipoVh + '&nbsp;&nbsp;Linea : &nbsp;&nbsp;' + lineaVh;
    $(".btnGMedidas").attr("identiMedida", identiMedida);
});



$(document).on("keyup", "#retrovisorIZ", function () {
    var valorIZ = $(this).val();
    document.getElementById("retrovisorDer").value = valorIZ;


})

$(document).on("keyup", "#retrovisorDer", function () {
    var valorIZ = $(this).val();
    document.getElementById("retrovisorIZ").value = valorIZ;


})

$(document).on("click", ".btnGMedidas", function () {
    var idMedida = $(this).attr("identimedida");
    if (idMedida>=1) {
    var largoMetros = $("#largoMts").val();
    if (isNaN(largoMetros) || largoMetros == 0 || largoMetros == "") {
        $("#largoMts").removeClass("is-valid");
        $("#largoMts").addClass("is-invalid");
        var largoMts = 0;
    } else {
        $("#largoMts").removeClass("is-invalid");
        $("#largoMts").addClass("is-valid");
        var vallargoMts = $("#largoMts").val();        
        var largoMts = 1;
    }
    var anchoMts = $("#anchoMts").val();
    if (isNaN(anchoMts) || anchoMts == 0 || anchoMts == "") {
        $("#anchoMts").removeClass("is-valid");
        $("#anchoMts").addClass("is-invalid");
        var anchoMts = 0;
    } else {
        $("#anchoMts").removeClass("is-invalid");
        $("#anchoMts").addClass("is-valid");
        var valanchoMts = $("#anchoMts").val();
        var anchoMts = 1;
    }
    var retrovisorIZ = $("#retrovisorIZ").val();
    if (isNaN(retrovisorIZ) || retrovisorIZ == 0 || retrovisorIZ == "") {
        $("#retrovisorIZ").removeClass("is-valid");
        $("#retrovisorIZ").addClass("is-invalid");
        var retrovisorIZ = 0;
    } else {
        $("#retrovisorIZ").removeClass("is-invalid");
        $("#retrovisorIZ").addClass("is-valid");
        var valretrovisorIZ = $("#retrovisorIZ").val();        
        var retrovisorIZ = 1;
    }
    var retrovisorDer = $("#retrovisorDer").val();
    if (isNaN(retrovisorDer) || retrovisorDer == 0 || retrovisorDer == "") {
        $("#retrovisorDer").removeClass("is-valid");
        $("#retrovisorDer").addClass("is-invalid");
        var retrovisorDer = 0;
    } else {
        $("#retrovisorDer").removeClass("is-invalid");
        $("#retrovisorDer").addClass("is-valid");
        var valretrovisorDer = $("#retrovisorDer").val();        
        var retrovisorDer = 1;
    }
    var espacioFrontal = $("#espacioFrontal").val();
    if (isNaN(espacioFrontal) || espacioFrontal == 0 || espacioFrontal == "") {
        $("#espacioFrontal").removeClass("is-valid");
        $("#espacioFrontal").addClass("is-invalid");
        var espacioFrontal = 0;
    } else {
        $("#espacioFrontal").removeClass("is-invalid");
        $("#espacioFrontal").addClass("is-valid");
        var valespacioFrontal = $("#espacioFrontal").val();        
        var espacioFrontal = 1;
    }
    var espacioLateral = $("#espacioLateral").val();
    if (isNaN(espacioLateral) || espacioLateral == 0 || espacioLateral == "") {
        $("#espacioLateral").removeClass("is-valid");
        $("#espacioLateral").addClass("is-invalid");
        var espacioLateral = 0;
    } else {
        $("#espacioLateral").removeClass("is-invalid");
        $("#espacioLateral").addClass("is-valid");
        var valespacioLateral = $("#espacioLateral").val();        
        var espacioLateral = 1;
    }
    var totalValidacion = (largoMts + anchoMts + retrovisorIZ + retrovisorDer + espacioFrontal + espacioLateral);
    if (totalValidacion == 6) {
       guardarMedidasVehiculos(idMedida, vallargoMts, valanchoMts, valretrovisorIZ, valretrovisorDer, valespacioFrontal, valespacioLateral);
    } else {
        alert("error");
    }
    }else{
        alert("selecciona la linea que desea guardar");
    }
})



function guardarMedidasVehiculos(idMedida, vallargoMts, valanchoMts, valretrovisorIZ, valretrovisorDer, valespacioFrontal, valespacioLateral) {
    let todoMenus;
    var datos = new FormData();
    datos.append("vallargoMts", vallargoMts);
    datos.append("valanchoMts", valanchoMts);
    datos.append("valretrovisorIZ", valretrovisorIZ);
    datos.append("valretrovisorDer", valretrovisorDer);
    datos.append("valespacioFrontal", valespacioFrontal);
    datos.append("valespacioLateral", valespacioLateral);
    datos.append("idMedida", idMedida);    
    $.ajax({
        async: false,
        url: "ajax/vehiculosSinMedidas.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
console.log(respuesta);


        },
        error: function (respuesta) {
            console.log(respuesta);
        }
    })
    return todoMenus;
}