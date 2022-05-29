<?php

namespace Premialabs\Foundation\Permission\gen;

use Premialabs\Foundation\Permission\gen\PermissionFieldValidator;
use Premialabs\Foundation\Utilities;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Exception;
use Premialabs\Foundation\Traits\ModelAuditorTrait;

class PermissionBaseRepo
{

  use ModelAuditorTrait;

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
    if ($this->modelAuditable('Permission')) {
      $this->auditAfterCreate($object);
    }

    if (method_exists($this, 'afterCreateRec')) {
      if ($ret = $this->afterCreateRec($rec, $object)) {
        return $ret;
      }
    }
    return $object;
  }

  public function updateRec($model_id, array $rec)
  {
    $object = Permission::findOrFail($model_id);
    if (method_exists($this, 'beforeUpdateRec')) {
      $this->beforeUpdateRec($rec, $object);
    }
    if (!$object->updated_at->eq(\Carbon\Carbon::parse($rec['updated_at']))) {
      $entity = (new \ReflectionClass($object))->getShortName();
      throw new \Premialabs\Foundation\Exceptions\ConcurrencyCheckFailedException($entity);
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
    $_is_auditable = $this->modelAuditable('Permission');
    if ($_is_auditable) {
      $_beofre_id = $this->auditBeforeUpdate($model_id, $object);
    }
    $object->update($rec);
    $object->refresh();
    if ($_is_auditable) {
      $this->auditAfterUpdate($_beofre_id, $object);
    }
    if (method_exists($this, 'afterUpdateRec')) {
      $this->afterUpdateRec($rec, $object);
    }
    return $object;
  }

  public function deleteRec($model_id)
  {
    $object = Permission::findOrFail($model_id);

    if (method_exists($this, 'beforeDeleteRec')) {
      $this->beforeDeleteRec($object);
    }
    $object->delete();
    if (method_exists($this, 'afterDeleteRec')) {
      $this->afterDeleteRec($object);
    }
  }

  public function query($request)
  {
    $page_no = $request->query('page_no');
    $page_size = $request->query('page_size');
    $i = 1;

    $data = Permission::orderBy('_seq')
      ->get()
      ->map(
        function ($item, $key) use (&$i) {
          $item['_line_no'] = $i++;
          return $item;
        }
      );

    return PermissionView::collection($data);
  }

  public function showRec($model_id)
  {
    $i = 1;

    $data = Permission::where('id', $model_id)
      ->orderBy('_seq')
      ->with()
      ->get()
      ->map(
        function ($item, $key) use (&$i) {
          $item->setAttribute('_line_no', $i++);
          return $item;
        }
      );
    return PermissionWithParentsView::collection($data);
  }
}
