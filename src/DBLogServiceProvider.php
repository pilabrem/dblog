<?php

namespace Pilabrem\DBLog;

use Illuminate\Support\ServiceProvider;
use Pilabrem\DBLog\Http\Classes\DBLog;

class DBLogServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/Views', 'dblog');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        $this->publishes([
            __DIR__.'/public' => public_path('vendor/dblog'),
        ], 'public');

        $this->publishes([
            __DIR__.'/Views' => resource_path('views/vendor/dblog'),
        ], 'views');

        $this->publishes([
            __DIR__.'/config/dblog.php' => config_path('dblog.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Binding de la classe DBLog pour être utilisé dans sa facade
        $this->app->bind('classe.dblog', function () {
            return new DBLog();
        });
    }
}
