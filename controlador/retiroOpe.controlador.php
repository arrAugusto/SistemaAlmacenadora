<?php

use Endroid\QrCode\QrCode;

class ControladorRetiroOpe {

    public static function ctrMostrarNitRetiro($txtNitSalida) {
        $respuesta = ModeloRetiroOpe::mdlMostrarNitRetiro($txtNitSalida);
        return $respuesta;
    }

    public static function ctrMostrarBusqueda($datoSearch, $idDeBodega) {
        $respuesta = ModeloRetiroOpe::mdlMostrarBusqueda($datoSearch, $idDeBodega);
        return $respuesta;
    }

    public static function ctrMostrarEstadoDetalle($idBod) {
        $sp = "spMostrarEstado";
        $respuesta = ModeloRetiroOpe::mdlDetUnParametro($idBod, $sp);
        return $respuesta;
    }

    public static function ctrGuardarRetVehiculos($datos) {
        $listaVeh = json_decode($datos["listaVehiculos"], true);
        $estadoDup = 0;
        foreach ($listaVeh as $key => $value) {
            $respuestaChas = ControladorRetiroOpe::ctrRevisionChasisSalida($value[0]);
            if ($respuestaChas == "SD") {
                return array("tipoResp" => false, "data" => $value);
            }
        }
        $respuestaGuardar = ModeloRetiroOpe::ctrGuardarDataRet($datos);
        $arrayDataImagen = json_encode(array("retiroCod" => $respuestaGuardar, "numeroPoliza" => $datos['polizaRetiroVeh']));
        $estado = 0;
        if ($respuestaGuardar >= 1) {
            foreach ($listaVeh as $key => $value) {
                $sp = "spUpdateChasis";
                $valor = 2;
                $respuesta = ModeloRetiroOpe::mdlUpdateUnParam($value[0] * 1, $respuestaGuardar, $sp);
                if ($respuesta == false) {
                    $estado = 1;
                }
            }

            $recorrer = 1;
            if ($datos['jsonStorageDRVeh'] == 0) {
                $recorrer = 0;
            }
            if ($recorrer==1) {
                
       
                $jsonDecodeDR = json_decode($datos['jsonStorageDRVeh'], true);
                if (!emtpy($jsonDecodeDR)) {
                    
                
                foreach ($jsonDecodeDR as $key => $value) {
                    $poliza = $value["poliza"];
                    $idRet = $respuestaGuardar;
                    $bltsSumFinal = $value["bltsSumFinal"];
                    $valDolSumFinal = $value["valDolSumFinal"];
                    $cifFinal = $value["cifFinal"];
                    $impuestoFinal = $value["impuestoFinal"];
                    $sp = "spValContaRet";
                    $respuestaActStockGen = ModeloRetiroOpe::mdlInsertRetPolizaRetDR($poliza, $idRet, $bltsSumFinal, $valDolSumFinal, $cifFinal, $impuestoFinal, $sp);

                
                }
                     }
            } else {
                $idIngreso = $datos['hiddeniddeingresoVeh'];
                $respuestaActStockGen = ModeloRetiroOpe::mdlActualizarStockGeneral($idIngreso);
            }




            $direccion = "../extensiones/imagenesQRCreadasRet/";
            if (!file_exists($direccion)) {
                mkdir($direccion);
            }
            $codigoQR = new QrCode($arrayDataImagen, 'H', 5, 1);
            // La ruta en donde se guardará el código
            $nombreArchivoParaGuardar = ($direccion . "/qrCodeRet" . $respuestaGuardar . ".png");
            // Escribir archivo,
            $codigoQR->writeFile($nombreArchivoParaGuardar);
            return array("tipoResp" => true, "idRet" => $respuestaGuardar);
        }

//        return array("resRet"=>true, "data"=>true);
    }

