<?php

namespace App\Providers;

use App\AWS\awsDemo;
use Illuminate\Support\ServiceProvider;

class AWS extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('demo', function () {
            return new awsDemo();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
