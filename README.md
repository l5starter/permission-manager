# L5Start\PermissionManager

## Installation

In order to install Laravel 5, just add

``` php
"l5starter/permission-manager": "5.2.x-dev"
```
to your composer.json. Then run `composer install` or `composer update`.

Then in your `config/app.php` add in `providers`

``` php
Spatie\Permission\PermissionServiceProvider::class,
L5Starter\PermissionManager\PermissionManagerServiceProvider::class,
```

You can publish the migration with

``` php
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider" --tag="migrations"
```

Running Migrations

``` bash
$ php artisan migrate
```

You can publish the seeders with

``` php
php artisan vendor:publish --provider="L5Starter\PermissionManager\PermissionManagerServiceProvider" --tag="seeder"
```

Running Seeders

``` bash
$ php artisan db:seed --class=RolesTableSeeder
```

Add menu in `resources/views/vendor/l5starter/admin/partials/sidebar.blade.php`

``` html
<li class="{{ (Request::is('admin/roles*') ? 'active' : '') }}">
    <a href="{{ route('admin.roles.index') }}">
        <i class="fa fa-cog"></i> <span>{{ trans('l5starter::general.roles') }}</span>
    </a>
</li>
<li class="{{ (Request::is('admin/permissions*') ? 'active' : '') }}">
    <a href="{{ route('admin.permissions.index') }}">
        <i class="fa fa-cog"></i> <span>{{ trans('l5starter::general.permissions') }}</span>
    </a>
</li>
```