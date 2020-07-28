<?php

require_once "../controlador/ingPendientesC.controlador.php";
require_once "../modelo/ingPendientesC.modelo.php";
//SESSION DE USUARIO PARA MANEJAR BITACORA
require_once "../controlador/usuario.controlador.php";
//SESSION DE USUARIO PARA MANEJAR BITACORA
require_once "../controlador/usuario.controlador.php";


class AjaxContabilidadFiscal {

    public $contabilizar;

    public function ajaxIngRegistroConta() {
    session_start();
    $usuarioOp = $_SESSION["id"];
        $idContabilizar=$this->idContabilizar;
        $fechaCongeladaConta = $this->fechaCongeladaConta;
        $respuesta = ControladorGeneracionDeContabilidad::ctrIngRegistroConta($idContabilizar, $fechaCongeladaConta, $usuarioOp);
        echo json_encode($respuesta);
    }

}

if (isset($_POST["idContabilizar"])) {
    
    $contabilizar = new AjaxContabilidadFiscal();
    $contabilizar->idContabilizar = $_POST["idContabilizar"];
    $contabilizar->fechaCongeladaConta=$_POST["fechaCongeladaConta"];
    $contabilizar->ajaxIngRegistroConta();
}