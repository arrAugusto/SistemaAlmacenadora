<?php

require_once "../controlador/ingPendientesC.controlador.php";
require_once "../modelo/ingPendientesC.modelo.php";
//SESSION DE USUARIO PARA MANEJAR BITACORA
require_once "../controlador/usuario.controlador.php";

class AjaxContabilidadFiscalRegistro {

    public $reportarCont;

    public function ajaxMostrarReporte() {
        $reportarIng = $this->reportarIng;
        $respuesta = ControladorGeneracionDeContabilidad::ctrIngRegistroContaReportes($reportarIng);
        echo json_encode($respuesta);
    }

    public $descontaIng;

    public function ajaxDescontaIng() {
        $descontabilizaIng = $this->descontabilizaIng;
                session_start();
        $usuarioOp = $_SESSION["id"];
        $respuesta = ControladorGeneracionDeContabilidad::ctrDescontaIng($descontabilizaIng, $usuarioOp);
        echo json_encode($respuesta);
        
    }

}

if (isset($_POST["reportarIng"])) {
    $reportarCont = new AjaxContabilidadFiscalRegistro();
    $reportarCont->reportarIng = $_POST["reportarIng"];
    $reportarCont->ajaxMostrarReporte();
}

if (isset($_POST["descontabilizaIng"])) {
    $descontaIng = new AjaxContabilidadFiscalRegistro();
    $descontaIng->descontabilizaIng = $_POST["descontabilizaIng"];
    $descontaIng->ajaxDescontaIng();
}