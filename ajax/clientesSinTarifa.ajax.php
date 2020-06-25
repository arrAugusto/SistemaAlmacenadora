<?php

require_once "../controlador/clientesSinTarifa.controlador.php";
require_once "../modelo/clientesSinTarifa.modelo.php";

class AjaxClientesSinTarifa {

    public $asignarEjecutivo;

    public function ajaxAsignarEjecutivo() {
        $hiddenIdUsST = $this->hiddenIdUsST;
        $idregistrocliente = $this->idregistrocliente;
        $respuesta = ControladorClientesSinTarifa::ctrAsignarEjecutivo($hiddenIdUsST, $idregistrocliente);
        echo json_encode($respuesta);
    }
    public $confirmarClienteSinTarifa;
    public function ajaxConfirClienteSTarifa(){
        $idregistroCDown = $this->idregistroCDown;
        $respuesta = ControladorClientesSinTarifa::ctrConfirClienteSTarifa($idregistroCDown);
        echo json_encode($respuesta);
    }
    

}

if (isset($_POST["hiddenIdUsST"])) {
    $asignarEjecutivo = new AjaxClientesSinTarifa();
    $asignarEjecutivo->hiddenIdUsST = $_POST["hiddenIdUsST"];
    $asignarEjecutivo->idregistrocliente = $_POST["idregistrocliente"];
    $asignarEjecutivo->ajaxAsignarEjecutivo();
}

if (isset($_POST["idregistroCDown"])) {
    $confirmarClienteSinTarifa = new AjaxClientesSinTarifa();
    $confirmarClienteSinTarifa->idregistroCDown=$_POST["idregistroCDown"];
    $confirmarClienteSinTarifa->ajaxConfirClienteSTarifa();
    
}
