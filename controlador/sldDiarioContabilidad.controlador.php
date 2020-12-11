<?php

class ControladorSaldosContables {

    public static function ctrSaldoActualContabilidad() {
        $idDeBodega = $_SESSION["idDeBodega"];
        $sp = "spConsultaEmppresa";
        $respEmpresa = ModeloGenerarContabilidad::mdlMostrarContabilidad($sp, $idDeBodega);

        if ($respEmpresa[0]["idEmpresa"] >= 1) {
            $idEmpresa = $respEmpresa[0]["idEmpresa"];
        } else {
            return false;
        }
        $sp = "spSaldosContables";
        $idDeBodega = $respEmpresa[0]["idEmpresa"];
        $respSldsConta = ModeloGenerarContabilidad::mdlMostrarContabilidad($sp, $idDeBodega);

        if ($respSldsConta[0]["countImpts"] == 0 && $respSldsConta[0]["countCif"] == 0) {

            $respEmpresa = ControladorEmpresasAlmacenadoras::ctrMostrarEmpresa($idDeBodega);
            $empresa = $respEmpresa[0]["empresa"];
            echo '
                <tr>
                    <td>
                        <span class="ptable-title"><i class="fa fa-building-o"></i>' . $empresa . '</span></td>
                    <td>
                    <!-- Icon -->
                        CIF : Q <input class="form-control is-invalid" type="number" placeholder="Ejemplo : 250.25" id="cifInicial" onkeyup="javascript:this.value = this.value.toUpperCase();">
                        IMPUESTOS : Q <input class="form-control is-invalid" type="number" placeholder="Ejemplo : 250.25" id="impuestoInicial" onkeyup="javascript:this.value = this.value.toUpperCase();">
                    </td>
                    <td>
                    <!-- Icon -->
                        <i class="fa fa-save"></i>
                        <div class="btn-group"><button type="button" class="btn btn-primary btnInicialFiscal" btnInicia=' . $idDeBodega . '>Guardar Saldo Inicial</button></div>
                    </td>
                </tr>
            ';
            return true;
        }



        $sp = "spDatosContabilidad";
        $respVerDatos = ModeloGenerarContabilidad::mdlMostrarContabilidad($sp, $idDeBodega);

        $empresa = $respVerDatos[0]["empresa"];

        $idDeBodega = $respEmpresa[0]["idEmpresa"];
        $sp = "spsaldosContablesF";
        $respuesta = ModeloSaldosContables::mdlSaldoActualContabilidad($sp, $idDeBodega);
        if ($respuesta != "SD") {
            $saldoCif = $respuesta[0]["saldoCif"];
            $saldoImpuestos = $respuesta[0]["saldoImpuestos"];

            $saldoCif = number_format($saldoCif, 2);
            $saldoImpuestos = number_format($saldoImpuestos, 2);

            echo '
                <tr>
                    <td>
                        <span class="ptable-title"><i class="fa fa-building-o"></i>' . $empresa . '</span></td>
                    <td>
                    <!-- Icon -->
                        <span class="badge bg-warning" style="font-size: 15px;">CIF : Q ' . $saldoCif . '</span><br/>
                        <span class="badge bg-warning" style="font-size: 15px;">IMPUESTOS : Q ' . $saldoImpuestos . '</span>
                    </td>
                    <td>
                    <!-- Icon -->
                        <i class="fa fa-eye green"></i>
                        <div class="btn-group"><button type="button" class="btn btn-success btnHistoriaSaldos" btnVerHistoria=' . $idDeBodega . ' data-toggle="modal" data-target=".bd-example-modal-lg">Ver Historial</button><button type="button" class="btn btn-warning btnCorteContaPendt" btnCortesContables=' . $idDeBodega . ' data-toggle="modal" data-target="#modalCortesContables">Cierres Contables</button></div>
                    </td>
                </tr>
            ';
        }
    }
//()
        public static function ctrSaldoActualContabilidadAF() {
        $idDeBodega = $_SESSION["idDeBodega"];
        $sp = "spConsultaEmppresa";
        $respEmpresa = ModeloGenerarContabilidad::mdlMostrarContabilidad($sp, $idDeBodega);

        if ($respEmpresa[0]["idEmpresa"] >= 1) {
            $idEmpresa = $respEmpresa[0]["idEmpresa"];
        } else {
            return false;
        }
        $sp = "spSaldosContablesAF";
        $idDeBodega = $respEmpresa[0]["idEmpresa"];
        $respSldsConta = ModeloGenerarContabilidad::mdlMostrarContabilidad($sp, $idDeBodega);

        if ($respSldsConta[0]["countImpts"] == 0 && $respSldsConta[0]["countCif"] == 0) {

            $respEmpresa = ControladorEmpresasAlmacenadoras::ctrMostrarEmpresa($idDeBodega);
            $empresa = $respEmpresa[0]["empresa"];
            echo '
                <tr>
                    <td>
                        <span class="ptable-title"><i class="fa fa-building-o"></i>' . $empresa . '</span></td>
                    <td>
                    <!-- Icon -->
                        CIF : Q <input class="form-control is-invalid" type="number" placeholder="Ejemplo : 250.25" id="cifInicial" onkeyup="javascript:this.value = this.value.toUpperCase();">
                        IMPUESTOS : Q <input class="form-control is-invalid" type="number" placeholder="Ejemplo : 250.25" id="impuestoInicial" onkeyup="javascript:this.value = this.value.toUpperCase();">
                    </td>
                    <td>
                    <!-- Icon -->
                        <i class="fa fa-save"></i>
                        <div class="btn-group"><button type="button" class="btn btn-primary btnInicialFiscalAF" btnInicia=' . $idDeBodega . '>Guardar Saldo Inicial</button></div>
                    </td>
                </tr>
            ';
            return true;
        }



        $sp = "spDatosContabilidad";
        $respVerDatos = ModeloGenerarContabilidad::mdlMostrarContabilidad($sp, $idDeBodega);

        $empresa = $respVerDatos[0]["empresa"];

        $idDeBodega = $respEmpresa[0]["idEmpresa"];
        $sp = "spsaldosContablesF";
        $respuesta = ModeloSaldosContables::mdlSaldoActualContabilidad($sp, $idDeBodega);
        if ($respuesta != "SD") {
            $saldoCif = $respuesta[0]["saldoCif"];
            $saldoImpuestos = $respuesta[0]["saldoImpuestos"];

            $saldoCif = number_format($saldoCif, 2);
            $saldoImpuestos = number_format($saldoImpuestos, 2);

            echo '
                <tr>
                    <td>
                        <span class="ptable-title"><i class="fa fa-building-o"></i>' . $empresa . '</span></td>
                    <td>
                    <!-- Icon -->
                        <span class="badge bg-warning" style="font-size: 15px;">CIF : Q ' . $saldoCif . '</span><br/>
                        <span class="badge bg-warning" style="font-size: 15px;">IMPUESTOS : Q ' . $saldoImpuestos . '</span>
                    </td>
                    <td>
                    <!-- Icon -->
                        <i class="fa fa-eye green"></i>
                        <div class="btn-group"><button type="button" class="btn btn-success btnHistoriaSaldos" btnVerHistoria=' . $idDeBodega . ' data-toggle="modal" data-target=".bd-example-modal-lg">Ver Historial</button><button type="button" class="btn btn-warning btnCorteContaPendt" btnCortesContables=' . $idDeBodega . ' data-toggle="modal" data-target="#modalCortesContables">Cierres Contables</button></div>
                    </td>
                </tr>
            ';
        }
    }

    
    public static function ctrMostrarHistorial($viewHistorial) {
        $sp = "spSaldosCif";
        $respuesta = ModeloSaldosContables::mdlSaldoActualContabilidad($sp, $viewHistorial);
        return $respuesta;
    }

