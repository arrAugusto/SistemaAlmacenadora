<?php

/**
 * 
 * CONTROLADOR DE EVENTOS PARA REGISTRO, ACTUALIZACION, ETC DE OPERACIONES PARA CONTABILIZAR INGRESOS
 * 
 */
class ControladorGeneracionDeContabilidad {
    /*
     * ctrIngRegistroConta registra a contabilidad todos los ingresos pendientes.
     */

    public static function ctrIngRegistroConta($idContabilizar) {

        if (is_numeric($idContabilizar)) {
            $respuesta = ModeloGeneracionDeContabilidad::mdlIngRegistroConta($idContabilizar);
            return $respuesta;
        }
    }

    public static function ctrMostrarSaldos() {
        $valor = $_SESSION["idDeBodega"];
        $respuesta = ModeloGeneracionDeInventarios::mdlMostrarInventario($valor);
        if ($respuesta !== null || $respuesta !== null) {
            if ($respuesta == "SD") {
                
            } else {

                foreach ($respuesta as $key => $value) {
                    // Con objetos
                    if ($value["accionEstado"] == 4) {

                        $botoneraAcciones = '<div class="btn-group"><a href="#divEdiciones" class="btn btn-outline-warning btnEditOp btn-sm" estado=1 role="button" btnEditOp=' . $value["identificador"] . ' ><i class="fa fa-edit"></i></a><div class="btn-group"><button type="button" buttonId=' . $value["identificador"] . ' class="btn btn-outline-success btnGeneracionExcel btn-sm"><i class="fas fa-file-excel"></i></button><button type="button" buttonId=' . $value["identificador"] . ' class="btn btn-outline-dark btnSelectMultiple btn-sm" estado=0><i class="fas fa-close"></i></button><div class="btn-group"><button type="button" buttonId=' . $value["identificador"] . ' class="btn btn-outline-danger btn-sm btnContabilizar"><i class="fa fa-thumbs-down"></i></button></div>';
                    }
                    $fecha_actual = new DateTime();
                    $cadena_fecha_actual = $value["fechaRegistro"]->format("d-m-Y");

                    echo '
                                                         <tr>
                                                         <td>' . ($key + 1) . '</td>
                                                         <td>' . ($respuesta[$key]["nit"]) . '</td>
                                     <td>' . ($value["empresa"]) . '</td>
                                     <td>' . ($value["poliza"]) . '</td>
                                     <td>' . ($cadena_fecha_actual) . '</td>
                                     <td>' . ($value["blts"]) . '</td>
                                     <td>' . ($value["cif"]) . '</td>
                                     <td>' . ($value["impuesto"]) . '</td>
                                    <td><center>' . $botoneraAcciones . '</center></td>
                                    </tr>';
                }
            }
        }
    }

}
