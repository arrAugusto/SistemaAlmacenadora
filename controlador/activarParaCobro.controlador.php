<?php

class ControladorActivarParaCobro{

    public static function ctrActivarParaCobro($valor){
        $respuesta = ModeloActivarParaCobros::mdlActivarParaCobro($valor);
       return $respuesta;
}
public static function ctrMostrarParametro($valor){
  $respuesta =ModeloActivarParaCobros::mdlMostrarParametro($valor);
  return $respuesta;
}
  public static function ctrMostrarServicios($valor){

$respuesta=ModeloActivarParaCobros::mdlMostarServicios($valor);
return $respuesta;

  }

  public static function ctrActivarServicios($idCliente, $numeroSerie, $idParaActivar){
if (is_numeric($idCliente)) {
$respuesta=ModeloActivarParaCobros::mdlActivarServicios($idCliente, $numeroSerie, $idParaActivar);
return $respuesta;

}else{
	return "Error";
}
}

public static function ctrNuevaSerie($serieTarifa, $numeroCliente){

	if (is_numeric($numeroCliente)) {
	$respuesta=ModeloActivarParaCobros::mdlNuevaSerie($serieTarifa, $numeroCliente);
	return $respuesta;

	}else{
		return "error";
	}
}

public static function ctrMostrarServiciosIndividual($idServicioCliente, $Tabla){
if (is_numeric($idServicioCliente)) {

$respuesta=ModeloActivarParaCobros::mdlMostrarServiciosIndividual($idServicioCliente, $Tabla);
return $respuesta;
}
}

public static function ctrServiciosIndividuales($numeroServicio,
$numeroId, $servicioId){
	$respuesta=ModeloActivarParaCobros::mdlServiciosIndividuales($numeroServicio,
$numeroId, $servicioId);
return $respuesta;

}

public static function ctrServicioIndividualSeguro($modificacionIndividualSeguro){
$respuesta=ModeloActivarParaCobros::mdlmodificacionIndividualSeguro($modificacionIndividualSeguro);
return $respuesta;
}

public static function ctrModificacionCalculoSobreSeguro($numeroidtarifa, $nombreServicio, $numeroServicio){
$respuesta=ModeloActivarParaCobros::mdlModificacionCalculoSobreSeguro($numeroidtarifa, $nombreServicio, $numeroServicio);
return $respuesta;

}

public static function ctrModificacionCalculoSobreManejo($edicionServicioManejo){
$respuesta=ModeloActivarParaCobros::mdlModificacionCalculoSobreManejo($edicionServicioManejo);
return $respuesta;
}

public static function ctrModificacionManejo($numeroParaActivarManejo, $nombreServicioManejo, $numeroTarifaManejo){
	$respuesta=ModeloActivarParaCobros::mdlModificacionManejo($numeroParaActivarManejo, $nombreServicioManejo, $numeroTarifaManejo);
	return $respuesta;
}

public static function ctrMostarServicioGastosAdmin($idServicioClienteGtsAdmin){
	 if (preg_match('/^[0-9]+$/', $idServicioClienteGtsAdmin)){
$respuesta=ModeloActivarParaCobros::mdlMostarServicioGastosAdmin($idServicioClienteGtsAdmin);
return $respuesta;

	 }else{
		return "vacio";

}

}

public static function ctrModificacionGtsAdmin($numeroServicioGtsAdmin, $nombreServicioGtsAdmin, $numeroTarifaGtsAdmin){
	$respuesta=ModeloActivarParaCobros::mdlModificacionGtsAdmin($numeroServicioGtsAdmin, $nombreServicioGtsAdmin, $numeroTarifaGtsAdmin);
	return $respuesta;
}

public static function ctrMostarServicioOtrosGastos($idServicioClienteOtrosGastos){
	$respuesta=ModeloActivarParaCobros::mdlMostarServicioOtrosGastos($idServicioClienteOtrosGastos);
	return $respuesta;

}

public static function ctrModificacionOtrosGastos($numeroServicioOtrosGastos, $nombreServicioOtrosGastos, $numeroTarifaOtrosGastos){
$respuesta=ModeloActivarParaCobros::mdlModificacionOtrosGastos($numeroServicioOtrosGastos, $nombreServicioOtrosGastos, $numeroTarifaOtrosGastos);
return $respuesta;
}

public static function ctrAnulacionFila($idNumeroServicio, $idNumeroFilaCliente, $botonelminarfila){
$respuesta=ModeloActivarParaCobros::mdlAnulacionFila($idNumeroServicio, $idNumeroFilaCliente, $botonelminarfila);
return $respuesta;

}

public static function ctrreactivarCliente($idNitActivar){
	$respuesta =ModeloActivarParaCobros::mdlreactivarCliente($idNitActivar);
	return $respuesta;

}

public static function ctrClienteIdAnularTotal($lblClienteIdAnularTotal, $lblNitAnularTotal){
	$respuesta =ModeloActivarParaCobros::mdlClienteIdAnularTotal($lblClienteIdAnularTotal, $lblNitAnularTotal);
	return $respuesta;
}

public static function ctrMostrarDependencias(){
	$respuesta=ModeloActivarParaCobros::mdlMostrarDependencias();
	return $respuesta;
}

public static function ctrMostrarEjecutivo(){
    $valor = 1;
    $respuesta = ModeloActivarParaCobros::mdlMostrarEjecutivo($valor);
    return $respuesta;
}
}
