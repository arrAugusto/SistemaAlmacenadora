<?php

require_once "cone.php";

class ModeloContabilidadRegistrada {

    public static function mdlPolizasPorDia($valor, $estado) {
        $conn = Conexion::Conectar();
        $params = array(&$valor, &$estado);
        $sql = "EXECUTE spSaldosContabilizados ?, ?";
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
            if (!empty($results)) {
                return $results;
            } else {
                return "SD";
            }
        }
    }

    public static function mdlPolizasReportadasDia($valor, $estado) {
        $conn = Conexion::Conectar();
        $params = array(&$valor, &$estado);
        $sql = "EXECUTE spSaldosContaGeneral ?, ?";
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
            if (!empty($results)) {
                return $results;
            } else {
                return "SD";
            }
        }
    }

}
