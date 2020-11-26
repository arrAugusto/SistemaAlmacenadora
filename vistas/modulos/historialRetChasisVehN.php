<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Historial de ingresos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="Inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Procesos Pendientes</li>
                    </ol>
                </div>
            </div>
            <div class="card card-info card-outline">
                <form role="form" method="post">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 mt-2">
                                <button type="button" class="btn btn-outline-success btn-lg btn-block"  estadoRep="4">GENERAR HISTORIAL DE INGRESO EXCEL <i class="fa fa-file-excel-o"></i></button>
                            </div>
                            <div class="col-6 mt-2">
                                <button type="button" class="btn btn-outline-info btn-lg btn-block btnCorreoDeSolicitud" data-toggle="modal" data-target="#chasisVehiculosNuevos">PREPARAR SOLICITUD DE CHASIS <i class="fa fa-cogs"></i></button>
                            </div>                            
                            <div class="col-12 mt-5">
                                <table id="tableHistChasisVehN" role="grid" class="table  dt-responsive table-striped table-hover table-sm">
                                    <thead>
                                        <tr>
                                        <th style="width:3px;">#</th>
                                        <th>Nit</th>
                                        <th style="width:500px;">Empresa</th>
                                        <th>Poliza</th>
                                        <th>Chasis</th>
                                        <th>Linea </th>
                                        <th>Bultos</th>
                                        <th>Cif</th>
                                        <th>Impuestos</th>                                        
                                        <th><center>Acciones</center></th>
                                        </tr>
                                    </thead> 
                                </table>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.container-fluid -->
    </section><br/><br/><br/><br/>
    <div class="col-12">
        <section id="divEdiciones">
            <div class="card card-success">
                <div class="card-header">
                    <h5 class="card-title">Edición de ingresos</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Selecciona Servicio</label>
                            <input type="hidden" name="ServicioTarifa" id="ServicioTarifa">
                            <input type="hidden" id="hiddenIdentity" value="" />
                            <input type="hidden" id="hiddenDateTimeVal" value="" />
                            <p>
                                <select class="form-control" style="width: 100%;" id="serviciosEditOp" name="serviciosEditOp" disabled>
                                    <?php
                                    $respuesta = ControladorHistorialIngresos::ctrMostrarServiciosEdit();
                                    ?>
                                </select>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Fecha real de ingreso</label>
                                <div class="input-group input-group" id="divReverse">
                                    <input type="text" id ="dateTimes" class="form-control is-valid" readOnly=""/>
                                    <span class="input-group-append">
                                        <button type="button" class="btn btn-warning btn-flat btnCambiarFecha" estado=0>Cambiar Fecha</button>
                                    </span>
                                </div>
                                <input type="hidden" id="hiddenTipoCalcelDate" value="0"/>
                                <input type="hidden" id="hiddenDateTimeEdit" value=""/>
                                <input type="hidden" id="hiddenDateTime" value=""/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group" id="divFechaNuevaEditOP">
                                <label>Configuración de nueva fecha</label>
                                <div class="input-group input-group">
                                    <input type="text" id="dateTime" class="form-control"/>
                                    <span class="input-group-append">
                                        <button type="button" class="btn btn-success btn-flat btnCambiarFechaRever" estado=0>Restablecer fecha</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"><label>Carta de cupo</label>
                                <input class="form-control" type="text" id="cartaDeCupoEditOp" value="" readOnly="false"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Cantidad de contenedores</label>
                                <input class="form-control" type="text" id="cantContenedoresEditOp" value="" readOnly="false"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>DUA</label>
                                <input class="form-control" type="text" id="duaEditOp" value = "" readOnly="false"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>BL</label>
                                <input class="form-control" type="text" id="blEditOp" value = "" readOnly="false"/>
                            </div>
                        </div>
                        <div class="col-md-4"><div class="form-group">
                                <label>Poliza</label>
                                <input class="form-control" type="text" id="polizaEditOp" value = "" readOnly="false"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Bultos</label>
                                <input class="form-control" type="number" id="bultosEditOp" value = "" readOnly="false"/>
                            </div></div><div class="col-md-4">
                            <div class="form-group">
                                <label>Origen puerto</label>
                                <input class="form-control" type="text" id="puertoOrigenEditOp" value = "" readOnly="false"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Cantidad de clientes</label>
                                <input class="form-control" type="number" id="cantClientesEditOp" value = "" readOnly="false"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Producto</label>
                                <input class="form-control" type="text" id="productoEditOp" value = "" readOnly="false"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Peso</label>
                                <input class="form-control" type="number" id="pesoIngEditOp" value = "" readOnly="false"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Valor total en aduana</label>
                                <input class="form-control" type="number" id="valorTotalAduanaEditOp" value = "" readOnly="false"  onkeyup="capturaConversion()">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tipo de cambio</label>
                                <input class="form-control" type="number" id="tipoDeCambioEditOp" value = "" readOnly="false"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Totan valor CIF</label>
                                <input class="form-control" type="number" id="totalValorCifEditOp" value = "" readOnly="false"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"><label>Valor impuesto</label>
                                <input class="form-control" type="number" id="valorImpuestoEditOp" value = "" readOnly="false"/>
                            </div>
                        </div>

                        <div class="col-md-4" id="opcionesRegimen">
                            <div class="form-group">
                                <label>Regimen</label>
                                <select class="form-control" style="width: 100%;" id="regimenPolizaEditOp" name="regimenPolizaEditOp" disabled>
                                    <?php
                                    $respuesta = ControladorHistorialIngresos::ctrMostrarRegimenes();
                                    ?>
                                </select>
                            </div>

                        </div>
                        <div class="col-8"></div>

                        <div class="col-5">
                            <div class="card">
                                <center><h3>Lista de cliente(s)</h3></center>

                                <div id="divEdicionClientes">


                                </div>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="card">
                                <center><h3>Unidades de ingreso</h3></center>

                                <div id="divEdicionUnidades">


                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div id="divAcciones">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<!-- The Modal -->
<div class="modal fade" id="chasisVehiculosNuevos">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-primary">DETALLE DE CORREOS DE VEHÍCULOS NUEVOS&nbsp;&nbsp<i class="fa fa-envelope"></i></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-12" id="tableChasisCorreoPreVisual">
                        
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-success btn-block btnGuardarCorreoChasis">Cargar correo a sistema&nbsp;&nbsp;<i class="fa fa-save"></i></button>
            </div>
        </div>
    </div>
</div>
