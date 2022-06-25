<?php

namespace Premialabs\Http\Middleware;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Premialabs\Foundation\Permission\gen\Permission;
use Illuminate\Support\Facades\Auth;
use Closure;

class CheckAuthorization
{
  public function handle($request, Closure $next)
  {
    $path = $request->path();
    $method = $request->method();
    $inquireAuth = $request->exists('inquireAuth');

    if ($inquireAuth) {
      $user_grants = Cache::rememberForever('userGrants', function () {
        $permissions = Permission::select(['endpoint', 'method'])
          ->join('role_permissions', 'role_permissions.permission_id', '=', 'permissions.id')
          ->join('user_roles', 'user_roles.role_id', '=', 'role_permissions.role_id')
          ->join('users', 'users.id', '=', 'user_roles.user_id')
          ->where('users.id', Auth::user()->id)
          ->get();
      });

      return response()->json(["status" => "success", "data" => $user_grants], 200);
    } else {

      return $next($request);
    }
  }
}
