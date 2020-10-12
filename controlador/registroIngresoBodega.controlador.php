<?php

use Endroid\QrCode\QrCode;

class ControladorRegistroBodega {

    public static function ctrMostrarNitCoin($razonSocial) {
        $respuesta = ModeloRegIngBod::mdlMostrarNitCon($razonSocial);
        return $respuesta;
    }

    public static function ctrConsultaDetalles($numeroUsuario) {
        $respuesta = ModeloRegIngBod::mdlConsultaDetalles($numeroUsuario);
        $sp = "spTipoServicio";
        $respuestaDetalle = ModeloRegIngBod::mdlConsultaUnParam($numeroUsuario, $sp);
        return array($respuesta, $respuestaDetalle);
    }

    public static function ctrUsarFilaDetalle($idUsarFila) {
        $respuesta = ModeloRegIngBod::mdlUsarFilaDetalle($idUsarFila);
        return $respuesta;
    }

    public static function ctrGuardarDetalle($datos, $usuarioOp) {

        $idChequeBodega = $datos["idChequeBodega"];
        $montacarga = $datos["montacarga"];
        $operacion = 2;
        $estado = 1;
        date_default_timezone_set('America/Guatemala');
        $time = date('Y-m-d H:i:s');
        $idIngreso = $datos['idOrdenIng'];
        $respuesta = ModeloRegIngBod::mdlGuardarDetalle($datos, $usuarioOp);
        $dataListaUbica = $datos["hiddenLista"];
        if ($datos["hiddenLista"] == "vehiculoUsado") {
            $idDetalle = $datos['idDetalle'];
            $ubicacion = $datos['selectUbicacion'];
            $sp = "spUbicacionVehUsado";
            $respuestaGUbica = ModeloRegIngBod::mdlUbicarVehUsado($sp, $idDetalle, $ubicacion);
            if ($respuestaGUbica[0]["resp"] == 2) {
                return "finDetalle";
            }
        } else {

            $dataListaUbica = json_decode($dataListaUbica, true);
            $llave = $respuesta["llaveIdent"][0]["Identity"];

            $respuestaGUbica = ModeloRegIngBod::mdlGuardarDetalleLista($dataListaUbica, $llave);
        }
        if ($respuestaGUbica == "fin") {
            return $respuesta;
        }
    }

    public static function ctrtraerDatosIngreso($codigo, $cliente) {
        $respuesta = ModeloRegIngBod::mdltraerDatosIngreso($codigo, $cliente);
        return $respuesta;
    }

    public static function ctrMostrarDetalles($codigo) {
        $respuesta = ModeloRegIngBod::mdlMostrarDetalles($codigo);
        return $respuesta;
    }

    public static function ctrSumaDetallesInc($codigo) {
        $respuesta = ModeloRegIngBod::mdlSumaDetallesInc($codigo);
        return $respuesta;
    }

    public static function ctrSumaDetallesMer($codigo) {
        $respuesta = ModeloRegIngBod::mdlSumaDetallesMer($codigo);
        return $respuesta;
    }

    public static function ctrSumaDetallesData($codigo) {
        $respuestaInc = ModeloRegIngBod::mdlSumaDetallesInc($codigo);
        $respuetaMer = ModeloRegIngBod::mdlSumaDetallesMer($codigo);
        if ($respuestaInc[0]["sumaIncidencias"] == $respuetaMer[0]["sumaMerca"]) {
            $respuetaHist = ModeloRegIngBod::mdlEliminarHistorial($codigo);

            return "ok";
        } else {
            return $respuetaMer;
        }
    }

    public static function ctrTraerDatosOperaciones($codigo) {
        $respuesta = ModeloRegIngBod::mdlTraerDatosOperaciones($codigo);
        return $respuesta;
    }

    public static function ctrTraerDatosBodega($codigo) {
        $respuesta = ModeloRegIngBod::mdlTraerDatosBodega($codigo);
        return $respuesta;
    }

    public static function ctrLlaveDetalleId($llaveRevisonDet) {
        $respuesta = ModeloRegIngBod::mdlLlaveDetalleId($llaveRevisonDet);
        return $respuesta;
    }

    public static function ctrEditarDetallesBodega($datos) {
        $respuesta = ModeloRegIngBod::mdlEditarDetallesBodega($datos);
        return $respuesta;
    }

