<?php

namespace App\Providers;

use App\Models\Porn;
use Illuminate\Support\ServiceProvider;
use Validator;

class ValidateServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('porn_lose', function($attribute, $value, $parameters, $validator) {
            return Porn::where('code', $value)->where('use_id', null)->where('expire_at', '>', time())->first() ? true : false;
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
