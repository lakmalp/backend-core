<?php

namespace Premialabs\Foundation;

use Illuminate\Http\Request;

abstract class BaseRepo
{
  public function getNextSequence($model, $parent_column_name, $parent_id, $current_sequence, $positioning)
  {
    $next_seq = 0;

    if ($current_sequence == 0) {
      // no existing rows
      $next_seq = 100000;
    } else {
      if ($positioning === "above") {
        $prev_line_seq = $model::where($parent_column_name, $parent_id)->where('_seq', '<', $current_sequence)->max('_seq');
        if (is_null($prev_line_seq)) {
          // RMB has been executed on first row
          $next_seq = (0 + $current_sequence) / 2;
        } else {
          // not the first row
          $next_seq = ($prev_line_seq + $current_sequence) / 2;
        }
      } else if ($positioning === "below") {
        $next_line_seq = $model::where($parent_column_name, $parent_id)->where('_seq', '>', $current_sequence)->min('_seq');
        if (is_null($next_line_seq)) {
          // RMB has been executed on last row
          $next_seq = $current_sequence + 100;
        } else {
          // not the last row
          $next_seq = ($next_line_seq + $current_sequence) / 2;
        }
      } else {
        $next_seq = $current_sequence + 100;
      }
    }

    return $next_seq;
  }

  public function query(Request $request)
  {
    return;
  }

  public function showRec($model_id)
  {
    return;
  }

  public static function beforeCreateRec(array &$rec)
  {
    return $rec;
  }

  public function createRec(array $rec)
  {
    return;
  }

  public static function afterCreateRec($rec, $object)
  {
    return $object;
  }

  /**
   * This should be overridden to add custom validation logic other than field auto-validations.
   *
   * @param array  $rec  This is an array with fields that can be used for validation.
   * @param string $method can be of 'CRE' or 'UPD'
   */
  public static function customValidator($rec, $method)
  {
    return;
  }

  public static function beforeUpdateRec(&$rec, $object)
  {
    return $rec;
  }

  public function updateRec($model_id, array $rec)
  {
    return;
  }

  public function afterUpdateRec($rec, $object)
  {
    return;
  }

  public static function beforeDeleteRec($object)
  {
    return;
  }

  public function deleteRec($object)
  {
    return;
  }

  public function afterDeleteRec($object)
  {
    return;
  }
}
