<?php

class ControladorOpB {

    public static function ctrMostrarOpB($tipo) {
        if ($tipo == 1) {
            $respuesta = ModeloControladorOpB::mdlControladorOpB($tipo);
            foreach ($respuesta as $key => $value) {
                echo '<option value="' . $value["id"] . '">' . $value["nitEmpresa"] . ' </option>';
            }
        }
    }

    public static function ctrConsultaEmpresa($consultaEmpresa) {
        $respuesta = ModeloControladorOpB::mdlConsultaEmpresa($consultaEmpresa);
        return $respuesta;
    }

    public static function ctrConsultaCodigo($codigo) {
        $respuesta = ModeloControladorOpB::mdlConsultaCodigo($codigo);
        return $respuesta;
    }

    public static function ctrRegistrarIngresoOperacion($datos) {
        $cartaDeCupo = $datos["cartaDeCupo"];
        $poliza = $datos["poliza"];
        $dua = $datos["dua"];
        $bl = $datos["bl"];
        $puertoOrigen = $datos["puertoOrigen"];
        $producto = $datos["producto"];
        $estadoIngreso = $datos["estadoIngreso"] * 1;
        $idUsuarioCliente = $datos["idUsuarioCliente"] * 1;
        $idNitCliente = $datos["idNitCliente"] * 1;
        $servicioTarifa = $datos["servicioTarifa"] * 1;
        $idRegPol = $datos["idRegPol"] * 1;
        $consolidado = $datos["consolidado"];
        $cantContenedores = $datos["cantContenedores"] * 1;
        $cantClientes = $datos["cantClientes"] * 1;
        $peso = $datos["peso"] * 1;
        $bultos = $datos["bultos"] * 1;
        $valorTotalAduana = $datos["valorTotalAduana"] * 1;
        $tipoDeCambio = $datos["tipoDeCambio"] * 1;
        $totalValorCif = $datos["totalValorCif"] * 1;
        $valorImpuesto = $datos["valorImpuesto"] * 1;
        $hiddenDateTime = $datos["hiddenDateTime"];

        //CASTEO DE NUMEROS ENTEROS
        if (is_numeric($estadoIngreso) && is_numeric($idUsuarioCliente) && is_numeric($idNitCliente) &&
                is_numeric($servicioTarifa) && is_numeric($idRegPol) && is_numeric($cantContenedores) &&
                is_numeric($cantClientes) && is_numeric($bultos) && is_numeric($peso) &&
                is_numeric($valorTotalAduana) && is_numeric($tipoDeCambio) && is_numeric($totalValorCif) &&
                is_numeric($valorImpuesto)) {
            $rspestadoIngreso = revisionData::datoEntero($estadoIngreso * 1);
            $rspidUsuarioCliente = revisionData::datoEntero($idUsuarioCliente * 1);
            $rspidNitCliente = revisionData::datoEntero($idNitCliente * 1);
            $rspservicioTarifa = revisionData::datoEntero($servicioTarifa * 1);
            $rspidRegPol = revisionData::datoEntero($idRegPol * 1);
            $rspcantContenedores = revisionData::datoEntero($cantContenedores * 1);
            $rspcantClientes = revisionData::datoEntero($cantClientes * 1);
            $rspbultos = revisionData::datoEntero($bultos * 1);
            $rspFlotpeso = revisionData::datoFlotante($peso);
            $rspFlotvalorTotalAduana = revisionData::datoFlotante($valorTotalAduana * 1);
            $rspFlottipoDeCambio = revisionData::datoFlotante($tipoDeCambio * 1);
            $rspFlottotalValorCif = revisionData::datoFlotante($totalValorCif * 1);
            $rspFlotvalorImpuesto = revisionData::datoFlotante($valorImpuesto * 1);

            $rStringcartaDeCupo = revisionData::datoString($cartaDeCupo);
            $rStringpoliza = revisionData::datoString($poliza);
            $rStringdua = revisionData::datoString($dua);
            $rStringbl = revisionData::datoString($bl);
            $rStringpuertoOrigen = revisionData::datoString($puertoOrigen);
            $rStringproducto = revisionData::datoString($producto);
            $rStringconsolidado = revisionData::datoString($consolidado);
            $rStringhiddenDateTime = revisionData::datoString($hiddenDateTime);
            if ($rspestadoIngreso == true && $rspidUsuarioCliente == true || $rspidUsuarioCliente == 0 && $rspidNitCliente == true &&
                    $rspservicioTarifa == true && $rspidRegPol == true && $rspcantContenedores == true &&
                    $rspcantClientes == true && $rspbultos == true && $rspFlotpeso == true && $rspFlotvalorTotalAduana == true &&
                    $rspFlottipoDeCambio == true && $rspFlottotalValorCif == true && $rspFlotvalorImpuesto == true &&
                    $rStringcartaDeCupo == true && $rStringpoliza == true && $rStringdua == true && $rStringbl == true &&
                    $rStringpuertoOrigen == true && $rStringproducto == true && $rStringconsolidado == true && $rStringhiddenDateTime == true) {

                $numPolRev = $datos['poliza'];
                $respuesta = ModeloControladorOpB::mdlRevisionPoliza($numPolRev);


                if ($respuesta[0]["resultado"] == 1) {
                    return 1;
                } else {

                    $respuesta = ModeloControladorOpB::mdlRegistrarIngresoOperacion($datos);

                    if ($respuesta["resp"]) {
                        $idSer = $datos["servicioTarifa"];
                        $sp = "spServicio";
                        $respuestaServicio = ModeloControladorOpB::mdlTipoNewVeh($idSer, $sp);
                        if ($respuestaServicio[0]["servicio"] == "VEHICULOS NUEVOS") {
                            $dato = $respuesta["dataTxt"][0]["Identity"] * 1;
                            $tipoOperacion = 1;
                            $respuestaUnidades = ModeloControladorOpB::mdlRegistroUnidades($dato, $datos, $tipoOperacion);
                            $llaveConsulta = $respuesta["dataTxt"][0]["Identity"] * 1;
                            $datosArrayDetalle = array("tipoBusqueda" => $datos["lblEmpresa"], "bultosAgregados" => $datos["bultos"], "pesoAgregado" => $datos["peso"], "idUs" => $datos["idUs"]);
                            $respuestaCltIndividual = ModeloControladorOpB::mdlAgregarDetallesVehiculos($llaveConsulta, $datosArrayDetalle);
                            return $respuesta["dataTxt"][0];
                        } else {
                            $dato = $respuesta["dataTxt"][0]["Identity"] * 1;
                            if ($dato >= 1) {
                                $resp = 0;
                                if ($datos["sel2"] == "Cliente individual" || $datos["sel2"] == "Cliente consolidado poliza") {
                                    $llaveConsulta = $respuesta["dataTxt"][0]["Identity"] * 1;
                                    $datosArrayDetalle = array("tipoBusqueda" => $datos["lblEmpresa"], "bultosAgregados" => $datos["bultos"], "pesoAgregado" => $datos["peso"], "idUs" => $datos["idUs"]);
                                    $tipoOperacion = 1;
                                    $respuestaUnidades = ModeloControladorOpB::mdlRegistroUnidades($dato, $datos, $tipoOperacion);
                                    $respuestaCltIndividual = ModeloControladorOpB::mdlAgregarDetalles($llaveConsulta, $datosArrayDetalle);
                                    return $respuesta["dataTxt"][0];
                                }
                                if ($datos["sel2"] == "Cliente consolidado poliza") {
                                    $idBodega = $datos["hiddenIdBod"];
                                    $paramPlaca = $datos['numeroPlaca'];
                                    $numeroMarchamo = $datos['numeroMarchamo'];
                                    $paramContenedor = $datos['numeroContenedor'];
                                    $fechaIngFormat = date("d-m-Y", strtotime($datos['hiddenDateTime']));
                                    $numeroLicencia = $datos['numeroLicencia'];
                                    $tipoConsolidadoPol = $datos["sel2"];
                                    $concatLlave = ($idBodega . $paramPlaca . $numeroMarchamo . $paramContenedor . $fechaIngFormat . $numeroLicencia);
                                    $llaveConsolidadoPoliza = md5($concatLlave);
                                    $tipoOperacion = 1;
                                    $busquedaConsolidadoGrd = $datos["busquedaConsolidadoGrd"];
                                    $respuestaVinculo = ModeloControladorOpB::mdlCadenaVinculo($dato, $tipoOperacion, $llaveConsolidadoPoliza, $busquedaConsolidadoGrd);
                                    if ($respuestaVinculo == "okVinculo") {
                                        $sp = "spValVinculo";
                                        $respuestaLlave = ModeloControladorOpB::mdlUnParametroConsult($llaveConsolidadoPoliza, $sp);
                                        if ($respuestaLlave[0]["countCadena"] == 1) {
                                            $tipoOperacion = 1;
                                            $respuestaUnidades = ModeloControladorOpB::mdlRegistroUnidades($dato, $datos, $tipoOperacion);
                                        }
                                        $resp = 1;
                                    } else {
                                        $resp = 2;
                                    }
                                }
                                $dato = $respuesta["dataTxt"][0]["Identity"] * 1;
                                $tipoOperacion = 1;
                                $respuestaUnidades = ModeloControladorOpB::mdlRegistroUnidades($dato, $datos, $tipoOperacion);

                                return $respuesta["dataTxt"][0];
                            }
                        }
                        return $respuestaCltIndividual;
                    } else {
                        return "ErrorDB";
                    }
                }
            } else {
                return array($rspestadoIngreso, $rspservicioTarifa, $rspcantClientes, $rspFlottipoDeCambio, $rStringcartaDeCupo, $rStringpuertoOrigen, $rspidUsuarioCliente, $rspidRegPol, $rspbultos, $rspFlottotalValorCif, $rStringpoliza, $rStringproducto, $rspidNitCliente, $rspcantContenedores, $rspFlotpeso, $rspFlotvalorImpuesto, $rStringdua, $rStringconsolidado, $rspFlotvalorTotalAduana, $rStringbl, $rStringhiddenDateTime);
            }
        } else {
            return $idUsuarioCliente;
        }
    }

