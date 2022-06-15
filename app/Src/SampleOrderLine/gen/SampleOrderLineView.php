<?php

namespace App\Src\SampleOrderLine\gen;

use Illuminate\Http\Resources\Json\JsonResource;

class SampleOrderLineView extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */


  public function toArray($request)
  {
    return [
      'part_code' => $this->part_code,
      'part_description' => $this->part_description,
      'created_date' => $this->created_date,
      'delivery_date' => $this->delivery_date,
      'status' => $this->status,
      'sample_order_id' => $this->sample_order_id,
      'created_by_user_ref' => $this->created_by_user_ref,
      'last_modified_by_user_ref' => $this->last_modified_by_user_ref
    ];
  }
}
