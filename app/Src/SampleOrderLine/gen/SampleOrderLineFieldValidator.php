<?php

namespace App\Src\SampleOrderLine\gen;

class SampleOrderLineFieldValidator
{
  public static function getCommonRules()
  {
    return [
      'part_code' => ['required', 'max:30'],
      'part_description' => ['required', 'max:100'],
      'created_date' => ['required', 'date'],
      'delivery_date' => ['required', 'date'],
      'status' => ['required', 'max:30'],
      'sample_order_id' => ['numeric', 'nullable', 'exists:sample_orders,id'],
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
