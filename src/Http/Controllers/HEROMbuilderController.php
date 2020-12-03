<?php

namespace OMerz\HeroADM\Http\Controllers;

use OMerz\HeroADM\Tools\Crud;
use OMerz\HeroADM\Tools\CrudDefiner\Column;
use Illuminate\Support\Facades\Route;
use OMerz\HeroADM\Tools\Locale\LocaleTrt;
use OMerz\HeroADM\Permi;
use OMerz\HeroADM\HEROConfig;
use OMerz\HeroADM\Mbuilder;
use App\Permissions;
use OMerz\HeroADM\Mbulider;
use Illuminate\Http\Request;
use OMerz\HeroADM\Http\Controllers\HEROCrudController as BaseController;


class HEROMbuilderController extends BaseController
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
