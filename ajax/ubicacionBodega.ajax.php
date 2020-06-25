<?php

require_once "../controlador/ubicacionBodega.controlador.php";
require_once "../modelo/ubicacionBodega.modelo.php";

class AjaxUbicacionBodega {

    public $MostrarUbicaUnicas;

    public function ajaxMostrarUbUnitaria() {
        $datoSearch = $this->datoSearch;
        $hiddenIdBodega = $this->hiddenIdBodega;
        $respuesta = ControladorUbicacionBodega::ctrMostrarUbUnitaria($datoSearch, $hiddenIdBodega);
        echo json_encode($respuesta);
    }

    public $mostarUbicaciones;

    public function ajaxMostarUbicaciones() {
        $idDetView = $this->idDetView;
        $respuesta = ControladorUbicacionBodega::ctrMostarUbicaciones($idDetView);
        echo json_encode($respuesta);
    }

}

if (isset($_POST["datoSearch"])) {
    $MostrarUbicaUnicas = new AjaxUbicacionBodega();
    $MostrarUbicaUnicas->datoSearch = $_POST["datoSearch"];
    $MostrarUbicaUnicas->hiddenIdBodega = $_POST["hiddenIdBodega"];
    $MostrarUbicaUnicas->ajaxMostrarUbUnitaria();
}

if (isset($_POST["idDetView"])) {
    $mostarUbicaciones = new AjaxUbicacionBodega();
    $mostarUbicaciones->idDetView = $_POST["idDetView"];
    $mostarUbicaciones->ajaxMostarUbicaciones();
}