    public static function ctrInsertRetiroOpe($datos) {

        $jsonDecodeDR = json_decode($datos['jsonStringDR'], true);
        $estadoTransaRebaja = 0;
        $contDetalle = 0;
        $estadoTransa = 0;


        $arrayDetalles = json_decode($datos['listaDetalles'], true);
        $contDetalle = count($arrayDetalles);
        foreach ($arrayDetalles as $key => $value) {
            $idDetalle = $value["idDetalles"];
            $cantBultos = $value["cantBultos"];
            $respuesta = ModeloRetiroOpe::mdlConsultarDetalle($idDetalle);

            $stock = $respuesta[0]["stock"];
            $saldoNuevo = $stock - $cantBultos;
            if ($saldoNuevo == 0 || $saldoNuevo >= 1) {
                $estadoTransa = $estadoTransa + 1;
            }
        }

        if ($estadoTransa == count($arrayDetalles)) {

            foreach ($arrayDetalles as $key => $value) {
                $idDetalle = $value["idDetalles"];
                $cantBultos = $value["cantBultos"];
                $respuesta = ModeloRetiroOpe::mdlConsultarDetalle($idDetalle);
                $stock = $respuesta[0]["stock"];
                $saldoNuevo = $stock - $cantBultos;
                if ($datos['jsonStringDR']=="SD") {
                    
          
                $respuesta = ModeloRetiroOpe::mdlNuevoStock($idDetalle, $saldoNuevo);
               
                if ($respuesta[0]["estado"] == 1) {
                    $estadoTransaRebaja = $estadoTransaRebaja + 1;
                }
                      }
            }
        } else if ($estadoTransa != count($arrayDetalles)) {
            return "denegado";
        }


        if ($estadoTransaRebaja == $contDetalle || $datos['jsonStringDR']!="SD") {
            $idIngreso = $datos["hiddeniddeingreso"];

            $respuesta = ModeloRetiroOpe::mdlInsertRetiroOpe($datos);
            $arrayDataImagen = json_encode(array("retiroCod" => $respuesta["valIdRetiro"], "numeroPoliza" => $datos['polizaRetiro']));
            if ($respuesta != "SD") {
                if ($datos['jsonStringDR'] != "SD") {
                    $jsonDecodeDR = json_decode($datos['jsonStringDR'], true);
                    foreach ($jsonDecodeDR as $key => $value) {
                        $poliza = $value["poliza"];
                        $idRet = $respuesta["valIdRetiro"];
                        $bltsSumFinal = $value["bltsSumFinal"];
                        $valDolSumFinal = $value["valDolSumFinal"];
                        $cifFinal = $value["cifFinal"];
                        $impuestoFinal = $value["impuestoFinal"];
                        $sp = "spValContaRet";
                        $respuestaActStockGen = ModeloRetiroOpe::mdlInsertRetPolizaRetDR($poliza, $idRet, $bltsSumFinal, $valDolSumFinal, $cifFinal, $impuestoFinal, $sp);
                    }
                } else {
                    $respuestaActStockGen = ModeloRetiroOpe::mdlActualizarStockGeneral($idIngreso);
                }
                $direccion = "../extensiones/imagenesQRCreadasRet/";
                if (!file_exists($direccion)) {
                    mkdir($direccion);
                }
                $codigoQR = new QrCode($arrayDataImagen, 'H', 5, 1);
                // La ruta en donde se guardará el código
                $nombreArchivoParaGuardar = ($direccion . "/qrCodeRet" . $respuesta["valIdRetiro"] . ".png");
                // Escribir archivo,
                $codigoQR->writeFile($nombreArchivoParaGuardar);


                if ($respuestaActStockGen[0]["resp"] == 1) {
                    return $respuesta;
                } else {
                    return "denegado";
                }
            } else {
                return "denegado";
            }
        }
    }

    public static function ctrMostrarSelectDetOpe($idIngSelectDet) {
        $respuesta = ModeloRetiroOpe::mdlMostrarSelectDetOpe($idIngSelectDet);
        $respuestaStock = ModeloRetiroOpe::mdlVerificacionStock($idIngSelectDet);

        return array("respuestaDetalle" => $respuesta, "respuestaStock" => $respuestaStock);
    }

