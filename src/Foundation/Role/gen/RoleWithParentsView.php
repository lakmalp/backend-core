<?php

namespace Premialabs\Foundation\Role\gen;

use Illuminate\Http\Resources\Json\JsonResource;

class RoleWithParentsView extends JsonResource
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
