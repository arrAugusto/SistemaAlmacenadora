<?php

require_once "cone.php";

class ModeloUsuarios {
    /* =============================================
      MOSTRAR USUARIOS
      ============================================= */

    static public function mdlMostrarUsuarios($tabla, $item, $valor) {
        if ($item != null) {
            $conn = Conexion::Conectar();
            $params = array(&$valor);
            $sql = "EXECUTE spMostrarUsuario ?";
            $stmt = sqlsrv_prepare($conn, $sql, $params);
            if (sqlsrv_execute($stmt) == true) {
                while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                    $results[] = $row;
                }
                if (!empty($results)) {
                    return $results;
                } else {
                    return "SD";
                }
            } else {
                return sqlsrv_errors();
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

    public static function mdlTipoDeCambio($fechaHoy) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spFCambioDia ?";
        $params = array(&$fechaHoy);
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
            if (!empty($results)) {
                return $results;
            } else {
                return "SD";
            }
        }
    }

    public static function mdlGuardarTipoDeCambio($fechaHoy, $tipoDeCambio) {
              $conn = Conexion::Conectar();
        $sql = "EXECUTE spTpCambioDia ?, ?";
        $params = array(&$tipoDeCambio, $fechaHoy);
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
            if (!empty($results)) {
                return $results;
            } else {
                return "SD";
            }
        }  
    }

    /* =============================================
      REGISTROS USUARIOS ALMACENADORAS
      ============================================= */

    static public function mdlIngresarUsuario($tabla, $datos) {
        $conn = Conexion::Conectar();
        $params = array($datos['nombres'],
            $datos['apellidos'],
            $datos['usuarios'],
            $datos['contra'],
            $datos['dpi'],
            $datos['nivel'],
            $datos['departamento'],
            $datos['dependencia'],
            $datos['telefono'],
            $datos['email'],
            $datos['email1'],
            $datos['foto'],
            $datos['estado'],
            $datos['fecha_creacion'],
            $datos['intentos'],
            $datos['pregunta'],
            $datos['respuesta']
        );

        $sql = "INSERT INTO  [dbo].[$tabla]"
                . "([nombres], [apellidos], [usuarios], [contra], [dpi], [nivel], [departamento], [dependencia], [telefono], [email], [emailEncriptado], [foto], [estado], [fecha_creacion], [intentos], [preguntaSecreta], [respuesta])"
                . "VALUES "
                . "(?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?)";

        $stmt = sqlsrv_query($conn, $sql, $params);
        if ($stmt == false) {
            die(print_r(sqlsrv_errors(), true));
        } else {
            return "ok";
        }
    }

    static public function mdlEditarUsuario($tabla, $item, $datos) {
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

    static public function mdlclienteUser($tabla, $datos) {
        $conn = Conexion::Conectar();
        $params = array(
            &$datos['nombres'],
            &$datos['apellidos'],
            &$datos['usuarios'],
            &$datos['contra'],
            &$datos['dpi'],
            &$datos['telefono'],
            &$datos['email'],
            &$datos['email1'],
            &$datos['pregunta'],
            &$datos['respuesta'],
            &$datos['razonSocial'],
            &$datos['nombreComercial'],
            &$datos['direccionFiscal'],
            &$datos['direccionDeRecibos'],
            &$datos['numeroNit'],
            &$datos['contacto'],
            &$datos['foto'],
            &$datos['estado'],
            &$datos['ultimoLogin'],
            &$datos['fecha_creacion'],
            &$datos['estadoTarifa'],
            &$datos['ejecutivoVentas'],
            &$datos['intentos'],
            &$datos['tarifa'],
            &$datos['idNit']
        );



        $conn = Conexion::Conectar();
        $sql = "EXECUTE  spNvCliente ?, ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?,  ?";


        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            return "exito";
        } else {
            return sqlsrv_errors();
        }
    }

    static public function mdlEditarContraFoto($tabla, $item, $datos, $colum) {

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

    static public function mdlRecuperaPass($valor, $tabla, $item) {

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

    public static function HistorialNavega($idUsNavega, $depe) {


        $conn = Conexion::Conectar();
        $params = array(&$idUsNavega, &$depe);

        $sql = "EXECUTE spConsultNav ?, ?";
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }


            if (!empty($results)) {
                return $results;
            } else {
                return "ErrorSinData";
            }
        }
    }

    public static function mdlMostrarUsuariosTerceros($tipoTercero, $bodega) {

        $conn = Conexion::Conectar();
        $params = array(&$tipoTercero, &$bodega);

        $sql = "EXECUTE spSelectPersonal ?, ?";
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }


            if (!empty($results)) {
                return $results;
            } else {
                return "ErrorSinData";
            }
        }
    }

    public static function mdlNivelDeUsuario() {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spNivelesUser";
        $stmt = sqlsrv_prepare($conn, $sql);
        if (sqlsrv_execute($stmt) == true) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
            if (!empty($results)) {
                return $results;
            } else {
                return "ErrorSinData";
            }
        } else {
            return sqlsrv_error();
        }
    }

    public static function mdlDepartamentos() {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spDepartamentos";
        $stmt = sqlsrv_prepare($conn, $sql);
        if (sqlsrv_execute($stmt) == true) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
            if (!empty($results)) {
                return $results;
            } else {
                return "ErrorSinData";
            }
        } else {
            return sqlsrv_error();
        }
    }

    public static function MdlMostrarUsuariosGestor($perfil) {
        if ($perfil == "internos") {
            $conn = Conexion::Conectar();
            $sql = "EXECUTE spMostrarGestorus";
            $stmt = sqlsrv_prepare($conn, $sql);
            if (sqlsrv_execute($stmt) == true) {
                while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                    $results[] = $row;
                }
                if (!empty($results)) {
                    return $results;
                } else {
                    return "ErrorSinData";
                }
            } else {
                return sqlsrv_error();
            }
        }
    }

    public static function mdlEstadoCliente($activarIdCliente, $activarUsuarioCliente) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spEstadoPersonal ?, ?";
        $params = array(&$activarIdCliente, &$activarUsuarioCliente);
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
            if (!empty($results)) {
                return $results;
            } else {
                return "SD";
            }
        } else {
            return sqlsrv_errors();
        }
    }
    public static function mdlVerUsuarioEdicion($idUsuario) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spMostrarUsuarioEdit ?";
        $params = array(&$idUsuario);
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
            if (!empty($results)) {
                return $results;
            } else {
                return "SD";
            }
        } else {
            return sqlsrv_errors();
        }
    }
    public static function mdlRestablecer($clave, $idUsuario) {
        $conn = Conexion::Conectar();
        $sql = "EXECUTE spRestablecer ?, ?";
        $params = array(&$clave, &$idUsuario);
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if (sqlsrv_execute($stmt) == true) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $results[] = $row;
            }
            if (!empty($results)) {
                return $results;
            } else {
                return "SD";
            }
        } else {
            return sqlsrv_errors();
        }
    }
}
