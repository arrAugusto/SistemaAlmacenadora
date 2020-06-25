<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>CONTABILIDAD</h1>
                </div>
                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="Inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Procesos Pendientes</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="col-md-12">
        <div class="card card-info card-outline">


            <form role="form" method="post">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3 mt-4">

                            <div class="input-group">
                                <input type="text" id="dateTimeConta" class="form-control">
                                <input type="hidden" id="hiddenDateTime" value="<?php
                                date_default_timezone_set('America/Guatemala');
                                echo date('Y-m-d');
                                ?>">
                                <span class="input-group-append">
                                    <button type="button" class="btn btn-info btn-flat btnGenerarPolizaContable">Generar Poliza</button>
                                </span>
                            </div>
                        </div>
                        <div class="col-12 mt-4">
                            <div class="invoice p-3 mb-3">
                                <!-- title row -->
                                <div class="row">

                                </div>
                                <!-- info row -->
                                <div class="row invoice-info">
                                    <div class="col-sm-12 invoice-col">

                                        <address>
                                            <div class="col-12 mx-auto">


                                        </address>
                                    </div>

                                </div>
                                <!-- /.row -->

                                <!-- Table row -->
                                <div class="row">
                                    <div class="col-md-12 col-lg-9 wrapper-iframe">
                                        <h4 class="text-center">ALMACENADORA INTEGRADA, S.A.<br/>PÓLIZAS DE MERCADERÍAS SEGUN REPORTES ADJUNTOS DEL DÍA</h4>
                                        <table class="table col-12">
                                            <thead class="table-primary">
                                                <tr>
                                                <th scope="col">CUENTA</th>
                                                <th scope="col">NOMBRE DE CUENTA</th>
                                                <th scope="col">DEBE</th>
                                                <th scope="col">HABER</th>
                                                </tr>
                                            </thead>
                                                                                <?php
                                    $respuesta = ControladorGenerarContabilidad::ctrMostrarContabilidad();
                                    ?>


                                        </table>


                                    </div>
                                </div>

                                <!-- /.row -->

                                <!-- this row will not appear when printing -->
                                <div class="row no-print">
                                    <div class="col-12">
                                        <button type="button" class="btn btn-primary float-left" style="margin-right: 5px;">
                                            <i class="fa fa-floppy-o"></i> Contabilizar
                                        </button>
                                        <a href="invoice-print.html" target="_blank" class="btn btn-default float-right"><i class="fas fa-print"></i> Imprimir</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
