<?php

namespace Premialabs\Foundation\UserRole;

use App\Http\Controllers\Controller;
use App\Models\User;
use Premialabs\Foundation\UserRole\gen\UserRole;
use Premialabs\Foundation\Utilities;
use Exception;
use Illuminate\Http\Request;
use Premialabs\Foundation\FndDatabaseController;

class UserRoleController extends FndDatabaseController
{
  public $repo;

  public function __construct()
  {
    $this->repo = new UserRoleRepo();
  }

  public static function routes(): array
  {
    return [
      // ----- BEGIN Auto Routes -----
      // create
      ['prepareCreate', 'GET', 'prepareCreate'],
      ['{userRole}/prepareDuplicate', 'GET', 'prepareDuplicate'],
      ['', 'POST', 'create'],

      // update
      ['{userRole}/prepareEdit', 'GET', 'prepareEdit'],
      ['{userRole}', 'PATCH', 'update'],
      ['/toggle', 'PATCH', 'toggle'],

      // read
      ['{userRole}', 'GET', 'show'],
      ['', 'GET', 'query'],

      // delete
      ['{userRole}', 'DELETE', 'delete'],
      ['', 'DELETE', 'bulkDelete'],
      // ----- END Auto Routes -----

      // ----- BEGIN Custom Routes -----
      // ['list', 'GET', 'list'],
      // ----- END Custom Routes -----
    ];
  }

  public function toggle(Request $request)
  {
    $user_id = $request->input('user_id');
    $role_id = $request->input('role_id');
    return Utilities::exec($this, 'list', [$user_id, $role_id]);
  }
}
