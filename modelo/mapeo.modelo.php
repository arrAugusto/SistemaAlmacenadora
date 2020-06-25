<?php

require_once "cone.php";

class ModeloMapaDeBodegas {

    public static function mdlRegistrarNuevoMapa($datos) {
        $listaInactiva = json_decode($datos["listaUbInactiva"], true);
        $pasillos = $datos["pasillos"];
        $columnas = $datos["columnas"];
        $nuevArea = $datos["nuevArea"];
        $numeroBodega = $datos["numeroBodega"];
        $nuevDependencia = $datos["nuevDependencia"];
        date_default_timezone_set('America/Guatemala');
        $fechaCreacion = date('Y-m-d H:i:s');

        $conn = Conexion::Conectar();
        $params = array(&$numeroBodega, &$nuevArea, &$nuevDependencia);

        $sql = "EXECUTE spIngAreasAuto ?, ?, ?";
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
            if (!empty($results)) {
                if ($results[0]["cantidad"] == 0) {
                    $params = array(&$nuevArea, &$numeroBodega, &$nuevDependencia);
                    $sql = "EXECUTE spInsertAreasAuto ?, ?, ?";
                    $stmt = sqlsrv_prepare($conn, $sql, $params);
                    if (sqlsrv_execute($stmt) == true) {
                        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                            $results1[] = $row;
                        }
                        if (!empty($results1)) {
                            $llaveID = $results1[0]["Identity"];
                            $sql = "EXECUTE spNuevoMapa ?, ?, ?, ?";
                            $params = array(&$llaveID, &$pasillos, &$columnas, &$fechaCreacion);
                            $stmt = sqlsrv_prepare($conn, $sql, $params);
                            if (sqlsrv_execute($stmt) == true) {
                                while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                                    $results2[] = $row;
                                }
                                if (!empty($results2)) {
                                    $llave = $results2[0]["Identity"];
                                    foreach ($listaInactiva as $key => $value) {
                                        $valueY = $value["datoY"];
                                        $valueX = $value["datoX"];
                                        $sql = "EXECUTE spIngInactivas ?, ?, ?";
                                        $params = array(&$llave, &$valueY, &$valueX);
                                        $stmt = sqlsrv_prepare($conn, $sql, $params);
                                        if (sqlsrv_execute($stmt) == true) {
                                            if (sizeof($listaInactiva) == $key + 1) {
                                                return "fin";
                                            }
                                        } else {
                                            return sqlsrv_errors();
                                        }
                                    }
                                } else {
                                    return "vacio";
                                }
                            } else {
                                return sqlsrv_errors();
                            }
                        } else {
                            return "dataVacia";
                        }
                    } else {
                        return "existe";
                    }
                } else {
                    return "Existe";
                }
            }
        } else {
            return sqlsrv_errors();
        }
    }
}

/*


IF(
SELECT COUNT(*) AS 'cantidad'  from AREASALMACEANDORAS WHERE numeroIdentidad=2 AND areasAutorizadas LIKE '%Predio de Vehiculos Usados%' AND dependencia LIKE '%Almacenadora Integrada, S.A.%')=1
PRINT 1
ELSE
PRINT 0*/
