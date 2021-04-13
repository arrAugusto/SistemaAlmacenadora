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

        foreach ($detalles as $key => $value) {
            $lista = json_decode($value["detallesRebajados"], true);
            $listaRebaja = [];
            foreach ($lista as $keys => $values) {
                $idDetalle = $values["idDetalles"];
                $cantBultos = $values["cantBultos"];
                $valPosSalidaEdit = 0;
                $valMtsSalidaEdit = 0;
                if ($value["estadoRet"] >= 4) {
                    $valPosSalidaEdit = $values["valPosSalidaEdit"];
                    $valMtsSalidaEdit = $values["valMtsSalidaEdit"];
                }

                //
                $saldosAjuste = ModeloHistorialIngresos::mdlAjusteRet($value["idRet"], $value["idIng"], $idDetalle,
                        $cantBultos, $valPosSalidaEdit, $valMtsSalidaEdit);
            }
            var_dump($listaRebaja);
            return false;
        }
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


            foreach ($respIngVeh as $key => $value) {
                
            }
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
