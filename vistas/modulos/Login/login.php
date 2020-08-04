<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Almacenadoras Unidas</title>

        <!-- Diseño responsivo para trabajar los puntos de quiebre -->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!--======================
        PLUGIN DE CSS
        ========================== -->

        <!-- Font Awesome -->

        <link rel="stylesheet" href="vistas/plugins/font-awesome/css/font-awesome.min.css">

        <!-- Iconos -->

        <link rel="stylesheet" href="vistas/dist/js/plugins/font-awesome/css/ionicons.min.css">

        <!-- Tema de plantilla -->

        <link rel="stylesheet" href="vistas/dist/css/adminlte.min.css">

        <!-- Fuente Google:  -->
        <link href="vistas/dist/css/css.css" rel="stylesheet">

        <!-- sweetalert2 css:  -->

        <link rel="stylesheet" href="vistas/dist/css/weetalert2css/weetalert2.css">

        <!-- DataTables -->

        <link rel="stylesheet" href="vistas/plugins/datat/datatable/css/responsive.dataTables.min.css">

        <!-- DataTables -->
        <link rel="stylesheet" href="vistas/plugins/datatables/dataTables.bootstrap4.min.css">


        <!--======================
        PLUGIN DE JAVASCRIPT
        ========================== -->


        <!-- jQuery -->

        <script src="vistas/plugins/jquery/jquery.min.js"></script>

        <!-- Bootstrap 4 -->

        <script src="vistas/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- SlimScroll -->

        <script src="vistas/plugins/slimScroll/jquery.slimscroll.min.js"></script>

        <!-- FastClick -->

        <script src="vistas/plugins/fastclick/fastclick.js"></script>

        <!-- AdminLTE App -->

        <script src="vistas/dist/js/adminlte.min.js"></script>

        <!-- sweetalert2  -->

        <script src="vistas/plugins/sweetalert2/sweetalert2.all.js"></script>

        <!-- DataTables -->


        <script type="text/javascript" src="vistas/plugins/datat/datatable/js/jquery-3.3.1.js"></script>

        <script type="text/javascript" src="vistas/plugins/datat/datatable/js/dataTables.responsive.min.js"></script>
        <script type="text/javascript" src="vistas/js/datatable.js"></script>

        <!---->

        <script src="vistas/plugins/datat/datatable/js/jquery.dataTables.min.js"></script>
        <script src="vistas/plugins/datatables/dataTables.bootstrap4.min.js"></script>

        <!---->
        <script src="vistas/js/usuario.js"></script>
        <!-- Tema de plantilla -->

        <link rel="stylesheet" href="vistas/dist/css/adminlte.css">


    </head>

    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">

                <img src="vistas/img/plantilla/ai.png" class="img-responsive" style="padding: 10px 200px 0px 100px">
            </div>
            <!-- /.login-logo -->
            <div>
                  <div class="login-box-body" style="background-color:rgba(1,21,14,0.8); color: white;">
                    
                    <p class="login-box-msg"><b>Ingresa Tu usuario y contraseña</b></p>

                    <form method="post">

                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Ingresa Usuario" name="ingUsuarios"required value="" autocomplete="off" />
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fa fa-user"></span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" placeholder="Contraseña" name="ingPassword" required value="" autocomplete="off" />
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fa fa-lock"></span>
                                </div>
                            </div>
                        </div>                        
              
                        <div class="row">
                            <!-- /.col -->
                            <div class="col-12">
                                <button type="submit" class="btn btn-block btn-primary">Aceptar</button>
                            </div>
    </div>
                
                            <?php
                            $login = new ControladorUsuarios();
                            $login->ctrIngresoUsuario();
                            ?>  

                    </form>

                    </br>
                    <div class="col-8">

                        <a href="#myModal" data-dismiss="modal" data-toggle="modal">Olvide mi contraseña</a>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <!--=====================================
    MODAL AGREGAR USUARIO
    ======================================-->
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
                                <h3 class="card-title">RECUPERACIÓN DE CONTRASEÑA</h3>
                            </div>
                            <!--campos formularios -->
                            <form role="form" method="post"  >
                                <div class="form-horizontal">
                                    <div class="card-body">
                                        <div class="row">
                                            </br>
                                            </br>
                                            <div class="col-12">
                                                <label>Ingresa Usuario</label>
                                                <input type="text" class="form-control input-lg"  placeholder="Ingresa usuario"  id="recuperaUsuario" name="recuperaUsuario">
                                                <span class="fa fa-user"></span>
                                            </div>
                                            <div class="col-12">
                                                <label>Escribe tu correo electronico</label>
                                                <input type="email" class="form-control input-lg"  placeholder="Correo Electronico"  id="email" name="email">
                                                <span class="fa fa-at"></span>
                                            </div>
                                            <div class="col-md-12">
                                                <label>Seleccione su pregunta secreta</label>
                                                <select class="form-control select2" style="width: 100%;" name="preguntaSecreta" required>
                                                    <option>¿Nombre de su primera mascota?</option>
                                                    <option>¿Nombre de el hospital que nacio?</option>
                                                    <option>¿Nombre y año que nacio su abuelo(a)?</option>
                                                    <option>¿Color favorito?</option>
                                                    <option>¿Cual es tu refrán favorito?</option>
                                                    <option>¿Cual es tu canción favorita?</option>
                                                    <option>¿Cual es tu pelicula favorita?</option>
                                                </select>
                                                <span class="fa fa-asl-interpreting"> </span>
                                            </div>
                                            <div class="col-12">
                                                <label>Escriba tu respuesta</label>
                                                <input type="text" class="form-control input-lg"  placeholder="Escriba su respuesta"  id="respuestaSecreta" name="respuestaSecreta">
                                                <span class="fa fa-question"></span>
                                            </div>
                                            <!--=====================================
                                            FIN FORM
                                            ======================================-->
                                        </div>
                                        </br>  </br>  </br>
                                        <div class="card-footer">
                                            <div class="btn-group">
                                                <button type="submit" class="btn btn-primary">Recuperar mi contraseña</button>
                                            </div>
                                        </div>
                                    </div>  
                                </div>  
                                <?php
                                $editarUsuario = new ControladorUsuarios();
                                $editarUsuario->ctrRecuperar();
                                ?>
                            </form> 
                        </div>     
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
