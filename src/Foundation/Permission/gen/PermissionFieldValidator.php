<?php

namespace Premialabs\Foundation\Permission\gen;

class PermissionFieldValidator
{
  public static function getCommonRules()
  {
    return [

      'endpoint' => ['nullable'],
      'method' => ['required'],
      'action' => ['required'],

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
