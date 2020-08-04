<nav class="main-header navbar navbar-expand navbar-light bgNavSuper">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu"><i class="fa fa-bars colorBarSuper"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="Inicio" class="nav-link" ><strong class="colorBarSuper">Inicio</strong></a>
        </li>
    </ul>

    <!-- BUSQUEDA DE OPCIONES -->
    <form class="form-inline d-none d-lg-inline-block mb-3 mb-md-0 ml-md-3">
        <div class="input-group input-group-sm">
            <div class="input-group-append">
                <label>
                    <?php if (isset($_SESSION["Navega"]) && $_SESSION["Navega"] == "SinNav") {
                    echo '<i class="fa fa-window-close"></i>';
} else {
    echo '<i class="fa fa-check-square"></i>';
}
?>
                </label>
            </div>
            <i id="etiquetaEmpresa" style="color:#fff;"><?php
                if (isset($_SESSION["Navega"]) && $_SESSION["Navega"] == "SinNav") {
                    echo '&nbsp;&nbsp;&nbsp;&nbsp;' . "Su usuario no tiene navegación configurada";
                } else {
                    echo '&nbsp;&nbsp;&nbsp;&nbsp;' . $_SESSION["Navega"] . '&nbsp;&nbsp;&nbsp;&nbsp;<i id="etiquetaBod">' . $_SESSION["NavegaBod"] . '</i>&nbsp;&nbsp;&nbsp;&nbsp;<i id="etiquetaNumBod">' . $_SESSION["NavegaNumB"] . '</i>';
                }
                ?></i>
            <input type="hidden" id="hiddenIdBod" value=<?php echo $_SESSION["idDeBodega"]; ?>>
            <input type="hidden" id="hiddenIdUs" value=<?php echo $_SESSION["id"]; ?>>
            <input type="hidden" id="hiddenIdDependencia" value=<?php echo $_SESSION["dependencia"]; ?>>

        </div>

    </form>

    <!-- TIPO DE CAMBIO DIARIO -->
    <ul class="navbar-nav ml-auto">

        <!-- MENSAJES PRINCIPALES -->
        <li class="nav-item dropdown">
            <a class="nav-link" style="color:#fff;" data-toggle="dropdown">
                <span><?php/*
                $respuesta = tipoDeCambio::cambioDelDia();*/
                ?></span>
            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown">
                <i class="fa fa-power-off"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">Cerrar Sesión</span>
                <div class="dropdown-divider"></div>

                </br><center>
                    <a href="salir"><button type="submit" class="btn btn-info">Cerrar Sesión
                            <i class="fa fa-power-off"></i> </button>
                </center>
                </br></a>

            </div>

        </li>
</nav>
