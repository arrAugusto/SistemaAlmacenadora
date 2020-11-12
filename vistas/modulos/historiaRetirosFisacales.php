<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Historial de retiros fiscales</h1>
                </div>
                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="Inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Procesos Pendientes</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="col-md-12">
        <div class="card card-info card-outline">
            <div class="col-md-12">
                <div class="input-group">
                </div>
            </div>
            <form role="form" method="post">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-sm-12 mt-2">
                            <button type="button" class="btn btn-outline-success btn-lg btn-block btnHistoriaExcelRec"  estadoRep="4">GENERAR HISTORIAL DE RECIBOS EXCEL <i class="fa fa-file-excel-o"></i></button>
                        </div>
                        <div class="col-lg-6 col-sm-12 mt-2">
                            <button type="button" class="btn btn-outline-success btn-lg btn-block btnHistoriaExcelRet"  estadoRep="4">GENERAR HISTORIAL DE RETIROS EXCEL <i class="fa fa-file-excel-o"></i></button>
                        </div>
                        <div class="col-12 mt-5">
                            <table id="tablasHistRetiro" role="grid" class="table  dt-responsive table-striped table-hover table-sm">
                                <thead>
                                    <tr>
                                    <th style="width:auto;">#</th>
                                    <th>Nit</th>
                                    <th>Empresa</th>
                                    <th>Poliza Ing</th>
                                    <th>Poliza Ret</th>
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

        <div class="card card-info card-outline divOculto" id="divEdicionRetiro">
            <form role="form" method="post">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="input-group">
                                <input type="text" id="textParamBusqRet" placeholder="Escriba poliza, nit, empresa..." class="form-control is-invalid buscando" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                                <input type="hidden" id="hiddenTipoOP"  value="retiro">
                                <input type="hidden" id="hiddenDateTimeVal" value="" />
                                <input type="hidden" id="hiddenStockIngreso"  value="">
                                <span class="input-group-append">
                                    <button type="button" class="btn btn-primary btn-block btnBuscaRetiro"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                        </div>
                        <div class="col-3">
                        </div>                        
                        <div class="col-3">
                        </div>
                        <div class="col-7 mt-4" id="dataRetiro">
                        </div>
                        <div class="col-5 mt-4" id="ListaSelect">
                        </div>
                        <input type="hidden" id="hiddenIdentificador" value="" />
                        <input type="hidden" id="hiddeniddeingreso" value="" />
                    </div>
                    <!--INICIO DE DATOS PARA RETIRO OPERACIONES-->
                    <div class="row">
                        <div class="col-3 mt-4">
                            <label>Nit del consignatario</label>
                            <input type="text" class="form-control is-invalid" id="txtNitSalida" dataRetiro="" placeholder="Ejemplo : 37315213" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                        </div>
                        <div class="col-4 mt-4">
                            <label>Nombre del consignatario</label>
                            <input type="text" class="form-control is-invalid" id="txtNombreSalida" placeholder="Ejemplo : AUTOVENTAS, S.A." onkeyup="javascript:this.value = this.value.toUpperCase();" />
                        </div>
                        <div class="col-5 mt-4">
                            <label>Dirección del consignatario</label>
                            <input type="text" class="form-control is-invalid" id="txtDireccionSalida" placeholder="Ejemplo : 9a. Calle 10-58 Zona 0 Guatemala" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                        </div>
                        <div class="col-3 mt-4">
                            <label>Número de Póliza</label>
                            <input type="text" class="form-control is-invalid" id="polizaRetiro" placeholder="Ejmeplo : 2999502532" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                        </div>
                        <div class="col-3 mt-4">
                            <label>Régimen / Modalidad</label>
                            <input type="text" class="form-control is-invalid" id="regimen" placeholder="Ejemplo : ID" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                            <span class="badge bg-danger pull-right" id="spanPoliza" style="display: none;"></span>
                        </div>
                        <div class="col-3 mt-4">
                            <label>Valor en Aduana Total</label>
                            <input type="number" class="form-control is-invalid" id="valorTAduana" placeholder="Ejemplo : 152350" />
                            <span class="badge bg-danger pull-right" id="spanCalculoValorTAduana" style="display: none;"></span>
                        </div>
                        <div class="col-3 mt-4">
                            <label>Tasa de Cambio</label>
                            <input type="number" class="form-control is-invalid" id="cambio" placeholder="Ejemplo : 7.65425" />
                            <span class="badge bg-danger pull-right" id="spanCalculoCambio" style="display: none;"></span>
                        </div>
                        <div class="col-3 mt-4">
                            <label>Total Val. Aduana * Tasa de Cambio</label>
                            <input type="number" class="form-control is-invalid" id="valorCif" placeholder="Ejemplo : 1166124.98 " />

                        </div>
                        <div class="col-3 mt-4">
                            <label>Total General (DAI+IVA)</label>
                            <input type="number" class="form-control is-invalid" id="calculoValorImpuesto" placeholder="Ejemplo : 1166124.98 " />  
                            <span class="badge bg-danger pull-right" id="spanCalculoValorImpuesto" style="display: none;"></span>
                        </div>
                        <div class="col-3 mt-4">
                            <label>Peso Bruto Total KG</label>
                            <input type="number" class="form-control is-invalid" id="pesoKg" placeholder="Ejemplo : 1521" />
                            <span class="badge bg-danger pull-right" id="spanCalculoPesoKg" style="display: none;"></span>
                        </div>
                        <div class="col-3 mt-4">
                            <label>Total de Bultos en Póliza</label>
                            <input type="number" class="form-control is-invalid" id="cantBultos" placeholder="Ejemplo : 52" />
                            <span class="badge bg-danger pull-right" id="spanCalculoCantBultos" style="display: none;"></span>
                        </div>
                        <div class="col-3 mt-4">
                            <label>Descripción de la Mercadería</label>
                            <input type="text" class="form-control is-invalid" id="descMercaderia" placeholder="Ejemplo : PERFILES" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                        </div>
                        <div class="col-3 mt-4" id="divDataLic">
                            <label>Número de licencia</label>
                            <input class="form-control is-invalid" type="number" placeholder="Ejemplo : 2330675310102" id="numeroLicencia" name="numeroLicencia" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                        </div>
                        <div class="col-3 mt-4" id="divDataPiloto">
                            <label>Nombre de piloto</label>
                            <input class="form-control is-invalid" type="text" placeholder="Ejemplo : CARLOS FERNANDO LOPEZ AVILA" id="nombrePiloto" name="nombrePiloto" onkeyup="javascript:this.value = this.value.toUpperCase();">
                        </div>
                        <div class="col-3 mt-4" id="divPlaca">
                            <label>Número de placa</label>
                            <input type="text" class="form-control is-invalid" id="numeroPlaca" placeholder="Ejemplo : C250CMK" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                        </div>
                        <div class="col-3 mt-4" id="divCont">
                            <label>Núm contenedor / Tipo veh</label>
                            <input type="text" class="form-control is-invalid" id="contenedor" placeholder="Ejemplo : SMLU8415002" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                        </div>
                        <div class="col-3 mt-4">
                            <label>Fecha Salida</label>
                            <input type="text" id="dateTime" class="form-control is-valid">
                            <input type="hidden" id="hiddenDateTime" value="<?php
                            date_default_timezone_set('America/Guatemala');
                            echo date('Y-m-d H:i:s');
                            ?>">
                        </div>
                        <input type="hidden" id="arrayListDetalle" value="" />

                        <div class="col-6 mt-4" id="tableVeh">

                        </div>
                        <div class="col-6 mt-4" id="tableMostrarEmpresa">
                        </div>
                        <div class="col-6 mt-4" id="divListaDetalles">
                        </div>
                        <div class="col-9 mt-4" id="divPolizasDR">
                        </div>                            
                    </div>
                    <div class="card-footer mt-4" id="divBottoneraAccion">
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary btn-block btnGuardarRetiro">¡Aceptar !&nbsp;&nbsp;&nbsp;<i class="fa fa-map-marker-alt" style="font-size:20px"></i></button>
                        </div>
                    </div>
                    <div id="divExiste"></div>
                    <input type="hidden" id="hiddenDR" value="" />                        
                    <input type="hidden" id="hiddenTipoRet" value="" />
                    <input type="hidden" id="hiddenGdVehMerc" value="" />
                    <input type="hidden" id="hiddenValorCif" value="" />

                    <input type="hidden" id="hidenPilotosPlus" value="" />
                    <input type="hidden" id="hiddenIdentity" value="" />                        
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalRebajaMercaOp" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modalRebajaMercaOpStock"></h3>
                <button type="button" class="close" data-dismiss="modal" id="cerrarMinModal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
                    <div class="col-6 mt-4">
                        <input class="form-control is-invalid" type="number" id="numeroMarchamoPlusUn" name="numeroMarchamoPlusUn" placeholder="Escriba el numero de marchamo" onkeyup="javascript:this.value = this.value.toUpperCase();">
                    </div>    
                    <div class="col-12 mt-4">
                        <button type="button" id="capturarQRPol" class="btn btn-outline-secondary btnCapturarQRPol btn-block" style="font-size:25px">Codigo de Barras&nbsp;&nbsp;&nbsp;<i class="fa fa-barcode" style="font-size:48px;"></i></button>
                    </div>                        
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info btn-flat btn-sm btnGuardaNuevaUnidadPlus" id="btnGuardaNuevaUnidad">Guardar Nueva Unidad</button>
            </div>
        </div>
    </div>
</div>