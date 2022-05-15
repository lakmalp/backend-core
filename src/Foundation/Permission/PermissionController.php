<?php

namespace Premialabs\Foundation\Permission;

use App\Http\Controllers\Controller;
use Premialabs\Foundation\Utilities;
use Exception;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
  public $repo;

  public function __construct()
  {
    $this->repo = new PermissionRepo();
  }

  public static function routes(): array
  {
    return [
      '' => ['GET', 'index'],
    ];
  }

  public function index(Request $request)
  {
    if ($request->has('search')) {
      $search = $request->query('search');
      return Utilities::fetch($this, 'search', [$search]);
    } else {
      $page_no = $request->query('page_no');
      return Utilities::fetch($this, 'index', [$page_no]);
    }
  }
}
