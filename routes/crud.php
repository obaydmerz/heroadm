<?php

use OMerz\HeroADM\Mbuilder;
use OMerz\HeroADM\Tools\CrudRoute;
use OMerz\HeroADM\Classes\Wheres\WhereMbuilder;
use OMerz\HeroADM\Notifications\LittleADM as AdminNtf;

Route::group(['prefix' => LaravelLocalization::setLocale(),
'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'heroAdmin']
], function()
{
    foreach (WhereMbuilder::wherecrud() as $item) {
        new CrudRoute($item->val);
    }
});   