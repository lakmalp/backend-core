<?php

namespace Premialabs\Foundation\User\gen;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;

class UserView extends JsonResource
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
      'name' => $this->name,
      'email' => $this->email,
      'password' => $this->password,
      'type' => $this->type,
    ];
  }
}
