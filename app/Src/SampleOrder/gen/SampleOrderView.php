<?php

namespace App\Src\SampleOrder\gen;

use Illuminate\Http\Resources\Json\JsonResource;

class SampleOrderView extends JsonResource
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
      'po_no' => $this->po_no,
      'created_date' => $this->created_date,
      'delivery_date' => $this->delivery_date,
      'status' => $this->status,
      'created_by_user_ref' => $this->created_by_user_ref,
      'last_modified_by_user_ref' => $this->last_modified_by_user_ref
    ];
  }
}
