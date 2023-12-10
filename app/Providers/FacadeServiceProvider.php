<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * FacadeServiceProvider
 * 
 */
class FacadeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('AppFacade', 'App\Facades\AppFacade');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}