    public static function ctrVerificarIngreso($numVerificarIng) {
        $respuesta = ModeloControladorOpB::mdlVerificarIngreso($numVerificarIng);
        return $respuesta;
    }

    public static function ctrMostrarNumeroIdNitCliente($numeroIdNitCliente) {
        $respuesta = ModeloControladorOpB::mdlMostrarNumeroIdNitCliente($numeroIdNitCliente);
        return $respuesta;
    }

    public static function ctrMostrarDatosEjecutivo($idEjecutivo) {
        $respuesta = ModeloControladorOpB::mdlMostrarDatosEjecutivo($idEjecutivo);
        return $respuesta;
    }

    public static function ctrEditarIngOP($datos) {
        $idIngrseso = $datos['identity'];
        $sp = "spConsulTipoConsol";
        $respuesta = ModeloControladorOpB::mdlEditarIngOP($datos);
        $respuestaTipCons = ModeloControladorOpB::mdlUnParametroConsult($idIngrseso, $sp);
        if ($respuestaTipCons[0]["consolidado"] == 0) {
            $bultos = $datos['bultosEditar'];
            $peso = $datos['pesoEditar'];
            $sp = "spEdicionDetIndivi";
            $respuestaEdicion = ModeloControladorOpB::mdlActualizacionDetallesMerca($idIngrseso, $bultos, $peso, $sp);
        }
        return $respuestaEdicion;
    }

