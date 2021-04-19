<?php

class ControladorHistorialIngresos {

    public static function ctrMostrarIngresosVigentes() {
        $valor = $_SESSION["idDeBodega"];
        $sp = "spHisIngTodoSuper";
        $respuesta = ModeloHistorialIngresos::mdlMostrarSinParams($sp);

        if ($respuesta !== null || $respuesta !== NULL) {
            if ($respuesta == "SD") {
                
            } else {
                $contador = 0;
                foreach ($respuesta as $key => $value) {
                    // Con objetos
                    if ($_SESSION["departamentos"] == "Operaciones Fiscales") {
                        if ($value["accionEstado"] == 3) {
                            if ($_SESSION["niveles"] == "BAJO") {
                                $botoneraAcciones = '<div class="btn-group"><a href="#divEdiciones" class="btn btn-warning btnEditOp" estado=2 role="button" btnEditOp=' . $value["identificador"] . ' ><i class="fa fa-edit"></i></a><button type="button" buttonId=' . $value["identificador"] . ' class="btn bg-danger-gradient" disabled="disabled"><i class="fa fa-print"></i> </button></div>';
                            }
                            if ($_SESSION["niveles"] == "MEDIO") {
                                $botoneraAcciones = '<div class="btn-group"><a href="#divEdiciones" class="btn btn-warning btnEditOp" estado=2 role="button" btnEditOp=' . $value["identificador"] . ' ><i class="fa fa-edit"></i></a><button type="button" buttonId=' . $value["identificador"] . ' class="btn btn-danger btnAnularMostModal"  data-toggle="modal" data-target="#AnulacionIngreso"><i class="fa fa-window-close"></i> </button><button type="button" buttonId=' . $value["identificador"] . ' class="btn bg-danger-gradient" disabled="disabled"><i class="fa fa-print"></i> </button></div>';
                            }
                        } else {
                            if ($_SESSION["niveles"] == "BAJO") {
                                if ($value["accionEstado"] == 1) {
                                    $botoneraAcciones = '<div class="btn-group"><a href="#divEdiciones" class="btn btn-success btnEditOp" estado=1 role="button" btnEditOp=' . $value["identificador"] . ' ><i class="fa fa-edit"></i></a><button type="button" buttonId=' . $value["identificador"] . ' class="btn bg-danger-gradient" disabled="disabled"><i class="fa fa-print"></i> </button><button type="button" buttonId=' . $value["identificador"] . ' class="btn bg-warning-gradient btnImprimirInforme btn-sm">Info . <i class="fa fa-print"></i></button><button type="button" buttonId=' . $value["identificador"] . ' class="btn bg-success-gradient btnImprimirDet btn-sm">Det . <i class="fa fa-print"></i></button></div>';
                                } else if ($value["accionEstado"] == 2) {

                                    $botoneraAcciones = '<div class="btn-group"><a href="#divEdiciones" class="btn btn-warning btnEditOp" estado=2 role="button" btnEditOp=' . $value["identificador"] . ' ><i class="fa fa-edit"></i></a><button type="button" buttonId=' . $value["identificador"] . ' class="btn bg-danger-gradient" disabled="disabled"><i class="fa fa-print"></i> </button><button type="button" buttonId=' . $value["identificador"] . ' class="btn bg-warning-gradient btnImprimirInforme btn-sm">Info . <i class="fa fa-print"></i></button><button type="button" buttonId=' . $value["identificador"] . ' class="btn bg-success-gradient btnImprimirDet btn-sm">Det . <i class="fa fa-print"></i></button></div>';
                                } else if ($value["accionEstado"] >= 4) {
                                    $botoneraAcciones = '<div class="btn-group"><button type="button" buttonId=' . $value["identificador"] . ' class="btn bg-info-gradient bntImprimir"><i class="fa fa-print"></i> </button><button type="button" buttonId=' . $value["identificador"] . ' class="btn bg-warning-gradient btnImprimirInforme btn-sm">Info . <i class="fa fa-print"></i></button><button type="button" buttonId=' . $value["identificador"] . ' class="btn bg-success-gradient btnImprimirDet btn-sm">Det . <i class="fa fa-print"></i></button></div>';
                                } else if ($value["accionEstado"] == -1) {
                                    $botoneraAcciones = '<div class="btn-group"><button type="button" buttonId=' . $value["identificador"] . ' class="btn bg-info-gradient bntImprimir"><i class="fa fa-print"></i> </button><button type="button" buttonId=' . $value["identificador"] . ' class="btn btn-dark" disabled>Anulado&nbsp;&nbsp;<i class="fa fa-ban"></i></button><button type="button" buttonId=' . $value["identificador"] . ' class="btn bg-warning-gradient btnImprimirInforme btn-sm">Info . <i class="fa fa-print"></i></button><button type="button" buttonId=' . $value["identificador"] . ' class="btn bg-success-gradient btnImprimirDet btn-sm">Det . <i class="fa fa-print"></i></button></div>';
                                }
                            } else if ($_SESSION["niveles"] == "MEDIO") {
                                if ($value["accionEstado"] == 1) {
                                    $botoneraAcciones = '<div class="btn-group"><a href="#divEdiciones" class="btn btn-success btnEditOp" estado=1 role="button" btnEditOp=' . $value["identificador"] . ' ><i class="fa fa-edit"></i></a><button type="button" buttonId=' . $value["identificador"] . ' class="btn btn-danger btnAnularMostModal"  data-toggle="modal" data-target="#AnulacionIngreso"><i class="fa fa-window-close"></i></button><button type="button" buttonId=' . $value["identificador"] . ' class="btn bg-danger-gradient" disabled="disabled"><i class="fa fa-print"></i> </button></div>';
                                } else if ($value["accionEstado"] == 2) {
                                    $botoneraAcciones = '<div class="btn-group"><a href="#divEdiciones" class="btn btn-warning btnEditOp" estado=2 role="button" btnEditOp=' . $value["identificador"] . ' ><i class="fa fa-edit"></i></a><button type="button" buttonId=' . $value["identificador"] . ' class="btn btn-danger btnAnularMostModal"  data-toggle="modal" data-target="#AnulacionIngreso"><i class="fa fa-window-close"></i> </button><button type="button" buttonId=' . $value["identificador"] . ' class="btn bg-danger-gradient" disabled="disabled"><i class="fa fa-print"></i> </button></div>';
                                } else if ($value["accionEstado"] >= 4) {
                                    $botoneraAcciones = '<div class="btn-group"><a href="#divEdiciones" class="btn btn-dark btnEditOp" estado=3 role="button" btnEditOp=' . $value["identificador"] . ' ><i class="fa fa-edit"></i></a><button type="button" buttonId=' . $value["identificador"] . ' class="btn btn-danger btnAnularMostModal"  data-toggle="modal" data-target="#AnulacionIngreso"><i class="fa fa-window-close"></i> </button><button type="button" buttonId=' . $value["identificador"] . ' class="btn bg-info-gradient bntImprimir"><i class="fa fa-print"></i> </button></div>';
                                } else if ($value["accionEstado"] == -1) {
                                    $botoneraAcciones = '<div class="btn-group"><button type="button" buttonId=' . $value["identificador"] . ' class="btn bg-info-gradient bntImprimir"><i class="fa fa-print"></i> </button><button type="button" buttonId=' . $value["identificador"] . ' class="btn btn-dark" disabled>Anulado&nbsp;&nbsp;<i class="fa fa-ban"></i></button></div>';
                                }
                            }
                        }
                    } else {
                        if ($_SESSION["departamentos"] == "Bodegas Fiscales") {


                            if ($value["accionEstado"] == 3) {
                                $botoneraAcciones = '<div class="btn-group"><a href="#divEdiciones" class="btn btn-warning btnEditOp" estado=2 role="button" btnEditOp=' . $value["identificador"] . ' ><i class="fa fa-edit"></i></a><button type="button" buttonId=' . $value["identificador"] . ' class="btn btn-danger btnAnularMostModal"  data-toggle="modal" data-target="#AnulacionIngreso"><i class="fa fa-window-close"></i> </button><button type="button" buttonId=' . $value["identificador"] . ' class="btn bg-danger-gradient" disabled="disabled"><i class="fa fa-print"></i> </button></div>';
                            }
                            if ($value["accionEstado"] == 1) {
                                $botoneraAcciones = '<div class="btn-group"><button type="button" buttonId=' . $value["identificador"] . ' class="btn bg-danger-gradient" disabled="disabled"><i class="fa fa-print"></i> </button></div>';
                            } else if ($value["accionEstado"] == 2) {
                                $botoneraAcciones = '<div class="btn-group"><button type="button" buttonId=' . $value["identificador"] . ' class="btn bg-danger-gradient" disabled="disabled"><i class="fa fa-print"></i> </button></div>';
                            } else if ($value["accionEstado"] >= 4) {
                                if ($_SESSION["niveles"] == "MEDIO") {
                                    $botoneraAcciones = '<div class="btn-group"><button type="button" buttonId=' . $value["identificador"] . ' class="btn btn-danger btnAnularMostModal"  data-toggle="modal" data-target="#AnulacionIngreso"><i class="fa fa-window-close"></i><button type="button" buttonId=' . $value["identificador"] . ' class="btn bg-info-gradient btnImprimirDet">Ing. <i class="fa fa-print"></i> </button><button type="button" buttonId=' . $value["identificador"] . ' class="btn bg-success-gradient btnImprimirDet btn-sm">Det . <i class="fa fa-print"></i></button></div>';
                                } else {
                                    $botoneraAcciones = '<div class="btn-group"></i><button type="button" buttonId=' . $value["identificador"] . ' class="btn bg-info-gradient bntImprimir btn-sm">Ing. <i class="fa fa-print"></i></button><button type="button" buttonId=' . $value["identificador"] . ' class="btn bg-success-gradient btnImprimirDet btn-sm">Det . <i class="fa fa-print"></i></button></div>';
                                }
                            } else if ($value["accionEstado"] == -1) {
                                $botoneraAcciones = '<div class="btn-group"><button type="button" buttonId=' . $value["identificador"] . ' class="btn bg-info-gradient bntImprimir"><i class="fa fa-print"></i><button type="button" buttonId=' . $value["identificador"] . ' class="btn btn-dark" disabled>Anulado&nbsp;&nbsp;<i class="fa fa-ban"></i></button></div>';
                            } else {
                                $botoneraAcciones = '<div class="btn-group"><button type="button" buttonId=' . $value["identificador"] . ' class="btn bg-info-gradient bntImprimir"><i class="fa fa-print"></i></div>';
                            }
                        } else {
                            $botoneraAcciones = '<div class="btn-group"><button type="button" buttonId=' . $value["identificador"] . ' class="btn bg-info-gradient bntImprimir btn-sm">Ing. <i class="fa fa-print"></i></button><button type="button" buttonId=' . $value["identificador"] . ' class="btn bg-warning-gradient btnImprimirInforme btn-sm">Info . <i class="fa fa-print"></i></button><button type="button" buttonId=' . $value["identificador"] . ' class="btn bg-success-gradient btnImprimirDet btn-sm">Det . <i class="fa fa-print"></i></button></div>';
                        }
                    }
                    $fecha_actual = new DateTime();
                    $cadena_fecha_actual = $value["fechaIngreso"]->format("d-m-Y");
                    if ($value["numeroAsignado"] == 0) {
                        $ingreso = "Sin Ingreso";
                    } else {
                        $ingreso = $value["numeroAsignado"];
                    }
                    $cif = number_format($value["cif"], 2);
                    $impuesto = number_format($value["impuesto"], 2);
                    $identBodega = $value["identBodega"];
                    $bodega = '<span class="right badge badge-success">Bodega_' . $identBodega . '</span>';
                    $contador = $contador + 1;
                    echo '
                        <tr>
                            <td>' . ($contador) . '</td>
                            <td>' . ($respuesta[$key]["nit"]) . '</td>
                            <td>' . ($value["empresa"]) . '</td>
                            <td>' . ($value["poliza"]) . '</td>
                            <td>' . ($cadena_fecha_actual) . '</td>
                            <td>' . ($ingreso) . '</td>
                            <td>' . ($value["blts"]) . '</td>
                            <td>' . ($cif) . '</td>
                            <td>' . ($impuesto) . '</td>
                            <td>' . ($bodega) . '</td>                                
                            <td><center>' . $botoneraAcciones . '</center></td>
                        </tr>';
                }
            }
        }
    }

