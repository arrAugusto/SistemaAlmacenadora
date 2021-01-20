<style>
    .has-error .select2-selection {
        border-color: rgb(185, 74, 72) !important;
    }
    .has-success .select2-selection {
        border-color: #00AA0D !important;
    }
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Ingresos pendientes de finalizar</h1>
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
                        <div class="col-12">
                            <?php
                            if ($_SESSION["departamentos"] == "Bodegas Fiscales" && $_SESSION["niveles"] == "BAJO" || $_SESSION["departamentos"] == "Bodegas Fiscales" && $_SESSION["niveles"] == "MEDIO" || $_SESSION["departamentos"] == "Operaciones Fiscales" && $_SESSION["niveles"] == "BAJO") {
                                echo '
                                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                    <center>Mercadería : Detallar lo recibido en bodega / Generar pase : Autorización de salida de pilotos</center>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
                            } else if ($_SESSION["departamentos"] == "Operaciones Fiscales" && $_SESSION["niveles"] == "MEDIO") {
                                echo '
                                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                    <center>El ingreso de mercaderia aún no se a culminado</center>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
                            }
                            ;
                            ?>
                        </div>
                        <?php
                        if ($_SESSION["departamentos"] == "Bodegas Fiscales" || $_SESSION["departamentos"] == "Operaciones Fiscales") {
                            echo '
                            <div class="col-lg-3 col-xs-12" id="divAgregandoDetalles">
                                <div class="box box-success">
                                    <div class="box-header with-border"></div>
                                    <div class="box-body">
                                        <div class="box">
                                            <!--=====================================
                                            DATOS DE CHEQUE
                                            ======================================-->
                                           <div class="col-12">';
                            ($_SESSION['nombre']) . "  " . ($_SESSION['apellidos']);
                            echo '</label><br/>
                                            </div>
                                            <div class="col-12 has-error" id="divMontarguist" style="display: none;">
                                                <label id="idMontacarguista">Montacarguista:&nbsp;&nbsp;     </label>
                                                <select class="select2 form-control is-invalid montacarguista" style="width: 100%;" id="personaSeleccionada" name="personaSeleccionada" required="">
                                                <option selected="selected" disabled="disabled">Seleccione Montacarguista</option>';
                            $tipoTercero = "Bodega";
                            $bodega = $_SESSION["idDeBodega"];
                            $respuesta = ControladorUsuarios::ctrMostrarUsuariosTerceros($tipoTercero, $bodega);
                            echo '
                                            </select>
                                       
                                               </div>
 
                                            <div class="col-md-12 mt-4" id="agregarDetalles">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <div class="col-md-9" id="tableDinamicIngBod">
                                <!-- formrt -->
                                <div class="card-body">
                                    <!--- =======================
                                    INICIO
                                    ======================-->
                          
                            <table id="tablasGeneral" role="grid" class="table dt-responsive table-striped table-hover table-sm" >
                                        <thead style="background-color: #81BEF7;color: white; font-weight: bold;">
                                            <tr>
                                            <th style="width:1%;">#</th>
                                            <th style="width:25%;">Empresa</th>
                                            <th style="width:5%;">Nit</th>
                                            <th style="width:5%;">Bultos</th>
                                            <th style="width:8%">Poliza</th>
                                            <th style="width:8%">Fecha Operación</th>
                                            <th style="width:8%">Tiempo</th>
                                            <th style="width:8%"><center>Acciones</center></th>
                                            </tr>
                                        </thead>
                                        <tbody>';
                            $respuesta = ControladorIngresosPendientes::ctrMostrarIngresosPendientes();

                            echo '</tbody>
                                    </table>
                                </div>
                            </div>          ';
                        } else if ($_SESSION["niveles"] == "ALTO" && $_SESSION["departamentos"] == "Operaciones Generales" || $_SESSION["departamentos"] == "Ventas" || $_SESSION["departamentos"] == "Gerencia") {

                            echo '
                            <div class="col-md-11" id="tableDinamicIngBod">
                                <!-- formrt -->
                               
                                <div class="card-body">
                                    <!--- =======================
                                    INICIO
                                    ======================-->                         
                              <table id="tablasGeneral" role="grid" class="table dt-responsive table-striped table-hover table-sm" >
                                      <thead style="background-color: #81BEF7;color: white; font-weight: bold;">
                                            <tr>
                                            <th style="width:1%;">#</th>
                                            <th style="width:25%;">Empresa</th>
                                            <th style="width:5%;">Nit</th>
                                            <th style="width:5%;">Bultos</th>
                                            <th style="width:8%">Poliza</th>
                                            <th style="width:10%">Fecha Operación</th>
                                            <th style="width:8%">Tiempo</th>
                                            <th style="width:8%"><center>Acciones</center></th>
                                            </tr>
                                        </thead>
                                        <tbody>';
                            $respuesta = ControladorIngresosPendientes::ctrMostrarIngresosPendientes();
                            echo '</tbody>
                                    </table>
                                </div>
                            </div>
                            ';
                        }
                        ?>
                    </div>
                    <div class="col-12" id="divDetallesMerca">
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>

