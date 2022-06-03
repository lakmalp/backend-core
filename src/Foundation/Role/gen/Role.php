<?php

namespace Premialabs\Foundation\Role\gen;

use Premialabs\Foundation\RolePermission\gen\RolePermission;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
  protected $fillable = [
    '_seq',
    'code',
    'description',
  ];
  protected $table = 'roles';

  public function rolePermissions()
  {
    return $this->hasMany(RolePermission::class);
  }
}
