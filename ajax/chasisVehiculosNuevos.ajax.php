<?php

require_once "../controlador/historiaIngresosFisacales.controlador.php";
require_once "../modelo/historiaIngresosFisacales.modelo.php";
//SESSION DE USUARIO PARA MANEJAR BITACORA
require_once "../controlador/usuario.controlador.php";

//CONTROLADOR Y MODELO DE CALCULOS

class historialIngresosFiscales {

    public function ajaxMostrarTableIngHistoria() {
        session_start();
        $valor = $_SESSION["idDeBodega"];
        $respuesta = ControladorHistorialIngresos::ctrMostrarTableIngHistoria($valor);

        if ($respuesta != "SD") {
            $contador = 0;
            $cabeza = '{
                        "data": [';
            echo $cabeza;
            foreach ($respuesta as $key => $value) {
                $contador = $contador + 1;
                $nombreEmpresa = $value["nombreEmpresa"];
                $numeroPoliza = $value["numeroPoliza"];
                $regimen = $value["regimen"];
                $chasis = $value["chasis"];
                $tipoVehiculo = $value["tipoVehiculo"];
                $linea = $value["linea"];
                $predio = $value["predio"];
                $idRet = $value["idRet"];
                $linea = $value["linea"];
                $idIng = $value["idIng"];
                $fechaIngAlmacen = date("d-m-Y", strtotime($value["fechaReal"]));
                                        
                $buttonRet = "";
                $buttonIng = "<button type='button' buttonid=" . $idIng . " class='btn btn-outline-info bntImprimir btn-sm'>Ing. <i class='fa fa-print'></i></button>";
                if ($idRet == 0) {
                    $estado = "Fiscal";
                }
                if ($idRet >= 1) {
                    $estado = "Liquidado";
                    $buttonRet = "<button type='button' class='btn btn-outline-primary btn-sm' id='btnReimprimeRet' idret='".$idRet."'>Ret. <i class='fa fa-print'></i></button><div class='btn btn-success btn-sm btn-flat btnMasPilotos' id='idbtnMasPilotos' estado='0' idret='".$idRet."' idmaspilotos='".$idRet."' data-toggle='modal' data-target='#plusPilotos'><i class='fa fa-plus' style='font-size:20px' aria-hidden='true'></i></div>";
                }
                $buttons = "<div class='btn-group btn-sm'>" . $buttonIng . $buttonRet . "</div>";
                $datoJsonChasisNew = '[
                                    "' . $contador . '",
                                    "' . $nombreEmpresa . '",
                                    "' . $numeroPoliza . '",
                                    "' . $regimen . '",
                                    "' . $fechaIngAlmacen . '",                                        
                                    "' . $chasis . '",
                                    "' . $tipoVehiculo . '",
                                    "' . $linea . '",
                                    "' . $predio . '",
                                    "' . $estado . '",
                                    "' . $buttons . '"                                        
    ],';


                if ($key + 1 != count($respuesta)) {
                    echo $datoJsonChasisNew;
                }
            }
            $pie = substr($datoJsonChasisNew, 0, -1);
            $pie .= ']}';
            echo $pie;
        }
    }

}

//ACTIVAR HISTORIAL DE INGRESO DATATABLE
$activarHistorial = new historialIngresosFiscales();
$activarHistorial->ajaxMostrarTableIngHistoria();



