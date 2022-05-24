<?php

namespace Premialabs\Foundation\Traits;

use Premialabs\Foundation\AuditableModel;
use Premialabs\Foundation\ModelAudit;
use Illuminate\Support\Facades\Log;

trait ModelAuditorTrait
{
  private $_auditModel;

  private function modelAuditable($model)
  {
    $this->_auditModel = $model;
    $is_auditable = AuditableModel::where('model', $model)->first();
    return !empty($is_auditable);
  }

  private function auditAfterCreate($object)
  {
    $model = ModelAudit::create([
      'model' => $this->_auditModel,
      'model_id' => $object->id,
      'after_json' => $object,
      'by_user_id' => auth()->user()->id
    ]);
  }

  private function auditBeforeUpdate($model_id, $rec)
  {
    $model = ModelAudit::create([
      'model' => $this->_auditModel,
      'model_id' => $model_id,
      'before_json' => $rec,
      'by_user_id' => auth()->user()->id
    ]);

    return $model->id;
  }


  private function auditAfterUpdate($before_update_audit_id, $object)
  {
    $model_audit = ModelAudit::find($before_update_audit_id);
    $model_audit->after_json = $object;
    $model_audit->save();
  }
}
