<?php
class ControladorMedidasVehiculos {
  public static function ctrMostrarListadoVehiMedidas(){
    $valor = $_SESSION["idDeBodega"];
          $respuesta = ModeloMedidasVehiculos::mdlMostrarListadoVehiMedidas();
          if ($respuesta !== null || $respuesta !== null) {
      if ($respuesta != "SD") {

          foreach ($respuesta as $key => $value) {

                    echo '
                                     <tr>
                                     <td>' . ($key + 1) . '</td>
                                     <td>' . ($value["tipoV"]) . '</td>
                                     <td>' . ($value["tipoLinea"]) . '</td>
                                     <td>' . ($value["largo"]) . '</td>
                                     <td>' . ($value["ancho"]) . '</td>
                                     <td>' . ($value["retrovisor"]) . '</td>
                                     <td>' . ($value["lateral"]) . '</td>
                                     <td>' . ($value["frontal"]) . '</td>
           
                                     ';

          }
  }
}
}
}
