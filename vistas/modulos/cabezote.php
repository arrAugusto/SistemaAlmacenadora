<nav class="main-header navbar navbar-expand navbar-light bgNavSuper">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu"><i class="fa fa-bars colorBarSuper"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="Inicio" class="nav-link" ><strong class="colorBarSuper">Inicio</strong></a>
        </li>
    </ul>

    <!-- BUSQUEDA DE OPCIONES -->
    <form class="form-inline d-none d-lg-inline-block mb-3 mb-md-0 ml-md-3">
        <div class="input-group input-group-sm">
            <div class="input-group-append">
                <label>
                    <?php
                    if (isset($_SESSION["Navega"]) && $_SESSION["Navega"] == "SinNav") {
                        echo '<i class="fa fa-window-close"></i>';
                    } else {
                        echo '<i class="fa fa-check-square"></i>';
                    }
                    ?>
                </label>
            </div>
            <i id="etiquetaEmpresa" style="color:#fff;"><?php
                if (isset($_SESSION["Navega"]) && $_SESSION["Navega"] == "SinNav") {
                    echo '&nbsp;&nbsp;&nbsp;&nbsp;' . "Su usuario no tiene navegación configurada";
                } else {
                    echo '&nbsp;&nbsp;&nbsp;&nbsp;' . $_SESSION["Navega"] . '&nbsp;&nbsp;&nbsp;&nbsp;<i id="etiquetaBod">' . $_SESSION["NavegaBod"] . '</i>&nbsp;&nbsp;&nbsp;&nbsp;<i id="etiquetaNumBod">' . $_SESSION["NavegaNumB"] . '</i>';
                }
                ?></i>
            <input type="hidden" id="hiddenIdBod" value=<?php echo $_SESSION["idDeBodega"]; ?>>
            <input type="hidden" id="hiddenIdUs" value=<?php echo $_SESSION["id"]; ?>>
            <input type="hidden" id="hiddenIdDependencia" value=<?php echo $_SESSION["dependencia"]; ?>>

        </div>

    </form>

    <!-- TIPO DE CAMBIO DIARIO -->
    <ul class="navbar-nav ml-auto">

        <!-- MENSAJES PRINCIPALES -->
        <!--<li class="nav-item dropdown">
            <a class="nav-link" style="color:#fff;" data-toggle="dropdown">
                <span><?php /*
                  $respuesta = tipoDeCambio::cambioDelDia(); */
                ?></span>
            </a>
        </li>-->
        <li class="nav-item dropdown show newData">
            <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="true">
                <i class="fa fa-bell colorBarSuper"></i>
                <?php
                $respuesta = ControladorOpB::ctrCartaDeMedioMillonCant();
                ?>
            </a>

            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="agNewNit">
                <span class="dropdown-item dropdown-header">Tareas Pendientes Por retiro</span>
                <?php
                $respuesta = ControladorOpB::ctrCartaDeMedioMillon();
                ?>


            </div>
        </li>

        <li class="nav-item dropdown show newData">
            <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="true">
                <i class="fa fa-th-large colorBarSuper"></i>
                <span class="badge badge-danger navbar-badge"><i class="fa fa-plus"></i></span>
            </a>

            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="agNewNit">
                <span class="dropdown-item dropdown-header">Agregar Nuevos Datos</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item" data-toggle="modal" data-target="#agregarNit">
                    <i class="fa fa-database mr-2"></i> Agregar Nuevo Nit
                </a>
                <?php
                if ($_SESSION["niveles"] == "MEDIO" && $_SESSION["departamentos"] == "Operaciones Fiscales") {
                    echo '
                <a href="#" class="dropdown-item" data-toggle="modal" data-target="#agregarConsolidado">
                    <i class="fa fa-database mr-2"></i> Agregar Nuevo Consolidado
                </a>';
                }

                if ($_SESSION["niveles"] == "MEDIO" && $_SESSION["departamentos"] == "Operaciones Fiscales") {
                    echo '
                <a href="#" class="dropdown-item" data-toggle="modal" data-target="#agregarNuevosServicios">
                    <i class="fa fa-database mr-2"></i> Agregar servicio de cobro
                </a>';
                }
                ?>                 
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown">
                <i class="fa fa-power-off"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">Cerrar Sesión</span>
                <div class="dropdown-divider"></div>

                </br><center>
                    <a href="salir"><button type="submit" class="btn btn-info">Cerrar Sesión
                            <i class="fa fa-power-off"></i> </button>
                </center>
                </br></a>

            </div>

        </li>
