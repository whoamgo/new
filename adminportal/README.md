# Admin Portal (Laravel 12)

This repository contains production-ready scaffolding for an Admin Portal built on Laravel 12, Bootstrap 5, jQuery, Blade, and MySQL with the following features:

- Authentication (login via email or username), remember-me, email verification (toggleable)
- Social Login (Google, Twitter, Facebook)
- Two-Factor Authentication (toggleable)
- Roles and Permissions (Spatie)
- User Management with Datatables
- User Impersonation (Admin)
- Profile Update with Avatar Upload + Crop (Intervention Image)
- Activity Log (Spatie)
- Registration History Chart (Chart.js)
- Google reCAPTCHA (toggleable)
- CSRF protection for all forms
- Responsive Dashboard with Light/Dark sidebar
- Application Settings (logo, name, theme)
- Application Backup (Spatie Backup)
- Optimizations for speed and security

## Requirements

- PHP 8.2+
- Composer 2.7+
- MySQL 8+
- Node 20+ and npm
- GD or Imagick
- Redis (optional)

## Quick Start

1) Install dependencies:

```
composer install
npm install
```

2) Copy environment:

```
cp .env.example .env
php artisan key:generate
```

3) Configure DB in `.env` and adjust mail, cache, session, queue as needed.

4) Run package installs and publish assets/configs:

```
php artisan vendor:publish --provider="Spatie\\Permission\\PermissionServiceProvider"
php artisan vendor:publish --provider="Spatie\\Activitylog\\ActivitylogServiceProvider"
php artisan vendor:publish --provider="Spatie\\Backup\\BackupServiceProvider"
php artisan vendor:publish --provider="Yajra\\DataTables\\DataTablesServiceProvider"
php artisan vendor:publish --provider="Anhskohbo\\NoCaptcha\\NoCaptchaServiceProvider"
php artisan vendor:publish --provider="Intervention\\Image\\ImageServiceProviderLaravelRecent"
php artisan vendor:publish --provider="PragmaRX\\Google2FALaravel\\ServiceProvider"
php artisan vendor:publish --provider="Lab404\\Impersonate\\ImpersonateServiceProvider"
```

5) Migrate and seed base roles, admin user, and settings:

```
php artisan migrate --seed
```

6) Build frontend:

```
npm run build
```

7) Run the app:

```
php artisan serve
```

## Notes

- All forms submit via AJAX with CSRF tokens embedded.
- Datatables used for listings with server-side processing.
- Email verification, 2FA, and reCAPTCHA are controlled via settings.
- Admin can impersonate users from the User Management table.

Refer to `docs/setup.md` for detailed instructions and environment examples.