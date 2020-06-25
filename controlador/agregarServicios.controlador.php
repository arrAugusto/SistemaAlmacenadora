<?php


class ControladorAgregarServicios {
    public static function ctrSumarMasServicios(){
        $respuesta= modeloAgregarServicios::mdlSumarMasServicios();
        var_dump($respuesta);
    }
}