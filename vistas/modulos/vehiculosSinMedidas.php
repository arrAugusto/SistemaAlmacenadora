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
        </div><!-- /.container-fluid -->
    </section>
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h5 class="card-title">Parametrizar Almacenajes</h5>
            </div>
            <form role="form" method="post">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <table id="tablas" role="grid" class="table dt-responsive table-striped table-hover table-sm" >
                                <thead>
                                    <tr>
                                    <th style="width:3px;">#</th>
                                    <th>Tipo de Vehículo</th>
                                    <th>Linea de Vehículo</th>
                                    <th>Agregar Medida</th>
                                    </tr>
                                </thead> <tbody>
                                    <?php
                                    $respuesta = ControladorVehiculosSinMedidas::ctrMostrarVehSinMedida();
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-8">
                            <div class="card card-warning">
                                <div class="card-header">
                                    <h5 class="card-title" id="titleMedidas">Medidas de vehiculos</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <label>Largo Metros</label>
                                            <input type="number" class="form-control" id="largoMts" value="" />
                                        </div>
                                        <div class="col-6">
                                            <label>Ancho Metros</label>
                                            <input type="number" class="form-control" id="anchoMts" value="" />
                                        </div>
                                        <div class="col-6">
                                            <label>Retrovisor izquierdo</label>
                                            <input type="number" class="form-control" id="retrovisorIZ" value="" />
                                        </div>
                                        <div class="col-6">
                                            <label>Retrovisor derecho</label>
                                            <input type="number" class="form-control" id="retrovisorDer" value="" />
                                        </div>                                            
                                        <div class="col-6">
                                            <label>Espacio frontal</label>
                                            <input type="number" class="form-control" id="espacioFrontal" value="" />
                                        </div>
                                        <div class="col-6">
                                            <label>Espacio lateral</label>
                                            <input type="number" class="form-control" id="espacioLateral" value="" />
                                        </div>  
                                    </div>
                                    <div class="card-footer mt-4">
                                        <div class="row">
                                            <div class="col-12">
                                                <button type="button" class="btn btn-success btnGMedidas">Guardar Medidas de vehículo</button>
                                            </div>
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
