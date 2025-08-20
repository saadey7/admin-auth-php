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

        $this->app->booted(function () {
            app(\Illuminate\Foundation\Application::class)
                ->useRedirects(function ($redirects) {
                    // Sirf admin guard ke liye
                    $redirects->redirectGuestsUsing(function ($request) {
                        if ($request->is('admin/*')) {
                            return route('admin.showlogin');
                        }
                        return null; // default
                    });
                });
        });

        $this->app['router']->aliasMiddleware(
            'admin.guest',
            \Mughal\AdminAuth\Middleware\RedirectIfAdminAuthenticated::class
        );

    }

    public function register()
    {
        $this->commands([
            \Mughal\AdminAuth\Commands\AdminAuthInstallCommand::class,
        ]);
    }
}
