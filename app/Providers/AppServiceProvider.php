<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;

class AppServiceProvider extends ServiceProvider
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
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Validator::extend('check_end_date', function ($attribute, $value, $parameters) {
            return $value > $parameters[0];
        });

        Validator::extend('check_phone', function ($attribute, $value, $parameters) {
            $pattern = '/^([+][9][1]|[9][1]|[0]){0,1}([7-9]{1})([0-9]{9})$/';
            return preg_match($pattern, $value);
        });

        Validator::extend('check_vehicle', function ($attribute, $value, $parameters) {
            $pattern = '/^[A-Z]{2}[ -][0-9]{1,2}(?: [A-Z])?(?: [A-Z]*)? [0-9]{4}$/';
            return preg_match($pattern, $value);
        });

        Validator::extend('check_digits', function ($attribute, $value, $parameters) {
            $pattern = '/^\d{10}$/';
            return preg_match($pattern, $value);
        });
    }
}
