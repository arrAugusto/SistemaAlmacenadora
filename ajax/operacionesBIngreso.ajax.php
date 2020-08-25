<?php

require_once "../controlador/operacionesBIngreso.controlador.php";
require_once "../modelo/operacionesBIngreso.modelo.php";
//CASTEO DE DATA
require_once "../controlador/revisionDeData.controlador.php";
//SESSION DE USUARIO PARA MANEJAR BITACORA
require_once "../controlador/usuario.controlador.php";

class AjaxOperacionesBIngreso {

    /**
     * -------------------------------------------------------------------------
     *
     * 25.11.19 AJAX USADO PARA GESTIONAR LA OPERACION DE EL MODULO INGRESO
     * OPERACIONES FISCALES.
     *
     * -------------------------------------------------------------------------
     * */
    public $consultaEmpresa;

    public function AjaxConsultaEmpresa() {
        $consultaEmpresa = $this->consultaEmpresa;
        $respuesta = ControladorOpB::ctrConsultaEmpresa($consultaEmpresa);
        echo json_encode($respuesta);
    }

    public $consultaCodigo;

    public function AjaxConsultaEmpresaPCodigo() {

        $codigo = $this->codigo;
        $respuesta = ControladorOpB::ctrConsultaCodigo($codigo);
        echo json_encode($respuesta);
    }

    public $registrarIngOP;

    public function AjaxRegistrarIngresoOperacion() {
        session_start();
        $usuarioOp = $_SESSION["id"];
        date_default_timezone_set('America/Guatemala');
        $time = date('Y-m-d H:i:s');
        $sel2 = $this->sel2;
        $cartaDeCupo = $this->cartaDeCupo;
        $poliza = $this->poliza;
        $cantContenedores = $this->cantContenedores;
        $dua = $this->dua;
        $bl = $this->bl;
        $puertoOrigen = $this->puertoOrigen;
        $producto = $this->producto;
        $cantClientes = $this->cantClientes;
        $peso = $this->peso;
        $bultos = $this->bultos;
        $valorTotalAduana = $this->valorTotalAduana;
        $tipoDeCambio = $this->tipoDeCambio;
        $totalValorCif = $this->totalValorCif;
        $valorImpuesto = $this->valorImpuesto;
        $estadoIngreso = 1;
        $fechaOperacion = $time;
        $idUsuarioCliente = $this->idUsuarioCliente;
        $idNitCliente = $this->idNitCliente;
        $dependencia = $this->dependencia;
        $consolidado = $this->consolidado;
        $hiddenIdBod = $_SESSION["idDeBodega"];
        $numeroLicencia = $this->numeroLicencia;
        $nombrePiloto = $this->nombrePiloto;
        $numeroPlaca = $this->numeroPlaca;
        $numeroContenedor = $this->numeroContenedor;
        $numeroMarchamo = $this->numeroMarchamo;
        $hiddenDateTime = $this->hiddenDateTime;
        $servicioTarifa = $this->servicioTarifa;
        $idRegPol = $this->idRegPol;
        $lblEmpresa = $this->lblEmpresa;
        $hiddenIdUsser = $this->hiddenIdUsser;
        $busquedaConsolidadoGrd = $this->busquedaConsolidadoGrd;


        $datos = array("sel2" => $sel2,
            "cartaDeCupo" => $cartaDeCupo,
            "poliza" => $poliza,
            "cantContenedores" => $cantContenedores,
            "dua" => $dua,
            "bl" => $bl,
            "puertoOrigen" => $puertoOrigen,
            "producto" => $producto,
            "cantClientes" => $cantClientes,
            "peso" => $peso,
            "bultos" => $bultos,
            "valorTotalAduana" => $valorTotalAduana,
            "tipoDeCambio" => $tipoDeCambio,
            "totalValorCif" => $totalValorCif,
            "valorImpuesto" => $valorImpuesto,
            "estadoIngreso" => $estadoIngreso,
            "fechaOperacion" => $fechaOperacion,
            "idUsuarioCliente" => $idUsuarioCliente,
            "idNitCliente" => $idNitCliente,
            "dependencia" => $dependencia,
            "consolidado" => $consolidado,
            "hiddenIdBod" => $hiddenIdBod,
            "numeroLicencia" => $numeroLicencia,
            "nombrePiloto" => $nombrePiloto,
            "numeroPlaca" => $numeroPlaca,
            "numeroContenedor" => $numeroContenedor,
            "numeroMarchamo" => $numeroMarchamo,
            "hiddenDateTime" => $hiddenDateTime,
            "servicioTarifa" => $servicioTarifa,
            "idRegPol" => $idRegPol,
            "lblEmpresa" => $lblEmpresa,
            "hiddenIdUsser" => $hiddenIdUsser,
            "busquedaConsolidadoGrd" => $busquedaConsolidadoGrd,
            "idUs" => $usuarioOp
        );
        $respuesta = ControladorOpB::ctrRegistrarIngresoOperacion($datos);
        echo json_encode($respuesta);
    }

