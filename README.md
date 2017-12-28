# L5Starter\PermissionManagement

## Installation

In order to install Laravel 5, just add

``` php
"l5starter/permission-manager": "5.5.x-dev"
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
        <i class="fa fa-users"></i> <span>{{ trans('l5starter::general.roles') }}</span>
    </a>
</li>
<li class="{{ (Request::is('admin/permissions*') ? 'active' : '') }}">
    <a href="{{ route('admin.permissions.index') }}">
        <i class="fa fa-cog"></i> <span>{{ trans('l5starter::general.permissions') }}</span>
    </a>
</li>
```

## Usage
First add the `Spatie\Permission\Traits\HasRoles`-trait to your User model.

```php
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;

    // ...
}
```

## Using a middleware
The package doesn't contain a middleware to check permissions but it's very trivial to add this yourself.

``` bash
$ php artisan make:middleware RoleMiddleware
```

This will create a RoleMiddleware for you, where you can handle your role check.
```php
// app/Http/Middleware/RoleMiddleware.php
use Auth;

...

public function handle($request, Closure $next, $role)
{
    if (Auth::guest()) {
        return redirect($urlOfYourLoginPage);
    }

    if (! $request->user()->hasRole($role)) {
       abort(403);
    }

    return $next($request);
}
```

Don't forget to add the route middleware to your Kernel:

```php
// app/Http/Kernel.php
protected $routeMiddleware = [
    ...
    'role' => \App\Http\Middleware\RoleMiddleware::class,
    ...
];
```

Now you can protect your routes using the middleware you just set up:

```php
Route::group(['middleware' => ['role:admin']], function () {
    //
});
```
