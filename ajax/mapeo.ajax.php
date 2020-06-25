<?php
require_once "../controlador/mapeo.controlador.php";
require_once "../modelo/mapeo.modelo.php";

class AjaxMapaDeBodegas {
public $nuevaBodega;
public function AjaxRegistrarNuevoMapa(){
  $datos = array(
  "pasillos" => $pasillos = $this->pasillos,
  "columnas" => $columnas = $this->columnas,
  "nuevArea" => $nuevArea = $this->nuevArea,
  "nuevDependencia" => $nuevDependencia = $this->nuevDependencia,
  "numeroBodega" => $numeroBodega = $this->numeroBodega,
  "listaUbInactiva" => $listaUbInactiva = $this->listaUbInactiva);
  $repuesta = ControladorMapaDeBodegas::ctrRegistrarNuevoMapa($datos);
echo json_encode($repuesta);
}
}
if (isset($_POST["pasillos"])) {

$nuevaBodega = new AjaxMapaDeBodegas();
$nuevaBodega ->pasillos = $_POST["pasillos"];
$nuevaBodega ->columnas = $_POST["columnas"];
$nuevaBodega ->nuevArea = $_POST["nuevArea"];
$nuevaBodega ->nuevDependencia = $_POST["nuevDependencia"];
$nuevaBodega ->numeroBodega = $_POST["numeroBodega"];
$nuevaBodega ->listaUbInactiva = $_POST["listaUbInactiva"];
$nuevaBodega->AjaxRegistrarNuevoMapa();

}
