<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SummaryResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        logger($this->count());
        return [
            'total_orders'      => $this->count(),
            'total_quantities'  => array_sum($this->total_quantity),
            'total_sold'        => array_sum($this->total_amount),
        ];
    }
}
