function cuiIsValid(cui) {
    var console = window.console;
    if (!cui) {
        return true;
    }
    var cuiRegExp = /^[0-9]{4}\s?[0-9]{5}\s?[0-9]{4}$/;
    if (!cuiRegExp.test(cui)) {
        console.log("CUI con formato inválido");
        return false;
    }

    cui = cui.replace(/\s/, '');
    var depto = parseInt(cui.substring(9, 11), 10);
    var muni = parseInt(cui.substring(11, 13));
    var numero = cui.substring(0, 8);
    var verificador = parseInt(cui.substring(8, 9));

    // Se asume que la codificación de Municipios y
    // departamentos es la misma que esta publicada en
    // http://goo.gl/EsxN1a

    // Listado de municipios actualizado segun:
    // http://goo.gl/QLNglm

    // Este listado contiene la cantidad de municipios
    // existentes en cada departamento para poder
    // determinar el código máximo aceptado por cada
    // uno de los departamentos.
    var munisPorDepto = [
        /* 01 - Guatemala tiene:      */ 17 /* municipios. */,
        /* 02 - El Progreso tiene:    */  8 /* municipios. */,
        /* 03 - Sacatepéquez tiene:   */ 16 /* municipios. */,
        /* 04 - Chimaltenango tiene:  */ 16 /* municipios. */,
        /* 05 - Escuintla tiene:      */ 13 /* municipios. */,
        /* 06 - Santa Rosa tiene:     */ 14 /* municipios. */,
        /* 07 - Sololá tiene:         */ 19 /* municipios. */,
        /* 08 - Totonicapán tiene:    */  8 /* municipios. */,
        /* 09 - Quetzaltenango tiene: */ 24 /* municipios. */,
        /* 10 - Suchitepéquez tiene:  */ 21 /* municipios. */,
        /* 11 - Retalhuleu tiene:     */  9 /* municipios. */,
        /* 12 - San Marcos tiene:     */ 30 /* municipios. */,
        /* 13 - Huehuetenango tiene:  */ 32 /* municipios. */,
        /* 14 - Quiché tiene:         */ 21 /* municipios. */,
        /* 15 - Baja Verapaz tiene:   */  8 /* municipios. */,
        /* 16 - Alta Verapaz tiene:   */ 17 /* municipios. */,
        /* 17 - Petén tiene:          */ 14 /* municipios. */,
        /* 18 - Izabal tiene:         */  5 /* municipios. */,
        /* 19 - Zacapa tiene:         */ 11 /* municipios. */,
        /* 20 - Chiquimula tiene:     */ 11 /* municipios. */,
        /* 21 - Jalapa tiene:         */  7 /* municipios. */,
        /* 22 - Jutiapa tiene:        */ 17 /* municipios. */
    ];

    if (depto === 0 || muni === 0)
    {
        console.log("CUI con código de municipio o departamento inválido.");
        return false;
    }

    if (depto > munisPorDepto.length)
    {
        console.log("CUI con código de departamento inválido.");
        return false;
    }

    if (muni > munisPorDepto[depto -1])
    {
        console.log("CUI con código de municipio inválido.");
        return false;
    }

    // Se verifica el correlativo con base
    // en el algoritmo del complemento 11.
    var total = 0;

    for (var i = 0; i < numero.length; i++)
    {
        total += numero[i] * (i + 2);
    }

    var modulo = (total % 11);

    console.log("CUI con módulo: " + modulo);
    return modulo === verificador;
}

function contar_palabras(texto){
  //Obtenemos el texto del campo

  //Reemplazamos los saltos de linea por espacios
  texto = texto.replace (/\r?\n/g," ");
  //Reemplazamos los espacios seguidos por uno solo
  texto = texto.replace (/[ ]+/g," ");
  //Quitarmos los espacios del principio y del final
  texto = texto.replace (/^ /,"");
  texto = texto.replace (/ $/,"");
  //Troceamos el texto por los espacios
  var textoTroceado = texto.split (" ");
  //Contamos todos los trozos de cadenas que existen
  var numeroPalabras = textoTroceado.length;
  //Mostramos el número de palabras
  return numeroPalabras;
}


$(document).on("change", "#numeroLicencia", async function() {
    var dato = $(this).val();
    if (dato=="") {
    $("#numeroLicencia").removeClass("is-valid");
    $("#numeroLicencia").addClass("is-invalid");
    if ($("#nombrePiloto").length>=1){
        
    
    document.getElementById("nombrePiloto").value = "";
     $("#numeroLicencia").removeClass("is-valid");
    $("#numeroLicencia").addClass("is-invalid");

    $("#nombrePiloto").removeClass("is-valid");
    $("#nombrePiloto").addClass("is-invalid");
    document.getElementById("nombrePiloto").value = "";
    
      document.getElementById("nombrePiloto").readOnly = true;
}
    }else{
        
    
        $("#numeroLicencia").removeClass("is-valid");
    $("#numeroLicencia").addClass("is-invalid");
      var dato = $(this).val();
      var resp = await cuiIsValid(dato);      
  if (resp==true) {
    $("#numeroLicencia").removeClass("is-invalid");
    $("#numeroLicencia").addClass("is-valid");
    document.getElementById("nombrePiloto").readOnly = false;
    $("#numeroLicencia").removeAttr('type');
    $("#numeroLicencia").attr('type', 'number');      

    
            if ($("#nombrePiloto").length>=1) {
    document.getElementById("nombrePiloto").readOnly = false;
}
  }else if (!resp) {
    $("#numeroLicencia").removeClass("is-valid");
    $("#numeroLicencia").addClass("is-invalid");
            if ($("#nombrePiloto").length>=1) {
                
            
    $("#nombrePiloto").removeClass("is-valid");
    $("#nombrePiloto").addClass("is-invalid");
    document.getElementById("nombrePiloto").value = "";
    
      document.getElementById("nombrePiloto").readOnly = true;
}

  }
  }
})

$(document).on("change", "#nombrePiloto", function() {
    var texto = document.getElementById("nombrePiloto").value;
    var palabras = contar_palabras(texto);
    console.log(palabras);
    if (palabras==1 ||  palabras==2) {
      document.getElementById("nombrePiloto").value="";
      document.getElementById("nombrePiloto").focus();
      swal({
          type: "error",
          title: 'No se admite solo un nombre y apellido',
          text: 'Dato registrado no es admitido registrelo correctamente.',
          showConfirmButton: true,
          confrimButtonText: "cerrar",
          closeConfirm: true
      });
}else if (palabras==3) {
      Swal.fire({
        title: '¿Seguro los datos registrados son correctos?',
        text: "Las personas normalmente cuentan con 2 apellidos y 2 nombres, si esta incorrecto el campo favor corrigalo.",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Si es correcto!',
        cancelButtonText: 'Cancelar,  Es incorrecto'
      }).then((result) => {
        if (result.value) {
        document.getElementById("numeroPlaca").focus();

      }else{
        document.getElementById("nombrePiloto").focus();
      }
      })

    }else if (palabras>=4) {
        $("#nombrePiloto").removeClass("is-invalid");
        $("#nombrePiloto").addClass("is-valid");
   

    }
});
