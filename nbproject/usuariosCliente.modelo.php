<?php

require_once "cone.php";

class ModeloUsuariosExternos {
    /* =============================================
      MOSTRAR USUARIOS
      ============================================= */

    public static function MdlMostrarUsuariosExternos($tabla, $item, $valor) {

        if ($item != null) {

            $conn = Conexion::Conectar();

            $query = "SELECT * FROM $tabla WHERE $item=$valor";
            $stmt = sqlsrv_prepare($conn, $query);
            $result = sqlsrv_execute($stmt);

            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {

                $id = $row['id'];
                $nit = $row['nit'];
                $user = $row['usuarios'];
                $razonSocial = $row['razonSocial'];
                $estadoTarifa = $row['estadoTarifa'];
                $direccionFiscal = $row['direccionFiscal'];
                $direccionDeRecibos = $row['direccionDeRecibos'];
                $telefono = $row['telefono'];
                $email = $row['email'];
                $ejecutivo = $row['ejecutivoVentas'];
                $numeroTarifa = $row['numeroTarifa'];

                if ($numeroTarifa == null || $numeroTarifa == 11111 || $estadoTarifa == 0) {
                    $numeroTarifa = "SN";
                }



                return array("numeroTarifa" => $numeroTarifa, "email" => $email, "id" => $id, "nit" => $nit, "usuario" => $user, "razonSocial" => $razonSocial, "direccionFiscal" => $direccionFiscal, "direccionDeRecibos" => $direccionDeRecibos, "estadoTarifa" => $estadoTarifa, "telefono" => $telefono, "ejecutivo" => $ejecutivo);
            }
        } else {
            $conn = Conexion::Conectar();
            $query = "SELECT * FROM $tabla";
            $stmt = sqlsrv_prepare($conn, $query);
            $result = sqlsrv_execute($stmt);

            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
            return $results;
        }

        sqlsrv_free_stmt($stmt);
        sqlsrv_close($conn);
    }

    /* =============================================
      REGISTROS USUARIOS ALMACENADORAS
      ============================================= */

    public static function mdlIngresarUsuario($tabla, $datos) {
        $conn = Conexion::Conectar();
        $params = array($datos['nombres'],
            $datos['apellidos'],
            $datos['usuarios'],
            $datos['contra'],
            $datos['dpi'],
            $datos['nivel'],
            $datos['departamento'],
            $datos['funcion'],
            $datos['dependencia'],
            $datos['telefono'],
            $datos['email'],
            $datos['email1'],
            $datos['foto'],
            $datos['estado'],
            $datos['fecha_creacion'],
            $datos['intentos'],
            $datos['pregunta'],
            $datos['respuesta'],
        );

        $sql = "INSERT INTO  [dbo].[$tabla]"
                . "([nombres], [apellidos], [usuarios], [contra], [dpi], [nivel], [departamento], [funcion], [dependencia], [telefono], [email], [emailEncriptado], [foto], [estado], [fecha_creacion], [intentos], [preguntaSecreta], [respuesta])"
                . "VALUES "
                . "(?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?)";
        $stmt = sqlsrv_query($conn, $sql, $params);
        if ($stmt == false) {
            die(print_r(sqlsrv_errors(), true));
        } else {
            return "ok";
        }
    }

    public static function mdlEditarUsuario($tabla, $item, $datos) {
        $conn = Conexion::Conectar();
        $user = $datos["usuarioid"];

        $params = array($datos['telefono'],
            $datos['correo']);

        $sql = "UPDATE dbo.$tabla SET telefono=(?), email=(?) WHERE $item=" . $datos["usuarioid"];

        $stmt = sqlsrv_query($conn, $sql, $params);
        if ($stmt == false) {
            die(print_r(sqlsrv_errors(), true));
        } else {
            return "ok";
        }
        sqlsrv_free_stmt($stmt);
        sqlsrv_close($conn);
    }

    public static function mdlclienteUser($tabla, $datos) {
        $conn = Conexion::Conectar();
        $params = array($datos['nombres'],
            $datos['apellidos'],
            $datos['usuarios'],
            $datos['contra'],
            $datos['dpi'],
            $datos['telefono'],
            $datos['email'],
            $datos['email1'],
            $datos['pregunta'],
            $datos['respuesta'],
            $datos['razonSocial'],
            $datos['nombreComercial'],
            $datos['direccionFiscal'],
            $datos['direccionDeRecibos'],
            $datos['nit'],
            $datos['contacto'],
            $datos['foto'],
            $datos['estado'],
            $datos['fecha_creacion'],
            $datos['intentos']);

        $sql = "INSERT INTO  [dbo].[$tabla]"
                . "([nombres], [apellidos], [usuarios], [contra], [dpi], [telefono], [email], [emailEncriptado], [preguntaSecreta], [respuesta], [razonSocial], [nombreComercial], [direccionFiscal], [direccionDeRecibos], [nit], [contacto], [foto], [estado], [fecha_creacion], [intentos])"
                . "VALUES "
                . "(?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?)";
        $stmt = sqlsrv_query($conn, $sql, $params);
        if ($stmt == false) {
            die(print_r(sqlsrv_errors(), true));
        } else {
            return "ok";
        }
    }

    public static function mdlEditarContraFoto($tabla, $item, $datos, $colum) {

        $conn = Conexion::Conectar();

        $params = array($datos['nuevoDato']);

        $sql = "UPDATE dbo.$tabla SET $colum=(?) WHERE " . $item . "=" . $datos["usuario"];
        $stmt = sqlsrv_query($conn, $sql, $params);

        if ($stmt == false) {
            die(print_r(sqlsrv_errors(), true));
        } else {
            return "ok";
        }
        sqlsrv_free_stmt($stmt);
        sqlsrv_close($conn);
    }

    public static function mdlRecuperaPass($valor, $tabla, $item) {

        $conn = Conexion::Conectar();
        $query = "SELECT * FROM $tabla WHERE $item=$valor";
        $stmt = sqlsrv_prepare($conn, $query);
        $result = sqlsrv_execute($stmt);

        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $user = $row['usuarios'];
            $emailEncriptado = $row['emailEncriptado'];
            $contra = $row['contra'];
            $preguntas = $row['preguntaSecreta'];
            $respuesta = $row['respuesta'];

            return array("usuario" => $user, "emailEncriptado" => $emailEncriptado, "contra" => $contra, "preguntas" => $preguntas, "respuestas" => $respuesta);
        }
    }


}
