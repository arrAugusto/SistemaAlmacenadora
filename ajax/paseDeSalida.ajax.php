<?php

require_once "../controlador/paseDeSalida.controlador.php";
require_once "../modelo/paseDeSalida.modelo.php";

/*
  REQUERIDO POR METODO CONSULTA DE LOTE Y VERIFICACION PARA CALCULO DE ALMACENAJE
 */
require_once "../modelo/retiroOpe.modelo.php";

require_once "../modelo/logicaDeCalculos.php";

require_once "../modelo/paseDeSalida.modelo.php";

require_once "../modelo/calculoDeAlmacenaje.modelo.php";

//calculos de almacenaje
require_once "../controlador/calculoDeAlmacenaje.controlador.php";
require_once "../modelo/calculoDeAlmacenaje.modelo.php";

//SESSION DE USUARIO PARA MANEJAR BITACORA
require_once "../controlador/usuario.controlador.php";

class AjaxPasesDeSalida {

    public $mostrarDataCalcUnidad;

    public function ajaxMostrarCalculoDatosUnidad() {
        $idRetCal = $this->idRetCal;
        $idIngresoCal = $this->idIngresoCal;
        $hiddenDateTimeVal = $this->hiddenDateTimeVal;
        $respuesta = ControladorPasesDeSalida::ctrMostrarCalculoDatosUnidad($idRetCal, $idIngresoCal, $hiddenDateTimeVal);
        echo json_encode($respuesta);
    }

    public $consultDatoRet;

    public function ajaxConsultDatosRet() {
        $idNumRetConsult = $this->idNumRetConsult;
        $respuesta = ControladorPasesDeSalida::ctrConsultDatosRet($idNumRetConsult);
        echo json_encode($respuesta);
    }

    public $datosConsult;

    public function ajaxConsultaDatosGen() {
        $idRetDatosGen = $this->idRetDatosGen;
        $respuesta = ControladorPasesDeSalida::ctrConsultaDatosGen($idRetDatosGen);
        echo json_encode($respuesta);
    }

    public $guardarRecAlm;

    public function ajaxGuardarNuevoRecibo() {
        session_start();
        $usuarioOp = $_SESSION["id"];
        $datos = array(
            "idRetGdRec" => $idRetGdRec = $this->idRetGdRec,
            "hiddenresultIdIngresoGdRec" => $hiddenresultIdIngresoGdRec = $this->hiddenresultIdIngresoGdRec,
            "listaOtrosGdRec" => $listaOtrosGdRec = $this->listaOtrosGdRec,
            "listaServiciosDefaultGdRec" => $listaServiciosDefaultGdRec = $this->listaServiciosDefaultGdRec,
            "valDescuentoGdRec" => $valDescuentoGdRec = $this->valDescuentoGdRec,
            "hiddenDescuentoGdRec" => $hiddenDescuentoGdRec = $this->hiddenDescuentoGdRec,
            "hiddenDateTimeValRecEle" => $hiddenDateTimeValRecEle = $this->hiddenDateTimeValRecEle,
            "usuarioOp"=>$usuarioOp);
        $respuesta = ControladorPasesDeSalida::ctrGuardarNuevoRecibo($datos);
        echo json_encode($respuesta);
    }

    public $guardarRetiroMerca;

    public function ajaxGuardarRetiroMerca() {
                session_start();
        $usuarioOp = $_SESSION["id"];

        $idRetAutorizado = $this->idRetAutorizado;
        $respuesta = ControladorPasesDeSalida::ctrGuardarRetiroMerca($idRetAutorizado, $usuarioOp);
        echo json_encode($respuesta);
    }

    public $mostrarSerEx;

    public function ajaxMostrarSerExtra() {
        $revExtrasPol = $this->revExtrasPol;
        $respuesta = ControladorPasesDeSalida::ctrMostrarSerExtra($revExtrasPol);
        echo json_encode($respuesta);
    }

}

if (isset($_POST["idRetCal"])) {
    $mostrarDataCalcUnidad = new AjaxPasesDeSalida();
    $mostrarDataCalcUnidad->idRetCal = $_POST["idRetCal"];
    $mostrarDataCalcUnidad->idIngresoCal = $_POST["idIngresoCal"];
    $mostrarDataCalcUnidad->hiddenDateTimeVal = $_POST["hiddenDateTimeVal"];
    $mostrarDataCalcUnidad->ajaxMostrarCalculoDatosUnidad();
}


if (isset($_POST["idNumRetConsult"])) {
    $consultDatoRet = new AjaxPasesDeSalida();
    $consultDatoRet->idNumRetConsult = $_POST["idNumRetConsult"];
    $consultDatoRet->ajaxConsultDatosRet();
}

if (isset($_POST["idRetDatosGen"])) {
    $datosConsult = new AjaxPasesDeSalida();
    $datosConsult->idRetDatosGen = $_POST["idRetDatosGen"];
    $datosConsult->ajaxConsultaDatosGen();
}

if (isset($_POST["idRetGdRec"])) {
    $guardarRecAlm = new AjaxPasesDeSalida();
    $guardarRecAlm->idRetGdRec = $_POST["idRetGdRec"];
    $guardarRecAlm->hiddenresultIdIngresoGdRec = $_POST["hiddenresultIdIngresoGdRec"];
    $guardarRecAlm->listaOtrosGdRec = $_POST["listaOtrosGdRec"];
    $guardarRecAlm->listaServiciosDefaultGdRec = $_POST["listaServiciosDefaultGdRec"];
    $guardarRecAlm->valDescuentoGdRec = $_POST["valDescuentoGdRec"];
    $guardarRecAlm->hiddenDescuentoGdRec = $_POST["hiddenDescuentoGdRec"];
    $guardarRecAlm->hiddenDateTimeValRecEle = $_POST["hiddenDateTimeValRecEle"];
    $guardarRecAlm->ajaxGuardarNuevoRecibo();
}

if (isset($_POST["idRetAutorizado"])) {
    $guardarRetiroMerca = new AjaxPasesDeSalida();
    $guardarRetiroMerca->idRetAutorizado = $_POST["idRetAutorizado"];
    $guardarRetiroMerca->ajaxGuardarRetiroMerca();
}

if (isset($_POST["revExtrasPol"])) {
    $mostrarSerEx = new AjaxPasesDeSalida();
    $mostrarSerEx->revExtrasPol = $_POST["revExtrasPol"];
    $mostrarSerEx->ajaxMostrarSerExtra();
}