    public $vericarIngreso;

    public function AjaxVerificarIngreso() {
        $numVerificarIng = $this->numVerificarIng;
        $respuesta = ControladorOpB::ctrVerificarIngreso($numVerificarIng);
        echo json_encode($respuesta);
    }

    public $mostrarNumeroIdNitCliente;

    public function AjaxmostrarNumeroIdNitCliente() {
        $numeroIdNitCliente = $this->numeroIdNitCliente;
        $respuesta = ControladorOpB::ctrMostrarNumeroIdNitCliente($numeroIdNitCliente);
        echo json_encode($respuesta);
    }

    public $mostrarDatosEjecutivo;

    public function AjaxMostrarDatosEjecutivo() {
        $idEjecutivo = $this->idEjecutivo;
        $respuesta = ControladorOpB::ctrMostrarDatosEjecutivo($idEjecutivo);
        echo json_encode($respuesta);
    }

    public $EditarIngOP;

    public function AjaxEditarIngOP() {
        date_default_timezone_set('America/Guatemala');
        $time = date('Y-m-d');
        $datos = array(
            "cartaDeCupoEditar" => $this->cartaDeCupoEditar,
            "lblEmpresaEditar" => $this->lblEmpresaEditar,
            "sel2Editar" => $this->sel2Editar,
            "idRegPolEditar" => $this->idRegPolEditar,
            "polizaEditar" => $this->polizaEditar,
            "cantContenedoresEditar" => $this->cantContenedoresEditar,
            "duaEditar" => $this->duaEditar,
            "blEditar" => $this->blEditar,
            "puertoOrigenEditar" => $this->puertoOrigenEditar,
            "productoEditar" => $this->productoEditar,
            "cantClientesEditar" => $this->cantClientesEditar,
            "pesoEditar" => $this->pesoEditar,
            "bultosEditar" => $this->bultosEditar,
            "valorTotalAduanaEditar" => $this->valorTotalAduanaEditar,
            "tipoDeCambioEditar" => $this->tipoDeCambioEditar,
            "totalValorCifEditar" => $this->totalValorCifEditar,
            "valorImpuestoEditar" => $this->valorImpuestoEditar,
            "idNitClienteEditar" => $this->idNitClienteEditar,
            "dependenciaEditar" => $this->dependenciaEditar,
            "hiddenIdBodEditar" => $this->hiddenIdBodEditar,
            "hiddenDateTimeEditar" => $this->hiddenDateTimeEditar,
            "servicioTarifaEditar" => $this->servicioTarifaEditar,
            "numeroLicenciaEditar" => $this->numeroLicenciaEditar,
            "nombrePilotoEditar" => $this->nombrePilotoEditar,
            "numeroPlacaEditar" => $this->numeroPlacaEditar,
            "numeroContenedorEditar" => $this->numeroContenedorEditar,
            "numeroMarchamoEditar" => $this->numeroMarchamoEditar,
            "regimenPolizaEditar" => $this->regimenPolizaEditar,
            "identity" => $this->identity,
            "idUsuarioClienteEditar" => $this->idUsuarioClienteEditar,
            "consolidadoEditar" => $this->consolidadoEditar,
        );

        $respuesta = ControladorOpB::ctrEditarIngOP($datos);
        echo json_encode($respuesta);
    }

    public $AnularIngreso;

    public function AjaxAnularIngreso() {
        $identityAnular = $this->identityAnular;
        $respuesta = ControladorOpB::ctrAnularIngreso($identityAnular);

        echo json_encode($respuesta);
    }

    public $agregandoDetalles;

    public function AjaxAgregandoDetalles() {
        session_start();
        $usuarioOp = $_SESSION["id"];
        $datos = array(
            "identidad" => $this->identidad,
            "tipoBusqueda" => $this->tipoBusqueda,
            "bultosAgregados" => $this->bultosAgregados,
            "pesoAgregado" => $this->pesoAgregado,
            "idUs" => $usuarioOp);

        $respuesta = ControladorOpB::ctrAgregandoDetalles($datos);
        echo json_encode($respuesta);
    }

    public $verificarSuma;

    public function AjaxVerificarSuma() {
        $identitySum = $this->identitySum;
        $respuesta = ControladorOpB::ctrVerificarSuma($identitySum);
        echo json_encode($respuesta);
    }

