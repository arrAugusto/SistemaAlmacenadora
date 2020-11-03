<?php

require_once "../controlador/retiroBod.controlador.php";
require_once "../modelo/retiroBod.modelo.php";

require_once "../controlador/retiroOpe.controlador.php";
require_once "../modelo/retiroOpe.modelo.php";

require_once "../controlador/ingresosPendientes.controlador.php";
require_once "../modelo/ingresosPendientes.modelo.php";

//SESSION DE USUARIO PARA MANEJAR BITACORA
require_once "../controlador/usuario.controlador.php";

class AjaxRetiroBodega {

    public $detalle;

    public function AjaxMostrarDetalle() {
        $idIngreso = $this->idIngreso;
        $idRetiro = $this->idRetiro;
        $respuesta = ControladorRetirosBodega::ctrMostrarDetalle($idIngreso, $idRetiro);
        
        echo json_encode($respuesta);
    }

    public $guardaDetalleRet;

    public function ajaxGuardaDetalleRet() {
        $datos = array(
            "hiddenidIngreso" => $hiddenidIngreso = $this->hiddenidIngreso,
            "hiddenidRetiro" => $hiddenidRetiro = $this->hiddenidRetiro,
            "txtPosicioensRet" => $txtPosicioensRet = $this->txtPosicioensRet,
            "txtMetrosRet" => $txtMetrosRet = $this->txtMetrosRet
        );
                session_start();
        $usuarioOp = $_SESSION["id"];
        $respuesta = ControladorRetirosBodega::ctrGuardaDetalleRet($datos, $usuarioOp);
        echo json_encode($respuesta);
    }

    public $sumaSaldos;

    public function ajaxSumaSaldos() {
        $idIngOpDet = $this->idIngOpDet;
        $respuesta = ControladorRetirosBodega::ctrSumaSaldos($idIngOpDet);
        echo json_encode($respuesta);
    }

    public $detallesSalidaMerca;

    public function ajaxDetallesSalidaMerca() {
        $valIdRet = $this->valIdRet;
        $respuesta = ControladorRetirosBodega::ctrDetallesSalidaMerca($valIdRet);
        echo json_encode($respuesta);
    }

    public $guardarDetalleSalida;

    public function ajaxGuardarDetalleSalida() {
        $idRet = $this->idRetGD;
        $idDeta = $this->idDetaGD;
        $valPosSalida = $this->valPosSalidaGD;
        $valMtsSalida = $this->valMtsSalidaGD;
        session_start();
        $usuarioOp = $_SESSION["id"];
        $respuesta = ControladorRetirosBodega::ctrGuardarDetalleSalida($idDeta, $idRet, $valPosSalida, $valMtsSalida, $usuarioOp);
        echo json_encode($respuesta);
    }

    public $accionDetalle;

    public function ajaxAccionDetalle() {
        $tipoEditG = $this->tipoEditG;
        $idRetEdit = $this->idRetEdit;
        $idDetaEdit = $this->idDetaEdit;
        $valPosSalidaEdit = $this->valPosSalidaEdit;
        $valMtsSalidaEdit = $this->valMtsSalidaEdit;
                        session_start();
        $usuarioOp = $_SESSION["id"];
        $respuesta = ControladorRetirosBodega::ctrAccionDetalle($tipoEditG, $idRetEdit, $idDetaEdit, $valPosSalidaEdit, $valMtsSalidaEdit, $usuarioOp);
        echo json_encode($respuesta);
    }

    public $mostrarUbicacion;

    public function ajaxMostrarUbicacion() {
        $idDetalle = $this->idDetalle;
        $respuesta = ControladorRetirosBodega::ctrMostrarUbicacion($idDetalle);
        echo json_encode($respuesta);
    }

    public $gdMarchamoSal;

    public function ajaxNewMarchamoPlt() {
                session_start();
        $usuarioOp = $_SESSION["id"];
        $idPlt = $this->idRetPltNew;
        $marchamoSal = $this->marchamoSalNew;
        $idRetNewMarc = $this->idRetNewMarc;
        $guardarMarchamo = ControladorRetirosBodega::ctrNewMarchamoPltGD($idPlt, $marchamoSal, $idRetNewMarc, $usuarioOp);
        if ($guardarMarchamo[0]["resp"] == 1) {
            $estado = true;
        }else{
            $estado = false;
        }
        
        $respRev = ControladorRetirosBodega::ctrNewMarchamoPlt($idRetNewMarc, $usuarioOp);

        if ($respRev==true) {
            
            $respRet = ModeloRetirosBodega::mdlGuardaDetalleRet($idRetNewMarc, $usuarioOp);

            if ($respRet == "oksReb") {
                $estado = true;
            }
        }
echo json_encode($estado);


    }

    public $editMarchamoSal;

