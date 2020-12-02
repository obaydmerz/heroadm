<?php

namespace App;
use App\LittleADM\Permi;
use App\LittleADM\Tools\Contracts\CRUDPermi;


class Permissions
{
    public $perms = [];

    public function __construct(){
        $this->perms[] = new Permi("admin", CRUDPermi::toSingleArray(array(
            //       DEFAULTS        TRUE   TRUE   TRUE    TRUE
            //                      CREATE  READ  UPDATE  DELETE
            CRUDPermi::make('users', true , true,  true,   true ),
            CRUDPermi::make('mbuilders'),
        )));
    }
}
