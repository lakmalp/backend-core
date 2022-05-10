<?php

namespace Premialabs\Foundation\Grant\gen;

use Premialabs\Foundation\Permission\gen\Permission;
use Premialabs\Foundation\Role\gen\Role;
use Illuminate\Database\Eloquent\Model;

class Grant extends Model
{
  protected $fillable = [
    'role_id',
    'permission_id',
  ];
  protected $table = 'grants';


  public function role()
  {
    return $this->belongsTo(Role::class);
  }
  public function permission()
  {
    return $this->belongsTo(Permission::class);
  }
}
