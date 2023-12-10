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

        // LineRepository
        $this->app->bind(
            \App\Repositorys\LineRepositoryInterface::class,
            \App\Repositorys\LineRepository::class
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