    public static function ctrAnularIngreso($identityAnular) {
        $respuesta = ModeloControladorOpB::mdlAnularIngreso($identityAnular);
        return $respuesta;
    }

    public static function ctrMostrarIngPendientes() {

        $llaveIngresosPen = $_SESSION["idDeBodega"];
        $respuesta = ModeloControladorOpB::mdlMostrarIngPendientes($llaveIngresosPen);
        return $respuesta;
    }

    public static function ctrAgregandoDetalles($datos) {
        $respuesta = ModeloControladorOpB::mdlAgregandoDetalles($datos);
        return $respuesta;
    }

    public static function ctrVerificarSuma($identitySum) {
        $respueta = ModeloControladorOpB::mdlVerificarSuma($identitySum);
        return $respueta;
    }

    public static function ctrAgregarDetalles($llaveConsulta, $datos) {
        $respuesta = ModeloControladorOpB::mdlAgregarDetalles($llaveConsulta, $datos);
        return $respuesta;
    }

    public static function ctrAnularDetalle($llaveAnular) {
        $respuesta = ModeloControladorOpB::mdlAnularDetalle($llaveAnular);
        return $respuesta;
    }

    public static function ctrEditarDetalle($buttonEditar, $datos) {
        $respuesta = ModeloControladorOpB::mdlEditarDetalle($buttonEditar, $datos);
        return $respuesta;
    }

