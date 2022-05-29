<?php

namespace Premialabs\Foundation\Role;

use App\Http\Controllers\Controller;
use Premialabs\Foundation\Role\gen\Role;
use Premialabs\Foundation\Utilities;
use Exception;
use Illuminate\Http\Request;
use Premialabs\Foundation\FndDatabaseController;

class RoleController extends FndDatabaseController
{
  public $repo;

  public function __construct()
  {
    $this->repo = new RoleRepo();
  }

  public static function routes(): array
  {
    return [
      // ----- BEGIN Auto Routes -----
      // create
      ['prepareCreate', 'GET', 'prepareCreate'],
      ['{role}/prepareDuplicate', 'GET', 'prepareDuplicate'],
      ['', 'POST', 'create'],

      // update
      ['{role}/prepareEdit', 'GET', 'prepareEdit'],
      ['{role}', 'PATCH', 'update'],

      // read
      ['{role}', 'GET', 'show'],
      ['', 'GET', 'query'],

      // delete
      ['{role}', 'DELETE', 'delete'],
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
