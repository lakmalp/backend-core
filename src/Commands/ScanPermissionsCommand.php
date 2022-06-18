<?php

namespace Premialabs\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Premialabs\Foundation\Permission\PermissionRepo;

class ScanPermissionsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scan:permissions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scan and deploy permissions';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        array_map(function ($fileName) {
            $fileName = $fileName->getRelativePathName();
            if (Str::contains($fileName, "Controller.php")) {
                $className = "App\\Src\\" . $fileName;
                $className = Str::replace(".php", "", $className);
                $routes = $className::routes();
                foreach ($routes as $route) {
                    list($endpoint, $method, $action) = $route;
                    (new PermissionRepo)->createRec([
                        'endpoint' => $endpoint,
                        'method' => $method,
                        'action' => $action
                    ]);
                }
            }
            // $this->info($fileName->getRelativePathName());
        }, File::allFiles(app_path() . "/Src"));
    }
}
