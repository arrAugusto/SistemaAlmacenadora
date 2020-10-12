<?php

session_start();

if (isset($_SESSION["IniciarSesion"]) && $_SESSION["IniciarSesion"] == "ok") {
    include "modulos/ModuloPrincipal.php";
    include "modulos/cabezote.php";
    include "modulos/lateral.php";
    include "modulos/MenuCotizacion.php";
    if (isset($_GET["ruta"])) {
        if ($_GET["ruta"] == "configuracion") {

            include "modulos/navegaInicio.php";
            include "modulos/" . $_GET["ruta"] . ".php";
        } else if ($_SESSION["niveles"] == "ADMINISTRADOR") {
            if ($_GET["ruta"] == "Inicio" ||
                    $_GET["ruta"] == "parametrizarAlmacenaje" ||
                    $_GET["ruta"] == "salir" ||
                    $_GET["ruta"] == "consultas" ||
                    $_GET["ruta"] == "operacionesBIngreso" ||
                    $_GET["ruta"] == "ingBodHistorial" ||
                    $_GET["ruta"] == "cartera" ||
                    $_GET["ruta"] == "ingresosPendientes" ||
                    $_GET["ruta"] == "culminarIngresosBodega" ||
                    $_GET["ruta"] == "historiaIngresosFisacales" ||
                    $_GET["ruta"] == "mapeoBodega" ||
                    $_GET["ruta"] == "detallesTarifa" ||
                    $_GET["ruta"] == "activarOtrosServicios" ||
                    $_GET["ruta"] == "crearUsuarios" ||
                    $_GET["ruta"] == "crearClientes" ||
                    $_GET["ruta"] == "gestorUsuarios" ||
                    $_GET["ruta"] == "panelDeTarifas" ||
                    $_GET["ruta"] == "gestorClientes" ||
                    $_GET["ruta"] == "miperfil" ||
                    $_GET["ruta"] == "gestorDeTarifas" ||
                    $_GET["ruta"] == "parametrizarTarifaNormal" ||
                    $_GET["ruta"] == "panelDeControl" ||
                    $_GET["ruta"] == "UbicacionBodega" ||
                    $_GET["ruta"] == "subir-tarifa" ||
                    $_GET["ruta"] == "retiroBod" ||
                    $_GET["ruta"] == "calcAlmacenajeF" ||
                    $_GET["ruta"] == "paseDeSalida" ||
                    $_GET["ruta"] == "medidasVehiculos" ||
                    $_GET["ruta"] == "agregarServicios" ||
                    $_GET["ruta"] == "inventariosFiscales" ||
                    $_GET["ruta"] == "clientesSinTarifa" ||
                    $_GET["ruta"] == "calculosDeAlmacenaje" ||
                    $_GET["ruta"] == "ingPendientesC" ||
                    $_GET["ruta"] == "polizasDiarias" ||
                    $_GET["ruta"] == "ingReportados" ||
                    $_GET["ruta"] == "vehiculosSinMedidas" ||
                    $_GET["ruta"] == "retiroVeh" ||
                    $_GET["ruta"] == "historialCalculos" ||
                    $_GET["ruta"] == "retiroOpe") {
                /*
                  Include para hacer URL amigables.
                 */
                include "modulos/" . $_GET["ruta"] . ".php";
            } else {
                include "modulos/Page_Error/error404.php";
            }
        } else if ($_SESSION["niveles"] == "MEDIO" && $_SESSION["departamentos"] == "Operaciones Fiscales" || $_SESSION["niveles"] == "BAJO" && $_SESSION["departamentos"] == "Operaciones Fiscales" && $_SESSION["departamentos"] != "Ventas") {

            if ($_SESSION["niveles"] == "BAJO" && $_SESSION["departamentos"] == "Operaciones Fiscales" && $_SESSION["departamentos"] != "Ventas") {
                if ($_GET["ruta"] == "Inicio" ||
                        $_GET["ruta"] == "gestorDeTarifas" ||
                        $_GET["ruta"] == "culminarIngresosBodega" ||
                        $_GET["ruta"] == "operacionesBIngreso" ||
                        $_GET["ruta"] == "historiaIngresosFisacales" ||
                        $_GET["ruta"] == "UbicacionBodega" ||
                        $_GET["ruta"] == "calculosDeAlmacenaje" ||
                        $_GET["ruta"] == "calcAlmacenajeF" ||
                        $_GET["ruta"] == "paseDeSalida" ||
                        $_GET["ruta"] == "medidasVehiculos" ||
                        $_GET["ruta"] == "gestorUsuarios" ||
                        $_GET["ruta"] == "retiroOpe" ||
                        $_GET["ruta"] == "retiroBod" ||
                        $_GET["ruta"] == "miperfil" ||
                        $_GET["ruta"] == "historialCalculos" ||
                        $_GET["ruta"] == "historiaRetirosFisacales" ||                        
                        $_GET["ruta"] == "clientesSinTarifa" ||
                        $_GET["ruta"] == "ingresosPendientes" ||
                        $_GET["ruta"] == "inventariosFiscales" ||
                        $_GET["ruta"] == "calcAlmacenajeF" ||
                        $_GET["ruta"] == "ingPendientesC" ||
                        $_GET["ruta"] == "ingReportados" ||
                        $_GET["ruta"] == "retiroPendienteC" ||
                        $_GET["ruta"] == "vehiculosSinMedidas" ||
                        $_GET["ruta"] == "retirosContabilizados" ||
                        $_GET["ruta"] == "salir") {
                    /*
                      Include para hacer URL amigables.
                     */
                    include "modulos/" . $_GET["ruta"] . ".php";
                } else {
                    include "modulos/Page_Error/error404.php";
                }
            }
            if ($_SESSION["niveles"] == "MEDIO" && $_SESSION["departamentos"] == "Operaciones Fiscales" && $_SESSION["departamentos"] != "Ventas") {
                if ($_GET["ruta"] == "Inicio" ||
                        $_GET["ruta"] == "gestorDeTarifas" ||
                        $_GET["ruta"] == "culminarIngresosBodega" ||
                        $_GET["ruta"] == "operacionesBIngreso" ||
                        $_GET["ruta"] == "historiaIngresosFisacales" ||
                        $_GET["ruta"] == "UbicacionBodega" ||
                        $_GET["ruta"] == "calculosDeAlmacenaje" ||
                        $_GET["ruta"] == "calcAlmacenajeF" ||
                        $_GET["ruta"] == "paseDeSalida" ||
                        $_GET["ruta"] == "medidasVehiculos" ||
                        $_GET["ruta"] == "historiaRetirosFisacales" ||                         
                        $_GET["ruta"] == "gestorUsuarios" ||
                        $_GET["ruta"] == "retiroOpe" ||
                        $_GET["ruta"] == "retiroBod" ||
                        $_GET["ruta"] == "miperfil" ||
                        $_GET["ruta"] == "clientesSinTarifa" ||
                        $_GET["ruta"] == "ingresosPendientes" ||
                        $_GET["ruta"] == "inventariosFiscales" ||
                        $_GET["ruta"] == "calcAlmacenajeF" ||
                        $_GET["ruta"] == "salir" ||
                        $_GET["ruta"] == "ingPendientesC" ||
                        $_GET["ruta"] == "polizasDiarias" ||
                        $_GET["ruta"] == "sldDiarioContabilidad" ||
                        $_GET["ruta"] == "retiroPendienteC" ||
                        $_GET["ruta"] == "retirosContabilizados" ||
                        $_GET["ruta"] == "historialCalculos" ||
                        $_GET["ruta"] == "vehiculosSinMedidas" ||
                        $_GET["ruta"] == "ingReportados") {
                    /*
                      Include para hacer URL amigables.
                     */
                    include "modulos/" . $_GET["ruta"] . ".php";
                } else {
                    include "modulos/Page_Error/error404.php";
                }
            }
        } else if ($_SESSION["niveles"] == "ALTO" && $_SESSION["departamentos"] == "Operaciones Generales" && $_SESSION["departamentos"] != "Ventas") {
            if ($_GET["ruta"] == "Inicio" ||
                    $_GET["ruta"] == "parametrizarAlmacenaje" ||
                    $_GET["ruta"] == "miperfil" ||
                    $_GET["ruta"] == "activarOtrosServicios" ||
                    $_GET["ruta"] == "gestorDeTarifas" ||
                    $_GET["ruta"] == "calculosDeAlmacenaje" ||
                    $_GET["ruta"] == "historiaIngresosFisacales" ||
                    $_GET["ruta"] == "UbicacionBodega" ||
                    $_GET["ruta"] == "inventariosFiscales" ||
                    $_GET["ruta"] == "calcAlmacenajeF" ||
                    $_GET["ruta"] == "ingPendientesC" ||
                    $_GET["ruta"] == "polizasDiarias" ||
                    $_GET["ruta"] == "ingReportados" ||
                    $_GET["ruta"] == "paseDeSalida" ||
                    $_GET["ruta"] == "retiroBod" ||
                    $_GET["ruta"] == "historialCalculos" ||
                    $_GET["ruta"] == "culminarIngresosBodega" ||
                    $_GET["ruta"] == "salir" ||
                    $_GET["ruta"] == "clientesSinTarifa" ||
                    $_GET["ruta"] == "calcAlmacenajeF" ||
                    $_GET["ruta"] == "nuevasEmpresas" ||
                    $_GET["ruta"] == "activarTarifa" ||
                    $_GET["ruta"] == "detallesTarifa") {
                /*
                  Include para hacer URL amigables.
                 */
                include "modulos/" . $_GET["ruta"] . ".php";
            } else {
                include "modulos/Page_Error/error404.php";
            }
        } else if ($_SESSION["departamentos"] == "Ventas" || $_SESSION["departamentos"] == "Gerencia") {
            if ($_GET["ruta"] == "Inicio" ||
                    $_GET["ruta"] == "miperfil" ||
                    $_GET["ruta"] == "gestorDeTarifas" ||
                    $_GET["ruta"] == "historiaIngresosFisacales" ||
                    $_GET["ruta"] == "UbicacionBodega" ||
                    $_GET["ruta"] == "inventariosFiscales" ||
                    $_GET["ruta"] == "calculosDeAlmacenaje" ||
                    $_GET["ruta"] == "paseDeSalida" ||
                    $_GET["ruta"] == "retiroBod" ||
                    $_GET["ruta"] == "historialCalculos" ||
                    $_GET["ruta"] == "culminarIngresosBodega" ||
                    $_GET["ruta"] == "salir" ||
                    $_GET["ruta"] == "clientesSinTarifa" ||
                    $_GET["ruta"] == "gestorUsuarios" ||
                    $_GET["ruta"] == "crearClientes" ||
                    $_GET["ruta"] == "gestorClientes" ||
                    $_GET["ruta"] == "calcAlmacenajeF" ||
                    $_GET["ruta"] == "detallesTarifa") {
                /*
                  Include para hacer URL amigables.
                 */
                include "modulos/" . $_GET["ruta"] . ".php";
            } else {
                include "modulos/Page_Error/error404.php";
            }
        } else if ($_SESSION["departamentos"] == "Bodegas Fiscales") {
                if ($_GET["ruta"] == "Inicio" ||
                        $_GET["ruta"] == "gestorDeTarifas" ||
                        $_GET["ruta"] == "culminarIngresosBodega" ||
                        $_GET["ruta"] == "historiaIngresosFisacales" ||
                        $_GET["ruta"] == "UbicacionBodega" ||
                        $_GET["ruta"] == "paseDeSalida" ||
                        $_GET["ruta"] == "gestorUsuarios" ||
                        $_GET["ruta"] == "retiroBod" ||
                        $_GET["ruta"] == "miperfil" ||
                        $_GET["ruta"] == "clientesSinTarifa" ||
                        $_GET["ruta"] == "ingresosPendientes" ||
                        $_GET["ruta"] == "inventariosFiscales" ||
                        $_GET["ruta"] == "salir") {
                    /*
                  Include para hacer URL amigables.
                 */
                include "modulos/" . $_GET["ruta"] . ".php";
            } else {
                include "modulos/Page_Error/error404.php";
            }
                } else if ($_SESSION["departamentos"] == "Seguridad Interna") {
                                  if ($_GET["ruta"] == "Inicio" ||
                        $_GET["ruta"] == "controlDeIngPersonas" ||
                        $_GET["ruta"] == "salir"){
                    /*
                  Include para hacer URL amigables.
                 */
                include "modulos/" . $_GET["ruta"] . ".php";

                                      
                                  }else{
                include "modulos/Page_Error/error404.php";                                      
                                  }
  
            
 }else {
            include "modulos/Page_Error/error404.php";
        }
    } else {
        include "modulos/inicio.php";
    }
} else {
    include "vistas/modulos/Login/login.php";
}
