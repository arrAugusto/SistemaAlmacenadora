<?php

require_once "../controlador/sldDiarioContabilidad.controlador.php";
require_once "../modelo/sldDiarioContabilidad.modelo.php";
//SESSION DE USUARIO PARA MANEJAR BITACORA
require_once "../controlador/usuario.controlador.php";
//MODELO DE POLIZAS DIARIAS PARA UTILIZAR SUS METODOS
require_once "../controlador/polizasDiarias.controlador.php";
require_once "../modelo/polizasDiarias.modelo.php";

class AjaxHistorialDeSaldos {

    public $mostrarHistorialCif;

    public function ajaxMostrarHistorial() {
        session_start();
        $viewHistorialCif = $_SESSION["idDeBodega"];
        $respuesta = ControladorSaldosContables::ctrMostrarHistorial($viewHistorialCif);
        echo json_encode($respuesta);
    }

    public $mostrarHistorialImpts;

    public function ajaxMostrarHistorialImpts() {
        session_start();
        $viewHistorialImpts = $_SESSION["idDeBodega"];
        $respuesta = ControladorSaldosContables::ctrMostrarHistorialImpts($viewHistorialImpts);
        echo json_encode($respuesta);
    }

    public $cortePendiente;

    public function ajaxCortesPendientesContables() {
        session_start();
        $cortesPendiente = $_SESSION["idDeBodega"];
        $respuesta = ControladorSaldosContables::ctrCortesPendientesContables($cortesPendiente);
        echo json_encode($respuesta);
    }

    public $inicialConta;

    public function ajaxSaldosInicioConta() {
        $idEmpInicalConta = $this->idEmpInicalConta;
        $sldContableCif = $this->sldContableCif;
        $sldContableImpts = $this->sldContableImpts;
        $respuesta = ControladorSaldosContables::ctrSaldosInicioConta($idEmpInicalConta, $sldContableCif, $sldContableImpts);
        echo json_encode($respuesta);
    }

    public $mstReporteriaFecha;

    public function ajaxReporteriaFecha() {
        $fechaReporteria = $this->fechaReporteria;
        session_start();
        $idBodFecha = $_SESSION["idDeBodega"];
        $respuesta = ControladorSaldosContables::ctrReporteriaFecha($fechaReporteria, $idBodFecha);
        echo json_encode($respuesta);
    }

    public $mostrarAjustesConta;

    public function ajaxMostrarAjusteConta() {
        $idBodegaAjuste = $this->idBodegaAjuste;
        $fechaReportAjuste = $this->fechaReportAjuste;
        $respuesta = ControladorSaldosContables::ctrMostrarAjusteConta($fechaReportAjuste, $idBodegaAjuste);
        echo json_encode($respuesta);
    }

    public $mtrCuentasContables;

    public function ajaxMostrarCtaContables() {
        $cuentasContables = $this->cuentasContables;
        if ($cuentasContables == 0) {
            $respuesta = ControladorSaldosContables::ctrMostrarCuentas();
            echo json_encode($respuesta);
        }
    }

    public $ajusteIngRetContable;

    public function ajaxAjusteIngRetContable() {
        $datePolAjuste = $this->datePolAjuste;
        session_start();
        $idDeBodega = $_SESSION["idDeBodega"];
        $tipoAjuste = $this->tipoAjuste;
        $montoCif = $this->montoCif;
        $montoImpuesto = $this->montoImpuesto;
        $respuesta = ControladorSaldosContables::ctrGenerarAjusteContableIngRet($datePolAjuste, $idDeBodega, $montoCif, $montoImpuesto, $tipoAjuste);
        echo json_encode($respuesta);
    }

    public $ajusteMultiple;

