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
        <div class="card card-primary">
            <div class="card-header">
                <h5 class="card-title">Saldos Fiscales</h5>
            </div>
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
                    <div class="row">
                        <div class="col-6 mt-4">
                            <button type="button" class="btn btn-outline-success btn-lg bntReportarLote">Reportar Lote Seleccionado</button>
                        </div>
                        <div class="col-12 mt-4">
                            <table id="tablas" role="grid" class="table  dt-responsive table-striped table-hover table-sm">
                                <thead>
                                    <tr>
                                    <th style="whidth:3px;">#</th>
                                    <th>Nit</th>
                                    <th>Empresa</th>
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
                                    $respuesta = ControladorGeneracionDeContabilidad::ctrMostrarSaldos();
                                    if ($respuesta !== null) {
                                        
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

    <section id="divEdiciones">
        <div class="col-12">
            <div class="card card-success">
                <div class="card-header">
                    <h5 class="card-title">Edición de detalles</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            
                            <label>Selecciona Servicio</label>
                            <input type="hidden" name="ServicioTarifa" id="ServicioTarifa">
                            <input type="hidden" id="hiddenIdentity" value="" />
                            <p>
                                <select class="form-control" style="width: 100%;" id="serviciosEditOp" name="serviciosEditOp" disabled>
                                    <?php
                                    $respuesta = ControladorHistorialIngresos::ctrMostrarServiciosEdit();
                                    ?>
                                </select>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Fecha real de ingreso</label>
                                <div class="input-group input-group" id="divReverse">
                                    <input type="text" id ="dateTimes" class="form-control is-valid" readOnly=""/>
                                    <span class="input-group-append">
                                        <button type="button" class="btn btn-warning btn-flat btnCambiarFecha" estado=0>Cambiar Fecha</button>
                                    </span>
                                </div>
                                <input type="hidden" id="hiddenDateTime" value="<?php
                                date_default_timezone_set('America/Guatemala');
                                echo date('d-m-Y');
                                ?>"/>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="form-group" id="divFechaNuevaEditOP">
                                <label>Configuración de nueva fecha</label>
                                <div class="input-group input-group">
                                    <input type="text" id="dateTime" class="form-control"/>
                                    <span class="input-group-append">
                                        <button type="button" class="btn btn-success btn-flat btnCambiarFechaRever" estado=0>Restablecer fecha</button>
                                    </span>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="form-group"><label>Carta de cupo</label>
                                <input class="form-control" type="text" id="cartaDeCupoEditOp" value="" readOnly="false"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Cantidad de contenedores</label>
                                <input class="form-control" type="text" id="cantContenedoresEditOp" value="" readOnly="false"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>DUA</label>
                                <input class="form-control" type="text" id="duaEditOp" value = "" readOnly="false"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>BL</label>
                                <input class="form-control" type="text" id="blEditOp" value = "" readOnly="false"/>
                            </div>
                        </div>
                        <div class="col-md-4"><div class="form-group">
                                <label>Poliza</label>
                                <input class="form-control" type="text" id="polizaEditOp" value = "" readOnly="false"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Bultos</label>
                                <input class="form-control" type="number" id="bultosEditOp" value = "" readOnly="false"/>
                            </div></div><div class="col-md-4">
                            <div class="form-group">
                                <label>Origen puerto</label>
                                <input class="form-control" type="text" id="puertoOrigenEditOp" value = "" readOnly="false"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Cantidad de clientes</label>
                                <input class="form-control" type="number" id="cantClientesEditOp" value = "" readOnly="false"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Producto</label>
                                <input class="form-control" type="text" id="productoEditOp" value = "" readOnly="false"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Peso</label>
                                <input class="form-control" type="number" id="pesoIngEditOp" value = "" readOnly="false"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Valor total en aduana</label>
                                <input class="form-control" type="number" id="valorTotalAduanaEditOp" value = "" readOnly="false"  onkeyup="capturaConversion()">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tipo de cambio</label>
                                <input class="form-control" type="number" id="tipoDeCambioEditOp" value = "" readOnly="false"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Totan valor CIF</label>
                                <input class="form-control" type="number" id="totalValorCifEditOp" value = "" readOnly="false"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"><label>Valor impuesto</label>
                                <input class="form-control" type="number" id="valorImpuestoEditOp" value = "" readOnly="false"/>
                            </div>
                        </div>

                        <div class="col-md-4" id="opcionesRegimen">
                            <div class="form-group">
                                <label>Regimen</label>
                                <select class="form-control" style="width: 100%;" id="regimenPolizaEditOp" name="regimenPolizaEditOp" disabled>
                                    <?php
                                    $respuesta = ControladorHistorialIngresos::ctrMostrarRegimenes();
                                    ?>
                                </select>
                            </div>

                        </div>
                        <div class="col-8"></div>

                        <div class="col-5">
                            <div class="card">
                                <center><h3>Lista de cliente(s)</h3></center>

                                <div id="divEdicionClientes">


                                </div>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="card">
                                <center><h3>Unidades de ingreso</h3></center>

                                <div id="divEdicionUnidades">


                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div id="divAcciones">
                        </div>
                    </div>
                </div>
            </div>
    </section>
        <section id="divEdicionesBodega">
       <div class="col-12" id="divDetallesMerca"> 
        <div class="card card-success">
        <div class="card-header">
            <h5 class="card-title">Edicion de detalles <?php if (isset($_SESSION["Navega"]) && $_SESSION["Navega"] == "SinNav") {
          echo '&nbsp;&nbsp;&nbsp;&nbsp;'."Su usuario no tiene navegación configurada";
        }else{
          echo '&nbsp;&nbsp;&nbsp;&nbsp;'.$_SESSION["Navega"].'&nbsp;&nbsp;&nbsp;&nbsp;<i id="etiquetaBod">'.$_SESSION["NavegaBod"].'</i>&nbsp;&nbsp;&nbsp;&nbsp;<i id="etiquetaNumBod">'.$_SESSION["NavegaNumB"].'</i>';

        }?></h5>
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
            <h5 class="card-title">Edicion de detalles <?php if (isset($_SESSION["Navega"]) && $_SESSION["Navega"] == "SinNav") {
          echo '&nbsp;&nbsp;&nbsp;&nbsp;'."Su usuario no tiene navegación configurada";
        }else{
          echo '&nbsp;&nbsp;&nbsp;&nbsp;'.$_SESSION["Navega"].'&nbsp;&nbsp;&nbsp;&nbsp;<i id="etiquetaBod">'.$_SESSION["NavegaBod"].'</i>&nbsp;&nbsp;&nbsp;&nbsp;<i id="etiquetaNumBod">'.$_SESSION["NavegaNumB"].'</i>';

        }?></h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12" id="mapeandoUbica">

   
                         <?php
                    $respuesta = ControladorUbicacionBodega::ctrDibujarMapaDetalles();
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


