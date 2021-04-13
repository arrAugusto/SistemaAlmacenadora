<?php

require_once "../controlador/ubicacionBodega.controlador.php";
require_once "../modelo/ubicacionBodega.modelo.php";

require_once "../controlador/calculoDeAlmacenaje.controlador.php";
require_once "../modelo/calculoDeAlmacenaje.modelo.php";

require_once "../controlador/retiroOpe.controlador.php";
require_once "../modelo/retiroOpe.modelo.php";

require_once "../controlador/ingresosPendientes.controlador.php";
require_once "../modelo/ingresosPendientes.modelo.php";
//TOMAR OBJETOS DE POSICIONES Y METROS RETIROS DE BODEGA
require_once "../controlador/retiroBod.controlador.php";
require_once "../modelo/retiroBod.modelo.php";
//REQUIRE CREATOR QR 
require_once "../extensiones/qrCodeCreate/vendor/autoload.php";
//SESSION DE USUARIO PARA MANEJAR BITACORA
require_once "../controlador/usuario.controlador.php";
//PASE DE SALIDA PARA PODER ACCEDER A METODOS DE ESTE FICHERO
require_once "../controlador/paseDeSalida.controlador.php";
require_once "../modelo/paseDeSalida.modelo.php";

class AjaxUbicacionOpe {

    public $MostrarUbicaUnicas;

    public function AjaxMostrarUbUnitaria() {
        session_start();
        $dependencia = $_SESSION["dependencia"];
        $datoSearchPol = $this->datoSearchPol;
        $respuesta = ControladorRetiroOpe::ctrMostrarBusqueda($datoSearchPol, $dependencia);
        echo json_encode(array($respuesta, $dependencia));
    }

    public $mostrarNitRetiro;

    public function AjaxMostrarNitRetiro() {
        $txtNitSalida = $this->txtNitSalida;
        $respuesta = ControladorRetiroOpe::ctrMostrarNitRetiro($txtNitSalida);
        echo json_encode($respuesta);
    }

    public $mostrarEstadoDetalle;

    public function ajaxMostrarEstadoDetalle() {
        $idBod = $this->idBod;
        $respuesta = ControladorRetiroOpe::ctrMostrarEstadoDetalle($idBod);
        echo json_encode($respuesta);
    }

    public $insertRetiroOpe;

    public function ajaxInsertRetiroOpe() {
        session_start();
        $usuarioOp = $_SESSION["id"];
        $datos = array(
            "hiddeniddeingreso" => $hiddeniddeingreso = $this->hiddeniddeingreso,
            "hiddenIdUs" => $hiddenIdUs = $this->hiddenIdUs,
            "idNit" => $idNit = $this->idNit,
            "polizaRetiro" => $polizaRetiro = $this->polizaRetiro,
            "regimen" => $regimen = $this->regimen,
            "tipoCambio" => $tipoCambio = $this->tipoCambio,
            "valorTotalAduana" => $valorTotalAduana = $this->valorTotalAduana,
            "valorCif" => $valorCif = $this->valorCif,
            "calculoValorImpuesto" => $calculoValorImpuesto = $this->calculoValorImpuesto,
            "pesoKg" => $pesoKg = $this->pesoKg,
            "descMercaderia" => $descMercaderia = $this->descMercaderia,
            "hiddenIdBod" => $hiddenIdBod = $this->hiddenIdBod,
            "contenedor" => $contenedor = $this->contenedor,
            "placa" => $placa = $this->placa,
            "licencia" => $licencia = $this->licencia,
            "piloto" => $piloto = $this->piloto,
            "cantBultos" => $cantBultos = $this->cantBultos,
            "hiddenIdentificador" => $hiddenIdentificador = $this->hiddenIdentificador,
            "hiddenDateTime" => $hiddenDateTime = $this->hiddenDateTime,
            "listaDetalles" => $listaDetalles = $this->listaDetalles,
            "usuarioOp" => $usuarioOp,
            "tipoIng" => $tipoIng = $this->tipoIng,
            "jsonStringDR" => $jsonStringDR = $this->jsonStringDR);

        $respuesta = ControladorRetiroOpe::ctrInsertRetiroOpe($datos);
        echo json_encode($respuesta);
    }

    public $selectDetaOpera;

    public function ajaxMostrarSelectDetOpe() {
        $idIngSelectDet = $this->idIngSelectDet;
        $respuesta = ControladorRetiroOpe::ctrMostrarSelectDetOpe($idIngSelectDet);
        echo json_encode($respuesta);
    }

