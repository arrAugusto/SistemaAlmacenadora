<?php

require_once "../controlador/retiroVeh.controlador.php";
require_once "../modelo/retiroVeh.modelo.php";
//CASTEO DE DATA
require_once "../controlador/revisionDeData.controlador.php";
//REQUIRE CREATOR QR 
require_once "../extensiones/qrCodeCreate/vendor/autoload.php";

class AjaxAccionesVehiculosNuevos {

    public $estadoVeh;

    public function ajaxAccionEstadoVeh() {
        $estado = $this->estado;
        $identChas = $this->identChas;
        $tipo = $this->tipo;
        $respuesta = ControladorRetirosRebajados::ctrAccionEstadoVeh($estado * 1, $identChas * 1, $tipo * 1);
        echo json_encode($respuesta);
    }

    public $reversionChasis;

    public function ajaxReversionChasis() {
        $idNewChas = $this->idNewChas;
        $idAntChasis = $this->idAntChasis;
        if (is_numeric($idNewChas) && is_numeric($idAntChasis)) {
            $respuesta = ControladorRetirosRebajados::ctrReversionChasis($idNewChas * 1, $idAntChasis * 1);
            echo json_encode($respuesta);
        }
    }

    public $chasisCorreo;

    public function ajaxPreparCorreo() {
        $chasisCorreo = $this->chasisCorreo;
        $respuesta = ControladorRetirosRebajados::ctrPreparCorreo($chasisCorreo);
        echo json_encode($respuesta);
    }

    public $gdCorreoChas;

    public function ajaxGuardarVehCorreo() {
        $guardarCorreo = $this->guardarCorreo;
        $respuesta = ControladorRetirosRebajados::ctrGuardarVehCorreo($guardarCorreo);
        echo json_encode($respuesta);
    }

    public $gdPrimaryEmp;

    public function ajaxNewEmpresaGPO() {
        $gdEmpresaPrimary = $this->gdEmpresaPrimary;
        $respuesta = ControladorRetirosRebajados::ctrNewEmpresaGPO($gdEmpresaPrimary);
        echo json_encode($respuesta);
    }

    public $mostrarGrupoVeh;

    public function ajaxMostrarGrupoEmpresasVeh() {
        $idEmpresaGPO = $this->idEmpresaGPO;
        $respuesta = ControladorRetirosRebajados::ctrMostrarGrupoEmpresasVeh($idEmpresaGPO);
        echo json_encode($respuesta);
    }

    public $guardarNewempresa;

    public function ajaxGuardarNewEmpresaAlGP() {
        $idNitUnion = $this->idNitUnion;
        $idEmpresaUnion = $this->idEmpresaUnion;
        $respuesta = ControladorRetirosRebajados::ctrGuardarNewEmpresaAlGP($idNitUnion, $idEmpresaUnion);
        echo json_encode($respuesta);
    }

    public $gdIdChasVeh;

    public function ajaxGdChasisIdVeh() {
        $idContaChas = $this->idContaChas;
        $fechaContableChas = $this->fechaContableChas;
        $respuesta = ControladorRetirosRebajados::ctrGdChasisIdVeh($idContaChas, $fechaContableChas);
        echo json_encode($respuesta);
    }

}

if (isset($_POST["estado"])) {
    $estadoVeh = new AjaxAccionesVehiculosNuevos();
    $estadoVeh->estado = $_POST["estado"];
    $estadoVeh->identChas = $_POST["identChas"];
    $estadoVeh->tipo = $_POST["tipo"];
    $estadoVeh->ajaxAccionEstadoVeh();
}

if (isset($_POST["idNewChas"])) {
    $reversionChasis = new AjaxAccionesVehiculosNuevos();
    $reversionChasis->idNewChas = $_POST["idNewChas"];
    $reversionChasis->idAntChasis = $_POST["idAntChasis"];
    $reversionChasis->ajaxReversionChasis();
}
if (isset($_POST["chasisCorreo"])) {
    $chasisCorreo = new AjaxAccionesVehiculosNuevos();
    $chasisCorreo->chasisCorreo = $_POST["chasisCorreo"];
    $chasisCorreo->ajaxPreparCorreo();
}

if (isset($_POST["guardarCorreo"])) {
    $gdCorreoChas = new AjaxAccionesVehiculosNuevos();
    $gdCorreoChas->guardarCorreo = $_POST["guardarCorreo"];
    $gdCorreoChas->ajaxGuardarVehCorreo();
}

if (isset($_POST["gdEmpresaPrimary"])) {
    $gdPrimaryEmp = new AjaxAccionesVehiculosNuevos();
    $gdPrimaryEmp->gdEmpresaPrimary = $_POST["gdEmpresaPrimary"];
    $gdPrimaryEmp->ajaxNewEmpresaGPO();
}

if (isset($_POST["idEmpresaGPO"])) {
    $mostrarGrupoVeh = new AjaxAccionesVehiculosNuevos();
    $mostrarGrupoVeh->idEmpresaGPO = $_POST["idEmpresaGPO"];
    $mostrarGrupoVeh->ajaxMostrarGrupoEmpresasVeh();
}

if (isset($_POST["idNitUnion"])) {
    $guardarNewempresa = new AjaxAccionesVehiculosNuevos();
    $guardarNewempresa->idNitUnion = $_POST["idNitUnion"];
    $guardarNewempresa->idEmpresaUnion = $_POST["idEmpresaUnion"];
    $guardarNewempresa->ajaxGuardarNewEmpresaAlGP();
}
if (isset($_POST["idContaChas"])) {
    $gdIdChasVeh = new AjaxAccionesVehiculosNuevos();
    $gdIdChasVeh->idContaChas = $_POST["idContaChas"];
    $gdIdChasVeh->fechaContableChas = $_POST["fechaContableChas"];
    $gdIdChasVeh->ajaxGdChasisIdVeh();
}