    public static function ctrmostrarMapa($hiddenIdBod) {
        $respuesta = ModeloRegIngBod::mdlmostrarMapa($hiddenIdBod);
        if ($respuesta) {
            $respuestaInactivos = ModeloRegIngBod::mdlmostrarMapaInactivo($hiddenIdBod);
            return array("TCordenadas" => $respuesta, "TCordenadasIn" => $respuestaInactivos);
        }
    }

    public static function ctrTraerDatosBodegas($codigo, $tipo) {
        $respuesta = ModeloRegIngBod::mdlTraerDatosBodegas($codigo, $tipo);
        return $respuesta;
    }

    public static function ctrTraerDatosUnidades($codigo, $tipo) {
        $sp = "spValCadenaIng";
        $respuestaLlave = ModeloRegIngBod::mdlConsultaUnParam($codigo, $sp);
        $sp = "spValCadenaIngPasV";
        $respuestaLlaves = ModeloRegIngBod::mdlConsultaUnParam($codigo, $sp);
        if ($respuestaLlave != "SD") {
            $listaPilotos = array();
            foreach ($respuestaLlave as $key => $value) {
                if ($tipo == "Acuse") {
                    $codigo = $value["ingreso"];
                    $respuesta = ModeloRegIngBod::mdlTraerDatosUnidades($codigo);
                    if ($respuesta != "SD") {
                        foreach ($respuesta as $key => $value) {
                            $operacionPlt = array("operacion" => $value["operacion"], "idIngreso" => $value["idIngreso"], "licencia" => $value["licencia"], "piloto" => $value["piloto"], "marchamo" => $value["marchamo"], "placa" => $value["placa"], "contenedor" => $value["contenedor"], "numeroPoliza" => $value["numeroPoliza"]);
                            array_push($listaPilotos, $operacionPlt);
                        }
                    }
                } else {
                    if ($value["operacion"] != 0) {
                        $codigo = $value["ingreso"];
                        $respuesta = ModeloRegIngBod::mdlTraerDatosUnidades($codigo);
                        if ($respuestaLlaves != "SD") {
                            foreach ($respuesta as $key => $values) {
                                if ($values["unidad"] >= 1) {
                                    $operacionPlt = array("operacion" => $values["operacion"], "idIngreso" => $values["idIngreso"], "licencia" => $values["licencia"], "piloto" => $values["piloto"], "marchamo" => $values["marchamo"], "placa" => $values["placa"], "contenedor" => $values["contenedor"], "numeroPoliza" => $values["numeroPoliza"]);
                                    array_push($listaPilotos, $operacionPlt);
                                }
                            }
                        } else {
                            return "SD";
                        }
                    }
                }
            }
            $resp = [];
            foreach ($listaPilotos as $key => $value) {
                if ($key == 0) {
                    array_push($resp, $value);
                }
                if ($key >= 1) {
                    $dupli = 0;
                    foreach ($resp as $key => $values) {
                        if ($values["licencia"] == $value["licencia"]) {
                            $dupli = $dupli + 1;
                        }
                    }
                    if ($dupli == 0) {
                        array_push($resp, $value);
                    }
                }
            }

            return $resp;
        } else {

            if ($tipo == "PVacio") {
                $respuestaPVacio = ModeloRegIngBod::mdlTraerDatosUnidades($codigo);
                $resp = [];
                foreach ($respuestaPVacio as $key => $value) {
                    if ($key == 0) {
                        array_push($resp, $value);
                    }
                    if ($key >= 1) {
                        $dupli = 0;
                        foreach ($resp as $key => $values) {
                            if ($values["licencia"] == $value["licencia"]) {
                                $dupli = $dupli + 1;
                            }
                        }
                        if ($dupli == 0) {
                            array_push($resp, $value);
                        }
                    }
                }
                $respuestaPVacio = $resp;
                $datosPVacio = array();
                foreach ($respuestaPVacio as $key => $value) {
                    if ($value["unidad"] >= 1) {
                        $arrayPVacio = array("operacion" => $value["operacion"], "licencia" => $value["licencia"], "piloto" => $value["piloto"], "marchamo" => $value["marchamo"], "placa" => $value["placa"], "contenedor" => $value["contenedor"], "numeroPoliza" => $value["numeroPoliza"]);
                        array_push($datosPVacio, $arrayPVacio);
                    }
                }
                return $datosPVacio;
            } else {
                $respuesta = ModeloRegIngBod::mdlTraerDatosUnidades($codigo);
                return $respuesta;
            }
        }
    }

