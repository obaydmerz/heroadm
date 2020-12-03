<?php
namespace OMerz\HeroADM\Tools;

class ObjectComp {
    public static function support($variable, $value, $base = ""){
        $result = array();
        $result1 = explode('|', $base);
        foreach ($result1 as $data) {
            $dt = explode(':', $data);
            $result[$dt[0]] = $dt[1];
        }
        $result[$variable] = $value;
        $result2 = "";
        foreach ($result as $key => $data) {
            if($result == "") $result = $key . ':' . $data;
            else $result = $result . '|' . $key . ':' . $data;
        }
        return $result2;
    }

    public static function unSupport($variable, $base = ""){
        $result = array();
        $result1 = explode('|', $base);
        foreach ($result1 as $data) {
            $dt = explode(':', $data);
            if($dt[0] != $variable) $result[$dt[0]] = $dt[1];
        }  
        $result2 = "";
        foreach ($result as $key => $data) {
            if($result == "") $result = $key . ':' . $data;
            else $result = $result . '|' . $key . ':' . $data;
        }
        return $result2;
    }

    public static function isSupport($variable, $string = ""){
        $result = false;
        $result1 = explode('|', $base);
        foreach ($result1 as $data) {
            $dt = explode(':', $data);
            if($dt[0] == $variable) $result = true;
        }  
        return $result;
    }

    public static function isUnSupport($variable, $string = ""){
        $result = false;
        $result1 = explode('|', $base);
        foreach ($result1 as $data) {
            $dt = explode(':', $data);
            if($dt[0] == $variable) $result = true;
        }  
        return !$result;
    }


    public static function compress(array $datas){
        $result = "";
        foreach ($datas as $key => $data) {
            if($result == "") $result = $key . ':' . $data;
            else $result = $result . '|' . $key . ':' . $data;
        }
        return $result;
    }

    public static function isObjcomp($string){
        $restr = true;
        try {
            $result = array();
            $result1 = explode('|', $string);
            foreach ($result1 as $data) {
                $dt = explode(':', $data);
                if(!(isset($dt[0]) && isset($dt[1]))){
                    $restr = false;
                }
            }
        } catch (Throwable $th) {
            $restr = false;
        }
        return $restr;
    }

    public static function extract($string){
        $result = array();
        $result1 = explode('|', $string);
        foreach ($result1 as $data) {
            $dt = explode(':', $data);
            $result[$dt[0]] = $dt[1];
        }
        return $result;
    }

    public static function getVariable(array $datas, $var, $def = false){
        $result = $def;
        foreach ($datas as $key => $value) {
            if($key == $var) $result = $value;
        }
        return $result;
    }

    public static function getKeys(array $datas){
        $result = array();
        foreach ($datas as $key => $value) {
            $result[] = $key;
        }
        return $result;
    }

    public static function getVariableInCompressed($string, $lang, $def = false){
        $result = $def;
        $result1 = explode('|', $string);
        foreach ($result1 as $data) {
            $dt = explode(':', $data);
            if($dt[0] == $lang) $result = $dt[1];
        }
        return $result;
    }
}
