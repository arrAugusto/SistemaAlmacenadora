<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Retiro Fiscal Bodega</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    </ol>
                </div>
            </div>
            <div class="card card-success">
                <div class="card-header">
                    <h5 class="card-title">Parametrizar Almacenajes</h5>
                </div>
                <div class="card-body">
                    <form role="form" method="post">
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-primary" role="alert">
                                    ¡Listado de retiros pendientes!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>

                            <div class="col-12 mt-4">
                                <table id="tablas" role="grid" class="table  dt-responsive nowrap table-hover table-sm" cellspacing="0">

                                    <thead>
                                        <tr>
                                        <th style="whidth:5px">#</th>
                                        <th>Empresa</th>
                                        <th>Chasis</th>
                                        <th>Tipo Veh</th>
                                        <th>Linea Veh</th>
                                        <th>Poliza Ing</th>
                                        <th>Poliza Ret</th>
                                        <th>Num Ret</th>
                                        <th>Predio</th>
                                        <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $respuesta = ControladorRetirosRebajados::ctrRetAutorizadosSalida();
                                        ?>
                                    </tbody>
                                </table    
                            </div>
                        </div>


                </div>
                </form>
            </div>
        </div>
</div>
</section>
</div>


<div id="cambioChasis" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            <div class="modal-body">
                <!--=====================================
                INICIO FORM
                ======================================-->
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Busqueda de chasises para reversión</h3>
                        </div>
                        <!--campos formularios -->
                        <form role="form" method="post">
                            <div class="form-horizontal">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <label>Ingrese el numero de póliza</label>
                                            <div class="input-group" id="divVehRegresion">
                                                <input type="text" id="textParamBusqRet" placeholder="Escriba poliza, nit, empresa..." class="form-control is-invalid buscando" onkeyup="javascript:this.value = this.value.toUpperCase();">
                                                <input type="hidden" id="hiddenTipoOP" value="retiro">
                                                <input type="hidden" id="hiddenDateTimeVal" value="">
                                                <span class="input-group-append">
                                                    <button type="button" class="btn btn-primary btn-block btnBuscaRetiro">Buscar poliza&nbsp;&nbsp;&nbsp;<i class="fa fa-search" aria-hidden="true"></i></button>                                                
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"></div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <label>Chasis Anterior</label>
                                            <div class="input-group" id="divVehRegresion">
                                                <input type="text" id="textChasisAnt"  class="form-control is-valid buscando" readOnly="readOnly" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                                                <input type="hidden" id="idChasAnt" value="" />
                                                <span class="input-group-append">
                                                    <button type="button" class="btn btn-warning btn-block" disabled="disabled">Anterior</button>                                                
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <label>Chasis Anterior</label>
                                            <div class="input-group" id="divVehRegresion">
                                                <input type="text" id="textChasNuevo"  class="form-control is-valid buscando" readOnly="readOnly" onkeyup="javascript:this.value = this.value.toUpperCase();" />
                                                <input type="hidden" id="idChasNew" value="" />
                                                <span class="input-group-append">
                                                    <button type="button" class="btn btn-outline-primary btn-block btnRevesionChasis">Cambiar</button>                                                
                                                </span>
                                            </div>
                                        </div>                                        
                                        <div class="col-12 mt-4" id="dataRetiro">

                                        </div>  
                                        <div class="col-12 mt-4" id="tableVeh">

                                        </div>  
                                        <input type="hidden" id="hiddenIdentificador" value="">
                                        <input type="hidden" id="hiddeniddeingreso" value="">
                                        <input type="hidden" id="hiddenGdVehMerc" value="vehN">
                                        <input type="hidden" id="hiddenVehReg" value="vehN">


                                        <!--=====================================
                                        FIN FORM
                                        ======================================-->
                                    </div>

                                </div>  
                            </div>  


                        </form> 
                    </div>     

                </div>

            </div>

        </div>
    </div>
</div>