    public static function ctrMostrarServicio($MostrarServicio) {
        $respuesta = ModeloControladorOpB::ctrMostrarServicio($MostrarServicio);
        return $respuesta;
    }

    public static function ctrMostrarServicioGeneral($MostrarServicios) {
        $respuesta = ModeloControladorOpB::mdlMostrarServicioGeneral($MostrarServicios);
        return $respuesta;
    }

    public static function ctrValidacionNuevosVehiculos($listaValidacion, $tipo) {
        $objectValidar = json_decode($listaValidacion);
        $arrayRespuesta = [];
        foreach ($objectValidar as $key => $value) {
            if ($tipo == 0) {
                $chasis = $value[1];
                $TipoVehiculo = $value[2];
                $lineaVehiculo = $value[3];
            } else {
                $chasis = $value[0];
                $TipoVehiculo = $value[1];
                $lineaVehiculo = $value[2];
            }
            $respuesta = ModeloControladorOpB::mdlValidacionNuevosVehiculos($TipoVehiculo, $lineaVehiculo);
            $respuestaSimilar = ModeloControladorOpB::mdlSimilarNuevosVehiculos($TipoVehiculo, $lineaVehiculo);
            if ($respuesta == 0 && $respuestaSimilar == 1) {
                $respuesta = 2;
            }
            $datos = array("chasis" => $chasis, "TipoVehiculo" => $TipoVehiculo, "lineaVehiculo" => $lineaVehiculo, "estado" => $respuesta);
            array_push($arrayRespuesta, $datos);
        }
        return $arrayRespuesta;
    }

    public static function ctrMostrarFamiliaPol($tipoRegimenConsult) {
        $respuesta = ModeloControladorOpB::mdlMostrarFamiliaPol($tipoRegimenConsult);
        return $respuesta;
    }

    public static function ctrMostrarConcidencias($tipoBusqueda) {
        $respuesta = ModeloControladorOpB::mdlMostrarConcidencias($tipoBusqueda);
        return $respuesta;
    }

    public static function ctrConsultaPiloto($datoDpiConsult) {
        $respuesta = ModeloControladorOpB::mdlConsultaPiloto($datoDpiConsult);
        return $respuesta;
    }

    public static function ctrRevisionPoliza($numPolRev) {
        $respuesta = ModeloControladorOpB::mdlRevisionPoliza($numPolRev);
        return $respuesta;
    }

    public static function ctrStockBultosPeso($hiddenIdentityIngPeso, $bultosAgregados, $pesoAgregado) {
        $respuesta = ModeloControladorOpB::mdlStockBultosPeso($hiddenIdentityIngPeso, $bultosAgregados, $pesoAgregado);

        $nuevosBltos = $respuesta[0]["bultosAgregadosDet"] + $bultosAgregados;
        $nuevoPeso = $respuesta[0]["pesosAgregadosDet"] + $pesoAgregado;
        $saldoBlts = $respuesta[0]["bultosIng"] - $nuevosBltos;
        $saldoPeso = $respuesta[0]["pesoIngreso"] - $nuevoPeso;


        if ($saldoBlts >= 0) {
            if ($saldoBlts == 0) {
                if ($saldoPeso >= -0.10 && $saldoPeso <= 0.10 || $saldoPeso == 0 && $saldoPeso <= 0.10) {
                    $data = array("bultosIng" => $respuesta[0]["bultosIng"], "bultosSal" => $saldoBlts, "bultos" => $nuevosBltos,
                        "pesoIng" => $respuesta[0]["pesoIngreso"], "pesoSalida" => $saldoPeso, "pesoStock" => $nuevoPeso);
                    return array("estadoSaldo" => "Ok", "saldos" => $data);
                } else {
                    $data = array("bultosIng" => $respuesta[0]["bultosIng"], "bultosSal" => $saldoBlts, "bultos" => $nuevosBltos,
                        "pesoIng" => $respuesta[0]["pesoIngreso"], "pesoSalida" => $saldoPeso, "pesoStock" => $nuevoPeso);
                    return array("estadoSaldo" => "denegado", "saldos" => $data);
                }
            } else {
                $data = array("bultosIng" => $respuesta[0]["bultosIng"], "bultosSal" => $saldoBlts, "bultos" => $nuevosBltos,
                    "pesoIng" => $respuesta[0]["pesoIngreso"], "pesoSalida" => $saldoPeso, "pesoStock" => $nuevoPeso);
                return array("estadoSaldo" => "Ok", "saldos" => $data);
            }
        } else {

            $data = array("bultosIng" => $respuesta[0]["bultosIng"], "bultosSal" => $saldoBlts, "bultos" => $nuevosBltos,
                "pesoIng" => $respuesta[0]["pesoIngreso"], "pesoSalida" => $saldoPeso, "pesoStock" => $nuevoPeso);
            return array("estadoSaldo" => "denegado", "saldos" => $data);
        }
    }

