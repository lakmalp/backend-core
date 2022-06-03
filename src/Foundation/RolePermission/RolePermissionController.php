<?php

namespace Premialabs\Foundation\RolePermission;

use App\Http\Controllers\Controller;
use Premialabs\Foundation\Utilities;
use Exception;
use Illuminate\Http\Request;
use Premialabs\Foundation\FndDatabaseController;

class RolePermissionController extends FndDatabaseController
{
  public $repo;

  public function __construct()
  {
    $this->repo = new RolePermissionRepo();
  }

  public static function routes(): array
  {
    return [
      // ----- BEGIN Auto Routes -----
      // create
      ['prepareCreate', 'GET', 'prepareCreate'],
      ['{rolePermission}/prepareDuplicate', 'GET', 'prepareDuplicate'],
      ['', 'POST', 'create'],

      // update
      ['toggle', 'PATCH', 'toggle'],
      ['{rolePermission}/prepareEdit', 'GET', 'prepareEdit'],
      ['{rolePermission}', 'PATCH', 'update'],

      // read
      ['{rolePermission}', 'GET', 'show'],
      ['', 'GET', 'query'],

      // delete
      ['{rolePermission}', 'DELETE', 'delete'],
      ['', 'DELETE', 'bulkDelete'],
      // ----- END Auto Routes -----

      // ----- BEGIN Custom Routes -----
      // ['list', 'GET', 'list'],
      // ----- END Custom Routes -----
    ];
  }

  public function toggle(Request $request)
  {
    $permission_id = $request->input('permission_id');
    $role_id = $request->input('role_id');
    return Utilities::exec($this, 'toggle', [$permission_id, $role_id]);
  }
}
