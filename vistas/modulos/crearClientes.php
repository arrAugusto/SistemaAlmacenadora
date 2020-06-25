<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Crear un nuevo Usuario</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="Inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Crear un nuevo Usuario</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Creacion de usuarios-Internos Externos</h3>
                </div>
                <!--campos formularios -->
                <form role="form" method="post"  enctype="multipart/form-data">
                    <div class="form-horizontal">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <input type="text" class="form-control" placeholder="Codigo de cif" name="nuevoUsuario" required >
                                    <span class="fa fa-user"></span>
                                </div>
                                <div class="col-6">
                                    <input type="password" class="form-control" placeholder="Ingresa Contraseña" name="nuevaContraseña" required >
                                    <span class="fa fa-lock form-control-feedback"></span>
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control" placeholder="Nombres" name="nuevoNombre" required >
                                    <span class="fa fa-edit"></span>
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control" placeholder="Apellidos" name="nuevoApellido" required >
                                    <span class="fa fa-edit"></span>
                                </div>
                                <div class="col-md-6">
                                    <label>Numero de DPI</label>
                                    <input type="text" class="form-control" placeholder="# DPI" name="dpi" required >
                                    <span class="fa fa-edit"></span>
                                </div>

                                <div class="col-md-6">
                                    <label>Nit de la empresa</label>
                                    <select class="form-control select2" id="nitTarifaEspecial" name="nitTarifaEspecial">
                                        <option value="">Escriba el nit</option>
                                        <?php
                                        $tipo = 1;
                                        $respuesta = ControladorOpB::ctrMostrarOpB($tipo);
                                        foreach ($respuesta as $key => $value) {
                                            echo '<option value="' . $value["id"] . '">' . $value["nitEmpresa"] . ' </option>';
                                        }
                                        ?>
                                    </select>
                                    <input type="hidden" id="hiddenNitEspecial" name="hiddenNitEspecial" value="">

                                    <span class="fa fa-asl-interpreting"> </span>
                                </div>

                                <div class="col-md-6">
                                    <label>Razon Social</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-edit"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="razonSocial" name="razonSocial" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label>Nombre Comecial</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-edit"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="nombreComercial" name="nombreComercial" required>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <label>Direccion Fiscal</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-edit"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="direccionFiscal" name="direccionFiscal" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>Direccion de recibos</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-edit"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="direccionDeRecibos" name="direccionDeRecibos" required>
                                    </div>
                                </div>




                                <div class="col-md-6">
                                    <label>Persona encarda</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-edit"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="contacto" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>Ejecutivo de Ventas</label>
                                    <select class="form-control select2" style="width: 100%;" id="ejecutivoVentas" name="ejecutivoVentas">
                                        <?php
                                        $respuesta = ControladorActivarParaCobro::ctrMostrarEjecutivo();
                                        foreach ($respuesta as $key => $value) {
                                            echo '<option value=' . $value["indenty"] . '>' . $value["nombreVendedor"] . ' '.$value["apellidoVendedor"].'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>


                                <div class="col-md-6">
                                    <label>Pregunta Secreta</label>
                                    <select class="form-control select2" style="width: 100%;" id="preguntaSecreta" name="preguntaSecreta" required>
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
                                <div class="col-6">
                                    <label>Respuesta de la pregunta secreta</label>
                                    <input type="text" class="form-control input-lg"  placeholder="Escriba su respuesta"  id="respuestaSecreta" name="respuestaSecreta">
                                    <span class="fa fa-question"></span>
                                </div>
                                <div class="col-md-6">
                                    <label>Dependencia</label>
                                    <select class="form-control select2" style="width: 100%;" name="dependencia" disabled="disabled">
                                        <option>Cliente</option>
                                    </select>
                                    <span class="fa fa-edit"></span>
                                </div>
                                <div class="col-md-6">
                                    <label>Telefono de usuario</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="telefono" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label>Email-usuario</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                        </div>
                                        <input type="email" class="form-control" placeholder="Email" name="Email" required>
                                    </div>
                                </div>




                                <div class="form-group">

                                    <div class="panel">SUBIR FOTO</div>

                                    <input type="file" class="nuevaFoto" name="nuevaFoto" id="nuevaFoto">

                                    <p class="help-block">Peso máximo de la foto 2MB</p>

                                    <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

                                </div>

                            </div>

                        </div>
                        <!--CIERRE DE CODIGO HTML-->
                    </div>
            </div>
            <div class="card-footer">
                <div class="btn-group">
                    <button type="submit" class="btn btn-primary">Guardar usuario</button>
                    <button type="button" class="btn btn-info" data-dismiss="modal">Salir</button>

                </div>
            </div>
            <?php
            $perfil = "externo";
            $tipoUsuario = "cliente";
            $user = ControladorUsuarios::ctrCrearUsuario($perfil, $tipoUsuario);
            ?>
        </div>
        </form>
</div>

</section>

</div>

<!--CIERRRE DE CENTER-->
