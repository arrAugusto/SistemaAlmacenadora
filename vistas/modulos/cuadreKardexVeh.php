
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Cuadrar Kardex</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="./Inicio">Inicio</a></li>
                    </ol>
                </div>

            </div>
            <div class="row">
                <div class="col-8 mt-4">            
                    <div class="card card-info card-outline">
                        <form role="form" method="post">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 mt-4">
                                        <div class="row">
                                            <div class="col-6 mt-4">
                                                <h1>Mercaderias en bodega</h1>
                                            </div> 

                                            <div class="col-6 mt-4">
                                                <button type="button" class="btn btn-outline-info btn-block faPlusData" style="font-size:25px">Escaner codigo <i class="fa fa-qrcode"></i></button>
                                            </div> 
                                        </div> 
                                    </div> 
                                    <div class="col-12 mt-4">
                                        <table id="tbCuadreKardexVeh" role="grid" class="table  dt-responsive table-striped table-hover table-sm">
                                            <thead>
                                                <tr>
                                                <th style="width:3px;">#</th>
                                                <th>Nit</th>
                                                <th>Póliza</th>
                                                <th>Empresa</th>
                                                <th>Chasis</th>
                                                <th>Tipo Veh</th>
                                                <th>Linea Veh</th>
                                                </tr>
                                            </thead> 
                                        </table>

                                    </div> 


                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-4 mt-4">            
                    <div class="card card-info card-outline">
                        <form role="form" method="post">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 mt-4">
                                        <div class="row">

                                            <div class="col-6 mt-4">
                                                <h1>Cuadre de Póliza</h1>
                                            </div>
                                            <div class="col-6 validacionKardex"><i class="fa fa-exclamation-circle" style="font-size: 75px; color: orange;"></i></div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-4" id="cardCuadre">
                                    </div>
                                </div>  
                            </div>
                    </div>
                </div>  
            </div>
        </div><!-- /.container-fluid -->
    </section>
</div>
