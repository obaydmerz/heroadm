<?php

namespace OMerz\HeroADM\Http\Controllers;

use App\User;
use App\Permissions;
use OMerz\HeroADM\Modules\Permi;
use Illuminate\Http\Request;
use OMerz\HeroADM\Modules\HEROConfig;
use OMerz\HeroADM\Tools\Crud;
use Illuminate\Support\Facades\Route;
use OMerz\HeroADM\Tools\Locale\LocaleTrt;
use OMerz\HeroADM\Tools\CrudDefiner\Column;
use OMerz\HeroADM\Http\Controllers\HEROCrudController;


class HEROUserController extends HEROCrudController
{
    protected $class;
    protected $name = "users";
    protected $rolesallowed = array();

    public function constructcolumns(){
        $crud = new Crud;

        $crud->register([
            new Column("name", "fr:Nom|en:Name|ar:الإسم", "string", true, [], true),
            new Column("email", "fr:Email|en:Email|ar:البريد الإلكتروني", "email", true, [], true, "", "users"),
            new Column("role", "fr:Role|en:Role|ar:الصلاحية", "enum", true, ["values" => ['admin', 'user']], true, ''),
            new Column("password", "fr:Mot de Passe|en:Password|ar:كلمة السر", "password", false, ['hashing' => true], true, null),
        ]);

        $this->columns = $crud->get();
    }

    public function construct($auth){
        $per = new Permissions();
        $this->rolesallowed = $per->perms;
        $this->class = new User;
    }
}
