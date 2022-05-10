<?php

namespace Premialabs\Foundation\Traits;

trait StatusTrait
{
  public function getFsm()
  {
    return $this->fsm;
  }

  public static function getStatus($action)
  {
    return array_reduce(array_values(self::$fsm), function ($accumulator, $item) {
      $accumulator = array_merge($accumulator, $item);
      return $accumulator;
    }, [])[$action];
  }

  public static function getInitialStatus()
  {
    return self::$fsm["_START_"][0];
  }

  public static function getNextStatuses($currentState)
  {
    return self::$fsm[$currentState];
  }

  public static function getStates()
  {
    return array_values(array_diff_key(array_keys(self::$fsm), [array_key_first(self::$fsm)]));
  }
}
