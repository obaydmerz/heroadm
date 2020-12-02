<?php

namespace App\LittleADM;


class Permi
{
    public $permis;
    public $name;

    public function __construct($name, array $permis){
        $this->name = $name;
        $this->permis = $permis;
    }

    public static function allowin($pername, $roles, $roler){
        $perms = array();
        foreach ($roles as $role) {
            if($role->name == $roler && $role->allow($pername)){
                $perms[] = in_array($pername, $role->permis) ? $pername : "";
            }
        }

        return in_array($pername, $perms);
    }

    public static function deniesin($pername, $roles, $roler){
        $perms = array();
        foreach ($roles as $role) {
            if($role->name == $roler && $role->allow($pername)){
                $perms[] = in_array($pername, $role->permis) ? $pername : "";
            }
        }

        return !in_array($pername, $perms);
    }

    public static function abort($pername, $roles, $roler){
        $result = static::deniesin($pername, $roles, $roler);
        if($result){
            abort(403, 'Unauthorized');
        }
    }

    public function allow($pername){
        return in_array($pername, $this->permis);
    }

    public function denies($pername){
        return !in_array($pername, $this->permis);
    }

    public function allowat($pername, $roles, $roler){
        $perms = array();
        foreach ($roles as $role) {
            if($role->name == $roler && $role->allow($pername)){
                $perms[] = in_array($pername, $role->permis) ? $pername : "";
            }
        }

        return in_array($pername, $perms);
    }

    public function deniesat($pername, $roles, $roler){
        $perms = array();
        foreach ($roles as $role) {
            if($role->name == $roler && $role->allow($pername)){
                $perms[] = in_array($pername, $role->permis) ? $pername : "";
            }
        }

        return !in_array($pername, $perms);
    }
}
