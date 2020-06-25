<?php

class ControladorUbicacionBodega {

    public static function ctrDibujarMapaDetalles() {
        $numeroMapa = $_SESSION["idDeBodega"];
        $class = "";

        if ($_SESSION["departamentos"] != "Operaciones Bodegas") {
            $class = "noBodega";
        }
        $salto = 0;
        $respuesta = ModeloUbicacionBodega::mdlDibujarMapaDetalles($numeroMapa);

        $respuestaUbicaSaldo = ModeloUbicacionBodega::mdlDibujarUbicaciones($numeroMapa);

        $listaUbica = json_encode($respuestaUbicaSaldo, JSON_UNESCAPED_UNICODE);


        if ($respuestaUbicaSaldo == "SD") {
            echo '<script>
                    swal({
type: "error",
title: "Sin datos",
text: "Esta bodega no tiene ingresos registrados",
showConfirmButton: true,
confrimButtonText: "Aceptar",
closeConfirm: true
 });
                    </script>';
        } else {
            $pasY = $respuesta[0]["pasillos"];
            $colx = $respuesta[0]["columnas"];

            echo '<table id="tablaScrollingUbica" width="100%">';

            for ($i = 1; $i < $pasY + 1; ++$i) {
                echo '<tr>';

                for ($j = 1; $j < $colx + 1; ++$j) {

                    echo '<td id=P' . $i . 'C' . $j . '>P' . $i . 'C' . $j . '</i><br/>';

                    foreach ($respuestaUbicaSaldo as $key => $value) {

                        if ($key >= 4) {
                            $multiplo = $key / 4;
                            if (intval($multiplo) == $multiplo) {
                                $salto = 1;
                            } else {
                                $salto = 0;
                            }
                        }
                        if ($value["pasillo"] == $i && $value["columna"] == $j) {
                            if ($salto == 1) {
                                echo '&nbsp&nbsp<i class="fa fa-circle element ' . $class . '" id="elemento' . $i . $j . $value["idBodega"] . '" idBodega="' . $value["idBodega"] . '" onmouseover="capturar(' . 'elemento' . $i . $j . $value["idBodega"] . ')" onmouseout="desmarcar(' . 'elemento' . $i . $j . $value["idBodega"] . ')" style="font-size:4px"></i><br/>';
                            } else if ($salto == 0) {
                                echo '&nbsp&nbsp<i class="fa fa-circle element ' . $class . '" id="elemento' . $i . $j . $value["idBodega"] . '" idBodega="' . $value["idBodega"] . '" onmouseover="capturar(' . 'elemento' . $i . $j . $value["idBodega"] . ')" onmouseout="desmarcar(' . 'elemento' . $i . $j . $value["idBodega"] . ')" style="font-size:4px"></i>';
                            }
                        }
                    }
                }
                echo'</td>';
            }
            echo '</tr>';
        }


        echo '

</table>
';

        echo '<input type="hidden" id="listaUbicaciones" value="' . htmlspecialchars($listaUbica) . '" />';
    }

    public static function ctrMostrarUbUnitaria($datoSearch, $hiddenIdBodega) {
        $respuesta = ModeloUbicacionBodega::mdlMostrarUbUnitaria($datoSearch);
        $llaves = [];
        foreach ($respuesta as $key => $value) {
            array_push($llaves, $value["identifica"]);
        }
        $arrayUnique = array_unique($llaves);
        $arrayUniques = array_values($arrayUnique);
        $detalle = [];
        foreach ($arrayUniques as $key => $value) {
            $respuestaDetalles = ModeloUbicacionBodega::mdlMostrarDetallesIng($value);
            array_push($detalle, $respuestaDetalles);
        }
        if (is_array($respuesta)) {
            if ($respuesta !== "SD") {
                $respuestaDibuja = ModeloUbicacionBodega::mdlDibujarMapaDetalles($hiddenIdBodega);
                if (is_array($respuestaDibuja)) {
                    return array("respuestaDibuja" => $respuestaDibuja, "respuestaUbicas" => $respuesta, "detallesIngs" => $detalle);
                }
            } else {
                return $respuesta;
            }
        } else {
            return $respuesta;
        }
    }

    public static function ctrMostarUbicaciones($idDetView) {
        $respuestaDibuja = ModeloUbicacionBodega::mdlMostarUbicaciones($idDetView);
        return $respuestaDibuja;
    }

}
