<?php

require_once "../../../controlador/paseDeSalida.controlador.php";
require_once "../../../modelo/paseDeSalida.modelo.php";


require_once "../../../controlador/retiroOpe.controlador.php";
require_once "../../../modelo/retiroOpe.modelo.php";

//calculos de almacenaje
require_once "../../../controlador/calculoDeAlmacenaje.controlador.php";
require_once "../../../modelo/calculoDeAlmacenaje.modelo.php";

class imprimirIngresoBodega {

    public $recibo;

    public function traerDatosIngreso() {
// TRAER DATOS DE INGRESO
        $retiroF = $this->retiroF;
        $respRet = ControladorRetiroOpe::ctrDatosRetirosGenerardos($retiroF);

        $respuestaOtros = ControladorPasesDeSalida::ctrOtrosRubros($retiroF);
        if ($respuestaOtros == "SD") {
            $respuestaOtros = ControladorPasesDeSalida::ctrMostrarValExtras($retiroF);
        }
        $tipo = 0;
        
        $respAuxiliares = ControladorPasesDeSalida::ctrAuxiliares($retiroF, $tipo);
        
        $nombre = $respAuxiliares[0]["nombres"];
        $apellidos = $respAuxiliares[0]["apellidos"];

        $valEmpresas = 0;
        $idNitSal = $respRet[0]["idNitRet"];
        $idNitIng = $respRet[0]["idNitIng"];
        $empresaSal = $respRet[0]["empresaFact"];
        $empresaIng = $respRet[0]["nombreIng"];
        $nitEmpresa = $respRet[0]["nitFact"];
        $descProducto = $respRet[0]["descProducto"];
        $bultosSalida = $respRet[0]["bultosSalida"];
        $polRetiro = $respRet[0]["polRetiro"];
        $polIng = $respRet[0]["polIng"];
        $valCif = number_format($respRet[0]["valCif"], 2);
        $valImpuesto = number_format($respRet[0]["valImpuesto"], 2);
        $totalParcial = 0;
        $nombrePiloto = $respRet[0]["nombrePiloto"];
        $licPiloto = $respRet[0]["licPiloto"];
        $placaUnidad = $respRet[0]["placaUnidad"];
        $contenedorUnidad = $respRet[0]["contenedorUnidad"];
        $numMarchamo = $respRet[0]["numMarchamo"];

        $fechaEmision = $respRet[0]["fechaEm"]->format("d-m-Y h:i:s A");
        $numeroRecibo = $respRet[0]["numeroRecibo"];
        $numeroRecibo = $respRet[0]["numeroRecibo"];
        $fechaAsigna = $respRet[0]["fechaAsignado"]->format("d-m-Y h:i:s A");

        $rubroAlm = floatval($respRet[0]["cbAlmacenaje"]);
        $rubroMarchElect = floatval($respRet[0]["rubrosMarchElect"]);
        $numberMarchElect = number_format($rubroMarchElect, 2);


        $rubroZA = floatval($respRet[0]["cbZnaAduana"]);
        $rubroGAd = floatval($respRet[0]["cbGastosAdmin"]);
        $rubroMan = floatval($respRet[0]["cbManejo"]);
        $rubroRevIng = floatval($respRet[0]["cbrubroRevision"]);

        // muestra el formato internacional para la configuración regional en_US

        $numberAlm = number_format($rubroAlm, 2);
        $numberMan = number_format($rubroMan, 2);
        $numberZA = number_format($rubroZA, 2);
        $numberGAd = number_format($rubroGAd, 2);
        $numberRubroRevIng = number_format($rubroRevIng, 2);

        $totalRecibo = floatval(($rubroAlm + $rubroZA + $rubroGAd + $rubroMan + $rubroRevIng));
        $reciboEmitVal = number_format($totalRecibo, 2);
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
                <td style="width:490px; text-align:center; font-size:17px; font-family: 'Source Sans Pro';">Recibo de caja</td>
                <td style="background-color:white; width:70px; text-align:center; color:red; text-align:rigth; font-size:10px;">Recibo No.<br/>$numeroRecibo</td>
            </tr>
                
	</table>
EOF;
        $pdf->writeHTML($bloque1, false, false, false, false, PDF_HEADER_STRING);


//-------------------------------------------------------------------------------------------------------
        $bloque2 = <<<EOF
	<table style="font-size:7.5px; border: none; padding: none; margin: none;">
		<tr><br/><br/>
                    <td style="width:75px"><b>Consignatario :</b></td><td style="width:600px">$empresaSal&nbsp;&nbsp;</td>
                </tr>
                <tr>
                    <td style="width:75px"><b>Nit:</b></td><td style="width:250px">$nitEmpresa</td>
                    <td style="width:90px;"><b>Fecha Emisión:</b></td><td style="width:165px">$fechaAsigna</td>    
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
                <td style="width:75px"><b>Auxiliar Operativo:</b></td><td style="width:250px">$nombre $apellidos&nbsp;&nbsp;</td>
                </tr>    
        </table>	
EOF;
        $pdf->writeHTML($bloque2, false, false, false, false, '');
        $bloque3 = <<<EOF
	<table style="font-size:8px;">
 		<tr>
                 <br/>
                    <th style="border: 1px solid #030505; background-color:white; width:480px; text-align:center;"><strong>DESCRIPCIÓN DEL DOCUMENTO</strong></th>
                    <th style="border: 1px solid #030505; background-color:white; width:82px; text-align:rigth;"><strong>CANTIDAD</strong></th>
		</tr>
	</table>	
EOF;
        $pdf->writeHTML($bloque3, false, false, false, false, '');


        $fontLetra = "font-size:7px";
        if ($rubroAlm > 0) {
            $totalParcial = $totalParcial + $rubroAlm;
            $AlmaDesc = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:480px; ' . $fontLetra . ' text-align:left;">ALMACENAJE</td>';
            $tdAlmTot = '<td style="text-align:rigth; border-right: 1px solid #030505; width:82px;' . $fontLetra . '">Q. ' . $numberAlm . '</td>';

            $bloque4 = <<<EOF
        <table style="padding: 2px 5px">
            <tr>
                $AlmaDesc
                $tdAlmTot

            </tr>
	</table>	
EOF;
            $pdf->writeHTML($bloque4, false, false, false, false, '');
        }
//
        if ($rubroMan > 0) {
            $totalParcial = $totalParcial + $rubroMan;
            $ManDesc = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:480px; ' . $fontLetra . ' text-align:left;">MANEJO</td>';
            $tdManTot = '<td style="text-align:rigth; border-right: 1px solid #030505; width:82px;' . $fontLetra . '">Q. ' . $numberMan . '</td>';
            $bloque4 = <<<EOF
        <table style="padding: 2px 5px">
            <tr>
                $ManDesc
                $tdManTot

            </tr>
	</table>	
EOF;
            $pdf->writeHTML($bloque4, false, false, false, false, '');
        }

        if ($rubroZA > 0) {
            $totalParcial = $totalParcial + $rubroZA;
            $ZADesc = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:480px; ' . $fontLetra . ' text-align:left;">ZONA ADUANERA</td>';
            $tdZATot = '<td style="text-align:rigth; border-right: 1px solid #030505; width:82px;' . $fontLetra . '">Q. ' . $numberZA . '</td>';

            $bloque4 = <<<EOF
        <table style="padding: 2px 5px">
            <tr>
                $ZADesc
                $tdZATot
          
            </tr>
	</table>	
EOF;
            $pdf->writeHTML($bloque4, false, false, false, false, '');
        }

        if ($rubroGAd > 0) {
            $totalParcial = $totalParcial + $rubroGAd;
            $GADesc = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:480px; ' . $fontLetra . ' text-align:left;">GASTOS ADMINISTRACIÓN</td>';
            $tdGATot = '<td style="text-align:rigth; border-right: 1px solid #030505; width:82px;' . $fontLetra . '">Q. ' . $numberGAd . '</td>';

            $bloque4 = <<<EOF
        <table style="padding: 2px 5px">
            <tr>
       
                $GADesc
                $tdGATot
            </tr>
	</table>	
EOF;
            $pdf->writeHTML($bloque4, false, false, false, false, '');
        }



        if ($rubroRevIng > 0) {

            $totalParcial = $totalParcial + $rubroRevIng;
            $ZARev = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:480px; ' . $fontLetra . ' text-align:left;">REVISIÓN</td>';
            $tdRevTot = '<td style="text-align:rigth; border-right: 1px solid #030505; width:82px;' . $fontLetra . '">Q. ' . $numberRubroRevIng . '</td>';

            $bloque4 = <<<EOF
        <table style="padding: 2px 5px">
            <tr>
                $ZARev
                $tdRevTot
          
            </tr>
	</table>	
EOF;
            $pdf->writeHTML($bloque4, false, false, false, false, '');
        }

        if ($numberMarchElect > 0) {
            $totalParcial = $totalParcial + $numberMarchElect;
            $AlmaDesc = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:480px; ' . $fontLetra . ' text-align:left;">MARCHAMO ELECTRÓNICO</td>';
            $tdAlmTot = '<td style="text-align:rigth; border-right: 1px solid #030505; width:82px;' . $fontLetra . '">Q. ' . $numberMarchElect . '</td>';

            $bloque4 = <<<EOF
        <table style="padding: 2px 5px">
            <tr>
                $AlmaDesc
                $tdAlmTot

            </tr>
	</table>	
EOF;
            $pdf->writeHTML($bloque4, false, false, false, false, '');
        }

        if (count($respuestaOtros["servPrestados"]) >= 1) {

            foreach ($respuestaOtros["servPrestados"] as $key => $value) {
                if ($value["tipo"] == 0) {
                    $rubro = $value["otrosServicios"];
                    $valRubro = floatval($value["montoServicio"]);
                    $numberRubro = number_format($valRubro, 2);
                    $totalParcial = $totalParcial + $valRubro;
                }
                if ($value["tipo"] == 1) {
                    $rubro = $value["servicioDefault"];
                    $valRubro = floatval($value["montoServicio"]);
                    $numberRubro = number_format($valRubro, 2);
                    $totalParcial = $totalParcial + $valRubro;
                }

                $otroSer = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:480px; ' . $fontLetra . ' text-align:left;">' . $rubro . '</td>';
                $tdValueOtro = '<td style="text-align:rigth; border-right: 1px solid #030505; width:82px;' . $fontLetra . '">Q. ' . $numberRubro . '</td>';

                $bloque4 = <<<EOF
            <table style="padding: 2px 5px">
                <tr>
                    $otroSer
                    $tdValueOtro
                </tr>
            </table>	
EOF;
                $pdf->writeHTML($bloque4, false, false, false, false, '');
            }





            if ($respuestaOtros["descuentoCalc"] != "SD") {
                $percent = $respuestaOtros["descuentoCalc"][0]["descuentoPercent"];
                $descuento = $respuestaOtros["descuentoCalc"][0]["descuento"];

                $total = ($totalParcial - $descuento);
                $descuentoFormat = number_format($descuento, 2);
                $totalParcial = number_format($totalParcial, 2);
                $total = number_format($total, 2);
                $bloque3 = <<<EOF
	<table style="font-size:8px; padding: 4px;">
 		<tr>
                    <th style="border-top: 1px solid black; width:380px; text-align:center;"></th>
                    <th style="border-top: 1px solid black; width:100px; text-align:center; height: 20px;">VALOR PARCIAL</th>
                    <th style="border-top: 1px solid black; width:82px; border-bottom: 1px solid #8C9599; text-align:rigth; height: 20px;">Q. $totalParcial</th>
		</tr>
	</table>	
EOF;
                $pdf->writeHTML($bloque3, false, false, false, false, '');
                $bloque3 = <<<EOF
	<table style="font-size:8px; padding: 4px;">
 		<tr>
                    <th style="width:380px; text-align:center; "></th>
                        <th style=" width:100px; text-align:center; height: 20px; color: red;">DESCUENTOS $percent%</th>
                    <th style="border-top: 1px solid black; width:82px; border-bottom: 1px solid #8C9599; text-align:rigth; height: 20px; color: red;">(Q. $descuentoFormat)</th>
		</tr>
 		<tr>
                    <th style="width:380px; text-align:center;"></th>
                        <th style=" width:100px; text-align:center; height: 20px;">VALOR TOTAL</th>
                    <th style="border-top: 1px solid black; width:82px; border-bottom: 1px solid #8C9599; text-align:rigth; height: 20px;">Q. $total</th>
		</tr>

   </table>	
EOF;
                $pdf->writeHTML($bloque3, false, false, false, false, '');
            } else {
                $totalParcialFormat = number_format($totalParcial, 2);
                $bloque3 = <<<EOF
	<table style="font-size:8px; padding: 4px;">
 		<tr>
                    <th style="border-top: 1px solid black; width:380px; text-align:center;"></th>
                        <th style="border-top: 1px solid black; width:100px; text-align:center; height: 20px;">VALOR TOTAL</th>
                    <th style="border-top: 1px solid black; width:82px; border-bottom: 1px solid #8C9599; text-align:rigth; height: 20px;">Q. $totalParcialFormat</th>
		</tr>
	</table>	
EOF;
                $pdf->writeHTML($bloque3, false, false, false, false, '');
            }
        } else {
            $bloque3 = <<<EOF
	<table style="font-size:8px;">
 		<tr>
                    <th style="border: 1px solid #030505; background-color:white; width:480px; text-align:center;"><strong>VALOR TOTAL</strong></th>
                    <th style="border: 1px solid #030505; background-color:white; width:82px; text-align:rigth;"><strong>Q. $reciboEmitVal</strong></th>
		</tr>
	</table>	
EOF;
            $pdf->writeHTML($bloque3, false, false, false, false, '');
        }



        $pdf->OutPut('Sin título.pdf');
    }

}

$recibo = new imprimirIngresoBodega();
$recibo->retiroF = $_GET["codigo"];
ob_start();
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
$recibo->traerDatosIngreso();
?>




