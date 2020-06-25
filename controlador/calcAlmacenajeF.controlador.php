<?php

class ControladorCalculos {

    public static function ctrMostrarSinCobro() {
        date_default_timezone_set('America/Guatemala');
        $time = date('d-m-Y');
        $valor = $_SESSION["idDeBodega"];
        $respuesta = ModeloCalculos::mdlFacturacion($valor);

        if ($respuesta !== null || $respuesta !== NULL) {
            if ($respuesta == "SD") {
                
            } else {
                foreach ($respuesta as $key => $value) {
                    if ($value["servAd"] != "VEHICULOS NUEVOS") {
                        // Con objetos
                        $fecha_actual = new DateTime();
                        $cadena_fecha_actual = $value["fechaIngreso"]->format("d/m/Y");
                        $buttonFact = '<button type="button" class="btn btn-warning btnCalculos" buttonIdIngreso=' . $value["identificador"] . '><i class="fa fa-calculator"></i></button>';
                        echo'
                                     <tr>
                                     <td>' . ($key + 1) . '</td>
                                     <td>' . ($respuesta[$key]["nit"]) . '</td>
                                     <td>' . ($value["empresa"]) . '</td>
                                     <td>' . ($value["identificador"]) . '</td>
                                     <td>' . ($value["poliza"]) . '</td>
             			     <td>' . ($cadena_fecha_actual) . '</td>
                                     <td>' . ($value["blts"]) . '</td>
                                     <td>' . ($value["cif"]) . '</td>
                                     <td>' . ($value["impuesto"]) . '</td>
                                    <td>' . '<div class="btn-group">' . $buttonFact . '<button type="button" buttonId=' . $value["identificador"] . ' class="btn bg-info-gradient bntImprimir"><i class="fa fa-print"></i></button></div>' . '</td>
                                    </tr>';
                    }
                }
            }
        }
    }

    public static function ctrMostrarDatosIngreso($buttonidingreso) {
        $respuesta = ModeloCalculos::mdlMostrarDatosIngreso($buttonidingreso);
        return $respuesta;
    }

    public static function ctrMostrarNit($resultIdIngreso) {
        $respuesta = ModeloCalculos::mdlMostrarNit($resultIdIngreso);
        return $respuesta;
    }

    public static function ctrGuardarReciboAlmacenaje($hiddenresultIdIngreso) {
        $respuesta = ModeloCalculos::mdlGuardarReciboAlmacenaje($hiddenresultIdIngreso);
        return $respuesta;
    }

    public static function ctrRecalculoVariosCortes($ultimoCorte, $corteCierre, $idIngCambio) {
        $recalculoCobrado = ControladorCalculos::ctrRecalculaAlmacenaje($ultimoCorte, $idIngCambio);
        return $recalculoCobrado;
    }

