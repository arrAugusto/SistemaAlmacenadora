<?php

require_once "../controlador/historiaIngresosFisacales.controlador.php";
require_once "../modelo/historiaIngresosFisacales.modelo.php";
//SESSION DE USUARIO PARA MANEJAR BITACORA
require_once "../controlador/usuario.controlador.php";
//CONTROLADOR Y MODELO DE CALCULOS
require_once "../controlador/calculoDeAlmacenaje.controlador.php";
require_once "../modelo/calculoDeAlmacenaje.modelo.php";

class AjaxAccionesIngresos {

    public $editarIngOP;

    public function ajaxEditarIngOperacion() {
        session_start();
        $rubros = 0;
        if ($_SESSION["departamentos"] == "Operaciones Fiscales" && $_SESSION["niveles"] == "MEDIO") {
            $rubros = 1;
        }

        $idIngEditOp = $this->idIngEditOp;
        $respuesta = ControladorHistorialIngresos::ctrEditarIngOperacion($idIngEditOp);
        $data = array("dataIng" => $respuesta, "tipo" => $rubros);
        echo json_encode($data);
    }

    public $editarIngreso;

    public function ajaxEditarIngresoOperacion() {
        $datos = array(
            "idIngresoEditado" => $idIngresoEditado = $this->idIngresoEditado,
            "cartaDeCupoEditOp" => $cartaDeCupoEditOp = $this->cartaDeCupoEditOp,
            "cantContenedoresEditOp" => $cantContenedoresEditOp = $this->cantContenedoresEditOp,
            "duaEditOp" => $duaEditOp = $this->duaEditOp,
            "blEditOp" => $blEditOp = $this->blEditOp,
            "polizaEditOp" => $polizaEditOp = $this->polizaEditOp,
            "bultosEditOp" => $bultosEditOp = $this->bultosEditOp,
            "puertoOrigenEditOp" => $puertoOrigenEditOp = $this->puertoOrigenEditOp,
            "cantClientesEditOp" => $cantClientesEditOp = $this->cantClientesEditOp,
            "productoEditOp" => $productoEditOp = $this->productoEditOp,
            "pesoIngEditOp" => $pesoIngEditOp = $this->pesoIngEditOp,
            "valorTotalAduanaEditOp" => $valorTotalAduanaEditOp = $this->valorTotalAduanaEditOp,
            "tipoDeCambioEditOp" => $tipoDeCambioEditOp = $this->tipoDeCambioEditOp,
            "totalValorCifEditOp" => $totalValorCifEditOp = $this->totalValorCifEditOp,
            "valorImpuestoEditOp" => $valorImpuestoEditOp = $this->valorImpuestoEditOp,
            "regimenPolizaEditOp" => $regimenPolizaEditOp = $this->regimenPolizaEditOp,
            "fechaIngEditOp" => $fechaIngEditOp = $this->fechaIngEditOp,
            "serviciosEditOp" => $serviciosEditOp = $this->serviciosEditOp
        );
        $respuesta = ControladorHistorialIngresos::ctrEditarIngresoOperacion($datos);
        echo json_encode($respuesta);
    }

    public $mostrarDetallesClientesPlts;

    public function ajaxmostrarDetallesClientesPlts() {
        session_start();
        $rubros = 0;
        if ($_SESSION["departamentos"] == "Operaciones Fiscales" && $_SESSION["niveles"] == "MEDIO") {
            $rubros = 1;
        }

        $idIngClientesPlt = $this->idIngClientesPlt;
        $repuesta = ControladorHistorialIngresos::ctrMostrarDetallesClientesPlts($idIngClientesPlt);
        $data = array("dataDet" => $repuesta, "tipo" => $rubros);
        echo json_encode($data);
    }

    public $anularIngreso;

