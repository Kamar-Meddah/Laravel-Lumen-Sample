<?php

namespace App\Providers;

use App\Models\User;
use App\Services\AuthService;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(AuthService::class, function ($app) {
            return new AuthService();
        });
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {

        $this->app['auth']->viaRequest('api', function ($request) {
            return $this->check($request);
        });

    }

    private function check(Request $request)
    {
        if ($request->header('Authorization')) {
            try {
                $us = JWT::decode($request->header('Authorization'), env('APP_KEY'), ['HS256']);
                return User::all()->where('token', '=', $request->header('Authorization'))->first();
            } catch (\Exception $e) {
                return null;
            }
        };
        return null;
    }

}
