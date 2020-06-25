<?php

require_once "cone.php";

class ModeloGestorDeTarifas {

    public static function mdlMostrarTarifas() {
        $conn = Conexion::Conectar();
            $sql = "EXECUTE  spGestorDeTarifas";
        $stmt = sqlsrv_prepare($conn, $sql);
        if (sqlsrv_execute($stmt) == true) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
            return $results;
        } else {
            return "SD";
        }
    }

    public static function mdlMostrarTodoServicio($idMostrar, $numerotarifa) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE  spMostrarTodo ?, ?";
        $params = array(&$numerotarifa, &$idMostrar);
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (is_null(sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))) {
            return "sindata";
        } else {
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
                return "SD";
            }
        }
    }

    public static function mdlDataDosParams($estadoTarifa, $idClt, $sp) {
               $conn = Conexion::Conectar();
        $params = array(&$estadoTarifa, &$idClt);
        $sql = "EXECUTE  ".$sp." ?, ?";
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
            if (!empty($results)) {
                return array("resp"=>true, "data"=>$results);
            } else {
                return "SD";
            }
        } else {
            return array("resp"=>false);
        }
 
    }

}
