<?php
class controladorParametrizarTarifaNormal
{
    public static function ctrParametrizarTarifaNormal($AjaxMostrarServiciosTarifaNormal)
    {
        return $AjaxMostrarServiciosTarifaNormal;

    }

    public static function ctrMostrarNitEmpresas($tipo){
        if ($tipo == 1) {
            $respuesta = ModeloParametrizarTarifaNormal::mdlMostrarNitEmpresas($tipo);
            return $respuesta;

        }
    }
public static function ctrCrearTarifaNormal($datos){
$respuesta=ModeloParametrizarTarifaNormal::mdlCrearTarifaNormal($datos);
return $respuesta;

}

public static function ctrConsultaEmpresa($consultaEmpresa){
    $respuesta=ModeloParametrizarTarifaNormal::mdlConsultaEmpresa($consultaEmpresa);
    return $respuesta;
}
}
