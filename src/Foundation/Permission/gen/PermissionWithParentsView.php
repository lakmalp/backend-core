<?php

namespace Premialabs\Foundation\Permission\gen;

use Illuminate\Http\Resources\Json\JsonResource;

class PermissionWithParentsView extends JsonResource
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
