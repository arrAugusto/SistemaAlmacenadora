<?php

require_once "cone.php";

class ModeloGeneracionDeContabilidad {

    public static function mdlIngRegistroConta($idContabilizar, $fechaCongeladaConta, $usuarioOp) {
        $FormatConta = date("Y-m-d H:i:s", strtotime($fechaCongeladaConta));
        $conn = Conexion::Conectar();
        $params = array(&$idContabilizar, &$FormatConta, &$usuarioOp);
        $sql = "EXECUTE spContaIngresoEstado ?, ?, ?";
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
            return $results;
        } else {
            return sqlsrv_errors();
        }
    }

    public static function mdlIngRegistroContaReportes($sp, $tipo, $ident) {
        $conn = Conexion::Conectar();
        $params = array(&$tipo, &$ident);
        $sql = 'EXECUTE ' . $sp . ' ?, ?';
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

    public static function mdlJefeUnidad($sp, $ident) {
        $conn = Conexion::Conectar();
        $sql = 'EXECUTE ' . $sp .' ?';
        $params = array(&$ident);
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
