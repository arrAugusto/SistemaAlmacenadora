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

    public static function ctrIngRegistroConta($idContabilizar, $fechaCongeladaConta, $usuarioOp) {
        $respuesta = ModeloGeneracionDeContabilidad::mdlIngRegistroConta($idContabilizar, $fechaCongeladaConta, $usuarioOp);
        return $respuesta;
    }

    public static function ctrMostrarSaldos($estado) {
        $valor = $_SESSION["idDeBodega"];
        $respuesta = ModeloContabilidadRegistrada::mdlPolizasReportadasDia($valor, $estado);
        if ($respuesta != null) {
            if ($respuesta == "SD") {
                
            } else {

                foreach ($respuesta as $key => $value) {
                    // Con objetos
                    if ($_SESSION["departamentos"] == "Operaciones Fiscales" && $_SESSION["niveles"] == "MEDIO") {
                        if ($key % 2 != 0) {
                            $spanBodega = '<span class="right badge badge-success">Bodega_' . ($value["numeroIdentidad"]) . '</span>';
                        } else {
                            $spanBodega = '<span class="right badge badge-primary">Bodega_' . ($value["numeroIdentidad"]) . '</span>';
                        }
                    }
                    $botoneraAcciones = '<div class="btn-group"><div class="btn-group"><button type="button" buttonId=' . $value["identificador"] . ' class="btn btn-outline-success btnGeneracionExcel btn-sm"><i class="fa fa-file-excel-o"></i></button><button type="button" buttonId=' . $value["identificador"] . ' class="btn btn-outline-dark btnSelectMultiple btn-sm" estado=0><i class="fa fa-close"></i></button><div class="btn-group"><button type="button" buttonId=' . $value["identificador"] . ' class="btn btn-outline-danger btn-sm btnContabilizar"><i class="fa fa-thumbs-down"></i></button></div>';
                    $fecha_actual = new DateTime();
                    $cadena_fecha_actual = $value["fechaRegistro"]->format("d-m-Y");

                    if ($_SESSION["departamentos"] == "Operaciones Fiscales" && $_SESSION["niveles"] == "MEDIO") {

                        echo '
                        <tr>
                            <td>' . ($key + 1) . '</td>
                            <td>' . ($respuesta[$key]["nit"]) . '</td>
                            <td>' . ($value["empresa"]) . '</td>
                            <td>' . $spanBodega . '</td>
                            <td>' . ($value["poliza"]) . '</td>
                            <td>' . ($cadena_fecha_actual) . '</td>
                            <td>' . ($value["blts"]) . '</td>
                            <td>' . ($value["cif"]) . '</td>
                            <td>' . ($value["impuesto"]) . '</td>
                            <td id="tbAcciones"><center>' . $botoneraAcciones . '</center></td>
                        </tr>';
                    } else {
                        if ($value["numeroIdentidad"] == $valor) {
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

    public static function ctrReporteIngContabilizado($tipoReporte, $entidad) {
        $sp = "spIngRprteContabilizado";
        $repContabilidad = ModeloGeneracionDeContabilidad::mdlIngRegistroContaReportes($sp, $entidad, $tipoReporte);
        $listaIng = [];
        foreach ($repContabilidad as $key => $value) {
            $estado = 0;
            if ($key == 0) {
                array_push($listaIng, $value);
            }
            if ($key >= 1) {
                foreach ($listaIng as $key => $values) {
                    if ($value["numeroDeIngreso"] == $values["numeroDeIngreso"]) {
                        $estado = $estado + 1;
                    }
                }
                if ($estado == 0) {
                    array_push($listaIng, $value);
                }
            }
        }
        return $listaIng;
    }

    public static function ctrIngRegistroContaReportes($codigo, $ident) {
        if ($codigo == "Ingreso") {
            $sp = "spReporteConta";
            $tipo = 1;
            $repContabilidad = ModeloGeneracionDeContabilidad::mdlIngRegistroContaReportes($sp, $tipo, $ident);
            $listaIng = [];
            foreach ($repContabilidad as $key => $value) {
                $estado = 0;
                if ($key == 0) {
                    array_push($listaIng, $value);
                }
                if ($key >= 1) {
                    foreach ($listaIng as $key => $values) {
                        if ($value["numeroDeIngreso"] == $values["numeroDeIngreso"]) {
                            $estado = $estado + 1;
                        }
                    }
                    if ($estado == 0) {
                        array_push($listaIng, $value);
                    }
                }
            }
            return $listaIng;
        } else {
            $sp = "spReporteConta";
            $tipo = 2;
            $repContabilidad = ModeloGeneracionDeContabilidad::mdlIngRegistroContaReportes($sp, $tipo, $ident);
            return $repContabilidad;
        }
    }

    public static function ctrJefeUnidad($ident) {
        $sp = "spJefeRepConta";
        $repContabilidad = ModeloGeneracionDeContabilidad::mdlJefeUnidad($sp, $ident);
        return $repContabilidad;
    }

    public static function ctrDescontaIng($descontabilizaIng, $usuarioOp) {
        $sp = "spDescontabilizaIng";
        $respuesta = ModeloGeneracionDeContabilidad::mdlIngRegistroContaReportes($sp, $descontabilizaIng, $usuarioOp);
        return $respuesta;
    }

    public static function ctrDescargaRepExcel($idBod, $estadoDescarga) {
        $sp = "spDescExcelIng";
        $respuesta = ModeloGeneracionDeContabilidad::mdlIngRegistroContaReportes($sp, $idBod, $estadoDescarga);
        return $respuesta;
    }

    public static function ctrMostrarIdIngMasiva($idIngMasivo) {
        $sp = "spIdPoliza";
        $tipo = 0;
        $repContabilidad = ModeloGeneracionDeContabilidad::mdlIngRegistroContaReportes($sp, $idIngMasivo, $tipo);
        return $repContabilidad;
    }

}
