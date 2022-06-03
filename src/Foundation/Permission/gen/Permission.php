<?php


namespace Premialabs\Foundation\Permission\gen;

use Premialabs\Foundation\RolePermission\gen\RolePermission;


use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
  protected $fillable = [
    '_seq',
    'code',
    'description',
  ];
  protected $table = 'permissions';



  public function rolePermissions()
  {
    return $this->hasMany(RolePermission::class);
  }
}
