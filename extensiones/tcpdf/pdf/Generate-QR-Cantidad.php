<?php

require_once "../../../controlador/registroIngresoBodega.controlador.php";
require_once "../../../modelo/registroIngresoBodega.modelo.php";

require_once "../../../controlador/historiaIngresosFisacales.controlador.php";
require_once "../../../modelo/historiaIngresosFisacales.modelo.php";

require_once "../../../extensiones/qrCodeCreate/vendor/autoload.php";

use Endroid\QrCode\QrCode;

class imprimirIngresoBodega {

    public $codigo;

    public function traerDatosIngreso() {
        // TRAER DATOS DE INGRESO
        $codigo = $this->codigo;
        $cantidadQR = $this->cantidadQR;
        $repuestaOperaciones = ControladorRegistroBodega::ctrDatosDetalleQR($codigo);
        $idHash = md5($repuestaOperaciones[0]["idDet"]);
        $arrayDataImagen = $idHash;

        
        $direccion = "../../../extensiones/imgQRCodeDet/";
                $nombreArchivoParaGuardar = ($direccion."QR" . $idHash . ".png");
        if (!file_exists($nombreArchivoParaGuardar)) {
            
       
        if (!file_exists($direccion)) {
            mkdir($direccion);
        }


        $codigoQR = new QrCode($arrayDataImagen, 'H', 5, 1);

        // Escribir archivo,

        $codigoQR->writeFile($nombreArchivoParaGuardar);
         }
        $poliza = $repuestaOperaciones[0]["numeroPoliza"];
        $empresaIng = $repuestaOperaciones[0]["nombreEmpresa"];
        $empresaDet = $repuestaOperaciones[0]["empresa"];
        $bultos = $repuestaOperaciones[0]["bultos"];
        $peso = $repuestaOperaciones[0]["peso"];
        $fechaEmision = $repuestaOperaciones[0]["fechaEmision"];
        require_once('tcpdf_include.php');
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->AddPage('L', 'A4');
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetMargins(2, 0, 2);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        //---------------------------------------------------------------------------------------------------
        $bloque3 = <<<EOF
    <table>
	<tbody>
		<tr>
                    <td rowspan="3" style="width: 180px; height: 180px;"><img style="width:180px; height:180px;" src="$nombreArchivoParaGuardar"></td>
    		<td style="text-align: center; font-size: 70px; width: 560px;">&nbsp;$poliza</td>
		</tr>
		<tr>
                    <td style="text-align:center; font-size: 25px; width: 462px; text-align: left;">&nbsp;$empresaDet</td>
		</tr>
		<tr>
                    <td style="text-align:left; font-size: 25px; width: 462px;">&nbsp;Peso:&nbsp;&nbsp;$peso Kg, &nbsp;$fechaEmision</td>
		</tr>
		<tr>
                    <td style="text-align:left; font-size: 25px; width: 742px;">Código: $idHash</td>
		</tr>

   <tr>
                    <td style="text-align:center; font-size: 35px; width: 742px; border-bottom: 1px;">$empresaIng</td>
		</tr>

   </tbody>
</table>
    
EOF;
$pdf->writeHTML($bloque3, false, false, false, false, '');
        $bloque3 = <<<EOF
    <table>
	<tbody>
		<tr>
                    <td rowspan="3" style="width: 180px; height: 180px;"><img style="width:180px; height:180px;" src="$nombreArchivoParaGuardar"></td>
    		<td style="text-align: center; font-size: 70px; width: 560px;">&nbsp;$poliza</td>
		</tr>
		<tr>
                    <td style="text-align:center; font-size: 25px; width: 462px; text-align: left;">&nbsp;$empresaDet</td>
		</tr>
		<tr>
                    <td style="text-align:left; font-size: 25px; width: 462px;">&nbsp;Peso:&nbsp;&nbsp;$peso Kg, &nbsp;$fechaEmision</td>
		</tr>
		<tr>
                    <td style="text-align:left; font-size: 25px; width: 742px;">Código: $idHash</td>
		</tr>

   <tr>
                    <td style="text-align:center; font-size: 35px; width: 742px; border-bottom: 1px;">$empresaIng</td>
		</tr>

   </tbody>
</table>
    
EOF;
$pdf->writeHTML($bloque3, false, false, false, false, '');
        $pdf->OutPut('Sin título.pdf');
    }

}

$ingreso = new imprimirIngresoBodega();
$ingreso->codigo = $_GET["codigo"];
$ingreso->cantidadQR = $_GET["cantidadQR"];

ob_start();
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
$ingreso->traerDatosIngreso();
?>
