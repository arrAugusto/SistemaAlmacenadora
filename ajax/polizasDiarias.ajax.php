<?php

require_once "../controlador/polizasDiarias.controlador.php";
require_once "../modelo/polizasDiarias.modelo.php";
//SESSION DE USUARIO PARA MANEJAR BITACORA
require_once "../controlador/usuario.controlador.php";

class AjaxGenerarContabilidad {

    public $polizaDiaria;

    public function ajaxGenerarPolizasDiarias() {
        $fechaContable = $this->fechaContable;
        /*
         *  Generar Poliza Contable Ingresos Zona Aduanera
         */
        $PolizaIngreso = ControladorGenerarContabilidad::ctrGenerarPolizasDiarias($fechaContable);
        $respuestaContabilidad = array();
        if ($PolizaIngreso != false && $PolizaIngreso != "SD") {
            $respuestaCuentas = ControladorGenerarContabilidad::ctrCtsContables();
        }
        $polizaIng = array("ctapolDefitiva" => $respuestaCuentas[0]["cuenta"], "polDefitiva" => $respuestaCuentas[0]["nombreDeCuenta"], "ctaImptsMerV" => $respuestaCuentas[1]["cuenta"], "ImptsMerV" => $respuestaCuentas[1]["nombreDeCuenta"], "ctaContra" => $respuestaCuentas[2]["cuenta"], "Contra" => $respuestaCuentas[2]["nombreDeCuenta"], "valCif" => $PolizaIngreso[0]["polDefinitiva"], "valImpuesto" => $PolizaIngreso[0]["impuestosFiscales"], "total" => $PolizaIngreso[0]["total"]);
        array_push($respuestaContabilidad, $polizaIng);
        echo json_encode($respuestaContabilidad);
    }

    public $contabilizarCierre;

    public function ajaxCierreContableDiario() {
        $cotabilizarFecha = $this->cotabilizarFecha;
                session_start();
                $hiddenIdBod = $_SESSION["idDeBodega"];
                
        $respCierre = ControladorGenerarContabilidad::ctrCierreContableDiario($cotabilizarFecha, $hiddenIdBod);
        echo json_encode($respCierre);
    }

    public $ultimaFecha;

    public function ajaxUltimaFecha() {
        $ultimaData = $this->ultimaData;
        if ($ultimaData==1) {
        $respuesta = ControladorGenerarContabilidad::ctrUltimaFecha();
        echo json_encode($respuesta);
        }
    }

}

if (isset($_POST["fechaContable"])) {
    $polizaDiaria = new AjaxGenerarContabilidad();
    $polizaDiaria->fechaContable = $_POST["fechaContable"];
    $polizaDiaria->ajaxGenerarPolizasDiarias();
}


if (isset($_POST["cotabilizarFecha"])) {
    $contabilizarCierre = new AjaxGenerarContabilidad();
    $contabilizarCierre->cotabilizarFecha = $_POST["cotabilizarFecha"];
    $contabilizarCierre->ajaxCierreContableDiario();
}

if (isset($_POST["ultimaData"])) {
    $ultimaFecha = new AjaxGenerarContabilidad();
    $ultimaFecha->ultimaData = $_POST["ultimaData"];
    $ultimaFecha->ajaxUltimaFecha();
}