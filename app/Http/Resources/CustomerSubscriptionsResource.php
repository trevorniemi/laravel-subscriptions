<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerSubscriptionsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'customerName' => $this->customer_name,
            'name' => $this->name,
            'status' => $this->status,
            'price' => $this->price,
            'frequency' => $this->frequency,
            'term' => $this->term,
        ];
    }
}
