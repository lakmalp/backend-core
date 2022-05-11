<?php

namespace App\Src\SampleOrder;

use Premialabs\Foundation\FndDatabaseController;

class SampleOrderController extends FndDatabaseController
{
  public $repo;

  public function __construct()
  {
    $this->repo = new SampleOrderRepo();
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
      ['{sampleOrder}', 'PATCH', 'update'],

      // read
      ['{sampleOrder}', 'GET', 'show'],
      ['', 'GET', 'query'],

      // delete
      ['{sampleOrder}', 'DELETE', 'delete'],
      ['', 'DELETE', 'bulkDelete'],

      // other routes
      // ['{sampleOrder}/suspend', 'PATCH', 'suspend']
    ];
  }

  // public function suspend(SampleOrder $sampleOrder)
  // {
  //   return Utilities::exec($this, 'suspend', [$sampleOrder]);
  // }
}
