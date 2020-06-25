<?php
require_once "cone.php";
class ModeloGeneracionDeContabilidad{
    public static function mdlIngRegistroConta($idContabilizar){
        $conn = Conexion::Conectar();
        $params = array(&$idContabilizar);
        $sql = "EXECUTE spContaIngresoEstado ?";
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
           while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
return $results;
            } else {
            return array("resp" => false, "data" => "errorDB");
        }
    }
}