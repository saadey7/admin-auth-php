<?php

namespace Mughal\AdminAuth;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Configuration\Middleware;

class AdminAuthServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        /**
         * ------------------------------
         * Load package resources
         * ------------------------------
         */
        // Routes
        $this->loadRoutesFrom(__DIR__.'/routes/admin.php');

        // Views
        $this->loadViewsFrom(__DIR__.'/views', 'adminauth');

        // Migrations
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        /**
         * ------------------------------
         * Config
         * ------------------------------
         */
        // Merge default config
        $this->mergeConfigFrom(__DIR__.'/config/adminauth.php', 'adminauth');

        // Allow publishing config (manual publish)
        $this->publishes([
            __DIR__.'/config/adminauth.php' => config_path('adminauth.php'),
        ], 'config');

        /**
         * ------------------------------
         * Middleware
         * ------------------------------
         */
        $this->app->afterResolving(Middleware::class, function (Middleware $middleware) {
            // Redirect guests for admin routes
            $middleware->redirectGuestsTo(function ($request) {
                if ($request->is('admin/*')) {
                    return route('admin.showlogin'); // defined in package routes
                }
                return null; // default Laravel behaviour
            });
        });

        // Alias middleware for reusability
        $this->app['router']->aliasMiddleware(
            'admin.guest',
            \Mughal\AdminAuth\Middleware\RedirectIfAdminAuthenticated::class
        );
    }

    public function register(): void
    {
        // Register custom artisan commands (if any)
        $this->commands([
            \Mughal\AdminAuth\Commands\AdminAuthInstallCommand::class,
        ]);
    }
}