    public $MostrarSaldos;

    public function ajaxMostrarSaldosConta() {
        $idIngOpDet = $this->idIngOpDet;
        $respuesta = ControladorRetiroOpe::ctrMostrarSaldosConta($idIngOpDet);
        echo json_encode($respuesta);
    }

    public $verStock;

    public function ajaxMostrarStock() {
        $idIngresoCantBultos = $this->idIngresoCantBultos;
        $cantBultosVal = $this->cantBultosVal;
        $respuesta = ControladorRetiroOpe::ctrMostrarStock($idIngresoCantBultos, $cantBultosVal);
        echo json_encode($respuesta);
    }

    public $consultarDetalle;

    public function ajaxConsultarDetalle() {
        $idOpDetTraer = $this->idOpDetTraer;
        $textoValDet = $this->textoValDet;
        $respuesta = ControladorRetiroOpe::ctrConsultarDetalle($idOpDetTraer, $textoValDet);
        echo json_encode($respuesta);
    }

    public $editarRetiroOpF;

    public function ajaxEditarRetiroOpF() {

        $idRetiroBtn = $this->idRetiroBtn;

        $datos = array(
            "listaDetallesEdit" => $listaDetallesEdit = $this->listaDetallesEdit,
            "hiddeniddeingresoEdit" => $hiddeniddeingresoEdit = $this->hiddeniddeingresoEdit,
            "hiddenIdUsEdit" => $hiddenIdUsEdit = $this->hiddenIdUsEdit,
            "idNitEdit" => $idNitEdit = $this->idNitEdit,
            "polizaRetiroEdit" => $polizaRetiroEdit = $this->polizaRetiroEdit,
            "regimenEdit" => $regimenEdit = $this->regimenEdit,
            "tipoCambioEdit" => $tipoCambioEdit = $this->tipoCambioEdit,
            "valorTotalAduanaEdit" => $valorTotalAduanaEdit = $this->valorTotalAduanaEdit,
            "valorCifEdit" => $valorCifEdit = $this->valorCifEdit,
            "calculoValorImpuestoEdit" => $calculoValorImpuestoEdit = $this->calculoValorImpuestoEdit,
            "pesoKgEdit" => $pesoKgEdit = $this->pesoKgEdit,
            "placaEdit" => $placaEdit = $this->placaEdit,
            "contenedorEdit" => $contenedorEdit = $this->contenedorEdit,
            "descMercaderiaEdit" => $descMercaderiaEdit = $this->descMercaderiaEdit,
            "licenciaEdit" => $licenciaEdit = $this->licenciaEdit,
            "pilotoEdit" => $pilotoEdit = $this->pilotoEdit,
            "hiddenIdBodEdit" => $hiddenIdBodEdit = $this->hiddenIdBodEdit,
            "cantBultosEdit" => $cantBultosEdit = $this->cantBultosEdit,
            "hiddenIdentificadorEdit" => $hiddenIdentificadorEdit = $this->hiddenIdentificadorEdit,
            "hiddenDateTimeEdit" => $hiddenDateTimeEdit = $this->hiddenDateTimeEdit
        );
        session_start();
        $usuarioOp = $_SESSION["id"];
        $respuesta = ControladorRetiroOpe::ctrEditarRetiroOpF($datos, $idRetiroBtn, $usuarioOp);
        echo json_encode($respuesta);
    }

    public $revPoliza;

    public function ajaxRevisionPoliza() {
        $numPolizaRev = $this->numPolizaRev;
        $respuesta = ControladorRetiroOpe::ctrRevisionPoliza($numPolizaRev);
        echo json_encode($respuesta);
    }

    public $revisionChasisSalida;

    public function ajaxRevisionChasisSalida() {
        $idChasVer = $this->idChasVer;
        $respuesta = ControladorRetiroOpe::ctrRevisionChasisSalida($idChasVer);
        echo json_encode($respuesta);
    }

    public $guardarRetVeh;

