<?php

require_once "../controlador/controlDeIngPersonas.controlador.php";
require_once "../modelo/controlDeIngPersonas.modelo.php";
//SESSION DE USUARIO PARA MANEJAR BITACORA
require_once "../controlador/usuario.controlador.php";

class AjaxVisitasAlmacenadoras {

    public $mostrarDatosIngreso;

    public function ajaxNuevaVisita() {
        session_start();
        $idBodegaNavega = $_SESSION["idDeBodega"];
        $usuarioOp = $_SESSION["id"];
        $procedencia = $this->procedencia;
        $destino = $this->destino;
        $placaVisita = $this->placaVisita;
        $listaVisitas = $this->listaVisitas;
        $gafete = $this->gafete;
        $respuesta = ControladorVisitasAlmacenadoras::ctrNuevaVisita($procedencia, $destino, $placaVisita, $listaVisitas, $gafete, $idBodegaNavega, $usuarioOp);
        echo json_encode($respuesta);
    }

}

/**
 * CAPTURANDO DATOS DE LA NUEVA VISITA PARA GUARDAR ESTADIA
 * * */
if (isset($_POST["procedencia"])) {
    $nuevaVisita = new AjaxVisitasAlmacenadoras();
    $nuevaVisita->procedencia = $_POST["procedencia"];
    $nuevaVisita->destino = $_POST["destino"];
    $nuevaVisita->placaVisita = $_POST["placaVisita"];
    $nuevaVisita->listaVisitas = $_POST["listaVisitas"];
    $nuevaVisita->gafete = $_POST["gafete"];
    $nuevaVisita->ajaxNuevaVisita();
}