    public static function ctrBuscarEmpresaConsolidada() {
        $respuesta = ModeloControladorOpB::mdlBuscarEmpresaConsolidada();

        foreach ($respuesta as $key => $value) {
            echo '<option value=' . $value["id"] . '>' . $value["consolidado"] . '</option>';
        }
    }

    public static function ctrGuardarPilotosPlus($hiddenIdentityPlus, $datos, $tipoOperacion) {
        $respuesta = ModeloControladorOpB::mdlRegistroUnidades($hiddenIdentityPlus, $datos, $tipoOperacion);
        return $respuesta;
    }

    public static function ctrRevisicionPiloto($revisionCui, $hiddenIdentityRevPlt) {

        $sp = "spValidarCui";
        $respuesta = ModeloControladorOpB::mdlRevisicionPiloto($revisionCui, $hiddenIdentityRevPlt, $sp);
        return $respuesta;
    }

    public static function ctrRevPilotosUnidadPlus($numeroLicenciaPlusRev, $numeroPlacaPlusUnRev, $numeroContenedorPlusUnRev, $numeroMarchamoPlusUnRev, $hiddenIdentityPlusRev, $tipoPlus) {
        $respuesta = ModeloControladorOpB::mdlRevPilotosUnidadPlus($numeroLicenciaPlusRev, $numeroPlacaPlusUnRev, $numeroContenedorPlusUnRev, $numeroMarchamoPlusUnRev, $hiddenIdentityPlusRev, $tipoPlus);
        return $respuesta;
    }

    public static function ctrNuevaEmpresa($nuevoNit, $nuevaEmpresa, $nuevaDireccion) {
        $respuesta = ModeloControladorOpB::mdlNuevaEmpresa($nuevoNit, $nuevaEmpresa, $nuevaDireccion);
        return $respuesta;
    }