    public function ajaxGuardarRetVehiculos() {
        $datos = array(
            "hiddeniddeingresoVeh" => $hiddeniddeingresoVeh = $this->hiddeniddeingresoVeh,
            "hiddenIdUsVeh" => $hiddenIdUsVeh = $this->hiddenIdUsVeh,
            "idNitVeh" => $idNitVeh = $this->idNitVeh,
            "polizaRetiroVeh" => $polizaRetiroVeh = $this->polizaRetiroVeh,
            "regimenVeh" => $regimenVeh = $this->regimenVeh,
            "tipoCambioVeh" => $tipoCambioVeh = $this->tipoCambioVeh,
            "valorTotalAduanaVeh" => $valorTotalAduanaVeh = $this->valorTotalAduanaVeh,
            "valorCifVeh" => $valorCifVeh = $this->valorCifVeh,
            "calculoValorImpuestoVeh" => $calculoValorImpuestoVeh = $this->calculoValorImpuestoVeh,
            "pesoKgVeh" => $pesoKgVeh = $this->pesoKgVeh,
            "licenciaVeh" => $licenciaVeh = $this->licenciaVeh,
            "pilotoVeh" => $pilotoVeh = $this->pilotoVeh,
            "hiddenIdBodVeh" => $hiddenIdBodVeh = $this->hiddenIdBodVeh,
            "cantBultosVeh" => $cantBultosVeh = $this->cantBultosVeh,
            "hiddenIdentificadorVeh" => $hiddenIdentificadorVeh = $this->hiddenIdentificadorVeh,
            "hiddenDateTimeVeh" => $hiddenDateTimeVeh = $this->hiddenDateTimeVeh,
            "listaVehiculos" => $listaVehiculos = $this->listaVehiculos,
            "descMercaderiaVeh" => $descMercaderiaVeh = $this->descMercaderiaVeh,
            "jsonStorageDRVeh" => $jsonStorageDRVeh = $this->jsonStorageDRVeh
        );
        $respuesta = ControladorRetiroOpe::ctrGuardarRetVehiculos($datos);
        echo json_encode($respuesta);
    }

    public $edicionVehN;

    public function ajaxEdicionVehN() {
        $datos = array(
            "listaVehiculosVEd" => $listaVehiculosVEd = $this->listaVehiculosVEd,
            "hiddeniddeingresoVEd" => $hiddeniddeingresoVEd = $this->hiddeniddeingresoVEd,
            "hiddenIdUsVEd" => $hiddenIdUsVEd = $this->hiddenIdUsVEd,
            "idNitVEd" => $idNitVEd = $this->idNitVEd,
            "polizaRetiroVEd" => $polizaRetiroVEd = $this->polizaRetiroVEd,
            "regimenVEd" => $regimenVEd = $this->regimenVEd,
            "tipoCambioVEd" => $tipoCambioVEd = $this->tipoCambioVEd,
            "valorTotalAduanaVEd" => $valorTotalAduanaVEd = $this->valorTotalAduanaVEd,
            "valorCifVEd" => $valorCifVEd = $this->valorCifVEd,
            "calculoValorImpuestoVEd" => $calculoValorImpuestoVEd = $this->calculoValorImpuestoVEd,
            "pesoKgVEd" => $pesoKgVEd = $this->pesoKgVEd,
            "licenciaVEd" => $licenciaVEd = $this->licenciaVEd,
            "pilotoVEd" => $pilotoVEd = $this->pilotoVEd,
            "hiddenIdBodVEd" => $hiddenIdBodVEd = $this->hiddenIdBodVEd,
            "cantBultosVEd" => $cantBultosVEd = $this->cantBultosVEd,
            "hiddenIdentificadorVEd" => $hiddenIdentificadorVEd = $this->hiddenIdentificadorVEd,
            "hiddenDateTimeVEd" => $hiddenDateTimeVEd = $this->hiddenDateTimeVEd,
            "descMercaderiaVEd" => $descMercaderiaVEd = $this->descMercaderiaVEd
        );
        $respuesta = ControladorRetiroOpe::ctrEdicionVehN($datos);
        echo json_encode($respuesta);
    }

    public $editPiloto;

    public function ajaxEditarPilotoUnidad() {
        $idRetUnidad = $this->idRetUnidad;
        $respuesta = ControladorRetiroOpe::ctrEditarPilotoUnidad($idRetUnidad);
        echo json_encode($respuesta);
    }

    public $editarPiloto;

    public function ajaxEditarPilotoUn() {
        $licEdit = $this->licEdit;
        $nombreEdit = $this->nombreEdit;
        $numeroPlacaEdit = $this->numeroPlacaEdit;
        $numeroContEdit = $this->numeroContEdit;
        $numeroMarchEdit = $this->numeroMarchEdit;
        $hiddenIdentEdit = $this->hiddenIdentEdit;
        $hiddenTipEdit = $this->hiddenTipEdit;
        $identiUnidad = $this->identiUnidad;
        $respuesta = ControladorRetiroOpe::ctrEditarPilotoUn($licEdit, $nombreEdit, $numeroPlacaEdit, $numeroContEdit, $numeroMarchEdit, $hiddenIdentEdit, $hiddenTipEdit, $identiUnidad);
        echo json_encode($respuesta);
    }

