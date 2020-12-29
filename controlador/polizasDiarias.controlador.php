<?php

class ControladorGenerarContabilidad {

    public static function ctrGenerarPolizasDiarias($fechaContable) {
        if (date('Y-m-d', strtotime($fechaContable)) == $fechaContable) {
            $respuesta = ModeloGenerarContabilidad::mdlGenerarPolizasDiarias($fechaContable);
            return $respuesta;
        } else {
            return false;
        }
    }

    public static function ctrCtsContables() {
        $respuesta = ModeloGenerarContabilidad::mdlCtsContables();
        return $respuesta;
    }

    public static function ctrMostrarContabilidad() {

        $idDeBodega = $_SESSION["idDeBodega"];
        $sp = "spContabilidad";
        $tipo = 0;
        $respMostIng = ModeloGenerarContabilidad::mdlMostrarContabilidad($sp, $tipo);

        if ($respMostIng[0]["totalCifIngMerca"] > 0) {
            $cif = $respMostIng[0]["totalCifIngMerca"];
            $numberCif = number_format($cif, 2);
            $impuesto = $respMostIng[0]["totalImpuestoIngMerca"];

            $numImpuesto = number_format($impuesto, 2);
            $total = ($cif + $impuesto);
            $numTotal = number_format($total, 2);
            echo '
            <tbody>
                <tr>
                    <th scope="row">802103.0102</th>
                    <td>CON PÓLIZA DEFINITIVA</td>
                    <td><h8 class="float-left">Q.</h8><h8 class="float-right">' . $numberCif . '</h8></td>
                    <td></td>
                </tr>
                <tr>
                    <th scope="row">801109.01</th>
                    <td>IMPUESTOS DE MERCADERÍAS EN BOD. FISCALES</td>
                    <td><h8 class="float-left">Q.</h8><h8 class="float-right">' . $numImpuesto . '</h8></td>                    <td></td>
                    </tr>
                <tr>
                    <th scope="row">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;888888</th>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CUENTAS DE ORDEN POR CONTRA</td>
                    <td></td>
                    <td><h8 class="float-left">Q.</h8><h8 class="float-right">' . $numTotal . '</h8></td>                    <td></td>
                </tr>
                <tr>
                    <th scope="row"></th>
                    <td>INGRESOS DE CIF E IMPUESTOS EN ZONA ADUANERADE BODEGAS Y PREDIO DE VEHICULOS</td>
                    <td><b class="float-left">Q.</b><b class="float-right">' . $numTotal . '</b></td>
                    <td><b class="float-left">Q.</b><b class="float-right">' . $numTotal . '</b></td>
                </tr>    
            </tbody>


';
        }

        $sp = "spContabilidad";
        $tipo = 1;
        $respMostRet = ModeloGenerarContabilidad::mdlMostrarContabilidad($sp, $tipo);
        $cifRet = $respMostRet[0]["totalCifRetMerca"];
        $numberCifRet = number_format($cifRet, 2);
        $impuestoRet = $respMostRet[0]["totalImpuestoRetMerca"];
        $numImpuestoRet = number_format($impuestoRet, 2);
        $total = ($cifRet + $impuestoRet);
        $numTotalRet = number_format($total, 2);

        echo '
            <tbody style="border-top: 4px solid #084587">
                <tr>
                    <th scope="row">802103.0102</th>
                    <td>CON PÓLIZA DEFINITIVA</td>
                    <td><h8 class="float-left">Q.</h8><h8 class="float-right">' . $numberCifRet . '</h8></td>
                    <td></td>
                </tr>
                <tr>
                    <th scope="row">801109.01</th>
                    <td>IMPUESTOS DE MERCADERÍAS EN BOD. FISCALES</td>
                    <td><h8 class="float-left">Q.</h8><h8 class="float-right">' . $numImpuestoRet . '</h8></td>                    <td></td>
                    </tr>
                <tr>
                    <th scope="row">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;888888</th>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CUENTAS DE ORDEN POR CONTRA</td>
                    <td></td>
                    <td><h8 class="float-left">Q.</h8><h8 class="float-right">' . $numTotalRet . '</h8></td>                    <td></td>
                </tr>
                <tr>
                    <th scope="row"></th>
                    <td>INGRESOS DE CIF E IMPUESTOS EN ZONA ADUANERADE BODEGAS Y PREDIO DE VEHICULOS</td>
                    <td><b class="float-left">Q.</b><b class="float-right">' . $numTotalRet . '</b></td>
                    <td><b class="float-left">Q.</b><b class="float-right">' . $numTotalRet . '</b></td>
                </tr>    
            </tbody>';
    }

