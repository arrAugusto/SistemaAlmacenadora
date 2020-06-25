<?php

require_once "cone.php";

class ModeloServicios {

    public function mdlMostrarServicios($tabla, $valor) {

        if ($tabla == "SERVICIOS" && $valor == "") {
            $conn = Conexion::Conectar();
            $query = "SELECT * FROM $tabla";
            $stmt = sqlsrv_prepare($conn, $query);
            $result = sqlsrv_execute($stmt);
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
            return $results;

            sqlsrv_free_stmt($stmt);
            sqlsrv_close($conn);
        } else {

            return "error";
        }
    }

    public function mdlNuevaTarifa($tabla, $datos) {
        $params = array(&$datos['idServicio'],
            &$datos['idNit'],
            &$datos['baseCalculo'],
            &$datos['calculosobre'],
            &$datos['periodoCobro'],
            &$datos['moneda'],
            &$datos['valorAlmacenaje'],
            &$datos['aplica'],
            &$datos['estado'],
            &$datos['fechaCreacion'],
            &$datos['fechaCreacion'],
            $datos['serie']
        );
        
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spNuevoAlmacenaje ?,	?,	?,	?,	?,	?,	?,	?,	?,	?,	?,	?";
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

    public static function mdlNitClientesTarifaEspecial() {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spNitUsuario";

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
        }
    }

}
