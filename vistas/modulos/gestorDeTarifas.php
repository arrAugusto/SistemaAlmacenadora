<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Gestor de Tarifas</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="Inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Gestor de Usuarios</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
        <div class="card card-info card-outline">
            <!-- form start -->
            <form class="form-horizontal" method="post">
                <div class="card-body">
                    <!--- =======================
                    INICIO
                    ======================-->
                    <div class="box-body">
                        <table id="tablasGeneral" role="grid" class="table dt-responsive nowrap table-striped table-bordered display table-sm tb-responsive" cellspacing="0" >
                            <thead style="background-color: #81BEF7;color: white; font-weight: bold;">
                                <tr>
                                <th style="whidth:5px">#</th>
                                <th>Nit</th>
                                <th>Nombre de empresa</th>
                                <th>Contacto</th>
                                <th>Telefono</th>
                                <th>Email</th>
                                <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $respuesta = ControladorGestorDeTarifas::ctrMostrarTarifas();
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>


<div id="MostrarTodoServicio" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Detalle de todos los servicios prestados</h3>
                        </div>
                        <form role="form" method="post">
                            <div class="form-horizontal">
                                <div class="row" id="divMostrarTodoServicio">
                                    <div class="card-body">



                                        <div  id="divServicio">


                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title">Recently Added Products</h3>
                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool" data-widget="collapse">
                                                            <i class="fa fa-minus"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-tool" data-widget="remove">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="card-body p-0">
                                                    <ul class="products-list product-list-in-card pl-2 pr-2">
                                                        <li class="item">
                                                            <div class="product-img">
                                                                <span><i class="fa fa-close"></i></span>
                                                            </div>
                                                            <div class="product-info">


                                                                <span class="product-description">
                                                                    <div class="alert alert-primary" role="alert">
                                                                        <div class="row">
                                                                            <div class="col-12" style=" border-style: ridge; border-width: 2px; border-color: #60D13F; bord">
                                                                            </div>
                                                                            <div class="col-6" style=" border-style: ridge; border-width: 2px; border-color: #60D13F; bord">
                                                                            </div>
                                                                            <div class="col-6" style=" border-style: ridge; border-width: 2px; border-color: #60D13F; bord">
                                                                            </div>
                                                                            <div class="col-6" style=" border-style: ridge; border-width: 2px; border-color: #60D13F; bord">
                                                                            </div>
                                                                            <div class="col-6" style=" border-style: ridge; border-width: 2px; border-color: #60D13F; bord">
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </span>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <!-- /.card-body -->
                                                <div class="card-footer text-center">
                                                    <a href="javascript:void(0)" class="uppercase">View All Products</a>
                                                </div>
                                                <!-- /.card-footer -->
                                            </div>



                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-info btn-block" data-dismiss="modal">Salir</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>



