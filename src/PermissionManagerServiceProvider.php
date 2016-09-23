<?php

namespace L5Starter\PermissionManager;

use Illuminate\Support\ServiceProvider;
use Spatie\Permission\PermissionServiceProvider;

class PermissionManagerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if (!$this->app->routesAreCached()) {
            require __DIR__ . '/Http/routes.php';
        }

        $this->loadViewsFrom(__DIR__ . '/../resources/views/admin/permissions', 'permissions');
        $this->loadViewsFrom(__DIR__ . '/../resources/views/admin/roles', 'roles');
        // Publishing File
        $this->publishes([__DIR__.'/../database/seeds/' => database_path('seeds')], 'seeder');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(PermissionServiceProvider::class);
    }
}
