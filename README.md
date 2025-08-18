# AdminAuth Laravel Package

[![Latest Version](https://img.shields.io/packagist/v/saadmughal/admin-auth.svg)](https://packagist.org/packages/saadmughal/admin-auth)
[![License](https://img.shields.io/packagist/l/saadmughal/admin-auth.svg)](https://packagist.org/packages/saadmughal/admin-auth)
[![PHP Version](https://img.shields.io/packagist/php-v/saadmughal/admin-auth.svg)](https://www.php.net/)

Admin authentication package for Laravel with Firebase notifications. Provides login, registration, password reset, email verification, and Firebase notifications for admins.

## Installation & Setup

Install the package via Composer:

```bash
composer require saadmughal/admin-auth
```

Publish the package config and views:
```bash
php artisan vendor:publish --tag=adminauth-config
php artisan vendor:publish --tag=adminauth-views
```

Run migrations:
```bash
php artisan migrate
```

Set your Firebase JSON path in `.env` :
```bash
ADMIN_FIREBASE_JSON=/full/path/to/firebase_project.json
```

Add admin guard and provider in `config/auth.php`:
```bash
'guards' => [
    'admin' => [
        'driver' => 'session',
        'provider' => 'admins',
    ],
],
'providers' => [
    'admins' => [
        'driver' => 'eloquent',
        'model' => Mughal\AdminAuth\Models\Admin::class,
    ],
],
```

## Firebase Notifications
To send Firebase notifications to admins:
```bash
use Mughal\AdminAuth\Models\Admin;

$admin = Admin::first();
$data = [
    'title' => 'New Alert',
    'body' => 'You have a new notification!',
    'description' => 'Notification details',
    'type' => 'info'
];
$message = "Check your dashboard";

$admin->sendNotification($admin->id, $data, $message);
```

# Quick Start
```bash
laravel new myproject
cd myproject
composer require mughal/admin-auth
php artisan vendor:publish --tag=adminauth-config
php artisan vendor:publish --tag=adminauth-views
php artisan migrate
```

Set Firebase JSON path in .env as above and visit in your browser:
```bash
http://localhost:8000/admin/login
http://localhost:8000/admin/register
```
