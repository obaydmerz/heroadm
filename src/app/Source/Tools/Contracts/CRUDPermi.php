<?php
namespace App\LittleADM\Tools\Contracts;

class CRUDPermi {
    public static function make($name, $create = true, $read = true, $update = true, $delete = true){
        $result = array();
        if($create){
            $result[] = $name . "_create";
        }
        if($read){
            $result[] = $name . "_read";
        }
        if($update){
            $result[] = $name . "_update";
        }
        if($delete){
            $result[] = $name . "_delete";
        }
        return $result;
    }
    
    public static function toSingleArray(array $arrays){
        $result = array();
        foreach($arrays as $array){
            foreach ($array as $value) {
                $result[] = $value;
            }
        }
        return $result;
    }
}