    public function ajaxAgregarDetalles() {
        session_start();
        $usuarioOp = $_SESSION["id"];
        $llaveConsulta = $this->llaveConsulta;
        $datos = array(
            "tipoBusqueda" => $this->tipoBusqueda,
            "bultosAgregados" => $this->bultosAgregados,
            "pesoAgregado" => $this->pesoAgregado,
            "idUs" => $usuarioOp);
        $respuesta = ControladorOpB::ctrAgregarDetalles($llaveConsulta, $datos);
        echo json_encode($respuesta);
    }

    public $anularDetalle;

    public function AjaxAnularDetalle() {
        $llaveAnular = $this->llaveAnular;
        $respuesta = ControladorOpB::ctrAnularDetalle($llaveAnular);
        echo json_encode($respuesta);
    }

    public $editarDetalle;

    public function AjaxEditarDetalle() {
        $buttonEditar = $this->buttonEditar;

        $datos = array(
            "textnomEmpresa" => $textnomEmpresa = $this->textnomEmpresa,
            "textbltsEmpresa" => $textbltsEmpresa = $this->textbltsEmpresa,
            "textpesoEmpresa" => $textpesoEmpresa = $this->textpesoEmpresa,
        );

        $respuesta = ControladorOpB::ctrEditarDetalle($buttonEditar, $datos);
        echo json_encode($respuesta);
    }

    public $mostrarServicios;

    public function ajaxMostrarServicio() {
        $MostrarServicio = $this->MostrarServicio;
        $respuesta = ControladorOpB::ctrMostrarServicio($MostrarServicio);
        echo json_encode($respuesta);
    }

    public $mostrarServiciosGeneral;

    public function ajaxMostrarServicioGeneral() {
        $MostrarServicios = $this->MostrarServicios;
        $respuesta = ControladorOpB::ctrMostrarServicioGeneral($MostrarServicios);
        echo json_encode($respuesta);
    }

    public $validacionNuevosVehiculos;

    public function ajaxValidacionNuevosVehiculos() {
        $listaValidacion = $this->listaValidacion;
        $tipo = 0;
        $respuesta = ControladorOpB::ctrValidacionNuevosVehiculos($listaValidacion, $tipo);
        echo json_encode($respuesta);
    }

    public $mostrarNitCosnulta;

    public function ajaxMostrarFamiliaPol() {
        $tipoRegimenConsult = $this->tipoRegimenConsult;
        $respuesta = ControladorOpB::ctrMostrarFamiliaPol($tipoRegimenConsult);
        echo json_encode($respuesta);
    }

    public $mostrarConcidencias;

    public function ajaxMostrarConcidencias() {
        $tipoBusquedaEmpresa = $this->tipoBusquedaEmpresa;
        $respuesta = ControladorOpB::ctrMostrarConcidencias($tipoBusquedaEmpresa);
        echo json_encode($respuesta);
    }

    public $consultaPiloto;

    public function ajaxConsultaPiloto() {
        $datoDpiConsult = $this->datoDpiConsult;
        $respuesta = ControladorOpB::ctrConsultaPiloto($datoDpiConsult);
        echo json_encode($respuesta);
    }

    public $revisionPoliza;

    public function ajaxRevisionPoliza() {
        $numPolRev = $this->numPolRev;
        $respuesta = ControladorOpB::ctrRevisionPoliza($numPolRev);
        echo json_encode($respuesta);
    }

    public $stockBultosPeso;

    public function ajaxStockBultosPeso() {
        $hiddenIdentityIngPeso = $this->hiddenIdentityIngPeso;
        $bultosAgregados = $this->bultosAgregados;
        $pesoAgregado = $this->pesoAgregado;
        $respuesta = ControladorOpB::ctrStockBultosPeso($hiddenIdentityIngPeso, $bultosAgregados, $pesoAgregado);
        echo json_encode($respuesta);
    }

    public $buscarEmpresaConsolidada;

    public function ajaxBuscarEmpresaConsolidada() {
        $busquedaConsolidado = $this->busquedaConsolidado;
        $respuesta = ControladorOpB::ctrBuscarEmpresaConsolidada();
        echo json_encode($busquedaConsolidado);
    }

    public $guardarPilotosPlus;

