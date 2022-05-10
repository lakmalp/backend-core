<?php

namespace Premialabs\Foundation\UserRole\gen;

class UserRoleFieldValidator
{
  public static function getCommonRules()
  {
    return [

      'user_id' => ['numeric', 'required', 'exists:users,id'],
      'role_id' => ['numeric', 'required', 'exists:roles,id'],

    ];
  }

  public static function getCreateRules()
  {
    return array_merge([], self::getCommonRules());
  }

  public static function getUpdateRules()
  {
    return array_merge([], self::getCommonRules());
  }
}
