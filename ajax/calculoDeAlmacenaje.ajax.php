<?php

require_once "../controlador/calculoDeAlmacenaje.controlador.php";
require_once "../modelo/calculoDeAlmacenaje.modelo.php";

/*
  REQUERIDO POR METODO CONSULTA DE LOTE Y VERIFICACION PARA CALCULO DE ALMACENAJE
 */
require_once "../modelo/retiroOpe.modelo.php";

require_once "../modelo/logicaDeCalculos.php";

require_once "../modelo/paseDeSalida.modelo.php";
//SESSION DE USUARIO PARA MANEJAR BITACORA
require_once "../controlador/usuario.controlador.php";

class AjaxCalculoDeAlmacenaje {

    public function ajaxPrepararCalculo() {
        session_start();
        $usuarioOp = $_SESSION["id"];
        $datos = array(
            "idCalculoAlmacenaje" => $idCalculoAlmacenaje = $this->idCalculoAlmacenaje,
            "hiddenIdNitSalida" => $hiddenIdNitSalida = $this->hiddenIdNitSalida,
            "hiddenIdentificador" => $hiddenIdentificador = $this->hiddenIdentificador,
            "calculoTxtNitSalida" => $calculoTxtNitSalida = $this->calculoTxtNitSalida,
            "calculoTxtNombreSalida" => $calculoTxtNombreSalida = $this->calculoTxtNombreSalida,
            "calculoTxtDireccionSalida" => $calculoTxtDireccionSalida = $this->calculoTxtDireccionSalida,
            "calculoPolizaRetiro" => $calculoPolizaRetiro = $this->calculoPolizaRetiro,
            "calculoRegimen" => $calculoRegimen = $this->calculoRegimen,
            "calculoValorTAduana" => $calculoValorTAduana = $this->calculoValorTAduana,
            "calculoCambio" => $calculoCambio = $this->calculoCambio,
            "calculoValorCif" => $calculoValorCif = $this->calculoValorCif,
            "calculoValorImpuesto" => $calculoValorImpuesto = $this->calculoValorImpuesto,
            "calculoPesoKg" => $calculoPesoKg = $this->calculoPesoKg,
            "calculoCantBultos" => $calculoCantBultos = $this->calculoCantBultos,
            "hiddenDateTime" => $hiddenDateTime = $this->hiddenDateTime,
            "hiddenEstadoCalculo" => $hiddenEstadoCalculo = $this->hiddenEstadoCalculo,
            "usuarioOp" =>$usuarioOp
        );
        $respuesta = controladorCalculoDeAlmacenaje::ctrPrepararCalculo($datos);
        echo json_encode($respuesta);
    }

    public $verificarMostrarTarifa;

    public function ajaxverificarMostrarTarifa() {
        $calculoTextParamBusqRet = $this->calculoTextParamBusqRet;
        $respuesta = ControladorCalculoDeAlmacenaje::ctrVerificarMostrarTarifa($calculoTextParamBusqRet);
        echo json_encode($respuesta);
    }

    public $mostrarCalculosRealizados;

    public function ajaxCalculosRealizados() {
        $idIngresoCalculo = $this->idIngresoCalculo;
        $respuesta = ControladorCalculoDeAlmacenaje::ctrCalculosRealizados($idIngresoCalculo);
        echo json_encode($respuesta);
    }

    public $gdSerExtra;

    public function ajaxOtrosServiciosExtraGd() {
        $otrosExtra = $this->otrosExtra;
        $listaDefaultExtra = $this->listaDefaultExtra;
        $hiddenDescuento = $this->hiddenDescuento;
        $polizaExtraSer = $this->polizaExtraSer;
        $valCalculado = $this->valCalculado;
        $hiddenTipoOP = $this->hiddenTipoOP;
        $estado = 1;
        $idRetCal = 0;
        $respuesta = ControladorCalculoDeAlmacenaje::ctrOtrosServiciosExtraGd($otrosExtra, $listaDefaultExtra, $hiddenDescuento, $polizaExtraSer, $valCalculado, $hiddenTipoOP, $estado, $idRetCal);
        echo json_encode($respuesta);
    }
    public $existPoliza;     
    public function ajaxExistePoliza(){
        $verPoliza = $this->verPoliza;
        $respuesta = ControladorCalculoDeAlmacenaje::ctrExistePoliza($verPoliza);
        echo json_encode($respuesta);       
    }
}

