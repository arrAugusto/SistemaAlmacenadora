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
        $estado = 0;
        $sp = "spConsultaTrasladosAF";
        $respuesta = ModeloHistorialIngresos::mdlMostrarChasisVehContables($sp, $valor);
        if ($respuesta != null || $respuesta != NULL) {
            if ($respuesta != "SD") {

                $contador = 0;
                $cabeza = '{
                            "data": [';
                echo $cabeza;
                foreach ($respuesta as $key => $value) {
                    $contador = $contador+1;
                    // Con objetos
            
                        $button = "<button type='button' class='btn btn-outline-success btn-sm btnHacerTrasladoDefinitivo' idIng=".$value["id"]."><i class='fa fa-share'></i></button>";

                    $datoJsonIngHis = '[
                                    "' . $contador . '",
                                    "' . $value["nitEmpresa"] . '",
                                    "' . $value["nombreEmpresa"] . '",
                                    "' . $value["numeroPoliza"] . '",                                        
                                    "' . $value["bultos"] . '",
                                    "' . $value["totalValorCif"] . '",
                                    "' . $value["valorImpuesto"] . '",
                                    "' . $button . '"
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
