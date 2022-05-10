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
            'user' => new UserView($this->user),
            'role' => new RoleView($this->role),
        ];
    }
}