    public static function ctrCalculosAlmacenajesEspeciales($buttonidingreso) {
        $respuesta = ControladorCalculos::ctrMostrarDatosIngreso($buttonidingreso);
     return $respuesta;
        if ($respuesta != "ST") {

            if ($respuesta["tipo"] == "factCorteCobro") {

                $fechaCalcEsp = $respuesta["corteCobrado"];
                $idIngCambio = $respuesta["results"][0]["idIng"];
                $recalculoCobrado = ControladorCalculos::ctrRecalculaAlmacenaje($fechaCalcEsp, $idIngCambio);
         
                $pendienteDeCobro = $respuesta["cortes"]["pendienteDeCobro"];
                $calcPendCobro = ControladorCalculos::ctrpendienteCobro($fechaCalcEsp, $idIngCambio, $pendienteDeCobro);
                $listaDetallada = [];
                foreach ($recalculoCobrado["resCalSaldoDiarioBaseDiaria"] as $key => $value) {
                    $valorDataCobrada = array(
                        "poliza" => $poliza = $value["poliza"],
                        "valorTarifa" => $valorTarifa = $value["valorTarifa"],
                        "posSaldo" => $posSaldo = $value["posSaldo"],
                        "fechaIn" => $fechaIn = $value["fechaIn"],
                        "fechaCorte" => $fechaCorte = $value["fechaCorte"],
                        "dias" => $dias = $value["dias"],
                        "unidades" => $unidades = $value["unidades"],
                        "cifImpuestos" => $cifImpuestos = $value["cifImpuestos"],
                        "almacenaje" => $almacenaje = $value["almacenaje"],
                        "toneladas" => $toneladas = $value["toneladas"],
                        "pesoCalculo" => $pesoCalculo = $value["pesoCalculo"],
                        "resSeguro" => $resSeguro = $value["resSeguro"],
                        "calcGstAdmin" => $calcGstAdmin = $value["calcGstAdmin"],
                        "totalAlmacenaje" => $totalAlmacenaje = $value["totalAlmacenaje"],
                        "tipoMov" => "movCobrado"
                    );
                    array_push($listaDetallada, $valorDataCobrada);
                }
                foreach ($calcPendCobro as $key => $valuees) {
                    $valorDataPendiente = array(
                        "poliza" => $poliza = $valuees["poliza"],
                        "valorTarifa" => $valorTarifa = $valuees["valorTarifa"],
                        "posSaldo" => $posSaldo = $valuees["posSaldo"],
                        "fechaIn" => $fechaIn = $valuees["fechaIn"],
                        "fechaCorte" => $fechaCorte = $valuees["fechaCorte"],
                        "dias" => $dias = $valuees["dias"],
                        "unidades" => $unidades = $valuees["unidades"],
                        "cifImpuestos" => $cifImpuestos = $valuees["cifImpuestos"],
                        "almacenaje" => $almacenaje = $valuees["almacenaje"],
                        "toneladas" => $toneladas = $valuees["toneladas"],
                        "pesoCalculo" => $pesoCalculo = $valuees["pesoCalculo"],
                        "resSeguro" => $resSeguro = $valuees["resSeguro"],
                        "calcGstAdmin" => $calcGstAdmin = $valuees["calcGstAdmin"],
                        "totalAlmacenaje" => $totalAlmacenaje = $valuees["totalAlmacenaje"],
                        "tipoMov" => "pendiente"
                    );
                    array_push($listaDetallada, $valorDataPendiente);
                }
                $nuevaRespuesta = array("results" => $respuesta["results"], "resCalSaldoDiarioBaseDiaria" => $listaDetallada, "tipo" => $respuesta["tipo"]);
                return $nuevaRespuesta;
                //   $respuestaCliente = array($respuesta, $recalculo);
                //echo json_encode($respuestaCliente);
            } else {
                return $respuesta;
            }
        } else {
            return "ST";
        }
    }

    public static function ctrMostrarEjecutivoCredito($ejecutivoCredito) {
        $respuesta = ModeloCalculos::mdlMostrarEjecutivoCredito($ejecutivoCredito);
        return $respuesta;
    }

