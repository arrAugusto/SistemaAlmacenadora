<?php

require_once "cone.php";

class ModeloHistoriaDeIngresos {

    public static function mdlMostrarCalculosMes($valor) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spHistoriaCalc ?";
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
        } else {
            return sqlsrv_errors();
        }
    }

    public static function mdlUpdateFechaCalculo($fechRecalc, $idRetCalc) {
              $conn = Conexion::Conectar();
        $sql = "EXECUTE spFechaRecalc ?, ?";
        $params = array(&$fechRecalc, &$idRetCalc);
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