    public function ajaxAnularIngreso() {
        session_start();
        $idIngresoAnulacion = $this->idIngresoAnulacion;
        $usuario = $_SESSION["id"];
        $departamento = $_SESSION["departamentos"];
        $nivel = $_SESSION["niveles"];
        $motivoAnula = $this->motivoAnula;
        $repuesta = ControladorHistorialIngresos::ctrAnularIngreso($idIngresoAnulacion, $usuario, $departamento, $nivel, $motivoAnula);
        echo json_encode($repuesta);
    }

    public $nuevoServices;

    public function ajaxNuevoServicies() {
        session_start();
        $usuario = $_SESSION["id"];
        $nuevoServicio = $this->nuevoServicio;
        $repuesta = ControladorHistorialIngresos::ctrInsertNuevoServicio($nuevoServicio, $usuario);
        echo json_encode($repuesta);
    }

    public $newListServicioS;

    public function ajaxNewServicioIng() {
        session_start();
        $usuario = $_SESSION["id"];
        $idIngSerOtr = $this->idIngSerOtr;
        $listaServOtr = $this->listaServOtr;
        $tipoOpera = $this->tipoOpera;
        $repuesta = ControladorHistorialIngresos::ctrNewServicioIng($usuario, $idIngSerOtr, $listaServOtr, $tipoOpera);
        echo json_encode($repuesta);
    }

    public $mostrarServEx;

    public function ajaxMostrarServicioExtra() {
        $verCobrado = $this->verCobrado;
        $repuesta = ControladorHistorialIngresos::ctrMostrarServicioExtra($verCobrado);
        echo json_encode($repuesta);
    }

    public $eliminarServicio;

    public function ajaxEliminarServicio() {
        $eliminarServicio = $this->eliminarServicio;
        $repuesta = ControladorHistorialIngresos::ctrEliminarServicio($eliminarServicio);
        echo json_encode($repuesta);
    }

    public $historiaIng;

    public function ajaxGenerateHistoriaIng() {
        $generateHistoriaIng = $this->generateHistoriaIng;
        $repuesta = ControladorHistorialIngresos::ctrGenerateHistoriaIng($generateHistoriaIng);
        echo json_encode($repuesta);
    }

    public $historiaRec;

    public function ajaxGenerateHistoriaRec() {
        $generateRecHistoria = $this->generateRecHistoria;
        $repuesta = ControladorHistorialIngresos::ctrGenerateHistoriaRec($generateRecHistoria);
        echo json_encode($repuesta);
    }

    public $historiaRet;

    public function ajaxGenerateHistoriaRet() {
        $generateRetHistoria = $this->generateRetHistoria;
        $repuesta = ControladorHistorialIngresos::ctrGenerateHistoriaRet($generateRetHistoria);
        echo json_encode($repuesta);
    }

    public $historiaChasis;

    public function ajaxGenerateHistoriaChasis() {
        $generateHistoriaChasis = $this->generateHistoriaChasis;
        $repuesta = ControladorHistorialIngresos::ctrGenerateHistoriaChasis($generateHistoriaChasis);
        echo json_encode($repuesta);        
    }

}

if (isset($_POST["idIngEditOp"])) {
    $editarIngOP = new AjaxAccionesIngresos();
    $editarIngOP->idIngEditOp = $_POST["idIngEditOp"];
    $editarIngOP->ajaxEditarIngOperacion();
}


