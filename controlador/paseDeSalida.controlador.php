<?php

class ControladorPasesDeSalida {

    public static function ctrListarRetiros($tipo) {
        $idDeBodega = $_SESSION["idDeBodega"];
        $sp = "spRevisionRetEstadoTres";
        $revision = ModeloPasesDeSalida::mdlMostrarOtrosServicios($sp);
        foreach ($revision as $key => $value) {
            $sp = "spSuperEstadoRet";
            $idRetSuper = $value["idRetOperacion"];
            $cambioData = ModeloPasesDeSalida::mdlValidacionCobro($sp, $idRetSuper);
        }
        if ($tipo == 1) {
            $sp = "spPaseSalidaCalc";
            $respuesta = ModeloPasesDeSalida::mdlListarRetiros($sp, $idDeBodega);
        }
        if ($tipo == 0) {
            $sp = "spPaseSalidaVehN";
            $respuesta = ModeloPasesDeSalida::mdlListarRetiros($sp, $idDeBodega);
        }

        if ($respuesta != "SD") {
            foreach ($respuesta as $key => $value) {

                if ($tipo == 1) {
                    if ($value["retAsignado"] == 0 && $value["reciboAsignado"] >= 1) {
                        $bottonera = '<div class="btn-group"><button type="button" class="btn btn-success btnConsultDataConfirm btn-sm" reciboAsignado=' . $value["reciboAsignado"] . ' retiroAsignado=0 correlInicio =' . $value["inicioCorrelativo"] . ' idRet =' . $value["identRet"] . ' idNitIng=' . $value["nitIngreso"] . ' servicio=' . $value["numId"] . ' idIngreso=' . $value["idIngOp"] . ' data-toggle="modal" data-target="#modalPaseSalida">Retiro&nbsp;<i class="fa fa-print"></i></button></div>';
                    }
                    if ($value["reciboAsignado"] == 0 && $value["retAsignado"] >= 1) {
                        $bottonera = '<div class="btn-group"><button type="button" class="btn btn-warning btnConsultDataConfirm btn-sm" reciboAsignado=0 retiroAsignado=' . $value["retAsignado"] . ' correlInicio =' . $value["inicioCorrelativo"] . ' idRet =' . $value["identRet"] . ' idNitIng=' . $value["nitIngreso"] . ' servicio=' . $value["numId"] . ' idIngreso=' . $value["idIngOp"] . ' data-toggle="modal" data-target="#modalPaseSalida">Recibo&nbsp;<i class="fa fa-print"></i></button></div>';
                    }
                    if ($value["reciboAsignado"] == 0 && $value["retAsignado"] == 0) {
                        $bottonera = '<div class="btn-group"><button type="button" class="btn btn-danger btnConsultDataConfirm btn-sm" reciboAsignado=0 retiroAsignado=0 polizaSal="' . $value["numPolIng"] . '" correlInicio =' . $value["inicioCorrelativo"] . ' idRet =' . $value["identRet"] . ' idNitIng=' . $value["nitIngreso"] . ' servicio=' . $value["numId"] . ' idIngreso=' . $value["idIngOp"] . ' data-toggle="modal" data-target="#modalPaseSalida">Pendiente &nbsp;<i class="fa fa-print"></i></button></div>';
                    }
                }
                if ($tipo == 0) {
                    $bottonera = '<div class="btn-group"><button type="button" class="btn btn-danger btnConsultDataConfirm btn-sm" id="btnVehNew" reciboAsignado=0 retiroAsignado=0 polizaSal="' . $value["numPolIng"] . '" correlInicio =' . $value["inicioCorrelativo"] . ' idRet =' . $value["identRet"] . ' idNitIng=' . $value["nitIngreso"] . ' servicio=' . $value["numId"] . ' idIngreso=' . $value["idIngOp"] . ' data-toggle="modal" data-target="#modalPaseSalida">RETIRO VEHICULOS &nbsp;<i class="fa fa-print"></i></button></div>';
                }
                echo '
                    <tr>
                        <td>' . ($key + 1) . '</td>
                        <td>' . $value["numNit"] . '</td>
                        <td>' . $value["empresa"] . '</td>
                        <td>' . $value["numPolIng"] . '</td>
                        <td>' . $value["polRet"] . '</td>
                        <td>' . $value["bultosRet"] . '</td>
                        <td>' . $value["pesoRet"] . '</td>
                        <td>' . $value["tipoServicio"] . '</td>';
                if ($_SESSION["departamentos"] == "Operaciones Fiscales") {
                    echo '    <td>' . $bottonera . '</td>';
                }
                echo '   
                    </tr>';
            }
        }
    }

