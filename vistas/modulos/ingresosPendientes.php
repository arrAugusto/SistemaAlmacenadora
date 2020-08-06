
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Menú Principal</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card card-info card-outline">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mt-4" id="tableDinamicIngBod">
                            <!-- form start -->
                            <form class="form-horizontal" method="post">
                                <div class="card-body" id="divTableFail">
                                    <!--- =======================
                                    INICIO
                                    ======================-->

                                    <table id="tablas" role="grid" class="table  dt-responsive nowrap table-striped table-bordered display tableIngFail table-sm" cellspacing="0" >
                                        <thead style="background-color: #1e88e5;color: white; font-weight: bold;">
                                            <tr>
                                            <th style="whidth:5px">#</th>
                                            <th>Empresa</th>
                                            <th>Nit</th>
                                            <th>Bultos</th>
                                            <th>Poliza</th>
                                            <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $respuesta = ControladorIngresosPendientes::ctrTransaccionesPendientes();
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!--=====================================
MODAL POLIZA CONSOLIDADA
======================================-->
<!-- Modal -->
<div id="gdrManifiestos" class="modal fade" role="dialog">
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
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Agregar Detalles de Mercadería</h3>
                        </div>
                        <!--campos formularios -->
                        <form role="form" method="post" autocomplete="off" id="divGuardaDetalle">
                            <div class="row">
                                <div class="col-12 mt-4" id="UltimochasisTeclado">
                                    <center><label id="comprobarChasis"></label></center>
                                </div>
                            </div>
                            <div class="form-horizontal mt-2">
                                <div class="card-body">
                                    <div class="nav nav-tabs" id="product-tab" role="tablist">
                                        <a class="nav-item nav-link" id="tabIngManifiesto" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="false">Ingreso con manifiesto</a>
                                        <a class="nav-item nav-link" id="tabVehiculosUsados" data-toggle="tab" href="#product-comments" role="tab" aria-controls="product-comments" aria-selected="false">Ingreso Vehiculos</a>
                                    </div>  

                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade" id="product-desc" role="tabpanel" aria-labelledby="tabIngManifiesto">
                                            <div class="row">

                                                <input id="valueClientes" name="valueClientes" type="hidden" value="" />
                                                <input id="cantVsClientes" name="cantVsClientes" type="hidden" value="0" />



                                                <div class="col-4 form-group autocompletar">
                                                    <label>
                                                        Nombre de Empresa
                                                    </label>
                                                    <input class="form-control is-invalid" id="tipoBusqueda" name="tipoBusqueda" placeholder="Ingrese Nombre de empresa" type="text" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                                                </div>
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label>
                                                            Cantidad de Bultos
                                                        </label>
                                                        <input class="form-control is-invalid" id="bultosAgregados" name="bultosAgregados" placeholder="Ingrese cantidad de bultos" type="number" />
                                                        <center><label id="bultosSobregiro" style="color:red;"></label></center>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="col-12">
                                                        <label>
                                                            Valor Peso
                                                        </label>
                                                        <div class="input-group">
                                                            <input class="form-control is-invalid" id="pesoAgregado" name="pesoAgregado" placeholder="Ingrese peso" type="number" />

                                                            <span class="input-group-append">
                                                                <button btnagrega="0" class="btn btn-info btn-flat btnAgregarEmpresa" type="button">Agregar Empresa</button>
                                                            </span>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="col-12">
                                                    <div id="divEmpresasAgregadasMani">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="product-comments" role="tabpanel" aria-labelledby="tabVehiculosUsados">
                                            <div class="row">
                                                <div class="col-6">
                                                    <label>Ingrese el Numero de Chasis</label>
                                                    <input type="text" class="form-control is-invalid" id="numChasisVehUs" placeholder="Chasis: 5UXFA53543LW26843" value="" autocomplete="false" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                                                </div>

                                                <div class="col-3">
                                                    <label>Tipo de Vehículo</label>
                                                    <input type="text" class="form-control is-invalid" id="tVehiculoUs" placeholder="Ejemplo : AUTOMOVIL" value="" autocomplete="false" onkeyup="javascript:this.value = this.value.toUpperCase();" />

                                                </div>
                                                <div class="col-3">
                                                    <label>Marca del Vehículo</label>
                                                    <input type="text" class="form-control is-invalid" id="marcaVeh" placeholder="Ejemplo : TOYOTA" value="" autocomplete="false" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                                                </div>      

                                                <div class="col-6">
                                                    <label>Linea del Vehículo</label>
                                                    <input type="text" class="form-control is-invalid"  id="lineaVeh" placeholder="Ejemplo : Yaris" value=""  autocomplete="false" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                                                </div>
                                                <div class="col-6">
                                                    <label>Modelo del Vehículo</label>
                                                    <input type="number" class="form-control is-invalid"  id="modeloVeh" autocomplete="false" placeholder="Ejemplo : <?php
                                                    date_default_timezone_set('America/Guatemala');
                                                    $year = date('Y');
                                                    echo $year;
                                                    ?>" value="" />
                                                </div>
                                                <div class="col-6">
                                                    <label>Cantidad de Vehículos</label>
                                                    <input type="number" class="form-control is-valid"  id="cantidaVeh" value="1" autocomplete="false" readOnly="false" />
                                                    <center><label id="bultosSobregiro" style="color:red;"></label></center>
                                                </div>                                                
                                                <div class="col-6">
                                                    <div class="col-12">
                                                        <label>Peso de Vehículo</label>
                                                        <div class="input-group">
                                                            <input type="number" class="form-control is-invalid" id="pesoVehiculoUs" autocomplete="false" placeholder="Ejemplo : 2125.12" value="" />
                                                            <span class="input-group-append">
                                                                <button type="button" class="btn btn-success btnGVehciuloUs">Agregar Chasis</button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <center><label id="pesoSobregiro" style="color:red;"></label></center>
                                                </div>
                                            </div>   
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row"> 
                                <div class="col-12 mt-4" id="divChaisVehiculosUS">

                                </div>
                                <div class="col-4">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-info">
                                            <i class="fa fa-calculator">
                                            </i>
                                        </span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Detalle de Bultos</span>
                                            <h4 id="saldoIngNblts"></h4>

                                            <h4 id="saldoNuevoblts"></h4>
                                            <h4 id="bltsRetirados"></h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-info">
                                            <i class="fa fa-calculator">
                                            </i>
                                        </span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">
                                                Detalle de Peso
                                            </span>
                                            <h4 id="saldoIngNPeso"></h4>
                                            <h4 id="pesoNuevoblts"></h4>
                                            <h4 id="pesoRetirados"></h4>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-success">
                                            <i class="fa fa-calculator">
                                            </i>
                                        </span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">
                                                Clientes Agregados
                                            </span>
                                            <h3 id="contadorClientes"></h3>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                            </div>       
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="vistas/js/autocompletar.js"></script>



