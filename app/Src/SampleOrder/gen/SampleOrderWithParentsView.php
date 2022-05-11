<?php

namespace App\Src\SampleOrder\gen;

use Illuminate\Http\Resources\Json\JsonResource;

class SampleOrderWithParentsView extends JsonResource
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
            'po_no' => $this->po_no,
            'created_date' => $this->created_date,
            'delivery_date' => $this->delivery_date,
            'status' => $this->status,
            'created_by' => $this->created_by,
            'created_by_id' => $this->created_by_id,
            'last_modified_by' => $this->last_modified_by,
            'last_modified_by_id' => $this->last_modified_by_id
        ];
    }
}
