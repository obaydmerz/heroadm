<?php

namespace App\Http\Controllers\LittleADM;

use App\LittleADM\Tools\Crud;
use App\LittleADM\Tools\CrudDefiner\Column;
use App\LittleADM\Tools\Locale\LocaleTrt;
use App\LittleADM\Permi;
use App\Permissions;
use App\User;
use Illuminate\Http\Request;
use App\LittleADM\Http\Controllers\LADCrudController as BaseController;


class PostsController extends BaseController
{
    protected $class;
    protected $name = "posts"; // Name 
    protected $rolesallowed = array();

    public function constructcolumns(){
        $crud = new Crud; // Instance for Crud

        $crud->register([
            // Your Columns Ex:
            //          Name         Display Name          Type   Required   Datas     Default      Validator   Unique
            new Column('name', 'en:Name|fr:Nom|ar:الإسم', "string", false , [      ], "         ", "          ",  true  ),
        ]);

        $this->columns = $crud->get(); // Getting Columns
    }

    public function construct(){
        $per = new Permissions();
        $this->rolesallowed = $per->perms;
        $this->class = new Post; // Your Model
    }
}
