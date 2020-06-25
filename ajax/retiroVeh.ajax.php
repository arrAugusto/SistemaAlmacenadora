<?php

require_once "../controlador/retiroVeh.controlador.php";
require_once "../modelo/retiroVeh.modelo.php";
//CASTEO DE DATA
require_once "../controlador/revisionDeData.controlador.php";

class AjaxAccionesVehiculosNuevos {

    public $estadoVeh;

    public function ajaxAccionEstadoVeh() {
        $estado = $this->estado;
        $identChas = $this->identChas;
        $tipo = $this->tipo;
        $respuesta = ControladorRetirosRebajados::ctrAccionEstadoVeh($estado * 1, $identChas * 1, $tipo * 1);
        echo json_encode($respuesta);
    }

    public $reversionChasis;

    public function ajaxReversionChasis() {
        $idNewChas = $this->idNewChas;
        $idAntChasis = $this->idAntChasis;
        if (is_numeric($idNewChas) && is_numeric($idAntChasis)) {
            $respuesta = ControladorRetirosRebajados::ctrReversionChasis($idNewChas * 1, $idAntChasis * 1);
            echo json_encode($respuesta);
        }
    }

}

if (isset($_POST["estado"])) {
    $estadoVeh = new AjaxAccionesVehiculosNuevos();
    $estadoVeh->estado = $_POST["estado"];
    $estadoVeh->identChas = $_POST["identChas"];
    $estadoVeh->tipo = $_POST["tipo"];
    $estadoVeh->ajaxAccionEstadoVeh();
}

if (isset($_POST["idNewChas"])) {
    $reversionChasis = new AjaxAccionesVehiculosNuevos();
    $reversionChasis->idNewChas = $_POST["idNewChas"];
    $reversionChasis->idAntChasis = $_POST["idAntChasis"];
    $reversionChasis->ajaxReversionChasis();
}