    public $borrarUnidad;

    public function ajaxBorrarUnidad() {
        $borrarUnidad = $this->borrarUnidad;
        $estado = 0;
        $respuesta = ControladorRetiroOpe::ctrBorrarActivarUnidad($borrarUnidad, $estado);
        echo json_encode($respuesta);
    }

    public $todasUnidades;

    public function ajaxTodasUnidades() {
        $todasUnidades = $this->todasUnidades;
        $estadoVerPlt = $this->estadoVerPlt;
        $datosUnidades = ControladorRetiroOpe::ctrDatosPilotos($todasUnidades, $estadoVerPlt);
        echo json_encode($datosUnidades);
    }

    public $activarUnidad;

    public function ajaxActivarUnidad() {
        $activarUnidad = $this->activarUnidad;
        $estado = 1;
        $respuesta = ControladorRetiroOpe::ctrBorrarActivarUnidad($activarUnidad, $estado);
        echo json_encode($respuesta);
    }

    public $mostrarVehUsado;

    public function ajaxCalcVehUsados() {
        $revVehUsados = $this->revVehUsados;
        $dateReVehUs = $this->dateReVehUs;
        $respuesta = ControladorRetiroOpe::ctrCalcVehUsados($revVehUsados, $dateReVehUs);
        echo json_encode($respuesta);
    }

    public $trasladoIngZAAF;

    public function ajaxTrasladoZAAF() {
        $idIngTrasladar = $this->idIngTrasladar;
        $datosUnidades = ControladorRetiroOpe::ctrTrasladoZAAF($idIngTrasladar);
        echo json_encode($datosUnidades);
    }

    public $verSaldosAF;

    public function ajaxMostrarSaldosAF() {
        $saldosAF = $this->saldosAF;
        $respSaldAF = ControladorRetiroOpe::ctrMostrarSaldosAF($saldosAF);
        echo json_encode($respSaldAF);
    }

    public $anulacionOperaciones;

    public function ajaxAnularOperaciones() {
        session_start();
        $usuarioOp = $_SESSION["id"];
        $idtrans = $this->idtrans;
        $idoperacion = $this->idoperacion;
        $motivoAnula = $this->motivoAnula;
        $anularOperaciones = ControladorRetiroOpe::ctrAnularTransaccion($idtrans, $idoperacion, $motivoAnula, $usuarioOp);
        echo json_encode($anularOperaciones);
    }

    public $verSaldosDR;

    public function ajaxRevisionDePolDR() {
        $polizaIngDR = $this->polizaIngDR;
        $bltsDR = $this->bltsDR;
        $cifDR = $this->cifDR;
        $imptDR = $this->imptDR;
        $respuesta = ControladorRetiroOpe::ctrRevisionDePolDR($polizaIngDR, $bltsDR, $cifDR, $imptDR);
        echo json_encode($respuesta);
    }

    public $dataEditRetOp;

    public function ajaxDataEditRetOp() {
        $tipoConsulRet = $this->tipoConsulRet;
        $idRetConsul = $this->idRetConsul;
        $respuesta = ControladorRetiroOpe::ctrDataEditRetOp($tipoConsulRet, $idRetConsul);
        echo json_encode($respuesta);
    }

    public $objDetalleM;

    public function ajaxVerDataDetalleEditRet() {
        $idDetRevEd = $this->idDetRevEd;
        $respuesta = ControladorRetiroOpe::ctrVerDataDetalleEditRet($idDetRevEd);
        echo json_encode($respuesta);
    }

    public $trasladoAFDef;

    public function ajaxTrasladoDefinitivoAF() {
        $trasladoDefAf = $this->trasladoDefAf;
        $respuesta = ControladorRetiroOpe::ctrTrasladoDefinitivoAF($trasladoDefAf);
        echo json_encode($respuesta);
    }

    public $anRetiro;

    public function ajaxAnularRetiro() {
        session_start();
        $usuarioOp = $_SESSION["id"];
        $AnularRetiro = $this->AnularRetiro;
        $motvAnulacion = $this->motvAnulacion;
        $respuesta = ControladorRetiroOpe::ctrAnularRetiro($AnularRetiro, $motvAnulacion, $usuarioOp);
        echo json_encode($respuesta);
    }

    public $mostrarRetiros;

