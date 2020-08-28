<style>
    .cardVehUs {
        background: #058BBD;
        border-radius: 2px;
        display: inline-block;
        height: 100%;
        margin: 1rem;
        position: relative;
        width: 100%;
        color: #FFFFFF;
    }
    .card-1 {
        box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
        transition: all 0.3s cubic-bezier(.25,.8,.25,1);
    }

    .card-1:hover {
        box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
    }

</style>

<div class="content-wrapper">
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
            <div class="card card-success">
                <form role="form" method="post">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <input type="text" id="calculoTextParamBusqRet" class="form-control" placeholder="Escriba poliza, nit, empresa..." onkeyup="javascript:this.value = this.value.toUpperCase();" autocomplete="off" />
                                <input type="hidden" id="hiddenGdVehMerc"  value="">

                                <input type="hidden" id="hiddenStockIngreso"  value="">
                            </div>
                            <div class="col-2">
                                <button type="button" class="btn btn-primary btn-block btnCalculoBusqueda">Buscar poliza&nbsp;&nbsp;&nbsp;<i class="fa fa-search"></i></button>
                            </div>
                            <br/><br/><br/>
                            <div class="col-7" id="dataRetiro">
                            </div>
                            <div class="col-5" id="ListaSelect">
                            </div>
                            <input type="hidden" id="hiddenIdentificador" value="">
                            <input type="hidden" id="hiddeniddeingreso" value="">
                        </div>

                        <!--INICIO DE DATOS PARA RETIRO OPERACIONES-->
                        <div class="row">
                            <div class="col-3 mt-5">
                                <label>Nit del consignatario</label>
                                <input type="text" class="form-control is-invalid" id="calculoTxtNitSalida" dataRetiro="" placeholder="Ejemplo : 37315439" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                                <input type="hidden" id="hiddenIdNitSalida" value =""/>
                            </div>
                            <div class="col-4 mt-5">
                                <label>Nombre del consignatario</label>
                                <input type="text" class="form-control is-invalid" id="calculoTxtNombreSalida" placeholder="Ejemplo : AUTOVENTAS, S.A." onkeyup="javascript:this.value = this.value.toUpperCase();" />
                            </div>
                            <div class="col-5 mt-5">
                                <label>Dirección del consignatario</label>                                
                                <input type="text" class="form-control is-invalid" id="calculoTxtDireccionSalida" placeholder="Ejemplo : 9a. Calle 10-58 Zona 0 Guatemala" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                            </div>

                            <div class="col-3 mt-4">
                                <label>Número de Póliza</label>    
                                <input type="text" class="form-control is-invalid" id="calculoPolizaRetiro" placeholder="Ejemplo : 2889504525">
                            </div>

                            <div class="col-3 mt-4">
                                <label>Régimen / Modalidad</label>    
                                <input type="text" class="form-control is-invalid" id="calculoRegimen" placeholder="Ejemplo : ID" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                                <span class="badge bg-danger pull-right" id="spanPoliza" style="display: none;"></span>

                            </div>

                            <div class="col-3 mt-4">
                                <label>Valor en Aduana Total</label>    
                                <input type="number" class="form-control is-invalid" id="calculoValorTAduana" placeholder="Ejemplo : 13545">
                                <span class="badge bg-danger pull-right" id="spanCalculoValorTAduana" style="display: none;"></span>
                            </div>

                            <div class="col-3 mt-4">
                                <label>Tasa de Cambio</label>    
                                <input type="number" class="form-control is-invalid" id="calculoCambio" placeholder="Ejemplo : 7.656">
                                <span class="badge bg-danger pull-right" id="spanCalculoCambio" style="display: none;"></span>

                            </div>
                            <div class="col-3 mt-4">
                                <label>Total Val. Aduana * Tasa de Cambio</label>
                                <input type="number" class="form-control is-invalid" id="calculoValorCif" placeholder="Ejemplo : 103700.52">
                            </div>


                            <div class="col-3 mt-4">
                                <label>Total General (DAI+IVA)</label>
                                <input type="number" class="form-control is-invalid" id="calculoValorImpuesto" placeholder="Ejemplo : 75213">
                                <span class="badge bg-danger pull-right" id="spanCalculoValorImpuesto" style="display: none;"></span>

                            </div>
                            <div class="col-3 mt-4">
                                <label>Peso Bruto Total KG</label>
                                <input type="number" class="form-control is-invalid" id="calculoPesoKg" placeholder="Ejemplo : 1250">
                                <span class="badge bg-danger pull-right" id="spanCalculoPesoKg" style="display: none;"></span>

                            </div>
                            <div class="col-3 mt-4">
                                <label>Total de Bultos en Póliza</label>
                                <input type="number" class="form-control is-invalid" id="calculoCantBultos" placeholder="Ejemplo : 23">
                                <span class="badge bg-danger pull-right" id="spanCalculoCantBultos" style="display: none;"></span>

                            </div>

                            <div class="col-6 mt-4">
                                <label>Calculado hasta :</label>
                                <div class="input-group input-group">
                                    <input type="text" id="dateTime" class="form-control">
                                    <input type="hidden" id="hiddenDateTime" value="<?php
                                    date_default_timezone_set('America/Guatemala');
                                    echo date('Y-m-d H:i:s');
                                    ?>">
                                    <span class="input-group-append">
                                        <button type="button" class="btn btn-success btnCalcularAlmacenaje">Calcular Almacenaje&nbsp;&nbsp;<i class="fa fa-calculator"></i></button>
                                    </span>
                                </div>
                            </div>
                            <div class="col-3 mt-4" id="divCalcVehUsados">

                            </div>
                            <div class="col-3 mt-4" id="divDetVehUsados">

                               

                                </div>
                            </div>
                            <input type="hidden" id="hiddenZonaAduana" value="" />
                            <input type="hidden" id="hiddenAlmacenaje" value="" />
                            <input type="hidden" id="hiddenManejo" value="" />
                            <input type="hidden" id="hiddenGstosAdmin" value="" />
                            <input type="hidden" id="hiddenTotalCobrar" value="" />
                            <input type="hidden" id="hiddenOtros" value="" />
                            <input type="hidden" id="serviciosDefTotal" value="" />
                            <input type="hidden" id="valDescuento" value="" />
                            <input type="hidden" id="hiddenDescuento" value="" />
                            <input type="hidden" id="hiddenTxtNitSalida" value=""/>
                            <input type="hidden" id="hiddenTxtNombreSalida" value=""/>
                            <input type="hidden" id="hiddenTxtDireccionSalida" value=""/>
                            <input type="hidden" id="hiddenPolizaRetiro" value=""/>
                            <input type="hidden" id="hiddenRegimen" value=""/>
                            <input type="hidden" id="hiddenValorTAduana" value=""/>
                            <input type="hidden" id="hiddenCambio" value=""/>
                            <input type="hidden" id="hiddenValorCif" value=""/>
                            <input type="hidden" id="hiddenValorImpuesto" value=""/>
                            <input type="hidden" id="hiddenPesoKg" value=""/>
                            <input type="hidden" id="hiddenCantBultos" value=""/>
                            <input type="hidden" id="hiddenEstadoCalculo" value=""/>
                            <input type="hidden" id="hiddenDateTimeVal" value=""/>
                            <input type="hidden" id="hiddenTipoOP" value=""/>
                            <div class="col-12 responsive divCalculoDetalle mt-4" id="divCalculoDetalle">
                            </div>
                            <div id="divExiste">
                            </div>
                        </div>
                    </div>
                </form>
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
                    <div class="col-12" id="tableMostrarEmpresa">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- The Modal -->
