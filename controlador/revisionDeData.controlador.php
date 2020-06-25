<?php

class revisionData {

    public static function datoEntero($numeroEntero) {
        if (preg_match('/^[1-9][0-9]*$/', $numeroEntero)) {
            return true;
        } else if (preg_match('/^[0-9]*$/', $numeroEntero)) {
            return 0;
        } else {
            return false;
        }
    }

    public static function datoFlotante($numeroFlotante) {
        if (is_numeric($numeroFlotante)) {
            if ($numeroFlotante > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    public static function datoString($datoString){

        if (is_string($datoString)) {
            return true;
        }else{
            return false;
        }
    }

}