    public static function ctrEditarIngOperacion($idIngEditOp) {
        $respuesta = ModeloHistorialIngresos::mdlEditarIngOperacion($idIngEditOp);
        return $respuesta;
    }

    public static function ctrEditarIngresoOperacion($datos) {
        $respuesta = ModeloHistorialIngresos::mdlEditarIngresoOperacion($datos);
        return $respuesta;
    }

    public static function ctrMostrarServiciosEdit() {
        $respuesta = ModeloHistorialIngresos::mdlMostrarServiciosEdit();
        foreach ($respuesta as $key => $value) {
            echo '<option value=' . $value["idServicio"] . '>' . $value["nombreServicio"] . '</option>';
        }
    }

    public static function ctrMostrarLineasTpVeh() {
        $sp = "spTipoVeh";
        $respuesta = ModeloHistorialIngresos::mdlMostrarSinParams($sp);
        echo '<option selected="selected">Seleccionen tipo y linea del vehículo</option>';
        foreach ($respuesta as $key => $value) {
            echo '<option value=' . $value["id"] . '>' . $value["tipoVehiculo"] . ' ' . $value["linea"] . '</option>';
        }
    }

    public static function ctrMostrarRegimenes() {
        $respuesta = ModeloHistorialIngresos::mdlMostrarRegimenes();
        foreach ($respuesta as $key => $value) {
            echo '<option value=' . $value["id"] . '>' . $value["regimen"] . '</option>';
        }
    }

