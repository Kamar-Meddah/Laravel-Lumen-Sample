<?php

namespace App\Providers;

use App\Services\UsersService;
use Illuminate\Support\ServiceProvider;

class UsersServiceProvider extends ServiceProvider
{

    protected $defer = true;

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(UsersService::class, function ($app) {
            return new UsersService();
        });
    }


    public function provides()
    {
        return ['\App\Services\UsersService'];
    }

}
