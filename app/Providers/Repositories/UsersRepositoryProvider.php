<?php

namespace App\Providers\Repositories;

use App\Repositories\Repositories\Sql\UsersRepository;
use Illuminate\Support\ServiceProvider;

class UsersRepositoryProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('App\Repositories\Interfaces\Repositories\UsersRepoInterface', function ($app) {
            return new UsersRepository();
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
