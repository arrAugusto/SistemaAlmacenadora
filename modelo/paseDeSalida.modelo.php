<?php

require_once "cone.php";

class ModeloPasesDeSalida {

    public static function mdlListarRetiros() {
        $dataArray = [];
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spPaseSalidaCalc";
        $stmt = sqlsrv_prepare($conn, $sql);
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

    public static function mdlMostrarCalculoDatosUnidad($idRetCal, $idIngresoCal, $hiddenDateTimeVal) {
        $identRet = 0;
        $respuestaVerifica = ModeloCalculoDeAlmacenaje::mdlVerificarMostrarTarifa($idIngresoCal, $identRet);

        $conn = Conexion::Conectar();
        $sql = "EXECUTE spDatosCalculo ?,  ?";
        $params = array(&$idIngresoCal, &$idRetCal);
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }

            if (!empty($results)) {
                $cif = $results[0]["totalCif"];
                $impuestos = $results[0]["valImpuesto"];
                $peridoAlm = $results[0]["peridoAlm"];
                $TarifaAlm = $results[0]["TarifaAlm"];
                $minAlmacenaje = $results[0]["minimoAlmacenaje"];
                $peridoZona = $results[0]["peridoZona"];
                $tarifaZA = $results[0]["tarifaZA"];
                $minZonaAduanera = $results[0]["minimoZonaAduanera"];
                $baseManejo = $results[0]["baseManejo"];
                $tarifaManejo = $results[0]["tarifaManejo"];
                $valPeso = $results[0]["valPeso"];
                $minimoManejo = $results[0]["minimoManejo"];
                $TarifaGtsAdmin = $results[0]["TarifaGtsAdmin"];
                $cantClientes = $results[0]["cantClientes"];
                $minGastosAdministracion = $results[0]["minGastosAdministracion"];
                $defaultCopias = $results[0]["TarifaCopias"];

                if ($results[0]["servicioAlm"] == "ZONA ADUANERA") {
                    $nuevafechaInicio = $results[0]["FecingAlmacen"];
                    if ($hiddenDateTimeVal != "NA") {
                        $fechaCorte = $hiddenDateTimeVal;
                    } else {
                        $fechaCorte = $results[0]["fechaRet"];
                    }
                    $tiempoTotal = funcionesDeCalculo::dias($nuevafechaInicio, $fechaCorte);

                    if ($tiempoTotal >= $results[0]["delZA"]) {
                        $diaAlmacenaje = ($tiempoTotal - $results[0]["delZA"]) + 1;
                        $diasZA = $tiempoTotal - $diaAlmacenaje;
                    } else if ($tiempoTotal <= $results[0]["delZA"]) {
                        $diaAlmacenaje = 0;
                        $diasZA = $tiempoTotal - $diaAlmacenaje;
                    }
                }

                if ($respuestaVerifica[0]["tarifaEspecial"] == 0 && $respuestaVerifica[0]["tarifaNormal"] == 0) {

                    $respuestaAlmacenaje = calculosRubros::almacenajeFiscalCalculo($peridoAlm, $TarifaAlm, $impuestos, $diaAlmacenaje, $minAlmacenaje);
                    $respuestaZonaAduanera = calculosRubros::zonaAduaneraCalculo($diasZA, $peridoZona, $tarifaZA, $cif, $minZonaAduanera);
                    $respuestaManejo = calculosRubros::manejoCalculo($baseManejo, $tarifaManejo, $valPeso, $minimoManejo);
                    $respuestaGastosAdmin = calculosRubros::gastosAdminCalculo($TarifaGtsAdmin, $cantClientes, $minGastosAdministracion);
                    $gtoAdminMSuperior = ceil($respuestaGastosAdmin);
                    $almacenaje = $respuestaAlmacenaje;
                    $almaMSuperior = ceil($almacenaje / 10) * 10;
                    if ($results[0]["familiaPoliza"] == 1) {
                        $zonaAduaneraCalc = intval($respuestaZonaAduanera);
                        $zonaAduanMSuperior = ceil($zonaAduaneraCalc / 10) * 10 + $defaultCopias;
                    } else if ($results[0]["familiaPoliza"] == 2) {
                        $zonaAduaneraCalc = intval($respuestaZonaAduanera);
                        $zonaAduanMSuperior = ceil($zonaAduaneraCalc / 5) * 5 + $defaultCopias;
                    }
                    $datos = array("almaMSuperior" => $almaMSuperior, "zonaAduanMSuperior" => $zonaAduanMSuperior, "calculoManejo" => $respuestaManejo, "gtoAdminMSuperior" => $gtoAdminMSuperior, "tiempoTotal" => $tiempoTotal, "nuevafechaInicio" => $nuevafechaInicio, "fechaCorte" => $fechaCorte);
                    return $datos;
                } else {
                    //OBJETO UTILIZADO PARA OBTENER LOS PARAMETROS DE LA TARIFA
                    $sp = "spDataCalculo";
                    $datosIngCalculo = ModeloCalculoDeAlmacenaje::mdlVerificaTarifa($idIngresoCal, $sp);

                    /*
                     *  DATOS PARA GENERAR EL RUBRO ALMACENAJES
                     */
                    $peridoAlm = $datosIngCalculo[0]["PeriodoAlmacenaje"]; // PERIODO DE ALMACENAJE
                    $TarifaAlm = $datosIngCalculo[0]["tarifaAlmacenaje"]; // TARIFA DE ALMACENAJE
                    $minAlmacenaje = $datosIngCalculo[0]["minimoAlmacenaje"]; // MINIMO DE ALMACENAJE
                    /*
                     *  DATOS PARA GENERAR EL RUBRO DE ZONA ADUANERA
                     */
                    $peridoZona = $datosIngCalculo[0]["PeriodoZonaAduanera"]; // PERIODO ZONA ADUANA
                    $tarifaZA = $datosIngCalculo[0]["tarifaZonaAduanera"]; // TARIFA DE ZONA ADUANA
                    $minZonaAduanera = $datosIngCalculo[0]["minimoZonaAduanera"]; // MINIMO DE ZONA ADUANA  
                    /*
                     *  DATOS PARA GENERAR EL RUBRO DE MANEJO
                     */
                    $baseManejo = $datosIngCalculo[0]["baseManejo"]; // BASE DE MANEJO
                    $tarifaManejo = $datosIngCalculo[0]["tarifaManejo"]; // TARIFA DE MANEJO
                    $minimoManejo = $datosIngCalculo[0]["minimoManejo"]; // MINIMO DE MANEJO   

                    /*
                     *  DATOS PARA GENERA EL RUBRO DE GASTOS ADMINISTRACIÓN
                     */

                    $TarifaGtsAdmin = $datosIngCalculo[0]["tarifaGastosAdministrativos"] * $results[0]["cantContenedores"]; // TARIFA GASTOS ADMINISTRACION * CANTIDAD DE CONTENEDORES
                    $minGastosAdministracion = $datosIngCalculo[0]["minGastosAdministracion"]; // MINIMO POR GASTOS DE ADMINISTRACION
                    $defaultCopias = $datosIngCalculo[0]["tarifaFotocopias"]; // FOTOCOPIAS POR CLIENTE
                    $fechaVencimiento = $datosIngCalculo[0]["fechaVencimiento"]; // VENCIMIENTO DE LA TARIFA
                    $fechaSalida = $fechaCorte; // FECHA DE SALIDA DE LA MERCADERIA
                    $fechaIngreso = $nuevafechaInicio; // FECHA DE INGRESO
                    $tiempoTotal = funcionesDeCalculo::dias($fechaIngreso, $fechaSalida); // DIAS TOTAL EN ALMACENADORA                     

                    if ($tiempoTotal >= $results[0]["delZA"]) {
                        $diaAlmacenaje = ($tiempoTotal - $results[0]["delZA"]) + 1;
                        $diasZA = $tiempoTotal - $diaAlmacenaje;
                    } else if ($tiempoTotal <= $results[0]["delZA"]) {
                        $diaAlmacenaje = 0;
                        $diasZA = $tiempoTotal - $diaAlmacenaje;
                    }
                    $respuestaAlmacenaje = calculosRubros::almacenajeFiscalCalculo($peridoAlm, $TarifaAlm, $impuestos, $diaAlmacenaje, $minAlmacenaje); // OBJETO CALCULA ALMACENAJE EN BASE A LOS PARAMETROS.
                    $respuestaZonaAduanera = calculosRubros::zonaAduaneraCalculo($diasZA, $peridoZona, $tarifaZA, $cif, $minZonaAduanera); // OBJETO CALCULA EL RUBRO ZONA ADUANERA

                    $respuestaManejo = calculosRubros::manejoCalculo($baseManejo, $tarifaManejo, $valPeso, $minimoManejo); // OBJETO CALCULA EL VALOR MANEJO
                    $respuestaGastosAdmin = calculosRubros::gastosAdminCalculo($TarifaGtsAdmin, $cantClientes, $minGastosAdministracion); // OBJETO CALCULA GASTOS ADMIN
                    $gtoAdminMSuperior = ceil($respuestaGastosAdmin);
                    $almaMSuperior = ceil($respuestaAlmacenaje / 10) * 10;
                    $zonaAduaneraCalc = intval($respuestaZonaAduanera);
                    $zonaAduanMSuperior = ceil($zonaAduaneraCalc / 10) * 10 + $defaultCopias;
                    $totalCobrar = ($almaMSuperior + $zonaAduanMSuperior + $respuestaManejo + $gtoAdminMSuperior);
                    $datos = array("almaMSuperior" => $almaMSuperior, "zonaAduanMSuperior" => $zonaAduanMSuperior, "calculoManejo" => $respuestaManejo, "gtoAdminMSuperior" => $gtoAdminMSuperior, "tiempoTotal" => $tiempoTotal, "nuevafechaInicio" => $nuevafechaInicio, "fechaCorte" => $fechaCorte);
                    return $datos;
                }
            }
        } else {
            return sqlsrv_errors();
        }
    }

    public static function mdlConsultDatosRet($idNumRetConsult) {
        $params = array(&$idNumRetConsult);
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spDetRetSal ?";
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
            return "sd";
        }
    }

    public static function mdlConsultaDatosGen($idRetDatosGen) {
        $params = array(&$idRetDatosGen);
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spCltDatosSal ?";
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
            return "sd";
        }
    }

    public static function mdlConsultaDatosGenPiloto($idRetDatosGen) {
        $params = array(&$idRetDatosGen);
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spDatoPlt ?";
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
            return "sd";
        }
    }

    public static function mdlConsultaDatosGenUnidad($idRetDatosGen) {
        $params = array(&$idRetDatosGen);
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spDatoUnd ?";
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
            return "sd";
        }
    }

    public static function mdlMostrarOtrosServicios($sp) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE " . $sp;
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
            return "sd";
        }
    }

    public static function mdlAccionesRetDosParam($sp, $idRetAutorizado, $estado, $asignar, $usuarioOp) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE " . $sp . " ?, ?, ?, ?";
        $params = array(&$idRetAutorizado, &$estado, &$asignar, &$usuarioOp);
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

    public static function mdlValidacionCobro($sp, $param) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE " . $sp . " ?";
        $params = array(&$param);
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
public static function mdlAuxiliares($retiroF, $tipo, $sp){
          $conn = Conexion::Conectar();
        $sql = "EXECUTE " . $sp . " ?, ?";
        $params = array(&$retiroF, &$tipo);
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
    public static function mdlAgregarServicios($sp, $idRetCal, $serviciosOtros, $valorOtros) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE " . $sp . " ?, ?, ?";
        $params = array(&$idRetCal, $serviciosOtros, $valorOtros);

        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            return "Ok";
        } else {
            return sqlsrv_errors();
        }
    }

    public static function mdlGuardarNuevoRecibo($idRetCal, $almaMSuperior, $zonaAduanMSuperior, $calculoManejo, $gtoAdminMSuperior, $nuevafechaInicio, $fechaCorte, $usuarioOp) {
        $conn = Conexion::Conectar();
        /*  FORMATO DE FECHA INICIAL.  */
        $fechaIngreso = $nuevafechaInicio;
        $fechaIngFormat = date("Y-m-d", strtotime($fechaIngreso));
        /*  FORMAT FECHA DE CORTE.  */
        $fechaCorteFormat = date("Y-m-d", strtotime($fechaCorte));
        $idRetCal = $idRetCal * 1;
        $params = array(&$idRetCal, &$almaMSuperior, &$zonaAduanMSuperior, &$calculoManejo, &$gtoAdminMSuperior, &$usuarioOp);

        $sql = "EXECUTE spGdServCobrados ?, ?, ?, ?, ?, ?";
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
            return "sd";
        }
    }



}

