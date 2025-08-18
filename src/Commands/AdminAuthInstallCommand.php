<?php

namespace Mughal\AdminAuth\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class AdminAuthInstallCommand extends Command
{
    protected $signature = 'adminauth:install';
    protected $description = 'Install AdminAuth package: publish views, migrations, routes';

    public function handle()
    {
        // Copy views
        $this->info('Publishing views...');
        $source = __DIR__ . '/../resources/views';
        $destination = resource_path('views/vendor/adminauth');
        $this->laravel['files']->copyDirectory($source, $destination);

        // Copy migrations
        $this->info('Publishing migrations...');
        $sourceMigrations = __DIR__ . '/../database/migrations';
        $destinationMigrations = database_path('migrations');
        $this->laravel['files']->copyDirectory($sourceMigrations, $destinationMigrations);

        // Copy routes
        $this->info('Publishing routes...');
        $sourceRoutes = __DIR__ . '/../routes/admin.php';
        $destinationRoutes = base_path('routes/admin.php');
        copy($sourceRoutes, $destinationRoutes);

        $this->info('AdminAuth installed successfully!');
    }
}
