<?php

use Endroid\QrCode\QrCode;

class ControladorRetirosRebajados {

    public static function ctrRetAutorizadosSalida() {
        $valor = $_SESSION["idDeBodega"];
        $respuesta = ModeloRetAutorizadosSalida::mdlRetAutorizadosSalida($valor);
        foreach ($respuesta as $key => $value) {
            if ($value["estado"] == 2) {
                $botonera = '<div class="btn-group"><button type="button" class="btn btn-outline-dark btn-sm btnRetVeh" identChas="' . $value["ident"] . '" estado="' . $value["estado"] . '"><i class="fa fa-car"></i>&nbsp;&nbsp;<i class="fa fa-check"></i></button><button type="button" class="btn btn-warning btn-sm btnRegresarAnt" identChas="' . $value["ident"] . '" estado="' . $value["estado"] . '" chasis="' . $value["chasis"] . '"data-toggle="modal" data-target="#cambioChasis"><i class="fa fa-window-close-o"></i></button><button type="button" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf-o"></i></button></div>';
            } else if ($value["estado"] == 3) {
                $botonera = '<div class="btn-group"><button type="button" class="btn btn-outline-success btn-sm btnRetVeh" identChas="' . $value["ident"] . '" estado="' . $value["estado"] . '"><i class="fa fa-car"></i>&nbsp;&nbsp;<i class="fa fa-check"></i></button><button type="button" class="btn btn-warning btn-sm btnRegresarAnt" identChas="' . $value["ident"] . '" estado="' . $value["estado"] . '"><i class="fa fa-window-close-o"></i></button><button type="button" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf-o"></i></button></div>';
            } else if ($value["estado"] == 4) {
                $botonera = '<div class="btn-group"><button type="button" class="btn btn-primary btn-sm btnRetVeh" identChas="' . $value["ident"] . '" estado="' . $value["estado"] . '" disabled="disabled"><i class="fa fa-car"></i>&nbsp;&nbsp;<i class="fa fa-check"></i></button><button type="button" class="btn btn-warning btn-sm btnRegresarAnt" identChas="' . $value["ident"] . '" estado="' . $value["estado"] . '"><i class="fa fa-window-close-o"></i></button><button type="button" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf-o"></i></button></div>';
            }
            echo '
                    <tr>
                        <td>' . ($key + 1) . '</td>
                        <td>' . ($value["nombreEmpresa"]) . '</td>
                        <td>' . ($value["chasis"]) . '</td>
                        <td>' . ($value["tipoVehiculo"]) . '</td>
                        <td>' . ($value["linea"]) . '</td>
                        <td>' . ($value["numeroPoliza"]) . '</td>
                        <td>' . ($value["polizaRetiro"]) . '</td>
                        <td>' . ($value["ret"]) . '</td>
                        <td>' . ($value["predio"]) . '</td>
                        <td>' . $botonera . '</td>                        

</tr>';
        }
    }

    public static function ctrAccionEstadoVeh($estado, $identChas, $tipo) {
        $respIdEs = revisionData::datoEntero($estado);
        $respIdChas = revisionData::datoEntero($identChas);
        $respIdTp = revisionData::datoEntero($tipo);

        if ($respIdEs == true && $respIdChas == true && $respIdTp == true || $respIdTp == 0) {
            if ($tipo == 1) {
                if ($estado == 2) {
                    $nuevoEstado = 3;
                }
                if ($estado == 3) {
                    $nuevoEstado = 4;
                }
            }
            if ($tipo == 0) {
                if ($estado == 3) {
                    $nuevoEstado = 2;
                }
                if ($estado == 4) {
                    $nuevoEstado = 3;
                }
            }
            $sp = "spNuevoEstadoChas";
            $respuesta = ModeloRetAutorizadosSalida::ctrInsertDosParams($sp, $identChas, $nuevoEstado);
            if ($respuesta != "SD" && $respuesta["resp"] == true) {
                return array("resp" => true, "primary" => $respuesta["data"]);
            } else if ($respuesta != "SD" && $respuesta["resp"] == false) {
                //ERRORES EN DB VALOR RECIBIDO POR AJAX NO ES ENTERO
                return array("resp" => false, "error" => "inconcistenica", "descripcion" => "Activar Servicios Almacenaje 46");
            } else {
                return array("resp" => false, "error" => "sinConcidencia");
            }
        } else {
            return array("resp" => false, "error" => "errorDato");
        }
    }

