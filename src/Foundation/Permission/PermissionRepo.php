<?php

namespace Premialabs\Foundation\Permission;

use Premialabs\Foundation\Permission\gen\Permission;
use Premialabs\Foundation\Permission\gen\PermissionBaseRepo;
use Premialabs\Foundation\Security;
use Premialabs\Foundation\UserRole\gen\UserRole;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PermissionRepo extends PermissionBaseRepo
{
  #region ---------------- Hooks ------------------
  // public static function beforeCreateRec(&$rec)
  // {
  //   //$rec['code'] = Str::upper($rec['code']);
  //   //$rec['status'] = SampleObject::getInitialStatus();
  // }

  // public static function customValidator($rec, $method)
  // {
  //   //$rec['code'] = Str::upper($rec['code']);
  //   //$rec['status'] = SampleObject::getInitialStatus();
  // }

  public function index($page_no)
  {
    // if ($page_no === "n") {
    $recs =  Permission::orderBy('created_at', 'asc')
      // ->whereNotIn('code', ['SUPERADMIN'])
      ->get();
    // } else {
    //   $chunk = 15;

    //   $recs =  Role::orderBy('created_at', 'asc')
    //     ->whereNotIn('code', ['SUPERADMIN'])
    //     ->skip($chunk * ($page_no - 1))
    //     ->take($chunk)
    //     ->get();

    //   $recs->transform(function ($item, $key) use ($chunk, $page_no) {
    //     $item['_seq_'] = ($chunk * ($page_no - 1)) + $key + 1; // +1 is done since $key is index
    //     return $item;
    //   });
    // }

    return $recs;
  }

  public function getNavigator()
  {
    return (new Security)->getNavigator();
  }

  public function getRoutingAndNavs()
  {
    return (new Security)->getRoutingAndNavs();
  }
}
