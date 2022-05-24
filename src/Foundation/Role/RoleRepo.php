<?php

namespace Premialabs\Foundation\Role;

use Premialabs\Foundation\Role\gen\Role;
use Premialabs\Foundation\Role\gen\RoleBaseRepo;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class RoleRepo extends RoleBaseRepo
{
  #region ---------------- Hooks ------------------
  public static function beforeCreateRec(&$rec)
  {
    $rec['code'] = Str::upper($rec['code']);
    //$rec['status'] = SampleObject::getInitialStatus();
  }

  public static function customValidator($rec, $method)
  {
    //$rec['code'] = Str::upper($rec['code']);
    //$rec['status'] = SampleObject::getInitialStatus();
  }
  #endregion

  #region FSM
  // protected static $fsm = [
  //   '_START_' => [
  //     'Open'
  //   ],
  //   'Open' => [
  //     'release' => 'Released'
  //   ],
  //   'Released' => [
  //     'reopen' => 'Open',
  //     'close' => 'Closed'
  //   ],
  //   'Closed' => [
  //     'unclose' => 'Released'
  //   ]
  // ];


  // public function release($ids)
  // {
  //   foreach ($ids as $id) {
  //     $model = SampleObject::findOrFail($id);
  //     $model->update(['status' => SampleObject::getStatus('release')]);
  //     $model->refresh();
  //     $ret[] = $model;
  //   }
  //   return $ret;
  // }

  #endregion

  #region custom code blocks
  // public function sampleMethod($id, $param_1)
  // {
  //   return "xxxxx";
  // }

  #endregion

  public function index($page_no)
  {
    // if ($page_no === "n") {
    $recs =  Role::orderBy('created_at', 'asc')
      ->whereNotIn('code', ['SUPERADMIN'])
      ->get();
    // } else {
    //   $chunk = 15;

    //   $recs =  Role::orderBy('created_at', 'asc')
    //     ->whereNotIn('code', ['SUPERADMIN'])
    //     ->skip($chunk * ($page_no - 1))
    //     ->take($chunk)
    //     ->get();

    //   $recs->transform(function ($item, $key) use ($chunk, $page_no) {
    //     $item['_seq'] = ($chunk * ($page_no - 1)) + $key + 1; // +1 is done since $key is index
    //     return $item;
    //   });
    // }

    return $recs;
  }

  public function search($search)
  {
    $chunk = 15;

    $sql = Role::where('crn_no', 'LIKE', '%' . $search . '%')
      ->orWhere('description', 'LIKE', '%' . $search . '%');
    $data = $sql->take($chunk)->get();
    return $data;
  }

  public function get($role)
  {
    return $role;
  }
}
