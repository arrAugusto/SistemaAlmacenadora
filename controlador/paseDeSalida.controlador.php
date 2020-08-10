<?php

class ControladorPasesDeSalida {

    public static function ctrListarRetiros() {
        $respuesta = ModeloPasesDeSalida::mdlListarRetiros();
        if ($respuesta != "SD") {
            foreach ($respuesta as $key => $value) {
                if ($value["aplica"] == 0 || $value["aplica"] == 1) {
                    if ($value["retAsignado"] == 0 && $value["reciboAsignado"] >= 1) {
                        $bottonera = '<div class="btn-group"><button type="button" class="btn btn-success btnConsultDataConfirm btn-sm" reciboAsignado=' . $value["reciboAsignado"] . ' retiroAsignado=0 correlInicio =' . $value["inicioCorrelativo"] . ' idRet =' . $value["identRet"] . ' idNitIng=' . $value["nitIngreso"] . ' servicio=' . $value["numId"] . ' idIngreso=' . $value["idIngOp"] . ' data-toggle="modal" data-target="#modalPaseSalida">Retiro&nbsp;<i class="fa fa-print"></i></button></div>';
                    }
                    if ($value["reciboAsignado"] == 0 && $value["retAsignado"] >= 1) {
                        $bottonera = '<div class="btn-group"><button type="button" class="btn btn-warning btnConsultDataConfirm btn-sm" reciboAsignado=0 retiroAsignado=' . $value["retAsignado"] . ' correlInicio =' . $value["inicioCorrelativo"] . ' idRet =' . $value["identRet"] . ' idNitIng=' . $value["nitIngreso"] . ' servicio=' . $value["numId"] . ' idIngreso=' . $value["idIngOp"] . ' data-toggle="modal" data-target="#modalPaseSalida">Recibo&nbsp;<i class="fa fa-print"></i></button></div>';
                    }
                    if ($value["reciboAsignado"] == 0 && $value["retAsignado"] == 0) {
                        $bottonera = '<div class="btn-group"><button type="button" class="btn btn-danger btnConsultDataConfirm btn-sm" reciboAsignado=0 retiroAsignado=0 polizaSal="' . $value["numPolIng"] . '" correlInicio =' . $value["inicioCorrelativo"] . ' idRet =' . $value["identRet"] . ' idNitIng=' . $value["nitIngreso"] . ' servicio=' . $value["numId"] . ' idIngreso=' . $value["idIngOp"] . ' data-toggle="modal" data-target="#modalPaseSalida">Pendiente &nbsp;<i class="fa fa-print"></i></button></div>';
                    }
                    echo '
<tr>
    <td>' . ($key + 1) . '</td>
    <td>' . $value["numNit"] . '</td>
    <td>' . $value["empresa"] . '</td>
    <td>' . $value["numPolIng"] . '</td>
    <td>' . $value["polRet"] . '</td>
    <td>' . $value["idIngOp"] . '</td>
    <td>' . $value["identRet"] . '</td>
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
    }

    public static function ctrMostrarCalculoDatosUnidad($idRetCal, $idIngresoCal, $hiddenDateTimeVal) {

        if ($hiddenDateTimeVal == "NA") {
            $hiddenDateTimeVal = date('d-m-Y');
        }

        $spVeh = "spIngVehUsados";
        $respuestaRevertVeh = ModeloRetiroOpe::mdlDetUnParametro($idIngresoCal, $spVeh);
        if ($respuestaRevertVeh[0]["resp"] == 1) {
            $respuesta = ControladorRetiroOpe::ctrCalcVehUsados($idIngresoCal, $hiddenDateTimeVal);
            $tiempoTotal = $respuesta["totalDiasC"];
            $datos = array("almaMSuperior" => $respuesta["almacenaje"], "zonaAduanMSuperior" => 0, "calculoManejo" => $respuesta["manejo"], "gtoAdminMSuperior" => $respuesta["transEle"], "tiempoTotal" => $tiempoTotal, "nuevafechaInicio" => $respuesta["fechaIngreso"], "fechaCorte" => $respuesta["fechaCalculo"]);
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

        if ($hiddenDateTimeVal == "NA") {
            $hiddenDateTimeVal = date('d-m-Y');
        }


        $spVeh = "spIngVehUsados";
        $respuestaRevertVeh = ModeloRetiroOpe::mdlDetUnParametro($idIngresoCal, $spVeh);
        if ($respuestaRevertVeh[0]["resp"] == 1) {
            $respuesta = ControladorRetiroOpe::ctrCalcVehUsados($idIngresoCal, $hiddenDateTimeVal);

        $sp = "spMostrarPoliza";
        $hiddenTipoOP = 3;
        $mostrarPoliza = ModeloPasesDeSalida::mdlValidacionCobro($sp, $idRetCal);
        $polizaExtraSer = $mostrarPoliza[0]["poliza"];
        $respuestaCalculo = ModeloPasesDeSalida::mdlMostrarCalculoDatosUnidad($idRetCal, $idIngresoCal, $hiddenDateTimeVal);
        $almaMSuperior = $respuesta["almacenaje"];
        $zonaAduanMSuperior = 0;
        $calculoManejo = $respuesta["manejo"];
        $gtoAdminMSuperior = $respuesta["transEle"];
        $nuevafechaInicio = $respuesta["fechaIngreso"];
        $fechaCorte = $respuesta["fechaCalculo"];
            
            
        }else{
            
        
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
        }
        $tipoTran = 2;
        $estado = 2;
        $respuesta = ControladorCalculoDeAlmacenaje::ctrOtrosServiciosExtraGd($otros, $serviciosExt, $hiddenDescuento, $polizaExtraSer, $valCalculado, $hiddenTipoOP, $estado, $idRetCal);
        $sp = "spValidaCobro";
        $respuestaValidacion = ModeloPasesDeSalida::mdlValidacionCobro($sp, $idRetCal);

        if ($respuestaValidacion[0]["valiCobro"] == 0) {
            $usuarioOp = $datos["usuarioOp"];
            $respuestaInsertCalculo = ModeloPasesDeSalida::mdlGuardarNuevoRecibo($idRetCal, $almaMSuperior, $zonaAduanMSuperior, $calculoManejo, $gtoAdminMSuperior, $nuevafechaInicio, $fechaCorte, $usuarioOp);
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

    public static function ctrMostrarSerExtra($revExtrasPol) {
        $respuesta = ControladorCalculoDeAlmacenaje::ctrExistePoliza($revExtrasPol);
        if ($respuesta != "SD") {
            $idRetCalc = $respuesta[0]["id"];
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
        $respuesta = ControladorPasesDeSalida::ctrMostrarSerExtra($polizaExtraSer);
        return $respuesta;
    }

    public static function ctrAuxiliares($retiroF, $tipo) {
        $sp = "spCltDataRet";
        $mostrarPoliza = ModeloPasesDeSalida::mdlAuxiliares($retiroF, $tipo, $sp);
        return $mostrarPoliza;
    }

}
