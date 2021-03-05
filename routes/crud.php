<?php

use OMerz\HeroADM\Mbuilder;
use OMerz\HeroADM\Tools\CrudRoute;
use OMerz\HeroADM\Classes\Wheres\WhereMbuilder;
use OMerz\HeroADM\Notifications\LittleADM as AdminNtf;

new CrudRoute('users', 'OMerz\HeroADM\Http\Controllers\HEROUserController', true);

foreach (WhereMbuilder::wherecrud() as $item) {
    new CrudRoute($item->val);
}