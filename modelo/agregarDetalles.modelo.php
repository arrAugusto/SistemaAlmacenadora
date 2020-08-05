<?php

require_once "cone.php";

class ModeloAgregarDetalles {

    public static function mdlMostrarEmpresas() {

        $conn = Conexion::Conectar();

        $query = "SELECT * FROM NIT";
        $stmt = sqlsrv_prepare($conn, $query);
        $result = sqlsrv_execute($stmt);
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $results[] = $row;
        }
        return $results;
    }

}
