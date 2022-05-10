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
      'code' => $this->code,
      'description' => $this->description,
    ];
  }
}
