<?php

namespace App\Providers;

use App\Services\CategoriesService;
use Illuminate\Support\ServiceProvider;

class CategoriesServiceProvider extends ServiceProvider
{

    protected $defer = true;

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(CategoriesService::class, function ($app) {
            return new CategoriesService();
        });
    }


    public function provides()
    {
        return ['\App\Services\CategoriesService'];
    }

}
