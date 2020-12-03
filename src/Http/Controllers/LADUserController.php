<?php

namespace App\LittleADM\Http\Controllers;

use App\LittleADM\Tools\Crud;
use App\LittleADM\Tools\CrudDefiner\Column;
use Illuminate\Support\Facades\Route;
use App\LittleADM\Tools\Locale\LocaleTrt;
use App\LittleADM\Permi;
use App\LittleADM\LADConfig;
use App\LittleADM\Mbuilder;
use App\Permissions;
use App\User;
use Illuminate\Http\Request;
use App\LittleADM\Http\Controllers\LADCrudController as BaseController;


class LADUserController extends BaseController
{
    protected $class;
    protected $name = "users";
    protected $rolesallowed = array();

    public function constructcolumns(){
        $crud = new Crud;

        $crud->register([
            new Column("name", "fr:Nom|ar:الإسم", "string", true, [], true),
            new Column("email", "fr:Email|ar:البريد الإلكتروني", "email", true, [], true, "", "users"),
            new Column("role", "fr:Role|ar:الصلاحية", "enum", true, ["values" => ['admin', 'user']], true, ''),
            new Column("password", "fr:Mot de Passe|ar:كلمة السر", "password", false, ['hashing' => true], true, null),
        ]);

        $this->columns = $crud->get();
    }

    public function construct($auth){
        $per = new Permissions();
        $this->rolesallowed = $per->perms;
        $this->class = new User;
    }
}
