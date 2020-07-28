<?php
require_once "cone.php";

class ModeloSaldosContables {

    public static function mdlSaldoActualContabilidad($sp, $idDeBodega) {
              $conn = Conexion::Conectar();
        $sql = 'EXECUTE ' . $sp . ' ?';
        $params = array(&$idDeBodega);

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