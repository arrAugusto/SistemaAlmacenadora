<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pases de Salida</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="Inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Pases de salida Bodega</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <div class="col-md-12">
        <div class="card card-success card-outline">

            <form role="form" method="post">
                <div class="card-body">
                    <div class="col-12" id="divAlerta">

                    </div>
                    <div>
                        <input type="hidden" id="hiddenTipoOP" value="" />
                    </div>
                    <div class="col-12">
                        <div class="row" id="divCalculoHistoria">
                        </div>

                        <?php
                        if ($_SESSION["departamentos"] != "Operaciones Fiscales") {
                            echo '
    
                         </div>
<div class="alert alert-danger" role="alert">
Las mercaderías listadas son clientes que estan por retirarse,
si la mercaderia no puede salir, comuniquese con el area de oficinas fiscales
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>   
    
    ';
                        }
                        ?>
                        <div class="col-12 mt-4">
                            <table id="tablas" role="grid" class="table dt-responsive table-striped table-hover table-sm" >
                                <thead>
                                    <tr>
                                    <th style="whidth:5px">#</th>
                                    <th>Nit</th>
                                    <th>Nombre de Empresa</th>
                                    <th>Poliza Ing</th>
                                    <th>Poliza Ret</th>
                                    <th>Bultos</th>
                                    <th>Peso</th>
                                    <th>Servicio</th>
                                    <?php
                                    if ($_SESSION["departamentos"] == "Operaciones Fiscales") {
                                        echo '<th>Acciones</th>';
                                    }
                                    ?>
                                    </tr>
                                </thead> <tbody>
                                    <?php
                                    $respuesta = ControladorPasesDeSalida::ctrListarRetiros();
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade responsive" id="modalPaseSalida" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-4">
                            <label>Póliza de ingreso</label>
                            <input type="text" class="form-control" id="polizaIngreso" value="" disabled/>
                        </div>
                        <div class="col-4">
                            <label>Póliza de retiro</label>
                            <input type="text" class="form-control" id="polizaRetiro" value="" disabled/>
                        </div>  
                        <div class="col-4">
                            <label>Numero de retiro</label>
                            <input type="text" class="form-control" id="numeroRetiro" value="" disabled/>
                        </div>
                        <div class="col-4 mt-4">
                            <label>Valor en Aduana Total</label>
                            <input type="number" class="form-control is-invalid" id="valorDoll" placeholder="Ejemplo : 40525.23" value=""/>
                            <span class="badge bg-danger pull-right" id="spanvalorDoll" style="display: none;"></span>
                        </div>
                        <div class="col-4 mt-4">
                            <label>Tasa de Cambio</label>                        
                            <input type="number" class="form-control is-invalid" id="tCambio" placeholder="Ejemplo : 7.6452" value=""/>
                            <span class="badge bg-danger pull-right" id="spantCambio" style="display: none;"></span>                        
                        </div>
                        <div class="col-4 mt-4">
                            <label>Total Val. Aduana * Tasa de Cambio</label>   
                            <input type="number" class="form-control is-invalid" id="cif" placeholder="Ejemplo : 309823.49" value=""/>
                            <span class="badge bg-danger pull-right" id="spancif" style="display: none;"></span>                        

                        </div>
                        <div class="col-4 mt-4">
                            <label>Total General (DAI+IVA)</label>
                            <input type="number" class="form-control is-invalid" id="impuestos" placeholder="Ejemplo : 41252.13" value=""/>
                            <span class="badge bg-danger pull-right" id="spanimpuestos" style="display: none;"></span>                        

                        </div>
                        <div class="col-4 mt-4">
                            <label>Peso Bruto Total KG</label>
                            <input type="number" class="form-control is-invalid" id="peso" placeholder="Ejemplo : 524.25" value=""/>
                            <span class="badge bg-danger pull-right" id="spanpeso" style="display: none;"></span>                        

                        </div>
                        <div class="col-4 mt-4">
                            <label>Total de Bultos en Póliza</label>
                            <input type="number" class="form-control is-invalid" id="bultos" placeholder="Ejemplo : 5" value=""/>
                            <span class="badge bg-danger pull-right" id="spanbultos" style="display: none;"></span>                        
                        </div>
                        <div class="col-12 mt-4">
                                <div class="input-group input-group-sm">
                                    <input type="hidden" id="hiddenLista" value="">
                                    <textarea class="form-control textoQRPoliza" rows="5" ></textarea>
                                    <span class="input-group-append">
                                        <button type="button" id="capturarQRPol" class="btn btn-dark btnCapturarQRPol"><i class='fa fa-barcode' style='font-size:48px;color:white'></i></button>
                                    </span>
                                </div>
                        </div>                    
                        
                        <input type="hidden" id="hiddenvalorDoll" value="">
                        <input type="hidden" id="hiddentCambio" value="">
                        <input type="hidden" id="hiddencif" value="">
                        <input type="hidden" id="hiddenimpuestos" value="">
                        <input type="hidden" id="hiddenbultos" value="">
                        <input type="hidden" id="hiddenMarchElect" value="">

                        <input type="hidden" id="hiddenpeso" value="">
                        <input type="hidden" id="hiddenOtros" value="">
                        <input type="hidden" id="spanTotalC" value="">
                        <input type="hidden" id="hiddenZonaAduana" value="">  

                        <input type="hidden" id="hiddenRevision" value="">                     
                        <input type="hidden" id="hiddenAlmacenaje" value="">                    
                        <input type="hidden" id="hiddenManejo" value="">                    
                        <input type="hidden" id="hiddenGstosAdmin" value="">                    
                        <input type="hidden" id="hiddenresultIdIngreso" value="">                    
                        <input type="hidden" id="serviciosDefTotal" value="">
                        <input type="hidden" id="valDescuento" value="">   
                        <input type="hidden" id="hiddenTotalCobrar" value="">                    
                        <input type="hidden" id="hiddenDescuento" value=""> 
                    </div>
                </div>
                <div class="modal-footer" id="divButtonPase">
                    <button type="button" class="btn btn-primary btnImprimirRecibo" id="btnCalculoAlm" data-dismiss="modal">Confirmar datos <i class="far fa-check-circle"></i></button>
               </div>
            </div>
        </div>
    </div>
    <div class="tipOtros responsive" id="tipOtros">
        <div class="card card-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-warning">
                <button type="button" class="btn btn-tool pull-right btnCerrarOtros"><i class="fa fa-times"></i>
                </button>
                <h4>Total Otros gastos</h4>
            </div>
            <div id="divCrearListOtros" class="card-footer p-0">

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
                                    Valor Peso
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


    <!-- Modal -->
    <div class="modal fade" id="plusPilotos" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 id="modalRebajaMercaOpStock"></h3>
                    <button type="button" class="close" data-dismiss="modal" id="cerrarMinModal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6 mt-4">
                            <input class="form-control is-invalid" type="number" placeholder="Ingrese numero de licencia sin guiones" id="numeroLicenciaPlus" name="numeroLicencia" onkeyup="javascript:this.value = this.value.toUpperCase();" value="" />
                            <input type="hidden" id="idPilotoPlusUni" value="" />
                        </div>
                        <div class="col-6 mt-4">
                            <input class="form-control is-invalid" type="text" placeholder="Ingrese nombre del piloto" id="nombrePilotoPlusUn" name="nombrePiloto" onkeyup="javascript:this.value = this.value.toUpperCase();" value="" />
                        </div>
                        <div class="col-6 mt-4">
                            <input class="form-control is-invalid" type="text" id="numeroPlacaPlusUn" name="numeroPlaca" placeholder="Escriba el numero de placa" onkeyup="javascript:this.value = this.value.toUpperCase();">
                        </div> 
                        <div class="col-6 mt-4">
                            <input class="form-control is-invalid" type="text" id="numeroContenedorPlusUn" name="numeroContenedor" placeholder="Escriba el numero de contenedor" onkeyup="javascript:this.value = this.value.toUpperCase();">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info btn-flat btn-sm btnGuardaNuevaUnidadPlus" id="btnGuardaNuevaUnidad">Guardar Nueva Unidad</button>
                </div>
            </div>
        </div>
    </div>