    public static function ctrGuardarAlmacenaje($idIngAlmacenajeF, $listaServiciosDefault, $listaOtros, $valDescuento, $hiddenDescuento, $hiddenDateTimeValCorte) {
        $respuestaRevCobro = ModeloCalculos::mdlRevisarCobrosAnteriores($idIngAlmacenajeF);
        if ($respuestaRevCobro == "SD") {
            $respuesta = ModeloCalculos::mdlMostrarDatosIngreso($idIngAlmacenajeF);
            // Valores generales de almacenaje
            if ($respuesta != "SD") {
                //Sumando Almacenajes
                $almacenajeCalado = 0;
                //Sumando Manejo
                $manejo = 0;
                //Sumando Transmisión electronica
                $transElectronica = 0;
                //Sumando Seguro
                $seguro = 0;
                foreach ($respuesta["resCalSaldoDiarioBaseDiaria"] as $key => $value) {
                    //Sumando Almacenajes
                    $almacenajeCalado = round(($almacenajeCalado + $value["almacenaje"]), 2);
                    //Sumando Manejo
                    $manejo = round(($manejo + $value["pesoCalculo"]), 2);
                    //Sumando Seguro
                    $seguro = round(($seguro + $value["resSeguro"]), 2);
                    //Sumando Transmisión electronica
                    $transElectronica = round(($transElectronica + $value["calcGstAdmin"]), 2);
                }
                //fechaInicio
                $fechaInicio = $respuesta["resCalSaldoDiarioBaseDiaria"][0]["fechaCorte"];
                $fechaInicio = date("Y-m-d", strtotime($fechaInicio));

                //fechaCobroHasta
                $fechaCobro = $respuesta["resCalSaldoDiarioBaseDiaria"][$key]["fechaCorte"];
                $fechaCobro = date("Y-m-d", strtotime($fechaCobro));
                $fechaDateCambio = $hiddenDateTimeValCorte;
                $fechaDateCambio = date("Y-m-d", strtotime($fechaDateCambio));
                if ($fechaCobro != $fechaDateCambio) {
                    $respuestaControlado = ControladorCalculos::ctrRecalculaAlmacenaje($fechaDateCambio, $idIngAlmacenajeF);
                    //Sumando Almacenajes
                    $almacenajeCalado = 0;
                    //Sumando Manejo
                    $manejo = 0;
                    //Sumando Seguro
                    $seguro = 0;
                    //Sumando Transmisión electronica
                    $transElectronica = 0;
                    foreach ($respuestaControlado["resCalSaldoDiarioBaseDiaria"] as $key => $value) {
                        //Sumando Almacenajes
                        $almacenajeCalado = round(($almacenajeCalado + $value["almacenaje"]), 2);
                        //Sumando Manejo
                        $manejo = round(($manejo + $value["pesoCalculo"]), 2);
                        //Sumando Seguro
                        $seguro = round(($seguro + $value["resSeguro"]), 2);
                        //Sumando Transmisión electronica
                        $transElectronica = round(($transElectronica + $value["calcGstAdmin"]), 2);
                    }
                    $fechaCobro = $respuestaControlado["resCalSaldoDiarioBaseDiaria"][$key]["fechaCorte"];
                    $fechaCobro = date("Y-m-d", strtotime($fechaCobro));
                    $fechaDateCambio = $hiddenDateTimeValCorte;
                    $fechaDateCambio = date("Y-m-d", strtotime($fechaDateCambio));
                }
                $tipo = 1;
                $registroNuevoCobro = ModeloCalculos::mdlAlmacenajeRegistro($idIngAlmacenajeF, $fechaInicio, $fechaCobro);
                if ($registroNuevoCobro[0]["identEspecial"] >= 1) {
                    $identRegistroCobro = $registroNuevoCobro[0]["identEspecial"];
                    // spAlmacenaje
                    if ($almacenajeCalado >= 0.01) {
                        $respuestaAlmacenaje = ModeloCalculos::mdlCobroAlmacenajes($identRegistroCobro, $idIngAlmacenajeF, $almacenajeCalado, $fechaCobro);
                    }
                    // spManejo
                    if ($respuestaAlmacenaje) {
                        if ($manejo >= 0.01) {
                            $respuestaManejo = ModeloCalculos::mdlCobroManejos($identRegistroCobro, $idIngAlmacenajeF, $manejo);
                        }
                    }
                    // spSeguro
                    if ($respuestaManejo) {
                        if ($seguro >= 0.01) {
                            $respuestaSeguro = ModeloCalculos::mdlCobroSeguro($identRegistroCobro, $idIngAlmacenajeF, $seguro);
                        } else {
                            $respuestaSeguro = true;
                        }
                    }
                    // spTransmisionElectronica
                    if ($respuestaSeguro) {
                        if ($transElectronica >= 0.01) {
                            $respuestaTElectronica = ModeloCalculos::mdlCobroTransElectronica($identRegistroCobro, $idIngAlmacenajeF, $transElectronica);
                            return $respuestaTElectronica;
                        }
                    }
                    // Valores generales de servicios extras
                    $datoServicios = json_decode($listaServiciosDefault, true);
                    if ($datoServicios != 0) {
                        foreach ($datoServicios as $key => $value) {
                            
                        }
                        return "enCiclo";
                    }
                    // Valores generales de otros servicios
                    $datoServiciosListaOtros = json_decode($listaOtros, true);
                    if ($datoServiciosListaOtros != 0) {
                        foreach ($datoServiciosListaOtros as $key => $value) {
                            
                        }
                        return "enCiclo";
                    }
                    // Aplicacr Descuentos de almacenajes
                    return round(($almacenajeCalado + $manejo + $seguro + $transElectronica), 2);
                }
            }
        }
    }

