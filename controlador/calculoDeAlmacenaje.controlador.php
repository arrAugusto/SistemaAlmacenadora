<?php

class ControladorCalculoDeAlmacenaje {

    public static function ctrPrepararCalculo($datos) {
        $idIngreso = $datos['idCalculoAlmacenaje'];
        $idDetalleCalc = $datos['hiddenIdentificador'];
        $idPoliza = $datos['calculoPolizaRetiro'];
        $respuestaVerifacacion = ModeloCalculoDeAlmacenaje::mdlVerificacionCalculo($idPoliza);
        $serPrestado = 0;
        $descuentoCalc = 0;

        if ($respuestaVerifacacion[0]["cantidadEstado"] == 0) {
            /*
              GUARDAR CALCULO DE ALMACENAJE NORMAL
             */
            $respuesta = ModeloCalculoDeAlmacenaje::mdlGuardarCalculo($datos);
            $idCalc = $respuesta[0]["Identity"];
            $Autorizacion = 1;
            $tipoOPCalc = "OkNuevo";
            /*
              CALCULAR DATO DE ALMACENAJE
             */
        } else if ($respuestaVerifacacion[0]["cantidadEstado"] >= 1) {

            /*
              MODIFICAR CALCULO ANTERIOR
             */
            $respuesta = ModeloCalculoDeAlmacenaje::mdlModificarCalculo($datos, $idIngreso, $idDetalleCalc);

            $Autorizacion = 1;
            $tipoOPCalc = "OkModificcion";
            $idCalc = $respuesta[0]["Identity"];
            $sp = "spVerMasRubros";
            $serPrestado = ModeloCalculoDeAlmacenaje::mdlVerificaTarifa($idCalc, $sp);
            $sp = "spVerDescuentos";
            $descuentoCalc = ModeloCalculoDeAlmacenaje::mdlVerificaTarifa($idCalc, $sp);
        }

        $respuestaCalculo = calculoDeAlmacenaje::ctrCalculoAlmacenajes($idIngreso, $idCalc, $tipoOPCalc);

        return array("datosCalculo" => $respuestaCalculo, "servPrestados" => $serPrestado, "descuentoCalc" => $descuentoCalc, "tipoOPCalc" => $tipoOPCalc);
    }

    public static function ctrVerificarMostrarTarifa($calculoTextParamBusqRet) {
        /*
          REQUERIDO POR METODO CONSULTA DE LOTE Y VERIFICACION PARA CALCULO DE ALMACENAJE
         */
        $respuesta = ModeloRetiroOpe::mdlMostrarBusqueda($calculoTextParamBusqRet);

        if ($respuesta == "SD") {
            return "SD";
        }
        $id = $respuesta[0]["idIng"];

        $identRet = null;
        $respuestaVerifica = ModeloCalculoDeAlmacenaje::mdlVerificarMostrarTarifa($id, $identRet);
        if ($respuestaVerifica[0]["srvCliente"] == "VEHICULOS NUEVOS") {
            if ($respuestaVerifica[0]["idUser"] == 0) {
                return array("bloque" => "SD", "resp" => "VNST");
            }
            if ($respuestaVerifica[0]["idUser"] >= 1) {
                return array("bloque" => "SD", "resp" => "VNT");
            }
        }

        if ($respuestaVerifica[0]["aplica"] >= 1) {
            if ($respuestaVerifica[0]["tarifaEspecial"] >= 1) {
                return array("bloque" => "SD", "resp" => "TE");
            }
            if ($respuestaVerifica[0]["estadoTarifa"] >= 1) {
                return array("bloque" => $respuesta, "resp" => "TN");
            }
            if ($respuestaVerifica[0]["tarifaNormal"] >= 1) {
                return array("bloque" => $respuesta, "resp" => "TN");
            }
        }
        if ($respuestaVerifica[0]["aplica"] == 0) {
            return array("bloque" => $respuesta, "resp" => "TN");
        }
    }

    public static function ctrCalculosRealizados($idIngresoCalculo) {
        $respuesta = ModeloCalculoDeAlmacenaje::mdlCalculosRealizados($idIngresoCalculo);
        return $respuesta;
    }