    public static function ctrmostrarDetallesClientesPlts($idIngClientesPlt) {
        $sp = "spRevChasis";
        $revChasis = ModeloHistorialIngresos::mdlMostrarChasisVehContables($sp, $idIngClientesPlt);

        if ($revChasis != "SD") {
            return array("respuestaClientes" => $revChasis, "tipoDet" => "Vehiculos");
        } else {


            $respuestaClientes = ModeloHistorialIngresos::mdlMostrarDetallesClientesPlts($idIngClientesPlt);
            //      $respuestaPiloto =  ModeloHistorialIngresos::mdlMostrarDetallesPlts($idIngClientesPlt );

            return array("respuestaClientes" => $respuestaClientes, "tipoDet" => "Mercaderia");
        }
    }

    public static function ctrAnularIngreso($idIngresoAnulacion, $usuario, $departamento, $nivel, $motivoAnula) {
        if ($departamento == "Bodegas Fiscales" && $nivel == "MEDIO") {
            date_default_timezone_set('America/Guatemala');
            $time = date('Y-m-d H:i:s');
            $hasing = hash('md5', $time . $usuario);
            $sp = "spAutAnulaIng";
            $estado = 1;
            $respuestaVal = ModeloHistorialIngresos::mdlAnulaIngBod($idIngresoAnulacion, $hasing, $time, $motivoAnula, $usuario, $estado);
        }
        if ($departamento == "Operaciones Fiscales" && $nivel == "MEDIO") {
            $respuestaVal = ModeloHistorialIngresos::mdlAnularIngresoValidacion($idIngresoAnulacion);
        }



        return $respuestaVal;
    }