    public static function ctrpendienteCobro($fechaCalcEsp, $idIngCambio, $calcPendCobro) {
        $fechaIngFormat = strtotime('+1 day', strtotime($fechaCalcEsp));
        $fechaIngFormat = date('d-m-Y', $fechaIngFormat);
        $respuesta = ControladorCalculos::ctrMostrarDatosIngreso($idIngCambio);
        $pendCobro = array_values($respuesta["cortes"]["pendienteDeCobro"]);
        $fechaCorte = $pendCobro[0]["fechaCorte"];
        $arraySaldos = array(0 => $pendCobro[0]);
        $respuestaTarifa = TarifaCalculo::mostrarTarifa($idIngCambio);
        $idTarifa = $respuestaTarifa[0]["identy"];
        $respuestaManejo = TarifaCalculo::mostrarTarifaManejo($idTarifa);
        $respuestaSeguro = TarifaCalculo::mostrarTarifaSeguro($idTarifa);
        $respuestaGstsAdmin = TarifaCalculo::mostrarTarifaGtsAdmin($idTarifa);
        $respCalculoControlado = calculosAlmacenFiscal::calculosPendienteCobro($arraySaldos, $respuestaTarifa, $fechaIngFormat, $respuestaManejo, $respuestaSeguro, $respuestaGstsAdmin);
        unset($pendCobro[0]);
        array_unshift($pendCobro, $respCalculoControlado[0]);
        return $pendCobro;
    }

    public static function ctrRecalculaAlmacenaje($fechaCalcEsp, $idIngCambio) {
        $fecha1 = strtotime($fechaCalcEsp);
        $fechaIngFormat = date('d-m-Y', $fecha1);
        $diasCalculo = funcionTiempo::diasCalculo($fecha1, $fecha1);
        $numFinMes = date("m", strtotime($fecha1));
        $numFinAnio = date("Y", strtotime($fecha1));
        $finDeMes = $diasCalculo . '-' . $numFinMes . '-' . $numFinAnio;
        $finDeMes = strtotime($finDeMes);
        $finDeMes = date('d-m-Y', $finDeMes);
        $respuesta = ControladorCalculos::ctrMostrarDatosIngreso($idIngCambio);
        // si no existe ningun corte se hace el calculo general sin ningun 
        $listaRecalculada = [];
        foreach ($respuesta["resCalSaldoDiarioBaseDiaria"] as $key => $value) {
            $fecha2 = strtotime($value["fechaIn"]);
            $fechaCorteMes = date('d-m-Y', $fecha2);
            if ($fecha2 > $fecha1) {
                break;
            } else {
                array_push($listaRecalculada, $value);
            }
        }
        $index = count($listaRecalculada);
        $index = $index - 1;
        $fechaFinCalc = $listaRecalculada[$index]["fechaCorte"];
        if ($fechaIngFormat == $fechaFinCalc) {
            return array("resCalSaldoDiarioBaseDiaria" => $listaRecalculada);
        } else {
            $arrayRespuesta = [];
            $arraySaldos = array(0 => $listaRecalculada[$index]);
            unset($listaRecalculada[$index]);
            foreach ($listaRecalculada as $key => $value) {
                array_push($arrayRespuesta, $value);
            }
            $respuestaTarifa = TarifaCalculo::mostrarTarifa($idIngCambio);
            $idTarifa = $respuestaTarifa[0]["identy"];
            $respuestaManejo = TarifaCalculo::mostrarTarifaManejo($idTarifa);
            $respuestaSeguro = TarifaCalculo::mostrarTarifaSeguro($idTarifa);
            $respuestaGstsAdmin = TarifaCalculo::mostrarTarifaGtsAdmin($idTarifa);
            $fechaInicio = $arraySaldos[0]["fechaIn"];
            $respCalculoControladoResp = calculosAlmacenFiscal::calculosCorteControlado($arraySaldos, $respuestaTarifa, $fechaInicio, $fechaCalcEsp, $respuestaManejo, $respuestaSeguro, $respuestaGstsAdmin);
            foreach ($respCalculoControladoResp as $key => $value) {
                array_push($arrayRespuesta, $value);
            }
            if ($respuesta["tipo"] == "factCorteCobro") {
                $arrayRespuesta = [];
                $arrayCobrados = [];
                //calculado cierre del bloque los calculos cobrados
                $contBloques = count($respuesta["cortes"]["cobrado"]) - 1;
                $bloquesCobrados = array_values($respuesta["cortes"]["cobrado"]);
                $primerFechaBCobrado = $bloquesCobrados[$contBloques]["fechaCorte"];
                $nuevafechaInicio = strtotime('+1 day', strtotime($primerFechaBCobrado));
                $nuevafechaInicio = date('d-m-Y', $nuevafechaInicio);
                $cierreDeFecha = $respuesta["corteCobrado"];
                $respCalculoControlado = calculosAlmacenFiscal::calculosCorteControlado($arraySaldos, $respuestaTarifa, $nuevafechaInicio, $cierreDeFecha, $respuestaManejo, $respuestaSeguro, $respuestaGstsAdmin);
                foreach ($bloquesCobrados as $key => $value) {
                    array_push($arrayCobrados, $value);
                }
                foreach ($respCalculoControlado as $key => $values) {
                    array_push($arrayCobrados, $values);
                }
                $tipoMov = "movCobrado";
                $dataCobrados = funcionesRepetitivasForeach::arrayDeCalculoControlado($arrayCobrados, $tipoMov);
                //calculando cierre del bloque los calculos pendientes
                $arrayPendientes = [];
                $arraySaldos = array(0 => $respCalculoControladoResp[0]);
                $fechaFin = $arraySaldos[0]["fechaCorte"];
                $primeraFecha = $respuesta["corteCobrado"];
                $nuevafechaInicio = strtotime('+1 day', strtotime($primeraFecha));
                $nuevafechaInicio = date('d-m-Y', $nuevafechaInicio);
                $respCalculoControlado = calculosAlmacenFiscal::calculosCorteControlado($arraySaldos, $respuestaTarifa, $nuevafechaInicio, $fechaFin, $respuestaManejo, $respuestaSeguro, $respuestaGstsAdmin);
                foreach ($respCalculoControlado as $key => $value) {
                    array_push($arrayPendientes, $value);
                }
                $tipoMov = "pendiente";
                $dataPendientes = funcionesRepetitivasForeach::arrayDeCalculoControlado($arrayPendientes, $tipoMov);
                foreach ($dataCobrados as $key => $value) {
                    array_push($arrayRespuesta, $value);
                }
                foreach ($dataPendientes as $key => $value) {
                    array_push($arrayRespuesta, $value);
                }
                return array("resCalSaldoDiarioBaseDiaria" => $arrayRespuesta, "tipo" => $respuesta["tipo"]);
            }
        }
        return array("resCalSaldoDiarioBaseDiaria" => $arrayRespuesta, "tipo" => $respuesta["tipo"]);
    }

}

