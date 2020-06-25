<?php

class ControladorHistorialIngresos {

    public static function ctrMostrarIngresosVigentes() {
        $valor = $_SESSION["idDeBodega"];
        $respuesta = ModeloHistorialIngresos::mdlMostrarIngresosVigentes($valor);

        if ($respuesta !== null || $respuesta !== NULL) {
            if ($respuesta == "SD") {
                
            } else {

                foreach ($respuesta as $key => $value) {
                    // Con objetos
                    if ($_SESSION["departamentos"] == "Operaciones Fiscales" && $_SESSION["niveles"] == "MEDIO") {
           
                    if ($value["accionEstado"] == 3) {
                        
                    }else{
                    if ($value["accionEstado"] == 1) {
                        if ($_SESSION["niveles"] == "MEDIO") {
                            $botoneraAcciones = '<div class="btn-group"><a href="#divEdiciones" class="btn btn-success btnEditOp" estado=1 role="button" btnEditOp=' . $value["identificador"] . ' ><i class="fa fa-edit"></i></a><div class="btn-group"><button type="button" buttonId=' . $value["identificador"] . ' class="btn btn-danger btnAnularMostModal"  data-toggle="modal" data-target="#AnulacionIngreso"><i class="fas fa-close"></i> </button><div class="btn-group"><button type="button" buttonId=' . $value["identificador"] . ' class="btn bg-info-gradient bntImprimir"><i class="fa fa-print"></i> </button></div>';
                        } else {
                            $botoneraAcciones = '<div class="btn-group"><a href="#divEdiciones" class="btn btn-success btnEditOp"  estado=1 role="button" btnEditOp=' . $value["identificador"] . ' ><i class="fa fa-edit"></i></a><div class="btn-group"><button type="button" buttonId=' . $value["identificador"] . ' class="btn bg-info-gradient bntImprimir"><i class="fa fa-print"></i> </button>';
                        }
                    } else if ($value["accionEstado"] == 2) {

                        if ($_SESSION["niveles"] == "MEDIO") {
                            $botoneraAcciones = '<div class="btn-group"><a href="#divEdiciones" class="btn btn-warning btnEditOp" estado=2 role="button" btnEditOp=' . $value["identificador"] . ' ><i class="fa fa-edit"></i></a><div class="btn-group"><button type="button" buttonId=' . $value["identificador"] . ' class="btn btn-danger btnAnularMostModal"  data-toggle="modal" data-target="#AnulacionIngreso"><i class="fas fa-close"></i> </button><div class="btn-group"><button type="button" buttonId=' . $value["identificador"] . ' class="btn bg-info-gradient bntImprimir"><i class="fa fa-print"></i> </button></div>';
                        } else {
                            $botoneraAcciones = '<div class="btn-group"><a href="#divEdiciones" class="btn btn-success btnEditOp"  estado=1 role="button" btnEditOp=' . $value["identificador"] . ' ><i class="fa fa-edit"></i></a><div class="btn-group"><button type="button" buttonId=' . $value["identificador"] . ' class="btn bg-info-gradient bntImprimir"><i class="fa fa-print"></i> </button>';
                        }
                    } else if ($value["accionEstado"] == 4) {
                        if ($_SESSION["niveles"] == "MEDIO") {
                            $botoneraAcciones = '<div class="btn-group"><a href="#divEdiciones" class="btn btn-success btnEditOp" estado=3 role="button" btnEditOp=' . $value["identificador"] . ' ><i class="fa fa-edit"></i></a><div class="btn-group"><button type="button" buttonId=' . $value["identificador"] . ' class="btn btn-danger btnAnularMostModal"  data-toggle="modal" data-target="#AnulacionIngreso"><i class="fas fa-close"></i> </button><div class="btn-group"><button type="button" buttonId=' . $value["identificador"] . ' class="btn bg-info-gradient bntImprimir"><i class="fa fa-print"></i> </button></div>';
                        } else {
                            $botoneraAcciones = '<div class="btn-group"><a href="#divEdiciones" class="btn btn-danger btnEditOp"  estado=1 role="button" btnEditOp=' . $value["identificador"] . ' ><i class="fa fa-edit"></i></a><div class="btn-group"><button type="button" buttonId=' . $value["identificador"] . ' class="btn bg-info-gradient bntImprimir"><i class="fa fa-print"></i> </button>';
                        }
                    }else if ($value["accionEstado"] == -1) {
                            $botoneraAcciones = '<div class="btn-group"><button type="button" buttonId=' . $value["identificador"] . ' class="btn bg-info-gradient bntImprimir"><i class="fa fa-print"></i> </button><div class="btn-group"><button type="button" buttonId=' . $value["identificador"] . ' class="btn btn-dark" disabled>Anulado&nbsp;&nbsp;<i class="fas fa-ban"></i></button></div>';
                        }
                        }
                        }else{
                         $botoneraAcciones = '<div class="btn-group"><button type="button" buttonId=' . $value["identificador"] . ' class="btn bg-info-gradient bntImprimir"><i class="fa fa-print"></i> </button><div class="btn-group"></div>';   
                        }
                        

                        $fecha_actual = new DateTime();
                    $cadena_fecha_actual = $value["fechaIngreso"]->format("d-m-Y");

                    echo '
                                                         <tr>
                                                         <td>' . ($key + 1) . '</td>
                                                         <td>' . ($respuesta[$key]["nit"]) . '</td>
                                     <td>' . ($value["empresa"]) . '</td>
                                     <td>' . ($value["poliza"]) . '</td>
                                     <td>' . ($cadena_fecha_actual) . '</td>
                                     <td>' . ($value["blts"]) . '</td>
                                     <td>' . ($value["cif"]) . '</td>
                                     <td>' . ($value["impuesto"]) . '</td>
                                    <td><center>' . $botoneraAcciones . '</center></td>
                                    </tr>';
                }
            }
            }
        }