<div class="modal fade" id="AnulacionIngreso">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Modal Heading</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <label>
                            Numero de Ingreso
                        </label>
                        <input class="form-control is-invalid" id="numeroIngreso" type="text" value = "" readonly="readonly" />
                    </div>
                    <div class="col-12">
                        Motivo de anulación &nbsp;&nbsp;Palabras Aceptadas <strong id="conteoCaracteres">150</strong>
                        <textarea class="form-control is-invalid" rows="3" id="textMotivoAnulacion" name="text">SE ANULO DEBIDO A : </textarea>
                    </div>                    
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="anulacionDefinitiva" numeroIdIngreso="" disabled="disabled" />Anular Ingreso&nbsp;&nbsp;<i class="fa fa-trash"></i></button>
            </div>

        </div>
    </div>
</div>

<!-- The Modal -->
<div class="modal fade" id="modalCalculo">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Modal Heading</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 mt-4">
                        <label>Calculado hasta :</label>
                        <div class="input-group input-group">
                            <input type="hidden" id="hiddenDateTime" value="<?php
                            date_default_timezone_set('America/Guatemala');
                            echo date('Y-m-d H:i:s');
                            ?>">
                            <span class="input-group-append">
                                <button type="button" class="btn btn-danger btnCalcularAlmacenaje"><i class="fa fa-calculator"></i></button>
                                <input type="hidden" id="hiddenDateTimeVal" value="1"/>
                            </span>
                        </div>
                    </div>
                    <div class="col-12 divCalculoHistoria mt-4" id="divCalculoHistoria">                
                    </div>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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