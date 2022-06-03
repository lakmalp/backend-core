<?php

namespace Premialabs\Foundation\RolePermission\gen;

use Premialabs\Foundation\Permission\gen\Permission;
use Premialabs\Foundation\Role\gen\Role;
use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
  protected $fillable = [
    '_seq',
    'role_id',
    'permission_id',
  ];
  protected $table = 'role_permissions';


  public function role()
  {
    return $this->belongsTo(Role::class);
  }
  public function permission()
  {
    return $this->belongsTo(Permission::class);
  }
}
