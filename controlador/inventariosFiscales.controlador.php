<?php

class ControladorGeneracionDeInventarios {

    public static function ctrMostrarSaldos() {

        $valor = $_SESSION["idDeBodega"];
        if ($_SESSION["departamentos"] == "Operaciones Fiscales" && $_SESSION["niveles"] == "MEDIO") {
            $sp = "spSaldosSuper";
            $respuesta = ModeloHistorialIngresos::mdlMostrarChasisVehContables($sp, $valor);
        } else {
            $respuesta = ModeloGeneracionDeInventarios::mdlMostrarInventario($valor);
        }


        if ($respuesta !== null || $respuesta !== null) {
            if ($respuesta == "SD") {
                
            } else {

                foreach ($respuesta as $key => $value) {
                    // Con objetos
                    if ($_SESSION["departamentos"] == "Bodegas Fiscales" || $_SESSION["departamentos"] == "Operaciones Fiscales" && $_SESSION["niveles"] == "BAJO") {
                        if ($_SESSION["departamentos"] == "Bodegas Fiscales") {
                            if ($value["accionEstado"] >= 4) {
                                $botoneraAcciones = '<div class="btn-group"><a href="#divEdicionesBodega" class="btn btn-info btnEditBod btn-sm" estado=1 role="button" btnEditBod=' . $value["identificador"] . ' ><i class="fa fa-edit"></i></a><div class="btn-group"><button type="button" buttonId=' . $value["identificador"] . ' class="btn btn-success btnGeneracionExcel btn-sm"><i class="fa fa-file-excel-o"></i></button><div class="btn-group"><button type="button" buttonId=' . $value["identificador"] . ' class="btn btn-danger btnGenerarPDf btn-sm"><i class="fa fa-file-pdf-o"></i></button></div>';
                            }
                        } else {
                            if ($value["accionEstado"] >= 4) {
                                $botoneraAcciones = '<div class="btn-group"><a href="#divEdiciones" class="btn btn-warning btnEditOp btn-sm" estado=1 role="button" btnEditOp=' . $value["identificador"] . ' ><i class="fa fa-edit"></i></a><a href="#divEdicionesBodega" class="btn btn-info btnEditBod btn-sm" estado=1 role="button" btnEditBod=' . $value["identificador"] . ' ><i class="fa fa-edit"></i></a><div class="btn-group"><button type="button" buttonId=' . $value["identificador"] . ' class="btn btn-success btnGeneracionExcel btn-sm"><i class="fa fa-file-excel-o"></i></button><div class="btn-group"><button type="button" buttonId=' . $value["identificador"] . ' class="btn btn-danger btnGenerarPDf btn-sm"><i class="fa fa-file-pdf-o"></i></button></div>';
                            }
                        }
                    } else {
                        $botoneraAcciones = '<div class="btn-group"><a href="#divEdiciones" class="btn btn-warning btnEditOp btn-sm" estado=1 role="button" btnEditOp=' . $value["identificador"] . ' ><i class="fa fa-edit"></i></a><div class="btn-group"><button type="button" buttonId=' . $value["identificador"] . ' class="btn btn-success btnGeneracionExcel btn-sm"><i class="fa fa-file-excel-o"></i></button><div class="btn-group"></div>';
                    }
                    $fecha_actual = new DateTime();
                    $cadena_fecha_actual = $value["fechaRegistro"]->format("d-m-Y");

                    echo '
                                    <tr>
                                    <td>' . ($key + 1) . '</td>
                                    <td>' . ($respuesta[$key]["nit"]) . '</td>
                                    <td>' . ($value["empresa"]) . '</td>
                                    <td>' . ($value["poliza"]) . '</td>
                                    <td>' . ($cadena_fecha_actual) . '</td>
                                    <td>' . ($value["blts"]) . '</td>
                                    <td>' . ($value["cif"]) . '</td>
                                    <td>' . ($value["impuesto"]) . '</td>
                                    <td><center>' . $botoneraAcciones . '</center></td>
                                    </tr>';
                }
            }
        }
    }

