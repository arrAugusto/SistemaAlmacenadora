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

        if ($respuesta != 'SD' && $respuesta != NULL) {
            $contador = 0;
            $cabeza = '{
            "data": [';
            echo $cabeza;
            foreach ($respuesta as $key => $value) {
                $botoneraAcciones = "";
                $contador = $contador + 1;
                $identRet = $value['identRet'];
                if ($_SESSION['departamentos'] == 'Operaciones Fiscales') {


                    if ($_SESSION['niveles'] == 'MEDIO') {
                        if ($value['estadoRet'] == 2 || $value['estadoRet'] == 1) {
                            $botoneraAcciones = "<div class='btn-group'><button type='button' class='btn btn-success btn-sm btnExcelRetSal' idRet = '" . $identRet . "'><i class='fa fa-file-excel-o'></i></button></i><button type='button' class='btn btn-warning btn-sm'>Pendiente</button><a href='#divEdicionRetiro' type='button' class='btn btn-outline-danger btnAnularOperacion btn-sm' idPoliza='" . $value['polRet'] . "' idRet='" . $value['identificaRet'] . "' estado=0><i class='fa fa-eraser'></i></a><a href='#divEdicionRetiro' type='button' class='btn btn-outline-danger btnAnularRetiro_recibo btn-sm' idPoliza='" . $value['polRet'] . "' idRet='" . $value['identificaRet'] . "' estado=0><i class='fa fa-close'></i></a><button type='button' class='btn btn-warning btnConsultDataConfirm btn-sm' reciboasignado='0' retiroasignado='0' polizasal='3188511109' correlinicio='100000000' idRet = '" . $identRet . "' idniting = '" . $value["idIngOp"] . "' servicio='3' idingreso='583' data-toggle='modal' data-target='#modalPaseSalida'><i class='fa fa-undo'></i></button></div>";
                        }
                        if ($value['estadoRet'] >= 4) {
                            $botoneraAcciones = "<div class='btn-group'><button type='button' class='btn btn-success btn-sm btnExcelRetSal' idRet = '" . $identRet . "'><i class='fa fa-file-excel-o'></i></button><button type='button' class='btn btn-outline-primary btn-sm' id='btnReimprimeRec' idRet='" . $identRet . "'>Rec.</button><button type='button' class='btn btn-outline-info btn-sm' id='btnReimprimeRet' idRet='" . $identRet . "'>Ret.</button><a href='#divEdicionRetiro' type='button' class='btn btn-outline-danger btnAnularOperacion btn-sm' idPoliza='" . $value['polRet'] . "' idRet='" . $value['identificaRet'] . "' estado=0><i class='fa fa-eraser'></i></a><a href='#divEdicionRetiro' type='button' class='btn btn-outline-danger btnAnularRetiro_recibo btn-sm' idPoliza='" . $value['polRet'] . "' idRet='" . $value['identificaRet'] . "' estado=0><i class='fa fa-close'></i></a><button type='button' class='btn btn-warning btnConsultDataConfirm btn-sm' reciboasignado='0' retiroasignado='0' polizasal='3188511109' correlinicio='100000000' idRet = '" . $identRet . "' idniting = '" . $value["idIngOp"] . "' servicio='3' idingreso='583' data-toggle='modal' data-target='#modalPaseSalida'><i class='fa fa-undo'></i></button></div>";
                        }
                        if ($value['estadoRet'] == 3) {
                            $botoneraAcciones = "<div class='btn-group'><button type='button' class='btn btn-success btn-sm btnExcelRetSal' idRet = '" . $identRet . "'><i class='fa fa-file-excel-o'></i><button type='button' class='btn btn-warning btn-sm'>Pendiente</button><a href='#divEdicionRetiro' type='button' class='btn btn-outline-danger btnAnularOperacion btn-sm' idPoliza='" . $value['polRet'] . "' idRet='" . $value['identificaRet'] . "' estado=0><i class='fa fa-eraser'></i></a><a href='#divEdicionRetiro' type='button' class='btn btn-outline-danger btnAnularRetiro_recibo btn-sm' idPoliza='" . $value['polRet'] . "' idRet='" . $value['identificaRet'] . "' estado=0><i class='fa fa-close'></i></a><button type='button' class='btn btn-warning btnConsultDataConfirm btn-sm' reciboasignado='0' retiroasignado='0' polizasal='3188511109' correlinicio='100000000' idRet = '" . $identRet . "' idniting = '" . $value["idIngOp"] . "' servicio='3' idingreso='583' data-toggle='modal' data-target='#modalPaseSalida'><i class='fa fa-undo'></i></button></div>";
                        }
                    } else {
                        if ($value['estadoRet'] == 2 || $value['estadoRet'] == 1) {
                            $botoneraAcciones = "<div class='btn-group'><button type='button' class='btn btn-success btn-sm btnExcelRetSal' idRet = '" . $identRet . "'><i class='fa fa-file-excel-o'></i><button type='button' class='btn btn-warning btnConsultDataConfirm btn-sm' reciboasignado='0' retiroasignado='0' polizasal='3188511109' correlinicio='100000000' idRet = '" . $identRet . "' idniting = '" . $value["idIngOp"] . "' servicio='3' idingreso='583' data-toggle='modal' data-target='#modalPaseSalida'><i class='fa fa-undo'></i></button></div>";
                        }
                        if ($value['estadoRet'] >= 4) {
                            $botoneraAcciones = "<div class='btn-group'><button type='button' class='btn btn-success btn-sm btnExcelRetSal' idRet = '" . $identRet . "'><i class='fa fa-file-excel-o'></i></button><button type='button' class='btn btn-outline-primary btn-sm' id='btnReimprimeRec' idRet='" . $identRet . "'>Rec.</button><button type='button' class='btn btn-outline-info btn-sm' id='btnReimprimeRet' idRet='" . $identRet . "'>Ret.</button><button type='button' class='btn btn-warning btnConsultDataConfirm btn-sm' reciboasignado='0' retiroasignado='0' polizasal='3188511109' correlinicio='100000000' idRet = '" . $identRet . "' idniting = '" . $value["idIngOp"] . "' servicio='3' idingreso='583' data-toggle='modal' data-target='#modalPaseSalida'><i class='fa fa-undo'></i></button></div>";
                        }
                        if ($value['estadoRet'] == 3) {
                            $botoneraAcciones = "<div class='btn-group'><button type='button' class='btn btn-success btn-sm btnExcelRetSal' idRet = '" . $identRet . "'><i class='fa fa-file-excel-o'></i><button type='button' class='btn btn-warning btn-sm'>Pendiente</button><button type='button' class='btn btn-warning btnConsultDataConfirm btn-sm' reciboasignado='0' retiroasignado='0' polizasal='3188511109' correlinicio='100000000' idRet = '" . $identRet . "' idniting = '" . $value["idIngOp"] . "' servicio='3' idingreso='583' data-toggle='modal' data-target='#modalPaseSalida'><i class='fa fa-undo'></i></button></div>";
                        }
                    }
                    if ($value['estadoRet'] == -1) {
                        $botoneraAcciones = "<div class='btn-group'><button type='button' class='btn btn-success btn-sm btnExcelRetSal' idRet = '" . $identRet . "'><i class='fa fa-file-excel-o'></i></button><button type='button' class='btn btn-outline-primary btn-sm' id='btnReimprimeRec' idRet='" . $identRet . "'>Rec.</button><button type='button' class='btn btn-outline-info btn-sm' id='btnReimprimeRet' idRet='" . $identRet . "'>Ret.</button><button type='button' class='btn btn-secondary'>Anulado</button></div>";
                    }
                }else{
                        if ($value['estadoRet'] == 2 || $value['estadoRet'] == 1) {
                            $botoneraAcciones = "<div class='btn-group'><button type='button' class='btn btn-success btn-sm btnExcelRetSal' idRet = '" . $identRet . "'><i class='fa fa-file-excel-o'></i></div>";
                        }
                        if ($value['estadoRet'] >= 4) {
                            $botoneraAcciones = "<div class='btn-group'><button type='button' class='btn btn-success btn-sm btnExcelRetSal' idRet = '" . $identRet . "'><i class='fa fa-file-excel-o'></i></button><button type='button' class='btn btn-outline-primary btn-sm' id='btnReimprimeRec' idRet='" . $identRet . "'>Rec.</button><button type='button' class='btn btn-outline-info btn-sm' id='btnReimprimeRet' idRet='" . $identRet . "'>Ret.</button></div>";
                        }
                        if ($value['estadoRet'] == 3) {
                            $botoneraAcciones = "<div class='btn-group'><button type='button' class='btn btn-success btn-sm btnExcelRetSal' idRet = '" . $identRet . "'><i class='fa fa-file-excel-o'></i><button type='button' class='btn btn-warning btn-sm'>Pendiente</button><button type='button' class='btn btn-warning btnConsultDataConfirm btn-sm' reciboasignado='0' retiroasignado='0' polizasal='3188511109' correlinicio='100000000' idRet = '" . $identRet . "' idniting = '" . $value["idIngOp"] . "' servicio='3' idingreso='583' data-toggle='modal' data-target='#modalPaseSalida'><i class='fa fa-undo'></i></button></div>";
                        }
                }
                $datoJsonRetHis = '[
                    "' . $contador . '",
                    "' . $value['numNit'] . '",
                    "' . $value['empresa'] . '",
                    "' . $value['emision'] . '",                        
                    "' . $value['numPolIng'] . '",
                    "' . $value['polRet'] . '",
                    "' . $value['numeroRetiro'] . '",                        
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
