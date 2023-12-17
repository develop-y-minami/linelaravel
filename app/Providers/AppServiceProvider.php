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
        // LineApiService
        $this->app->bind(
            \App\Services\Apis\LineApiServiceInterface::class,
            function ($app) {
                return new \App\Services\Apis\LineApiService(
                    $app->make(\App\Repositorys\LineNoticeSettingRepositoryInterface::class),
                    $app->make(\App\Repositorys\LineRepositoryInterface::class)
                );
            },
        );

        // LineMessagingApiService
        $this->app->bind(
            \App\Services\Apis\LineMessagingApiServiceInterface::class,
            function ($app) {
                return new \App\Services\Apis\LineMessagingApiService(config('line.message_channel_access_token'));
            },
        );

        // LineNoticeApiService
        $this->app->bind(
            \App\Services\Apis\LineNoticeApiServiceInterface::class,
            function ($app) {
                return new \App\Services\Apis\LineNoticeApiService($app->make(\App\Repositorys\LineNoticeRepositoryInterface::class));
            },
        );

        // LineWebhookService
        $this->app->bind(
            \App\Services\Apis\LineWebhookServiceInterface::class,
            function ($app) {
                return new \App\Services\Apis\LineWebhookService(
                    config('line.message_channel_access_token'),
                    $app->make(\App\Repositorys\LineMessageImageRepositoryInterface::class),
                    $app->make(\App\Repositorys\LineMessageRepositoryInterface::class),
                    $app->make(\App\Repositorys\LineMessageTextRepositoryInterface::class),
                    $app->make(\App\Repositorys\LineNoticeRepositoryInterface::class),
                    $app->make(\App\Repositorys\LineNoticeTypeRepositoryInterface::class),
                    $app->make(\App\Repositorys\LineRepositoryInterface::class)
                );
            },
        );

        // LineAccountStatusService
        $this->app->bind(
            \App\Services\Webs\LineAccountStatusServiceInterface::class,
            function ($app) {
                return new \App\Services\Webs\LineAccountStatusService($app->make(\App\Repositorys\LineAccountStatusRepositoryInterface::class));
            },
        );

        // LineNoticeTypeService
        $this->app->bind(
            \App\Services\Webs\LineNoticeTypeServiceInterface::class,
            function ($app) {
                return new \App\Services\Webs\LineNoticeTypeService(
                    $app->make(\App\Repositorys\LineNoticeSettingRepositoryInterface::class),
                    $app->make(\App\Repositorys\LineNoticeTypeRepositoryInterface::class)
                );
            },
        );

        // LineService
        $this->app->bind(
            \App\Services\Webs\LineServiceInterface::class,
            function ($app) {
                return new \App\Services\Webs\LineService($app->make(\App\Repositorys\LineRepositoryInterface::class));
            },
        );

        // UserService
        $this->app->bind(
            \App\Services\Webs\UserServiceInterface::class,
            function ($app) {
                return new \App\Services\Webs\UserService($app->make(\App\Repositorys\UserRepositoryInterface::class));
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
