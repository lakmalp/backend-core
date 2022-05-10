<?php

namespace Premialabs\Foundation\User\gen;

class UserFieldValidator
{
  public static function getCommonRules()
  {
    return [

      'name' => ['required'],
      'email' => ['required'],
      'type' => ['required']

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