    public function ajaxGuardarPilotosPlus() {
        $numeroLicenciaPlus = $this->numeroLicenciaPlus;
        $nombrePilotoPlusUn = $this->nombrePilotoPlusUn;
        $numeroPlacaPlusUn = $this->numeroPlacaPlusUn;
        $numeroContenedorPlusUn = $this->numeroContenedorPlusUn;
        $numeroMarchamoPlusUn = $this->numeroMarchamoPlusUn;
        $hiddenIdentityPlus = $this->hiddenIdentityPlus;
        $tipoOperacion = $this->hiddenTipo;
        $datos = array("numeroLicencia" => $numeroLicenciaPlus, "numeroPlaca" => $numeroPlacaPlusUn,
            "numeroContenedor" => $numeroContenedorPlusUn, "nombrePiloto" => $nombrePilotoPlusUn, "numeroMarchamo" => $numeroMarchamoPlusUn, "hiddenTipo" => $tipoOperacion);

        $respuesta = ControladorOpB::ctrGuardarPilotosPlus($hiddenIdentityPlus, $datos, $tipoOperacion);
        echo json_encode($respuesta);
    }

    public $revisicionPiloto;

    public function ajaxRevisicionPiloto() {
        $revisionCui = $this->revisionCui;
        $hiddenIdentityRevPlt = $this->hiddenIdentityRevPlt;
        $respuesta = ControladorOpB::ctrRevisicionPiloto($revisionCui, $hiddenIdentityRevPlt);
        echo json_encode($respuesta);
    }

    public $revPilotosUnidadPlus;

    public function ajaxRevPilotosUnidadPlus() {
        $numeroLicenciaPlusRev = $this->numeroLicenciaPlusRev;
        $numeroPlacaPlusUnRev = $this->numeroPlacaPlusUnRev;
        $numeroContenedorPlusUnRev = $this->numeroContenedorPlusUnRev;
        $numeroMarchamoPlusUnRev = $this->numeroMarchamoPlusUnRev;
        $hiddenIdentityPlusRev = $this->hiddenIdentityPlusRev;
        $tipoPlus = $this->tipoPlus;
        $respuesta = ControladorOpB::ctrRevPilotosUnidadPlus($numeroLicenciaPlusRev, $numeroPlacaPlusUnRev, $numeroContenedorPlusUnRev, $numeroMarchamoPlusUnRev, $hiddenIdentityPlusRev, $tipoPlus);
        echo json_encode($respuesta);
    }

    public $nuevaEmpresa;

    public function ajaxNuevaEmpresa() {
        $nuevoNit = $this->nuevoNit;
        $nuevaEmpresa = $this->nuevaEmpresa;
        $nuevaDireccion = $this->nuevaDireccion;
        $respuesta = ControladorOpB::ctrNuevaEmpresa($nuevoNit, $nuevaEmpresa, $nuevaDireccion);
        echo json_encode($respuesta);
    }

    public $consultaEjecutivoDeTarifa;

    public function ajaxConsultaEjecutivoDeTarifa() {
        $idNitCltEje = $this->idNitCltEje;
        $respuesta = ControladorOpB::ctrConsultaEjecutivoDeTarifa($idNitCltEje);
        echo json_encode($respuesta);
    }

    public $detalleVehUsado;

    public function ajaxDetallesVehiculosUSados() {
        $idIngVehUs = $this->idIngVehUs;
        $idDetVehUs = $this->idDetVehUs;
        $tipoVeh = $this->tipoVeh;
        $marcaVeh = $this->marcaVeh;
        $lineaVeh = $this->lineaVeh;
        $anioVehiculo = $this->anioVehiculo;
        $respuesta = ControladorOpB::ctrDetallesVehiculosUSados($idIngVehUs, $idDetVehUs, $tipoVeh, $marcaVeh, $lineaVeh, $anioVehiculo);
        echo json_encode($respuesta);
    }

    public $revChbasisVeh;

    public function ajaxRevChasisVehiculo() {
        $idIngRevVeh = $this->idIngRevVeh;
        $chasisRevVeh = $this->chasisRevVeh;
        $respuesta = ControladorOpB::ctrRevChbasisVehiculo($idIngRevVeh, $chasisRevVeh);
        echo json_encode($respuesta);
    }

    public $consultaTipoVehiculo;

    public function ajaxConsultaTipoVehiculo() {
        $indexValue = $this->indexValue;
        $respuesta = ControladorOpB::ctrConsultaTipoVehiculo($indexValue);
        echo json_encode($respuesta);
    }

    public $nuevosVehiculosG;

    public function ajaxGuardarNuevosVehiculos() {
        $hiddenIdnetyIngV = $this->hiddenIdnetyIngV;
        $jsonVehiculosG = $this->jsonVehiculosG;
                session_start();
        $usuarioOp = $_SESSION["id"];
        $respuesta = ControladorOpB::ctrGuardarNuevosVehiculos($hiddenIdnetyIngV, $jsonVehiculosG, $usuarioOp);

        echo json_encode($respuesta);
    }

    public $gdListaNoEncontrada;