    public static function ctrOtrosServiciosExtraGd($otrosExtra, $listaDefaultExtra, $hiddenDescuento, $polizaExtraSer, $valCalculado, $hiddenTipoOP, $estado, $idRetCal) {
        $otrosExtraArray = json_decode($otrosExtra, true);
        $listaDefaultExtraArray = json_decode($listaDefaultExtra, true);
        date_default_timezone_set('America/Guatemala');
        $time = date('Y-m-d H:i:s');
        $respuestaVerifacacion = ModeloCalculoDeAlmacenaje::mdlVerificacionCalculo($polizaExtraSer);
        $sp = "spVerIdCalc";
        $repIdCalc = ModeloCalculoDeAlmacenaje::mdlVerificaTarifa($polizaExtraSer, $sp);
        if ($repIdCalc != "SD") {
            $idCalculo = $repIdCalc[0]["id"];
            if ($respuestaVerifacacion[0]["cantidadEstado"] == 0) {
                return "sinCalculo";
            }

            //guardando servicios y descuentos en la db foreach para recorrer el array de servicios y el dato de descuento

            if ($respuestaVerifacacion[0]["cantidadEstado"] == 1) {
                if (!empty($otrosExtraArray) >= 1) {
                    foreach ($otrosExtraArray as $key => $value) {
                        //$idCalculo, $idServicio
                        $tipo = 0;
                        $sp = "spOtrosServicios";
                        $idServicio = $value["serviciosOtros"];
                        $valorOtros = $value["valorOtros"];
                        $calcRev = ModeloCalculoDeAlmacenaje::mdlVerificarCalculo($idCalculo, $idServicio, $tipo, $sp);

                        if ($calcRev == "SD") {
                            $respuesta = ModeloCalculoDeAlmacenaje::mdlInsertRubroExtraCalculo($idCalculo, $idServicio, $valorOtros, $time, $estado, $tipo, $idRetCal);
                        } else {
                            $sp = "spModificarRubrosSerCalc";
                            $respuesta = ModeloCalculoDeAlmacenaje::mdlModificarCalculoSerExtra($idCalculo, $idServicio, $tipo, $valorOtros, $estado, $idRetCal, $sp);
                        }
                    }
                }
                if (!empty($listaDefaultExtraArray) >= 1) {
                    foreach ($listaDefaultExtraArray as $key => $value) {
                        $tipo = 1;
                        $idServicio = $value["serviciosDefault"];
                        $sp = "spOtrosServicios";
                        $valorOtros = $value["valServicios"];
                        $calcRevDef = ModeloCalculoDeAlmacenaje::mdlVerificarCalculo($idCalculo, $idServicio, $tipo, $sp);

                        if ($calcRevDef == "SD") {
                            $respuesta = ModeloCalculoDeAlmacenaje::mdlInsertRubroExtraCalculo($idCalculo, $idServicio, $valorOtros, $time, $estado, $tipo, $idRetCal);
                        } else {
                            $sp = "spModificarRubrosSerCalc";
                            $respuesta = ModeloCalculoDeAlmacenaje::mdlModificarCalculoSerExtra($idCalculo, $idServicio, $tipo, $valorOtros, $estado, $idRetCal, $sp);
                        }
                    }
                }
                if ($valCalculado >= 0.0001) {
                    $tipo = 1;
                    $sp = "spRevDescCalcExis";
                    $revDesc = ModeloCalculoDeAlmacenaje::mdlVerificaTarifaDosParms($idCalculo, $tipo, $sp);

                    if ($revDesc == "SD") {
                        $respuesta = ModeloCalculoDeAlmacenaje::mdInsertDescuentoCalc($idCalculo, $valCalculado, $time, $estado, $hiddenTipoOP, $hiddenDescuento, $idRetCal);
                    } else {

                        $sp = "spRevDescCalc";
                        $respuesta = ModeloCalculoDeAlmacenaje::mdlModificarCalculoSerExtra($idCalculo, $hiddenDescuento, $tipo, $valCalculado, $estado, $idRetCal, $sp);
                    }
                }
            }
            return "Oks";
        }
    }

