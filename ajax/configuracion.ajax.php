<?php

require_once "../controlador/configuracion.controlador.php";
require_once "../modelo/configuracion.modelo.php";

class AjaxConfiNavega {

    public $inicioSession;

    public function AjaxInicioSesiones() {
        $txtAreaBodega = $this->txtAreaBodega;
        $numeroBodega = $this->numeroBodega;
        $idHiddenNavega = $this->idHiddenNavega;
        $idHiddenNavegaUs = $this->idHiddenNavegaUs;
        $respuesta = ControladorConfiNavega::ctrInicioSesiones($txtAreaBodega, $numeroBodega, $idHiddenNavega, $idHiddenNavegaUs);
        echo json_encode($respuesta);
    }

}

if (isset($_POST["numeroBodega"])) {
    $inicioSession = new AjaxConfiNavega();
    $inicioSession->txtAreaBodega = $_POST["txtAreaBodega"];
    $inicioSession->numeroBodega = $_POST["numeroBodega"];
    $inicioSession->idHiddenNavega = $_POST["idHiddenNavega"];
    $inicioSession->idHiddenNavegaUs = $_POST["idHiddenNavegaUs"];
    $inicioSession->AjaxInicioSesiones();
}
