<?php

require_once "../controlador/historiaIngresosFisacales.controlador.php";
require_once "../modelo/historiaIngresosFisacales.modelo.php";
//SESSION DE USUARIO PARA MANEJAR BITACORA
require_once "../controlador/usuario.controlador.php";
//CONTROLADOR Y MODELO DE CALCULOS
require_once "../controlador/calculoDeAlmacenaje.controlador.php";
require_once "../modelo/calculoDeAlmacenaje.modelo.php";
//REGISTRO AJAX PARA USAR EL ALGORITMO DE LLAVE PRIVADA
require_once "../controlador/registroIngresoBodega.controlador.php";
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
        $respuesta = ControladorHistorialIngresos::ctrMostrarDetallesClientesPlts($idIngClientesPlt);
        $data = array("dataDet" => $respuesta, "tipo" => $rubros);
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
        $respuesta = ControladorHistorialIngresos::ctrAnularIngreso($idIngresoAnulacion, $usuario, $departamento, $nivel, $motivoAnula);
        echo json_encode($respuesta);
    }

    public $nuevoServices;

    public function ajaxNuevoServicies() {
        session_start();
        $usuario = $_SESSION["id"];
        $nuevoServicio = $this->nuevoServicio;
        $respuesta = ControladorHistorialIngresos::ctrInsertNuevoServicio($nuevoServicio, $usuario);
        echo json_encode($respuesta);
    }

    public $newListServicioS;

    public function ajaxNewServicioIng() {
        session_start();
        $usuario = $_SESSION["id"];
        $idIngSerOtr = $this->idIngSerOtr;
        $listaServOtr = $this->listaServOtr;
        $tipoOpera = $this->tipoOpera;
        $respuesta = ControladorHistorialIngresos::ctrNewServicioIng($usuario, $idIngSerOtr, $listaServOtr, $tipoOpera);
        echo json_encode($respuesta);
    }

    public $mostrarServEx;

    public function ajaxMostrarServicioExtra() {
        $verCobrado = $this->verCobrado;
        $respuesta = ControladorHistorialIngresos::ctrMostrarServicioExtra($verCobrado);
        echo json_encode($respuesta);
    }

    public $eliminarServicio;

    public function ajaxEliminarServicio() {
        $eliminarServicio = $this->eliminarServicio;
        $respuesta = ControladorHistorialIngresos::ctrEliminarServicio($eliminarServicio);
        echo json_encode($respuesta);
    }

    public $historiaIng;

    public function ajaxGenerateHistoriaIng() {
        session_start();
        $valor = $_SESSION["idDeBodega"];
        $generateHistoriaIng = $this->generateHistoriaIng;
        $respuesta = ControladorHistorialIngresos::ctrGenerateHistoriaIng($generateHistoriaIng, $valor);
        echo json_encode($respuesta);
    }

    public $historiaRec;

    public function ajaxGenerateHistoriaRec() {
        $generateRecHistoria = $this->generateRecHistoria;
        $respuesta = ControladorHistorialIngresos::ctrGenerateHistoriaRec($generateRecHistoria);
        echo json_encode($respuesta);
    }

    public $historiaRet;

    public function ajaxGenerateHistoriaRet() {
        session_start();

        $valor = $_SESSION["idDeBodega"];
        $generateRetHistoria = $this->generateRetHistoria;
        $respuesta = ControladorHistorialIngresos::ctrGenerateHistoriaRet($generateRetHistoria, $valor);
        echo json_encode($respuesta);
    }

    public $historiaChasis;

    public function ajaxGenerateHistoriaChasis() {
        $generateHistoriaChasis = $this->generateHistoriaChasis;
        $respuesta = ControladorHistorialIngresos::ctrGenerateHistoriaChasis($generateHistoriaChasis);
        echo json_encode($respuesta);
    }

    public $historiaRecEx;

    public function ajaxGenerateHistoriaRecEx() {
        $generateRecExHistoria = $this->generateRecExHistoria;
        $respuesta = ControladorHistorialIngresos::ctrGenerateHistoriaRecEx($generateRecExHistoria);
        echo json_encode($respuesta);
    }

    public $chasisVeh;

    public function ajaxMostrarChasisVh() {
        $EditChasisVh = $this->EditChasisVh;
        $respuesta = ControladorHistorialIngresos::ctrMostrarChasisVh($EditChasisVh);
        echo json_encode($respuesta);
    }

    public $chasisVehEdt;

    public function ajaxEdicionVehEdit() {
        $idChasEdit = $this->idChasEdit;
        $chasisNewEdt = $this->chasisNewEdt;
        $tipoLineaVeh = $this->tipoLineaVeh;
        $respuesta = ControladorHistorialIngresos::ctrEditarChasisVeh($idChasEdit, $chasisNewEdt, $tipoLineaVeh);
        echo json_encode($respuesta);
    }

    public $editarBltsIng;

    public function ajaxEditarBltsIng() {
        $idIngEditCuadreBlts = $this->idIngEditCuadreBlts;
        $totalBultosPol = $this->totalBultosPol;
        $listaDetallesBltsPso = $this->listaDetallesBltsPso;
        $respuesta = ControladorHistorialIngresos::ctrEditarBltsIng($idIngEditCuadreBlts, $totalBultosPol, $listaDetallesBltsPso);
        echo json_encode($respuesta);
    }

    public $editarUbica;

    public function ajaxEditUbicaBodega() {
        $newBod = $this->newBod;
        $ingNewBod = $this->ingNewBod;
        $respuesta = ControladorHistorialIngresos::ctrEditUbicaBodega($newBod, $ingNewBod);
        echo json_encode($respuesta);
    }

    public $histVehNew;

    public function ajaxDescargaExelVeh() {
        $generateExcelVehiNew = $this->generateExcelVehiNew;
        $respuesta = ControladorHistorialIngresos::ctrDescargaExelVeh($generateExcelVehiNew);
        echo json_encode($respuesta);
    }

    //mostrar todos lo ingresos
    public $todosIng;

    public function ajaxTodosIngHistorial() {
        session_start();
        $valor = $_SESSION["idDeBodega"];
        if ($_SESSION['departamentos'] == 'Operaciones Fiscales') {
            if ($_SESSION['niveles'] == 'BAJO') {
                $tipo = "B1";
            }
            if ($_SESSION['niveles'] == 'MEDIO') {
                $tipo = "M1";
            }
        } else if ($_SESSION['departamentos'] == 'Bodegas Fiscales') {
            if ($_SESSION['niveles'] == 'MEDIO') {
                $tipo = "BodM";
            } else {
                $tipo = "Bod";
            }
        } else {
            $tipo = "General";
        }
        $respuesta = ControladorHistorialIngresos::ctrTodosIngHistorial($valor);
        echo json_encode(array($respuesta, $tipo));
    }

    public $polizaHist;

    public function ajaxMstPolIng() {
        session_start();
        $valor = $_SESSION["idDeBodega"];
        if ($_SESSION['departamentos'] == 'Operaciones Fiscales') {
            if ($_SESSION['niveles'] == 'BAJO') {
                $tipo = "B1";
            }
            if ($_SESSION['niveles'] == 'MEDIO') {
                $tipo = "M1";
            }
        } else if ($_SESSION['departamentos'] == 'Bodegas Fiscales') {
            if ($_SESSION['niveles'] == 'MEDIO') {
                $tipo = "BodM";
            } else {
                $tipo = "Bod";
            }
        } else {
            $tipo = "General";
        }
        $polizaIngHistBusq = $this->polizaIngHistBusq;
        $respuesta = ControladorHistorialIngresos::ctrMstPolIng($valor, $polizaIngHistBusq);
        echo json_encode(array($respuesta, $tipo));
    }

    public $paramFechaHist;

    public function ajaxParametrosFechaHis() {
        session_start();
        $valor = $_SESSION["idDeBodega"];
        if ($_SESSION['departamentos'] == 'Operaciones Fiscales') {
            if ($_SESSION['niveles'] == 'BAJO') {
                $tipo = "B1";
            }
            if ($_SESSION['niveles'] == 'MEDIO') {
                $tipo = "M1";
            }
        } else if ($_SESSION['departamentos'] == 'Bodegas Fiscales') {
            if ($_SESSION['niveles'] == 'MEDIO') {
                $tipo = "BodM";
            } else {
                $tipo = "Bod";
            }
        } else {
            $tipo = "General";
        }

        $fechaIng = $this->fechaIng;
        $fechaFin = $this->fechaFin;
        $respuesta = ControladorHistorialIngresos::ctrParametrosFechaHis($valor, $fechaIng, $fechaFin);
        echo json_encode(array($respuesta, $tipo));
    }

    public $inveExcel;

    public function ajaxMostrarInvetarioExcel() {
        session_start();
        $valor = $_SESSION["idDeBodega"];
        $respuesta = ControladorHistorialIngresos::ctrMostrarInvetarioExcel($valor);
        echo json_encode($respuesta);
    }

    public $validarLlave;

    public function ajaxValidarLlave() {
        $validarIngOP = $this->validarIngOP;
        $respuesta = ControladorHistorialIngresos::ctrValidarLlaveIng($validarIngOP);
        echo json_encode($respuesta);
    }

    public $polizaData;

    public function ajaxPolizaRet() {
        $polizaData = $this->polizaData;
        $respuesta = ControladorHistorialIngresos::ctrPolizaRet($polizaData);
        echo json_encode($respuesta);
    }

    public $revisarPol;

    public function ajaxRevisionPol() {
        $objRevPol = $this->objRevPol;
        session_start();
        $usuario = $_SESSION["id"];        
        $respuesta = ControladorHistorialIngresos::ctrRevisionPol($objRevPol, $usuario);
        echo json_encode($respuesta);
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

if (isset($_POST["generateRecExHistoria"])) {
    $historiaRecEx = new AjaxAccionesIngresos();
    $historiaRecEx->generateRecExHistoria = $_POST["generateRecExHistoria"];
    $historiaRecEx->ajaxGenerateHistoriaRecEx();
}
if (isset($_POST["EditChasisVh"])) {
    $chasisVeh = new AjaxAccionesIngresos();
    $chasisVeh->EditChasisVh = $_POST["EditChasisVh"];
    $chasisVeh->ajaxMostrarChasisVh();
}

if (isset($_POST["idChasEdit"])) {
    $chasisVehEdt = new AjaxAccionesIngresos();
    $chasisVehEdt->idChasEdit = $_POST["idChasEdit"];
    $chasisVehEdt->chasisNewEdt = $_POST["chasisNewEdt"];
    $chasisVehEdt->tipoLineaVeh = $_POST["tipoLineaVeh"];
    $chasisVehEdt->ajaxEdicionVehEdit();
}

if (isset($_POST["idIngEditCuadreBlts"])) {
    $editarBltsIng = new AjaxAccionesIngresos();
    $editarBltsIng->idIngEditCuadreBlts = $_POST["idIngEditCuadreBlts"];
    $editarBltsIng->totalBultosPol = $_POST["totalBultosPol"];
    $editarBltsIng->listaDetallesBltsPso = $_POST["listaDetallesBltsPso"];
    $editarBltsIng->ajaxEditarBltsIng();
}


if (isset($_POST["newBod"])) {
    $editarUbica = new AjaxAccionesIngresos();
    $editarUbica->newBod = $_POST["newBod"];
    $editarUbica->ingNewBod = $_POST["ingNewBod"];
    $editarUbica->ajaxEditUbicaBodega();
}

if (isset($_POST["generateExcelVehiNew"])) {
    $histVehNew = new AjaxAccionesIngresos();
    $histVehNew->generateExcelVehiNew = $_POST["generateExcelVehiNew"];
    $histVehNew->ajaxDescargaExelVeh();
}


if (isset($_POST["generarTodosLosIng"])) {
    $todosIng = new AjaxAccionesIngresos();
    $todosIng->generarTodosLosIng = $_POST["generarTodosLosIng"];
    $todosIng->ajaxTodosIngHistorial();
}

if (isset($_POST["polizaIngHistBusq"])) {
    $polizaHist = new AjaxAccionesIngresos();
    $polizaHist->polizaIngHistBusq = $_POST["polizaIngHistBusq"];
    $polizaHist->ajaxMstPolIng();
}

if (isset($_POST["fechaIng"])) {
    $paramFechaHist = new AjaxAccionesIngresos();
    $paramFechaHist->fechaIng = $_POST["fechaIng"];
    $paramFechaHist->fechaFin = $_POST["fechaFin"];
    $paramFechaHist->ajaxParametrosFechaHis();
}
if (isset($_POST["descargaExcelInventario"])) {
    $inveExcel = new AjaxAccionesIngresos();
    $inveExcel->descargaExcelInventario = $_POST["descargaExcelInventario"];
    $inveExcel->ajaxMostrarInvetarioExcel();
}


if (isset($_POST["validarIngOP"])) {
    $validarLlave = new AjaxAccionesIngresos();
    $validarLlave->validarIngOP = $_POST["validarIngOP"];
    $validarLlave->ajaxValidarLlave();
}

if (isset($_POST["polizaData"])) {
    $polizaData = new AjaxAccionesIngresos();
    $polizaData->polizaData = $_POST["polizaData"];
    $polizaData->ajaxPolizaRet();
}

if (isset($_POST["objRevPol"])) {
    $revisarPol = new AjaxAccionesIngresos();
    $revisarPol->objRevPol = $_POST["objRevPol"];
    $revisarPol->ajaxRevisionPol();
}