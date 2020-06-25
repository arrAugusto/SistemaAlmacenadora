<?php
 require_once "cone.php";

class ModeloParametrizarTarifaNormal
{
    public static function mdlMostrarNitEmpresas($tipo)
    {

        $conn   = Conexion::Conectar();
        $sql    = "EXECUTE  spMostrarNit";
        $stmt   = sqlsrv_prepare($conn, $sql);
        if (sqlsrv_execute($stmt) == true) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
            return $results;
        } else {
            return "SD";
        }
    }

    public static function mdlCrearTarifaNormal($datos){

        $params = array($datos['lblNit'],
            $datos['lblEmpresa'],
            $datos['lblDireccion'],
            $datos['baseCalculoAlmacenaje'],
            $datos['periodoCalculoAlmacenaje'],
            $datos['valorAlmacenaje'],
            $datos['baseCalculoZA'],
            $datos['periodoCalculoZA'],
            $datos['valorZA'],
            $datos['basePeso'],
            $datos['valorPeso'],
            $datos['baseGastosAdmin'],
            $datos['valorGastosAdmin'],
            $datos['baseFotocopias'],
            $datos['valorFotocopias'],
            $datos['calculocargaDescarga'],
            $datos['valorcargaDescarga'],
            $datos['calculoOtrosGastos'],
            $datos['valorOtrosGastos'],
            $datos['fecha_creacion'],
            $datos['fecha_Vegencia'],
            $datos['fecha_Vencimiento']);
        $conn = Conexion::Conectar();
        $sql  = "EXECUTE  spInsertNormales1 ?, ?, ?, ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?";
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            return "exito";
        } else {
            return sqlsrv_error();
        }
    }

    public static function mdlConsultaEmpresa($consultaEmpresa)
    {
        $conn   = Conexion::Conectar();
        $sql    = "EXECUTE  spEmpresa ?";
        $params = array(&$consultaEmpresa);
        $stmt   = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
            return $results;
        } else {
            return "SD";
        }

    }
}
