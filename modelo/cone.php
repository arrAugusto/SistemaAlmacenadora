<?php

class Conexion {

    public function Conectar() {
//$serverName = '127.0.01\SQLSERVER, 1433';
//$serverName = 'LAPTOP-NSSA4NHO\SQLEXPRESS';
$serverName = 'LAPTOP-JT8VBSF1\SQLEXPRESS';
//$serverName = 'WKAIDESAR01\SQLEXPRESS';
//$serverName = '';
        $connectionInfo = array("Database" => "Integrada", "UID" => "logUser", "PWD" => "Contra$2019#", "CharacterSet" => "UTF-8");
        $conn = sqlsrv_connect($serverName, $connectionInfo);
        if ($conn) {
            return $conn;
        } else {
            return false;
        }
    }

}
