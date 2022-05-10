<?php

namespace Premialabs\Foundation\Permission\gen;

use Premialabs\Foundation\Permission\gen\PermissionFieldValidator;
use Premialabs\Foundation\Utilities;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Exception;


class PermissionBaseRepo
{


  public function createRec(array $rec)
  {
    if (method_exists($this, 'beforeCreateRec')) {
      $this->beforeCreateRec($rec);
    }
    $validator = Validator::make(
      $rec,
      PermissionFieldValidator::getCreateRules()
    );
    if ($validator->fails()) {
      throw new Exception($validator->errors());
    }
    if (method_exists($this, 'customValidator')) {
      $this->customValidator($rec, 'CRE');
    }
    $object =  Permission::create($rec);
    if (method_exists($this, 'afterCreateRec')) {
      $this->afterCreateRec($rec, $object);
    }
    return $object;
  }

  public function updateRec($model_id, array $rec)
  {
    $object = Permission::findOrFail($model_id);
    if (method_exists($this, 'beforeUpdateRec')) {
      $this->beforeUpdateRec($rec, $object);
    }
    Utilities::hydrate($object, $rec);
    $validator = Validator::make(
      $rec,
      PermissionFieldValidator::getUpdateRules($model_id)
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
    Permission::destroy($recs);
  }
}