class funcionesRepetitivasForeach {

    public static function arrayDeCalculoControlado($bloquesCobrados, $tipoMov) {
        $dataRespuesta = [];
        foreach ($bloquesCobrados as $key => $valuees) {
            $valorDataPendiente = array(
                "poliza" => $poliza = $valuees["poliza"],
                "valorTarifa" => $valorTarifa = $valuees["valorTarifa"],
                "posSaldo" => $posSaldo = $valuees["posSaldo"],
                "fechaIn" => $fechaIn = $valuees["fechaIn"],
                "fechaCorte" => $fechaCorte = $valuees["fechaCorte"],
                "dias" => $dias = $valuees["dias"],
                "unidades" => $unidades = $valuees["unidades"],
                "cifImpuestos" => $cifImpuestos = $valuees["cifImpuestos"],
                "almacenaje" => $almacenaje = $valuees["almacenaje"],
                "toneladas" => $toneladas = $valuees["toneladas"],
                "pesoCalculo" => $pesoCalculo = $valuees["pesoCalculo"],
                "resSeguro" => $resSeguro = $valuees["resSeguro"],
                "calcGstAdmin" => $calcGstAdmin = $valuees["calcGstAdmin"],
                "totalAlmacenaje" => $totalAlmacenaje = $valuees["totalAlmacenaje"],
                "tipoMov" => $tipoMov
            );
            array_push($dataRespuesta, $valorDataPendiente);
        }
        return $dataRespuesta;
    }

}
