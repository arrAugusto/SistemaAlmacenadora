<?php

require_once "cone.php";

class ModeloControladorOpB {

    public static function mdlControladorOpB($tipo) {

        $conn = Conexion::Conectar();
        $sql = "EXECUTE  spMostrarNit";
        $stmt = sqlsrv_prepare($conn, $sql);
        if (sqlsrv_execute($stmt) == true) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
            return $results;
        } else {
            return "SD";
        }
    }

    public static function mdlConsultaEmpresa($consultaEmpresa) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spMostrarNitOPB ?";
        $params = array(&$consultaEmpresa);
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

    public static function mdlConsultaCodigo($codigo) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spMostrarCodigoOPB ?";
        $params = array(&$codigo);
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
            return "SD";
        }
    }

    public static function mdlRegistrarIngresoOperacion($datos) {
        $conn = Conexion::Conectar();
        $idBodega = $datos["hiddenIdBod"];
        $comentario = "Registrado Operaciones";
        $params = array(
            &$datos['cartaDeCupo'],
            &$datos['poliza'],
            &$datos['dua'],
            &$datos['bl'],
            &$datos['puertoOrigen'],
            &$datos['producto'],
            &$datos['estadoIngreso'],
            &$datos['idUsuarioCliente'],
            &$datos['idNitCliente'],
            &$datos['servicioTarifa'],
            &$datos['idRegPol'],
            &$datos['consolidado'],
            &$idBodega,
            &$datos['cantContenedores'],
            &$datos['cantClientes'],
            &$datos['peso'],
            &$datos['bultos'],
            &$datos['valorTotalAduana'],
            &$datos['tipoDeCambio'],
            &$datos['totalValorCif'],
            &$datos['valorImpuesto'],
            &$datos['hiddenDateTime'],
            &$comentario,
            &$datos["idUs"]
        );

        $sql = "EXECUTE spNuevoIngOPe   ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?";
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
            if (!empty($results)) {
                return array("resp" => true, "dataTxt" => $results);
            } else {
                return array("resp" => false, "dataTxt" => $results);
            }
        } else {
            return array("resp" => false, "dataTxt" => sqlsrv_errors());
        }
    }

    public static function mdlVerificarIngreso($numVerificarIng) {

        $conn = Conexion::Conectar();
        $params = array(&$numVerificarIng);
        $sql = "EXECUTE  spVerificar ?";
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
            return "SD";
        }
    }

    public static function mdlCadenaVinculo($dato, $tipoOperacion, $llaveConsolidadoPoliza, $busquedaConsolidadoGrd) {
// insert a ala linea params modificar la tupla vinculo
        $conn = Conexion::Conectar();
        $estadoOp = 0;
        $params = array(&$dato, &$tipoOperacion, &$busquedaConsolidadoGrd, &$llaveConsolidadoPoliza, &$estadoOp);
        $sql = "EXECUTE  spVinculo ?, ?, ?, ?, ?";
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            return "okVinculo";
        } else {
            return sqlsrv_errors();
        }
    }

    public static function mdlRegistroDeTransacciones($dataTransaccion) {

        $conn = Conexion::Conectar();
        $params = array(&$dataTransaccion["usuario"], &$dataTransaccion["idOperaciones"], &$dataTransaccion["tipoOperacion"], &$dataTransaccion["estadoOperacion"], &$dataTransaccion["time"]);
        $sql = "EXECUTE  spRegTransaccion ?, ?, ?, ?, ?";
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

    public static function mdlRegistroUnidades($dato, $datos, $tipoOperacion) {
        $conn = Conexion::Conectar();
        /*
         *
         * CONSULTA SI EXISTEN LOS PILOTOS, UNIDADES DE PLACA Y CONTENEDOR PARA AGREGAR ALA BASE DE DATOS
         *
         * 
         */
        $parametrosValidacion = array(&$datos['numeroLicencia'], &$datos['numeroPlaca'], &$datos['numeroContenedor']);
        $sql = "EXECUTE  spRespuestaUnidades ?, ?, ?";
        $stmt = sqlsrv_prepare($conn, $sql, $parametrosValidacion);
        if (sqlsrv_execute($stmt) == true) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
            if (!empty($results)) {
                $agregado = 0;
                if ($results[0]["respLicencia"] == 0) {
                    $paramPiloto = array(&$datos['numeroLicencia'], &$datos['nombrePiloto']);
                    $sql = "EXECUTE  spRetPlto ?, ?";
                    $stmt = sqlsrv_prepare($conn, $sql, $paramPiloto);
                    if (sqlsrv_execute($stmt) == true) {
                        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                            $resultsPiloto[] = $row;
                        }
                        if (!empty($resultsPiloto)) {
                            $idPiloto = $resultsPiloto[0]["IdentityPlt"];
                        } else {
                            $idPiloto = 0;
                        }
                    } else {
                        return sqlsrv_errors();
                    }
                } else {
                    $idPiloto = $results[0]["idLicencia"];
                }
                if ($results[0]["respPlaca"] == 0) {
                    $paramPlaca = array(&$datos['numeroPlaca']);
                    $sql = "EXECUTE  spNuevaPlaca ?";
                    $stmt = sqlsrv_prepare($conn, $sql, $paramPlaca);
                    if (sqlsrv_execute($stmt) == true) {
                        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                            $resultsUnidad[] = $row;
                        }
                        if (!empty($resultsUnidad)) {
                            $idPlaca = $resultsUnidad[0]["IdentityPlaca"];
                        } else {
                            $idPlaca = 0;
                        }
                    } else {
                        return sqlsrv_errors();
                    }
                } else {
                    $idPlaca = $results[0]["idPlaca"];
                }
                if ($results[0]["respContenedor"] == 0) {
                    $paramPlaca = array(&$datos['numeroContenedor']);
                    $sql = "EXECUTE  spNuevoContenedor ?";
                    $stmt = sqlsrv_prepare($conn, $sql, $paramPlaca);
                    if (sqlsrv_execute($stmt) == true) {
                        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                            $resultsContendor[] = $row;
                        }
                        if (!empty($resultsContendor)) {
                            $idContenedor = $resultsContendor[0]["IdentityContenedor"];
                        } else {
                            $idContenedor = 0;
                        }
                    } else {
                        return sqlsrv_errors();
                    }
                } else {
                    $idContenedor = $results[0]["idContenedor"];
                }
                if ($idPiloto >= 1 && $idPlaca >= 1 && $idContenedor >= 1) {
                    $paramPlaca = array(&$dato, &$idPiloto, &$idPlaca, &$idContenedor, &$tipoOperacion, &$datos['numeroMarchamo']);
                    $sql = "EXECUTE  spInsUnidades ?, ?, ?, ?, ?, ?";
                    $stmt = sqlsrv_prepare($conn, $sql, $paramPlaca);
                    if (sqlsrv_execute($stmt) == true) {
                        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                            $RespuestaAsinacion[] = $row;
                        }
                        if (!empty($RespuestaAsinacion)) {
                            return $RespuestaAsinacion;
                        } else {
                            return "SD";
                        }
                    } else {
                        return sqlsrv_errors();
                    }
                }
            } else {
                return "SD";
            }
        } else {
            return sqlsrv_errors();
        }
    }

    public static function mdlMostrarNumeroIdNitCliente($numeroIdNitCliente) {

        $conn = Conexion::Conectar();
        $sql = "EXECUTE spDataClientes ?";
        $params = array(&$numeroIdNitCliente);
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
            if (!empty($results)) {
                return array("tarifaEspecial", $results);
            } else {

                $sql = "EXECUTE spClienteTar ?";
                $params = array(&$numeroIdNitCliente);
                $stmt = sqlsrv_prepare($conn, $sql, $params);
                if (sqlsrv_execute($stmt) == true) {
                    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                        $resultsCont[] = $row;
                    }

                    if (!empty($resultsCont)) {
                        if ($resultsCont[0]["estado"] == 0) {
                            return array("tarifaRegistrada", "Operacion" => 0);
                        } else if ($resultsCont[0]["estado"] == 1) {
                            return array("tarifaRegistrada", "Operacion" => 1);
                        } else if ($resultsCont[0]["estado"] == 2) {
                            return array("tarifaRegistrada", "Operacion" => 2);
                        } else if ($resultsCont[0]["estado"] == 3) {
                            return array("tarifaRegistrada", "Operacion" => 3);
                        }
                    } else {
                        return "sinTarifra";
                    }
                }
            }
        } else {
            return sqlsrv_errors();
        }
    }

    public static function mdlMostrarDatosEjecutivo($idEjecutivo) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spDataEjecutivo ?";
        $params = array(&$idEjecutivo);
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
            return "SD";
        }
    }

    public static function mdlGuardarNuevaLinea($tipo, $linea, $sp) {
        $conn = Conexion::Conectar();
        $sql = 'EXECUTE ' . $sp . ' ?, ?';
        $params = array(&$tipo, &$linea);
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

    public static function mdlEditarIngOP($datos) {
        $conn = Conexion::Conectar();
        $fechaIngFormat = date("Y-m-d", strtotime($datos['hiddenDateTimeEditar']));



        $params = array(
            &$datos['identity'],
            &$datos['cartaDeCupoEditar'],
            &$datos['polizaEditar'],
            &$datos['duaEditar'],
            &$datos['blEditar'],
            &$datos['puertoOrigenEditar'],
            &$datos['productoEditar'],
            &$fechaIngFormat,
            &$datos['idNitClienteEditar'],
            &$datos['regimenPolizaEditar'],
            &$datos['consolidadoEditar'],
            &$datos['idUsuarioClienteEditar']);

        $sql = "EXECUTE spEditarIngOP ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?";

        $stmt = sqlsrv_prepare($conn, $sql, $params);

        if (sqlsrv_execute($stmt) == true) {

            $paramsIngSaldo = array(&$datos['identity'],
                &$datos['cantContenedoresEditar'],
                &$datos['cantClientesEditar'],
                &$datos['pesoEditar'],
                &$datos['bultosEditar'],
                &$datos['valorTotalAduanaEditar'],
                &$datos['tipoDeCambioEditar'],
                &$datos['totalValorCifEditar'],
                &$datos['valorImpuestoEditar'],
                &$datos['hiddenDateTimeEditar']);

            $sql = "EXECUTE spEditarSaldoOp ?, ?, ?, ?, ?, ?, ?, ?, ?, ?";
            $stmt = sqlsrv_prepare($conn, $sql, $paramsIngSaldo);
            if (sqlsrv_execute($stmt) == true) {
                return "EXITO";
            } else {
                return sqlsrv_errors();
            }
        } else {
            return sqlsrv_errors();
        }
    }

    public static function mdlAnularIngreso($identity) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spAnularOPF ?";
        $params = array(&$identity);
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            return "ANULADOOPF";
        } else {
            return sqlsrv_errors();
        }
    }

    public static function mdlMostrarIngPendientes($llaveIngresosPen) {
        $params = array(&$llaveIngresosPen);
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spMostrarPen ?";
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
            if (!empty($results)) {
                return $results;
            } else {
                return "sin datos";
            }
        } else {
            return sqlsrv_errors();
        }
    }

    public static function mdlAgregandoDetalles($datos) {
        $conn = Conexion::Conectar();
        $params = array(&$datos['identidad']);
        $sql = "EXECUTE spMstSuma ?";
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
            if (!empty($results)) {
                return $results;
            }
        }
        $params = array(
            &$datos['identidad'],
            &$datos['tipoBusqueda'],
            &$datos['bultosAgregados'],
            &$datos['pesoAgregado']);

        $sql = "EXECUTE spGuadDetalle ?, ?, ?, ?";
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
            return "SD";
        }
    }

    public static function mdlVerificarSuma($identitySum) {
        $conn = Conexion::Conectar();

        $params = array(&$identitySum);
        $sql = "EXECUTE spMstSuma ?";
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
            if (!empty($results)) {
                $sumaDeBultos = $results;

                $sql = "EXECUTE spMstTotalBlt ?";
                $stmt = sqlsrv_prepare($conn, $sql, $params);
                if (sqlsrv_execute($stmt) == true) {
                    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                        $results[] = $row;
                    }
                    if (!empty($results)) {
                        if ($results[0]["bultos"] >= $sumaDeBultos[0][""]) {
                            return "OK";
                        } else {
                            return "denegado";
                        }
                    } else {
                        return "SinData";
                    }
                } else {
                    return "sd";
                }
            } else {
                return sqlsrv_errors();
            }
        }
    }
    public static function mdlAgregarDetallesVehiculos($llaveConsulta, $datos) {
        
        $conn = Conexion::Conectar();
        $sp = "spBultosIngN";
        $validarSumarTotales = FuncionesRepetitivas::validarSumarTotales($llaveConsulta, $sp);

        $sumarDetalles = FuncionesRepetitivas::sumaDetalles($llaveConsulta);
        $resultSumBultos = $sumarDetalles[0]["bultosDetalle"] + $datos['bultosAgregados'];
        $saldoIngreso = $validarSumarTotales - $resultSumBultos;

        if ($validarSumarTotales == $resultSumBultos) {
            $estado = 0;
            $params = array(
                &$llaveConsulta,
                &$datos['tipoBusqueda'],
                &$datos['bultosAgregados'],
                &$datos['pesoAgregado'],
                &$estado
            );
            $sql = "EXECUTE spGuardDetalle ?, ?, ?, ?, ?";
            $stmt = sqlsrv_prepare($conn, $sql, $params);
            if ($validarSumarTotales == $resultSumBultos) {
                if (sqlsrv_execute($stmt) == true) {
                    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                        $results[] = $row;
                    }
                    /**/////////////////////////////////////////////////////////////////////////////////

                        return array("estado" => "Okk", "resultado" => $results, "saldo" => $saldoIngreso);
                } else {
                    return sqlsrv_errors();
                }
            } else if ($validarSumarTotales > $resultSumBultos) {
                if (sqlsrv_execute($stmt) == true) {
                    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                        $results[] = $row;
                    }
                    return array("estado" => "OK", "resultado" => $results, "saldo" => $saldoIngreso);
                } else {
                    return "sqlsrv_errors()";
                }
            } else {
                return "sobreGiro";
            }
        }
    }

    public static function mdlAgregarDetalles($llaveConsulta, $datos) {
        $conn = Conexion::Conectar();
        $sp = "spBultosIngN";
        $validarSumarTotales = FuncionesRepetitivas::validarSumarTotales($llaveConsulta, $sp);

        $sumarDetalles = FuncionesRepetitivas::sumaDetalles($llaveConsulta);
        $resultSumBultos = $sumarDetalles[0]["bultosDetalle"] + $datos['bultosAgregados'];
        $saldoIngreso = $validarSumarTotales - $resultSumBultos;

        if ($validarSumarTotales == $resultSumBultos || $validarSumarTotales > $resultSumBultos) {

            $estado = 0;
            $params = array(
                &$llaveConsulta,
                &$datos['tipoBusqueda'],
                &$datos['bultosAgregados'],
                &$datos['pesoAgregado'],
                &$estado
            );
            $sql = "EXECUTE spGuardDetalle ?, ?, ?, ?, ?";
            $stmt = sqlsrv_prepare($conn, $sql, $params);
            if ($validarSumarTotales == $resultSumBultos) {
                if (sqlsrv_execute($stmt) == true) {
                    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                        $results[] = $row;
                    }
                    /**/////////////////////////////////////////////////////////////////////////////////
                    $estado = 2;
                    $paramIdIng = array(&$llaveConsulta, &$estado, &$datos["idUs"]);
                    $sql = "EXECUTE spEstIng ?, ?, ?";
                    $stmtEstIng = sqlsrv_prepare($conn, $sql, $paramIdIng);
                    if (sqlsrv_execute($stmtEstIng) == true) {
                        return array("estado" => "Okk", "resultado" => $results, "saldo" => $saldoIngreso);
                    } else {

                        return sqlsrv_errors();
                    }
                } else {
                    return sqlsrv_errors();
                }
            } else if ($validarSumarTotales > $resultSumBultos) {
                if (sqlsrv_execute($stmt) == true) {
                    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                        $results[] = $row;
                    }
                    return array("estado" => "OK", "resultado" => $results, "saldo" => $saldoIngreso);
                } else {
                    return "sqlsrv_errors()";
                }
            } else {
                return "sobreGiro";
            }
        }
    }

    public static function mdlAnularDetalle($llaveAnular) {
        $sumarDetalles = FuncionesRepetitivas::verIncidenciaAnular($llaveAnular);
        if ($sumarDetalles[0]["cantidad"] == 0) {
            $params = array(&$llaveAnular);
            $conn = Conexion::Conectar();
            $sql = "EXECUTE spAnularDet ?";
            $stmt = sqlsrv_prepare($conn, $sql, $params);
            if (sqlsrv_execute($stmt) == true) {
                return "Anulado";
            } else {
                return sqlsrv_errors();
            }
        } else if ($sumarDetalles != 0) {

            return "ConDetalleBodega";
        }
    }

    public static function mdlEditarDetalle($buttonEditar, $datos) {

        $llaveEdit = $buttonEditar;
        $textbltsEmpresa = $datos["textbltsEmpresa"];

        $sp = "spBultosIng";
        $respuestaValDetalle = FuncionesRepetitivas::validarSumarTotales($llaveEdit, $sp);

        $respuestaValBultos = FuncionesRepetitivas::validarIncidencias($llaveEdit, $textbltsEmpresa);
        $tipo = 0;
        if ($respuestaValBultos == "ConDetalleBodega") {
            $tipo = 1;
        }

        if ($respuestaValBultos <= $respuestaValDetalle) {
           $conn = Conexion::Conectar();
            $sql = "EXECUTE spRevIncideUP ?, ?, ?, ?, ?";
            $params = array(
                &$datos['textnomEmpresa'],
                &$datos['textbltsEmpresa'],
                &$datos['textpesoEmpresa'],
                &$buttonEditar,
                &$tipo);
            $stmt = sqlsrv_prepare($conn, $sql, $params);

            if (sqlsrv_execute($stmt) == true) {

            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
            if (!empty($results)) {
                return $results;
            } else {
                return sqlsrv_errors();
            }
                
                
            } else {
                return sqlsrv_errors();
            }
        } else {
            return "bultosExcede";
        }
    }

    public static function ctrMostrarServicio($MostrarServicio) {
        $conn = Conexion::Conectar();

        $params = array(&$MostrarServicio);
        $sql = "EXECUTE spSerTarifa ?";
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

    public static function mdlMostrarServicioGeneral($MostrarServicios) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spTServicios";
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

    public static function mdlValidacionNuevosVehiculos($TipoVehiculo, $lineaVehiculo) {
        $conn = Conexion::Conectar();
        $params = array(&$TipoVehiculo, &$lineaVehiculo);
        $sql = "EXECUTE spValChasis ?, ?";
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
            if (!empty($results)) {
                return $results[0]["incidenciaChasis"];
            } else {
                return "SD";
            }
        } else {
            return sqlsrv_errors();
        }
    }

    public static function mdlSimilarNuevosVehiculos($TipoVehiculo, $lineaVehiculo) {
        $conn = Conexion::Conectar();
        $params = array(&$TipoVehiculo, &$lineaVehiculo);
        $sql = "EXECUTE spValChasisSimilar ?, ?";
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
            if (!empty($results)) {
                return $results[0]["incidenciaChasis"];
            } else {
                return "SD";
            }
        } else {
            return sqlsrv_errors();
        }
    }

    public static function MostrarFamiliaPol($tipoRegimenConsult) {
        $conn = Conexion::Conectar();
        $params = array(&$tipoRegimenConsult);
        $sql = "EXECUTE spConsultReg ?";
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

    public static function mdlMostrarConcidencias($tipoBusqueda) {

        $conn = Conexion::Conectar();
        $params = array(&$tipoBusqueda);
        $sql = "EXECUTE spBusquedaInc ?";
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
            if (!empty($results)) {
                if (count($results) >= 26) {
                    return "SC";
                } else if (count($results) <= 25) {
                    return $results;
                }
            } else {
                return "SD";
            }
        } else {
            return "sqlsrv_errors()";
        }
    }

    public static function mdlBuscarEmpresaConsolidada() {

        $conn = Conexion::Conectar();
        //$params = array(&$busquedaConsolidado);
        $sql = "EXECUTE spBusquedaConsolidado";
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

    public static function mdlConsultaPiloto($datoDpiConsult) {

        $conn = Conexion::Conectar();
        $params = array(&$datoDpiConsult);
        $sql = "EXECUTE spPiloto ?";
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

    public static function mdlRevisionPoliza($numPolRev) {
        $conn = Conexion::Conectar();
        $params = array(&$numPolRev);
        $sql = "EXECUTE spRevPol ?";
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

    public static function mdlMostrarFamiliaPol($tipoRegimenConsult) {
        $conn = Conexion::Conectar();
        $params = array(&$tipoRegimenConsult);
        $sql = "EXECUTE spConsultReg ?";
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

    public static function mdlStockBultosPeso($hiddenIdentityIngPeso) {
        $conn = Conexion::Conectar();
        $params = array(&$hiddenIdentityIngPeso);
        $sql = "EXECUTE spValStock ?";
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

    public static function mdlRevisicionPiloto($revisionCui, $hiddenIdentityRevPlt, $sp) {
        $conn = Conexion::Conectar();
        $params = array(&$revisionCui, &$hiddenIdentityRevPlt);
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
        } else {
            return sqlsrv_errors();
        }
    }

    public static function mdlConsultaUnParam($param, $paramUno, $sp) {

        $conn = Conexion::Conectar();
        $params = array(&$param, &$paramUno);
        $sql = "EXECUTE " . $sp . " ?, ?";
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            return "ok";
        } else {
            return sqlsrv_errors();
        }
    }
    public static function mdlMostrarConsolidados($sp) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE ".$sp;
        $stmt = sqlsrv_prepare($conn, $sql);
        if (sqlsrv_execute($stmt) == true) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
            return $results;
        } else {
            return sqlsrv_errors();
        }
    }
    public static function mdlUnParametroConsult($idIngrseso, $sp) {
        $conn = Conexion::Conectar();
        $params = array(&$idIngrseso);
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
        } else {
            return sqlsrv_errors();
        }
    }

    public static function mdlRevPilotosUnidadPlus($numeroLicenciaPlusRev, $numeroPlacaPlusUnRev, $numeroContenedorPlusUnRev, $numeroMarchamoPlusUnRev, $hiddenIdentityPlusRev, $tipoPlus) {
        $conn = Conexion::Conectar();
        $params = array(&$hiddenIdentityPlusRev, &$numeroLicenciaPlusRev, &$numeroPlacaPlusUnRev, &$numeroContenedorPlusUnRev, &$numeroMarchamoPlusUnRev, &$tipoPlus);

        $sql = "EXECUTE spRevUnidadPlus ?, ?, ?, ?, ?, ?";
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

    public static function mdlNuevaEmpresa($nuevoNit, $nuevaEmpresa, $nuevaDireccion) {
        $conn = Conexion::Conectar();
        $params = array(&$nuevoNit, &$nuevaEmpresa, &$nuevaDireccion);
        $sql = "EXECUTE spNuevaEmpresa ?, ?, ?";
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

    public static function mdlActualizacionDetallesMerca($idIngrseso, $bultos, $peso, $sp) {

        $conn = Conexion::Conectar();
        $params = array(&$idIngrseso, &$bultos, &$peso);
        $sql = "EXECUTE " . $sp . " ?, ?, ?";
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            return "Ok";
        } else {
            return sqlsrv_errors();
        }
    }

    public static function mdlDetallesVehiculosUSados($idIngVehUs, $idDetVehUs, $tipoVeh, $marcaVeh, $lineaVeh, $anioVehiculo) {
        $conn = Conexion::Conectar();
        $params = array(&$idIngVehUs, &$idDetVehUs, &$tipoVeh, &$marcaVeh, &$lineaVeh, &$anioVehiculo);
        $sql = "EXECUTE spNuevoUsados ?, ?, ?, ?, ?, ?";
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            return true;
        } else {
            return sqlsrv_errors();
        }
    }

    public static function mdlRevChbasisVehiculo($idIngRevVeh, $chasisRevVeh) {
        $conn = Conexion::Conectar();
        $params = array(&$idIngRevVeh, &$chasisRevVeh);
        $sql = "EXECUTE spConsultaChasis ?, ?";
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

    public static function mdlConsultaTipoV($tipoVh, $lineaV, $sp) {
        $conn = Conexion::Conectar();
        $params = array(&$tipoVh, &$lineaV);
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
        } else {
            return sqlsrv_errors();
        }
    }

    public static function mdlTipoNewVeh($tipoVh, $sp) {
        
        $conn = Conexion::Conectar();
        $params = array(&$tipoVh);
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
        } else {
            return sqlsrv_errors();
        }
    }

    public static function mdlMostrarTiposLines($identidad) {

        $conn = Conexion::Conectar();
        $sql = "EXECUTE spMostrarLineas";
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

    public static function mdlConsultaTipoVehiculo($indexValue) {
        $conn = Conexion::Conectar();
        $params = array(&$indexValue);
        $sql = "EXECUTE spMostrarVehiculo ?";
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

    public static function mdlGuardarVehiculo($hiddenIdnetyIngV, $value) {
        
        
        //return true;//
        $chasis = $value["chasis"];
        $tipo = $value["TipoVehiculo"];
        $linea = $value["lineaVehiculo"];
        $conn = Conexion::Conectar();
        $params = array(&$hiddenIdnetyIngV, &$chasis, &$tipo, &$linea);
        $sql = "EXECUTE spNuevoV ?, ?, ?, ?";
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            return true;
        } else {
            return "sqlsrv_errors()";
        }
    }

    public static function mdlRevisionVehiculosNuevos($chasis, $tipo, $linea) {
        $conn = Conexion::Conectar();
        $params = array(&$chasis);
        $sql = "EXECUTE spRevChasisDup ?";
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

    public static function mdlEstadoIngresoFiscal($idIngreso, $tipo, $idUSser) {
        $conn = Conexion::Conectar();
        $params = array(&$idIngreso, &$tipo, &$idUSser);
        $sql = "EXECUTE spEstIng ?, ?, ?";
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

//**********************************************************************************************/


class FuncionesRepetitivas {

    public static function validarSumarTotales($llaveEdit, $sp) {


        $conn = Conexion::Conectar();
        $sql = 'EXECUTE ' . $sp . ' ?';
        $params = array(&$llaveEdit);
        $stmt = sqlsrv_prepare($conn, $sql, $params);

        if (sqlsrv_execute($stmt) == true) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
            if (!empty($results)) {
                $dato1 = $results[0]["bultosIngOp"];
                return $dato1;
            } else {
                return "SinData";
            }
        } else {
            return "500 Internal Server Error";
        }
    }

    public static function validarIncidencias($llaveEdit, $textbltsEmpresa) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spRevIncide ?";
        $params = array(&$llaveEdit);
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
            if (!empty($results)) {
                if ($results[0]["cantidad"] == 0) {
                    $sql = "EXECUTE spSumBlsDet ?";
                    $params = array(&$llaveEdit);

                    $stmt = sqlsrv_prepare($conn, $sql, $params);
                    if (sqlsrv_execute($stmt) == true) {
                        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                            $results1[] = $row;
                        }
                        if (!empty($results1)) {

                            if ($results1[0]["bultosDetalle"] == 0) {
                                $bultos = (0 + $results1[0]["bultosDetalle"]);
                                return $bultos;
                            } else {
                                $bultos = ($results1[0]["bultosDetalle"] + $textbltsEmpresa);
                                return $bultos;
                            }
                        }
                    } else {
                        return sqlsrv_errors();
                    }
                } else {
                    return "ConDetalleBodega";
                }
            } else {
                return "ErrorData";
            }
        } else {
            return "500 Internal Server Error";
        }
    }

    public static function sumaDetalles($llaveConsulta) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spSumBlsDeta ?";
        $params = array(&$llaveConsulta);
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

    public static function verIncidenciaAnular($llaveAnular) {
        $conn = Conexion::Conectar();
        $params = array(&$llaveAnular);
        $sql = "EXECUTE spRevIncide ?";
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


}