    public static function ctrMostrarPuertos() {

        $respuesta = ModeloHistorialIngresos::mdlMostrarPuertos();
        foreach ($respuesta as $key => $value) {
            echo '<option value=' . $value["clave"] . '>' . $value["clave"] . " - " . $value["origen"] . '</option>';
        }
    }

    public static function ctrInsertNuevoServicio($nuevoServicio, $usuario) {
        $sp = "spNewServicio";
        $respuestaVal = ModeloHistorialIngresos::mdlInsertNuevoServicio($nuevoServicio, $usuario, $sp);
        return $respuestaVal;
    }

    public static function ctrNewServicioIng($usuario, $idIngSerOtr, $listaServOtr, $tipoOpera) {
        $otrosExtraArray = json_decode($listaServOtr, true);

        foreach ($otrosExtraArray as $key => $value) {
            $idServ = $value["serviciosOtros"];
            $valorOtros = $value["valorOtros"];
            if ($tipoOpera == 1) {
                $comentario = 'TODOS LOS CLIENTES';
            } else {
                $comentario = 'UN CLIENTE';
            }
            $estado = 1;
            $sp = "spNewServicios";
            $respuesta = ModeloHistorialIngresos::mdlNewServicioIng($idIngSerOtr, $idServ, $valorOtros, $comentario, $usuario, $estado, $tipoOpera, $sp);
            return $respuesta;
        }
    }

