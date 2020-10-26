<?php

require_once "cone.php";

class ModeloRetiroOpe {

    public static function mdlMostrarNitRetiro($txtNitSalida) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spNitRetiro ?";
        $params = array(&$txtNitSalida);
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

    public static function mdlUpdateUnParam($parametro, $idRet, $sp) {

        $conn = Conexion::Conectar();
        $sql = "EXECUTE " . $sp . " ?, ?";
        $params = array(&$parametro, $idRet);
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            return true;
        } else {
            return sqlsrv_errors();
        }
    }
    public static function mdlInsertRetPolizaRetDR($poliza, $idRet, $bltsSumFinal, $valDolSumFinal, $cifFinal, $impuestoFinal, $sp) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE ".$sp." ?, ?, ?, ?, ?, ?";
        $params = array(&$poliza, &$idRet, &$bltsSumFinal, &$valDolSumFinal, &$cifFinal, &$impuestoFinal);
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
    public static function mdlMostrarBusqueda($datoSearch) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spNitSalida ?";
        $params = array(&$datoSearch);
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

    public static function mdlUpdateParam($parametro, $sp) {

        $conn = Conexion::Conectar();
        $sql = "EXECUTE " . $sp . " ?";
        $params = array(&$parametro);
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            return true;
        } else {
            return sqlsrv_errors();
        }
    }

    public static function mdlDetUnParametro($idBod, $sp) {

        $conn = Conexion::Conectar();
        $sql = "EXECUTE " . $sp . " ?";
        $params = array(&$idBod);
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

    public static function mdlInsertRetiroOpe($datos) {
        $conn = Conexion::Conectar();
        $fechaCorte = $datos['hiddenDateTime'];
        $nuevafecha = strtotime('+1 day', strtotime($fechaCorte));
        $nuevafecha = date('Y-m-d H:i:s', $nuevafecha);
        date_default_timezone_set('America/Guatemala');
        $time = date('Y-m-d H:i:s');
        $estadoRet = 1;
        if ($datos['tipoIng'] == "vehUs") {
            $tipo = 1;
        } else {
            $tipo = 0;
        }
        $paramsDet = array(
            &$datos['hiddeniddeingreso'],
            &$datos['idNit'],
            &$datos['polizaRetiro'],
            &$datos['regimen'],
            &$datos['descMercaderia'],
            &$datos['hiddenIdUs'],
            &$datos['hiddenIdBod'],
            &$estadoRet,
            &$datos['listaDetalles'],
            &$datos['hiddenDateTime'],
            &$datos['cantBultos'],
            &$datos['pesoKg'],
            &$datos['tipoCambio'],
            &$datos['valorTotalAduana'],
            &$datos['valorCif'],
            &$datos['calculoValorImpuesto'],
            &$datos['licencia'],
            &$datos['piloto'],
            &$datos['placa'],
            &$datos['contenedor'],
            &$datos['usuarioOp'],
            &$tipo
        );

        $sqlDet = "EXECUTE spInsRetiro  ?,	?,	?,	?,	?,	?,	?,	?,	?,	?,	?,	?,	?,	?,	?,	?,	?,	?,	?,	?,	?,	?";
        $stmt = sqlsrv_prepare($conn, $sqlDet, $paramsDet);
        if (sqlsrv_execute($stmt) == true) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
            if (!empty($results)) {
                $valIdRetiro = $results[0]['Identity'];
                return array("exito" => "exito", "valIdRetiro" => $valIdRetiro);
            } else {
                return "SD";
            }
        } else {
            return sqlsrv_errors();
        }
    }

    public static function mdlMostrarSelectDetOpe($idIngSelectDet) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spSelectDetRet ?";
        $params = array(&$idIngSelectDet);
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

    
    public static function mdlMostrarSaldosConta($idIngOpDet) {

        $conn = Conexion::Conectar();
        $sql = "EXECUTE spSaldosRet ?";
        $params = array(&$idIngOpDet);

        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
            if (!empty($results)) {
                $sql = "EXECUTE spTotalBlts ?";
                $stmt = sqlsrv_prepare($conn, $sql, $params);
                if (sqlsrv_execute($stmt) == true) {
                    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                        $resultsTblts[] = $row;
                    }
                    if (!empty($resultsTblts)) {
                        $sql = "EXECUTE spTotalIng ?";
                        $stmt = sqlsrv_prepare($conn, $sql, $params);
                        if (sqlsrv_execute($stmt) == true) {
                            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                                $resultsTIng[] = $row;
                            }
                            if (!empty($resultsTIng)) {
                                $sldCif = $resultsTIng[0]["totalValorCif"] - $resultsTblts[0]["sumaCif"];
                                $sldBultos = $resultsTIng[0]["bultos"] - $resultsTblts[0]["sumaBultos"];
                                $sldImpuesto = $resultsTIng[0]["valorImpuesto"] - $resultsTblts[0]["sumaImpts"];
                                $saldos = array("sldBultos" => $sldBultos, "sldCif" => $sldCif, "sldImpuesto" => $sldImpuesto);
                                if ($sldBultos >= 1) {
                                    return array("resHistorial" => $results, "sumRet" => $resultsTblts, "sumIng" => $resultsTIng, "saldos" => $saldos);
                                } else {
                                    return "SD";
                                }
                            } else {
                                return "SD";
                            }
                        } else {
                            sqlsrv_errors();
                        }
                    } else {
                        return "SD";
                    }
                } else {
                    return sqlsrv_errors();
                }
            } else {
                return "sinRet";
            }
        } else {
            return sqlsrv_errors();
        }
    }

    public static function mdlVerificacionStock($idIngSelectDet) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spVerificacion ?";
        $params = array(&$idIngSelectDet);
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
    public static function mdlRetiroVehN($retiroVehN, $estado, $asignar, $usuarioOp, $sp) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE ".$sp." ?, ?, ?, ?";
        $params = array(&$retiroVehN, &$estado, &$asignar, &$usuarioOp);
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
    public static function mdlConsultarDetalle($idOpDetTraer) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spDetalleStock ?";
        $params = array(&$idOpDetTraer);
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

    public static function mdlNuevoStock($idDetalle, $cantBultos) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spNuevoSaldoDetalle ?, ?";
        $params = array(&$idDetalle, &$cantBultos);
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

    public static function mdlActualizarStockGeneral($idIngreso) {
        $conn = Conexion::Conectar();
        $sql = 'EXECUTE spStockGeneral ?';
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
        } else {
            return "error";
        }
    }

    public static function mdlEditarRetiroOpF($datos, $idRetiroBtn, $tipo) {
        $conn = Conexion::Conectar();
        if ($tipo == 1) {
            $paramsDet = array(
                &$datos['hiddeniddeingresoEdit'],
                &$datos['idNitEdit'],
                &$datos['polizaRetiroEdit'],
                &$datos['regimenEdit'],
                &$datos['descMercaderiaEdit'],
                &$datos['listaDetallesEdit'],
                &$datos['hiddenDateTimeEdit'],
                &$idRetiroBtn
            );
            $sqlDet = "EXECUTE spEditRetiros  ?,	?,	?,	?,	?,	?,	?,	?";

            $stmt = sqlsrv_prepare($conn, $sqlDet, $paramsDet);
        } else {

            $paramsDet = array(
                &$datos['hiddeniddeingresoVEd'],
                &$datos['idNitVEd'],
                &$datos['polizaRetiroVEd'],
                &$datos['regimenVEd'],
                &$datos['descMercaderiaVEd'],
                &$datos['hiddenDateTimeEdit'],
                &$idRetiroBtn
            );
            $sqlDet = "EXECUTE spEditRetirosVehEd  ?,	?,	?,	?,	?,	?,	?";

            $stmt = sqlsrv_prepare($conn, $sqlDet, $paramsDet);
        }

        if (sqlsrv_execute($stmt) == true) {
            if ($tipo == 1) {


                $paramsBlts = array(
                    &$datos['hiddeniddeingresoEdit'],
                    &$idRetiroBtn,
                    &$datos['cantBultosEdit'],
                    &$datos['pesoKgEdit'],
                    &$datos['tipoCambioEdit'],
                    &$datos['valorTotalAduanaEdit'],
                    &$datos['valorCifEdit'],
                    &$datos['calculoValorImpuestoEdit']
                );
            } else {

                $paramsBlts = array(
                    &$datos['hiddeniddeingresoVEd'],
                    &$idRetiroBtn,
                    &$datos['cantBultosVEd'],
                    &$datos['pesoKgVEd'],
                    &$datos['tipoCambioVEd'],
                    &$datos['valorTotalAduanaVEd'],
                    &$datos['valorCifVEd'],
                    &$datos['calculoValorImpuestoVEd']
                );
            }
            $sqlBlts = "EXECUTE spEdicionValRet  ?,	?,  ?,  ?,  ?,  ?,  ?,  ?";

            $stmt = sqlsrv_prepare($conn, $sqlBlts, $paramsBlts);
            if (sqlsrv_execute($stmt) == true) {
                return "Editado";
            } else {
                return sqlsrv_errors();
            }
        } else {
            return sqlsrv_errors();
        }
    }

    public static function mdlModificacionDetalles($idDetalle, $sp) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE " . $sp . " ?";
        $params = array(&$idDetalle);
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

    public static function mdlModificacionDetallesDosParams($idDetalle, $nuevoDato, $sp) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE " . $sp . " ?, ?";
        $params = array(&$idDetalle, &$nuevoDato);
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

    public static function mdlModificacionDetallesTresParams($retiroF, $tipo, $estadoVerPlt, $sp) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE " . $sp . " ?, ?, ?";
        $params = array(&$retiroF, &$tipo, &$estadoVerPlt);
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

    public static function mdlModificacionDetallesCuatroParams($idoperacion, $usuarioOp, $motivoAnula, $idtrans, $sp) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE " . $sp . " ?, ?, ?, ?";
        $params = array(&$idoperacion, &$usuarioOp, &$motivoAnula, &$idtrans);
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

    public static function ctrGuardarDataRet($datos) {

        $conn = Conexion::Conectar();
        //Valores retiros para historial de retiros fiscales
        $estadoRet = 1;

        $paramsDet = array(
            &$datos['hiddeniddeingresoVeh'],
            &$datos['idNitVeh'],
            &$datos['polizaRetiroVeh'],
            &$datos['regimenVeh'],
            &$datos['descMercaderiaVeh'],
            &$datos['hiddenIdUsVeh'],
            &$datos['hiddenIdBodVeh'],
            &$estadoRet,
            &$datos['hiddenDateTimeVeh'],
            &$datos['cantBultosVeh'],
            &$datos['pesoKgVeh'],
            &$datos['tipoCambioVeh'],
            &$datos['valorTotalAduanaVeh'],
            &$datos['valorCifVeh'],
            &$datos['calculoValorImpuestoVeh'],
        );
        $sqlDet = "EXECUTE spInsRetiroVeh  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?";
        $stmt = sqlsrv_prepare($conn, $sqlDet, $paramsDet);
        if (sqlsrv_execute($stmt) == true) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }

            if (!empty($results)) {
                $valIdRetiro = $results[0]['Identity'];
                return $valIdRetiro;
            } else {
                return "SD";
            }
        } else {
            return sqlsrv_errors();
        }
    }

    public static function mdlEditarPilotoUn($licEdit, $nombreEdit, $numeroPlacaEdit, $numeroContEdit, $numeroMarchEdit, $hiddenIdentEdit, $hiddenTipEdit, $identiUnidad, $sp) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE " . $sp . " ?, ?, ?, ?, ?, ?, ?, ?";
        $params = array(&$licEdit, &$nombreEdit, &$numeroPlacaEdit, &$numeroContEdit, &$numeroMarchEdit, &$hiddenIdentEdit, &$hiddenTipEdit, &$identiUnidad);
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