    public function ajaxGuardarListaNoEncontrada() {
        $listaNoEncontrada = $this->listaNoEncontrada;
        $respuesta = ControladorOpB::ctrGuardarListaNoEncontrada($listaNoEncontrada);
        echo json_encode($respuesta);
        
    }
    public $mostValParaDet;
    public function ajaxMostrarValDeDetalles(){
        $idIngValDet = $this->idIngValDet;
        $respuesta = ControladorOpB::ctrMostrarValDeDetalles($idIngValDet);
        echo json_encode($respuesta);
        
    }

}

if (isset($_POST["consultaEmpresa"])) {
    $consultaEmpresa = new AjaxOperacionesBIngreso();
    $consultaEmpresa->consultaEmpresa = $_POST["consultaEmpresa"];
    $consultaEmpresa->AjaxConsultaEmpresa();
}

if (isset($_POST["consultaCodigo"])) {
    $consultaCodigo = new AjaxOperacionesBIngreso();
    $consultaCodigo->codigo = $_POST["consultaCodigo"];
    $consultaCodigo->AjaxConsultaEmpresaPCodigo();
}

if (isset($_POST["poliza"])) {
    $registrarIngOP = new AjaxOperacionesBIngreso();
    $registrarIngOP->sel2 = $_POST["sel2"];
    $registrarIngOP->cartaDeCupo = $_POST["cartaDeCupo"];
    $registrarIngOP->poliza = $_POST["poliza"];
    $registrarIngOP->cantContenedores = $_POST["cantContenedores"];
    $registrarIngOP->dua = $_POST["dua"];
    $registrarIngOP->bl = $_POST["bl"];
    $registrarIngOP->puertoOrigen = $_POST["puertoOrigen"];
    $registrarIngOP->producto = $_POST["producto"];
    $registrarIngOP->cantClientes = $_POST["cantClientes"];
    $registrarIngOP->peso = $_POST["peso"];
    $registrarIngOP->bultos = $_POST["bultos"];
    $registrarIngOP->valorTotalAduana = $_POST["valorTotalAduana"];
    $registrarIngOP->tipoDeCambio = $_POST["tipoDeCambio"];
    $registrarIngOP->totalValorCif = $_POST["totalValorCif"];
    $registrarIngOP->valorImpuesto = $_POST["valorImpuesto"];
    $registrarIngOP->idUsuarioCliente = $_POST["idUsuarioCliente"];
    $registrarIngOP->idNitCliente = $_POST["idNitCliente"];
    $registrarIngOP->dependencia = $_POST["dependencia"];
    $registrarIngOP->consolidado = $_POST["consolidado"];
    $registrarIngOP->hiddenIdBod = $_POST["hiddenIdBod"];
    $registrarIngOP->numeroLicencia = $_POST["numeroLicencia"];
    $registrarIngOP->nombrePiloto = $_POST["nombrePiloto"];
    $registrarIngOP->numeroPlaca = $_POST["numeroPlaca"];
    $registrarIngOP->numeroContenedor = $_POST["numeroContenedor"];
    $registrarIngOP->numeroMarchamo = $_POST["numeroMarchamo"];
    $registrarIngOP->hiddenDateTime = $_POST["hiddenDateTime"];
    $registrarIngOP->servicioTarifa = $_POST["servicioTarifa"];
    $registrarIngOP->idRegPol = $_POST["idRegPol"];
    $registrarIngOP->lblEmpresa = $_POST["lblEmpresa"];
    $registrarIngOP->hiddenIdUsser = $_POST["hiddenIdUsser"];
    $registrarIngOP->busquedaConsolidadoGrd = $_POST["busquedaConsolidadoGrd"];
    $registrarIngOP->idUs = $_POST["idUs"];

    $registrarIngOP->AjaxRegistrarIngresoOperacion();
}

if (isset($_POST["numVerificarIng"])) {
    $vericarIngreso = new AjaxOperacionesBIngreso();
    $vericarIngreso->numVerificarIng = $_POST["numVerificarIng"];
    $vericarIngreso->AjaxVerificarIngreso();
}

if (isset($_POST["numeroIdNitCliente"])) {
    $mostrarNumeroIdNitCliente = new AjaxOperacionesBIngreso();
    $mostrarNumeroIdNitCliente->numeroIdNitCliente = $_POST["numeroIdNitCliente"];
    $mostrarNumeroIdNitCliente->AjaxmostrarNumeroIdNitCliente();
}

if (isset($_POST["idEjecutivo"])) {
    $mostrarDatosEjecutivo = new AjaxOperacionesBIngreso();
    $mostrarDatosEjecutivo->idEjecutivo = $_POST["idEjecutivo"];
    $mostrarDatosEjecutivo->AjaxMostrarDatosEjecutivo();
}