    public static function ctrMostrarHistorialImpts($viewHistorialImpts) {
        $sp = "spSaldosImpts";
        $respuesta = ModeloSaldosContables::mdlSaldoActualContabilidad($sp, $viewHistorialImpts);
        return $respuesta;
    }

    public static function ctrCortesPendientesContables($cortesPendiente) {
        $sp = "spCtrPendDia";
        $respuesta = ModeloSaldosContables::mdlSaldoActualContabilidad($sp, $cortesPendiente);
        return $respuesta;
    }

    public static function ctrSaldosInicioConta($idEmpInicalConta, $sldContableCif, $sldContableImpts, $tipoSaldoInicia) {
        if ($tipoSaldoInicia==0) {
        $sp = "spSldInicialConta";
        }else{
        $sp = "spSldInicialContaAF";
            
        }
        $respuesta = ModeloSaldosContables::mdlSaldosInicioConta($sp, $idEmpInicalConta, $sldContableCif, $sldContableImpts);
        return $respuesta;
    }

    public static function ctrReporteriaFecha($fechaReporteria, $idBodFecha) {

        $date = $fechaReporteria;
        if (!empty($date)) {
            $timestamp = strtotime($date);
            if ($timestamp === FALSE) {
                $timestamp = strtotime(str_replace('/', '-', $date));
            }
            $date = date('Y-m-d', $timestamp);
        }
        $sp = "spReportesContabilida";
        $tipo = 0;
        $ingresos = ModeloSaldosContables::mdlSaldosInicioConta($sp, $idBodFecha, $date, $tipo);
        $tipo = 1;
        $retiros = ModeloSaldosContables::mdlSaldosInicioConta($sp, $idBodFecha, $date, $tipo);
        $tipo = 2;
        $ajustes = ModeloSaldosContables::mdlSaldosInicioConta($sp, $idBodFecha, $date, $tipo);
        return array("idIngReportes" => $ingresos, "idRetReportes" => $retiros, "ajustes" => $ajustes);
    }

