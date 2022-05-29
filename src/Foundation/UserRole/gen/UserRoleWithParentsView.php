<?php

namespace Premialabs\Foundation\UserRole\gen;

use Illuminate\Http\Resources\Json\JsonResource;

class UserRoleWithParentsView extends JsonResource
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
            'user_id' => $this->user_id,
            'role_id' => $this->role_id,
            'user' => $this->user,
            'role' => $this->role,
        ];
    }
}
