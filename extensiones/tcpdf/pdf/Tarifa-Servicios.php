<?php
require_once "../../../controlador/activarOtrosServicios.controlador.php";
require_once "../../../modelo/activarOtrosServicios.modelo.php";
//casteoDeData
require_once "../../../controlador/revisionDeData.controlador.php";

class imprimirIngresoBodega{
public $numTar;

public function traerDatosIngreso(){
// TRAER DATOS DE INGRESO
$numTarSer = $this->tarifaCodigo;
$respSerTar = ControladorActivarTarifa::ctrMostrarDataTarifa($numTarSer * 1);




//buscasr toda la data de una





//DATA DE CLIENTE Y EJECUTIVO
$respInfo = ControladorActivarTarifa::ctrMostrarCliente($numTarSer * 1);

$nitEmpresa =  $respInfo["success"][0]["nitEmpresa"];
$telefono = $respInfo["success"][0]["tel"];
$razonSocial = $respInfo["success"][0]["razonSocial"];
$correo = $respInfo["success"][0]["correo"];
$nombreComercial = $respInfo["success"][0]["nombreComercial"];
$nombreContacto = $respInfo["success"][0]["nombreContacto"];
$direccionFiscal = $respInfo["success"][0]["direccionFiscal"];
$ejecutivo  = $respInfo["success"][0]["ejecutivo"];
$direccionRec = $respInfo["success"][0]["direccionRec"];
$telEje  = $respInfo["success"][0]["celEje"];

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
        <table style="padding:3px; border: none; padding: none; margin: none;">
            <tr>
                <td style="width:550px; text-align:center; font-size:17px; color:red; font-family: 'Source Sans Pro';">TARIFARIO</td>
            </tr>
	</table>
EOF;

$pdf->writeHTML($bloque1, false, false, false, false, PDF_HEADER_STRING);

//-------------------------------------------------------------------------------------------------------
$bloque2 = <<<EOF
	<table style="font-size:7.5px; border: none; padding: none; margin: none;">
		<tr><br/><br/>
                    <td style="width:75px"><b>Nit. :</b></td><td style="width:250px">$nitEmpresa&nbsp;&nbsp;</td>
                    <td style="width:90px"><b>Tel. Empresa.:</b></td><td style="width:260px">$telefono</td>
                </tr>
                <tr>
                    <td style="width:75px"><b>Empresa.:</b></td><td style="width:250px">$razonSocial</td>
                    <td style="width:90px"><b>Contacto.:</b></td><td style="width:165px">$nombreContacto</td>
  
                </tr>
                <tr>
                    <td style="width:75px"><b>Nombre comercial.: </b></td><td style="width:250px">$nombreComercial</td>
   <td style="width:90px;"><b>Correo.:</b></td><td style="width:165px">$correo</td>    
   
   </tr>
                <tr>
                    <td style="width:75px"><b>Dirección.:</b></td><td style="width:250px">$direccionFiscal&nbsp;&nbsp;</td>
                    <td style="width:90px"><b>Ejecutivo.:</b></td><td style="width:165px">$ejecutivo</td>
                </tr>

        </table>	
   
EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');
//-------------------------------------------------------------------------------------------------------

$bloque3 = <<<EOF
	<table style="font-size:8px; text-align:left;">
      
	<tr><br/>
          <br/>
            <th style="border: 1px solid #030505; text-align:center; background-color:white; width:30px;"><strong>#</strong></th>
            <th style="border: 1px solid #030505; text-align:center; background-color:white; width:120px;"><strong>REGIMEN</strong></th>
            <th style="border: 1px solid #030505; text-align:center; background-color:white; width:100px;"><strong>RUBRO</strong></th>
            <th style="border: 1px solid #030505; text-align:center; background-color:white; width:70px;"><strong>TIPO</strong></th>
            <th style="border: 1px solid #030505; text-align:center; background-color:white; width:135px;"><strong>FORMA DE COBRO</strong></th>
            <th style="border: 1px solid #030505; text-align:center; background-color:white; width:35px;"><strong>M</strong></th>
            <th style="border: 1px solid #030505; text-align:center; background-color:white; width:70px;"><strong>TARIFA</strong></th>
        </tr>
	</table>	
EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

//-------------------------------------------------------------------------------------------------------
$bloque4 = <<<EOF
    <table style="padding: 2px 5px; text-align:left;">
EOF;

$num = '<td style="border-left: 1px solid #030505; text-align:center; border-right: 1px solid #030505; font-size:7px; width:30px;">';
$clCategoria = '<td style="border-left: 1px solid #030505; text-align:centert; border-right: 1px solid #030505; font-size:7px; width:120px;">';
$clServicio = '<td style="border-left: 1px solid #030505; text-align:center; border-right: 1px solid #030505; font-size:7px; width:100px;">';
$clTipo = '<td style="border-left: 1px solid #030505; text-align:center; border-right: 1px solid #030505; font-size:7px; width:70px;">';
$clPeriodo = '<td style="border-left: 1px solid #030505; text-align:center; border-right: 1px solid #030505; font-size:7px; width:135px;">';
$clMoneda = '<td style="border-left: 1px solid #030505; text-align:center; border-right: 1px solid #030505; font-size:7px; width:35px;">';
$clTarifa = '<td style="border-left: 1px solid #030505; text-align:center; border-right: 1px solid #030505; font-size:8px; width:70px;">';

$pdf->writeHTML($bloque4, false, false, false, false, '');               

foreach ($respSerTar["success"] as $key => $value) {
    $numero = $key + 1;
    $servicio = $value["categoria"];
$bloque5 = <<<EOF
    <tr>
        $num $numero</td>
        $clCategoria $servicio</td>
        $clServicio </td>
        $clTipo </td>
        $clPeriodo </td>
        $clMoneda<strong></strong></td>
        $clTarifa<strong></strong></td>
    </tr>        
EOF;
$pdf->writeHTML($bloque5, false, false, false, false, '');
    //VALOR Y DATOS DE ALMACENAJE
    $periodoCalc = $value["periodoCalc"];
    if ($periodoCalc != "SD") {
        $subAlm = $value["subAlm"];
        $baseAlm = $value["baseAlm"];
        $calcSAlm = $value["calcSAlm"];
        $moneda = $value["monedaAlm"];
        $valTar = $value["valTar"];
        if ($moneda == "Quetzales") {
            $mon = "Q";
        } else if ($moneda == "Dolares") {
            $mon = "$";
        } else {
            $mon = $moneda;
        }
$bloque5 = <<<EOF
    <tr>
        $num </td>
        $clCategoria </td>
        $clServicio $subAlm</td>
        $clTipo $baseAlm</td>
        $clPeriodo $periodoCalc - $calcSAlm</td>
        $clMoneda<strong>$mon</strong></td>
        $clTarifa<strong>$valTar</strong></td>
    </tr>        
EOF;
$pdf->writeHTML($bloque5, false, false, false, false, '');
}
    //VALOR Y DATOS DE SEGURO
    $periodoSeg = $value["periodoSeg"];
    if ($periodoSeg != "SD") {
        $subSeguro = $value["subSeguro"];
        $basSeg = $value["basSeg"];
        $perCalcSeg = $value["perCalcSeg"];
        $monSeg = $value["monSeg"];
        $valSeg = $value["valSeg"];
        if ($monSeg == "Quetzales") {
            $monS = "Q";
        } else if ($monSeg == "Dolares") {
            $monS = "$";
        } else {
            $monS = $monSeg;
        }
        $bloque6 = <<<EOF
    <tr>
        $num </td>
        $clCategoria </td>
        $clServicio $subSeguro</td>
        $clTipo $basSeg</td>
        $clPeriodo $periodoSeg - $perCalcSeg</td>
        $clMoneda<strong>$monS</strong></td>
        $clTarifa<strong>$valSeg</strong></td>
    </tr>        
EOF;
        $pdf->writeHTML($bloque6, false, false, false, false, '');        
    }
    //VALOR Y DATOS DE MANEJO
    $bsManejo = $value["bsManejo"];
    if ($bsManejo != "SD") {
        $manCat = $value["manCat"];
        $monCalcManejo = $value["monCalcManejo"];
        $valManejo = $value["valManejo"];
        if ($monCalcManejo == "Quetzales") {
            $monMan = "Q";
        } else if ($monCalcManejo == "Dolares") {
            $monMan = "$";
        } else {
            $monMan = $valManejo;
        }        
        
$bloque7 = <<<EOF
    <tr>
        $num </td>
        $clCategoria </td>
        $clServicio $manCat</td>
        $clTipo $bsManejo</td>
        $clPeriodo -</td>
        $clMoneda<strong>$monMan</strong></td>
        $clTarifa<strong>$valManejo</strong></td>
    </tr>        
EOF;
$pdf->writeHTML($bloque7, false, false, false, false, '');            
}
    //VALOR Y DATOS DE GASTOS ADMINISTRACION
$baseGtAd = $value["baseGtAd"];
    if ($baseGtAd != "SD") {
            $gtsAdmin = $value["gtsAdmin"];

        $monGst = $value["monGst"];
        $valGstAd = $value["valGstAd"];
        if ($monGst == "Quetzales") {
            $monGtAd = "Q";
        } else if ($monGst == "Dolares") {
            $monGtAd = "$";
        } else {
            $monGtAd = $monGst;
        }              
        $bloque8 = <<<EOF
    <tr>
        $num </td>
        $clCategoria </td>
        $clServicio $gtsAdmin</td>
        $clTipo $baseGtAd</td>
        $clPeriodo -</td>
        $clMoneda<strong>$monGtAd</strong></td>
        $clTarifa<strong>$valGstAd</strong></td>
    </tr>        
EOF;
        $pdf->writeHTML($bloque8, false, false, false, false, '');               
    }

    //VALOR Y DATOS DE GASTOS ADMINISTRACION
    $basOtrosG = $value["basOtrosG"];
    if ($basOtrosG != "SD") {
    $otrGastos = $value["otrGastos"];
        $monOtrosG = $value["monOtrosG"];
        $valOtrosG = $value["valOtrosG"];
        if ($monOtrosG == "Quetzales") {
            $monOtrosG = "Q";
        } else if ($monOtrosG == "Dolares") {
            $monOtrosG = "$";
        } else {
            $monOtrosG = $monOtrosG;
        }          
        $bloque8 = <<<EOF
    <tr>
        $num </td>
        $clCategoria </td>
        $clServicio $otrGastos</td>
        $clTipo $basOtrosG</td>
        $clPeriodo -</td>
        $clMoneda<strong>$monGtAd</strong></td>
        $clTarifa<strong>$valOtrosG</strong></td>
    </tr>        
EOF;
        $pdf->writeHTML($bloque8, false, false, false, false, '');              
        
    }
}

$bloque10 = <<<EOF
	<table style="font-size:8px; text-align:left;">
      
	<tr>
            <th style="border: 1px solid #030505; text-align:center; background-color:white; width:560px;"><strong></strong></th>
        </tr>
	</table>	
EOF;

$pdf->writeHTML($bloque10, false, false, false, false, '');

$bloque11 = <<<EOF
        <br/><br/><br/><br/><br/><br/>
	<table style="font-size:8px; text-align:left;">
      
            <td style="width:185px text-align:center; border: none; padding: none; margin: none;">______________________________<br/><strong>EJECUTIVO :</strong></td>
            <td style="width:185px text-align:center; border: none; padding: none; margin: none;">______________________________<br/><strong>REVISADO :</strong></td>
            <td style="width:190px text-align:right;  border: none; padding: none; margin: none;">______________________________<br/><strong>AUTORIZADO:</strong></td>

   </table>	
EOF;
$pdf->writeHTML($bloque11, false, false, false, false, '');
$pdf->OutPut('Sin título.pdf');
}
}

$numTar = new imprimirIngresoBodega();
$numTar -> tarifaCodigo = $_GET["tarifaCodigo"];
ob_start();
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
$numTar -> traerDatosIngreso();

?>


															
															
