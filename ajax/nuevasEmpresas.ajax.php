<?php

require_once "../controlador/nuevasEmpresas.controlador.php";
require_once "../modelo/nuevasEmpresas.modelo.php";

class AjaxEditarEmpresaNueva {

    public $mostrarEmpresa;

    public function ajaxMostrarEmpresa() {
        $idEditarEmpresa = $this->idEditarEmpresa;
        $respuesta = ControladorEmpresasAlmacenadoras::ctrMostrarEmpresa($idEditarEmpresa);
        echo json_encode($respuesta);
    }

    public $cancelEmpresa;

    public function ajaxCancelarEmpresa() {
        $cancelarEmpresa = $this->cancelarEmpresa;
        $respuesta = ControladorEmpresasAlmacenadoras::ctrCancelarEmpresa($cancelarEmpresa);
        echo json_encode($respuesta);
    }

    public $activaEmpresa;

    public function ajaxActivarEmpresa() {
        $activaEmpresa = $this->activaEmpresa;
        $respuesta = ControladorEmpresasAlmacenadoras::ctrActivarEmpresa($activaEmpresa);
        echo json_encode($respuesta);
    }

}

if (isset($_POST["idEditarEmpresa"])) {
    $mostrarEmpresa = new AjaxEditarEmpresaNueva();
    $mostrarEmpresa->idEditarEmpresa = $_POST["idEditarEmpresa"];
    $mostrarEmpresa->ajaxMostrarEmpresa();
}

if (isset($_POST["cancelarEmpresa"])) {
    $cancelEmpresa = new AjaxEditarEmpresaNueva();
    $cancelEmpresa->cancelarEmpresa = $_POST["cancelarEmpresa"];
    $cancelEmpresa->ajaxCancelarEmpresa();
}

if (isset($_POST["activaEmpresa"])) {
    $activaEmpresa = new AjaxEditarEmpresaNueva();
    $activaEmpresa->activaEmpresa = $_POST["activaEmpresa"];
    $activaEmpresa->ajaxActivarEmpresa();
}