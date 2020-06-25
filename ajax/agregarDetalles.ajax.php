<?php

require_once "../controlador/agregarDetalles.controlador.php";
require_once "../modelo/agregarDetalles.modelo.php";

class AjaxAgregarDetalles {

    public $MostrarEmpresas;

    public function AjaxMostrarEmpresas() {
        $datoAgregar = $this->datoAgregar;
        $respuesta = ControladorAgrDetalles::ctrMostrarEmpresas();
        echo json_encode($respuesta);
    }

}

if (isset($_POST["datoAgregar"])) {
    $MostrarEmpresas = new AjaxAgregarDetalles();
    $MostrarEmpresas->datoAgregar = $_POST["datoAgregar"];
    $MostrarEmpresas->AjaxMostrarEmpresas();
}