<!-- The Modal CAPTURA DE INFORMACION INGRESO -->
<div class="modal fade" id="agrDetalles">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Detalle de bodega </h4>
                <button type="button" class="close" id="buttonMin" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div id="mapaGenerado" class="row">
                    <div class="col-12" id="tableMercaderia" >
                    </div>
                    <!-- Main content -->
                    <div class="col-12 mt-2">
                        <section class="content">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Detalle de vehículos</h4>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                        <!-- /. box -->
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-6" id="datoEmpresa">
                                                        <div class="form-group tooltips">
                                                            <label>Empresa</label>
                                                            <input type="text" class="form-control" id="nombreEmpresa" name="nombreEmpresa" placeholder="Nombre de Empresa" value="" readOnly="false" />
                                                            <span>Seleccione la empresa, presionando el boton verde "Seleccionar"</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-3" id="datoBltsEmp">
                                                        <div class="form-group">
                                                            <label>Cantidad de bultos</label>
                                                            <input type="text" class="form-control"  id="cantidadBultos" name="cantidadBultos" placeholder="Numero de bultos" value="" readOnly="false" />
                                                        </div>
                                                    </div>
                                                    <div class="col-3" id="datoPesoEmp">
                                                        <div class="form-group">
                                                            <label>Peso en kg</label>
                                                            <input type="text" class="form-control"  id="pesoKg" name="pesoKg" placeholder="Numero de bultos" value="" readOnly="false" />
                                                        </div>
                                                    </div>
                                                    <div class="col-4 mt-4" id="divUbicacionMerc">
                                                        <input type="hidden" id="hiddenUbicaciones" name="hiddenUbicaciones" value="" />
                                                        <div class="form-group">
                                                            <label>Ubicación</label>
                                                            <select class="form-control select2 select2-hidden-accessible" name="selectUbicacion" id="selectUbicacion" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                                                <option selected="selected">Selecione Ubicación</option>
                                                                <option>Piso</option>
                                                                <option>Rack</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-1 mt-4"  id="divFueraMotivo">
                                                    </div>
                                                    <div class="col-7 mt-4"  id="ubicacionesSelect">
                                                    </div>
                                                    <div class="col-12 mt-4" id="chasisVeh"></div>
                                                    <div class="col-12 mt-2  mt-4" id="divObserva">
                                                        <div class="input-group input-group-sm">
                                                            <input type="hidden" id="hiddenLista" value="" />
                                                            <textarea class="form-control" id="descripcionMerca" name="descripcionMerca" rows="3" onkeyup="javascript:this.value = this.value.toUpperCase();" value="">OBSERVACIONES :</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-6 mt-2" id="mdStandarTarima">
                                                        <label>Medida estándar por tarima</label>
                                                        <div class="input-group input-group-sm">
                                                            <input type="number" class="form-control"  id="proTarima" name="proTarima" value="" />
                                                            <span id="btnProTarima"class="input-group-append">
                                                                <button type="button" class="btn btn-info btnPromedioTarima" id="btnPromedioTarima">Guardar promedio de tarima</button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-6 mt-2"></div>
                                                    <div class="col-6 mt-2" id="divTarPrivar"></div>        
                                                    <div class="col-6 mt-2" id="divTarPrivarMts"></div>
                                                    <div class="col-12">
                                                        <!-- /btn-group -->
                                                        <div class="input-group" id="newTxtBtn">
                                                            <input type="number" id="cantidadPosiciones" name="cantidadPosiciones" class="form-control" placeholder="Cantidad de posiciones" style="text-align: center;" value="" />
                                                            <input type="number" id="Metraje" name="Metraje" class="form-control" placeholder="Cantidad de Metros" style="text-align: center;" value="" />
                                                            <div class="input-group-append">
                                                                <button type="button" estadoBoton=0 id="GuardarIngBod" idIngresoPB=0 idDetalle=0 class="btn btn-primary btnADetalle">Aceptar</button>
                                                            </div>
                                                            <!-- /btn-group -->
                                                        </div>
                                                        <!-- /input-group -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- The Modal CAPTURA UBICACIONES -->
