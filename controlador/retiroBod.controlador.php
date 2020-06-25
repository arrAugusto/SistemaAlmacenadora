<?php

class ControladorRetirosBodega {

    public static function ctrRebajarRetiroBod() {
        $respuesta = ModeloRetirosBodega::mdlRebajarRetiroBod();
        if ($respuesta !== "SD") {

            foreach ($respuesta as $key => $value) {
                if ($_SESSION["departamentos"] == "Operaciones Fiscales" && $_SESSION["niveles"] == "MEDIO" || $_SESSION["departamentos"] == "Operaciones Generales" && $_SESSION["niveles"] == "ALTO" || $_SESSION["departamentos"] == "Ventas" || $_SESSION["departamentos"] == "Gerencia") {
                    $bottonera = '<div class="btn-group" role="group">
                                    <button type="button" class="btn btn-success btnDetalleRetBod btn-sm" id="buttonDetalleRet" idRetiro=' . $value["idRetiro"] . '  idIngreso=' . $value["idIngreso"] . ' data-toggle="modal" data-target="#modalRebajaMerca"><i class="fas fa-eye"></i></button>
                                  </div>';
                } else if ($_SESSION["departamentos"] == "Bodegas Fiscales" || $_SESSION["niveles"] == "ADMINISTRADOR" || $_SESSION["departamentos"] == "Operaciones Fiscales" && $_SESSION["niveles"] == "BAJO") {
                    $bottonera = '<div class="btn-group" role="group">
        <button type="button" class="btn btn-success btnDetalleRetBod btn-sm" id="buttonDetalleRet" idRetiro=' . $value["idRetiro"] . '  idIngreso=' . $value["idIngreso"] . ' data-toggle="modal" data-target="#modalRebajaMerca"><i class="fas fa-eye"></i></button>
        <button type="button" class="btn btn-primary btnSalidaBodega btn-sm" id="idBtnSalidaBodega" idRetiro=' . $value["idRetiro"] . '  ><i class="fa fa-rocket"></i></button>
</div>';
                }
                echo '
                <tr>
  <td>' . ($key + 1) . '</td>
  <td>' . $value["nit"] . '</td>
  <td>' . $value["empresa"] . '</td>
  <td>' . $value["polizaIng"] . '</td>
  <td>' . $value["regimenRet"] . '</td>
  <td>' . $value["polizaRetiro"] . '</td>
  <td>' . $value["numRetiro"] . '</td>
  <td> ' . $value["bultosRet"] . '</td>
  <td>' . $value["peso"] . ' kg</td>
  <td><center>
      ' . $bottonera . '
      </center>
  </td>
</tr>';
            }
        }
    }

