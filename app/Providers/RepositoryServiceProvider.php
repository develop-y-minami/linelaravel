<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * RepositoryServiceProvider
 * 
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // LineAccountStatusRepository
        $this->app->bind(
            \App\Repositorys\LineAccountStatusRepositoryInterface::class,
            \App\Repositorys\LineAccountStatusRepository::class
        );

        // LineMessageImageRepository
        $this->app->bind(
            \App\Repositorys\LineMessageImageRepositoryInterface::class,
            \App\Repositorys\LineMessageImageRepository::class
        );

        // LineMessageRepository
        $this->app->bind(
            \App\Repositorys\LineMessageRepositoryInterface::class,
            \App\Repositorys\LineMessageRepository::class
        );

        // LineMessageTypeRepository
        $this->app->bind(
            \App\Repositorys\LineMessageTypeRepositoryInterface::class,
            \App\Repositorys\LineMessageTypeRepository::class
        );

        // LineMessageTextRepository
        $this->app->bind(
            \App\Repositorys\LineMessageTextRepositoryInterface::class,
            \App\Repositorys\LineMessageTextRepository::class
        );

        // LineNoticeRepository
        $this->app->bind(
            \App\Repositorys\LineNoticeRepositoryInterface::class,
            \App\Repositorys\LineNoticeRepository::class
        );

        // LineNoticeTypeRepository
        $this->app->bind(
            \App\Repositorys\LineNoticeTypeRepositoryInterface::class,
            \App\Repositorys\LineNoticeTypeRepository::class
        );

        // LineOfUserNoticeSettingRepository
        $this->app->bind(
            \App\Repositorys\LineOfUserNoticeSettingRepositoryInterface::class,
            \App\Repositorys\LineOfUserNoticeSettingRepository::class
        );

        // LineRepository
        $this->app->bind(
            \App\Repositorys\LineRepositoryInterface::class,
            \App\Repositorys\LineRepository::class
        );

        // LineSendMessageRepository
        $this->app->bind(
            \App\Repositorys\LineSendMessageRepositoryInterface::class,
            \App\Repositorys\LineSendMessageRepository::class
        );

        // LineSendMessageTextRepository
        $this->app->bind(
            \App\Repositorys\LineSendMessageTextRepositoryInterface::class,
            \App\Repositorys\LineSendMessageTextRepository::class
        );

        // LineTalkHistoryRepository
        $this->app->bind(
            \App\Repositorys\LineTalkHistoryRepositoryInterface::class,
            \App\Repositorys\LineTalkHistoryRepository::class
        );

        // ServiceProviderRepository
        $this->app->bind(
            \App\Repositorys\ServiceProviderRepositoryInterface::class,
            \App\Repositorys\ServiceProviderRepository::class
        );

        // UserRepository
        $this->app->bind(
            \App\Repositorys\UserRepositoryInterface::class,
            \App\Repositorys\UserRepository::class
        );
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