    public static function ctrMostrarSaldosConta($idIngOpDet) {
        ///
        $sp = "spVerifSerIn";
        $respuestaServ = ModeloRetiroOpe::mdlDetUnParametro($idIngOpDet, $sp);

        if ($respuestaServ[0]["servicio"] == "VEHICULOS NUEVOS") {
            $sp = "spMostrarChasis";
            $respuestaVehN = ModeloRetiroOpe::mdlDetUnParametro($idIngOpDet, $sp);
            $respuesta = ModeloRetiroOpe::mdlMostrarSaldosConta($idIngOpDet);
            return array("respTipo" => "vehN", "data" => $respuestaVehN, "dataRetiro" => $respuesta);
        } else {
            $spVeh = "spIngVehUsados";
            $respuestaRevertVeh = ModeloIngresosPendientes::mdlTransaccionesPendientes($idIngOpDet, $spVeh);

            if ($respuestaRevertVeh[0]['resp'] == 1) {
                $respuesta = ModeloRetiroOpe::mdlMostrarSaldosConta($idIngOpDet);
                return array("respTipo" => "vehUs", "data" => $respuesta);
            } else {
                $respuesta = ModeloRetiroOpe::mdlMostrarSaldosConta($idIngOpDet);
                return array("respTipo" => "vehM", "data" => $respuesta);
            }
        }
    }

    public static function ctrMostrarStock($idIngresoCantBultos, $cantBultosVal) {
        $respuesta = ModeloRetiroOpe::mdlVerificacionStock($idIngresoCantBultos);
        if ($respuesta[0]["stock"] >= $cantBultosVal) {
            return "ok";
        } else {
            return "SobreGiro";
        }
    }

    public static function ctrConsultarDetalle($idOpDetTraer, $textoValDet) {

        $respuesta = ModeloRetiroOpe::mdlConsultarDetalle($idOpDetTraer);
        $stock = $respuesta[0]["stock"];
        if ($textoValDet == 0) {
            return "valorNoAceptado";
        }
        if ($stock >= 1) {
            if ($textoValDet >= 1) {

                $diferencia = $stock - $textoValDet;
                if ($diferencia >= 0) {
                    return $respuesta;
                } else {
                    return "Denegado";
                }
            } else {
                return "Denegado";
            }
        } else {
            return "SinSaldo";
        }
    }

