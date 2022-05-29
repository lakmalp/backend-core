<?php

namespace Premialabs\Foundation\UserRole\gen;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;

class UserRoleView extends JsonResource
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
      'user_id' => $this->user_id,
      'role_id' => $this->role_id,
      'updated_at' => $this->updated_at,
      'created_at' => $this->created_at
    ];
  }
}
