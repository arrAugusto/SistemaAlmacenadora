<?php

require_once '../controlador/contabilidadRetiro.controlador.php';
require_once '../modelo/contabilidadRetiro.modelo.php';
//SESSION DE USUARIO PARA MANEJAR BITACORA
require_once '../controlador/usuario.controlador.php';

class historialSaldosKardex {

    public $activarHistorial;

    public function ajaxMostrarSaldosKardex() {
        session_start();
        $NavegaNumB = $_SESSION['idDeBodega'];
        $sp = "spsaldosCuadreKardex";
        $respuesta = ModeloContabilidadDeRet::mdlMstrReporteRet($sp, $NavegaNumB) ;

        if ($respuesta != 'SD' && $respuesta != NULL) {
            $contador = 0;
            $circlePlus = "<i class='fa fa-plus-circle faPlusData' style='color:#0066FA; cursor: pointer;'></i>";
            $cabeza = '{
            "data": [';
            echo $cabeza;
            foreach ($respuesta as $key => $value) {
                $botoneraAcciones = "";
                $contador = $contador + 1;


                $datoJsonRetHis = '[
                    "' . $contador . '",
                    "' . $value['nitEmpresa'] . '",
                    "' . $value['numeroPoliza'] . '",
                    "' .  $value['nombreEmpresa'] . $circlePlus.'",                        
                    "' . $value['empresa'] . '",
                    "' . $value['stockBultos'] . '",                        
                    "' . $value['bultos'] . '",
                    "' . $value['peso'] . '"
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
$activarHistorial = new historialSaldosKardex();
$activarHistorial->ajaxMostrarSaldosKardex();