    public static function ctrMostarDetalleExcel($idIngresoExcel) {
        $sp = "spStockDetalles";
        $respuestaDetalle = ModeloGeneracionDeInventarios::mdlMostarDetalleExcel($idIngresoExcel, $sp);


        $sp = "spGenerateExcel";
        $respuesta = ModeloGeneracionDeInventarios::mdlMostarDetalleExcel($idIngresoExcel, $sp);
        $sp = "spGenerateExcelDet";
        $respuestaDet = ModeloGeneracionDeInventarios::mdlMostarDetalleExcel($idIngresoExcel, $sp);
        $jsonGenerateExcel = [];
        if ($respuesta != "SD") {
            foreach ($respuesta as $key => $value) {
                $tipo = "Ingreso";
                $Nit_Razon = $value["nit"];
                $Razon_Social = $value["empresa"];
                $Documento = $value["numIng"];
                $Declaracion = $value["numPoliza"];
                $Fecha_Ingreso_Salida = $value["fechaIngresoAlSal"];
                $Fecha_Emision = $value["fechaIngresoRegistro"];
                $Bultos = $value["bultosIng"];
                $PesoKG = $value["ingPeso"];
                $Regimen_Decalaracion = $value["regimenPol"];
                $totalValorCif = $value["totalValorCif"];
                $valorImpuesto = $value["valorImpuesto"];
                $datosArray = array("Tipo_Documento" => $tipo, "Nit_Razon" => $Nit_Razon, "Razon_Social" => $Razon_Social, "Documento" => $Documento, "Declaracion" => $Declaracion, "Fecha_Ingreso_Salida" => $Fecha_Ingreso_Salida,
                    "Fecha_Emision" => $Fecha_Emision, "Bultos" => $Bultos, "PesoKG" => $PesoKG, "Regimen_Decalaracion" => $Regimen_Decalaracion,
                    "VALOR CIF" => $totalValorCif, "VALOR IMPUESTOS" => $valorImpuesto);
                array_push($jsonGenerateExcel, $datosArray);
            }
            if ($respuestaDet != "SD") {
                foreach ($respuestaDet as $key => $value) {
                    $tipo = "Retiro";
                    $Nit_Razon = $value["nit"];
                    $Razon_Social = $value["empresa"];
                    $Documento = $value["numRet"];
                    $Declaracion = $value["numPoliza"];
                    $Fecha_Ingreso_Salida = $value["fechaIngresoAlSal"];
                    $Fecha_Emision = $value["fechaIngresoRegistroSal"];
                    $Bultos = $value["retBultos"];
                    $PesoKG = $value["pesoKG"];
                    $Regimen_Decalaracion = $value["regimenPol"];
                    $datosArray = array("Tipo_Documento" => $tipo, "Nit_Razon" => $Nit_Razon, "Razon_Social" => $Razon_Social, "Documento" => $Documento, "Declaracion" => $Declaracion, "Fecha_Ingreso_Salida" => $Fecha_Ingreso_Salida,
                        "Fecha_Emision" => $Fecha_Emision,
                        "Bultos" => $Bultos, "PesoKG" => $PesoKG, "Regimen_Decalaracion" => $Regimen_Decalaracion);
                    array_push($jsonGenerateExcel, $datosArray);
                }
                $tipo = "";
                $Nit_Razon = "";
                $Razon_Social = "";
                $Documento = "";
                $Declaracion = "";
                $Fecha_Ingreso_Salida = "";
                $Fecha_Emision = "SALDOS ACTUALES";
                $Bultos = $respuesta[0]["saldoBultos"];
                $PesoKG = $respuesta[0]["pesoKgSald"];
                $Regimen_Decalaracion = "";

                $datosArray = array("Tipo_Documento" => $tipo, "Nit_Razon" => $Nit_Razon, "Razon_Social" => $Razon_Social, "Documento" => $Documento, "Declaracion" => $Declaracion, "Fecha_Ingreso_Salida" => $Fecha_Ingreso_Salida,
                    "Fecha_Emision" => $Fecha_Emision, "Bultos" => $Bultos, "PesoKG" => $PesoKG, "Regimen_Decalaracion" => $Regimen_Decalaracion);
                array_push($jsonGenerateExcel, $datosArray);

                $tipo = "------------";
                $Nit_Razon = "------------";
                $Razon_Social = "------------";
                $Documento = "------------";
                $Declaracion = "------------";
                $Fecha_Ingreso_Salida = "------------";
                $Fecha_Emision = "------------";
                $Bultos = "------------";
                $PesoKG = "------------";
                $Regimen_Decalaracion = "------------";
                $datosArray = array("Tipo_Documento" => $tipo, "Nit_Razon" => $Nit_Razon, "Razon_Social" => $Razon_Social, "Documento" => $Documento, "Declaracion" => $Declaracion, "Fecha_Ingreso_Salida" => $Fecha_Ingreso_Salida,
                    "Fecha_Emision" => $Fecha_Emision, "Bultos" => $Bultos, "PesoKG" => $PesoKG, "Regimen_Decalaracion" => $Regimen_Decalaracion);
                array_push($jsonGenerateExcel, $datosArray);
            }
        }
        return array("moviminetos" => $jsonGenerateExcel, "detalles" => $respuestaDetalle);
    }

    public static function ctrMostrarEdicionesBod($idIngEdicionBod) {
        $sp = "spStockDetalles";
        $respuestaDetalle = ModeloGeneracionDeInventarios::mdlMostarDetalleExcel($idIngEdicionBod, $sp);
        return $respuestaDetalle;
    }

