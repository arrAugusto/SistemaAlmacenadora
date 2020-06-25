<?php

class ControladorVehiculosSinMedidas {

    public static function ctrMostrarVehSinMedida() {
        $valor = $_SESSION["idDeBodega"];
        $respuesta = ModeloVehiculosSinMedidas::mdlMostrarVehSinMedida($valor);

        if ($respuesta != "SD") {
            foreach ($respuesta as $key => $value) {
                $tVeh = $value["tVeh"];
                $lVeh = $value["lVeh"];
                echo '
                <tr>
                <td>' . ($key + 1) . '</td>'
                . '<td>' . $tVeh . '</td>'
                . '<td>' . $lVeh . '</td>'
                . '<td><button type="button" class="btn btn-outline-info btn-sm btnAgregarMedidas" identificaMedida="'.$value["identificaMedida"].'" tipoVh="'.$tVeh.'" lineaVh="'.$lVeh.'">Agregar Medidas</button></td></tr>';
            }
        }
    }
    
    public static function ctrGuardarNuevaMedida($idMedida, $vallargoMts, $valanchoMts, $valretrovisorIZ, $valretrovisorDer, $valespacioFrontal, $valespacioLateral){
           $respuesta = ModeloVehiculosSinMedidas::mdlGuardarNuevaMedida($idMedida, $vallargoMts, $valanchoMts, $valretrovisorIZ, $valretrovisorDer, $valespacioFrontal, $valespacioLateral); 
           return $respuesta;
    }

}


