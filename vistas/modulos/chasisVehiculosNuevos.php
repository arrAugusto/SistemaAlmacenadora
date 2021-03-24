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

    <div class="col-md-6 mt-4">
        <button type="button" class="btn btn-outline-success btn-block btnDescargaExcelVehNew">Descargar excel vehículos nuevos</button>
    </div>

            <form role="form" method="post">
                <div class="card-body">
                    <div class="row"><!--
                        <div class="col-lg-6 col-sm-12 mt-2">
                            <button type="button" class="btn btn-outline-success btn-lg btn-block btnHistoriaExcelRec"  estadoRep="4">GENERAR HISTORIAL DE RECIBOS EXCEL <i class="fa fa-file-excel-o"></i></button>
                        </div>
                        <div class="col-lg-6 col-sm-12 mt-2">
                            <button type="button" class="btn btn-outline-success btn-lg btn-block btnHistoriaExcelRet"  estadoRep="4">GENERAR HISTORIAL DE RETIROS EXCEL <i class="fa fa-file-excel-o"></i></button>
                        </div>-->

                        <div class="col-12 mt-5">
                            <table id="tablasChasisNew" role="grid" class="table  dt-responsive table-striped table-hover table-sm">
                                <thead>
                                    <tr>
                                    <th style="whidth:3px;">#</th>
                                    <th>Empresa</th>
                                    <th>Póliza</th>
                                    <th>Régimen</th>
                                    <th>Fecha Ingreso</th>                                    
                                    <th>Chasis Veh.</th>
                                    <th>Tipo Veh.</th>
                                    <th>Linea Veh.</th>
                                    <th>Predio</th>
                                    <th>Estado</th>
                                    <th><center>Acciones</center></th>
                                    </tr>
                                </thead> 
              
                            </table>
                        </div>
                    </div>
                </div>
            </form>
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
            
            <div class="card-body col-12 mt-4" id="ListaSelect"></div>

            
            <div class="modal-footer">
                <button type="button" class="btn btn-info btn-flat btn-sm btnGuardaNuevaUnidadPlus" id="btnGuardaNuevaUnidad">Guardar Nueva Unidad</button>
            </div>
        </div>
    </div>
</div>


