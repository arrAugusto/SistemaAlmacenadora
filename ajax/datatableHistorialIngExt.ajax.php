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
                   $contador = $contador+1;
                                
                                $datoJsonIngHis ='[
                                    "'.$contador.'",
                                    "'.$value["nitEmpresa"].'",
                                    "'.$value["nombreEmpresa"].'",
                                    "'.$value["numeroPoliza"].'",
                                    "'.$value["bl"].'",
                                    "'.$value["idCartaCupo"].'",
                                    "'.$value["producto"].'",
                                    "'.$value["peso"].'"
    ],';
                                
       
                                if ($key+1!=count($respuesta)) {
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