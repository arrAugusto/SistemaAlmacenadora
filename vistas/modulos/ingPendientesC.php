<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Inventarios Fiscales</h1>
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

            <form role="form" method="post">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3 mt-4">
                            <button type="button" class="btn btn-success btn-lg btn-block btnDescargaExcelIngRep"  estadoRep="4">DESCARGA EXCEL DE INGRESOS <i class="fa fa-file-excel-o"></i></button>
                        </div>   
                        
                        <div class="col-3 mt-4">
                            <button type="button" class="btn btn-outline-info btn-lg btn-block btnCargaMasiva" id="btnMasivo" estadoRep="4">REPORTAR PÓLIZAS <i class="fa fa-level-up"></i></button>
                        </div>   

                        <div class="col-3 mt-4">
                            <button type="button" class="btn btn-outline-primary btn-lg  btn-block bntReportarLote">Reportar Lote Seleccionado</button>
                        </div>

                        <div class="col-3 mt-4">
                            <label>Fecha Contabilidad :</label>
                            <div class="input-group input-group">
                                <input type="text" id="dateTime" class="form-control">
                                <input type="hidden" id="hiddenDateTime" value="<?php
                                date_default_timezone_set('America/Guatemala');
                                echo date('Y-m-d H:i:s');
                                ?>">
                                <input type="hidden" id="hiddenDateTimeVal" value="" />
                                <span class="input-group-append">
                                    <button type="button" class="btn btn-info btnMatenerFecha" estado="0">Congelar Fecha</button>
                                </span>

                            </div>
                        </div>
                        <div class="col-12 mt-4">
                            <table id="tablasGeneral" role="grid" class="table  dt-responsive table-striped table-hover table-sm">
                                <thead>
                                    <tr>
                                    <th style="whidth:3px;">#</th>
                                    <th>Nit</th>
                                    <th>Empresa</th>
                                    <?php
                                    if ($_SESSION["departamentos"] == "Operaciones Fiscales" && $_SESSION["niveles"] == "MEDIO") {
                                        echo '<th>Bodega</th>';
                                    }
                                    ?>
                                    <th>Poliza</th>
                                    <th>Fecha</th>
                                    <th>Bultos</th>
                                    <th>Cif</th>
                                    <th>Impuestos</th>
                                    <th><center>Acciones</center></th>
                                    </tr>
                                </thead> <tbody>
                                    <?php
                                    if (isset($_GET["fechaInicial"])) {
                                        $fechaInicial = $_GET["fechaInicial"];
                                        $fechaFinal = $_GET["fechaFinal"];
                                    } else {
                                        $fechaInicial = null;
                                        $fechaFinal = null;
                                    }
                                
                                    $estado = 4;
                                
                                    $respuesta = ControladorGeneracionDeContabilidad::ctrMostrarSaldos($estado);
                                    if ($respuesta != null) {
                                        
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <section id="divEdicionesBodega">
        <div class="col-12" id="divDetallesMerca"> 
            <div class="card card-success">
                <div class="card-header">
                    <h5 class="card-title">Edicion de detalles <?php
                        if (isset($_SESSION["Navega"]) && $_SESSION["Navega"] == "SinNav") {
                            echo '&nbsp;&nbsp;&nbsp;&nbsp;' . "Su usuario no tiene navegación configurada";
                        } else {
                            echo '&nbsp;&nbsp;&nbsp;&nbsp;' . $_SESSION["Navega"] . '&nbsp;&nbsp;&nbsp;&nbsp;<i id="etiquetaBod">' . $_SESSION["NavegaBod"] . '</i>&nbsp;&nbsp;&nbsp;&nbsp;<i id="etiquetaNumBod">' . $_SESSION["NavegaNumB"] . '</i>';
                        }
                        ?></h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12" id="divContenidoEdicionBodega">



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="divTableUbi">
        <div class="col-12" id="divTableUbicciones"> 
            <div class="card card-success">
                <div class="card-header">
                    <h5 class="card-title">Edicion de detalles <?php
                        if (isset($_SESSION["Navega"]) && $_SESSION["Navega"] == "SinNav") {
                            echo '&nbsp;&nbsp;&nbsp;&nbsp;' . "Su usuario no tiene navegación configurada";
                        } else {
                            echo '&nbsp;&nbsp;&nbsp;&nbsp;' . $_SESSION["Navega"] . '&nbsp;&nbsp;&nbsp;&nbsp;<i id="etiquetaBod">' . $_SESSION["NavegaBod"] . '</i>&nbsp;&nbsp;&nbsp;&nbsp;<i id="etiquetaNumBod">' . $_SESSION["NavegaNumB"] . '</i>';
                        }
                        ?></h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12" id="mapeandoUbica">


                            <?php/*
                            $respuesta = ControladorUbicacionBodega::ctrDibujarMapaDetalles();*/
                            ?>

                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div id="mapeandoAcciones" class="col-12"></div>
        <div class="card-footer mt-4" id="divBottoneraAccion">
            <div class="btn-group" id="divBotonesAcciones">

            </div>
        </div>
        <br/>
        <br/>
        <br/>
        <br/><br/>
        <br/>
        <br/>
        <br/>
        <br/><br/>

    </section>  

    <div class="tip" id="tip2">
        <div class="info-box-content">
            <b id="numIng"></b><br/>
            <b id="numPoliza"></b><br/>
            <b id="Nomempresa"></b><br/>
            <b id="cantBultos"></b><br/>
            <b id="CantpesoKg"></b><br/>
            <b id="descripcion"></b><br/>
            <b id="posiciones"></b><br/>
            <b id="metros"></b><br/>

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
                <button type="button" class="btn btn-danger" id="anulacionDefinitiva" numeroIdIngreso="" disabled="disabled" />Anular Ingreso&nbsp;&nbsp;<i class="fas fa-trash"></i></button>
            </div>

        </div>
    </div>
</div>


