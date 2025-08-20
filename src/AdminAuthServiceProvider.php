<?php

namespace Mughal\AdminAuth;

use Illuminate\Support\ServiceProvider;

class AdminAuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Load routes automatically
        $this->loadRoutesFrom(__DIR__.'/routes/admin.php');

        // Load views automatically
        $this->loadViewsFrom(__DIR__.'/views', 'adminauth');

        // Load migrations automatically
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        // Merge package config automatically
        $this->mergeConfigFrom(__DIR__.'/config/adminauth.php', 'adminauth');

        $this->publishes([
            __DIR__.'/config/adminauth.php' => config_path('adminauth.php'),
        ], 'config');
    }

    public function register()
    {
        $this->commands([
            \Mughal\AdminAuth\Commands\AdminAuthInstallCommand::class,
        ]);
    }
}
