<?php

namespace Premialabs\Foundation\RolePermission;

use Premialabs\Foundation\RolePermission\gen\RolePermission;
use Premialabs\Foundation\RolePermission\gen\RolePermissionBaseRepo;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Premialabs\Foundation\RolePermission\gen\RolePermissionWithParentsView;

class RolePermissionRepo extends RolePermissionBaseRepo
{
  #region ---------------- Hooks ------------------
  public static function beforeCreateRec(&$rec)
  {
    //$rec['code'] = Str::upper($rec['code']);
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

  #

  public function index($page_no)
  {
    $recs =  RolePermission::orderBy('created_at', 'asc')
      ->get();

    return $recs;
  }

  public function toggle($permission_id, $role_id)
  {
    $_seq_max = RolePermission::max('_seq');
    $_seq = (is_null($_seq_max) ? 100000 : $_seq_max + 100);
    $role_permission = RolePermission::where([
      'permission_id' => $permission_id, 'role_id' => $role_id
    ])->first();

    if (!$role_permission) {
      return RolePermission::create(['_seq' => $_seq, 'permission_id' => $permission_id, 'role_id' => $role_id]);
    } else {
      $role_permission->delete();
      return null;
    }
  }

  public function list($request)
  {
    $data = RolePermission::orderBy('_seq')
      ->get()
      ->map(
        function ($item, $key) use (&$i) {
          $item['_line_no'] = ++$i;
          return $item;
        }
      );

    return RolePermissionWithParentsView::collection($data);
  }
}
