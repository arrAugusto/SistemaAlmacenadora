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
        $sp = "spSaldosContables";
        $idDeBodega = $respEmpresa[0]["idEmpresa"];
        $respSldsConta = ModeloGenerarContabilidad::mdlMostrarContabilidad($sp, $idDeBodega);

        if ($respSldsConta[0]["countImpts"] == 0 && $respSldsConta[0]["countCif"] == 0) {

            $respEmpresa = ControladorEmpresasAlmacenadoras::ctrMostrarEmpresa($idDeBodega);
            $empresa = $respEmpresa[0]["empresa"];

            echo '
                <tr>
                    <td>
                        <span class="ptable-title"><i class="fa fa-building-o"></i>' . $empresa . '</span></td>
                    <td>
                    <!-- Icon -->
                        CIF : Q <input class="form-control is-invalid" type="number" placeholder="Ejemplo : 250.25" id="cifInicial" onkeyup="javascript:this.value = this.value.toUpperCase();">
                        IMPUESTOS : Q <input class="form-control is-invalid" type="number" placeholder="Ejemplo : 250.25" id="impuestoInicial" onkeyup="javascript:this.value = this.value.toUpperCase();">
                    </td>
                    <td>
                    <!-- Icon -->
                        <i class="fas fa-save"></i>
                        <div class="btn-group"><button type="button" class="btn btn-primary btnInicialFiscal" btnInicia=' . $idDeBodega . '>Guardar Saldo Inicial</button></div>
                    </td>
                </tr>
            ';
            return true;
        }



        $sp = "spDatosContabilidad";
        $respVerDatos = ModeloGenerarContabilidad::mdlMostrarContabilidad($sp, $idDeBodega);

        $empresa = $respVerDatos[0]["empresa"];

        $idDeBodega = $respEmpresa[0]["idEmpresa"];
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

    public static function ctrSaldosInicioConta($idEmpInicalConta, $sldContableCif, $sldContableImpts) {
        $sp = "spSldInicialConta";
        $respuesta = ModeloSaldosContables::mdlSaldosInicioConta($sp, $idEmpInicalConta, $sldContableCif, $sldContableImpts);
        return $respuesta;
    }

}
