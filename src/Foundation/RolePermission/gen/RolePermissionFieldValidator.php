<?php

namespace Premialabs\Foundation\RolePermission\gen;

class RolePermissionFieldValidator
{
  public static function getCommonRules()
  {
    return [

      'role_id' => ['numeric', 'required', 'exists:roles,id'],
      'permission_id' => ['numeric', 'required', 'exists:permissions,id'],

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
