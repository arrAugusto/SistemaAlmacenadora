<?php

class ControladorIngresosPendientes {
    /*
     *
     *  HISTORIAL PENDIENTE DE FINALIZAR, POR EL AUXILIAR DE BODEGA  
     * 
     */

    public static function ctrMostrarIngresosPendientes() {
        $llaveIngresosPen = $_SESSION["idDeBodega"];
        $respuesta = ModeloIngresosPendientes::mdlMostrarIngresosPendientes($llaveIngresosPen);
        // ARRAY : LISTA TEMPORAL PARA GUARDAR, LAS POLIZAS YA MAQUETADAS EN EL TABLE
        date_default_timezone_set('America/Guatemala');
        $timeActual = date('d-m-Y H:i:s');
        if ($respuesta != "SD") {
            foreach ($respuesta as $key => $value) {
                
                //revision si esta cuadrado
                $idIng = $value["numeroOrden"];

                $sp = "spRevertirIng";
                $respuestaRevert = ModeloIngresosPendientes::mdlTransaccionesPendientes($idIng, $sp);
                    $spVeh = "spIngVehUsados";
                $respuestaRevertVeh = ModeloIngresosPendientes::mdlTransaccionesPendientes($idIng, $spVeh);

                if ($respuestaRevertVeh[0]['resp']==1) {
                  $usados = 'vehiculoUsado';  
                }else{
                    $usados = 'ZA';
                }
                if ($respuestaRevert[0]["resp"] == 1) {


                    $fEmision = new DateTime();
                    $fEmision = $value["emisionOperacion"]->format("d-m-Y H:i:s");
                    $horaInicio = new DateTime($fEmision);
                    $horaTermino = new DateTime($timeActual);
                    $interval = $horaInicio->diff($horaTermino);
                    $tiempoDiff = $interval->format('%H h %i mins %s seg');
                    $button = '<span class="right badge badge-success">' . $tiempoDiff . '</span>';
                    if ($interval->format('%H') >= 1) {
                        $button = '<span class="right badge badge-danger">' . $tiempoDiff . '</span>';
                    }
                    $verPase = $value["numeroOrden"];
                    $respuestaPase = ControladorRegistroBodega::ctrMostarPaseSalida($verPase);
                    if ($respuestaPase!="SD"){

                     
                    $contador = 0;
                    $contadorEstadoTres = 0;
                    foreach ($respuestaPase as $keys => $valueUnidad) {
                        if ($valueUnidad["unidad"] >= 1) {
                            $contador = $contador + 1;
                        }
                        if ($valueUnidad["unidad"] == 0 && $valueUnidad["estadoIngreso"] == 3) {
                            $contadorEstadoTres = $contadorEstadoTres + 1;
                        }
                    }
                    if (count($respuestaPase) != $contador) {
                        $contador = 0;
                    }
                        if (count($respuestaPase) != $contadorEstadoTres) {
                        $contadorEstadoTres = 0;
                    }
                } 
                    if ($valueUnidad["estadoIngreso"] == 3 && $valueUnidad["unidad"] >= 1 && $valueUnidad["diferencia"] == 0) {
                        
                    } else {
                        /*   if ($valueUnidad["estadoIngreso"] == 3 && $valueUnidad["diferencia"] == 0) {
                          $sp = "spUpdateIngEstado";
                          $ingreso = $verPase;
                          $respuesta = ModeloRegIngBod::mdlInsertUnParam($ingreso, $sp);
                          echo '<script>location.reload();</script>';
                          } else {
                         */ if ($valueUnidad["diferencia"] == 1 && $contadorEstadoTres != 0) {
                            if ($value["servicioFis"] == "VEHICULOS NUEVOS" || $usados=="vehiculoUsado") {
                                if ($value["servicioFis"] == "VEHICULOS NUEVOS") {
                                    $usados = $value["servicioFis"];
                                }
                                if ($contador == 0) {
                                    $botonera = '<button numeroOrden=' . $value["numeroOrden"] . ' type="button" class="btn btn-info btn-sm btnAgregarDetalles" tipoIng="' . $usados . '" numeroButton=' . ($key + 1) . ' >Vehículos</button><button type="button" class="btn btn-success bntSalidaRapida btn-sm" id="salidaRapida' . $value["numeroOrden"] . '" idCliente="' . $value["numeroOrden"] . '"  data-toggle="modal" data-target="#modalSalidaRapida">Generar Pase <i class="fa fa-print"></i></button>';
                                } else {
                                    $botonera = '<button numeroOrden=' . $value["numeroOrden"] . ' type="button" class="btn btn-info btn-sm btnAgregarDetalles" tipoIng="' . $usados . '" numeroButton=' . ($key + 1) . ' >Vehículos</button>';
                                }
                            } else {
                                $botonera = '<button numeroOrden=' . $value["numeroOrden"] . ' type="button" class="btn btn-info btn-sm btnAgregarDetalles" tipoIng="' . $usados . '" numeroButton=' . ($key + 1) . ' >Mercadería</button>';
                            }
                        } else {

                            if ($value["servicioFis"] == "VEHICULOS NUEVOS" || $usados=="vehiculoUsado") {
                                                                if ($value["servicioFis"] == "VEHICULOS NUEVOS") {
                                    $usados = $value["servicioFis"];
                                }
                                if ($contador == 0) {
                                    $botonera = '<button numeroOrden=' . $value["numeroOrden"] . ' type="button" class="btn btn-info btn-sm btnAgregarDetalles" tipoIng="' . $usados . '" numeroButton=' . ($key + 1) . ' >Vehículos</button><button type="button" class="btn btn-success bntSalidaRapida btn-sm" id="salidaRapida' . $value["numeroOrden"] . '" idCliente="' . $value["numeroOrden"] . '"  data-toggle="modal" data-target="#modalSalidaRapida">Generar Pase <i class="fa fa-print"></i></button>';
                                } else {
                                    $botonera = '<button numeroOrden=' . $value["numeroOrden"] . ' type="button" class="btn btn-info btn-sm btnAgregarDetalles" tipoIng="' . $usados. '" numeroButton=' . ($key + 1) . ' >Vehículos</button>';
                                }
                            } else {
                                if ($contadorEstadoTres >= 1) {
                                    if ($value["vinculo"] == "NoAplica") {
                                        $botonera = '<button type="button" class="btn btn-success bntSalidaRapida btn-sm" id="salidaRapida' . $value["numeroOrden"] . '" idCliente="' . $value["numeroOrden"] . '"  data-toggle="modal" data-target="#modalSalidaRapida">Generar Pase <i class="fa fa-print"></i></button>';
                                    } else {
                                        $botonera = '<button type="button" class="btn btn-success bntSalidaRapida btn-sm" id="salidaRapida' . $value["numeroOrden"] . '" idCliente="' . $value["numeroOrden"] . '"  data-toggle="modal" data-target="#modalSalidaRapida">Generar Pase <i class="fa fa-print"></i></button>';
                                    }
                                } else if ($contador == 0 && $contadorEstadoTres == 0) {

                                    if ($value["vinculo"] == "NoAplica") {
                                        $botonera = '<button numeroOrden=' . $value["numeroOrden"] . ' type="button" class="btn btn-info btn-sm btnAgregarDetalles" tipoIng="' . $usados . '" numeroButton=' . ($key + 1) . ' >Mercadería</button><button type="button" class="btn btn-sm btn-success bntSalidaRapida" id="salidaRapida' . $value["numeroOrden"] . '" idCliente="' . $value["numeroOrden"] . '"  data-toggle="modal" data-target="#modalSalidaRapida">Generar Pase <i class="fa fa-print"></i></button>';
                                    } else {
                                        $botonera = '<button numeroOrden=' . $value["numeroOrden"] . ' type="button" class="btn btn-info btn-sm btnAgregarDetalles" tipoIng="' . $usados . '" numeroButton=' . ($key + 1) . ' >Mercadería</button><button type="button" class="btn btn-sm btn-success bntSalidaRapida" idCliente="' . $value["numeroOrden"] . '"  data-toggle="modal" data-target="#modalSalidaRapida">Generar Pase <i class="fa fa-print"></i></button>';
                                    }
                                } else if ($contador >= 1 && $contadorEstadoTres == 0) {

                                    if ($value["vinculo"] == "NoAplica") {
                                        $botonera = '<button numeroOrden=' . $value["numeroOrden"] . ' type="button" class="btn btn-info btn-sm btnAgregarDetalles" tipoIng="' . $usados . '" numeroButton=' . ($key + 1) . ' >Mercadería</button>';
                                    } else {
                                        $botonera = '<button numeroOrden=' . $value["numeroOrden"] . ' type="button" class="btn btn-info btn-sm btnAgregarDetalles" tipoIng="' . $usados. '" numeroButton=' . ($key + 1) . ' >Mercadería</button>';
                                    }
                                }
                            }
                        }
                        if ($value["vinculo"] != "NoAplica") {
                            $empresaCons = $respuesta[$key]["empresa"] . ' / <strong style="color:blue;">' . $respuesta[$key]["consolidadoEmpresa"] . '<strong>  ';
                        } else {
                            $empresaCons = $respuesta[$key]["empresa"];
                        }

                        if ($_SESSION["departamentos"] == "Operaciones Fiscales" && $_SESSION["niveles"] == "MEDIO" || $_SESSION["niveles"] == "ALTO" || $_SESSION["departamentos"] == "Ventas") {
                            $botonera = '<button type="button" class="btn btn-primary btn-sm btnMostrarDetOpIng" idIng="' . $verPase . '" data-toggle="modal" data-target="#mdlDepDiffBodega">Ver Manifiesto&nbsp;&nbsp;<i class="fa fa-eye"></i></button>';
                        }
                        echo '
                      <tr>
                        <td>' . ($key + 1) . '</td>
                        <td>' . '<label id="lblEmpresa' . ($key + 1) . '">' . $empresaCons . '</label></td>
                        <td>' . '<label id="lblNit' . ($key + 1) . '">' . $respuesta[$key]["nit"] . '</label></td>
                        <td>' . '<label id="lblBultos' . ($key + 1) . '">' . $respuesta[$key]["bultos"] . '</label></td>
                        <td>' . '<label id="lblPoliza' . ($key + 1) . '">' . $respuesta[$key]["poliza"] . '</label></td>
                        <td>' . $fEmision . '</td>                                
                        <td>' . $button . '</td>';
                        echo '<td>' . '<center><div class="btn-group">' . $botonera . '</div></center></td>';
                    }
                }
            }
        }
    }

