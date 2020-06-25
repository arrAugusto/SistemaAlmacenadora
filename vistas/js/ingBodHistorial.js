/*=============================================
VARIABLE LOCAL STORAGE
=============================================*/
$(document).ready(function() {
if(localStorage.getItem("capturarRango2") != null){

  $("#daterange-btn2 span").html(localStorage.getItem("capturarRango2"));

}else{

  $("#daterange-btn2 span").html('<i class="fa fa-calendar"></i> Rango de fecha')

}



 })
/*=============================================
RANGO DE FECHAS
=============================================*/
$(document).ready(function() {

$('#daterange-btn2').daterangepicker(
  {
    ranges   : {
      'Hoy'       : [moment(), moment()],
      'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Últimos 7 días' : [moment().subtract(6, 'days'), moment()],
      'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
      'Este mes'  : [moment().startOf('month'), moment().endOf('month')],
      'Último mes'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    startDate: moment(),
    endDate  : moment()
  },
  function (start, end) {
    $('#daterange-btn2 span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

    var fechaInicial = start.format('YYYY-MM-DD');

    var fechaFinal = end.format('YYYY-MM-DD');

    var capturarRango = $("#daterange-btn2 span").html();

     localStorage.setItem("capturarRango2", capturarRango);

     window.location = "index.php?ruta=ingBodHistorial&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

  }

)


 })

/*=============================================
CANCELAR RANGO DE FECHAS
=============================================*/


$(document).on("click", ".cancelBtn", function() {
var hiddenTipoCalcelDate = document.getElementById("hiddenTipoCalcelDate").value;
console.log(hiddenTipoCalcelDate);
    

if (hiddenTipoCalcelDate==1) {
          localStorage.removeItem("capturarRango2");
  localStorage.clear();
  var mantenerFecha = document.getElementById("hiddenDateTimeEdit").value;
  document.getElementById("dateTime").value = mantenerFecha;
    }else if (hiddenTipoCalcelDate==0) {
        
    
          localStorage.removeItem("capturarRango2");
  localStorage.clear();
  window.location='historiaIngresosFisacales';
    }else{
        alert("hiddenTipoCalcelDate");
    }
});

/*=============================================
CAPTURAR HOY
=============================================*/


$(document).on("click", ".daterangepicker .ranges li", function(event) {


  var textoHoy = $(this).attr("data-range-key");

  if(textoHoy == "Hoy"){

    var d = new Date();

    var dia = d.getDate();
    var mes = d.getMonth()+1;
    var año = d.getFullYear();

    if(mes < 10){

      var fechaInicial = año+"-0"+mes+"-"+dia;
      var fechaFinal = año+"-0"+mes+"-"+dia;

    }else if(dia < 10){

      var fechaInicial = año+"-"+mes+"-0"+dia;
      var fechaFinal = año+"-"+mes+"-0"+dia;

    }else if(mes < 10 && dia < 10){

      var fechaInicial = año+"-0"+mes+"-0"+dia;
      var fechaFinal = año+"-0"+mes+"-0"+dia;

    }else{

      var fechaInicial = año+"-"+mes+"-"+dia;
        var fechaFinal = año+"-"+mes+"-"+dia;

    }

      localStorage.setItem("capturarRango2", "Hoy");

      window.location = "index.php?ruta=ingBodHistorial&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

  }

})
