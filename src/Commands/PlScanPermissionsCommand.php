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

PHP_OS == "Windows" || PHP_OS == "WINNT" ? define("DIR_PATH_SEPARATOR", "\\") : define("DIR_PATH_SEPARATOR", "\\");
PHP_OS == "Windows" || PHP_OS == "WINNT" ? define("CLASS_PATH_SEPARATOR", "\\") : define("CLASS_PATH_SEPARATOR", "/");

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
            if (Str::contains($fileName, "Controller.php")) {
                // --- linux - start ---
                // $model = explode("^", str_replace("\\", "^", $fileName))[0];
                // $myfilename = explode("^", str_replace("\\", "^", $fileName))[1];
                // $className = "App/Src/" . $fileName;                
                // --- linux - end ---

                // --- win - start ---
                // $model = explode("^", str_replace("\\", "^", $fileName))[0];
                // $myfilename = explode("^", str_replace("\\", "^", $fileName))[1];
                // $className = "App\\Src\\" . $model . "\\" . $myfilename;
                // --- win - end ---

                $model = explode("^", str_replace(DIR_PATH_SEPARATOR, "^", $fileName))[0];
                $myfilename = explode("^", str_replace(DIR_PATH_SEPARATOR, "^", $fileName))[1];
                $className = "App" . CLASS_PATH_SEPARATOR . "Src" . CLASS_PATH_SEPARATOR . $model . CLASS_PATH_SEPARATOR . $myfilename;

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
