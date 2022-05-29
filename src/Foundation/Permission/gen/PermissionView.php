<?php

namespace Premialabs\Foundation\Permission\gen;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;

class PermissionView extends JsonResource
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
      'id' => $this->id,
      '_line_no' => $this->_line_no,
      '_seq' => $this->_seq,
      'code' => $this->code,
      'description' => $this->description,
      'updated_at' => $this->updated_at,
      'created_at' => $this->created_at
    ];
  }
}
