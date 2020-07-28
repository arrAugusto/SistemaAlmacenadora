<?php

class ControladorEmpresasAlmacenadoras {

    public static function ctrMostrarEmpAlmacenadora() {
        $sp = "spMostrarEmpresas";
        $respuesta = ModeloEmpresasAlmacenadoras::mdlMostrarEmpAlmacenadora($sp);
        if ($respuesta != "SD") {
            $numero = 0;
            foreach ($respuesta as $key => $value) {
                if ($value["estado"] == 1) {
                    $button = '<div class="btn-group btn-group-sm"><button type="button" class="btn btn-outline-warning btnEditarEmpresa" idBtnEdit="' . $value["id"] . '" data-toggle="modal" data-target="#modalEditarEmpresa"><i class="fa fa-edit"></i></button><button type="button" class="btn btn-outline-danger btnCancelEmpresa" idBtnCancel="' . $value["id"] . '"><i class="fa fa-trash"></i></button></div>';
                } else {
                    $button = '<button type="button" class="btn btn-outline-danger btn-sm btnActivaEmpresa" idBtnActiva="' . $value["id"] . '">Activar <i class="fa fa-fighter-jet"></i></button>';
                }
                $numero = $numero + 1;
                //
                echo '
            <tr>
                <td>' . $numero . '</td>
                <td>' . $value["nit"] . '</td>
                <td>' . $value["empresa"] . '</td>
                <td>' . $value["direccion"] . '</td>
                <td>' . $value["telefono"] . '</td>
                <td>' . $value["email"] . '</td>
                <td><img src="' . $value["logo"] . '" class="img-thumbnail" style="width:110px;height:auto;"></td>
                <td>' . $button . '</td>    
            </tr>
            
            ';
            }
        }
    }

