<?php

namespace App\Providers\Repositories;

use App\Repositories\Repositories\Sql\AgenciesRepository;
use Illuminate\Support\ServiceProvider;

class AgenciesRepositoryProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('App\Repositories\Interfaces\Repositories\AgenciesRepoInterface', function ($app) {
            return new AgenciesRepository();
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
