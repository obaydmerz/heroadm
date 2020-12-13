<?php

namespace OMerz\HeroADM\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class HEROROUTEServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\Http\Controllers';
    protected $namespacehero = 'OMerz\Http\Controllers';
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    public function map()
    {
        $this->mapHeroADMWebRoutes();
        $this->mapHeroADMCustomRoutes();
        $this->mapHeroADMCrudRoutes();
    }


    protected function mapHeroADMWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespacehero)
            ->name('heroadm.')
            ->group(base_path('src/Routes/web.php'));
        Route::middleware('web')
            ->namespace($this->namespace)
            ->name('heroadm.crud.')
            ->group(base_path('app/Routes/crud.php'));
    }

    protected function mapHeroADMCustomRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->name('heroadm.')
            ->group(base_path('routes/heroadm/custom.php'));
    }

    protected function mapHeroADMCrudRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->name('heroadm.crud.')
            ->group(base_path('routes/heroadm/crud.php'));
    }
}