if (isset($_POST["polizaEditar"])) {
    $EditarIngOP = new AjaxOperacionesBIngreso();
    $EditarIngOP->cartaDeCupoEditar = $_POST["cartaDeCupoEditar"];
    $EditarIngOP->lblEmpresaEditar = $_POST["lblEmpresaEditar"];
    $EditarIngOP->sel2Editar = $_POST["sel2Editar"];
    $EditarIngOP->idRegPolEditar = $_POST["idRegPolEditar"];
    $EditarIngOP->regimenPolizaEditar = $_POST["regimenPolizaEditar"];
    $EditarIngOP->polizaEditar = $_POST["polizaEditar"];
    $EditarIngOP->cantContenedoresEditar = $_POST["cantContenedoresEditar"];
    $EditarIngOP->duaEditar = $_POST["duaEditar"];
    $EditarIngOP->blEditar = $_POST["blEditar"];
    $EditarIngOP->puertoOrigenEditar = $_POST["puertoOrigenEditar"];
    $EditarIngOP->productoEditar = $_POST["productoEditar"];
    $EditarIngOP->cantClientesEditar = $_POST["cantClientesEditar"];
    $EditarIngOP->pesoEditar = $_POST["pesoEditar"];
    $EditarIngOP->bultosEditar = $_POST["bultosEditar"];
    $EditarIngOP->valorTotalAduanaEditar = $_POST["valorTotalAduanaEditar"];
    $EditarIngOP->tipoDeCambioEditar = $_POST["tipoDeCambioEditar"];
    $EditarIngOP->totalValorCifEditar = $_POST["totalValorCifEditar"];
    $EditarIngOP->valorImpuestoEditar = $_POST["valorImpuestoEditar"];
    $EditarIngOP->idNitClienteEditar = $_POST["idNitClienteEditar"];
    $EditarIngOP->dependenciaEditar = $_POST["dependenciaEditar"];
    $EditarIngOP->hiddenIdBodEditar = $_POST["hiddenIdBodEditar"];
    $EditarIngOP->hiddenDateTimeEditar = $_POST["hiddenDateTimeEditar"];
    $EditarIngOP->servicioTarifaEditar = $_POST["servicioTarifaEditar"];
    $EditarIngOP->numeroLicenciaEditar = $_POST["numeroLicenciaEditar"];
    $EditarIngOP->nombrePilotoEditar = $_POST["nombrePilotoEditar"];
    $EditarIngOP->numeroPlacaEditar = $_POST["numeroPlacaEditar"];
    $EditarIngOP->numeroContenedorEditar = $_POST["numeroContenedorEditar"];
    $EditarIngOP->numeroMarchamoEditar = $_POST["numeroMarchamoEditar"];
    $EditarIngOP->identity = $_POST["identity"];
    $EditarIngOP->idUsuarioClienteEditar = $_POST["idUsuarioClienteEditar"];
    $EditarIngOP->consolidadoEditar = $_POST["consolidadoEditar"];
    $EditarIngOP->AjaxEditarIngOP();
}

if (isset($_POST["identityAnular"])) {
    $AnularIngreso = new AjaxOperacionesBIngreso();
    $AnularIngreso->identityAnular = $_POST["identityAnular"];
    $AnularIngreso->AjaxAnularIngreso();
}

if (isset($_POST["identidad"])) {

    $agregandoDetalles = new AjaxOperacionesBIngreso();
    $agregandoDetalles->identidad = $_POST["identidad"];
    $agregandoDetalles->tipoBusqueda = $_POST["tipoBusqueda"];
    $agregandoDetalles->bultosAgregados = $_POST["bultosAgregados"];
    $agregandoDetalles->pesoAgregado = $_POST["pesoAgregado"];
    $agregandoDetalles->AjaxAgregandoDetalles();
}

if (isset($_POST["identitySum"])) {
    $verificarSuma = new AjaxOperacionesBIngreso();
    $verificarSuma->identitySum = $_POST["identitySum"];
    $verificarSuma->AjaxVerificarSuma();
}

if (isset($_POST["llaveConsulta"])) {
    $consultaBultos = new AjaxOperacionesBIngreso();
    $consultaBultos->llaveConsulta = $_POST["llaveConsulta"];
    $consultaBultos->tipoBusqueda = $_POST["tipoBusqueda"];
    $consultaBultos->bultosAgregados = $_POST["bultosAgregados"];
    $consultaBultos->pesoAgregado = $_POST["pesoAgregado"];
    $consultaBultos->ajaxAgregarDetalles();
}

