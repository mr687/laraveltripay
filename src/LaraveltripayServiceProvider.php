<?php

namespace Mr687\Laraveltripay;

use Illuminate\Support\ServiceProvider;

class LaraveltripayServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('tripay.php'),
            ], 'config');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'tripay');

        // Register the main class to use with the facade
        $this->app->singleton('tripay', function () {
            return new Tripay;
        });
    }
}
