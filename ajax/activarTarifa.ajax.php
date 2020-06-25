<?php

require_once "../controlador/cotizacion.controlador.php";
require_once "../modelo/cotizacion.modelo.php";

require_once "../controlador/activarParaCobro.controlador.php";
require_once "../modelo/activarParaCobro.modelo.php";

class AjaxNuevaTarifa {

    public $idServicio;

    public function AjaxIngresarNuevoServicio() {
                date_default_timezone_set('America/Guatemala');
        $date = date('Y-m-d');
        $tabla = "ALMACENAJES";
        $idServicio = $this->idServicio;
        $idNit = $this->idNit;
        $calculosobre = $this->calculosobre;
        $baseCalculo = $this->baseCalculo;
        $periodoCobro = $this->periodoCobro;
        $moneda = $this->moneda;
        $valorAlmacenaje = $this->valorAlmacenaje;
        $aplica = '1';
        $estado = '1';
        $fechaCreacion = $date;
        $serie = '11111';
        $datos = array("idServicio" => $idServicio, "idNit" => $idNit, "calculosobre" => $calculosobre, "baseCalculo" => $baseCalculo, "periodoCobro" => $periodoCobro, "moneda" => $moneda, "valorAlmacenaje" => $valorAlmacenaje, "aplica" => $aplica, "fechaCreacion" => $fechaCreacion, "estado" => $estado, "serie" => $serie);
        $respuesta = controladorServicios::ctrNuevoTarifa($tabla, $datos);
        echo json_encode($respuesta);
    }

    public $mostrarUsuarios;

    public function ajaxMostrarUsuarios() {
        $valor = $this->ejecutivo;
        $respuesta = ControladorActivarParaCobro::ctrActivarParaCobro($valor);
        echo json_encode($respuesta);
    }

    public $mostrarServicios;

    public function ajaxMostarServicios() {
        $valor = $this->idClienteServicio;
        $respuesta = ControladorActivarParaCobro::ctrMostrarServicios($valor);
        echo json_encode($respuesta);
    }

    public $ActivarNuevaTarifa;

    public function AjaxNuevaTarifaActivacion() {
        $idCliente = $this->ActivarNuevaTarifa;
        $numeroSerie = $this->numeroSerie;
        $idParaActivar = $this->idParaActivar;
        $respuesta = ControladorActivarParaCobro::ctrActivarServicios($idCliente, $numeroSerie, $idParaActivar);

        echo json_encode($respuesta);
    }

    public $nuevaSerieTarifa;

    public function AjaxNuevaSerie() {
        $serieTarifa = $this->serieTarifa;
        $numeroCliente = $this->numeroCliente;

        $respuesta = ControladorActivarParaCobro::ctrNuevaSerie($serieTarifa, $numeroCliente);
        echo json_encode($respuesta);
    }

    public $MostrarServiciosIndividual;

    public function AjaxMostrarServiciosIndividual() {
        $idServicioCliente = $this->idServicioCliente;
        $Tabla = $this->Tabla;

        $respuesta = ControladorActivarParaCobro::ctrMostrarServiciosIndividual($idServicioCliente, $Tabla);

        echo json_encode($respuesta);
    }

    public $modificacionIndividual;

    public function AjaxSeviciosInidividuales() {
        $numeroServicio = $this->numeroServicio;
        $numeroId = $this->numeroId;
        $servicioId = $this->servicioId;

        $respuesta = ControladorActivarParaCobro::ctrServiciosIndividuales($numeroServicio, $numeroId, $servicioId);
        echo json_encode($respuesta);
    }

    public $modificacionIndividualSeguro;

    public function AjaxServicioIndividualSeguro() {

        $modificacionIndividualSeguro = $this->modificacionIndividualSeguro;
        $respuesta = ControladorActivarParaCobro::ctrServicioIndividualSeguro($modificacionIndividualSeguro);
        echo json_encode($respuesta);
    }

    public $modificarCalculoSobreSeguro;

