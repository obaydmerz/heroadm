<?php

use App\Notifications\LittleADM\LittleADM as AdminNtf;

Route::group(['prefix' => LaravelLocalization::setLocale(),
'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function()
{
    Route::group(['prefix' => 'littleadm'], function () {
        // Not Admin
    });

    Route::group(['prefix' => 'littleadm', 'middleware' => ['ladAdmin']], function () {
        // Admin
    });
});