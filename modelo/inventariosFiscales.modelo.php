<?php

require_once "cone.php";

class ModeloGeneracionDeInventarios {

    public static function mdlMostrarInventario($valor) {
        $conn = Conexion::Conectar();
        $params = array(&$valor);
        $sql = "EXECUTE spSaldos ?";
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

    public static function mdlMostarDetalleExcel($idIngresoExcel, $sp) {
        $conn = Conexion::Conectar();
        $params = array(&$idIngresoExcel);
        $sql = "EXECUTE " . $sp . " ?";
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

    public static function mdlModificacionesUbicaciones($idDet, $sp) {
        $conn = Conexion::Conectar();
        $params = array(&$idDet);
        $sql = "EXECUTE " . $sp . " ?";
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

    public static function mdlEliminarUbicacion($pasilloYTrash, $columnaXTrash, $idIncidenciaTrash, $sp) {
        $conn = Conexion::Conectar();
        $params = array(&$idIncidenciaTrash, &$pasilloYTrash, &$columnaXTrash);
        $sql = "EXECUTE " . $sp . " ?, ?, ?";
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            return "Ok";
        } else {
            return sqlsrv_errors();
        }
    }

}
