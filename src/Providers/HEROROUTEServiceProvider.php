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
            ->prefix('/heroadm')
            ->group(base_path('routes/web.php'));
    }

    protected function mapHeroADMCrudRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespacehero)
            ->name('heroadm.crud.')
            ->prefix('/heroadm/crud')
            ->group(base_path('routes/crud.php'));
    }

    protected function mapHeroADMAPIRoutes()
    {
        Route::middleware('api')
            ->namespace($this->namespacehero)
            ->name('heroadm.api.')
            ->prefix('/heroadm/api')
            ->group(base_path('routes/api.php'));
    }
}