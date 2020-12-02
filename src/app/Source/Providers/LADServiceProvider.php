<?php

namespace App\LittleADM\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class LADServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\Http\Controllers';
    protected $namespaceldm = 'App\LittleADM\Http\Controllers';
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
        $this->mapLittleADMWebRoutes();
        $this->mapLittleADMCustomRoutes();
        $this->mapLittleADMCrudRoutes();
    }


    protected function mapLittleADMWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespaceldm)
            ->name('littleadm.')
            ->group(base_path('app/LittleADM/Routes/web.php'));
        Route::middleware('web')
            ->namespace($this->namespace)
            ->name('littleadm.crud.')
            ->group(base_path('app/LittleADM/Routes/crud.php'));
    }

    protected function mapLittleADMCustomRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->name('littleadm.')
            ->group(base_path('routes/littleadm/custom.php'));
    }

    protected function mapLittleADMCrudRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->name('littleadm.crud.')
            ->group(base_path('routes/littleadm/crud.php'));
    }
}