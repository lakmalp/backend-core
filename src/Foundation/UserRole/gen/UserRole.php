<?php

namespace Premialabs\Foundation\UserRole\gen;

use Premialabs\Foundation\Role\gen\Role;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
  protected $fillable = [
    '_seq',
    'user_id',
    'role_id',
  ];
  protected $table = 'user_roles';


  public function user()
  {
    return $this->belongsTo(User::class);
  }
  public function role()
  {
    return $this->belongsTo(Role::class);
  }
}
