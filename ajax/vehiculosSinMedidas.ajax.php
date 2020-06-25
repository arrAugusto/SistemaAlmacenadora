<?php
require_once "../controlador/vehiculosSinMedidas.controlador.php";
require_once "../modelo/vehiculosSinMedidas.modelo.php";

class AjaxOperacionesNuevasMedias {
    public $guardarLineaVeh;
    public function ajaxGuardarNuevaMedida() {
    $idMedida=$this->idMedida;
    $vallargoMts=$this->vallargoMts;
    $valanchoMts=$this->valanchoMts;
    $valretrovisorIZ=$this->valretrovisorIZ;
    $valretrovisorDer=$this->valretrovisorDer;
    $valespacioFrontal=$this->valespacioFrontal;
    $valespacioLateral=$this->valespacioLateral;
        $respuesta = ControladorVehiculosSinMedidas::ctrGuardarNuevaMedida($idMedida, $vallargoMts, $valanchoMts, $valretrovisorIZ, $valretrovisorDer, $valespacioFrontal, $valespacioLateral);
        echo json_encode($respuesta);
    }

}

if (isset($_POST["idMedida"])) {
    $guardarLineaVeh = new AjaxOperacionesNuevasMedias();
    $guardarLineaVeh ->idMedida=$_POST["idMedida"];
    $guardarLineaVeh ->vallargoMts=$_POST["vallargoMts"];
    $guardarLineaVeh ->valanchoMts=$_POST["valanchoMts"];
    $guardarLineaVeh ->valretrovisorIZ=$_POST["valretrovisorIZ"];
    $guardarLineaVeh ->valretrovisorDer=$_POST["valretrovisorDer"];
    $guardarLineaVeh ->valespacioFrontal=$_POST["valespacioFrontal"];
    $guardarLineaVeh ->valespacioLateral=$_POST["valespacioLateral"];
    $guardarLineaVeh->ajaxGuardarNuevaMedida();
}
