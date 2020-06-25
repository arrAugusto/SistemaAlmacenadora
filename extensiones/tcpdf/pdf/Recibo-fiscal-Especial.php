<?php
require_once "../../../controlador/paseDeSalida.controlador.php";
require_once "../../../modelo/paseDeSalida.modelo.php";

class imprimirIngresoBodega{
public $recibo;

public function traerDatosIngreso(){
// TRAER DATOS DE INGRESO
//$reciboF = $this->reciboF;
//$peticionGuatefacturas = ControladorPasesDeSalida::ctrPeticionGuatefacturas($reciboF);

//$respuesta = ControladorPasesDeSalida::ctrVerCobrosDeAlmacenaje($reciboF);

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
                <td style="width:550px; text-align:center; font-size:17px; font-family: 'Source Sans Pro';">Recibo de almacenaje
                    fiscal</td>
            </tr>
	</table>
EOF;

$pdf->writeHTML($bloque1, false, false, false, false, PDF_HEADER_STRING);


$pdf->OutPut('Sin título.pdf');
	}
	}

	


$recibo = new imprimirIngresoBodega();
$recibo -> reciboF = $_GET["codigo"];
ob_start();
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
$recibo -> traerDatosIngreso();

?>


															
															
