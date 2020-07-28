<?php

require_once "../controlador/sldDiarioContabilidad.controlador.php";
require_once "../modelo/sldDiarioContabilidad.modelo.php";
//SESSION DE USUARIO PARA MANEJAR BITACORA
require_once "../controlador/usuario.controlador.php";

class AjaxHistorialDeSaldos {

    public $mostrarHistorialCif;

    public function ajaxMostrarHistorial() {
        $viewHistorialCif = $this->viewHistorialCif;
        session_start();
        $viewHistorialCif = $_SESSION["idDeBodega"];
        $respuesta = ControladorSaldosContables::ctrMostrarHistorial($viewHistorialCif);
        echo json_encode($respuesta);
    }

    public $mostrarHistorialImpts;

    public function ajaxMostrarHistorialImpts() {
        $viewHistorialImpts = $this->viewHistorialImpts;
        session_start();
        $viewHistorialImpts = $_SESSION["idDeBodega"];
        $respuesta = ControladorSaldosContables::ctrMostrarHistorialImpts($viewHistorialImpts);
        echo json_encode($respuesta);
    }

    public $cortePendiente;

    public function ajaxCortesPendientesContables() {
        $cortesPendientes = $this->cortesPendientes;
        session_start();
        $cortesPendiente = $_SESSION["idDeBodega"];
        $respuesta = ControladorSaldosContables::ctrCortesPendientesContables($cortesPendiente);
        echo json_encode($respuesta);
    }

}

if (isset($_POST["viewHistorialCif"])) {
    $mostrarHistorialCif = new AjaxHistorialDeSaldos();
    $mostrarHistorialCif->viewHistorialCif = $_POST["viewHistorialCif"];
    $mostrarHistorialCif->ajaxMostrarHistorial();
}

if (isset($_POST["viewHistorialImpts"])) {
    $mostrarHistorialImpts = new AjaxHistorialDeSaldos();
    $mostrarHistorialImpts->viewHistorialImpts = $_POST["viewHistorialImpts"];
    $mostrarHistorialImpts->ajaxMostrarHistorialImpts();
}

if (isset($_POST["cortesPendientes"])) {
    $cortePendiente = new AjaxHistorialDeSaldos();
    $cortePendiente->cortesPendientes = $_POST["cortesPendientes"];
    $cortePendiente->ajaxCortesPendientesContables();
}