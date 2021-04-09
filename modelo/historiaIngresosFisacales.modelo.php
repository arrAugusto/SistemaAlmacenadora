<?php

require_once "cone.php";

class ModeloHistorialIngresos {

    public static function mdlMostrarIngresosVigentes($valor) {

        $conn = Conexion::Conectar();
        $params = array(&$valor);
        $sql = "EXECUTE spHisIngTodo ?";

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
        }
    }

    public static function mdlMostrarTableIngHistoria($sp, $param, $valor) {
        $conn = Conexion::Conectar();
        $params = array(&$param, &$valor);
        $sql = "EXECUTE " . $sp . " ?, ?";
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
        }
    }

    public static function mdlMostrarChasisVehContables($sp, $valor) {
        $conn = Conexion::Conectar();
        $params = array(&$valor);
        $sql = "EXECUTE " . $sp . " ?";
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
        }
    }

    public static function mdlMostrarServiciosEdit() {

        $conn = Conexion::Conectar();
        $sql = "EXECUTE spServicioF";

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

    public static function mdlMostrarSinParams($sp) {

        $conn = Conexion::Conectar();
        $sql = "EXECUTE " . $sp;

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

    public static function mdlEditarIngOperacion($idIngEditOp) {
        $conn = Conexion::Conectar();
        $params = array(&$idIngEditOp);
        $sql = "EXECUTE spEditIngOp ?";
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
        }
    }

    public static function mdlAnulaIngBod($idIngresoAnulacion, $hasing, $time, $motivoAnula, $usuario, $estado) {

        $conn = Conexion::Conectar();
        $params = array(&$idIngresoAnulacion, &$hasing, &$time, &$motivoAnula, &$usuario, &$estado);
        $sql = "EXECUTE spAutAnulaIng ?, ?, ?, ?, ?, ?";

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
        }
    }

    public static function mdlGenerarBitacoraRet($idRet, $usuario, $date, $encriptar, $sp) {

        $conn = Conexion::Conectar();
        $params = array(&$idRet, &$usuario, &$date, &$encriptar);
        $sql = "EXECUTE " . $sp . " ?, ?, ?, ?";

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

    public static function mdlMostrarRegimenes() {

        $conn = Conexion::Conectar();
        $sql = "EXECUTE spConstReg";

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

    public static function mdlEditarIngresoOperacion($datos) {

        $params = array(&$datos['idIngresoEditado'],
            &$datos['cartaDeCupoEditOp'],
            &$datos['polizaEditOp'],
            &$datos['duaEditOp'],
            &$datos['blEditOp'],
            &$datos['puertoOrigenEditOp'],
            &$datos['productoEditOp'],
            &$datos['serviciosEditOp'],
            &$datos['regimenPolizaEditOp']);
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spEditarIngreso ?, ?, ?, ?, ?, ?, ?, ?, ?";
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            $fechaIngFormat = date("Y-m-d H:i:s", strtotime($datos['fechaIngEditOp']));

            $paramsIngSaldo = array(&$datos['idIngresoEditado'],
                &$datos['cantContenedoresEditOp'],
                &$datos['cantClientesEditOp'],
                &$datos['pesoIngEditOp'],
                &$datos['bultosEditOp'],
                &$datos['valorTotalAduanaEditOp'],
                &$datos['tipoDeCambioEditOp'],
                &$datos['totalValorCifEditOp'],
                &$datos['valorImpuestoEditOp'],
                &$fechaIngFormat);
            $sql = "EXECUTE spEditarSaldoOp ?, ?, ?, ?, ?, ?, ?, ?, ?, ?";
            $stmt = sqlsrv_prepare($conn, $sql, $paramsIngSaldo);
            if (sqlsrv_execute($stmt) == true) {
                return "Okk";
            } else {
                return sqlsrv_errors();
            }
        } else {
            return sqlsrv_errors();
        }
    }

    public static function mdlMostrarDetallesClientesPlts($idIngClientesPlt) {
        $tipo = 1;
        $conn = Conexion::Conectar();
        $params = array(&$idIngClientesPlt, &$tipo);
        $sql = "EXECUTE spDetallesEdit ?, ?";
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

    public static function mdlInsertNuevoServicio($nuevoServicio, $usuario, $sp) {
        $estado = 1;
        $conn = Conexion::Conectar();
        $params = array(&$nuevoServicio, $estado);
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

    public static function mdlNewServicioIng($idIngSerOtr, $idServ, $valorOtros, $comentario, $usuario, $estado, $tipoOpera, $sp) {
        $conn = Conexion::Conectar();
        $params = array(&$idIngSerOtr, &$idServ, &$valorOtros, &$comentario, &$usuario, &$estado, &$tipoOpera);
        $sql = 'EXECUTE ' . $sp . ' ?, ?, ?, ?, ?, ?, ?';
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

    public static function mdlMostrarDetallesPlts($idIngClientesPlt) {
        $tipo = 2;
        $conn = Conexion::Conectar();



        $params = array(&$idIngClientesPlt, &$tipo);
        $sql = "EXECUTE spDetallesEdit ?, ?";

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

    public static function mdlAnularIngreso($idIngresoAnulacion) {

        $conn = Conexion::Conectar();
        $params = array(&$idIngresoAnulacion);
        $sql = "EXECUTE AnulacionDef ?";
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            return "Anulado";
        } else {
            return sqlsrv_errors();
        }
    }

    public static function mdlAnularIngresoValidacion($idIngresoAnulacion) {
        $conn = Conexion::Conectar();
        $params = array(&$idIngresoAnulacion);
        $sql = "EXECUTE spValAnulacion ?";
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

    public static function mdlMostrarPuertos() {


        $conn = Conexion::Conectar();
        $sql = "EXECUTE spMstrAduana";
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

}
