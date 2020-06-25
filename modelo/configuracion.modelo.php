<?php

require_once "cone.php";

    class ModeloConfiNavega {

    public static function mdlInicioSesiones($txtAreaBodega, $numeroBodega, $idHiddenNavega, $idHiddenNavegaUs) {


        $conn = Conexion::Conectar();
        $params = array(&$txtAreaBodega, &$numeroBodega, &$idHiddenNavega);
        $sql = "EXECUTE spConfiNavega ?, ?, ?";
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
            if (!empty($results)) {
                return $results;
            } else {
                return "errorSinData";
            }
        }
    }

    public static function mdlHistoriaNavega($idHiddenNavegaUs, $numIdBod, $time) {

        $conn = Conexion::Conectar();
        $params = array(&$idHiddenNavegaUs, &$numIdBod, &$time);
        $sql = "EXECUTE spInsertTresC ?, ?, ?";
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            return "OpExtiosa";
        } else {
            return sqlsrv_errors();
        }
    }

}