    public static function ctrMostrarServicioExtra($verCobrado) {
        $sp = "spMostrarSerAcuse";
        $tipo = 1;
        $revIngRev = ModeloCalculoDeAlmacenaje::mdlVerificaTarifaDosParms($verCobrado, $tipo, $sp);
        return $revIngRev;
    }

    public static function ctrEliminarServicio($eliminarServicio) {
        $sp = "spDeleteServicioDesc";
        $estado = 0;
        $revIngRev = ModeloCalculoDeAlmacenaje::mdlVerificaTarifaDosParms($estado, $eliminarServicio, $sp);
        return $revIngRev;
    }

    public static function ctrGenerateHistoriaIng($generateHistoriaIng, $valor) {
        $sp = "spHIstoriaTodosIng";
        $revIngRev = ModeloCalculoDeAlmacenaje::mdlVerificaTarifa($valor, $sp);
        return $revIngRev;
    }

    public static function ctrGenerateHistoriaRec($generateRecHistoria) {
        $sp = "spHistoriaRec";
        $revIngRev = ModeloCalculoDeAlmacenaje::ctrGenerateHistoriaIng($sp);
        return $revIngRev;
    }

    public static function ctrGenerateHistoriaRet($generateRetHistoria, $valor) {
        $sp = "spHistoriaRet";
        $revIngRev = ModeloCalculoDeAlmacenaje::mdlVerificaTarifa($valor, $sp);
        return $revIngRev;
    }

    public static function ctrMostrarTableIngHistoria($param) {
        $sp = "spRepChasisNew";
        $respuesta = ModeloHistorialIngresos::mdlMostrarChasisVehContables($sp, $param);
        return $respuesta;
    }

    public static function ctrValidarLlaveIng($validarIngOP) {
        $sp = "spValidateLlave";
        $revIngRev = ModeloHistorialIngresos::mdlMostrarChasisVehContables($sp, $validarIngOP);
        return $revIngRev;
    }

    public static function ctrGenerateHistoriaChasis($generateHistoriaChasis) {
        $sp = "spHistDataExtraIngExcel";
        $revIngRev = ModeloCalculoDeAlmacenaje::ctrGenerateHistoriaIng($sp);
        return $revIngRev;
    }

    public static function ctrGenerateHistoriaRecEx($generateRecExHistoria) {
        $sp = "spServExtraCorrel";
        $revIngRev = ModeloCalculoDeAlmacenaje::ctrGenerateHistoriaIng($sp);
        return $revIngRev;
    }

