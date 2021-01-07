<?php

require_once "cone.php";

class ModeloEmpresasAlmacenadoras {

    public static function mdlMostrarEmpAlmacenadora($sp) {
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

    public static function mdlCrearNuevaEmpresa($dataNewEmpresa) {
        $nitEmpresa = $dataNewEmpresa["nitEmpresa"];
        $nombreEmpresa = $dataNewEmpresa["nombreEmpresa"];
        $direEmpresa = $dataNewEmpresa["direEmpresa"];
        $telefonoEmpresa = $dataNewEmpresa["telefonoEmpresa"];
        $email = $dataNewEmpresa["email"];
        $establecimiento = $dataNewEmpresa["establecimiento"];
        $rutaFoto = $dataNewEmpresa["rutaFoto"];
        $params = array(&$nitEmpresa, &$nombreEmpresa, &$direEmpresa, &$telefonoEmpresa, &$email, &$rutaFoto, &$establecimiento);

        $conn = Conexion::Conectar();
        $sql = 'EXECUTE spInsertNewEmpresa ?, ?, ?, ?, ?, ?, ?  ';
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

    public static function ctrMostrarEmpresa($sp, $idEditarEmpresa) {
        $conn = Conexion::Conectar();
        $sql = 'EXECUTE ' . $sp . ' ?';
        $params = array(&$idEditarEmpresa);
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

    public static function mdlEditarNuevaEmpresa($dataNewEmpresa) {
        $nitEmpresa = $dataNewEmpresa["nitEmpresa"];
        $nombreEmpresa = $dataNewEmpresa["nombreEmpresa"];
        $direEmpresa = $dataNewEmpresa["direEmpresa"];
        $telefonoEmpresa = $dataNewEmpresa["telefonoEmpresa"];
        $email = $dataNewEmpresa["email"];
        $rutaFoto = $dataNewEmpresa["rutaFoto"];
        $idEmpresa = $dataNewEmpresa["hiddenIdEmpresa"];
        $establecimiento = $dataNewEmpresa["establecimiento"];

        $params = array(&$nitEmpresa, &$nombreEmpresa, &$direEmpresa, &$telefonoEmpresa, &$email, &$rutaFoto, &$idEmpresa, &$establecimiento);

        $conn = Conexion::Conectar();
        $sql = 'EXECUTE spEditarEmpresa ?, ?, ?, ?, ?, ?, ?, ?';
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

    public static function mdlCancelarEmpresa($sp, $estado, $cancelarEmpresa) {
        $conn = Conexion::Conectar();
        $sql = 'EXECUTE ' . $sp . ' ?, ?';
        $params = array(&$estado, &$cancelarEmpresa);
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
