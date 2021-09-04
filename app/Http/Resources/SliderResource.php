<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SliderResource extends JsonResource
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
        "id" => $this->id,
        "description_one"=> $this->description1,
        "description_two"=> $this->description2,
        "slider_image"=> $this->slider_image,
        
        ];
    }
}
