<?php

require_once "cone.php";

class ModeloContabilidadDeRet {

    public static function mdlListarRetPendientes($tipo, $ident) {
        $dataArray = [];
        $conn = Conexion::Conectar();
        
        $params = array(&$tipo, &$ident);
        $sql = "EXECUTE spRetirosPendientes ?, ?";
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
            if (!empty($results)) {
                foreach ($results as $key => $values) {
                    $resultsData = [];
                    $idIngreso = $values["idIngOp"];
                    $identificaRet = $values["identificaRet"];

                    $params = array(&$idIngreso, &$identificaRet);

                            $data = array(
                                "nitIngreso" => $nitIngreso = $values["nitIngreso"],
                                "nitRet" => $nitRet = $values["nitRet"],
                                "numNit" => $numNit = $values["numNit"],
                                "empresa" => $empresa = $values["empresa"],
                                "numPolIng" => $numPolIng = $values["numPolIng"],
                                "polRet" => $polRet = $values["polRet"],
                                "pesoRet" => $pesoRet = $values["pesoRet"],
                                "bultosRet" => $bultosRet = $values["bultosRet"],
                                "tipoServicio" => $tipoServicio = $values["tipoServicio"],
                                "numId" => $numId = $values["numId"],
                                "identRet" => $identRet = $values["identRet"],
                                "idIngOp" => $idIngOp = $values["idIngOp"],
                                "valorEstadoRet" => $valorEstadoRet = $values["valorEstadoRet"],
                                "totalValorCif" => $totalValorCif = $values["totalValorCif"],
                                "valorImpuesto" => $valorImpuesto = $values["valorImpuesto"],
                                "numeroRetiro" => $numeroRetiro = $values["numeroRetiro"],
                                "numeroIngreso" => $numeroIngreso = $values["numeroIngreso"],
                                "fecha" => $fecha = $values["fecha"],
                                "nombres" => $nombres = $values["nombres"],
                                "apellidos" => $apellidos = $values["apellidos"],
                                "identificaRet" => $identificaRet = $values["identificaRet"]);
                            array_push($dataArray, $data);
                       
                    }
             
                return $dataArray;
            } else {
                return "SD";
            }
        }
    }
    public static function mdlListarRetPendientesGeneral($tipo) {
        $dataArray = [];
        $conn = Conexion::Conectar();
        
        $params = array(&$tipo);
        $sql = "EXECUTE spRetirosPendGeneral ?";
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
            if (!empty($results)) {
                foreach ($results as $key => $values) {
                    $resultsData = [];
                    $idIngreso = $values["idIngOp"];
                    $identificaRet = $values["identificaRet"];

                    $params = array(&$idIngreso, &$identificaRet);

                            $data = array(
                                "nitIngreso" => $nitIngreso = $values["nitIngreso"],
                                "nitRet" => $nitRet = $values["nitRet"],
                                "numNit" => $numNit = $values["numNit"],
                                "empresa" => $empresa = $values["empresa"],
                                "numPolIng" => $numPolIng = $values["numPolIng"],
                                "polRet" => $polRet = $values["polRet"],
                                "pesoRet" => $pesoRet = $values["pesoRet"],
                                "bultosRet" => $bultosRet = $values["bultosRet"],
                                "tipoServicio" => $tipoServicio = $values["tipoServicio"],
                                "numId" => $numId = $values["numId"],
                                "identRet" => $identRet = $values["identRet"],
                                "idIngOp" => $idIngOp = $values["idIngOp"],
                                "valorEstadoRet" => $valorEstadoRet = $values["valorEstadoRet"],
                                "totalValorCif" => $totalValorCif = $values["totalValorCif"],
                                "valorImpuesto" => $valorImpuesto = $values["valorImpuesto"],
                                "numeroRetiro" => $numeroRetiro = $values["numeroRetiro"],
                                "numeroIngreso" => $numeroIngreso = $values["numeroIngreso"],
                                "fecha" => $fecha = $values["fecha"],
                                "nombres" => $nombres = $values["nombres"],
                                "apellidos" => $apellidos = $values["apellidos"],
                                "identificaRet" => $identificaRet = $values["identificaRet"]);
                            array_push($dataArray, $data);
                       
                    }
             
                return $dataArray;
            } else {
                return "SD";
            }
        }
    }
        public static function  mdlListarRetPendientesHistorial($ident) {
        $dataArray = [];
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spRetirosHistorial";
        $stmt = sqlsrv_prepare($conn, $sql);
        if (sqlsrv_execute($stmt) == true) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
            if (!empty($results)) {
                $data = [];
                foreach ($results as $keys => $values) {
                    $tipo = 0;
                    if ($keys>0) {
                        foreach ($data as $keyD => $valueD) {
                            if ($values["polRet"]==$valueD["polRet"]) {
                                $tipo = $tipo+1;
                            } 
                        }
                    }
                    if ($tipo==0) {
                        array_push($data, $values);
                    }
                }

                 
                return $data;
            } else {
                return "SD";
            }
        }
    }

    public static function mdlContabilizarRetiro($idRetContabilidad, $tipo, $usuarioOp, $fechaRetContabi) {
        $FormatConta = date("Y-m-d H:i:s", strtotime($fechaRetContabi));
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spContaRetiro ?, ?, ?, ?";
        $params = array(&$idRetContabilidad, &$tipo, &$usuarioOp, &$FormatConta);
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

    public static function mdlMostrarReporteConta($sp, $tipoOp, $reportContaIdent) {
        $conn = Conexion::Conectar();
        $sql = 'EXECUTE ' . $sp . ' ?, ?';
        $params = array(&$tipoOp, &$reportContaIdent);
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

    public static function mdlMstrAjustesContables($sp, $reportContaIdent) {
        $conn = Conexion::Conectar();
        $sql = 'EXECUTE ' . $sp . ' ?';
        $params = $reportContaIdent;

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
    public static function mdlMstrReporteRet($sp, $reportContaIdent) {
        $conn = Conexion::Conectar();
        $sql = 'EXECUTE ' . $sp . ' ?';
        $params = array(&$reportContaIdent);
        
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
    public static function mdlListarRetContabilizados($sp, $tipo, $ident, $fecha) {
        $dataArray = [];
        $conn = Conexion::Conectar();
        $params = array(&$tipo, &$ident, &$fecha);
        $sql = "EXECUTE " . $sp . " ?, ?, ?";
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
            
            if (!empty($results)) {
                foreach ($results as $key => $values) {
                    $resultsData = [];
                    $idIngreso = $values["idIngOp"];
                    $identificaRet = $values["identificaRet"];

                    $params = array(&$idIngreso, &$identificaRet);

                    $sql = "EXECUTE spVerificaTarifa ?, ?";
                    $stmt = sqlsrv_prepare($conn, $sql, $params);
                    if (sqlsrv_execute($stmt) == true) {
                        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                            $resultsData[] = $row;
                        }
                        if (!empty($resultsData)) {
                            $data = array(
                                "nitIngreso" => $nitIngreso = $values["nitIngreso"],
                                "nitRet" => $nitRet = $values["nitRet"],
                                "numNit" => $numNit = $values["numNit"],
                                "empresa" => $empresa = $values["empresa"],
                                "numPolIng" => $numPolIng = $values["numPolIng"],
                                "polRet" => $polRet = $values["polRet"],
                                "pesoRet" => $pesoRet = $values["pesoRet"],
                                "bultosRet" => $bultosRet = $values["bultosRet"],
                                "tipoServicio" => $tipoServicio = $values["tipoServicio"],
                                "numId" => $numId = $values["numId"],
                                "identRet" => $identRet = $values["identRet"],
                                "idIngOp" => $idIngOp = $values["idIngOp"],
                                "valorEstadoRet" => $valorEstadoRet = $values["valorEstadoRet"],
                                "tarifaEspecial" => $tarifaEspecial = $resultsData[0]["tarifaEspecial"],
                                "estadoTarifa" => $estadoTarifa = $resultsData[0]["estadoTarifa"],
                                "tarifaNormal" => $tarifaNormal = $resultsData[0]["tarifaNormal"],
                                "retAsignado" => $retAsignado = $resultsData[0]["retAsignado"],
                                "reciboAsignado" => $reciboAsignado = $resultsData[0]["reciboAsignado"],
                                "estadoRet" => $estadoRet = $resultsData[0]["estadoRet"],
                                "inicioCorrelativo" => $inicioCorrelativo = $resultsData[0]["inicioCorrelativo"],
                                "totalValorCif" => $totalValorCif = $values["totalValorCif"],
                                "valorImpuesto" => $valorImpuesto = $values["valorImpuesto"],
                                "numeroRetiro" => $numeroRetiro = $values["numeroRetiro"],
                                "numeroIngreso" => $numeroIngreso = $values["numeroIngreso"],
                                "fecha" => $fecha = $values["fecha"],
                                "nombres" => $nombres = $values["nombres"],
                                "apellidos" => $apellidos = $values["apellidos"],
                                "identificaRet" => $identificaRet = $values["identificaRet"],
                                "aplica" => $aplica = $resultsData[0]["aplica"]);
                            array_push($dataArray, $data);
                        }
                    }
                }
                return $dataArray;
            } else {
                return "SD";
            }
        }
    }

}
