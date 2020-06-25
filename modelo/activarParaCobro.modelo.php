<?php

//Conexion DB
require_once "cone.php";

//======================================================================
// La siguiente clase ModeloActivarParaCobros(), es necesaria para hacer
// CRUD en DB para el modulo de tarifas
// 
//  sqlsrv_free_stmt($stmt); liberación de variables
//  sqlsrv_close($conn); liberación de conexión
//  
//======================================================================

class ModeloActivarParaCobros {

    //Activar Tarifa para cobros de almacanajes
    public static function mdlActivarParaCobro($valor) {
        
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spSEjecutivo ?";
        $params = array(&$valor);
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
            return "Internal_Server_500";
        }
        sqlsrv_free_stmt($stmt);
        sqlsrv_close($conn);
    }

//Muestra parametros de tarifa
    public static function mdlMostrarParametro($valor) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spMstPara ?";
        $params = array(&$valor);
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
            return "Internal_Server_500";
        }
        sqlsrv_free_stmt($stmt);
        sqlsrv_close($conn);
    }

    //Mostrar servicios parametrizados
    public static function mdlMostarServicios($valor) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spMostrarServicios3 ?";
        $params = array(&$valor);
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
            return "Internal_Server_500";
        }
        sqlsrv_free_stmt($stmt);
        sqlsrv_close($conn);
    }

    //Activar servicios parametrizados para tarifa buscada
    public static function mdlActivarServicios($idCliente, $numeroSerie, $idParaActivar) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spActivacion ?, ?, ?";
        $params = array(&$idParaActivar, &$idCliente, &$numeroSerie);
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            return "EXITO";
        } else {
            return "Internal_Server_500";
        }
        sqlsrv_free_stmt($stmt);
        sqlsrv_close($conn);
    }

    //Modificar tarifa seleccionada
    public static function mdlNuevaSerie($serieTarifa, $numeroCliente) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spNuevaSerie0 ?, ?";
        $params = array(&$serieTarifa, &$numeroCliente);
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            return "exitos";
        } else {
            return "Internal_Server_500";
        }
        sqlsrv_free_stmt($stmt);
        sqlsrv_close($conn);
    }

    //Mostar cada uno de los servicios configurados de una tarifa
    public static function mdlMostrarServiciosIndividual($idServicioCliente, $Tabla) {
        $conn = Conexion::Conectar();
        if ($Tabla == "ALMACENAJES") {
            $sql = "EXECUTE spMstAlmacenaje ?";
            $params = array(&$idServicioCliente);
            $stmt = sqlsrv_prepare($conn, $sql, $params);
        }
        if (sqlsrv_execute($stmt) == true) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
            return $results;
        } else {
            return "Internal_Server_500";
        }
        sqlsrv_free_stmt($stmt);
        sqlsrv_close($conn);
    }

    //Modificaciones por cada uno de los servicios configurados
    public static function mdlServiciosIndividuales($numeroServicio, $numeroId, $servicioId) {
        $conn = Conexion::Conectar();
        if ($numeroServicio == 1) {
            $sql = "EXECUTE spUpdateCalculoSobre ?, ?";
            $params = array(&$servicioId, &$numeroId);
            $stmt = sqlsrv_prepare($conn, $sql, $params);
            if (sqlsrv_execute($stmt) == true) {
                return "ok";
            } else {
                return "Internal_Server_500";
            }
        }
        if ($numeroServicio == 2) {
            $sql = "EXECUTE spUpdateBaseCalculo ?, ?";
            $params = array(&$servicioId, &$numeroId);
            $stmt = sqlsrv_prepare($conn, $sql, $params);
            if (sqlsrv_execute($stmt) == true) {
                return "ok";
            } else {
                return "Internal_Server_500";
            }
        }
        if ($numeroServicio == 3) {
            $sql = "EXECUTE spUpdatePeriodoCalculo ?, ?";
            $params = array(&$servicioId, &$numeroId);
            $stmt = sqlsrv_prepare($conn, $sql, $params);
            if (sqlsrv_execute($stmt) == true) {
                return "ok";
            } else {
                return "Internal_Server_500";
            }
        }

        if ($numeroServicio == 4) {
            $sql = "EXECUTE spUpdateMoneda ?, ?";
            $params = array(&$servicioId, &$numeroId);
            $stmt = sqlsrv_prepare($conn, $sql, $params);
            if (sqlsrv_execute($stmt) == true) {
                return "ok";
            } else {
                return "Internal_Server_500";
            }
        }
        if ($numeroServicio == 5) {
            $sql = "EXECUTE spUpdateValor ?, ?";
            $params = array(&$servicioId, &$numeroId);
            $stmt = sqlsrv_prepare($conn, $sql, $params);
            if (sqlsrv_execute($stmt) == true) {
                return "ok";
            } else {
                return "Internal_Server_500";
            }
        }
        sqlsrv_free_stmt($stmt);
        sqlsrv_close($conn);
    }

    public static function mdlmodificacionIndividualSeguro($modificacionIndividualSeguro) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spEditarSeguro ?";
        $params = array(&$modificacionIndividualSeguro);
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
            return $results;
        } else {
            return "Internal_Server_500";
            
        }
    
    }

    public static function mdlModificacionCalculoSobreSeguro($numeroidtarifa, $nombreServicio, $numeroServicio) {
        if ($numeroServicio == 1) {

            $conn = Conexion::Conectar();
            $sql = "EXECUTE spUpdateSeguroSobre ?, ?";
            $params = array(&$nombreServicio, &$numeroidtarifa);
            $stmt = sqlsrv_prepare($conn, $sql, $params);
            if (sqlsrv_execute($stmt) == true) {

                return "ok";
            } else {
                return sqlsrv_errors();
            }
        }
        if ($numeroServicio == 3) {

            $conn = Conexion::Conectar();
            $sql = "EXECUTE spUpdatePrdoCalculo ?, ?";
            $params = array(&$nombreServicio, &$numeroidtarifa);
            $stmt = sqlsrv_prepare($conn, $sql, $params);
            if (sqlsrv_execute($stmt) == true) {

                return "ok";
            } else {
                return sqlsrv_errors();
            }
        }

        if ($numeroServicio == 4) {

            $conn = Conexion::Conectar();
            $sql = "EXECUTE spUpdateMonedaCalculo ?, ?";
            $params = array(&$nombreServicio, &$numeroidtarifa);
            $stmt = sqlsrv_prepare($conn, $sql, $params);
            if (sqlsrv_execute($stmt) == true) {

                return "ok";
            } else {
                return sqlsrv_errors();
            }
        }

        if ($numeroServicio == 5) {

            $conn = Conexion::Conectar();
            $sql = "EXECUTE spUpdateVlrSeguro ?, ?";
            $params = array(&$nombreServicio, &$numeroidtarifa);
            $stmt = sqlsrv_prepare($conn, $sql, $params);
            if (sqlsrv_execute($stmt) == true) {

                return "ok";
            } else {
                return sqlsrv_errors();
            }
        }
    }

    public static function mdlModificacionCalculoSobreManejo($edicionServicioManejo) {

        $conn = Conexion::Conectar();
        $sql = "EXECUTE spEditarManejo ?";
        $params = array(&$edicionServicioManejo);
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {

            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
            return $results;
        } else {
            return sqlsrv_errors();
        }
    }

    public static function mdlModificacionManejo($numeroServicioManejo, $nombreServicioManejo, $numeroTarifaManejo) {

        if ($numeroServicioManejo == 1) {

            $conn = Conexion::Conectar();
            $sql = "EXECUTE spUpdateBaseManejo ?, ?";
            $params = array(&$nombreServicioManejo, &$numeroTarifaManejo);
            $stmt = sqlsrv_prepare($conn, $sql, $params);
            if (sqlsrv_execute($stmt) == true) {

                return "ok";
            } else {
                return sqlsrv_errors();
            }
        } elseif ($numeroServicioManejo == 2) {
            $conn = Conexion::Conectar();
            $sql = "EXECUTE spUpdateMonedaManejo ?, ?";
            $params = array(&$nombreServicioManejo, &$numeroTarifaManejo);
            $stmt = sqlsrv_prepare($conn, $sql, $params);
            if (sqlsrv_execute($stmt) == true) {

                return "ok";
            } else {
                return sqlsrv_errors();
            }
        } elseif ($numeroServicioManejo == 3) {
            $conn = Conexion::Conectar();
            $sql = "EXECUTE spUpdateValorManejo ?, ?";
            $params = array(&$nombreServicioManejo, &$numeroTarifaManejo);
            $stmt = sqlsrv_prepare($conn, $sql, $params);
            if (sqlsrv_execute($stmt) == true) {

                return "ok";
            } else {
                return sqlsrv_errors();
            }
        }
    }

    public static function mdlMostarServicioGastosAdmin($idServicioClienteGtsAdmin) {

        $conn = Conexion::Conectar();
        $sql = "EXECUTE spEditarGastosAdministracion ?";
        $params = array(&$idServicioClienteGtsAdmin);
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {

            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
            return $results;
        } else {
            return sqlsrv_errors();
        }
    }

    public static function mdlModificacionGtsAdmin($numeroServicioGtsAdmin, $nombreServicioGtsAdmin, $numeroTarifaGtsAdmin) {
        $conn = Conexion::Conectar();

        if ($numeroServicioGtsAdmin == 1) {

            $sql = "EXECUTE spUpdateBaseGstosAdmin ?, ?";
            $params = array(&$nombreServicioGtsAdmin, &$numeroTarifaGtsAdmin);
            $stmt = sqlsrv_prepare($conn, $sql, $params);
            if (sqlsrv_execute($stmt) == true) {

                return "ok";
            } else {
                return sqlsrv_errors();
            }
        } elseif ($numeroServicioGtsAdmin == 2) {

            $sql = "EXECUTE spUpdateBaseMoneda ?, ?";
            $params = array(&$nombreServicioGtsAdmin, &$numeroTarifaGtsAdmin);
            $stmt = sqlsrv_prepare($conn, $sql, $params);
            if (sqlsrv_execute($stmt) == true) {

                return "ok";
            } else {
                return sqlsrv_errors();
            }
        } elseif ($numeroServicioGtsAdmin == 3) {

            $sql = "EXECUTE spUpdateValorGtsAdmin ?, ?";
            $params = array(&$nombreServicioGtsAdmin, &$numeroTarifaGtsAdmin);
            $stmt = sqlsrv_prepare($conn, $sql, $params);
            if (sqlsrv_execute($stmt) == true) {

                return "ok";
            } else {
                return sqlsrv_errors();
            }
        }
    }

    public static function mdlMostarServicioOtrosGastos($idServicioClienteOtrosGastos) {

        $conn = Conexion::Conectar();
        $sql = "EXECUTE spEditarOtrosGastos ?";
        $params = array(&$idServicioClienteOtrosGastos);
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {

            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
            return $results;
        } else {
            return sqlsrv_errors();
        }
    }

    public static function mdlModificacionOtrosGastos($numeroServicioOtrosGastos, $nombreServicioOtrosGastos, $numeroTarifaOtrosGastos) {

        if ($numeroServicioOtrosGastos == 1) {
            $conn = Conexion::Conectar();
            $sql = "EXECUTE spUpdateBaseOtros ?, ?";
            $params = array(&$nombreServicioOtrosGastos, &$numeroTarifaOtrosGastos);
            $stmt = sqlsrv_prepare($conn, $sql, $params);
            if (sqlsrv_execute($stmt) == true) {

                return "ok";
            } else {
                return sqlsrv_errors();
            }
        } elseif ($numeroServicioOtrosGastos == 2) {
            $conn = Conexion::Conectar();
            $sql = "EXECUTE spUpdateMonedaOtros ?, ?";
            $params = array(&$nombreServicioOtrosGastos, &$numeroTarifaOtrosGastos);
            $stmt = sqlsrv_prepare($conn, $sql, $params);
            if (sqlsrv_execute($stmt) == true) {

                return "ok";
            } else {
                return sqlsrv_errors();
            }
        } elseif ($numeroServicioOtrosGastos == 3) {
            $conn = Conexion::Conectar();
            $sql = "EXECUTE spUpdateValorOtros ?, ?";
            $params = array(&$nombreServicioOtrosGastos, &$numeroTarifaOtrosGastos);
            $stmt = sqlsrv_prepare($conn, $sql, $params);
            if (sqlsrv_execute($stmt) == true) {

                return "ok";
            } else {
                return sqlsrv_errors();
            }
        }
    }

    public static function mdlAnulacionFila($idNumeroServicio, $idNumeroFilaCliente, $botonelminarfila) {

        if ($botonelminarfila == 0) {
            $nuevoDato = 2;
        } elseif ($botonelminarfila == 1) {
            $nuevoDato = 1;
        } else {
            return "error dato invalido";
        }
        $conn = Conexion::Conectar();

        $sql = "EXECUTE spvalidarCntServicio";
        $stmt = sqlsrv_prepare($conn, $sql);
        if (sqlsrv_execute($stmt) == true) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $results = $row;
            }

            if ($results[""] == 1) {

                $sql = "EXECUTE spvalidarDescativa ?";
                $params = array(&$idNumeroFilaCliente);
                $stmt = sqlsrv_prepare($conn, $sql, $params);
                if (sqlsrv_execute($stmt) == true) {
                    
                } else {
                    
                }
            }

            $sql = "EXECUTE spMostrarFila ?, ?";
            $params = array(&$idNumeroFilaCliente, &$idNumeroServicio);
            $stmt = sqlsrv_prepare($conn, $sql, $params);
            if (sqlsrv_execute($stmt) == true) {

                while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                    $results[] = $row;
                }
                if (preg_match('/^[0-9]+$/', $results[0]["claveAlmacenaje"])) {
                    $sql = "EXECUTE spDeleteFilaAlmacenaje ?, ?";
                    $params = array(&$nuevoDato, &$results[0]["claveAlmacenaje"]);
                    $stmt = sqlsrv_prepare($conn, $sql, $params);
                    if (sqlsrv_execute($stmt) == true) {
                        
                    } else {
                        
                    }
                }

                if (preg_match('/^[0-9]+$/', $results[0]["claveSeguro"])) {
                    $sql = "EXECUTE spDeleteFilaSeguro ?, ?";
                    $params = array(&$nuevoDato, &$results[0]["claveAlmacenaje"]);
                    $stmt = sqlsrv_prepare($conn, $sql, $params);
                    if (sqlsrv_execute($stmt) == true) {
                        
                    } else {
                        
                    }
                }

                if (preg_match('/^[0-9]+$/', $results[0]["claveManejo"])) {
                    $sql = "EXECUTE spDeleteFilaManejo ?, ?";
                    $params = array(&$nuevoDato, &$results[0]["claveAlmacenaje"]);
                    $stmt = sqlsrv_prepare($conn, $sql, $params);
                    if (sqlsrv_execute($stmt) == true) {
                        
                    } else {
                        
                    }
                }

                if (preg_match('/^[0-9]+$/', $results[0]["claveGtosAdmin"])) {
                    $sql = "EXECUTE spDeleteFilaGtosAdmin ?, ?";
                    $params = array(&$results[0]["claveAlmacenaje"], &$nuevoDato);
                    $params = array(&$nuevoDato, &$results[0]["claveAlmacenaje"]);
                    if (sqlsrv_execute($stmt) == true) {
                        
                    } else {
                        
                    }
                }

                if (preg_match('/^[0-9]+$/', $results[0]["claveOtrosGtos"])) {
                    $sql = "EXECUTE spDeleteFilaOtrosGts ?, ?";
                    $params = array(&$results[0]["claveOtrosGtos"]);
                    $params = array(&$nuevoDato, &$results[0]["claveAlmacenaje"]);
                    if (sqlsrv_execute($stmt) == true) {
                        
                    } else {
                        
                    }
                }
            } else {
                return sqlsrv_errors();
            }
        } else {
            return sqlsrv_errors();
        }
    }

    public static function mdlreactivarCliente($idNitActivar) {

        $conn = Conexion::Conectar();
        $sql = "EXECUTE formDinamicos ?";
        $params = array(&$idNitActivar);
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            return 0;
        } else {
            return "error";
        }
    }

    public static function mdlClienteIdAnularTotal($lblClienteIdAnularTotal, $lblNitAnularTotal) {

        $conn = Conexion::Conectar();
        $sql = "EXECUTE spAnularTarifa ?, ?";
        $params = array(&$lblClienteIdAnularTotal, &$lblNitAnularTotal);
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            return 0;
        } else {
            return "error";
        }
    }

    public static function mdlMostrarDependencias() {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spMstDependencias";
        $stmt = sqlsrv_prepare($conn, $sql);
        if (sqlsrv_execute($stmt) == true) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
            if (!empty($results)) {
                return $results;
            } else if (empty($results)) {
                return sqlsrv_errors();
            }
        } else {
            return sqlsrv_errors();
        }
    }

    public static function mdlMostrarEjecutivo($valor) {
        $params = array(&$valor);
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spMstEjec ?";
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
            if (!empty($results)) {
                return $results;
            } else if (empty($results)) {
                return sqlsrv_errors();
            }
        } else {
            return sqlsrv_errors();
        }
    }

}
