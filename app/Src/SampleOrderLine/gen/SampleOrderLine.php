<?php


namespace App\Src\SampleOrderLine\gen;

use Premialabs\Foundation\Traits\ModelModifierTrait;
use Premialabs\Foundation\FndModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class SampleOrderLine extends FndModel
{
  use ModelModifierTrait;

  protected $fillable = [
    '_seq',
    'part_code',
    'part_description',
    'created_date',
    'delivery_date',
    'status',
    'sample_order_id',
    'created_by_id',
    'last_modified_by_id',
  ];
  protected $table = 'sample_order_lines';


  public function created_by()
  {
    return $this->belongsTo(User::class, 'created_by_id');
  }
  public function last_modified_by()
  {
    return $this->belongsTo(User::class, 'last_modified_by_id');
  }
  public function sample_order()
  {
    return $this->belongsTo(SampleOrder::class, 'sample_order_id');
  }
}
