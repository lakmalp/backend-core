<?php

namespace Premialabs\Foundation\UserRole\gen;

use Premialabs\Foundation\UserRole\gen\UserRoleFieldValidator;
use Premialabs\Foundation\Utilities;
use Premialabs\Foundation\Traits\StatusTrait;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Exception;


class UserRoleBaseRepo
{
  use StatusTrait;

  public function createRec(array $rec)
  {
    if (method_exists($this, 'beforeCreateRec')) {
      $this->beforeCreateRec($rec);
    }
    $validator = Validator::make(
      $rec,
      UserRoleFieldValidator::getCreateRules()
    );
    if ($validator->fails()) {
      throw new Exception($validator->errors());
    }
    if (method_exists($this, 'customValidator')) {
      $this->customValidator($rec, 'CRE');
    }
    $object =  UserRole::create($rec);
    if (method_exists($this, 'afterCreateRec')) {
      $this->afterCreateRec($rec, $object);
    }
    return $object;
  }

  public function updateRec($model_id, array $rec)
  {
    $object = UserRole::findOrFail($model_id);
    if (method_exists($this, 'beforeUpdateRec')) {
      $this->beforeUpdateRec($rec, $object);
    }
    Utilities::hydrate($object, $rec);
    $validator = Validator::make(
      $rec,
      UserRoleFieldValidator::getUpdateRules($model_id)
    );
    if ($validator->fails()) {
      throw new Exception($validator->errors());
    }
    if (method_exists($this, 'customValidator')) {
      $this->customValidator($rec, 'UPD');
    }
    $object->update($rec);
    $object->refresh();
    if (method_exists($this, 'afterUpdateRec')) {
      $this->afterUpdateRec($rec, $object);
    }
    return $object;
  }

  public static function deleteRecs(array $recs)
  {
    UserRole::destroy($recs);
  }
}
