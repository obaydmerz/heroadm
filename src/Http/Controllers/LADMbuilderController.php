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
use App\LittleADM\Mbulider;
use Illuminate\Http\Request;
use App\LittleADM\Http\Controllers\LADCrudController as BaseController;


class LADMbuilderController extends BaseController
{
    protected $class;
    protected $name = "mbuilders";
    protected $rolesallowed = array();

    public function constructcolumns(){
        $crud = new Crud;

        $crud->register([
            new Column("name", "fr:Nom|ar:الإسم", "string", false, ['trans' => ['langs' => ['ar', 'fr'], 'def' => 'No Supported Lang']], true),
            new Column("type", "fr:Type|ar:النوع", "enum", true, ['values' => ['dynamic', 'crud', 'url']], true),
            new Column("icon", "fr:Icon|ar:الأيقونة", "string", true, [], true, "", ""),
            new Column("permi", "fr:Roles|ar:الصلاحيات", "string", true, [], true, ''),
            new Column("val", "fr:Valeur|ar:الإجابة", "string", true, [], true),
        ]);

        $this->columns = $crud->get();
    }

    public function construct($auth){
        $per = new Permissions();
        $this->rolesallowed = $per->perms;
        $this->class = new Mbuilder;
    }
}
