<?php

namespace Premialabs\Foundation\ReportUtility;

use App\Http\Controllers\Controller;

class ReportUtilityController extends Controller
{
  public $repo;

  public function __construct()
  {
    $this->repo = new ReportUtilityRepo();
  }

  public static function routes(): array
  {
    return [
      // 'getAllTransactions' => ['GET', 'getAllTransactions'],
      // 'getAgentTransactions' => ['GET', 'getAgentTransactions']
    ];
  }
}
