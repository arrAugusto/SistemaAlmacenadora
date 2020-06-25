<?php

require_once "cone.php";

class ModeloVehiculosSinMedidas {

    public static function mdlMostrarVehSinMedida($valor) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spMostraLineasSinMed";
        $stmt = sqlsrv_prepare($conn, $sql);
        if (sqlsrv_execute($stmt) == true) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
            if (!empty($results)) {
                return $results;
            } else {
                return "SD";
            }
        } else {
            return sqlsrv_errors();
        }
    }
    
    public static function mdlGuardarNuevaMedida($idMedida, $vallargoMts, $valanchoMts, $valretrovisorIZ, $valretrovisorDer, $valespacioFrontal, $valespacioLateral){
    $retrovisores = $valretrovisorIZ+$valretrovisorDer;
        $conn = Conexion::Conectar();
    $params = array(&$idMedida, &$vallargoMts, &$valanchoMts, &$retrovisores, &$valespacioFrontal, &$valespacioLateral);
    $sql = "EXECUTE spMedidasVehN ?, ?, ?, ?, ?, ?";
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            return true;
        } else {
            return sqlsrv_errors();
        }
    }

}
