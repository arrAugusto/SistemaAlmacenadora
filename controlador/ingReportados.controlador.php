<?php

/**
 * 
 * CONTROLADOR DE EVENTOS PARA REGISTRO, ACTUALIZACION, ETC DE OPERACIONES PARA CONTABILIZAR INGRESOS
 * 
 */
class ControladorContabilidadRegistrada {
    /*
     * ctrPolizasPorDia Mostrara por di9a que fue lo que se reporto en contabildiad
     */

    public static function ctrPolizasPorDia($estado) {
        $valor = $_SESSION["idDeBodega"];
        
        if ($_SESSION["departamentos"] == "Operaciones Fiscales" && $_SESSION["niveles"] == "MEDIO") {
            $respuesta = ModeloContabilidadRegistrada::mdlPolizasReportadasDia($valor, $estado);
        } else {
            $respuesta = ModeloContabilidadRegistrada::mdlPolizasPorDia($valor);
        }
        if ($respuesta !== null || $respuesta !== null) {

            if ($respuesta == "SD") {
                
            } else {
                foreach ($respuesta as $key => $value) {
                    // Con objetos
                    if ($value["accionEstado"] == 5) {
                        $botoneraAcciones = '<div class="btn-group"><a href="#divEdiciones" class="btn btn-warning btnEditOp btn-sm" estado=1 role="button" btnEditOp=' . $value["identificador"] . ' ><i class="fa fa-edit"></i></a><div class="btn-group"><button type="button" buttonId=' . $value["identificador"] . ' class="btn btn-success btnGeneracionExcel btn-sm"><i class="fa  fa-file-excel"></i></button><div class="btn-group"><button type="button" buttonId=' . $value["identificador"] . ' class="btn btn-primary btn-sm btnDescontableIng"idIng='.$value["identificador"].'><i class="fa fa-thumbs-up"></i></button></div>';
                    }
                    $fecha_actual = new DateTime();
                    $cadena_fecha_actual = $value["fechaRegistro"]->format("d-m-Y");

                    if ($_SESSION["departamentos"] == "Operaciones Fiscales" && $_SESSION["niveles"] == "MEDIO") {
                        if ($key % 2 != 0) {
                            $spanBodega = '<span class="right badge badge-success">Bodega_' . ($value["numeroIdentidad"]) . '</span>';
                        }else{
                            $spanBodega = '<span class="right badge badge-primary">Bodega_' . ($value["numeroIdentidad"]) . '</span>';
                            
                        }
                        echo '
                            <tr>
                                <td>' . ($key + 1) . '</td>
                                <td>' . ($respuesta[$key]["nit"]) . '</td>
                                <td>' . ($value["empresa"]) . '</td>
                                <td>'.$spanBodega.'</td>
                                <td>' . ($value["poliza"]) . '</td>
                                <td>' . ($cadena_fecha_actual) . '</td>
                                <td>' . ($value["blts"]) . '</td>
                                <td>' . ($value["cif"]) . '</td>
                                <td>' . ($value["impuesto"]) . '</td>
                                <td><center>' . $botoneraAcciones . '</center></td>
                            </tr>';
                    }else{
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

}
