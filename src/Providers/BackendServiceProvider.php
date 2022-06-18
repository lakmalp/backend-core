<?php

namespace Premialabs\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Premialabs\Commands\ScanPermissionsCommand;

class BackendServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/premialabs.php', 'premialabs');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Route::middleware(['api', 'auth:sanctum'])->prefix('api')->group(function () {
            $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
        });

        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__ . '/../../config/premialabs.php' => config_path('premialabs.php'),
            ], 'premialabs-config');

            $this->commands([
                ScanPermissionsCommand::class,
            ]);
        }
    }
}
