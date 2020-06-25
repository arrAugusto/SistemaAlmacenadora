$(document).on("click", ".btnNavega", function() {
var txtAreaBodega = document.getElementById("txtAreaBodega").value;
var numeroBodega = document.getElementById("numeroBodega").value;
var idHiddenNavega = document.getElementById("idHiddenNavega").value
var idHiddenNavegaUs = document.getElementById("idHiddenNavegaUs").value;
if (isNaN(numeroBodega)) {
alert("valorTextualIntenteNuevo");
}else{
  var datos = new FormData();
  datos.append("txtAreaBodega", txtAreaBodega);
  datos.append("numeroBodega", numeroBodega);
  datos.append("idHiddenNavega", idHiddenNavega);
  datos.append("idHiddenNavegaUs", idHiddenNavegaUs);
  $.ajax({
      url: "ajax/configuracion.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function(respuesta) {
        console.log(respuesta);

        if (respuesta=="OpError") {
          swal({
        type: "error",
        title: "Error",
        text: "Se produjo un error en el registro de su navegación, intente de nuevo o comuniquese con soporte",
        showConfirmButton: true,
        confrimButtonText: "cerrar",
        closeConfirm: true
            });
        } else if (respuesta=="errorSinData") {
          swal({
        type: "error",
        title: "Error selección",
        text: "La bodega que selecciono no existe en la dependencia",
        showConfirmButton: true,
        confrimButtonText: "cerrar",
        closeConfirm: true
    });

        }else {



          swal({
              title: "Configración Exitosa",
              text: "Cambio de con exitó a bodega "+txtAreaBodega+numeroBodega,
              type: "success"
          }).then(okay => {
              if (okay) {
                  window.location="Inicio";
              }
          });




        }

      },error: function (respuesta){
        console.log(respuesta);

      }
    })



}
})
