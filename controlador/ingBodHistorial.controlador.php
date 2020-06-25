<?php

class ControladorIngBodHistorial {

    public static function ctrMostrarIngresos($fechaInicial, $fechaFinal) {

        $respuesta = ModeloIngBodHistorial::mdlRangoFechas($fechaInicial, $fechaFinal);
        return $respuesta;
    }

}