    public function ajaxAjustesMultiples() {
        session_start();
        $idDeBodega = $_SESSION["idDeBodega"];
        $ajusteMultDate = $this->ajusteMultDate;
        $montoCifMult = $this->montoCifMult;
        $montoImpuestoMult = $this->montoImpuestoMult;
        $tipoAjusteMult = $this->tipoAjusteMult;
        $estadoIngImptsMult = $this->estadoIngImptsMult;
        $estadoIngCifMult = $this->estadoIngCifMult;
        $estadoRetCifMult = $this->estadoRetCifMult;
        $estadoRetImptsMult = $this->estadoRetImptsMult;
        $respuesta = ControladorSaldosContables::ctrMultipleAjusteContable($ajusteMultDate, $montoCifMult, $montoImpuestoMult, $tipoAjusteMult, $estadoIngImptsMult, $estadoIngCifMult, $estadoRetCifMult, $estadoRetImptsMult, $idDeBodega);
        echo json_encode($respuesta);
    }

    public $corteContaDia;

    public function ajaxCorteContaDia() {
        $fechaCorteConta = $this->fechaCorteConta;
        session_start();
        $idBodCorte = $_SESSION["idDeBodega"];
        $respuesta = ControladorSaldosContables::ctrCorteContaDia($fechaCorteConta, $idBodCorte);
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

if (isset($_POST["idEmpInicalConta"])) {
    $inicialConta = new AjaxHistorialDeSaldos();
    $inicialConta->idEmpInicalConta = $_POST["idEmpInicalConta"];
    $inicialConta->sldContableCif = $_POST["sldContableCif"];
    $inicialConta->sldContableImpts = $_POST["sldContableImpts"];
    $inicialConta->ajaxSaldosInicioConta();
}

if (isset($_POST["fechaReporteria"])) {
    $mstReporteriaFecha = new AjaxHistorialDeSaldos();
    $mstReporteriaFecha->fechaReporteria = $_POST["fechaReporteria"];
    $mstReporteriaFecha->ajaxReporteriaFecha();
}

if (isset($_POST["fechaReportAjuste"])) {
    $mostrarAjustesConta = new AjaxHistorialDeSaldos();
    $mostrarAjustesConta->idBodegaAjuste = $_POST["idBodegaAjuste"];
    $mostrarAjustesConta->fechaReportAjuste = $_POST["fechaReportAjuste"];
    $mostrarAjustesConta->ajaxMostrarAjusteConta();
}

if (isset($_POST["cuentasContables"])) {
    $mtrCuentasContables = new AjaxHistorialDeSaldos();
    $mtrCuentasContables->cuentasContables = $_POST["cuentasContables"];
    $mtrCuentasContables->ajaxMostrarCtaContables();
}
if (isset($_POST["datePolAjuste"])) {
    $ajusteIngRetContable = new AjaxHistorialDeSaldos();
    $ajusteIngRetContable->datePolAjuste = $_POST["datePolAjuste"];
    $ajusteIngRetContable->montoCif = $_POST["montoCif"];
    $ajusteIngRetContable->montoImpuesto = $_POST["montoImpuesto"];
    $ajusteIngRetContable->tipoAjuste = $_POST["tipoAjuste"];
    $ajusteIngRetContable->ajaxAjusteIngRetContable();
}

if (isset($_POST["ajusteMultDate"])) {
    $ajusteMultiple = new AjaxHistorialDeSaldos();
    $ajusteMultiple->ajusteMultDate = $_POST["ajusteMultDate"];
    $ajusteMultiple->montoCifMult = $_POST["montoCifMult"];
    $ajusteMultiple->montoImpuestoMult = $_POST["montoImpuestoMult"];
    $ajusteMultiple->tipoAjusteMult = $_POST["tipoAjusteMult"];
    $ajusteMultiple->estadoIngImptsMult = $_POST["estadoIngImptsMult"];
    $ajusteMultiple->estadoIngCifMult = $_POST["estadoIngCifMult"];
    $ajusteMultiple->estadoRetCifMult = $_POST["estadoRetCifMult"];
    $ajusteMultiple->estadoRetImptsMult = $_POST["estadoRetImptsMult"];
    $ajusteMultiple->ajaxAjustesMultiples();
}
if (isset($_POST["fechaCorteConta"])) {
    $corteContaDia = new AjaxHistorialDeSaldos();
    $corteContaDia->fechaCorteConta = $_POST["fechaCorteConta"];
    $corteContaDia->ajaxCorteContaDia();
}
