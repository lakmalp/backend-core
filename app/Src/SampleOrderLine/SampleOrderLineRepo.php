<?php

namespace App\Src\SampleOrderLine;

use App\Core\Foundation\Interfaces\BaseRepo;
use Premialabs\Foundation\FndModel;
use App\Src\SampleOrderLine\gen\SampleOrderLine;
use App\Src\SampleOrderLine\gen\SampleOrderLineBaseRepo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class SampleOrderLineRepo extends SampleOrderLineBaseRepo
{
  #region ---------------- Hooks ------------------
  public function prepareCreate(Request $request)
  {
    $po_id = $request->query('parent_id');
    $curr_seq = $request->query('curr_seq');
    $positioning = $request->query('positioning');

    $next_seq = $this->getNextSequence(SampleOrderLine::class, 'sample_order_id', $po_id, $curr_seq, $positioning);

    // if ($curr_seq == 0) {
    //   // no existing rows
    //   $next_seq = 100000;
    // } else {
    //   if ($positioning === "above") {
    //     $prev_line_seq = SampleOrderLine::where('purchase_order_id', $po_id)->where('_seq', '<', $curr_seq)->max('_seq');
    //     if (is_null($prev_line_seq)) {
    //       // RMB has been executed on first row
    //       $next_seq = (0 + $curr_seq) / 2;
    //     } else {
    //       // not the first row
    //       $next_seq = ($prev_line_seq + $curr_seq) / 2;
    //     }
    //   } else if ($positioning === "below") {
    //     $next_line_seq = SampleOrderLine::where('purchase_order_id', $po_id)->where('_seq', '>', $curr_seq)->min('_seq');
    //     if (is_null($next_line_seq)) {
    //       // RMB has been executed on last row
    //       $next_seq = $curr_seq + 100;
    //     } else {
    //       // not the last row
    //       Log::info('$next_line_seq: ' . $next_line_seq);
    //       Log::info('$curr_seq: ' . $curr_seq);
    //       $next_seq = ($next_line_seq + $curr_seq) / 2;
    //     }
    //   } else {
    //     $next_seq = $curr_seq + 100;
    //   }
    // }

    return ['sample_order_id' => $po_id, '_seq' => $next_seq];
  }

  public function prepareDuplicate($sourceId)
  {
    $pol = SampleOrderLine::find($sourceId);
    $next_seq = $this->getNextSequence(SampleOrderLine::class, 'sample_order_id', $pol->sample_order_id, $pol->_seq, "below");
    $pol['_seq'] = $next_seq;

    return $pol;
  }

  public static function beforeCreateRec(&$rec)
  {
    $rec['last_modified_by_id'] = auth()->user()->id;
    $rec['created_date'] = Carbon::now()->format("Y-m-d");
    $rec['status'] = "Planned";
  }

  public static function afterCreateRec($rec, $object)
  {
    return $object;
  }

  public function prepareEdit(SampleOrderLine $sample_order_line)
  {
    return $sample_order_line;
  }

  public static function beforeUpdateRec(&$rec, $object)
  {
  }

  public static function customValidator($rec, $method)
  {
    //$rec['code'] = Str::upper($rec['code']);
    //$rec['status'] = SampleObject::getInitialStatus();
  }
  #endregion
}
