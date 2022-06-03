<?php

namespace Premialabs\Foundation\RolePermission\gen;

use Illuminate\Http\Resources\Json\JsonResource;

class RolePermissionWithParentsView extends JsonResource
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
            'role_id' => $this->role_id,
            'permission_id' => $this->permission_id,
            'role' => $this->role,
            'permission' => $this->permission,
        ];
    }
}
