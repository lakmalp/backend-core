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
      // 'getOpenObjects' => 'getOpenObjects',
      '' => ['GET', 'index'],
      'getNavigator' => ['GET', 'getNavigator'],
      'getRoutingAndNavs' => ['GET', 'getRoutingAndNavs']
    ];
  }

  // public function doSomethingBatch(Request $request)
  // {
  //   $ids = $request->input('ids');
  //   $param_1 = $request->input('param_1');
  //   return Utilities::exec($this, 'doSomethingBatch', [$ids, $param_1]);
  // }

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

  public function getNavigator(Request $request)
  {
    return Utilities::fetch($this, 'getNavigator', []);
  }

  public function getRoutingAndNavs(Request $request)
  {
    return Utilities::fetch($this, 'getRoutingAndNavs', []);
  }
}
