<?php

require_once "../controlador/historiaIngresosFisacales.controlador.php";
require_once "../modelo/historiaIngresosFisacales.modelo.php";
//SESSION DE USUARIO PARA MANEJAR BITACORA
require_once "../controlador/usuario.controlador.php";
//CONTROLADOR Y MODELO DE CALCULOS
require_once "../controlador/calculoDeAlmacenaje.controlador.php";
require_once "../modelo/calculoDeAlmacenaje.modelo.php";

class historialIngresosFiscalesEx {

    public function ajaxMostrarTableIngHistEx() {
        session_start();


        $sp = "spHistDataExtraIng";

        $respuesta = ModeloHistorialIngresos::mdlMostrarSinParams($sp);
        if ($respuesta !== null || $respuesta !== NULL) {
            if ($respuesta == "SD") {
                
            } else {





                $contador = 0;
                $cabeza = '{
                            "data": [';
                echo $cabeza;
                foreach ($respuesta as $key => $value) {
                    // Con objetos
                    if ($value["estadoIngreso"] >= 4) {
                        $botoneraAcciones = "<button type='button' buttonId=" . $value['idIngreso'] . " class='btn btn-info btn-sm bntImprimir btn-sm'>Ing. <i class='fa fa-print'></i></button>";
                    } else {
                        $botoneraAcciones = "<button type='button' buttonId=" . $value['idIngreso'] . " class='btn btn-warning btn-sm btn-sm'>Pend.</button>";
                    }
                    $contador = $contador + 1;
                    $fechaGaritaFormat = date("d-m-Y", strtotime($value["fechaIngReal"]));
                    $pesoNumber = number_format($value["peso"], 2);
                    $datoJsonIngHis = '[
                                    "' . $contador . '",
                                    "' . $value["nitEmpresa"] . '",
                                    "' . $value["nombreEmpresa"] . '",
                                    "' . $fechaGaritaFormat . '",
                                    "' . $value["numeroPoliza"] . '",
                                    "' . $value["bultos"] . '",
                                    "' . $pesoNumber . '",                                        
                                    "' . $value["chasis"] . '",                                        
                                    "' . $value["descVeh"] . '",

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
$activarHistorial = new historialIngresosFiscalesEx();
$activarHistorial->ajaxMostrarTableIngHistEx();
