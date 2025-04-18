<?php

namespace Premialabs\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Premialabs\Foundation\Permission\PermissionRepo;
use Premialabs\Foundation\Permission\gen\Permission;
use Premialabs\Foundation\RolePermission\gen\RolePermission;

class PlScanPermissionsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pl:scanPermissions';

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
        $this->_deleteUnassignedPermissions();

        $_seq_max = Permission::max('_seq');
        $_seq = (is_null($_seq_max) ? 99900 : $_seq_max + 100);

        array_map(function ($fileName) use (&$_seq) {
            $fileName = $fileName->getRelativePathName();

            // Skip files that are in _Config or _ExternalApi folders
            if (
                Str::contains($fileName, "_Config" . DIRECTORY_SEPARATOR) ||
                Str::contains($fileName, "_Config/") ||
                Str::contains($fileName, "_ExternalApi" . DIRECTORY_SEPARATOR) ||
                Str::contains($fileName, "_ExternalApi/")
            ) {
                return; // Skip this file
            }
            
            if (Str::contains($fileName, "Controller.php")) {
                // Use PHP's built-in constants for path handling
                $pathParts = explode(DIRECTORY_SEPARATOR, $fileName);
                if (count($pathParts) <= 1) {
                    // If DIRECTORY_SEPARATOR doesn't work, try forward slash
                    $pathParts = explode('/', $fileName);
                }

                // Get the model name (first directory)
                $model = $pathParts[0];
                // Get the filename (last part)
                $myfilename = end($pathParts);

                // Use namespace separator for class paths
                $namespaceSeparator = '\\';
                $className = "App{$namespaceSeparator}Src{$namespaceSeparator}{$model}{$namespaceSeparator}{$myfilename}";

                $className = str_replace(".php", "", $className);
                $routes = $className::routes();
                foreach ($routes as $route) {
                    $_seq = $_seq + 100;
                    list($endpoint, $method, $action) = $route;
                    $model_plural = Str::plural(Str::camel($model));
                    $is_exist = Permission::where([
                        'endpoint' => "api/" . (($endpoint === "") ? $model_plural : $model_plural . "/" . $endpoint),
                        'method' => $method
                    ])->exists();
                    if (!$is_exist) {
                        (new PermissionRepo)->createRec([
                            '_seq' => $_seq,
                            'endpoint' => "api/" . (($endpoint === "") ? $model_plural : $model_plural . "/" . $endpoint),
                            'method' => $method,
                            'action' => $model . 'Controller@' . $action
                        ]);
                    }
                }
            }
        }, File::allFiles(app_path() . "/Src"));
    }

    private function _deleteUnassignedPermissions()
    {
        $exclude_ids = RolePermission::select('permission_id')->distinct()->pluck('permission_id')->toArray();
        Permission::whereNotIn('id', $exclude_ids)->delete();
    }
}