    public static function ctrEditarRetiroOpF($datos, $idRetiroBtn, $usuarioOp) {
        $RevDetRebajados = json_decode($datos['listaDetallesEdit'], true);
     
        $contador = 0;
        foreach ($RevDetRebajados as $key => $value) {
            $idDetalle = $value["idDetalles"];
            $bultos = $value["cantBultos"];
            $sp = "spSelectStockBultos";
            $mostrarDetalleStock = ModeloRetiroOpe::mdlModificacionDetalles($idDetalle, $sp);
            $sp = "spConsultRetDet";
            $mostrarDetRebajado = ModeloRetiroOpe::mdlModificacionDetalles($idRetiroBtn, $sp);
            $arrayDetallesReb = json_decode($mostrarDetRebajado[0]["detallesRebajados"], true);


            if ($idDetalle == $arrayDetallesReb[0]["idDetalles"]) {
                $saldoActual = $mostrarDetalleStock[0]["bultosDetalle"];
                $Rebajado = $arrayDetallesReb[0]["cantBultos"];
                $saldoAnterior = $saldoActual + $Rebajado;
                $nuevosBultosRebajado = ($saldoAnterior - $value["cantBultos"]);
                if ($nuevosBultosRebajado == 0 || $nuevosBultosRebajado >= 1) {
                    $contador = $contador + 1;
                }
            } else {
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////                    
                $respuesta = ModeloRetiroOpe::mdlConsultarDetalle($idDetalle);
                $stock = $respuesta[0]["stock"];
                $valARebajar = $value["cantBultos"];
                $nuevoStock = $stock - $valARebajar;
                if ($nuevoStock >= 0) {
                    $contador = $contador + 1;
                }
            }
        }

        /**
         * REVISANDO QUE LOS DETALLES CAMBIAN O NO CAMBIEN
         * * */
        foreach ($RevDetRebajados as $key => $value) {
            foreach ($arrayDetallesReb as $keyDB => $valueDB) {
                if ($valueDB["idDetalles"] == $value["idDetalles"]) {
                    unset($arrayDetallesReb[$key]);
                }
            }
        }
        if (count($arrayDetallesReb) > 0) {
            if (count($RevDetRebajados) == $contador) {
                //reversion de detalles mercaderia
                $count = 0;

                foreach ($arrayDetallesReb as $key => $value) {
                    $idDetalles = $value["idDetalles"];

                    $cantidadBultos = $value["cantBultos"];
                    $sp = "spModStockAnterior";
                    $mostrarDetRebajado = ModeloRetiroOpe::mdlModificacionDetallesDosParams($idDetalles, $cantidadBultos, $sp);
                    if ($mostrarDetRebajado[0]["resp"] == 1) {

                        $count = $count + 1;
                        if ($value["estadoDet"] == 2) {
                            $sp = "spStockPosMts";
                            $pos = $value["valPosSalidaEdit"];
                            $mts = $value["valMtsSalidaEdit"];
                            $reversion = ModeloRetiroOpe::mdlModificacionDetallesTresParams($idDetalles, $pos, $mts, $sp);
                        }
                    }
                }

                if ($count == count($arrayDetallesReb)) {
                    foreach ($RevDetRebajados as $key => $value) {
                        $idDetalle = $value["idDetalles"];
                        $bultos = $value["cantBultos"];
                        $sp = "spSelectStockBultos";
                        $mostrarDetalleStock = ModeloRetiroOpe::mdlModificacionDetalles($idDetalle, $sp);
                        $sp = "spConsultRetDet";
                        $mostrarDetRebajado = ModeloRetiroOpe::mdlModificacionDetalles($idRetiroBtn, $sp);
                        $arrayDetallesReb = json_decode($mostrarDetRebajado[0]["detallesRebajados"], true);
                        if ($idDetalle == $arrayDetallesReb[0]["idDetalles"]) {
                            $saldoActual = $mostrarDetalleStock[0]["bultosDetalle"];
                            $Rebajado = $arrayDetallesReb[0]["cantBultos"];
                            $saldoAnterior = $saldoActual + $Rebajado;
                            $nuevosBultosRebajado = ($saldoAnterior - $value["cantBultos"]);
                            if ($nuevosBultosRebajado == 0 || $nuevosBultosRebajado >= 1) {
                                $sp = "spModStock";
                                $mostrarDetRebajado = ModeloRetiroOpe::mdlModificacionDetallesDosParams($idDetalle, $nuevosBultosRebajado, $sp);
                            }
                        } else {
                            $respuesta = ModeloRetiroOpe::mdlNuevoStock($idDetalle, $bultos);
                            $valPosSalida = $value["valPosSalidaEdit"];
                            $valMtsSalida = $value["valMtsSalidaEdit"];
                            $respPosMts = ControladorRetirosBodega::ctrGuardarDetalleSalida($idDetalle, $idRetiroBtn, $valPosSalida, $valMtsSalida, $usuarioOp);
                        }
                    }
                }
                $tipo = 1;
                $respuesta = ModeloRetiroOpe::mdlEditarRetiroOpF($datos, $idRetiroBtn, $tipo);
                return $respuesta;
            } else {
                return "sobregiro";
            }
        } else {

            $tipo = 1;
            $respuesta = ModeloRetiroOpe::mdlEditarRetiroOpF($datos, $idRetiroBtn, $tipo);
            return $respuesta;
        }
    }

    public static function ctrRevisionPoliza($numPolizaRev) {
        $sp = "spRevPolizaRet";
        $mostrarDetalleStock = ModeloRetiroOpe::mdlModificacionDetalles($numPolizaRev, $sp);
        return $mostrarDetalleStock;
    }

    public static function ctrRevisionChasisSalida($idChasVer) {
        $sp = "spRevChasisSalida";
        $respuesta = ModeloRetiroOpe::mdlDetUnParametro($idChasVer, $sp);
        return $respuesta;
    }

