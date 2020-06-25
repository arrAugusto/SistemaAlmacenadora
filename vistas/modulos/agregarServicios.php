
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
                            <div class="col-12">

                                            <table id="tablas" role="grid" class="table  dt-responsive    nowrap table-striped table-bordered display" cellspacing="0" >
                                                <thead>
                                                    <tr>
                                                    <th style="whidth:5px">#</th>

                                                    <th>Nit</th>

                                                    <th>Empresa</th>
                                                    <th>Ingreso</th>
                                                    <th>Poliza</th>
                                                    <th>Fecha</th>

                                                    <th>Bultos</th>
                                                    <th>Cif</th>
                                                    <th>Impuestos</th>
            <th>Acciones</th>
                                                    </tr>
                                                </thead> <tbody>
                                                    <?php
                                                        $resupuesta = ControladorAgregarServicios::ctrSumarMasServicios();
                                                        
                                                    ?>
                                                </tbody>
                                            </table>


                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
