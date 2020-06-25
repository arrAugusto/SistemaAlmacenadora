<?php

require_once "cone.php";

class ModeloCalculos {

    public static function mdlFacturacion($valor) {

        $conn = Conexion::Conectar();
        $params = array(&$valor);
        $sql = "EXECUTE spHisIng ?";
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

    public static function mdlMostrarSinCobro($valor) {
        $conn = Conexion::Conectar();
        $params = array(&$valor);
        $sql = "EXECUTE spHisIng ?";
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

    public static function mdlMostrarDatosIngreso($buttonidingreso) {
        // metodo para saber si tiene cobros realizados o si nunca se realizo un cobro al cliente
        $verificacionSaldo = verificaciones::verificacionSaldoIngreso($buttonidingreso);
                            $resultsSaldosR = [];

        $conCortes = 0;
        if ($verificacionSaldo == "ReciboSinRetConCorte" || $verificacionSaldo == "calculoConRet") {
            $verificacionSaldo = array("estado" => "procesar");
            $conCortes = 1;
        }

        

        if ($verificacionSaldo["estado"] == "procesar") {
            $respuestaTarifa = TarifaCalculo::mostrarTarifa($buttonidingreso);
            if ($respuestaTarifa != "SD") {
                $idTarifa = $respuestaTarifa[0]["identy"];
                $respuestaManejo = TarifaCalculo::mostrarTarifaManejo($idTarifa);
                $respuestaSeguro = TarifaCalculo::mostrarTarifaSeguro($idTarifa);
                $respuestaGstsAdmin = TarifaCalculo::mostrarTarifaGtsAdmin($idTarifa);
                $AutoirzarCalculo = 0;
                /**
                 * CUANDO APLICA CORTE
                 * **/

                   

                $conn = Conexion::Conectar();
                $params = array(&$buttonidingreso);
                $sql = "EXECUTE spMstIngCobro ?";
                $stmt = sqlsrv_prepare($conn, $sql, $params);
                if (sqlsrv_execute($stmt) == true) {
                    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                        $results[] = $row;
                    }
                    if (!empty($results)) {
                        $sql = "EXECUTE spMstrSldF ?";
                        $stmt = sqlsrv_prepare($conn, $sql, $params);
                        if (sqlsrv_execute($stmt) == true) {
                            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                                $resultsSaldos[] = $row;
                            }
                 
                            if (!empty($resultsSaldos)) {
                                $resultsSaldosRs = [];
                                $sql = "EXECUTE spMstrSldFR ?";
                                $stmt = sqlsrv_prepare($conn, $sql, $params);
                                if (sqlsrv_execute($stmt) == true) {
                                    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                                        $resultsSaldosRs[] = $row;
                                    }

                                    if (!empty($resultsSaldosRs)) {
                          
                                        $valPosSalidaEdit = 0;
                                        $valMtsSalidaEdit = 0;
                                        foreach ($resultsSaldosRs as $key => $value) {
                                            $detallesRebajados = json_decode($value["detallesRebajados"], true);
                                            foreach ($detallesRebajados as $key => $values) {
                                                $valPosSalidaEdit = $values["valPosSalidaEdit"];
                                                $valMtsSalidaEdit = $values["valMtsSalidaEdit"];
                                            }
                                            $nuevoLista = array("fechaRetiro" => $value["fechaRetiro"], "cif" => $value["cif"],
                                                "impuesto" => $value["impuesto"]
                                                , "aduana" => $value["aduana"], "pos" => $valPosSalidaEdit, "mts" => $valMtsSalidaEdit, "blts" => $value["blts"]);
                                            array_push($resultsSaldosR, $nuevoLista);
                                        }
                                    }else{
                                       $AutoirzarCalculo = 2; 
                                    }
                                    $arraySaldos = array();
                                    if (!empty($resultsSaldosR)) {
                                        if (count($resultsSaldosR) >= 2) {
                                            date_default_timezone_set('America/Guatemala');
                                            $time = date('Y-m-d');
                                            /* ==================================================
                                              EVENTO CUANDO NO EXISTEN RETIROS EN SALDOS
                                              EL MISMO DIA DEL INGRESO => GENERACION DE SALDOS
                                              =================================================== */
                                            foreach ($resultsSaldosR as $key => $value) {

                                                if ($key == 0) {
                                                    $saldosCobro = array(
                                                        "saldoBultos" => round($saldoBultos = $resultsSaldos[0]["bultos"] - ($value["blts"]), 0),
                                                        "saldoPos" => round($saldoPos = $resultsSaldos[0]["posicion"] - ($value["pos"]), 0),
                                                        "saldoMetros" => round($saldoMetros = $resultsSaldos[0]["metros"] - ($value["mts"]), 2),
                                                        "saldoValAduana" => round($saldoValAduana = $resultsSaldos[0]["valorTotalAduana"] - ($value["aduana"]), 2),
                                                        "saldoCif" => round($saldoCif = $resultsSaldos[0]["totalValorCif"] - ($value["cif"]), 2),
                                                        "saldoImpuesto" => round($saldoImpuesto = $resultsSaldos[0]["valorImpuesto"] - ($value["impuesto"]), 2),
                                                        "saldoFechaSig" => $saldoFechaSig = $resultsSaldosR[0]["fechaRetiro"]
                                                    );
                                                    array_push($arraySaldos, $saldosCobro);
                                                } else if ($key >= 1) {
                                                    $saldosCobro = array(
                                                        "saldoBultos" => round($arraySaldos[$key - 1]["saldoBultos"] - $resultsSaldosR[$key]["blts"], 0),
                                                        "saldoPos" => round($arraySaldos[$key - 1]["saldoPos"] - $resultsSaldosR[$key]["pos"], 0),
                                                        "saldoMetros" => round($arraySaldos[$key - 1]["saldoMetros"] - $resultsSaldosR[$key]["mts"], 2),
                                                        "saldoValAduana" => round($arraySaldos[$key - 1]["saldoValAduana"] - $resultsSaldosR[$key]["aduana"], 2),
                                                        "saldoCif" => round($arraySaldos[$key - 1]["saldoCif"] - $resultsSaldosR[$key]["cif"], 2),
                                                        "saldoImpuesto" => round($arraySaldos[$key - 1]["saldoImpuesto"] - $resultsSaldosR[$key]["impuesto"], 2),
                                                        "saldoFechaSig" => $resultsSaldosR[$key]["fechaRetiro"]);
                                                    array_push($arraySaldos, $saldosCobro);
                                                }
                                            }

                                            $AutoirzarCalculo = 1;
                                        } else if (count($resultsSaldosR) == 1) {
                                            foreach ($resultsSaldosR as $key => $value) {
                                                $contador = 0;
                                                date_default_timezone_set('America/Guatemala');
                                                $time = date('Y-m-d');
                                                if ($value["fechaRetiro"] == $time) {
                                                    $contador = $contador + 1;
                                                }
                                            }

                                            if ($contador == count($resultsSaldosR)) {
                                                $AutoirzarCalculo = 2;
                                            } else {


                                                $saldosCobro = array(
                                                    "saldoBultos" => round($saldoBultos = $resultsSaldos[0]["bultos"] - ($resultsSaldosR[0]["blts"]), 0),
                                                    "saldoPos" => round($saldoPos = $resultsSaldos[0]["posicion"] - ($resultsSaldosR[0]["pos"]), 0),
                                                    "saldoMetros" => round($saldoMetros = $resultsSaldos[0]["metros"] - ($resultsSaldosR[0]["mts"]), 2),
                                                    "saldoValAduana" => round($saldoValAduana = $resultsSaldos[0]["valorTotalAduana"] - ($resultsSaldosR[0]["aduana"]), 2),
                                                    "saldoCif" => round($saldoCif = $resultsSaldos[0]["totalValorCif"] - ($resultsSaldosR[0]["cif"]), 2),
                                                    "saldoImpuesto" => round($saldoImpuesto = $resultsSaldos[0]["valorImpuesto"] - ($resultsSaldosR[0]["impuesto"]), 2),
                                                    "saldoFechaSig" => $saldoFechaSig = $resultsSaldosR[0]["fechaRetiro"]
                                                );
                                                array_push($arraySaldos, $saldosCobro);
                                                $AutoirzarCalculo = 3;
                                            }
                                        }
                                    } else {
                                        $AutoirzarCalculo = 2;
                                    }
                                } else {
                                    return "SD";
                                }
                            } else {
                                return sqlsrv_errors();
                            }
                        } else {
                            return sqlsrv_errors();
                        }
                    } else {
                        return sqlsrv_errors();
                    }


                    if ($conCortes == 1) {
                
                        $respuesta = verificaciones::mdlVerCorteDeAlmacenaje($buttonidingreso);
                        $fechaInicialCorte = $respuesta[0]["fechaRetiro"];
                        $fechaInicialCorte = date("d-m-Y", strtotime($fechaInicialCorte));
                        if ($fechaInicialCorte != date('d-m-Y')) {
             
                            $arraySaldos = 0;
                            $resCalSaldoDiarioBaseDiaria = calculosAlmacenFiscal::calculoSaldoDiarioBaseDiaria($resultsSaldos, $arraySaldos, $respuestaTarifa, $respuestaManejo, $respuestaSeguro, $respuestaGstsAdmin, $resultsSaldosR);
                            
                            $respuestaConCorte = calculosAlmacenFiscal::calculoConCorteFacturado($resCalSaldoDiarioBaseDiaria, $fechaInicialCorte, $buttonidingreso);
                            return array("results" => $results, "resCalSaldoDiarioBaseDiaria" => $resCalSaldoDiarioBaseDiaria, "resultsSaldosR" => $resultsSaldosR, "corteCobrado" => $fechaInicialCorte, "tipo" => "factCorteCobro", "cortes" => $respuestaConCorte);
                        } else {
                            return "reciboCobradoHoy";
                        }
                    }

                    if ($AutoirzarCalculo == 1) {
                        if ($respuestaTarifa[0]["base"] == "Posiciones" && $respuestaTarifa[0]["calculoSobre"] == "Saldo Diario" && $respuestaTarifa[0]["periodoCalculo"] == "Diario") {
                            /* array definitivos mostrados al cliente */
                            $resCalSaldoDiarioBaseDiaria = calculosAlmacenFiscal::calculoSaldoDiarioBaseDiaria($resultsSaldos, $arraySaldos, $respuestaTarifa, $respuestaManejo, $respuestaSeguro, $respuestaGstsAdmin, $resultsSaldosR);

                            if ($verificacionSaldo["estadoCorte"] === "sinCorte") {
                                return array("results" => $results, "resCalSaldoDiarioBaseDiaria" => $resCalSaldoDiarioBaseDiaria, "resultsSaldosR" => $resultsSaldosR, "tipo" => "noFacturado");
                            } else {

                                $data = $verificacionSaldo["resultsData"];
                                $respuestaCorteRecibos = funcionCortes::cortesArraySaldos($data, $resCalSaldoDiarioBaseDiaria);
                                return $respuestaCorteRecibos;
                            }
                        } else {
                            return "otroTarifa";
                        }
                    } 
                    if ($AutoirzarCalculo == 2) {
 
                        $arraySaldos = 0;
                        /* array definitivos mostrados al cliente */
                        if ($verificacionSaldo["estadoCorte"] == "sinCorte") {

                            $resCalSaldoDiarioBaseDiaria = calculosAlmacenFiscal::calculoSaldoDiarioBaseDiaria($resultsSaldos, $arraySaldos, $respuestaTarifa, $respuestaManejo, $respuestaSeguro, $respuestaGstsAdmin, $resultsSaldosR);
                            return array("results" => $results, "resCalSaldoDiarioBaseDiaria" => $resCalSaldoDiarioBaseDiaria, "tipo" => "noFacturado");
                        } else {
                            return "concorte";
                        }
                    } 
                    if ($AutoirzarCalculo == 3) {
                        /* array definitivos mostrados al cliente */

                        $resCalSaldoDiarioBaseDiaria = calculosAlmacenFiscal::calculoSaldoDiarioBaseDiaria($resultsSaldos, $arraySaldos, $respuestaTarifa, $respuestaManejo, $respuestaSeguro, $respuestaGstsAdmin, $resultsSaldosR);
                        if ($verificacionSaldo["estadoCorte"] === "sinCorte" || $verificacionSaldo["estadoCorte"] === 1) {
                            return array("results" => $results, "resCalSaldoDiarioBaseDiaria" => $resCalSaldoDiarioBaseDiaria, "resultsSaldosR" => $resultsSaldosR, "tipo" => "noFacturado");
                        } else {
                            return "concorte";
                        }
                    }
                }
            } else {
                return "ST";
            }
        } else {
            return "dsf";
        }
    }

    public static function mdlMostrarNit($resultIdIngreso) {

        $conn = Conexion::Conectar();
        $params = array(&$resultIdIngreso);
        $sql = "EXECUTE spNitIngO ?";
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

    public static function mdlGuardarReciboAlmacenaje($hiddenresultIdIngreso) {
        $conn = Conexion::Conectar();
        $estado = 1;
        date_default_timezone_set('America/Guatemala');
        $time = date('Y-m-d H:i:s');
        $params = array(&$hiddenresultIdIngreso, &$estado, &$time);
        $sql = "EXECUTE spRegRecibo ?, ?, ?";
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
            if (!empty($results)) {
                $numeroRecibo = $results[0]["Identity"];
                $params = array(&$numeroRecibo);
                $sql = "EXECUTE spNumRecibo ?";
                $stmt = sqlsrv_prepare($conn, $sql, $params);
                if (sqlsrv_execute($stmt) == true) {
                    return "Ok";
                } else {
                    return sqlsrv_errors();
                }
            } else {
                return "SD";
            }
        } else {
            return sqlsrv_errors();
        }
    }

    public static function mdlMostrarEjecutivoCredito($ejecutivoCredito) {
        $conn = Conexion::Conectar();
        $params = array(&$ejecutivoCredito);
        $sql = "EXECUTE spEjecutivoCredito ?";
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
            if (!empty($results)) {
                return $results;
            } else {
                return "sinEjecutivo";
            }
        }
    }

    public static function mdlRevisarCobrosAnteriores($idIngAlmacenajeF) {

        $conn = Conexion::Conectar();
        $params = array(&$idIngAlmacenajeF);
        $sql = "EXECUTE spCobrosFiscalRev ?";
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

    public static function mdlCobroAlmacenajes($identRegistroCobro, $idIngAlmacenajeF, $almacenajeCalado, $fechaCobro) {
        $conn = Conexion::Conectar();
        $params = array(&$identRegistroCobro, &$idIngAlmacenajeF, &$almacenajeCalado, &$fechaCobro);
        $sql = "EXECUTE spGdAlmacenaje ?, ?, ?, ?";
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            return true;
        } else {
            return false;
        }
    }

    public static function mdlCobroManejos($identRegistroCobro, $idIngAlmacenajeF, $manejo) {
        $conn = Conexion::Conectar();
        $params = array(&$identRegistroCobro, &$idIngAlmacenajeF, &$manejo);
        $sql = "EXECUTE spCobroManejos ?, ?, ?";
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            return true;
        } else {
            return sqlsrv_errors();
        }
    }

    public static function mdlCobroSeguro($identRegistroCobro, $idIngAlmacenajeF, $seguro) {
        $conn = Conexion::Conectar();
        $params = array(&$identRegistroCobro, &$idIngAlmacenajeF, &$seguro);
        $sql = "EXECUTE spCobroSeguro ?, ?, ?";
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            return true;
        } else {
            return sqlsrv_errors();
        }
    }

    public static function mdlCobroTransElectronica($identRegistroCobro, $idIngAlmacenajeF, $transElectronica) {
        $conn = Conexion::Conectar();
        $params = array(&$identRegistroCobro, &$idIngAlmacenajeF, &$transElectronica);
        $sql = "EXECUTE spTElectronica ?, ?, ?";
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            return true;
        } else {
            return sqlsrv_errors();
        }
    }

    public static function mdlAlmacenajeRegistro($idIngAlmacenajeF, $fechaInicio, $fechaCobro) {
        $conn = Conexion::Conectar();
        $params = array(&$idIngAlmacenajeF, &$fechaInicio, &$fechaCobro);
        $sql = "EXECUTE spRegistroCobroFiscal ?, ?, ?";
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
            return false;
        }
    }

}
