<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Gestor de Clientes</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="Inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Gestor de Usuarios</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
        <div class="card card-info">

            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post">
                <div class="card-body">
                    <!--- =======================
                    INICIO
                    ======================-->
                    <div class="box-body">
             <table id="tablas" role="grid" class="table dt-responsive nowrap table-striped table-bordered display table-sm" cellspacing="0" >
                                          <thead style="background-color: #81BEF7;color: white; font-weight: bold;">
                                <tr>
                                <th style="width: 5px;">#</th>
                                <th>Nit</th>
                                <th>Empresa</th>
                                <th>Correo</th>
                                <th>Telefono</th>
                                <th>Contacto</th>
                                <th>Foto</th>
                                <th>Ejecutivo</th>
                                <th>Accion</th>                                
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $user = ControladorUsuarios::ctrmostrarClientes();
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>