    public static function ctrTransaccionesPendientes() {
        $llaveIngresosPen = $_SESSION["idDeBodega"];
        $sp = "spIngPendientesFail";
        $respuesta = ModeloIngresosPendientes::mdlTransaccionesPendientes($llaveIngresosPen, $sp);

        if ($respuesta != "SD") {
            foreach ($respuesta as $key => $value) {
                $botonera = "";
                $vehNV = 0;
                if ($value["servicioFis"] == "VEHICULOS NUEVOS") {
                    $sp = "spCountChas";
                    $idIng = $value["numeroOrden"];
                    $respuestaTran = ModeloIngresosPendientes::mdlTransaccionesPendientes($idIng, $sp);
                    if ($respuestaTran[0]["countChas"] >= 1) {
                        $vehNV = 1;
                    }
                    $buttonDetalle = '<button type="button" class="btn btn-success btn-sm btnMostrarDetOpIng" iding="' . $value["numeroOrden"] . '" data-toggle="modal" data-target="#mdlDepDiffBodega">Ver Manifiesto&nbsp;&nbsp;<i class="fa fa-eye"></i></button>';

                    $botonera = '<button type="button" class="btn btn-primary btnVehiculosNuevos" idIngOp="' . $value["numeroOrden"] . '" bultosIng="' . $value["bultos"] . '" data-toggle="modal" data-target="#gdVehiculosNuevos">Vehiculos N.</button>';
                    $empresaCons = $respuesta[$key]["empresa"];
                    echo '
                      <tr>
                        <td>' . ($key + 1) . '</td>
                        <td>' . '<label id="lblEmpresa' . ($key + 1) . '">' . $empresaCons . '</label></td>
                        <td>' . '<label id="lblNit' . ($key + 1) . '">' . $respuesta[$key]["nit"] . '</label></td>
                        <td>' . '<label id="lblBultos' . ($key + 1) . '">' . $respuesta[$key]["bultos"] . '</label></td>
                        <td>' . '<label id="lblPoliza' . ($key + 1) . '">' . $respuesta[$key]["poliza"] . '</label></td>';
                    echo '<td>' . '<center><div class="btn-group">' . $botonera . $buttonDetalle . '</div></center></td>';
                } else {



                    if ($value["vinculo"] != "NoAplica") {
                        $empresaCons = $respuesta[$key]["empresa"] . ' / <strong style="color:blue;">' . $respuesta[$key]["consolidadoEmpresa"] . '<strong>  ';
                    } else {
                        $empresaCons = $respuesta[$key]["empresa"];
                    }
                    if ($value["servicioFis"] == "VEHICULOS USADOS") {
                        $botonera = '<button type="button" class="btn btn-primary btnCgrDetallePorFail" idIngOp="' . $value["numeroOrden"] . '" data-toggle="modal" data-target="#gdrManifiestos" id="gDetalles">Manifiesto</button>';
                    } else {
                        $botonera = '<button type="button" class="btn btn-primary btnCgrDetallePorFail" idIngOp="' . $value["numeroOrden"] . '" data-toggle="modal" data-target="#gdrManifiestos" id="gDetalles">Manifiesto</button>';
                        $vehNV = 1;
                    }


                    $buttonDetalle = '<button type="button" class="btn btn-success btn-sm btnMostrarDetOpIng" iding="' . $value["numeroOrden"] . '" data-toggle="modal" data-target="#mdlDepDiffBodega">Ver Manifiesto&nbsp;&nbsp;<i class="fa fa-eye"></i></button>';
                    if ($vehNV == 1) {
                        echo '
                      <tr>
                        <td>' . ($key + 1) . '</td>
                        <td>' . '<label id="lblEmpresa' . ($key + 1) . '">' . $empresaCons . '</label></td>
                        <td>' . '<label id="lblNit' . ($key + 1) . '">' . $respuesta[$key]["nit"] . '</label></td>
                        <td>' . '<label id="lblBultos' . ($key + 1) . '">' . $respuesta[$key]["bultos"] . '</label></td>
                        <td>' . '<label id="lblPoliza' . ($key + 1) . '">' . $respuesta[$key]["poliza"] . '</label></td>';
                        echo '<td>' . '<center><div class="btn-group">' . $botonera . $buttonDetalle . '</div></center></td>';
                    }
                }
            }
        }
    }

}