    public function AjaxModificacionCalculoSobreSeguro() {
        $numeroidtarifa = $this->numeroidtarifa;
        $nombreServicio = $this->servicioId1;
        $numeroServicio = $this->numeroServicio;
        $respuesta = ControladorActivarParaCobro::ctrModificacionCalculoSobreSeguro($numeroidtarifa, $nombreServicio, $numeroServicio);
        echo json_encode($respuesta);
    }

    public $mostrarCaloSobreManejo;

    public function AjaxModificacionCalculoSobreManejo() {
        $edicionServicioManejo = $this->edicionServicioManejo;
        $respuesta = ControladorActivarParaCobro::ctrModificacionCalculoSobreManejo($edicionServicioManejo);

        echo json_encode($respuesta);
    }

    public $modificacionSobreManejo;

    public function AjaxModificacionManejo() {

        $numeroServicioManejo = $this->numeroServicioManejo;
        $nombreServicioManejo = $this->nombreServicioManejo;
        $numeroTarifaManejo = $this->numeroTarifaManejo;

        $respuesta = ControladorActivarParaCobro::ctrModificacionManejo($numeroServicioManejo, $nombreServicioManejo, $numeroTarifaManejo);

        echo json_encode($respuesta);
    }

    public $mostrarGastosAdmin;

    public function AjaxMostarServicioGastosAdmin() {
        $idServicioClienteGtsAdmin = $this->idServicioClienteGtsAdmin;

        $respuesta = ControladorActivarParaCobro::ctrMostarServicioGastosAdmin($idServicioClienteGtsAdmin);
        echo json_encode($respuesta);
    }

    public $modificacionSobreGtsAdmin;

    public function AjaxModificacionGtsAdmin() {
        $numeroServicioGtsAdmin = $this->numeroServicioGtsAdmin;
        $nombreServicioGtsAdmin = $this->nombreServicioGtsAdmin;
        $numeroTarifaGtsAdmin = $this->numeroTarifaGtsAdmin;
        $respuesta = ControladorActivarParaCobro::ctrModificacionGtsAdmin($numeroServicioGtsAdmin, $nombreServicioGtsAdmin, $numeroTarifaGtsAdmin);

        echo json_encode($respuesta);
    }

    public $mostrarOtrosGastos;

    public function AjaxMostarServicioOtrosGastos() {
        $idServicioClienteOtrosGastos = $this->idServicioClienteOtrosGastos;
        $respuesta = ControladorActivarParaCobro::ctrMostarServicioOtrosGastos($idServicioClienteOtrosGastos);
        echo json_encode($respuesta);
    }

    public $mostrarEditarOtrosGastos;

    public function AjaxModificacionOtrosGastos() {

        $numeroServicioOtrosGastos = $this->numeroServicioOtrosGastos;
        $nombreServicioOtrosGastos = $this->nombreServicioOtrosGastos;
        $numeroTarifaOtrosGastos = $this->numeroTarifaOtrosGastos;
        $respuesta = ControladorActivarParaCobro::ctrModificacionOtrosGastos($numeroServicioOtrosGastos, $nombreServicioOtrosGastos, $numeroTarifaOtrosGastos);
        echo json_encode($respuesta);
    }

    public $recuperarServiciosAnulacionFila;

    public function AjaxAnulacionFila() {
        $idNumeroServicio = $this->idNumeroServicio;
        $idNumeroFilaCliente = $this->idNumeroFilaCliente;
        $botonelminarfila = $this->botonelminarfila;

        $respuesta = ControladorActivarParaCobro::ctrAnulacionFila($idNumeroServicio, $idNumeroFilaCliente, $botonelminarfila);

        echo json_encode($respuesta);
    }

    public $reactivarCliente;

    public function AjaxreactivarCliente() {
        $idNitActivar = $this->idNitActivar;
        $respuesta = ControladorActivarParaCobro::ctrreactivarCliente($idNitActivar);
        echo json_encode($respuesta);
    }

    public $ClienteIdAnularTotal;

    public function AjaxClienteIdAnularTotal() {
        $lblClienteIdAnularTotal = $this->lblClienteIdAnularTotal;
        $lblNitAnularTotal = $this->lblNitAnularTotal;

        $respuesta = ControladorActivarParaCobro::ctrClienteIdAnularTotal($lblClienteIdAnularTotal, $lblNitAnularTotal);
        echo json_encode($respuesta);
    }

}

