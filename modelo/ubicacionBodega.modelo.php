<?php

require_once "cone.php";

class ModeloUbicacionBodega {

    public static function mdlDibujarMapaDetalles($numeroMapa) {
      $conn = Conexion::Conectar();
      $sql = "EXECUTE spDibMapa ?";
      $params = array(&$numeroMapa);
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

    public static function mdlDibujarUbicaciones($numeroMapa){
      $conn = Conexion::Conectar();
      $sql = "EXECUTE spUbicSld ?";
      $params = array(&$numeroMapa);
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

    public static function mdlMostrarUbUnitaria($datoSearch){
      $conn = Conexion::Conectar();
      $sql = "EXECUTE spMstUnicaUb ?";
      $params = array(&$datoSearch);
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
      }else{
      return sqlsrv_errors();
      }


    }
public static function mdlMostrarDetallesIng($value){

          $conn = Conexion::Conectar();
      $sql = "EXECUTE spDetalleIngreso ?";
      $params = array(&$value);
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
      }else{
      return sqlsrv_errors();
      }

}

public static function mdlMostarUbicaciones($idDetView){
          $conn = Conexion::Conectar();
      $sql = "EXECUTE spUbicaDetalle ?";
      $params = array(&$idDetView);
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
      }else{
      return sqlsrv_errors();
      }
}
}
