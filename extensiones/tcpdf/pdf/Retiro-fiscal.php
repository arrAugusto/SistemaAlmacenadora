<?php

require_once "../../../controlador/retiroOpe.controlador.php";
require_once "../../../modelo/retiroOpe.modelo.php";


require_once "../../../controlador/paseDeSalida.controlador.php";
require_once "../../../modelo/paseDeSalida.modelo.php";

class imprimirIngresoBodega {

    public $retiro;

    public function pdfDatosRetiro() {
// TRAER DATOS DE INGRESO
        $retiroF = $this->retiroF;

        $respRet = ControladorRetiroOpe::ctrDatosRetirosGenerardos($retiroF);
        $detDR = ControladorRetiroOpe::ctrValoresDRRetiro($retiroF);
        $tipoDR = 0;
        if ($detDR != "SD") {
            $tipoDR = 1;
        }
        $estado = 0;
        $datosUnidades = ControladorRetiroOpe::ctrDatosPilotos($retiroF, $estado);
        $tipo = 1;
        $respAuxRebaja = ControladorPasesDeSalida::ctrAuxiliares($retiroF, $tipo);
        $nombreRebaja = $respAuxRebaja[0]["nombres"];
        $apellidosRebaja = $respAuxRebaja[0]["apellidos"];
        $tipo = 2;
        $respAuxRetiro = ControladorPasesDeSalida::ctrAuxiliares($retiroF, $tipo);
        $nombreRetiro = $respAuxRetiro[0]["nombres"];
        $apellidosRetiro = $respAuxRetiro[0]["apellidos"];
        $valEmpresas = 0;
        $idNitSal = $respRet[0]["idNitRet"];
        $idNitIng = $respRet[0]["idNitIng"];

        $empresaSal = $respRet[0]["nombreRet"];
        $empresaIng = $respRet[0]["nombreIng"];

        $nitEmpresa = $respRet[0]["nitEmpresa"];

        $nitEmpresa = $respRet[0]["nitEmpresa"];
        $nitEmpresa = $respRet[0]["nitEmpresa"];

        $descProducto = $respRet[0]["descProducto"];
        $bultosSalida = $respRet[0]["bultosSalida"];

        $polRetiro = $respRet[0]["polRetiro"];
        $polIng = $respRet[0]["polIng"];

        $valCif = number_format($respRet[0]["valCif"], 2);
        $valImpuesto = number_format($respRet[0]["valImpuesto"], 2);

        $concatenarConsultImagen = "../../imagenesQRCreadasRet/qrCodeRet" . $retiroF . ".png";

        $fechaEmision = $respRet[0]["fechaEm"]->format("d-m-Y h:i:s A");
        $numeroRetiro = $respRet[0]["numeroRetiro"];
        require_once('tcpdf_include.php');

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

//$pdf->startPageGroup();

        $pdf->AddPage();

//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        $pdf->SetMargins(6, 0, 6);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
// 
//---------------------------------------------------------------------------------------------------
        if (count($datosUnidades) >= 3) {


            $bloque1 = <<<EOF
	<table style="border: none; padding: none; margin: none;">
		<tr><br/>
			<td style="width:130px; text-align:left;"><img src="images/almacenadoras_logo.png"></td>
                        <td style="width:432px; text-align:right; font-size:7px;">
                            <br/>
                            NIT: 874108
                            <br/>
                            Dirección: 24 av. 41-81, Zona 12 
                            <br/>
                            Teléfono: 2422-3000 
                            <br/>
                            Email: aintegrada@bi.com.gt
                        </td>
		</tr>
	</table>
        <table style="padding:3px; border: none; padding: none; margin: none;">
            <tr>
                <td style="width:400px; text-align:center; font-size:17px; font-family: 'Source Sans Pro';">Retiro de Almacen Fiscal</td>
                <td style="background-color:white; width:160px; text-align:center; color:red; text-align:rigth; font-size:10px;">Retiro No.<br/>$numeroRetiro</td>
            </tr>
                
	</table>
EOF;
            $pdf->writeHTML($bloque1, false, false, false, false, PDF_HEADER_STRING);

//-------------------------------------------------------------------------------------------------------
            if ($tipoDR == 1) {
                $bloque2 = <<<EOF
	<table style="font-size:7.5px; border: none; padding: none; margin: none;">
		<tr><br/>
                    <td style="width:75px"><b>Consignatario :</b></td><td style="width:600px">$empresaSal&nbsp;&nbsp;</td>
                </tr>
                <tr>
                    <td style="width:75px"><b>Nit:</b></td><td style="width:250px">$nitEmpresa</td>
                    <td style="width:90px;"><b>Fecha Emisión:</b></td><td style="width:165px">$fechaEmision</td>    
                </tr>
                <tr>
                <td style="width:75px"><b>Poliza de Retiro:</b></td><td style="width:250px">$polRetiro&nbsp;&nbsp;</td>
                    <td style="width:90px"><b>Valor Cif:</b></td><td style="width:165px">Q. $valCif</td>
                </tr>
                <tr>
   <td style="width:75px"><b>Auxiliar Operativo:</b></td><td style="width:250px">$nombreRebaja $apellidosRebaja&nbsp;&nbsp;</td>
                             
   <td style="width:90px"><b>Valor de Impuestos:</b></td><td style="width:165px">Q. $valImpuesto&nbsp;&nbsp;</td>
                </tr>
                <tr>
                <td style="width:75px"><b>Auxiliar Bodega:</b></td><td style="width:165px">$nombreRetiro $apellidosRetiro&nbsp;&nbsp;</td>
                </tr>    
        </table>	
EOF;
                $pdf->writeHTML($bloque2, false, false, false, false, '');
            } else {

                $bloque2 = <<<EOF
	<table style="font-size:7.5px; border: none; padding: none; margin: none;">
		<tr><br/>
                    <td style="width:75px"><b>Consignatario :</b></td><td style="width:600px">$empresaSal&nbsp;&nbsp;</td>
                </tr>
                <tr>
                    <td style="width:75px"><b>Nit:</b></td><td style="width:250px">$nitEmpresa</td>
                    <td style="width:90px;"><b>Fecha Emisión:</b></td><td style="width:165px">$fechaEmision</td>    
                </tr>
                <tr>
                      <td style="width:75px"><b>Poliza de Ingreso:</b></td><td style="width:250px">$polIng&nbsp;&nbsp;</td>
                    <td style="width:90px"><b>Poliza de Retiro:</b></td><td style="width:165px">$polRetiro</td>
                </tr>
                <tr>
                <td style="width:75px"><b>Valor Cif:</b></td><td style="width:250px">Q. $valCif&nbsp;&nbsp;</td>
                <td style="width:90px"><b>Valor de Impuestos:</b></td><td style="width:165px">Q. $valImpuesto&nbsp;&nbsp;</td>
                </tr>
                <tr>
                <td style="width:75px"><b>Auxiliar Operativo:</b></td><td style="width:250px">$nombreRebaja $apellidosRebaja&nbsp;&nbsp;</td>
                <td style="width:90px"><b>Auxiliar Bodega:</b></td><td style="width:165px">$nombreRetiro $apellidosRetiro&nbsp;&nbsp;</td>
                </tr>    
        </table>	
EOF;
                $pdf->writeHTML($bloque2, false, false, false, false, '');
            }

            if ($respRet[0]["cantChasN"] >= 1) {
                $sp = "spChasisVNuevo";
                $dataChasNew = ModeloRetiroOpe::mdlModificacionDetalles($retiroF, $sp);


                $bloque3 = <<<EOF
<table style="font-size:8px;">
 		<tr>
                 <br/>
                    <th style="border: 1px solid #030505; background-color:white; width:190px; text-align:center;"><strong>CHASIS VEHICULO</strong></th>
                    <th style="border: 1px solid #030505; background-color:white; width:100px; text-align:center;"><strong>TIPO</strong></th>
                    <th style="border: 1px solid #030505; background-color:white; width:100px; text-align:center;"><strong>LINEA</strong></th>            
                    <th style="border: 1px solid #030505; background-color:white; width:100px; text-align:center;"><strong>PREDIO</strong></th>            
                    <th style="border: 1px solid #030505; background-color:white; width:70px; text-align:center;"><strong>CANTIDAD</strong></th>            
</tr>
</table>	
EOF;
                $pdf->writeHTML($bloque3, false, false, false, false, '');
                $cant = 0;
                foreach ($dataChasNew as $key => $value) {
                    $chasis = $value["chasis"];
                    $tipoVehiculo = $value["tipoVehiculo"];
                    $linea = $value["linea"];
                    $predio = $value["predio"];
                    $cantidad = 1;
                    $cant = $cant + 1;

                    $fontLetra = "font-size:7px";
                    $tdChasis = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:190px; ' . $fontLetra . ' text-align:left;">' . $chasis . '</td>';
                    $tdTipo = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:100px; ' . $fontLetra . '">' . $tipoVehiculo . '</td>';
                    $tdLinea = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:100px; ' . $fontLetra . '">' . $linea . '</td>';
                    $tdPredio = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:100px; ' . $fontLetra . '">' . $predio . '</td>';
                    $tdCantidad = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:70px; ' . $fontLetra . ' ">' . $cantidad . '</td>';
                    $bloque4 = <<<EOF
<table style="padding: 2px 5px; text-align:center;">
        <tr>
            $tdChasis
            $tdTipo
            $tdLinea
            $tdPredio
            $tdCantidad
        </tr>
</table>	
EOF;
                    $pdf->writeHTML($bloque4, false, false, false, false, '');
                }
                $bloque3 = <<<EOF
	<table style="font-size:8px; text-align:center;">
 		<tr>
                    <th style="border: 1px solid #030505; background-color:white; width:490px;"><strong>TOTAL VEHICULOS RETIRADOS</strong></th>
                    <th style="border: 1px solid #030505; background-color:white; width:70px;"><strong>$cant</strong></th>
		</tr>
	</table>	
EOF;
                $pdf->writeHTML($bloque3, false, false, false, false, '');
            } else {


//INICIO DETALLE MERCADERIA
//-------------------------------------------------------------------------------------------------------        
                $bloque3 = <<<EOF
	<table style="font-size:8px; text-align:center;">
 		<tr>
                 <br/>
                    <th style="border: 1px solid #030505; background-color:white; width:500px;"><strong>DESCRIPCIÓN Y CONTENIDO</strong></th>
                    <th style="border: 1px solid #030505; background-color:white; width:62px;"><strong>CANTIDAD</strong></th>
		</tr>
	</table>	
EOF;
                $pdf->writeHTML($bloque3, false, false, false, false, '');
//-------------------------------------------------------------------------------------------------------        
                $fontLetra = "font-size:7px";
                $tdDetalle = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; border-bottom: 1px solid #030505; width:500px; ' . $fontLetra . ' text-align:left;">' . $descProducto . '</td>';
                $tdCantidad = '<td style="text-align:center; border-right: 1px solid #030505; border-bottom: 1px solid #030505; width:62px; ' . $fontLetra . '">' . $bultosSalida . '</td>';
                $bloque4 = <<<EOF
	<table style="padding: 2px 5px">
		<tr>
        		$tdDetalle
                        $tdCantidad
		</tr>
	</table>	
EOF;
                $pdf->writeHTML($bloque4, false, false, false, false, '');
//-------------------------------------------------------------------------------------------------------
                $bloque5 = <<<EOF
	<table style="font-size:8px;">
            <tr>
                <th style="border: 1px solid #030505; background-color:white; width:500px; text-align:center"><strong>TOTAL DE BULTOS RETIRADOS</strong></th>
                <th style="border: 1px solid #030505; background-color:white; width:62px; text-align:center"><strong>$bultosSalida</strong></th>
            </tr>
	</table>	
EOF;

                $pdf->writeHTML($bloque5, false, false, false, false, '');
//FIN DETALLE MERCADERIA
//-------------------------------------------------------------------------------------------------------

                if ($tipoDR == 1) {
                    //-------------------------------------------------------------------------------------------------------

                    $bloque3 = <<<EOF
	<table style="font-size:8px; text-align:left;">
      
	<tr>
            <th style="width:562px; text-align:center;"></th>
   </tr>
	</table>	
EOF;

                    $pdf->writeHTML($bloque3, false, false, false, false, '');
//-------------------------------------------------------------------------------------------------------
                    $bloque5 = <<<EOF
	<table style="font-size:9px;">
            <tr><br/>
                <th style="border-bottom: 1px solid #030505; width:562px; text-align:center"><strong>REBAJA DE BULTOS PÓLIZA DR</strong></th>
            </tr>
	</table>	
EOF;

                    $pdf->writeHTML($bloque5, false, false, false, false, '');
                    //-------------------------------------------------------------------------------------------------------

                    $bloque3 = <<<EOF
	<table style="font-size:8px; text-align:left;">
      
	<tr><br/>
            <th style="border: 1px solid #030505; background-color:white; width:60px; text-align:center;"><strong>Nit</strong></th>
            <th style="border: 1px solid #030505; background-color:white; width:230px; text-align:center;"><strong>Empresa</strong></th>
            <th style="border: 1px solid #030505; background-color:white; width:80px; text-align:center;"><strong>Ingreso</strong></th>                
            <th style="border: 1px solid #030505; background-color:white; width:80px; text-align:center;"><strong>Poliza</strong></th>
            <th style="border: 1px solid #030505; background-color:white; width:50px; text-align:center;"><strong>Regimen</strong></th>
            <th style="border: 1px solid #030505; background-color:white; width:62px; text-align:center;"><strong>Bultos</strong></th>
   </tr>
	</table>	
EOF;

                    $pdf->writeHTML($bloque3, false, false, false, false, '');

                    $totalBultos = 0;
                    foreach ($detDR as $key => $value) {
                        $totalBultos = $totalBultos + $value["bultos"];
                        //-------------------------------------------------------------------------------------------------------
                        $tdNit = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:60px; text-align:center;">' . $value["nitEmpresa"] . '</td>';
                        $tdEmpresa = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:230px; text-align:center;">' . $value["nombreEmpresa"] . '</td>';
                        $tdIng = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:80px; text-align:center;">' . $value["numeroIngreso"] . '</td>';
                        $tdPol = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:80px; text-align:center;">' . $value["numeroPoliza"] . '</td>';
                        $tdRegimen = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:50px; text-align:center;">' . $value["regimen"] . '</td>';
                        $tdbultos = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:62px; text-align:center;">' . $value["bultos"] . '</td>';

                        $bloque3 = <<<EOF
	<table style="font-size:8px; text-align:left;">
      
	<tr>
            $tdNit
            $tdEmpresa
            $tdIng  
            $tdPol   
            $tdRegimen
            $tdbultos
   </tr>
	</table>	
EOF;

                        $pdf->writeHTML($bloque3, false, false, false, false, '');
                    }
                    //-------------------------------------------------------------------------------------------------------

                    $bloque3 = <<<EOF
	<table style="font-size:8px; text-align:left;">
      
	<tr>
            <th style="border: 1px solid #030505; background-color:white; width:500px; text-align:center;"><strong>TOTAL REBAJA DE BULTOS PÓLIZA DR</strong></th>
            <th style="border: 1px solid #030505; background-color:white; width:62px; text-align:center;"><strong>$totalBultos</strong></th>
   </tr>
	</table>	
EOF;

                    $pdf->writeHTML($bloque3, false, false, false, false, '');
                    //-------------------------------------------------------------------------------------------------------

                    $bloque3 = <<<EOF
	<table style="font-size:8px; text-align:left;">
      
	<tr>
            <th style="width:562px; text-align:center;"></th>
   </tr>
	</table>	
EOF;

                    $pdf->writeHTML($bloque3, false, false, false, false, '');
//------------------------------------------------------------------------------------------------------- 
                }
//-------------------------------------------------------------------------------------------------------

                $bloque3 = <<<EOF
	<table style="font-size:8px; text-align:left;">
      
	<tr><br/>
            <th style="border: 1px solid #030505; background-color:white; width:191px;"><strong>Piloto</strong></th>
            <th style="border: 1px solid #030505; background-color:white; width:111px;"><strong>Licencia</strong></th>
            <th style="border: 1px solid #030505; background-color:white; width:90px;"><strong>Placa</strong></th>
            <th style="border: 1px solid #030505; background-color:white; width:100px;"><strong>Contenedor</strong></th>
            <th style="border: 1px solid #030505; background-color:white; width:70px;"><strong>Marchamo</strong></th>
        </tr>
	</table>	
EOF;

                $pdf->writeHTML($bloque3, false, false, false, false, '');
//------------------------------------------------------------------------------------------------------- 
                foreach ($datosUnidades as $key => $value) {
                    if ($value["estadoUnidad"] != 0) {


                        $nombrePiloto = $value["nombrePiloto"];
                        $licPiloto = $value["licPiloto"];
                        $placaUnidad = $value["placaUnidad"];
                        $contenedorUnidad = $value["contenedorUnidad"];
                        $numMarchamo = $value["numMarchamo"];

                        if ($numMarchamo == 0) {
                            $numMarchamo = "NO APLICA";
                        }

                        $colPiloto = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; border-bottom: 1px solid #030505; width:191px; ' . $fontLetra . '">' . $nombrePiloto . '</td>';
                        $colLic = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; border-bottom: 1px solid #030505; width:111px; ' . $fontLetra . '">' . $licPiloto . '</td>';
                        $colPlaca = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; border-bottom: 1px solid #030505; width:90px; ' . $fontLetra . '">' . $placaUnidad . '</td>';
                        $colContainer = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; border-bottom: 1px solid #030505; width:100px; ' . $fontLetra . '">' . $contenedorUnidad . '</td>';
                        $marchamo = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; border-bottom: 1px solid #030505; width:70px; ' . $fontLetra . '">' . $numMarchamo . '</td>';
                        $bloque6 = <<<EOF
	<table style="padding: 2px 5px; text-align:left;">
		<tr>
        	    $colPiloto
                    $colLic
                    $colPlaca
                    $colContainer  
                    $marchamo
		</tr>
    	</table>	
EOF;
                        $pdf->writeHTML($bloque6, false, false, false, false, '');
                    }
                }
            }
//-------------------------------------------------------------------------------------------------------
            $bloque7 = <<<EOF
<table style="font-size:7px; border: none; padding: none; margin: none;"> <!-- Lo cambiaremos por CSS -->
    <tbody>
    <tr><br/><br/><br/><br/>
        <td style="width:186px text-align:left; border: none; padding: none; margin: none;">Elaborado por.:_________________________________</td>    
        <td style="width:185px text-align:left; border: none; padding: none; margin: none;">Vo. Bo.:_________________________________</td>    
        <td style="width:185px text-align:left; border: none; padding: none; margin: none;">Recibí Conforme.:_________________________________</td>    
   </tr>
    </tbody>
</table>
EOF;

            $pdf->writeHTML($bloque7, false, false, false, false, '');
//-------------------------------------------------------------------------------------------------------

            $bloque8 = <<<EOF
       <table style="font-size:7px; border: none; padding: none; margin: none;"> <!-- Lo cambiaremos por CSS -->
	<tbody>
		<tr><br/><td style="width:245px text-align:left; border: none; padding: none; margin: none;"></td>
			<td style="width:242px text-align:left;"></td>
			<td rowspan="2" style="width:80px text-align:center;"><img style="width:80px; height:80px; text-align:center;" src=""></td>
		</tr>
		<tr>
			<td colspan="2" style="width:480px; text-align:left;"><br/><strong>Nota:</strong> <br/>Se han entregado los bultos arriba descritos, al portador quien declara haberlos recibido a su entera satisfacción y no se aceptará ninguna reclamación que se formule despues de haber sido retirados de la bodega<br/></td>
 			<td style="width:80px; text-align:left;"><img style="width:80px; height:80px; text-align:center;" src="$concatenarConsultImagen"></td>               
		</tr>
	</tbody>
        </table>
EOF;

            $pdf->writeHTML($bloque8, false, false, false, false, '');
//$pdf->startPageGroup();

            $pdf->AddPage();

//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

            $pdf->SetMargins(6, 0, 6);
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);
// SEGUNDA PAGINA            
            $bloque1 = <<<EOF
	<table style="border: none; padding: none; margin: none;">
		<tr><br/>
			<td style="width:130px; text-align:left;"><img src="images/almacenadoras_logo.png"></td>
                        <td style="width:432px; text-align:right; font-size:7px;">
                            <br/>
                            NIT: 874108
                            <br/>
                            Dirección: 24 av. 41-81, Zona 12 
                            <br/>
                            Teléfono: 2422-3000 
                            <br/>
                            Email: aintegrada@bi.com.gt
                        </td>
		</tr>
	</table>
        <table style="padding:3px; border: none; padding: none; margin: none;">
            <tr>
                <td style="width:400px; text-align:center; font-size:17px; font-family: 'Source Sans Pro';">Retiro de Almacen Fiscal</td>
                <td style="background-color:white; width:160px; text-align:center; color:red; text-align:rigth; font-size:10px;">Retiro No.<br/>$numeroRetiro</td>
            </tr>
                
	</table>
EOF;
            $pdf->writeHTML($bloque1, false, false, false, false, PDF_HEADER_STRING);

//-------------------------------------------------------------------------------------------------------
            if ($tipoDR == 1) {
                $bloque2 = <<<EOF
	<table style="font-size:7.5px; border: none; padding: none; margin: none;">
		<tr><br/>
                    <td style="width:75px"><b>Consignatario :</b></td><td style="width:600px">$empresaSal&nbsp;&nbsp;</td>
                </tr>
                <tr>
                    <td style="width:75px"><b>Nit:</b></td><td style="width:250px">$nitEmpresa</td>
                    <td style="width:90px;"><b>Fecha Emisión:</b></td><td style="width:165px">$fechaEmision</td>    
                </tr>
                <tr>
                <td style="width:75px"><b>Poliza de Retiro:</b></td><td style="width:250px">$polRetiro&nbsp;&nbsp;</td>
                    <td style="width:90px"><b>Valor Cif:</b></td><td style="width:165px">Q. $valCif</td>
                </tr>
                <tr>
   <td style="width:75px"><b>Auxiliar Operativo:</b></td><td style="width:250px">$nombreRebaja $apellidosRebaja&nbsp;&nbsp;</td>
                             
   <td style="width:90px"><b>Valor de Impuestos:</b></td><td style="width:165px">Q. $valImpuesto&nbsp;&nbsp;</td>
                </tr>
                <tr>
                <td style="width:75px"><b>Auxiliar Bodega:</b></td><td style="width:165px">$nombreRetiro $apellidosRetiro&nbsp;&nbsp;</td>
                </tr>    
        </table>	
EOF;
                $pdf->writeHTML($bloque2, false, false, false, false, '');
            } else {

                $bloque2 = <<<EOF
	<table style="font-size:7.5px; border: none; padding: none; margin: none;">
		<tr><br/>
                    <td style="width:75px"><b>Consignatario :</b></td><td style="width:600px">$empresaSal&nbsp;&nbsp;</td>
                </tr>
                <tr>
                    <td style="width:75px"><b>Nit:</b></td><td style="width:250px">$nitEmpresa</td>
                    <td style="width:90px;"><b>Fecha Emisión:</b></td><td style="width:165px">$fechaEmision</td>    
                </tr>
                <tr>
                      <td style="width:75px"><b>Poliza de Ingreso:</b></td><td style="width:250px">$polIng&nbsp;&nbsp;</td>
                    <td style="width:90px"><b>Poliza de Retiro:</b></td><td style="width:165px">$polRetiro</td>
                </tr>
                <tr>
                <td style="width:75px"><b>Valor Cif:</b></td><td style="width:250px">Q. $valCif&nbsp;&nbsp;</td>
                <td style="width:90px"><b>Valor de Impuestos:</b></td><td style="width:165px">Q. $valImpuesto&nbsp;&nbsp;</td>
                </tr>
                <tr>
                <td style="width:75px"><b>Auxiliar Operativo:</b></td><td style="width:250px">$nombreRebaja $apellidosRebaja&nbsp;&nbsp;</td>
                <td style="width:90px"><b>Auxiliar Bodega:</b></td><td style="width:165px">$nombreRetiro $apellidosRetiro&nbsp;&nbsp;</td>
                </tr>    
        </table>	
EOF;
                $pdf->writeHTML($bloque2, false, false, false, false, '');
            }

            if ($respRet[0]["cantChasN"] >= 1) {
                $sp = "spChasisVNuevo";
                $dataChasNew = ModeloRetiroOpe::mdlModificacionDetalles($retiroF, $sp);


                $bloque3 = <<<EOF
<table style="font-size:8px;">
 		<tr>
                 <br/>
                    <th style="border: 1px solid #030505; background-color:white; width:190px; text-align:center;"><strong>CHASIS VEHICULO</strong></th>
                    <th style="border: 1px solid #030505; background-color:white; width:100px; text-align:center;"><strong>TIPO</strong></th>
                    <th style="border: 1px solid #030505; background-color:white; width:100px; text-align:center;"><strong>LINEA</strong></th>            
                    <th style="border: 1px solid #030505; background-color:white; width:100px; text-align:center;"><strong>PREDIO</strong></th>            
                    <th style="border: 1px solid #030505; background-color:white; width:70px; text-align:center;"><strong>CANTIDAD</strong></th>            
</tr>
</table>	
EOF;
                $pdf->writeHTML($bloque3, false, false, false, false, '');
                $cant = 0;
                foreach ($dataChasNew as $key => $value) {
                    $chasis = $value["chasis"];
                    $tipoVehiculo = $value["tipoVehiculo"];
                    $linea = $value["linea"];
                    $predio = $value["predio"];
                    $cantidad = 1;
                    $cant = $cant + 1;

                    $fontLetra = "font-size:7px";
                    $tdChasis = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:190px; ' . $fontLetra . ' text-align:left;">' . $chasis . '</td>';
                    $tdTipo = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:100px; ' . $fontLetra . '">' . $tipoVehiculo . '</td>';
                    $tdLinea = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:100px; ' . $fontLetra . '">' . $linea . '</td>';
                    $tdPredio = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:100px; ' . $fontLetra . '">' . $predio . '</td>';
                    $tdCantidad = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:70px; ' . $fontLetra . ' ">' . $cantidad . '</td>';
                    $bloque4 = <<<EOF
<table style="padding: 2px 5px; text-align:center;">
        <tr>
            $tdChasis
            $tdTipo
            $tdLinea
            $tdPredio
            $tdCantidad
        </tr>
</table>	
EOF;
                    $pdf->writeHTML($bloque4, false, false, false, false, '');
                }
                $bloque3 = <<<EOF
	<table style="font-size:8px; text-align:center;">
 		<tr>
                    <th style="border: 1px solid #030505; background-color:white; width:490px;"><strong>TOTAL VEHICULOS RETIRADOS</strong></th>
                    <th style="border: 1px solid #030505; background-color:white; width:70px;"><strong>$cant</strong></th>
		</tr>
	</table>	
EOF;
                $pdf->writeHTML($bloque3, false, false, false, false, '');
            } else {


//INICIO DETALLE MERCADERIA
//-------------------------------------------------------------------------------------------------------        
                $bloque3 = <<<EOF
	<table style="font-size:8px; text-align:center;">
 		<tr>
                 <br/>
                    <th style="border: 1px solid #030505; background-color:white; width:500px;"><strong>DESCRIPCIÓN Y CONTENIDO</strong></th>
                    <th style="border: 1px solid #030505; background-color:white; width:62px;"><strong>CANTIDAD</strong></th>
		</tr>
	</table>	
EOF;
                $pdf->writeHTML($bloque3, false, false, false, false, '');
//-------------------------------------------------------------------------------------------------------        
                $fontLetra = "font-size:7px";
                $tdDetalle = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; border-bottom: 1px solid #030505; width:500px; ' . $fontLetra . ' text-align:left;">' . $descProducto . '</td>';
                $tdCantidad = '<td style="text-align:center; border-right: 1px solid #030505; border-bottom: 1px solid #030505; width:62px; ' . $fontLetra . '">' . $bultosSalida . '</td>';
                $bloque4 = <<<EOF
	<table style="padding: 2px 5px">
		<tr>
        		$tdDetalle
                        $tdCantidad
		</tr>
	</table>	
EOF;
                $pdf->writeHTML($bloque4, false, false, false, false, '');
//-------------------------------------------------------------------------------------------------------
                $bloque5 = <<<EOF
	<table style="font-size:8px;">
            <tr>
                <th style="border: 1px solid #030505; background-color:white; width:500px; text-align:center"><strong>TOTAL DE BULTOS RETIRADOS</strong></th>
                <th style="border: 1px solid #030505; background-color:white; width:62px; text-align:center"><strong>$bultosSalida</strong></th>
            </tr>
	</table>	
EOF;

                $pdf->writeHTML($bloque5, false, false, false, false, '');
//FIN DETALLE MERCADERIA
//-------------------------------------------------------------------------------------------------------

                if ($tipoDR == 1) {
                    //-------------------------------------------------------------------------------------------------------

                    $bloque3 = <<<EOF
	<table style="font-size:8px; text-align:left;">
      
	<tr>
            <th style="width:562px; text-align:center;"></th>
   </tr>
	</table>	
EOF;

                    $pdf->writeHTML($bloque3, false, false, false, false, '');
//-------------------------------------------------------------------------------------------------------
                    $bloque5 = <<<EOF
	<table style="font-size:9px;">
            <tr><br/>
                <th style="border-bottom: 1px solid #030505; width:562px; text-align:center"><strong>REBAJA DE BULTOS PÓLIZA DR</strong></th>
            </tr>
	</table>	
EOF;

                    $pdf->writeHTML($bloque5, false, false, false, false, '');
                    //-------------------------------------------------------------------------------------------------------

                    $bloque3 = <<<EOF
	<table style="font-size:8px; text-align:left;">
      
	<tr><br/>
            <th style="border: 1px solid #030505; background-color:white; width:60px; text-align:center;"><strong>Nit</strong></th>
            <th style="border: 1px solid #030505; background-color:white; width:230px; text-align:center;"><strong>Empresa</strong></th>
            <th style="border: 1px solid #030505; background-color:white; width:80px; text-align:center;"><strong>Ingreso</strong></th>                
            <th style="border: 1px solid #030505; background-color:white; width:80px; text-align:center;"><strong>Poliza</strong></th>
            <th style="border: 1px solid #030505; background-color:white; width:50px; text-align:center;"><strong>Regimen</strong></th>
            <th style="border: 1px solid #030505; background-color:white; width:62px; text-align:center;"><strong>Bultos</strong></th>
   </tr>
	</table>	
EOF;

                    $pdf->writeHTML($bloque3, false, false, false, false, '');

                    $totalBultos = 0;
                    foreach ($detDR as $key => $value) {
                        $totalBultos = $totalBultos + $value["bultos"];
                        //-------------------------------------------------------------------------------------------------------
                        $tdNit = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:60px; text-align:center;">' . $value["nitEmpresa"] . '</td>';
                        $tdEmpresa = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:230px; text-align:center;">' . $value["nombreEmpresa"] . '</td>';
                        $tdIng = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:80px; text-align:center;">' . $value["numeroIngreso"] . '</td>';
                        $tdPol = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:80px; text-align:center;">' . $value["numeroPoliza"] . '</td>';
                        $tdRegimen = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:50px; text-align:center;">' . $value["regimen"] . '</td>';
                        $tdbultos = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:62px; text-align:center;">' . $value["bultos"] . '</td>';

                        $bloque3 = <<<EOF
	<table style="font-size:8px; text-align:left;">
      
	<tr>
            $tdNit
            $tdEmpresa
            $tdIng  
            $tdPol   
            $tdRegimen
            $tdbultos
   </tr>
	</table>	
EOF;

                        $pdf->writeHTML($bloque3, false, false, false, false, '');
                    }
                    //-------------------------------------------------------------------------------------------------------

                    $bloque3 = <<<EOF
	<table style="font-size:8px; text-align:left;">
      
	<tr>
            <th style="border: 1px solid #030505; background-color:white; width:500px; text-align:center;"><strong>TOTAL REBAJA DE BULTOS PÓLIZA DR</strong></th>
            <th style="border: 1px solid #030505; background-color:white; width:62px; text-align:center;"><strong>$totalBultos</strong></th>
   </tr>
	</table>	
EOF;

                    $pdf->writeHTML($bloque3, false, false, false, false, '');
                    //-------------------------------------------------------------------------------------------------------

                    $bloque3 = <<<EOF
	<table style="font-size:8px; text-align:left;">
      
	<tr>
            <th style="width:562px; text-align:center;"></th>
   </tr>
	</table>	
EOF;

                    $pdf->writeHTML($bloque3, false, false, false, false, '');
//------------------------------------------------------------------------------------------------------- 
                }
//-------------------------------------------------------------------------------------------------------

                $bloque3 = <<<EOF
	<table style="font-size:8px; text-align:left;">
      
	<tr><br/>
          <br/>
            <th style="border: 1px solid #030505; background-color:white; width:191px;"><strong>Piloto</strong></th>
            <th style="border: 1px solid #030505; background-color:white; width:111px;"><strong>Licencia</strong></th>
            <th style="border: 1px solid #030505; background-color:white; width:90px;"><strong>Placa</strong></th>
            <th style="border: 1px solid #030505; background-color:white; width:100px;"><strong>Contenedor</strong></th>
            <th style="border: 1px solid #030505; background-color:white; width:70px;"><strong>Marchamo</strong></th>
        </tr>
	</table>	
EOF;

                $pdf->writeHTML($bloque3, false, false, false, false, '');
//------------------------------------------------------------------------------------------------------- 
                foreach ($datosUnidades as $key => $value) {
                    if ($value["estadoUnidad"] != 0) {


                        $nombrePiloto = $value["nombrePiloto"];
                        $licPiloto = $value["licPiloto"];
                        $placaUnidad = $value["placaUnidad"];
                        $contenedorUnidad = $value["contenedorUnidad"];
                        $numMarchamo = $value["numMarchamo"];

                        if ($numMarchamo == 0) {
                            $numMarchamo = "NO APLICA";
                        }

                        $colPiloto = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; border-bottom: 1px solid #030505; width:191px; ' . $fontLetra . '">' . $nombrePiloto . '</td>';
                        $colLic = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; border-bottom: 1px solid #030505; width:111px; ' . $fontLetra . '">' . $licPiloto . '</td>';
                        $colPlaca = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; border-bottom: 1px solid #030505; width:90px; ' . $fontLetra . '">' . $placaUnidad . '</td>';
                        $colContainer = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; border-bottom: 1px solid #030505; width:100px; ' . $fontLetra . '">' . $contenedorUnidad . '</td>';
                        $marchamo = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; border-bottom: 1px solid #030505; width:70px; ' . $fontLetra . '">' . $numMarchamo . '</td>';
                        $bloque6 = <<<EOF
	<table style="padding: 2px 5px; text-align:left;">
		<tr>
        	    $colPiloto
                    $colLic
                    $colPlaca
                    $colContainer  
                    $marchamo
		</tr>
    	</table>	
EOF;
                        $pdf->writeHTML($bloque6, false, false, false, false, '');
                    }
                }
            }
//-------------------------------------------------------------------------------------------------------
            $bloque7 = <<<EOF
<table style="font-size:7px; border: none; padding: none; margin: none;"> <!-- Lo cambiaremos por CSS -->
    <tbody>
    <tr><br/><br/><br/><br/>
        <td style="width:186px text-align:left; border: none; padding: none; margin: none;">Elaborado por.:_________________________________</td>    
        <td style="width:185px text-align:left; border: none; padding: none; margin: none;">Vo. Bo.:_________________________________</td>    
        <td style="width:185px text-align:left; border: none; padding: none; margin: none;">Recibí Conforme.:_________________________________</td>    
   </tr>
    </tbody>
</table>
EOF;

            $pdf->writeHTML($bloque7, false, false, false, false, '');
//-------------------------------------------------------------------------------------------------------

            $bloque8 = <<<EOF
       <table style="font-size:7px; border: none; padding: none; margin: none;"> <!-- Lo cambiaremos por CSS -->
	<tbody>
		<tr><br/><td style="width:245px text-align:left; border: none; padding: none; margin: none;"></td>
			<td style="width:242px text-align:left;"></td>
			<td rowspan="2" style="width:80px text-align:center;"><img style="width:80px; height:80px; text-align:center;" src=""></td>
		</tr>
		<tr>
			<td colspan="2" style="width:480px; text-align:left;"><br/><strong>Nota:</strong> <br/>Se han entregado los bultos arriba descritos, al portador quien declara haberlos recibido a su entera satisfacción y no se aceptará ninguna reclamación que se formule despues de haber sido retirados de la bodega<br/></td>
 			<td style="width:80px; text-align:left;"><img style="width:80px; height:80px; text-align:center;" src="$concatenarConsultImagen"></td>               
		</tr>
	</tbody>
        </table>
EOF;

            $pdf->writeHTML($bloque8, false, false, false, false, '');
        } else {


// SINO SI SOLO TIENE UN PILOTO LA  
//---------------------------------------------------------------------------------------------------
            $bloque1 = <<<EOF
	<table style="border: none; padding: none; margin: none;">
		<tr><br/>
			<td style="width:130px; text-align:left;"><img src="images/almacenadoras_logo.png"></td>
                        <td style="width:432px; text-align:right; font-size:7px;">
                            <br/>
                            NIT: 874108
                            <br/>
                            Dirección: 24 av. 41-81, Zona 12 
                            <br/>
                            Teléfono: 2422-3000 
                            <br/>
                            Email: aintegrada@bi.com.gt
                        </td>
		</tr>
	</table>
        <table style="padding:3px; border: none; padding: none; margin: none;">
            <tr>
                <td style="width:400px; text-align:center; font-size:17px; font-family: 'Source Sans Pro';">Retiro de Almacen Fiscal</td>
                <td style="background-color:white; width:160px; text-align:center; color:red; text-align:rigth; font-size:10px;">Retiro No.<br/>$numeroRetiro</td>
            </tr>
                
	</table>
EOF;
            $pdf->writeHTML($bloque1, false, false, false, false, PDF_HEADER_STRING);

//-------------------------------------------------------------------------------------------------------
            if ($tipoDR == 1) {
                $bloque2 = <<<EOF
	<table style="font-size:7.5px; border: none; padding: none; margin: none;">
		<tr><br/>
                    <td style="width:75px"><b>Consignatario :</b></td><td style="width:600px">$empresaSal&nbsp;&nbsp;</td>
                </tr>
                <tr>
                    <td style="width:75px"><b>Nit:</b></td><td style="width:250px">$nitEmpresa</td>
                    <td style="width:90px;"><b>Fecha Emisión:</b></td><td style="width:165px">$fechaEmision</td>    
                </tr>
                <tr>
                <td style="width:75px"><b>Poliza de Retiro:</b></td><td style="width:250px">$polRetiro&nbsp;&nbsp;</td>
                    <td style="width:90px"><b>Valor Cif:</b></td><td style="width:165px">Q. $valCif</td>
                </tr>
                <tr>
   <td style="width:75px"><b>Auxiliar Operativo:</b></td><td style="width:250px">$nombreRebaja $apellidosRebaja&nbsp;&nbsp;</td>
                             
   <td style="width:90px"><b>Valor de Impuestos:</b></td><td style="width:165px">Q. $valImpuesto&nbsp;&nbsp;</td>
                </tr>
                <tr>
                <td style="width:75px"><b>Auxiliar Bodega:</b></td><td style="width:165px">$nombreRetiro $apellidosRetiro&nbsp;&nbsp;</td>
                </tr>    
        </table>	
EOF;
                $pdf->writeHTML($bloque2, false, false, false, false, '');
            } else {

                $bloque2 = <<<EOF
	<table style="font-size:7.5px; border: none; padding: none; margin: none;">
		<tr><br/>
                    <td style="width:75px"><b>Consignatario :</b></td><td style="width:600px">$empresaSal&nbsp;&nbsp;</td>
                </tr>
                <tr>
                    <td style="width:75px"><b>Nit:</b></td><td style="width:250px">$nitEmpresa</td>
                    <td style="width:90px;"><b>Fecha Emisión:</b></td><td style="width:165px">$fechaEmision</td>    
                </tr>
                <tr>
                      <td style="width:75px"><b>Poliza de Ingreso:</b></td><td style="width:250px">$polIng&nbsp;&nbsp;</td>
                    <td style="width:90px"><b>Poliza de Retiro:</b></td><td style="width:165px">$polRetiro</td>
                </tr>
                <tr>
                <td style="width:75px"><b>Valor Cif:</b></td><td style="width:250px">Q. $valCif&nbsp;&nbsp;</td>
                <td style="width:90px"><b>Valor de Impuestos:</b></td><td style="width:165px">Q. $valImpuesto&nbsp;&nbsp;</td>
                </tr>
                <tr>
                <td style="width:75px"><b>Auxiliar Operativo:</b></td><td style="width:250px">$nombreRebaja $apellidosRebaja&nbsp;&nbsp;</td>
                <td style="width:90px"><b>Auxiliar Bodega:</b></td><td style="width:165px">$nombreRetiro $apellidosRetiro&nbsp;&nbsp;</td>
                </tr>    
        </table>	
EOF;
                $pdf->writeHTML($bloque2, false, false, false, false, '');
            }

            if ($respRet[0]["cantChasN"] >= 1) {
                $sp = "spChasisVNuevo";
                $dataChasNew = ModeloRetiroOpe::mdlModificacionDetalles($retiroF, $sp);


                $bloque3 = <<<EOF
<table style="font-size:8px;">
 		<tr>
                 <br/>
                    <th style="border: 1px solid #030505; background-color:white; width:190px; text-align:center;"><strong>CHASIS VEHICULO</strong></th>
                    <th style="border: 1px solid #030505; background-color:white; width:100px; text-align:center;"><strong>TIPO</strong></th>
                    <th style="border: 1px solid #030505; background-color:white; width:100px; text-align:center;"><strong>LINEA</strong></th>            
                    <th style="border: 1px solid #030505; background-color:white; width:100px; text-align:center;"><strong>PREDIO</strong></th>            
                    <th style="border: 1px solid #030505; background-color:white; width:70px; text-align:center;"><strong>CANTIDAD</strong></th>            
</tr>
</table>	
EOF;
                $pdf->writeHTML($bloque3, false, false, false, false, '');
                $cant = 0;
                foreach ($dataChasNew as $key => $value) {
                    $chasis = $value["chasis"];
                    $tipoVehiculo = $value["tipoVehiculo"];
                    $linea = $value["linea"];
                    $predio = $value["predio"];
                    $cantidad = 1;
                    $cant = $cant + 1;

                    $fontLetra = "font-size:7px";
                    $tdChasis = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:190px; ' . $fontLetra . ' text-align:left;">' . $chasis . '</td>';
                    $tdTipo = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:100px; ' . $fontLetra . '">' . $tipoVehiculo . '</td>';
                    $tdLinea = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:100px; ' . $fontLetra . '">' . $linea . '</td>';
                    $tdPredio = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:100px; ' . $fontLetra . '">' . $predio . '</td>';
                    $tdCantidad = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:70px; ' . $fontLetra . ' ">' . $cantidad . '</td>';
                    $bloque4 = <<<EOF
<table style="padding: 2px 5px; text-align:center;">
        <tr>
            $tdChasis
            $tdTipo
            $tdLinea
            $tdPredio
            $tdCantidad
        </tr>
</table>	
EOF;
                    $pdf->writeHTML($bloque4, false, false, false, false, '');
                }
                $bloque3 = <<<EOF
	<table style="font-size:8px; text-align:center;">
 		<tr>
                    <th style="border: 1px solid #030505; background-color:white; width:490px;"><strong>TOTAL VEHICULOS RETIRADOS</strong></th>
                    <th style="border: 1px solid #030505; background-color:white; width:70px;"><strong>$cant</strong></th>
		</tr>
	</table>	
EOF;
                $pdf->writeHTML($bloque3, false, false, false, false, '');
            } else {


//INICIO DETALLE MERCADERIA
//-------------------------------------------------------------------------------------------------------        
                $bloque3 = <<<EOF
	<table style="font-size:8px; text-align:center;">
 		<tr>
                 <br/>
                    <th style="border: 1px solid #030505; background-color:white; width:500px;"><strong>DESCRIPCIÓN Y CONTENIDO</strong></th>
                    <th style="border: 1px solid #030505; background-color:white; width:62px;"><strong>CANTIDAD</strong></th>
		</tr>
	</table>	
EOF;
                $pdf->writeHTML($bloque3, false, false, false, false, '');
//-------------------------------------------------------------------------------------------------------        
                $fontLetra = "font-size:7px";
                $tdDetalle = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; border-bottom: 1px solid #030505; width:500px; ' . $fontLetra . ' text-align:left;">' . $descProducto . '</td>';
                $tdCantidad = '<td style="text-align:center; border-right: 1px solid #030505; border-bottom: 1px solid #030505; width:62px; ' . $fontLetra . '">' . $bultosSalida . '</td>';
                $bloque4 = <<<EOF
	<table style="padding: 2px 5px">
		<tr>
        		$tdDetalle
                        $tdCantidad
		</tr>
	</table>	
EOF;
                $pdf->writeHTML($bloque4, false, false, false, false, '');
//-------------------------------------------------------------------------------------------------------
                $bloque5 = <<<EOF
	<table style="font-size:8px;">
            <tr>
                <th style="border: 1px solid #030505; background-color:white; width:500px; text-align:center"><strong>TOTAL DE BULTOS RETIRADOS</strong></th>
                <th style="border: 1px solid #030505; background-color:white; width:62px; text-align:center"><strong>$bultosSalida</strong></th>
            </tr>
	</table>	
EOF;

                $pdf->writeHTML($bloque5, false, false, false, false, '');
//FIN DETALLE MERCADERIA
//-------------------------------------------------------------------------------------------------------

                if ($tipoDR == 1) {
                    //-------------------------------------------------------------------------------------------------------

                    $bloque3 = <<<EOF
	<table style="font-size:8px; text-align:left;">
      
	<tr>
            <th style="width:562px; text-align:center;"></th>
   </tr>
	</table>	
EOF;

                    $pdf->writeHTML($bloque3, false, false, false, false, '');
//-------------------------------------------------------------------------------------------------------
                    $bloque5 = <<<EOF
	<table style="font-size:9px;">
            <tr><br/>
                <th style="border-bottom: 1px solid #030505; width:562px; text-align:center"><strong>REBAJA DE BULTOS PÓLIZA DR</strong></th>
            </tr>
	</table>	
EOF;

                    $pdf->writeHTML($bloque5, false, false, false, false, '');
                    //-------------------------------------------------------------------------------------------------------

                    $bloque3 = <<<EOF
	<table style="font-size:8px; text-align:left;">
      
	<tr><br/>
            <th style="border: 1px solid #030505; background-color:white; width:60px; text-align:center;"><strong>Nit</strong></th>
            <th style="border: 1px solid #030505; background-color:white; width:230px; text-align:center;"><strong>Empresa</strong></th>
            <th style="border: 1px solid #030505; background-color:white; width:80px; text-align:center;"><strong>Ingreso</strong></th>                
            <th style="border: 1px solid #030505; background-color:white; width:80px; text-align:center;"><strong>Poliza</strong></th>
            <th style="border: 1px solid #030505; background-color:white; width:50px; text-align:center;"><strong>Regimen</strong></th>
            <th style="border: 1px solid #030505; background-color:white; width:62px; text-align:center;"><strong>Bultos</strong></th>
   </tr>
	</table>	
EOF;

                    $pdf->writeHTML($bloque3, false, false, false, false, '');

                    $totalBultos = 0;
                    foreach ($detDR as $key => $value) {
                        $totalBultos = $totalBultos + $value["bultos"];
                        //-------------------------------------------------------------------------------------------------------
                        $tdNit = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:60px; text-align:center;">' . $value["nitEmpresa"] . '</td>';
                        $tdEmpresa = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:230px; text-align:center;">' . $value["nombreEmpresa"] . '</td>';
                        $tdIng = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:80px; text-align:center;">' . $value["numeroIngreso"] . '</td>';
                        $tdPol = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:80px; text-align:center;">' . $value["numeroPoliza"] . '</td>';
                        $tdRegimen = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:50px; text-align:center;">' . $value["regimen"] . '</td>';
                        $tdbultos = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:62px; text-align:center;">' . $value["bultos"] . '</td>';

                        $bloque3 = <<<EOF
	<table style="font-size:8px; text-align:left;">
      
	<tr>
            $tdNit
            $tdEmpresa
            $tdIng  
            $tdPol   
            $tdRegimen
            $tdbultos
   </tr>
	</table>	
EOF;

                        $pdf->writeHTML($bloque3, false, false, false, false, '');
                    }
                    //-------------------------------------------------------------------------------------------------------

                    $bloque3 = <<<EOF
	<table style="font-size:8px; text-align:left;">
      
	<tr>
            <th style="border: 1px solid #030505; background-color:white; width:500px; text-align:center;"><strong>TOTAL REBAJA DE BULTOS PÓLIZA DR</strong></th>
            <th style="border: 1px solid #030505; background-color:white; width:62px; text-align:center;"><strong>$totalBultos</strong></th>
   </tr>
	</table>	
EOF;

                    $pdf->writeHTML($bloque3, false, false, false, false, '');
                    //-------------------------------------------------------------------------------------------------------

                    $bloque3 = <<<EOF
	<table style="font-size:8px; text-align:left;">
      
	<tr>
            <th style="width:562px; text-align:center;"></th>
   </tr>
	</table>	
EOF;

                    $pdf->writeHTML($bloque3, false, false, false, false, '');
//------------------------------------------------------------------------------------------------------- 
                }
//-------------------------------------------------------------------------------------------------------

                $bloque3 = <<<EOF
	<table style="font-size:8px; text-align:left;">
      
	<tr><br/>
          <br/>
            <th style="border: 1px solid #030505; background-color:white; width:191px;"><strong>Piloto</strong></th>
            <th style="border: 1px solid #030505; background-color:white; width:111px;"><strong>Licencia</strong></th>
            <th style="border: 1px solid #030505; background-color:white; width:90px;"><strong>Placa</strong></th>
            <th style="border: 1px solid #030505; background-color:white; width:100px;"><strong>Contenedor</strong></th>
            <th style="border: 1px solid #030505; background-color:white; width:70px;"><strong>Marchamo</strong></th>
        </tr>
	</table>	
EOF;

                $pdf->writeHTML($bloque3, false, false, false, false, '');
//------------------------------------------------------------------------------------------------------- 
                foreach ($datosUnidades as $key => $value) {
                    if ($value["estadoUnidad"] != 0) {


                        $nombrePiloto = $value["nombrePiloto"];
                        $licPiloto = $value["licPiloto"];
                        $placaUnidad = $value["placaUnidad"];
                        $contenedorUnidad = $value["contenedorUnidad"];
                        $numMarchamo = $value["numMarchamo"];

                        if ($numMarchamo == 0) {
                            $numMarchamo = "NO APLICA";
                        }

                        $colPiloto = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; border-bottom: 1px solid #030505; width:191px; ' . $fontLetra . '">' . $nombrePiloto . '</td>';
                        $colLic = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; border-bottom: 1px solid #030505; width:111px; ' . $fontLetra . '">' . $licPiloto . '</td>';
                        $colPlaca = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; border-bottom: 1px solid #030505; width:90px; ' . $fontLetra . '">' . $placaUnidad . '</td>';
                        $colContainer = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; border-bottom: 1px solid #030505; width:100px; ' . $fontLetra . '">' . $contenedorUnidad . '</td>';
                        $marchamo = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; border-bottom: 1px solid #030505; width:70px; ' . $fontLetra . '">' . $numMarchamo . '</td>';
                        $bloque6 = <<<EOF
	<table style="padding: 2px 5px; text-align:left;">
		<tr>
        	    $colPiloto
                    $colLic
                    $colPlaca
                    $colContainer  
                    $marchamo
		</tr>
    	</table>	
EOF;
                        $pdf->writeHTML($bloque6, false, false, false, false, '');
                    }
                }
            }
//-------------------------------------------------------------------------------------------------------
            $bloque7 = <<<EOF
<table style="font-size:7px; border: none; padding: none; margin: none;"> <!-- Lo cambiaremos por CSS -->
    <tbody>
    <tr><br/><br/><br/><br/>
        <td style="width:186px text-align:left; border: none; padding: none; margin: none;">Elaborado por.:_________________________________</td>    
        <td style="width:185px text-align:left; border: none; padding: none; margin: none;">Vo. Bo.:_________________________________</td>    
        <td style="width:185px text-align:left; border: none; padding: none; margin: none;">Recibí Conforme.:_________________________________</td>    
   </tr>
    </tbody>
</table>
EOF;

            $pdf->writeHTML($bloque7, false, false, false, false, '');
//-------------------------------------------------------------------------------------------------------

            $bloque8 = <<<EOF
       <table style="font-size:7px; border: none; padding: none; margin: none;"> <!-- Lo cambiaremos por CSS -->
	<tbody>
		<tr><br/><td style="width:245px text-align:left; border: none; padding: none; margin: none;"></td>
			<td style="width:242px text-align:left;"></td>
			<td rowspan="2" style="width:80px text-align:center;"><img style="width:80px; height:80px; text-align:center;" src=""></td>
		</tr>
		<tr>
			<td colspan="2" style="width:480px; text-align:left;"><br/><strong>Nota:</strong> <br/>Se han entregado los bultos arriba descritos, al portador quien declara haberlos recibido a su entera satisfacción y no se aceptará ninguna reclamación que se formule despues de haber sido retirados de la bodega<br/></td>
 			<td style="width:80px; text-align:left;"><img style="width:80px; height:80px; text-align:center;" src="$concatenarConsultImagen"></td>               
		</tr>
	</tbody>
        </table>
EOF;

            $pdf->writeHTML($bloque8, false, false, false, false, '');


// 
//---------------------------------------------------------------------------------------------------
            $bloque1 = <<<EOF
	<table style="border: none; padding: none; margin: none;">
		<tr><br/>
			<td style="width:130px; text-align:left;"><img src="images/almacenadoras_logo.png"></td>
                        <td style="width:432px; text-align:right; font-size:7px;">
                            <br/>
                            NIT: 874108
                            <br/>
                            Dirección: 24 av. 41-81, Zona 12 
                            <br/>
                            Teléfono: 2422-3000 
                            <br/>
                            Email: aintegrada@bi.com.gt
                        </td>
		</tr>
	</table>
        <table style="padding:3px; border: none; padding: none; margin: none;">
            <tr>
                <td style="width:400px; text-align:center; font-size:17px; font-family: 'Source Sans Pro';">Retiro de Almacen Fiscal</td>
                <td style="background-color:white; width:160px; text-align:center; color:red; text-align:rigth; font-size:10px;">Retiro No.<br/>$numeroRetiro</td>
            </tr>
                
	</table>
EOF;
            $pdf->writeHTML($bloque1, false, false, false, false, PDF_HEADER_STRING);

//-------------------------------------------------------------------------------------------------------
            if ($tipoDR == 1) {
                $bloque2 = <<<EOF
	<table style="font-size:7.5px; border: none; padding: none; margin: none;">
		<tr><br/>
                    <td style="width:75px"><b>Consignatario :</b></td><td style="width:600px">$empresaSal&nbsp;&nbsp;</td>
                </tr>
                <tr>
                    <td style="width:75px"><b>Nit:</b></td><td style="width:250px">$nitEmpresa</td>
                    <td style="width:90px;"><b>Fecha Emisión:</b></td><td style="width:165px">$fechaEmision</td>    
                </tr>
                <tr>
                <td style="width:75px"><b>Poliza de Retiro:</b></td><td style="width:250px">$polRetiro&nbsp;&nbsp;</td>
                    <td style="width:90px"><b>Valor Cif:</b></td><td style="width:165px">Q. $valCif</td>
                </tr>
                <tr>
   <td style="width:75px"><b>Auxiliar Operativo:</b></td><td style="width:250px">$nombreRebaja $apellidosRebaja&nbsp;&nbsp;</td>
                             
   <td style="width:90px"><b>Valor de Impuestos:</b></td><td style="width:165px">Q. $valImpuesto&nbsp;&nbsp;</td>
                </tr>
                <tr>
                <td style="width:75px"><b>Auxiliar Bodega:</b></td><td style="width:165px">$nombreRetiro $apellidosRetiro&nbsp;&nbsp;</td>
                </tr>    
        </table>	
EOF;
                $pdf->writeHTML($bloque2, false, false, false, false, '');
            } else {

                $bloque2 = <<<EOF
	<table style="font-size:7.5px; border: none; padding: none; margin: none;">
		<tr><br/>
                    <td style="width:75px"><b>Consignatario :</b></td><td style="width:600px">$empresaSal&nbsp;&nbsp;</td>
                </tr>
                <tr>
                    <td style="width:75px"><b>Nit:</b></td><td style="width:250px">$nitEmpresa</td>
                    <td style="width:90px;"><b>Fecha Emisión:</b></td><td style="width:165px">$fechaEmision</td>    
                </tr>
                <tr>
                      <td style="width:75px"><b>Poliza de Ingreso:</b></td><td style="width:250px">$polIng&nbsp;&nbsp;</td>
                    <td style="width:90px"><b>Poliza de Retiro:</b></td><td style="width:165px">$polRetiro</td>
                </tr>
                <tr>
                <td style="width:75px"><b>Valor Cif:</b></td><td style="width:250px">Q. $valCif&nbsp;&nbsp;</td>
                <td style="width:90px"><b>Valor de Impuestos:</b></td><td style="width:165px">Q. $valImpuesto&nbsp;&nbsp;</td>
                </tr>
                <tr>
                <td style="width:75px"><b>Auxiliar Operativo:</b></td><td style="width:250px">$nombreRebaja $apellidosRebaja&nbsp;&nbsp;</td>
                <td style="width:90px"><b>Auxiliar Bodega:</b></td><td style="width:165px">$nombreRetiro $apellidosRetiro&nbsp;&nbsp;</td>
                </tr>    
        </table>	
EOF;
                $pdf->writeHTML($bloque2, false, false, false, false, '');
            }

            if ($respRet[0]["cantChasN"] >= 1) {
                $sp = "spChasisVNuevo";
                $dataChasNew = ModeloRetiroOpe::mdlModificacionDetalles($retiroF, $sp);


                $bloque3 = <<<EOF
<table style="font-size:8px;">
 		<tr>
                 <br/>
                    <th style="border: 1px solid #030505; background-color:white; width:190px; text-align:center;"><strong>CHASIS VEHICULO</strong></th>
                    <th style="border: 1px solid #030505; background-color:white; width:100px; text-align:center;"><strong>TIPO</strong></th>
                    <th style="border: 1px solid #030505; background-color:white; width:100px; text-align:center;"><strong>LINEA</strong></th>            
                    <th style="border: 1px solid #030505; background-color:white; width:100px; text-align:center;"><strong>PREDIO</strong></th>            
                    <th style="border: 1px solid #030505; background-color:white; width:70px; text-align:center;"><strong>CANTIDAD</strong></th>            
</tr>
</table>	
EOF;
                $pdf->writeHTML($bloque3, false, false, false, false, '');
                $cant = 0;
                foreach ($dataChasNew as $key => $value) {
                    $chasis = $value["chasis"];
                    $tipoVehiculo = $value["tipoVehiculo"];
                    $linea = $value["linea"];
                    $predio = $value["predio"];
                    $cantidad = 1;
                    $cant = $cant + 1;

                    $fontLetra = "font-size:7px";
                    $tdChasis = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:190px; ' . $fontLetra . ' text-align:left;">' . $chasis . '</td>';
                    $tdTipo = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:100px; ' . $fontLetra . '">' . $tipoVehiculo . '</td>';
                    $tdLinea = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:100px; ' . $fontLetra . '">' . $linea . '</td>';
                    $tdPredio = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:100px; ' . $fontLetra . '">' . $predio . '</td>';
                    $tdCantidad = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:70px; ' . $fontLetra . ' ">' . $cantidad . '</td>';
                    $bloque4 = <<<EOF
<table style="padding: 2px 5px; text-align:center;">
        <tr>
            $tdChasis
            $tdTipo
            $tdLinea
            $tdPredio
            $tdCantidad
        </tr>
</table>	
EOF;
                    $pdf->writeHTML($bloque4, false, false, false, false, '');
                }
                $bloque3 = <<<EOF
	<table style="font-size:8px; text-align:center;">
 		<tr>
                    <th style="border: 1px solid #030505; background-color:white; width:490px;"><strong>TOTAL VEHICULOS RETIRADOS</strong></th>
                    <th style="border: 1px solid #030505; background-color:white; width:70px;"><strong>$cant</strong></th>
		</tr>
	</table>	
EOF;
                $pdf->writeHTML($bloque3, false, false, false, false, '');
            } else {


//INICIO DETALLE MERCADERIA
//-------------------------------------------------------------------------------------------------------        
                $bloque3 = <<<EOF
	<table style="font-size:8px; text-align:center;">
 		<tr>
                 <br/>
                    <th style="border: 1px solid #030505; background-color:white; width:500px;"><strong>DESCRIPCIÓN Y CONTENIDO</strong></th>
                    <th style="border: 1px solid #030505; background-color:white; width:62px;"><strong>CANTIDAD</strong></th>
		</tr>
	</table>	
EOF;
                $pdf->writeHTML($bloque3, false, false, false, false, '');
//-------------------------------------------------------------------------------------------------------        
                $fontLetra = "font-size:7px";
                $tdDetalle = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; border-bottom: 1px solid #030505; width:500px; ' . $fontLetra . ' text-align:left;">' . $descProducto . '</td>';
                $tdCantidad = '<td style="text-align:center; border-right: 1px solid #030505; border-bottom: 1px solid #030505; width:62px; ' . $fontLetra . '">' . $bultosSalida . '</td>';
                $bloque4 = <<<EOF
	<table style="padding: 2px 5px">
		<tr>
        		$tdDetalle
                        $tdCantidad
		</tr>
	</table>	
EOF;
                $pdf->writeHTML($bloque4, false, false, false, false, '');
//-------------------------------------------------------------------------------------------------------
                $bloque5 = <<<EOF
	<table style="font-size:8px;">
            <tr>
                <th style="border: 1px solid #030505; background-color:white; width:500px; text-align:center"><strong>TOTAL DE BULTOS RETIRADOS</strong></th>
                <th style="border: 1px solid #030505; background-color:white; width:62px; text-align:center"><strong>$bultosSalida</strong></th>
            </tr>
	</table>	
EOF;

                $pdf->writeHTML($bloque5, false, false, false, false, '');
//FIN DETALLE MERCADERIA
//-------------------------------------------------------------------------------------------------------

                if ($tipoDR == 1) {
                    //-------------------------------------------------------------------------------------------------------

                    $bloque3 = <<<EOF
	<table style="font-size:8px; text-align:left;">
      
	<tr>
            <th style="width:562px; text-align:center;"></th>
   </tr>
	</table>	
EOF;

                    $pdf->writeHTML($bloque3, false, false, false, false, '');
//-------------------------------------------------------------------------------------------------------
                    $bloque5 = <<<EOF
	<table style="font-size:9px;">
            <tr><br/>
                <th style="border-bottom: 1px solid #030505; width:562px; text-align:center"><strong>REBAJA DE BULTOS PÓLIZA DR</strong></th>
            </tr>
	</table>	
EOF;

                    $pdf->writeHTML($bloque5, false, false, false, false, '');
                    //-------------------------------------------------------------------------------------------------------

                    $bloque3 = <<<EOF
	<table style="font-size:8px; text-align:left;">
      
	<tr><br/>
            <th style="border: 1px solid #030505; background-color:white; width:60px; text-align:center;"><strong>Nit</strong></th>
            <th style="border: 1px solid #030505; background-color:white; width:230px; text-align:center;"><strong>Empresa</strong></th>
            <th style="border: 1px solid #030505; background-color:white; width:80px; text-align:center;"><strong>Ingreso</strong></th>                
            <th style="border: 1px solid #030505; background-color:white; width:80px; text-align:center;"><strong>Poliza</strong></th>
            <th style="border: 1px solid #030505; background-color:white; width:50px; text-align:center;"><strong>Regimen</strong></th>
            <th style="border: 1px solid #030505; background-color:white; width:62px; text-align:center;"><strong>Bultos</strong></th>
   </tr>
	</table>	
EOF;

                    $pdf->writeHTML($bloque3, false, false, false, false, '');

                    $totalBultos = 0;
                    foreach ($detDR as $key => $value) {
                        $totalBultos = $totalBultos + $value["bultos"];
                        //-------------------------------------------------------------------------------------------------------
                        $tdNit = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:60px; text-align:center;">' . $value["nitEmpresa"] . '</td>';
                        $tdEmpresa = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:230px; text-align:center;">' . $value["nombreEmpresa"] . '</td>';
                        $tdIng = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:80px; text-align:center;">' . $value["numeroIngreso"] . '</td>';
                        $tdPol = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:80px; text-align:center;">' . $value["numeroPoliza"] . '</td>';
                        $tdRegimen = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:50px; text-align:center;">' . $value["regimen"] . '</td>';
                        $tdbultos = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:62px; text-align:center;">' . $value["bultos"] . '</td>';

                        $bloque3 = <<<EOF
	<table style="font-size:8px; text-align:left;">
      
	<tr>
            $tdNit
            $tdEmpresa
            $tdIng  
            $tdPol   
            $tdRegimen
            $tdbultos
   </tr>
	</table>	
EOF;

                        $pdf->writeHTML($bloque3, false, false, false, false, '');
                    }
                    //-------------------------------------------------------------------------------------------------------

                    $bloque3 = <<<EOF
	<table style="font-size:8px; text-align:left;">
      
	<tr>
            <th style="border: 1px solid #030505; background-color:white; width:500px; text-align:center;"><strong>TOTAL REBAJA DE BULTOS PÓLIZA DR</strong></th>
            <th style="border: 1px solid #030505; background-color:white; width:62px; text-align:center;"><strong>$totalBultos</strong></th>
   </tr>
	</table>	
EOF;

                    $pdf->writeHTML($bloque3, false, false, false, false, '');
                    //-------------------------------------------------------------------------------------------------------

                    $bloque3 = <<<EOF
	<table style="font-size:8px; text-align:left;">
      
	<tr>
            <th style="width:562px; text-align:center;"></th>
   </tr>
	</table>	
EOF;

                    $pdf->writeHTML($bloque3, false, false, false, false, '');
//------------------------------------------------------------------------------------------------------- 
                }
//-------------------------------------------------------------------------------------------------------

                $bloque3 = <<<EOF
	<table style="font-size:8px; text-align:left;">
      
	<tr><br/>
          <br/>
            <th style="border: 1px solid #030505; background-color:white; width:191px;"><strong>Piloto</strong></th>
            <th style="border: 1px solid #030505; background-color:white; width:111px;"><strong>Licencia</strong></th>
            <th style="border: 1px solid #030505; background-color:white; width:90px;"><strong>Placa</strong></th>
            <th style="border: 1px solid #030505; background-color:white; width:100px;"><strong>Contenedor</strong></th>
            <th style="border: 1px solid #030505; background-color:white; width:70px;"><strong>Marchamo</strong></th>
        </tr>
	</table>	
EOF;

                $pdf->writeHTML($bloque3, false, false, false, false, '');
//------------------------------------------------------------------------------------------------------- 
                foreach ($datosUnidades as $key => $value) {
                    if ($value["estadoUnidad"] != 0) {


                        $nombrePiloto = $value["nombrePiloto"];
                        $licPiloto = $value["licPiloto"];
                        $placaUnidad = $value["placaUnidad"];
                        $contenedorUnidad = $value["contenedorUnidad"];
                        $numMarchamo = $value["numMarchamo"];

                        if ($numMarchamo == 0) {
                            $numMarchamo = "NO APLICA";
                        }

                        $colPiloto = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; border-bottom: 1px solid #030505; width:191px; ' . $fontLetra . '">' . $nombrePiloto . '</td>';
                        $colLic = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; border-bottom: 1px solid #030505; width:111px; ' . $fontLetra . '">' . $licPiloto . '</td>';
                        $colPlaca = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; border-bottom: 1px solid #030505; width:90px; ' . $fontLetra . '">' . $placaUnidad . '</td>';
                        $colContainer = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; border-bottom: 1px solid #030505; width:100px; ' . $fontLetra . '">' . $contenedorUnidad . '</td>';
                        $marchamo = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; border-bottom: 1px solid #030505; width:70px; ' . $fontLetra . '">' . $numMarchamo . '</td>';
                        $bloque6 = <<<EOF
	<table style="padding: 2px 5px; text-align:left;">
		<tr>
        	    $colPiloto
                    $colLic
                    $colPlaca
                    $colContainer  
                    $marchamo
		</tr>
    	</table>	
EOF;
                        $pdf->writeHTML($bloque6, false, false, false, false, '');
                    }
                }
            }
//-------------------------------------------------------------------------------------------------------
            $bloque7 = <<<EOF
<table style="font-size:7px; border: none; padding: none; margin: none;"> <!-- Lo cambiaremos por CSS -->
    <tbody>
    <tr><br/><br/><br/><br/>
        <td style="width:186px text-align:left; border: none; padding: none; margin: none;">Elaborado por.:_________________________________</td>    
        <td style="width:185px text-align:left; border: none; padding: none; margin: none;">Vo. Bo.:_________________________________</td>    
        <td style="width:185px text-align:left; border: none; padding: none; margin: none;">Recibí Conforme.:_________________________________</td>    
   </tr>
    </tbody>
</table>
EOF;

            $pdf->writeHTML($bloque7, false, false, false, false, '');
//-------------------------------------------------------------------------------------------------------

            $bloque8 = <<<EOF
       <table style="font-size:7px; border: none; padding: none; margin: none;"> <!-- Lo cambiaremos por CSS -->
	<tbody>
		<tr><br/><td style="width:245px text-align:left; border: none; padding: none; margin: none;"></td>
			<td style="width:242px text-align:left;"></td>
			<td rowspan="2" style="width:80px text-align:center;"><img style="width:80px; height:80px; text-align:center;" src=""></td>
		</tr>
		<tr>
			<td colspan="2" style="width:480px; text-align:left;"><br/><strong>Nota:</strong> <br/>Se han entregado los bultos arriba descritos, al portador quien declara haberlos recibido a su entera satisfacción y no se aceptará ninguna reclamación que se formule despues de haber sido retirados de la bodega<br/></td>
 			<td style="width:80px; text-align:left;"><img style="width:80px; height:80px; text-align:center;" src="$concatenarConsultImagen"></td>               
		</tr>
	</tbody>
        </table>
EOF;

            $pdf->writeHTML($bloque8, false, false, false, false, '');
        }
        $pdf->OutPut('Sin título.pdf');
    }

}

$retiro = new imprimirIngresoBodega();
$retiro->retiroF = $_GET["codigo"];
ob_start();
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
$retiro->pdfDatosRetiro();
?>

