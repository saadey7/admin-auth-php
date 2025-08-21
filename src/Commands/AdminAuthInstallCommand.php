<?php

namespace Mughal\AdminAuth\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Filesystem\Filesystem;

class AdminAuthInstallCommand extends Command
{
    protected $signature = 'adminauth:install';
    protected $description = 'Install AdminAuth package: publish views, migrations, routes, config, and setup guard';

    public function handle()
    {
        $fs = new Filesystem();

        // 1. Copy views
        $this->info('📂 Publishing views...');
        $source = __DIR__ . '/../resources/views';
        $destination = resource_path('views/vendor/adminauth');
        $fs->copyDirectory($source, $destination);

        // 2. Copy migrations
        $this->info('📂 Publishing migrations...');
        $sourceMigrations = __DIR__ . '/../database/migrations';
        $destinationMigrations = database_path('migrations');
        $fs->copyDirectory($sourceMigrations, $destinationMigrations);

        // 3. Copy routes
        $this->info('📂 Publishing routes...');
        $sourceRoutes = __DIR__ . '/../routes/admin.php';
        $destinationRoutes = base_path('routes/admin.php');
        copy($sourceRoutes, $destinationRoutes);

        // 4. Publish config
        $this->info('⚙️ Publishing config...');
        $this->callSilent('vendor:publish', [
            '--provider' => "Mughal\AdminAuth\AdminAuthServiceProvider",
            '--tag' => "config"
        ]);

        // 5. Update auth.php with admin guard
        $this->info('⚙️ Updating config/auth.php...');
        $authPath = config_path('auth.php');
        $authContent = $fs->get($authPath);

        if (!str_contains($authContent, "'admin' => [")) {
            $authContent = str_replace(
                "'guards' => [",
                "'guards' => [\n\n        'admin' => [\n            'driver' => 'session',\n            'provider' => 'admins',\n        ],",
                $authContent
            );

            $authContent = str_replace(
                "'providers' => [",
                "'providers' => [\n\n        'admins' => [\n            'driver' => 'eloquent',\n            'model' => App\\Models\\Admin::class,\n        ],",
                $authContent
            );

            $fs->put($authPath, $authContent);
            $this->info('✅ Admin guard added to config/auth.php');
        } else {
            $this->warn('⚠️ Admin guard already exists, skipped.');
        }

        // 6. Create Admin model if not exists
        $this->info('⚙️ Checking Admin model...');
        $adminModel = app_path('Models/Admin.php');
        if (!$fs->exists($adminModel)) {
            $fs->ensureDirectoryExists(app_path('Models'));
            $fs->put($adminModel, <<<PHP
<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected \$guard = 'admin';

    protected \$fillable = [
        'name',
        'email',
        'password',
    ];

    protected \$hidden = [
        'password',
        'remember_token',
    ];
}
PHP);
            $this->info('✅ Admin model created: app/Models/Admin.php');
        } else {
            $this->warn('⚠️ Admin model already exists, skipped.');
        }

        // 7. Run migrations
        $this->info('📂 Running migrations...');
        Artisan::call('migrate');

        $this->info('🎉 AdminAuth installed successfully!');
    }
}
