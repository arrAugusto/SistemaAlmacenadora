<?php

require_once "cone.php";

class ModeloRegIngBod {

    public static function  mdlConsultaDetalles($numeroIdIng) {

        $conn = Conexion::Conectar();
        $params = array(&$numeroIdIng);
        $sql = "EXECUTE spIgualDetalles ?";

        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $resultsContIng[] = $row;
            }

            if (!empty($resultsContIng)) {

                $sql = "EXECUTE spIgualIncidencia ?";
                $stmt = sqlsrv_prepare($conn, $sql, $params);

                if (sqlsrv_execute($stmt) == true) {
                    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                        $results1[] = $row;
                    }


                    if (!empty($results1)) {
                        if ($resultsContIng[0]["countDetMerca"] > $results1[0]["countIncidencia"]) {

                            $sql = "EXECUTE spMstDetalles ?";

                            $stmt = sqlsrv_prepare($conn, $sql, $params);
                            if (sqlsrv_execute($stmt) == true) {
                                while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                                    $results2[] = $row;
                                }
                                if (!empty($results2)) {
                                    return $results2;
                                } else {
                                    return "Nodatos";
                                }
                            } else {
                                return "SD";
                            }
                        } else {
                            return "finDetalle";
                        }
                    } else {
                        return "SinDatosOp";
                    }
                }
            }
        }
    }

    public static function mdlUsarFilaDetalle($idUsarFila) {

        $conn = Conexion::Conectar();
        $sql = "EXECUTE spMstDetBod ?";
        $params = array(&$idUsarFila);
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

    public static function mdlGuardarDetalle($datos, $usuarioOp) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spIgualDetalles ?";
        $params = array(&$datos["idOrdenIng"]);
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $resultsContIng[] = $row;
            }
            if (!empty($resultsContIng)) {
                $sql = "EXECUTE spIgualIncidencia ?";
                $stmt = sqlsrv_prepare($conn, $sql, $params);
                if (sqlsrv_execute($stmt) == true) {
                    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                        $results1[] = $row;
                    }
                    $nuevoDetalle = $results1[0]["countIncidencia"] + 1;
                    /**/
                    if ($resultsContIng[0]["countDetMerca"] == $nuevoDetalle) {

                        date_default_timezone_set('America/Guatemala');
                        $time = date('Y-m-d H:i:s');
                        $estado = 1;
                        $params = array(
                            &$datos['idDetalle'],
                            &$datos['idOrdenIng'],
                            &$datos['descripcionMerca'],
                            &$datos['cantidadPosiciones'],
                            &$datos['Metraje'],
                            &$estado,
                            &$usuarioOp
                        );
    
                        $sql = "EXECUTE spIngIncidencias  ?, ?, ?, ?, ?, ?, ?";
                        $stmt = sqlsrv_prepare($conn, $sql, $params);
                        if (sqlsrv_execute($stmt) == true) {

                            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                                $resultsIdent[] = $row;
                            }
                            if (!empty($resultsIdent)) {
                                $idDetalle = $datos['idDetalle'];
                                $paramsIngreso = array(&$datos["idOrdenIng"], &$idDetalle, &$usuarioOp);

                                $sql = "EXECUTE spUpdateEstadoDet ?, ?, ?";
                                $stmt = sqlsrv_prepare($conn, $sql, $paramsIngreso);
                                $idIngreso = $datos['idOrdenIng'];
                                if (sqlsrv_execute($stmt) == true) {



                                    $montacarga = $datos["montacarga"];
                                    $montacargaLista = json_decode($montacarga, true);
                                    foreach ($montacargaLista as $key => $value) {
                                        $idMontarguistaUs = $value["montacarguistaSele"];
                                        $trans = 'Culminar Ingreso Montacarguista';
                                        $tipo = 0;
                                        $respMont = ModeloRegIngBod::mdlGuardarMontarguista($idIngreso, $trans, $idMontarguistaUs, $tipo);
                                    }
                                    /**/////////////////////////////////////////////////////////////

                                    return array("DetalleRebajado" => 0, "llaveIdent" => $resultsIdent);
                                } else {
                                    return sqlsrv_errors();
                                }
                            } else {
                                return "ErrorInsert";
                            }
                        } else {
                            return sqlsrv_errors();
                        }
                    } else {

                        date_default_timezone_set('America/Guatemala');
                        $time = date('Y-m-d H:i:s');
                        $estado = 1;
                        $params = array(
                            &$datos['idDetalle'],
                            &$datos['idOrdenIng'],
                            &$datos['descripcionMerca'],
                            &$datos['cantidadPosiciones'],
                            &$datos['Metraje'],
                            &$estado,
                            &$usuarioOp
                        );

                        $sql = "EXECUTE spIngIncidencias  ?, ?, ?, ?, ?, ?, ?";
                        $stmt = sqlsrv_prepare($conn, $sql, $params);
                        if (sqlsrv_execute($stmt) == true) {
                            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                                $resultsIdent[] = $row;
                            }
                            if (!empty($resultsIdent)) {
                                $sql = "EXECUTE spUpdateEstadoDeta ?";
                                $parametro = array(&$datos['idDetalle']);
                                $stmt = sqlsrv_prepare($conn, $sql, $parametro);
                                if (sqlsrv_execute($stmt) == true) {
                                    return array("DetalleRebajado" => "DetalleRebajado", "llaveIdent" => $resultsIdent);
                                } else {
                                    return sqlsrv_errors();
                                }
                            }
                        } else {
                            return sqlsrv_errors();
                        }
                    }
                } else {
                    return sqlsrv_errrors();
                }
            } else {
                return "SD";
            }
        } else {
            return sqlsrv_errors();
        }
    }

    public static function mdltraerDatosIngreso($codigo, $cliente) {

        $conn = Conexion::Conectar();
        $sql = "EXECUTE spConsulIng ?, ?";
        $params = array(&$cliente, &$codigo);
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
    public static function mdlUbicarVehUsado($sp, $idDetalle, $ubicacion) {

        $conn = Conexion::Conectar();
        $sql = 'EXECUTE '.$sp.' ?, ?';
        $params = array(&$idDetalle, &$ubicacion);
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
    public static function mdlMostrarDetalles($codigo) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spMostrarDetI ?";
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
        }
    }

    public static function mdlSumaDetallesInc($codigo) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spMostrarSumDet ?";
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
        }
    }

    public static function mdlSumaDetallesMer($codigo) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spMostrarSumMer ?";
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
        }
    }

    public static function mdlEliminarHistorial($codigo) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spElimHist ?, ?";
        date_default_timezone_set('America/Guatemala');
        $time = date('Y-m-d H:i:s');
        $params = array(&$time, &$codigo);
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

    public static function mdlTraerDatosOperaciones($codigo) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spIngOpe ?";
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
        }
    }

    public static function mdlTraerDatosBodega($codigo) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spIngBod ?";
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
        }
    }

    public static function mdlLlaveDetalleId($llaveRevisonDet) {

        $conn = Conexion::Conectar();
        $sql = "EXECUTE spAnularIncid ?";
        $params = array(&$llaveRevisonDet);
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            return "Anulado";
        }
    }

    public static function mdlmostrarMapa($hiddenIdBod) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spDibMapa ?";
        $params = array(&$hiddenIdBod);
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

    public static function mdlmostrarMapaInactivo($hiddenIdBod) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spDibMapaIn ?";
        $params = array(&$hiddenIdBod);
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

    public static function mdlGuardarDetalleLista($dataListaUbica, $llave) {

        $conn = Conexion::Conectar();
        foreach ($dataListaUbica as $key => $value) {
            $valueY = $value["ubicacionY"];
            $valueX = $value["ubicacionX"];
            $estado = 1;
            $sql = "EXECUTE spUbica ?, ?, ?, ?";
            $params = array(&$llave, &$valueY, &$valueX, &$estado);

            $stmt = sqlsrv_prepare($conn, $sql, $params);
            if (sqlsrv_execute($stmt) == true) {
                if (sizeof($dataListaUbica) == $key + 1) {
                    return "fin";
                }
            } else {
                return sqlsrv_errors();
            }
        }
    }

    public static function mdlAsignacionBodegaRev($idChequeBodega, $idIngreso, $operacion) {

        $conn = Conexion::Conectar();
        $sql = "EXECUTE spRevRegistroTra ?, ?, ?";
        $params = array(&$idChequeBodega, &$idIngreso, &$operacion);
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

    public static function mdlTraerDatosBodegas($codigo, $tipo) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spDatosBodega ?, ?";
        $params = array(&$codigo, &$tipo);
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

    public static function mdlTraerDatosUnidades($codigo) {

        $conn = Conexion::Conectar();
        $sql = "EXECUTE spPilotosUnidades ?";
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
        }
    }

    public static function mdlInsertPaseSalida($idUnidad, $usuarioOp) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spValPaseSalida ?";
        $params = array(&$idUnidad);
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $resultsVal[] = $row;
            }
            if (!empty($resultsVal)) {
                if ($resultsVal[0]["estado"] == 0) {
                    $sql = "EXECUTE spPaseSalida ?, ?";
                    $params = array(&$idUnidad, &$usuarioOp);
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
                } else {
                    return "PaseYaExiste";
                }
            }
        }
    }

    public static function mdlGuardarToken($idPase, $hashGenerado, $times) {

        $conn = Conexion::Conectar();
        $sql = "EXECUTE spGuardarToken ?, ?, ?";
        $params = array(&$idPase, &$hashGenerado, &$times);
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
            if (!empty($results)) {
                return $results;
            } else {
                return "SDs";
            }
        } else {
            return sqlsrv_errors();
        }
    }

    public static function mdlConsolidadoPoliza($idIngreso) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spVerificacionVinculo ?";
        $params = array(&$idIngreso);
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
            if (!empty($results)) {
                return $results[0]["cadenaVinculo"];
            } else {
                return "SD";
            }
        } else {
            return sqlsrv_errors();
        }
    }

    public static function mdlGuardarMontarguista($idIngreso, $trans, $idUsuario, $tipo) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spBitacoraIng ?, ?, ?, ?";
        $params = array(&$idIngreso, &$trans, &$idUsuario, &$tipo);
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
            if (!empty($results)) {
                return "Ok";
            } else {
                return sqlsrv_errors();
            }
        }
    }

    public static function mdlFinialVinculo($respuestaRevConsPol) {

        $conn = Conexion::Conectar();
        $sql = "EXECUTE spFinalVinculo ?";
        $params = array(&$respuestaRevConsPol);
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            return "Ok";
        } else {
            return sqlsrv_errors();
        }
    }

    public static function mdlEditarDetallesBodega($datos) {

        $idDet = $datos["editarIdDet"];
        $IdTextPosiciones = $datos["IdTextPosiciones"];
        $IdTextMetraje = $datos["IdTextMetraje"];
        $IdDescIngreso = $datos["IdDescIngreso"];

        $conn = Conexion::Conectar();
        $sql = "EXECUTE spEditarBodInci ?, ?, ?, ?";
        $params = array(&$idDet, &$IdTextPosiciones, &$IdTextMetraje, &$IdDescIngreso);
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

    public static function mdlInsertUnParam($parametro, $sp) {

        $conn = Conexion::Conectar();
        $sql = "EXECUTE " . $sp . " ?";
        $params = array(&$parametro);

        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            return "Ok";
        } else {
            return sqlsrv_errors();
        }
    }

    public static function mdlConsultaUnParam($Ingreso, $sp) {

        $conn = Conexion::Conectar();
        $sql = "EXECUTE " . $sp . " ?";
        $params = array(&$Ingreso);
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

        public static function mdlConsultaDosParam($Ingreso, $sp, $usuarioOp) {

        $conn = Conexion::Conectar();
        $sql = "EXECUTE " . $sp . " ?, ?";
        $params = array(&$Ingreso, &$usuarioOp);
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
    public static function mdlMostVehNewFinalIng($idIngMstV) {

        $conn = Conexion::Conectar();
        $params = array(&$idIngMstV);
        $sql = "EXECUTE spMostVeFina ?";
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

    public static function mdlUpdateChasis($idData, $vehiculosUbicaN) {

        $conn = Conexion::Conectar();
        $params = array(&$idData, &$vehiculosUbicaN);
        $sql = "EXECUTE spUpdateUbicaChas ?, ?";
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            return true;
        } else {
            return sqlsrv_errors();
        }
    }

}
