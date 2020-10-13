<?php

require_once '../controlador/contabilidadRetiro.controlador.php';
require_once '../modelo/contabilidadRetiro.modelo.php';
//SESSION DE USUARIO PARA MANEJAR BITACORA
require_once '../controlador/usuario.controlador.php';

class historialIngresosFiscalesRet {

    public $activarHistorial;

    public function ajaxMostrarTableIngHistoriaRet() {
        $tipo = $this->tipo;
        session_start();
        $NavegaNumB = $_SESSION['idDeBodega'];
        $respuesta = ModeloContabilidadDeRet::mdlListarRetPendientesHistorial($tipo, $NavegaNumB);
        if ($respuesta != 'SD') {
            $contador = 0;
            $cabeza = '{
            "data": [';
            echo $cabeza;

            foreach ($respuesta as $key => $value) {
                $contador = $contador + 1;
                $numIng = $value['idIngOp'];
                $identRet = $value['identRet'];
                if ($tipo == 4) {
                    if ($tipo == 4) {
                        $botoneraAcciones = "<div class='btn-group'><button type='button' class='btn btn-success btn-sm btnExcelRetSal' idRet= " . $identRet . "><i class='fa fa-file-excel-o'></i></button><button type='button' class='btn btn-outline-primary btn-sm' id='btnReimprimeRec' idRet=" . $identRet . ">Rec.</button></button><button type='button' class='btn btn-outline-info btn-sm' id='btnReimprimeRet' idRet=" . $identRet . ">Ret.</button><button type='button'  class='btn btn-outline-danger btnAnularOperacion btn-sm' disabled='disabled' data-toggle='modal' data-target='#AnulacionRetiro' idPoliza=" . $value['polRet'] . " idRet=" . $value['identificaRet'] . " estado=0><i class='fa fa-close'></i></button><div class='btn-group'></div>";
                    }
                    if ($tipo >= 5) {
                        $botoneraAcciones = "<div class='btn-group'><button type='button' class='btn btn-success btn-sm btnExcelRetSal' idRet= " . $identRet . "><i class='fa fa-file-excel-o'></i></button><button type='button' class='btn btn-outline-primary btn-sm' id='btnReimprimeRec' idRet='" . $identRet . "'>Rec.</button></button><button type='button' class='btn btn-outline-info btn-sm' id='btnReimprimeRet' idRet='" . $identRet . "'>Ret.</button><button type='button'  class='btn btn-outline-danger btnAnularOperacion btn-sm' disabled='disabled' data-toggle='modal' data-target='#AnulacionRetiro' idPoliza=" . $value['polRet'] . " idRet=" . $value['identificaRet'] . " estado=0><i class='fa fa-close'></i></button><div class='btn-group'></div>";
                    }
                } else {
                    $botoneraAcciones = "<div class='btn-group'><button type='button' class='btn btn-success btn-sm btnExcelRetSal' idRet= " . $identRet . "><i class='fa fa-file-excel-o'></i></button><button type='button' class='btn btn-warning btn-sm'>Pendiente&nbsp;</button><button type='button'  class='btn btn-outline-danger btnAnularOperacion btn-sm' disabled='disabled' data-toggle='modal' data-target='#AnulacionRetiro' idPoliza=" . $value['polRet'] . " idRet=" . $value['identificaRet'] . " estado=0><i class='fa fa-close'></i></button><div class='btn-group'></div>";
                }

                $datoJsonIngHis = '[
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



            $datoJsonIngHis = substr($datoJsonIngHis, 0, -1);
                if ($key + 1 != count($respuesta)) {
                    echo $datoJsonIngHis.']}';
                }
                return true;
            }
            $pie = substr($datoJsonIngHis, 0, -1);
            $pie .= ']}';
            echo $pie;
        }
    }

}

//ACTIVAR HISTORIAL DE INGRESO DATATABLE
$activarHistorial = new historialIngresosFiscalesRet();
$activarHistorial->tipo = $_POST['tipo'];
$activarHistorial->ajaxMostrarTableIngHistoriaRet();
