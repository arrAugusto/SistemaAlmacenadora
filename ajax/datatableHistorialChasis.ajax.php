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

        $sp = "spConsultaChasSalida";
        $respuesta = ModeloHistorialIngresos::mdlMostrarSinParams($sp);
        var_dump($respuesta);
        if ($respuesta !== null || $respuesta !== NULL) {
            if ($respuesta != "SD") {

                $contador = 0;
                $cabeza = '{
                            "data": [';
                echo $cabeza;
                foreach ($respuesta as $key => $value) {
                    // Con objetos
                    if ($value["estado"]==0) {
                        $button = '<button type="button" class="btn btn-primary"><i class="fa fa-check"></i></button>';
                    }
                    $fecha_actual = new DateTime();
                    $cadena_fecha_actual = $value["fechaRealIng"]->format("d-m-Y");
                    if ($value["numeroAsig"] == 0) {
                        $ingreso = "Sin Ingreso";
                    } else {
                        $ingreso = $value["numeroAsig"];
                    }
                    $chasis = $value["chasis"];
                    $linea = $value["linea"];
                    $tipoV = $value["tipoVehiculo"];
                    $cif = $value["cif"];
                    $impuesto = $value["impuesto"];
                   

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
