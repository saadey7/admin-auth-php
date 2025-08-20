# Admin Authentication Package for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/saadmughal/admin-auth-php.svg)](https://packagist.org/packages/saadmughal/admin-auth-php)
[![Total Downloads](https://img.shields.io/packagist/dt/saadmughal/admin-auth-php.svg)](https://packagist.org/packages/saadmughal/admin-auth-php)
[![License](https://img.shields.io/packagist/l/saadmughal/admin-auth-php.svg)](https://packagist.org/packages/saadmughal/admin-auth-php)
[![PHP Version Require](https://img.shields.io/packagist/php-v/saadmughal/admin-auth-php.svg)](https://www.php.net/)

A complete Admin Authentication package for Laravel.
Features include:

1. 🔐 Admin login & registration

2. 🔑 Password reset & email verification

3. 🔔 Firebase push notifications for admins

4. ⚡ Ready-to-use routes, controllers, and views

# 🚀 Installation & Setup

## 1. Install via Composer

```bash
composer require saadmughal/admin-auth-php
```

## 2. Register Service Provider
This package uses manual provider registration (to avoid errors on removal).

Laravel 9 & 10

Edit `config/app.php` and add to the providers array:
```bash
Mughal\AdminAuth\AdminAuthServiceProvider::class,
```
Laravel 11 & above

Edit `bootstrap/providers.php`:
```bash
return [
    // other providers...
    Mughal\AdminAuth\AdminAuthServiceProvider::class,
];
```

## 3. Run Migrations
```bash
php artisan migrate
```

## 4. Add Guard & Provider
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
## 5. Dashboard Redirect
By default, after successful login, admins are redirected to `/admin`.  
You can change this in `config/adminauth.php`:
```bash
'redirect_to' => '/dashboard',
```

After installing and migrating, you must define your own admin dashboard route.  

Add this to `routes/web.php` in your Laravel project:

```php
Route::middleware('auth:admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard'); 
    });
});
```

## 6. Publish Config
After installing, publish the config file:

```bash
php artisan vendor:publish --provider="Mughal\AdminAuth\AdminAuthServiceProvider" --tag=config
```

## Firebase Notifications (Optional)
If you want to send notifications to admins, configure Firebase:

1. Add your Firebase JSON path in `.env`:
```bash
ADMIN_FIREBASE_JSON=/full/path/to/firebase_project.json
```
2. Save the admin’s FCM token when they log in
3. If you have added the Firebase JSON file path in your .env file and the FCM token is being stored in the database, you can use the below function to send notifications to admins.
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

## Visit in your browser:
```bash
http://localhost:8000/admin/login
http://localhost:8000/admin/register
```
# 🗑️ Removal / Uninstall
To uninstall cleanly without errors:

1. Remove provider entry
   1.1 Laravel 9 & 10 → remove from config/app.php
   1.2 Laravel 11 → remove from bootstrap/providers.php

2. Remove the package
```bash
composer remove saadmughal/admin-auth-php
```
3. Clear caches
```bash
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear
```