    public static function ctrMostrarChasisVh($EditChasisVh) {
        $sp = "spServExtraCorrel";
        $revIngRev = ModeloCalculoDeAlmacenaje::ctrGenerateHistoriaIng($sp);
        return $revIngRev;
    }

    public static function ctrEditarChasisVeh($idChasEdit, $chasisNewEdt, $tipoLineaVeh) {
        $sp = "spRevChasisVehN";
        $revIngRev = ModeloCalculoDeAlmacenaje::mdlVerificarCalculo($idChasEdit, $chasisNewEdt, $tipoLineaVeh, $sp);
        return $revIngRev;
    }

    public static function ctrEditarBltsIng($idIngEditCuadreBlts, $totalBultosPol, $listaDetallesBltsPso) {
        $bultosPesoArray = json_decode($listaDetallesBltsPso, true);
        $totalBlts = 0;
        foreach ($bultosPesoArray as $key => $value) {
            $bultos = $value[1];
            $totalBlts = $totalBlts + $bultos;
        }
        if ($totalBlts == $totalBultosPol) {
            foreach ($bultosPesoArray as $keys => $values) {
                $idDetalle = $values[0];
                $bultos = $values[1];
                $peso = $values[2];
                $sp = "spUpdateBltsDetIng";
                $revIngRev = ModeloCalculoDeAlmacenaje::mdlVerificarCalculo($idDetalle, $bultos, $peso, $sp);
            }
            if ($revIngRev[0]["resp"] == $totalBultosPol) {
                $sp = "spUpdateBltsIng";
                $respBltsINg = ModeloCalculoDeAlmacenaje::mdlVerificaTarifaDosParms($idIngEditCuadreBlts, $totalBultosPol, $sp);
                return $respBltsINg;
            } else {
                return false;
            }
        }
    }

    public static function ctrEditUbicaBodega($newBod, $ingNewBod) {
        $sp = "spEditUbicaIng";
        $revIngRev = ModeloCalculoDeAlmacenaje::mdlVerificaTarifaDosParms($newBod, $ingNewBod, $sp);
        return $revIngRev;
    }

    public static function ctrDescargaExelVeh($generateExcelVehiNew) {
        $sp = "spExcelVehNew";
        $revIngRev = ModeloCalculoDeAlmacenaje::ctrGenerateHistoriaIng($sp);
        return $revIngRev;
    }

    public static function ctrTodosIngHistorial($valor) {
        $sp = "spHisIngTodoSuper";
        $revChasis = ModeloHistorialIngresos::mdlMostrarChasisVehContables($sp, $valor);
        return $revChasis;
    }

    public static function ctrMstPolIng($valor, $polizaIngHistBusq) {
        $sp = "spHisIngTodoSuperPol";
        $resp = ModeloCalculoDeAlmacenaje::mdlVerificaTarifaDosParms($valor, $polizaIngHistBusq, $sp);
        return $resp;
    }

    public static function ctrParametrosFechaHis($valor, $fechaIng, $fechaFin) {
        $sp = "spHisIngTodoSuperFParam";
        $revIngRev = ModeloCalculoDeAlmacenaje::mdlVerificarCalculo($valor, $fechaIng, $fechaFin, $sp);
        return $revIngRev;
    }

    public static function ctrMostrarInvetarioExcel($valor) {
        $sp = "spSaldosSuper";
        $revIngRev = ModeloHistorialIngresos::mdlMostrarChasisVehContables($sp, $valor);
        return $revIngRev;
    }

    public static function ctrPolizaRet($polizaData) {
        $sp = "spIdRetiro";
        $revIngRev = ModeloHistorialIngresos::mdlMostrarChasisVehContables($sp, $polizaData);
        return $revIngRev;
    }

