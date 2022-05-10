<?php

namespace Premialabs\Foundation\User\gen;

use Premialabs\Foundation\User\gen\UserFieldValidator;
use Premialabs\Foundation\Utilities;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Exception;


class UserBaseRepo
{


  public function createRec(array $rec)
  {
    if (method_exists($this, 'beforeCreateRec')) {
      $this->beforeCreateRec($rec);
    }
    $validator = Validator::make(
      $rec,
      UserFieldValidator::getCreateRules()
    );
    if ($validator->fails()) {
      throw new Exception($validator->errors());
    }
    if (method_exists($this, 'customValidator')) {
      $this->customValidator($rec, 'CRE');
    }
    $object =  User::create($rec);
    if (method_exists($this, 'afterCreateRec')) {
      $this->afterCreateRec($rec, $object);
    }
    return $object;
  }

  public function updateRec($model_id, array $rec)
  {
    $object = User::findOrFail($model_id);
    if (method_exists($this, 'beforeUpdateRec')) {
      $this->beforeUpdateRec($rec, $object);
    }
    Utilities::hydrate($object, $rec);
    $validator = Validator::make(
      $rec,
      UserFieldValidator::getUpdateRules($model_id)
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
    User::destroy($recs);
  }
}
