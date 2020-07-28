<?php

//POLIZAS CONTABLES
require_once "../../../controlador/polizasDiarias.controlador.php";
require_once "../../../modelo/polizasDiarias.modelo.php";

class imprimirIngresoBodega {

    public $fechaPoliza;

    public function traerDatosIngreso() {
// TRAER DATOS DE INGRESO
        $fechaPoliza = $this->fechaPoliza;
        $date = $fechaPoliza;
        if (!empty($date)) {
            $timestamp = strtotime($date);
            if ($timestamp === FALSE) {
                $timestamp = strtotime(str_replace('/', '-', $date));
            }
            $date = date('Y-m-d', $timestamp);
        }

        $entidad = $this->entidad;
        $respMstPolConta = ControladorGenerarContabilidad::ctrMostrarPolConta($date, $entidad);
        require_once('tcpdf_include.php');

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

//$pdf->startPageGroup();

        $pdf->AddPage();

//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        $pdf->SetMargins(6, 0, 6);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

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
        <table style="padding:3px; border: none; padding: none; margin: none;border: 1px solid #030505;">
            <tr>
                <td style="width:562px; text-align:center; font-size:10px; font-family: 'Source Sans Pro';">ALMACENADORA INTEGRADA, S.A.<br/>PÓLIZAS DE MERCADERÍA SEGÚN REPORTES ADJUNTOS DEL DÍA<br/>FECHA DE EMISIÓN $fechaPoliza</td>
            </tr>
                <br/><br/>
	</table>
EOF;
        $pdf->writeHTML($bloque1, false, false, false, false, PDF_HEADER_STRING);

//---------------------------------------------------------------------------------------------------
        $bloque1 = <<<EOF
        <br/><br/><table style="padding:3px; border: none; padding: none; margin: none;border: none;">
            <tr>
                <th style="width:100px; text-align:center; font-size:8px; font-family: 'Source Sans Pro'; border-left: 1px solid #030505; border-top: 1px solid #030505;"></th>
                <th style="width:262px; text-align:center; font-size:8px; font-family: 'Source Sans Pro'; border-top: 1px solid #030505;"></th>
                <th style="width:100px; text-align:center; font-size:8px; font-family: 'Source Sans Pro'; border-top: 1px solid #030505;"></th>
                <th style="width:100px; text-align:center; font-size:8px; font-family: 'Source Sans Pro'; border-top: 1px solid #030505; border-right: 1px solid #030505;"></th>
            </tr>

   </table>

EOF;
        $pdf->writeHTML($bloque1, false, false, false, false, PDF_HEADER_STRING);
//---------------------------------------------------------------------------------------------------

        foreach ($respMstPolConta as $key => $value) {
            $numPoliza = $value["numPoliza"];

            if ($key == 0) {
                $bloque1 = <<<EOF
        
        <table style="padding:3px; border: none; padding: none; margin: none;border: none;">

            <tr>
                <th style="width:100px; text-align:center; font-size:9px; font-family: 'Source Sans Pro'; border-left: 1px solid #030505;">CUENTA</th>
                <th style="width:262px; text-align:center; font-size:9px; font-family: 'Source Sans Pro';">NOMBRE DE CUENTA</th>
                <th style="width:100px; text-align:center; font-size:9px; font-family: 'Source Sans Pro';">POLIZA NO.</th>
                <th style="width:100px; text-align:center; font-size:9px; font-family: 'Source Sans Pro'; border-right: 1px solid #030505;">$numPoliza</th>
            </tr>     
            <tr>
                   <th style="width:100px; text-align:center; font-size:8px; font-family: 'Source Sans Pro'; border-left: 1px solid #030505; "></th>
                <th style="width:262px; text-align:center; font-size:8px; font-family: 'Source Sans Pro';"></th>
                <th style="width:100px; text-align:center; font-size:8px; font-family: 'Source Sans Pro';"></th>
                <th style="width:100px; text-align:center; font-size:8px; font-family: 'Source Sans Pro';border-right: 1px solid #030505;"></th>
            </tr> 
        </table>
EOF;
                $pdf->writeHTML($bloque1, false, false, false, false, PDF_HEADER_STRING);
            }


            $numPoliza = $value["numPoliza"];
            $monto = floatval($value["monto"]);
            $monto = number_format($monto, 2);
            $explicacion = $value["explicacion"];
            $nombreDeCuenta = $value["nombreDeCuenta"];
            $codigo = $value["cuenta"];
            if ($value["concepto"] == "DEBE") {
                $orientacion = "left";
                $bloque1 = <<<EOF
        
        <table style="padding:3px; border: none; padding: none; margin: none;border: none;">
            <tr>
                <td style="width:100px; text-align:$orientacion; font-size:8px; font-family: 'Source Sans Pro'; border-left: 1px solid #030505;">&nbsp;&nbsp;&nbsp;$codigo</td>
                <td style="width:282px; text-align:left; font-size:8px; font-family: 'Source Sans Pro';">$nombreDeCuenta</td>
                <td style="width:90px; text-align:right; font-size:8px; font-family: 'Source Sans Pro';">$monto</td>
                <td style="width:90px; text-align:right; font-size:8px; font-family: 'Source Sans Pro'; border-right: 1px solid #030505;"></td>
            </tr>
   </table>

EOF;
                $pdf->writeHTML($bloque1, false, false, false, false, PDF_HEADER_STRING);
            } else {
                $orientacion = "center";
                $bloque1 = <<<EOF
        <table style="padding:3px; border: none; padding: none; margin: none;border: none;">
            <tr>
                <td style="width:100px; text-align:$orientacion; font-size:8px; font-family: 'Source Sans Pro'; border-left: 1px solid #030505;">&nbsp;&nbsp;&nbsp;$codigo</td>
                <td style="width:282px; text-align:left; font-size:8px; font-family: 'Source Sans Pro';">$nombreDeCuenta</td>
                <td style="width:90px; text-align:right; font-size:8px; font-family: 'Source Sans Pro';"></td>
                <td style="width:90px; text-align:right; font-size:8px; font-family: 'Source Sans Pro'; border-right: 1px solid #030505;">$monto&nbsp;&nbsp;&nbsp;</td>
            </tr>
   </table>

EOF;
                $pdf->writeHTML($bloque1, false, false, false, false, PDF_HEADER_STRING);
            }

            $polizaNum = $value["numPoliza"];
            $numeroRealPol = $value["numero"];


            $salto = $respMstPolConta[$key + 1]["numPoliza"];

            if ($polizaNum != $salto && $salto >= 1) {
                $sumaPoliza = ControladorGenerarContabilidad::ctrTotalPolizaContable($numeroRealPol);
                $totalPoliza = floatval($sumaPoliza[0]["sumaMonto"]);
                $totalPoliza = number_format($totalPoliza, 2);
                $bloque1 = <<<EOF
        <table style="padding:3px; border: none; padding: none; margin: none;border: none;">
            <tr>
                <td style="width:100px; text-align:left; font-size:8px; font-family: 'Source Sans Pro'; border-bottom: 1px solid #030505; border-left: 1px solid #030505;"></td>
                <td style="width:282px; text-align:left; font-size:8px; font-family: 'Source Sans Pro'; border-bottom: 1px solid #030505;">$explicacion</td>
                <td style="width:90px; text-align:right; font-size:8px; font-family: 'Source Sans Pro'; border-bottom: 1px solid #030505;"><strong>$totalPoliza</strong></td>
                <td style="width:90px; text-align:right; font-size:9px; font-family: 'Source Sans Pro'; border-bottom: 1px solid #030505; border-right: 1px solid #030505;"><strong>$totalPoliza</strong>&nbsp;&nbsp;&nbsp;</td>
            </tr>
            <tr>
                <td style="width:100px; text-align:left; font-size:8px; font-family: 'Source Sans Pro'; border-left: 1px solid #030505;"></td>
                <td style="width:282px; text-align:left; font-size:8px; font-family: 'Source Sans Pro';"></td>
                <td style="width:90px; text-align:right; font-size:8px; font-family: 'Source Sans Pro';"></td>
                <td style="width:90px; text-align:right; font-size:8px; font-family: 'Source Sans Pro'; border-right: 1px solid #030505;"></td>
            </tr>    
            <tr>
                <th style="width:100px; text-align:center; font-size:8px; font-family: 'Source Sans Pro'; border-left: 1px solid #030505; ">CUENTA</th>
                <th style="width:262px; text-align:center; font-size:8px; font-family: 'Source Sans Pro'; ">NOMBRE DE CUENTA</th>
                <th style="width:100px; text-align:center; font-size:8px; font-family: 'Source Sans Pro'; ">POLIZA NO.</th>
                <th style="width:100px; text-align:center; font-size:8px; font-family: 'Source Sans Pro';border-right: 1px solid #030505; ">$salto</th>
            </tr>     
            <tr>
                <th style="width:100px; text-align:center; font-size:8px; font-family: 'Source Sans Pro'; border-left: 1px solid #030505; "></th>
                <th style="width:262px; text-align:center; font-size:8px; font-family: 'Source Sans Pro';"></th>
                <th style="width:100px; text-align:center; font-size:8px; font-family: 'Source Sans Pro';"></th>
                <th style="width:100px; text-align:center; font-size:8px; font-family: 'Source Sans Pro';border-right: 1px solid #030505;"></th>
            </tr>     

   </table>

EOF;
                $pdf->writeHTML($bloque1, false, false, false, false, PDF_HEADER_STRING);
            } else if (empty($salto)) {
                                $sumaPoliza = ControladorGenerarContabilidad::ctrTotalPolizaContable($numeroRealPol);
                $totalPoliza = floatval($sumaPoliza[0]["sumaMonto"]);
                $totalPoliza = number_format($totalPoliza, 2);

                $bloque1 = <<<EOF
        <table style="padding:3px; border: none; padding: none; margin: none;border: none;">
            <tr>
                <td style="width:100px; text-align:left; font-size:8px; font-family: 'Source Sans Pro'; border-bottom: 1px solid #030505; border-left: 1px solid #030505;"></td>
                <td style="width:282px; text-align:left; font-size:8px; font-family: 'Source Sans Pro'; border-bottom: 1px solid #030505;">$explicacion</td>
                <td style="width:90px; text-align:right; font-size:8px; font-family: 'Source Sans Pro'; border-bottom: 1px solid #030505;"><strong>$totalPoliza</strong></td>
                <td style="width:90px; text-align:right; font-size:9px; font-family: 'Source Sans Pro'; border-bottom: 1px solid #030505; border-right: 1px solid #030505;"><strong>$totalPoliza</strong>&nbsp;&nbsp;&nbsp;</td>
            </tr>
 
   </table>

EOF;
                $pdf->writeHTML($bloque1, false, false, false, false, PDF_HEADER_STRING);
            }
        }

//-------------------------------------------------------------------------------------------------------
        $bloque7 = <<<EOF

        <table style="font-size:7px; border: none; padding: none; margin: none;"> <!-- Lo cambiaremos por CSS -->
            <tbody>
                <tr><br/><br/><br/><br/><br/><br/>
                    <td style="width:278px text-align:left; border: none; padding: none; margin: none;">Elaborado por.:_________________________________</td>    
                    <td style="width:278px text-align:left; border: none; padding: none; margin: none;">Vo. Bo.:_________________________________</td>    
                </tr>
            </tbody>
        </table>
EOF;
        $pdf->writeHTML($bloque7, false, false, false, false, '');



        $pdf->OutPut('Sin título.pdf');
    }

}

$fechaPoliza = new imprimirIngresoBodega();
$fechaPoliza->fechaPoliza = $_GET["fechaPoliza"];
$fechaPoliza->entidad = $_GET["entidad"];
ob_start();
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
$fechaPoliza->traerDatosIngreso();
?>