    public static function ctrMostrarCalculoDatosUnidad($idRetCal, $idIngresoCal, $hiddenDateTimeVal) {
        if ($hiddenDateTimeVal == "NA") {
            $hiddenDateTimeVal = date('d-m-Y');
        }
        $spVeh = "spIngVehUsados";
        $respuestaRevertVeh = ModeloRetiroOpe::mdlDetUnParametro($idIngresoCal, $spVeh);

        if ($respuestaRevertVeh[0]["resp"] == 1) {
            $respuesta = ControladorRetiroOpe::ctrCalcVehUsados($idIngresoCal, $hiddenDateTimeVal);

            if ($respuesta == "SD") {
                return $respuesta;
            }
            $tiempoTotal = $respuesta["totalDiasC"];
            $datos = array("revCuad" => $respuesta["revCuad"], "almaMSuperior" => $respuesta["almacenaje"], "zonaAduanMSuperior" => 0, "calculoManejo" => $respuesta["manejo"], "gtoAdminMSuperior" => $respuesta["transEle"], "tiempoTotal" => $tiempoTotal, "nuevafechaInicio" => $respuesta["fechaIngreso"], "fechaCorte" => $respuesta["fechaCalculo"], "marchElectro" => $respuesta["marchElectro"], "serAcuse" => "SD");
            return $datos;
        } else {

            $respuesta = ModeloPasesDeSalida::mdlMostrarCalculoDatosUnidad($idRetCal, $idIngresoCal, $hiddenDateTimeVal);
            return $respuesta;
        }
    }

    public static function ctrConsultDatosRet($idNumRetConsult) {
        $respuesta = ModeloPasesDeSalida::mdlConsultDatosRet($idNumRetConsult);
        return $respuesta;
    }

    public static function ctrConsultaDatosGen($idRetDatosGen) {
        $respuesta = ModeloPasesDeSalida::mdlConsultaDatosGen($idRetDatosGen);

        return $respuesta;
        //   $respuestaPiloto = ModeloPasesDeSalida::mdlConsultaDatosGenPiloto($idRetDatosGen);
        //  $respuestaUnidad = ModeloPasesDeSalida::mdlConsultaDatosGenUnidad($idRetDatosGen);
    }

    public static function ctrMostrarOtrosServicios() {
        $sp = "spMuestraOtrosServicios";
        $respuesta = ModeloPasesDeSalida::mdlMostrarOtrosServicios($sp);
        foreach ($respuesta as $key => $value) {
            echo '<option value=' . $value["servicio"] . '>' . $value["otrosServicios"] . '</option>';
        }
    }

    public static function ctrMostrarOtrosServiciosExt() {
        $sp = "spMuestraOtrosServicios";
        $respuesta = ModeloPasesDeSalida::mdlMostrarOtrosServicios($sp);

        foreach ($respuesta as $key => $value) {
            echo '
                <tr>
                <td>' . ($key + 1) . '</td>
                <td>' . ($value["otrosServicios"]) . '</td>
                </tr>

';
        }
    }

    public static function ctrMostrarGrupoEmpresas() {
        $sp = "spGruposVeh";
        $respuesta = ModeloPasesDeSalida::mdlMostrarOtrosServicios($sp);

        if ($respuesta != "SD") {
            foreach ($respuesta as $key => $value) {
                echo '
                <tr>
                <td>' . ($key + 1) . '</td>
                <td>' . ($value["nombreEmpresa"]) . '</td>
                <td><button type="button" class="btn btn-outline-primary btn-sm bntGPOEmpresa" idButton="' . $value["id"] . '">Seleccionar</button></td>
                </tr>

';
            }
        }
    }

    public static function ctrMostrarGrupoEmpresasCorreo() {
        $sp = "spGruposVeh";
        $respuesta = ModeloPasesDeSalida::mdlMostrarOtrosServicios($sp);

        if ($respuesta != "SD") {
            foreach ($respuesta as $key => $value) {
                echo '
                <tr>
                <td>' . ($key + 1) . '</td>
                <td>' . ($value["nombreEmpresa"]) . '</td>
                <td><button type="button" class="btn btn-outline-primary btn-sm btnVerCorreos" idButton="' . $value["id"] . '">Seleccionar</button></td>
                </tr>

';
            }
        }
    }

