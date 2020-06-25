<?php

require_once "cone.php";

//Activar Tarfia
class ModeloActivarTarifas {
    /* ingreso usuarios */

/*    public static function mdlActivarTarifas($tabla, $item, $valor) {

        $conn = Conexion::Conectar();

        $query = "SELECT ALM." . "idServicio, ALM.idTarifa, SER.servicio, ALM.calculoSobre FROM SERVICIOS SER, ALMACENAJES ALM WHERE ALM.idServicio=SER.id AND idUsuarioCliente=$valor AND ALM.aplicaServicio=1";

        $stmt = sqlsrv_prepare($conn, $query);

        if (sqlsrv_execute($stmt) == true) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
            return $results;
        } else {
            return sqlsrv_errors();
        }

        sqlsrv_free_stmt($stmt);
        sqlsrv_close($conn);
    }*/

    /* =============================================
      INSERTANDO VALORES A DIFERENTES VACES DE DATOS
      ============================================= */

    /*     * INSERTANDO A TABLA SEGURO* */

    public static function mdlIngresoOtrosServicios($tablas, $datos) {
        $tabla = $tablas["tabla1"];
        $valor1 = $datos[6];

        $data = array("idTarifa" => $datos[0], "idUsuario" => $datos[16], "idServicio" => $datos[1], "periodoSeguro" => $datos[2], "baseSeguro" => $datos[3], "peridoCalculo" => $datos[4], "monedaCalculo" => $datos[5], "valorSeguro" => $datos[6], "aplicaServicio" => 1, "fechaCot" => "2019/03/01", "fechaInicio" => "2019/03/01", "numeroTarifa" => 11111);
        $params = array($data['idTarifa'],
            $data['idUsuario'],
            $data['idServicio'],
            $data['periodoSeguro'],
            $data['baseSeguro'],
            $data['peridoCalculo'],
            $data['monedaCalculo'],
            $data['valorSeguro'],
            $data['aplicaServicio'],
            $data['fechaCot'],
            $data['fechaInicio'],
            $data['numeroTarifa']);

        if ($valor1 == 0) {
            return "Servicio no guardado";
        }

        if (is_numeric($valor1)) {

            /*             * INSERT A BASE DE DATOS SEGURO */

            $conn = Conexion::Conectar();
            $sql = "INSERT INTO  [dbo].[$tabla]"
                    . " ([idTarifa]
           ,[idUsuarioCliente]
           ,[idServicio]
           ,[periodSeguro]
           ,[baseSeguro]
           ,[periodoCalculo]
           ,[monedaCalculo]
           ,[valorSeguro]
           ,[aplicaServicio]
           ,[fechaCotizacion]
           ,[fechaInicio]
           ,[numeroSerie])"
                    . " VALUES "
                    . "(?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?
)";

