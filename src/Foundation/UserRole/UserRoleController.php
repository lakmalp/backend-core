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
      ['prepareDuplicate', 'GET', 'prepareDuplicate'],
      ['', 'POST', 'create'],

      // update
      ['prepareEdit', 'GET', 'prepareEdit'],
      ['{userRole}', 'PATCH', 'update'],

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

  // public function list(Request $request)
  // {
  //   return Utilities::exec($this, 'list', [$request]);
  // }
}
