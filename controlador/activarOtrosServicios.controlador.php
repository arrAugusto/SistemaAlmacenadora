<?php

class ControladorActivarTarifa {
    /* ingreso usuarios */

    public static function ctrActivarTarifa($valor) {


        $envia = ModeloActivarTarifas::mdlActivarTarifas($valor);
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

// INVOCADO POR METODO DE AJAX MUESTRA DATA DEL CLIENTE SOLICITADO
    public static function ctrMostrarCliente($idNit) {
        try {
// CASTEO DE DATA
            $respuestaData = revisionData::datoEntero($idNit);
            if ($respuestaData) {
//SOLICITUD DE DATA
                    $sp = "spConsulNitTar";
                $respuesta = ModeloActivarTarifas::mdlMostrarUnParam($idNit, $sp);
                if ($respuesta != "SD" && $respuesta["resp"] == true) {
                    return array("resp" => true, "success" => $respuesta["data"]);
                } else if ($respuesta != "SD" && $respuesta["resp"] == false) {
//ERRORES EN DB VALOR RECIBIDO POR AJAX NO ES ENTERO
                    return array("resp" => false, "error" => "inconcistenica", "descripcion" => "Activar Servicios Almacenaje 41");
                }
            } else {
// DATO NO EXISTE EN DB
                return array("resp" => false, "error" => "errorDato");
            }
        } catch (Exception $ex) {
// ERROR DE SERVIDOR ERROR 500
            return array("resp" => false, "error" => "inconcistenica", "descripcion" => "Activar Servicios Almacenaje 50" + $ex);
        }
    }

    public static function ctrConsultaServicios($idNit) {
        try {
// CASTEO DE DATA
            $respuestaData = revisionData::datoEntero($idNit);
            if ($respuestaData) {
//SOLICITUD DE DATA
                $sp = "spMostrarSerTar";
                $respuesta = ModeloActivarTarifas::mdlMostrarUnParam($idNit, $sp);
                if ($respuesta != "SD" && $respuesta["resp"] == true) {
                    return array("resp" => true, "success" => $respuesta["data"]);
                } else if ($respuesta != "SD" && $respuesta["resp"] == false) {
//ERRORES EN DB VALOR RECIBIDO POR AJAX NO ES ENTERO
                    return array("resp" => false, "error" => "inconcistenica", "descripcion" => "Activar Servicios Almacenaje 66");
                } else {
                    return array("resp" => false, "error" => "sinConcidencia");
                }
            } else {
// DATO NO EXISTE EN DB
                return array("resp" => false, "error" => "errorDato");
            }
        } catch (Exception $ex) {
// ERROR DE SERVIDOR ERROR 500
            return array("resp" => false, "error" => "inconcistenica", "descripcion" => "Activar Servicios Almacenaje 74" + $ex);
        }
    }

    public static function ctrMostrarDataTarifa($idNit) {
        try {
// CASTEO DE DATA
            $respuestaData = revisionData::datoEntero($idNit);
            if ($respuestaData) {

//SOLICITUD DE DATA
                $sp = "spConsServ";
                $respuesta = ModeloActivarTarifas::mdlMostrarUnParam($idNit, $sp);

                if ($respuesta != "SD" && $respuesta["resp"] == true) {
                    return array("resp" => true, "success" => $respuesta["data"]);
                } else if ($respuesta != "SD" && $respuesta["resp"] == false) {
//ERRORES EN DB VALOR RECIBIDO POR AJAX NO ES ENTERO
                    return array("resp" => false, "error" => "inconcistenica", "descripcion" => "Activar Servicios Almacenaje 66");
                } else {
                    return array("resp" => false, "error" => "sinConcidencia");
                }
            } else {
// DATO NO EXISTE EN DB
                return array("resp" => false, "error" => "errorDato");
            }
        } catch (Exception $ex) {
// ERROR DE SERVIDOR ERROR 500
            return array("resp" => false, "error" => "inconcistenica", "descripcion" => "Activar Servicios Almacenaje 74" + $ex);
        }
    }

    public static function ctrComposicionTarifa($compTarifa) {
        try {
// CASTEO DE DATA
            $respuestaData = revisionData::datoEntero($compTarifa);
            if ($respuestaData) {

//SOLICITUD DE DATA
                $sp = "spMostrarServicios3";
                $respuesta = ModeloActivarTarifas::mdlMostrarUnParam($compTarifa, $sp);

                if ($respuesta != "SD" && $respuesta["resp"] == true) {
                    return array("resp" => true, "success" => $respuesta["data"]);
                } else if ($respuesta != "SD" && $respuesta["resp"] == false) {
//ERRORES EN DB VALOR RECIBIDO POR AJAX NO ES ENTERO
                    return array("resp" => false, "error" => "inconcistenica", "descripcion" => "Activar Servicios Almacenaje 66");
                } else {
                    return array("resp" => false, "error" => "sinConcidencia");
                }
            } else {
// DATO NO EXISTE EN DB
                return array("resp" => false, "error" => "errorDato");
            }
        } catch (Exception $ex) {
// ERROR DE SERVIDOR ERROR 500
            return array("resp" => false, "error" => "inconcistenica", "descripcion" => "Activar Servicios Almacenaje 74" + $ex);
        }
    }

}