    public static function ctrEdicionVehN($datos) {
        //iniciando edicion
        $sp = "spVerEstadoVehRet";
        $idRet = $datos["hiddenIdentificadorVEd"];
        $respuesta = ModeloRetiroOpe::mdlDetUnParametro($idRet, $sp);

        foreach ($respuesta as $key => $value) {
            if ($value["estado"] >= 3) {
                return array("resp" => false, "tipo" => "fueraDeAlmacen");
            }
        }
        $listaFront = json_decode($datos["listaVehiculosVEd"], true);

        $arrayMayor = 0;
        if (count($listaFront) == count($respuesta)) {
            $listaRevisada = [];
            foreach ($respuesta as $keys => $value) {
                $rev = 0;
                foreach ($listaFront as $key => $values) {
                    if ($value["id"] == $values[0]) {
                        $rev = 1;
                    }
                }
                if ($rev == 0) {
                    array_push($listaRevisada, $value["id"]);
                }
            }
        }
        if (count($listaFront) > count($respuesta)) {
            $listaRevisada = [];
            foreach ($listaFront as $keys => $value) {
                $rev = 0;
                foreach ($respuesta as $key => $values) {
                    if ($values["id"] == $value[0]) {
                        $rev = 1;
                    }
                }
                if ($rev == 0) {
                    array_push($listaRevisada, $value[0]);
                }
            }
        }
            $listaRevisada = [];
        if (count($listaFront) < count($respuesta)) {

            foreach ($respuesta as $keys => $value) {
                $rev = 0;
                foreach ($listaFront as $key => $values) {
                    if ($value["id"] == $values[0]) {
                        $rev = 1;
                    }
                }
                if ($rev == 0) {
                    array_push($listaRevisada, $value["id"]);
                }
            }
        }

        if (count($listaRevisada) >= 1) {
            //$listaFront

            foreach ($listaRevisada as $key => $value) {
                $respuestaChas = ControladorRetiroOpe::ctrRevisionChasisSalida($value[0]);
                if ($respuestaChas == "SD") {


                    $sp = "spRevVeh";
                    $mostrarDetalleStock = ModeloRetiroOpe::mdlModificacionDetallesDosParams($idRet, $value, $sp);
                    if ($mostrarDetalleStock[0]["cantidadVeh"] == "SD") {
                        return array("tipoResp" => false, "data" => $value);
                    }
                }
            }
        }
        $sp = "spRemoveChasAnt";
        $respuesta = ModeloRetiroOpe::mdlUpdateParam($idRet, $sp);
        if ($respuesta) {
            $estado = 0;
            foreach ($listaFront as $key => $value) {
                $sp = "spUpdateChasis";
                $valor = 2;
                $respuesta = ModeloRetiroOpe::mdlUpdateUnParam($value[0] * 1, $idRet, $sp);
                if ($respuesta == false) {
                    $estado = 1;
                }
            }
        }
        $tipo = 2;
        $idRetiroBtn = $datos["hiddenIdentificadorVEd"];
        $respEdVeh = ModeloRetiroOpe::mdlEditarRetiroOpF($datos, $idRetiroBtn, $tipo);
        return $respEdVeh;
    }

    public static function ctrExcelRetFiscal($idRetFEx) {
        $sp = "spDataRetExcel";
        $respuesta = ModeloRetiroOpe::mdlModificacionDetalles($idRetFEx, $sp);
        return $respuesta;
    }

    public static function ctrDatosRetirosGenerardos($retiroFs) {
        $sp = "spDataRet";
        $respuesta = ModeloRetiroOpe::mdlDetUnParametro($retiroFs, $sp);
        return $respuesta;
    }

    public static function ctrValoresDRRetiro($retiroFs) {
        $sp = "spValoresDRRet";
        $respuesta = ModeloRetiroOpe::mdlDetUnParametro($retiroFs, $sp);
        return $respuesta;
    }

    public static function ctrDatosPilotos($retiroF, $estadoVerPlt) {
        $sp = "spConsultaRetUnidad";
        $tipo = 2;
        $respuesta = ModeloRetiroOpe::mdlModificacionDetallesTresParams($retiroF, $tipo, $estadoVerPlt, $sp);
        return $respuesta;
    }

    public static function ctrEditarPilotoUnidad($idRetUnidad) {
        $sp = "spConsultaRetUnidadRev";
        $respEdit = ModeloRetiroOpe::mdlModificacionDetalles($idRetUnidad, $sp);
        return $respEdit;
    }

    public static function ctrEditarPilotoUn($licEdit, $nombreEdit, $numeroPlacaEdit, $numeroContEdit, $numeroMarchEdit, $hiddenIdentEdit, $hiddenTipEdit, $identiUnidad) {
        $sp = "spEditarPilotoAnt";
        $respEdit = ModeloRetiroOpe::mdlEditarPilotoUn($licEdit, $nombreEdit, $numeroPlacaEdit, $numeroContEdit, $numeroMarchEdit, $hiddenIdentEdit, $hiddenTipEdit, $identiUnidad, $sp);
        return $respEdit;
    }

    public static function ctrBorrarActivarUnidad($borrarUnidad, $estado) {
        $sp = "spBorrarUnidad";

        $mostrarDetalleStock = ModeloRetiroOpe::mdlModificacionDetallesDosParams($borrarUnidad, $estado, $sp);
        return $mostrarDetalleStock;
    }

