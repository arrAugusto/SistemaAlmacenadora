<?php

class ControladorHistoriaDeIngresos {

    public static function ctrMostrarCalculosMes() {
        $respuesta = ModeloHistoriaDeIngresos::mdlMostrarCalculosMes();

        $contador = 0;
        foreach ($respuesta as $key => $value) {

            $cadena_fecha_Descarga = new DateTime();
            $cadena_fecha_Descarga = $value["fechaCalculo"]->format("d/m/Y H:i:s A");
            $contador = $contador + 1;

            echo '<tr>
                    <td>' . $contador . '</td> 
                    <td>' . $value["nitEmpresa"] . '</td> 
                    <td>' . $value["nombreEmpresa"] . '</td> 
                    <td>' . $value["regIng"] . '</td> 
                    <td>' . $value["polIng"] . '</td> 
                    <td>' . $value["regSalida"] . '</td> 
                    <td>' . $value["polizaSal"] . '</td> 
                    <td>' . $cadena_fecha_Descarga . '</td> 
                    <td><center><button type="button" class="btn btn-outline-primary btnVerCalculo" idCalculo="' . $value["id"] . '" idIng="' . $value["idIng"] . '" polizaSal="' . $value["polizaSal"] . '"><i class="fa fa-eye"></i></button></center></td> 
            </tr>';
        }
        return $respuesta;
    }

    public static function ctrMostrarCalculo($viewCalculo, $viewIng) {
        $tipoOPCalc = "OkModificcion";
        $respuestaCalculo = calculoDeAlmacenaje::ctrCalculoAlmacenajes($viewIng, $viewCalculo, $tipoOPCalc);
        $sp = "spVerMasRubros";
        $serPrestado = ModeloCalculoDeAlmacenaje::mdlVerificaTarifa($viewCalculo, $sp);
        $sp = "spVerDescuentos";
        $descuentoCalc = ModeloCalculoDeAlmacenaje::mdlVerificaTarifa($viewCalculo, $sp);

        return array("datosCalculo" => $respuestaCalculo,
            "servPrestados" => $serPrestado, "descuentoCalc" => $descuentoCalc,
            "tipoOPCalc" => $tipoOPCalc);
    }

    public static function ctrMostrarCalculoRecalculo($fechRecalc, $idRetCalc, $idIngCalc) {
        $respuesta = ModeloHistoriaDeIngresos::mdlUpdateFechaCalculo($fechRecalc, $idRetCalc);
        $tipoOPCalc = "OkModificcion";
        $respuestaCalculo = calculoDeAlmacenaje::ctrCalculoAlmacenajes($idIngCalc, $idRetCalc, $tipoOPCalc);
        $sp = "spVerMasRubros";
        $serPrestado = ModeloCalculoDeAlmacenaje::mdlVerificaTarifa($idRetCalc, $sp);
        $sp = "spVerDescuentos";
        $descuentoCalc = ModeloCalculoDeAlmacenaje::mdlVerificaTarifa($idRetCalc, $sp);
        return array("datosCalculo" => $respuestaCalculo, "servPrestados" => $serPrestado, "descuentoCalc" => $descuentoCalc);
    }

}