    public function ajaxMostrarHistorialRetiros() {
        session_start();
        $NavegaNumB = $_SESSION["idDeBodega"];
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
        $respuesta = ControladorRetiroOpe::ctrMostrarHistorialRetiros($NavegaNumB);
        echo json_encode(array($respuesta, $tipo));
    }

    //solicitando historiales por rangos
    public $range;

    public function ajaxMostrarRangoHistorial() {
        session_start();
        $NavegaNumB = $_SESSION["idDeBodega"];
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
        $fechaInicio = $this->fechaInicio;
        $fechaFin = $this->fechaFin;


        $respuesta = ControladorRetiroOpe::ctrMostrarRangoHistorial($NavegaNumB, $fechaInicio, $fechaFin);
        echo json_encode(array($respuesta, $tipo));
    }

    //busqueda por poliza
    public $busquedaPol;

    public function ajaxMostrarBusquedaPoliza() {
        session_start();
        $NavegaNumB = $_SESSION["idDeBodega"];
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
        $busquedaPoliza = $this->busquedaPoliza;
        $respuesta = ControladorRetiroOpe::ctrMostrarBusquedaPoliza($NavegaNumB, $busquedaPoliza);
        echo json_encode(array($respuesta, $tipo));
    }

}

if (isset($_POST["datoSearchPol"])) {
    $MostrarUbicaUnicas = new AjaxUbicacionOpe();
    $MostrarUbicaUnicas->datoSearchPol = $_POST["datoSearchPol"];
    $MostrarUbicaUnicas->AjaxMostrarUbUnitaria();
}


if (isset($_POST["txtNitSalida"])) {
    $mostrarNitRetiro = new AjaxUbicacionOpe();
    $mostrarNitRetiro->txtNitSalida = $_POST["txtNitSalida"];
    $mostrarNitRetiro->AjaxMostrarNitRetiro();
}


if (isset($_POST["idBod"])) {
    $mostrarEstadoDetalle = new AjaxUbicacionOpe();
    $mostrarEstadoDetalle->idBod = $_POST["idBod"];
    $mostrarEstadoDetalle->ajaxMostrarEstadoDetalle();
}

if (isset($_POST["hiddeniddeingreso"])) {
    $insertRetiroOpe = new AjaxUbicacionOpe();
    $insertRetiroOpe->hiddeniddeingreso = $_POST["hiddeniddeingreso"];
    $insertRetiroOpe->hiddenIdUs = $_POST["hiddenIdUs"];
    $insertRetiroOpe->idNit = $_POST["idNit"];
    $insertRetiroOpe->polizaRetiro = $_POST["polizaRetiro"];
    $insertRetiroOpe->regimen = $_POST["regimen"];
    $insertRetiroOpe->tipoCambio = $_POST["tipoCambio"];
    $insertRetiroOpe->valorTotalAduana = $_POST["valorTotalAduana"];
    $insertRetiroOpe->valorCif = $_POST["valorCif"];
    $insertRetiroOpe->calculoValorImpuesto = $_POST["calculoValorImpuesto"];
    $insertRetiroOpe->pesoKg = $_POST["pesoKg"];
    $insertRetiroOpe->placa = $_POST["placa"];
    $insertRetiroOpe->contenedor = $_POST["contenedor"];
    $insertRetiroOpe->descMercaderia = $_POST["descMercaderia"];
    $insertRetiroOpe->licencia = $_POST["licencia"];
    $insertRetiroOpe->piloto = $_POST["piloto"];
    $insertRetiroOpe->hiddenIdBod = $_POST["hiddenIdBod"];
    $insertRetiroOpe->cantBultos = $_POST["cantBultos"];
    $insertRetiroOpe->hiddenIdentificador = $_POST["hiddenIdentificador"];
    $insertRetiroOpe->hiddenDateTime = $_POST["hiddenDateTime"];
    $insertRetiroOpe->listaDetalles = $_POST["listaDetalles"];
    $insertRetiroOpe->tipoIng = $_POST["tipoIng"];
    $insertRetiroOpe->jsonStringDR = $_POST["jsonStringDR"];


    $insertRetiroOpe->ajaxInsertRetiroOpe();
}

if (isset($_POST["idIngSelectDet"])) {
    $selectDetaOpera = new AjaxUbicacionOpe();
    $selectDetaOpera->idIngSelectDet = $_POST["idIngSelectDet"];
    $selectDetaOpera->ajaxMostrarSelectDetOpe();
}


