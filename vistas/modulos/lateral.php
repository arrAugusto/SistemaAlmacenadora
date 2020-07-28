
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar elevation-4" style="background-color:rgba(0,0,0, 0.89); color: #fff;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="vistas/img/plantilla/bi.png"
           alt="Almacenadora Integrada"
           class="brand-image img-square elevation-2"
           style="opacity: 1">
      <span class="brand-text font-weight-light"><strong style="color: #fff;">Almacenadoras</strong></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar" id="style-3">
      <!-- Sidebar user (optional) -->

      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <?php
           if ($_SESSION["foto"]!=""){
            echo '<img src="'.$_SESSION["foto"].'" class="img-circle elevation-3" alt="User Image">';
          }else{
           echo '<img src="vistas/img/usuarios/default/anonymous.png" class="img-circle elevation-3" alt="User Image">';

          }

          ?>

        </div>
        <div class="info">
          <a href="miperfil" class="d-block" style="color: #fff;"><?php echo $_SESSION["nombre"];?></a>
          <a href="miperfil" class="d-block" style="color: #fff;"><?php echo $_SESSION["apellidos"] ;?></a>


        </div>
      </div>

<!-- ========================================================================================
*			FIN MENU LATERAL IZQUIERZDO  >> MENU'S GENERALES    					                        *
*			>>BUSQUEDA                                                                            *
==========================================================================================-->
