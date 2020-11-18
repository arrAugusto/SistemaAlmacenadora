<?php

class ControladorVisitasAlmacenadoras {

    public static function ctrNuevaVisita($procedencia, $destino, $placaVisita, $listaVisitas, $gafete, $idBodegaNavega, $usuarioOp) {
        $respuesta = ModeloVisitasAlmacenadoras::mdlNuevaVisita($procedencia, $destino, $placaVisita, $listaVisitas, $gafete);

        if ($respuesta[0]["resp"] == 1) {
            $idEmpresa = $respuesta[0]["idEmpresa"];
            $idAreaVisita = $respuesta[0]["idAreaVisita"];
            $idPlacaVisitante = $respuesta[0]["placaVisita"];
            $datosVitantes = json_decode($listaVisitas, true);
            $contador = 0;
            foreach ($datosVitantes as $key => $value) {
                $licenciaVisita = $value[0];
                $nombreVisita = $value[1];
                $respuesta = ModeloVisitasAlmacenadoras::mdlNuevaVisitaData($licenciaVisita, $nombreVisita, $idPlacaVisitante, $idAreaVisita, $idEmpresa, $gafete, $idBodegaNavega, $usuarioOp);
                if ($respuesta != "SD") {
                    $contador = $contador + 1;
                }
            }
            if ($contador == count($datosVitantes)) {
                return "Exito";
            }
        }
    }

}