    public static function ctrCalcVehUsados($revVehUsados, $dateReVehUs) {
        $spVeh = "spIngVehUsados";
        $respuestaRevertVeh = ModeloRetiroOpe::mdlDetUnParametro($revVehUsados, $spVeh);
        if ($respuestaRevertVeh[0]["resp"] == 1) {
            $idPoliza = $revVehUsados;
            // OBJETO DECLARADO Y UTILIZADO PARA OBTENER VALORES DE EL INGRESO.
            $sp = "spDatosCalculoIng";
            $idIngreso = $revVehUsados;
            $datosIngInfo = ModeloCalculoDeAlmacenaje::mdlVerificaTarifa($idIngreso, $sp);
            $orgDate = $dateReVehUs;
            $date = str_replace('-"', '/', $orgDate);
            $fechaCalculo = date("d-m-Y", strtotime($date));
            $fechaIngreso = $datosIngInfo[0]["fechaRealIng"]; //ingreso de contenedor
            $tiempoTotal = funcionDiasCalc::diasCalc($fechaIngreso, $fechaCalculo); // DIAS TOTAL EN ALMACENADORA      
            $sp = "spTarifaVehUsados";
            $datosIng = ModeloCalculoDeAlmacenaje::mdlVerificaTarifa($idIngreso, $sp);
            if ($datosIng == "SD") {
                return $datosIng;
            }
            //CALCULO DE ALMACENAJE FISCAL

            foreach ($datosIng as $key => $value) {
                if ($value["servicio"] == "ALMACENAJE") {
                    $almacenaje = $value;
                }
            }
            if ($almacenaje["tipoMinimo"] == "base") {
                if ($tiempoTotal > $almacenaje["diaDeta"]) {
                    $diasCalc = $tiempoTotal - $almacenaje["diaDeta"];
                    $almacenaje = $almacenaje["minimoCobro"] + ($diasCalc * $almacenaje["deltaAlmacenajeDiario"]);
                } else {
                    $almacenaje = $almacenaje["minimoCobro"];
                }
            } else {
                $almacenaje = $almacenaje["minimoCobro"];
            }
            //CALCULO DE MANEJO FISCAL
            foreach ($datosIng as $key => $value) {
                if ($value["servicio"] == "MANEJO_CUADRILLA") {
                    $manejo = $value;
                }
            }
            $manejo = $manejo["minimoCobro"];

            //CALCULO DE TRANSMISION FISCAL
            foreach ($datosIng as $key => $value) {
                if ($value["servicio"] == "REVVEH") {
                    $revision = $value;
                }
            }

            $revision = $revision["minimoCobro"];
            $respMarcha = 0;
            foreach ($datosIng as $key => $value) {
                if ($value["servicio"] == "ALMACENAJE") {
                    if ($value["aplicaMarchamoElec"] == 1) {
                        if ($fechaIngreso >= $value["apartirFecha"]) {
                            $cantClientes = $value["clientes"];
                            $TarifaMarcElect = $value["marchamoElectronico"];
                            $minimoMarch = $value["minimoMarch"];
                            $respMarcha = calculosRubros::gastosAdminCalculo($TarifaMarcElect, $cantClientes, $minimoMarch);
                            $respMarcha = ceil($respMarcha / 5) * 5;
                            if ($respMarcha <= $minimoMarch) {
                                $respMarcha = $minimoMarch;
                            }
                        }
                    }
                    $respMarcha = ceil($respMarcha);
                }
            }
            return array("revCuad" => $revision, "almacenaje" => $almacenaje, "manejo" => $manejo, "transEle" => 0, "respuesta" => true, "datosIngInfo" => $datosIngInfo, "fechaCalculo" => $fechaCalculo, "fechaIngreso" => $fechaIngreso, "totalDiasC" => $tiempoTotal, "marchElectro" => $respMarcha);
        } else {
            return array("respuesta" => false);
        }
    }

    public static function ctrTrasladoZAAF($idIngTrasladar) {
        $sp = "spTrasladoFiscal";
        $respuesta = ModeloRetiroOpe::mdlModificacionDetalles($idIngTrasladar, $sp);
        return $respuesta;
    }

