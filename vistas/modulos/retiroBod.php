<style>

    #tableSalidaBodega td:nth-child(5){

        border: 1px solid #f57f17;
        font-weight: normal;
        text-align: center;

    }
    #tableSalidaBodega td:nth-child(6){

        border: 1px solid #f57f17;
        font-weight: normal;
        text-align: center;

    }

    #tableSalidaBodega td:nth-child(7){

        border: 1px solid #f57f17;
        font-weight: normal;
        text-align: center;

    }
    #tableSalidaBodega td:nth-child(8){

        border: 1px solid #f57f17;
        font-weight: normal;
        text-align: center;

    }



    #tableSalidaBodega th:nth-child(1){
        background-color: #0d47a1;
        border: 1px solid #0d47a1;
        font-weight: normal;
        text-align: center;
        color: white;        
    }
    #tableSalidaBodega th:nth-child(2){
        background-color: #0d47a1;
        border: 1px solid #0d47a1;
        font-weight: normal;
        text-align: center;
        color: white;        
    }
    #tableSalidaBodega th:nth-child(3){
        background-color: #0d47a1;
        border: 1px solid #0d47a1;
        font-weight: normal;
        text-align: center;
        color: white;        
    }
    #tableSalidaBodega th:nth-child(4){
        background-color: #0d47a1;
        border: 1px solid #0d47a1;
        font-weight: normal;
        text-align: center;
        color: white;          
    }
    #tableSalidaBodega th:nth-child(5){
        background-color: #1d96b2;
        border: 1px solid #1d96b2;
        font-weight: normal;
        text-align: center;
        color: white;       
    }
    #tableSalidaBodega th:nth-child(6){
        background-color: #1d96b2;
        border: 1px solid #1d96b2;
        font-weight: normal;
        text-align: center;
        color: white;        
    }
    #tableSalidaBodega th:nth-child(7){
        background-color: #1d96b2;
        border: 1px solid #1d96b2;
        font-weight: normal;
        text-align: center;
        color: white;   
    }  
    #tableSalidaBodega th:nth-child(8){
        background-color: #1d96b2;
        border: 1px solid #1d96b2;
        font-weight: normal;
        text-align: center;
        color: white;         
    }  
    #tableSalidaBodega th:nth-child(9){
        background-color: #0288d1;
        border: 1px solid #0288d1;
        font-weight: normal;
        text-align: center;
        color: white;        
    }      
    #tableSalidaBodega th:nth-child(10){
        background-color: #0288d1;
        border: 1px solid #0288d1;
        font-weight: normal;
        text-align: center;
        color: white;        
    }#tableSalidaBodega th:nth-child(11){
        background-color: #0288d1;
        border: 1px solid #0288d1;
        font-weight: normal;
        text-align: center;
        color: white;        
    }  
    #tableSalidaBodega th:nth-child(12){
        background-color: #0288d1;
        border: 1px solid #0288d1;
        font-weight: normal;
        text-align: center;
        color: white;        
    }  
    #tablePosMetraje th:nth-child(3){
        background-color: #0288d1;
        border: 1px solid #0288d1;
        font-weight: normal;
        text-align: center;
        color: white;        
    }   
    #tablePosMetraje td:nth-child(3){
        background-color: #F18B08;    

        font-weight: normal;
        text-align: center;
        color: white;   
        border-radius: 1px;

    }

</style>


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
                                    <table id="tablasGeneral" role="grid" class="table  dt-responsive nowrap table-hover table-sm" cellspacing="0">
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
                        if ($_SESSION["departamentos"] == "Bodegas Fiscales" || $_SESSION["departamentos"] == "Operaciones Fiscales") {
                            echo '
                <div class="col-12 mt-4">
        <div class="card card-dark">
            <div class="card-header">
                <h5 class="card-title">Registrar Salida de Mercadería  <button type="button" class="btn btn-outline-warning btn-sm btnLimpiarRetiros">Limpiar Pantalla <i class="fa fa-signing"></i></button</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mt-1">
<div class="alert alert-warning">
  <strong>Cambios en este modulo!</strong> Borra tu historial de navegación para recargar esta nueva función, las columnas turquesas remarcadas con color Naranja los saldos actuales del sistema.
</div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 mt-4" id="divTableRetiraBodega">

                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 mt-4" id="divPOSMetraje">

                    </div>                    
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mt-4" id="divTablePilotos">

                    </div>
<div class="col-12 mt-4">
     
                        
                        <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-6 mt-4" id="divRetiroOperacion">
      


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
                                            <span class="info-box-icon"><i class="fa fa-dolly"></i></span>
                                        </div>
                                        <div class="product-info" style="text-align: justify;">
                                            <span class="product-description" id="txtDescripcionRet">
                                            </span>
                                        </div>
                                            <div class="description-block border-right">
                                                <h5 class="description-header">Poliza   e ingreso</h5>
                                                <span class="description-text" id="txtPolizaIng"></span>
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
                                                        <span class="info-box-icon"><i class="fa fa-route"></i></span>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="hiddenidIngreso" value="">
                <input type="hidden" id="hiddenidRetiro" value="">
            </div>
        </div>
    </div>
</div>


<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Modal Heading</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
                  <h5 class="card-title">Retiro de Mercadería</h5>

            <!-- Modal body -->
            <div class="modal-body">
                Modal body..
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
