<?php

require_once "../controlador/polizasDiarias.controlador.php";
require_once "../modelo/polizasDiarias.modelo.php";


class AjaxGenerarContabilidad {

    public $polizaDiaria;

    public function ajaxGenerarPolizasDiarias() {
       $fechaContable = $this->fechaContable;
       /*
        *  Generar Poliza Contable Ingresos Zona Aduanera
        */
     $PolizaIngreso = ControladorGenerarContabilidad::ctrGenerarPolizasDiarias($fechaContable);
     $respuestaContabilidad = array();
    if ($PolizaIngreso!=false && $PolizaIngreso!="SD") {
         $respuestaCuentas = ControladorGenerarContabilidad::ctrCtsContables();
     }
     $polizaIng = array("ctapolDefitiva"=>$respuestaCuentas[0]["cuenta"], "polDefitiva"=>$respuestaCuentas[0]["nombreDeCuenta"], "ctaImptsMerV"=>$respuestaCuentas[1]["cuenta"], "ImptsMerV"=>$respuestaCuentas[1]["nombreDeCuenta"], "ctaContra"=>$respuestaCuentas[2]["cuenta"], "Contra"=>$respuestaCuentas[2]["nombreDeCuenta"],  "valCif"=>$PolizaIngreso[0]["polDefinitiva"], "valImpuesto"=>$PolizaIngreso[0]["impuestosFiscales"], "total"=>$PolizaIngreso[0]["total"]);
     array_push($respuestaContabilidad, $polizaIng);
     echo json_encode($respuestaContabilidad);
    }

}

if (isset($_POST["fechaContable"])) {
    $polizaDiaria = new AjaxGenerarContabilidad();
    $polizaDiaria->fechaContable = $_POST["fechaContable"];
    $polizaDiaria->ajaxGenerarPolizasDiarias();
}
