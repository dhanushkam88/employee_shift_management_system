<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Shift\ShiftManageRepository;
use App\Repositories\Shift\ShiftManageRepositoryInterface;
use App\Repositories\Calander\CalanderRepository;
use App\Repositories\Calander\CalanderRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );
        $this->app->bind(
            ShiftManageRepositoryInterface::class,
            ShiftManageRepository::class
        );
        $this->app->bind(
            CalanderRepositoryInterface::class,
            CalanderRepository::class
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
