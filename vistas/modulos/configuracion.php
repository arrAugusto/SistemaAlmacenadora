
<div id="wrapperConfi" class="content-wrapper">
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
    </section>

    <div class="login-box">

        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg"><b>Configuración de navegación</b></p>

                <form method="post">
<div class="row">

<div class="col-md-12">
    <label>¿Que tipo de Area trabajara?</label>
    <select class="form-control select2" style="width: 100%;" id="txtAreaBodega" name="txtAreaBodega" required>

    <option selected="selected" disabled="disabled">Seleccione el Area</option>
        <option>Bodega</option>
        <option>Predio de Vehiculos Usados</option>
        <option>Predio de Vehiculos Nuevos</option>
    </select>
    <span class="fas fa-ruler-horizontal"></span>
</div>

<div class="col-12">
  <label>Escriba el numero de bodega</label>
  <input type="text" id="numeroBodega" class="form-control">
    <span class="fas fa-pencil-alt"> </span>
</div>


</div>

<input type="hidden" id="idHiddenNavega" value=<?php echo $_SESSION["dependencia"]; ?>>
<input type="hidden" id="idHiddenNavegaUs" value=<?php echo $_SESSION["id"]; ?>>


                </form>

                </br>

            </div>
            <div class="card-footer">
                <div class="btn-group">
                    <button type="submit" class="btn btn-primary btnNavega">Aceptar</button>

                </div>
            </div>


</div>
        </div>

        </div>


  </div>
