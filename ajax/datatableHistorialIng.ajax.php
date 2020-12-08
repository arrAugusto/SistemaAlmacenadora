<?php


require_once "../controlador/historiaIngresosFisacales.controlador.php";
require_once "../modelo/historiaIngresosFisacales.modelo.php";
//SESSION DE USUARIO PARA MANEJAR BITACORA
require_once "../controlador/usuario.controlador.php";
//CONTROLADOR Y MODELO DE CALCULOS
require_once "../controlador/calculoDeAlmacenaje.controlador.php";
require_once "../modelo/calculoDeAlmacenaje.modelo.php";


class historialIngresosFiscales {

    public function ajaxMostrarTableIngHistoria() {
        session_start();
        $valor = $_SESSION["idDeBodega"];

        $sp = "spHisIngTodoSuper";
        $respuesta = ModeloHistorialIngresos::mdlMostrarSinParams($sp);
        if ($respuesta !== null || $respuesta !== NULL) {
            if ($respuesta != "SD") {

                $contador = 0;
                $cabeza = '{
                            "data": [';
                echo $cabeza;
                foreach ($respuesta as $key => $value) {
                    // Con objetos
                    if ($_SESSION['departamentos'] == 'Operaciones Fiscales') {
                        if ($value['accionEstado'] == 3) {
                            if ($_SESSION['niveles'] == 'BAJO') {
                                $botoneraAcciones = "<div class='btn-group'><a href='#divEdiciones' class='btn btn-warning btnEditOp' estado=2 role='button' btnEditOp=" . $value['identificador'] . " ><i class='fa fa-edit'></i></a><button type='button' buttonId=" . $value['identificador'] . " class='btn bg-danger-gradient btn-sm' disabled='disabled'><i class='fa fa-print'></i> </button></div>";
                            }
                            if ($_SESSION['niveles'] == 'MEDIO') {
                                $botoneraAcciones = "<div class='btn-group'><a href='#divEdiciones' class='btn btn-warning btnEditOp' estado=2 role='button' btnEditOp=" . $value['identificador'] . " ><i class='fa fa-edit'></i></a><button type='button' buttonId=" . $value['identificador'] . " class='btn btn-danger btnAnularMostModal'  data-toggle='modal' data-target='#AnulacionIngreso'><i class='fa fa-window-close'></i> </button><button type='button' buttonId=" . $value['identificador'] . " class='btn bg-danger-gradient btn-sm' disabled='disabled'><i class='fa fa-print'></i> </button></div>";
                            }
                        } else {
                            if ($_SESSION['niveles'] == 'BAJO') {
                                if ($value['accionEstado'] == 1) {
                                    $botoneraAcciones = "<div class='btn-group'><a href='#divEdiciones' class='btn btn-success btnEditOp' estado=1 role='button' btnEditOp=" . $value['identificador'] . " ><i class='fa fa-edit'></i></a><button type='button' buttonId=" . $value['identificador'] . " class='btn bg-danger-gradient btn-sm' disabled='disabled'><i class='fa fa-print'></i> </button><button type='button' buttonId=" . $value['identificador'] . " class='btn bg-warning-gradient btn-sm btnImprimirInforme btn-sm'>Info . <i class='fa fa-print'></i></button><button type='button' buttonId=" . $value['identificador'] . " class='btn bg-success-gradient btn-sm btnImprimirDet btn-sm'>Det . <i class='fa fa-print'></i></button></div>";
                                } else if ($value['accionEstado'] == 2) {

                                    $botoneraAcciones = "<div class='btn-group'><a href='#divEdiciones' class='btn btn-warning btnEditOp' estado=2 role='button' btnEditOp=" . $value['identificador'] . " ><i class='fa fa-edit'></i></a><button type='button' buttonId=" . $value['identificador'] . " class='btn bg-danger-gradient btn-sm' disabled='disabled'><i class='fa fa-print'></i> </button><button type='button' buttonId=" . $value['identificador'] . " class='btn bg-warning-gradient btn-sm btnImprimirInforme btn-sm'>Info . <i class='fa fa-print'></i></button><button type='button' buttonId=" . $value['identificador'] . " class='btn bg-success-gradient btn-sm btnImprimirDet btn-sm'>Det . <i class='fa fa-print'></i></button></div>";
                                } else if ($value['accionEstado'] >= 4) {
                                    $botoneraAcciones = "<div class='btn-group'><button type='button' buttonId=" . $value['identificador'] . " class='btn bg-info-gradient btn-sm bntImprimir'><i class='fa fa-print'></i> </button><button type='button' buttonId=" . $value['identificador'] . " class='btn bg-warning-gradient btn-sm btnImprimirInforme btn-sm'>Info . <i class='fa fa-print'></i></button><button type='button' buttonId=" . $value['identificador'] . " class='btn bg-success-gradient btn-sm btnImprimirDet btn-sm'>Det . <i class='fa fa-print'></i></button></div>";
                                } else if ($value['accionEstado'] == -1) {
                                    $botoneraAcciones = "<div class='btn-group'><button type='button' buttonId=" . $value['identificador'] . " class='btn bg-info-gradient btn-sm bntImprimir'><i class='fa fa-print'></i> </button><button type='button' buttonId=" . $value['identificador'] . " class='btn btn-dark' disabled>Anulado&nbsp;&nbsp;<i class='fa fa-ban'></i></button><button type='button' buttonId=" . $value['identificador'] . " class='btn bg-warning-gradient btn-sm btnImprimirInforme btn-sm'>Info . <i class='fa fa-print'></i></button><button type='button' buttonId=" . $value['identificador'] . " class='btn bg-success-gradient btn-sm btnImprimirDet btn-sm'>Det . <i class='fa fa-print'></i></button></div>";
                                }
                            } else if ($_SESSION['niveles'] == 'MEDIO') {
                                if ($value['accionEstado'] == 1) {
                                    $botoneraAcciones = "<div class='btn-group'><a href='#divEdiciones' class='btn btn-success btnEditOp' estado=1 role='button' btnEditOp=" . $value['identificador'] . " ><i class='fa fa-edit'></i></a><button type='button' buttonId=" . $value['identificador'] . " class='btn btn-danger btnAnularMostModal'  data-toggle='modal' data-target='#AnulacionIngreso'><i class='fa fa-window-close'></i></button><button type='button' buttonId=" . $value['identificador'] . " class='btn bg-danger-gradient btn-sm' disabled='disabled'><i class='fa fa-print'></i> </button></div>";
                                } else if ($value['accionEstado'] == 2) {
                                    $botoneraAcciones = "<div class='btn-group'><a href='#divEdiciones' class='btn btn-warning btnEditOp' estado=2 role='button' btnEditOp=" . $value['identificador'] . " ><i class='fa fa-edit'></i></a><button type='button' buttonId=" . $value['identificador'] . " class='btn btn-danger btnAnularMostModal'  data-toggle='modal' data-target='#AnulacionIngreso'><i class='fa fa-window-close'></i> </button><button type='button' buttonId=" . $value['identificador'] . " class='btn bg-danger-gradient btn-sm' disabled='disabled'><i class='fa fa-print'></i> </button></div>";
                                } else if ($value['accionEstado'] >= 4) {
                                    $botoneraAcciones = "<div class='btn-group'><a href='#divEdiciones' class='btn btn-dark btnEditOp' estado=3 role='button' btnEditOp=" . $value['identificador'] . " ><i class='fa fa-edit'></i></a><button type='button' buttonId=" . $value['identificador'] . " class='btn btn-danger btnAnularMostModal'  data-toggle='modal' data-target='#AnulacionIngreso'><i class='fa fa-window-close'></i> </button><button type='button' buttonId=" . $value['identificador'] . " class='btn bg-info-gradient btn-sm bntImprimir'><i class='fa fa-print'></i> </button></div>";
                                } else if ($value['accionEstado'] == -1) {
                                    $botoneraAcciones = "<div class='btn-group'><button type='button' buttonId=" . $value['identificador'] . " class='btn bg-info-gradient btn-sm bntImprimir'><i class='fa fa-print'></i> </button><button type='button' buttonId=" . $value['identificador'] . " class='btn btn-dark' disabled>Anulado&nbsp;&nbsp;<i class='fa fa-ban'></i></button></div>";
                                }
                            }
                        }
                    } else {
                        if ($_SESSION['departamentos'] == 'Bodegas Fiscales') {


                            if ($value['accionEstado'] == 3) {
                                $botoneraAcciones = "<div class='btn-group'><a href='#divEdiciones' class='btn btn-warning btnEditOp' estado=2 role='button' btnEditOp=" . $value['identificador'] . " ><i class='fa fa-edit'></i></a><button type='button' buttonId=" . $value['identificador'] . " class='btn btn-danger btnAnularMostModal'  data-toggle='modal' data-target='#AnulacionIngreso'><i class='fa fa-window-close'></i> </button><button type='button' buttonId=" . $value['identificador'] . " class='btn bg-danger-gradient btn-sm' disabled='disabled'><i class='fa fa-print'></i> </button></div>";
                            }
                            if ($value['accionEstado'] == 1) {
                                $botoneraAcciones = "<div class='btn-group'><button type='button' buttonId=" . $value['identificador'] . " class='btn bg-danger-gradient btn-sm' disabled='disabled'><i class='fa fa-print'></i> </button></div>";
                            } else if ($value['accionEstado'] == 2) {
                                $botoneraAcciones = "<div class='btn-group'><button type='button' buttonId=" . $value['identificador'] . " class='btn bg-danger-gradient btn-sm' disabled='disabled'><i class='fa fa-print'></i> </button></div>";
                            } else if ($value['accionEstado'] >= 4) {
                                if ($_SESSION['niveles'] == 'MEDIO') {
                                    $botoneraAcciones = "<div class='btn-group'><button type='button' buttonId=" . $value['identificador'] . " class='btn btn-danger btnAnularMostModal'  data-toggle='modal' data-target='#AnulacionIngreso'><i class='fa fa-window-close'></i><button type='button' buttonId=" . $value['identificador'] . " class='btn bg-info-gradient btn-sm btnImprimirDet'>Ing. <i class='fa fa-print'></i> </button><button type='button' buttonId=" . $value['identificador'] . " class='btn bg-success-gradient btn-sm btnImprimirDet btn-sm'>Det . <i class='fa fa-print'></i></button></div>";
                                } else {
                                    $botoneraAcciones = "<div class='btn-group'></i><button type='button' buttonId=" . $value['identificador'] . " class='btn bg-info-gradient btn-sm bntImprimir btn-sm'>Ing. <i class='fa fa-print'></i></button><button type='button' buttonId=" . $value['identificador'] . " class='btn bg-success-gradient btn-sm btnImprimirDet btn-sm'>Det . <i class='fa fa-print'></i></button></div>";
                                }
                            } else if ($value['accionEstado'] == -1) {
                                $botoneraAcciones = "<div class='btn-group'><button type='button' buttonId=" . $value['identificador'] . " class='btn bg-info-gradient btn-sm bntImprimir'><i class='fa fa-print'></i><button type='button' buttonId=" . $value['identificador'] . " class='btn btn-dark' disabled>Anulado&nbsp;&nbsp;<i class='fa fa-ban'></i></button></div>";
                            } else {
                                $botoneraAcciones = "<div class='btn-group'><button type='button' buttonId=" . $value['identificador'] . " class='btn bg-info-gradient btn-sm bntImprimir'><i class='fa fa-print'></i></div>";
                            }
                        } else {
                            $botoneraAcciones = "<div class='btn-group'><button type='button' buttonId=" . $value['identificador'] . " class='btn bg-info-gradient btn-sm bntImprimir btn-sm'>Ing. <i class='fa fa-print'></i></button><button type='button' buttonId=" . $value['identificador'] . " class='btn bg-warning-gradient btn-sm btnImprimirInforme btn-sm'>Info . <i class='fa fa-print'></i></button><button type='button' buttonId=" . $value['identificador'] . " class='btn bg-success-gradient btn-sm btnImprimirDet btn-sm'>Det . <i class='fa fa-print'></i></button></div>";
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
                    $bod = $bodega = "<span class='right badge badge-success'>Bodega_" . $identBodega . "</span>";
                    $contador = $contador + 1;


                    $datoJsonIngHis = '[
                                    "' . $contador . '",
                                    "' . $respuesta[$key]["nit"] . '",
                                    "' . $value["empresa"] . '",
                                    "' . $value["poliza"] . '",
                                    "' . $cadena_fecha_actual . '",
                                    "' . $ingreso . '",
                                    "' . $value["blts"] . '",
                                    "' . $cif . '",
                                    "' . $impuesto . '",
                                    "' . $bodega . '",
                                    "' . $botoneraAcciones . '"
    ],';


                    if ($key + 1 != count($respuesta)) {
                        echo $datoJsonIngHis;
                    }
                }
                $pie = substr($datoJsonIngHis, 0, -1);
                $pie .= ']}';
                echo $pie;
            }
        }
    }

}

//ACTIVAR HISTORIAL DE INGRESO DATATABLE
$activarHistorial = new historialIngresosFiscales();
$activarHistorial->ajaxMostrarTableIngHistoria();
