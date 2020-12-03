<?php


use App\LittleADM\Mbuilder;
use App\LittleADM\Tools\CrudRoute;
use OMerz\HeroADM\Notifications\HeroADM as AdminNtf;


Route::group(['prefix' => LaravelLocalization::setLocale(),
	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function()
{

    Route::get('/heroadm/login', 'HEROLoginController@loginv')->name('login');
    Route::post('/heroadm/login/post', 'HEROLoginController@login')->name('login.post');
    Route::get('/heroadm/install', 'HEROAdminController@install')->name('install');

    Route::group(['prefix' => 'heroadm', 'middleware' => ['heroAdmin']], function () {
        Route::get('/', 'HEROAdminController@index')->name('dashboard');  
        // Crud

        Route::group(['as' => 'crud.'], function(){
            new CrudRoute('users', 'HEROUserController', true);
        });

        // Auth
        Route::get('/logout', 'HEROLoginController@logout')->name('logout');

        // Media

        Route::get('/media/new', 'HEROAdminController@newmediasv')->name('media.new');
        //Route::post('/media/newfile', 'HEROAdminController@newmedias')->name('media.newfile');
        Route::get('/media/upload', 'HEROAdminController@storemediasv')->name('media.upload');
        Route::post('/media/uploadfile', 'HEROAdminController@storemedias')->name('media.uploadfile');
        Route::post('/media/editup', 'HEROAdminController@editmedias')->name('media.upfile');
        Route::get('/media/{pathto?}', 'HEROAdminController@medias')->name('media');

        // Configs

        Route::get('/configs', 'HEROAdminController@configs')->name('configs');
        Route::post('/configs/save', 'HEROAdminController@saveConfigs')->name('configs.save');
        Route::post('/configs/default', 'HEROAdminController@defaultConfigs')->name('configs.default');

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