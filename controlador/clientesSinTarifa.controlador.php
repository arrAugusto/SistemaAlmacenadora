<?php

class ControladorClientesSinTarifa {

    public static function ctrMostrarClientesSinTarifa() {
        $respuesta = ModeloClientesSinTarifa::mdlMostrarClientesSinTarifa();
        if ($respuesta != "SD") {
            foreach ($respuesta as $key => $value) {
                $botons = "";
                if ($value["estadoCliente"] == 0 && $_SESSION["departamentos"] == "Ventas") {
                    $botons = '<td><div class="btn-group"><button type="button" class="btn btn-success btnAsinarEje" estado=0 idRegistroCliente=' . $value["idRegistroCliente"] . '><i class="fas fa-id-card-alt"></i></button><button type="button" class="btn btn-warning btnSinTarifa"><i class="fas fa-user-times"></i></button>
                <button type="button" class="btn btn-primary btnGuardarData"><i class="fas fa-user-plus"></i></button></td></div>';
                } else if ($value["estadoCliente"] == 1 && $_SESSION["departamentos"] == "Ventas") {
                    $botons = '<td>
                <div class="btn-group"><button type="button" class="btn btn-dark" estado=1 ejecutivoAsignado=' . $value["ejecutivoAsignado"] . ' disabled><i class="fas fa-id-card-alt"></i></button><button type="button" class="btn btn-warning btnSinTarifa" ejecutivoAsignado=' . $value["ejecutivoAsignado"] . ' idRegistroCliente=' . $value["idRegistroCliente"] . '><i class="fas fa-user-times"></i></button>
                <button type="button" class="btn btn-primary btnGuardarData"><i class="fas fa-user-plus" idRegistroCliente=' . $value["idRegistroCliente"] . '></i></button></div></td>';
                }
                if ($_SESSION["departamentos"] != "Ventas" && $value["ejecutivoAsignado"] >= 1) {

                    $botons = '<td><button type="button" class="btn btn-outline-info" id="btnEjecutivoAsg" indentyNit="' . $value["indentyNit"] . '" data-toggle="modal" data-target="#modalEjecutivo">Asignacion <i class="fa fa-check-circle"></i></button></td>';
                }
                if ($_SESSION["departamentos"] != "Ventas" && $value["ejecutivoAsignado"] == 0) {
                    $botons = '<td><button type="button" class="btn btn-secondary" disabled="disabled">Asignacion <i class="fa fa-window-close"></i></button></td>';
                }
               echo '
        <tr>
            <td>' . ($key + 1) . '</td>
            <td>' . $value["nit"] . '</td>
            <td>' . $value["empresa"] . '</td>
            <td>' . $value["nomAuxiliar"] . ' ' . $value["apeAuxiliar"] . '</td>
            <td>' . $value["empOrigen"] . '  ' . $value["areaOrigen"] . '  ' . $value["areaNumOrigen"] . '</td>
                ' . $botons;
            }
        }
    }

    public static function ctrAsignarEjecutivo($hiddenIdUsST, $idregistrocliente) {
        $respuesta = ModeloClientesSinTarifa::mdlAsignarEjecutivo($hiddenIdUsST, $idregistrocliente);
        return $respuesta;
    }

    public static function ctrConfirClienteSTarifa($idregistroCDown) {
        $respuesta = ModeloClientesSinTarifa::mdlConfirClienteSTarifa($idregistroCDown);
        if ($respuesta == "oK") {
            return $respuesta;
        }
    }

}
