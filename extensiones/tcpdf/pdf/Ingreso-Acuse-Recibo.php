<?php

require_once "../../../controlador/registroIngresoBodega.controlador.php";
require_once "../../../modelo/registroIngresoBodega.modelo.php";

require_once "../../../controlador/historiaIngresosFisacales.controlador.php";
require_once "../../../modelo/historiaIngresosFisacales.modelo.php";

class imprimirIngresoBodega {

    public $Ingreso;

    public function traerDatosIngreso() {
// TRAER DATOS DE INGRESO
        $Ingreso = $this->Ingreso;
        $repuestaUsuarios = ControladorRegistroBodega::ctrTraerUsuarios($Ingreso);
        $nombres = $repuestaUsuarios[0]["nombres"];
        $apellidos = $repuestaUsuarios[0]["apellidos"];
        $repuestaOperaciones = ControladorRegistroBodega::ctrTraerDatosOperaciones($Ingreso);
        
        
        $tipo = "Acuse";
        $repuestaUnidades = ControladorRegistroBodega::ctrTraerDatosUnidades($Ingreso, $tipo);

        $fechaIngreso = $repuestaOperaciones[0]["fechaRealIng"];
        $fechaIngFormat = date("d-m-Y- H:i:s", strtotime($fechaIngreso));

        $fechaOperacion = $repuestaOperaciones[0]["fechaOperacion"];
        $fechaOperacionIngFormat = date("d-m-Y H:i:s", strtotime($fechaOperacion));

        $area = $repuestaOperaciones[0]["area"];
        $numeroArea = $repuestaOperaciones[0]["numeroArea"];
        $nombreEmpresa = $repuestaOperaciones[0]["empresa"];
        $numeroNit = $repuestaOperaciones[0]["numeroNit"];
        $bultosTotal = $repuestaOperaciones[0]["blts"];
        $ing = $repuestaOperaciones[0]["ing"];
        $origen = $repuestaOperaciones[0]["origen"];
        $bill = $repuestaOperaciones[0]["bill"];
        $mrch = $repuestaOperaciones[0]["mrch"];
        $numberoDua = $repuestaOperaciones[0]["numberoDua"];
        $regIngreso = $repuestaOperaciones[0]["regIngreso"];
        $valFobDolares = number_format($repuestaOperaciones[0]["valorTotalAduana"], 2);
        $bultosIngreso = $repuestaOperaciones[0]["bultosIngreso"];


        $cif = number_format($repuestaOperaciones[0]["cif"], 2);
        $impuesto = number_format($repuestaOperaciones[0]["impuesto"], 2);

        $idIngreso = $repuestaUnidades[0]["idIngreso"];
        $poliza = $repuestaOperaciones[0]["poliza"];
        $numPlaca = $repuestaUnidades[0]["placa"];
//$concatenarConsultImagen = "../../imagenesQRCreadas/qrCode".$idIngreso.$poliza.$numPlaca.".png";

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
                <td style="width:550px; text-align:center; font-size:17px; font-family: 'Source Sans Pro';">Incidencia Recibo de acuse</td>
            </tr>
	</table>
EOF;

        $pdf->writeHTML($bloque1, false, false, false, false, PDF_HEADER_STRING);


//-------------------------------------------------------------------------------------------------------
        $bloque2 = <<<EOF


	<table style="font-size:7.5px; border: none; padding: none; margin: none;">
		<tr><br/><br/>
                    <td style="width:70px"><b>Empresa :</b></td><td style="width:330px">$nombreEmpresa&nbsp;&nbsp;</td>
                    <td style="width:75px"><b>Fecha Garita :</b></td><td style="width:250px">$fechaIngFormat</td>
                </tr>
                <tr>
                    <td style="width:70px"><b>Nit :</b></td><td style="width:330px">$numeroNit&nbsp;&nbsp;</td>
                    <td style="width:75px;"><b>Fecha Registro:</b></td><td style="width:250px">$fechaOperacionIngFormat</td>    
                </tr>
                <tr>
                    <td style="width:70px"><b>Poliza de Ingreso :</b></td><td style="width:330px">$poliza&nbsp;&nbsp;</td>
                    <td style="width:75px"><b>Valor Fob :</b></td><td style="width:250px">$valFobDolares</td>
                    
                </tr>
                <tr>
                    <td style="width:70px"><b>Dua :</b></td><td style="width:330px">$numberoDua&nbsp;&nbsp;</td>
                    <td style="width:75px"><b>Bodega No. :</b></td><td style="width:330px">$numeroArea&nbsp;&nbsp;</td>
                </tr>
                <tr>
                   <td style="width:70px"><b>Regimen :</b></td><td style="width:330px">$regIngreso</td>
                  <td style="width:75px"><b>Cantidad de bultos  :</b></td><td style="width:330px">$bultosIngreso&nbsp;&nbsp;</td>
          
                </tr>    
         </table>	
EOF;

        $pdf->writeHTML($bloque2, false, false, false, false, '');

//-------------------------------------------------------------------------------------------------------

        $bloque3 = <<<EOF
	<table style="font-size:8px; text-align:center;">
		<tr><br/>
                    <th style="border: 1px solid #030505; background-color:white; width:191px;"><strong>PILOTO</strong></th>
                    <th style="border: 1px solid #030505; background-color:white; width:111px;"><strong>LICENCIA</strong></th>
                    <th style="border: 1px solid #030505; background-color:white; width:90px;"><strong>PLACA</strong></th>
                    <th style="border: 1px solid #030505; background-color:white; width:100px;"><strong>CONTENEDOR</strong></th>    
                 <th style="border: 1px solid #030505; background-color:white; width:70px;"><strong>Marchamo</strong></th>                            
		</tr>
	</table>	
EOF;

        $pdf->writeHTML($bloque3, false, false, false, false, '');
//-------------------------------------------------------------------------------------------------------
        //       var_dump($repuestaUnidades);
        $fontLetra = "font-size:7px";
        foreach ($repuestaUnidades as $key => $value) {
            $piloto = $value["piloto"];
            $licencia = $value["licencia"];
            $placa = $value["placa"];
            $contenedor = $value["contenedor"];
            $marchamo = $value["marchamo"];
            $llave = count($repuestaUnidades);
            if ($key + 1 == $llave) {
                $colPiloto = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; border-bottom: 1px solid #030505; width:191px; ' . $fontLetra . '">' . $piloto . '</td>';
                $colLic = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; border-bottom: 1px solid #030505; width:111px; ' . $fontLetra . '">' . $licencia . '</td>';
                $colPlaca = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; border-bottom: 1px solid #030505; width:90px; ' . $fontLetra . '">' . $placa . '</td>';
                $colContainer = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; border-bottom: 1px solid #030505; width:100px; ' . $fontLetra . '">' . $contenedor . '</td>';
                $marchamo = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; border-bottom: 1px solid #030505; width:70px; ' . $fontLetra . '">' . $marchamo . '</td>';
            } else {
                $colPiloto = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:191px; ' . $fontLetra . '">' . $piloto . '</td>';
                $colLic = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:111px; ' . $fontLetra . '">' . $licencia . '</td>';
                $colPlaca = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:90px; ' . $fontLetra . '">' . $placa . '</td>';
                $colContainer = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:100px; ' . $fontLetra . '">' . $contenedor . '</td>';
                $marchamo = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:70px; ' . $fontLetra . '">' . $marchamo . '</td>';
            }

            $bloque4 = <<<EOF
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

            $pdf->writeHTML($bloque4, false, false, false, false, '');
        }

        /*
         *
         *  
         * LEYENDA ALMACENADORAS ACUSE FISCAL 42 / 33 CALLE
         * 
         * 
         */

//-------------------------------------------------------------------------------------------------------

        $bloque8 = <<<EOF

		<table style="font-size:7px; border: none; padding: none; margin: none;"> <!-- Lo cambiaremos por CSS -->
			<tbody>
				<tr><br/><br/><br/><br/><br/><br/><td style="width:245px text-align:left; border: none; padding: none; margin: none;">f.________________________________________<br/>$nombres $apellidos</td>
				</tr>
			</tbody>
        </table>
EOF;

        $pdf->writeHTML($bloque8, false, false, false, false, '');

        $pdf->OutPut('Sin título.pdf');
    }

}

$ingreso = new imprimirIngresoBodega();
$ingreso->Ingreso = $_GET["Ingreso"];
ob_start();
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
$ingreso->traerDatosIngreso();
?>




