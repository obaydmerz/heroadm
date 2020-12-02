<?php

use App\Notifications\LittleADM\LittleADM as AdminNtf;
use App\LittleADM\Tools\CrudRoute;
use App\LittleADM\Mbuilder;

Route::group(['prefix' => LaravelLocalization::setLocale(),
'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'ladAdmin']
], function()
{
    foreach (Mbuilder::where("type", "crud")->get() as $item) {
        new CrudRoute($item->val);
    }
});   