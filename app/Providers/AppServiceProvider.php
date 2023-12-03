<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //LineService
        $this->app->bind(
            \App\Services\LineServiceInterface::class,
            function ($app) {
                return new \App\Services\LineService(config('line.message_channel_access_token'));
            },
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