if (isset($_POST["idIngOpDet"])) {
    $MostrarSaldos = new AjaxUbicacionOpe();
    $MostrarSaldos->idIngOpDet = $_POST["idIngOpDet"];
    $MostrarSaldos->ajaxMostrarSaldosConta();
}

if (isset($_POST["idIngresoCantBultos"])) {
    $verStock = new AjaxUbicacionOpe();
    $verStock->idIngresoCantBultos = $_POST["idIngresoCantBultos"];
    $verStock->cantBultosVal = $_POST["cantBultosVal"];
    $verStock->ajaxMostrarStock();
}

if (isset($_POST["idOpDetTraer"])) {
    $consultarDetalle = new AjaxUbicacionOpe();
    $consultarDetalle->idOpDetTraer = $_POST["idOpDetTraer"];
    $consultarDetalle->textoValDet = $_POST["textoValDet"];
    $consultarDetalle->ajaxConsultarDetalle();
}

if (isset($_POST["idRetiroBtn"])) {
    $editarRetiroOpF = new AjaxUbicacionOpe();
    $editarRetiroOpF->idRetiroBtn = $_POST["idRetiroBtn"];
    $editarRetiroOpF->listaDetallesEdit = $_POST["listaDetallesEdit"];
    $editarRetiroOpF->hiddeniddeingresoEdit = $_POST["hiddeniddeingresoEdit"];
    $editarRetiroOpF->hiddenIdUsEdit = $_POST["hiddenIdUsEdit"];
    $editarRetiroOpF->idNitEdit = $_POST["idNitEdit"];
    $editarRetiroOpF->polizaRetiroEdit = $_POST["polizaRetiroEdit"];
    $editarRetiroOpF->regimenEdit = $_POST["regimenEdit"];
    $editarRetiroOpF->tipoCambioEdit = $_POST["tipoCambioEdit"];
    $editarRetiroOpF->valorTotalAduanaEdit = $_POST["valorTotalAduanaEdit"];
    $editarRetiroOpF->valorCifEdit = $_POST["valorCifEdit"];
    $editarRetiroOpF->calculoValorImpuestoEdit = $_POST["calculoValorImpuestoEdit"];
    $editarRetiroOpF->pesoKgEdit = $_POST["pesoKgEdit"];
    $editarRetiroOpF->placaEdit = $_POST["placaEdit"];
    $editarRetiroOpF->contenedorEdit = $_POST["contenedorEdit"];
    $editarRetiroOpF->descMercaderiaEdit = $_POST["descMercaderiaEdit"];
    $editarRetiroOpF->licenciaEdit = $_POST["licenciaEdit"];
    $editarRetiroOpF->pilotoEdit = $_POST["pilotoEdit"];
    $editarRetiroOpF->hiddenIdBodEdit = $_POST["hiddenIdBodEdit"];
    $editarRetiroOpF->cantBultosEdit = $_POST["cantBultosEdit"];
    $editarRetiroOpF->hiddenIdentificadorEdit = $_POST["hiddenIdentificadorEdit"];
    $editarRetiroOpF->hiddenDateTimeEdit = $_POST["hiddenDateTimeEdit"];
    $editarRetiroOpF->ajaxEditarRetiroOpF();
}

if (isset($_POST["numPolizaRev"])) {
    $revPoliza = new AjaxUbicacionOpe();
    $revPoliza->numPolizaRev = $_POST["numPolizaRev"];
    $revPoliza->ajaxRevisionPoliza();
}
if (isset($_POST["idChasVer"])) {
    $revisionChasisSalida = new AjaxUbicacionOpe();
    $revisionChasisSalida->idChasVer = $_POST["idChasVer"];
    $revisionChasisSalida->ajaxRevisionChasisSalida();
}

