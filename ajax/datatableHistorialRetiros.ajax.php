<?php

require_once '../controlador/contabilidadRetiro.controlador.php';
require_once '../modelo/contabilidadRetiro.modelo.php';
//SESSION DE USUARIO PARA MANEJAR BITACORA
require_once '../controlador/usuario.controlador.php';

class historialIngresosFiscalesRet {

    public $activarHistorial;

    public function ajaxMostrarTableIngHistoriaRet() {
        session_start();
        $NavegaNumB = $_SESSION['idDeBodega'];
        $respuesta = ModeloContabilidadDeRet::mdlListarRetPendientesHistorial($NavegaNumB);
        if ($respuesta != 'SD') {
            $contador = 0;
            $cabeza = '{
            "data": [';
            echo $cabeza;
            foreach ($respuesta as $key => $value) {
                $botoneraAcciones = "";
                $contador = $contador + 1;
                $identRet = $value['identRet'];
                if ($value['estadoRet'] == 2 || $value['estadoRet'] == 1) {
                    $botoneraAcciones = "<div class='btn-group'><button type='button' class='btn btn-success btn-sm btnExcelRetSal' idRet = '" . $identRet . "'><i class='fa fa-file-excel-o'></i></button><button type='button' class='btn btn-outline-primary btn-sm' id='btnReimprimeRec' idRet='" . $identRet . ">Rec.</button><button type='button' class='btn btn-outline-info btn-sm' id='btnReimprimeRet' idRet='" . $identRet . ">Ret.</button><button type='button'  class='btn btn-outline-danger btnAnularOperacion btn-sm' data-toggle='modal' data-target='#AnulacionRetiro' idPoliza='" . $value['polRet'] . " idRet='" . $value['identificaRet'] . "' estado=0><i class='fa fa-eraser'></i></button></div>";
                }
                if ($value['estadoRet'] >= 4) {
                    $botoneraAcciones = "<div class='btn-group'><button type='button' class='btn btn-success btn-sm btnExcelRetSal' idRet = '" . $identRet . "'><i class='fa fa-file-excel-o'></i></button><button type='button' class='btn btn-outline-primary btn-sm' id='btnReimprimeRec' idRet='" . $identRet . "'>Rec.</button><button type='button' class='btn btn-outline-info btn-sm' id='btnReimprimeRet' idRet='" . $identRet . "'>Ret.</button><button type='button'  class='btn btn-outline-danger btnAnularOperacion btn-sm' data-toggle='modal' data-target='#AnulacionRetiro' idPoliza='" . $value['polRet'] . "' idRet='" . $value['identificaRet'] . "' estado=0><i class='fa fa-eraser'></i></button></div>";
                }
                if ($value['estadoRet'] == 3) {
                    $botoneraAcciones = "<div class='btn-group'><button type='button' class='btn btn-success btn-sm btnExcelRetSal' idRet = '" . $identRet . "'><i class='fa fa-file-excel-o'></i><button type='button' class='btn btn-warning btn-sm'>Pendiente</button><button type='button'  class='btn btn-outline-danger btnAnularOperacion btn-sm' data-toggle='modal' data-target='#AnulacionRetiro' idPoliza='" . $value['polRet'] . "' idRet='" . $value['identificaRet'] . "' estado=0><i class='fa fa-eraser'></i></button></div>";
                }
                $datoJsonRetHis = '[
                    "' . $contador . '",
                    "' . $value['numNit'] . '",
                    "' . $value['empresa'] . '",
                    "' . $value['numPolIng'] . '",
                    "' . $value['polRet'] . '",
                    "' . $value['bultosRet'] . '",
                    "' . $value['totalValorCif'] . '",
                    "' . $value['valorImpuesto'] . '",
                    "' . $botoneraAcciones . '"
                ],';
                if ($key + 1 != count($respuesta)) {
                    echo $datoJsonRetHis;
                }
            }
            $pie = substr($datoJsonRetHis, 0, -1);
            $pie .= ']}';
            echo $pie;
        }
    }
}

//ACTIVAR HISTORIAL DE INGRESO DATATABLE
$activarHistorial = new historialIngresosFiscalesRet();
$activarHistorial->ajaxMostrarTableIngHistoriaRet();
