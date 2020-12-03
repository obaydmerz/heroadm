<?php
namespace OMerz\HeroADM\Tools;
use Illuminate\Support\Facades\Route;

class CrudRoute {
    protected $namer;
    protected $namecontr;
    public function __construct($name = "", $controller = null, $noprefix = false)
    {
        $this->namer = $name;
        $namecontr = $controller == null ? ucfirst($this->namer) . 'Controller' : $controller;
        $this->namecontr = $namecontr;
        $arrayable = [];

        if($noprefix == false){
            $arrayable['prefix'] = 'heroadm';
        }

        Route::group($arrayable, function () {
            Route::group(['prefix' => $this->namer], function () {
                Route::get('/', $this->namecontr . '@index')->name($this->namer . '.index');
                Route::get('/create', $this->namecontr . '@create')->name($this->namer . '.create');
                Route::post('/store', $this->namecontr . '@store')->name($this->namer . '.store');
                Route::post('/truncate', $this->namecontr . '@truncate')->name($this->namer . '.truncate');
                Route::get('/relation', $this->namecontr . '@relation')->name($this->namer . '.relation');
                Route::get('/relationmany', $this->namecontr . '@relationmany')->name($this->namer . '.relationmany');
                Route::get('/{id}/edit', $this->namecontr . '@edit')->name($this->namer . '.update');
                Route::post('/{id}/update', $this->namecontr . '@update')->name($this->namer . '.edit');
                Route::post('/{id}/destroy', $this->namecontr . '@destroy')->name($this->namer . '.delete');
            });
        });
    }
}
