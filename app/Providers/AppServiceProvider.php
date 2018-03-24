<?php

namespace App\Providers;

use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Mail\MailServiceProvider;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /*
    protected $defer = true;
    */
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('mailer', function ($app) {
            return $app->loadComponent('mail', MailServiceProvider::class, 'mailer');
        });

        $this->app->alias('mailer', Mailer::class);
    }

    /*
    public function provides()
    {
    }
    */
}
