<?php

namespace Premialabs\Foundation\Role\gen;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleView extends JsonResource
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
