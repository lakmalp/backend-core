<?php

namespace Premialabs\Foundation\UserPermission;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Premialabs\Foundation\Permission\gen\Permission;
use Illuminate\Support\Facades\Auth;

class UserPermissionRepo
{
  public function query($request)
  {
    return Permission::select(['method', 'endpoint'])
      ->join('role_permissions', 'role_permissions.permission_id', '=', 'permissions.id')
      ->join('user_roles', 'user_roles.role_id', '=', 'role_permissions.role_id')
      ->join('users', 'users.id', '=', 'user_roles.user_id')
      ->where('users.id', Auth::user()->id)
      ->get();
  }
}
