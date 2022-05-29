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
            'role_id' => $this->role_id,
            'permission_id' => $this->permission_id,
            'role' => $this->role,
            'permission' => $this->permission,
        ];
    }
}
