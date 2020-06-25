<?php

require_once "cone.php";

class ModeloIngBodHistorial {

    public static function mdlRangoFechas($fechaInicial, $fechaFinal) {
        if ($fechaInicial == null) {
            $conn = Conexion::Conectar();
            $sql = "EXECUTE spMostrarIngBodOp";
            $stmt = sqlsrv_prepare($conn, $sql);
            if (sqlsrv_execute($stmt) == true) {
                while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                    $results[] = $row;
                }
                if (!empty($results)) {
                    return $results;
                } else if (empty($results)) {
                    return sqlsrv_errors();
                }
            } else {
                return sqlsrv_errors();
            }
        } else if ($fechaInicial == $fechaFinal) {
            $conn = Conexion::Conectar();
            $sql = "EXECUTE spMostrarIngBod1 ?";
            $params = array(&$fechaInicial);
            $stmt = sqlsrv_prepare($conn, $sql, $params);
            if (sqlsrv_execute($stmt) == true) {
                while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                    $results[] = $row;
                }
                if (!empty($results)) {
                    return $results;
                } else if (empty($results)) {
                    return sqlsrv_errors();
                }
            } else {
                return sqlsrv_errors();
            }
        } else if ($fechaInicial !== $fechaFinal) {
            $conn = Conexion::Conectar();
            $sql = "EXECUTE spMostrarIngBod2 ?, ?";
            $params = array(&$fechaInicial, &$fechaFinal);
            $stmt = sqlsrv_prepare($conn, $sql, $params);
            if (sqlsrv_execute($stmt) == true) {
                while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                    $results[] = $row;
                }
                if (!empty($results)) {
                    return $results;
                } else if (empty($results)) {
                    return sqlsrv_errors();
                }
            } else {
                return sqlsrv_errors();
            }
        }
    }

}
