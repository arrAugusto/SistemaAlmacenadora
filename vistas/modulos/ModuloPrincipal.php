<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Almacenadoras Unidas</title>

        <!-- Diseño responsivo para trabajar los puntos de quiebre -->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!--======================
        PLUGIN DE CSS
        ========================== -->

        <!-- Font Awesome -->
        <link rel="stylesheet" href="vistas/plugins/font-awesome/css/font-awesome.min.css">



        <!-- Tema de plantilla -->
        <link rel="stylesheet" href="vistas/dist/css/adminlte.min.css?n=1">
        <!-- Fuente Google:  -->
        <link href="vistas/dist/font.html">

        <!-- sweetalert2 css:  -->
        <link rel="stylesheet" href="vistas/dist/css/weetalert2css/weetalert2.css">
        <!-- DataTables -->
        <link rel="stylesheet" href="vistas/plugins/datat/datatable/css/responsivedata.min.css">
        <!-- DataTables -->
        <link rel="stylesheet" href="vistas/plugins/datatables/dataTables.bootstrap4.min.css">
        <!-- estulos for checkboxes and radio inputs -->
        <link rel="stylesheet" href="vistas/dist/css/estilos.css">
        <link rel="stylesheet" href="vistas/dist/css/autocompletar.css">
        <!-- Select2 -->
        <link rel="stylesheet" href="vistas/plugins/select2/select2.min.css">
        <!-- bootstrap datepicker -->   
        <link rel="stylesheet" href="vistas/plugins/datepicker/bootstrap-datepicker.min.css">
        <!-- bootstrap daterangepicker -->
        <link rel="stylesheet" type="text/css" href="vistas/plugins/daterangepicker/daterangepicker.css">
        <link rel="stylesheet" type="text/css" href="vistas/build/datetimepicker/jquery.datetimepicker.min.css">
        <!-- Alerts Especiales y dinamicas -->
        <link rel="stylesheet" type="text/css" href="vistas/dist/css/toastr.min.css">


        <!--======================
        PLUGIN DE JAVASCRIPT
        ========================== -->
        <!-- jQuery -->
        <script src="vistas/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="vistas/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="vistas/dist/js/adminlte.min.js"></script>
        <!-- sweetalert2  -->
        <script src="vistas/plugins/sweetalert2/sweetalert2.all.js"></script>
        <!-- DataTables -->
        <script type="text/javascript" src="vistas/plugins/datat/datatable/js/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="vistas/plugins/datat/datatable/js/dataTables.responsive.min.js"></script>
        <script src="vistas/plugins/datat/datatable/js/jquery.dataTables.min.js"></script>
        <script src="vistas/plugins/datatables/dataTables.bootstrap4.min.js"></script>
        <script src="vistas/plugins/datat/datatable/js/responsive.dataTables.min.js"></script>
        <script src="vistas/plugins/datatables/dataTables.bootstrap4.min.js"></script>
        <script src="vistas/js/bootstrap-datepicker.min.js"></script>
        <!-- js de almacenadora integrada -->
        <script type="text/javascript" src="vistas/js/mapeoBodega.js"></script>
        <script src="vistas/js/dateParams.js"></script>
        <script src="vistas/js/usuario.js"></script>
        <script src="vistas/js/masRubros.js"></script>
        <script src="vistas/js/gestorDeTarifas.js"></script>
        <script src="vistas/js/ingBodHistorial.js"></script>
        <script src="vistas/js/detalleMercaderia.js"></script>
        <script src="vistas/js/parametrizarAlmacenaje.js"></script>
        <script src="vistas/js/activarOtrosServicios.js"></script>
        <script src="vistas/js/parametrizarTarifaNormal.js"></script>
        <script src="vistas/js/operacionesBIngreso.js"></script>
        <script src="vistas/js/plantilla.js"></script>
        <script src="vistas/js/agregarDetallesIngresos.js"></script>
        <script src="vistas/js/historiaIngresosFisacales.js"></script>
        <script src="vistas/js/historialCalculos.js"></script>
       <script src="vistas/js/configuracion.js"></script>
        <script src="vistas/js/activarTarifa.js"></script>
        <script src="vistas/js/ubicacionBodega.js"></script>
        <script src="vistas/js/retiroOpe.js"></script>
        <script src="vistas/js/retirosBod.js"></script>
        <script src="vistas/js/calcAlmacenajeF.js"></script>
        <script src="vistas/js/clientesSinTarifa.js"></script>
        <script src="vistas/js/paseDeSalida.js"></script>
        <script src="vistas/js/calculoDeAlmacenaje.js"></script>
        <script src="vistas/js/validateNit.js"></script>
        <script src="vistas/js/validateCUI.js"></script>
        <script src="vistas/js/inventario.js"></script>
        <script src="vistas/js/ingPendientesC.js"></script>
        <script src="vistas/js/polizasDiarias.js"></script>
        <script src="vistas/js/vehiculosSinMedidas.js"></script>
        <script src="vistas/js/retiroVeh.js"></script>
        <script src="vistas/js/contabilidadRetiro.js"></script>
        <script src="vistas/js/nuevasEmpresas.js"></script>
       <script src="vistas/js/sldDiarioContabilidad.js"></script>
        
        <!-- iCheck 1.0.1 -->
        <script src="vistas/dist/js/dataTables.bootstrap.js"></script><script src="vistas/dist/js/responsive.bootstrap.min.js"></script>
        <!-- iCheck 1.0.1 -->
        <script src="vistas/plugins/iCheck/icheck.min.js"></script>
        <!-- Select2 -->
        <script src="vistas/plugins/select2/select2.full.min.js"></script>
        <script type="text/javascript" src="vistas/plugins/daterangepicker/moment.js"></script>
        <script type="text/javascript" src="vistas/plugins/daterangepicker/daterangepicker.js"></script>
        <script type="text/javascript" src='vistas/dist/js/bootstrap-datetimepicker.min.js'></script>
        <script type="text/javascript" src='vistas/dist/js/jquerynumber.min.js'></script>
        <script type="text/javascript" src='vistas/dist/js/bootstrapValidator.min.js'></script>
        
        <script type="text/javascript" src="vistas/dist/js/toastr.min.js"></script>
        <!--
        SCRIPT DESCATADOS PORQUE CONSUMEN INTERNET EN EL SERVIDOR
        <script type="text/javascript" src='vistas/dist/js/kit.fontawesome.js'></script>
       
        <script type="text/javascript" src="vistas/dist/js/font-awesome.js"></script> 
       -->
        
        
    </head>
    <body class="hold-transition sidebar-collapse sidebar-mini">
        <div class="wrapper">
