<style>
        .wrapper-iframe {
  position: relative;
  overflow: hidden;
  float: left;


}
    
</style>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Calculos Fiscales</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="Inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Procesos Pendientes</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <div class="col-md-12">
        <div class="card card-primary">
            <form role="form" method="post">
                <div class="card-body">
                    <div class="row">
                        <div id="divDetallePoliza" class="col-md-6 col-sm-12">                           
                        </div> 
                        <div id="divAlerta" class="col-md-3 col-sm-6">
                            <div class="info-box">
                                <span class="info-box-icon bg-danger"><i class="fa fa-exchange"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Cambie la fecha</span>

                                    <div class="input-group input-group">
                                        <input type="text" id="dateTime" class="form-control">
                                        <input type="hidden" id="hiddenDateTime" value="">
                                        <span class="input-group-append">
                                            <button type="button" class="btn btn-danger btnAlmacenajeEspecial"><i class="fas fa-calculator" aria-hidden="true"></i></button>
                                    </div>


                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        </div>                                
                        <div id="divBottons" class="col-12">
                        </div>
                        <div id="divInfo" class=" col-6">
                        </div>
                        <div id="detalleCalculo" class="col-12 respScroll">
                        </div>
                        <div id="divHiddenTotales">
                        </div>
                    </div>
                    <div class="col-12">
                        <table id="tablasGeneral" role="grid" class="table  dt-responsive nowrap table-striped table-bordered display table-sm" cellspacing="0" >
                            <thead>
                                <tr>
                                <th style="whidth:5px">#</th>
                                <th>Nit</th>
                                <th>Empresa</th>
                                <th>Ingreso</th>
                                <th>Poliza</th>
                                <th>Fecha</th>
                                <th>Bultos</th>
                                <th>Cif</th>
                                <th>Impuestos</th>
                                <th>Acciones</th>
                                </tr>
                            </thead> <tbody>
                                <?php
                                $respuesta = ControladorCalculos::ctrMostrarSinCobro();

                                if ($respuesta !== null) {
                                    
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modalCalculos" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>This is a large modal.</p>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-sm-4 col-6">
                            <div class="description-block border-right">
                                <h5 class="description-header">Detalle Poliza</h5>
                                <span class="description-text" id="detallePol"></span>
                            </div>
                        </div>
                        <div class="col-sm-4 col-6">
                            <div class="description-block border-right">
                                <h5 class="description-header">Detalle Valores </h5>
                                <span class="description-text" id="detalleVal"></span>
                            </div>
                        </div>
                        <div class="col-sm-4 col-6">
                            <div class="description-block border-right">
                                <h5 class="description-header">Detalle Espacio</h5>
                                <span class="description-text" id="detalleEspace"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalFacturacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Datos de facturación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-3">
                        <div class="input-group input-group">
                            <input type="text" id="textNit" class="form-control" value="">
                            <span class="input-group-append">
                                <button type="button" class="btn btn-info btnNitFact"><i class="fas fa-search"></i></button>
                            </span>
                            <input type="hidden" id="hiddenDateTimeVal" value="<?php
                                date_default_timezone_set('America/Guatemala');
                                echo $time = date('d-m-Y');
                                ?>" />
                            <input type="hidden" id="hiddenIdentyFact" value="" />
                            <input type="hidden" id="hiddenIdenty" value="" />
                            <input type="hidden" id="hiddenNit" value="" />
                            <input type="hidden" id="hiddenEmpresas" value="" />
                            <input type="hidden" id="hiddenDireccion" value="" />
                            <input type="hidden" id="hiddenresultIdIngreso" value="" />
                            <input type="hidden" id="hiddenOtros" value="" />
                            <input type="hidden" id="hiddenZonaAduana" value="" />    
                            <input type="hidden" id="hiddenAlmacenaje" value="" />       
                            <input type="hidden" id="hiddenManejo" value="" />         
                            <input type="hidden" id="hiddenGstosAdmin" value="" />         
                            <input type="hidden" id="serviciosDefTotal" value="" />         
                            <input type="hidden" id="valDescuento" value="0" />    
                            <input type="hidden" id="spanTotalC" value="" />    
                            <input type="hidden" id="totaTh" value="" /> 
                            <input type="hidden" id="hiddenTotalCobrar" value="" />                             
                            <input type="hidden" id="thAlteracion" value="" />  
                            <input type="hidden" id="hiddenSeguro" value="" />                              
                            <input type="hidden" id="hiddenDescuento" value="0" />
                        </div>
                    </div>
                    <div class="col-9 mt-4">
                        <input type="text" id="textEmpresa" class="form-control" value="">
                    </div>
                    <div class="col-12 mt-4">
                        <input type="text" id="textDereccion" class="form-control" value="">
                    </div>
                    <div class="col-6 mt-4">
                        <div class="card">
                            <div class="card-header border-transparent">
                                <h3 class="card-title">Detalle de almacenaje</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="col-11">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                <th style="width:50%">Almacenaje</th>
                                                <td><center><b id="detalleParseAlmacenaje"></b></center></td>
                                                </tr>
                                                <tr>
                                                <th>Manejo</th>
                                                <td><center><b id="detalleManejo"></b></center></td>
                                                </tr>
                                                <tr>
                                                <th>Gastos Admin:</th>
                                                <td><center><b id="detalleGstsAd"></b></center></td>
                                                </tr>
                                                <tr>
                                                <th>Seguro:</th>
                                                <td><center><b id="detalleParseSeguro"></b></center></td>
                                                </tr>
                                                <tr>
                                                <tr>
                                                <th>Otros:</th>
                                                <td><center><b id="detalleOtros">0</b></center></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <br/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header border-transparent">
                                <h3 class="card-title">Descuentos y Otros</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="col-11">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                <th style="width:50%">Almacenaje</th>
                                                <td>
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" id="txtValDesc" class="form-control" onkeyup="totalAlmDescuento()">
                                                        <span class="input-group-append">
                                                            <button type="button" id="percentQuet" class="btn btn-info btn-flat">%</button>
                                                            <button type="button" class="btn btn-danger btn-flat btnCambioDes" id="cambioTipoTarifa"  estado=0><i class="fas fa-sync-alt"></i></button>
                                                        </span>
                                                    </div>
                                                </td>
                                                </tr>
                                                <tr>
                                                <th style="width:50%">Otros<br/>
                                                    <div id="totalOtros">
                                                    </div>
                                                    <input type="hidden" id="hiddenTotalesOtros" value=0>

                                                    <div id="divOtros"></div>
                                                    <div id="listaEditada">
                                                    </div>
                                                </th>
                                                <td>
                                                    <input type="text" id="agregarMasServicios" class="form-control" value="">
                                                    <br/>
                                                    <div class="input-group input-group-sm">
                                                        <input type="number" class="form-control" id="valOtros">
                                                        <span class="input-group-append">
                                                            <button type="button" class="btn btn-info btn-flat btnAgregarOtros" estado=0>+</button>
                                                        </span>
                                                    </div>
                                                </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="divDescuento" class="col-12">
                        </div>
                    </div>
                    <div class="col-6">
                        <p>Fecha de emisión &nbsp;&nbsp;<strong class="pull-right" style="color:#1976d2"><?php
                                date_default_timezone_set('America/Guatemala');
                                echo $time = date('d-m-Y');
                                ?></strong></p>
                        <p id="datosEjecutivo"></p>
                    </div>
                    <div class="col-6">
                        <div class="info-box mb-3 bg-danger">
                            <span class="info-box-icon"><i class="fas fa-heart"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total a cobrar</span>
                                <span id="totalFacturar" style="font-size:175%">760</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group" data-select2-id="13">
                            <label>Tipo de pago</label>
                            <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                <option>Pagado</option>
                                <option>Credito</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label>Tipo de pago</label>
                            <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                <option>Convenio</option>
                                <option>Transferencia</option>
                                <option>Cuenta</option>
                                <option>Otro</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-4 form-group">
                        <label>Numero de boleta</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-success btnEspecifCobro"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div id="plusServicio"></div>
                    </div>
                </div>
            </div>
            <div class="tipOtros" id="tipOtros">
                <div class="card card-widget widget-user-2">
                    <div class="widget-user-header bg-warning">
                        <button type="button" class="btn btn-tool pull-right btnCerrarOtros"><i class="fas fa-times"></i>
                        </button>
                        <h4>Total Otros gastos</h4>
                    </div>
                    <div id="divCrearListOtros" class="card-footer p-0">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary bntFactRegistro">Facturar e Imprimir Recibo de Almacenaje</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="plusOtrosServicios" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Complete el Formulario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <label>
                            AGREGAR MAS SERVICIOS
                        </label>
                        </input>
                    </div>
                    <div class="col-6 form-group">
                        <label>
                            Nombre del servicio
                        </label>
                        <select class="form-control select2" id="selectOtrosServ"style="width: 100%;">
                            <option selected="selected" disabled="disabled">Seleccione el servicio</option>
                            <?php
                            $respuesta = ControladorPasesDeSalida::ctrMostrarOtrosServicios();
                            ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <div class="col-12">
                            <label>
                                Valor del servicio
                            </label>
                            <div class="input-group">
                                <input class="form-control is-invalid" id="montoOtroServicio" name="montoOtroServicio" placeholder="Ingrese monto del servicio" type="number" />

                                <span class="input-group-append">
                                    <button btnagrega="0" class="btn btn-primary btn-flat btnNuevoServicios" type="button">Agregar nuevo servicio</button>
                                </span>
                            </div>
                        </div>
                        <center><label id="pesoSobregiro" style="color:red;"></label></center>
                    </div>
                    <div class="col-md-12" id="divOtrosServicios"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="plusServiciosDefalult" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Complete el Formulario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="row">
                        <div class="col-12">
                            <label>
                                AGREGAR MAS SERVICIOS
                            </label>
                            </input>
                        </div>
                        <div class="col-6 form-group">
                            <label>
                                Nombre del servicio
                            </label>
                            <select class="form-control select2" id="selectOtrosServDefault"style="width: 100%;">
                                <option selected="selected" disabled="disabled">Seleccione el servicio</option>
                                <?php
                                $respuesta = ControladorPasesDeSalida::ctrMostrarServiciosDefault();
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <div class="col-12">
                                <label>
                                    Valor Peso
                                </label>
                                <div class="input-group">
                                    <input class="form-control is-invalid" id="montoOtroServicioDefault" name="montoOtroServicio" placeholder="Ingrese monto del servicio" type="number" />
                                    <span class="input-group-append">
                                        <button btnagrega="0" class="btn btn-primary btn-flat btnServiciosDefault" type="button">Agregar nuevo servicio</button>
                                    </span>
                                </div>
                            </div>
                            <center><label id="pesoSobregiro" style="color:red;"></label></center>
                        </div>
                        <div class="col-md-12" id="divServiciosDefault"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>