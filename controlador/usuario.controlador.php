<?php

class ControladorUsuarios {
    /* ingreso usuarios */

    public static function ctrIngresoUsuario() {


        if (isset($_POST["ingUsuarios"])) {
            if (preg_match('/^[0-9]+$/', $_POST["ingUsuarios"]) &&
                    preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"])) {

                $encriptar = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
                $tabla = "personal";
                $item = "usuarios";
                $valor = $_POST["ingUsuarios"];
                $respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);
                if ($respuesta == "SD") {
                    echo '</br></br><div class="alert alert-danger alert-dismissible">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<h5><i class="icon fa fa-danger"></i> ¡Aviso!</h5>
Contraseña o Usuario Incorrecto
</div>';
                } else {


                    if ($respuesta == false) {
                        echo '</br></br><div class="alert alert-danger alert-dismissible">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<h5><i class="icon fa fa-danger"></i> ¡Aviso!</h5>
Por el momento no puede ingresar al sistema. Comiquese con el dapartamento de TI.
</div>';
                    }

                    if ($respuesta[0]["usuario"] == $_POST["ingUsuarios"] && $respuesta[0]["contra"] == $encriptar) {
                        if ($respuesta[0]["estado"] === 1) {
                            $_SESSION["IniciarSesion"] = "ok";
                            $_SESSION["id"] = $respuesta[0]["id"];
                            $_SESSION["nombre"] = $respuesta[0]["nombre"];
                            $_SESSION["foto"] = $respuesta[0]["foto"];
                            $_SESSION["apellidos"] = $respuesta[0]["apellidos"];
                            $_SESSION["fecha_creacion"] = $respuesta[0]["fecha_creacion"];
                            $_SESSION["telefono"] = $respuesta[0]["telefono"];
                            $_SESSION["niveles"] = $respuesta[0]["niveles"];
                            $_SESSION["email"] = ($respuesta[0]["email"]);
                            $_SESSION["usuario"] = $respuesta[0]["usuario"];
                            $_SESSION["estado"] = $respuesta[0]["estado"];
                            $_SESSION["dependencia"] = $respuesta[0]["dependencia"];
                            $_SESSION["EmpresaDependiente"] = $respuesta[0]["dependencia"];
                            $_SESSION["departamentos"] = $respuesta[0]["departamentos"];
                            $idUsNavega = $_SESSION["id"];
                            $depe = $_SESSION["dependencia"];
                            $respuestaNavega = ModeloUsuarios::HistorialNavega($idUsNavega, $depe);
                            if ($respuestaNavega == "ErrorSinData") {
                                $_SESSION["Navega"] = "SinNav";
                                $_SESSION["NavegaBod"] = "SinNav";
                                $_SESSION["NavegaNumB"] = "SinNav";
                                $_SESSION["idDeBodega"] = "SinNav";
                                echo '<script>
window.location="configuracion";
</script>';
                            } else {
                                $_SESSION["Navega"] = $respuestaNavega[0]["nomEmpresa"];
                                $_SESSION["NavegaBod"] = $respuestaNavega[0]["Areas"];
                                $_SESSION["NavegaNumB"] = $respuestaNavega[0]["numBod"];
                                $_SESSION["idDeBodega"] = $respuestaNavega[0]["idDeBodega"];
                                echo '<script>
window.location="Inicio";
</script>';
                            }
                        } else {
                            echo '</br></br><div class="alert alert-danger alert-dismissible">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<h5><i class="icon fa fa-danger"></i> ¡Aviso!</h5>
No cuenta con permisos para ingresar al sistema
</div>';
                        }
                    } else {
                        echo '</br></br><div class="alert alert-danger alert-dismissible">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<h5><i class="icon fa fa-danger"></i> ¡Aviso!</h5>
Contraseña o Usuario Incorrecto
</div>';
                    }
                }
            } else {
                echo '</br></br><div class="alert alert-danger alert-dismissible">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<h5><i class="icon fa fa-danger"></i> ¡Aviso!</h5>
Contraseña o Usuario Incorrecto
</div>';
            }
        }
    }

    /* =============================================
      REGISTRO DE USUARIO
      ============================================= */

    static public function ctrCrearUsuario($perfil, $tipoUsuario) {

        if ($perfil == 'externo' && $tipoUsuario == 'cliente') {
            if (isset($_POST["nuevoUsuario"])) {

                if (preg_match('/^[0-9]+$/', $_POST["nuevoUsuario"]) &&
                        preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevaContraseña"])) {

                    if ($_FILES['nuevaFoto']['name'] == null) {

                        $ruta = "";
                    } else {
                        $ruta = "";
                        if (isset($_FILES["nuevaFoto"]["tmp_name"])) {
                            list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);
                            $nuevoAncho = 500;
                            $nuevoAlto = 500;
                            /* =============================================
                              CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
                              ============================================= */
                            $directorio = "vistas/img/usuarios/" . $_POST["nuevoUsuario"];
                            mkdir($directorio, 0755);
                            /* =============================================
                              DEACUERDO AL TIPO DE IMAGEN APLICAMOS POR DEFECTO PHP
                              ============================================= */
                            if ($_FILES["nuevaFoto"]["type"] == "image/png") {
                                /* =============================================
                                  GUARDAR LA IMAGEN EN EL DIRECTORIO
                                  ============================================= */
                                $aleatorio = mt_rand(100, 999);
                                $ruta = "vistas/img/usuarios/" . $_POST["nuevoUsuario"] . "/" . $aleatorio . ".jpg";
                                $origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);
                                $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                                imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                                imagepng($destino, $ruta);
                            } else if ($_FILES["nuevaFoto"]["type"] == "image/jpeg") {
                                /* =============================================
                                  GUARDAR LA IMAGEN EN EL DIRECTORIO
                                  ============================================= */
                                $aleatorio = mt_rand(100, 999);

                                $ruta = "vistas/img/usuarios/" . $_POST["nuevoUsuario"] . "/" . $aleatorio . ".jpg";
                                $origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);
                                $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                                imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                                imagejpeg($destino, $ruta);
                            } else {
                                echo '<script>

swal({
type: "error",
title: "Formato de fotografia",
text: "El formato de fotografia no se acepta utilice extension, jpeg o  png",
showConfirmButton: true,
confrimButtonText: "Aceptar",
closeConfirm: true
 });
                    </script>';
                                return false;
                            }
                        }
                    }

                    $tabla = "USUARIOCLIENTES";
                    $encriptar = crypt($_POST["nuevaContraseña"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
                    $correo = md5($_POST["Email"]);
                    $datos = array(
                        "nombres" => $_POST["nuevoNombre"],
                        "apellidos" => $_POST["nuevoApellido"],
                        "usuarios" => $_POST["nuevoUsuario"],
                        "contra" => $encriptar,
                        "dpi" => $_POST["dpi"],
                        "telefono" => $_POST["telefono"],
                        "email" => $_POST["Email"],
                        "email1" => $correo,
                        "pregunta" => md5($_POST["preguntaSecreta"]),
                        "respuesta" => md5($_POST["respuestaSecreta"]),
                        "razonSocial" => $_POST["razonSocial"],
                        "nombreComercial" => $_POST["nombreComercial"],
                        "direccionFiscal" => $_POST["direccionFiscal"],
                        "direccionDeRecibos" => $_POST["direccionDeRecibos"],
                        "numeroNit" => $_POST["hiddenNitEspecial"],
                        "contacto" => $_POST["contacto"],
                        "foto" => $ruta,
                        "estado" => 0,
                        "ultimoLogin" => "2019/03/01",
                        "fecha_creacion" => "2019/03/01",
                        "estadoTarifa" => 0,
                        "ejecutivoVentas" => $_REQUEST['ejecutivoVentas'],
                        "intentos" => 0,
                        "tarifa" => 0,
                        "idNit" => $_REQUEST['nitTarifaEspecial']);

                    $respuesta = ModeloUsuarios::mdlclienteUser($tabla, $datos);
                    if ($respuesta = "ok") {
                        echo '<script>
                    swal({
type: "success",
title: "USUARIO CREADO",
text: "El usuario ha sido creado satisfactoriamente",
showConfirmButton: true,
confrimButtonText: "Aceptar",
closeConfirm: true
 });
                    </script>';
                    }
                }
            }
        }
        if ($perfil == 'interno' && $tipoUsuario == 'empleado') {

            if (isset($_POST["nuevoUsuario"])) {

                if (preg_match('/^[0-9]+$/', $_POST["nuevoUsuario"]) &&
                        preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevaContraseña"])) {

                    if ($_FILES['nuevaFoto']['name'] == null) {

                        $ruta = "";
                    } else {


                        $ruta = "";

                        if (isset($_FILES["nuevaFoto"]["tmp_name"])) {


                            list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);

                            $nuevoAncho = 500;
                            $nuevoAlto = 500;

                            /* =============================================
                              CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
                              ============================================= */

                            $directorio = "vistas/img/usuarios/" . $_POST["nuevoUsuario"];
                            mkdir($directorio, 0755);
                            /* =============================================
                              DEACUERDO AL TIPO DE IMAGEN APLICAMOS POR DEFECTO PHP
                              ============================================= */

                            if ($_FILES["nuevaFoto"]["type"] == "image/png") {
                                /* =============================================
                                  GUARDAR LA IMAGEN EN EL DIRECTORIO
                                  ============================================= */
                                $aleatorio = mt_rand(100, 999);
                                $ruta = "vistas/img/usuarios/" . $_POST["nuevoUsuario"] . "/" . $aleatorio . ".jpg";
                                $origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);
                                $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                                imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                                imagepng($destino, $ruta);
                            } else if ($_FILES["nuevaFoto"]["type"] == "image/jpeg") {
                                /* =============================================
                                  GUARDAR LA IMAGEN EN EL DIRECTORIO
                                  ============================================= */
                                $aleatorio = mt_rand(100, 999);

                                $ruta = "vistas/img/usuarios/" . $_POST["nuevoUsuario"] . "/" . $aleatorio . ".jpg";
                                $origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);
                                $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                                imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                                imagejpeg($destino, $ruta);
                            } else {
                                echo '<script>

swal({
type: "error",
title: "Formato de fotografia",
text: "El formato de fotografia no se acepta utilice extension, jpeg o  png",
showConfirmButton: true,
confrimButtonText: "Aceptar",
closeConfirm: true
 });
                    </script>';
                                return false;
                            }
                        }
                    }

                    date_default_timezone_set('America/Guatemala');
                    $date = date('Y-m-d');
                    $tabla = "personal";
                    $encriptar = crypt($_POST["nuevaContraseña"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
                    $correo = md5($_POST["Email"]);
                    $datos = array("nombres" => $_POST["nuevoNombre"],
                        "apellidos" => $_POST["nuevoApellido"],
                        "usuarios" => $_POST["nuevoUsuario"],
                        "contra" => $encriptar,
                        "dpi" => $_POST["dpi"],
                        "nivel" => $_POST["nivelUsuario"],
                        "departamento" => $_POST["departamento"],
                        "dependencia" => $_POST["dependencia"],
                        "telefono" => $_POST["telefono"],
                        "pregunta" => md5($_POST["preguntaSecreta"]),
                        "respuesta" => md5($_POST["respuestaSecreta"]),
                        "email" => $_POST["Email"],
                        "email1" => $correo,
                        "foto" => $ruta,
                        "estado" => ['0'],
                        "fecha_creacion" => $date,
                        "intentos" => ['0'],);

                    $respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);


                    if ($respuesta = "ok") {
                        echo '<script>
                    swal({
type: "success",
title: "USUARIO CREADO",
text: "El usuario ha sido creado satisfactoriamente",
showConfirmButton: true,
confrimButtonText: "Aceptar",
closeConfirm: true
 });
                    </script>';
                    }
                }
            }
        }
    }

    /* =============================================
      MOSTRAR USUARIO
      ============================================= */

    static public function ctrMostrarUsuarios($item, $valor, $perfil) {

        if ($perfil == 'internos') {
            $tabla = "personal";
            $respuesta = ModeloUsuarios::MdlMostrarUsuariosGestor($perfil);
            $linea = 0;
            if ($_SESSION["niveles"] == "ADMINISTRADOR") {
                foreach ($respuesta as $key => $value) {
                    $linea = $linea + 1;
                    if ($value["estado"] == 0) {
                        $bottonera = '<button type="button" class="btn btn-danger btn-xs btnActivar" idUsuario="' . $value["id"] . '"estadoUsuario="1">Desactivado</button>';
                    } else {
                        $bottonera = '<button type="button" class="btn btn-success btn-xs btnActivar" idUsuario="' . $value["id"] . '"estadoUsuario="0">Activado</button>';
                    }
                    if ($value["foto"] != "") {
                        $foto = '<img src="' . $value["foto"] . '" class="img-thumbnail" width="40px">';
                    } else {
                        $foto = '<img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width="40px">';
                    }

                    echo '<tr>
                                <td>' . $linea . '</td>
                                <td>' . $value["usuarios"] . '</td>
                                <td>' . $value["nombres"] . '</td>
                                <td>' . $value["apellidos"] . '</td>
                                <td>' . $value["funcion"] . '</td>
                                <td>' . $value["nivel"] . '</td>
                                <td>' . $foto . '</td>

                    <td>' . $bottonera . '</td> ';
                }
                echo '
                                </tr>';
            } else {
                foreach ($respuesta as $key => $value) {
                    $linea = $linea + 1;
                    if ($value["foto"] != "") {
                        $foto = '<img src="' . $value["foto"] . '" class="img-thumbnail" width="40px">';
                    } else {
                        $foto = '<img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width="40px">';
                    }
                    if ($value["estado"] == 0) {
                        $bottonera = '<span class="right badge badge-danger">Inactivo</span>';
                    } else {
                        $bottonera = '<span class="right badge badge-success">Activo</span>';
                    }
                    echo '<tr>
                            <td>' . $linea . '</td>
                            <td>' . $value["nombres"] . '</td>
                            <td>' . $value["apellidos"] . '</td>
                            <td>' . $value["funcion"] . '</td>
                            <td>' . $value["email"] . '</td>
                            <td>' . $foto . '</td>
                            <td>' . $bottonera . '</td>

</tr>';
                }
            }
        } else if ($perfil == 'externo') {

            $tabla = "USUARIOSEXTERNOS";

            $respuesta = ModeloUsuariosExternos::MdlMostrarUsuariosExternos($tabla, $item, $valor);

            return $respuesta;
        }
    }

    /*

     */

    public static function ctrmostrarClientes() {
        $respuesta = ModeloUsuariosExternos::mdlmostrarClientes();
        $contador = 0;
        foreach ($respuesta as $key => $value) {
            $contador = $contador + 1;
            if ($value["fotoCliente"] != "") {
                $foto = '<img src="' . $value["fotoCliente"] . '"class="img-thumbnail" width="40px">';
            } else {
                $foto = '<img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width="40px">';
            }

            if ($value["estadoCliente"] != 0) {
                $button = '<button type="button" class="btn btn-success btn-sm btnActivar" idUsuario="' . $value["id"] . '"estadoUsuario="0">Activado</button>';
            } else {
                $button = '<button type="button" class="btn btn-danger btn-sm btnActivar" idUsuario="' . $value["id"] . '"estadoUsuario="1">Desactivado</button>';
            }

            echo '<tr>
                    <td>' . $contador . '</td>
                   <td style="width: 5%;">' . $value["nit"] . '</td>
                   <td style="width: 25%;">' . $value["nomEmpresa"] . '</td>
                   <td style="width: 20%;">' . $value["correo"] . '</td>  
                   <td style="width: 5%;">' . $value["telCliente"] . '</td>  
                   <td style="width: 10%;">' . $value["contactoClietne"] . '</td>    
                   <td ststyle="width: 20%;">' . $foto . '</td>   
                   <td style="width: 18%;">' . $value["ejecutivoNombre"] . ' ' . $value["ejecutivoApellido"] . '</td>   
                   <td style="width: 10%;"><center>' . $button . '</center></td>  
';

            echo


            '</tr>';
        }
    }

    static public function ctrEditarUsuario() {

        if (isset($_POST["editarUsuario"])) {

            if ($_POST["editarTelefono"] == $_POST["telefonoActual"] &&
                    $_POST["editarEmail"] == $_POST["emailActual"]) {
                echo '<script>
swal({
type: "error",
title: "SIN CAMBIOS",
text: " No se detecto ningun cambio",
showConfirmButton: true,
confrimButtonText: "Aceptar",
closeConfirm: true
 });
</script>';
            } else if (preg_match('/^[0-9]+$/', ($_POST["editarTelefono"]) &&
                            preg_match('/^[a-zA-Z0-9@._]+$/', $_POST["editarEmail"]))) {

                $item = "usuarios";
                $datos = array("telefono" => $_POST["editarTelefono"], "correo" => $_POST["editarEmail"], "usuarioid" => $_SESSION["usuario"]);
                $tabla = "personal";
                $respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $item, $datos);
                if ($respuesta == "ok") {
                    $_SESSION["telefono"] = $datos["telefono"];
                    $_SESSION["email"] = $datos["correo"];

                    echo '<script>
swal({ title: "MODIFICACION CORRECTA",
text: "La modificacion de su telefono y correo se remplazaron",
type: "success"}).then(okay => {
    if (okay) {
    window.location = "miperfil";
    }
});
          </script>';
                } else {
                    
                }
            } else {
                
            }
        }
    }

    static public function ctrEditarclave() {

        if (isset($_POST["passwordAcutal"])) {
            $encriptar1 = $_POST["passwordAcutal"];

            $encriptar = crypt($_POST["ActualContra"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
            if ($encriptar1 == $encriptar) {


                if ($_POST["nuevacontra"] == "" &&
                        $_POST["confirmapassword"] == "") {
                    echo '<script>

swal({
type: "error",
title: "ERROR DE CONTRASEÑA",
text: "No ingreso ninguno de los campos solicitados",
showConfirmButton: true,
confrimButtonText: "Aceptar",
closeConfirm: true
 });
                    </script>';
                } else if ($_POST["nuevacontra"] != "" &&
                        $_POST["confirmapassword"] != "") {

                    if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevacontra"]) &&
                            preg_match('/^[a-zA-Z0-9]+$/', $_POST["confirmapassword"])) {

                        if ($_POST["nuevacontra"] == $_POST["confirmapassword"]) {

                            $nuevoDato = crypt($_POST["nuevacontra"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
                            $encriptarAnterior = crypt($_POST["passwordAcutal"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
                            $tabla = "personal";
                            $colum = "contra";
                            $item = "usuarios";
                            $datos = array("nuevoDato" => $nuevoDato, "encriptarAnterior" => $encriptarAnterior, "usuario" => $_SESSION["usuario"]);
                            $respuesta = ModeloUsuarios::mdlRestablecer($nuevoDato, $_SESSION["usuario"]);
                            var_dump($respuesta);
                            if ($respuesta == "ok") {
                                echo '<script>
swal({
type: "success",
title: "CONTRASEÑA MODIFICADA",
text: "Su contraseña fue modificada",
showConfirmButton: true,
confrimButtonText: "Aceptar",
closeConfirm: true
 });
</script>';
                            } else {
                                echo "incco";
                            }
                        } else {
                            echo '<script />';
                        }
                    } else {
                        echo '<script>
swal({
type: "error",
title: "Caracteres no acepatados",
text: "Su contraseña fue modificada",
showConfirmButton: true,
confrimButtonText: "Aceptar",
closeConfirm: true
 });
</script>';
                    }
                }
            } else {

                echo '<script>
swal({
type: "error",
title: "SU CONTRASEÑA NO COINCIDE",
text: "Las contraseña digitada actual no es correcta"' . $encriptar1 . ',
showConfirmButton: true,
confrimButtonText: "Aceptar",
closeConfirm: true
 });
</script>';
            }
        }
    }

    static public function ctrCambiarFoto() {
        if (isset($_POST["fotoActual"])) {

            $editarFoto = $_FILES["editarFoto"];
            if ($_FILES['editarFoto']['name'] != null) {
                $ruta = $_POST["fotoActual"];
                if (isset($_FILES["editarFoto"]["tmp_name"])) {
                    list($ancho, $alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]);
                    $nuevoAncho = 500;
                    $nuevoAlto = 500;
                    /* =============================================
                      CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
                      ============================================= */

                    $directorio = "vistas/img/usuarios/" . $_SESSION["usuario"];

                    if (!empty($_POST["fotoActual"])) {
                        unlink($_POST["fotoActual"]);
                    } else {

                        mkdir($directorio, 0755);
                    }
                    /* =============================================
                      DEACUERDO AL TIPO DE IMAGEN APLICAMOS POR DEFECTO PHP
                      ============================================= */

                    if ($_FILES["editarFoto"]["type"] == "image/png") {
                        /* =============================================
                          GUARDAR LA IMAGEN EN EL DIRECTORIO
                          ============================================= */
                        $aleatorio = mt_rand(100, 999);
                        $ruta = "vistas/img/usuarios/" . $_SESSION["usuario"] . "/" . $aleatorio . ".jpg";
                        $origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);
                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                        imagepng($destino, $ruta);
                    } else if ($_FILES["editarFoto"]["type"] == "image/jpeg") {
                        /* =============================================
                          GUARDAR LA IMAGEN EN EL DIRECTORIO
                          ============================================= */
                        $aleatorio = mt_rand(100, 999);

                        $ruta = "vistas/img/usuarios/" . $_SESSION["usuario"] . "/" . $aleatorio . ".jpg";
                        $origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);
                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                        imagejpeg($destino, $ruta);
                    } else {
                        echo '<script>

swal({
type: "error",
title: "Formato de fotografia",
text: "El formato de fotografia no se acepta utilice extension, jpeg o  png",
showConfirmButton: true,
confrimButtonText: "Aceptar",
closeConfirm: true
 });
                    </script>';
                        return false;
                    }
                }

                $tabla = "personal";
                $colum = "foto";
                $item = "usuarios";
                $datos = array("nuevoDato" => $ruta, "usuario" => $_SESSION["usuario"]);
                $respuesta = ModeloUsuarios::mdlEditarContraFoto($tabla, $item, $datos, $colum);

                if ($respuesta = "ok") {
                    $_SESSION["foto"] = $datos["nuevoDato"];
                    echo '<script>
    window.location = "miperfil";
          </script>';
                } else {
                    echo '<script>

swal({
type: "error",
title: "Error - 01",
text: "Contacte al soporte tecnico",
showConfirmButton: true,
confrimButtonText: "Aceptar",
closeConfirm: true
 });
                    </script>';
                }
            } else {

                echo '<script>
                    swal({
type: "error",
title: "FOTOGRAFIA NO ACTUALIZADA",
text: "No cargo ninguna fotografia",
showConfirmButton: true,
confrimButtonText: "Aceptar",
closeConfirm: true
 });
                    </script>';
            }
        }
    }

    public static function ctrRecuperar() {

        if (isset($_POST["recuperaUsuario"])) {
            if (preg_match('/^[0-9]+$/', $_POST["recuperaUsuario"])) {

                $imailIngresado = md5($_POST["email"]);

                $preguntasIng = md5($_POST["preguntaSecreta"]);

                $respuesaIng = md5($_POST["respuestaSecreta"]);

                $valor = $_POST["recuperaUsuario"];
                $tabla = "personal";
                $item = "usuarios";
                $respuesta = ModeloUsuarios::mdlRecuperaPass($valor, $tabla, $item);

                if ($respuesta["usuario"] == $_POST["recuperaUsuario"] && $respuesta["emailEncriptado"] == $imailIngresado && $respuesta["preguntas"] == $preguntasIng && $respuesta["respuestas"] == $respuesaIng) {

                    function generarPassword($longitud) {

                        $key = "";

                        $pathern = "1234567890abcdefghijklmnopqrstuvwxyz";
                        $max = strlen($pathern) - 1;

                        for ($i = 0; $i < $longitud; $i++) {
                            $key .= $pathern{mt_rand(0, $max)};
                        }
                        return $key;
                    }

                    $nuevaContraseña = generarPassword(11);
                    $encriptar = crypt($nuevaContraseña, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
                    $tabla = "personal";
                    $colum = "contra";
                    $item = "usuarios";
                    $datos = array("nuevoDato" => $encriptar, "encriptarAnterior" => $respuesta["contra"], "usuario" => $_POST["recuperaUsuario"]);
                    $respuesta = ModeloUsuarios::mdlEditarContraFoto($tabla, $item, $datos, $colum);

                    /* =============================================
                      VERIFICACIÓN CORREO ELECTRÓNICO
                      ============================================= */

                    date_default_timezone_get("America/Guatemala");

                    $url = Ruta::ctrRuta();
                    $mail = new PHPMailer();
                    $mail->CharSet = 'UTF-8';
                    $mail->isMail();
                    $mail->setFrom('agomezc6@miumg.edu.gt', 'Almacenadora Integrada, S.A.');
                    $mail->addReplyTo('agomezc6@miumg.edu.gt', 'Almacenadora Integrada, S.A.');
                    $mail->Subject = "Solicitud Nueva contraseña";
                    $mail->addAddress($_POST["email"]);
                    $mail->msgHTML('

                    <div style="width:100
                    <center>
                    <img style="padding:20px; width:10%" src="http://tutorialesatualcance.com/tienda/logo.png">
                    </center>
                    <div style="position:relative; margin:auto; width:600px; background:white; padding:20px">
                    <center>
                    <img style="padding:20px; width:15%" src="http://tutorialesatualcance.com/tienda/icon-pass.png">
                    <h3 style="font-weight:100; color:#999">SOLICITUD DE NUEVA CONTRASEÑA</h3>
                    <hr style="border:1px solid #ccc; width:80%">
                    <h4 style="font-weight:100; color:#999; padding:0 20px"><strong>Su nueva contraseña: </strong>' . $nuevaContraseña . '</h4>
                    <a href="' . $url . '" target="_blank" style="text-decoration:none">
                    <div style="line-height:60px; background:#0aa; width:60%; color:white">Ingrese nuevamente al sitio</div>
                    </a>
                    <br>
                    <hr style="border:1px solid #ccc; width:80%">
                    <h5 style="font-weight:100; color:#999">Si no se inscribió en esta cuenta, puede ignorar este correo electrónico y la cuenta se eliminará.</h5>
                    </center>
                    </div>
                    </div>
                            ');

                    $envio = $mail->send();

                    if (!$envio) {
                        echo '<script>
swal({
type: "error",
title: "ERROR DE ENVIO",
text: "Error al enviar el correo comuniquese al telefono de su proveedor",
showConfirmButton: true,
confrimButtonText: "Aceptar",
closeConfirm: true
 });
                    </script>';
                    } else {
                        echo '<script>
swal({
type: "success",
title: "Envio de correo",
text: "Revisa tu correo electronico en la bandeja de entrada o spam adjunto se encuentra tu codigo para recuperacion de contraseña",
showConfirmButton: true,
confrimButtonText: "Aceptar",
closeConfirm: true
 });
</script>';
                    }
                } else {
                    echo '<script>
swal({
type: "error",
title: "DATOS INVALIDOS",
text: "Los datos enviados no son correctos, intente de nuevo.",
showConfirmButton: true,
confrimButtonText: "Aceptar",
closeConfirm: true
 });
</script>';
                }
            }
        }
    }

    public static function ctrMostrarNit($idNitEspecial) {
        $respuesta = ModeloUsuariosExternos::mdlMostrarNit($idNitEspecial);
        return $respuesta;
    }

    public static function ctrMostrarUsuariosTerceros($tipoTercero, $bodega) {
        $respuesta = ModeloUsuarios::mdlMostrarUsuariosTerceros($tipoTercero, $bodega);
        foreach ($respuesta as $key => $value) {
            echo '<option value=' . $value['indentyPersona'] . '>' . $value["nombres"] . ' ' . $value['apellidos'] . '</option>';
        }
    }

    public static function ctrNivelDeUsuario() {
        $respuestas = ModeloUsuarios::mdlNivelDeUsuario();
        echo '<option selected="true" disabled="disabled">Seleccione Nivel Usuario</option>';
        foreach ($respuestas as $key => $value) {
            echo ' <option value=' . $value["identNivel"] . '>' . $value["nvlUser"] . '</option>';
        }
    }

    public static function ctrDepartamentos() {
        $respuestas = ModeloUsuarios::mdlDepartamentos();
        echo '<option selected="true" disabled="disabled">Seleccione Departamento</option>';
        foreach ($respuestas as $key => $value) {
            echo ' <option value=' . $value["identDep"] . '>' . $value["dep"] . '</option>';
        }
    }

    public static function ctrEstadoCliente($activarIdCliente, $activarUsuarioCliente) {
        $respuesta = ModeloUsuarios::mdlEstadoCliente($activarIdCliente, $activarUsuarioCliente);
        return $respuesta;
    }

    public static function ctrVerUsuarioEdicion($idUsuario) {
        $respuesta = ModeloUsuarios::mdlVerUsuarioEdicion($idUsuario);
        return $respuesta;
    }

    public static function ctrColaborador($colabora, $tipoRestaura) {

        if ($tipoRestaura) {
            $encriptar = crypt($colabora, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
            $respuesta = ModeloUsuarios::mdlRestablecer($encriptar, $colabora);
            return $respuesta;
        }
    }

}