<!--=====================================
MODAL POLIZA CONSOLIDADA
======================================-->
<!-- Modal -->
<div id="gdVehiculosNuevos" class="modal fade" role="dialog">
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
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Agregar Detalles de Mercadería</h3>
                        </div>
                        <!--campos formularios -->
                        <form role="form" method="post" id="divGuardaDetalle">
                            <input type="hidden" id ="hiddenIdentity" value=""> 


                            <div class="row">
                                <div class="col-5 mt-4" id="divAccionesValidacion">
                                    <div class="container">
                                        <h2>Validación e ingreso de chasis</h2>
                                        <p>En el siguiente campo, tiene que ingresar cada uno de los chasis delimitados por el simbolo pai " | "</p>
                                        <div class="form-group">
                                            <label for="comment">Ingresa los chasis de vehiculos:</label>
                                            <textarea class="form-control" rows="15" id="chasisDelimitados" name="text"></textarea>
                                        </div>
                                        <div class="btn-group" id="buttonsChasis">
                                            <button type="button" class="btn btn-info btnValidarChasis" id="buttonChasis" estado="0">Validar Chasis <i class="fa fa-wrench" aria-hidden="true"></i></button>
                                        </div> 
                                    </div>
                                    </div>
                                <div class="col-7 mt-4" id="divRelleno">

                                </div>
                                <input type="hidden" id="hiddenJsonVehiculos" value="" />
                                <input type="hidden" id="hiddenGuardarDB" value="" />
                                            <input type="hidden" id="parseRepuesta" value="">

                                <input type="hidden" id="bultosIngreso" value="" />

                            </div>       



                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- The Modal -->
<div class="modal fade" id="mdlDepDiffBodega">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Manifiesto de la poliza</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-12" id="tableMrcDiffMani">

                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
<div id="verChasisNoEncon" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Detalle de Todos los Servicios Prestados</h3>
                        </div>
                        <form role="form" method="post">
                            <div class="form-horizontal">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6 col-xs-12"  id="divChaisesNoEncontrados">

                                        </div>
                                        <div class="col-lg-6 col-xs-12 mt-5">
                                            <div class="col-12">
                                                <div class="alert alert-primary">
                                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                    <strong>Información</strong> <br/>Los botones rojos significan que el tipo de vehículo y linea no existe en la base de datos.<br/>Los botones amarillos significan que existen vehículos con tipo y linea similares en predios
                                                </div>
                                                <div class="col-12 mt-4">

                                                    <div class="form-group">
                                                        <label>Buscar linea</label>
                                                        <select class="form-control is-invalid select2" style="width: 100%;" id="selectVehiculos" name="selectVehiculos" required>
                                                            <option selected="selected" disabled="disabled">Seleccione regimen</option>
                                                            <?php
                                                            $respuesta = ControladorOpB::ctrMostrarTiposLines();
                                                            ?>
                                                        </select>

                                                    </div>
                                                </div>
                                                <div class="col-12 mt-4" id="divCompararChasis">


                                                </div>
                                                <div class="col-12 mt-4" id="divButtonsCompara">


                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="card-footer mt-4">
                                        <div class="col-12">
                                            <button type="button" class="btn btn-outline-success btn-block btnGuardarNuevasLineas" data-dismiss="modal">Guardar lineas</button>
                                        </div>
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