if (isset($_POST["hiddeniddeingresoVeh"])) {
    $guardarRetVeh = new AjaxUbicacionOpe();
    $guardarRetVeh->hiddeniddeingresoVeh = $_POST["hiddeniddeingresoVeh"];
    $guardarRetVeh->hiddenIdUsVeh = $_POST["hiddenIdUsVeh"];
    $guardarRetVeh->idNitVeh = $_POST["idNitVeh"];
    $guardarRetVeh->polizaRetiroVeh = $_POST["polizaRetiroVeh"];
    $guardarRetVeh->regimenVeh = $_POST["regimenVeh"];
    $guardarRetVeh->tipoCambioVeh = $_POST["tipoCambioVeh"];
    $guardarRetVeh->valorTotalAduanaVeh = $_POST["valorTotalAduanaVeh"];
    $guardarRetVeh->valorCifVeh = $_POST["valorCifVeh"];
    $guardarRetVeh->calculoValorImpuestoVeh = $_POST["calculoValorImpuestoVeh"];
    $guardarRetVeh->pesoKgVeh = $_POST["pesoKgVeh"];
    $guardarRetVeh->licenciaVeh = $_POST["licenciaVeh"];
    $guardarRetVeh->pilotoVeh = $_POST["pilotoVeh"];
    $guardarRetVeh->hiddenIdBodVeh = $_POST["hiddenIdBodVeh"];
    $guardarRetVeh->cantBultosVeh = $_POST["cantBultosVeh"];
    $guardarRetVeh->hiddenIdentificadorVeh = $_POST["hiddenIdentificadorVeh"];
    $guardarRetVeh->hiddenDateTimeVeh = $_POST["hiddenDateTimeVeh"];
    $guardarRetVeh->listaVehiculos = $_POST["listaVehiculos"];
    $guardarRetVeh->descMercaderiaVeh = $_POST["descMercaderiaVeh"];
    $guardarRetVeh->jsonStorageDRVeh = $_POST["jsonStorageDRVeh"];

    $guardarRetVeh->ajaxGuardarRetVehiculos();
}


if (isset($_POST["hiddenIdUsVEd"])) {
    $edicionVehN = new AjaxUbicacionOpe();
    $edicionVehN->listaVehiculosVEd = $_POST["listaVehiculosVEd"];
    $edicionVehN->hiddeniddeingresoVEd = $_POST["hiddeniddeingresoVEd"];
    $edicionVehN->hiddenIdUsVEd = $_POST["hiddenIdUsVEd"];
    $edicionVehN->idNitVEd = $_POST["idNitVEd"];
    $edicionVehN->polizaRetiroVEd = $_POST["polizaRetiroVEd"];
    $edicionVehN->regimenVEd = $_POST["regimenVEd"];
    $edicionVehN->tipoCambioVEd = $_POST["tipoCambioVEd"];
    $edicionVehN->valorTotalAduanaVEd = $_POST["valorTotalAduanaVEd"];
    $edicionVehN->valorCifVEd = $_POST["valorCifVEd"];
    $edicionVehN->calculoValorImpuestoVEd = $_POST["calculoValorImpuestoVEd"];
    $edicionVehN->pesoKgVEd = $_POST["pesoKgVEd"];
    $edicionVehN->licenciaVEd = $_POST["licenciaVEd"];
    $edicionVehN->pilotoVEd = $_POST["pilotoVEd"];
    $edicionVehN->hiddenIdBodVEd = $_POST["hiddenIdBodVEd"];
    $edicionVehN->cantBultosVEd = $_POST["cantBultosVEd"];
    $edicionVehN->hiddenIdentificadorVEd = $_POST["hiddenIdentificadorVEd"];
    $edicionVehN->hiddenDateTimeVEd = $_POST["hiddenDateTimeVEd"];
    $edicionVehN->descMercaderiaVEd = $_POST["descMercaderiaVEd"];
    $edicionVehN->ajaxEdicionVehN();
}

if (isset($_POST["idRetUnidad"])) {
    $editPiloto = new AjaxUbicacionOpe();
    $editPiloto->idRetUnidad = $_POST["idRetUnidad"];
    $editPiloto->ajaxEditarPilotoUnidad();
}

if (isset($_POST["licEdit"])) {
    $editarPiloto = new AjaxUbicacionOpe();
    $editarPiloto->licEdit = $_POST["licEdit"];
    $editarPiloto->nombreEdit = $_POST["nombreEdit"];
    $editarPiloto->numeroPlacaEdit = $_POST["numeroPlacaEdit"];
    $editarPiloto->numeroContEdit = $_POST["numeroContEdit"];
    $editarPiloto->numeroMarchEdit = $_POST["numeroMarchEdit"];
    $editarPiloto->hiddenIdentEdit = $_POST["hiddenIdentEdit"];
    $editarPiloto->hiddenTipEdit = $_POST["hiddenTipEdit"];
    $editarPiloto->identiUnidad = $_POST["identiUnidad"];
    $editarPiloto->ajaxEditarPilotoUn();
}

if (isset($_POST["borrarUnidad"])) {
    $borrarUnidad = new AjaxUbicacionOpe();
    $borrarUnidad->borrarUnidad = $_POST["borrarUnidad"];
    $borrarUnidad->ajaxBorrarUnidad();
}


