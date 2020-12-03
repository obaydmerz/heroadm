<?php
namespace OMerz\HeroADM\Classes;

use OMerz\HeroADM\Modules\HEROConfig;

class Installer {
    public static function handle(){
        $configs = new HEROConfig;
        if(!static::getMiddleVerify__FACE($configs)){
            return false;
        }

        $configs->create([
            'name' => 'role_cont_configs',
            'type' => 'input',
            'display_name' => 'Role Controling Configs',
            'desc' => 'Role Controling Configs',
            'val' => 'admin',
            'default_val' => 'admin',
            'que' => 0,
        ]);
        $configs->create([
            'name' => 'role_cont_users',
            'type' => 'input',
            'display_name' => 'Role Controling Users',
            'desc' => 'Role Controling Users',
            'val' => 'admin',
            'default_val' => 'admin',
            'que' => 0,
        ]);
        $configs->create([
            'name' => 'role_cont_medias',
            'type' => 'input',
            'display_name' => 'Role Controlling Medias',
            'desc' => 'Role Controlling Medias',
            'val' => 'admin',
            'default_val' => 'admin',
            'que' => 0,
        ]);
        $configs->create([
            'name' => 'role_cont_mbulider',
            'type' => 'input',
            'display_name' => 'Role Controlling Menu Bulider',
            'desc' => 'Role Controlling Menu Bulider',
            'val' => 'admin',
            'default_val' => 'admin',
            'que' => 0,
        ]);
        $configs->create([
            'name' => 'roles_see_heroadm',
            'type' => 'input',
            'display_name' => 'Roles See Dashboard',
            'desc' => 'Roles See Dashboard',
            'val' => 'admin',
            'default_val' => 'admin',
            'que' => 0,
        ]);

        return true;
    }

    public static function down(){
        $configs = new HEROConfig;
        if(!static::getMiddleVerify__BACK($configs)){
            return false;
        }

        // HERE

        return true;
    }

    public static function getMiddleVerify__FACE($configs){
        if($configs->get('role_cont_configs', 'DEFDEF') != "DEFDEF"){
            return false;
        }
        return true;
    }

    public static function getMiddleVerify__BACK($configs){
        if($configs->get('role_cont_configs', 'DEFDEF') == "DEFDEF"){
            return false;
        }
        return true;
    }
}