    public static function ctrMostrarSaldosAF($saldosAF) {
        $sp = "spVerSaldAF";
        $respuesta = ModeloRetiroOpe::mdlModificacionDetalles($saldosAF, $sp);
        return $respuesta;
    }

    public static function ctrAnularTransaccion($idtrans, $idoperacion, $motivoAnula, $usuarioOp) {
        //ANULACION RECIBO
        $sp = "spAnulacion";
        //ENVIANDO DATOS A MODELO DE RECEPCION TRES PARAMETROS
        $respuesta = ModeloRetiroOpe::mdlModificacionDetallesCuatroParams($idoperacion, $usuarioOp, $motivoAnula, $idtrans, $sp);
        return $respuesta;
    }

    public static function ctrDetalleVehN($idRetVehN) {
        $sp = "spChasisVNuevo";
        $respuesta = ModeloRetiroOpe::mdlModificacionDetalles($idRetVehN, $sp);
        return $respuesta;
    }

    public static function ctrRetiroVehN($retiroVehN, $usuarioOp) {
        $sp = "spEstadoRetVehN";
        $estado = 4;
        $asignar = 1;
        $respuesta = ModeloRetiroOpe::mdlRetiroVehN($retiroVehN, $estado, $asignar, $usuarioOp, $sp);
        return $respuesta;
    }

    public static function ctrRegistrarChasisGeneral($idRetChas, $listaChasis, $usuarioOp) {
        $listaVeh = json_decode($listaChasis, true);
        foreach ($listaVeh as $key => $value) {
            $idChas = $value["idChasis"];
            $valTotal = $value["valTotal"];
            $cif = $value["cif"];
            $impts = $value["impts"];
            $sp = "spTrasladoVeh";
            $respuesta = ModeloRetiroOpe::mdlRetiroVehNGdValores($idRetChas, $idChas, $cif, $impts, $valTotal, $usuarioOp, $sp);
        }
        return $respuesta;
    }

    public static function ctrRevisionDePolDR($polizaIngDR, $bltsDR, $cifDR, $imptDR) {
        //SALDO DE POLIZA DA
        $sp = "spSaldosDR";
        //ENVIANDO DATOS A MODELO
        $respuesta = ModeloRetiroOpe::mdlModificacionDetallesCuatroParams($polizaIngDR, $bltsDR, $cifDR, $imptDR, $sp);
        return $respuesta;
    }

    public static function ctrDataEditRetOp($tipoConsulRet, $idRetConsul) {
            $respuestaChasis = "SD";

        if ($tipoConsulRet == "Retiro") {
            $sp = "spDatosRetOp";
        }
        if ($tipoConsulRet == "Recibo") {
            $sp = "spSaldosDR";
        }
        $respuesta = ModeloRetiroOpe::mdlModificacionDetalles($idRetConsul, $sp);

        if ($respuesta[0]["countChas"]==0) {


            return array($respuesta, $respuestaChasis);
        }else{
            $sp = "spChasisVNuevo";
            $respuestaChasis = ModeloRetiroOpe::mdlModificacionDetalles($idRetConsul, $sp);
            return array($respuesta, $respuestaChasis);
        }

    }

    public static function ctrVerDataDetalleEditRet($idDetRevEd) {
        $sp = "spDetalleDeBod";
        $respuesta = ModeloRetiroOpe::mdlDetUnParametro($idDetRevEd, $sp);
        return $respuesta;
    }

    public static function ctrTrasladoDefinitivoAF($trasladoDefAf) {
        $sp = "spTrasladoFiscalDef";
        $respuesta = ModeloRetiroOpe::mdlDetUnParametro($trasladoDefAf, $sp);
        return $respuesta;
    }
    public static function ctrAnularRetiro($AnularRetiro, $motvAnulacion, $usuarioOp){
        $sp = "spAnularRetiro";
        $respuesta = ModeloRetiroOpe::mdlAnularRetiro($AnularRetiro, $motvAnulacion, $usuarioOp, $sp);
        return $respuesta;        
    }

}

class funcionDiasCalc {

    public static function diasCalc($fechaIngFormat, $fechaCorteFormat) {
        $fecha1 = new DateTime($fechaIngFormat);
        $fecha2 = new DateTime($fechaCorteFormat);
        $diff = $fecha1->diff($fecha2);
        $dias = ($diff->days + 1);
        return $dias;
    }

}
