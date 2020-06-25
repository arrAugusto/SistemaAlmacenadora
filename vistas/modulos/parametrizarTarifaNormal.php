<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Menú Principal</h1>
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
                    <h5 class="card-title">Parametrizar almacenajes con tarifas normales</h5>
                </div>
                <form role="form" method="post">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <label>Ingresa Nit de cliente</label>
                                <p>
                                    <select class="form-control select2" id="consultaNitNomal" name="consultaNitNomal">
                                        <option value="">Escriba el nit</option>
                                        <?php
$tipo      = 1;
$respuesta = controladorParametrizarTarifaNormal::ctrMostrarNitEmpresas($tipo);

foreach ($respuesta as $key => $value) {
    echo '<option value="' . $value["id"] . '">' . $value["nitEmpresa"] . ' </option>';
}
?>
                                    </select>
                                </p>
                            </div>
                            <div class="col-2">
                                <label>Tarifa Global</label>
                                <p>
                                <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i></button>
                                </p>
                            </div>
                            <div class="col-2">
                                <label>Agregar Nit</label>
                                <p>
                                <button type="button" class="btn btn-warning btnMostrarServicios" ><i class="fa fa-plus"></i></button>
                                </p>
                            </div>
                            <div class="col-2">
                                <label>ver nit</label>
                                <p>
                                <button type="button" class="btn btn-warning btnVerNit" ><i class="fa fa-plus"></i></button>
                                </p>
                            </div>
                            <div class="col-md-12" id="individualGlobal">
                            </div>
                            <br>
                            <br>
                            <br><br><br><br><br><br><br><br>
                            <div class="col-md-12" id="formDinamic">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <div class="modal fade" id="exampleModal" tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <label>Seleccione la empresa</label>
                            <select class="form-control select2" style="width: 100%;" id="Dependencias" name="Dependencias" required>
                                <option>Todas las dependencias</option>

                                <option>Almacenes Generales, S.A.</option>
                                <option>Almacenadora Integrada, S.A.</option>
                            </select>
                        </div>
                        <div class="col-6">
                              <div class="col-md-12" id="regimenesSat">
                          
                            <label>Seleccione Regímen</label>
                            <select class="form-control select2" style="width: 100%;" id="regimenSat" name="regimenSat" required>
                                <option>Todos los regimenes</option>
                                <option>Almacen Fiscal</option>
                                <option>Zona Aduanera</option>

                            </select>
                        </div>
                        </div>




                   <div class="col-6">
                            <div class="col-md-12" id="tipoDePolizas">
                            
                            <label>Seleccione Tipos de poliza</label>
                            <select class="form-control select2" style="width: 100%;" id="tipoPoliza" name="tipoPoliza" required>
                                <option>Todos los tipos</option>

                                <option>AI2</option>
                                <option>AI3</option>
                                <option>G1</option>
                            </select>
                            </div>
                        </div>



                        <div class="col-12">
                            <div class="form-group">
                                <label>Date:</label>
                                <div class="input-group date">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="datepicker">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btnGuardarGlobal" data-dismiss="modal">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>