    public static function ctrExistePoliza($verPoliza) {
        $sp = "spMstCalculo";
        $respuesta = ModeloCalculoDeAlmacenaje::mdlRevisionCalculospol($verPoliza, $sp);
        return $respuesta;
    }

}

class calculoDeAlmacenaje {

    public static function ctrCalculoAlmacenajes($idIngreso, $idCalc, $tipoOPCalc) {
        $identRet = 0;
        $respuestaVerifica = ModeloCalculoDeAlmacenaje::mdlVerificarMostrarTarifa($idIngreso, $identRet);

        if ($respuestaVerifica[0]["estadoTarifa"] == 1) {
            $mensaje = 1;
        } else {
            $mensaje = 0;
        }

        if ($respuestaVerifica[0]["tarifaEspecial"] == 0 && $respuestaVerifica[0]["estadoTarifa"] == 1 || $respuestaVerifica[0]["estadoTarifa"] == 0 && $respuestaVerifica[0]["tarifaNormal"] == 0) {
            // OBJETO DECLARADO Y UTILIZADO PARA OBTENER VALORES DE EL INGRESO.
            $sp = "spDatosCalculoIng";
            $datosIng = ModeloCalculoDeAlmacenaje::mdlVerificaTarifa($idIngreso, $sp);
            // OBJETO UTILIZADO PARA OBTENER VALORES GUARDADOS POR EL USUARIOS, PARA CALCULO DE ALMACENAJE
            $sp = "spDatosSalida";
            $datosIngSalida = ModeloCalculoDeAlmacenaje::mdlVerificaTarifa($idCalc, $sp);
            //OBJETO UTILIZADO PARA OBTENER LOS PARAMETROS DE LA TARIFA
            $sp = "spDataCalculoNormal";
            $familia = $datosIng[0]["familiaPoliza"];
            $datosIngCalculo = ModeloCalculoDeAlmacenaje::mdlVerificaTarifa($familia, $sp);
            // OBTENINIENDO LOS VALORES PARA EL CALCULO DE ALMACENAJE DE LOS ARRAYS
            if ($datosIng != "SD" && $datosIngSalida != "SD" && $datosIngCalculo != "SD") {

                /*
                 *  DATOS PARA GENERAR EL RUBRO ALMACENAJES
                 */
                $cif = $datosIngSalida[0]["valorCif"]; // VALOR CIF
                $peridoAlm = $datosIngCalculo[0]["PeriodoAlmacenaje"]; // PERIODO DE ALMACENAJE
                $TarifaAlm = $datosIngCalculo[0]["tarifaAlmacenaje"]; // TARIFA DE ALMACENAJE
                $minAlmacenaje = $datosIngCalculo[0]["minimoAlmacenaje"]; // MINIMO DE ALMACENAJE
                /*
                 *  DATOS PARA GENERAR EL RUBRO DE ZONA ADUANERA
                 */
                $impuestos = $datosIngSalida[0]["valorImpuesto"]; // VALOR IMPUESTO
                $peridoZona = $datosIngCalculo[0]["PeriodoZonaAduanera"]; // PERIODO ZONA ADUANA
                $tarifaZA = $datosIngCalculo[0]["tarifaZonaAduanera"]; // TARIFA DE ZONA ADUANA
                $minZonaAduanera = $datosIngCalculo[0]["minimoZonaAduanera"]; // MINIMO DE ZONA ADUANA
                /*
                 *  DATOS PARA GENERAR EL RUBRO DE MANEJO
                 */
                $baseManejo = $datosIngCalculo[0]["baseManejo"]; // BASE DE MANEJO
                $tarifaManejo = $datosIngCalculo[0]["tarifaManejo"]; // TARIFA DE MANEJO
                $valPeso = $datosIngSalida[0]["pesoKG"]; // PESO KG DEL RETIRO
                $minimoManejo = $datosIngCalculo[0]["minimoManejo"]; // MINIMO DE MANEJO
                /*
                 *  DATOS PARA GENERA EL RUBRO DE GASTOS ADMINISTRACIÓN
                 */
                $TarifaGtsAdmin = $datosIngCalculo[0]["tarifaGastosAdministrativos"] * $datosIng[0]["cantidadContenedores"]; // TARIFA GASTOS ADMINISTRACION * CANTIDAD DE CONTENEDORES
                $cantClientes = $datosIng[0]["cantidadClientes"]; // CANTIDAD DE CLIENTES
                $minGastosAdministracion = $datosIngCalculo[0]["minGastosAdministracion"]; // MINIMO POR GASTOS DE ADMINISTRACION
                $defaultCopias = $datosIngCalculo[0]["tarifaFotocopias"]; // FOTOCOPIAS POR CLIENTE
                $fechaVencimiento = $datosIngCalculo[0]["fechaVencimiento"]; // VENCIMIENTO DE LA TARIFA
                $fechaSalida = $datosIngSalida[0]["fechaCalculo"]; // FECHA DE SALIDA DE LA MERCADERIA
                $fechaIngreso = $datosIng[0]["fechaRealIng"]; // FECHA DE INGRESO
                $tiempoTotal = funcionesDeCalculo::dias($fechaIngreso, $fechaSalida); // DIAS TOTAL EN ALMACENADORA      
                /*
                 * SI EL TIEMPO TOTAL ES SUPERIOR A FECHA DE INGRESO Y SUPERA AL TIEMPO 
                 * QUE NO SE COBRA ALMACENAJE, SE CALCULAN LOS DIAS QUE SE COBRAR ALMACENAJES
                 */
                if ($tiempoTotal >= $datosIngCalculo[0]["delZA"]) {
                    $tiempoAlmacenaje = ($tiempoTotal - $datosIngCalculo[0]["delZA"]) + 1; // DIAS DE ALMACENAJE, MAS EL DIA QUE INGRESO
                    $diasZA = $tiempoTotal - $tiempoAlmacenaje;
                } else if ($tiempoTotal < $datosIngCalculo[0]["delZA"]) {
                    $tiempoAlmacenaje = 0;
                    $diasZA = $tiempoTotal - $tiempoAlmacenaje;
                }
                
                $respuestaAlmacenaje = calculosRubros::almacenajeFiscalCalculo($peridoAlm, $TarifaAlm, $impuestos, $tiempoAlmacenaje, $minAlmacenaje); // OBJETO CALCULA ALMACENAJE EN BASE A LOS PARAMETROS.
                $respuestaZonaAduanera = calculosRubros::zonaAduaneraCalculo($diasZA, $peridoZona, $tarifaZA, $cif, $minZonaAduanera); // OBJETO CALCULA EL RUBRO ZONA ADUANERA
                $respuestaManejo = calculosRubros::manejoCalculo($baseManejo, $tarifaManejo, $valPeso, $minimoManejo); // OBJETO CALCULA EL VALOR MANEJO
                $respuestaGastosAdmin = calculosRubros::gastosAdminCalculo($TarifaGtsAdmin, $cantClientes, $minGastosAdministracion); // OBJETO CALCULA GASTOS ADMIN
                $gtoAdminMSuperior = ceil($respuestaGastosAdmin);
                $almaMSuperior = ceil($respuestaAlmacenaje / 10) * 10;
                if ($datosIng[0]["familiaPoliza"] == 1) {
                    $zonaAduaneraCalc = intval($respuestaZonaAduanera);
                    $zonaAduanMSuperior = ceil($zonaAduaneraCalc / 10) * 10 + $defaultCopias;
                } else if ($datosIng[0]["familiaPoliza"] == 2) {
                    $zonaAduaneraCalc = intval($respuestaZonaAduanera);
                    $zonaAduanMSuperior = ceil($zonaAduaneraCalc / 5) * 5 + $defaultCopias;
                }

                $totalCobrar = ($almaMSuperior + $zonaAduanMSuperior + $respuestaManejo + $gtoAdminMSuperior);
                $datos = array("almaMSuperior" => $almaMSuperior, "zonaAduanMSuperior" => $zonaAduanMSuperior, "calculoManejo" => $respuestaManejo, "gtoAdminMSuperior" => $gtoAdminMSuperior, "tiempoTotal" => $tiempoTotal, "cobrar" => $totalCobrar);
                $datosCliente = array("empresa" => $datosIng[0]["nombreEmpresa"],
                    "polizaIng" => $datosIng[0]["numeroPoliza"], "reg" => $datosIng[0]["regimen"],
                    "tiempo" => $tiempoTotal,
                    "nit" => $datosIng[0]["nitEmpresa"], "fechaIng" => $fechaIngreso, "tipoOpCalc" => $tipoOPCalc, "fechaRetiro" => $fechaSalida);
                return array("datos" => $datos, "respuestaData" => $datosCliente, "mensaje" => $mensaje);
            }
        } else if ($respuestaVerifica[0]["tarifaNormal"] == 1) {
            // OBJETO DECLARADO Y UTILIZADO PARA OBTENER VALORES DEL INGRESO.
            $sp = "spDatosCalculoIng";
            $datosIng = ModeloCalculoDeAlmacenaje::mdlVerificaTarifa($idIngreso, $sp);
            // OBJETO UTILIZADO PARA OBTENER VALORES GUARDADOS POR EL USUARIOS, PARA CALCULO DE ALMACENAJE
            $sp = "spDatosSalida";
            $datosIngSalida = ModeloCalculoDeAlmacenaje::mdlVerificaTarifa($idCalc, $sp);
            //OBJETO UTILIZADO PARA OBTENER LOS PARAMETROS DE LA TARIFA
            $sp = "spDataCalculo";
            $datosIngCalculo = ModeloCalculoDeAlmacenaje::mdlVerificaTarifa($idIngreso, $sp);
            // OBTENINIENDO LOS VALORES PARA EL CALCULO DE ALMACENAJE DE LOS ARRAYS
            if ($datosIng != "SD" && $datosIngSalida != "SD" && $datosIngCalculo != "SD") {
                /*
                 *  DATOS PARA GENERAR EL RUBRO ALMACENAJES
                 */
                $cif = $datosIngSalida[0]["valorCif"]; // VALOR CIF
                $peridoAlm = $datosIngCalculo[0]["PeriodoAlmacenaje"]; // PERIODO DE ALMACENAJE
                $TarifaAlm = $datosIngCalculo[0]["tarifaAlmacenaje"]; // TARIFA DE ALMACENAJE
                $minAlmacenaje = $datosIngCalculo[0]["minimoAlmacenaje"]; // MINIMO DE ALMACENAJE
                /*
                 *  DATOS PARA GENERAR EL RUBRO DE ZONA ADUANERA
                 */
                $impuestos = $datosIngSalida[0]["valorImpuesto"]; // VALOR IMPUESTO
                $peridoZona = $datosIngCalculo[0]["PeriodoZonaAduanera"]; // PERIODO ZONA ADUANA
                $tarifaZA = $datosIngCalculo[0]["tarifaZonaAduanera"]; // TARIFA DE ZONA ADUANA
                $minZonaAduanera = $datosIngCalculo[0]["minimoZonaAduanera"]; // MINIMO DE ZONA ADUANA
                /*
                 *  DATOS PARA GENERAR EL RUBRO DE MANEJO
                 */
                $baseManejo = $datosIngCalculo[0]["baseManejo"]; // BASE DE MANEJO
                $tarifaManejo = $datosIngCalculo[0]["tarifaManejo"]; // TARIFA DE MANEJO
                $valPeso = $datosIngSalida[0]["pesoKG"]; // PESO KG DEL RETIRO
                $minimoManejo = $datosIngCalculo[0]["minimoManejo"]; // MINIMO DE MANEJO
                /*
                 *  DATOS PARA GENERA EL RUBRO DE GASTOS ADMINISTRACIÓN
                 */
                $TarifaGtsAdmin = $datosIngCalculo[0]["tarifaGastosAdministrativos"] * $datosIng[0]["cantidadContenedores"]; // TARIFA GASTOS ADMINISTRACION * CANTIDAD DE CONTENEDORES
                $cantClientes = $datosIng[0]["cantidadClientes"]; // CANTIDAD DE CLIENTES
                $minGastosAdministracion = $datosIngCalculo[0]["minGastosAdministracion"]; // MINIMO POR GASTOS DE ADMINISTRACION
                $defaultCopias = $datosIngCalculo[0]["tarifaFotocopias"]; // FOTOCOPIAS POR CLIENTE
                $fechaVencimiento = $datosIngCalculo[0]["fechaVencimiento"]; // VENCIMIENTO DE LA TARIFA

                $fechaSalida = $datosIngSalida[0]["fechaCalculo"]; // FECHA DE SALIDA DE LA MERCADERIA
                $fechaIngreso = $datosIng[0]["fechaRealIng"]; // FECHA DE INGRESO
                $tiempoTotal = funcionesDeCalculo::dias($fechaIngreso, $fechaSalida); // DIAS TOTAL EN ALMACENADORA      
                /*
                 * SI EL TIEMPO TOTAL ES SUPERIOR A FECHA DE INGRESO Y SUPERA AL TIEMPO 
                 * QUE NO SE COBRA ALMACENAJE, SE CALCULAN LOS DIAS QUE SE COBRAR ALMACENAJES
                 */
                if ($tiempoTotal >= $datosIngCalculo[0]["delZA"]) {
                    $tiempoAlmacenaje = ($tiempoTotal - $datosIngCalculo[0]["delZA"]) + 1; // DIAS DE ALMACENAJE, MAS EL DIA QUE INGRESO
                    $diasZA = $tiempoTotal - $tiempoAlmacenaje;
                } else if ($tiempoTotal < $datosIngCalculo[0]["delZA"]) {
                    $tiempoAlmacenaje = 0;
                    $diasZA = $tiempoTotal - $tiempoAlmacenaje;
                }
                $respuestaAlmacenaje = calculosRubros::almacenajeFiscalCalculo($peridoAlm, $TarifaAlm, $impuestos, $tiempoAlmacenaje, $minAlmacenaje); // OBJETO CALCULA ALMACENAJE EN BASE A LOS PARAMETROS.
                $respuestaZonaAduanera = calculosRubros::zonaAduaneraCalculo($diasZA, $peridoZona, $tarifaZA, $cif, $minZonaAduanera); // OBJETO CALCULA EL RUBRO ZONA ADUANERA
                $respuestaManejo = calculosRubros::manejoCalculo($baseManejo, $tarifaManejo, $valPeso, $minimoManejo); // OBJETO CALCULA EL VALOR MANEJO
                $respuestaGastosAdmin = calculosRubros::gastosAdminCalculo($TarifaGtsAdmin, $cantClientes, $minGastosAdministracion); // OBJETO CALCULA GASTOS ADMIN
                $gtoAdminMSuperior = ceil($respuestaGastosAdmin);
                $almaMSuperior = ceil($respuestaAlmacenaje / 10) * 10;
                $zonaAduaneraCalc = intval($respuestaZonaAduanera);
                $zonaAduanMSuperior = ceil($zonaAduaneraCalc / 10) * 10 + $defaultCopias;
                $totalCobrar = ($almaMSuperior + $zonaAduanMSuperior + $respuestaManejo + $gtoAdminMSuperior);
                $datos = array("almaMSuperior" => $almaMSuperior, "zonaAduanMSuperior" => $zonaAduanMSuperior, "calculoManejo" => $respuestaManejo, "gtoAdminMSuperior" => $gtoAdminMSuperior, "tiempoTotal" => $tiempoTotal, "cobrar" => $totalCobrar);
                $datosCliente = array("empresa" => $datosIng[0]["nombreEmpresa"],
                    "polizaIng" => $datosIng[0]["numeroPoliza"], "reg" => $datosIng[0]["regimen"],
                    "tiempo" => $tiempoTotal,
                    "nit" => $datosIng[0]["nitEmpresa"], "fechaIng" => $fechaIngreso, "tipoOpCalc" => $tipoOPCalc, "fechaRetiro" => $fechaSalida);
                return array("datos" => $datos, "respuestaData" => $datosCliente, "mensaje" => $mensaje);
            }
        }
    }

}
