<?php

class ControladorConfiNavega {

    public static function ctrInicioSesiones($txtAreaBodega, $numeroBodega, $idHiddenNavega, $idHiddenNavegaUs) {
        $respuesta = ModeloConfiNavega::mdlInicioSesiones($txtAreaBodega, $numeroBodega, $idHiddenNavega, $idHiddenNavegaUs);
        if ($respuesta == "errorSinData") {
            return $respuesta;
        } else {
            session_start();
            $accesoOkEmp = $respuesta[0]["nombreEmpresa"];
            $accesoOkArea = $respuesta[0]["Area"];
            $accesoOkNumArea = $respuesta[0]["numeroArea"];
            $numIdBod = $respuesta[0]["idDeBodega"];
            $_SESSION["Navega"] = $accesoOkEmp;
            $_SESSION["NavegaBod"] = $accesoOkArea;
            $_SESSION["NavegaNumB"] = $accesoOkNumArea;
            $_SESSION["idDeBodega"] = $numIdBod;
            date_default_timezone_set('America/Guatemala');
            $time = date('Y-m-d H:i:s');
            $respuestaNavega = ModeloConfiNavega::mdlHistoriaNavega($idHiddenNavegaUs, $numIdBod, $time);
            if ($respuestaNavega == "OpExtiosa") {
                return $respuesta;
            } else {
                return $respuestaNavega;
            }
        }
    }

}
