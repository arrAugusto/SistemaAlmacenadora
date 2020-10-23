<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Historial de ingresos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="Inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Procesos Pendientes</li>
                    </ol>
                </div>
            </div>
            <div class="card card-info card-outline">
                <form role="form" method="post">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 mt-2">
                                <button type="button" class="btn btn-outline-success btn-lg btn-block btnExcelChasis"  estadoRep="4">GENERAR HISTORIAL DE CHASIS EXCEL <i class="fa fa-file-excel-o"></i></button>
                            </div>   
                            <div class="col-12 mt-5">
                                <table id="tableHistorialDataExtra" role="grid" class="table dt-responsive table-striped table-hover table-sm">
                                    <thead>
                                        <tr>
                                        <th style="width:3px;">#</th>
                                        <th>Nit</th>
                                        <th style="width:400px;">Empresa</th>
                                        <th style="width:100px;">Fecha Ing</th>
                                        <th>Póliza No.</th>
                                        <th>Bultos</th>
                                        <th>Peso</th>         
                                        <th>Chasis</th>
                                        <th>Descripción</th>

                                        <th><center>Acciones</center></th>
                                        </tr>
                                    </thead> 
                                </table>
                            
                            </div>  
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.container-fluid -->
    </section>