if (isset($_POST["llaveAnular"])) {
    $anularDetalle = new AjaxOperacionesBIngreso();
    $anularDetalle->llaveAnular = $_POST["llaveAnular"];
    $anularDetalle->AjaxAnularDetalle();
}

if (isset($_POST["buttonEditar"])) {
    $editarDetalle = new AjaxOperacionesBIngreso();
    $editarDetalle->buttonEditar = $_POST["buttonEditar"];
    $editarDetalle->textnomEmpresa = $_POST["textnomEmpresa"];
    $editarDetalle->textbltsEmpresa = $_POST["textbltsEmpresa"];
    $editarDetalle->textpesoEmpresa = $_POST["textpesoEmpresa"];
    $editarDetalle->AjaxEditarDetalle();
}

if (isset($_POST["MostrarServicio"])) {
    $mostrarServicios = new AjaxOperacionesBIngreso();
    $mostrarServicios->MostrarServicio = $_POST["MostrarServicio"];
    $mostrarServicios->ajaxMostrarServicio();
}

if (isset($_POST["MostrarServicios"])) {
    $mostrarServiciosGeneral = new AjaxOperacionesBIngreso();
    $mostrarServiciosGeneral->MostrarServicios = $_POST["MostrarServicios"];
    $mostrarServiciosGeneral->ajaxMostrarServicioGeneral();
}

if (isset($_POST["listaValidacion"])) {
    $validacionNuevosVehiculos = new AjaxOperacionesBIngreso();
    $validacionNuevosVehiculos->listaValidacion = $_POST["listaValidacion"];
    $validacionNuevosVehiculos->ajaxValidacionNuevosVehiculos();
}

if (isset($_POST["tipoRegimenConsult"])) {
    $mostrarNitCosnulta = new AjaxOperacionesBIngreso();
    $mostrarNitCosnulta->tipoRegimenConsult = $_POST["tipoRegimenConsult"];
    $mostrarNitCosnulta->ajaxMostrarFamiliaPol();
}

if (isset($_POST["tipoBusquedaEmpresa"])) {
    $mostrarConcidencias = new AjaxOperacionesBIngreso();
    $mostrarConcidencias->tipoBusquedaEmpresa = $_POST["tipoBusquedaEmpresa"];
    $mostrarConcidencias->ajaxMostrarConcidencias();
}

if (isset($_POST["datoDpiConsult"])) {
    $consultaPiloto = new AjaxOperacionesBIngreso();
    $consultaPiloto->datoDpiConsult = $_POST["datoDpiConsult"];
    $consultaPiloto->ajaxConsultaPiloto();
}

if (isset($_POST["numPolRev"])) {
    $revisionPoliza = new AjaxOperacionesBIngreso();
    $revisionPoliza->numPolRev = $_POST["numPolRev"];
    $revisionPoliza->ajaxRevisionPoliza();
}

if (isset($_POST["hiddenIdentityIngPeso"])) {
    $stockBultosPeso = new AjaxOperacionesBIngreso();
    $stockBultosPeso->hiddenIdentityIngPeso = $_POST["hiddenIdentityIngPeso"];
    $stockBultosPeso->bultosAgregados = $_POST["bultosAgregados"];
    $stockBultosPeso->pesoAgregado = $_POST["pesoAgregado"];
    $stockBultosPeso->ajaxStockBultosPeso();
}

if (isset($_POST["busquedaConsolidado"])) {
    $buscarEmpresaConsolidada = new AjaxOperacionesBIngreso();
    $buscarEmpresaConsolidada->busquedaConsolidado = $_POST["busquedaConsolidado"];
    $buscarEmpresaConsolidada->ajaxBuscarEmpresaConsolidada();
}
if (isset($_POST["numeroLicenciaPlus"])) {
    $guardarPilotosPlus = new AjaxOperacionesBIngreso();
    $guardarPilotosPlus->numeroLicenciaPlus = $_POST["numeroLicenciaPlus"];
    $guardarPilotosPlus->nombrePilotoPlusUn = $_POST["nombrePilotoPlusUn"];
    $guardarPilotosPlus->numeroPlacaPlusUn = $_POST["numeroPlacaPlusUn"];
    $guardarPilotosPlus->numeroContenedorPlusUn = $_POST["numeroContenedorPlusUn"];
    $guardarPilotosPlus->numeroMarchamoPlusUn = $_POST["numeroMarchamoPlusUn"];
    $guardarPilotosPlus->hiddenIdentityPlus = $_POST["hiddenIdentityPlus"];
    $guardarPilotosPlus->hiddenTipo = $_POST["hiddenTipo"];
    $guardarPilotosPlus->ajaxGuardarPilotosPlus();
}


