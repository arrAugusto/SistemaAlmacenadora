
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Control de ingreso de personas</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
        <div class="card card-info card-outline">

            <form role="form" method="post">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 mt-5">                       
                            <div class="col-12 mt-5">
                                <button type="button" id="btnCapturarQRCtrPersonal" class="btn btn-secondary btnCapturarQRPol btn-block" style="font-size:35px">ESCANEAR LICENCIA&nbsp;&nbsp;&nbsp;<i class='fa fa-barcode' style='font-size:68px;'></i></button>
                            </div>
                        </div>

                        <div class="col-6 mt-5">                       
                            <div class="col-12 mt-5">
                                <button type="button" id="btnCapturarQRCtrPersonalDPI" class="btn btn-secondary btnCapturarQRPol btn-block" style="font-size:35px">ESCANEAR DPI&nbsp;&nbsp;&nbsp;<i class='fa fa-barcode' style='font-size:68px;'></i></button>
                            </div>
                        </div>
                        <div class="col-4 mt-5 mt-4">
                            <input type="text" class="form-control" placeholder="Procedencía" id="procedencia" value="" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                        </div>
                        <div class="col-4 mt-5 mt-4">
                            <input type="text" class="form-control" placeholder="Destino" id="destino" value="" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                        </div>
                        <div class="col-4 mt-5 mt-4">
                            <input type="text" class="form-control" placeholder="Placa"  id="placa" value="" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                        </div>                        
                        <div class="col-12 mt-5">    
                            <div id="datosDeVisitantes">



                            </div>

                        </div>
                        <div class="col-12 mt-5">
                                <button type="button" class="btn btn-primary btn-block gdVisitaExterna" style="font-size:25px">GUARDAR VISITA&nbsp;&nbsp;&nbsp;<i class='fa fa-save' style='font-size:48px;'></i></button>
                        </div>                            
                    </div>
                </div>
            </form>
        </div>

    </section>
</div>

<!-- The Modal CAPTURA UBICACIONES -->

<div class="modal fade" id="nitPersonas">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Manifiestos SAT</h4>
                <button type="button" class="close" id="buttonMin1" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">

                    <div class="col-12">
                        <iframe id="myFrameManifiesto" src="https://portal.sat.gob.gt/portal/consulta-cui-nit#wpb_text_column" title="W3Schools HTML Tutorial" height="550px" width="99%"></iframe>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>