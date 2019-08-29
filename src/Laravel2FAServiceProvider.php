<?php

namespace SunAsterisk\Laravel2FA;

use Illuminate\Support\ServiceProvider;

class Laravel2FAServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-2fa');
        $this->loadRoutesFrom(__DIR__.'/Http/routes.php');
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'laravel-2fa');

        $this->publishes([
           __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'migrations');

        $this->publishes([
            __DIR__.'/../config/config.php' => config_path('laravel-2fa.php'),
        ], 'config');

        $this->publishes([
            __DIR__.'/../resources/views' => $this->app->resourcePath('views/vendor/laravel-2fa'),
        ], 'views');
    }
}
