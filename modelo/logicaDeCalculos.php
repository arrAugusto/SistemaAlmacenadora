<?php

require_once "cone.php";
/* ==================================
  MOSTRAR TARIFA PARA CALCULAR
  ================================== */

class TarifaCalculo {

    public static function mostrarTarifa($buttonidingreso) {
        $conn = Conexion::Conectar();
        $params = array(&$buttonidingreso);
        $sql = "EXECUTE spTarifaCalc ?";
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

    public static function mostrarTarifaManejo($idTarifa) {
        $conn = Conexion::Conectar();
        $params = array(&$idTarifa);
        $sql = "EXECUTE spMstManejo ?";
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

    public static function mostrarTarifaSeguro($idTarifa) {
        $conn = Conexion::Conectar();
        $params = array(&$idTarifa);
        $sql = "EXECUTE spMstSeguro ?";
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

    public static function mostrarTarifaGtsAdmin($idTarifa) {
        $conn = Conexion::Conectar();
        $params = array(&$idTarifa);
        $sql = "EXECUTE spMstGtsAd ?";
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

}

/* ==========================================================
  CALCULO DE ALMACENAJE FISCAL.
  =========================================================== */

class calculosAlmacenFiscal {

    public static function calculoConCorteFacturado($resCalSaldoDiarioBaseDiaria, $fechaInicialCorte, $buttonidingreso) {
        $fechaCorteBusqueda = date("d-m-Y", strtotime($fechaInicialCorte));
        $numMesFBuscada = date("m", strtotime($fechaCorteBusqueda));
        $numAnioFBuscada = date("Y", strtotime($fechaCorteBusqueda));
        // Lista vacia, hacer detalle de lo cobrado y pendiente de cobrar
        $listaDefCliente = [];
        foreach ($resCalSaldoDiarioBaseDiaria as $key => $value) {
            $fechaInFormat = date("d-m-Y", strtotime($value["fechaIn"]));
            $numMesFInFormat = date("m", strtotime($fechaInFormat));
            $numAnioFInFormat = date("Y", strtotime($fechaInFormat));

            $fechaCorteFormat = date("d-m-Y", strtotime($value["fechaCorte"]));
            $numMesFCorteFormat1 = date("m", strtotime($fechaCorteFormat));
            $numAnioFCorteFormat1 = date("Y", strtotime($fechaCorteFormat));

            if ($numMesFBuscada == $numMesFInFormat && $numAnioFBuscada == $numAnioFInFormat && $numMesFBuscada == $numMesFCorteFormat1 && $numAnioFBuscada == $numAnioFCorteFormat1) {
                break;
            }
        }
        for ($i = 0; $i < $key; $i++) {
            array_push($listaDefCliente, $resCalSaldoDiarioBaseDiaria[$i]);
            unset($resCalSaldoDiarioBaseDiaria[$i]);
        }
        return array("pendienteDeCobro" => $resCalSaldoDiarioBaseDiaria, "cobrado" => $listaDefCliente);
    }

    public static function calculosCorteControlado($arraySaldos, $respuestaTarifa, $fechaInicio, $fechaCalcEsp, $respuestaManejo, $respuestaSeguro, $respuestaGstsAdmin) {
        $clientes = 0;
        $tarifaManejo = $respuestaManejo[0]["valorManejo"];
        $base = $respuestaTarifa[0]["base"];
        $calculoSobre = $respuestaTarifa[0]["calculoSobre"];
        $periodoCalculo = $respuestaTarifa[0]["periodoCalculo"];
        if ($respuestaSeguro == "SD") {
            $PeriodoSeguro = "SD";
            $periodoCalculoSeg = "SD";
            $tarifaSeguro = 0;
        } else if ($respuestaSeguro != "SD") {
            $PeriodoSeguro = $respuestaSeguro[0]["periodSeguro"];
            $periodoCalculoSeg = $respuestaSeguro[0]["periodoCalculo"];
            $tarifaSeguro = $respuestaSeguro[0]["valorSeguro"];
        }
        $tipoTrans = $respuestaGstsAdmin[0]["basegastosAdmin"];
        //fecha del ultimo corte para tomar como base inicial esa fecha.
        $fechaFin = $fechaCalcEsp;
        $datetimeInicio = new DateTime($fechaInicio);
        $datetimeFin = new DateTime($fechaFin);
        $interval = $datetimeFin->diff($datetimeInicio);
        $cantidadMeses = $interval->format("%m") + 1;
        $arrayCalculosConRetiros = [];
        for ($i = 0; $i < $cantidadMeses; $i++) {
            if ($i + 1 == $cantidadMeses) {
                $resultsSaldo = array("numeroPoliza" => $arraySaldos[$i]["poliza"]);
                $resultsSaldos = array(0 => $resultsSaldo);
                $arrayMovimiento = array("saldoPos" => $arraySaldos[$i]["posSaldo"], "saldoBultos" => $arraySaldos[$i]["unidades"], "saldoCif" => $arraySaldos[$i]["cifImpuestos"], "saldoImpuesto" => 0);
                $arrayMovimientos = array(0 => $arrayMovimiento);
                $respuestaTipo1 = funcionArmarDetalles::detalleDeCalculos($arrayMovimientos, $resultsSaldos, $fechaInicio, $fechaFin, $respuestaTarifa, $base, $calculoSobre, $periodoCalculo, $tarifaManejo, $respuestaSeguro, $tarifaSeguro, $PeriodoSeguro, $periodoCalculoSeg, $tipoTrans, $clientes);
                foreach ($respuestaTipo1 as $keys => $values) {
                    array_push($arrayCalculosConRetiros, $values);
                }
            }
        }
        return $arrayCalculosConRetiros;
    }

    public static function calculosPendienteCobro($arraySaldos, $respuestaTarifa, $fechaCalcEsp, $respuestaManejo, $respuestaSeguro, $respuestaGstsAdmin) {
        $clientes = 0;
        $tarifaManejo = $respuestaManejo[0]["valorManejo"];
        $base = $respuestaTarifa[0]["base"];
        $calculoSobre = $respuestaTarifa[0]["calculoSobre"];
        $periodoCalculo = $respuestaTarifa[0]["periodoCalculo"];
        if ($respuestaSeguro == "SD") {
            $PeriodoSeguro = "SD";
            $periodoCalculoSeg = "SD";
            $tarifaSeguro = 0;
        } else if ($respuestaSeguro != "SD") {
            $PeriodoSeguro = $respuestaSeguro[0]["periodSeguro"];
            $periodoCalculoSeg = $respuestaSeguro[0]["periodoCalculo"];
            $tarifaSeguro = $respuestaSeguro[0]["valorSeguro"];
        }
        $tipoTrans = $respuestaGstsAdmin[0]["basegastosAdmin"];
        //fecha del ultimo corte para tomar como base inicial esa fecha.
        $fechaInicio = $fechaCalcEsp;
        $fechaFin = $arraySaldos[0]["fechaCorte"];
        $datetimeInicio = new DateTime($fechaInicio);
        $datetimeFin = new DateTime($fechaFin);
        $interval = $datetimeFin->diff($datetimeInicio);
        $cantidadMeses = $interval->format("%m") + 1;
        $arrayCalculosConRetiros = [];
        return $cantidadMeses;
    }

    public static function calculoSaldoDiarioBaseDiaria($resultsSaldos, $arraySaldos, $respuestaTarifa, $respuestaManejo, $respuestaSeguro, $respuestaGstsAdmin, $resultsSaldosR) {

        date_default_timezone_set('America/Guatemala');
        $date = date('d-m-Y');
        $arrayCalculos = [];
        /*  ///////////////////////////////////Quitar */
        $numeroPoliza = $resultsSaldos[0]["numeroPoliza"];
        $volumenPeso = $resultsSaldos[0]["peso"];
        $numeroPosiciones = $resultsSaldos[0]["posicion"];
        $BultosIngreso = $resultsSaldos[0]["bultos"];
        $cifImpuestos = ($resultsSaldos[0]["totalValorCif"] + $resultsSaldos[0]["valorImpuesto"]);
        /*  //////////////////////////////////// Quitar */
        /*  FORMATO DE FECHA INICIAL.  */
        $fechaIngreso = $resultsSaldos[0]["fechaIngreso"];
        $fechaIngFormat = date("d-m-Y", strtotime($fechaIngreso));


        if ($arraySaldos == 0) {
            $fechaCorteFormat = $date;
        } else {
            /*  FORMAT FECHA DE CORTE.  */
            $fechaCorte = $arraySaldos[0]["saldoFechaSig"];
            $fechaCorteFormat = date("d-m-Y", strtotime($fechaCorte));
        }
        $tarifaManejo = $respuestaManejo[0]["valorManejo"];
        $date1 = $fechaIngFormat;
        $date2 = $fechaCorteFormat;
        $numMes1 = date("m", strtotime($date1));
        $numMes2 = date("m", strtotime($date2));
        $numDia1 = date("d", strtotime($date1));
        $numDia2 = date("d", strtotime($date2));
        $numAnio1 = date("Y", strtotime($date1));
        $numAnio2 = date("Y", strtotime($date2));
        $valorTarifa = round($respuestaTarifa[0]["valTarifa"], 2);
        $base = $respuestaTarifa[0]["base"];
        $calculoSobre = $respuestaTarifa[0]["calculoSobre"];
        $periodoCalculo = $respuestaTarifa[0]["periodoCalculo"];
        if ($respuestaSeguro == "SD") {
            $PeriodoSeguro = "SD";
            $periodoCalculoSeg = "SD";
            $tarifaSeguro = 0;
        } else if ($respuestaSeguro != "SD") {
            $PeriodoSeguro = $respuestaSeguro[0]["periodSeguro"];
            $periodoCalculoSeg = $respuestaSeguro[0]["periodoCalculo"];
            $tarifaSeguro = $respuestaSeguro[0]["valorSeguro"];
        }
        $tipoTrans = $respuestaGstsAdmin[0]["basegastosAdmin"];
        $clientes = $resultsSaldos[0]["cantidadClientes"];

        /** ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ */
        /** ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ */
        /** ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ */
        /** ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ */
        if ($arraySaldos == 0) {

            if ($numMes1 == $numMes2 && $numAnio1 == $numAnio2) {
                $dias = funcionesDeCalculo::dias($fechaIngFormat, $fechaCorteFormat);
                /* CALCULO DE ALMACENAJE. */
                $respuestaAlmacenaje = funcionesDeCalculo::calculoAlmacenDiario($fechaIngFormat, $fechaCorteFormat, $valorTarifa, $dias, $numeroPosiciones, $base, $calculoSobre, $periodoCalculo);
                /* CALCULO DE MANEJO. */
                $roundManejo = ceil($volumenPeso / 1000);
                $resManejo = funcionesDeCalculo::calculoManejo($tarifaManejo, $volumenPeso);
                /* CALCULO DE SEGURO. */
                if ($respuestaSeguro != "SD") {
                    $resSeguro = funcionesDeCalculo::calculoSeguro($tarifaSeguro, $dias, $cifImpuestos, $PeriodoSeguro, $periodoCalculoSeg);
                } else {
                    $resSeguro = 0;
                }
                /* TRANSMISION ELECTRONICA. */
                $resTrasnmision = funcionesDeCalculo::calculoTransElectronica($tipoTrans, $clientes);
                $totalCalculo = round(($respuestaAlmacenaje + $resManejo + $resSeguro + $resTrasnmision), 2);
                $datos = array("poliza" => $numeroPoliza,
                    "valorTarifa" => $valorTarifa,
                    "posSaldo" => $numeroPosiciones,
                    "fechaIn" => $fechaIngFormat,
                    "fechaCorte" => $fechaCorteFormat,
                    "dias" => $dias,
                    "unidades" => $BultosIngreso,
                    "cifImpuestos" => $cifImpuestos,
                    "almacenaje" => $respuestaAlmacenaje,
                    "toneladas" => $roundManejo,
                    "pesoCalculo" => $resManejo,
                    "resSeguro" => $resSeguro,
                    "calcGstAdmin" => $resTrasnmision,
                    "totalAlmacenaje" => $totalCalculo);
                array_push($arrayCalculos, $datos);
                /* -------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
            } else {
                $dateFin = date('d-m-Y');
                $datetimeInicio = new DateTime($fechaIngFormat);
                $datetimeFin = new DateTime($dateFin);
                $interval = $datetimeFin->diff($datetimeInicio);
                # obtenemos la diferencia en meses
                $diferenciaMeses = $interval->format("%m") + 1;

                for ($i = 0; $i < $diferenciaMeses; $i++) {
                    if ($i == 0) {
                        $diasCalculo = funcionTiempo::diasCalculo($date1, $date1);
                        $diferenciaDias = ($diasCalculo - $numDia1);
                        $fechaPrimerCorte = $diasCalculo . '-' . $numMes1 . '-' . $numAnio1;
                        /* RESTA ENTRE FECHAS EXPRESADO EN DIAS. */
                        $dias = funcionesDeCalculo::dias($fechaIngFormat, $fechaPrimerCorte);
                        /* CALCULO DE ALMACENAJE. */
                        $respuestaAlmacenaje = funcionesDeCalculo::calculoAlmacenDiario($fechaIngFormat, $fechaPrimerCorte, $valorTarifa, $dias, $numeroPosiciones, $base, $calculoSobre, $periodoCalculo);
                        /* CALCULO DE MANEJO. */
                        $roundManejo = ceil($volumenPeso / 1000);
                        $resManejo = funcionesDeCalculo::calculoManejo($tarifaManejo, $volumenPeso);
                        /* CALCULO DE SEGURO. */
                        if ($respuestaSeguro != "SD") {
                            $resSeguro = funcionesDeCalculo::calculoSeguro($tarifaSeguro, $dias, $cifImpuestos, $PeriodoSeguro, $periodoCalculoSeg);
                        } else {
                            $resSeguro = 0;
                        }
                        $resTrasnmision = funcionesDeCalculo::calculoTransElectronica($tipoTrans, $clientes);
                        $totalCalculo = round(($respuestaAlmacenaje + $resManejo + $resSeguro + $resTrasnmision), 2);
                        $tipo = 0;
                        $key = 0;
                        $respuestaArrayDetallesYCaclulos = detallesYCalculos::DetallesCalculos($tipo, $key, $resultsSaldos, $arraySaldos, $respuestaTarifa, $respuestaManejo, $respuestaSeguro, $respuestaGstsAdmin, $fechaIngFormat, $fechaPrimerCorte, $dias, $respuestaAlmacenaje, $roundManejo, $resManejo, $resSeguro, $resTrasnmision, $totalCalculo);
                        foreach ($respuestaArrayDetallesYCaclulos as $key => $value) {
                            array_push($arrayCalculos, $value);
                        }
                        $nuevafechaInicio = strtotime('+1 day', strtotime($fechaPrimerCorte));
                        $nuevafechaInicio = date('d-m-Y', $nuevafechaInicio);
                        $diasCalculo = funcionTiempo::diasCalculo($nuevafechaInicio, $nuevafechaInicio);
                        $numFinMes = date("m", strtotime($nuevafechaInicio));
                        $numFinAnio = date("Y", strtotime($nuevafechaInicio));
                        $formatRecorrido = $diasCalculo . '-' . $numFinMes . '-' . $numFinAnio;
                    }
                    if ($i >= 1 && $i != $diferenciaMeses - 1) {
                        $dias = funcionesDeCalculo::dias($nuevafechaInicio, $formatRecorrido);
                        /* CALCULO DE ALMACENAJE. */
                        $respuestaAlmacenaje = funcionesDeCalculo::calculoAlmacenDiario($nuevafechaInicio, $formatRecorrido, $valorTarifa, $dias, $numeroPosiciones, $base, $calculoSobre, $periodoCalculo);
                        /* CALCULO DE SEGURO. */
                        if ($respuestaSeguro != "SD") {
                            $resSeguro = funcionesDeCalculo::calculoSeguro($tarifaSeguro, $dias, $cifImpuestos, $PeriodoSeguro, $periodoCalculoSeg);
                        } else {
                            $resSeguro = 0;
                        }
                        /* CALCULO DE MANEJO. */
                        $roundManejo = 0;
                        $resManejo = 0;
                        $resTrasnmision = 0;
                        $totalCalculo = round(($respuestaAlmacenaje + $resManejo + $resSeguro + $resTrasnmision), 2);
                        $tipo = 3;
                        $key = 0;
                        $respuestaArrayDetallesYCaclulos = detallesYCalculos::DetallesCalculos($tipo, $key, $resultsSaldos, $arraySaldos, $respuestaTarifa, $respuestaManejo, $respuestaSeguro, $respuestaGstsAdmin, $nuevafechaInicio, $formatRecorrido, $dias, $respuestaAlmacenaje, $roundManejo, $resManejo, $resSeguro, $resTrasnmision, $totalCalculo);
                        foreach ($respuestaArrayDetallesYCaclulos as $key => $value) {
                            array_push($arrayCalculos, $value);
                        }
                        $nuevafechaInicio = strtotime('+1 day', strtotime($formatRecorrido));
                        $nuevafechaInicio = date('d-m-Y', $nuevafechaInicio);
                        $diasCalculo = funcionTiempo::diasCalculo($nuevafechaInicio, $nuevafechaInicio);
                        $numFinMes = date("m", strtotime($nuevafechaInicio));
                        $numFinAnio = date("Y", strtotime($nuevafechaInicio));
                        $formatRecorrido = $diasCalculo . '-' . $numFinMes . '-' . $numFinAnio;
                    }
                    if ($i == $diferenciaMeses - 1) {
                        /* RESTA ENTRE FECHAS EXPRESADO EN DIAS. */
                        $dias = funcionesDeCalculo::dias($nuevafechaInicio, $date);
                        /* CALCULO DE ALMACENAJE.  */
                        $respuestaAlmacenaje = funcionesDeCalculo::calculoAlmacenDiario($nuevafechaInicio, $date, $valorTarifa, $dias, $numeroPosiciones, $base, $calculoSobre, $periodoCalculo);
                        /* CALCULO DE MANEJO. */
                        $roundManejo = 0;
                        $resManejo = 0;
                        /* CALCULO DE SEGURO. */
                        if ($respuestaSeguro != "SD") {
                            $resSeguro = funcionesDeCalculo::calculoSeguro($tarifaSeguro, $dias, $cifImpuestos, $PeriodoSeguro, $periodoCalculoSeg);
                        } else {
                            $resSeguro = 0;
                        }
                        $resTrasnmision = 0;
                        $totalCalculo = round(($respuestaAlmacenaje + $resManejo + $resSeguro + $resTrasnmision), 2);
                        $tipo = 3;
                        $key = 0;
                        $respuestaArrayDetallesYCaclulos = detallesYCalculos::DetallesCalculos($tipo, $key, $resultsSaldos, $arraySaldos, $respuestaTarifa, $respuestaManejo, $respuestaSeguro, $respuestaGstsAdmin, $nuevafechaInicio, $date, $dias, $respuestaAlmacenaje, $roundManejo, $resManejo, $resSeguro, $resTrasnmision, $totalCalculo);
                        foreach ($respuestaArrayDetallesYCaclulos as $key => $value) {
                            array_push($arrayCalculos, $value);
                        }
                    }
                }
            }
            return $arrayCalculos;
            /** ------------------------------------------------------------------------------------ */
            /** ------------------------------------------------------------------------------------ */
            /** ------------------------------------------------------------------------------------ */
            /** ------------------------------------------------------------------------------------ */
        } else if (count($arraySaldos) >= 1) {

            /* =====================================================
             * 	RECORRIDO $arraySaldos, SE TOMO LOS MOVIMIENTOS  
             * 	DE RETIROS COMO LIMITE SUPERIOR POR RECORRIDO,
             *  DE ESTA MANERA LOS PIVOTES (MOVIMIENTOS) SON
             *  REFERENCIA PARA SABER DONDE EXISTEN CORTES.
              ===================================================== */
            $arrayCalculosConRetiros = [];
            $mesInicio = $fechaIngFormat;
            // APERTURA DE ITERACIONES
            //fecha que es el limite al que debemos llegar con iteraciones


            $datetimeInicio = new DateTime($fechaIngFormat);
            $datetimeFin = new DateTime($arraySaldos[0]["saldoFechaSig"]);
            $interval = $datetimeFin->diff($datetimeInicio);
            # obtenemos la diferencia en meses
            $cantidadMeses = $interval->format("%m") + 1;


            for ($i = 0; $i < $cantidadMeses; $i++) {
                if ($i == 0 && $i + 1 == $cantidadMeses) {
                    $tipo = 4;
                    $primerCorteSinMovimientos = funcionArmarDetalles::primerCorteSinMov($resultsSaldos, $fechaIngFormat, $respuestaTarifa, $base, $calculoSobre, $periodoCalculo, $tarifaManejo, $respuestaSeguro, $tarifaSeguro, $PeriodoSeguro, $periodoCalculoSeg, $tipoTrans, $clientes, $corteFecha, $tipo);
                    $numero = count($primerCorteSinMovimientos) - 1;
                    $fechaSigMes = $primerCorteSinMovimientos[$numero]["fechaCorte"];
                    $fechaIngFormat = strtotime('+1 day', strtotime($fechaSigMes));
                    $fechaIngFormat = date('d-m-Y', $fechaIngFormat);
                    foreach ($primerCorteSinMovimientos as $keys => $values) {
                        array_push($arrayCalculosConRetiros, $values);
                    }
                }
                if ($i == 0 && $i + 1 != $cantidadMeses) {
                    if ($cantidadMeses >= 2) {
                        $tipo = 1;
                        $diasCalculo = funcionTiempo::diasCalculo($fechaIngFormat, $fechaIngFormat);
                        $numFinMes = date("m", strtotime($fechaIngFormat));
                        $numFinAnio = date("Y", strtotime($fechaIngFormat));
                        $corteFecha = $diasCalculo . '-' . $numFinMes . '-' . $numFinAnio;
                    } else {
                        $tipo = 0;
                    }
                    $primerCorteSinMovimientos = funcionArmarDetalles::primerCorteSinMov($resultsSaldos, $fechaIngFormat, $respuestaTarifa, $base, $calculoSobre, $periodoCalculo, $tarifaManejo, $respuestaSeguro, $tarifaSeguro, $PeriodoSeguro, $periodoCalculoSeg, $tipoTrans, $clientes, $corteFecha, $tipo);
                    $numero = count($primerCorteSinMovimientos) - 1;
                    $fechaSigMes = $primerCorteSinMovimientos[$numero]["fechaCorte"];
                    $fechaIngFormat = strtotime('+1 day', strtotime($fechaSigMes));
                    $fechaIngFormat = date('d-m-Y', $fechaIngFormat);
                    foreach ($primerCorteSinMovimientos as $keys => $values) {
                        array_push($arrayCalculosConRetiros, $values);
                    }
                }

                if ($i >= 1 && $i + 1 != $cantidadMeses) {
                    $tipo = 3;
                    $diasCalculo = funcionTiempo::diasCalculo($fechaIngFormat, $fechaIngFormat);
                    $numFinMes = date("m", strtotime($fechaIngFormat));
                    $numFinAnio = date("Y", strtotime($fechaIngFormat));
                    $corteFecha = $diasCalculo . '-' . $numFinMes . '-' . $numFinAnio;
                    $primerCorteSinMovimientos = funcionArmarDetalles::primerCorteSinMov($resultsSaldos, $fechaIngFormat, $respuestaTarifa, $base, $calculoSobre, $periodoCalculo, $tarifaManejo, $respuestaSeguro, $tarifaSeguro, $PeriodoSeguro, $periodoCalculoSeg, $tipoTrans, $clientes, $corteFecha, $tipo);
                    $numero = count($primerCorteSinMovimientos) - 1;
                    $fechaSigMes = $primerCorteSinMovimientos[$numero]["fechaCorte"];
                    $fechaIngFormat = strtotime('+1 day', strtotime($fechaSigMes));
                    $fechaIngFormat = date('d-m-Y', $fechaIngFormat);
                    foreach ($primerCorteSinMovimientos as $keys => $values) {
                        array_push($arrayCalculosConRetiros, $values);
                    }
                }
                if ($i + 1 == $cantidadMeses) {
                    $tipo = 3;
                    $corteFecha = $arraySaldos[0]["saldoFechaSig"];
                    $corteFecha = date("d-m-Y", strtotime($corteFecha));
                    $primerCorteSinMovimientos = funcionArmarDetalles::primerCorteSinMov($resultsSaldos, $fechaIngFormat, $respuestaTarifa, $base, $calculoSobre, $periodoCalculo, $tarifaManejo, $respuestaSeguro, $tarifaSeguro, $PeriodoSeguro, $periodoCalculoSeg, $tipoTrans, $clientes, $corteFecha, $tipo);
                    $numero = count($primerCorteSinMovimientos) - 1;
                    $fechaSigMes = $primerCorteSinMovimientos[$numero]["fechaCorte"];
                    $fechaIngFormat = strtotime('+1 day', strtotime($fechaSigMes));
                    $fechaIngFormat = date('d-m-Y', $fechaIngFormat);
                    $fDespuesDeCorte = $fechaIngFormat;
                    foreach ($primerCorteSinMovimientos as $keys => $values) {
                        array_push($arrayCalculosConRetiros, $values);
                    }
                }
            }


            //RECORRIENDO $arraySaldos RAZÓN DE CAMBIO
            if (count($arraySaldos) >= 2) {
                foreach ($arraySaldos as $key => $value) {
                    if ($key + 1 != count($arraySaldos)) {
                        //movimiento de referencia al que se tiene que llegar.
                        $arrayMovimientos = array(0 => $arraySaldos[$key]);
                        //fecha que es el limite al que debemos llegar con iteraciones


                        $datetimeInicio = new DateTime($fechaIngFormat);
                        $datetimeFin = new DateTime($arraySaldos[$key + 1]["saldoFechaSig"]);
                        $interval = $datetimeFin->diff($datetimeInicio);
                        # obtenemos la diferencia en meses
                        $cantidadMeses = $interval->format("%m") + 1;

                        //ciclo que itera de la fecha de ingreso al limite de fecha.
                        for ($i = 0; $i < $cantidadMeses; $i++) {
                            if ($cantidadMeses == 1 && $i + 1 == $cantidadMeses) {
                                $respuestaTipo1 = funcionArmarDetalles::detalleDeCalculos($arrayMovimientos, $resultsSaldos, $fechaIngFormat, $corteFecha, $respuestaTarifa, $base, $calculoSobre, $periodoCalculo, $tarifaManejo, $respuestaSeguro, $tarifaSeguro, $PeriodoSeguro, $periodoCalculoSeg, $tipoTrans, $clientes);
                                $numero = count($respuestaTipo1) - 1;
                                $fechaSigMes = $respuestaTipo1[$numero]["fechaCorte"];
                                $fechaIngFormat = strtotime('+1 day', strtotime($fechaSigMes));
                                $fechaIngFormat = date('d-m-Y', $fechaIngFormat);

                                foreach ($respuestaTipo1 as $keys => $values) {
                                    array_push($arrayCalculosConRetiros, $values);
                                }
                            }
                            if ($cantidadMeses >= 2 && $i + 1 != $cantidadMeses) {
                                $diasCalculo = funcionTiempo::diasCalculo($fechaIngFormat, $fechaIngFormat);
                                $numFinMes = date("m", strtotime($fechaIngFormat));
                                $numFinAnio = date("Y", strtotime($fechaIngFormat));
                                $corteFecha = $diasCalculo . '-' . $numFinMes . '-' . $numFinAnio;
                                $respuestaTipo1 = funcionArmarDetalles::detalleDeCalculos($arrayMovimientos, $resultsSaldos, $fechaIngFormat, $corteFecha, $respuestaTarifa, $base, $calculoSobre, $periodoCalculo, $tarifaManejo, $respuestaSeguro, $tarifaSeguro, $PeriodoSeguro, $periodoCalculoSeg, $tipoTrans, $clientes);
                                foreach ($respuestaTipo1 as $keys => $values) {
                                    array_push($arrayCalculosConRetiros, $values);
                                }
                                $numero = count($respuestaTipo1) - 1;
                                $fechaSigMes = $respuestaTipo1[$numero]["fechaCorte"];
                                $fechaIngFormat = strtotime('+1 day', strtotime($fechaSigMes));
                                $fechaIngFormat = date('d-m-Y', $fechaIngFormat);
                                $mesInicio = $fechaIngFormat;
                                $corteFecha = $arraySaldos[$key + 1]["saldoFechaSig"];
                                $corteFecha = date("d-m-Y", strtotime($corteFecha));
                            }
                            if ($i + 1 == $cantidadMeses && $cantidadMeses >= 2) {
                                $respuestaTipo1 = funcionArmarDetalles::detalleDeCalculos($arrayMovimientos, $resultsSaldos, $fechaIngFormat, $corteFecha, $respuestaTarifa, $base, $calculoSobre, $periodoCalculo, $tarifaManejo, $respuestaSeguro, $tarifaSeguro, $PeriodoSeguro, $periodoCalculoSeg, $tipoTrans, $clientes);
                                $numero = count($respuestaTipo1) - 1;
                                $fechaSigMes = $respuestaTipo1[$numero]["fechaCorte"];
                                $fechaIngFormat = strtotime('+1 day', strtotime($fechaSigMes));
                                $fechaIngFormat = date('d-m-Y', $fechaIngFormat);
                                $mesInicio = $fechaIngFormat;
                                foreach ($respuestaTipo1 as $keys => $values) {
                                    array_push($arrayCalculosConRetiros, $values);
                                }
                            }
                        }
                    } else if ($key >= 1 && $key + 1 == count($arraySaldos)) {
                        $contArrays = count($arraySaldos);
                        $arrayMovimientos = array(0 => $arraySaldos[$contArrays - 1]);
                    }
                }
            } else {
                $contArrays = count($arraySaldos);
                $arrayMovimientos = array(0 => $arraySaldos[$contArrays - 1]);
            }




            //*******************************************************************************************************
            // CIERRE DE MOVIMIENTOS
            if ($fechaIngFormat < date('d-m-Y')) {
                //fecha que es el limite al que debemos llegar con iteraciones


                $datetimeInicio = new DateTime($fechaIngFormat);
                $datetimeFin = new DateTime($date);
                $interval = $datetimeFin->diff($datetimeInicio);
                # obtenemos la diferencia en meses
                $cantidadMeses = $interval->format("%m") + 1;


                // ciclo iteraciones del ultimo movimiento a fecha actual o fecha que se desea el calculo.
                for ($i = 0; $i < $cantidadMeses; $i++) {
                    if ($cantidadMeses == 1) {
                        $corteFecha = date('d-m-Y');
                        $respuestaTipo1 = funcionArmarDetalles::detalleDeCalculos($arrayMovimientos, $resultsSaldos, $fechaIngFormat, $corteFecha, $respuestaTarifa, $base, $calculoSobre, $periodoCalculo, $tarifaManejo, $respuestaSeguro, $tarifaSeguro, $PeriodoSeguro, $periodoCalculoSeg, $tipoTrans, $clientes);
                        foreach ($respuestaTipo1 as $keys => $value) {
                            array_push($arrayCalculosConRetiros, $value);
                        }
                        return $arrayCalculosConRetiros;
                    }
                    if ($cantidadMeses >= 2 && $i + 1 != $cantidadMeses) {
                        $diasCalculo = funcionTiempo::diasCalculo($fechaIngFormat, $fechaIngFormat);
                        $numFinMes = date("m", strtotime($fechaIngFormat));
                        $numFinAnio = date("Y", strtotime($fechaIngFormat));
                        $corteFecha = $diasCalculo . '-' . $numFinMes . '-' . $numFinAnio;
                        $respuestaTipo1 = funcionArmarDetalles::detalleDeCalculos($arrayMovimientos, $resultsSaldos, $fechaIngFormat, $corteFecha, $respuestaTarifa, $base, $calculoSobre, $periodoCalculo, $tarifaManejo, $respuestaSeguro, $tarifaSeguro, $PeriodoSeguro, $periodoCalculoSeg, $tipoTrans, $clientes);
                        $numero = count($respuestaTipo1) - 1;
                        $fechaSigMes = $respuestaTipo1[$numero]["fechaCorte"];
                        $fechaIngFormat = strtotime('+1 day', strtotime($fechaSigMes));
                        $fechaIngFormat = date('d-m-Y', $fechaIngFormat);
                        foreach ($respuestaTipo1 as $keys => $value) {
                            array_push($arrayCalculosConRetiros, $value);
                        }
                    }

                    if ($cantidadMeses >= 2 && $i + 1 == $cantidadMeses) {
                        $corteFecha = date('d-m-Y');
                        $respuestaTipo1 = funcionArmarDetalles::detalleDeCalculos($arrayMovimientos, $resultsSaldos, $fechaIngFormat, $corteFecha, $respuestaTarifa, $base, $calculoSobre, $periodoCalculo, $tarifaManejo, $respuestaSeguro, $tarifaSeguro, $PeriodoSeguro, $periodoCalculoSeg, $tipoTrans, $clientes);
                        foreach ($respuestaTipo1 as $keys => $value) {
                            array_push($arrayCalculosConRetiros, $value);
                        }
                    }
                }
            }
            return $arrayCalculosConRetiros;
            //retornando calculos de almacenaje.
        }
    }

}

class funcionesDeCalculo {

    public static function calculoAlmacenDiario($fechaIngFormat, $fechaCorteFormat, $valorTarifa, $dias, $numeroPosiciones, $base, $calculoSobre, $periodoCalculo) {
        $tarifa = $valorTarifa;
        $posiciones = $numeroPosiciones;
        $date1 = $fechaIngFormat;
        $date2 = $fechaCorteFormat;
        $numMes1 = date("m", strtotime($date1));
        $numMes2 = date("m", strtotime($date2));
        $numDia1 = date("d", strtotime($date1));
        $numDia2 = date("d", strtotime($date2));
        $numAnio1 = date("Y", strtotime($date1));
        $numAnio2 = date("Y", strtotime($date2));
        if ($calculoSobre = "Saldo Diario" && $periodoCalculo == "Diario") {
            if ($base == "Metros³" || $base == "Metros²" || $base == "Posiciones") {
                if ($numAnio1 == $numAnio2) {
                    if ($numMes1 == $numMes2) {
                        /* CALCULO, EN EL MISMO AÑO, EN EL MISMO MES COBRO DENTRO DE LOS DIAS DEL MES */
                        if ($numDia1 <= $numDia2) {
                            $parametro = "Dias";
                            $diferenciaDias = funcionTiempo::diferenciaDias($date1, $date2);
                            $diasCalculo = funcionTiempo::diasCalculo($date1, $date2);
                            if ($periodoCalculo == "Mensual") {
                                $almacenaje = (($tarifa / $diasCalculo) * $diferenciaDias * $posiciones);
                            } else if ($periodoCalculo == "Diario") {
                                return round(($valorTarifa * $diferenciaDias * $numeroPosiciones), 2);
                            }
                        } else if ($numDia1 > $numDia2) {
                            return 0;
                        }
                        /* CALCULO, EN EL MISMO AÑO, EN DIFERENTES MESES MES COBRO DENTRO DE LOS DIAS DEL MES */
                    } else if ($numMes1 < $numMes2) {
                        $direnciaMeses = funcionTiempo::diferenciaMeses($date1, $date2);
                        $limite = $direnciaMeses;
                        //*ciclo for sumando almacenajes, conforme su mes*/
                        $totalAlm = 0;
                        for ($i = 0; $i < $direnciaMeses; $i++) {
                            if ($i == 0) {
                                $diasCalculo = funcionTiempo::diasCalculo($date1, $date1);
                                $numDia1 = date("d", strtotime($date1));
                                $primerMes = ($diasCalculo - $numDia1) + 1;
                                if ($periodoCalculo == "Mensual") {
                                    $almacenaje = (($tarifa / $diasCalculo) * $primerMes * $posiciones);
                                    $totalAlm = $totalAlm + $almacenaje;
                                } else if ($periodoCalculo == "Diario") {
                                    $almacenaje = round(($valorTarifa * $diasCalculo * $numeroPosiciones), 2);
                                    $totalAlm = $totalAlm + $almacenaje;
                                }
                            } else if ($i >= 1) {
                                $contadorFecha = $i;
                                if ($i + 1 < $limite) {
                                    $nuevafecha = strtotime('+' . $contadorFecha . ' month', strtotime($date1));
                                    $nuevafecha = date('d-m-Y', $nuevafecha);
                                    $diasCalculo = funcionTiempo::diasCalculo($nuevafecha, $nuevafecha);
                                    if ($periodoCalculo == "Mensual") {
                                        $almacenaje = (($tarifa / $diasCalculo) * $primerMes * $posiciones);
                                        $totalAlm = $totalAlm + $almacenaje;
                                    } else if ($periodoCalculo == "Diario") {
                                        $almacenaje = round(($valorTarifa * $primerMes * $numeroPosiciones), 2);
                                        $totalAlm = $totalAlm + $almacenaje;
                                    }
                                } else if ($i + 1 == $limite) {
                                    $diasCalculo = funcionTiempo::diasCalculo($date2, $date2);
                                    $numDia1 = date("d", strtotime($date2));
                                    if ($periodoCalculo == "Mensual") {
                                        $almacenaje = (($tarifa / $diasCalculo) * $primerMes * $posiciones);
                                        $totalAlm = $totalAlm + $almacenaje;
                                    } else if ($periodoCalculo == "Diario") {
                                        $almacenaje = round(($valorTarifa * $numDia1 * $numeroPosiciones), 2);
                                        $totalAlm = $totalAlm + $almacenaje;
                                    }
                                }
                            }
                        }
                        return round($totalAlm, 2);
                    } else if ($numMes1 > $numMes2) {
                        return 0;
                    }
                } else if ($numAnio1 <= $numAnio2) {
                    $direnciaMeses = funcionTiempo::diferenciaMeses($date1, $date2);
                    $limite = $direnciaMeses;
                    //*ciclo for sumando almacenajes, conforme su mes*/
                    $totalAlm = 0;
                    for ($i = 0; $i < $direnciaMeses; $i++) {
                        if ($i == 0) {
                            $diasCalculo = funcionTiempo::diasCalculo($date1, $date1);
                            $numDia1 = date("d", strtotime($date1));
                            $primerMes = ($diasCalculo - $numDia1) + 1;
                            $almacenaje = (($tarifa / $diasCalculo) * $primerMes * $posiciones);
                            $totalAlm = $totalAlm + $almacenaje;
                        } else if ($i >= 1) {
                            $contadorFecha = $i;
                            if ($i + 1 < $limite) {
                                $nuevafecha = strtotime('+' . $contadorFecha . ' month', strtotime($date1));
                                $nuevafecha = date('d-m-Y', $nuevafecha);
                                $diasCalculo = funcionTiempo::diasCalculo($nuevafecha, $nuevafecha);
                                $almacenaje = (($tarifa / $diasCalculo) * $diasCalculo * $posiciones);
                                $totalAlm = $totalAlm + $almacenaje;
                            } else if ($i + 1 == $limite) {
                                $diasCalculo = funcionTiempo::diasCalculo($date2, $date2);
                                $numDia1 = date("d", strtotime($date2));
                                $almacenaje = (($tarifa / $diasCalculo) * $numDia1 * $posiciones);
                                $totalAlm = $totalAlm + $almacenaje;
                            }
                        }
                    }
                    return round($totalAlm, 2);
                } else if ($numAnio1 > $numAnio2) {
                    return 0;
                }
            }
        } else if ($calculoSobre = "Saldo Diario" && $periodoCalculo == "Mensual") {
            $diferenciaDias = funcionTiempo::diferenciaDias($date1, $date2);
            $diasCalculo = funcionTiempo::diasCalculo($date1, $date2);
            if ($base == "Metros³" || $base == "Metros²" || $base == "Posiciones") {
                return round(($valorTarifa / $diasCalculo * $numeroPosiciones), 2);
            }
        }
    }

    public static function calculoManejo($tarifaManejo, $volumenPeso) {
        $roundManejo = ceil($volumenPeso / 1000);
        $pesoCalculo = round(($roundManejo * $tarifaManejo), 0);
        return $pesoCalculo;
    }

    public static function calculoSeguro($tarifaSeguro, $dias, $cifImpuestos, $PeriodoSeguro, $periodoCalculoSeg) {
        if ($tarifaSeguro != "SD") {
            if ($periodoCalculoSeg == "Diario") {
                $porcentaje = ($tarifaSeguro / 100);
                $valorSeguro = round(($porcentaje * $dias * $cifImpuestos), 2);
                return $valorSeguro;
            } else if ($periodoCalculoSeg == "Anual") {
                $porcentaje = ($tarifaSeguro / 100 / 365);
                $valorSeguro = round(($porcentaje * $dias * $cifImpuestos), 2);
                return $valorSeguro;
            } else if ($periodoCalculoSeg == "Mensual") {
                $porcentaje = ($tarifaSeguro * 12 / 365);
                $valorSeguro = round(($porcentaje * $dias * $cifImpuestos), 2);
                return $valorSeguro;
            }
        } else {
            return 0;
        }
    }

    public static function calculoTransElectronica($tipoTrans, $clientes) {
        if ($tipoTrans == "Individual" && $clientes >= 1) {
            return round((100 / $clientes), 2);
        }
    }

    public static function dias($fechaIngFormat, $fechaCorteFormat) {
        $fecha1 = new DateTime($fechaIngFormat);
        $fecha2 = new DateTime($fechaCorteFormat);
        $diff = $fecha1->diff($fecha2);
        $dias = ($diff->days + 1);
        return $dias;
    }

}

class funcionTiempo {

    public static function diferenciaDias($date1, $date2) {
        $fecha1 = new DateTime($date1);
        $fecha2 = new DateTime($date2);
        $diff = $fecha1->diff($fecha2);
        $dias = ($diff->days + 1);
        return $dias;
    }

    public static function diasCalculo($date1, $date2) {
        $mesFecha1 = date('m', strtotime($date1));
        $añoFecha1 = date('Y', strtotime($date1));
        $diasMensual = cal_days_in_month(CAL_GREGORIAN, $mesFecha1, $añoFecha1);
        return $diasMensual;
    }

    public static function diferenciaMeses($date1, $date2) {
        $ts1 = strtotime($date1);
        $ts2 = strtotime($date2);
        $year1 = date('Y', $ts1);
        $year2 = date('Y', $ts2);
        $month1 = date('m', $ts1);
        $month2 = date('m', $ts2);
        $diff = (($year2 - $year1) * 12) + ($month2 - $month1) + 1;
        return $diff;
    }

}

class verificaciones {

    public static function verificacionSaldoIngreso($buttonidingreso) {
        $conn = Conexion::Conectar();
        $params = array(&$buttonidingreso);
        $sql = "EXECUTE spVerificacion ?";
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
            if (!empty($results)) {
                if ($results[0]["stock"] == 0 && $results[0]["numCorte"] == 0) {
                    //sin corte se refiere a que no tiene ningun cobro antecesor que respetar, se cobrara desde el ingreso hasta fecha del dia actual
                    return array("estado" => "procesar", "estadoCorte" => "sinCorte");
                }
                if ($results[0]["stock"] >= 1 && $results[0]["numCorte"] == 0) {
                    //sin corte se refiere a que no tiene ningun cobro antecesor que respetar, se cobrara desde el ingreso hasta fecha del dia actual
                    return array("estado" => "procesar", "estadoCorte" => "sinCorte");
                }
                if ($results[0]["stock"] == 0 && $results[0]["numCorte"] == 0 && $results[0]["retirosCant"] == 1) {
                    return array("estado" => "procesar", "estadoCorte" => "corteOk");
                }
                if ($results[0]["stock"] >= 1 && $results[0]["numCorte"] >= 1 && $results[0]["retirosCant"] == 0) {
                    return "ReciboSinRetConCorte";
                }
                if ($results[0]["stock"] >= 1 && $results[0]["numCorte"] >= 1 && $results[0]["retirosCant"] == 1) {
                    return "calculoConRet";
                }
            } else {
                return "SD";
            }
        } else {
            return sqlsrv_errors();
        }
    }

    public static function mdlVerCorteDeAlmacenaje($buttonidingreso) {
        $conn = Conexion::Conectar();
        $params = array(&$buttonidingreso);
        $sql = "EXECUTE spVerificarCorteRec ?";
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

}

class funcionCortes {

    public static function cortesArraySaldos($data, $resCalSaldoDiarioBaseDiaria) {
        foreach ($resCalSaldoDiarioBaseDiaria as $key => $value) {
            if ($data < $value["fechaCorte"]) {
                unset($resCalSaldoDiarioBaseDiaria[$key]);
            }
        }
        $nuevoCortes = array_values($resCalSaldoDiarioBaseDiaria);
        return $nuevoCortes;
    }

}

class detallesYCalculos {

    public static function DetallesCalculos($tipo, $key, $resultsSaldos, $arraySaldos, $respuestaTarifa, $respuestaManejo, $respuestaSeguro, $respuestaGstsAdmin, $fechaIngFormat, $fechaCorteFormat, $dias, $respuestaAlmacenaje, $roundManejo, $resManejo, $resSeguro, $resTrasnmision, $totalCalculo) {
        $arrayCalculos = [];
        if ($tipo == 0) {
            $numeroPoliza = $resultsSaldos[0]["numeroPoliza"];
            $volumenPeso = $resultsSaldos[0]["peso"];
            $numeroPosiciones = $resultsSaldos[0]["posicion"];
            $BultosIngreso = $resultsSaldos[0]["bultos"];
            $cifImpuestos = ($resultsSaldos[0]["totalValorCif"] + $resultsSaldos[0]["valorImpuesto"]);
            $valorTarifa = round($respuestaTarifa[0]["valTarifa"], 2);
            $datos = array("poliza" => $numeroPoliza,
                "valorTarifa" => $valorTarifa,
                "posSaldo" => $numeroPosiciones,
                "fechaIn" => $fechaIngFormat,
                "fechaCorte" => $fechaCorteFormat,
                "dias" => $dias,
                "unidades" => $BultosIngreso,
                "cifImpuestos" => $cifImpuestos,
                "almacenaje" => $respuestaAlmacenaje,
                "toneladas" => $roundManejo,
                "pesoCalculo" => $resManejo,
                "resSeguro" => $resSeguro,
                "calcGstAdmin" => $resTrasnmision,
                "totalAlmacenaje" => $totalCalculo);
            array_push($arrayCalculos, $datos);
            return $arrayCalculos;
        } else if ($tipo == 1) {
            $numeroPoliza = $resultsSaldos[0]["numeroPoliza"];
            $volumenPeso = 0;
            $numeroPosiciones = $arraySaldos[$key]["saldoPos"];
            $BultosIngreso = $arraySaldos[$key]["saldoBultos"];
            $cifImpuestos = ($arraySaldos[$key]["saldoCif"] + $arraySaldos[$key]["saldoImpuesto"]);
            $valorTarifa = round($respuestaTarifa[0]["valTarifa"], 2);
            $datos = array("poliza" => $numeroPoliza,
                "valorTarifa" => $valorTarifa,
                "posSaldo" => $numeroPosiciones,
                "fechaIn" => $fechaIngFormat,
                "fechaCorte" => $fechaCorteFormat,
                "dias" => $dias,
                "unidades" => $BultosIngreso,
                "cifImpuestos" => $cifImpuestos,
                "almacenaje" => $respuestaAlmacenaje,
                "toneladas" => $roundManejo,
                "pesoCalculo" => $resManejo,
                "resSeguro" => $resSeguro,
                "calcGstAdmin" => $resTrasnmision,
                "totalAlmacenaje" => $totalCalculo);
            array_push($arrayCalculos, $datos);
            return $arrayCalculos;
        } else if ($tipo == 3) {
            $numeroPoliza = $resultsSaldos[0]["numeroPoliza"];
            $volumenPeso = $resultsSaldos[0]["peso"];
            $numeroPosiciones = $resultsSaldos[0]["posicion"];
            $BultosIngreso = $resultsSaldos[0]["bultos"];
            $cifImpuestos = ($resultsSaldos[0]["totalValorCif"] + $resultsSaldos[0]["valorImpuesto"]);
            $valorTarifa = round($respuestaTarifa[0]["valTarifa"], 2);
            $datos = array("poliza" => $numeroPoliza,
                "valorTarifa" => $valorTarifa,
                "posSaldo" => $numeroPosiciones,
                "fechaIn" => $fechaIngFormat,
                "fechaCorte" => $fechaCorteFormat,
                "dias" => $dias,
                "unidades" => $BultosIngreso,
                "cifImpuestos" => $cifImpuestos,
                "almacenaje" => $respuestaAlmacenaje,
                "toneladas" => $roundManejo,
                "pesoCalculo" => $resManejo,
                "resSeguro" => $resSeguro,
                "calcGstAdmin" => $resTrasnmision,
                "totalAlmacenaje" => $totalCalculo);
            array_push($arrayCalculos, $datos);
            return $arrayCalculos;
        }
    }

}

class funcionArmarDetalles {

    public static function detalleDeCalculos($arrayMovimientos, $resultsSaldos, $fechaInicio, $formatRecorrido, $respuestaTarifa, $base, $calculoSobre, $periodoCalculo, $tarifaManejo, $respuestaSeguro, $tarifaSeguro, $PeriodoSeguro, $periodoCalculoSeg, $tipoTrans, $clientes) {
        $arrayCalculos = [];
        $numeroPoliza = $resultsSaldos[0]["numeroPoliza"];
        $volumenPeso = 0;
        $numeroPosiciones = $arrayMovimientos[0]["saldoPos"];
        $BultosIngreso = $arrayMovimientos[0]["saldoBultos"];
        $cifImpuestos = round(($arrayMovimientos[0]["saldoCif"] + $arrayMovimientos[0]["saldoImpuesto"]), 2);
        $valorTarifa = round($respuestaTarifa[0]["valTarifa"], 2);
        $dias = funcionesDeCalculo::dias($fechaInicio, $formatRecorrido);
        /* CALCULO DE ALMACENAJE. */
        $respuestaAlmacenaje = funcionesDeCalculo::calculoAlmacenDiario($fechaInicio, $formatRecorrido, $valorTarifa, $dias, $numeroPosiciones, $base, $calculoSobre, $periodoCalculo);
        if ($respuestaSeguro != "SD") {
            $resSeguro = funcionesDeCalculo::calculoSeguro($tarifaSeguro, $dias, $cifImpuestos, $PeriodoSeguro, $periodoCalculoSeg);
        } else {
            $resSeguro = 0;
        }
        $roundManejo = 0;
        $resManejo = 0;
        $resTrasnmision = 0;
        $totalCalculo = round(($respuestaAlmacenaje + $resManejo + $resSeguro + $resTrasnmision), 2);
        $datos = array("poliza" => $numeroPoliza,
            "valorTarifa" => $valorTarifa,
            "posSaldo" => $numeroPosiciones,
            "fechaIn" => $fechaInicio,
            "fechaCorte" => $formatRecorrido,
            "dias" => $dias,
            "unidades" => $BultosIngreso,
            "cifImpuestos" => $cifImpuestos,
            "almacenaje" => $respuestaAlmacenaje,
            "toneladas" => $roundManejo,
            "pesoCalculo" => $resManejo,
            "resSeguro" => $resSeguro,
            "calcGstAdmin" => $resTrasnmision,
            "totalAlmacenaje" => $totalCalculo);
        array_push($arrayCalculos, $datos);
        return $arrayCalculos;
    }

    public static function detalleDeCalculosSinMov($tipo, $resultsSaldos, $respuestaTarifa, $arrayDetalleConRet, $base, $calculoSobre, $periodoCalculo, $tarifaSeguro, $PeriodoSeguro, $periodoCalculoSeg, $respuestaSeguro) {
        $arrayCalculos = [];
        date_default_timezone_set('America/Guatemala');
        $date = date('d-m-Y');
        if ($tipo == 1) {
            $cant = count($arrayDetalleConRet);
            $numeroPoliza = $resultsSaldos[0]["numeroPoliza"];
            $volumenPeso = 0;
            $numeroPosiciones = $arrayDetalleConRet[$cant - 1]["posSaldo"];
            $BultosIngreso = $arrayDetalleConRet[$cant - 1]["unidades"];
            $cifImpuestos = ($arrayDetalleConRet[$cant - 1]["cifImpuestos"]);
            $valorTarifa = round($respuestaTarifa[0]["valTarifa"], 2);
            $fecha = $arrayDetalleConRet[$cant - 1]["fechaCorte"];
            $fechaInicio = strtotime('+1 day', strtotime($fecha));
            $fechaInicio = date('d-m-Y', $fechaInicio);
            $diasCalculo = funcionTiempo::diasCalculo($fechaInicio, $fechaInicio);
            $numFinMes = date("m", strtotime($fechaInicio));
            $numFinAnio = date("Y", strtotime($fechaInicio));
            $formatRecorrido = $diasCalculo . '-' . $numFinMes . '-' . $numFinAnio;
            $dias = funcionesDeCalculo::dias($fechaInicio, $formatRecorrido);
            /* CALCULO DE ALMACENAJE. */
            $respuestaAlmacenaje = funcionesDeCalculo::calculoAlmacenDiario($fechaInicio, $formatRecorrido, $valorTarifa, $dias, $numeroPosiciones, $base, $calculoSobre, $periodoCalculo);
            if ($respuestaSeguro != "SD") {
                $resSeguro = funcionesDeCalculo::calculoSeguro($tarifaSeguro, $dias, $cifImpuestos, $PeriodoSeguro, $periodoCalculoSeg);
            } else {
                $resSeguro = 0;
            }
            $roundManejo = 0;
            $resManejo = 0;
            $resTrasnmision = 0;
            $totalCalculo = round(($respuestaAlmacenaje + $resManejo + $resSeguro + $resTrasnmision), 2);
            $datos = array("poliza" => $numeroPoliza,
                "valorTarifa" => $valorTarifa,
                "posSaldo" => $numeroPosiciones,
                "fechaIn" => $fechaInicio,
                "fechaCorte" => $formatRecorrido,
                "dias" => $dias,
                "unidades" => $BultosIngreso,
                "cifImpuestos" => $cifImpuestos,
                "almacenaje" => $respuestaAlmacenaje,
                "toneladas" => $roundManejo,
                "pesoCalculo" => $resManejo,
                "resSeguro" => $resSeguro,
                "calcGstAdmin" => $resTrasnmision,
                "totalAlmacenaje" => $totalCalculo);
            array_push($arrayCalculos, $datos);
            return $arrayCalculos;
        }
        if ($tipo == 3) {
            $cant = count($arrayDetalleConRet);
            $numeroPoliza = $resultsSaldos[0]["numeroPoliza"];
            $volumenPeso = 0;
            $numeroPosiciones = $arrayDetalleConRet[$cant - 1]["posSaldo"];
            $numeroPosiciones = $arrayDetalleConRet[$cant - 1]["posSaldo"];
            $BultosIngreso = $arrayDetalleConRet[$cant - 1]["unidades"];
            $cifImpuestos = ($arrayDetalleConRet[$cant - 1]["cifImpuestos"]);
            $valorTarifa = round($respuestaTarifa[0]["valTarifa"], 2);
            $fecha = $arrayDetalleConRet[$cant - 1]["fechaCorte"];
            $fechaInicio = strtotime('+1 day', strtotime($fecha));
            $fechaInicio = date('d-m-Y', $fechaInicio);
            $formatRecorrido = $date;
            $dias = funcionesDeCalculo::dias($fechaInicio, $formatRecorrido);
            /* CALCULO DE ALMACENAJE. */
            $respuestaAlmacenaje = funcionesDeCalculo::calculoAlmacenDiario($fechaInicio, $formatRecorrido, $valorTarifa, $dias, $numeroPosiciones, $base, $calculoSobre, $periodoCalculo);
            if ($respuestaSeguro != "SD") {
                $resSeguro = funcionesDeCalculo::calculoSeguro($tarifaSeguro, $dias, $cifImpuestos, $PeriodoSeguro, $periodoCalculoSeg);
            } else {
                $resSeguro = 0;
            }
            $roundManejo = 0;
            $resManejo = 0;
            $resTrasnmision = 0;
            $totalCalculo = round(($respuestaAlmacenaje + $resManejo + $resSeguro + $resTrasnmision), 2);
            $datos = array("poliza" => $numeroPoliza,
                "valorTarifa" => $valorTarifa,
                "posSaldo" => $numeroPosiciones,
                "fechaIn" => $fechaInicio,
                "fechaCorte" => $formatRecorrido,
                "dias" => $dias,
                "unidades" => $BultosIngreso,
                "cifImpuestos" => $cifImpuestos,
                "almacenaje" => $respuestaAlmacenaje,
                "toneladas" => $roundManejo,
                "pesoCalculo" => $resManejo,
                "resSeguro" => $resSeguro,
                "calcGstAdmin" => $resTrasnmision,
                "totalAlmacenaje" => $totalCalculo);
            array_push($arrayCalculos, $datos);
            return $arrayCalculos;
        }
    }

    public static function primerCorteSinMov($resultsSaldos, $fechaInicio, $respuestaTarifa, $base, $calculoSobre, $periodoCalculo, $tarifaManejo, $respuestaSeguro, $tarifaSeguro, $PeriodoSeguro, $periodoCalculoSeg, $tipoTrans, $clientes, $corteFecha, $tipo) {
        $arrayCalculos = [];
        $numeroPoliza = $resultsSaldos[0]["numeroPoliza"];
        $volumenPeso = $resultsSaldos[0]["peso"];
        $numeroPosiciones = $resultsSaldos[0]["posicion"];
        $BultosIngreso = $resultsSaldos[0]["bultos"];
        $cifImpuestos = ($resultsSaldos[0]["totalValorCif"] + $resultsSaldos[0]["valorImpuesto"]);
        $valorTarifa = round($respuestaTarifa[0]["valTarifa"], 2);
        $diasCalculo = funcionTiempo::diasCalculo($fechaInicio, $fechaInicio);
        $numFinMes = date("m", strtotime($fechaInicio));
        $numFinAnio = date("Y", strtotime($fechaInicio));
        if ($tipo == 1 || $tipo == 3 || $tipo == 4) {
            $formatRecorrido = $corteFecha;
        } else {
            $formatRecorrido = $diasCalculo . '-' . $numFinMes . '-' . $numFinAnio;
        }


        $dias = funcionesDeCalculo::dias($fechaInicio, $formatRecorrido);
        /* CALCULO DE ALMACENAJE. */
        $respuestaAlmacenaje = funcionesDeCalculo::calculoAlmacenDiario($fechaInicio, $formatRecorrido, $valorTarifa, $dias, $numeroPosiciones, $base, $calculoSobre, $periodoCalculo);
        if ($respuestaSeguro != "SD") {
            $resSeguro = funcionesDeCalculo::calculoSeguro($tarifaSeguro, $dias, $cifImpuestos, $PeriodoSeguro, $periodoCalculoSeg);
        } else {
            $resSeguro = 0;
        }
        /* CALCULO DE MANEJO. */
        $roundManejo = ceil($volumenPeso / 1000);
        $resManejo = funcionesDeCalculo::calculoManejo($tarifaManejo, $volumenPeso);
        /* CALCULO DE SEGURO. */
        if ($respuestaSeguro != "SD") {
            $resSeguro = funcionesDeCalculo::calculoSeguro($tarifaSeguro, $dias, $cifImpuestos, $PeriodoSeguro, $periodoCalculoSeg);
        } else {
            $resSeguro = 0;
        }
        /* TRANSMISION ELECTRONICA. */
        $resTrasnmision = funcionesDeCalculo::calculoTransElectronica($tipoTrans, $clientes);
        if ($tipo == 1 || $tipo == 4) {
            $totalCalculo = round(($respuestaAlmacenaje + $resManejo + $resSeguro + $resTrasnmision), 2);
            $datos = array("poliza" => $numeroPoliza,
                "valorTarifa" => $valorTarifa,
                "posSaldo" => $numeroPosiciones,
                "fechaIn" => $fechaInicio,
                "fechaCorte" => $formatRecorrido,
                "dias" => $dias,
                "unidades" => $BultosIngreso,
                "cifImpuestos" => $cifImpuestos,
                "almacenaje" => $respuestaAlmacenaje,
                "toneladas" => $roundManejo,
                "pesoCalculo" => $resManejo,
                "resSeguro" => $resSeguro,
                "calcGstAdmin" => $resTrasnmision,
                "totalAlmacenaje" => $totalCalculo);
            array_push($arrayCalculos, $datos);
        }
        if ($tipo == 3) {
            $totalCalculo = round(($respuestaAlmacenaje + $resSeguro), 2);
            $datos = array("poliza" => $numeroPoliza,
                "valorTarifa" => $valorTarifa,
                "posSaldo" => $numeroPosiciones,
                "fechaIn" => $fechaInicio,
                "fechaCorte" => $formatRecorrido,
                "dias" => $dias,
                "unidades" => $BultosIngreso,
                "cifImpuestos" => $cifImpuestos,
                "almacenaje" => $respuestaAlmacenaje,
                "toneladas" => 0,
                "pesoCalculo" => 0,
                "resSeguro" => $resSeguro,
                "calcGstAdmin" => 0,
                "totalAlmacenaje" => $totalCalculo);
            array_push($arrayCalculos, $datos);
        }
        return $arrayCalculos;
    }

}