    public static function ctrRevisionPol($objRevPol, $usuario) {
        $lista = json_decode($objRevPol, true);
        $idRet = $lista[0][0];
        $sp = "spDataRet";
        $retDetalle = ModeloHistorialIngresos::mdlMostrarChasisVehContables($sp, $idRet);
        $detallesReb = $retDetalle[0]["detallesRebajados"];
        $listaReb = json_decode($detallesReb, true);
        $totalId = 0;
        $totalBlts = 0;
        //La suma de los id de detalles de retiro registrados tienen que ser igual a lo que se comprueba en poliza

        foreach ($listaReb as $key => $value) {
            $totalId = $totalId + $value["idDetalles"];

            $totalBlts = $totalBlts + $value["cantBultos"];
        }
        //suma de detalles y butos de la comprobación en poliza
        $totalIdR = 0;
        $totalBltsR = 0;
        foreach ($lista as $key => $value) {
            $totalIdR = $totalIdR + $value[1];
            $totalBltsR = $totalBltsR + $value[2];
        }
        if ($totalId == $totalIdR && $totalBlts == $totalBltsR) {
            date_default_timezone_set('America/Guatemala');
            $date = date('Y-m-d H:m:s');
            $ranABC = Randomalfa();
            $hashGenerado = hash("sha512", $ranABC . $date . $idRet);
            $encriptar = crypt($hashGenerado, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
            $sp = "spBitacoraPolNew";
            //return array($idRet, $usuario, $date, $encriptar, $sp);
            $respuesta = ModeloHistorialIngresos::mdlGenerarBitacoraRet($idRet, $usuario, $date, $encriptar, $sp);
            return $respuesta;
        } else {
            return false;
        }
    }

    public static function ctrRevisionVehNew($listaIdVehOBJ, $usuario) {
        $lista = json_decode($listaIdVehOBJ, true);

        $idRetPol = $lista[0]["idRetPol"];
        $sp = "spChasisVNuevo";

        $chasisPol = ModeloHistorialIngresos::mdlMostrarChasisVehContables($sp, $idRetPol);

        //eliminando todos los vehiculos del retiro si al final el arreglo esta vacio 
        //significa que todos los chasis fueron correctamente rebajado
        $contEvent = 0;
        foreach ($lista as $key => $value) {
            $idChas = $value["idChas"];
            $idChas = intval($idChas);
            $idVehN = $value["idVehN"];
            $idVehN = intval($idVehN);
            foreach ($chasisPol as $keys => $values) {

                if ($values["idRetNew"] == $idVehN && $values["id"] == $idChas) {
                    $contEvent = $contEvent + 1;
                }
            }
        }
        if (count($chasisPol) == $contEvent) {
            date_default_timezone_set('America/Guatemala');
            $date = date('Y-m-d H:m:s');
            $ranABC = Randomalfa();
            $hashGenerado = hash("sha512", $ranABC . $date . $idVehN);
            $encriptar = crypt($hashGenerado, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
            $sp = "spBitacoraPolNew";
            //return array($idRet, $usuario, $date, $encriptar, $sp);
            $respuesta = ModeloHistorialIngresos::mdlGenerarBitacoraRet($idVehN, $usuario, $date, $encriptar, $sp);
            return $respuesta;
        } else {
            return false;
        }
    }

    public static function ctrDeleteIncidencia($corregirIncidencia, $aut) {
        if ($aut) {
            $sp = "spDeleteBitacora";
            $respuesta = ModeloHistorialIngresos::mdlMostrarChasisVehContables($sp, $corregirIncidencia);
            return $respuesta;
        } else {
            return false;
        }
    }

    public static function ctrMostrarFechasPolizas($valor, $fechasPolizas) {
        if ($fechasPolizas) {
            $sp = "spListaFechasPolizas";
            $respuesta = ModeloHistorialIngresos::mdlMostrarChasisVehContables($sp, $valor);
            return $respuesta;
            
        }else{
            return false;
        }
    }

}
