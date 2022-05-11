<?php

namespace App\Src\SampleOrderLine;

use Premialabs\Foundation\FndDatabaseController;

class SampleOrderLineController extends FndDatabaseController
{
  public $repo;

  public function __construct()
  {
    $this->repo = new SampleOrderLineRepo();
  }

  public static function routes(): array
  {
    return [
      // create
      ['prepareCreate', 'GET', 'prepareCreate'],
      ['prepareDuplicate', 'GET', 'prepareDuplicate'],
      ['', 'POST', 'create'],

      // update
      ['prepareEdit', 'GET', 'prepareEdit'],
      ['{sampleOrderLine}', 'PATCH', 'update'],

      // read
      ['{sampleOrderLine}', 'GET', 'show'],
      ['', 'GET', 'query'],

      // delete
      ['{sampleOrderLine}', 'DELETE', 'delete'],
      ['', 'DELETE', 'bulkDelete'],

      // other routes
      // ['{sampleOrderLine}/suspend', 'PATCH', 'suspend']
    ];
  }

  // public function suspend(SampleOrderLine $sampleOrderLine)
  // {
  //   return Utilities::exec($this, 'suspend', [$sampleOrderLine]);
  // }
}
