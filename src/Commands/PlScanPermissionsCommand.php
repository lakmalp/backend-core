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
            if (Str::contains($fileName, "Controller.php")) {
                $model = explode("^", str_replace("\\", "^", $fileName))[0];
                $className = "App\\Src\\" . $fileName;
                $className = str_replace(".php", "", $className);
                $routes = $className::routes();
                foreach ($routes as $route) {
                    $_seq = $_seq + 100;
                    list($endpoint, $method, $action) = $route;
                    $model_formatted = Str::plural(Str::camel($model));
                    (new PermissionRepo)->createRec([
                        '_seq' => $_seq,
                        'endpoint' => (($endpoint === "") ? $model_formatted : $model_formatted . "\\" . $endpoint),
                        'method' => $method,
                        'action' => $action
                    ]);
                }
            }
        }, File::allFiles(app_path() . "/Src"));
    }

    private function _deleteUnassignedPermissions()
    {
        Permission::leftJoin('role_permissions', 'role_permissions.permission_id', '<>', 'permissions.id')
            ->delete();
    }
}