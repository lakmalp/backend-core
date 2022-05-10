<?php


namespace Premialabs\Foundation\User\gen;

use Premialabs\Foundation\UserProfile\gen\UserProfile;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
  protected $fillable = [
    'name',
    'email',
    'password',
    'type'
  ];
  protected $table = 'users';

  public function user_profile()
  {
    return $this->hasOne(UserProfile::class);
  }
}