    public static function ctrMostarPaseSalida($idClientePaseRapido) {
        $sp = "spPilotosCont";
        $respuestaCount = ModeloRegIngBod::mdlConsultaUnParam($idClientePaseRapido, $sp);
        if ($respuestaCount[0]["conteoIng"] >= 1) {
            $sp = "spCadenaPlt";
            $respuestaCadenaPiloto = ModeloRegIngBod::mdlConsultaUnParam($idClientePaseRapido, $sp);
            if ($respuestaCadenaPiloto == "SD") {
                $respuestaCadenaPiloto = ModeloRegIngBod::mdlConsultaUnParam($idClientePaseRapido, $sp);
                echo $idClientePaseRapido;
            }
            $resp = [];
            foreach ($respuestaCadenaPiloto as $key => $value) {
                if ($key == 0) {
                    array_push($resp, $value);
                }
                if ($key >= 1) {
                    $dupli = 0;
                    foreach ($resp as $key => $values) {
                        if ($values["licencia"] == $value["licencia"]) {
                            $dupli = $dupli + 1;
                        }
                    }
                    if ($dupli == 0) {
                        array_push($resp, $value);
                    }
                }
            }
            return $resp;
        } else {

            $respuestaCadenaPiloto = ModeloRegIngBod::mdlTraerDatosUnidades($idClientePaseRapido);
            $resp = [];
            foreach ($respuestaCadenaPiloto as $key => $value) {
                if ($key == 0) {
                    array_push($resp, $value);
                }
                if ($key >= 1) {
                    $dupli = 0;
                    foreach ($resp as $key => $values) {
                        if ($values["licencia"] == $value["licencia"]) {
                            $dupli = $dupli + 1;
                        }
                    }
                    if ($dupli == 0) {
                        array_push($resp, $value);
                    }
                }
            }
            return $resp;
        }
    }

