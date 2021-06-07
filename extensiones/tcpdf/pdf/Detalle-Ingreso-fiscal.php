<?php

require_once "../../../controlador/registroIngresoBodega.controlador.php";
require_once "../../../modelo/registroIngresoBodega.modelo.php";

require_once "../../../controlador/historiaIngresosFisacales.controlador.php";
require_once "../../../modelo/historiaIngresosFisacales.modelo.php";

class imprimirIngresoBodega {

    public $codigo;

    public function traerDatosIngreso() {
// TRAER DATOS DE INGRESO
        $codigo = $this->codigo;

        $repuestaOperaciones = ControladorRegistroBodega::ctrTraerDatosOperaciones($codigo);

        $cadena = ControladorRegistroBodega::ctrCadenaVinculo($codigo);

        $servicio = $repuestaOperaciones[0]["servicioIng"];
        if ($servicio == "VEHICULOS NUEVOS") {
            $repuestaOpera = ControladorRegistroBodega::ctrTraerDatosBodegas($codigo, $tipo);
            $nomElab = $repuestaOpera[0]["nombres"];
            $apellElab = $repuestaOpera[0]["apellidos"];
            $tipo = 0;

            $repuestaBod = ControladorRegistroBodega::ctrTraerDatosBodegas($codigo, $tipo);
            $nomBod = $repuestaBod[0]["nombres"];
            $apellBod = $repuestaBod[0]["apellidos"];
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

        //datos de logos
        //datos de forma
        $nit = $repuestaOperaciones[0]["nitAlm"];
        $direccion = $repuestaOperaciones[0]["direAlm"];
        $telefono = $repuestaOperaciones[0]["telAlm"];
        $email = $repuestaOperaciones[0]["emailAlm"];
        $logo = $repuestaOperaciones[0]["logoAlm"];
        $empresa = $repuestaOperaciones[0]["empresaInterna"];

        require_once('tcpdf_include.php');
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->AddPage('L', 'A4');
        if ($cadena != "SD") {
            $concatenarConsultImagen = "../../imagenesQRCreadas/qrCode" . $cadena[0]["idIngOp"] . $cadena[0]["numeroPoliza"] . $cadena[0]["placa"] . ".png";
        } else {
            $concatenarConsultImagen = "../../imagenesQRCreadas/qrCode" . $idIngreso . $poliza . $numPlaca . ".png";
        }
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
                            NIT: $nit
                            <br/>
                            $direccion 
                            <br/>
                            Teléfono: $telefono
                            <br/>
                            Email: $email
                        </td>
		</tr>
	</table>
        <table style="padding:3px; border: none; padding: none; margin: none;">
            <tr>
                
                <td style="width:610px; text-align:center; font-size:17px; font-family: 'Source Sans Pro';">Informe recepción de $titulo</td>
                <td style="background-color:white; width:146px; text-align:center; color:red; text-align:rigth; font-size:10px;">Ingreso No.<br/>$numAsigIng</td>
            </tr>
        </table><br/><br/>
EOF;
        $pdf->writeHTML($bloque1, false, false, false, false, PDF_HEADER_STRING);
//-------------------------------------------------------------------------------------------------------

        $bloque2 = <<<EOF
	<table style="font-size:7.5px; border: none; padding: none; margin: none;">
                <tr>
                    <td style="width:75px;"><b>Empresa :</b></td><td style="width:350px;">$numeroNit&nbsp;&nbsp;</td>
                    <td style="width:90px;"></td><td style="width:301px;"></td>    
                </tr>
                <tr>
                    <td style="width:75px"><b>Nit:</b></td><td style="width:350px">$nombreEmpresa</td>
                    <td style="width:90px"></td><td style="width:301px"></td>
                </tr>
                <tr>
                    <td style="width:75px"><b>Bodega No.:</b></td><td style="width:350px">$numeroArea</td>
                    <td style="width:90px"><b>Póliza :</b></td><td style="width:301px">$poliza</td>
                </tr>
                <tr>
                    <td style="width:75px"><b>Elaborado por:</b></td><td style="width:350px">$nomElab $apellElab&nbsp;&nbsp;</td>
                    <td style="width:90px"><b>Fecha Garita :</b></td><td style="width:301px">$fechaGaritaFormat&nbsp;&nbsp;</td>
                </tr>
                <tr>
                   <td style="width:75px"><b>Descargado por:</b></td><td style="width:350px">$nomBod $apellBod</td>
                    <td style="width:90px"><b>Fecha emisión :</b></td><td style="width:301px">$cadenaEmisionFormat</td>
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
                    <th style="border: 1px solid #030505; background-color:white; width:300px; text-align:center;"><strong>CHASIS VEHICULO</strong></th>
                    <th style="border: 1px solid #030505; background-color:white; width:114px; text-align:center;"><strong>TIPO</strong></th>
                    <th style="border: 1px solid #030505; background-color:white; width:114px; text-align:center;"><strong>LINEA</strong></th>            
                    <th style="border: 1px solid #030505; background-color:white; width:114px; text-align:center;"><strong>PREDIO</strong></th>            
                    <th style="border: 1px solid #030505; background-color:white; width:114px; text-align:center;"><strong>CANTIDAD</strong></th>            
   </tr></table>	
EOF;
            $pdf->writeHTML($bloque3, false, false, false, false, '');

            foreach ($repuestaBodega as $key => $value) {
                $chasis = $value["chasis"];
                $tipo = $value["tipoVehiculo"];
                $linea = $value["linea"];
                $predio = $value["predio"];
                $cantidad = 1;
                $fontLetra = "font-size:7px";
                $tdChasis = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:300px; ' . $fontLetra . ' text-align:left;">' . $chasis . '</td>';
                $tdTipo = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:114px; ' . $fontLetra . '">' . $tipo . '</td>';
                $tdLinea = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:114px; ' . $fontLetra . '">' . $linea . '</td>';
                $tdPredio = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:114px; ' . $fontLetra . '">' . $predio . '</td>';
                $tdCantidad = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:114px; ' . $fontLetra . ' ">' . $cantidad . '</td>';
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
                    <th style="border: 1px solid #030505; background-color:white; width:642px;"><strong>TOTAL VEHICULOS INGRESADOS</strong></th>
                    <th style="border: 1px solid #030505; background-color:white; width:114px;"><strong>$cantidad</strong></th>
		</tr>
	</table>	
EOF;
                    $pdf->writeHTML($bloque3, false, false, false, false, '');
                }
            }

            $bloque3 = <<<EOF
	<table style="font-size:8px;">
 		<tr>
                 <br/>
                    <th style="border: 1px solid #030505; background-color:white; width:300px; text-align:center;"><strong>VEHÍCULOS CON INCIDENCIA</strong></th>
                    <th style="border: 1px solid #030505; background-color:white; width:300px; text-align:center;"><strong>DAÑOS O AVERÍAS</strong></th>            
   </tr></table>	
EOF;
            $pdf->writeHTML($bloque3, false, false, false, false, '');
            
            foreach ($repuestaBodega as $key => $value) {
                $chasis = $value["chasis"];
                $tipo = $value["comentario"];
                if (!empty($tipo)){
                $fontLetra = "font-size:7px";
                $tdChasis = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:300px; ' . $fontLetra . ' text-align:left;">' . $chasis . '</td>';
                $tdTipo = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:300px; ' . $fontLetra . '">' . $tipo . '</td>';
                $bloque4 = <<<EOF
<table style="padding: 2px 5px; text-align:center;">
        <tr>
            $tdChasis
            $tdTipo
        </tr>
</table>	
EOF;
                $pdf->writeHTML($bloque4, false, false, false, false, '');
    }       
}
            $bloque4 = <<<EOF
<table style="padding: 2px 5px; text-align:center;">
        <tr>
                    <th style="border-top: 1px solid #030505; background-color:white; width:300px;"><strong></strong></th>
                    <th style="border-top: 1px solid #030505; background-color:white; width:300px;"><strong></strong></th>
        </tr>
</table>	
EOF;
            $pdf->writeHTML($bloque4, false, false, false, false, '');
        } else {

            $bloque3 = <<<EOF
	<table style="font-size:8px;">
 		<tr>
                 <br/>
                    <th style="border: 1px solid #030505; background-color:white; width:570px; text-align:center;"><strong>DESCRIPCION DE MERCADERIA</strong></th>
                    <th style="border: 1px solid #030505; background-color:white; width:62px;"><strong>POSICIONES</strong></th>
                    <th style="border: 1px solid #030505; background-color:white; width:62px;"><strong>METROS</strong></th>
                    <th style="border: 1px solid #030505; background-color:white; width:62px;"><strong>CANTIDAD</strong></th>
                    
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
            foreach ($repuestaDetalles as $key => $value) {
                $idInc = $value["idIncidencia"];
                $repPOSM = ControladorRegistroBodega::ctrMostrarPosMetros($idInc);
                $nombreEmpresa = $value["nombreEmpresa"];
                $detalleMerca = $value["detalleMerca"];
                $posiciones = $repPOSM[0]["posiciones"];
                $metros = $repPOSM[0]["metraje"];
                $posTotal = $posTotal + $posiciones;
                $mtsTotal = $mtsTotal + $metros;
                $llave = count($repuestaDetalles);
                $nombreDetalle = $nombreEmpresa . " - " . $detalleMerca;
                $blts = $value["blts"];
                $tdDetalleS = "";
                $tdDetalle = "";
                $tdCantidadS = "";
                $tdCantidad = "";
                $linea = 0;
                if ($key + 1 == $llave) {
                    $tdDetalle = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; border-bottom: 1px solid #030505; width:570px; ' . $fontLetra . ' text-align:left;">' . $nombreDetalle . '</td>';
                    $tdCantidadP = '<td style="text-align:center; border-right: 1px solid #030505; border-bottom: 1px solid #030505; width:62px; ' . $fontLetra . '">' . $posiciones . '</td>';
                    $tdCantidadM = '<td style="text-align:center; border-right: 1px solid #030505; width:62px;' . $fontLetra . '">' . $metros . '</td>';
                    $tdCantidad = '<td style="text-align:center; border-right: 1px solid #030505; width:62px;' . $fontLetra . '">' . $blts . '</td>';
                } else {

                    $tdDetalle = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:570px; ' . $fontLetra . ' text-align:left;">' . $nombreDetalle . '</td>';
                    $tdCantidadP = '<td style="text-align:center; border-right: 1px solid #030505; width:62px;' . $fontLetra . '">' . $posiciones . '</td>';
                    $tdCantidadM = '<td style="text-align:center; border-right: 1px solid #030505; width:62px;' . $fontLetra . '">' . $metros . '</td>';
                    $tdCantidad = '<td style="text-align:center; border-right: 1px solid #030505; width:62px;' . $fontLetra . '">' . $blts . '</td>';
                }

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
                <th style="border: 1px solid #030505; background-color:white; width:62px; text-align:center"><strong>$posTotal</strong></th>
                <th style="border: 1px solid #030505; background-color:white; width:62px; text-align:center"><strong>$mtsTotal</strong></th>
                <th style="border: 1px solid #030505; background-color:white; width:62px; text-align:center"><strong>$bultosTotal</strong></th>
            </tr>
	</table>	

EOF;
            $pdf->writeHTML($bloque5, false, false, false, false, '');
        }
//-------------------------------------------------------------------------------------------------------

        $bloque3 = <<<EOF
	<table style="font-size:8px; text-align:left;">
      
	<tr>
          <br/>
            <th style="border: 1px solid #030505; background-color:white; width:291px;"><strong>Piloto</strong></th>
            <th style="border: 1px solid #030505; background-color:white; width:121px;"><strong>Licencia</strong></th>
            <th style="border: 1px solid #030505; background-color:white; width:124px;"><strong>Placa</strong></th>
            <th style="border: 1px solid #030505; background-color:white; width:120px;"><strong>Contenedor</strong></th>
            <th style="border: 1px solid #030505; background-color:white; width:100px;"><strong>Marchamo</strong></th>
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
                $colPiloto = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; border-bottom: 1px solid #030505; width:291px; ' . $fontLetra . '">' . $piloto . '</td>';
                $colLic = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; border-bottom: 1px solid #030505; width:121px; ' . $fontLetra . '">' . $licencia . '</td>';
                $colPlaca = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; border-bottom: 1px solid #030505; width:124px; ' . $fontLetra . '">' . $placa . '</td>';
                $colContainer = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; border-bottom: 1px solid #030505; width:120px; ' . $fontLetra . '">' . $contenedor . '</td>';
                $marchamo = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; border-bottom: 1px solid #030505; width:100px; ' . $fontLetra . '">' . $marchamo . '</td>';
            } else {
                $colPiloto = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:291px; ' . $fontLetra . '">' . $piloto . '</td>';
                $colLic = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:121px; ' . $fontLetra . '">' . $licencia . '</td>';
                $colPlaca = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:124px; ' . $fontLetra . '">' . $placa . '</td>';
                $colContainer = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:120px; ' . $fontLetra . '">' . $contenedor . '</td>';
                $marchamo = '<td style="border-left: 1px solid #030505; border-right: 1px solid #030505; width:100px; ' . $fontLetra . '">' . $marchamo . '</td>';
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


        $pdf->OutPut('Sin título.pdf');
    }

}

$ingreso = new imprimirIngresoBodega();
$ingreso->codigo = $_GET["codigo"];
ob_start();
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
$ingreso->traerDatosIngreso();
?>
