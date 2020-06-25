<?php

class ControladorMapaDeBodegas {

    public static function ctrRegistrarNuevoMapa($datos) {
        $respuesta = ModeloMapaDeBodegas::mdlRegistrarNuevoMapa($datos);
        return $respuesta;
    }

}
