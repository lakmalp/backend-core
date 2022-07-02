<?php

namespace Premialabs\Foundation\UserPermission;

use App\Http\Controllers\Controller;
use Premialabs\Foundation\Utilities;
use Illuminate\Http\Request;

class UserPermissionController
{
  public $repo;

  public function __construct()
  {
    $this->repo = new UserPermissionRepo();
  }

  public static function routes(): array
  {
    return [
      // ----- BEGIN Auto Routes -----
      ['', 'GET', 'query'],
      // ----- END Auto Routes -----
    ];
  }

  public function query(Request $request)
  {
    return Utilities::fetch($this, 'query', [$request]);
  }
}
