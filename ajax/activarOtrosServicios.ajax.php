<?php

require_once "../controlador/activarOtrosServicios.controlador.php";
require_once "../modelo/activarOtrosServicios.modelo.php";
//casteoDeData
require_once "../controlador/revisionDeData.controlador.php";

class AjaxNuevaTarifaParametros {
    /* =============================================
      FUNCION CONSULTA EL NUMERO DE NIT
      ============================================= */

    public $valorNit;

    public function AjaxConsultaServicios() {
        $valorNit = $this->valorNit;

        $respuesta = ControladorActivarTarifa::ctrConsultaServicios($valorNit * 1);
        echo json_encode($respuesta);
    }

    /* Insert segunda fase */

    public $segundaFase;

    public function ajaxOtrosServicios() {
        $valor = $this->idOtroServicios;
        $datos = array($this->idOtroServicios, $this->idservicioalmacenadora, $this->calculoSobreSeguro, $this->baseCalculo, $this->periodoCalculo, $this->monedaSeguro, $this->valorSobreSeguro, $this->basePeso, $this->monedaPeso, $this->valorPeso, $this->valorGastosAdmin, $this->monedaGtsAdmin, $this->valorGtosA, $this->calculoOtrosGastos, $this->monedaOtrosGastos, $this->valorOtrosGastos, $this->nitEmpresa);
        $respuesta = ControladorActivarTarifa::ctrIngresoOtrosServicios($valor, $datos);
        echo json_encode($respuesta);
    }

    // HACIENDO PUBLICO EL OBJETO PARA HEREDAR SUS VARIABLES
    public $mostrarCliente;

    //SOLICITUD DE DATA
    public function ajaxMostrarCliente() {
        $idNit = $this->idNit;
        $respuesta = ControladorActivarTarifa::ctrMostrarCliente($idNit * 1);
        echo json_encode($respuesta);
    }

    public $mostrarDetTarifa;

    public function ajaxMostrarDataTarifa() {
        $ActivarTar = $this->ActivarTar;
        $respuesta = ControladorActivarTarifa::ctrMostrarDataTarifa($ActivarTar * 1);
        echo json_encode($respuesta);
    }

}

/* =============================================
  SI EXISTE LA VARIABLE POST-->VALORNIT
  EJECUTAR FUNCION CONSULTASERVICIOS
  ============================================= */
if (isset($_POST["valorNit"])) {
    $valorNit = new AjaxNuevaTarifaParametros();
    $valorNit->valorNit = $_POST["valorNit"];
    $valorNit->AjaxConsultaServicios();
}

/* =============================================
  SI EXISTE LA VARIABLE POST-->IDOTROSSERVICIOS
  INSERT OTROS SERVICIOS
  ============================================= */

if (isset($_POST["idOtroServicios"])) {
    $segundaFase = new AjaxNuevaTarifaParametros();
    $segundaFase->idOtroServicios = $_POST["idOtroServicios"];
    $segundaFase->idservicioalmacenadora = $_POST["idservicioalmacenadora"];
    $segundaFase->calculoSobreSeguro = $_POST["calculoSobreSeguro"];
    $segundaFase->baseCalculo = $_POST["baseCalculo"];
    $segundaFase->periodoCalculo = $_POST["periodoCalculo"];
    $segundaFase->monedaSeguro = $_POST["monedaSeguro"];
    $segundaFase->valorSobreSeguro = $_POST["valorSobreSeguro"];
    $segundaFase->basePeso = $_POST["basePeso"];
    $segundaFase->monedaPeso = $_POST["monedaPeso"];
    $segundaFase->valorPeso = $_POST["valorPeso"];
    $segundaFase->valorGastosAdmin = $_POST["valorGastosAdmin"];
    $segundaFase->monedaGtsAdmin = $_POST["monedaGtsAdmin"];
    $segundaFase->valorGtosA = $_POST["valorGtosA"];
    $segundaFase->calculoOtrosGastos = $_POST["calculoOtrosGastos"];
    $segundaFase->monedaOtrosGastos = $_POST["monedaOtrosGastos"];
    $segundaFase->valorOtrosGastos = $_POST["valorOtrosGastos"];
    $segundaFase->nitEmpresa = $_POST["nitEmpresa"];
    $segundaFase->ajaxOtrosServicios();
}

// SI EXISTE EL IDNIT
if (isset($_POST["idNit"])) {
    $mostrarCliente = new AjaxNuevaTarifaParametros();
    $mostrarCliente->idNit = $_POST["idNit"];
    $mostrarCliente->ajaxMostrarCliente();
}

// SI EXISTE EL IDNIT
if (isset($_POST["ActivarTar"])) {
    $mostrarDetTarifa = new AjaxNuevaTarifaParametros();
    $mostrarDetTarifa->ActivarTar = $_POST["ActivarTar"];
    $mostrarDetTarifa->ajaxMostrarDataTarifa();
}


