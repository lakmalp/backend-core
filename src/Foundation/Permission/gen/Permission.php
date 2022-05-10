<?php


namespace Premialabs\Foundation\Permission\gen;

use Premialabs\Foundation\Grant\gen\Grant;


use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
  protected $fillable = [
    'code',
    'description',
  ];
  protected $table = 'permissions';



  public function grants()
  {
    return $this->hasMany(Grant::class);
  }
}
