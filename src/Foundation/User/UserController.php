<?php

namespace Premialabs\Foundation\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Premialabs\Foundation\Utilities;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
  public $repo;

  public function __construct()
  {
    $this->repo = new UserRepo();
  }

  public static function routes(): array
  {
    return [
      // 'getOpenObjects' => 'getOpenObjects',
      // 'doSomethingBatch' => 'doSomethingBatch'
      '' => ['GET', 'index'],
      '{user}/' => ['GET', 'get']
    ];
  }

  // public function doSomethingBatch(Request $request)
  // {
  //   $ids = $request->input('ids');
  //   $param_1 = $request->input('param_1');
  //   return Utilities::exec($this, 'doSomethingBatch', [$ids, $param_1]);
  // }

  // public function getOpenObjects(Request $request)
  // {
  //   $id = $request->input('id');
  //   $param_1 = $request->input('param_1');
  //   return Utilities::fetch($this, 'getOpenObjects', [$id, $param_1]);
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

  public function get(User $user)
  {
    return Utilities::fetch($this, 'get', [$user]);
  }
}
