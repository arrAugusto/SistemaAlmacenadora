<?php

class ControladorGestorDeTarifas {

    public static function ctrMostrarTarifas() {
        $respuesta = ModeloGestorDeTarifas::mdlMostrarTarifas();
        foreach ($respuesta as $key => $value) {
                $buttonPDF = '<button type="button" class="btn btn-outline-danger btn-sm btnPDFGTarifa" idClt="' . $value["identificador"] . '"><i class="fa fa-file-pdf-o"></i></button>';
                if ($_SESSION["niveles"] == "ADMINISTRADOR" || $_SESSION["niveles"] == "ALTO" && $_SESSION["departamentos"] == "Operaciones Generales") {
                    if ($value["estadoDeTarifa"] == 0) {
                        $bottonera = '<div class="btn-group btn-sm"><button type="button" class="btn btn-warning btn-sm" idClt="' . $value["identificador"] . '" estado="' . $value["estadoDeTarifa"] . '" disabled="disabled">Inactiva&nbsp;</button><button type="button" class="btn btn-info btnView btn-sm" data-toggle="modal" data-target="#MostrarTodoServicio" idMostrar=' . $value["tarifa"] . ' numerotarifa=' . $value["identificador"] . '  disabled="disabled"><i class="fa fa-eye"></i></button>' . $buttonPDF . '</div>';
                        $numTarifa = "Inactiva / Sin tarifa";
                    }
                    if ($value["estadoDeTarifa"] == 1) {
                        $bottonera = '<div class="btn-group btn-sm"><button type="button" class="btn btn-outline-primary btnActivarTarifa btn-sm" idClt="' . $value["identificador"] . '" estado="' . $value["estadoDeTarifa"] . '">Activa&nbsp;&nbsp;&nbsp;</button><button type="button" class="btn btn-outline-info btnView btn-sm" data-toggle="modal" data-target="#MostrarTodoServicio" idMostrar=' . $value["tarifa"] . ' numerotarifa=' . $value["identificador"] . '><i class="fa fa-eye"></i></button>' . $buttonPDF . '</div>';
                        $numTarifa = $value["tarifa"];
                    }
                    if ($value["estadoDeTarifa"] == 2) {
                        $bottonera = '<div class="btn-group btn-sm"><button type="button" class="btn btn-outline-dark btnActivarTarifa btn-sm" idClt="' . $value["identificador"] . '" estado="' . $value["estadoDeTarifa"] . '">Anulada</button><button type="button" class="btn btn-outline-info btnView btn-sm" data-toggle="modal" data-target="#MostrarTodoServicio" idMostrar=' . $value["tarifa"] . ' numerotarifa=' . $value["identificador"] . '><i class="fa fa-eye"></i></button>' . $buttonPDF . '</div>';
                        $numTarifa = $value["tarifa"];
                    }
                } else {
                    $bottonera = '<div class="btn-group btn-sm"><button type="button" class="btn btn-outline-info btnView btn-sm" data-toggle="modal" data-target="#MostrarTodoServicio" idMostrar=' . $value["tarifa"] . ' numerotarifa=' . $value["identificador"] . '><i class="fa fa-eye"></i></button>' . $buttonPDF . '</div>';
                    if ($value["estadoDeTarifa"] == 0) {
                        $numTarifa = "Inactiva / Sin tarifa";
                    }
                    if ($value["estadoDeTarifa"] == 1) {
                        $numTarifa = $value["tarifa"];
                    }
                    if ($value["estadoDeTarifa"] == 2) {
                        $numTarifa = $value["tarifa"];
                    }
                }
                echo '<tr>
                                <td>' . ($key + 1) . '</td>
                                <td>' . $value["numNit"] . '</td>
                                <td>' . $value["nombreEmpresa"] . '</td>
                                <td>' . $numTarifa . '</td>
                                <td>' . $value["Contacto"] . '</td>
                                <td>' . $value["telefono"] . '</td>
                                <td>' . $value["correo"] . '</td>
                                <td>' . $bottonera . '</td></tr>';
            
        }
    }

    public static function ctrMostrarTodoServicio($idMostrar, $numerotarifa) {

        $respuesta = ModeloGestorDeTarifas::mdlMostrarTodoServicio($idMostrar, $numerotarifa);
        return $respuesta;
    }

    public static function ctrActivDescactivaTarifa($estadoTarifa, $idClt) {

        try {
// CASTEO DE DATA
            $respEstado = revisionData::datoEntero($estadoTarifa);
            $respIdClt = revisionData::datoEntero($idClt);


            if ($respEstado == true || $respEstado == 0 && $respIdClt == true) {

//SOLICITUD DE DATA
                $sp = "spActivarTarifa";
                $respuesta = ModeloGestorDeTarifas::mdlDataDosParams($estadoTarifa, $idClt, $sp);

                if ($respuesta != "SD" && $respuesta["resp"] == true) {
                    return array("resp" => true, "primary" => $respuesta["data"]);
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
