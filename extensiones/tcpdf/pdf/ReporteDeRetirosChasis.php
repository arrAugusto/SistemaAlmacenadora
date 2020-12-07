<?php

require_once "../../../controlador/contabilidadRetiro.controlador.php";
require_once "../../../modelo/contabilidadRetiro.modelo.php";

require_once "../../../controlador/ingPendientesC.controlador.php";
require_once "../../../modelo/ingPendientesC.modelo.php";

class imprimirIngresoBodega {

    public $retiro;

    public function traerDatosIngreso() {
// TRAER DATOS DE INGRESO

        $tipoReporte = $this->tipoReporte;
        $idBodega = $this->idBodega;
        $tipo = 5;
        if ($tipoReporte != "retiro") {
            $date = $tipoReporte;
            if (!empty($date)) {
                $timestamp = strtotime($date);
                if ($timestamp === FALSE) {
                    $timestamp = strtotime(str_replace('/', '-', $date));
                }
                $date = date('Y-m-d', $timestamp);
            }
            $tipo = 6;
            $sp = "spRetirosContabilizados";
            $respRepRet = ControladorContabilidadDeRet::ctrListarRetContabilizados($sp, $tipo, $idBodega, $date);
            $dataReporte = [];
        } else {
            $estado = 2;
            $respRepRet = ControladorContabilidadDeRet::ctrMostrarChasisRet($estado, $idBodega);
            $dataReporte = [];
        }
        
        $repContabilidad = ControladorGeneracionDeContabilidad::ctrIngRegistroContaReportes($tipoReporte, $idBodega);
        $nombreAuxiliar = $repContabilidad[0]["nombres"];
        $apellidoAuxiliar = $repContabilidad[0]["apellidos"];

        $ident = $idBodega;


        foreach ($respRepRet as $key => $value) {
            $estado = 0;
            if ($key == 0) {
                array_push($dataReporte, $value);
            }
            if ($key >= 1) {
                foreach ($dataReporte as $key => $values) {
                    if ($values["numeroRetiro"] == $value["numeroRetiro"]) {
                        $estado = $estado + 1;
                    }
                }
                if ($estado == 0) {
                    array_push($dataReporte, $value);
                }
            }
        }

        $FContaRep = $respRepRet[0]["fechaContabilidad"];
        $formatFechReporte = date("d/m/Y", strtotime($FContaRep));

        $respJefe = ControladorGeneracionDeContabilidad::ctrJefeUnidad($ident);
        $nombreJefe = $respJefe[0]["nombres"];
        $apellidoJefe = $respJefe[0]["apellidos"];
        if ($nombreJefe == $nombreAuxiliar && $apellidoJefe == $apellidoAuxiliar) {
            $nombreJefe = "";
            $apellidoJefe = "";
        }

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
        <td style="width:560px; text-align:center; font-size:9px; font-family: 'Source Sans Pro';">ALMACENADORA INTEGRADA, S.A.<br/>REPORTE DE RETIROS FISCALES ZONA ADUANERA<br/>CIFRAS EXPRESADAS EN QUETZALES, $formatFechReporte</td>
      </tr>  
	</table>

EOF;
        $pdf->writeHTML($bloque1, false, false, false, false, PDF_HEADER_STRING);
//---------------------------------------------------------------------------------------------------
        $bloque3 = <<<EOF
  <table style="font-size:7px;">
    <tr><br/>
   <th style="border: 1px solid #030505; background-color:white; color:black; background-color: #4ECBE9; width:47px; text-align:center;"><strong>Retiro</strong></th>
      <th style="border: 1px solid #030505; background-color:white; color:black; background-color: #4ECBE9; width:47px; text-align:center;"><strong>Ingreso</strong></th>
      <th style="border: 1px solid #030505; background-color:white; color:black; background-color: #4ECBE9; width:55px; text-align:center;"><strong>Poliza</strong></th>
      <th style="border: 1px solid #030505; background-color:white; color:black; background-color: #4ECBE9; width:40px; text-align:center;"><strong>Fecha</strong></th>
      <th style="border: 1px solid #030505; background-color:white; width:173px; color:black; background-color: #4ECBE9; text-align:center;"><strong>Nombre de Empresa</strong></th>
      <th style="border: 1px solid #030505; background-color:white; width:28px; color:black; background-color: #4ECBE9; text-align:center;"><strong>Bultos</strong></th>      
      <th style="border: 1px solid #030505; background-color:white; width:58px; color:black; background-color: #4ECBE9; text-align:center;"><strong>Cif</strong></th>      
      <th style="border: 1px solid #030505; background-color:white; width:56px; color:black; background-color: #4ECBE9; text-align:center;"><strong>Impuestos</strong></th>      
      <th style="border: 1px solid #030505; background-color:white; width:58px; color:black; background-color: #4ECBE9; text-align:center;"><strong>Total</strong></th>      
    </tr>
  </table>	
EOF;
        $pdf->writeHTML($bloque3, false, false, false, false, '');
//---------------------------------------------------------------------------------------------------
        $bultosAcum = 0;
        $cifAcum = 0;
        $imptAcum = 0;
        $totalAcum = 0;
        foreach ($dataReporte as $key => $value) {
            
            $numeroRetiro = $value["numeroRetiro"];
            $numeroIngreso = $value["numeroIngreso"];
            $polRet = $value["polizaRetiro"];

            $FConta = $value["fecha"];
            $formatFechConta = date("d/m/Y", strtotime($FConta));
            $empresa = $value["empresaRet"];
            $bultosRet = 1;
            $totalValorCif = $value["cif"];
            $valorImpuesto = $value["impuesto"];
            $total = $totalValorCif + $valorImpuesto;

            $bultosAcum = $bultosAcum + $bultosRet;
            $cifAcum = $cifAcum + $totalValorCif;
            $imptAcum = $imptAcum + $valorImpuesto;
            $totalAcum = $totalAcum + $total;

            $cifAcumF = number_format($cifAcum, 2);
            $imptAcumF = number_format($imptAcum, 2);
            $totalAcumF = number_format($totalAcum, 2);


            $totalValorCifF = number_format($totalValorCif, 2);
            $valorImpuestoF = number_format($valorImpuesto, 2);
            $totalF = number_format($total, 2);

            $nombresAux = $value["nombres"];
            $apellidosAux = $value["apellidos"];

            $bloque3 = <<<EOF
  <table style="font-size:6px;">
    <tr>
   <th style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:47px; text-align:center;">$numeroRetiro</th>
      <th style="border-right: 1px solid #030505; width:47px; text-align:center;">$numeroIngreso</th>
      <th style="border-right: 1px solid #030505; width:55px; text-align:center;">$polRet</th>
      <th style="border-right: 1px solid #030505; color:black; width:40px; text-align:center;">$formatFechReporte</th>
      <th style="border-right: 1px solid #030505; width:173px; #4ECBE9; text-align:left;">$empresa</th>
      <th style="border-right: 1px solid #030505; width:28px; text-align:right;">$bultosRet</th>      
      <th style="border-right: 1px solid #030505; width:58px;  text-align:right;">$totalValorCifF</th>      
      <th style="border-right: 1px solid #030505; width:56px; text-align:right;">$valorImpuestoF</th>      
      <th style="border-right: 1px solid #030505; width:58px; text-align:right;">$totalF</th>      
    </tr>
  </table>	
EOF;
            $pdf->writeHTML($bloque3, false, false, false, false, '');
        }
//---------------------------------------------------------------------------------------------------
        $bloque3 = <<<EOF
  <table style="font-size:7px;">
    <tr>  
      <th style="border: 1px solid #030505; width:362px; text-align:center;"><strong>TOTALES</strong></th>
      <th style="border: 1px solid #030505; width:28px; text-align:right;"><strong>$bultosAcum</strong></th>      
      <th style="border: 1px solid #030505; width:58px; text-align:right;"><strong>$cifAcumF</strong></th>      
      <th style="border: 1px solid #030505; width:56px; text-align:right;"><strong>$imptAcumF</strong></th>      
      <th style="border: 1px solid #030505; width:58px; text-align:right;"><strong>$totalAcumF</strong></th>      
    </tr>
  </table>	
EOF;
        $pdf->writeHTML($bloque3, false, false, false, false, '');

//---------------------------------------------------------------------------------------------------
        $bloque7 = <<<EOF
      <table style="font-size:7px; border: none; padding: none; margin: none;"> <!-- Lo cambiaremos por CSS -->
        <tbody>
		<tr><br/><br/><br/><br/><br/><br/>
          <td nstyle="width:278px text-align:left; border: none; padding: none; margin: none;">Elaborado por.:__________________________________________<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$nombresAux $apellidosAux</td>
          <td style="width:279px text-align:left; border: none; padding: none; margin: none;">Vo. Bo.:__________________________________________<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$nombreJefe $apellidoJefe</td>  
        </tr>
		</tbody>
                
               
    </table>
EOF;
        $pdf->writeHTML($bloque7, false, false, false, false, '');
        $pdf->OutPut('Sin título.pdf');
    }

}

$retiro = new imprimirIngresoBodega();
$retiro->tipoReporte = $_GET["tipoReporte"];
$retiro->idBodega = $_GET["idBodega"];
ob_start();
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
$retiro->traerDatosIngreso();
?>
