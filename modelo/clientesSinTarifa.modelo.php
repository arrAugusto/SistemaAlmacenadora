<?php

require_once "cone.php";

class ModeloClientesSinTarifa {

    public static function mdlMostrarClientesSinTarifa() {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spCltSinTar";
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

    public static function mdlAsignarEjecutivo($hiddenIdUsST, $idregistrocliente) {
        $conn = Conexion::Conectar();
        $params = array(&$hiddenIdUsST, &$idregistrocliente);
        $sql = "EXECUTE spAsignarEje ?, ?";
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            return "oK";
        } else {
            return sqlsrv_errors();
        }
    }

    public static function mdlConfirClienteSTarifa($idregistroCDown) {
        $conn = Conexion::Conectar();
        $params = array(&$idregistroCDown);
        $sql = "EXECUTE spNAplicaTarifa ?";
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            return "oK";
        } else {
            return sqlsrv_errors();
        }
    }

}
