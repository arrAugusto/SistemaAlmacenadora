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
                    <!--     <button type="button" class="btn btn-default" id="daterange-btn2">
                             <span>
                                 <i class="fa fa-calendar"></i> Rango de fecha
                             </span>
                             <i class="fa fa-caret-down"></i>
                         </button>-->
                </div>
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