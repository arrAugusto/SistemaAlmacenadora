<?php

require_once "../../../controlador/registroIngresoBodega.controlador.php";
require_once "../../../modelo/registroIngresoBodega.modelo.php";

require_once "../../../controlador/historiaIngresosFisacales.controlador.php";
require_once "../../../modelo/historiaIngresosFisacales.modelo.php";

class imprimirIngresoBodegaInforme {

    public $codigo;

    public function traerDatosIngresoInforme() {
// TRAER DATOS DE INGRESO
        $codigo = $this->codigo;

        $repuestaOperaciones = ControladorRegistroBodega::ctrTraerDatosOperaciones($codigo);

        $cadena = ControladorRegistroBodega::ctrCadenaVinculo($codigo);

        $servicio = $repuestaOperaciones[0]["servicioIng"];
        if ($servicio == "VEHICULOS NUEVOS") {
            $repuestaBodega = ControladorRegistroBodega::ctrMostrarChasis($codigo);
            $titulo = "vehículos en predios fiscales";
        } else {
            $tipo = 1;
            $repuestaOpera = ControladorRegistroBodega::ctrTraerDatosBodegas($codigo, $tipo);
            $nomElab = $repuestaOpera[0]["nombres"];
            $apellElab = $repuestaOpera[0]["apellidos"];
            $tipo = 0;

            $repuestaBod = ControladorRegistroBodega::ctrTraerDatosBodegas($codigo, $tipo);
            $nomBod = $repuestaBod[0]["nombres"];
            $apellBod = $repuestaBod[0]["apellidos"];
            $estado = $repuestaOperaciones[0]["estadoIngreso"];
            $titulo = "mercadería en bodega fiscal";
        }
        $tipo = "Ingreso";
        $repuestaUnidades = ControladorRegistroBodega::ctrTraerDatosUnidades($codigo, $tipo);

        $area = $repuestaOperaciones[0]["area"];
        $numeroArea = $repuestaOperaciones[0]["numeroArea"];
        $nombreEmpresa = $repuestaOperaciones[0]["empresa"];
        $numeroNit = $repuestaOperaciones[0]["numeroNit"];
        $bultosTotal = $repuestaOperaciones[0]["blts"];

        $cadena_fecha_Garita = $repuestaOperaciones[0]["fechaRealIng"];
        $fechaGaritaFormat = date("d/m/Y H:i:s A", strtotime($cadena_fecha_Garita));

        $cadenaEmision = $repuestaOperaciones[0]["fechaOperacion"];
        $cadenaEmisionFormat = date("d/m/Y H:i:s A", strtotime($cadenaEmision));

        $numAsigIng = $repuestaOperaciones[0]["numAsigIng"];
        $origen = $repuestaOperaciones[0]["origen"];
        $bill = $repuestaOperaciones[0]["bill"];
        $cif = number_format($repuestaOperaciones[0]["cif"], 2);
        $impuesto = number_format($repuestaOperaciones[0]["impuesto"], 2);
        $idIngreso = $repuestaUnidades[0]["idIngreso"];
        $poliza = $repuestaOperaciones[0]["poliza"];
        $numPlaca = $repuestaUnidades[0]["placa"];
        require_once('tcpdf_include.php');
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->AddPage('L');

        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetMargins(6, 0, 6);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
//---------------------------------------------------------------------------------------------------
        $bloque1 = <<<EOF
	<table style="border: none; padding: none; margin: none;">
		<tr><br/>
			<td style="width:130px; text-align:left;"><img src="images/almacenadoras_logo.png"></td>
                        <td style="width:626px; text-align:right; font-size:7px;">
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
                <td style="width:726px; text-align:center; font-size:17px; font-family: 'Source Sans Pro';">Informe recepción de $titulo</td>
            </tr>
        </table><br/><br/>
EOF;
        $pdf->writeHTML($bloque1, false, false, false, false, PDF_HEADER_STRING);
//-------------------------------------------------------------------------------------------------------
        $bloque2 = <<<EOF
	<table style="font-size:7.5px; border: none; padding: none; margin: none;">
                <tr>
                    <td style="width:75px;"><b>Nit :</b></td><td style="width:350px;">$numeroNit&nbsp;&nbsp;</td>
                    <td style="width:90px;"></td><td style="width:301px;"></td>    
                </tr>
                <tr>
                    <td style="width:75px"><b>Empresa :</b></td><td style="width:350px">$nombreEmpresa</td>
                    <td style="width:90px"></td><td style="width:301px"></td>
                </tr>
                <tr>
                    <td style="width:75px"><b>Area :</b></td><td style="width:350px">Bodega No. $numeroArea</td>
                    <td style="width:90px"><b>Póliza :</b></td><td style="width:301px">$poliza</td>
                </tr>
                <tr>
                    <td style="width:75px"><b>Elaborado por:</b></td><td style="width:350px">$nomElab $apellElab&nbsp;&nbsp;</td>
                    <td style="width:90px"><b>Fecha Garita :</b></td><td style="width:301px">$fechaGaritaFormat&nbsp;&nbsp;</td>
                </tr>
                <tr>
                   <td style="width:75px"><b>Descargado por:</b></td><td style="width:350px"></td>
                    <td style="width:90px"><b>Fecha emisión :</b></td><td style="width:301px">$cadenaEmisionFormat</td>
                </tr> 
                <tr>
                   <td style="width:75px"><b>Montacarguista(s) :</b></td><td style="width:350px"></td>
                    <td style="width:90px"><b>Fecha y hora de descarga :</b></td><td style="width:301px"></td>
                </tr> 

   </table>	
EOF;
        $pdf->writeHTML($bloque2, false, false, false, false, '');
//-------------------------------------------------------------------------------------------------------
        if ($estado == -1) {
            $bloque2 = <<<EOF
	<table>
            <tr>
                <td style="width:200px;"></td>
                <td style="width:160px;"><img src="images/anulado.png"></td>                    
                <td style="width:200px;"></td>
            </tr>
        </table>	
EOF;
            $pdf->writeHTML($bloque2, false, false, false, false, '');
        }
//-------------------------------------------------------------------------------------------------------

        if ($servicio == "VEHICULOS NUEVOS") {
            $bloque3 = <<<EOF
	<table style="font-size:8px;">
 		<tr>
                 <br/>
                    <th style="border: 1px solid #030505; background-color:white; width:240px; text-align:center;"><strong>CHASIS VEHICULO</strong></th>
                    <th style="border: 1px solid #030505; background-color:white; width:150px; text-align:center;"><strong>TIPO</strong></th>
                    <th style="border: 1px solid #030505; background-color:white; width:150px; text-align:center;"><strong>LINEA</strong></th>            
                    <th style="border: 1px solid #030505; background-color:white; width:150px; text-align:center;"><strong>PREDIO</strong></th>            
                    <th style="border: 1px solid #030505; background-color:white; width:126px; text-align:center;"><strong>CANTIDAD</strong></th>            
   </tr>
	</table>	
EOF;
            $pdf->writeHTML($bloque3, false, false, false, false, '');

            foreach ($repuestaBodega as $key => $value) {
                $chasis = $value["chasis"];
                $tipo = $value["tipoVehiculo"];
                $linea = $value["linea"];
                $predio = $value["predio"];
                $cantidad = 1;
                $fontLetra = "font-size:7px";
                $tdChasis = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:240px; ' . $fontLetra . ' text-align:left;">' . $chasis . '</td>';
                $tdTipo = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:150px; ' . $fontLetra . '">' . $tipo . '</td>';
                $tdLinea = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:150px; ' . $fontLetra . '">' . $linea . '</td>';
                $tdPredio = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:150px; ' . $fontLetra . '">' . $predio . '</td>';
                $tdCantidad = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:126px; ' . $fontLetra . ' ">' . $cantidad . '</td>';
                $bloque4 = <<<EOF
<table style="padding: 2px 5px; text-align:center;">
        <tr>
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
                if ($key + 1 == count($repuestaBodega)) {
                    $bloque3 = <<<EOF
	<table style="font-size:8px; text-align:center;">
 		<tr>
                    <th style="border: 1px solid #030505; background-color:white; width:690px;"><strong>TOTAL VEHICULOS INGRESADOS</strong></th>
                    <th style="border: 1px solid #030505; background-color:white; width:126px;"><strong>$cantidad</strong></th>
		</tr>
	</table>	
EOF;
                    $pdf->writeHTML($bloque3, false, false, false, false, '');
                }
            }
        } else {

            $bloque3 = <<<EOF
	<table style="font-size:8px;">
 		<tr>
                 <br/>
                    <th style="border: 1px solid #030505; background-color:white; text-align:center; width:570px;"><strong>DESCRIPCION DE MERCADERIA</strong></th>
                    <th style="border: 1px solid #030505; background-color:white; text-align:left; width:62px; text"><strong>POSICIONES</strong></th>
                       <th style="border: 1px solid #030505; background-color:white; text-align:left; width:62px; text"><strong>METROS</strong></th>

   <th style="border: 1px solid #030505; background-color:white; text-align:left; width:62px;"><strong>CANTIDAD</strong></th>

   
		</tr>
	</table>	
EOF;
            $pdf->writeHTML($bloque3, false, false, false, false, '');

//-------------------------------------------------------------------------------------------------------
            $repuestaDetalles = ControladorRegistroBodega::ctrTraerDatosBodega($codigo);

            if (count($repuestaDetalles) <= 3) {
                $fontLetra = "font-size:7px";
            } else if (count($repuestaDetalles) >= 4) {
                $fontLetra = "font-size:6px";
            }
            $posTotal = 0;
            $mtsTotal = 0;

            for ($i=0; $i<8; $i++){
                
                    $tdDetalle = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:570px; height:20px;' . $fontLetra . ' text-align:left; border-bottom: 1px solid #030505;">' . $nombreDetalle . '</td>';
                    $tdCantidadP = '<td style="text-align:center; border-right: 1px solid #030505; border-bottom: 1px solid #030505; height:20px; width:62px;' . $fontLetra . '">' . $posiciones . '</td>';
                    $tdCantidadM = '<td style="text-align:center; border-right: 1px solid #030505; border-bottom: 1px solid #030505; height:20px; width:62px;' . $fontLetra . '">' . $metros . '</td>';
                    $tdCantidad = '<td style="text-align:center; border-right: 1px solid #030505; border-bottom: 1px solid #030505; height:20px; width:62px;' . $fontLetra . '">' . $blts . '</td>';

                $bloque4 = <<<EOF
	<table style="padding: 2px 5px">
		<tr>
                
        		$tdDetalle
                        $tdCantidadP
                        $tdCantidadM
                        $tdCantidad
                        
		</tr>
	</table>	
EOF;
                $pdf->writeHTML($bloque4, false, false, false, false, '');

                
            }

//-------------------------------------------------------------------------------------------------------
            $bloque5 = <<<EOF
	<table style="font-size:8px;">
            <tr>
                <th style="border: 1px solid #030505; background-color:white; width:570px; text-align:center"><strong>TOTAL DE BULTOS INGRESADOS</strong></th>
                <th style="border: 1px solid #030505; background-color:white; width:62px; text-align:center"><strong></strong></th>
                <th style="border: 1px solid #030505; background-color:white; width:62px; text-align:center"><strong></strong></th>
                <th style="border: 1px solid #030505; background-color:white; width:62px; text-align:center"><strong></strong></th>
            </tr>
	</table>	

EOF;
            $pdf->writeHTML($bloque5, false, false, false, false, '');
        }
//-------------------------------------------------------------------------------------------------------

        $bloque3 = <<<EOF
	<table style="font-size:8px; text-align:left;">
      
	<tr><br/><br/><br/>
          <br/>
            <th style="border: 1px solid #030505; background-color:white; width:281px;"><strong>Piloto</strong></th>
            <th style="border: 1px solid #030505; background-color:white; width:141px;"><strong>Licencia</strong></th>
            <th style="border: 1px solid #030505; background-color:white; width:113px;"><strong>Placa</strong></th>
            <th style="border: 1px solid #030505; background-color:white; width:116px;"><strong>Contenedor</strong></th>
            <th style="border: 1px solid #030505; background-color:white; width:105px;"><strong>Marchamo</strong></th>
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
                $colPiloto = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; border-bottom: 1px solid #030505; width:281px; ' . $fontLetra . '">' . $piloto . '</td>';
                $colLic = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; border-bottom: 1px solid #030505; width:141px; ' . $fontLetra . '">' . $licencia . '</td>';
                $colPlaca = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; border-bottom: 1px solid #030505; width:113px; ' . $fontLetra . '">' . $placa . '</td>';
                $colContainer = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; border-bottom: 1px solid #030505; width:116px; ' . $fontLetra . '">' . $contenedor . '</td>';
                $marchamo = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; border-bottom: 1px solid #030505; width:105px; ' . $fontLetra . '">' . $marchamo . '</td>';
            } else {
                $colPiloto = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:281px; ' . $fontLetra . '">' . $piloto . '</td>';
                $colLic = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:141px; ' . $fontLetra . '">' . $licencia . '</td>';
                $colPlaca = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:113px; ' . $fontLetra . '">' . $placa . '</td>';
                $colContainer = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:116px; ' . $fontLetra . '">' . $contenedor . '</td>';
                $marchamo = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:105px; ' . $fontLetra . '">' . $marchamo . '</td>';
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
         * LEYENDA ALMACENADORAS RESPONSABILIDES INGRESO FISCAL 42 / 33 CALLE
         * 
         * 
         */


//-------------------------------------------------------------------------------------------------------

        $bloque8 = <<<EOF

       <table style="font-size:7px; border: none; padding: none; margin: none;"> <!-- Lo cambiaremos por CSS -->
	<tbody>

		<tr><br/>
                    <td colspan="2" style="width:736px; text-align:left;"><strong>Nota:</strong> <br/>El ingreso de la mercadería que se describe en el presente documento, implica la aceptación por parte del su propietario de que la misma se le entregará sin responsabilidad alguna de Almacenadora Integrada, Sociedad Anónima, al portador de la respectiva póliza de importación.<br/>
                La persona que ingrese la mercaderia a la Almacenadora es la responsable de obtener la autorización y aceptación del propietario para el ingreso de la misma. De no existir consentimiento del propietario, la responsabilidad sobre la mercadería recaerá en la persona que ingrese la mercaderia y en ningún caso en la Almacenadora.<br/>
                Almacenadora Integrada, S.A. no se responsabiliza de la merma, deterioro o destrucción de las mercancías derivadas de su propia naturaleza</td>
		</tr>
	</tbody>
        </table>
EOF;

        $pdf->writeHTML($bloque8, false, false, false, false, '');

        $pdf->OutPut('Sin título.pdf');
    }

}

$ingreso = new imprimirIngresoBodegaInforme();
$ingreso->codigo = $_GET["codigo"];
ob_start();
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
$ingreso->traerDatosIngresoInforme();
?>




