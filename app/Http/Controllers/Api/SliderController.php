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

       $slider = Slider::findOrFail($id);
       $slider->update;
        return view('admin.editslider')->with('slider', $slider);
    }
    public function delete_slider($id)
    {
     
        $slider = Slider::findOrFail($id);
        $slider->delete();
       return new SliderResource($slider);

       
    }

    public function saveslider(Request $request)
    {
    

        $this->validate($request, [
            'description_one' => 'required',
            'description_two' => 'required',
            'slider_image' => 'image|nullable|max:1999'
        ]);

        if ($request->hasFile('slider_image')) {
            // 1 : get filename with Ext
            $fileNameWithExt = $request->file('slider_image')->getClientOriginalName();

            // 2 : get just file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            // 3 : get just extension
            $extension = $request->file('slider_image')->getClientOriginalExtension();

            // 4 : file name to store
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;

            // 5 : upload image
            $path = $request->file('slider_image')->storeAs('public/slider_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        $slider = new Slider();

        $slider->description1 = $request->input('description_one');
        $slider->description2 = $request->input('description_two');
        $slider->slider_image = $fileNameToStore;
        $slider->status = 1;

        $slider->save();

        return new SliderResource($slider);


    }


    public function edit_slider(Request $request)
    {

        $this->validate($request, [
            'description_one' => 'required',
            'description_two' => 'required',
            'slider_image' => 'image|nullable|max:1999'
        ]);

        $slider = Slider::findOrFail($request->input('id'));

        $slider->description1 = $request->input('description_one');
        $slider->description2 = $request->input('description_two');

        if ($request->hasFile('slider_image')) {

            // 1 : get filename with Ext
            $fileNameWithExt = $request->file('slider_image')->getClientOriginalName();

            // 2 : get just file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            // 3 : get just extension
            $extension = $request->file('slider_image')->getClientOriginalExtension();

            // 4 : file name to store
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;

            // 5 : upload image
            $path = $request->file('slider_image')->storeAs('public/slider_images', $fileNameToStore);

            // $old_image = Product::findOrFail($request->input('id'));

            if ($slider->slider_image != 'noimage.jpg') {
                Storage::delete('public/slider_image/' . $slider->slider_image);
            }

            $slider->slider_image = $fileNameToStore;
        }
        $slider->update();
        return new SliderResource($slider);
    }
  

}
