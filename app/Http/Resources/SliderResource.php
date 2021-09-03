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
<<<<<<< HEAD
        "id" => $this->id,
        "description1"=> $this->description1,
        "description2"=> $this->description2,
        "slider_image"=> $this->slider_image,
        "status"=> $this->status,
=======
            'id' => $this->id,
            'Description One' => $this->description1,
            'Description Two' => $this->description2,
            'status' => $this->status,
>>>>>>> 5652a708ff0ea15aea358e008549fa8c47c35564
        ];
    }
}