    public function ajaxEditMarchamoPlt() {
                        session_start();
        $usuarioOp = $_SESSION["id"];
        $idRetNewMarc = $this->idRetEditMar;
        $idPltEdit = $this->idPltEdit;
        $marchamoEdit = $this->marchamoEdit;
        $guardarMarchamo = ControladorRetirosBodega::ctrEditMarchamoPlt($idPltEdit, $marchamoEdit);
        if ($guardarMarchamo[0]["resp"] == 1) {
            $estado = true;
        }else{
            $estado = false;
        }
        
         $respRev = ControladorRetirosBodega::ctrNewMarchamoPlt($idRetNewMarc, $usuarioOp);

         if ($respRev==true) {
            
            $respRet = ModeloRetirosBodega::mdlGuardaDetalleRet($idRetNewMarc, $usuarioOp);

            if ($respRet == "oksReb") {
                $estado = true;
            }
        }
            echo json_encode($respRev);
       
        
    }

    public $trashMarchamoSal;

    public function ajaxCancelMarchamoPlt() {
        $idPltTrash = $this->idPltTrash;
        $resp = ControladorRetirosBodega::ctrCancelMarchamoPlt($idPltTrash);
        echo json_encode($resp);
    }

}

if (isset($_POST["idIngreso"])) {
    $detalle = new AjaxRetiroBodega();
    $detalle->idIngreso = $_POST["idIngreso"];
    $detalle->idRetiro = $_POST["idRetiro"];
    $detalle->AjaxMostrarDetalle();
}

if (isset($_POST["hiddenidIngreso"])) {
    $guardaDetalleRet = new AjaxRetiroBodega();
    $guardaDetalleRet->hiddenidIngreso = $_POST["hiddenidIngreso"];
    $guardaDetalleRet->hiddenidRetiro = $_POST["hiddenidRetiro"];
    $guardaDetalleRet->txtPosicioensRet = $_POST["txtPosicioensRet"];
    $guardaDetalleRet->txtMetrosRet = $_POST["txtMetrosRet"];
    $guardaDetalleRet->ajaxGuardaDetalleRet();
}

if (isset($_POST["idIngOpDet"])) {
    $sumaSaldos = new AjaxRetiroBodega();
    $sumaSaldos->idIngOpDet = $_POST["idIngOpDet"];
    $sumaSaldos->ajaxSumaSaldos();
}

if (isset($_POST["valIdRet"])) {
    $detallesSalidaMerca = new AjaxRetiroBodega();
    $detallesSalidaMerca->valIdRet = $_POST["valIdRet"];
    $detallesSalidaMerca->ajaxDetallesSalidaMerca();
}

if (isset($_POST["idRetGD"])) {
    $guardarDetalleSalida = new AjaxRetiroBodega();
    $guardarDetalleSalida->idRetGD = $_POST["idRetGD"];
    $guardarDetalleSalida->valPosSalidaGD = $_POST["valPosSalidaGD"];
    $guardarDetalleSalida->valMtsSalidaGD = $_POST["valMtsSalidaGD"];
    $guardarDetalleSalida->idDetaGD = $_POST["idDetaGD"];
    $guardarDetalleSalida->ajaxGuardarDetalleSalida();
}

if (isset($_POST["tipoEditG"])) {
    $accionDetalle = new AjaxRetiroBodega();
    $accionDetalle->tipoEditG = $_POST["tipoEditG"];
    $accionDetalle->idRetEdit = $_POST["idRetEdit"];
    $accionDetalle->idDetaEdit = $_POST["idDetaEdit"];
    $accionDetalle->valPosSalidaEdit = $_POST["valPosSalidaEdit"];
    $accionDetalle->valMtsSalidaEdit = $_POST["valMtsSalidaEdit"];
    $accionDetalle->ajaxAccionDetalle();
}

if (isset($_POST["idDetalle"])) {
    $mostrarUbicacion = new AjaxRetiroBodega();
    $mostrarUbicacion->idDetalle = $_POST["idDetalle"];
    $mostrarUbicacion->ajaxMostrarUbicacion();
}


if (isset($_POST["idRetPltNew"])) {
    $gdMarchamoSal = new AjaxRetiroBodega();
    $gdMarchamoSal->idRetPltNew = $_POST["idRetPltNew"];
    $gdMarchamoSal->marchamoSalNew = $_POST["marchamoSalNew"];
    $gdMarchamoSal->idRetNewMarc = $_POST["idRetNewMarc"];
    $gdMarchamoSal->ajaxNewMarchamoPlt();
}

if (isset($_POST["idPltEdit"])) {
    $editMarchamoSal = new AjaxRetiroBodega();
    $editMarchamoSal->idRetEditMar=$_POST["idRetEditMar"];
    $editMarchamoSal->idPltEdit = $_POST["idPltEdit"];
    $editMarchamoSal->marchamoEdit = $_POST["marchamoEdit"];
    $editMarchamoSal->ajaxEditMarchamoPlt();
}

if (isset($_POST["idPltTrash"])) {
    $trashMarchamoSal = new AjaxRetiroBodega();
    $trashMarchamoSal->idPltTrash = $_POST["idPltTrash"];
    $trashMarchamoSal->ajaxCancelMarchamoPlt();
}