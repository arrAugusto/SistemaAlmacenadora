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
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Gestor de usuarios / Activación o desactivación</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post">
                <div class="card-body">
                    <!--- =======================
                    INICIO
                    ======================-->
                    <div class="box-body">
                        <table id="tablas"class="table table-striped table-responsive-xl">
                            <thead>
                                <tr>
                                <th style="whidth:5px">#</th>
                                <th>Usuario</th>
                                <th>Nit</th>
                                <th>Empresa</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Fotografia</th>
                                <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $item = null;
                                $valor = null;
                                $perfil="externo";
                                $user = ControladorUsuarios::ctrMostrarUsuarios($item, $valor, $perfil);
                                foreach ($user as $key => $value) {
                                    echo '<tr>
                                <td>1</td>
                                <td>' . $value["usuarios"] . '</td>
                                <td>' . $value["nit"] . '</td>
                                <td>' . $value["razonSocial"] . '</td>
                                <td>' . $value["nombres"] . '</td>
                                <td>' . $value["apellidos"] . '</td>';
                                    if ($value["foto"] != "") {
                                        echo '<td><img src="' . $value["foto"] . '"class="img-thumbnail" width="40px"></td>';
                                    } else {
                                        echo '<td><img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width="40px"></td>';
                                    }

if ($value["estado"] !=0    ) {
echo  '<td><button type="button" class="btn btn-success btn-xs btnActivar" idUsuario="' . $value["id"] . '"estadoUsuario="0">Activado</button></td>';
}else{
echo  '<td><button type="button" class="btn btn-danger btn-xs btnActivar" idUsuario="' . $value["id"] . '"estadoUsuario="1">Desactivado</button></td>';

}
                                    echo
                           
                                                                    
                                '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>

