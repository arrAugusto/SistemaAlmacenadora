<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Parametrizar Almacenajes</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="Inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Paremetrización de tarifa</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card card-success">
                <div class="card-header">
                    <h5 class="card-title">Parametrizar Almacenajes</h5>
                </div>
                <form role="form" method="post">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <label>Ingresa Nit de cliente</label>

                                <p>
                                    <select class="form-control select2" id="consultaNit" name="consultaNit2">
                                        <option value="">Escriba el nit</option>
                                        <?php
                                        $solicitudNit = controladorServicios::ctrNitClientesTarifaEspecial();
                                        ?>                         </select>
                                <span class="fa fa-pencil"></span>
                                </p>
                            </div>

                            <!-- /.*********************************************************************** -->

                            <div class="col-md-12" id="imprimirCotizacion">

                                <!-- info row -->
                                <div class="row invoice-info">
                                    <div class="col-sm-5 invoice-col">
                                        <label >Datos del cliente</label>
                                        <address>
                                            <b>Nit: </b>
                                            <label id="lblNit" style="font-weight: normal;"></label><br>
                                            <input type="hidden" id="lblCliente" name="lblCliente" value="">
                                            <b>Empresa: </b>
                                            <label id="lblEmpresa" style="font-weight: normal;"></label><br>
                                            <b>Direccion: </b>
                                            <label id="lblDireccion" style="font-weight: normal;"></label><br>
                                            <b>Direccion de cobro: </b>
                                            <label id="lblDireccionCobro" style="font-weight: normal;"></label><br>
                                            <b>Telefono: </b>
                                            <label id="lblTelefono" style="font-weight: normal;"></label><br>
                                            <b>Correo: </b>
                                            <label id="lblCorreo" style="font-weight: normal;"></label><br>
                                        </address>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-5 invoice-col">
                                        <b>Datos Ejecutivo</b><br>
                                        <input type="hidden" id="lblEjecutivo" name="lblEjecutivo" value="">
                                        <br>
                                        <b>Ejecutivo: </b>
                                        <label id="lblNombreEjecutivo" style="font-weight: normal;"></label><br>
                                        <b>Telefono: </b>
                                        <label id="lblTelefonoE" style="font-weight: normal;"></label><br>
                                        <b>Correo: </b>
                                        <label id="lblCorreoE" style="font-weight: normal;"></label><br>
                                    </div>
                                    <div class="col-sm-2 invoice-col">
                                        <b>Cotizacion #: </b>
                                        <label id="lblNumeroSerie" style="font-weight: normal;"></label><br>
                                        <b>Estado Cotizacion</b>
                                        <br>
                                        <label id="lblEstadoTarifa" style="font-weight: normal; color: red"></label>
                                        <label id="lblEstadoTarifaVigente" style="font-weight: normal; color: blue"></label><br>
                                        <input type="hidden" name="estadoNumeroSerie" id="estadoNumeroSerie" value="">
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <!-- Table row -->
                                <div class="row" id="divTableAccTar">
                                    

                                </div>
                                <!-- /.col -->
                            </div>
                        </div>
                        <!-- /.*********************************************************************** -->
                        <div class="btn-group" id="btnActivaImpreme">
                            <!--
                            <button type="button" class="btn btn-danger btn-sm btnActivacion">Desactiva</button>
                            
                            <input type="button"  class="btn btn-dark btn-sm" onclick="printDiv('imprimirCotizacion')" value="Imprimir Cotizacion" />
                            -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>


<div id="UpdateServiciosAlmacenajes" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Almacen Fiscal</h3>
                        </div>
                        <form role="form" method="post"  >
                            <div class="form-horizontal">
                                <div class="card-body">
                                    <div class="row" id="divServicios">


                                    </div>
                                </div>
                                <button type="button" class="btn btn-outline-info btn-block" data-dismiss="modal">Salir</button>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="UpdateServiciosSeguro" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Seguro Fiscal</h3>
                        </div>
                        <form role="form" method="post"  >
                            <div class="form-horizontal">
                                <div class="card-body">
                                    <div class="row" id="divServiciosSeguro">



                                    </div>
                                </div>
                                <button type="button" class="btn btn-outline-info btn-block" data-dismiss="modal">Salir</button>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<div id="UpdateServiciosManejo" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Seguro Fiscal</h3>
                        </div>
                        <form role="form" method="post"  >
                            <div class="form-horizontal">
                                <div class="card-body">
                                    <div class="row" id="divServiciosManejo">



                                    </div>
                                </div>
                                <button type="button" class="btn btn-outline-info btn-block" data-dismiss="modal">Salir</button>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>






<div id="UpdateGastosAdministracion" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Seguro Fiscal</h3>
                        </div>
                        <form role="form" method="post"  >
                            <div class="form-horizontal">
                                <div class="card-body">
                                    <div class="row" id="divServiciosGastosAdmin">



                                    </div>
                                </div>
                                <button type="button" class="btn btn-outline-info btn-block" data-dismiss="modal">Salir</button>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





<div id="UpdateOtrosGastos" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Seguro Fiscal</h3>
                        </div>
                        <form role="form" method="post"  >
                            <div class="form-horizontal">
                                <div class="card-body">
                                    <div class="row" id="divServiciosOtrosGastos">



                                    </div>
                                </div>
                                <button type="button" class="btn btn-outline-info btn-block" data-dismiss="modal">Salir</button>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
