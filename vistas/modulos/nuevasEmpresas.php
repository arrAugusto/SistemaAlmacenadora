<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dominio De Empresas</h1>
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
        <div class="card card-info card-outline">
            <div class="col-md-6 col-lg-6 col-sm-12 mt-4">
                <button type="button" class="btn btn-outline-danger btn-block btnNDivisionuevaEmpresa"  data-toggle="modal" data-target="#modalNuevaEmpresa">Registrar Nueva Empresa<i class="fa fa-plus"></i></button>
            </div> 
            <form role="form" method="post">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <table id="tablas" role="grid" class="table  dt-responsive table-striped table-hover table-sm" >
                                <thead>
                                    <tr>
                                    <th style="width:3px;">#</th>
                                    <th>Nit</th>
                                    <th>Empresa</th>
                                    <th>Dirección</th>
                                    <th>Telefono</th>
                                    <th>E-mail</th>
                                    <th>Logo</th>
                                    <th>Acciones</th>
                                    </tr>
                                </thead> <tbody>
                                    <?php
                                    $respuesta = ControladorEmpresasAlmacenadoras::ctrMostrarEmpAlmacenadora();
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- The Modal -->
<div class="modal fade" id="modalNuevaEmpresa">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">CREACIÓN DE NUEVA EMPRESA</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form role="form" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-6 mt-4">
                            <label>Nit Empresa</label>
                            <input type="text" class="form-control is-invalid" id="txtNewNit" name="txtNewNit" placeholder="Ejemplo : 37315452" value="" required  onkeyup="javascript:this.value = this.value.toUpperCase();" autocomplete="off" />
                        </div>
                        <div class="col-6 mt-4">
                            <label>Nombre Empresa</label>
                            <input type="text" class="form-control is-invalid" id="txtNewNombre" name="txtNewNombre" placeholder="Ejemplo : MIEMPRESA, S.A." value="" required onkeyup="javascript:this.value = this.value.toUpperCase();" autocomplete="off" />
                        </div>
                        <div class="col-6 mt-4">
                            <label>Establecimiento</label>
                            <input type="text" class="form-control is-invalid" id="establecimiento" name="establecimiento" placeholder="Ejemplo : ALGESA" value="" required onkeyup="javascript:this.value = this.value.toUpperCase();" autocomplete="off" />
                        </div>                        
                        <div class="col-6 mt-4">
                            <label>Dirección Empresa</label>
                            <input type="text" class="form-control is-invalid" id="txtNewDireccion" name="txtNewDireccion" placeholder="Ejemplo : 5A CALLE 10-52 ZONA 7" value="" required onkeyup="javascript:this.value = this.value.toUpperCase();" autocomplete="off" />
                        </div>
                        <div class="col-6 mt-4">
                            <label>Telefono Empresa</label>
                            <input type="text" class="form-control is-invalid" id="txtNewTelefono" name="txtNewTelefono" placeholder="555-1212" required  value="" onkeyup="javascript:this.value = this.value.toUpperCase();"  autocomplete="off" />
                        </div>
                        <div class="col-6 mt-4">
                            <label>Email</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                                </div>
                                <input type="email" class="form-control" placeholder="Email" name="Email" required="" autocomplete="off" value="" />
                                <input type="hidden" name="fotoActual" id="fotoActual" value="">

                                <div class="alert alert-info mt-4" role="alert">
                                    ¡Las dimensiones maximas aceptadas en acho 270px y en alto 300px! 
                                </div>
                            </div>
                        </div>
                        <div class="col-6 mt-4">
                            <div class="form-group">
                                <div class="panel">SUBIR FOTO</div>
                                <input type="file" class="nuevaFoto" name="nuevoLogo" id="nuevoLogo" required>
                                <p class="help-block">Peso máximo de la foto 2MB</p>
                                <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

                            </div>
                        </div>  
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-primary btn-block">Guardar Nueva Empresa <i class="fa fa-save"></i></button>
                    </div>
                </form>

            </div>
            <?php
            $resp = ControladorEmpresasAlmacenadoras::ctrCrearNuevaEmpresa();
            ?>
        </div>    
    </div>     
</div>

<!-- The Modal -->
<div class="modal fade" id="modalEditarEmpresa">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">EDCIÓN DE NUEVA EMPRESA</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form role="form" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-6 mt-4">
                            <label>Nit Empresa</label>
                            <input type="text" class="form-control is-invalid" id="txtNewNitEdit" name="txtNewNitEdit" placeholder="Ejemplo : 37315452" value="" onkeyup="javascript:this.value = this.value.toUpperCase();" autocomplete="off" />
                        </div>
                        <div class="col-6 mt-4">
                            <label>Nombre Empresa</label>
                            <input type="text" class="form-control is-invalid" id="txtNewNombreEdit" name="txtNewNombreEdit" placeholder="Ejemplo : MIEMPRESA, S.A." value="" onkeyup="javascript:this.value = this.value.toUpperCase();" autocomplete="off" />
                        </div>
                        <div class="col-6 mt-4">
                            <label>Establecimiento</label>
                            <input type="text" class="form-control is-invalid" id="establecimientoEdit" name="establecimientoEdit" placeholder="Ejemplo : ALGESA" value="" required onkeyup="javascript:this.value = this.value.toUpperCase();" autocomplete="off" />
                        </div>                           
                        <div class="col-6 mt-4">
                            <label>Dirección Empresa</label>
                            <input type="text" class="form-control is-invalid" id="txtNewDireccionEdit" name="txtNewDireccionEdit" placeholder="Ejemplo : 5A CALLE 10-52 ZONA 7" value="" onkeyup="javascript:this.value = this.value.toUpperCase();" autocomplete="off" />
                        </div>
                        <div class="col-6 mt-4">
                            <label>Telefono Empresa</label>
                            <input type="text" class="form-control is-invalid" id="txtNewTelefonoEdit" name="txtNewTelefonoEdit" placeholder="555-1212" value="" onkeyup="javascript:this.value = this.value.toUpperCase();"  autocomplete="off" />
                        </div>
                        <div class="col-6 mt-4">
                            <label>Email</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                                </div>
                                <input type="email" class="form-control" placeholder="Email" name="EmailEdit" id="EmailEdit" autocomplete="off" value="" />
                                <input type="hidden" name="hiddenFotoActual" id="hiddenFotoActual" value="" />
                                <input type="hidden" name="hiddenIdEmpresa" id="hiddenIdEmpresa" value="" />

                            </div>
                        </div>
                        <div class="col-6 mt-4">
                            <div class="form-group">
                                <div class="panel">SUBIR FOTO</div>
                                <input type="file" class="nuevaFoto" name="LogoEditar">
                                <p class="help-block">Peso máximo de la foto 2MB</p>
                                <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
                            </div>
                        </div>  
                        <div class="col-6 mt-4">
                            <div class="alert alert-info mt-4" role="alert">
                                ¡Las dimensiones maximas aceptadas en acho 270px y en alto 300px! 
                            </div>
                        </div>    
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-warning btn-block">Editar Empresa <i class="fa fa-edit"></i></button>
                    </div>
                </form>
                <?php
                $resp = ControladorEmpresasAlmacenadoras::ctrEditarEmpresa();
                ?>
            </div>
        </div>    
    </div>     
</div>
