<?php

//use OMerz\HeroADM\Mbuilder;
//use OMerz\HeroADM\Tools\CrudRoute;
use OMerz\HeroADM\Classes\Wheres\WhereMbuilder;
use OMerz\HeroADM\Notifications\LittleADM as AdminNtf;

Route::get('/{model}', 'HEROCRUDRouterController@index')->name("index");
Route::get('/{model}/create', 'HEROCRUDRouterController@create')->name("create");
Route::post('/{model}/store', 'HEROCRUDRouterController@store')->name("store");
Route::post('/{model}/truncate', 'HEROCRUDRouterController@truncate');
Route::get('/{model}/relation', 'HEROCRUDRouterController@relation')->name("relation");
Route::get('/{model}/relationmany', 'HEROCRUDRouterController@relationmany')->name("relationmany");
Route::get('/{model}/{id}/edit', 'HEROCRUDRouterController@edit')->name("edit");
Route::post('/{model}/{id}/update', 'HEROCRUDRouterController@update')->name("update");
Route::post('/{model}/{id}/destroy', 'HEROCRUDRouterController@destroy')->name("destroy");