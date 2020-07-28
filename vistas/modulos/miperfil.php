

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                </div>
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="Inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Mi Perfil de Usuario</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
        <div id="actualizado">
            <center> <div class="col-md-4">


                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <div class="image">


                                    <?php
                                    if ($_SESSION["foto"] != "") {
                                        echo '<img class="profile-user-img img-fluid img-circle"  src="' . $_SESSION["foto"] . '"    alt="User profile picture">';
                                    } else {
                                        echo '<img class="profile-user-img img-fluid img-circle" src="vistas/img/usuarios/default/anonymous.png"   alt="User profile picture">';
                                    }
                                    ?>

                                </div>
                                <h3><?php echo ($_SESSION['nombre']); ?></h3>
                                <h3><?php echo ($_SESSION['apellidos']); ?></h3>

                                <p class="text-muted text-center"><?php echo $_SESSION["departamentos"]; ?></p>

                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Fecha Creacion:  23/03/2019</b>
                                    </li>
                                    <li class="list-group-item">
                                        <b><?php echo "Telefono:  " . ($_SESSION["telefono"]); ?></b>
                                    </li>
                                    <li class="list-group-item">
                                        <b><?php echo ($_SESSION["niveles"]); ?></b>
                                    </li>
                                    <li class="list-group-item">
                                        <b><?php echo "Email:  " . ($_SESSION["email"]); ?></b>
                                    </li>

                                    <li class="list-group-item">
                                        <b>EDICION Y CONFIGURACION DE PERFIL</b>
                                    </li>


                                    <li class="list-group-item">
                                    <button type="button" class="btn btn-info btnEditarUsuario" idUsuario="<?php echo ($_SESSION['id']); ?>" data-toggle="modal" data-target="#myModal">Mi datos</button>

                                    <button type="button" class="btn btn-danger btnEditarUsuario"  idUsuario="<?php echo ($_SESSION['id']); ?>" data-toggle="modal" data-target="#myModal2">Contraseña</button>

                                    <button type="button" class="btn btn-success btnEditarUsuario" idUsuario="<?php echo ($_SESSION['id']); ?>" data-toggle="modal" data-target="#myModalfoto"><i class="fa fa-camera-retro" style="font-size18px"></i>                         
                                    </button>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>

                </div></center>
    </section>
</div>
</div>
<!--=====================================
MODAL AGREGAR USUARIO
======================================-->
<!-- Modal -->

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-xl">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <!--=====================================
                INICIO FORM
                ======================================-->
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Edicion de usuarios</h3>
                        </div>
                        <!--campos formularios -->
                        <form role="form" method="post">
                            <div class="form-horizontal">
                                <div class="card-body">
                                    <div class="row">


                                        <div class="col-12">
                                            <label>Numero de Usuario</label>
                                            <input type="text" class="form-control input-lg"  id="editarUsuario" name="editarUsuario"  value="" readonly>
                                            <span class="fa fa-user"></span>
                                        </div>
                                        <div class="col-md-12">
                                            <label>Telefono de usuario</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                                </div>
                                                <input type="text" class="form-control" id="editarTelefono" name="editarTelefono" value="" required>
                                                <input type="hidden" name="telefonoActual" id="telefonoActual">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label>Email-usuario</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                                </div>
                                                <input type="email" class="form-control" placeholder="editarEmail" id="editarEmail" name="editarEmail" value="" required>
                                                <input type="hidden" name="emailActual" id="emailActual">

                                            </div>
                                        </div>



                                        <!--=====================================
                                        FIN FORM
                                        ======================================-->
                                    </div>
                                    <div class="card-footer">
                                        <div class="btn-group">
                                            <button type="submit" class="btn btn-primary btnCambiaDataEdicion" idUsuario="<?php echo ($_SESSION["id"]); ?>">Editar mis datos</button>
                                            <button type="button" class="btn btn-info" data-dismiss="modal">Salir</button>




                                        </div>
                                    </div>
                                </div>  
                            </div>  

                            <?php
                            $editarUsuario = new ControladorUsuarios();
                            $editarUsuario->ctrEditarUsuario();
                            ?>

                        </form> 
                    </div>     

                </div>

            </div>

        </div>
    </div>
