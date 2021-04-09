<?php

// Crud
Route::get('/crud/getvalues/{model}', 'HEROAPIController@getValuesFromModel')->name('crud.getvalues');  
Route::get('/crud/destroy/{model}', 'HEROAPIController@destroyFromModel')->name('crud.destroy');  
