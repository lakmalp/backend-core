<?php

namespace Premialabs\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

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

        $this->publishes([
            __DIR__ . '/../../config/premialabs.php' => config_path('premialabs.php'),
        ], 'laravel-assets');

        $this->loadMigrationsFrom(__DIR__ . '/../migrations');
    }
}
