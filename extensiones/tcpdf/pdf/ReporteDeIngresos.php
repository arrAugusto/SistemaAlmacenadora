<?php

require_once "../../../controlador/ingPendientesC.controlador.php";
require_once "../../../modelo/ingPendientesC.modelo.php";

class imprimirIngresoBodega {

    public $reportIngConta;

    public function traerDatosIngreso() {
// TRAER DATOS DE INGRESO
        $tipoReporte = $this->tipoReporte;
        $idBodega = $this->idBodega;

        if ($tipoReporte == "Ingreso") {
            $repContabilidad = ControladorGeneracionDeContabilidad::ctrIngRegistroContaReportes($tipoReporte, $idBodega);
        } else {

            $date = $tipoReporte;
            if (!empty($date)) {
                $timestamp = strtotime($date);
                if ($timestamp === FALSE) {
                    $timestamp = strtotime(str_replace('/', '-', $date));
                }
                $date = date('Y-m-d', $timestamp);
            }
            $repContabilidad = ControladorGeneracionDeContabilidad::ctrReporteIngContabilizado($date, $idBodega);
        }
        $nombreAuxiliar = $repContabilidad[0]["nombres"];
        $apellidoAuxiliar = $repContabilidad[0]["apellidos"];

        $respJefe = ControladorGeneracionDeContabilidad::ctrJefeUnidad($idBodega);

        $nombreJefe = $respJefe[0]["nombres"];
        $apellidoJefe = $respJefe[0]["apellidos"];

        $FConta = $repContabilidad[0]["fechaContabilidad"];
        $formatFechConta = date("d/m/Y", strtotime($FConta));
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
                
                <td style="width:560px; text-align:center; font-size:9px; font-family: 'Source Sans Pro';">ALMACENADORA INTEGRADA, S.A.<br/>INGRESO DE PÓLIZAS A ALMACÉN FISCAL<br/>CIFRAS EXPRESADAS EN QUETZALES, $formatFechConta</td>
   </tr>
                
	</table>

EOF;
        $pdf->writeHTML($bloque1, false, false, false, false, PDF_HEADER_STRING);
//---------------------------------------------------------------------------------------------------
        $bloque3 = <<<EOF
    <table style="font-size:7px;">
        <tr><br/>
            <th style="border: 1px solid #030505; background-color:white; color:black; background-color: #4ECBE9; width:47px; text-align:center;"><strong>Ingreso</strong></th>
            <th style="border: 1px solid #030505; background-color:white;  color:black; background-color: #4ECBE9; width:47px; text-align:center;"><strong>Póliza</strong></th>
            <th style="border: 1px solid #030505; background-color:white;  color:black; background-color: #4ECBE9;  width:40px; text-align:center;"><strong>Fecha</strong></th>
            <th style="border: 1px solid #030505; background-color:white; width:23px;   color:black; background-color: #4ECBE9; text-align:center;"><strong>Reg.</strong></th>
            <th style="border: 1px solid #030505; background-color:white; width:200px;  color:black; background-color: #4ECBE9;  text-align:center;"><strong>Nombre de Empresa</strong></th>
            <th style="border: 1px solid #030505; background-color:white; width:28px;  color:black; background-color: #4ECBE9;  text-align:center;"><strong>Bultos</strong></th>            
            <th style="border: 1px solid #030505; background-color:white; width:60px;  color:black; background-color: #4ECBE9;  text-align:center;"><strong>Cif</strong></th>            
            <th style="border: 1px solid #030505; background-color:white; width:60px;  color:black; background-color: #4ECBE9;  text-align:center;"><strong>Impuestos</strong></th>            
            <th style="border: 1px solid #030505; background-color:white; width:60px;  color:black; background-color: #4ECBE9;  text-align:center;"><strong>Total</strong></th>            
        </tr>
    </table>	
EOF;
        $pdf->writeHTML($bloque3, false, false, false, false, '');
//---------------------------------------------------------------------------------------------------
        $totalBultos = 0;
        $totalCif = 0;
        $totalImpuesto = 0;
        $totalVal = 0;
        foreach ($repContabilidad as $key => $value) {
            $numIng = $value["numeroDeIngreso"];
            $poliza = $value["numeroPoliza"];
            $FConta = $value["fechaContabilidad"];
            $formatFechConta = date("d/m/Y", strtotime($FConta));
            $regimen = $value["regimen"];
            $empresa = $value["nombreEmpresa"];

            $bultos = $value["bultos"];
            $bultosFormat = number_format($bultos);

            $cif = $value["totalValorCif"];
            $cifFormat = number_format($cif, 2);

            $impts = $value["valorImpuesto"];

            $imptsFormat = number_format($impts, 2);

            $total = ($cif + $impts);
            $totalFormat = number_format($total, 2);

            $totalBultos = $totalBultos + $bultos;

            $totalCif = $totalCif + $cif;
            $totalCifFormat = number_format($totalCif, 2);
            $totalImpuesto = $totalImpuesto + $impts;
            $totalImptoFormat = number_format($totalImpuesto, 2);
            $totalVal = $totalVal + $total;
            $totalValFormat = number_format($totalVal, 2);
            $bloque3 = <<<EOF
    <table style="font-size:6px;">
        <tr>
            <th style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:47px; text-align:center;">$numIng</th>
            <th style="border-right: 1px solid #030505; width:47px; text-align:center;">$poliza</th>
            <th style="border-right: 1px solid #030505; width:40px; text-align:center;">$formatFechConta</th>
            <th style="border-right: 1px solid #030505; width:23px; text-align:center;">$regimen     </th>
            <th style="border-right: 1px solid #030505; width:200px; text-align:left;">$empresa</th>
            <th style="border-right: 1px solid #030505; width:28px; text-align:right;">$bultosFormat</th>            
            <th style="border-right: 1px solid #030505; width:60px; text-align:right;">$cifFormat</th>            
            <th style="border-right: 1px solid #030505; width:60px; text-align:right;">$imptsFormat</th>            
            <th style="border-right: 1px solid #030505; width:60px; text-align:right;">$totalFormat</th>            
        </tr>
    </table>
EOF;
            $pdf->writeHTML($bloque3, false, false, false, false, '');
        }
//---------------------------------------------------------------------------------------------------

        $bloque3 = <<<EOF
    <table style="font-size:7px;">
        <tr>
            <th style="border: 1px solid #030505; width:357px; text-align:center;"><strong>TOTALES</strong></th>
            <th style="border: 1px solid #030505; width:28px; text-align:right;"><strong>$totalBultos</strong></th>            
            <th style="border: 1px solid #030505; width:60px; #4ECBE9;  text-align:right;"><strong>$totalCifFormat</strong></th>            
            <th style="border: 1px solid #030505; width:60px; text-align:right;"><strong>$totalImptoFormat</strong></th>            
            <th style="border: 1px solid #030505; width:60px; text-align:right;"><strong>$totalValFormat</strong></th>            
        </tr>
    </table>	
EOF;
        $pdf->writeHTML($bloque3, false, false, false, false, '');

//---------------------------------------------------------------------------------------------------
        $bloque7 = <<<EOF
            <table style="font-size:7px; border: none; padding: none; margin: none;"> <!-- Lo cambiaremos por CSS -->
                <tbody>
		<tr><br/><br/><br/><br/><br/><br/>
                    <td nstyle="width:278px text-align:left; border: none; padding: none; margin: none;">Elaborado por.:__________________________________________<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$nombreAuxiliar $apellidoAuxiliar</td>
                    <td style="width:279px text-align:left; border: none; padding: none; margin: none;">Vo. Bo.:__________________________________________<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$nombreJefe $apellidoJefe</td>    
                </tr>
		</tbody>
        </table>
EOF;
        $pdf->writeHTML($bloque7, false, false, false, false, '');
        $pdf->OutPut('Sin título.pdf');
    }

}

$reportIngConta = new imprimirIngresoBodega();
$reportIngConta->tipoReporte = $_GET["tipoReporte"];
$reportIngConta->idBodega = $_GET["idBodega"];
ob_start();
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
$reportIngConta->traerDatosIngreso();
?>