class calculosRubros {

    public static function almacenajeFiscalCalculo($peridoAlm, $TarifaAlm, $impuestos, $diaAlmacenaje, $minAlmacenaje) {
        if ($peridoAlm == "Diario") {
            $TarifaAlm = ($TarifaAlm / 100);
            $almacenajeF = ($TarifaAlm * $impuestos * $diaAlmacenaje);
            if ($diaAlmacenaje === 0) {
                return 0;
            }
            if ($almacenajeF <= $minAlmacenaje) {
                return $minAlmacenaje;
            }
            if ($almacenajeF > $minAlmacenaje) {
                return $almacenajeF;
            }
        }
    }

    public static function zonaAduaneraCalculo($diasZA, $peridoZona, $tarifaZA, $cif, $minZonaAduanera) {

        if ($peridoZona == "Mensual") {
            $tarifaZA = (($tarifaZA / 100) * 12 / 365);
            $zonaAduanera = ($cif * $tarifaZA * $diasZA);

            if ($zonaAduanera <= $minZonaAduanera) {
                return ($minZonaAduanera - 10);
            } else if ($zonaAduanera > $minZonaAduanera) {
                return $zonaAduanera;
            }
        }
    }

    public static function manejoCalculo($baseManejo, $tarifaManejo, $valPeso, $minimoManejo) {
        if ($baseManejo === "Tonelada") {
            $valPeso = ceil($valPeso / 1000);
            $manejo = ($tarifaManejo * $valPeso);
        }
        if ($manejo <= $minimoManejo) {
            return $minimoManejo;
        } else if ($manejo > $minimoManejo) {
            return $manejo;
        }
    }

    public static function gastosAdminCalculo($TarifaGtsAdmin, $cantClientes, $minGastosAdministracion) {
        if ($cantClientes === 1) {
            return $TarifaGtsAdmin;
        } else if ($cantClientes >= 6) {
            return $minGastosAdministracion;
        } else if ($cantClientes <= 5) {
            return ($TarifaGtsAdmin / $cantClientes);
        }
    }

}
