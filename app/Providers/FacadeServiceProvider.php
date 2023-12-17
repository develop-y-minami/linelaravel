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
        $this->app->bind('ArrayFacade', 'App\Facades\ArrayFacade');
        $this->app->bind('StringFacade', 'App\Facades\StringFacade');
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