    public static function ctrGuardarNuevosVehiculos($hiddenIdnetyIngV, $jsonVehiculosG, $usuarioOp) {

        //$respuesta = ModeloCalculos::mdlGuardarNuevosVehiculos($hiddenIdnetyIngV, $jsonVehiculosG);
        //revisando si los vehiculos no se estan duplicando
        $listaChasis = json_decode($jsonVehiculosG, true);

        $arrayChasisVal = [];
        $duplicado = 0;
        $varAgregados = 0;
        foreach ($listaChasis as $key => $value) {
            $varAgregados = $varAgregados + 1;
            $chasis = $value[0];
            $tipo = $value[1];
            $linea = $value[2];
            $repuesta = ModeloControladorOpB::mdlRevisionVehiculosNuevos($chasis, $tipo, $linea);
            if ($repuesta[0]["cantidadChas"] >= 1) {
                $duplicado = $duplicado + 1;
                array_push($arrayChasisVal, $chasis);
            }
        }
        if ($duplicado >= 1) {
            return array("chasisDuplicados" => $arrayChasisVal, "estado" => false);
        } else {
            //revisando las lineas que existen y cuales no      
            $tipo = 1;
            $respustaChasis = ControladorOpB::ctrValidacionNuevosVehiculos($jsonVehiculosG, $tipo);

            //guardando cada uno de los vehiculos
            $agregadosDB = 0;
            foreach ($respustaChasis as $key => $values) {

                if ($values["estado"] == 0) {
                    //vehiculos y lineas no registradas en nuestra db
                    $tipoVh = $values["TipoVehiculo"];
                    $lineaV = $values["lineaVehiculo"];
                    $sp = "spConsultaTipoV";
                    $respuesta = ModeloControladorOpB::mdlConsultaTipoV($tipoVh, $lineaV, $sp);

                    $idTipo = $respuesta[0]["tipoVe"];
                    //si el tipo de vehiculo no existe en db se agrega 

                    if ($respuesta[0]["tipoVe"] == 0 || $respuesta[0]["lineaVe"] == 0) {

                        if ($respuesta[0]["tipoVe"] == 0) {
                            $sp = "spNuevoTipoV";
                            $respInsertNuevoTipo = ModeloControladorOpB::mdlTipoNewVeh($tipoVh, $sp);
                            $idTipo = $respInsertNuevoTipo[0]["Identity"];
                        }
                        if ($respuesta[0]["lineaVe"] == 0) {
                            $sp = "spNuevaLinea";
                            $respInsertNuevoLinea = ModeloControladorOpB::mdlConsultaTipoV($idTipo, $lineaV, $sp);
                        }
                        //vehiculos y lineasde vehiculos registradas en nuestra db
                        $respuesta = ModeloControladorOpB::mdlGuardarVehiculo($hiddenIdnetyIngV, $values);
                        $agregadosDB = $agregadosDB + 1;
                    }
                } else {
                    //vehiculos y lineasde vehiculos registradas en nuestra db
                    $respuesta = ModeloControladorOpB::mdlGuardarVehiculo($hiddenIdnetyIngV, $values);
                    $agregadosDB = $agregadosDB + 1;
                }
            }
            if ($agregadosDB == $varAgregados) {
                $idIngreso = $hiddenIdnetyIngV;
                $idUSser = $usuarioOp;
                $estado = 0;
                $respuesta = ModeloControladorOpB::mdlEstadoIngresoFiscal($idIngreso, $estado, $idUSser);
            }

            if ($respuesta[0]["resp"] == 1) {
                return true;
            } else {
                return false;
            }
        }
    }

    public static function ctrConsultaEjecutivoDeTarifa($idNitCltEje) {
        $sp = "spCltEjecutivo";
        $respuesta = ModeloControladorOpB::mdlUnParametroConsult($idNitCltEje, $sp);
        return $respuesta;
    }

    public static function ctrDetallesVehiculosUSados($idIngVehUs, $idDetVehUs, $tipoVeh, $marcaVeh, $lineaVeh, $anioVehiculo) {
        $respuesta = ModeloControladorOpB::mdlDetallesVehiculosUSados($idIngVehUs, $idDetVehUs, $tipoVeh, $marcaVeh, $lineaVeh, $anioVehiculo);
        return $respuesta;
    }

    public static function ctrRevChbasisVehiculo($idIngRevVeh, $chasisRevVeh) {
        $respuesta = ModeloControladorOpB::mdlRevChbasisVehiculo($idIngRevVeh, $chasisRevVeh);
        return $respuesta;
    }

    public static function ctrMostrarTiposLines() {
        $identidad = $_SESSION["idDeBodega"];
        $respuesta = ModeloControladorOpB::mdlMostrarTiposLines($identidad);
        foreach ($respuesta as $key => $value) {
            echo '<option value=' . $value["idMedida"] . '>' . $value["tipoVeh"] . ' - ' . $value["lineaVeh"] . '</option>';
        }
    }

    public static function ctrConsultaTipoVehiculo($indexValue) {
        $respuesta = ModeloControladorOpB::mdlConsultaTipoVehiculo($indexValue);
        return $respuesta;
    }

    public static function ctrGuardarListaNoEncontrada($listaNoEncontrada) {

        $sp = "spMedidaVeh";
        $objectValidar = json_decode($listaNoEncontrada);
        foreach ($objectValidar as $key => $value) {
            $tipo = $value[0];
            $linea = $value[1];
            $respuesta = ModeloControladorOpB::mdlGuardarNuevaLinea($tipo, $linea, $sp);
            return $respuesta;
        }
    }

    public static function ctrMostrarValDeDetalles($idIngValDet) {
        $sp = "spConsultaBltPs";
        $respuesta = ModeloControladorOpB::mdlUnParametroConsult($idIngValDet, $sp);
        return $respuesta;
        
    }

}
