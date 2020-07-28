<?php

class ControladorSaldosContables {

    public static function ctrSaldoActualContabilidad() {
        $idDeBodega = $_SESSION["idDeBodega"];
        $sp = "spConsultaEmppresa";
        $respEmpresa = ModeloGenerarContabilidad::mdlMostrarContabilidad($sp, $idDeBodega);
        
        

        if ($respEmpresa[0]["idEmpresa"] >= 1) {
            $idEmpresa = $respEmpresa[0]["idEmpresa"];
        } else {
            return false;
        }
        $idDeBodega = $respEmpresa[0]["idEmpresa"];
        $sp = "spMostrarDetCont";
        $respVerDatos = ModeloGenerarContabilidad::mdlMostrarContabilidad($sp, $idDeBodega);
        
                if ($respVerDatos=="SD") {
              
                            $respEmpresa = ControladorEmpresasAlmacenadoras::ctrMostrarEmpresa($idDeBodega);
                            $empresa = $respEmpresa[0]["empresa"];        
        
                        echo '
                <tr>
                    <td>
                        <span class="ptable-title"><i class="fa fa-building-o"></i>' . $empresa . '</span></td>
                    <td>
                    <!-- Icon -->
                        <span class="badge bg-info">CIF : Q <input type="number" class="form-group" value /></span><br/>
                        <span class="badge bg-info">IMPUESTOS : Q <input type="number" class="form-group" value /></span>
                    </td>
                    <td>
                    <!-- Icon -->
                        <i class="fas fa-eye green"></i>
                        <div class="btn-group"><button type="button" class="btn btn-success btnHistoriaSaldos" btnVerHistoria=' . $idDeBodega . ' data-toggle="modal" data-target=".bd-example-modal-lg">Ver Historial</button><button type="button" class="btn btn-warning btnCorteContaPendt" btnCortesContables=' . $idDeBodega . ' data-toggle="modal" data-target="#modalCortesContables">Cierres Contables</button></div>
                    </td>
                </tr>
            ';
            return true;
        }

        
        
        $empresa = $respVerDatos[0]["empresa"];


        $sp = "spsaldosContablesF";
        $respuesta = ModeloSaldosContables::mdlSaldoActualContabilidad($sp, $idDeBodega);
        if ($respuesta != "SD") {
            $saldoCif = $respuesta[0]["saldoCif"];
            $saldoImpuestos = $respuesta[0]["saldoImpuestos"];

            $saldoCif = number_format($saldoCif, 2);
            $saldoImpuestos = number_format($saldoImpuestos, 2);

            echo '
                <tr>
                    <td>
                        <span class="ptable-title"><i class="fa fa-building-o"></i>' . $empresa . '</span></td>
                    <td>
                    <!-- Icon -->
                        <span class="badge bg-warning" style="font-size: 15px;">CIF : Q ' . $saldoCif . '</span><br/>
                        <span class="badge bg-warning" style="font-size: 15px;">IMPUESTOS : Q ' . $saldoImpuestos . '</span>
                    </td>
                    <td>
                    <!-- Icon -->
                        <i class="fas fa-eye green"></i>
                        <div class="btn-group"><button type="button" class="btn btn-success btnHistoriaSaldos" btnVerHistoria=' . $idDeBodega . ' data-toggle="modal" data-target=".bd-example-modal-lg">Ver Historial</button><button type="button" class="btn btn-warning btnCorteContaPendt" btnCortesContables=' . $idDeBodega . ' data-toggle="modal" data-target="#modalCortesContables">Cierres Contables</button></div>
                    </td>
                </tr>
            ';
        }
    }

    public static function ctrMostrarHistorial($viewHistorial) {
        $sp = "spSaldosCif";
        $respuesta = ModeloSaldosContables::mdlSaldoActualContabilidad($sp, $viewHistorial);
        return $respuesta;
    }

    public static function ctrMostrarHistorialImpts($viewHistorialImpts) {
        $sp = "spSaldosImpts";
        $respuesta = ModeloSaldosContables::mdlSaldoActualContabilidad($sp, $viewHistorialImpts);
        return $respuesta;
    }

    public static function ctrCortesPendientesContables($cortesPendiente) {
        $sp = "spCtrPendDia";
        $respuesta = ModeloSaldosContables::mdlSaldoActualContabilidad($sp, $cortesPendiente);
        return $respuesta;
    }

}
