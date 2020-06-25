<?php

require_once "../../../controlador/registroIngresoBodega.controlador.php";
require_once "../../../modelo/registroIngresoBodega.modelo.php";

require_once "../../../controlador/historiaIngresosFisacales.controlador.php";
require_once "../../../modelo/historiaIngresosFisacales.modelo.php";

class imprimirRetiroVacio {

    public $unidad;

    public function traerDatosUnidades() {
        // TRAER DATOS DE INGRESO
        $unidad = $this->unidad;
        $repuestaOperaciones = ControladorRegistroBodega::ctrTraerDatosOperaciones($unidad);

        $tipo = "PVacio";
        $repuestaUnidades = ControladorRegistroBodega::ctrTraerDatosUnidades($unidad, $tipo);
        if ($repuestaUnidades == "SD" || $repuestaOperaciones == "SD") {
            echo '<script>
                    alert("El siguiente documento no tiene pase de salida autorizado...");
                    window.location = "http://localhost/AlmacenadorasUnidasDesarrollo/Inicio";
                  </script>';
            exit();
        }
        $fecha_actual = new DateTime();
        $area = $repuestaOperaciones[0]["area"];
        $numeroArea = $repuestaOperaciones[0]["numeroArea"];
        $nombreEmpresa = $repuestaOperaciones[0]["empresa"];
        $numeroNit = $repuestaOperaciones[0]["numeroNit"];
        $bultosTotal = $repuestaOperaciones[0]["blts"];

        $cadena_fecha_actual = $repuestaOperaciones[0]["fReal"]->format("d/m/Y");
        $ing = $repuestaOperaciones[0]["idIngreso"];
        $origen = $repuestaOperaciones[0]["origen"];
        $bill = $repuestaOperaciones[0]["bill"];


        $cif = number_format($repuestaOperaciones[0]["cif"], 2);
        $impuesto = number_format($repuestaOperaciones[0]["impuesto"], 2);
        
        require_once('tcpdf_include.php');

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

//$pdf->startPageGroup();

        $pdf->AddPage();

//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        $pdf->SetMargins(6, 0, 6);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        //**************  CUERPO DEL PDF
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
                <td style="width:550px; text-align:center; font-size:17px; font-family: 'Source Sans Pro';">Pase de salida vacío</td>
            </tr>
	</table>
EOF;

        $pdf->writeHTML($bloque1, false, false, false, false, PDF_HEADER_STRING);

//-------------------------------------------------------------------------------------------------------
        $bloque2 = <<<EOF


	<table style="font-size:9px; border: none; padding: none; margin: none;">
		<tr><br/>
			<td style="width:300px">
				Empresa que lo solicita: $nombreEmpresa<br/>
                                Nit:        $numeroNit<br/>
                                Bodega No.: $area&nbsp;&nbsp;$numeroArea<br/>
                                
			</td></tr>

	</table>	
EOF;

        $pdf->writeHTML($bloque2, false, false, false, false, '');

//-------------------------------------------------------------------------------------------------------

        $bloque3 = <<<EOF
	<table style="font-size:8px; text-align:center;">
		<tr>
                    <th style="border: 1px solid #030505; background-color:white; width:201px;"><strong>PILOTO</strong></th>
                    <th style="border: 1px solid #030505; background-color:white; width:141px;"><strong>LICENCIA</strong></th>
                    <th style="border: 1px solid #030505; background-color:white; width:100px;"><strong>PLACA</strong></th>
                    <th style="border: 1px solid #030505; background-color:white; width:120px;"><strong>CONTENEDOR</strong></th>                        
		</tr>
	</table>	
EOF;

        $pdf->writeHTML($bloque3, false, false, false, false, '');
//-------------------------------------------------------------------------------------------------------
        $fontLetra = "font-size:7px";

        foreach ($repuestaUnidades as $key => $value) {
            $piloto = $value["piloto"];
            $licencia = $value["licencia"];
            $placa = $value["placa"];
            $contenedor = $value["contenedor"];
            $llave = count($repuestaUnidades);
            if ($key + 1 == $llave) {
                $colPiloto = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; border-bottom: 1px solid #030505; width:201px; ' . $fontLetra . '">' . $piloto . '</td>';
                $colLic = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; border-bottom: 1px solid #030505; width:141px; ' . $fontLetra . '">' . $licencia . '</td>';
                $colPlaca = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; border-bottom: 1px solid #030505; width:100px; ' . $fontLetra . '">' . $placa . '</td>';
                $colContainer = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; border-bottom: 1px solid #030505; width:120px; ' . $fontLetra . '">' . $contenedor . '</td>';
            } else {
                $colPiloto = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:201px; ' . $fontLetra . '">' . $piloto . '</td>';
                $colLic = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:141px; ' . $fontLetra . '">' . $licencia . '</td>';
                $colPlaca = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:100px; ' . $fontLetra . '">' . $placa . '</td>';
                $colContainer = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:120px; ' . $fontLetra . '">' . $contenedor . '</td>';
            }

            $bloque4 = <<<EOF
	<table style="padding: 2px 5px; text-align:center;">
		<tr>
        	    $colPiloto
                    $colLic
                    $colPlaca
                    $colContainer   
		</tr>
	</table>	
EOF;

            $pdf->writeHTML($bloque4, false, false, false, false, '');
        }

//-------------------------------------------------------------------------------------------------------

        $bloque5 = <<<EOF

       <table style="font-size:7px; border: none; padding: none; margin: none;"> <!-- Lo cambiaremos por CSS -->
	<tbody>

		<tr><br/><br/><br/><br/><br/><td style="width:245px text-align:left; border: none; padding: none; margin: none;">______________________________<br/><strong>Firma Recibido</strong></td>
                		<td style="width:242px text-align:left;"><br/><br/></td>
	    
   </tr>
		<tr><br/>
			<td colspan="2" style="width:480px; text-align:left;"><strong>Nota:</strong> <br/>El ingreso de la mercadería que se describe en el presente documento, implica la aceptación por parte del su propietario de que la misma se le entregará sin responsabilidad alguna de Almacenadora Integrada, Sociedad Anónima, al portador de la respectiva póliza de importación.<br/>
                La persona que ingrese la mercaderia a la Almacenadora es la responsable de obtener la autorización y aceptación del propietario para el ingreso de la misma. De no existir consentimiento del propietario, la responsabilidad sobre la mercadería recaerá en la persona que ingrese la mercaderia y en ningún caso en la Almacenadora.<br/>
                Almacenadora Integrada, S.A. no se responsabiliza de la merma, deterioro o destrucción de las mercancías derivadas de su propia naturaleza</td>
		</tr>
	</tbody>

        </table>
EOF;

        $pdf->writeHTML($bloque5, false, false, false, false, '');


//-------------------------------------------------------------------------------------------------------        
        // SALIDAD DEL ARCHIVO

        $pdf->OutPut('Sin título.pdf');
    }

}

$ingreso = new imprimirRetiroVacio();
$ingreso->unidad = $_GET["unidad"];
ob_start();
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
$ingreso->traerDatosUnidades();
?>