<div class="modal fade" id="MyagrUbicacion">
    <div class="modal-dialog modal-lgMapa">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Ubicaciones <?php echo '&nbsp;&nbsp;&nbsp;&nbsp' . $_SESSION["Navega"] . '&nbsp;&nbsp;&nbsp;&nbsp' . $_SESSION["NavegaBod"] . '&nbsp;&nbsp;&nbsp;&nbsp' . $_SESSION["NavegaNumB"]; ?> </h4>
                <button type="button" class="close" id="buttonMin1" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div id="mapaGenerado" class="row">
                    <div class="col-12">
                        <button type="button" class="btn btn-success btnGuardaUbicacion"><i class="fa fa-save" style="font-size:48px">&nbsp;&nbsp;Guardar</i></button>
                    </div>
                    <div id="mapEntrada" class="col-1 mt-4 pull-right">
                        <center>Entrada De :<?php echo '&nbsp;&nbsp;&nbsp;&nbsp' . $_SESSION["NavegaBod"] . '&nbsp;&nbsp' . $_SESSION["NavegaNumB"]; ?></center>
                    </div>
                    <div id="mapeandoUbicaciones" class="col-10 mt-4">
                    </div>
                    <div id="mapEntrada" class="col-1 mt-4 pull-right">
                        <center>Fondo De :<?php echo '&nbsp;&nbsp;&nbsp;&nbsp' . $_SESSION["NavegaBod"] . '&nbsp;&nbsp' . $_SESSION["NavegaNumB"]; ?></center>
                    </div>                    
                    <div id="mapeandoAcciones" class="col-12 mt-4">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- The Modal CAPTURA DE INFORMACION INGRESO -->
<div class="modal fade" id="modalSalidaRapida">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Contenedores - Pases de salida vacio</h4>
                <button type="button" class="close" id="buttonMin" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="input-group col-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                        </div>
                        <input type="text" class="form-control" value="<?php echo ($_SESSION['nombre']) . "  " . ($_SESSION['apellidos']); ?>" readOnly/>
                    </div>
                    <div class="col-12 mt-4" id="tablePilotos">
                    </div>            
                </div>
            </div>
        </div>
    </div>
</div>

<!-- The Modal -->
<div class="modal fade" id="mdlDepDiffBodega">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Manifiesto de la poliza</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-12" id="tableMrcDiffMani">

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

<!-- The Modal -->
<div class="modal fade" id="modalCarousel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Configuración detalles vehiculos usados</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <div class="sticky-top mb-3">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Detalles de vehículos</h4>
                                </div>
                                <div class="card-body">
                                    <!-- the events -->
                                    <div id="external-events">
                                        <button type="button" class="btn btn-success btn-block mt-4 divDetalleVehUsaLlave" id="divDetalleVehUsa">LLAVE</button>
                                        <button type="button" class="btn btn-info btn-block mt-4 divDetalleVehUsaBat" id="divDetalleVehUsa">BATERIA</button>
                                        <button type="button" class="btn btn-danger btn-block mt-4 divDetalleVehUsaRad" id="divDetalleVehUsa">RADIO</button>
                                        <button type="button" class="btn btn-warning btn-block mt-4 divDetalleVehUsaLlanta" id="divDetalleVehUsa">LLANTA DE REPUESTO</button>
                                        <button type="button" class="btn btn-primary btn-block mt-4 divDetalleVehUsaTr" id="divDetalleVehUsa">TRIQUE</button>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </div>
                    <div class="col-6" id="divDetalle">
                        <textarea class="form-control" id="textDetalleVeh" name="textDetalleVeh" rows="3" onkeyup="javascript:this.value = this.value.toUpperCase();" value=""></textarea>
                    </div>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>