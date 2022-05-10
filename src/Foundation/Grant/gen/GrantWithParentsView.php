<?php

namespace Premialabs\Foundation\Grant\gen;

use Illuminate\Http\Resources\Json\JsonResource;

class GrantWithParentsView extends JsonResource
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
            'role' => new RoleView($this->role),
            'permission' => new PermissionView($this->permission),
        ];
    }
}
