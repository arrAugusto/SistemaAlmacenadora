<?php

class ControladorActivarTarifa {
    /* ingreso usuarios */

    public static function ctrActivarTarifa($valor) {

        $tabla = "ALMACENAJES";
        $item = "idUsuarioCliente";
        $envia = ModeloActivarTarifas::mdlActivarTarifas($tabla, $item, $valor);
        return $envia;
    }

    /* Nueva tarifa segunda formularios activar cotizacion */

    public static function ctrIngresoOtrosServicios($valor, $datos) {
        $tablas = array("tabla1" => "SEGURO", "tabla2" => "MANEJO", "tabla3" => "GASTOS_ADMIN", "tabla4" => "OTROS_GASTOS");

        $valores = array("seguro" => $datos[6], "peso" => $datos[9], "gstsAdmin" => $datos[12], "otros" => $datos[15]);


        $envia = ModeloActivarTarifas::mdlIngresoOtrosServicios($tablas, $datos);
        $envia1 = ModeloActivarTarifas::mdlIngresoOtrosServicios1($tablas, $datos);
        $envia2 = ModeloActivarTarifas::mdlIngresoOtrosServicios2($tablas, $datos);
        $envia3 = ModeloActivarTarifas::mdlIngresoOtrosServicios3($tablas, $datos);

        return array($envia, $envia1, $envia2, $envia3);
    }

}
