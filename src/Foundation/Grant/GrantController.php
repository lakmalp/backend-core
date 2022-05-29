<?php

namespace Premialabs\Foundation\Grant;

use App\Http\Controllers\Controller;
use Premialabs\Foundation\Utilities;
use Exception;
use Illuminate\Http\Request;
use Premialabs\Foundation\FndDatabaseController;

class GrantController extends FndDatabaseController
{
  public $repo;

  public function __construct()
  {
    $this->repo = new GrantRepo();
  }

  public static function routes(): array
  {
    return [
      // 'getOpenObjects' => 'getOpenObjects',
      // 'doSomethingBatch' => 'doSomethingBatch'

      // ----- BEGIN Auto Routes -----
      // create
      ['prepareCreate', 'GET', 'prepareCreate'],
      ['prepareDuplicate', 'GET', 'prepareDuplicate'],
      ['', 'POST', 'create'],

      // update
      ['prepareEdit', 'GET', 'prepareEdit'],
      ['{grant}', 'PATCH', 'update'],

      // read
      ['{grant}', 'GET', 'show'],
      ['', 'GET', 'query'],

      // delete
      ['{grant}', 'DELETE', 'delete'],
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
