
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Medidas de vehiculos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="Inicio">Inicio</a></li>
                    </ol>
                </div>

            </div>
            <div class="card card-info card-outline">

                <form role="form" method="post">
                    <div class="card-body">
                        <div class="row">
        
                            <div class="col-12 p-3">
                                <table id="tablas" role="grid" class="table dt-responsive table-sm table-hover" cellspacing="0" > <thead>
                                        <tr>
                                        <th style="whidth:5px">#</th>
                                        <th>Tipo Vehiculo</th>
                                        <th>Linea</th>
                                        <th>Largo mt</th>
                                        <th>Ancho mt</th>
                                        <th>retrovisor mt</th>
                                        <th>Lateral mt</th>
                                        <th>Frontal mt</th>
                                        </tr>
                                    </thead> <tbody>
                                        <?php
                                        $respuesta = ControladorMedidasVehiculos::ctrMostrarListadoVehiMedidas();
                                     
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
<!-- Modal -->
<div class="modal fade" id="modalRebajaMercaOp" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h3 id="modalRebajaMercaOpStock"></h3>
                <button type="button" class="close" data-dismiss="modal" id="cerrarMinModal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">

                    <div class="col-12" id="tableMostrarEmpresa">

                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
