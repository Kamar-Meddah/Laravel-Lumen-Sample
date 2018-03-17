<?php

namespace App\Providers;

use App\Services\CommentsService;
use Illuminate\Support\ServiceProvider;

class CommentsServiceProvider extends ServiceProvider
{

    protected $defer = true;

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(\App\Services\CommentsService::class, function ($app) {
            return new CommentsService();
        });
    }


    public function provides()
    {
        return ['\App\Services\CommentsService'];
    }

}