    public static function ctrMostrarEdicionesUbica($iddetEdicionUbica) {
        $sp = "spEdicionUbicacion";
        $respuestaUbicas = ModeloGeneracionDeInventarios::mdlMostarDetalleExcel($iddetEdicionUbica, $sp);
        $sp = "spUbicaData";
        $listaUbicaciones = ModeloGeneracionDeInventarios::mdlMostarDetalleExcel($iddetEdicionUbica, $sp);
        $sp = "spMapa";
        $respuestaDibuja = ModeloGeneracionDeInventarios::mdlMostarDetalleExcel($iddetEdicionUbica, $sp);
        return array("respuestaUbicas" => $respuestaUbicas, "respuestaDibuja" => $respuestaDibuja, "listaUbicaciones" => $listaUbicaciones);
    }

    public static function ctrGuardaListaModificada($GdListaUbModificada, $idDet, $Idincidencia) {
        $dataListaUbica = json_decode($GdListaUbModificada, true);
        $sp = "spConsultaUbica";
        $guardarUbicacion = ModeloGeneracionDeInventarios::mdlModificacionesUbicaciones($idDet, $sp);
        $listaTesteada = [];
        foreach ($dataListaUbica as $key => $value) {
            $datoY = $value["datoY"];
            $datoY = $datoY * 1;
            $datoX = $value["datoX"];
            $datoX = $datoX * 1;
            $nuevoArrayLista = array("datoListaY" => $datoY, "datoListaX" => $datoX);
            array_push($listaTesteada, $nuevoArrayLista);
        }
        foreach ($guardarUbicacion as $key => $value) {
            $datoY = $value["pasillo"];
            $datoX = $value["columna"];
            $nuevoArrayLista = array("datoListaY" => $datoY, "datoListaX" => $datoX);
            array_push($listaTesteada, $nuevoArrayLista);
        }
        $listaUnique = [];
        foreach ($listaTesteada as $key => $value) {
            $estado = 0;
            $datoY = $value["datoListaY"];
            $datoY = $datoY * 1;
            $datoX = $value["datoListaX"];
            $datoX = $datoX * 1;
            $datoYX = $datoY + $datoX;
            foreach ($guardarUbicacion as $key => $value) {
                $datoDBY = $value["pasillo"];
                $datoDBY = $datoDBY * 1;
                $datoDBX = $value["columna"];
                $datoDBX = $datoDBX * 1;
                $datoDBYX = $datoDBY + $datoDBX;
                $valDatoXY = ($datoYX - $datoDBYX);
                if ($valDatoXY == 0) {
                    $estado = 1;
                }
            }
            if ($estado == 0) {
                $concatNueva = array("ubicacionY" => $datoY, "ubicacionX" => $datoX);
                array_push($listaUnique, $concatNueva);
            }
        }
        $respuestaGuardaUb = ModeloRegIngBod::mdlGuardarDetalleLista($listaUnique, $Idincidencia);
        return $respuestaGuardaUb;
    }

    public static function ctrEliminarUbicacion($pasilloYTrash, $columnaXTrash, $idIncidenciaTrash) {
        $sp = "spVerificarEstado";
        $verificaEstado = ModeloGeneracionDeInventarios::mdlModificacionesUbicaciones($idIncidenciaTrash, $sp);
        if ($verificaEstado[0]["cantUbicaciones"] == 1) {
            return "Denegado";
        } else if ($verificaEstado[0]["cantUbicaciones"] >= 2) {
            $sp = "spEliminarUbica";
            $respuestaEliminar = ModeloGeneracionDeInventarios::mdlEliminarUbicacion($pasilloYTrash, $columnaXTrash, $idIncidenciaTrash, $sp);
            return $respuestaEliminar;
        }
    }

    public static function ctrMostrarVehiculosUsados($mostrarVehiculosUsados) {

        $sp = "spListaVehUsados";
        $guardarUbicacion = ModeloGeneracionDeInventarios::mdlModificacionesUbicaciones($mostrarVehiculosUsados, $sp);
        return $guardarUbicacion;
    }

    public static function ctrMostrarUbicacionesVhUS($idDetChas) {
        $sp = "spMostrarUbicacion";
        $guardarUbicacion = ModeloGeneracionDeInventarios::mdlModificacionesUbicaciones($idDetChas, $sp);
        $listaDetalles = [];
        foreach ($guardarUbicacion as $key => $value) {
            if ($key == 0) {
                array_push($listaDetalles, $value);
            }
            if ($key >= 1) {
                $estado = 0;
                foreach ($listaDetalles as $key => $values) {
                    if ($values["descripcionMercaderia"] == $value["descripcionMercaderia"]) {
                        $estado = $estado + 1;
                    }
                }
                if ($estado == 0) {
                    array_push($listaDetalles, $value);
                }
            }
        }
        return array("detalles" => $listaDetalles, "ubicacionVehUs" => $guardarUbicacion);
    }

}
