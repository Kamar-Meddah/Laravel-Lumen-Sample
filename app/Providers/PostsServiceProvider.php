<?php

namespace App\Providers;


use App\Services\PostsService;
use Illuminate\Support\ServiceProvider;

class PostsServiceProvider extends ServiceProvider
{

    protected $defer = true;

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(PostsService::class, function ($app) {
            return new PostsService();
        });
    }


    public function provides()
    {
        return ['\App\Services\PostsService'];
    }

}
