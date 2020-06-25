function validar_nit(txtN) {
let validando;
    // en el caso de los NIT que terminan en K, se convierte a mayúsculas
    // también el NIT CF o C/F es válido (CF = consumidor final)
    txtN = txtN.toUpperCase();
    if (txtN == "CF" || txtN == "C/F") return true;
    var nit = txtN;
    var pos = nit.indexOf("-");

    if (pos < 0)
    {
        var correlativo = txtN.substr(0, txtN.length - 1);
        correlativo = correlativo + "-";

        var pos2 = correlativo.length - 2;
        var digito = txtN.substr(pos2 + 1);
        nit = correlativo + digito;
        pos = nit.indexOf("-");
        txtN = nit;
    }

    var Correlativo = nit.substr(0, pos);
    var DigitoVerificador = nit.substr(pos + 1);
    DigitoVerificador.toUpperCase();
    var Factor = Correlativo.length + 1;
    var Suma = 0;
    var Valor = 0;
    for (x = 0; x <= (pos - 1); x++) {
        Valor = eval(nit.substr(x, 1));
        var Multiplicacion = eval(Valor * Factor);
        Suma = eval(Suma + Multiplicacion);
        Factor = Factor - 1;
    }
    var xMOd11 = 0;
    xMOd11 = (11 - (Suma % 11)) % 11;
    var s = xMOd11;
    if ((xMOd11 == 10 && DigitoVerificador == "K") || (s == DigitoVerificador))
    {
           validando = true;
    }
    else
    {
        validando = false;
    }
 
    return validando;
}

$(document).on("keyup", "#nuevoNit", function() {
      var dato = $(this).val();
      var resp = validar_nit(dato);
  if (resp) {
    $("#nuevoNit").removeClass("is-invalid");
    $("#nuevoNit").addClass("is-valid");
  }else if (!resp) {
    $("#nuevoNit").removeClass("is-valid");
    $("#nuevoNit").addClass("is-invalid");
  }
})


$(document).on("keyup", "#txtNitSalida", function() {
      var dato = $(this).val();
      var resp = validar_nit(dato);
  if (resp) {
    $("#txtNitSalida").removeClass("is-invalid");
    $("#txtNitSalida").addClass("is-valid");
  }else if (!resp) {
    $("#txtNitSalida").removeClass("is-valid");
    $("#txtNitSalida").addClass("is-invalid");
  }
})