    public static function ctrCrearNuevaEmpresa() {
        if (isset($_POST["txtNewNit"])) {
            if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["txtNewNit"])) {

                $ruta = "";
                if (isset($_FILES["nuevoLogo"]["tmp_name"])) {
                    list($ancho, $alto) = getimagesize($_FILES["nuevoLogo"]["tmp_name"]);
                    /**
                     * 
                     * 
                     */
                    if ($ancho > 300 || $alto > 270) {
                        echo '
                <script>                    

    Swal.fire({
    tytle: "Error en logo",
      text: "Las dimensiones maximas aceptadas en acho 270px y en alto 300px",
      allowOutsideClick: false, // prevent close on click anywhere/outside
      type: "error",
      confirmButtonColor: "#3085d6",
      confirmButtonText: "Ok!"
    }).then((result) => {
  if (result.value) {
        window.location = "nuevasEmpresas";
  }
})
        </script>

                    ';
                        return false;
                    }

                    /* =============================================
                      CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
                      ============================================= */
                    $directorio = "vistas/img/empresas/" . $_POST["txtNewNit"];
                    mkdir($directorio, 0755);
                    /* =============================================
                      DEACUERDO AL TIPO DE IMAGEN APLICAMOS POR DEFECTO PHP
                      ============================================= */
                    if ($_FILES["nuevoLogo"]["type"] == "image/png") {
                        /* =============================================
                          GUARDAR LA IMAGEN EN EL DIRECTORIO
                          ============================================= */
                        $aleatorio = mt_rand(100, 999);
                        $ruta = "vistas/img/empresas/" . $_POST["txtNewNit"] . "/" . $aleatorio . ".jpg";
                        $origen = imagecreatefrompng($_FILES["nuevoLogo"]["tmp_name"]);
                        $destino = imagecreatetruecolor($ancho, $alto);
                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $ancho, $alto, $ancho, $alto);
                        imagepng($destino, $ruta);
                    }
                    if ($_FILES["nuevoLogo"]["type"] == "image/jpeg") {
                        /* =============================================
                          GUARDAR LA IMAGEN EN EL DIRECTORIO
                          ============================================= */
                        $aleatorio = mt_rand(100, 999);

                        $ruta = "vistas/img/empresas/" . $_POST["txtNewNit"] . "/" . $aleatorio . ".jpg";
                        $origen = imagecreatefromjpeg($_FILES["nuevoLogo"]["tmp_name"]);
                        $destino = imagecreatetruecolor($ancho, $alto);
                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $ancho, $alto, $ancho, $alto);
                        imagejpeg($destino, $ruta);
                    }
                }

                var_dump($ancho);
                echo '<br/>';
                var_dump($alto);




                $dataNewEmpresa = array(
                    "nitEmpresa" => $_POST["txtNewNit"],
                    "nombreEmpresa" => $_POST["txtNewNombre"],
                    "direEmpresa" => $_POST["txtNewDireccion"],
                    "telefonoEmpresa" => $_POST["txtNewTelefono"],
                    "email" => $_POST["Email"],
                    "rutaFoto" => $ruta
                );
                $respuesta = ModeloEmpresasAlmacenadoras::mdlCrearNuevaEmpresa($dataNewEmpresa);

                if ($respuesta[0]["resp"] != 1) {
                    echo '
            <script>                    
            
Swal.fire({
tytle: "Operación erronea",
  text: "Nueva empresa no se creo!",
  allowOutsideClick: false, // prevent close on click anywhere/outside
  type: "error",
  confirmButtonColor: "#3085d6",
  confirmButtonText: "Ok!"
}).then((result) => {
  if (result.value) {
        window.location = "nuevasEmpresas";
  }
})
        </script>
            
                ';
                }

                if ($respuesta[0]["resp"] == 1) {
                    echo '
   
        <script>                
Swal.fire({
tytle: "Operación exitosa",
  text: "Nueva empresa creada",
  allowOutsideClick: false, // prevent close on click anywhere/outside
  type: "success",
  confirmButtonColor: "#3085d6",
  confirmButtonText: "Ok!"
}).then((result) => {
  if (result.value) {
          window.location = "nuevasEmpresas";
        
  }
})
             </script>       
                ';
                }
            }
        }
    }

    public static function ctrMostrarEmpresa($idEditarEmpresa) {
        $sp = "spMostrarEmpreEdit";
        $respuesta = ModeloEmpresasAlmacenadoras::ctrMostrarEmpresa($sp, $idEditarEmpresa);
        return $respuesta;
    }

    public static function ctrEditarEmpresa() {
        if (isset($_POST["txtNewNitEdit"])) {
            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["txtNewNitEdit"]) && preg_match('/^[,\.\-\-a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["txtNewNombreEdit"]) && preg_match('/^[#\.\,\-a-zA-Z0-9 ]+$/', $_POST["txtNewDireccionEdit"]) && preg_match('/^[()\-\-0-9 ]+$/', $_POST["txtNewTelefonoEdit"]) && preg_match('/^[a-zA-Z0-9]+$/', $_POST["txtNewNitEdit"]) && preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["EmailEdit"])) {

                if ($_FILES['LogoEditar']['name'] == null) {
                    $ruta = $_POST["hiddenFotoActual"];
                } else {
                    $ruta = $_POST["hiddenFotoActual"];


                    if (isset($_FILES["LogoEditar"]["tmp_name"])) {
                        list($ancho, $alto) = getimagesize($_FILES["LogoEditar"]["tmp_name"]);
                        /**
                         * 
                         * 
                         */
                        if ($ancho > 300 || $alto > 270) {
                            echo '
                <script>                    

    Swal.fire({
    tytle: "Error en logo",
    allowOutsideClick: false, // prevent close on click anywhere/outside
      text: "Las dimensiones maximas aceptadas en acho 270px y en alto 300px",
      type: "error",
      confirmButtonColor: "#3085d6",
      confirmButtonText: "Ok!"
    }).then((result) => {
  if (result.value) {
        window.location = "nuevasEmpresas";
  }
})
        </script>

                    ';
                            return false;
                        }

                        /* =============================================
                          CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
                          ============================================= */
                        $directorio = "vistas/img/empresas/" . $_POST["txtNewNitEdit"];

                        if (!empty($_POST["hiddenFotoActual"])) {
                            unlink($_POST["hiddenFotoActual"]);
                        } else {
                            mkdir($directorio, 0755);
                        }

                        /* =============================================
                          DEACUERDO AL TIPO DE IMAGEN APLICAMOS POR DEFECTO PHP
                          ============================================= */
                        if ($_FILES["LogoEditar"]["type"] == "image/png") {
                            /* =============================================
                              GUARDAR LA IMAGEN EN EL DIRECTORIO
                              ============================================= */
                            $aleatorio = mt_rand(100, 999);
                            $ruta = "vistas/img/empresas/" . $_POST["txtNewNitEdit"] . "/" . $aleatorio . ".jpg";
                            $origen = imagecreatefrompng($_FILES["LogoEditar"]["tmp_name"]);
                            $destino = imagecreatetruecolor($ancho, $alto);
                            imagecopyresized($destino, $origen, 0, 0, 0, 0, $ancho, $alto, $ancho, $alto);
                            imagepng($destino, $ruta);
                        }
                        if ($_FILES["LogoEditar"]["type"] == "image/jpeg") {
                            /* =============================================
                              GUARDAR LA IMAGEN EN EL DIRECTORIO
                              ============================================= */
                            $aleatorio = mt_rand(100, 999);

                            $ruta = "vistas/img/empresas/" . $_POST["txtNewNitEdit"] . "/" . $aleatorio . ".jpg";
                            $origen = imagecreatefromjpeg($_FILES["LogoEditar"]["tmp_name"]);
                            $destino = imagecreatetruecolor($ancho, $alto);
                            imagecopyresized($destino, $origen, 0, 0, 0, 0, $ancho, $alto, $ancho, $alto);
                            imagejpeg($destino, $ruta);
                        }
                    }
                }
                /*
                 * DECLARO LAS VARIABLES DEL ARRAY.
                 */
                $dataNewEmpresa = array(
                    "nitEmpresa" => $_POST["txtNewNitEdit"],
                    "nombreEmpresa" => $_POST["txtNewNombreEdit"],
                    "direEmpresa" => $_POST["txtNewDireccionEdit"],
                    "telefonoEmpresa" => $_POST["txtNewTelefonoEdit"],
                    "email" => $_POST["EmailEdit"],
                    "rutaFoto" => $ruta,
                    "hiddenIdEmpresa" => $_POST["hiddenIdEmpresa"]
                );
                $respuesta = ModeloEmpresasAlmacenadoras::mdlEditarNuevaEmpresa($dataNewEmpresa);

                if ($respuesta[0]["resp"] != 1) {
                    echo '
            <script>                    
            
Swal.fire({
tytle: "Edición erronea",
allowOutsideClick: false, // prevent close on click anywhere/outside
  text: "Ocurrio un problema no se edito, intentalo de nuevo!",
  type: "error",
  confirmButtonColor: "#3085d6",
  confirmButtonText: "Ok!"
}).then((result) => {
  if (result.value) {
        window.location = "nuevasEmpresas";
  }
})
        </script>
            
                ';
                }

                if ($respuesta[0]["resp"] == 1) {
                    echo '
   
        <script>                
Swal.fire({
tytle: "Edición exitosa",
allowOutsideClick: false, // prevent close on click anywhere/outside
  text: "Los datos fueron editados correctamente!",
  type: "success",
  confirmButtonColor: "#3085d6",
  confirmButtonText: "Ok!"
}).then((result) => {
  if (result.value) {
          window.location = "nuevasEmpresas";
        
  }
})
             </script>       
                ';
                }
            } else {
                echo '
   
        <script>                
Swal.fire({
tytle: "Edición erronea",
allowOutsideClick: false, // prevent close on click anywhere/outside
  text: "Asegurese que sus modificaciones no contengan caracteres especiales!",
  type: "error",
  confirmButtonColor: "#3085d6",
  confirmButtonText: "Ok!"
}).then((result) => {
  if (result.value) {
          window.location = "nuevasEmpresas";
        
  }
})
             </script>       
                ';
            }
        }
    }

    public static function ctrCancelarEmpresa($cancelarEmpresa) {
        $sp = "spEstadoEmpresa";
        $estado = 0;
        $respuesta = ModeloEmpresasAlmacenadoras::mdlCancelarEmpresa($sp, $estado, $cancelarEmpresa);
        return $respuesta;
    }

    public static function ctrActivarEmpresa($activaEmpresa) {
        $sp = "spEstadoEmpresa";
        $estado = 1;
        $respuesta = ModeloEmpresasAlmacenadoras::mdlCancelarEmpresa($sp, $estado, $activaEmpresa);
        return $respuesta;
    }

}
