<?php

require_once "controlador/plantilla.controlador.php";
require_once "controlador/cartera.controlador.php";
require_once "controlador/ubicacionBodega.controlador.php";
require_once "controlador/cotizacion.controlador.php";
require_once "controlador/modificacion.controlador.php";
require_once "controlador/plantilla.controlador.php";
require_once "controlador/procesos-pendientes.controlador.php";
require_once "controlador/subir-tarifa.controlador.php";
require_once "controlador/usuario.controlador.php";
require_once "controlador/PHPMailer/PHPMailerAutoload.php";
require_once "controlador/activarOtrosServicios.controlador.php";
require_once "controlador/activarParaCobro.controlador.php";
require_once "controlador/parametrizarTarifaNormal.controlador.php";
require_once "controlador/gestorDeTarifas.controlador.php";
require_once "controlador/operacionesBIngreso.controlador.php";
require_once "controlador/ingBodHistorial.controlador.php";
require_once "controlador/ingresosPendientes.controlador.php";
require_once "controlador/registroIngresoBodega.controlador.php";
require_once "controlador/historiaIngresosFisacales.controlador.php";
require_once "controlador/mapeo.controlador.php";
require_once "controlador/retiroOpe.controlador.php";
require_once "controlador/retiroBod.controlador.php";
require_once "controlador/configuracion.controlador.php";
require_once "controlador/calcAlmacenajeF.controlador.php";
require_once "controlador/clientesSinTarifa.controlador.php";
require_once "controlador/paseDeSalida.controlador.php";
require_once "controlador/agregarServicios.controlador.php";
require_once "controlador/calculoDeAlmacenaje.controlador.php";
require_once "controlador/medidasVehiculos.controlador.php";
require_once "controlador/inventariosFiscales.controlador.php";
require_once "controlador/usuario.controlador.php";
require_once "controlador/tipoDeCambioBanguat.controlador.php";
require_once "controlador/ingPendientesC.controlador.php";
require_once "controlador/polizasDiarias.controlador.php";
require_once "controlador/ingReportados.controlador.php";
require_once "controlador/vehiculosSinMedidas.controlador.php";
require_once "controlador/retiroVeh.controlador.php";
require_once "controlador/revisionDeData.controlador.php";
require_once "controlador/historialCalculos.controlador.php";


require_once "modelo/plantilla.modelo.php";
require_once "modelo/cartera.modelo.php";
require_once "modelo/ubicacionBodega.modelo.php";
require_once "modelo/cotizacion.modelo.php";
require_once "modelo/modificacion.modelo.php";
require_once "modelo/plantilla.modelo.php";
require_once "modelo/procesos-pendientes.modelo.php";
require_once "modelo/subir-tarifa.modelo.php";
require_once "modelo/usuarios.modelo.php";
require_once "modelo/activarOtrosServicios.modelo.php";
require_once "modelo/activarParaCobro.modelo.php";
require_once "modelo/parametrizarTarifaNormal.modelo.php";
require_once "modelo/gestorDeTarifas.modelo.php";
require_once "modelo/operacionesBIngreso.modelo.php";
require_once "modelo/ingBodHistorial.modelo.php";
require_once "modelo/ingresosPendientes.modelo.php";
require_once "modelo/registroIngresoBodega.modelo.php";
require_once "modelo/historiaIngresosFisacales.modelo.php";
require_once "modelo/mapeo.modelo.php";
require_once "modelo/configuracion.modelo.php";
require_once "modelo/retiroOpe.modelo.php";
require_once "modelo/retiroBod.modelo.php";
require_once "modelo/calcAlmacenajeF.modelo.php";
require_once "modelo/clientesSinTarifa.modelo.php";
require_once "modelo/paseDeSalida.modelo.php";
require_once "modelo/agregarServicios.modelo.php";
require_once "modelo/calculoDeAlmacenaje.modelo.php";
require_once "modelo/medidasVehiculos.modelo.php";
require_once "modelo/inventariosFiscales.modelo.php";
require_once "modelo/usuariosCliente.modelo.php";
require_once "modelo/ingPendientesC.modelo.php";
require_once "modelo/polizasDiarias.modelo.php";
require_once "modelo/ingReportados.modelo.php";
require_once "modelo/vehiculosSinMedidas.modelo.php";
require_once "modelo/retiroVeh.modelo.php";
require_once "modelo/historialCalculos.modelo.php";



require_once "modelo/logicaDeCalculos.php";

require_once "modelo/rutas.php";


$plantilla = new ControladorPlantilla();

$plantilla->ctrPlantilla();
