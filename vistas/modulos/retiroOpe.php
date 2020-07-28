<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Retiro Fiscal</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="Inicio">Inicio</a></li>
                    </ol>
                </div>
            </div>
            <div class="card card-info card-outline">
                <form role="form" method="post">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <input type="text" id="textParamBusqRet" placeholder="Escriba poliza, nit, empresa..." class="form-control is-invalid buscando" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                                <input type="hidden" id="hiddenTipoOP"  value="retiro">
                                <input type="hidden" id="hiddenDateTimeVal" value="" />
                                <input type="hidden" id="hiddenStockIngreso"  value="">

                            </div>  
                            <div class="col-2">
                                <button type="button" class="btn btn-primary btn-block btnBuscaRetiro">Buscar poliza&nbsp;&nbsp;&nbsp;<i class="fa fa-search"></i></button>
                            </div>
                            <div class="col-4">
                                <input type="text" id="dateTime" class="form-control">
                                <input type="hidden" id="hiddenDateTime" value="<?php
                                date_default_timezone_set('America/Guatemala');
                                echo date('Y-m-d H:i:s');
                                ?>">

                            </div>
                            <div class="col-7 mt-4" id="dataRetiro">
                            </div>
                            <div class="col-3 mt-4" id="ListaSelect">
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
                            <div class="col-3 mt-4">
                                <label>Número de licencia</label>
                                <input class="form-control is-invalid" type="number" placeholder="Ejemplo : 2330675310102" id="numeroLicencia" name="numeroLicencia" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                            </div>
                            <div class="col-3 mt-4">
                                <label>Nombre de piloto</label>
                                <input class="form-control is-invalid" type="text" placeholder="Ejemplo : CARLOS FERNANDO LOPEZ AVILA" id="nombrePiloto" name="nombrePiloto" onkeyup="javascript:this.value = this.value.toUpperCase();">
                            </div>
                            <div class="col-3 mt-4" id="divPlaca">
                                <label>Número de placa</label>
                                <input type="text" class="form-control is-invalid" id="numeroPlaca" placeholder="Ejemplo : C250CMK" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                            </div>
                            <div class="col-3 mt-4" id="divCont">
                                <label>Número de contenedor / Tipo Vehiculo</label>
                                <input type="text" class="form-control is-invalid" id="contenedor" placeholder="Ejemplo : SMLU8415002" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                            </div>
                            <input type="hidden" id="arrayListDetalle" value="" />

                            <div class="col-6 mt-4" id="tableVeh">
                            </div>
                            <div class="col-6 mt-4" id="tableMostrarEmpresa">
                            </div>
                            <div class="col-6 mt-4" id="divListaDetalles">
                            </div>
                        </div>
                        <div class="card-footer mt-4" id="divBottoneraAccion">
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary btn-block btnGuardarRetiro">¡Aceptar !&nbsp;&nbsp;&nbsp;<i class="fas fa-map-marker-alt" style="font-size:20px"></i></button>
                            </div>
                        </div>
                        <div id="divExiste"></div>
                        <input type="hidden" id="hiddenTipoRet" value="" />
                        <input type="hidden" id="hiddenGdVehMerc" value="" />
                        <input type="hidden" id="hiddenValorCif" value="" />
                        
                        <input type="hidden" id="hidenPilotosPlus" value="" />
                        <input type="hidden" id="hiddenIdentity" value="" />                        
                    </div>
            </div>
        </div>
    </section>
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
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info btn-flat btn-sm btnGuardaNuevaUnidadPlus" id="btnGuardaNuevaUnidad">Guardar Nueva Unidad</button>
            </div>
        </div>
    </div>
</div>