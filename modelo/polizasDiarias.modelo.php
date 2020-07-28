<?php

require_once "cone.php";

class ModeloGenerarContabilidad {

    public static function mdlGenerarPolizasDiarias($fechaContable) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spPolizaIngreso ?";
        $params = array(&$fechaContable);
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

    public static function mdlCtsContables() {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spCuentasContables";
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
        } else {
            return sqlsrv_errors();
        }
    }

    public static function mdlMostrarContabilidad($sp, $tipo) {
        $conn = Conexion::Conectar();
        $sql = 'EXECUTE ' . $sp . ' ?';
        $params = array(&$tipo);

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

    public static function mdlMostrarIng($sp) {
        $conn = Conexion::Conectar();
        $sql = 'EXECUTE ' . $sp;

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
        } else {
            return sqlsrv_errors();
        }
    }

    public static function mdlMostrarRetirosFiscales($sp, $estado, $identBodega) {
        $conn = Conexion::Conectar();
        $sql = 'EXECUTE ' . $sp . ' ?, ?';
        $params = array(&$estado, &$identBodega);

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

    public static function mdlGuardarPolContable($sp, $conPolDefCif, $dependencia, $sumaCif, $estado, $conceptoPoliza, $numeroDepolizaAsig, $debeCif, $tipOperaSaldo, $tipConcepto) {
        
        $conn = Conexion::Conectar();
        $sql = 'EXECUTE ' . $sp . ' ?, ?, ?, ?, ?, ?, ?, ?, ?';
        $params = array(&$conPolDefCif, &$dependencia, &$sumaCif, &$estado, &$conceptoPoliza, &$numeroDepolizaAsig, &$debeCif, &$tipOperaSaldo, &$tipConcepto);
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
