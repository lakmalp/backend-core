<?php


namespace App\Src\SampleOrder\gen;

use Premialabs\Foundation\Traits\ModelModifierTrait;
use Premialabs\Foundation\FndModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class SampleOrder extends FndModel
{
  use ModelModifierTrait;

  protected $fillable = [
    '_seq',
    'po_no',
    'created_date',
    'delivery_date',
    'status',
    'created_by_id',
    'last_modified_by_id',
  ];
  protected $table = 'purchase_orders';


  public function created_by()
  {
    return $this->belongsTo(User::class, 'created_by_id');
  }
  public function last_modified_by()
  {
    return $this->belongsTo(User::class, 'last_modified_by_id');
  }
}