    public static function ctrEditarIngOperacion($idIngEditOp) {
        $respuesta = ModeloHistorialIngresos::mdlEditarIngOperacion($idIngEditOp);
        return $respuesta;
    }

    public static function ctrEditarIngresoOperacion($datos) {
        $respuesta = ModeloHistorialIngresos::mdlEditarIngresoOperacion($datos);
        return $respuesta;
    }

    public static function ctrMostrarServiciosEdit() {
        $respuesta = ModeloHistorialIngresos::mdlMostrarServiciosEdit();
        foreach ($respuesta as $key => $value) {
            echo '<option value=' . $value["idServicio"] . '>' . $value["nombreServicio"] . '</option>';
        }
    }

    public static function ctrMostrarRegimenes() {
        $respuesta = ModeloHistorialIngresos::mdlMostrarRegimenes();
        foreach ($respuesta as $key => $value) {
            echo '<option value=' . $value["id"] . '>' . $value["regimen"] . '</option>';
        }
    }

    public static function ctrmostrarDetallesClientesPlts($idIngClientesPlt) {

        $respuestaClientes = ModeloHistorialIngresos::mdlMostrarDetallesClientesPlts($idIngClientesPlt);
        //      $respuestaPiloto =  ModeloHistorialIngresos::mdlMostrarDetallesPlts($idIngClientesPlt );

        return array("respuestaClientes" => $respuestaClientes);
    }
public static function ctrAnularIngreso($idIngresoAnulacion){
    $respuestaVal = ModeloHistorialIngresos::mdlAnularIngresoValidacion($idIngresoAnulacion);  

    if ($respuestaVal[0]["ingreso"]==0 || $respuestaVal[0]["movimientosIngreso"]>=1) {
        return "SinAnulacion";
    }

    if ($respuestaVal[0]["ingreso"]==1 && $respuestaVal[0]["movimientosIngreso"]==0) {
       $respuestaAnulada = ModeloHistorialIngresos::mdlAnularIngreso($idIngresoAnulacion);
       return $respuestaAnulada;
    }
}
public static function ctrMostrarPuertos(){
    
    $respuesta = ModeloHistorialIngresos::mdlMostrarPuertos();
            foreach ($respuesta as $key => $value) {
            echo '<option>'.$value["clave"]." - " . $value["origen"] . '</option>';
        }
}


    
}
