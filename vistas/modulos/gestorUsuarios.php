<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Gestor de Usuarios</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="Inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Gestor de Usuarios</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
        <div class="card card-info card-outline">
            <!-- form start -->
            <form class="form-horizontal" method="post">
                <div class="card-body">
                    <!--- =======================
                    INICIO
                    ======================-->

                    <div class="box-body">

                        <table id="tablas" role="grid" class="table  dt-responsive table-sm nowrap table-striped table-bordered display" cellspacing="0" >
                            <thead style="background-color: #0096d2;color: white; font-weight: bold;">       
                                <tr>
                                    <?php
                                    if ($_SESSION["niveles"] == "ADMINISTRADOR") {
                                        echo '
                                                   <th style="whidth:5px">#</th>
                                <th>Usuario</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Funcion</th>
                                <th>Nivel</th>
                                <th>Fotografia</th>
                                <th>Estado</th>';
                                    } else {
                                        echo '
                                    <th style="whidth:5px">#</th>
                                        <th>Nombres</th>
                                        <th>Apellidos</th>
                                        <th>Funcion</th>
                                        <th>Correo</th>
                                        <th>Fotografia</th>
                                        <th>Estado</th>';
                                    }
                                    ?>

                                </tr>
                            </thead>
                            <?php
                            $item = null;
                            $valor = null;
                            $perfil = "internos";
                            $user = ControladorUsuarios::ctrMostrarUsuarios($item, $valor, $perfil);
                            ?>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>

