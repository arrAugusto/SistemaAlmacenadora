<?php

require_once "../controlador/gestorDeTarifas.controlador.php";
require_once "../modelo/gestorDeTarifas.modelo.php";
//casteoDeData
require_once "../controlador/revisionDeData.controlador.php";

class AjaxGestorDeTarifas {

    public $MostrarTodoServicio;

    public function AjaxMostrarTodoServicio() {
        $idMostrar = $this->idMostrar;
        $numerotarifa = $this->numerotarifa;
        $respuesta = ControladorGestorDeTarifas::ctrMostrarTodoServicio($idMostrar, $numerotarifa);
        echo json_encode($respuesta);
    }

    public $activarTarifa;

    public function ajaxActivDescactivaTarifa() {
        $estadoTarifa = $this->estadoTarifa;
        $idClt = $this->idClt;
        $respuesta = ControladorGestorDeTarifas::ctrActivDescactivaTarifa($estadoTarifa*1, $idClt*1);
        echo json_encode($respuesta);
    }

}

if (isset($_POST["numerotarifa"])) {
    $MostrarTodoServicio = new AjaxGestorDeTarifas();
    $MostrarTodoServicio->idMostrar = $_POST["idMostrar"];
    $MostrarTodoServicio->numerotarifa = $_POST["numerotarifa"];
    $MostrarTodoServicio->AjaxMostrarTodoServicio();
}


if (isset($_POST["estadoTarifa"])) {
    $activarTarifa = new AjaxGestorDeTarifas();
    $activarTarifa->estadoTarifa=$_POST["estadoTarifa"];
    $activarTarifa->idClt=$_POST["idClt"];
    $activarTarifa->ajaxActivDescactivaTarifa();
}