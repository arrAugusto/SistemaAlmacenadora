<?php

require_once "cone.php";

class ModeloRetAutorizadosSalida {

    public static function mdlRetAutorizadosSalida($valor) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spVehAutorizados ?";
        $params = array(&$valor);
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

        public static function mdlPreparCorreo($valor, $sp) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE ".$sp." ?";
        $params = array(&$valor);
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
    public static function ctrInsertDosParams($sp, $identChas, $nuevoEstado) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE " . $sp . " ?, ?";
        $params = array(&$nuevoEstado, &$identChas);
        $stmt = sqlsrv_prepare($conn, $sql, $params);

        if (sqlsrv_execute($stmt) == true) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
            if (!empty($results)) {
                return array("resp" => true, "data" => $results);
            } else {
                return "SD";
            }
        } else {
            return array("resp" => false, "data" => "errorDB");
        }
    }
}
