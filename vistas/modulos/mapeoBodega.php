
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
                                      <div class="col-5">
                                      <input class="form-control" type="text" placeholder="Cantidad de pasillos" id="cantPasillos" style="text-align: center; font-size:30px;">
                                      </div>

                                      <div class="col-5">
                                        <input class="form-control" type="text" placeholder="Cantidad de columnas" id="cantColumnas" style="text-align: center; font-size:30px;">
                                        </div>
                                      <div class="col-2">

                                      <button type="button" class="btn btn-primary btnMapeando" style="text-align: center; font-size:30px;"><i class="fas fa-drafting-compass"></i></button>
                                      </div>

<br><br><br><br>
<div id="mapeandoAcciones" class="col-12">
</div>
<br><br><br><br>
<div id="mapeandoUbicaciones" class="col-12">

</div>





</div>
<br><br>


<div class="row">
  <div class="col-3">
      <label>¿Que tipo de Area?</label>
      <select class="form-control select2" style="width: 100%;" id="nuevArea" name="nuevArea" required>
          <option selected="selected" disabled="disabled">Seleccione el Area</option>
          <option>Bodega</option>
          <option>Predio de Vehiculos Usados</option>
          <option>Predio de Vehiculos Nuevos</option>
      </select>
      <span class="fas fa-ruler-horizontal"></span>
  </div>


  <div class="col-3">
      <label>Escriba el numero de bodega</label>
    <input type="text" id="numeroBodega" class="form-control">
      <span class="fas fa-pencil-alt"> </span>
  </div>


  <div class="col-3">
      <label>¿Que dependencia es?</label>
      <select class="form-control select2" style="width: 100%;" id="nuevDependencia" name="nuevArea" required>
          <option selected="selected" disabled="disabled">Seleccione el Dependencia</option>
          <option value=1>Almacenadora Integrada, S.A.</option>
          <option value=2>Almacenes Generales, S.A.</option>
      </select>
      <span class="fas fa-ruler-horizontal"> </span>
  </div>
<input type="hidden" id="hiddenArray" value="">
</div>


<div class="card-footer">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary btnGuardarMapa">Guardar Mapa de bodega</button>

                </div>
            </div>

                </form>
              </div>
          </div>
    </section>
  </div>
