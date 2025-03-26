<?php

require __DIR__ . '/vendor/autoload.php';

$app = new \Illuminate\Foundation\Application(__DIR__ . '/vendor/orchestra/testbench-core/laravel');

$app->register(\Spatie\Permission\PermissionServiceProvider::class);

// Also register your own service provider if needed
$app->register(\Premialabs\Providers\BackendServiceProvider::class);

$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

return $app;