    public static function ctrMostrarReportes() {
        $iBodEmpresa = $_SESSION["idDeBodega"];
        $sp = "spConsultaEmppresa";
        $respEmpresa = ModeloGenerarContabilidad::mdlMostrarContabilidad($sp, $iBodEmpresa);
        if ($respEmpresa[0]["idEmpresa"] > 0) {
            $idEmpresa = $respEmpresa[0]["idEmpresa"];
        } else {
            return false;
        }
        $sp = "spIndentIngresos";
        $respIng = ModeloGenerarContabilidad::mdlMostrarIng($sp);
        if ($respIng != "SD") {
            $ajustesContaLote = [];
            $listaAreas = [];
            foreach ($respIng as $key => $value) {
                $idContbilidades = $value["numeroBodegaFiscal"];
                $sp = "spMostrarDetCont";
                $respVerDatos = ModeloGenerarContabilidad::mdlMostrarContabilidad($sp, $idContbilidades);
                $sp = "spAjustesContables";
                $respAjustes = ModeloGenerarContabilidad::mdlMostrarContabilidad($sp, $idContbilidades);
                if ($respAjustes != "SD") {
                    array_push($ajustesContaLote, $respAjustes);
                }
                $ident = $idContbilidades;
                $empresa = $respVerDatos[0]["empresa"];
                $area = $respVerDatos[0]["areasAutorizadas"];
                $bodega = $respVerDatos[0]["numeroIdentidad"];
                $arrayLista = array("ident" => $ident, "empresa" => $empresa, "area" => $area, "bodega" => $bodega);
                array_push($listaAreas, $arrayLista);
            }

            echo '
            <tr><td id="saltoTD" colspan="3"><center><h2 class="text-center text-success">INGRESOS ALMACENADORA INTEGRADA, S.A.</h2></center></td></tr>
            <tr><td id="saltoTD" colspan="3"></td></tr>
            <tr>
                <th>Area Reportada<br/>&nbsp;</th>
                <th class="highlight">
                    Valores<br/>&nbsp;
                </th>
                <th>
                    Acciones
                    <br/>&nbsp;
                </th>
            </tr>
            </thead>
            <tbody>';
            foreach ($listaAreas as $key => $value) {

                $ident = $value["ident"];
                $empresa = $value["empresa"];
                $area = $value["area"];
                $bodega = $value["bodega"];
                if ($key % 2 != 0) {
                    $sp = "spMostrarTotalesConta";
                    $respSumTotal = ModeloGenerarContabilidad::mdlMostrarContabilidad($sp, $ident);
                    $sumCif = $respSumTotal[0]["sumCif"];
                    $sumImpuesto = $respSumTotal[0]["sumImpuesto"];

                    $numberSumCif = number_format($sumCif, 2);
                    $numberSumImpuesto = number_format($sumImpuesto, 2);
                    echo '
                <tr>
                    <td>
                        <span class="ptable-title"><i class="fa fa-building-o"></i>' . $empresa . ' ' . $area . ' ' . $bodega . '</span></td>
                    <td>
                        <!-- Icon -->
                        <span class="badge bg-danger">CIF : Q ' . $numberSumCif . '</span><br/>
                        <span class="badge bg-danger">IMPUESTOS : Q ' . $numberSumImpuesto . '</span>
                    </td>
                    <td>
                        <!-- Icon -->
                        <i class="fa fa-eye green"></i>
                        <div class="btn-group"><button type="button" class="btn btn-success btnViewContabilidad" btnViewConta=' . $ident . ' data-toggle="modal" data-target=".bd-example-modal-lg">Ver Reporte</button></div>
                    </td>
                </tr>
                ';
                } else {
                    $sp = "spMostrarTotalesConta";
                    $respSumTotal = ModeloGenerarContabilidad::mdlMostrarContabilidad($sp, $ident);
                    $sumCif = $respSumTotal[0]["sumCif"];
                    $sumImpuesto = $respSumTotal[0]["sumImpuesto"];

                    $numberSumCif = number_format($sumCif, 2);
                    $numberSumImpuesto = number_format($sumImpuesto, 2);
                    echo '
                <tr>
                    <td>
                        <span class="ptable-title"><i class="fa fa-building-o"></i>' . $empresa . ' ' . $area . ' ' . $bodega . '</span></td>
                    <td>
                        <!-- Icon -->
                        <span class="badge bg-danger">CIF : Q ' . $numberSumCif . '</span><br/>
                        <span class="badge bg-danger">IMPUESTOS : Q ' . $numberSumImpuesto . '</span>
                    </td>
                    <td>
                        <!-- Icon -->
                        <i class="fa fa-eye lblue"></i>
                        <div class="btn-group"><button type="button" class="btn btn-primary btnViewContabilidad" btnViewConta=' . $ident . ' data-toggle="modal" data-target=".bd-example-modal-lg">Ver Reporte</button></div>
                    </td>
                </tr>
                ';
                }
            }
            echo '<tr><td id="saltoTD" colspan="3"><center><h2 class="text-center text-success">RETIROS ALMACENADORA INTEGRADA, S.A.</h2></center></td></tr>';
            echo '<tr><td id="saltoTD" colspan="3"></td></tr>';
            echo '
            <tr>
                <th>Area Reportada<br/>&nbsp;</th>
                <th class="highlight">
                    Valores<br/>&nbsp;
                </th>
                <th>
                    Acciones
                    <br/>&nbsp;
                </th>
            </tr>';
        }

        $sp = "spIndentRetiros";
        $respRet = ModeloGenerarContabilidad::mdlMostrarIng($sp);
        
        if ($respRet != "SD") {
            foreach ($respRet as $keys => $value) {
                $identBodega = $value["identBodega"];
                $ident = $identBodega;
                $sp = "spValoresContaRet";
                $respVerDatos = ModeloGenerarContabilidad::mdlMostrarContabilidad($sp, $identBodega);
                
                $sumCif = $respVerDatos[0]["sumCifRet"];
                $sumImpuesto = $respVerDatos[0]["sumImpt"];

                $numberSumCif = number_format($sumCif, 2);
                $numberSumImpuesto = number_format($sumImpuesto, 2);
                if ($numberSumCif > 0 && $numberSumImpuesto > 0) {


                    $sp = "spDetRetConta";
                    $datosEmpresa = ModeloGenerarContabilidad::mdlMostrarContabilidad($sp, $identBodega);


                    $empresa = $datosEmpresa[0]["empresa"];
                    $area = $datosEmpresa[0]["areasAutorizadas"];
                    $bodega = $datosEmpresa[0]["numeroIdentidad"];

                    if ($keys % 2 != 0 || $keys == 0) {
                        echo '
                <tr>
                    <td>
                        <span class="ptable-title"><i class="fa fa-building-o"></i>' . $empresa . ' ' . $area . ' ' . $bodega . '</span></td>
                    <td>
                        <!-- Icon -->
                        <span class="badge bg-danger">CIF : Q ' . $numberSumCif . '</span><br/>
                        <span class="badge bg-danger">IMPUESTOS : Q ' . $numberSumImpuesto . '</span>
                    </td>
                    <td>
                        <!-- Icon -->
                        <i class="fa fa-eye green"></i>
                        <div class="btn-group"><button type="button" class="btn btn-success btnViewContabilidadRet" btnViewContaRet=' . $ident . ' data-toggle="modal" data-target=".bd-example-modal-lg">Ver Reporte</button></div>
                    </td>
                </tr>
                ';
                    } else {
                        echo '
                <tr>
                    <td>
                        <span class="ptable-title"><i class="fa fa-building-o"></i>' . $empresa . ' ' . $area . ' ' . $bodega . '</span></td>
                    <td>
                        <!-- Icon -->
                        <span class="badge bg-danger">CIF : Q ' . $numberSumCif . '</span><br/>
                        <span class="badge bg-danger">IMPUESTOS : Q ' . $numberSumImpuesto . '</span>
                    </td>
                    <td>
                          <!-- Icon -->
                        <i class="fa fa-eye lblue"></i>
                        <div class="btn-group"><button type="button" class="btn btn-primary btnViewContabilidadRet" btnViewContaRet=' . $ident . ' data-toggle="modal" data-target=".bd-example-modal-lg">Ver Reporte</button></div>
                    </td>
                </tr>
                ';
                    }
                }
            }
        }
        $sp = "spAjustesVehiculosNew";
        $ajusteVehiculos = ModeloGenerarContabilidad::mdlMostrarContabilidad($sp, $iBodEmpresa);

        if ($ajusteVehiculos != "SD") {
            $listaVehAjuste = [];
            foreach ($ajusteVehiculos as $key => $value) {
                if ($key == 0) {
                    array_push($listaVehAjuste, $value);
                }

                if ($key > 0) {
                    $contador = 0;
                    foreach ($listaVehAjuste as $keys => $values) {
                        if ($values["id"] == $value["id"]) {
                            $contador = $contador + 1;
                        }
                    }
                    if ($contador == 0) {
                        array_push($listaVehAjuste, $value);
                    }
                }
            }
            $cifVehAjuste = 0;
            $impuestoVehAjuste = 0;

            foreach ($listaVehAjuste as $key => $value) {

                $cifVehAjuste = $cifVehAjuste + $value["cif"];
                $impuestoVehAjuste = $impuestoVehAjuste + $value["impuesto"];
            }
        }



        if ($respIng != "SD" || $ajusteVehiculos != "SD") {
            $valorCifMerca = 0;
            $impuestosMerca = 0;

            if ($respIng != "SD") {
                $respAjustes = [];
 
                foreach ($ajustesContaLote[0] as $key => $value) {
                    if ($key==0) {
                        array_push($respAjustes, $value);
                    }

                    if ($key>0) {
                        $contador = 0;
                        foreach ($respAjustes as $keys => $values) {
                        
                            if ($value["id"]==$values["id"]) {
                               $contador = $contador+1; 
                            }
                        }
                        if ($contador==0) {
                            array_push($respAjustes, $value);
                        }
                    }
                }   

                foreach ($respAjustes as $key => $value) {
                    $valorCifMerca = $valorCifMerca + $value["saldoValorCif"];
                    $impuestosMerca = $impuestosMerca + $value["saldoValorImpuesto"];
                }
            }
            if ($ajusteVehiculos != "SD") {
                $valorCif = $valorCifMerca + $cifVehAjuste;
                $impuesto = $impuestosMerca + $impuestoVehAjuste;
            }
  
            if ($valorCif != 0 || $impuesto != 0) {

                echo '<tr><td id="saltoTD" colspan="3"><center><h2 class="text-center text-success">AJUSTES ALMACENADORA INTEGRADA, S.A.</h2></center></td></tr>';
                echo '<tr><td id="saltoTD" colspan="3"></td></tr>';


                $numberSumCif = number_format($valorCif, 2);
                $numberSumImpuesto = number_format($impuesto, 2);
                if ($key + 1 % 2 != 0) {

                    echo '
                <tr>
                    <td>
                        <span class="ptable-title"><i class="fa fa-building-o"></i>AJUSTES CONTABLES DE VEHÍCULOS Y MERCADERIA</span></td>
                    <td>
                        <!-- Icon -->
                        <span class="badge bg-danger">CIF : Q ' . $numberSumCif . '</span><br/>
                        <span class="badge bg-danger">IMPUESTOS : Q ' . $numberSumImpuesto . '</span>
                    </td>
                    <td>
                        <!-- Icon -->
                        <i class="fa fa-eye lblue"></i>
                        <div class="btn-group"><button type="button" class="btn btn-primary btnViewAjustes" data-toggle="modal" data-target=".bd-example-modal-lg">Ver Reporte</button></div>
                    </td>
                </tr>
                ';
                } else {

                    echo '
                <tr>
                    <td>
                        <span class="ptable-title"><i class="fa fa-building-o"></i>AJUSTES CONTABLES DE ' . $empresa . '</span></td>
                    <td>
                        <!-- Icon -->
                        <span class="badge bg-danger">CIF : Q ' . $numberSumCif . '</span><br/>
                        <span class="badge bg-danger">IMPUESTOS : Q ' . $numberSumImpuesto . '</span>
                    </td>
                    <td>
                        <!-- Icon -->
                        <i class="fa fa-eye green"></i>
                        <div class="btn-group"><button type="button" class="btn btn-success btnViewAjustes" data-toggle="modal" data-target=".bd-example-modal-lg">Ver Reporte</button></div>
                </tr>
                ';
                }
            }
        }
        $estado = 2;
        $sp = "spContaVeh";
        $respVeh = ModeloGenerarContabilidad::mdlMostrarRetirosFiscales($sp, $estado, $iBodEmpresa);

        if ($respVeh != "SD") {
            $numberSumCif = number_format($respVeh[0]["cif"], 2);
            $numberSumImpuesto = number_format($respVeh[0]["impuesto"], 2);
            if ($numberSumCif > 0) {


                echo '
                <tr>
                    <td>
                        <span class="ptable-title"><i class="fa fa-building-o"></i>CONTABILIDAD DE CHASIS VEHÍCULOS NUEVOS </span></td>
                    <td>
                        <!-- Icon -->
                        <span class="badge bg-danger">CIF : Q ' . $numberSumCif . '</span><br/>
                        <span class="badge bg-danger">IMPUESTOS : Q ' . $numberSumImpuesto . '</span>
                    </td>
                    <td>
                        <!-- Icon -->
                        <i class="fa fa-eye green"></i>
                        <div class="btn-group"><button type="button" class="btn btn-success btnViewAjustes" data-toggle="modal" data-target=".bd-example-modal-lg">Ver Reporte</button></div>
                </tr>
                ';
            }
        }
        $tipo = "ALMFISCAL";
        $sp = "spTrasladoAf";

        $respTrasladoAF = ModeloGenerarContabilidad::mdlMostrarRetirosFiscales($sp, $tipo, $iBodEmpresa);
        if ($respTrasladoAF != "SD") {
            echo '<tr><td id="saltoTD" colspan="3"><center><h2 class="text-center text-success">MOVIMIENTOS ALMACEN FISCAL </h2></center></td></tr>';
            echo '<tr><td id="saltoTD" colspan="3"></td></tr>';
            $numberSumCif = number_format($respTrasladoAF[0]["cifTraslado"], 2);
            $numberSumImpuesto = number_format($respTrasladoAF[0]["impuestoTraslado"], 2);
            if ($numberSumCif > 0) {
                echo '
                <tr>
                    <td>
                        <span class="ptable-title"><i class="fa fa-building-o"></i>INGRESO A ALMACEN FISCAL </span></td>
                    <td>
                        <!-- Icon -->
                        <span class="badge bg-danger">CIF : Q ' . $numberSumCif . '</span><br/>
                        <span class="badge bg-danger">IMPUESTOS : Q ' . $numberSumImpuesto . '</span>
                    </td>
                    <td>
                        <!-- Icon -->
                        <i class="fa fa-eye green"></i>
                        <div class="btn-group"><button type="button" class="btn btn-success btnViewAjustes" data-toggle="modal" data-target=".bd-example-modal-lg">Ver Reporte</button></div>
                </tr>
                ';
            }
        }

        $ident = $iBodEmpresa;
        $sp = "spValoresContaRetAF";
        $respVerDatos = ModeloGenerarContabilidad::mdlMostrarContabilidad($sp, $ident);
        $sumCif = $respVerDatos[0]["sumCifRet"] * 1;
        $sumImpuesto = $respVerDatos[0]["sumImpt"] * 1;
        if ($sumCif > 0 && $sumImpuesto > 0) {
            $numberSumCif = number_format($sumCif, 2);
            $numberSumImpuesto = number_format($sumImpuesto, 2);
            $sp = "spDetRetConta";
            $datosEmpresa = ModeloGenerarContabilidad::mdlMostrarContabilidad($sp, $identBodega);
            $empresa = $datosEmpresa[0]["empresa"];
            $area = $datosEmpresa[0]["areasAutorizadas"];
            $bodega = $datosEmpresa[0]["numeroIdentidad"];
            echo '
                <tr>
                    <td>
                        <span class="ptable-title"><i class="fa fa-building-o"></i>RETIROS ' . $empresa . ' ' . $area . ' ' . $bodega . '</span></td>
                    <td>
                        <!-- Icon -->
                        <span class="badge bg-danger">CIF : Q ' . $numberSumCif . '</span><br/>
                        <span class="badge bg-danger">IMPUESTOS : Q ' . $numberSumImpuesto . '</span>
                    </td>
                    <td>
                          <!-- Icon -->
                        <i class="fa fa-eye lblue"></i>
                        <div class="btn-group"><button type="button" class="btn btn-primary btnViewContabilidadRet" btnViewContaRet=' . $ident . ' data-toggle="modal" data-target=".bd-example-modal-lg">Ver Reporte</button></div>
                    </td>
                </tr>
                ';
        }
    }

