<?php

namespace App\Src\SampleOrder;

use App\Src\SampleOrder\gen\SampleOrder;
use App\Src\SampleOrder\gen\SampleOrderBaseRepo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class SampleOrderRepo extends SampleOrderBaseRepo
{
  #region ---------------- Hooks ------------------
  public function prepareCreate(Request $request)
  {
    $max_po_no = SampleOrder::max('id');
    return [
      'po_no' => $max_po_no + 1,
      'created_date' => Carbon::now(),
      'status' => 'Preliminary',
      '_seq_' => $this->getNextSequence(null, null, null, 0, null)
    ];
  }

  public static function beforeCreateRec(&$rec)
  {
    $rec['last_modified_by_id'] = auth()->user()->id;
  }

  public function prepareEdit(SampleOrder $sampleOrder)
  {
    // $sampleOrder['roles'] = Role::all()->toArray();
    // $sampleOrder['email_address'] = $sampleOrder->user->email;
    // $sampleOrder['role'] = $sampleOrder->user->user_roles[0]->role_id;
    // $sampleOrder['keep_password'] = true;
    // $sampleOrder['retype_email_address'] = $sampleOrder->user->email;

    // return $sampleOrder;
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

  public function query($request)
  {
    $page_no = $request->query('page_no');
    $page_size = $request->query('page_size');
    $po_id = $request->query('po_id');
    $i = 1;

    return SampleOrder::orderBy('_seq_')->get()->map(function ($item, $key) use (&$i) {
      $item['_line_no_'] = $i++;
      return $item;
    });
  }
}