            $stmt = sqlsrv_query($conn, $sql, $params);
            if ($stmt == false) {
                return sqlsrv_errors();
            } else {
                return "ok";
            }
        } else {
            return "Servicio no guardado";
        }
        sqlsrv_free_stmt($stmt);
        sqlsrv_close($conn);
    }

    /* =============================================
      INSERTANDO VALORES A DIFERENTES VACES DE DATOS
      ============================================= */

    /*     * INSERTANDO A TABLA MANEJO* */

    public static function mdlIngresoOtrosServicios1($tablas, $datos) {

        $tabla = $tablas["tabla2"];
        $valor1 = $datos[9];

        $data = array("idTarifa" => $datos[0], "idUsuario" => $datos[16], "idServicio" => $datos[1], "baseManejo" => $datos[7], "monedaCalculo" => $datos[8], "valorManejo" => $datos[9], "aplicaServicio" => 1, "fechaCot" => "2019/03/01", "fechaInicio" => "2019/03/01", "numeroTarifa" => 11111);
        $params = array($data['idTarifa'],
            $data['idUsuario'],
            $data['idServicio'],
            $data['baseManejo'],
            $data['monedaCalculo'],
            $data['valorManejo'],
            $data['aplicaServicio'],
            $data['fechaCot'],
            $data['fechaInicio'],
            $data['numeroTarifa']
        );
        if ($valor1 == 0) {
            return "Servicio no guardado";
        }

        if (preg_match('/^[0-9]+(\.[0-9]{1,2})?$/', $valor1)) {

            if (is_numeric($valor1)) {

                /*                 * INSERT A BASE DE DATOS SEGURO */

                $conn = Conexion::Conectar();
                $sql = "INSERT INTO  [dbo].[$tabla]"
                        . "([idTarifa]
           ,[idUsuarioCliente]
           ,[idServicio]
           ,[baseManejo]
           ,[monedaCalculo]
           ,[valorManejo]
           ,[aplicaServicio]
           ,[fechaCotizacion]
           ,[fechaInicio]
           ,[numeroSerie])"
                        . " VALUES "
                        . "(?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?)";

                $stmt = sqlsrv_query($conn, $sql, $params);
                if ($stmt == false) {
                    return sqlsrv_errors();
                } else {
                    return "ok";
                }
            }
        } else {
            return "Servicio no guardado";
        }
        sqlsrv_free_stmt($stmt);
        sqlsrv_close($conn);
    }

    /* =============================================
      INSERTANDO VALORES A DIFERENTES VACES DE DATOS
      ============================================= */

    /*     * INSERTANDO A TABLA GASTOS ADMINISTRACION* */

    public static function mdlIngresoOtrosServicios2($tablas, $datos) {

        $tabla = $tablas["tabla3"];
        $valor1 = $datos[12];

        $data = array("idTarifa" => $datos[0], "idUsuario" => $datos[16], "idServicio" => $datos[1], "basegastosAdmin" => $datos[10], "monedaCalculo" => $datos[11], "valorgastosAdmin" => $datos[12], "aplicaServicio" => 1, "fechaCot" => "2019/03/01", "fechaInicio" => "2019/03/01", "numeroTarifa" => 11111);
        $params = array($data['idTarifa'],
            $data['idUsuario'],
            $data['idServicio'],
            $data['basegastosAdmin'],
            $data['monedaCalculo'],
            $data['valorgastosAdmin'],
            $data['aplicaServicio'],
            $data['fechaCot'],
            $data['fechaInicio'],
            $data['numeroTarifa']
        );
        if ($valor1 == 0) {
            return "Servicio no guardado";
        }

        if (preg_match('/^[0-9][0-9]{0,15}$/', $valor1)) {

            if (is_numeric($valor1)) {

                /*                 * INSERT A BASE DE DATOS SEGURO */

                $conn = Conexion::Conectar();
                $sql = "INSERT INTO  [dbo].[$tabla]"
                        . "([idTarifa]
           ,[idUsuarioCliente]
           ,[idServicio]
           ,[basegastosAdmin]
           ,[monedaCalculo]
           ,[valorgastosAdmin]
           ,[aplicaServicio]
           ,[fechaCotizacion]
           ,[fechaInicio]
           ,[numeroSerie])"
                        . " VALUES "
                        . "(?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?)";

                $stmt = sqlsrv_query($conn, $sql, $params);
                if ($stmt == false) {
                    return sqlsrv_errors();
                } else {
                    return "ok";
                }
            }
        } else {
            return "Servicio no guardado";
        }
        sqlsrv_free_stmt($stmt);
        sqlsrv_close($conn);
    }

    /* =============================================
      INSERTANDO VALORES A DIFERENTES VACES DE DATOS
      ============================================= */

    /*     * INSERTANDO A TABLA GASTOS ADMINISTRACION* */

    public static function mdlIngresoOtrosServicios3($tablas, $datos) {

        $tabla = $tablas["tabla4"];
        $valor1 = $datos[15];
        date_default_timezone_set('America/Guatemala');
        $time = date('Y-m-d');
        $data = array("idTarifa" => $datos[0], "idUsuario" => $datos[16], "idServicio" => $datos[1], "baseotrosGastos" => $datos[10], "monedaCalculo" =>
            $datos[11], "valorotrosGastos" => $datos[12], "aplicaServicio" => 1,
            "fechaCot" => $time, "fechaInicio" => $time, "numeroTarifa" => 11111);
        $params = array($data['idTarifa'],
            $data['idUsuario'],
            $data['idServicio'],
            $data['baseotrosGastos'],
            $data['monedaCalculo'],
            $data['valorotrosGastos'],
            $data['aplicaServicio'],
            $data['fechaCot'],
            $data['fechaInicio'],
            $data['numeroTarifa']
        );

        if ($valor1 == 0) {
            return "Servicio no guardado";
        }

        if (preg_match('/^[0-9]+(\.[0-9]{1,2})?$/', $valor1)) {

            if (is_numeric($valor1)) {

                /*                 * INSERT A BASE DE DATOS SEGURO */

                $conn = Conexion::Conectar();
                $sql = "INSERT INTO  [dbo].[$tabla]"
                        . " ([idTarifa]
           ,[idUsuarioCliente]
           ,[idServicio]
           ,[baseotrosGastos]
           ,[monedaCalculo]
           ,[valorotrosGastos]
           ,[aplicaServicio]
           ,[fechaCotizacion]
           ,[fechaInicio]
           ,[numeroSerie])"
                        . " VALUES "
                        . "(?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?)";

                $stmt = sqlsrv_query($conn, $sql, $params);
                if ($stmt == false) {
                    return sqlsrv_errors();
                } else {
                    return "ok";
                }
            }
        } else {
            return "Servicio no guardado";
        }
        sqlsrv_free_stmt($stmt);
        sqlsrv_close($conn);
    }

    public static function mdlMostrarUnParam($idNit, $sp) {
        $conn = Conexion::Conectar();
        $params = array(&$idNit);
        $sql = "EXECUTE " . $sp . " ?";
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
            if (!empty($results)) {
                return array("resp"=>true, "data"=>$results);
            } else {
                return "SD";
            }
        } else {
            return array("resp"=>false);
        }
    }

}
