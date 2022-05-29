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
}
