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
                                    <select class="form-control select2" id="consultaNit" name="consultaNit">
                                        <option value="">Escriba el nit</option>
                                        <?php
                                        $solicitudNit = controladorServicios::ctrNitClientesTarifaEspecial();
                                        ?>
                                    </select>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <div class="card card-success card-outline">

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    </div>
                                    <div class="card-body box-profile">

                                        <div class="col-12">
                                            <b style="font-size:175%; color:black;">Datos generales de la empresa</b>

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
                                            <b style="font-size:125%; color:#0e4ebe;">Telefono:</b>
                                            <label id="lblTelefono" style="font-size:125%; color:#0e4ebe;"></label>
                                        </div>



                                    </div>
                                </div>
                            </div>

                            <div class="col-12" id="divParamAlm">
                                <section class="content">
                                    <div class="card-body">
                                        <div class="input-group" style="font-size:175%">


                                        </div>

                                       

                                        <table id="tablas" role="grid" class="table  dt-responsive    nowrap table-striped table-bordered display" cellspacing="0" >
                                            <thead style="background-color: #0096d2;color: white; font-weight: bold;">

                                                <tr>
                                                <th style="width: 2%">#</th>
                                                <th style="width: 20%">Servicios de almacenajes</th>
                                                <th style="width: 13%">Calculado sobre</th>
                                                <th style="width: 13%">Base para calculo</th>
                                                <th style="width: 13%">Periodos de cobro</th>
                                                <th style="width: 13%">Moneda, % o $ </th>
                                                <th style="width: 13%">Valor calculo</th>
                                                <th style="width: 13%">Acciones</th>


                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                    
                                                $servicios = controladorServicios::ctrConsultaServicios();
                                              
                                                ?>
                                            </tbody>

                                        </table>

                                    </div>
                                    <button type="button" class="btn btn-primary btn-block btnAct">CARGAR OTROS RUBROS Y ACTIVAR TARIFA</button>
                                </section>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </section>
</div><!--
