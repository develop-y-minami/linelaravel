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
        // LineMessagingApiService
        $this->app->bind(
            \App\Services\LineMessagingApiServiceInterface::class,
            function ($app) {
                return new \App\Services\LineMessagingApiService(config('line.message_channel_access_token'));
            },
        );

        // LineNoticeService
        $this->app->bind(
            \App\Services\LineNoticeServiceInterface::class,
            function ($app) {
                return new \App\Services\LineNoticeService($app->make(\App\Repositorys\LineNoticeRepositoryInterface::class));
            },
        );

        // LineNoticeTypeService
        $this->app->bind(
            \App\Services\LineNoticeTypeServiceInterface::class,
            function ($app) {
                return new \App\Services\LineNoticeTypeService($app->make(\App\Repositorys\LineNoticeTypeRepositoryInterface::class));
            },
        );

        // UserService
        $this->app->bind(
            \App\Services\UserServiceInterface::class,
            function ($app) {
                return new \App\Services\UserService($app->make(\App\Repositorys\UserRepositoryInterface::class));
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
