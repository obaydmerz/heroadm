<?php
namespace OMerz\HeroADM\Tools\CrudDefiner;

class Validator {
    public static function make($columns){
        $validator = array();
        
        foreach ($columns as $col) {
            if($vali = $col->validator != ""){
                $validator[$col->name] = $col->validator . ($col->required == true ? '|required' : '') . ($col->unique ? '|unique:' . $col->unique : '');
            }else{
                if($col->required == true) $validator[$col->name] = 'required';
                if($col->unique) $validator[$col->name] = ($col->required == true ? '|' : '') . 'unique:' . $col->unique;
            }
        }

        return $validator;
    }

    public static function makeOnUpdate($columns, $req, $model){
        $validator = array();
            
        foreach ($columns as $col) {
            if($vali = $col->validator != ""){
                $validator[$col->name] = $col->validator . ($col->required == true ? '|required' : '') . ($col->unique && $req[$col->name] != $model[$col->name] ? '|unique:' . $col->unique : '');
            }else{
                if($col->required == true) $validator[$col->name] = 'required';
                if($col->unique && $req[$col->name] != $model[$col->name]) $validator[$col->name] = ($col->required == true ? '|' : '') . 'unique:' . $col->unique;
            }
        }

        return $validator;
    }
}
