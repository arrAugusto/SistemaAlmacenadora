<?php

require_once "cone.php";

class ModeloCalculoDeAlmacenaje {

    public static function mdlGuardarCalculo($datos) {
        date_default_timezone_set('America/Guatemala');
        $date = date('Y-m-d H:i:s');
        $params = array(
            &$datos['idCalculoAlmacenaje'],
            &$datos['hiddenIdentificador'],
            &$datos['hiddenIdNitSalida'],
            &$datos['calculoPolizaRetiro'],
            &$datos['calculoRegimen'],
            &$datos['calculoValorTAduana'],
            &$datos['calculoCambio'],
            &$datos['calculoValorCif'],
            &$datos['calculoValorImpuesto'],
            &$datos['calculoPesoKg'],
            &$datos['calculoCantBultos'],
            &$date,
            &$datos['hiddenDateTime'],
            &$datos['usuarioOp']);
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spGuardCalc  ?, ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?";
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

    public static function mdlVerificarMostrarTarifa($idIngresoCal, $identRet) {
        $params = array(&$idIngresoCal, &$identRet);
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spVerificaTarifa ?, ?";
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

    public static function mdlVerificacionCalculo($idPoliza) {
        $params = array($idPoliza);
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spVerificaCalc ?";
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

    public static function mdlModificarCalculo($datos, $idIngreso, $idDetalleCalc) {
        $params = array(
            &$idIngreso,
            &$idDetalleCalc,
            &$datos['hiddenIdNitSalida'],
            &$datos['calculoPolizaRetiro'],
            &$datos['calculoRegimen'],
            &$datos['calculoValorTAduana'],
            &$datos['calculoCambio'],
            &$datos['calculoValorCif'],
            &$datos['calculoValorImpuesto'],
            &$datos['calculoPesoKg'],
            &$datos['calculoCantBultos'],
            &$datos['hiddenDateTime'],
            &$datos['usuarioOp']
                );
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spModificarCalc ?,	?,	?,	?,	?,	?,	?,	?,	?,	?,	?,	?,	?";
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

    public static function mdlVerificaTarifa($idIngreso, $sp) {
        $params = array(&$idIngreso);
        $conn = Conexion::Conectar();
        $sql = 'EXECUTE ' . $sp . ' ?';
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

    public static function mdlVerificaTarifaDosParms($idIngreso, $idCalc, $sp) {
        $params = array(&$idIngreso, &$idCalc);
        $conn = Conexion::Conectar();
        $sql = 'EXECUTE ' . $sp . ' ?, ?';
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

    public static function mdlInsertRubroExtraCalculo($idCalculo, $idServicio, $valorOtros, $time, $estado, $tipo, $idRetCal) {
        $conn = Conexion::Conectar();
        $params = array(&$idCalculo, &$idServicio, &$valorOtros, &$time, &$estado, &$tipo, &$idRetCal);
        $sql = 'EXECUTE spInsertExtraCalculo ?, ?, ?, ?, ?, ?, ?';
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

    public static function mdInsertDescuentoCalc($idCalculo, $valCalculado, $time, $estado, $hiddenTipoOP, $hiddenDescuento, $idRetCal) {
        $conn = Conexion::Conectar();

        $params = array(&$idCalculo, &$valCalculado, &$hiddenDescuento, &$time, &$estado, &$estado, &$hiddenTipoOP, &$idRetCal);
        $sql = 'EXECUTE spDescuentoOtro ?, ?, ?, ?, ?, ?, ?';
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

    public static function mdlVerificarCalculo($idCalculo, $idServicio, $tipo, $sp) {
        $conn = Conexion::Conectar();
        $params = array(&$idCalculo, &$idServicio, &$tipo);
        $sql = 'EXECUTE ' . $sp . ' ?, ?, ?';
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

    public static function mdlModificarCalculoSerExtra($idCalculo, $idServicio, $tipo, $valorOtros, $estado, $idRetCal, $sp) {
        $conn = Conexion::Conectar();
        $params = array(&$idCalculo, &$idServicio, &$tipo, &$valorOtros, &$estado, &$idRetCal);

        $sql = 'EXECUTE ' . $sp . ' ?, ?, ?, ?, ?, ?';
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

    public static function mdlRevisionCalculospol($verPoliza, $sp) {

        $conn = Conexion::Conectar();
        $params = array(&$verPoliza);
        $sql = 'EXECUTE ' . $sp . ' ?';
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
