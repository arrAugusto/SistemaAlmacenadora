<?php

require_once "cone.php";

class ModeloMedidasVehiculos {
  public static function mdlMostrarListadoVehiMedidas() {
    $conn = Conexion::Conectar();
    $sql = "EXECUTE spMetrajeVehi";
    $stmt = sqlsrv_prepare($conn, $sql);
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

}
