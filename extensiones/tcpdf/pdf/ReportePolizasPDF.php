<?php

require_once "../../../controlador/registroIngresoBodega.controlador.php";
require_once "../../../modelo/registroIngresoBodega.modelo.php";

require_once "../../../controlador/historiaIngresosFisacales.controlador.php";
require_once "../../../modelo/historiaIngresosFisacales.modelo.php";
require_once '../../../controlador/usuario.controlador.php';

class PDFReportQR {

    public $fecha;

    public function datosMostrarDatos() {
        // TRAER DATOS DE INGRESO
        $fecha = $this->fecha;
        $fechaVista = $fecha;
        session_start();
        $NavegaNumB = $_SESSION['idDeBodega'];

        $fecha = date("Y-m-d", strtotime($fecha));
        $datosReport = ControladorRegistroBodega::ctrdatosMostrarDatos($fecha, $NavegaNumB);
        $datosNoRegister = ControladorRegistroBodega::ctrdatosMostDatPolNoReg($fecha, $NavegaNumB);
        
            $nit = $datosReport[0]["nitMatriz"];
            $direccion = $datosReport[0]["direccionMatriz"];
            $telefono = $datosReport[0]["telefonoMatriz"];
            $email = $datosReport[0]["emailMatriz"];
            $logo = $datosReport[0]["logoMatriz"];
            $empresa = $datosReport[0]["empresaMatriz"];

            
        require_once('tcpdf_include.php');
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            // establecer datos de encabezado predeterminados
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Reporte de pólizas reportadas y no reportadas a sistema '.' '.$fechaVista, 'reporte de pólizas diarias');
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

        $pdf->AddPage('L', 'A4');
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetMargins(10, 15, 10);
        //---------------------------------------------------------------------------------------------------


        $bloque3 = <<<EOF
            <table style="font-size:8px;">
                    <tr>
                        <th style="border: 1px solid #030505; background-color:white; width:25px; text-align:center;"><strong>#</strong></th>
                        <th style="border: 1px solid #030505; background-color:white; width:50px; text-align:center;"><strong>NIT</strong></th>
                        <th style="border: 1px solid #030505; background-color:white; width:190px; text-align:center;"><strong>NOMBRE</strong></th>            
                        <th style="border: 1px solid #030505; background-color:white; width:60px; text-align:center;"><strong>Pol Ret</strong></th>            
                        <th style="border: 1px solid #030505; background-color:white; width:60px; text-align:center;"><strong>Pol Ing</strong></th>            
                        <th style="border: 1px solid #030505; background-color:white; width:260px; text-align:center;"><strong>LLAVE</strong></th>            
                        <th style="border: 1px solid #030505; background-color:white; width:120px; text-align:center;"><strong>LLAVE</strong></th>            

       </tr>
            </table>	
EOF;
        $pdf->writeHTML($bloque3, false, false, false, false, '');
        if ($datosReport!="SD") {
            $conatdor = 0;
            foreach ($datosReport as $key => $value) {
                $conatdor = $conatdor+1;
                
                $nit = $value["nitEmpresa"];
                $nombreEmpresa = $value["nombreEmpresa"];
                $nombreEmpresa = $value["nombreEmpresa"];
                $polizaRetiro = $value["polizaRetiro"];
                $numeroPoliza = $value["numeroPoliza"];
                $llave = $value["llave"];
                $nombres = $value["nombres"];
                if ($llave!="") {
                    
                }
                $bloque3 = <<<EOF
            <table style="font-size:7px;">
                    <tr>
                        <th style="border-right: 1px solid #030505; border-left: 1px solid #030505; border-bottom: none; background-color:white; width:25px; text-align:center;">$conatdor</th>
                        <th style="border-right: 1px solid #030505; border-bottom: none; background-color:white; width:50px; text-align:center;">$nit</th>
                        <th style="border-right: 1px solid #030505; border-bottom: none; background-color:white; width:190px; text-align:center;">$nombreEmpresa</th>            
                        <th style="border-right: 1px solid #030505; border-bottom: none; background-color:white; width:60px; text-align:center;">$polizaRetiro</th>            
                        <th style="border-right: 1px solid #030505; border-bottom: none; background-color:white; width:60px; text-align:center;">$numeroPoliza</th>            
                        <th style="border-right: 1px solid #030505; border-bottom: none; background-color:white; width:260px; text-align:left;">$llave</th>            
                     <th style="border-right: 1px solid #030505; border-bottom: none; background-color:white; width:120px; text-align:center;">$nombres</th>            

   </tr>
            </table>	
EOF;
        $pdf->writeHTML($bloque3, false, false, false, false, '');
                
            }
            
        }
        $bloque3 = <<<EOF
            <table style="font-size:8px;">
                    <tr>
                        <th style="border-top: 2px solid #030505; background-color:white; width:25px; text-align:center;"><strong></strong></th>
                        <th style="border-top: 2px solid #030505; background-color:white; width:50px; text-align:center;"><strong></strong></th>
                        <th style="border-top: 2px solid #030505; background-color:white; width:190px; text-align:center;"><strong></strong></th>            
                        <th style="border-top: 2px solid #030505; background-color:white; width:60px; text-align:center;"><strong></strong></th>            
                        <th style="border-top: 2px solid #030505; background-color:white; width:60px; text-align:center;"><strong></strong></th>            
                        <th style="border-top: 2px solid #030505; background-color:white; width:260px; text-align:center;"><strong></strong></th>            
                        <th style="border-top: 2px solid #030505;background-color:white; width:120px; text-align:center;"><strong></strong></th>            

       </tr>
            </table>	
EOF;
        $pdf->writeHTML($bloque3, false, false, false, false, '');
        if ($datosNoRegister!="SD") {
                    $bloque3 = <<<EOF
            <table style="font-size:8px;">
                    <tr>
                        <th style="border: 1px solid #030505; background-color:white; width:25px; text-align:center;"><strong>#</strong></th>
                        <th style="border: 1px solid #030505; background-color:white; width:50px; text-align:center;"><strong>NIT</strong></th>
                        <th style="border: 1px solid #030505; background-color:white; width:190px; text-align:center;"><strong>NOMBRE</strong></th>            
                        <th style="border: 1px solid #030505; background-color:white; width:60px; text-align:center;"><strong>Pol Ret</strong></th>            
                        <th style="border: 1px solid #030505; background-color:white; width:60px; text-align:center;"><strong>Pol Ing</strong></th>            
                        <th style="border: 1px solid #030505; background-color:white; width:260px; text-align:center;"><strong>LLAVE</strong></th>            
                        <th style="border: 1px solid #030505; background-color:white; width:120px; text-align:center;"><strong>LLAVE</strong></th>            

       </tr>
            </table>	
EOF;
        $pdf->writeHTML($bloque3, false, false, false, false, '');

            $conatdor = 0;
            foreach ($datosNoRegister as $key => $value) {
                $conatdor = $conatdor+1;
                
                $nit = $value["nitEmpresa"];
                $nombreEmpresa = $value["nombreEmpresa"];
                $nombreEmpresa = $value["nombreEmpresa"];
                $polizaRetiro = $value["polizaRetiro"];
                $numeroPoliza = $value["numeroPoliza"];
                $llave = $value["llave"];
                $nombres = $value["nombres"];
                if ($llave!="") {
                    
                }
                $bloque3 = <<<EOF
            <table style="font-size:7px;">
                    <tr>
                        <th style="border-right: 1px solid #030505; border-left: 1px solid #030505; border-bottom: none; background-color:white; width:25px; text-align:center;">$conatdor</th>
                        <th style="border-right: 1px solid #030505; border-bottom: none; background-color:white; width:50px; text-align:center;">$nit</th>
                        <th style="border-right: 1px solid #030505; border-bottom: none; background-color:white; width:190px; text-align:center;">$nombreEmpresa</th>            
                        <th style="border-right: 1px solid #030505; border-bottom: none; background-color:white; width:60px; text-align:center;">$polizaRetiro</th>            
                        <th style="border-right: 1px solid #030505; border-bottom: none; background-color:white; width:60px; text-align:center;">$numeroPoliza</th>            
                        <th style="border-right: 1px solid #030505; border-bottom: none; background-color:white; width:260px; text-align:center;">$llave</th>            
                     <th style="border-right: 1px solid #030505; border-bottom: none; background-color:white; width:120px; text-align:center;">$nombres</th>            

   </tr>
            </table>	
EOF;
        $pdf->writeHTML($bloque3, false, false, false, false, '');
                
            }
            
        }
        $bloque3 = <<<EOF
            <table style="font-size:8px;">
                    <tr>
                        <th style="border-top: 2px solid #030505; background-color:white; width:25px; text-align:center;"><strong></strong></th>
                        <th style="border-top: 2px solid #030505; background-color:white; width:50px; text-align:center;"><strong></strong></th>
                        <th style="border-top: 2px solid #030505; background-color:white; width:190px; text-align:center;"><strong></strong></th>            
                        <th style="border-top: 2px solid #030505; background-color:white; width:60px; text-align:center;"><strong></strong></th>            
                        <th style="border-top: 2px solid #030505; background-color:white; width:60px; text-align:center;"><strong></strong></th>            
                        <th style="border-top: 2px solid #030505; background-color:white; width:260px; text-align:center;"><strong></strong></th>            
                        <th style="border-top: 2px solid #030505; background-color:white; width:120px; text-align:center;"><strong></strong></th>            

       </tr>
            </table>	
EOF;
        $pdf->writeHTML($bloque3, false, false, false, false, '');

        
        $pdf->OutPut('Sin título.pdf');
    }

}

$fecha = new PDFReportQR();
$fecha->fecha = $_GET["fecha"];
ob_start();
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
$fecha->datosMostrarDatos();
?>
