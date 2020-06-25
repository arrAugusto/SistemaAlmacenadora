<?php

require_once "../controlador/ingPendientesC.controlador.php";
require_once "../modelo/ingPendientesC.modelo.php";


class AjaxContabilidadFiscal {

    public $contabilizar;

    public function ajaxIngRegistroConta() {
        $idContabilizar=$this->idContabilizar;       
        $respuesta = ControladorGeneracionDeContabilidad::ctrIngRegistroConta($idContabilizar);
        echo json_encode($respuesta);
    }

}

if (isset($_POST["idContabilizar"])) {
    $contabilizar = new AjaxContabilidadFiscal();
    $contabilizar->idContabilizar = $_POST["idContabilizar"];
    $contabilizar->ajaxIngRegistroConta();
}