if (isset($_POST["idCalculoAlmacenaje"])) {
    $prepararCalculo = new AjaxCalculoDeAlmacenaje();
    $prepararCalculo->idCalculoAlmacenaje = $_POST["idCalculoAlmacenaje"];
    $prepararCalculo->calculoTxtNitSalida = $_POST["calculoTxtNitSalida"];
    $prepararCalculo->calculoTxtNombreSalida = $_POST["calculoTxtNombreSalida"];
    $prepararCalculo->calculoTxtDireccionSalida = $_POST["calculoTxtDireccionSalida"];
    $prepararCalculo->calculoPolizaRetiro = $_POST["calculoPolizaRetiro"];
    $prepararCalculo->calculoRegimen = $_POST["calculoRegimen"];
    $prepararCalculo->calculoValorTAduana = $_POST["calculoValorTAduana"];
    $prepararCalculo->calculoCambio = $_POST["calculoCambio"];
    $prepararCalculo->calculoValorCif = $_POST["calculoValorCif"];
    $prepararCalculo->calculoValorImpuesto = $_POST["calculoValorImpuesto"];
    $prepararCalculo->calculoPesoKg = $_POST["calculoPesoKg"];
    $prepararCalculo->calculoCantBultos = $_POST["calculoCantBultos"];
    $prepararCalculo->hiddenDateTime = $_POST["hiddenDateTime"];
    $prepararCalculo->hiddenIdNitSalida = $_POST["hiddenIdNitSalida"];
    $prepararCalculo->hiddenIdentificador = $_POST["hiddenIdentificador"];
    $prepararCalculo->hiddenEstadoCalculo = $_POST["hiddenEstadoCalculo"];
    $prepararCalculo->ajaxPrepararCalculo();
}

if (isset($_POST["calculoTextParamBusqRet"])) {
    $verificarMostrarTarifa = new AjaxCalculoDeAlmacenaje();
    $verificarMostrarTarifa->calculoTextParamBusqRet = $_POST["calculoTextParamBusqRet"];
    $verificarMostrarTarifa->ajaxverificarMostrarTarifa();
}


if (isset($_POST["idIngresoCalculo"])) {
    $mostrarCalculosRealizados = new AjaxCalculoDeAlmacenaje();
    $mostrarCalculosRealizados->idIngresoCalculo = $_POST["idIngresoCalculo"];
    $mostrarCalculosRealizados->ajaxCalculosRealizados();
}


if (isset($_POST["otrosExtra"])) {
    $gdSerExtra = new AjaxCalculoDeAlmacenaje();
    $gdSerExtra->otrosExtra = $_POST["otrosExtra"];
    $gdSerExtra->listaDefaultExtra = $_POST["listaDefaultExtra"];
    $gdSerExtra->hiddenDescuento = $_POST["hiddenDescuento"];
    $gdSerExtra->polizaExtraSer = $_POST["polizaExtraSer"];
    $gdSerExtra->valCalculado = $_POST["valCalculado"];
    $gdSerExtra->hiddenTipoOP = $_POST["hiddenTipoOP"];
    
    
    $gdSerExtra->ajaxOtrosServiciosExtraGd();
}

if (isset($_POST["verPoliza"])) {
    $existPoliza = new AjaxCalculoDeAlmacenaje();
    $existPoliza->verPoliza=$_POST["verPoliza"];
    $existPoliza->ajaxExistePoliza();
}

