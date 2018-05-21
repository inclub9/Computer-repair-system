<?php

namespace App\Providers;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function boot()
    {
            Carbon::setLocale(config('app.locale'));
    }


    public function register()
    {
        //
    }
}
