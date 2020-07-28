<?php

require_once "../controlador/registroIngresoBodega.controlador.php";


require_once "../modelo/registroIngresoBodega.modelo.php";
require_once "../modelo/operacionesBIngreso.modelo.php";
require_once "../extensiones/qrCodeCreate/vendor/autoload.php";
//SESSION DE USUARIO PARA MANEJAR BITACORA
require_once "../controlador/usuario.controlador.php";

class AjaxRegistroIngBodega {

    public $mostrarCoincidencias;

    public function AjaxMostrarCoincidencias() {
        $razonSocial = $this->razonSocial;
        $arreglo = ControladorRegistroBodega::ctrMostrarNitCoin($razonSocial);
        echo json_encode($arreglo);
    }

    public $consultaDetalles;

    public function AjaxConsultaDetalles() {
        $numeroIdIng = $this->numeroIdIng;
        $respuesta = ControladorRegistroBodega::ctrConsultaDetalles($numeroIdIng);
        echo json_encode($respuesta);
    }

    public $usarFilaDetalle;

    public function AjaxUsarFilaDetalle() {
        $idUsarFila = $this->idUsarFila;
        $respuesta = ControladorRegistroBodega::ctrUsarFilaDetalle($idUsarFila);
        echo json_encode($respuesta);
    }

    public $guardarDetalle;

    public function AjaxGuardarDetalle() {

        $datos = array(
            "idDetalle" => $this->idDetalle,
            "idOrdenIng" => $this->idOrdenIng,
            "descripcionMerca" => $this->descripcionMerca,
            "cantidadPosiciones" => $this->cantidadPosiciones,
            "Metraje" => $this->Metraje,
            "hiddenLista" => $this->hiddenLista,
            "idChequeBodega" => $this->idChequeBodega,
            "montacarga" => $this->montacarga
        );
        session_start();
        $usuarioOp = $_SESSION["id"];
        $respuesta = ControladorRegistroBodega::ctrGuardarDetalle($datos, $usuarioOp);
        echo json_encode($respuesta);
    }

    public $sumaDetallesData;

    public function AjaxSumaDetallesData() {
        $codigo = $this->codigo;

        $respuesta = ControladorRegistroBodega::ctrSumaDetallesData($codigo);
        echo json_encode($respuesta);
    }

    public $llaveDetalleId;

    public function AjaxLlaveDetalleId() {
        $llaveRevisonDet = $this->idDetalleButton;
        $respuesta = ControladorRegistroBodega::ctrLlaveDetahiddenIdBodegalleId($llaveRevisonDet);
        echo json_encode($respuesta);
    }

    public $editarDetallesBodega;

    public function AjaxEditarDetallesBodega() {
        $datos = array("editarIdDet" => $this->editarIdDet,
            "IdTextPosiciones" => $this->IdTextPosiciones,
            "IdTextMetraje" => $this->IdTextMetraje,
            "IdDescIngreso" => $this->IdDescIngreso);

        $respuesta = ControladorRegistroBodega::ctrEditarDetallesBodega($datos);
        echo json_encode($respuesta);
    }

    public $mostrarMapa;

    public function AjaxmostrarMapa() {
        $hiddenIdBod = $this->hiddenIdBod;
        $respuesta = ControladorRegistroBodega::ctrmostrarMapa($hiddenIdBod);
        echo json_encode($respuesta);
    }

    public $mostrarPaseSalida;

    public function ajaxMostarPaseSalida() {
        $idClientePaseRapido = $this->idClientePaseRapido;
        $tipo = 1;
        $respuesta = ControladorRegistroBodega::ctrMostarPaseSalida($idClientePaseRapido, $tipo);
        echo json_encode($respuesta);
    }

    public $generarPase;

    public function ajaxGenerarPaseVacio() {
        $valUnidad = $this->valUnidad;
        $tipo = 1;
        session_start();
        $usuarioOp = $_SESSION["id"];
        $respuesta = ControladorRegistroBodega::ctrGenerarPaseVacio($valUnidad, $tipo, $usuarioOp);
        echo json_encode($respuesta);
    }

    public $generarPaseCons;

    public function ajaxGenerarPaseCons() {
        $operacionOpPs = $this->operacionOpPs;
        $tipoOpPS = $this->tipoOpPS;
        $cadena = $this->cadena;
        session_start();
        $usuarioOp = $_SESSION["id"];
        $respuesta = ControladorRegistroBodega::ctrGenerarPaseVacio($operacionOpPs, $tipoOpPS, $cadena, $usuarioOp);
        echo json_encode($respuesta);
    }

    public $mostrarVehiculosNuevos;

    public function ajaxMostVehNewFinalIng() {
        $idIngMstV = $this->idIngMstV;
        $respuesta = ControladorRegistroBodega::ctrMostVehNewFinalIng($idIngMstV);
        echo json_encode($respuesta);
    }

    public $cargarChasis;

    public function ajaxConsultarPredios() {
        $consultarPredio = $this->consultarPredio;
        $respuesta = ControladorRegistroBodega::ctrConsultarPredios($consultarPredio);
        echo json_encode($respuesta);
    }

    public $guardarChas;

    public function ajaxVehiculosUbicaN() {
        session_start();
        $usuarioOp = $_SESSION["id"];
        $vehiculosUbicaN = $this->vehiculosUbicaN;
        $listaValida = $this->listaValida;

        $respuesta = ControladorRegistroBodega::ctrVehiculosUbicaN($vehiculosUbicaN, $listaValida, $usuarioOp);
        echo json_encode($respuesta);
    }

