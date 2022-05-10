<?php

namespace Premialabs\Foundation\User\gen;

use Illuminate\Http\Resources\Json\JsonResource;

class UserWithParentsView extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'type' => $this->type,
        ];
    }
}
