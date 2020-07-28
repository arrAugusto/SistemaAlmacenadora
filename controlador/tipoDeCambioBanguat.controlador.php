<?php

require_once('banguat/lib/nusoap.php');

class tipoDeCambio {

    public static function cambioDelDia() {
        date_default_timezone_set('America/Guatemala');
        $fechaHoy = date('Y-m-d');
        $respuesta = ModeloUsuarios::mdlTipoDeCambio($fechaHoy);
         if ($respuesta[0]["cambio"] == 0) {
            //url del webservice
            $wsdl = "http://www.banguat.gob.gt/variables/ws/TipoCambio.asmx?WSDL";
            //instanciando un nuevo objeto cliente para consumir el webservice
            $client = new nusoap_client($wsdl, 'wsdl');
            // Call the SOAP method
            $result = $client->call('TipoCambioDia');
            if ($client->fault) { // si
                $error = $client->getError();
                if ($error) { // Hubo algun error
                    echo 'Error:  ' . $client->faultstring;
                }
                die();
            }
            $tipoDeCambio = $result["TipoCambioDiaResult"]["CambioDolar"]["VarDolar"]["referencia"];
            $fecha = $result["TipoCambioDiaResult"]["CambioDolar"]["VarDolar"]["fecha"];
            $respuesta = ModeloUsuarios::mdlGuardarTipoDeCambio($fechaHoy, $tipoDeCambio);
                echo 'Cambio : ' . $fecha . ',  Q. ' . $tipoDeCambio;
        }else{
            echo 'Cambio : ' . $fechaHoy = date('d/m/Y') . ',  Q. ' . $respuesta[0]["cambio"];

        }
    }

}