</div>




<!--=====================================
MODAL CONTRASEÑA
======================================-->
<!-- Modal -->
<div id="myModal2" class="modal fade" role="dialog">
    <div class="modal-dialog modal-xl">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <!--=====================================
                INICIO FORM
                ======================================-->

                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Edicion de usuarios</h3>
                        </div>
                        <!--campos formularios -->
                        <form role="form" method="post"  enctype="multipart/form-data">
                            <div class="form-horizontal">
                                <div class="card-body">

                                    <div class="row">


                                        <div class="col-md-12">
                                            <label>Contraseña Actual</label>
                                            <div class="form-group has-feedback">
                                                <input type="password" class="form-control" placeholder="Nueva Contraseña" id="ActualContra" name="ActualContra" value="" required>
                                                <input type="hidden" id="passwordAcutal" name="passwordAcutal">
                                                
                                            </div>
                                        </div>


                                        <div class="col-md-12">
                                            <label>Nueva contraseña</label>
                                            <div class="form-group has-feedback">
                                                <input type="password" class="form-control" placeholder="Nueva Contraseña" id="nuevacontra" name="nuevacontra" value="" required>
                                                
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <label>Confirma Nueva contraseña</label>
                                            <div class="form-group has-feedback">
                                                <input type="password" class="form-control" placeholder="Confirma Contraseña" id="confirmapassword" name="confirmapassword" value="" required>
                                                
                                            </div>


                                        </div>


                                        <!--=====================================
                                        FIN FORM
                                        ======================================-->
                                    </div>
                                    <div class="card-footer">
                                        <div class="btn-group">
                                            <button type="submit" class="btn btn-primary validar">Nueva contraseña</button>
                                            <button type="button" class="btn btn-info" data-dismiss="modal">Salir</button>
                                            <!--CIERRE DE CODIGO HTML-->
                                        </div>
                                    </div>
                                </div>  
                            </div>  
                            <?php
                            $editor = new ControladorUsuarios();
                            $editor->ctrEditarclave();
                            ?>

                        </form> 
                    </div>     

                </div>

            </div>

        </div>
    </div>
</div>

<!--=====================================
MODAL AGREGAR USUARIO
======================================-->
<!-- Modal -->
<!-- Modal -->
<div id="myModalfoto" class="modal fade" role="dialog">
    <div class="modal-dialog modal-xl">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <!--=====================================
                INICIO FORM
                ======================================-->
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Edicion de usuarios</h3>
                        </div>
                        <!--campos formularios -->
                        <form role="form" method="post"  enctype="multipart/form-data">
                            <div class="form-horizontal">
                                <div class="card-body">


                                    <div class="form-group">

                                        <div class="panel">SUBIR FOTO</div>

                                        <input type="file" class="nuevaFoto" name="editarFoto" id="editarFoto" required>

                                        <p class="help-block">Peso máximo de la foto 2MB</p>

                                        <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
                                        <input type="hidden" name="fotoActual" id="fotoActual" value="">

                                    </div>
                                    <div class="card-footer">
                                        <div class="btn-group">
                                            <button type="submit" class="btn btn-primary validar">Cambiar fotografia

<?php
$cambiarFoto = new ControladorUsuarios();
$cambiarFoto->ctrCambiarFoto();
?>  
                                            </button>
                                            <button type="button" class="btn btn-info" data-dismiss="modal">Salir</button>
                                            <!--CIERRE DE CODIGO HTML-->
                                        </div>
                                    </div>
                                    </br>
                                    <div class="alert alert-primary">
                                        Despues de hacer click en "GUARDAR CAMBIOS",  se actualizara su fotografia con exito
                                    </div>
                                </div>  



                            </div>


                        </form> 

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>