<?php

namespace Pilabrem\DBLog;

use Illuminate\Support\ServiceProvider;

class DBLogServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        $this->loadRoutesFrom(__DIR__ . '/routes.php');

        $this->loadViewsFrom(__DIR__ . '/Views', 'dblog');

        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        $this->publishes([
            __DIR__.'/public' => public_path('vendor/dblog'),
        ], 'public');

        $this->publishes([
            __DIR__.'/Views' => resource_path('views/vendor/dblog'),
        ], 'views');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        /* $this->app['dblog'] = $this->app->share(function ($app) {
            return new DBLog;
        }); */
    }
}
