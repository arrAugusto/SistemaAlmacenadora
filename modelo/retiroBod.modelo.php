<?php

require_once "cone.php";

class ModeloRetirosBodega {

    public static function mdlRebajarRetiroBod() {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spRetirosBodP";
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

    public static function mdlMostrarDetalle($idRetiro) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spConsultRetDet ?";
        $params = array(&$idRetiro);
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

    public static function mdlGuardaDetalleRet($idRet, $usuarioOp) {
        $estado = 2;
        $asignar = 0;
        $params = array(&$idRet, &$estado, &$asignar, &$usuarioOp);
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spEstadoRet ?, ?, ?, ?";
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            return "oksReb";
        } else {
            return sqlsrv_errors();
        }
    }

    public static function mdlDetallesIng($idIngreso) {

        $conn = Conexion::Conectar();
        $sql = "EXECUTE spMostrarDetI ?";
        $params = array(&$idIngreso);
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

    public static function mdlSumaSaldosRet($idIngOpDet) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spSumRet ?";
        $params = array(&$idIngOpDet);
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

    public static function mdlSumaSaldosIng($idIngOpDet) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spSumDet ?";
        $params = array(&$idIngOpDet);
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

    public static function mdlConsultaParamUno($valParamentro, $sp) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE " . $sp . " ?";
        $params = array(&$valParamentro);
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

    public static function mdlMostrarUbicaciones($idDetalles) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spUbicaRetiro ?";
        $params = array(&$idDetalles);
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

    public static function mdlLiquidarStockIngreso($idIngresoCantBultos) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spUpdateIngLiqui ?";
        $params = array(&$idIngresoCantBultos);
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            return "oK";
        } else {
            return sqlsrv_errors();
        }
    }

    public static function mdlDetallesRet($idDetalle, $idRetiro) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spNuevoDetalle   ?, ?";
        $params = array(&$idDetalle, &$idRetiro);
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

    public static function  mdlDetallesSalidaMerca($valIdRet) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spDataRetBod ?";
        $params = array(&$valIdRet);
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

    public static function mdlUpdateDetalle($idRet, $arrayNuevoDetalle, $usuarioOp) {

        $conn = Conexion::Conectar();
        $sql = "EXECUTE spUpdateDetalle ?, ?, ?";
        $params = array(&$arrayNuevoDetalle, &$idRet, &$usuarioOp);
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            return "exito";
        } else {
            return sqlsrv_errors();
        }
    }

    public static function mdlAccionDetalleEditar($idDetaEdit, $valPosSalidaEdit, $valMtsSalidaEdit, $saldoAnteriorPos, $saldoAnteriorMts) {

        $conn = Conexion::Conectar();
        $sql = "EXECUTE spEditStockInci ?, ?, ?, ?, ?";
        $params = array(&$idDetaEdit, &$valPosSalidaEdit, &$valMtsSalidaEdit, &$saldoAnteriorPos, &$saldoAnteriorMts);
        return $params;
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            return "exito";
        } else {
            return sqlsrv_errors();
        }
    }

    public static function mdlActualizarStock($idDetaEdit, $valPosSalidaEdit, $valMtsSalidaEdit) {

        $conn = Conexion::Conectar();
        $sql = "EXECUTE spActualizarStock  ?, ?, ?";
        $params = array(&$idDetaEdit, &$valPosSalidaEdit, &$valMtsSalidaEdit);
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            return "exitoG";
        } else {
            return sqlsrv_errors();
        }
    }

    public static function mdlRetiroBodParamUno($value1, $value2, $sp) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE " . $sp . " ?, ?";
        $params = array(&$value1, $value2);
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            return "Ok";
        } else {
            return sqlsrv_errors();
        }
    }
        public static function mdlInsertMarchamoDos($value1, $value2, $value3, $sp) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE " . $sp . " ?, ?, ?";
        $params = array(&$value1, &$value2, &$value3);
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

    public static function mdlInsertMarchamoTres($value1, $value2, $value3, $sp) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE " . $sp . " ?, ?, ?";
        $params = array(&$value1, $value2, $value3);
        
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
    