<?php

require_once "../controlador/contabilidadRetiro.controlador.php";
require_once "../modelo/contabilidadRetiro.modelo.php";
//SESSION DE USUARIO PARA MANEJAR BITACORA
require_once "../controlador/usuario.controlador.php";

class AjaxContabilidadRetiro {

    public $mostrarRet;

    public function ajaxContabilizarRetiro() {
        $idRetContabilidad = $this->idRetContabilidad;
        $fechaRetContabi = $this->fechaRetContabi;
        $tipo = 0;
        session_start();
        $usuarioOp = $_SESSION["id"];
        $respuesta = ControladorContabilidadDeRet::ctrContabilizarRetiro($idRetContabilidad, $tipo, $usuarioOp, $fechaRetContabi);
        echo json_encode($respuesta);
    }

    public $reportConta;

    public function ajaxMostrarReporteConta() {
        $reportContaIdent = $this->reportContaIdent;
        $respuesta = ControladorContabilidadDeRet::ctrMostrarReporteConta($reportContaIdent);
        echo json_encode($respuesta);
    }

    public $mostrarRepRetiro;

    public function ajaxMostrarReporteRetiro() {
        $mostrarRepRetiro = $this->mostrarRepRetiro;
        $respRetiro = ControladorContabilidadDeRet::ctrMostrarReporteRetiro($mostrarRepRetiro);
        echo json_encode($respRetiro);
    }

    public $mostrarAjustesConta;

    public function ajaxMstrAjustesContables() {
        $mstAjustesConta = $this->mstAjustesConta;
        $respRetiro = ControladorContabilidadDeRet::ctrMstrAjustesContables($mstAjustesConta);
        echo json_encode($respRetiro);
    }

    public $descontabilizar;

    public function ajaxDescontabilizaRet() {
        $descontabilizaRet = $this->descontabilizaRet;
        session_start();
        $usuarioOp = $_SESSION["id"];
        $respuesta = ControladorContabilidadDeRet::ctrDescontabilizaRet($descontabilizaRet, $usuarioOp);
        echo json_encode($respuesta);
        
    }

}

if (isset($_POST["idRetContabilidad"])) {
    $mostrarRet = new AjaxContabilidadRetiro();
    $mostrarRet->idRetContabilidad = $_POST["idRetContabilidad"];
    $mostrarRet->fechaRetContabi = $_POST["fechaRetContabi"];
    $mostrarRet->ajaxContabilizarRetiro();
}

if (isset($_POST["reportContaIdent"])) {
    $reportConta = new AjaxContabilidadRetiro();
    $reportConta->reportContaIdent = $_POST["reportContaIdent"];
    $reportConta->ajaxMostrarReporteConta();
}

if (isset($_POST["mostrarRepRetiro"])) {
    $mostrarRepRetiro = new AjaxContabilidadRetiro();
    $mostrarRepRetiro->mostrarRepRetiro = $_POST["mostrarRepRetiro"];
    $mostrarRepRetiro->ajaxMostrarReporteRetiro();
}


if (isset($_POST["mstAjustesConta"])) {
    $mostrarAjustesConta = new AjaxContabilidadRetiro();
    $mostrarAjustesConta->mstAjustesConta = $_POST["mstAjustesConta"];
    $mostrarAjustesConta->ajaxMstrAjustesContables();
}

if (isset($_POST["descontabilizaRet"])) {
    $descontabilizar = new AjaxContabilidadRetiro();
    $descontabilizar->descontabilizaRet = $_POST["descontabilizaRet"];
    $descontabilizar->ajaxDescontabilizaRet();
}