    public static function ctrMostrarDetalle($idIngreso, $idRetiro) {
        $respuesta = ModeloRetirosBodega::mdlMostrarDetalle($idRetiro);
        $arrayDetalles = json_decode($respuesta[0]["detallesRebajados"], true);
        $arrayDetallesResp = [];
        foreach ($arrayDetalles as $key => $value) {
            $idDetalles = $value["idDetalles"];
            $cantBultos = $value["cantBultos"];
            $respuestaDetalles = ModeloRetirosBodega::mdlDetallesRet($idDetalles, $idRetiro);
            $empresa = $respuestaDetalles[0]["empresa"];
            $peso = $respuestaDetalles[0]["peso"];
            $polizaRet = $respuestaDetalles[0]["polizaRetiro"];
            $descripcionMercaderia = $respuestaDetalles[0]["descripcionMercaderia"];
            $numeroPoliza = $respuestaDetalles[0]["numeroPoliza"];
            $Ing = $respuestaDetalles[0]["Ing"];
            $Ret = $respuestaDetalles[0]["Ret"];
            $bultosRetirados = $respuestaDetalles[0]["bultosRetirados"];
            $bltsIngreso = $respuestaDetalles[0]["bltsIngreso"];
            $nuevoSaldo = $respuestaDetalles[0]["nuevoSaldo"];
            $PosRetirdas = $respuestaDetalles[0]["PosRetirdas"];
            $saldoPos = $respuestaDetalles[0]["saldoPos"];
            $ingresoPos = $respuestaDetalles[0]["ingresoPos"];
            $mtsIngresados = $respuestaDetalles[0]["mtsIngresados"];
            $mtsRetirados = $respuestaDetalles[0]["mtsRetirados"];
            $stockMts = $respuestaDetalles[0]["stockMts"];
            $posUnid = $respuestaDetalles[0]["posUnid"];
            $mtsUnd = $respuestaDetalles[0]["mtsUnd"];
            $arrayDetallePrep = array("idDet" => $idDetalles, "empresa" => $empresa, "valPeso" => $peso, "numeroBultos" => $cantBultos, "polRet" => $polizaRet, "descMerca" => $descripcionMercaderia, "polIng" => $numeroPoliza, "Ing" => $Ing, "Ret" => $Ret
                , "bultosRetirados" => $bultosRetirados, "bltsIngreso" => $bltsIngreso, "nuevoSaldo" => $nuevoSaldo, "PosRetirdas" => $PosRetirdas, "saldoPos" => $saldoPos, "ingresoPos" => $ingresoPos,
                "mtsIngresados" => $mtsIngresados, "mtsRetirados" => $mtsRetirados, "stockMts" => $stockMts, "posUnid" => $posUnid, "mtsUnd" => $mtsUnd);
            array_push($arrayDetallesResp, $arrayDetallePrep);
        }
        $respuestaUbicacion = ModeloRetirosBodega::mdlMostrarUbicaciones($idDetalles, $idRetiro);
        return array($arrayDetallesResp, $respuestaUbicacion);
    }

    public static function ctrGuardaDetalleRet($datos, $usuarioOp) {
        $respuesta = ModeloRetirosBodega::mdlGuardaDetalleRet($datos, $usuarioOp);

        $idIngresoCantBultos = $datos['hiddenidIngreso'];
        $respuestaVerif = ModeloRetiroOpe::mdlVerificacionStock($idIngresoCantBultos);
        if ($respuestaVerif[0]["stock"] == 0) {
            $respuestaLiquidarIng = ModeloRetirosBodega::mdlLiquidarStockIngreso($idIngresoCantBultos);
            if ($respuestaLiquidarIng == "oK") {
                return array("respuestaOpe" => $respuesta, "estado" => "liquidado");
            } else {
                return "error 500 server";
            }
        } else if ($respuestaVerif[0]["stock"] >= 1) {
            return array("respuestaOpe" => $respuesta, "estado" => $respuestaVerif);
        }
    }

    public static function ctrSumaSaldos($idIngOpDet) {
        $respuestaRet = ModeloRetirosBodega::mdlSumaSaldosRet($idIngOpDet);
        $respuestaIng = ModeloRetirosBodega::mdlSumaSaldosIng($idIngOpDet);
        $respuestaUbicaciones = ModeloRetirosBodega::mdlMostrarUbicaciones($idIngOpDet);
        if (!empty($respuestaRet[0]["cantBultos"])) {
            $bultos = $respuestaIng[0]["bultos"] - $respuestaRet[0]["cantBultos"];
            $posiciones = $respuestaIng[0]["pos"] - $respuestaRet[0]["cantPos"];
            $metros = $respuestaIng[0]["mts"] - $respuestaRet[0]["Cantmts"];
            $saldosActuales = array("bultos" => $bultos, "posiciones" => $posiciones, "metros" => $metros);
            return array("Ret" => $respuestaRet, "Ing" => $respuestaIng, "saldosActuales" => $saldosActuales, "Ubicaciones" => $respuestaUbicaciones);
        } else {
            return array("SD" => "SD", "Ing" => $respuestaIng, "Ubicaciones" => $respuestaUbicaciones);
        }
    }

