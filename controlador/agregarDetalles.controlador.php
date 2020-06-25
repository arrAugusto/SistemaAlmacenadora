<?php
class ControladorAgrDetalles{
	public static function ctrMostrarEmpresas(){


$respuesta=ModeloAgregarDetalles::mdlMostrarEmpresas();
return $respuesta;


	}
}