/* =============================================
  SI EXISTE idServicio, EJECUTA METODOS
  ============================================= */
if (isset($_POST["idServicio"])) {

    $idServicio = new AjaxNuevaTarifa();
    $idServicio->idServicio = $_POST["idServicio"];
    $idServicio->idNit = $_POST["idNit"];
    $idServicio->calculosobre = $_POST["calculosobre"];
    $idServicio->baseCalculo = $_POST["baseCalculo"];
    $idServicio->periodoCobro = $_POST["periodoCobro"];
    $idServicio->moneda = $_POST["moneda"];
    $idServicio->valorAlmacenaje = $_POST["valorAlmacenaje"];
    $idServicio->AjaxIngresarNuevoServicio();
}



/* si existe variable ejecutivo */
if (isset($_POST["ejecutivo"])) {
    $mostrarUsuarios = new AjaxNuevaTarifa();
    $mostrarUsuarios->ejecutivo = $_POST["ejecutivo"];
    $mostrarUsuarios->ajaxMostrarUsuarios();
}

/* * * si existe la variable idCliente entonces ejecutar clase y funcion */
if (isset($_POST["idCliente"])) {
    $mostrarServicios = new AjaxNuevaTarifa();
    $mostrarServicios->idClienteServicio = $_POST["idCliente"];
    $mostrarServicios->ajaxMostarServicios();
}

if (isset($_POST["idNuevaTarifa"])) {
    $ActivarNuevaTarifa = new AjaxNuevaTarifa();
    $ActivarNuevaTarifa->ActivarNuevaTarifa = $_POST["idNuevaTarifa"];
    $ActivarNuevaTarifa->numeroSerie = $_POST["numeroSerie"];
    $ActivarNuevaTarifa->idParaActivar = $_POST["idParaActivar"];

    $ActivarNuevaTarifa->AjaxNuevaTarifaActivacion();
}

if (isset($_POST["serieTarifa"])) {
    $nuevaSerieTarifa = new AjaxNuevaTarifa();
    $nuevaSerieTarifa->serieTarifa = $_POST["serieTarifa"];
    $nuevaSerieTarifa->numeroCliente = $_POST["numeroCliente"];
    $nuevaSerieTarifa->AjaxNuevaSerie();
}
if (isset($_POST["idServicioCliente"])) {
    $MostrarServiciosIndividual = new AjaxNuevaTarifa();
    $MostrarServiciosIndividual->idServicioCliente = $_POST["idServicioCliente"];
    $MostrarServiciosIndividual->Tabla = "ALMACENAJES";
    $MostrarServiciosIndividual->AjaxMostrarServiciosIndividual();
}

if (isset($_POST["numeroId"])) {
    $modificacionIndividual = new AjaxNuevaTarifa();
    $modificacionIndividual->numeroServicio = $_POST["numeroServicio"];
    $modificacionIndividual->numeroId = $_POST["numeroId"];
    $modificacionIndividual->servicioId = $_POST["servicioId"];
    $modificacionIndividual->AjaxSeviciosInidividuales();
}

if (isset($_POST["idServicioClienteSeguro"])) {
    $modificacionIndividualSeguro = new AjaxNuevaTarifa();
    $modificacionIndividualSeguro->modificacionIndividualSeguro = $_POST["idServicioClienteSeguro"];
    $modificacionIndividualSeguro->AjaxServicioIndividualSeguro();
}


if (isset($_POST["numeroidtarifa"])) {
    $modificarCalculoSobreSeguro = new AjaxNuevaTarifa();
    $modificarCalculoSobreSeguro->numeroidtarifa = $_POST["numeroidtarifa"];
    $modificarCalculoSobreSeguro->servicioId1 = $_POST["servicioId1"];
    $modificarCalculoSobreSeguro->numeroServicio = $_POST["numeroServicio"];
    $modificarCalculoSobreSeguro->AjaxModificacionCalculoSobreSeguro();
}

