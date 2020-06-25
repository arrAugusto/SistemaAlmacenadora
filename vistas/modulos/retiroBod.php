<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Retiro Fiscal Bodega</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    </ol>
                </div>
            </div>
            <div class="card card-success">
                <div class="card-body">
                    <form role="form" method="post">
                        <div class="row">
                            <div class="col-12">
                                <?php
                                if ($_SESSION["departamentos"] != "Operaciones Fiscales") {
                                    echo '<div class="col-12">
                                        </div>  
                                            <div class="alert alert-danger" role="alert">
                                            Las mercaderías listadas son clientes que estan por retirarse,
                                            si la mercaderia no puede salir, comuniquese con el area de oficinas fiscales ' . $_SESSION["NavegaBod"] . ' - ' . $_SESSION["NavegaNumB"]
                                    . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div></div>';
                                } else {
                                    echo ' <div class="col-12">
                                        <div class="alert alert-primary" role="alert">
                                            ¡Listado de retiros pendientes!
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div></div>    
                          ';
                                }
                                ?>
                                <div class="col-12 mt-4">
                                    <table id="tablas" role="grid" class="table  dt-responsive nowrap table-hover table-sm" cellspacing="0">
                                        <thead>
                                            <tr>
                                            <th style="whidth:5px">#</th>
                                            <th>Nit</th>
                                            <th>Empresa</th>
                                            <th>Pol. Ingreso</th>
                                            <th>Regimen</th>
                                            <th>Pol. Retiro</th>
                                            <th>Numero Retiro</th>
                                            <th>Bultos</th>
                                            <th>Peso</th>    
                                            <th>Cargar Orden</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $respuesta = ControladorRetirosBodega::ctrRebajarRetiroBod();
                                            ?>
                                        </tbody>
                                    </table    
                                </div>
                            </div>
                        </div>

                        <?php
                        if ($_SESSION["departamentos"] == "Bodegas Fiscales" || $_SESSION["departamentos"] == "Operaciones Fiscales" && $_SESSION["niveles"] == "BAJO") {
                            echo '
                <div class="col-12 mt-4">
        <div class="card card-dark">
            <div class="card-header">
                <h5 class="card-title">Registrar Salida de Mercadería  <button type="button" class="btn btn-outline-warning btn-sm btnLimpiarRetiros">Limpiar Pantalla <i class="fa fa-signing"></i></button</h5>
            </div>
            <div class="card-body">
                <div class="row">

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 mt-4" id="divTableRetiraBodega">

                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 mt-4" id="divTablePilotos">

                    </div>
<div class="col-12 mt-4">
     
                        
                        <div class="form-group col-3" id="divRetiroOperacion">
      


                        </div>

                    </div>
                </div>

            </div>
        </div>

</div>';
                        }
                        ?>
                    </form>
                </div>
            </div>
        </div>
</div>
</section>
</div>

<!-- Modal -->
<div class="modal fade" id="modalRebajaMerca" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Retiro de Mercadería</h5>

                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <!-- /.col -->
                                    <div class="col-md-9" id="divDetallesRetBod">
                                        <p class="text-center">
                                            <strong id="detPolRet"></strong>
                                        </p>
                                        <div class="progress-group">
                                            <strong>Empresa:</strong>
                                            <span class="float-right" id="txtEmpresaRet">Almacenadora Integrada, S.A.</span>
                                        </div>
                                        <div class="progress-group">
                                            <strong>Bultos:</strong>
                                            <span class="float-right" id="txtBultosRet">10 Bultos</span>
                                        </div>
                                        <div class="progress-group">
                                            <strong>Peso kg:</strong>
                                            <span class="float-right" id="txtPesoKg">2,250 kg</span>
                                        </div>


                                        <div class="product-img">
                                            <span class="info-box-icon"><i class="fas fa-dolly"></i></span>
                                        </div>
                                        <div class="product-info" style="text-align: justify;">
                                            <span class="product-description" id="txtDescripcionRet">
                                            </span>
                                        </div>


                                        <div class="card-footer mt-4">
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="btn-group">
                                                        <div class="product-img">
                                                            <span class="info-box-icon"><i class="fa fa-building"></i></span>
                                                        </div>
                                                        <div id="empresasPosiciones"></div>                                     </div>

                                                </div>
                                                <div class="col-8">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3" id="divUbicacionRetBod">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title">Ubicación de los Productos</h3>
                                            </div>
                                            <ul class="products-list product-list-in-card pl-2 pr-2">
                                                <li class="item">
                                                    <div class="product-img">
                                                        <span class="info-box-icon"><i class="fas fa-route"></i></span>
                                                    </div>
                                                    <div class="product-info">
                                                        <div id="divUbicacionesRet">

                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>                                               
                                        </div>

                                    </div>
                                </div>
                                <div class="card-footer mt-4">
                                    <div class="row">
                                        <div class="col-sm-3 col-6">
                                            <div class="description-block border-right">
                                                <h5 class="description-header">Bultos <i class="fas fa-box-open"></i></h5>
                                                <span class="description-text" id="bltsActuales"></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-6">
                                            <div class="description-block border-right">
                                                <h5 class="description-header">Posiciones <i class="fas fa-map-pin"></i></h5>
                                                <span class="description-text" id="posActuales"></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-6">
                                            <div class="description-block border-right">
                                                <h5 class="description-header">Metros <i class="fas fa-map"></i></h5>
                                                <span class="description-text" id="mtsActuales"></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-6">
                                            <div class="description-block border-right">
                                                <h5 class="description-header">Poliza   e ingreso</h5>
                                                <span class="description-text" id="txtPolizaIng"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info btnPreparacionSaldia" id="btnPreparaSalida" idRetiro=>Salida Bodega <i class="fas fa-door-open"></i></button>
                    <input type="hidden" id="hiddenidIngreso" value="">
                    <input type="hidden" id="hiddenidRetiro" value="">
                </div>
            </div>
        </div>
    </div>