    public static function ctrMostrarServiciosDefault() {
        $sp = "spServicioDefault";
        $respuesta = ModeloPasesDeSalida::mdlMostrarOtrosServicios($sp);

        foreach ($respuesta as $key => $value) {
            echo '<option value=' . $value["servicio"] . '>' . $value["servicioDef"] . '</option>';
        }
    }

    public static function ctrGuardarNuevoRecibo($datos) {
        $otros = $datos["listaOtrosGdRec"];
        $serviciosExt = $datos["listaServiciosDefaultGdRec"];
        $idRetCal = $datos["idRetGdRec"];
        $idIngresoCal = $datos["hiddenresultIdIngresoGdRec"];
        $hiddenDateTimeVal = $datos["hiddenDateTimeValRecEle"];
        $hiddenDescuento = $datos["hiddenDescuentoGdRec"];
        $valCalculado = $datos["valDescuentoGdRec"];
        $idNitFact = $datos["idNitFact"];
        if ($hiddenDateTimeVal == "NA") {
            $hiddenDateTimeVal = date('d-m-Y');
        }
        $spVeh = "spIngVehUsados";
        $respuestaRevertVeh = ModeloRetiroOpe::mdlDetUnParametro($idIngresoCal, $spVeh);

        if ($respuestaRevertVeh[0]["resp"] == 1) {
            $sp = "spMostrarPoliza";
            $hiddenTipoOP = 3;
            $mostrarPoliza = ModeloPasesDeSalida::mdlValidacionCobro($sp, $idRetCal);
            $polizaExtraSer = $mostrarPoliza[0]["poliza"];
            $respuesta = ControladorRetiroOpe::ctrCalcVehUsados($idIngresoCal, $hiddenDateTimeVal);

            $tiempoTotal = $respuesta["totalDiasC"];
            $almaMSuperior = $respuesta["almacenaje"];
            $zonaAduanMSuperior = 0;
            $calculoManejo = $respuesta["manejo"];
            $gtoAdminMSuperior = 0;
            $nuevafechaInicio = $respuesta["fechaIngreso"];
            $fechaCorte = $respuesta["fechaCalculo"];
            $revCuad = $respuesta["revCuad"];
            $marchElectro = $respuesta["marchElectro"];
        } else {

            $sp = "spMostrarPoliza";
            $hiddenTipoOP = 3;
            $mostrarPoliza = ModeloPasesDeSalida::mdlValidacionCobro($sp, $idRetCal);
            $polizaExtraSer = $mostrarPoliza[0]["poliza"];
            $respuestaCalculo = ModeloPasesDeSalida::mdlMostrarCalculoDatosUnidad($idRetCal, $idIngresoCal, $hiddenDateTimeVal);
            $almaMSuperior = $respuestaCalculo["almaMSuperior"];
            $zonaAduanMSuperior = $respuestaCalculo["zonaAduanMSuperior"];
            $calculoManejo = $respuestaCalculo["calculoManejo"];
            $gtoAdminMSuperior = $respuestaCalculo["gtoAdminMSuperior"];
            $nuevafechaInicio = $respuestaCalculo["nuevafechaInicio"];
            $fechaCorte = $respuestaCalculo["fechaCorte"];
            $marchElectro = $respuestaCalculo["marchElectro"];
            $revCuad = 0;
        }


        $tipoTran = 2;
        $estado = 2;
        $respuesta = ControladorCalculoDeAlmacenaje::ctrOtrosServiciosExtraGd($idIngresoCal, $otros, $serviciosExt, $hiddenDescuento, $polizaExtraSer, $valCalculado, $hiddenTipoOP, $estado, $idRetCal);
        $sp = "spValidaCobro";
        $respuestaValidacion = ModeloPasesDeSalida::mdlValidacionCobro($sp, $idRetCal);
        if ($respuestaValidacion[0]["valiCobro"] == 0) {
            $usuarioOp = $datos["usuarioOp"];
            $respuestaInsertCalculo = ModeloPasesDeSalida::mdlGuardarNuevoRecibo($idRetCal, $almaMSuperior, $zonaAduanMSuperior, $calculoManejo, $gtoAdminMSuperior, $marchElectro, $nuevafechaInicio, $fechaCorte, $usuarioOp, $revCuad, $idNitFact);
            return "Oks";
        } else {
            return "ARegistrado";
        }
    }

    public static function ctrVerCobrosDeAlmacenaje($reciboF) {
        $sp = "spOtrosGastosRet";
        $respuesta = ModeloPasesDeSalida::mdlValidacionCobro($sp, $reciboF);
        return $respuesta;
    }

