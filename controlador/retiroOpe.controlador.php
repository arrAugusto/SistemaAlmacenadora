<?php

class ControladorRetiroOpe {

    public static function ctrMostrarNitRetiro($txtNitSalida) {
        $respuesta = ModeloRetiroOpe::mdlMostrarNitRetiro($txtNitSalida);
        return $respuesta;
    }

    public static function ctrMostrarBusqueda($datoSearch) {
        $respuesta = ModeloRetiroOpe::mdlMostrarBusqueda($datoSearch);
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
        $estado = 0;
        foreach ($listaVeh as $key => $value) {
            $sp = "spUpdateChasis";
            $valor = 2;
            $respuesta = ModeloRetiroOpe::mdlUpdateUnParam($value[0] * 1, $respuestaGuardar, $sp);
            if ($respuesta == false) {
                $estado = 1;
            }
        }
        return array("tipoResp" => true, "idRet" => $respuestaGuardar);


//        return array("resRet"=>true, "data"=>true);
    }

    public static function ctrInsertRetiroOpe($datos) {
        $arrayDetalles = json_decode($datos['listaDetalles'], true);
 
        $estadoTransa = 0;
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
            $estadoTransaRebaja = 0;
            foreach ($arrayDetalles as $key => $value) {
                $idDetalle = $value["idDetalles"];
                $cantBultos = $value["cantBultos"];
                $respuesta = ModeloRetiroOpe::mdlNuevoStock($idDetalle, $cantBultos);
                if ($respuesta[0]["estado"] == 1) {
                    $estadoTransaRebaja = $estadoTransaRebaja + 1;
                }
            }
        } else if ($estadoTransa != count($arrayDetalles)) {
            return "denegado";
        }
        if ($estadoTransaRebaja == count($arrayDetalles)) {
            $idIngreso = $datos["hiddeniddeingreso"];
            $cantBultos = $datos["cantBultos"];
            $valorCif = $datos["valorCif"];
            $calculoValorImpuesto = $datos["calculoValorImpuesto"];
            $valorTotalAduana = $datos["valorTotalAduana"];
            $pesoKg = $datos["pesoKg"];
            $respuesta = ModeloRetiroOpe::mdlInsertRetiroOpe($datos);
            $respuestaActStockGen = ModeloRetiroOpe::mdlActualizarStockGeneral($idIngreso, $cantBultos, $valorTotalAduana, $valorCif, $calculoValorImpuesto, $pesoKg);
            return $respuesta;
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

            $respuesta = ModeloRetiroOpe::mdlMostrarSaldosConta($idIngOpDet);
            return array("respTipo" => "vehM", "data" => $respuesta);
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

    public static function ctrEditarRetiroOpF($datos, $idRetiroBtn) {
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

        if (count($RevDetRebajados) == $contador) {
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
                        if ($mostrarDetRebajado == "editado") {
                            //editandoValores
                            $respuesta = ModeloRetiroOpe::mdlNuevoStock($idDetalle, $nuevosBultosRebajado);
                        }
                    }
                } else {
                    $respuesta = ModeloRetiroOpe::mdlNuevoStock($idDetalle, $bultos);
                }
            }
            $tipo = 1;
            $respuesta = ModeloRetiroOpe::mdlEditarRetiroOpF($datos, $idRetiroBtn, $tipo);
            return $respuesta;
        } else {
            return "sobregiro";
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
        $sp = "spRevChasisVehN";
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

        if (count($listaFront) < count($respuesta)) {
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

        if (count($listaRevisada) >= 1) {
            //$listaFront
            // $idRet 
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

    public static function ctrDatosRetirosGenerardos($retiroFs) {
        $sp = "spDataRet";
        $respuesta = ModeloRetiroOpe::mdlDetUnParametro($retiroFs, $sp);
        return $respuesta;
    }

    public static function ctrDatosPilotos($retiroF) {
        $sp = "spConsultaRetUnidad";
        $tipo = 2;
        $respuesta = ModeloRetiroOpe::mdlModificacionDetallesDosParams($retiroF, $tipo, $sp);
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

}