if (isset($_POST["cartaDeCupoEditOp"])) {
    $editarIngreso = new AjaxAccionesIngresos();
    $editarIngreso->idIngresoEditado = $_POST["idIngresoEditado"];
    $editarIngreso->cartaDeCupoEditOp = $_POST["cartaDeCupoEditOp"];
    $editarIngreso->cantContenedoresEditOp = $_POST["cantContenedoresEditOp"];
    $editarIngreso->duaEditOp = $_POST["duaEditOp"];
    $editarIngreso->blEditOp = $_POST["blEditOp"];
    $editarIngreso->polizaEditOp = $_POST["polizaEditOp"];
    $editarIngreso->bultosEditOp = $_POST["bultosEditOp"];
    $editarIngreso->puertoOrigenEditOp = $_POST["puertoOrigenEditOp"];
    $editarIngreso->cantClientesEditOp = $_POST["cantClientesEditOp"];
    $editarIngreso->productoEditOp = $_POST["productoEditOp"];
    $editarIngreso->pesoIngEditOp = $_POST["pesoIngEditOp"];
    $editarIngreso->valorTotalAduanaEditOp = $_POST["valorTotalAduanaEditOp"];
    $editarIngreso->tipoDeCambioEditOp = $_POST["tipoDeCambioEditOp"];
    $editarIngreso->totalValorCifEditOp = $_POST["totalValorCifEditOp"];
    $editarIngreso->valorImpuestoEditOp = $_POST["valorImpuestoEditOp"];
    $editarIngreso->regimenPolizaEditOp = $_POST["regimenPolizaEditOp"];
    $editarIngreso->fechaIngEditOp = $_POST["fechaIngEditOp"];
    $editarIngreso->serviciosEditOp = $_POST["serviciosEditOp"];
    $editarIngreso->ajaxEditarIngresoOperacion();
}

if (isset($_POST["idIngClientesPlt"])) {
    $mostrarDetallesClientesPlts = new AjaxAccionesIngresos();
    $mostrarDetallesClientesPlts->idIngClientesPlt = $_POST["idIngClientesPlt"];
    $mostrarDetallesClientesPlts->ajaxmostrarDetallesClientesPlts();
}

if (isset($_POST["idIngresoAnulacion"])) {
    $anularIngreso = new AjaxAccionesIngresos();
    $anularIngreso->idIngresoAnulacion = $_POST["idIngresoAnulacion"];
    $anularIngreso->motivoAnula = $_POST["motivoAnula"];
    $anularIngreso->ajaxAnularIngreso();
}

if (isset($_POST["nuevoServicio"])) {
    $nuevoServices = new AjaxAccionesIngresos();
    $nuevoServices->nuevoServicio = $_POST["nuevoServicio"];
    $nuevoServices->ajaxNuevoServicies();
}


if (isset($_POST["idIngSerOtr"])) {
    $newListServicioS = new AjaxAccionesIngresos();
    $newListServicioS->idIngSerOtr = $_POST["idIngSerOtr"];
    $newListServicioS->listaServOtr = $_POST["listaServOtr"];
    $newListServicioS->tipoOpera = $_POST["tipoOpera"];
    $newListServicioS->ajaxNewServicioIng();
}

if (isset($_POST["verCobrado"])) {
    $mostrarServEx = new AjaxAccionesIngresos();
    $mostrarServEx->verCobrado = $_POST["verCobrado"];
    $mostrarServEx->ajaxMostrarServicioExtra();
}

if (isset($_POST["eliminarServicio"])) {
    $eliminarServicio = new AjaxAccionesIngresos();
    $eliminarServicio->eliminarServicio = $_POST["eliminarServicio"];
    $eliminarServicio->ajaxEliminarServicio();
}

if (isset($_POST["generateHistoriaIng"])) {
    $historiaIng = new AjaxAccionesIngresos();
    $historiaIng->generateHistoriaIng = $_POST["generateHistoriaIng"];
    $historiaIng->ajaxGenerateHistoriaIng();
}

if (isset($_POST["generateRecHistoria"])) {
    $historiaRec = new AjaxAccionesIngresos();
    $historiaRec->generateRecHistoria = $_POST["generateRecHistoria"];
    $historiaRec->ajaxGenerateHistoriaRec();
}

if (isset($_POST["generateRetHistoria"])) {
    $historiaRet = new AjaxAccionesIngresos();
    $historiaRet->generateRetHistoria = $_POST["generateRetHistoria"];
    $historiaRet->ajaxGenerateHistoriaRet();
}

if (isset($_POST["generateHistoriaChasis"])) {
    $historiaChasis = new AjaxAccionesIngresos();
    $historiaChasis->generateHistoriaChasis = $_POST["generateHistoriaChasis"];
    $historiaChasis->ajaxGenerateHistoriaChasis();
}