<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('within_week', function($attribute, $value, $parameters, $validator) {
            if( Carbon::createFromFormat('Y-m-d H:i', $value) <= Carbon::now() ) {
                return false;
            }

            if( Carbon::createFromFormat('Y-m-d H:i', $value) >= Carbon::now()->addWeek() ) {
                return false;
            }
            return true;
        });

        Validator::extend('time', function($attribute, $value, $parameters, $validator) {
            if( Carbon::createFromFormat('Y-m-d H:i', $value) < Carbon::createFromFormat('Y-m-d H:i', $value)->setTime(7, 0, 0) ) {
                return false;
            }

            if( Carbon::createFromFormat('Y-m-d H:i', $value) > Carbon::createFromFormat('Y-m-d H:i', $value)->setTime(17, 0, 0) ) {
                return false;
            }
            return true;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
