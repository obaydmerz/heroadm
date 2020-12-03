<?php
namespace App\LittleADM\Tools\Locale;

class LocaleTrt {
    public static function support($lang, $string, $base = ""){
        $result = array();
        $result1 = explode('|', $base);
        foreach ($result1 as $data) {
            $dt = explode(':', $data);
            $result[$dt[0]] = $dt[1];
        }
        $result[$lang] = $string;
        $result2 = "";
        foreach ($result as $key => $data) {
            if($result == "") $result = $key . ':' . $data;
            else $result = $result . '|' . $key . ':' . $data;
        }
        return $result2;
    }

    public static function unSupport($lang, $base = ""){
        $result = array();
        $result1 = explode('|', $base);
        foreach ($result1 as $data) {
            $dt = explode(':', $data);
            if($dt[0] != $lang) $result[$dt[0]] = $dt[1];
        }  
        $result2 = "";
        foreach ($result as $key => $data) {
            if($result == "") $result = $key . ':' . $data;
            else $result = $result . '|' . $key . ':' . $data;
        }
        return $result2;
    }

    public static function isSupport($lang, $string = ""){
        $result = false;
        $result1 = explode('|', $base);
        foreach ($result1 as $data) {
            $dt = explode(':', $data);
            if($dt[0] == $lang) $result = true;
        }  
        return $result;
    }

    public static function isUnSupport($lang, $string = ""){
        $result = false;
        $result1 = explode('|', $base);
        foreach ($result1 as $data) {
            $dt = explode(':', $data);
            if($dt[0] == $lang) $result = true;
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

    public static function isTrans($string){
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

    public static function getTrad(array $datas, $lang, $def = "No Supported Lang"){
        $result = $def;
        foreach ($datas as $key => $value) {
            if($key == $lang) $result = $value;
        }
        return $result;
    }

    public static function getTradCompressed($string, $lang, $def = "No Supported Lang"){
        $result = $def;
        $result1 = explode('|', $string);
        foreach ($result1 as $data) {
            $dt = explode(':', $data);
            if($dt[0] == $lang) $result = $dt[1];
        }
        return $result;
    }
}