    public static function ctrMostrarAjusteConta($fechaReportAjuste, $idBodegaAjuste) {
        $date = $fechaReportAjuste;
        if (!empty($date)) {
            $timestamp = strtotime($date);
            if ($timestamp === FALSE) {
                $timestamp = strtotime(str_replace('/', '-', $date));
            }
            $date = date('Y-m-d', $timestamp);
        }

        $sp = "spReporteAjuste";
        $respuesta = ModeloSaldosContables::mdlMostrarAjusteConta($sp, $date, $idBodegaAjuste);
        return $respuesta;
    }

    public static function ctrSaldoActualContabilidadPolConta() {
        $idDeBodega = $_SESSION["idDeBodega"];
        $sp = "spConsultaEmppresa";
        $respEmpresa = ModeloGenerarContabilidad::mdlMostrarContabilidad($sp, $idDeBodega);
        if ($respEmpresa[0]["idEmpresa"] >= 1) {
            $idEmpresa = $respEmpresa[0]["idEmpresa"];
        } else {
            return false;
        }
        $sp = "spSaldosContables";
        $idDeBodega = $respEmpresa[0]["idEmpresa"];
        $respSldsConta = ModeloGenerarContabilidad::mdlMostrarContabilidad($sp, $idDeBodega);

        if ($respSldsConta[0]["countImpts"] == 0 && $respSldsConta[0]["countCif"] == 0) {

            return true;
        } else {





            $sp = "spDatosContabilidad";
            $respVerDatos = ModeloGenerarContabilidad::mdlMostrarContabilidad($sp, $idDeBodega);

            $empresa = $respVerDatos[0]["empresa"];

            $idDeBodega = $respEmpresa[0]["idEmpresa"];
            $sp = "spsaldosContablesF";
            $respuesta = ModeloSaldosContables::mdlSaldoActualContabilidad($sp, $idDeBodega);
            if ($respuesta != "SD") {
                $saldoCif = $respuesta[0]["saldoCif"];
                $saldoImpuestos = $respuesta[0]["saldoImpuestos"];

                $saldoCif = number_format($saldoCif, 2);
                $saldoImpuestos = number_format($saldoImpuestos, 2);

                echo '
                        <span class="ptable-title"><i class="fa fa-building-o">FISCAL</i> ' . $empresa . '</span>
                        <span class="badge bg-warning" style="font-size: 15px;">CIF : Q ' . $saldoCif . '</span>
                        <span class="badge bg-warning" style="font-size: 15px;">IMPUESTOS : Q ' . $saldoImpuestos . '</span>
                    
            ';
            }
        }
    }