    public static function ctrGenerarPaseVacio($valUnidad, $tipo, $cadena, $usuarioOp) {

        //creando imagen QR para pase de salida, registro de pase de salida vacio.
        // si tipo = 0 se registrara como una salida con tipo de poliza consolidado con polizas.
        if ($tipo == 0) {
            $respuestaInsertPase = ModeloRegIngBod::mdlInsertPaseSalida($valUnidad, $usuarioOp);
            // VERIFICANDO CUALES PILOTOS PUEDEN RETIRARSE DE BODEGA Y ASI FINALIZAR EL INGRESO SI TODOS LOS PILOTOS YA ESTAN AUTORIZADOS
            if ($cadena != 0) {
                $sp = "spVerCadena";
                $respuestaRev = ModeloRegIngBod::mdlConsultaUnParam($valUnidad, $sp);
                $sp = "spVerCadenaSalida";
                $respCadenaSalida = ModeloRegIngBod::mdlConsultaUnParam($valUnidad, $sp);
            } else {
                $sp = "spPlts";
                $respuestaRev = ModeloRegIngBod::mdlConsultaUnParam($valUnidad, $sp);
                $sp = "spPltsCount";
                $respCadenaSalida = ModeloRegIngBod::mdlConsultaUnParam($valUnidad, $sp);
            }

            $respPltSal = $respCadenaSalida[0]["cantPases"];
            $contador = 1;
            foreach ($respuestaRev as $key => $valueCont) {
                if ($valueCont["estado"] == 1) {
                    $contador = $contador + 1;
                }
            }

            $sp = "spPilotosUnidadesIng";
            $respuestaCadena = ModeloRegIngBod::mdlConsultaUnParam($valUnidad, $sp);

            if ($respuestaInsertPase != "PaseYaExiste") {

                $idCadena = $respuestaCadena[0]["idCadena"];
                $respuestaRevConsPol = $valUnidad;
                $identidad = $respuestaCadena[0]["operacion"];
                if ($cadena != 0) {
                    $respuestaFinVinc = ModeloRegIngBod::mdlFinialVinculo($cadena);
                }

                $idIngreso = $respuestaCadena[0]["idIngreso"];
                $numAleatorio = mt_rand(0, 1000);
                $numAleatorioFin = (($numAleatorio * 2) - 5 * 3);
                date_default_timezone_set('America/Guatemala');
                $time = date('d-m-Y H:i:ssssss');
                $ranABC = Randomalfa();
                $aleatorios = md5($numAleatorioFin . $ranABC . $time);
                $piloto = $respuestaCadena[0]["piloto"];
                $licencia = $respuestaCadena[0]["licencia"];
                $marchamo = $respuestaCadena[0]["marchamo"];
                $placa = $respuestaCadena[0]["placa"];
                $contenedor = $respuestaCadena[0]["contenedor"];
                $numeroPoliza = $respuestaCadena[0]["numeroPoliza"];
                $suma = $identidad + $idIngreso;
                $resulSuma = ((($suma * 4) * 3) - 4);
                $concatDatos = md5($identidad . $piloto . $licencia . $marchamo . $placa . $contenedor . $numeroPoliza . $resulSuma);
                $hashGenerado = hash("sha512", $aleatorios . $concatDatos);
                $encriptar = crypt($hashGenerado, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
                /**
                 * 
                 * GUARDADANDO HASH 
                 * 
                 * */
                date_default_timezone_set('America/Guatemala');
                $times = date('Y-m-d H:i:s');
                $idPase = $respuestaInsertPase[0]["Identity"];
                $respuestaParaQr = ModeloRegIngBod::mdlGuardarToken($idPase, $encriptar, $times);
                $arrayDataImagen = array("numeroDePoliza" => $numeroPoliza, "numeroDePlaca" => $placa, "numeroContenedor" => $contenedor, "token" => $encriptar);
                $arrayDataImagen = json_encode($arrayDataImagen);
                $direccion = "../extensiones/imagenesQRCreadas/";
                if (!file_exists($direccion)) {
                    mkdir($direccion);
                }
                $codigoQR = new QrCode($arrayDataImagen, 'H', 5, 1);
                // La ruta en donde se guardará el código
                $nombreArchivoParaGuardar = ($direccion . "/qrCode" . $idIngreso . $numeroPoliza . $placa . ".png");
                // Escribir archivo,
                $codigoQR->writeFile($nombreArchivoParaGuardar);

                if ($contador == $respPltSal) {
                    foreach ($respuestaRev as $key => $valueFin) {
                        $sp = "spUpdateIngEstado";
                        $ingreso = $valueFin["ingreso"];
                        $respuesta = ModeloRegIngBod::mdlInsertUnParam($ingreso, $sp);
                    }
                    return "creadoFin";
                }
                return "creado";
            } else {
                return "PaseYaExiste";
            }
        } else if ($tipo == 1) {
            $sp = "spPilotosUnidadesIng";
            $respuesta = ModeloRegIngBod::mdlConsultaUnParam($valUnidad, $sp);
            // VERIFICANDO CUALES PILOTOS PUEDEN RETIRARSE DE BODEGA Y ASI FINALIZAR EL INGRESO SI TODOS LOS PILOTOS YA ESTAN AUTORIZADOS
            $contador = 1;
            $conteoResp = count($respuesta);
            foreach ($respuesta as $key => $value) {
                if ($value["unidad"] == 1) {
                    $contador = $contador + 1;
                }
            }

            $idUnidad = $respuesta[0]["operacion"];
            $idIngreso = $respuesta[0]["idIngreso"];
            $respuestaInsertPase = ModeloRegIngBod::mdlInsertPaseSalida($valUnidad, $usuarioOp);

            /*
             * GENERANDO TOKENS
             *
             */
            if ($respuestaInsertPase != "PaseYaExiste") {
                $respuestaRevConsPol = ModeloRegIngBod::mdlConsolidadoPoliza($idIngreso);
                if ($respuestaRevConsPol != "SD") {
                    $respuestaFinVinc = ModeloRegIngBod::mdlFinialVinculo($respuestaRevConsPol);
                }
                $identidad = $respuestaInsertPase[0]["Identity"];
                $numAleatorio = mt_rand(0, 1000);
                $numAleatorioFin = (($numAleatorio * 2) - 5 * 3);
                date_default_timezone_set('America/Guatemala');
                $time = date('d-m-Y H:i:ssssss');
                $ranABC = Randomalfa();
                $aleatorios = md5($numAleatorioFin . $ranABC . $time);
                $piloto = $respuesta[0]["piloto"];
                $licencia = $respuesta[0]["licencia"];
                $marchamo = $respuesta[0]["marchamo"];
                $placa = $respuesta[0]["placa"];
                $contenedor = $respuesta[0]["contenedor"];
                $numeroPoliza = $respuesta[0]["numeroPoliza"];
                $suma = $idUnidad + $idIngreso;
                $resulSuma = ((($suma * 4) * 3) - 4);
                $concatDatos = md5($identidad . $piloto . $licencia . $marchamo . $placa . $contenedor . $numeroPoliza . $resulSuma);
                $hashGenerado = hash("sha512", $aleatorios . $concatDatos);
                $encriptar = crypt($hashGenerado, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
                /**
                 * 
                 * GUARDADANDO HASH 
                 * 
                 * */
                date_default_timezone_set('America/Guatemala');
                $times = date('Y-m-d H:i:s');
                $idPase = $respuestaInsertPase[0]["Identity"];
                $respuestaParaQr = ModeloRegIngBod::mdlGuardarToken($idPase, $encriptar, $times);
                $arrayDataImagen = array("numeroDePoliza" => $numeroPoliza, "numeroDePlaca" => $placa, "numeroContenedor" => $contenedor, "token" => $encriptar);
                $arrayDataImagen = json_encode($arrayDataImagen);
                $direccion = "../extensiones/imagenesQRCreadas/";
                if (!file_exists($direccion)) {
                    mkdir($direccion);
                }
                $codigoQR = new QrCode($arrayDataImagen, 'H', 5, 1);
                // La ruta en donde se guardará el código
                $nombreArchivoParaGuardar = ($direccion . "/qrCode" . $idIngreso . $numeroPoliza . $placa . ".png");
                // Escribir archivo,
                $codigoQR->writeFile($nombreArchivoParaGuardar);
                if ($contador == $conteoResp) {
                    $sp = "spUpdateIngEstado";
                    $respuesta = ModeloRegIngBod::mdlInsertUnParam($idIngreso, $sp);
                    return "creadoFin";
                }
                return "creado";
            } else {
                return $respuestaInsertPase;
            }
        }
    }

    public static function ctrTraerUsuarios($Ingreso) {
        $sp = "spMostrarUsuarioIng";
        $respuesta = ModeloRegIngBod::mdlConsultaUnParam($Ingreso, $sp);
        return $respuesta;
    }

    public static function ctrMostVehNewFinalIng($idIngMstV) {
        $respuesta = ModeloRegIngBod::mdlMostVehNewFinalIng($idIngMstV);
        return $respuesta;
    }

    public static function ctrConsultarPredios($consultarPredio) {
        $sp = "spConsultaPredios";
        $respuesta = ModeloRegIngBod::mdlConsultaUnParam($consultarPredio, $sp);
        return $respuesta;
    }

    public static function ctrVehiculosUbicaN($vehiculosUbicaN, $listaValida, $usuarioOp) {
        $dataListaUbica = json_decode($listaValida, true);
        $respuestaFin = 0;
        $contador = 0;
        $sp = "spValNewUbica";
        foreach ($dataListaUbica as $key => $value) {
            $idData = $value[0];
            $respuestaRev = ModeloRegIngBod::mdlConsultaUnParam($idData, $sp);
            $estado = $respuestaRev[0]["estado"];
            if ($estado == 0) {
                $contador = $contador + 1;
            }
        }
        if ($contador == count($dataListaUbica)) {
            $listaRespuesta = [];
            $contadorRes = 0;
            $estadoIng = 0;
            foreach ($dataListaUbica as $key => $value) {
                $idData = $value[0];
                $respuestaRev = ModeloRegIngBod::mdlUpdateChasis($idData, $vehiculosUbicaN);
                if ($respuestaRev) {
                    $contadorRes = $contadorRes + 1;
                    array_push($listaRespuesta, $idData);
                    $sp = "spRevVehN";
                    $revFin = ModeloRegIngBod::mdlConsultaUnParam($idData, $sp);

                    if ($revFin[0]["countChas"] == 0) {
                        $estadoIng = 1;
                        $sp = "spFinalVN";
                        $respuestaFin = ModeloRegIngBod::mdlConsultaDosParam($idData, $sp, $usuarioOp);
                    }
                }
            }
            return array("tipoRes" => true, "listaResp" => $listaRespuesta, "estadoIng" => $estadoIng, "respFianl" => $respuestaFin);
        }
    }

    public static function ctrMostrarChasis($codigo) {
        $sp = "spMostrarChasis";
        $respuestaFin = ModeloRegIngBod::mdlConsultaUnParam($codigo, $sp);
        return $respuestaFin;
    }

    public static function ctrMostrarMontarguista($montarcarguista) {
        $sp = "spMontarguista";
        $respMontarguista = ModeloRegIngBod::mdlConsultaUnParam($montarcarguista, $sp);
        return $respMontarguista;
    }

    public static function ctrCadenaVinculo($codigo) {
        $sp = "spCadenaPlt";
        $respCadena = ModeloRegIngBod::mdlConsultaUnParam($codigo, $sp);
        return $respCadena;
    }

    public static function ctrVerificaIdVehUsado($verIdDetVehUsados) {
        $sp = "spVerificaVehUs";
        $respuesta = ModeloRegIngBod::mdlConsultaUnParam($verIdDetVehUsados, $sp);
        return $respuesta;
    }

    public static function ctrMostrarOPrediosVehUsados($prediosVehUsados) {
        $sp = "spPredioVeUsado";
        $respuesta = ModeloRegIngBod::mdlConsultaUnParam($prediosVehUsados, $sp);
        return $respuesta;
    }

    public static function ctrCambioVinculoCons($hiddCopy, $idIngPaste) {
        $sp = "spVinculoCambio";
        $respuesta = ModeloRegIngBod::mdlConsultaDosParam($hiddCopy, $sp, $idIngPaste);
        return $respuesta;
    }

}

function Randomalfa() {

//Variables
    $DesdeLetra = "a";
    $HastaLetra = "z";

    $DesdeLetra1 = "a";
    $HastaLetra1 = "z";

    $DesdeLetra2 = "f";
    $HastaLetra2 = "r";

    $DesdeLetra3 = "a";
    $HastaLetra3 = "q";


    $letraAleatoria = chr(rand(ord($DesdeLetra), ord($HastaLetra)));
    $letraAleatoria1 = chr(rand(ord($DesdeLetra1), ord($HastaLetra1)));
    $letraAleatoria2 = chr(rand(ord($DesdeLetra2), ord($HastaLetra2)));
    $letraAleatoria3 = chr(rand(ord($DesdeLetra3), ord($HastaLetra3)));

    $DesdeLetra4 = "i";
    $HastaLetra4 = "x";

    $DesdeLetra5 = "d";
    $HastaLetra5 = "t";

    $DesdeLetra6 = "A";
    $HastaLetra6 = "M";

    $DesdeLetra7 = "A";
    $HastaLetra7 = "Z";

    $DesdeLetra8 = "A";
    $HastaLetra8 = "Z";

    $letraAleatoria4 = chr(rand(ord($DesdeLetra), ord($HastaLetra)));
    $letraAleatoria5 = chr(rand(ord($DesdeLetra1), ord($HastaLetra1)));
    $letraAleatoria6 = chr(rand(ord($DesdeLetra2), ord($HastaLetra2)));
    $letraAleatoria7 = chr(rand(ord($DesdeLetra2), ord($HastaLetra2)));
    $letraAleatoria8 = chr(rand(ord($DesdeLetra2), ord($HastaLetra2)));
    $magic = $letraAleatoria . 'n' . $letraAleatoria1 . $letraAleatoria2 . $letraAleatoria3 . 'v' . $letraAleatoria4 . $letraAleatoria5 . 'r' . $letraAleatoria6 . $letraAleatoria7 . 'v' . $letraAleatoria8 . 't' . $letraAleatoria6 . $letraAleatoria4;
    $ramEncript = md5($magic);
    return $ramEncript;
}
