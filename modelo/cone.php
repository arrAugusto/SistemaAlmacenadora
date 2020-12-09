<?php

class Conexion {

    public function Conectar() {
//$serverName = 'LAPTOP-JT8VBSF1\SQLEXPRESS';
$serverName = 'WKAIDESAR01\SQLEXPRESS';
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
