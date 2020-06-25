
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Menú Principal</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->


        <div class="col-md-12">
            <div class="card card-success">
                <div class="card-header">
                    <h5 class="card-title">Parametrizar almacenajes con tarifas normales</h5>
                </div>
                <form role="form" method="post">
                    <div class="card-body">
                        <div class="row">
                            <div class="    col-md-12">
                                <div class="input-group">

                                    <button type="button" class="btn btn-default" id="daterange-btn2">

                                        <span>
                                            <i class="fa fa-calendar"></i> Rango de fecha
                                        </span>

                                        <i class="fa fa-caret-down"></i>

                                    </button>

                                </div>
                            </div>

                            <br>
                            <br>
                            <br><br>

                            <div class="col-md-12" id="tableDinamicIngBod">

                                <!-- form start -->
                                <form class="form-horizontal" method="post">
                                    <div class="card-body">
                                        <!--- =======================
                                        INICIO
                                        ======================-->
                                        <div class="box-body">

                                            <table id="tablas" role="grid" class="table  dt-responsive    nowrap table-striped table-bordered display" cellspacing="0" >
                                                <thead style="background-color: #1e88e5;color: white; font-weight: bold;">
                                                    <tr>
                                                    <th style="whidth:5px">#</th>

                                                    <th>Nit</th>

                                                    <th>Empresa</th>
                                                    <th>Ingreso</th>
                                                    <th>Poliza</th>
                                                    <th>FechaOp</th>
                                                    <th>Bultos</th>
                                                    <th>Cif</th>
                                                    <th>Impuestos</th>
            <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if (isset($_GET["fechaInicial"])) {
                                                        $fechaInicial = $_GET["fechaInicial"];
                                                        $fechaFinal = $_GET["fechaFinal"];
                                                    } else {
                                                        $fechaInicial = null;
                                                        $fechaFinal = null;
                                                    }

                                                    $respuesta = ControladorIngBodHistorial::ctrMostrarIngresos($fechaInicial, $fechaFinal);


                                                    if ($respuesta!==null) {


                                                    foreach ($respuesta as $key => $value) {
$fecha_actual = new DateTime();
$cadena_fecha_actual = $value["fRegistro"]->format("d/m/Y");

                                                        echo '
                                     <tr>
                                     <td>' . ($key + 1) . '</td>
                                     <td>' . ($respuesta[$key]["nit"]) . '</td>
                                     <td>' . ($respuesta[$key]["empresa"]) . '</td>
                                     <td>' . ($respuesta[$key]["ingreso"]) . '</td>
                                     <td>' . ($respuesta[$key]["poliza"]) . '</td>
                                     <td>' . ($cadena_fecha_actual) . '</td>

                                     <td>' . ($respuesta[$key]["blts"]) . '</td>
                                     <td>' . ($respuesta[$key]["cif"]) . '</td>
                                     <td>' . ($respuesta[$key]["impts"]) . '</td>
                                    <td>'.'<button type="button" buttonid='.$respuesta[$key]["ident"].' class="btn bg-info-gradient bntImprimir"><i class="fa fa-print"></i> </button>'.'</td>



                                                                        '
                                                        ;
                                                    }
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>

                                                    </div>
                                                    </div>

                                                    </div>
                                                    </div>
                                                    </form>

                                                    </div>
                                                    </div>

                                                    </section>