    public static function ctrDetallesSalidaMerca($valIdRet) {
        $respuesta = ModeloRetirosBodega::mdlDetallesSalidaMerca($valIdRet);

        if ($respuesta != "SD") {
            $arrayDetalle = json_decode($respuesta[0]["detallesRebajados"], true);
            $arrayNuevoDetalle = [];
            foreach ($arrayDetalle as $key => $value) {
                $idDetalle = $value["idDetalles"];
                $respuestaDetalle = ModeloRetiroOpe::mdlConsultarDetalle($idDetalle);
                $sp = "spUsuarioOP";
                $respUsuario = ModeloRetiroOpe::mdlDetUnParametro($valIdRet, $sp);
                $datosUnidades = ControladorRetiroOpe::ctrDatosPilotos($valIdRet);
                $empresa = $respuestaDetalle[0]["empresa"];
                $bultos = $value["cantBultos"];
                $estado = $value["estadoDet"];
                $pos = $respuestaDetalle[0]["stockPos"];
                $mts = $respuestaDetalle[0]["stockMts"];
                if ($value["estadoDet"] == 0) {
                    $cantPos = $value["cantPos"];
                    $cantMts = $value["cantMts"];
                    $detalles = array("idDetalle" => $idDetalle, "empresa" => $empresa, "bultos" => $bultos, "pos" => $pos, "mts" => $mts, "cantPos" => $cantPos, "cantMts" => $cantMts, "estadoDet" => $value["estadoDet"]);
                } else {
                    $detalles = array("idDetalle" => $idDetalle, "empresa" => $empresa, "bultos" => $bultos, "pos" => $pos, "mts" => $mts, "estadoDet" => $value["estadoDet"]);
                }
                array_push($arrayNuevoDetalle, $detalles);
            }
        }
        return array($respuesta, $arrayNuevoDetalle, $respUsuario, $datosUnidades);
    }

    public static function ctrGuardarDetalleSalida($idDeta, $idRet, $valPosSalida, $valMtsSalida, $usuarioOp) {
        $respuestaDetalle = ModeloRetiroOpe::mdlConsultarDetalle($idDeta);
        if ($respuestaDetalle != "SD") {
            $stockPos = $respuestaDetalle[0]["stockPos"];
            $nuevoSaldo = $stockPos - $valPosSalida;
            $stockMts = $respuestaDetalle[0]["stockMts"];
            $nuevoSaldoMts = $stockMts - $valMtsSalida;
                $stockCondicional = $respuestaDetalle[0]["stock"];
            if ($respuestaDetalle[0]["stock"] == 0 && $nuevoSaldo == 0 && $nuevoSaldoMts == 0 ||
                    $respuestaDetalle[0]["stock"] > 0 && $nuevoSaldo > 0 && $nuevoSaldoMts > 0) {

                $respuestaDetalle = ModeloRetirosBodega::mdlDetallesSalidaMerca($idRet);

                $tipoEditG = 0;
                $respuesta = ControladorRetirosBodega::ctrAccionDetalle($tipoEditG, $idRet, $idDeta, $valPosSalida, $valMtsSalida, $usuarioOp);

                $arrayDetalleDB = json_decode($respuestaDetalle[0]["detallesRebajados"], true);
                $nuevoDetalleDB = [];
                foreach ($arrayDetalleDB as $key => $value) {
                    if ($value["idDetalles"] == $idDeta) {
                        $detalle = $value["idDetalles"];
                        $Blts = $value["cantBultos"];
                        $estado = 1;
                        $arrayNuevoDetalle = array("idDetalles" => $detalle, "cantBultos" => $Blts, "estadoDet" => $estado, "cantPos" => $valPosSalida, "cantMts" => $valMtsSalida);
                        array_push($nuevoDetalleDB, $arrayNuevoDetalle);
                    } else {
                        $detalle = $value["idDetalles"];
                        $Blts = $value["cantBultos"];
                        $estado = $value["estadoDet"];
                        $arrayNuevoDetalle = array("idDetalles" => $detalle, "cantBultos" => $Blts, "estadoDet" => $estado, "cantPos" => $valPosSalida, "cantMts" => $valMtsSalida);
                        array_push($nuevoDetalleDB, $arrayNuevoDetalle);
                    }
                }
                $arrayNuevoDetalle = json_encode($nuevoDetalleDB, false);
                $respuestaUpdate = ModeloRetirosBodega::mdlUpdateDetalle($idRet, $arrayNuevoDetalle, $usuarioOp);
                if ($respuestaUpdate=="exito" && $stockCondicional > 0) {
                    return "puedeEditar";
                }else{
                    return "exito";
                }
            } else {
                return "sobreGirara";
            }
        }
    }

