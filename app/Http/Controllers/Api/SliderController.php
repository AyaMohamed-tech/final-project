<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Slider;
use App\Http\Resources\SliderResource;


class SliderController extends Controller
{
    //
    public function sliders()
    {
    
        $sliders = Slider::get();
        return SliderResource::collection($sliders);
    }
    public function showsliders($id)
    {
    
        $slider = Slider::findOrFail($id);
        return  new SliderResource($slider);
    }
    public function edit_slider($id)
    {

        return "Dd";
    }

    public function unactivate_slider($id)
    {

     
        $slider = Slider::findOrFail($id);
        $slider->status = 0;
        $slider->update();
        return  new SliderResource($slider);
    }
    public function activate_slider($id)
    {

        $slider = Slider::findOrFail($id);

        $slider->status = 1;

        $slider->update();

        return  new SliderResource($slider);
    }


}
