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
        $this->_deleteUnassignedPermissions();

        $_seq_max = Permission::max('_seq');
        $_seq = (is_null($_seq_max) ? 99900 : $_seq_max + 100);

        array_map(function ($fileName) use (&$_seq) {
            $fileName = $fileName->getRelativePathName();
            if (Str::contains($fileName, "Controller.php")) {
                $className = "App\\Src\\" . $fileName;
                $className = Str::replace(".php", "", $className);
                $routes = $className::routes();
                foreach ($routes as $route) {
                    $_seq = $_seq + 100;
                    list($endpoint, $method, $action) = $route;
                    (new PermissionRepo)->createRec([
                        '_seq' => $_seq,
                        'endpoint' => Str::camel($className) . "/" . $endpoint,
                        'method' => $method,
                        'action' => $action
                    ]);
                }
            }
        }, File::allFiles(app_path() . "/Src"));
    }

    private function _deleteUnassignedPermissions()
    {
        $perms = Permission::join('role_permissions', 'role_permissions.permission_id', '<>', 'permissions.id')
            ->delete();
    }
}