    public static function ctrAccionDetalle($tipoEditG, $idRetEdit, $idDetaEdit, $valPosSalidaEdit, $valMtsSalidaEdit, $usuarioOp) {
        if ($tipoEditG == 1) {
            $respuesta = ModeloRetirosBodega::mdlAccionDetalleEditar($tipoEditG, $idRetEdit, $idDetaEdit, $valPosSalidaEdit, $valMtsSalidaEdit);
            if ($respuesta) {
                $respuestaDetalle = ModeloRetirosBodega::mdlDetallesSalidaMerca($idRetEdit);
                $arrayDetalle = json_decode($respuestaDetalle[0]["detallesRebajados"], true);
                foreach ($arrayDetalle as $key => $value) {
                    $saldoAnteriorPos = $value["cantPos"];
                    $saldoAnteriorMts = $value["cantMts"];
                    $respuestaEditEstock = ModeloRetirosBodega::mdlAccionDetalleEditar($idDetaEdit, $valPosSalidaEdit, $valMtsSalidaEdit, $saldoAnteriorPos, $saldoAnteriorMts);
                }
            }
        } else if ($tipoEditG == 0) {

            $respuestaDetalle = ModeloRetirosBodega::mdlDetallesSalidaMerca($idRetEdit);
            $arrayDetalle = json_decode($respuestaDetalle[0]["detallesRebajados"], true);
            $nuevoArrayDetalle = [];
            foreach ($arrayDetalle as $key => $value) {
                if ($value["idDetalles"] == $idDetaEdit && $value["estadoDet"] == 1) {
                    $cantBultos = $value["cantBultos"];
                    $estadoDet = 2;
                    $arrayNuevo = array("idDetalles" => $value["idDetalles"], "cantBultos" => $cantBultos, "valPosSalidaEdit" => $valPosSalidaEdit, "valMtsSalidaEdit" => $valMtsSalidaEdit, "estadoDet" => $estadoDet);
                    if ($key == 0) {
                        $json = json_encode($arrayNuevo, false);
                    } else if ($key >= 1) {
                        $json = $json . ',' . json_encode($arrayNuevo, false);
                    }
                } else if ($value["idDetalles"] != $idDetaEdit && $value["estadoDet"] == 1) {
                    $cantBultos = $value["cantBultos"];
                    $estadoDet = $value["estadoDet"];
                    $arrayNuevo = array("idDetalles" => $value["idDetalles"], "cantBultos" => $cantBultos, "estadoDet" => $estadoDet);
                    if ($key == 0) {
                        $json = json_encode($arrayNuevo, false);
                    } else if ($key >= 1) {
                        $json = $json . ',' . json_encode($arrayNuevo, false);
                    }
                } else if ($value["estadoDet"] == 2) {
                    $cantBultos = $value["cantBultos"];
                    $valPosSalidaEdit = $value["valPosSalidaEdit"];
                    $valMtsSalidaEdit = $value["valMtsSalidaEdit"];
                    $estadoDet = $value["estadoDet"];
                    $arrayNuevo = array("idDetalles" => $value["idDetalles"], "cantBultos" => $cantBultos, "valPosSalidaEdit" => $valPosSalidaEdit, "valMtsSalidaEdit" => $valMtsSalidaEdit, "estadoDet" => $estadoDet);
                    if ($key == 0) {
                        $json = json_encode($arrayNuevo, false);
                    } else if ($key >= 1) {
                        $json = $json . ',' . json_encode($arrayNuevo, false);
                    }
                }
            }
            $nuevoDetalleArray = '[' . $json . ']';
            $sp = "spNuevoDet";
            $actualizarDetalle = ModeloRetirosBodega::mdlRetiroBodParamUno($idRetEdit, $nuevoDetalleArray, $sp);
            if ($actualizarDetalle == "Ok") {
                $actualizarStock = ModeloRetirosBodega::mdlActualizarStock($idDetaEdit, $valPosSalidaEdit, $valMtsSalidaEdit);

                $respuestaDetalle = ModeloRetirosBodega::mdlDetallesSalidaMerca($idRetEdit);
                $arrayDetalle = json_decode($respuestaDetalle[0]["detallesRebajados"], true);
                $cant = count($arrayDetalle);
                $contador = 0;
                foreach ($arrayDetalle as $key => $value) {
                    if ($value["estadoDet"] == 2) {
                        $contador = $contador + 1;
                    }
                }
                if ($cant == 1) {
                    if ($contador == 1) {
                        $respuesta = ModeloRetirosBodega::mdlGuardaDetalleRet($idRetEdit, $usuarioOp);
                        return $respuesta;
                    }
                }
                if ($cant == 2) {
                    if ($contador == $key + 1 || $key + 1 == 0 && $contador == 1) {
                        $respuesta = ModeloRetirosBodega::mdlGuardaDetalleRet($idRetEdit, $usuarioOp);
                        return $respuesta;
                    } else {
                        return "UnoPendiente";
                    }
                }
                if ($cant >= 3) {
                    if ($contador == $key + 1 || $key + 1 == 0 && $contador == 1) {
                        $respuesta = ModeloRetirosBodega::mdlGuardaDetalleRet($idRetEdit, $usuarioOp);
                        return $respuesta;
                    } else {
                        return "faltanDetalles";
                    }
                }
            }
        }
    }