if (isset($_POST["todasUnidades"])) {
    $todasUnidades = new AjaxUbicacionOpe();
    $todasUnidades->todasUnidades = $_POST["todasUnidades"];
    $todasUnidades->estadoVerPlt = $_POST["estadoVerPlt"];
    $todasUnidades->ajaxTodasUnidades();
}
if (isset($_POST["activarUnidad"])) {
    $activarUnidad = new AjaxUbicacionOpe();
    $activarUnidad->activarUnidad = $_POST["activarUnidad"];
    $activarUnidad->ajaxActivarUnidad();
}


if (isset($_POST["revVehUsados"])) {
    $mostrarVehUsado = new AjaxUbicacionOpe();
    $mostrarVehUsado->revVehUsados = $_POST["revVehUsados"];
    $mostrarVehUsado->dateReVehUs = $_POST["dateReVehUs"];
    $mostrarVehUsado->ajaxCalcVehUsados();
}

if (isset($_POST["idIngTrasladar"])) {
    $trasladoIngZAAF = new AjaxUbicacionOpe();
    $trasladoIngZAAF->idIngTrasladar = $_POST["idIngTrasladar"];
    $trasladoIngZAAF->ajaxTrasladoZAAF();
}


if (isset($_POST["saldosAF"])) {
    $verSaldosAF = new AjaxUbicacionOpe();
    $verSaldosAF->saldosAF = $_POST["saldosAF"];
    $verSaldosAF->ajaxMostrarSaldosAF();
}


if (isset($_POST["idtrans"])) {
    $anulacionOperaciones = new AjaxUbicacionOpe();
    $anulacionOperaciones->idtrans = $_POST["idtrans"];
    $anulacionOperaciones->idoperacion = $_POST["idoperacion"];
    $anulacionOperaciones->motivoAnula = $_POST["motivoAnula"];
    $anulacionOperaciones->ajaxAnularOperaciones();
}


if (isset($_POST["polizaIngDR"])) {
    $verSaldosDR = new AjaxUbicacionOpe();
    $verSaldosDR->polizaIngDR = $_POST["polizaIngDR"];
    $verSaldosDR->bltsDR = $_POST["bltsDR"];
    $verSaldosDR->cifDR = $_POST["cifDR"];
    $verSaldosDR->imptDR = $_POST["imptDR"];
    $verSaldosDR->ajaxRevisionDePolDR();
}

if (isset($_POST["tipoConsulRet"])) {
    $dataEditRetOp = new AjaxUbicacionOpe();
    $dataEditRetOp->tipoConsulRet = $_POST["tipoConsulRet"];
    $dataEditRetOp->idRetConsul = $_POST["idRetConsul"];
    $dataEditRetOp->ajaxDataEditRetOp();
}

if (isset($_POST["idDetRevEd"])) {
    $objDetalleM = new AjaxUbicacionOpe();
    $objDetalleM->idDetRevEd = $_POST["idDetRevEd"];
    $objDetalleM->ajaxVerDataDetalleEditRet();
}


if (isset($_POST["trasladoDefAf"])) {
    $trasladoAFDef = new AjaxUbicacionOpe();
    $trasladoAFDef->trasladoDefAf = $_POST["trasladoDefAf"];
    $trasladoAFDef->ajaxTrasladoDefinitivoAF();
}

if (isset($_POST["AnularRetiro"])) {
    $anRetiro = new AjaxUbicacionOpe();
    $anRetiro->AnularRetiro = $_POST["AnularRetiro"];
    $anRetiro->motvAnulacion = $_POST["motvAnulacion"];
    $anRetiro->ajaxAnularRetiro();
}

if (isset($_POST["generateTodosLosRetiros"])) {
    $mostrarRetiros = new AjaxUbicacionOpe();
    $mostrarRetiros->generateTodosLosRetiros = $_POST["generateTodosLosRetiros"];
    $mostrarRetiros->ajaxMostrarHistorialRetiros();
}

if (isset($_POST["fechaInicio"])) {
    $range = new AjaxUbicacionOpe();
    $range->fechaInicio = $_POST["fechaInicio"];
    $range->fechaFin = $_POST["fechaFin"];
    $range->ajaxMostrarRangoHistorial();
}

if (isset($_POST["busquedaPoliza"])) {
    $busquedaPol = new AjaxUbicacionOpe();
    $busquedaPol->busquedaPoliza = $_POST["busquedaPoliza"];
    $busquedaPol->ajaxMostrarBusquedaPoliza();
}

