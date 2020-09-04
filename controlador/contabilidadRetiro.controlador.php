<?php

class ControladorContabilidadDeRet {

    public static function ctrListarRetiros($tipo, $NavegaNumB) {

        $respuesta = ModeloContabilidadDeRet::mdlListarRetPendientes($tipo, $NavegaNumB);
        
        if ($respuesta != "SD") {
            foreach ($respuesta as $key => $value) {
                $numIng = $value["idIngOp"];
                $identRet = $value["identRet"];
                if ($tipo == 4) {
                    $botoneraAcciones = '<div class="btn-group"><button type="button" buttonid="'.$numIng.'" class="btn btn-outline-success btnGeneracionExcel btn-sm"><i class="fa fa-file-excel-o"></i></button><button type="button" class="btn btn-outline-primary btn-sm" id="btnReimprimeRec" idRet="'.$identRet.'">Rec.</button></button><button type="button" class="btn btn-outline-info btn-sm" id="btnReimprimeRet" idRet="'.$identRet.'">Ret.</button><button type="button"  class="btn btn-outline-dark btnSelectMultiple btn-sm" idRet=' . $value["identificaRet"] . ' estado=0><i class="fa fa-close"></i></button><div class="btn-group"><button type="button" class="btn btn-outline-danger btn-sm btnContabilizarRet" idRet=' . $value["identificaRet"] . '><i class="fa fa-thumbs-down"></i></button></div>';
                }
                if ($tipo == 5) {
                    $botoneraAcciones = '<div class="btn-group"><button type="button" buttonid="'.$numIng.'" class="btn btn-outline-success btnGeneracionExcel btn-sm"><i class="fa fa-file-excel-o"></i></button><button type="button" class="btn btn-outline-primary btn-sm" id="btnReimprimeRec" idRet="'.$identRet.'">Rec.</button></button><button type="button" class="btn btn-outline-info btn-sm" id="btnReimprimeRet" idRet="'.$identRet.'">Ret.</button><button type="button"  class="btn btn-outline-dark btnSelectMultiple btn-sm" idRet=' . $value["identificaRet"] . ' estado=0><i class="fa fa-close"></i></button><div class="btn-group"><button type="button" class="btn btn-outline-primary btn-sm btnDescontabilizar" idRet=' . $value["identificaRet"] . '><i class="fa fa-thumbs-up"></i></button></div>';
                }

                echo '
            <tr>
                <td>' . ($key + 1) . '</td>
                <td>' . $value["numNit"] . '</td>
                <td>' . $value["empresa"] . '</td>
                <td>' . $value["numPolIng"] . '</td>
                <td>' . $value["polRet"] . '</td>
                <td>' . $value["bultosRet"] . '</td>
                <td>' . $value["totalValorCif"] . '</td>
                <td>' . $value["valorImpuesto"] . '</td>';
                if ($_SESSION["departamentos"] == "Operaciones Fiscales") {
                    echo '    <td>' . $botoneraAcciones . '</td>';
                }
                echo '   
            </tr>';
            }
        }
    }

    public static function ctrContabilizarRetiro($idRetContabilidad, $tipo, $usuarioOp, $fechaRetContabi) {
        $respuesta = ModeloContabilidadDeRet::mdlContabilizarRetiro($idRetContabilidad, $tipo, $usuarioOp, $fechaRetContabi);
        return $respuesta;
    }

    public static function ctrMostrarReporteReitiro($tipo, $ident) {
        $respuesta = ModeloContabilidadDeRet::mdlListarRetPendientes($tipo, $ident);
        return $respuesta;
    }

    public static function ctrMostrarReporteConta($reportContaIdent) {
        $sp = "spReporteConta";
        $tipoOp = 1;
        $respuesta = ModeloContabilidadDeRet::mdlMostrarReporteConta($sp, $tipoOp, $reportContaIdent);
        $listaIng = [];
        foreach ($respuesta as $key => $value) {
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

    public static function ctrMostrarReporteRetiro($mostrarRepRetiro) {
        $tipoOp = 5;
        $sp = "spRetirosPendientes";
        $respuesta = ModeloContabilidadDeRet::mdlMostrarReporteConta($sp, $tipoOp, $mostrarRepRetiro);
        $listaRet = [];
        foreach ($respuesta as $key => $value) {
            $estado = 0;
            if ($key == 0) {
                array_push($listaRet, $value);
            }
            if ($key >= 1) {
                foreach ($listaRet as $key => $values) {
                    if ($value["numeroRetiro"] == $values["numeroRetiro"]) {
                        $estado = $estado + 1;
                    }
                }
                if ($estado == 0) {
                    array_push($listaRet, $value);
                }
            }
        }
        return $listaRet;
    }

    public static function ctrMstrAjustesContables($mstAjustesConta) {
        $mstAjustesContaDB = json_decode($mstAjustesConta, true);
        $sp = "spMstAjustesConta";
        $dataRespons = [];
        foreach ($mstAjustesContaDB as $key => $value) {
            $IdentiBod = $value[$key];
            $respuesta = ModeloContabilidadDeRet::mdlMstrAjustesContables($sp, $IdentiBod);
            array_push($dataRespons, $respuesta[0]);
        }

        return $dataRespons;
    }

    public static function ctrDescontabilizaRet($descontabilizaRet, $usuarioOp) {
        $sp = "spDescontabiliza";
        $respuesta = ModeloContabilidadDeRet::mdlMostrarReporteConta($sp, $descontabilizaRet, $usuarioOp);
        return $respuesta;
    }

    public static function ctrListarRetContabilizados($sp, $tipo, $idBodega, $tipoReporte) {
        $respuesta = ModeloContabilidadDeRet::mdlListarRetContabilizados($sp, $tipo, $idBodega, $tipoReporte);
        return $respuesta;
    }

}
