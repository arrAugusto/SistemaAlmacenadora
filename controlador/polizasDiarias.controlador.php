<?php

class ControladorGenerarContabilidad {

    public static function ctrGenerarPolizasDiarias($fechaContable) {
        if (date('Y-m-d', strtotime($fechaContable)) == $fechaContable) {
            $respuesta = ModeloGenerarContabilidad::mdlGenerarPolizasDiarias($fechaContable);
            return $respuesta;
        } else {
            return false;
        }
    }

    public static function ctrCtsContables() {
        $respuesta = ModeloGenerarContabilidad::mdlCtsContables();
        return $respuesta;
    }

    public static function ctrMostrarContabilidad() {

        $idDeBodega = $_SESSION["idDeBodega"];
        $sp = "spContabilidad";
        $tipo = 0;
        $respMostIng = ModeloGenerarContabilidad::mdlMostrarContabilidad($sp, $tipo);

        if ($respMostIng[0]["totalCifIngMerca"] > 0) {
            $cif = $respMostIng[0]["totalCifIngMerca"];
            $numberCif = number_format($cif, 2);
            $impuesto = $respMostIng[0]["totalImpuestoIngMerca"];
            $numImpuesto = number_format($impuesto, 2);
            $total = ($cif + $impuesto);
            $numTotal = number_format($total, 2);
            echo '
            <tbody>
                <tr>
                    <th scope="row">802103.0102</th>
                    <td>CON PÓLIZA DEFINITIVA</td>
                    <td><h8 class="float-left">Q.</h8><h8 class="float-right">' . $numberCif . '</h8></td>
                    <td></td>
                </tr>
                <tr>
                    <th scope="row">801109.01</th>
                    <td>IMPUESTOS DE MERCADERÍAS EN BOD. FISCALES</td>
                    <td><h8 class="float-left">Q.</h8><h8 class="float-right">' . $numImpuesto . '</h8></td>                    <td></td>
                    </tr>
                <tr>
                    <th scope="row">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;888888</th>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CUENTAS DE ORDEN POR CONTRA</td>
                    <td></td>
                    <td><h8 class="float-left">Q.</h8><h8 class="float-right">' . $numTotal . '</h8></td>                    <td></td>
                </tr>
                <tr>
                    <th scope="row"></th>
                    <td>INGRESOS DE CIF E IMPUESTOS EN ZONA ADUANERADE BODEGAS Y PREDIO <br/>DE VEHICULOS</td>
                    <td><b class="float-left">Q.</b><b class="float-right">' . $numTotal . '</b></td>
                    <td><b class="float-left">Q.</b><b class="float-right">' . $numTotal . '</b></td>
                </tr>    
            </tbody>


';
        }
        
                $sp = "spContabilidad";
        $tipo = 1;
        $respMostRet = ModeloGenerarContabilidad::mdlMostrarContabilidad($sp, $tipo);
                    echo '
            <tbody style="border-top: 4px solid #084587">
                <tr>
                    <th scope="row">802103.0102</th>
                    <td>CON PÓLIZA DEFINITIVA</td>
                    <td><h8 class="float-left">Q.</h8><h8 class="float-right">' . $numberCif . '</h8></td>
                    <td></td>
                </tr>
                <tr>
                    <th scope="row">801109.01</th>
                    <td>IMPUESTOS DE MERCADERÍAS EN BOD. FISCALES</td>
                    <td><h8 class="float-left">Q.</h8><h8 class="float-right">' . $numImpuesto . '</h8></td>                    <td></td>
                    </tr>
                <tr>
                    <th scope="row">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;888888</th>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CUENTAS DE ORDEN POR CONTRA</td>
                    <td></td>
                    <td><h8 class="float-left">Q.</h8><h8 class="float-right">' . $numTotal . '</h8></td>                    <td></td>
                </tr>
                <tr>
                    <th scope="row"></th>
                    <td>INGRESOS DE CIF E IMPUESTOS EN ZONA ADUANERADE BODEGAS Y PREDIO <br/>DE VEHICULOS</td>
                    <td><b class="float-left">Q.</b><b class="float-right">' . $numTotal . '</b></td>
                    <td><b class="float-left">Q.</b><b class="float-right">' . $numTotal . '</b></td>
                </tr>    
            </tbody>


';
    }

}
