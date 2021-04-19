<?php

require_once '../controlador/contabilidadRetiro.controlador.php';
require_once '../modelo/contabilidadRetiro.modelo.php';
//SESSION DE USUARIO PARA MANEJAR BITACORA
require_once '../controlador/usuario.controlador.php';

class historialSaldosKardexVeh {

    public $activarHistorialVeh;

    public function ajaxMostrarSaldosKardexVeh() {
        session_start();
        $NavegaNumB = $_SESSION['idDeBodega'];
        $sp = "spsaldosCuadreKardexVeh";
        $respuesta = ModeloContabilidadDeRet::mdlMstrReporteRet($sp, $NavegaNumB);

        if ($respuesta != 'SD' && $respuesta != NULL) {
            $contador = 0;
            $cabeza = '{
            "data": [';
            echo $cabeza;
            foreach ($respuesta as $key => $value) {
                $contador = $contador + 1;
                    $circlePlus = "<i class='fa fa-plus-circle faRevisionVeh' idChas='" . $value["idChas"] . "' idRet='" . $value["idRet"] . "' chasis='" . $value["chasis"] . "' tipoVehiculo='" . $value["tipoVehiculo"] . "'  linea='" . $value["linea"] . "' style='color:#00BD06; cursor: pointer;'></i>";
                $datoJsonRetHis = '[
                    "' . $contador . '",
                    "' . $value['nitEmpresa'] . '",
                    "' . $value['numeroPoliza'] . '",
                    "' . $value['nombreEmpresa'] . '",                        
                    "' . $value['chasis'] . $circlePlus . '",
                    "' . $value['tipoVehiculo'] . '",                        
                    "' . $value['linea'] . '"                ],';
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
$activarHistorialVeh = new historialSaldosKardexVeh();
$activarHistorialVeh->ajaxMostrarSaldosKardexVeh();
