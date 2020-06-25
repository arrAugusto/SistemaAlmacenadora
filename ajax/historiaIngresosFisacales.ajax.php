<?php

require_once "../controlador/historiaIngresosFisacales.controlador.php";
require_once "../modelo/historiaIngresosFisacales.modelo.php";

class AjaxAccionesIngresos {

    public $editarIngOP;

    public function ajaxEditarIngOperacion() {
        $idIngEditOp = $this->idIngEditOp;
            $respuesta = ControladorHistorialIngresos::ctrEditarIngOperacion($idIngEditOp);
        echo json_encode($respuesta);
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
            "serviciosEditOp"=>$serviciosEditOp = $this->serviciosEditOp
            
        );
        $respuesta = ControladorHistorialIngresos::ctrEditarIngresoOperacion($datos);
        echo json_encode($respuesta);
    }
public $mostrarDetallesClientesPlts;
public function ajaxmostrarDetallesClientesPlts(){
    $idIngClientesPlt = $this->idIngClientesPlt;
    $repuesta = ControladorHistorialIngresos::ctrMostrarDetallesClientesPlts($idIngClientesPlt);
    echo json_encode($repuesta);
}
public $anularIngreso;
   public function ajaxAnularIngreso(){
       $idIngresoAnulacion=$this->idIngresoAnulacion;
       $repuesta = ControladorHistorialIngresos::ctrAnularIngreso($idIngresoAnulacion);
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
    $mostrarDetallesClientesPlts -> idIngClientesPlt = $_POST["idIngClientesPlt"];
    $mostrarDetallesClientesPlts ->ajaxmostrarDetallesClientesPlts();
}

if (isset($_POST["idIngresoAnulacion"])) {
   $anularIngreso =  new AjaxAccionesIngresos();
   $anularIngreso->idIngresoAnulacion=$_POST["idIngresoAnulacion"];
   $anularIngreso->ajaxAnularIngreso();
}