    public $montarguista;

    public function ajaxMostrarMontarguista() {
        $montarcarguista = $this->montarcarguista;
        $respuesta = ControladorRegistroBodega::ctrMostrarMontarguista($montarcarguista);
        echo json_encode($respuesta);
    }

}

if (isset($_POST["razonSocial"])) {
    $mostrarCoincidencias = new AjaxRegistroIngBodega();
    $mostrarCoincidencias->razonSocial = $_POST["razonSocial"];
    $mostrarCoincidencias->AjaxMostrarCoincidencias();
}

if (isset($_POST["numeroIdIng"])) {

    $consultaDetalles = new AjaxRegistroIngBodega();
    $consultaDetalles->numeroIdIng = $_POST["numeroIdIng"];
    $consultaDetalles->AjaxConsultaDetalles();
}

if (isset($_POST["idUsarFila"])) {
    $usarFilaDetalle = new AjaxRegistroIngBodega();
    $usarFilaDetalle->idUsarFila = $_POST["idUsarFila"];
    $usarFilaDetalle->AjaxUsarFilaDetalle();
}

if (isset($_POST["idDetalle"])) {

    $guardarDetalle = new AjaxRegistroIngBodega();
    $guardarDetalle->idDetalle = $_POST["idDetalle"];
    $guardarDetalle->idOrdenIng = $_POST["idOrdenIng"];
    $guardarDetalle->descripcionMerca = $_POST["descripcionMerca"];
    $guardarDetalle->cantidadPosiciones = $_POST["cantidadPosiciones"];
    $guardarDetalle->Metraje = $_POST["Metraje"];
    $guardarDetalle->hiddenLista = $_POST["hiddenLista"];
    $guardarDetalle->idChequeBodega = $_POST["idChequeBodega"];
    $guardarDetalle->montacarga = $_POST["montacarga"];
    $guardarDetalle->AjaxGuardarDetalle();
}

if (isset($_POST["codigo"])) {
    $sumaDetallesData = new AjaxRegistroIngBodega();
    $sumaDetallesData->codigo = $_POST["codigo"];

    $sumaDetallesData->AjaxSumaDetallesData();
}



if (isset($_POST["idDetalleButton"])) {

    $llaveDetalleId = new AjaxRegistroIngBodega();
    $llaveDetalleId->idDetalleButton = $_POST["idDetalleButton"];
    $llaveDetalleId->AjaxLlaveDetalleId();
}

if (isset($_POST["editarIdDet"])) {
    $editarDetallesBodega = new AjaxRegistroIngBodega();
    $editarDetallesBodega->editarIdDet = $_POST["editarIdDet"];
    $editarDetallesBodega->IdTextPosiciones = $_POST["IdTextPosiciones"];
    $editarDetallesBodega->IdTextMetraje = $_POST["IdTextMetraje"];
    $editarDetallesBodega->IdDescIngreso = $_POST["IdDescIngreso"];
    $editarDetallesBodega->AjaxEditarDetallesBodega();
}
if (isset($_POST["hiddenIdBod"])) {
    $mostrarMapa = new AjaxRegistroIngBodega();
    $mostrarMapa->hiddenIdBod = $_POST["hiddenIdBod"];
    $mostrarMapa->AjaxmostrarMapa();
}


if (isset($_POST["idClientePaseRapido"])) {
    $mostrarPaseSalida = new AjaxRegistroIngBodega();
    $mostrarPaseSalida->idClientePaseRapido = $_POST["idClientePaseRapido"];
    $mostrarPaseSalida->ajaxMostarPaseSalida();
}
if (isset($_POST["valUnidad"])) {
    $generarPase = new AjaxRegistroIngBodega();
    $generarPase->valUnidad = $_POST["valUnidad"];
    $generarPase->ajaxGenerarPaseVacio();
}

if (isset($_POST["operacionOpPs"])) {
    $generarPaseCons = new AjaxRegistroIngBodega();
    $generarPaseCons->operacionOpPs = $_POST["operacionOpPs"];
    $generarPaseCons->tipoOpPS = $_POST["tipoOpPS"];
    $generarPaseCons->cadena = $_POST["cadena"];
    $generarPaseCons->ajaxGenerarPaseCons();
}


if (isset($_POST["idIngMstV"])) {
    $mostrarVehiculosNuevos = new AjaxRegistroIngBodega();
    $mostrarVehiculosNuevos->idIngMstV = $_POST["idIngMstV"];
    $mostrarVehiculosNuevos->ajaxMostVehNewFinalIng();
}

if (isset($_POST["consultarPredio"])) {
    $cargarChasis = new AjaxRegistroIngBodega();
    $cargarChasis->consultarPredio = $_POST["consultarPredio"];
    $cargarChasis->ajaxConsultarPredios();
}
if (isset($_POST["vehiculosUbicaN"])) {
    $guardarChas = new AjaxRegistroIngBodega();
    $guardarChas->vehiculosUbicaN = $_POST["vehiculosUbicaN"];
    $guardarChas->listaValida = $_POST["listaValida"];
    $guardarChas->ajaxVehiculosUbicaN();
}

if (isset($_POST["montarcarguista"])) {
    $montarguista = new AjaxRegistroIngBodega();
    $montarguista->montarcarguista = $_POST["montarcarguista"];
    $montarguista->ajaxMostrarMontarguista();
}