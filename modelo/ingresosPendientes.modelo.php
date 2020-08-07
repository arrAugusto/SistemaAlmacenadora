<?php

require_once "cone.php";

class ModeloIngresosPendientes {

    public static function mdlMostrarIngresosPendientes($llaveIngresosPen) {
        
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spIngPendientes ?";
        $params = array(&$llaveIngresosPen);
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
        } else {
            return sqlsrv_errors();
        }
    }
        public static function mdlTransaccionesPendientes($llave, $sp) {
        $conn = Conexion::Conectar();

        $sql = "EXECUTE " . $sp . " ?";
        $params = array(&$llave);
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
        } else {
            return sqlsrv_errors();
        }
    }

}
