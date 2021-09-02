<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Slider;

class SliderController extends Controller
{
    //
    public function sliders()
    {
    
        $sliders = Slider::get();
        return $sliders;
    }
    public function edit_slider($id)
    {

        $slider = Slider::findOrFail($id);

        return "Dd";
    }
}
