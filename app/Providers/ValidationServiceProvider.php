<?php

namespace App\Providers;

use App\Rules\Equal;
use App\Rules\Prohibit;
use Illuminate\Support\ServiceProvider;

class ValidationServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $validator = app('validator');

        $validator->extend('prohibit', Prohibit::class);
        $validator->extend('equal', Equal::class);
    }
}
