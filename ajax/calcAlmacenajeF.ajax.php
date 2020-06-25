<?php

require_once "../controlador/calcAlmacenajeF.controlador.php";
require_once "../modelo/calcAlmacenajeF.modelo.php";
require_once "../modelo/logicaDeCalculos.php";

require_once "../controlador/retiroOpe.controlador.php";
require_once "../modelo/retiroOpe.modelo.php";

class AjaxCalculosFical {

    public $mostrarDatosIngreso;

    public function ajaxMostrarDatosIngreso() {
        $buttonidingreso = $this->buttonidingreso;
        $respuesta = ControladorCalculos::ctrCalculosAlmacenajesEspeciales($buttonidingreso);
        echo json_encode($respuesta);
    }

    public $mostrarEmpresaFactura;

    public function ajaxMostrarNit() {
        $resultIdIngreso = $this->resultIdIngreso;
        $respuesta = ControladorCalculos::ctrMostrarNit($resultIdIngreso);
        echo json_encode($respuesta);
    }

    public $cambiarNit;

    public function ajaxCambiarNitFact() {
        $textNitFactura = $this->textNitFactura;
        $respuesta = ControladorRetiroOpe::ctrMostrarNitRetiro($textNitFactura);
        $ejecutivoCredito = $respuesta[0]["nt"];
        $respuestaEjecutivo = ControladorCalculos::ctrMostrarEjecutivoCredito($ejecutivoCredito);
        $data = array($respuesta, $respuestaEjecutivo);
        echo json_encode($data);
    }

    public $guardarRecibo;

    public function ajaxGuardarReciboAlmacenaje() {
        $hiddenresultIdIngreso = $this->hiddenresultIdIngreso;
        $respuesta = ControladorCalculos::ctrGuardarReciboAlmacenaje($hiddenresultIdIngreso);
        echo json_encode($respuesta);
    }

    public $guardarAlmacenaje;

    public function ajaxGuardarAlmacenaje() {
        $idIngAlmacenajeF = $this->idIngAlmacenajeF;
        $listaServiciosDefault = $this->listaServiciosDefault;
        $listaOtros = $this->listaOtros;
        $valDescuento = $this->valDescuento;
        $hiddenDescuento = $this->hiddenDescuento;
        $hiddenDateTimeValCorte = $this->hiddenDateTimeValCorte;
        $respuesta = ControladorCalculos::ctrGuardarAlmacenaje($idIngAlmacenajeF, $listaServiciosDefault, $listaOtros, $valDescuento, $hiddenDescuento, $hiddenDateTimeValCorte);
        echo json_encode($respuesta);
    }

    public $recalcularAlmacenaje;

    public function ajaxRecalcularAlmacenaje() {
        $fechaCalcEsp = $this->fechaCalcEsp;
        $idIngCambio = $this->idIngCambio;
        $respuesta = ControladorCalculos::ctrRecalculaAlmacenaje($fechaCalcEsp, $idIngCambio);
    /*    if ($respuesta["tipo"]=="factCorteCobro") {
          $ultimoCorte = $respuesta["corteCobrado"];
          $respuesta = ControladorCalculos::ctrRecalculoVariosCortes($ultimoCorte, );
            echo json_encode($ultimoCorte);
        }else{
        echo json_encode($respuesta);
            
        }*/
            echo json_encode($respuesta);
    }

}

if (isset($_POST["buttonidingreso"])) {
    $mostrarDatosIngreso = new AjaxCalculosFical();
    $mostrarDatosIngreso->buttonidingreso = $_POST["buttonidingreso"];
    $mostrarDatosIngreso->ajaxMostrarDatosIngreso();
}

if (isset($_POST['resultIdIngreso'])) {
    $mostrarEmpresaFactura = new AjaxCalculosFical();
    $mostrarEmpresaFactura->resultIdIngreso = $_POST['resultIdIngreso'];
    $mostrarEmpresaFactura->ajaxMostrarNit();
}

if (isset($_POST["textNitFactura"])) {
    $cambiarNit = new AjaxCalculosFical();
    $cambiarNit->textNitFactura = $_POST["textNitFactura"];
    $cambiarNit->ajaxCambiarNitFact();
}

if (isset($_POST["hiddenresultIdIngreso"])) {
    $guardarRecibo = new AjaxCalculosFical();
    $guardarRecibo->hiddenresultIdIngreso = $_POST["hiddenresultIdIngreso"];
    $guardarRecibo->ajaxGuardarReciboAlmacenaje();
}


if (isset($_POST["idIngAlmacenajeF"])) {
    $guardarAlmacenaje = new AjaxCalculosFical();
    $guardarAlmacenaje->idIngAlmacenajeF = $_POST["idIngAlmacenajeF"];
    $guardarAlmacenaje->listaServiciosDefault = $_POST["listaServiciosDefault"];
    $guardarAlmacenaje->listaOtros = $_POST["listaOtros"];
    $guardarAlmacenaje->valDescuento = $_POST["valDescuento"];
    $guardarAlmacenaje->hiddenDescuento = $_POST["hiddenDescuento"];
    $guardarAlmacenaje->hiddenDateTimeValCorte = $_POST["hiddenDateTimeValCorte"];
    $guardarAlmacenaje->ajaxGuardarAlmacenaje();
}

if (isset($_POST["fechaCalcEsp"])) {
    $recalcularAlmacenaje = new AjaxCalculosFical();
    $recalcularAlmacenaje->fechaCalcEsp = $_POST["fechaCalcEsp"];
    $recalcularAlmacenaje->idIngCambio = $_POST["idIngCambio"];
    $recalcularAlmacenaje->ajaxRecalcularAlmacenaje();
}