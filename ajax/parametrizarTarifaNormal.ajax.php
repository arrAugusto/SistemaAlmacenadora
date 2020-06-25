<?php

require_once "../controlador/parametrizarTarifaNormal.controlador.php";
require_once "../modelo/parametrizarTarifaNormal.modelo.php";

class AjaxParametrizarTarifaNormal {

    public $AjaxMostrarServiciosTarifaNormal;

    public function AjaxMostrarServiciosTarifaNormal() {
        $AjaxMostrarServiciosTarifaNormal = $this->AjaxMostrarServiciosTarifaNormal;
        $respuesta = controladorParametrizarTarifaNormal::ctrParametrizarTarifaNormal($AjaxMostrarServiciosTarifaNormal);
        echo json_encode($respuesta);
    }

    public $CrearTarifaNormal;

    public function AjaxCrearTarifaNormal() {



$datos=array(
"lblNit" => $this ->lblNit,
"lblEmpresa" => $this ->lblEmpresa,
"lblDireccion" => $this ->lblDireccion,
"baseCalculoAlmacenaje" => $this->baseCalculoAlmacenaje, 
"periodoCalculoAlmacenaje" => $this->periodoCalculoAlmacenaje, 
"valorAlmacenaje" => $this->valorAlmacenaje, 
"baseCalculoZA" => $this->baseCalculoZA, 
"periodoCalculoZA" => $this->periodoCalculoZA, 
"valorZA" => $this->valorZA, 
"basePeso" => $this->basePeso, 
"valorPeso" => $this->valorPeso, 
"baseGastosAdmin" => $this->baseGastosAdmin, 
"valorGastosAdmin" => $this->valorGastosAdmin, 
"baseFotocopias" => $this->baseFotocopias, 
"valorFotocopias" => $this->valorFotocopias, 
"calculocargaDescarga"=>$this->calculocargaDescarga,
"valorcargaDescarga"=>$this->valorcargaDescarga,
"calculoOtrosGastos" => $this->calculoOtrosGastos,
"valorOtrosGastos" => $this->valorOtrosGastos,
"fecha_creacion"=> ['2019/05/31'],
"fecha_Vegencia"=> ['2019/05/31'],
"fecha_Vencimiento"=> ['2019/05/31']);


        $respuesta = controladorParametrizarTarifaNormal::ctrCrearTarifaNormal($datos);
        echo json_encode($respuesta);


    }

    public $consultaEmpresa;

    public function AjaxConsultaEmpresa() {
        $consultaEmpresa = $this->consultaEmpresa;
        $respuesta = controladorParametrizarTarifaNormal::ctrConsultaEmpresa($consultaEmpresa);
        echo json_encode($respuesta);
    }

}

if (isset($_POST["consultaNitNomal"])) {
    $AjaxMostrarServiciosTarifaNormal = new AjaxParametrizarTarifaNormal();
    $AjaxMostrarServiciosTarifaNormal->AjaxMostrarServiciosTarifaNormal = $_POST["consultaNitNomal"];
    $AjaxMostrarServiciosTarifaNormal->AjaxMostrarServiciosTarifaNormal();
}

if (isset($_POST["valorAlmacenaje"])) {
$CrearTarifaNormal = new AjaxParametrizarTarifaNormal();

$CrearTarifaNormal->lblNit = $_POST['lblNit'];
$CrearTarifaNormal->lblEmpresa = $_POST['lblEmpresa'];
$CrearTarifaNormal->lblDireccion = $_POST['lblDireccion'];
$CrearTarifaNormal->baseCalculoAlmacenaje = $_POST['baseCalculoAlmacenaje'];
$CrearTarifaNormal->periodoCalculoAlmacenaje = $_POST['periodoCalculoAlmacenaje'];
$CrearTarifaNormal->valorAlmacenaje = $_POST['valorAlmacenaje'];
$CrearTarifaNormal->baseCalculoZA = $_POST['baseCalculoZA'];
$CrearTarifaNormal->periodoCalculoZA = $_POST['periodoCalculoZA'];
$CrearTarifaNormal->valorZA = $_POST['valorZA'];
$CrearTarifaNormal->basePeso = $_POST['basePeso'];
$CrearTarifaNormal->valorPeso = $_POST['valorPeso'];
$CrearTarifaNormal->baseGastosAdmin = $_POST['baseGastosAdmin'];
$CrearTarifaNormal->valorGastosAdmin = $_POST['valorGastosAdmin'];
$CrearTarifaNormal->baseFotocopias = $_POST['baseFotocopias'];
$CrearTarifaNormal->valorFotocopias = $_POST['valorFotocopias'];
$CrearTarifaNormal->calculoOtrosGastos = $_POST['calculoOtrosGastos'];
$CrearTarifaNormal->valorOtrosGastos = $_POST['valorOtrosGastos'];
$CrearTarifaNormal->calculocargaDescarga=$_POST['calculocargaDescarga'];
$CrearTarifaNormal->valorcargaDescarga=$_POST['valorcargaDescarga'];

$CrearTarifaNormal->AjaxCrearTarifaNormal();
}

if (isset($_POST["consultaEmpresa"])) {
    $consultaEmpresa = new AjaxParametrizarTarifaNormal();
    $consultaEmpresa->consultaEmpresa = $_POST["consultaEmpresa"];
    $consultaEmpresa->AjaxConsultaEmpresa();
}
