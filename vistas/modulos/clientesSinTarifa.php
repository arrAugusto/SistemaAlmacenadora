<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Calculos Fiscales</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="Inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Procesos Pendientes</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <div class="col-md-12">
        <div class="card card-primary card-outline">

            <form role="form" method="post">
                <div class="card-body">
                    <div class="row">
                        <div id="divInfo" class="col-12">
                        </div>
                        <div id="divBottons" class="col-12">
                        </div>
                        <div id="detalleCalculo" class="col-12">
                        </div>
                        <div id="divHiddenTotales">
                        </div>
                    </div>
                    <div class="col-12">

                        <table id="tablasGeneral" role="grid" class="table  dt-responsive nowrap table-striped table-bordered display table-sm" cellspacing="0" >
                            <thead>
                                <tr>
                                <th style="whidth:5px">#</th>
                                <th>Nit</th>
                                <th style="width: 250px;">Empresa</th>
                                <th>Auxiliar</th>
                                <th>Origen</th>
                                <?php
                                if ($_SESSION["departamentos"] == "Ventas") {
                                    echo '<th>Acciones</th>';
                                } else {
                                    echo '<th>Ejecutivo Asignado</th>';
                                }
                                ?>
                                </tr>
                            </thead> <tbody>
                                <?php
                                $respuesta = ControladorClientesSinTarifa::ctrMostrarClientesSinTarifa();
                                ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- The Modal -->
<div class="modal fade" id="modalEjecutivo">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Ejecutivo Asignado</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center" id="fotoPerfil">
                        </div>
                        <h3 class="profile-username text-center" id="nombreEjecutivo"></h3>
                        <p class="text-muted text-center" id="funcion"></p>
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Correo</b> <b class="float-right" id="email"></b>
                            </li>
                            <li class="list-group-item">
                                <b>Telefono</b> <b class="float-right" id="cel"></b>
                            </li>
                        </ul>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</div>