    public static function ctrMostrarCuentas() {
        $sp = "spMtsCtaContables";
        $respuesta = ModeloSaldosContables::mdlMostrarCuentas($sp);
        return $respuesta;
    }

    public static function ctrGenerarAjusteContableIngRet($datePolAjuste, $idDeBodega, $montoCif, $montoImpuesto, $tipoAjuste) {
        $ajusteValCif = $montoCif;
        $ajusteVImpst = $montoImpuesto;
        $total = $ajusteValCif + $ajusteVImpst;
        $totalAjuste = round($total, 2);
        $sp = "spConsultaEmppresa";
        $respEmpresa = ModeloGenerarContabilidad::mdlMostrarContabilidad($sp, $idDeBodega);
        $dependencia = $respEmpresa[0]["idEmpresa"];
        $date = $datePolAjuste;
        if (!empty($date)) {
            $timestamp = strtotime($date);
            if ($timestamp === FALSE) {
                $timestamp = strtotime(str_replace('/', '-', $date));
            }
            $date = date('Y-m-d', $timestamp);
        }
        if ($tipoAjuste == "AjusteIngreso") {
            //  SOLICITANDO UN NUMERO DE POLIZA
            $sp = "spNumPolizas";
            $numAsigPoliza = ModeloGenerarContabilidad::mdlMostrarContabilidad($sp, $date);
            if ($numAsigPoliza[0]["resp"] >= 1) {
                $numeroDepolizaAsig = $numAsigPoliza[0]['resp'];
                /**
                 * SI ESTA CONDICION SE CUMPLE Y CIF E IMPUESTO SON MAYOR A 0 ENTONCES SE APLICA UNA POLIZA DE RETIRO
                 * YA QUE SE DEBE APLICAR UNA REBAJA AL TOTAL DE CIF E IMPUESTO PARA QUE REGRESE AL VALOR 0
                 * */
                /**
                 * DECLARANDO EL ASIENTO CONTABLE POR INGRESOS FISCALES 
                 * */
                $sp = "spAsientoContableAjuste"; //SP QUE CONECTA LA BASE DE DATOS Y GUARDA EL ASIENTO CONTABLE
                $conPolDefCif = "802103.0102"; //CUENTA UTILIZA DEFAULT PARA REGISTRAR CIF DE INGRESO EN POLIZA CONTABLE
                $estado = 1;
                $conceptoPoliza = "REGULARIZACION EN ZONA ADUANERA POR  DIFERENCIAL CAMBIARIO"; //EXPLICACION CONTABLE
                $debeCif = "DEBE"; //NATURALEZA DE CUENTA CONTABLE SUMA AL LIBRO DIARIO
                $tipOperaSaldo = "SUMA";
                $tipConcepto = "INGRESO CIF AJUSTE";
                $respIngCif = ModeloGenerarContabilidad::mdlGuardarPolContable($sp, $conPolDefCif, $dependencia, $ajusteValCif, $estado, $conceptoPoliza, $numeroDepolizaAsig, $debeCif, $tipOperaSaldo, $tipConcepto); //ENVIANDO PARAMETROS A UN OBJETO EN EL MODELO
                if ($respIngCif[0]["resp"] == 1) {
                    $conPolDefImpts = "801109.01"; //CUENTA DEFAULT PARA REGISTRAR IMPUESTOS INGRESO
                    $debeImpts = "DEBE"; //NATURALEZA DE CUENTA CONTABLE SUMA AL LIBRO DIARIO
                    $tipOperaSaldo = "SUMA";
                    $tipConcepto = "INGRESO IMPUESTOS AJUSTE";
                    $respIngImpts = ModeloGenerarContabilidad::mdlGuardarPolContable($sp, $conPolDefImpts, $dependencia, $ajusteVImpst, $estado, $conceptoPoliza, $numeroDepolizaAsig, $debeImpts, $tipOperaSaldo, $tipConcepto); //ENVIANDO PARAMETROS A UN OBJETO EN EL MODELO
                    if ($respIngImpts[0]["resp"] == 1) {
                        $haberPol = "HABER"; //NATURALEZA DE CUENTA CONTABLE QUE RESPALDA LA POLIZA
                        $cuentaPorContra = "888888"; //CUENTA QUE CARGA A SUS ANTERIORES DOS CUENTAS DE INGRESO
                        $tipOperaSaldo = "CONTRAPARTIDA";
                        $tipConcepto = "INGRESO CIF AJUSTE";
                        $respCuentaCarga = ModeloGenerarContabilidad::mdlGuardarPolContable($sp, $cuentaPorContra, $dependencia, $totalAjuste, $estado, $conceptoPoliza, $numeroDepolizaAsig, $haberPol, $tipOperaSaldo, $tipConcepto); //ENVIANDO PARAMETROS A UN OBJETO EN EL MODELO
                    }
                }
            } else {
                return "diaCerrado";
            }
        }
        if ($tipoAjuste == "AjusteRetiro") {
            //  SOLICITANDO UN NUMERO DE POLIZA
            $sp = "spNumPolizas";
            $numAsigPoliza = ModeloGenerarContabilidad::mdlMostrarContabilidad($sp, $date);
            if ($numAsigPoliza[0]["resp"] >= 1) {
                $numeroDepolizaAsig = $numAsigPoliza[0]['resp'];


                $sp = "spAsientoContable"; //SP QUE CONECTA LA BASE DE DATOS Y GUARDA EL ASIENTO CONTABLE
                $conPolDefCif = "888888"; //CUENTA UTILIZA DEFAULT PARA REGISTRAR CIF DE INGRESO EN POLIZA CONTABLE
                $estado = 1;
                $conceptoPoliza = "REGULARIZACION EN ZONA ADUANERA POR  DIFERENCIAL CAMBIARIO"; //EXPLICACION CONTABLE
                $debeCif = "DEBE"; //NATURALEZA DE CUENTA CONTABLE SUMA AL LIBRO DIARIO
                $tipOperaSaldo = "CONTRAPARTIDA";
                $tipConcepto = "POLIZA AJUSTE RETIRO";
                $respIngContra = ModeloGenerarContabilidad::mdlGuardarPolContable($sp, $conPolDefCif, $dependencia, $total, $estado, $conceptoPoliza, $numeroDepolizaAsig, $debeCif, $tipOperaSaldo, $tipConcepto); //ENVIANDO PARAMETROS A UN OBJETO EN EL MODELO
                if ($respIngContra[0]["resp"] == 1) {
                    $conPolDefCif = "802103.0102"; //CUENTA DEFAULT PARA REGISTRAR IMPUESTOS INGRESO
                    $debeCif = "HABER"; //NATURALEZA DE CUENTA CONTABLE SUMA AL LIBRO DIARIO
                    $tipOperaSaldo = "RESTA";
                    $tipConcepto = "RETIRO CIF AJUSTE";
                    $respIngCif = ModeloGenerarContabilidad::mdlGuardarPolContable($sp, $conPolDefCif, $dependencia, $ajusteValCif, $estado, $conceptoPoliza, $numeroDepolizaAsig, $debeCif, $tipOperaSaldo, $tipConcepto); //ENVIANDO PARAMETROS A UN OBJETO EN EL MODELO
                    if ($respIngCif[0]["resp"] == 1) {
                        $conPolDefImpst = "801109.01"; //CUENTA DEFAULT PARA REGISTRAR IMPUESTOS INGRESO
                        $debeImpst = "HABER"; //NATURALEZA DE CUENTA CONTABLE SUMA AL LIBRO DIARIO
                        $tipOperaSaldo = "RESTA";
                        $tipConcepto = "RETIRO IMPUESTOS AJUSTE";
                        $respIngCif = ModeloGenerarContabilidad::mdlGuardarPolContable($sp, $conPolDefImpst, $dependencia, $ajusteVImpst, $estado, $conceptoPoliza, $numeroDepolizaAsig, $debeImpst, $tipOperaSaldo, $tipConcepto); //ENVIANDO PARAMETROS A UN OBJETO EN EL MODELO
                    }
                }
            }
        }
    }

