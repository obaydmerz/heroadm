<?php

use App\Notifications\LittleADM\LittleADM as AdminNtf;
use App\LittleADM\Tools\CrudRoute;
use App\LittleADM\Mbuilder;

Route::group(['prefix' => LaravelLocalization::setLocale(),
	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function()
{

    Route::get('/littleadm/login', 'LADLoginController@loginv')->name('login');
    Route::post('/littleadm/login/post', 'LADLoginController@login')->name('login.post');
    Route::get('/littleadm/install', 'LADAdminController@install')->name('install');

    Route::group(['prefix' => 'littleadm', 'middleware' => ['ladAdmin']], function () {
        Route::get('/', 'LADAdminController@index')->name('dashboard');  
        // Crud

        Route::group(['as' => 'crud.'], function(){
            new CrudRoute('users', 'LADUserController', true);
            new CrudRoute('mbuilders', 'LADMbuilderController', true);
        });

        // Auth
        Route::get('/logout', 'LADLoginController@logout')->name('logout');

        // Media

        Route::get('/media/new', 'LADAdminController@newmediasv')->name('media.new');
        //Route::post('/media/newfile', 'LADAdminController@newmedias')->name('media.newfile');
        Route::get('/media/upload', 'LADAdminController@storemediasv')->name('media.upload');
        Route::post('/media/uploadfile', 'LADAdminController@storemedias')->name('media.uploadfile');
        Route::post('/media/editup', 'LADAdminController@editmedias')->name('media.upfile');
        Route::get('/media/{pathto?}', 'LADAdminController@medias')->name('media');

        // Configs

        Route::get('/configs', 'LADAdminController@configs')->name('configs');
        Route::post('/configs/save', 'LADAdminController@saveConfigs')->name('configs.save');
        Route::post('/configs/default', 'LADAdminController@defaultConfigs')->name('configs.default');

        // Notifications

        Route::get('/myNtfs/markasread/{id}', function($id){
            if($ntf = auth()->user()->unreadNotifications->where('id', $id)->first()){
                $ntf->markAsRead();
            }

            return redirect()->back();
        })->name('ntfs.markasread');

        Route::get('/myNtfs/delete/{id}', function($id){
            if($ntf = auth()->user()->readNotifications->where('id', $id)->first()){
                $ntf->delete();
            }

            return redirect()->back();
        })->name('ntfs.delete');

        Route::get('/myNtfs/alldelete', function(){
            auth()->user()->readNotifications()->delete();

            return redirect()->back();
        })->name('ntfs.alldelete');

        Route::get('/myNtfs/allread', function(){
            auth()->user()->unReadNotifications->markAsRead();

            return redirect()->back();
        })->name('ntfs.allread');
    });
});