if (isset($_POST["revisionCui"])) {
    $revisicionPiloto = new AjaxOperacionesBIngreso();
    $revisicionPiloto->revisionCui = $_POST["revisionCui"];
    $revisicionPiloto->hiddenIdentityRevPlt = $_POST["hiddenIdentityRevPlt"];
    $revisicionPiloto->ajaxRevisicionPiloto();
}
if (isset($_POST["numeroLicenciaPlusRev"])) {
    $revPilotosUnidadPlus = new AjaxOperacionesBIngreso();
    $revPilotosUnidadPlus->numeroLicenciaPlusRev = $_POST["numeroLicenciaPlusRev"];
    $revPilotosUnidadPlus->nombrePilotoPlusUnRev = $_POST["nombrePilotoPlusUnRev"];
    $revPilotosUnidadPlus->numeroPlacaPlusUnRev = $_POST["numeroPlacaPlusUnRev"];
    $revPilotosUnidadPlus->numeroContenedorPlusUnRev = $_POST["numeroContenedorPlusUnRev"];
    $revPilotosUnidadPlus->numeroMarchamoPlusUnRev = $_POST["numeroMarchamoPlusUnRev"];
    $revPilotosUnidadPlus->hiddenIdentityPlusRev = $_POST["hiddenIdentityPlusRev"];
    $revPilotosUnidadPlus->tipoPlus = $_POST["tipoPlus"];

    $revPilotosUnidadPlus->ajaxRevPilotosUnidadPlus();
}


if (isset($_POST["nuevoNit"])) {
    $nuevaEmpresa = new AjaxOperacionesBIngreso();
    $nuevaEmpresa->nuevoNit = $_POST["nuevoNit"];
    $nuevaEmpresa->nuevaEmpresa = $_POST["nuevaEmpresa"];
    $nuevaEmpresa->nuevaDireccion = $_POST["nuevaDireccion"];
    $nuevaEmpresa->ajaxNuevaEmpresa();
}

if (isset($_POST["idNitCltEje"])) {
    $consultaEjecutivoDeTarifa = new AjaxOperacionesBIngreso();
    $consultaEjecutivoDeTarifa->idNitCltEje = $_POST["idNitCltEje"];
    $consultaEjecutivoDeTarifa->ajaxConsultaEjecutivoDeTarifa();
}


if (isset($_POST["idIngVehUs"])) {
    $detalleVehUsado = new AjaxOperacionesBIngreso();
    $detalleVehUsado->idIngVehUs = $_POST["idIngVehUs"];
    $detalleVehUsado->idDetVehUs = $_POST["idDetVehUs"];
    $detalleVehUsado->tipoVeh = $_POST["tipoVeh"];
    $detalleVehUsado->marcaVeh = $_POST["marcaVeh"];
    $detalleVehUsado->lineaVeh = $_POST["lineaVeh"];
    $detalleVehUsado->anioVehiculo = $_POST["anioVehiculo"];
    $detalleVehUsado->ajaxDetallesVehiculosUSados();
}

if (isset($_POST["idIngRevVeh"])) {
    $revChbasisVeh = new AjaxOperacionesBIngreso();
    $revChbasisVeh->idIngRevVeh = $_POST["idIngRevVeh"];
    $revChbasisVeh->chasisRevVeh = $_POST["chasisRevVeh"];
    $revChbasisVeh->ajaxRevChasisVehiculo();
}


if (isset($_POST["indexValue"])) {
    $consultaTipoVehiculo = new AjaxOperacionesBIngreso();
    $consultaTipoVehiculo->indexValue = $_POST["indexValue"];
    $consultaTipoVehiculo->ajaxConsultaTipoVehiculo();
}

if (isset($_POST["hiddenIdnetyIngV"])) {
    $nuevosVehiculosG = new AjaxOperacionesBIngreso();
    $nuevosVehiculosG->hiddenIdnetyIngV = $_POST["hiddenIdnetyIngV"];
    $nuevosVehiculosG->jsonVehiculosG = $_POST["jsonVehiculosG"];
    $nuevosVehiculosG->ajaxGuardarNuevosVehiculos();
}
if (isset($_POST["listaNoEncontrada"])) {
    $gdListaNoEncontrada = new AjaxOperacionesBIngreso();
    $gdListaNoEncontrada->listaNoEncontrada = $_POST["listaNoEncontrada"];
    $gdListaNoEncontrada->ajaxGuardarListaNoEncontrada();
}
if (isset($_POST["idIngValDet"])) {
    $mostValParaDet = new AjaxOperacionesBIngreso();
    $mostValParaDet -> idIngValDet =$_POST["idIngValDet"];
    $mostValParaDet -> ajaxMostrarValDeDetalles();
    
}