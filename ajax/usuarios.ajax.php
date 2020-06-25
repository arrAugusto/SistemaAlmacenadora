<?php

require_once "../controlador/usuario.controlador.php";
require_once "../modelo/usuariosCliente.modelo.php";
require_once "../modelo/usuarios.modelo.php";

class AjaxUsuarios {
    /* =============================================
      EDITAR USUARIO
      ============================================= */

    public $idUsuario;

    public function ajaxEditarUsuario() {

        $item = "id";
        $valor = $this->idUsuario;
        $perfil = "internos";
        $respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor, $perfil);
        echo json_encode($respuesta);
    }

    /* =============================================
      MOSTRAR NOMBRE Y DATOS DEL CLIENTE
      ============================================= */

    public $idNit;

    public function ajaxMostrarDatosCliente() {

        $item = "id";
        $valor = $this->idNit;
        $perfil = "externo";

        $respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor, $perfil);
        echo json_encode($respuesta);
    }

    /* =============================================
      ACTIVAR USUARIO
      ============================================= */

    public $activarUsuario;
    public $activarId;

    public function ajaxActivarUsuario() {

        $tabla = "personal";
        $colum = "estado";
        $item = "id";
        $valor1 = $this->activarUsuario;
        $valor2 = $this->activarId;
        $datos = array("nuevoDato" => $valor1, "usuario" => $valor2);

        $respuesta = ModeloUsuarios::mdlEditarContraFoto($tabla, $item, $datos, $colum);
        echo json_encode($respuesta);
    }

    public $mostrarUsuario;

    public function ajaxMostrarEjecutivo() {
        $valor = $this->mostrarUsuario;
        echo json_encode($valor);
    }

    public $mostrarNit;

    public function AjaxMostrarNit() {
        $idNitEspecial = $this->idNitEspecial;
        $respuesta = ControladorUsuarios::ctrMostrarNit($idNitEspecial);
        echo json_encode($respuesta);
    }

    public $estadoCliente;

    public function ajaxEstadoCliente() {
        $activarIdCliente = $this->activarIdCliente;
        $activarUsuarioCliente = $this->activarUsuarioCliente;
        $respuesta = ControladorUsuarios::ctrEstadoCliente($activarIdCliente, $activarUsuarioCliente);
        echo json_encode($respuesta);
        
    }

}

/* =============================================
  EDITAR USUARIO
  ============================================= */
if (isset($_POST["idUsuario"])) {

    $editar = new AjaxUsuarios();
    $editar->idUsuario = $_POST["idUsuario"];
    $editar->ajaxEditarUsuario();
}

/* =============================================
  ACTIVAR USUARIO
  ============================================= */
if (isset($_POST["activarUsuario"])) {

    $activarUsuario = new AjaxUsuarios();
    $activarUsuario->activarId = $_POST["activarId"];
    $activarUsuario->activarUsuario = $_POST["activarUsuario"];
    $activarUsuario->ajaxActivarUsuario();
}

/* =============================================
  SI EXISTE IDNIT, EJECUTA METODOS
  ============================================= */
if (isset($_POST["idNit"])) {

    $idNit = new AjaxUsuarios();
    $idNit->idNit = $_POST["idNit"];
    $idNit->ajaxMostrarDatosCliente();
}


if (isset($_POST["ejecutivoDeVentas"])) {
    $mostrarUsuario = new AjaxUsuarios();
    $mostrarUsuario->mostrarUsuario = $_POST["ejecutivoDeVentas"];
    $mostrarUsuario->ajaxMostrarEjecutivo();
}



if (isset($_POST["idNitEspecial"])) {
    $mostrarNit = new AjaxUsuarios();
    $mostrarNit->idNitEspecial = $_POST["idNitEspecial"];
    $mostrarNit->AjaxMostrarNit();
}

if (isset($_POST["activarIdCliente"])) {
    $estadoCliente = new AjaxUsuarios();
    $estadoCliente->activarIdCliente = $_POST["activarIdCliente"];
    $estadoCliente->activarUsuarioCliente = $_POST["activarUsuarioCliente"];
    $estadoCliente->ajaxEstadoCliente();
}