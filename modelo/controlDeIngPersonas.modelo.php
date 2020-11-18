<?php

require_once "cone.php";

class ModeloVisitasAlmacenadoras {

    public static function mdlNuevaVisita($procedencia, $destino, $placaVisita) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spDatosGeneralVisita ?, ?, ?";

        $params = array(&$procedencia, &$destino, &$placaVisita);

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

    public static function mdlNuevaVisitaData($licenciaVisita, $nombreVisita, $idPlacaVisitante, $idAreaVisita, $idEmpresa, $gafete, $idBodegaNavega, $usuarioOp) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spCrearVisita ?, ?, ?, ?, ?, ?, ?, ?";

        $params = array(&$licenciaVisita, &$nombreVisita, &$idPlacaVisitante, &$idAreaVisita, &$idEmpresa, &$gafete, &$idBodegaNavega, &$usuarioOp);

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