if (isset($_POST["idServicioClienteManejo"])) {
    $mostrarCaloSobreManejo = new AjaxNuevaTarifa();
    $mostrarCaloSobreManejo->edicionServicioManejo = $_POST["idServicioClienteManejo"];
    $mostrarCaloSobreManejo->AjaxModificacionCalculoSobreManejo();
}

if (isset($_POST["numeroTarifaManejo"])) {
    $modificacionSobreManejo = new AjaxNuevaTarifa();
    $modificacionSobreManejo->numeroServicioManejo = $_POST["numeroServicioManejo"];
    $modificacionSobreManejo->nombreServicioManejo = $_POST["nombreServicioManejo"];
    $modificacionSobreManejo->numeroTarifaManejo = $_POST["numeroTarifaManejo"];

    $modificacionSobreManejo->AjaxModificacionManejo();
}
if (isset($_POST["idServicioClienteGtsAdmin"])) {
    $mostrarGastosAdmin = new AjaxNuevaTarifa();
    $mostrarGastosAdmin->idServicioClienteGtsAdmin = $_POST["idServicioClienteGtsAdmin"];
    $mostrarGastosAdmin->AjaxMostarServicioGastosAdmin();
}

if (isset($_POST["numeroTarifaGtsAdmin"])) {


    $modificacionSobreGtsAdmin = new AjaxNuevaTarifa();
    $modificacionSobreGtsAdmin->numeroServicioGtsAdmin = $_POST["numeroServicioGtsAdmin"];
    $modificacionSobreGtsAdmin->nombreServicioGtsAdmin = $_POST["nombreServicioGtsAdmin"];
    $modificacionSobreGtsAdmin->numeroTarifaGtsAdmin = $_POST["numeroTarifaGtsAdmin"];
    $modificacionSobreGtsAdmin->AjaxModificacionGtsAdmin();
}


if (isset($_POST["idOtrosGastos"])) {
    $mostrarOtrosGastos = new AjaxNuevaTarifa();
    $mostrarOtrosGastos->idServicioClienteOtrosGastos = $_POST["idOtrosGastos"];
    $mostrarOtrosGastos->AjaxMostarServicioOtrosGastos();
}


if (isset($_POST["numeroTarifaOtrosGastos"])) {
    $mostrarEditarOtrosGastos = new AjaxNuevaTarifa();
    $mostrarEditarOtrosGastos->numeroServicioOtrosGastos = $_POST["numeroServicioOtrosGastos"];
    $mostrarEditarOtrosGastos->nombreServicioOtrosGastos = $_POST["nombreServicioOtrosGastos"];
    $mostrarEditarOtrosGastos->numeroTarifaOtrosGastos = $_POST["numeroTarifaOtrosGastos"];

    $mostrarEditarOtrosGastos->AjaxModificacionOtrosGastos();
}

if (isset($_POST["idNumeroServicio"])) {
    $recuperarServiciosAnulacionFila = new AjaxNuevaTarifa();
    $recuperarServiciosAnulacionFila->idNumeroServicio = $_POST["idNumeroServicio"];
    $recuperarServiciosAnulacionFila->idNumeroFilaCliente = $_POST["idNumeroFilaCliente"];
    $recuperarServiciosAnulacionFila->botonelminarfila = $_POST["botonelminarfila"];
    $recuperarServiciosAnulacionFila->AjaxAnulacionFila();
}


if (isset($_POST["idNitActivar"])) {
    $reactivarCliente = new AjaxNuevaTarifa();
    $reactivarCliente->idNitActivar = $_POST["idNitActivar"];
    $reactivarCliente->AjaxreactivarCliente();
}


if (isset($_POST["lblClienteIdAnularTotal"])) {
    $ClienteIdAnularTotal = new AjaxNuevaTarifa();
    $ClienteIdAnularTotal->lblClienteIdAnularTotal = $_POST["lblClienteIdAnularTotal"];
    $ClienteIdAnularTotal->lblNitAnularTotal = $_POST["lblNitAnularTotal"];
    $ClienteIdAnularTotal->AjaxClienteIdAnularTotal();
}
