<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Parametrizar Almacenajes</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="Inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Paremetrización de tarifa</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card card-success">
                <div class="card-header">
                    <h5 class="card-title">Parametrizar Almacenajes</h5>
                </div>
                <form role="form" method="post">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <label>Ingresa Nit de cliente</label>
                                <p>
                                    <select class="form-control select2" id="consultaNit1" name="consultaNit1">
                                        <option value="">Escriba el nit</option>
                                        <?php
                                        $item = null;
                                        $valor = null;
                                        $perfil = "externo";
                                        $user = ControladorUsuarios::ctrMostrarUsuarios($item, $valor, $perfil);
                                        foreach ($user as $key => $value) {
                                            echo '<option value="' . $value["id"] . '">' . $value["nit"] . ' </option>';
                                        }
                                        ?>
                                    </select>
                                <span class="fa fa-pencil"></span>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <div class="card card-success card-outline">

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    </div>
                                    <div class="card-body box-profile">

                                        <div class="col-12">
                                            <b value="" style="font-size:175%; color:black;">Datos generales de la empresa</b>

                                        </div>
                                      <div class="col-12">
                                            <hr><b style="font-size:125%; color:#0e4ebe;">Codigo:</b>
                                            <label id="lblCodigo" style="font-size:125%; color:#0e4ebe;"></label>
                                       <input type="hidden" id="lblCliente" name="lblCliente" value="">
                                        </div>
                                        <div class="col-12">
                                            <b style="font-size:125%; color:#0e4ebe;">Nit:</b>
                                            <label id="lblNit" style="font-size:125%; color:#0e4ebe;"></label>
                                        </div>
                                        <div class="col-12">
                                            <b style="font-size:125%; color:#0e4ebe;">Empresa:</b>
                                            <label id="lblEmpresa" style="font-size:125%; color:#0e4ebe;"></label>
                                        </div>
                                        <div class="col-12">
                                            <b style="font-size:125%; color:#0e4ebe;">Direccion:</b>
                                            <label id="lblDireccion" style="font-size:125%; color:#0e4ebe;"></label>
                                        </div>
                                        <div class="col-12">
                                            <b style="font-size:125%; color:#0e4ebe;">Direccion de cobro:</b>
                                            <label id="lblDireccionCobro" style="font-size:125%; color:#0e4ebe;"></label>
                                        </div>
                                             <div class="col-12">
                                           
                                            </div>
                                    

                                        <div class="col-12">
                                            <b style="font-size:125%; color:#0e4ebe;">Telefono:</b>
                                            <label id="lblTelefono" style="font-size:125%; color:#0e4ebe;"></label>

                                        </div>

                                        <div class="col-12" id="cantServicios">  
                                            <b style="font-size:125%; color:#0e4ebe;">Cantidad de Servicios:</b>
                                            <label id="lblCantServicios" style="font-size:175%; color:#FF3377;"></label>
                                       

                                        </div>


                                        <div class="col-12" id="btnLimpiar">
                                                                                   
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- /.*********************************************************************** -->
                            
                            <div class="col-md-12" id="formDinamic1">
                                </div>   
                            <div class="col-md-12" id="formDinamic2">
                                </div>   
                            <div class="col-md-12" id="formDinamic3">
                                </div>   
                            <div class="col-md-12" id="formDinamic4">
                                </div>   
                            <div class="col-md-12" id="formDinamic5">
                                </div>   
                            <div class="col-md-12" id="formDinamic6">
                                </div>   
                            <div class="col-md-12" id="formDinamic7">
                                </div>   
                            <div class="col-md-12" id="formDinamic8">
                                </div>   
                            <div class="col-md-12" id="formDinamic9">
                                </div>   
                            <div class="col-md-12" id="formDinamic10">
                                </div>   
                            <div class="col-md-12" id="formDinamic11">
                                </div>   
                            <div class="col-md-12" id="formDinamic12">
                                </div>   
                            <div class="col-md-12" id="formDinamic13">
                                </div>   
                            <div class="col-md-12" id="formDinamic14">
                                </div>   
                            <div class="col-md-12" id="formDinamic15">
                                </div>   
                            <div class="col-md-12" id="formDinamic16">
                                </div>   
                            <div class="col-md-12" id="formDinamic17">
                                </div>   
                            <div class="col-md-12" id="formDinamic18">
                                </div>   
                            <div class="col-md-12" id="formDinamic19">
                                </div>   
                            <div class="col-md-12" id="formDinamic20">
                                </div>   
                            <div class="col-md-12" id="formDinamic21">
                                </div>   
                            <div class="col-md-12" id="formDinamic22">
                                </div>   
                            <div class="col-md-12" id="formDinamic23">
                                </div>   
                            <div class="col-md-12" id="formDinamic24">
                                </div>   
                            <div class="col-md-12" id="formDinamic25">
                                </div>   

                        
                            <!-- /.*********************************************************************** -->
</div>

                        </div>
                      </form>
                    </div>
            </div>
                    </section>
            </div>


