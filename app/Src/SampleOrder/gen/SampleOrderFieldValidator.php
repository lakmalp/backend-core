<?php

namespace App\Src\SampleOrder\gen;

class SampleOrderFieldValidator
{
  public static function getCommonRules()
  {
    return [
      'po_no' => ['required'],
      'created_date' => ['required', 'date'],
      'delivery_date' => ['required', 'date'],
      'status' => ['required'],
      'created_by_id' => ['numeric', 'nullable', 'exists:users,id'],
      'last_modified_by_id' => ['numeric', 'nullable', 'exists:users,id']

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