    public static function ctrReversionChasis($idNewChas, $idAntChasis) {
        $respAnt = revisionData::datoEntero($idNewChas);
        $respNew = revisionData::datoEntero($idAntChasis);
        if ($respAnt == true && $respNew) {

            $sp = "spReversionChas";
            $respuesta = ModeloRetAutorizadosSalida::ctrInsertDosParams($sp, $idNewChas, $idAntChasis);
            if ($respuesta != "SD" && $respuesta["resp"] == true) {
                return array("resp" => true, "primary" => $respuesta["data"]);
            } else if ($respuesta != "SD" && $respuesta["resp"] == false) {
                //ERRORES EN DB VALOR RECIBIDO POR AJAX NO ES ENTERO
                return array("resp" => false, "error" => "inconcistenica", "descripcion" => "Activar Servicios Almacenaje 46");
            } else {
                return array("resp" => false, "error" => "sinConcidencia");
            }
        } else {
            return array("resp" => false, "error" => "errorDato");
        }
    }

    public static function ctrPreparCorreo($chasisCorreo) {
        $arrayDetalles = json_decode($chasisCorreo, true);
        $sp = "spConsultaChasCorreo";
        $dataList = [];
        foreach ($arrayDetalles as $key => $value) {
            $chasis = $value[0];
            $respuesta = ModeloRetAutorizadosSalida::mdlPreparCorreo($chasis, $sp);
            array_push($dataList, $respuesta[0]);
        }
        return $dataList;
    }

    public static function ctrGuardarVehCorreo($guardarCorreo) {
        $arrayDetalles = json_decode($guardarCorreo, true);
        foreach ($arrayDetalles as $key => $value) {
            $idChasis = $value[0];
            $arrayData = array("codeChasis" => $value);
            $idDataQR = json_encode($arrayData);
            $sp = "spCorreoPrepara";
            $respuesta = ModeloRetAutorizadosSalida::mdlPreparCorreo($idChasis, $sp);

            $direccion = "../extensiones/imagenesQRChasSalida/";
            if (!file_exists($direccion)) {
                mkdir($direccion);
            }
            $codigoQR = new QrCode($idDataQR, 'H', 2, 1);
            // La ruta en donde se guardará el código
            $nombreArchivoParaGuardar = ($direccion . "/qrCodeRet" . $idChasis . ".png");
            // Escribir archivo,
            $codigoQR->writeFile($nombreArchivoParaGuardar);
        }
    }

    public static function ctrNewEmpresaGPO($gdEmpresaPrimary) {
        $sp = "spCreaNewEmpresa";
        $respuesta = ModeloRetAutorizadosSalida::mdlPreparCorreo($gdEmpresaPrimary, $sp);
        return $respuesta;
    }

    public static function ctrMostrarGrupoEmpresasVeh($idEmpresaGPO) {
        $sp = "spGPDependienteVeh";
        $respuesta = ModeloRetAutorizadosSalida::mdlPreparCorreo($idEmpresaGPO, $sp);
        return $respuesta;
    }

    public static function ctrGuardarNewEmpresaAlGP($idNitUnion, $idEmpresaUnion) {
        $sp = "spNuevaEmpresaGP";
        $respuesta = ModeloRetAutorizadosSalida::ctrInsertDosParams($sp, $idNitUnion, $idEmpresaUnion);
        return $respuesta;
    }

}
