<?php

namespace Premialabs\Foundation\UserRole;

use App\Models\User;
use Premialabs\Foundation\Role\gen\Role;
use Premialabs\Foundation\UserRole\gen\UserRole;
use Premialabs\Foundation\UserRole\gen\UserRoleBaseRepo;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class UserRoleRepo extends UserRoleBaseRepo
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

  #endregion

  public function index($page_no)
  {
    $super_role_id = Role::where('code', 'SUPERADMIN')->first()->id;
    $recs =  UserRole::orderBy('created_at', 'asc')
      ->whereNotIn('role_id', [$super_role_id])
      ->get();

    return $recs;
  }

  public function toggle($user_id, $role_id)
  {
    $_seq_max = UserRole::max('_seq');
    $_seq = (is_null($_seq_max) ? 100000 : $_seq_max + 100);
    $user_role = UserRole::where(['user_id' => $user_id, 'role_id' => $role_id])->first();

    if (!$user_role) {
      UserRole::create(['_seq' => $_seq, 'user_id' => $user_id, 'role_id' => $role_id]);
    } else {
      $user_role->delete();
    }
  }
}