</nav>
<!--=====================================
MODAL POLIZA CONSOLIDADA
======================================-->
<!-- Modal -->
<div id="agregarNit" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lgMapa">
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
                    <div class="card card-info card-outline">

                        <!--campos formularios -->
                        <form role="form" method="post" id="divGuardaDetalle">
                            <div class="form-horizontal">
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-3 form-group">
                                            <label>
                                                Nit Empresa
                                            </label>
                                            <input class="form-control is-invalid" id="nuevoNit" name="nuevoNit" placeholder="Ingrese el número de nit" type="text" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                                        </div>
                                        <div class="col-9">
                                            <div class="form-group">
                                                <label>
                                                    Nombre de Empresa
                                                </label>
                                                <input class="form-control is-invalid" id="nuevaEmpresa" name="nuevaEmpresa" placeholder="Ingrese el nombre de la empresa" type="text" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>
                                                    Dirección de Empresa
                                                </label>
                                                <input class="form-control is-invalid" id="nuevaDireccion" name="nuevaDireccion" placeholder="Ingrese dirección de la empresa" type="text" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <iframe id="myFrameManifiesto" src="https://portal.sat.gob.gt/portal/consulta-cui-nit#constanciaRTU" title="W3Schools HTML Tutorial" height="350px" width="99%"></iframe>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="card-footer">
                            <div>
                                <button type="button" class="btn btn-warning btn-block btnNuevaEmpresa">Guardar / Editar NIT de empresa</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  
<!--=====================================
MODAL POLIZA CONSOLIDADA
======================================-->
<!-- Modal -->

<?php
if ($_SESSION["niveles"] == "MEDIO" && $_SESSION["departamentos"] == "Operaciones Fiscales") {
    echo '
<div id="agregarConsolidado" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
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
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Nuevo Consolidado <i class="fa fa-plus"></i></h3>
                        </div>
                        <!--campos formularios -->
                        <form role="form" method="post" id="divGuardaDetalle">
                            <div class="form-horizontal">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="input-group">
                                                <input type="text" id="textParamBusqCons" placeholder="Escriba poliza, nit, empresa..." class="form-control is-invalid buscando" onkeyup="javascript:this.value = this.value.toUpperCase();">

                                                <span class="input-group-append">
                                                    <button type="button" class="btn btn-primary btn-block btnBuscaCons"><i class="fa fa-search"></i></button>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-6" id="empresaElegiConso">
                                        </div>                                        
                                        <div class="col-12 mt-5">
                                            <table id="tablas" role="grid" class="table dt-responsive table-striped table-hover table-sm" >
                                                <thead>
                                                    <tr>
                                                    <th style="width:3px">#</th>
                                                    <th>Nit</th>
                                                    <th>Empresa</th>
                                                    <th>Dirección</th>
                                                    <th>Consolidado</th>
                                                    </tr>
                                                </thead> <tbody>';

    $respuesta = ControladorOpB::ctrMostrarConsolidados();
    echo '
                                                </tbody>
                                            </table>

                                        </div>                                        

                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="card-footer">

                            <button type="button" class="btn btn-primary btn-block btnNuevoConsolidado">Guardar Cambios</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>';
}
?>


<!--=====================================
MODAL POLIZA CONSOLIDADA
======================================-->
<!-- Modal -->

<?php
if ($_SESSION["niveles"] == "MEDIO" && $_SESSION["departamentos"] == "Operaciones Fiscales") {
    echo '
<div id="agregarNuevosServicios" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
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
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Nuevo Consolidado <i class="fa fa-plus"></i></h3>
                        </div>
                        <!--campos formularios -->
                        <form role="form" method="post">
                            <div class="form-horizontal">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="input-group">
                                                <input type="text" id="textParamNuevoServicio" placeholder="Escriba el nombre del nuevo servicio" class="form-control is-invalid buscando" onkeyup="javascript:this.value = this.value.toUpperCase();">
                                                <span class="input-group-append">
                                                    <button type="button" class="btn btn-primary btn-block btnNuevoServicioEx"><i class="fa fa-plus"></i></button>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-6 mt-5">
                                            <table id="tablas" role="grid" class="table dt-responsive table-striped table-hover table-sm" >
                                                <thead>
                                                    <tr>
                                                    <th style="width:3px">#</th>
                                                    <th>Nit</th>
                                                    </tr>
                                                </thead> <tbody>';
    $respuesta = ControladorPasesDeSalida::ctrMostrarOtrosServiciosExt();
    echo '
                                                </tbody>
                                            </table>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="card-footer">
                            <button type="button" class="btn btn-primary btn-block btnNuevoConsolidado">Guardar Cambios</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>';
}?>