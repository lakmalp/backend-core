<?php

namespace Premialabs\Providers;

use Illuminate\Routing\Router;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Premialabs\Commands\PlScanPermissionsCommand;
use Premialabs\Http\Middleware\CheckAuthorization;

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
    public function boot(Kernel $kernel)
    {
        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('checkauth', CheckAuthorization::class);

        Route::middleware(['api', 'auth:sanctum', 'checkauth'])->prefix('api')->group(function () {
            $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
        });

        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__ . '/../../config/premialabs.php' => config_path('premialabs.php'),
            ], 'premialabs-config');

            $this->commands([
                PlScanPermissionsCommand::class,
            ]);
        }
    }
}
