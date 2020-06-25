<?php

require_once "../controlador/historialCalculos.controlador.php";
require_once "../modelo/historialCalculos.modelo.php";

require_once "../controlador/calculoDeAlmacenaje.controlador.php";
require_once "../modelo/calculoDeAlmacenaje.modelo.php";

/*
  REQUERIDO POR METODO CONSULTA DE LOTE Y VERIFICACION PARA CALCULO DE ALMACENAJE
 */
require_once "../modelo/retiroOpe.modelo.php";

require_once "../modelo/logicaDeCalculos.php";

require_once "../modelo/paseDeSalida.modelo.php";

class AjaxHistorialDeCalculos {

    public $mostrarCalculo;

    public function ajaxMostrarCalculo() {
        $viewCalculo = $this->viewCalculo;
        $viewIng = $this->viewIng;
        $respuesta = ControladorHistoriaDeIngresos::ctrMostrarCalculo($viewCalculo, $viewIng);
        echo json_encode($respuesta);
    }

    public $mostrarCalculoRecal;

    public  function ajaxMostrarCalculoRecal() {
        $fechRecalc = $this->fechRecalc;
        $idRetCalc = $this->idRetCalc;
        $idIngCalc = $this->idIngCalc;
        $respuesta = ControladorHistoriaDeIngresos::ctrMostrarCalculoRecalculo($fechRecalc, $idRetCalc, $idIngCalc);
        echo json_encode($respuesta);

        }

}

if (isset($_POST["viewCalculo"])) {
    $mostrarCalculo = new AjaxHistorialDeCalculos();
    $mostrarCalculo->viewCalculo = $_POST["viewCalculo"];
    $mostrarCalculo->viewIng = $_POST["viewIng"];
    $mostrarCalculo->ajaxMostrarCalculo();
}


if (isset($_POST["fechRecalc"])) {
    $mostrarCalculoRecal = new AjaxHistorialDeCalculos();
    $mostrarCalculoRecal->fechRecalc = $_POST["fechRecalc"];
    $mostrarCalculoRecal->idRetCalc = $_POST["idRetCalc"];
    $mostrarCalculoRecal->idIngCalc = $_POST["idIngCalc"];
    $mostrarCalculoRecal->ajaxMostrarCalculoRecal();
}