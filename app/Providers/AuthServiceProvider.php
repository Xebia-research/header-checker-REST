<?php

namespace App\Providers;

use App\Application;
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
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a Application instance or null. You're free to obtain
        // the Application instance via an API key or any other method necessary.

        $this->app['auth']->viaRequest('api', function ($request) {
            if ($apiKey = $request->bearerToken()) {
                return Application::where('api_key', $apiKey)->first();
            }
        });
    }
}
