<?php

namespace Premialabs\Foundation\Permission;

use App\Http\Controllers\Controller;
use Premialabs\Foundation\Utilities;
use Exception;
use Illuminate\Http\Request;
use Premialabs\Foundation\FndDatabaseController;

class PermissionController extends FndDatabaseController
{
  public $repo;

  public function __construct()
  {
    $this->repo = new PermissionRepo();
  }

  public static function routes(): array
  {
    return [
      // ----- BEGIN Auto Routes -----
      // create
      ['prepareCreate', 'GET', 'prepareCreate'],
      ['{permission}/prepareDuplicate', 'GET', 'prepareDuplicate'],
      ['', 'POST', 'create'],

      // update
      ['{permission}/prepareEdit', 'GET', 'prepareEdit'],
      ['{permission}', 'PATCH', 'update'],

      // read
      ['{permission}', 'GET', 'show'],
      ['', 'GET', 'query'],

      // delete
      ['{permission}', 'DELETE', 'delete'],
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
