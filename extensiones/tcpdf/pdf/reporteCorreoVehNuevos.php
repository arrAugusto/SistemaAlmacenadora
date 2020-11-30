<?php

require_once "../../../controlador/registroIngresoBodega.controlador.php";
require_once "../../../modelo/registroIngresoBodega.modelo.php";

require_once "../../../controlador/historiaIngresosFisacales.controlador.php";
require_once "../../../modelo/historiaIngresosFisacales.modelo.php";

class imprimirCorreoVeh {

    public $idGrupo;

    public function traerCorreoVeh() {
// TRAER DATOS DE INGRESO
        $idGrupo = $this->idGrupo;

        $respuesta = ControladorRegistroBodega::ctrMostrarListadoChasis($idGrupo);
        
        require_once('tcpdf_include.php');
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->AddPage();
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
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
        <table style="padding:3px; border: none; padding: none; margin: none;">
            <tr>
                <td style="width:420px; text-align:center; font-size:17px; font-family: 'Source Sans Pro';">Retiro de vehículos : $titulo</td>
            </tr>
        </table><br/><br/>
EOF;
        $pdf->writeHTML($bloque1, false, false, false, false, PDF_HEADER_STRING);
//-------------------------------------------------------------------------------------------------------
        $bloque2 = <<<EOF
	<table style="font-size:7.5px; border: none; padding: none; margin: none;">
                <tr>
                    <td style="width:75px;"><b>Empresa :</b></td><td style="width:250px;">$nombreEmpresa&nbsp;&nbsp;</td>
                </tr>
   </table>	
EOF;
        $pdf->writeHTML($bloque2, false, false, false, false, '');


//-------------------------------------------------------------------------------------------------------
        $bloque3 = <<<EOF
	<table style="font-size:8px;">
 		<tr>
                 <br/>
                    <th style="border: 1px solid #030505; background-color:white; width:180px; text-align:center;"><strong>NOMBRE EMPRESA</strong></th>
                    <th style="border: 1px solid #030505; background-color:white; width:140px; text-align:center;"><strong>CHASIS VEHICULO</strong></th>
                    <th style="border: 1px solid #030505; background-color:white; width:80px; text-align:center;"><strong>TIPO</strong></th>
                    <th style="border: 1px solid #030505; background-color:white; width:80px; text-align:center;"><strong>LINEA</strong></th>            
                    <th style="border: 1px solid #030505; background-color:white; width:90px; text-align:center;"><strong>CODIGO QR</strong></th>            
 
   </tr>
	</table>	
EOF;
        $pdf->writeHTML($bloque3, false, false, false, false, '');
//-------------------------------------------------------------------------------------------------------

        foreach ($respuesta as $key => $value) {
            $chasis = $value["chasis"];
            $linea = $value["linea"];
            $tipo = $value["tipoVehiculo"];
            $rutaQRChasis = $value["id"];   
            $nombreEmpresa = $value["nombreEmpresa"];
            $imgQRChasis = "../../imagenesQRChasSalida/qrCodeRet" . $rutaQRChasis. ".png";
                $cantidad = 1;
                $fontLetra = "font-size:7px";
                $empresa = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:180px; border-bottom: 0.8px solid #030505; ' . $fontLetra . ' text-align:left;">' . $nombreEmpresa. '</td>';
                $tdChasis = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:140px; border-bottom: 0.8px solid #030505; ' . $fontLetra . ' text-align:left;">' . $chasis . '</td>';
                $tdTipo = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:80px; border-bottom: 0.8px solid #030505;  ' . $fontLetra . '">' . $tipo . '</td>';
                $tdLinea = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:80px; border-bottom: 0.8px solid #030505;  ' . $fontLetra . '">' . $linea . '</td>';
                $tdPredio = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:90px; border-bottom: 0.8px solid #030505;  ' . $fontLetra . '"><img style="width:35px; height:35px; text-align:center;" src="'.$imgQRChasis.'"></td>';
                $bloque4 = <<<EOF
<table style="padding: 2px 5px; text-align:center;">
        <tr>
            $empresa
            $tdChasis
            $tdTipo
            $tdLinea
            $tdPredio
            $tdCantidad
        </tr>
</table>	
EOF;
                $cantidad = count($repuestaBodega);
                $pdf->writeHTML($bloque4, false, false, false, false, '');
            
        }
        $pdf->OutPut('Sin título.pdf');
    }

}

$Grupo = new imprimirCorreoVeh();
$Grupo->idGrupo = $_GET["idGrupo"];
ob_start();
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
$Grupo->traerCorreoVeh();
?>