    public static function ctrCierreContableDiario($cotabilizarFecha, $hiddenIdBod) {
        $date = $cotabilizarFecha;


        if (!empty($date)) {
            $timestamp = strtotime($date);
            if ($timestamp === FALSE) {
                $timestamp = strtotime(str_replace('/', '-', $date));
            }
            $date = date('Y-m-d', $timestamp);
        }

        $sp = "spConsultaEmppresa";
        $respEmpresa = ModeloGenerarContabilidad::mdlMostrarContabilidad($sp, $hiddenIdBod);
        if ($respEmpresa[0]["idEmpresa"] > 0) {


            $idEmpresa = $respEmpresa[0]["idEmpresa"];
        } else {
            return false;
        }
        $sp = "spSaldosContables";
        $respSldsConta = ModeloGenerarContabilidad::mdlMostrarContabilidad($sp, $idEmpresa);
       //AJUSTES CONTABLES DE INGRESOS VEHICULOS 
        $sp = "spAjustesVehiculosNew";
        $ajusteVehiculos = ModeloGenerarContabilidad::mdlMostrarContabilidad($sp, $hiddenIdBod);
                   //GENERANDO VALORES PARA RETIROS DE ALMACEN FISCAL
            $sp = "spValoresContaRetAF";
            $valoresAFRet = ModeloGenerarContabilidad::mdlMostrarContabilidad($sp, $hiddenIdBod);
 
        if ($respSldsConta[0]["countImpts"] == 0 && $respSldsConta[0]["countCif"] == 0) {
            return 0;
        } else {


            /*
             * SOLICITAR VALORES DE INGRESO PARA GENERAR POLIZA DE INGRESOS
             * DE CAJON CUENTAS A UTILIZAR 
             * */
            $sp = "spIndentIngresos";
            $respIng = ModeloGenerarContabilidad::mdlMostrarIng($sp);
            if ($respIng != "SD") {


                $ajustesContaLote = [];
                $listaAreas = [];
                $sumaCif = 0;
                $sumaImpuesto = 0;

                foreach ($respIng as $key => $value) {
                    $idContbilidades = $value["numeroBodegaFiscal"];
                    $sp = "spMostrarDetCont";
                    $respVerDatos = ModeloGenerarContabilidad::mdlMostrarContabilidad($sp, $idContbilidades);
                    $sp = "spAjustesContables";
                    $respAjustes = ModeloGenerarContabilidad::mdlMostrarContabilidad($sp, $idContbilidades);
                    if ($key==0) {
                        array_push($ajustesContaLote, $respAjustes);
                    }
                    $sp = "spRegistraAjustes";
                    $respRegistroAjuste = ModeloGenerarContabilidad::mdlMostrarRetirosFiscales($sp, $idContbilidades, $date);
                    
                        
                   
                    $ident = $idContbilidades;
                    $empresa = $respVerDatos[0]["empresa"];
                    $area = $respVerDatos[0]["areasAutorizadas"];
                    $bodega = $respVerDatos[0]["numeroIdentidad"];
                    $dependencia = $respVerDatos[0]["dependencia"];
                    $arrayLista = array("ident" => $ident, "empresa" => $empresa, "area" => $area, "bodega" => $bodega);
                    $sp = "spMostrarTotalesConta";
                    $respSumTotal = ModeloGenerarContabilidad::mdlMostrarContabilidad($sp, $ident);
                    $sumaCif = $sumaCif + $respSumTotal[0]["sumCif"];
                    $sumaImpuesto = $sumaImpuesto + $respSumTotal[0]["sumImpuesto"];
                    $sp = "spContabilizaLoteIng";
                    $respContaLoteIng = ModeloGenerarContabilidad::mdlMostrarRetirosFiscales($sp, $idContbilidades, $date);
                }

                $sumaTotal = $sumaCif + $sumaImpuesto;
                /**
                 * EJECUTO UN STORE PRODUCE PARA QUE ME GENERE EN CORRELATIVO DE POLIZAS
                 * UN NUMERO Y UTILIZARLO PARA AMARRA EL LOTE DE LA POLIZA, GUARDANDO VALOR
                 * CIF POLIZA DE INGRESO
                 * */
                $sp = "spNumPolizas";
                $numAsigPoliza = ModeloGenerarContabilidad::mdlMostrarContabilidad($sp, $date);
                $numeroPolAsignado = $numAsigPoliza[0]['resp'];
                if ($numeroPolAsignado > 0) {
                    $numeroDepolizaAsig = $numeroPolAsignado;
                }
                /**
                 * DECLARANDO EL ASIENTO CONTABLE POR INGRESOS FISCALES 
                 * */
                $sp = "spAsientoContable"; //SP QUE CONECTA LA BASE DE DATOS Y GUARDA EL ASIENTO CONTABLE
                $conPolDefCif = "802103.0102"; //CUENTA UTILIZA DEFAULT PARA REGISTRAR CIF DE INGRESO EN POLIZA CONTABLE
                $estado = 1;
                $conceptoPoliza = "INGRESOS DE CIF E IMPUESTOS EN ZONA ADUANERA DE BODEGAS Y PREDIO DE VEHICULOS"; //EXPLICACION CONTABLE
                $debeCif = "DEBE"; //NATURALEZA DE CUENTA CONTABLE SUMA AL LIBRO DIARIO
                $tipOperaSaldo = "SUMA";
                $tipConcepto = "INGRESO CIF";
                $respIngCif = ModeloGenerarContabilidad::mdlGuardarPolContable($sp, $conPolDefCif, $dependencia, $sumaCif, $estado, $conceptoPoliza, $numeroDepolizaAsig, $debeCif, $tipOperaSaldo, $tipConcepto); //ENVIANDO PARAMETROS A UN OBJETO EN EL MODELO
                if ($respIngCif[0]["resp"] == 1) {
                    $conPolDefImpts = "801109.01"; //CUENTA DEFAULT PARA REGISTRAR IMPUESTOS INGRESO
                    $debeImpts = "DEBE"; //NATURALEZA DE CUENTA CONTABLE SUMA AL LIBRO DIARIO
                    $tipOperaSaldo = "SUMA";
                    $tipConcepto = "INGRESO IMPUESTOS";
                    $respIngImpts = ModeloGenerarContabilidad::mdlGuardarPolContable($sp, $conPolDefImpts, $dependencia, $sumaImpuesto, $estado, $conceptoPoliza, $numeroDepolizaAsig, $debeImpts, $tipOperaSaldo, $tipConcepto); //ENVIANDO PARAMETROS A UN OBJETO EN EL MODELO
                    if ($respIngImpts[0]["resp"] == 1) {
                        $haberPol = "HABER"; //NATURALEZA DE CUENTA CONTABLE QUE RESPALDA LA POLIZA
                        $cuentaPorContra = "888888"; //CUENTA QUE CARGA A SUS ANTERIORES DOS CUENTAS DE INGRESO
                        $tipOperaSaldo = "CONTRAPARTIDA";
                        $tipConcepto = "INGRESO CIF";
                        $respCuentaCarga = ModeloGenerarContabilidad::mdlGuardarPolContable($sp, $cuentaPorContra, $dependencia, $sumaTotal, $estado, $conceptoPoliza, $numeroDepolizaAsig, $haberPol, $tipOperaSaldo, $tipConcepto); //ENVIANDO PARAMETROS A UN OBJETO EN EL MODELO
                    }
                }
            }
            }


//retiros de mercaderia
            $sp = "spIndentRetiros";
            $respRet = ModeloGenerarContabilidad::mdlMostrarIng($sp);
            //retiros de vehiculos nuevos
            //SUMANDO LOS VALORES DE VEHICULOS CONTABILIZADOS EN ALMACENADORA
            $estado = 2;
            $sp = "spContaVeh";
            $respVeh = ModeloGenerarContabilidad::mdlMostrarRetirosFiscales($sp, $estado, $hiddenIdBod);
            $dependencia = $respVeh[0]["dependencia"];

            $sumCif = 0;
            $sumImpuesto = 0;
            $totalVal = 0;
            if ($respRet != "SD" || $respVeh != "SD") {

                if ($respVeh != "SD") {
                    $sp = "spContaVeh";
                    $estado = 2;

                    $respVeh = ModeloGenerarContabilidad::mdlMostrarRetirosFiscales($sp, $estado, $hiddenIdBod);

                    $sumCif = $sumCif + $respVeh[0]["cif"];
                    $sumImpuesto = $sumImpuesto + $respVeh[0]["impuesto"];
                }


                $sp = "spNumPolizas";
                $numAsigPoliza = ModeloGenerarContabilidad::mdlMostrarContabilidad($sp, $date);
                $numeroPolAsignado = $numAsigPoliza[0]['resp'];
                if ($numeroPolAsignado > 0) {
                    $numeroDepolizaAsig = $numeroPolAsignado;
                }
                if ($respRet != "SD") {

                    foreach ($respRet as $keys => $value) {
                        $identBodega = $value["identBodega"];
                        $dependencia = $value["dependencia"];

                        $ident = $identBodega;

                        $sp = "spValoresContaRet";
                        $respVerDatos = ModeloGenerarContabilidad::mdlMostrarContabilidad($sp, $identBodega);
                        $sp = "spContabilizaRet";
                        $respContabilizaRet = ModeloGenerarContabilidad::mdlMostrarRetirosFiscales($sp, $identBodega, $date);
                        if ($respVerDatos != "SD") {
                            $sumCif = $sumCif + $respVerDatos[0]["sumCifRet"];
                            $sumImpuesto = $sumImpuesto + $respVerDatos[0]["sumImpt"];
                        }

                        $sp = "spDetRetConta";
                        $datosEmpresa = ModeloGenerarContabilidad::mdlMostrarContabilidad($sp, $identBodega);


                        $empresa = $datosEmpresa[0]["empresa"];
                        $area = $datosEmpresa[0]["areasAutorizadas"];
                        $bodega = $datosEmpresa[0]["numeroIdentidad"];
                    }
                }
                $totalVal = $sumCif + $sumImpuesto;
                /**
                 * DECLARANDO EL ASIENTO CONTABLE POR REIROS FISCALES 
                 * */
                $sp = "spAsientoContable"; //SP QUE CONECTA LA BASE DE DATOS Y GUARDA EL ASIENTO CONTABLE
                $conPolDefCif = "888888"; //CUENTA UTILIZA DEFAULT PARA REGISTRAR CIF DE INGRESO EN POLIZA CONTABLE
                $estado = 1;
                $conceptoPoliza = "RETIROS DE CIF E IMPUESTOS EN ZONA ADUANERA DE BODEGAS Y PREDIO DE VEHICULOS"; //EXPLICACION CONTABLE
                $debeCif = "DEBE"; //NATURALEZA DE CUENTA CONTABLE SUMA AL LIBRO DIARIO
                $tipOperaSaldo = "CONTRAPARTIDA";
                $tipConcepto = "RETIRO CIF";

                $respIngContra = ModeloGenerarContabilidad::mdlGuardarPolContable($sp, $conPolDefCif, $dependencia, $totalVal, $estado, $conceptoPoliza, $numeroDepolizaAsig, $debeCif, $tipOperaSaldo, $tipConcepto); //ENVIANDO PARAMETROS A UN OBJETO EN EL MODELO

                if ($respIngContra[0]["resp"] == 1) {
                    $conPolDefCif = "802103.0102"; //CUENTA DEFAULT PARA REGISTRAR IMPUESTOS INGRESO
                    $debeCif = "HABER"; //NATURALEZA DE CUENTA CONTABLE SUMA AL LIBRO DIARIO
                    $tipOperaSaldo = "RESTA";
                    $tipConcepto = "RETIRO CIF";
                    $respIngCif = ModeloGenerarContabilidad::mdlGuardarPolContable($sp, $conPolDefCif, $dependencia, $sumCif, $estado, $conceptoPoliza, $numeroDepolizaAsig, $debeCif, $tipOperaSaldo, $tipConcepto); //ENVIANDO PARAMETROS A UN OBJETO EN EL MODELO
                    if ($respIngCif[0]["resp"] == 1) {
                        $conPolDefImpst = "801109.01"; //CUENTA DEFAULT PARA REGISTRAR IMPUESTOS INGRESO
                        $debeImpst = "HABER"; //NATURALEZA DE CUENTA CONTABLE SUMA AL LIBRO DIARIO
                        $tipOperaSaldo = "RESTA";
                        $tipConcepto = "RETIRO IMPUESTOS";
                        $respIngImpuesto = ModeloGenerarContabilidad::mdlGuardarPolContable($sp, $conPolDefImpst, $dependencia, $sumImpuesto, $estado, $conceptoPoliza, $numeroDepolizaAsig, $debeImpst, $tipOperaSaldo, $tipConcepto); //ENVIANDO PARAMETROS A UN OBJETO EN EL MODELO
                    }
                }
            }
            
            

            //ajustesMerca
                $respAjustes = [];
                         $valorCifMerca = 0;
                        $impuestosMerca = 0;
                foreach ($ajustesContaLote[0] as $key => $value) {
                    if ($key==0) {
                        array_push($respAjustes, $value);
                    }

                    if ($key>0) {
                        $contador = 0;

                        foreach ($respAjustes as $keys => $values) {
                        
                            if ($value["id"]==$values["id"]) {
                               $contador = $contador+1; 
                            }
                        }
                        if ($contador==0) {
                            array_push($respAjustes, $value);
                        }
                    }
                }

                        
                foreach ($respAjustes as $key => $value) {
                    $valorCifMerca = $valorCifMerca + $value["saldoValorCif"];
                    $impuestosMerca = $impuestosMerca + $value["saldoValorImpuesto"];
                }   

            
            
            /*             * *
             * 
             * AJUSTE CONTABLE DE VEHÍCULOS NUEVOS
             * 
             * ** */

            if ($ajusteVehiculos != "SD") {
                $listaVehAjuste = [];
                foreach ($ajusteVehiculos as $key => $value) {
                    if ($key == 0) {
                        array_push($listaVehAjuste, $value);
                    }

                    if ($key > 0) {
                        $contador = 0;
                        foreach ($listaVehAjuste as $keys => $values) {
                            if ($values["id"] == $value["id"]) {
                                $contador = $contador + 1;
                            }
                        }
                        if ($contador == 0) {
                            array_push($listaVehAjuste, $value);
                        }
                    }
                }
                $cifVehAjuste = 0;
                $impuestoVehAjuste = 0;

                foreach ($listaVehAjuste as $key => $value) {
                    $sp = "spFinalizarAjusteVehN";
                    $idIngAjusteVN = $value["id"];
                    $cif = $value["cif"];
                    $impuesto = $value["impuesto"];

                    //en este metodo se requiere que el retiro sea estado 5 y el valor contabilidad quede a 0 en cif e impuestos
                    $cambiosAjustesRetVehIng = ModeloGenerarContabilidad::mdlAjusteFinalVehiculoNew($sp, $idIngAjusteVN, $cif, $impuesto, $date);
                    $cifVehAjuste = $cifVehAjuste + $cif;
                    $impuestoVehAjuste = $impuestoVehAjuste + $impuesto;
                }
            }


            if ($respIng != "SD" || $ajusteVehiculos != "SD") {
                $sp = "spNumPolizas";
                $numAsigPoliza = ModeloGenerarContabilidad::mdlMostrarContabilidad($sp, $date);
                $numeroPolAsignado = $numAsigPoliza[0]['resp'];
                if ($numeroPolAsignado > 0) {
                    $numeroDepolizaAsig = $numeroPolAsignado;
                }
                $ajusteValCif = 0;
                $ajusteVImpst = 0;
                $totalAjuste = 0;


                if ($ajusteVehiculos != "SD") {
                    $ajusteValCif = $valorCifMerca + $cifVehAjuste;
                    $ajusteVImpst = $impuestosMerca + $impuestoVehAjuste;
                }else{
                    $ajusteValCif = $valorCifMerca;
                    $ajusteVImpst = $impuestosMerca;
                    
                }

                $totalAjuste = $ajusteValCif + $ajusteVImpst;

                /**
                 * AJUSTES CONTABLES DE RETIROS MERCADERIAS Y VEHÍCULOS
                 * 
                 * * */
                if ($ajusteValCif < 0 && $ajusteVImpst < 0) {

                    //SETENADO VARIABLES A UN NUMERO POSITIVO PARA GUARDAR EN LA POLIZA CONTABLE
                    $ajusteValCifSet = $ajusteValCif * -1;
                    $ajusteVImpstSet = $ajusteVImpst * -1;
                    $totalAjuste = $ajusteValCifSet + $ajusteVImpstSet;
                    /**
                     * SI ESTA CONDICION SE CUMPLE Y CIF E IMPUESTO SON MAYOR A 0 ENTONCES SE APLICA UNA POLIZA DE RETIRO
                     * YA QUE SE DEBE APLICAR UNA REBAJA AL TOTAL DE CIF E IMPUESTO PARA QUE REGRESE AL VALOR 0
                     * */
                    /**
                     * DECLARANDO EL ASIENTO CONTABLE POR INGRESOS FISCALES 
                     * */
                    $sp = "spAsientoContable"; //SP QUE CONECTA LA BASE DE DATOS Y GUARDA EL ASIENTO CONTABLE
                    $conPolDefCif = "802103.0102"; //CUENTA UTILIZA DEFAULT PARA REGISTRAR CIF DE INGRESO EN POLIZA CONTABLE
                    $estado = 1;
                    $conceptoPoliza = "REGULARIZACION EN ZONA ADUANERA POR  DIFERENCIAL CAMBIARIO"; //EXPLICACION CONTABLE
                    $debeCif = "DEBE"; //NATURALEZA DE CUENTA CONTABLE SUMA AL LIBRO DIARIO
                    $tipOperaSaldo = "SUMA";
                    $tipConcepto = "INGRESO CIF AJUSTE";
                    $respIngCif = ModeloGenerarContabilidad::mdlGuardarPolContable($sp, $conPolDefCif, $dependencia, $ajusteValCifSet, $estado, $conceptoPoliza, $numeroDepolizaAsig, $debeCif, $tipOperaSaldo, $tipConcepto); //ENVIANDO PARAMETROS A UN OBJETO EN EL MODELO
                    if ($respIngCif[0]["resp"] == 1) {
                        $conPolDefImpts = "801109.01"; //CUENTA DEFAULT PARA REGISTRAR IMPUESTOS INGRESO
                        $debeImpts = "DEBE"; //NATURALEZA DE CUENTA CONTABLE SUMA AL LIBRO DIARIO
                        $tipOperaSaldo = "SUMA";
                        $tipConcepto = "INGRESO IMPUESTOS AJUSTE";
                        $respIngImpts = ModeloGenerarContabilidad::mdlGuardarPolContable($sp, $conPolDefImpts, $dependencia, $ajusteVImpstSet, $estado, $conceptoPoliza, $numeroDepolizaAsig, $debeImpts, $tipOperaSaldo, $tipConcepto); //ENVIANDO PARAMETROS A UN OBJETO EN EL MODELO
                        if ($respIngImpts[0]["resp"] == 1) {
                            $haberPol = "HABER"; //NATURALEZA DE CUENTA CONTABLE QUE RESPALDA LA POLIZA
                            $cuentaPorContra = "888888"; //CUENTA QUE CARGA A SUS ANTERIORES DOS CUENTAS DE INGRESO
                            $tipOperaSaldo = "CONTRAPARTIDA";
                            $tipConcepto = "INGRESO CIF AJUSTE";
                            $respCuentaCarga = ModeloGenerarContabilidad::mdlGuardarPolContable($sp, $cuentaPorContra, $dependencia, $totalAjuste, $estado, $conceptoPoliza, $numeroDepolizaAsig, $haberPol, $tipOperaSaldo, $tipConcepto); //ENVIANDO PARAMETROS A UN OBJETO EN EL MODELO
                        }
                    }
                }else if ($ajusteValCif > 0 && $ajusteVImpst > 0) {



                    /**
                     * DECLARANDO EL ASIENTO CONTABLE POR REIROS FISCALES 
                     * */
                    $sp = "spAsientoContable"; //SP QUE CONECTA LA BASE DE DATOS Y GUARDA EL ASIENTO CONTABLE
                    $conPolDefCif = "888888"; //CUENTA UTILIZA DEFAULT PARA REGISTRAR CIF DE INGRESO EN POLIZA CONTABLE
                    $estado = 1;
                    $conceptoPoliza = "REGULARIZACION EN ZONA ADUANERA POR  DIFERENCIAL CAMBIARIO"; //EXPLICACION CONTABLE
                    $debeCif = "DEBE"; //NATURALEZA DE CUENTA CONTABLE SUMA AL LIBRO DIARIO
                    $tipOperaSaldo = "CONTRAPARTIDA";
                    $tipConcepto = "RETIRO CIF AJUSTE";
                    $respIngContra = ModeloGenerarContabilidad::mdlGuardarPolContable($sp, $conPolDefCif, $dependencia, $totalAjuste, $estado, $conceptoPoliza, $numeroDepolizaAsig, $debeCif, $tipOperaSaldo, $tipConcepto); //ENVIANDO PARAMETROS A UN OBJETO EN EL MODELO

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
                }else{


                if ($ajusteValCif < 0) {
                    $ajusteValCifSet = $ajusteValCif * -1;
                    /**
                     * DECLARANDO EL ASIENTO CONTABLE POR REIROS FISCALES 
                     * */
                    $sp = "spAsientoContable"; //SP QUE CONECTA LA BASE DE DATOS Y GUARDA EL ASIENTO CONTABLE
                    $conPolDefCif = "888888"; //CUENTA UTILIZA DEFAULT PARA REGISTRAR CIF DE INGRESO EN POLIZA CONTABLE
                    $estado = 1;
                    $conceptoPoliza = "REGULARIZACION EN ZONA ADUANERA POR  DIFERENCIAL CAMBIARIO"; //EXPLICACION CONTABLE
                    $debeCif = "DEBE"; //NATURALEZA DE CUENTA CONTABLE SUMA AL LIBRO DIARIO
                    $tipOperaSaldo = "CONTRAPARTIDA";
                    $tipConcepto = "INGRESO CIF AJUSTE";

                    $respIngContra = ModeloGenerarContabilidad::mdlGuardarPolContable($sp, $conPolDefCif, $dependencia, $ajusteValCifSet, $estado, $conceptoPoliza, $numeroDepolizaAsig, $debeCif, $tipOperaSaldo, $tipConcepto); //ENVIANDO PARAMETROS A UN OBJETO EN EL MODELO
                    if ($respIngContra[0]["resp"] == 1) {
                        $conPolDefCif = "802103.0102"; //CUENTA DEFAULT PARA REGISTRAR IMPUESTOS INGRESO
                        $debeCif = "HABER"; //NATURALEZA DE CUENTA CONTABLE SUMA AL LIBRO DIARIO
                        $tipOperaSaldo = "SUMA";
                        $tipConcepto = "INGRESO CIF AJUSTE";
                        $respIngCif = ModeloGenerarContabilidad::mdlGuardarPolContable($sp, $conPolDefCif, $dependencia, $ajusteValCifSet, $estado, $conceptoPoliza, $numeroDepolizaAsig, $debeCif, $tipOperaSaldo, $tipConcepto); //ENVIANDO PARAMETROS A UN OBJETO EN EL MODELO
                    }
                }
                if ($ajusteValCif > 0) {
                    
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

                if ($ajusteVImpst < 0) {
                    $ajusteVImpstSet = $ajusteVImpst * -1;
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
                    $respIngContra = ModeloGenerarContabilidad::mdlGuardarPolContable($sp, $conPolDefCif, $dependencia, $ajusteVImpstSet, $estado, $conceptoPoliza, $numeroDepolizaAsig, $debeCif, $tipOperaSaldo, $tipConcepto); //ENVIANDO PARAMETROS A UN OBJETO EN EL MODELO
                    if ($respIngContra[0]["resp"] == 1) {
                        $conPolDefCif = "801109.01"; //CUENTA DEFAULT PARA REGISTRAR IMPUESTOS INGRESO
                        $debeCif = "HABER"; //NATURALEZA DE CUENTA CONTABLE SUMA AL LIBRO DIARIO
                        $tipOperaSaldo = "SUMA";
                        $tipConcepto = "INGRESO IMPUESTOS AJUSTE";
                        $respIngCif = ModeloGenerarContabilidad::mdlGuardarPolContable($sp, $conPolDefCif, $dependencia, $ajusteVImpstSet, $estado, $conceptoPoliza, $numeroDepolizaAsig, $debeCif, $tipOperaSaldo, $tipConcepto); //ENVIANDO PARAMETROS A UN OBJETO EN EL MODELO
                    }
                }
                if ($ajusteVImpst > 0) {
                    
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
                            $sp = "spContaVehEstado";
                $estado = 2;

                $finalizarChasis = ModeloGenerarContabilidad::mdlMostrarRetirosFiscales($sp, $estado, $hiddenIdBod);

            }


            $tipo = "ALMFISCAL";
            $sp = "spTrasladoAf";
            $respTrasladoAF = ModeloGenerarContabilidad::mdlMostrarRetirosFiscales($sp, $tipo, $hiddenIdBod);
            
            if ($respTrasladoAF != "SD") {
                $sumCif = $respTrasladoAF[0]["cifTraslado"] * 1;
                $sumImpuesto = $respTrasladoAF[0]["impuestoTraslado"] * 1;
                if ($sumCif > 0 && $sumImpuesto > 0) {

                    $sp = "spNumPolizas";
                    $numAsigPoliza = ModeloGenerarContabilidad::mdlMostrarContabilidad($sp, $date);

                    $numeroPolAsignado = $numAsigPoliza[0]['resp'];
                    if ($numeroPolAsignado > 0) {
                        $numeroDepolizaAsig = $numeroPolAsignado;
                    }


                    $dependencia = $respTrasladoAF[0]["dependencia"];
                    $conPolDefCif = "802103.0102"; //CUENTA DEFAULT PARA REGISTRAR IMPUESTOS INGRESO
                    $debeCif = "HABER"; //NATURALEZA DE CUENTA CONTABLE SUMA AL LIBRO DIARIO
                    $tipOperaSaldo = "RESTA";
                    $tipConcepto = "RET CIF TRASLADO";
                    $conceptoPoliza = "TRASLADO DE CIF E IMPUESTOS DE ZONA ADUANERA A ALMACEN FISCAL";
                    $sp = "spAsientoContable";
                    $estado = 1;
                    $respIngCif = ModeloGenerarContabilidad::mdlGuardarPolContableS($sp, $conPolDefCif, $dependencia, $sumCif, $estado, $conceptoPoliza, $numeroDepolizaAsig, $debeCif, $tipOperaSaldo, $tipConcepto); //ENVIANDO PARAMETROS A UN OBJETO EN EL MODELO

                    if ($respIngCif[0]["resp"] == 1) {
                        $conPolDefImpst = "801109.01"; //CUENTA DEFAULT PARA REGISTRAR IMPUESTOS INGRESO
                        $debeImpst = "HABER"; //NATURALEZA DE CUENTA CONTABLE SUMA AL LIBRO DIARIO
                        $tipOperaSaldo = "RESTA";
                        $tipConcepto = "RET IMPTS TRASLADO";
                        $respIngImpuesto = ModeloGenerarContabilidad::mdlGuardarPolContable($sp, $conPolDefImpst, $dependencia, $sumImpuesto, $estado, $conceptoPoliza, $numeroDepolizaAsig, $debeImpst, $tipOperaSaldo, $tipConcepto); //ENVIANDO PARAMETROS A UN OBJETO EN EL MODELO
                        if ($respIngCif[0]["resp"] == 1) {
                            /**
                             * HACIENDO INGRESO A CONTABILIDAD FISCAL
                             * */
                            $conPolDefCif = "802103.0101"; //CUENTA DEFAULT PARA REGISTRAR IMPUESTOS INGRESO
                            $debeCif = "DEBE"; //NATURALEZA DE CUENTA CONTABLE SUMA AL LIBRO DIARIO
                            $tipOperaSaldo = "SUMA";
                            $tipConcepto = "INGRESO CIF";
                            $conceptoPoliza = "TRASLADO DE CIF E IMPUESTOS DE ZONA ADUANERA A ALMACEN FISCAL";
                            $sp = "spAsientoContableAF";
                            $estado = 1;
                            $respIngCif = ModeloGenerarContabilidad::mdlGuardarPolContableS($sp, $conPolDefCif, $dependencia, $sumCif, $estado, $conceptoPoliza, $numeroDepolizaAsig, $debeCif, $tipOperaSaldo, $tipConcepto); //ENVIANDO PARAMETROS A UN OBJETO EN EL MODELO
                            if ($respIngCif[0]["resp"] == 1) {
                                $conPolDefImpst = "801109.01"; //CUENTA DEFAULT PARA REGISTRAR IMPUESTOS INGRESO
                                $debeImpst = "DEBE"; //NATURALEZA DE CUENTA CONTABLE SUMA AL LIBRO DIARIO
                                $tipOperaSaldo = "SUMA";
                                $tipConcepto = "INGRESO IMPUESTOS";
                                $conceptoPoliza = "TRASLADO DE CIF E IMPUESTOS DE ZONA ADUANERA A ALMACEN FISCAL";
                                $sp = "spAsientoContableAF";
                                $respIngImpuesto = ModeloGenerarContabilidad::mdlGuardarPolContable($sp, $conPolDefImpst, $dependencia, $sumImpuesto, $estado, $conceptoPoliza, $numeroDepolizaAsig, $debeImpst, $tipOperaSaldo, $tipConcepto); //ENVIANDO PARAMETROS A UN OBJETO EN EL MODELO
                            }
                        }
                    }
                }
            }
   
            if ($valoresAFRet != "SD") {

                $sumCif = $valoresAFRet[0]["sumCifRet"] * 1;
                $sumImpuesto = $valoresAFRet[0]["sumImpt"] * 1;
                if ($sumCif > 0 && $sumImpuesto > 0) {

                    $sp = "spNumPolizas";
                    $numAsigPoliza = ModeloGenerarContabilidad::mdlMostrarContabilidad($sp, $date);
                    $numeroDepolizaAsig = $numAsigPoliza[0]["resp"];
                    $totalVal = $sumCif + $sumImpuesto;
                    /**
                     * DECLARANDO EL ASIENTO CONTABLE POR REIROS FISCALES 
                     * */
                    $sp = "spAsientoContableAF"; //SP QUE CONECTA LA BASE DE DATOS Y GUARDA EL ASIENTO CONTABLE
                    $conPolDefCif = "888888"; //CUENTA UTILIZA DEFAULT PARA REGISTRAR CIF DE INGRESO EN POLIZA CONTABLE
                    $estado = 1;
                    $conceptoPoliza = "RETIROS DE CIF E IMPUESTOS EN ALMACEN FISCAL DE BODEGAS Y PREDIO DE VEHICULOS"; //EXPLICACION CONTABLE
                    $debeCif = "DEBE"; //NATURALEZA DE CUENTA CONTABLE SUMA AL LIBRO DIARIO
                    $tipOperaSaldo = "CONTRAPARTIDA";
                    $tipConcepto = "RETIRO CIF AF";
                    $respIngContra = ModeloGenerarContabilidad::mdlGuardarPolContable($sp, $conPolDefCif, $dependencia, $totalVal, $estado, $conceptoPoliza, $numeroDepolizaAsig, $debeCif, $tipOperaSaldo, $tipConcepto); //ENVIANDO PARAMETROS A UN OBJETO EN EL MODELO
                    if ($respIngContra[0]["resp"] == 1) {
                        $conPolDefCif = "802103.0101"; //CUENTA DEFAULT PARA REGISTRAR IMPUESTOS INGRESO
                        $debeCif = "HABER"; //NATURALEZA DE CUENTA CONTABLE SUMA AL LIBRO DIARIO
                        $tipOperaSaldo = "RESTA";
                        $tipConcepto = "RETIRO CIF AF";
                        $respIngCif = ModeloGenerarContabilidad::mdlGuardarPolContable($sp, $conPolDefCif, $dependencia, $sumCif, $estado, $conceptoPoliza, $numeroDepolizaAsig, $debeCif, $tipOperaSaldo, $tipConcepto); //ENVIANDO PARAMETROS A UN OBJETO EN EL MODELO
                        if ($respIngCif[0]["resp"] == 1) {
                            $conPolDefImpst = "801109.01"; //CUENTA DEFAULT PARA REGISTRAR IMPUESTOS INGRESO
                            $debeImpst = "HABER"; //NATURALEZA DE CUENTA CONTABLE SUMA AL LIBRO DIARIO
                            $tipOperaSaldo = "RESTA";
                            $tipConcepto = "RETIRO IMPUESTOS AF";
                            $respIngImpuesto = ModeloGenerarContabilidad::mdlGuardarPolContable($sp, $conPolDefImpst, $dependencia, $sumImpuesto, $estado, $conceptoPoliza, $numeroDepolizaAsig, $debeImpst, $tipOperaSaldo, $tipConcepto); //ENVIANDO PARAMETROS A UN OBJETO EN EL MODELO
                        }
                    }
                }
            }
            return true;
        }
    

    public static function ctrUltimaFecha() {
        $sp = "spMaxContabilidad";
        $respMaxFecha = ModeloGenerarContabilidad::mdlMostrarIng($sp);
        if ($respMaxFecha[0]["fechaMaxima"] != 0) {
            $fechaMax = $respMaxFecha[0]["fechaMaxima"];
            $fechaMaxFormat = date("d/m/Y", strtotime($fechaMax . "+ 1 days"));
            return $fechaMaxFormat;
        } else {
            return "SD";
        }
    }

    public static function ctrMostrarPolConta($fechaPoliza, $entidad) {
        $sp = "spVerPolizaContable";
        $respMstCont = ModeloGenerarContabilidad::mdlMostrarRetirosFiscales($sp, $fechaPoliza, $entidad);

        return $respMstCont;
    }

    public static function ctrTotalPolizaContable($polizaNum) {
        $sp = "spSumTotalPol";
        $respTotalPoliza = ModeloGenerarContabilidad::mdlMostrarContabilidad($sp, $polizaNum);
        return $respTotalPoliza;
    }

}
