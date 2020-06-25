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
        <div class="col-md-12">
            <div class="card card-success">
                <div class="card-header">
                    <h5 class="card-title">Formulario de para finalizar</h5>
                </div>
                <form role="form" method="post">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                    <center>Mercadería : Detallar lo recibido en bodega / Generar pase : Autorización de salida de pilotos</center>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                            <div class="col-lg-3 col-xs-12" id="divAgregandoDetalles">
                                <div class="box box-success">
                                    <div class="box-header with-border"></div>
                                    <div class="box-body">
                                        <div class="box">
                                            <!--=====================================
                                            ENTRADA DEL VENDEDOR
                                            ======================================-->
                                            <div class="col-12">
                                                <label id="lblUsuario">Recibido por:&nbsp;&nbsp;<?php echo ($_SESSION['nombre']) . "  " . ($_SESSION['apellidos']); ?></label><br/>

                                            </div>
                                            <div class="col-12">
                                                <label id="idMontacarguista">Montacarguista:&nbsp;&nbsp;</div>
                                            <select class="form-control is-invalid" style="width: 100%;" id="personaSeleccionada" name="personaSeleccionada" required="">
                                                <option selected="selected" disabled="disabled">Seleccione Montacarguista</option>
                                                <?php
                                                $tipoTercero = "Bodega";
                                                $respuesta = ControladorUsuarios::ctrMostrarUsuariosTerceros($tipoTercero);
                                                ?>
                                            </select>
                                            </label><br/>  

                                            <hr>
                                            <div class="col-md-12" id="agregarDetalles">
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
                                    <table id="tablas" role="grid" class="table  dt-responsive nowrap table-striped table-bordered display" cellspacing="0" >
                                        <thead style="background-color: #81BEF7;color: white; font-weight: bold;">
                                            <tr>
                                            <th style="width:10px">#</th>
                                            <th>Empresa</th>
                                            <th style="width:25px">Nit</th>
                                            <th style="width:25px">Bultos</th>
                                            <th style="width:25px">Poliza</th>
                                       <!--     <th>Tarifa</th>-->
                                            <th style="width:30px"><center>Acciones</center></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $respuesta = ControladorIngresosPendientes::ctrMostrarIngresosPendientes();
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-12" id="divDetallesMerca">
                        </div>
                    </div>
                </form>
            </div>
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
                                                            <textarea class="form-control" id="descripcionMerca" name="descripcionMerca" rows="3" onkeyup="javascript:this.value = this.value.toUpperCase();" >RECIBÍ : </textarea>
                                                            <span id="cancelAudio"class="input-group-append">
                                                                <button type="button" id="efectoGrabar" estadoAudio=0 class="btn btn-success btnAudioDescr"><i id="CancelAudio" class='fas fa-microphone-alt' style='font-size:36px;'></i></button>
                                                            </span>
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

                        <button type="button" class="btn btn-success btnGuardaUbicacion"><i class="fas fa-save" style="font-size:48px">&nbsp;&nbsp;Guardar</i></button>

                    </div>
                    <div id="mapEntrada" class="col-1 mt-4 pull-right">
                        <center>Entrada De :<?php echo '&nbsp;&nbsp;&nbsp;&nbsp' . $_SESSION["NavegaBod"] . '&nbsp;&nbsp' . $_SESSION["NavegaNumB"]; ?></center>
                    </div>

                    <div id="mapeandoUbicaciones" class="col-10 mt-4">
                    </div>
                    <div id="mapEntrada" class="col-1 mt-4 pull-right">
                        <center>Fondo De :<?php echo '&nbsp;&nbsp;&nbsp;&nbsp' . $_SESSION["NavegaBod"] . '&nbsp;&nbsp' . $_SESSION["NavegaNumB"]; ?></center>
                    </div>                    
                    <br/><br/><br/><br/>
                    <br/><br/><br/><br/>
                    <div id="mapeandoAcciones" class="col-12">
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
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
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
