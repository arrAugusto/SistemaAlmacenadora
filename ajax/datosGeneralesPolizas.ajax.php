<?php

require_once "../controlador/historiaIngresosFisacales.controlador.php";
require_once "../modelo/historiaIngresosFisacales.modelo.php";
//SESSION DE USUARIO PARA MANEJAR BITACORA
require_once "../controlador/usuario.controlador.php";
//CONTROLADOR Y MODELO DE CALCULOS
require_once "../controlador/calculoDeAlmacenaje.controlador.php";
require_once "../modelo/calculoDeAlmacenaje.modelo.php";

class datosGeneral {

    public function ajaxMostrarDatosIng() {
        session_start();
        $valor = $_SESSION["idDeBodega"];
        
        $sp = "spConsultPlt";
        $respuesta = ModeloCalculoDeAlmacenaje::ctrGenerateHistoriaIng($sp);


        if ($respuesta != "SD") {
            
            $contador = 0;
            $cabeza = '{
                            "data": [';
            echo $cabeza;
            foreach ($respuesta as $key => $value) {
                // Con objetos
                $contador = $contador+1;
                $fecha_actual = new DateTime();
                $cadena_fecha_actual = $value["fechaRealIng"]->format("d-m-Y");
                $botoneraAcciones =0;
                $contador = $contador + 1;
                
                if ($value["familiaPoliza"]==1) {
                    $acuse = "<button type='button' class='btn btn-success btnImprimirAcuseHist' estado='0' idIng=".$value["id"].">Imprimir Acuse</button>";
                }else{
                    $acuse = "<button type='button' class='btn btn-secondary' disabled='disabled'>Sin acuse</button>";
                    
                }

                $datoJsonIngHis = '[
                                    "' . $contador . '",
                                    "' . $value["nitEmpresa"] . '",
                                    "' . $value["nombreEmpresa"] . '",
                                    "' . $value["numeroPoliza"] . '",
                                    "' . $value["regimen"] . '",                                        
                                    "' . $cadena_fecha_actual . '",
                                    "' . $value["licencia"] . '",
                                    "' . $value["piloto"] . '",
                                    "' . $value["placa"] . '",
                                    "' . $value["contenedor"] . '",
                                    "' . $acuse . '"
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

//ACTIVAR HISTORIAL DE INGRESO DATATABLE
$historialDatos = new datosGeneral();
$historialDatos->ajaxMostrarDatosIng();
