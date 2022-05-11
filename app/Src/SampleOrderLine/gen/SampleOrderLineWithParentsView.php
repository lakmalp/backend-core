<?php

namespace App\Src\SampleOrderLine\gen;

use Illuminate\Http\Resources\Json\JsonResource;

class SampleOrderLineWithParentsView extends JsonResource
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
            'part_code' => $this->part_code,
            'part_description' => $this->part_description,
            'created_date' => $this->created_date,
            'delivery_date' => $this->delivery_date,
            'status' => $this->status,
            'sample_order' => $this->sample_order,
            'sample_order_id' => $this->sample_order_id,
            'created_by' => $this->created_by,
            'created_by_id' => $this->created_by_id,
            'last_modified_by' => $this->last_modified_by,
            'last_modified_by_id' => $this->last_modified_by_id
        ];
    }
}
