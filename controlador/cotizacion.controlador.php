<?php

class controladorServicios {

    public static function ctrConsultaServicios() {
        $tabla = "SERVICIOS";
        $valor = "";
        $envia = ModeloServicios::mdlMostrarServicios($tabla, $valor);

        foreach ($envia as $key => $value) {
            echo '
                                                            <tr>
                                                            <td>' . ($key + 1) . '</td>
                                                               <td servicio="' . $value["servicio"] . '">' . $value["servicio"] . '</td>
                                                               <td>
                                                               <select class="form-control select2"  id="calculoSobre' . ($key + 1) . '" name="calculoSobre' . ($key + 1) . '">
                                                               <option>Saldo Diario</option>
                                                               <option>Saldo Anticipado</option></select>
                                                               </td>
                                                               <td>
                                                               <select class="form-control select2" style="width: 100%;" id="baseCalculo' . ($key + 1) . '" name="baseCalculo' . ($key + 1) . '">
                                                               <option>Posiciones</option>
                                                               <option>Porcentaje</option>
                                                               <option>Metros²</option>
                                                               <option>Metros³</option>
                                                               <option>Unidad</option>
                                                               </select>
                                                               </td>
                                                               <td>
                                                               <select class="form-control select2" style="width: 100%;" id="periodoCobro' . ($key + 1) . '" name="periodoCobro' . ($key + 1) . '">
                                                               <option>Diario</option>
                                                               <option>Mensual</option>
                                                               <option>Anual</option>
                                                               </select>
                                                               </td>
                                                               <td>
                                                               <select class="form-control select2" style="width: 100%;" id="moneda' . ($key + 1) . '" name="moneda' . ($key + 1) . '">
                                                               <option>Quetzales</option>
                                                               <option>Porcentaje %</option>
                                                               <option>Dolares $</option>
                                                               </select>
                                                               </td>
                                                               <td>
                                                               <input type="number" class="form-control input-lg"  placeholder="Valor"  id="valorAlmacenaje' . ($key + 1) . '" name="valorAlmacenaje' . ($key + 1) . '">
                                                               </td>
                                                               <td>
                                                               <div class="btn-group">
                                                               <button type="button"  class="btn btn-outline-success btnGuardar"  servicioAlmacenaje="' . $value["servicio"] . '" idServicio="' . $value["id"] . '"estadoUsuario="' . ($key + 1) . '"> <i class="fa fa-upload"></i></button>
                                                                 </div>
                                                               </td>
                                                           </tr>';
        }
    }

    public static function ctrNuevoTarifa($tabla, $datos) {
        $respuesta = ModeloServicios::mdlNuevaTarifa($tabla, $datos);
        return $respuesta;
    }

    public static function ctrNitClientesTarifaEspecial() {
        $respuesta = ModeloServicios::mdlNitClientesTarifaEspecial();
        foreach ($respuesta as $key => $value) {
            echo '<option value="' . $value["idCliente"] . '">' . $value["nitCliente"] . ' </option>';
        }
    }

}
