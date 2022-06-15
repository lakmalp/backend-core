<?php

namespace Premialabs\Foundation\Traits;

use Illuminate\Support\Facades\Log;

trait ModelModifierTrait
{
  protected static function booted()
  {
    if (!is_null(auth()->user())) {
      static::creating(function ($model) {
        $model->created_by_user_ref = auth()->user()->id;
        $model->last_modified_by_user_ref = auth()->user()->id;
      });

      static::updating(function ($model) {
        $model->last_modified_by_user_ref = auth()->user()->id;
      });
    }
  }
}