    public static function ctrMostrarUbicacion($idDetalle) {
        $guardarUbicacion = ModeloRetirosBodega::mdlMostrarUbicaciones($idDetalle);
        $sp = "spStockIng";
        $mostrarPosMts = ModeloRetirosBodega::mdlConsultaParamUno($idDetalle, $sp);
        return array("ubicaciones" => $guardarUbicacion, "mostrarPos" => $mostrarPosMts);
    }

    public static function ctrNewMarchamoPlt($idRetNewMarc) {
        $respuesta = ControladorRetirosBodega::ctrDetallesSalidaMerca($idRetNewMarc);

        $countArray = count($respuesta[1]);
        $contador = 0;
        foreach ($respuesta[1] as $key => $value) {
            if ($value["estadoDet"] == 2) {
                $contador = $contador + 1;
            }
        }
        $contadorMarchamos = 0;
        $countArraM = count($respuesta[3]);
        foreach ($respuesta[3] as $key => $value) {
            if ($value["numMarchamo"] != 0) {
                $contadorMarchamos = $contadorMarchamos + 1;
            }
        }

        if ($contador == $countArray && $countArraM == $contadorMarchamos) {
            return true;
        } else {
            return false;
        }
    }

    public static function ctrNewMarchamoPltGD($idPlt, $marchamoSal, $usuarioOp) {
        $sp = "spNuevoMarchamo";
        $respuesta = ModeloRetirosBodega::mdlInsertMarchamoDos($idPlt, $marchamoSal, $usuarioOp, $sp);
        return $respuesta;
    }

    public static function ctrEditMarchamoPlt($idPltEdit, $marchamoEdit) {
        $sp = "spEditMarchamoSal";
        $estado = "2";
        $respuesta = ModeloRetirosBodega::mdlInsertMarchamoTres($idPltEdit, $marchamoEdit, $estado, $sp);
        return $respuesta;
    }

    public static function ctrCancelMarchamoPlt($idPltTrash) {
        $sp = "spEditMarchamoSal";
        $estado = 3;
        $marchamoEdit = "0";
        $respuesta = ModeloRetirosBodega::mdlInsertMarchamoTres($idPltTrash, $marchamoEdit, $estado, $sp);
        return $respuesta;
    }

}



