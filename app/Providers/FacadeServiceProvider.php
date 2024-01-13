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
        $this->app->bind('ArrayFacade', 'App\Facades\ArrayFacade');
        $this->app->bind('FileFacade', 'App\Facades\FileFacade');
        $this->app->bind('StringFacade', 'App\Facades\StringFacade');
        $this->app->bind('ViewFacade', 'App\Facades\ViewFacade');
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