    public static function ctrGuardarRetiroMerca($idRetAutorizado, $usuarioOp) {
        $sp = "spEstadoRet";
        $estado = 3;
        $asignar = 1;
        $respuesta = ModeloPasesDeSalida::mdlAccionesRetDosParam($sp, $idRetAutorizado, $estado, $asignar, $usuarioOp);
        $sp = "spEstadoTar";
        $revision = ModeloPasesDeSalida::mdlRevisionRetEstado($idRetAutorizado, $sp);
        return $respuesta;
    }

    public static function ctrPeticionGuatefacturas($reciboF) {

        //http://php.net/manual/es/book.xmlwriter.php

        $objetoXML = new XMLWriter();

        $objetoXML->openURI("reciboElectronico.xml"); //Creación del archivo XML

        $objetoXML->setIndent(true); //recibe un valor booleano para establecer si los distintos niveles de nodos XML deben quedar indentados o no.

        $objetoXML->setIndentString("\t"); // carácter \t, que corresponde a una tabulación

        $objetoXML->startDocument('1.0', 'utf-8'); // Inicio del documento

        $objetoXML->startElement('etiquetaPrincipal'); //Inicio del nodo raíz

        $objetoXML->writeAttribute("atributoEtiquetaPrincipal", "valor del Atributo"); //Atributos de una etiqueta raiz

        $objetoXML->startElement('etiquetaInterna'); //Inicio del nodo hijo

        $objetoXML->text("texto");

        $objetoXML->endElement(); //Fin del nodo hijo

        $objetoXML->endElement(); //Fin del nodo raíz    

        $objetoXML->endElement(); //Fin del nodo raíz

        $objetoXML->endDocument(); // Fin del documento
    }

    public static function ctrMostrarSerExtra($revExtrasPol, $idRet) {

        $respuesta = ControladorCalculoDeAlmacenaje::ctrExistePoliza($revExtrasPol);
        $tipo = 0;
        if ($respuesta != "SD") {
            $idRetCalc = $respuesta[0]["id"];
            $tipo = 1;
        } else {
            if ($idRet > 0) {
                $idRetCalc = $idRet;
                $tipo = 1;
            }
        }
        if ($tipo == 1) {
            $sp = "spVerMasRubros";
            $serPrestado = ModeloCalculoDeAlmacenaje::mdlVerificaTarifa($idRetCalc, $sp);
            $sp = "spVerDescuentos";
            $descuentoCalc = ModeloCalculoDeAlmacenaje::mdlVerificaTarifa($idRetCalc, $sp);
            return array("servPrestados" => $serPrestado, "descuentoCalc" => $descuentoCalc);
        } else {
            return false;
        }
    }

    public static function ctrOtrosRubros($retiroF) {
        $sp = "spMostrarPoliza";
        $mostrarPoliza = ModeloPasesDeSalida::mdlValidacionCobro($sp, $retiroF);
        $polizaExtraSer = $mostrarPoliza[0]["poliza"];
        $idRet = $retiroF;
        $respuesta = ControladorPasesDeSalida::ctrMostrarSerExtra($polizaExtraSer, $idRet);
        return $respuesta;
    }

    public static function ctrAuxiliares($retiroF, $tipo) {
        $sp = "spCltDataRet";
        $mostrarPoliza = ModeloPasesDeSalida::mdlAuxiliares($retiroF, $tipo, $sp);
        if ($mostrarPoliza == "SD") {
            $tipo = 2;
            $mostrarPoliza = ModeloPasesDeSalida::mdlAuxiliares($retiroF, 2, $sp);
        }
        return $mostrarPoliza;
    }

    public static function ctrMostrarValExtras($idRetCalc) {
        $sp = "spVerMasRubros";
        $serPrestado = ModeloCalculoDeAlmacenaje::mdlVerificaTarifa($idRetCalc, $sp);
        $sp = "spVerDescuentos";
        $descuentoCalc = ModeloCalculoDeAlmacenaje::mdlVerificaTarifa($idRetCalc, $sp);
        return array("servPrestados" => $serPrestado, "descuentoCalc" => $descuentoCalc);
    }

    public static function ctrMostrarRetValidacion($paseSalRetVal) {
        $sp = "spDatosRet";
        $respuesta = ModeloPasesDeSalida::mdlValidacionCobro($sp, $paseSalRetVal);
        return $respuesta;
    }

    public static function ctrReplaceDataRet($datos, $replaceDataRet) {
        $sp = "spReplaceValRet";
        $respuesta = ModeloPasesDeSalida::mdlReplaceDataRet($sp, $datos, $replaceDataRet);
        return $respuesta;
    }

}
