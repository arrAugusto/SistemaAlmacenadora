<?php

require_once "../controlador/inventariosFiscales.controlador.php";
require_once "../modelo/inventariosFiscales.modelo.php";
require_once "../modelo/registroIngresoBodega.modelo.php";
//SESSION DE USUARIO PARA MANEJAR BITACORA
require_once "../controlador/usuario.controlador.php";
//CARGANDO FICHEROS DE METODOS DE HISTORIALES ING FISCALES
require_once "../controlador/historiaIngresosFisacales.controlador.php";
require_once "../modelo/historiaIngresosFisacales.modelo.php";

class dataTableInventarios {

    public function ajaxGestionInventario() {
        session_start();
        $valor = $_SESSION["idDeBodega"];
        //HACIENDO AJUSTES DE SALDOS INGRESOS STOCK GENERAL BUSCA Y AJUSTA POSIBLES ERRORES EN EL INVENATARIO
        $sp = "spSaldosInventario";
        $saldosAjuste = ModeloHistorialIngresos::mdlMostrarChasisVehContables($sp, $valor);
        if ($saldosAjuste != "SD") {
            foreach ($saldosAjuste as $key => $value) {
                $spStock = "spStockGeneral";
                $idIng = $value["id"];
                $saldosAjuste = ModeloHistorialIngresos::mdlMostrarChasisVehContables($spStock, $idIng);
            }
        }
        //HACIENDO AJUSTES DETALLES DE RETIROS
        $sp = "spDetallesAjustInv";
        $detalles = ModeloHistorialIngresos::mdlMostrarChasisVehContables($sp, $valor);
        $listaSuper = [];
        $sobregirosDet = [];
        $tipoSobregiro = 0;
        $erroresRebajas = [];
        $descuadre = 0;
        foreach ($detalles as $key => $value) {
            $detallesRebajados = json_decode($value["detallesRebajados"], true);
            if (is_array($detallesRebajados)) {
                $bultosAcumulado = 0;
                foreach ($detallesRebajados as $keyAdd => $valueAdd) {
                    $idDetalle = $valueAdd["idDetalles"];
                    $tipo = 0;
                    $revision = array_search(md5($idDetalle), $listaSuper);
                    if ($revision) {
                        $tipo = 1;
                    } else {
                        array_push($listaSuper, array("idDetalle" => md5($idDetalle)));
                    }
                    $cantBlts = $valueAdd["cantBultos"];
                    $bultosAcumulado = $bultosAcumulado + $cantBlts;
                    $cantPos = 0;
                    $valPosSalidaEdit = 0;
                    if ($valueAdd["estadoDet"] >= 2) {
                        $cantPos = $valueAdd["valPosSalidaEdit"];
                        $valPosSalidaEdit = $valueAdd["valMtsSalidaEdit"];
                    }
                    $sp = "spAjusteDeDetalle";
                    $saldosAjusteVeh = ModeloHistorialIngresos::mdlAjustarSaldoDetalles($idDetalle, $tipo, $cantBlts, $sp);
                    if ($saldosAjusteVeh[0]["resp"] == 2) {
                        $tipoSobregiro = $tipoSobregiro+1;
                        $polizaRet = $value["polizaRetiro"];
                        $polizaIng = $value["numeroPoliza"];
                        $detSobreGiro = array("idRet" => $value["idRet"], "detallesRebajados" => $value["detallesRebajados"], "bultos"=>$value["bultos"], "tipo"=>0);
                        array_push($sobregirosDet, $detSobreGiro);
                    }
                }
            }
            if ($bultosAcumulado != intval($value["bultos"])) {
                $descuadre = $descuadre+1;
                $polizaRet = $value["polizaRetiro"];
                $polizaIng = $value["numeroPoliza"];
                        $errorRebaja = array("idRet" => $value["idRet"], "detallesRebajados" => $value["detallesRebajados"], "bultos"=>$value["bultos"], "tipo"=>1);
                array_push($erroresRebajas, $errorRebaja);
            }
        }
        
        $bitacoraSaldos = ModeloHistorialIngresos::mdlBitacoraDiferenciasEnStock($sobregirosDet, $erroresRebajas, $tipoSobregiro, $descuadre);       
        //rutina finalizada
        
        $sp = "spSaldosInventarioVeh";
        $saldosAjusteVeh = ModeloHistorialIngresos::mdlMostrarChasisVehContables($sp, $valor);
        foreach ($saldosAjusteVeh as $key => $value) {
            $sp = "spStockGeneralVeh";
            $idIng = $value["id"];
            $saldosAjuste = ModeloHistorialIngresos::mdlMostrarChasisVehContables($sp, $idIng);
        }
        //FIN DE AJUSTES DE INGRESOS 
        //HACIENDO AJUSTES DE SALDOS INGRESOS STOCK GENERAL BUSCA Y AJUSTA POSIBLES ERRORES EN EL INVENATARIO

        $spInioAjusteInv = "InicioDetallesAjustes";
        $inicioAjuste = ModeloHistorialIngresos::mdlMostrarChasisVehContables($spInioAjusteInv, $valor);
        $spAjustes = "spDetallesAjustInv";
        $saldosAjusteDetalle = ModeloHistorialIngresos::mdlMostrarChasisVehContables($spAjustes, $valor);
        if ($saldosAjusteDetalle != "SD") {
            foreach ($saldosAjusteDetalle as $key => $value) {
                $datoArray = json_decode($value["detallesRebajados"], true);
                if (is_array($datoArray)) {
                    for ($i = 0; $i < count($datoArray); ++$i) {
                        $idDetalles = intval($datoArray[$i]["idDetalles"]);
                        $cantBultos = intval($datoArray[$i]["cantBultos"]);
                        $spDetAjuste = "ActualizarDetInv";
                        $saldosAjusteDetalle = ModeloHistorialIngresos::mdlMostrarTableIngHistoria($spDetAjuste, $idDetalles, $cantBultos);
                    }
                }
            }
            $sp = "spVehNew";
            $respIngVeh = ModeloHistorialIngresos::mdlMostrarSinParams($sp);


        }




        $sp = "spSaldosSuper";
        $respuesta = ModeloHistorialIngresos::mdlMostrarChasisVehContables($sp, $valor);

        if ($respuesta !== null || $respuesta !== null) {
            if ($respuesta == "SD") {
                
            } else {
                $contador = 0;
                $cabeza = '{
                            "data": [';
                echo $cabeza;
                foreach ($respuesta as $key => $value) {
                    $contador = $contador + 1;
                    // Con objetos
                    if ($_SESSION["departamentos"] == "Bodegas Fiscales" || $_SESSION["departamentos"] == "Operaciones Fiscales" && $_SESSION["niveles"] == "BAJO") {
                        if ($_SESSION["departamentos"] == "Bodegas Fiscales") {
                            if ($value["accionEstado"] >= 4) {
                                $botoneraAcciones = "<div class='btn-group'><a href='#divEdicionesBodega' class='btn btn-info btnEditBod btn-sm' estado=1 role='button' btnEditBod=" . $value['identificador'] . " ><i class='fa fa-edit'></i></a><div class='btn-group'><button type='button' buttonId=" . $value['identificador'] . " class='btn btn-success btnGeneracionExcel btn-sm'><i class='fa fa-file-excel-o'></i></button><div class='btn-group'><button type='button' buttonId=" . $value['identificador'] . " class='btn btn-danger btnGenerarPDf btn-sm'><i class='fa fa-file-pdf-o'></i></button></div>";
                            }
                        } else {
                            if ($value["accionEstado"] >= 4) {
                                $botoneraAcciones = "<div class='btn-group'><a href='#divEdicionesBodega' class='btn btn-info btnEditBod btn-sm' estado=1 role='button' btnEditBod=" . $value['identificador'] . " ><i class='fa fa-edit'></i></a><div class='btn-group'><button type='button' buttonId=" . $value['identificador'] . " class='btn btn-success btnGeneracionExcel btn-sm'><i class='fa fa-file-excel-o'></i></button><div class='btn-group'><button type='button' buttonId=" . $value['identificador'] . " class='btn btn-danger btnGenerarPDf btn-sm'><i class='fa fa-file-pdf-o'></i></button></div>";
                            }
                        }
                    } else {
                        $botoneraAcciones = "<div class='btn-group'><div class='btn-group'><button type='button' buttonId=" . $value['identificador'] . " class='btn btn-success btnGeneracionExcel btn-sm'><i class='fa fa-file-excel-o'></i></button><div class='btn-group'></div>";
                    }
                    $fecha_actual = new DateTime();
                    $cadena_fecha_actual = $value["fechaRegistro"];



                    $datoJsonIngHis = '[
                                    "' . $contador . '",
                                    "' . $respuesta[$key]["nit"] . '",
                                    "' . $value["empresa"] . '",
                                    "' . $value["poliza"] . '",                                        
                                    "' . $cadena_fecha_actual . '",
                                    "' . $value["blts"] . '",
                                    "' . $value["cif"] . '",
                                    "' . $value["impuesto"] . '",
                                    "' . $botoneraAcciones . '"
                    ],';
                    if ($key + 1 != count($respuesta)) {
                        echo $datoJsonIngHis;
                    }
                }
                $pie = substr($datoJsonIngHis, 0, -1);
                $pie .= ']}';
                echo $pie;
            }
        }
    }

}

//ACTIVAR HISTORIAL DE INGRESO DATATABLE
$activarHistorial = new dataTableInventarios();
$activarHistorial->ajaxGestionInventario();
