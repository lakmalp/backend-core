<?php

namespace Premialabs\Foundation\Role\gen;

class RoleFieldValidator
{
  public static function getCommonRules()
  {
    return [

      'code' => ['required', 'min:2'],
      'description' => ['required'],

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
