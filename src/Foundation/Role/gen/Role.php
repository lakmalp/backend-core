<?php

namespace Premialabs\Foundation\Role\gen;

use Premialabs\Foundation\Grant\gen\Grant;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
  protected $fillable = [
    'code',
    'description',
  ];
  protected $table = 'roles';

  public function grants()
  {
    return $this->hasMany(Grant::class);
  }
}
