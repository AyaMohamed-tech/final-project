<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrdersResource extends JsonResource
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
                  'name' => $this->name,
                  'adress' => $this->adress,
                  'cart' => $this->cart,
                  'payment_id' => $this->payment_id
        ];
    }
}