    public static function ctrMultipleAjusteContable($ajusteMultDate, $montoCifMult, $montoImpuestoMult, $tipoAjusteMult, $estadoIngImptsMult, $estadoIngCifMult, $estadoRetCifMult, $estadoRetImptsMult, $idDeBodega) {
        $ajusteValCif = $montoCifMult;
        $ajusteVImpst = $montoImpuestoMult;
        $total = $ajusteValCif + $ajusteVImpst;
        $totalAjuste = round($total, 2);
        $sp = "spConsultaEmppresa";
        $respEmpresa = ModeloGenerarContabilidad::mdlMostrarContabilidad($sp, $idDeBodega);
        $dependencia = $respEmpresa[0]["idEmpresa"];
        $date = $ajusteMultDate;
        if (!empty($date)) {
            $timestamp = strtotime($date);
            if ($timestamp === FALSE) {
                $timestamp = strtotime(str_replace('/', '-', $date));
            }
            $date = date('Y-m-d', $timestamp);
        }

        if ($estadoIngCifMult == 1) {
            //  SOLICITANDO UN NUMERO DE POLIZA
            $sp = "spNumPolizas";
            $numAsigPoliza = ModeloGenerarContabilidad::mdlMostrarContabilidad($sp, $date);
            if ($numAsigPoliza[0]["resp"] >= 1) {
                $numeroDepolizaAsig = $numAsigPoliza[0]['resp'];

                $sp = "spAsientoContable"; //SP QUE CONECTA LA BASE DE DATOS Y GUARDA EL ASIENTO CONTABLE
                $conPolDefCif = "802103.0102"; //CUENTA UTILIZA DEFAULT PARA REGISTRAR CIF DE INGRESO EN POLIZA CONTABLE
                $estado = 1;
                $conceptoPoliza = "REGULARIZACION EN ZONA ADUANERA POR  DIFERENCIAL CAMBIARIO"; //EXPLICACION CONTABLE
                $debeCif = "DEBE"; //NATURALEZA DE CUENTA CONTABLE SUMA AL LIBRO DIARIO
                $tipOperaSaldo = "RESTA";
                $tipConcepto = "RETIRO CIF AJUSTE";
                $respIngCif = ModeloGenerarContabilidad::mdlGuardarPolContable($sp, $conPolDefCif, $dependencia, $ajusteValCif, $estado, $conceptoPoliza, $numeroDepolizaAsig, $debeCif, $tipOperaSaldo, $tipConcepto); //ENVIANDO PARAMETROS A UN OBJETO EN EL MODELO
                if ($respIngCif[0]["resp"] == 1) {
                    $haberPol = "HABER"; //NATURALEZA DE CUENTA CONTABLE QUE RESPALDA LA POLIZA
                    $cuentaPorContra = "888888"; //CUENTA QUE CARGA A SUS ANTERIORES DOS CUENTAS DE INGRESO
                    $tipOperaSaldo = "CONTRAPARTIDA";
                    $tipConcepto = "RETIRO CIF AJUSTE";
                    $respCuentaCarga = ModeloGenerarContabilidad::mdlGuardarPolContable($sp, $cuentaPorContra, $dependencia, $ajusteValCif, $estado, $conceptoPoliza, $numeroDepolizaAsig, $haberPol, $tipOperaSaldo, $tipConcepto); //ENVIANDO PARAMETROS A UN OBJETO EN EL MODELO
                }
            }
        }
        if ($estadoIngImptsMult == 1) {

            //  SOLICITANDO UN NUMERO DE POLIZA
            $sp = "spNumPolizas";
            $numAsigPoliza = ModeloGenerarContabilidad::mdlMostrarContabilidad($sp, $date);
            if ($numAsigPoliza[0]["resp"] >= 1) {
                $numeroDepolizaAsig = $numAsigPoliza[0]['resp'];

                $sp = "spAsientoContable"; //SP QUE CONECTA LA BASE DE DATOS Y GUARDA EL ASIENTO CONTABLE
                $conPolDefCif = "801109.01"; //CUENTA UTILIZA DEFAULT PARA REGISTRAR CIF DE INGRESO EN POLIZA CONTABLE
                $estado = 1;

                $conceptoPoliza = "REGULARIZACION EN ZONA ADUANERA POR  DIFERENCIAL CAMBIARIO"; //EXPLICACION CONTABLE
                $debeCif = "DEBE"; //NATURALEZA DE CUENTA CONTABLE SUMA AL LIBRO DIARIO
                $tipOperaSaldo = "RESTA";
                $tipConcepto = "RETIRO IMPUESTOS AJUSTE";
                $respIngCif = ModeloGenerarContabilidad::mdlGuardarPolContable($sp, $conPolDefCif, $dependencia, $ajusteVImpst, $estado, $conceptoPoliza, $numeroDepolizaAsig, $debeCif, $tipOperaSaldo, $tipConcepto); //ENVIANDO PARAMETROS A UN OBJETO EN EL MODELO
                if ($respIngCif[0]["resp"] == 1) {
                    $haberPol = "HABER"; //NATURALEZA DE CUENTA CONTABLE QUE RESPALDA LA POLIZA
                    $cuentaPorContra = "888888"; //CUENTA QUE CARGA A SUS ANTERIORES DOS CUENTAS DE INGRESO
                    $tipOperaSaldo = "CONTRAPARTIDA";
                    $tipConcepto = "INGRESO IMPUESTOS AJUSTE";
                    $respCuentaCarga = ModeloGenerarContabilidad::mdlGuardarPolContable($sp, $cuentaPorContra, $dependencia, $ajusteVImpst, $estado, $conceptoPoliza, $numeroDepolizaAsig, $haberPol, $tipOperaSaldo, $tipConcepto); //ENVIANDO PARAMETROS A UN OBJETO EN EL MODELO
                }
            }
        }
        if ($estadoRetImptsMult == 1) {
            //  SOLICITANDO UN NUMERO DE POLIZA
            $sp = "spNumPolizas";
            $numAsigPoliza = ModeloGenerarContabilidad::mdlMostrarContabilidad($sp, $date);
            if ($numAsigPoliza[0]["resp"] >= 1) {
                $numeroDepolizaAsig = $numAsigPoliza[0]['resp'];
                /**
                 * DECLARANDO EL ASIENTO CONTABLE POR REIROS FISCALES 
                 * */
                $sp = "spAsientoContable"; //SP QUE CONECTA LA BASE DE DATOS Y GUARDA EL ASIENTO CONTABLE
                $conPolDefCif = "888888"; //CUENTA UTILIZA DEFAULT PARA REGISTRAR CIF DE INGRESO EN POLIZA CONTABLE
                $estado = 1;
                $conceptoPoliza = "REGULARIZACION EN ZONA ADUANERA POR  DIFERENCIAL CAMBIARIO"; //EXPLICACION CONTABLE
                $debeCif = "DEBE"; //NATURALEZA DE CUENTA CONTABLE SUMA AL LIBRO DIARIO
                $tipOperaSaldo = "CONTRAPARTIDA";
                $tipConcepto = "INGRESO IMPUESTOS AJUSTE";
                $respIngContra = ModeloGenerarContabilidad::mdlGuardarPolContable($sp, $conPolDefCif, $dependencia, $ajusteVImpst, $estado, $conceptoPoliza, $numeroDepolizaAsig, $debeCif, $tipOperaSaldo, $tipConcepto); //ENVIANDO PARAMETROS A UN OBJETO EN EL MODELO
                if ($respIngContra[0]["resp"] == 1) {
                    $conPolDefCif = "801109.01"; //CUENTA DEFAULT PARA REGISTRAR IMPUESTOS INGRESO
                    $debeCif = "HABER"; //NATURALEZA DE CUENTA CONTABLE SUMA AL LIBRO DIARIO
                    $tipOperaSaldo = "SUMA";
                    $tipConcepto = "INGRESO IMPUESTOS AJUSTE";
                    $respIngCif = ModeloGenerarContabilidad::mdlGuardarPolContable($sp, $conPolDefCif, $dependencia, $ajusteVImpst, $estado, $conceptoPoliza, $numeroDepolizaAsig, $debeCif, $tipOperaSaldo, $tipConcepto); //ENVIANDO PARAMETROS A UN OBJETO EN EL MODELO
                }
            }
        }

        if ($estadoRetCifMult == 1) {
            //  SOLICITANDO UN NUMERO DE POLIZA
            $sp = "spNumPolizas";
            $numAsigPoliza = ModeloGenerarContabilidad::mdlMostrarContabilidad($sp, $date);
            if ($numAsigPoliza[0]["resp"] >= 1) {
                $numeroDepolizaAsig = $numAsigPoliza[0]['resp'];

                $sp = "spAsientoContable"; //SP QUE CONECTA LA BASE DE DATOS Y GUARDA EL ASIENTO CONTABLE
                $conPolDefCif = "801109.01"; //CUENTA UTILIZA DEFAULT PARA REGISTRAR CIF DE INGRESO EN POLIZA CONTABLE
                $estado = 1;

                $conceptoPoliza = "REGULARIZACION EN ZONA ADUANERA POR  DIFERENCIAL CAMBIARIO"; //EXPLICACION CONTABLE
                $debeCif = "DEBE"; //NATURALEZA DE CUENTA CONTABLE SUMA AL LIBRO DIARIO
                $tipOperaSaldo = "RESTA";
                $tipConcepto = "RETIRO IMPUESTOS AJUSTE";
                $respIngCif = ModeloGenerarContabilidad::mdlGuardarPolContable($sp, $conPolDefCif, $dependencia, $ajusteValCif, $estado, $conceptoPoliza, $numeroDepolizaAsig, $debeCif, $tipOperaSaldo, $tipConcepto); //ENVIANDO PARAMETROS A UN OBJETO EN EL MODELO
                if ($respIngCif[0]["resp"] == 1) {
                    $haberPol = "HABER"; //NATURALEZA DE CUENTA CONTABLE QUE RESPALDA LA POLIZA
                    $cuentaPorContra = "888888"; //CUENTA QUE CARGA A SUS ANTERIORES DOS CUENTAS DE INGRESO
                    $tipOperaSaldo = "CONTRAPARTIDA";
                    $tipConcepto = "INGRESO IMPUESTOS AJUSTE";
                    $respCuentaCarga = ModeloGenerarContabilidad::mdlGuardarPolContable($sp, $cuentaPorContra, $dependencia, $ajusteValCif, $estado, $conceptoPoliza, $numeroDepolizaAsig, $haberPol, $tipOperaSaldo, $tipConcepto); //ENVIANDO PARAMETROS A UN OBJETO EN EL MODELO
                }
            }
        }
    }

    public static function ctrCorteContaDia($fechaCorteConta, $idEmpresaCorte) {
        $date = $fechaCorteConta;
        if (!empty($date)) {
            $timestamp = strtotime($date);
            if ($timestamp === FALSE) {
                $timestamp = strtotime(str_replace('/', '-', $date));
            }
            $date = date('Y-m-d', $timestamp);
        }
        $sp = "spEstadoContaDia";
        $estado = 1;
        
        $finalDia = ModeloGenerarContabilidad::mdlMostrarRetirosFiscales($sp, $fechaCorteConta, $estado);
                return $finalDia;
    }

}
