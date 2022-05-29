<?php

namespace Premialabs\Foundation\PrintPreviewer;

use App\Http\Controllers\Controller;
use App\Core\Foundation\Utilities;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class PrintPreviewerController extends Controller
{
  public $repo;

  public function __construct()
  {
    $this->repo = new PrintPreviewerRepo();
  }

  public static function routes(): array
  {
    return [
      ['', 'GET', 'handleReport']
      // 'getOpenObjects' => 'getOpenObjects',
      // 'doSomethingBatch' => 'doSomethingBatch'
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
}
