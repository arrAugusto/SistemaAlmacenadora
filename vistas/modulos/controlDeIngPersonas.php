
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
                                <button type="button" id="capturarQRPol" class="btn btn-secondary btnCapturarQRPol btn-block" style="font-size:35px">ESCANEAR PÓLIZA&nbsp;&nbsp;&nbsp;<i class='fa fa-barcode' style='font-size:68px;'></i></button>
                            </div>
                        </div>

                        <div class="col-6 mt-5">
                            <div class="col-12 mt-5">
                                <button type="button" id="manifiestosSat" class="btn btn-success btn-block" data-toggle="modal" data-target="#nitPersonas" style="font-size:35px">INGRESO DE PERSONAS&nbsp;&nbsp;&nbsp;<i class='fa fa-external-link-square' style='font-size:68px;'></i></button>
                            </div>
                        </div>                            
                        <div class="col-12 mt-5">                       
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