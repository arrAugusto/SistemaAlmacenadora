<?php

require_once "../controlador/inventariosFiscales.controlador.php";
require_once "../modelo/inventariosFiscales.modelo.php";
require_once "../modelo/registroIngresoBodega.modelo.php";
//SESSION DE USUARIO PARA MANEJAR BITACORA
require_once "../controlador/usuario.controlador.php";

class AjaxInventario {

    public $mostrarDetallesExcel;

    public function ajaxMostarDetalleExcel() {
        $idIngresoExcel = $this->idIngresoExcel;
        $respuesta = ControladorGeneracionDeInventarios::ctrMostarDetalleExcel($idIngresoExcel);
        echo json_encode($respuesta);
    }

    public $mostrarEdicionesBod;

    public function ajaxMostrarEdicionesBod() {
        $idIngEdicionBod = $this->idIngEdicionBod;
        $respuesta = ControladorGeneracionDeInventarios::ctrMostrarEdicionesBod($idIngEdicionBod);
        echo json_encode($respuesta);
    }

    public $mostrarEdicionesUbica;

    public function ajaxMostrarEdicionesUbica() {
        $iddetEdicionUbica = $this->iddetEdicionUbica;
        $respuesta = ControladorGeneracionDeInventarios::ctrMostrarEdicionesUbica($iddetEdicionUbica);
        echo json_encode($respuesta);
    }

    public $GuardarUbicaionesMod;

    public function ajaxGuardaListaModificada() {
        $GdListaUbModificada = $this->GdListaUbModificada;
        $idDet = $this->idDet;
        $Idincidencia = $this->Idincidencia;
        $respuesta = ControladorGeneracionDeInventarios::ctrGuardaListaModificada($GdListaUbModificada, $idDet, $Idincidencia);
        echo json_encode($respuesta);
    }

    public $eliminarUbicacion;

    public function ajaxEliminarUbicacion() {
        $pasilloYTrash = $this->pasilloYTrash;
        $columnaXTrash = $this->columnaXTrash;
        $idIncidenciaTrash = $this->idIncidenciaTrash;
        $respuesta = ControladorGeneracionDeInventarios::ctrEliminarUbicacion($pasilloYTrash, $columnaXTrash, $idIncidenciaTrash);
        echo json_encode($respuesta);
    }

    public $mostrarVehUsados;

    public function ajaxMostrarVehiculosUsados() {
        session_start();
        $idDeBodega = $_SESSION["idDeBodega"];
        $respuesta = ControladorGeneracionDeInventarios::ctrMostrarVehiculosUsados($idDeBodega);
        echo json_encode($respuesta);
    }

    public $mostrarUbicaciones;
    public function ajaxMostrarUbicacionesVhUS() {
    $idDetChas = $this->idDetChas;
        $respuesta = ControladorGeneracionDeInventarios::ctrMostrarUbicacionesVhUS($idDetChas);
        echo json_encode($respuesta);
        
    }

}

if (isset($_POST["idIngresoExcel"])) {
    $mostrarDetallesExcel = new AjaxInventario();
    $mostrarDetallesExcel->idIngresoExcel = $_POST["idIngresoExcel"];
    $mostrarDetallesExcel->ajaxMostarDetalleExcel();
}


if (isset($_POST["idIngEdicionBod"])) {
    $mostrarEdicionesBod = new AjaxInventario();
    $mostrarEdicionesBod->idIngEdicionBod = $_POST["idIngEdicionBod"];
    $mostrarEdicionesBod->ajaxMostrarEdicionesBod();
}

if (isset($_POST["iddetEdicionUbica"])) {
    $mostrarEdicionesUbica = new AjaxInventario();
    $mostrarEdicionesUbica->iddetEdicionUbica = $_POST["iddetEdicionUbica"];
    $mostrarEdicionesUbica->ajaxMostrarEdicionesUbica();
}
if (isset($_POST["GdListaUbModificada"])) {
    $GuardarUbicaionesMod = new AjaxInventario();
    $GuardarUbicaionesMod->GdListaUbModificada = $_POST["GdListaUbModificada"];
    $GuardarUbicaionesMod->idDet = $_POST["idDet"];
    $GuardarUbicaionesMod->Idincidencia = $_POST["Idincidencia"];
    $GuardarUbicaionesMod->ajaxGuardaListaModificada();
}


if (isset($_POST["idIncidenciaTrash"])) {
    $eliminarUbicacion = new AjaxInventario();
    $eliminarUbicacion->pasilloYTrash = $_POST["pasilloYTrash"];
    $eliminarUbicacion->columnaXTrash = $_POST["columnaXTrash"];
    $eliminarUbicacion->idIncidenciaTrash = $_POST["idIncidenciaTrash"];
    $eliminarUbicacion->ajaxEliminarUbicacion();
}


if (isset($_POST["mostrarVehiculosUsados"])) {
    $mostrarVehUsados = new AjaxInventario();
    $mostrarVehUsados->mostrarVehiculosUsados = $_POST["mostrarVehiculosUsados"];
    $mostrarVehUsados->ajaxMostrarVehiculosUsados();
}

if (isset($_POST["idDetChas"])) {
    $mostrarUbicaciones = new AjaxInventario();
    $mostrarUbicaciones->idDetChas = $_POST["idDetChas"];
    $mostrarUbicaciones->ajaxMostrarUbicacionesVhUS();
}