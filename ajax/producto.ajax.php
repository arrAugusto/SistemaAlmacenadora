
<?php
require_once "../controlador/cotizacion.controlador.php";
require_once "../modelo/cotizacion.modelo.php";

class AjaxProductos{

/*generar codigo a partir de codigo idcategoria*/
public $idCategoria;
public function ajaxConsultaEmpresa(){

$item = "id";
$valor = $this->idCategoria;
$perfil = "externo";
$respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor, $perfil);

echo json_encode($respuesta);
}

/*Insert segunda fase*/
public $segundaFase;
public function ajaxOtrosServicios(){


echo json_encode($respuesta);
}
}

/*generar codigo a partir de codigo objeto*/

if(isset($_POST["idCategoria"])){

	$codigoNit = new AjaxProductos();
	$codigoNit -> idCategoria = $_POST["idCategoria"];
	$codigoNit -> ajaxConsultaEmpresa();
}


/*si existe variable*/

if(isset($_POST["idServicio"])){

$segundaFase = new AjaxProductos();
$segundaFase -> segundaFase = $_POST["idServicio"];
$segundaFase -> idServicio=$_POST["idServicio"];
$segundaFase -> calculoSobreSeguro=$_POST["calculoSobreSeguro"];
$segundaFase -> baseCalculo=$_POST["baseCalculo"];
$segundaFase -> periodoCalculo=$_POST["periodoCalculo"];
$segundaFase -> monedaSeguro  = $_POST["monedaSeguro"];
$segundaFase -> valorSeguro=$_POST["valorSeguro"];
$segundaFase -> basePeso=$_POST["basePeso"];
$segundaFase -> monedaPeso=$_POST["monedaPeso"];
$segundaFase -> valorPeso=$_POST["valorPeso"];
$segundaFase -> valorGastosAdmin=$_POST["valorGastosAdmin"];
$segundaFase -> monedaSeguro=$_POST["monedaSeguro"];
$segundaFase -> valorSeguro=$_POST["valorSeguro"];
$segundaFase -> calculoOtrosGastos=$_POST["calculoOtrosGastos"];
$segundaFase -> monedaOtrosGastos=$_POST["monedaOtrosGastos"];
$segundaFase -> valorOtrosGastos=$_POST["valorOtrosGastos"];


	$segundaFase -> ajaxOtrosServicios();
}
