<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Slider;

class SliderController extends Controller
{
    public function addslider(){
        if(!Session::has('admin')){
            return redirect('/loginadmin');
        }
        return view('admin.addslider');
    }

    public function saveslider(Request $request){
        if(!Session::has('admin')){
            return redirect('/loginadmin');
        }

        $this->validate($request,['description_one'=>'required',
                                  'description_two'=>'required',
                                  'slider_image'=>'image|nullable|max:1999']);

        if($request->hasFile('slider_image')){
            // 1 : get filename with Ext
            $fileNameWithExt = $request->file('slider_image')->getClientOriginalName();
                        
            // 2 : get just file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                        
            // 3 : get just extension
            $extension = $request->file('slider_image')->getClientOriginalExtension();
                                    
            // 4 : file name to store
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
                        
            // 5 : upload image
            $path = $request->file('slider_image')->storeAs('public/slider_images',$fileNameToStore);
                        
         }else{
         $fileNameToStore='noimage.jpg';
        }
                        
         $slider = new Slider();

         $slider->description1 = $request->input('description_one');
         $slider->description2 = $request->input('description_two');
         $slider->slider_image = $fileNameToStore;
         $slider->status = 1;
                        
         $slider->save();
                        
         return redirect('/addslider')->with('status','The Slider has been saved successfully');

    }
    public function sliders(){
        if(!Session::has('admin')){
            return redirect('/loginadmin');
        }
        $sliders = Slider::get();
        return view('admin.sliders')->with('sliders',$sliders);
    }
    public function edit_slider($id){

        $slider = Slider::findOrFail($id);

        return view('admin.editslider')->with('slider',$slider);
        
    }

    public function updateslider(Request $request){

        if(!Session::has('admin')){
            return redirect('/loginadmin');
        }
        $this->validate($request,['description_one'=>'required',
                                  'description_two'=>'required',
                                  'slider_image'=>'image|nullable|max:1999']);

        $slider = Slider::find($request->input('id'));

         $slider->description1 = $request->input('description_one');
         $slider->description2 = $request->input('description_two');

         if($request->hasFile('slider_image')){

            // 1 : get filename with Ext
            $fileNameWithExt = $request->file('slider_image')->getClientOriginalName();
       
            // 2 : get just file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            // 3 : get just extension
            $extension = $request->file('slider_image')->getClientOriginalExtension();
            
            // 4 : file name to store
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;

            // 5 : upload image
            $path = $request->file('slider_image')->storeAs('public/slider_images',$fileNameToStore);

           // $old_image = Product::find($request->input('id'));

            if($slider->slider_image != 'noimage.jpg'){
                Storage::delete('public/slider_image/'.$slider->slider_image);
            }

            $slider->slider_image = $fileNameToStore;

        }
         
             $slider->update();

             return redirect('/sliders')->with('status','The Slider has been updated successfully');
    }

    public function delete_slider($id){
        if(!Session::has('admin')){
            return redirect('/loginadmin');
        }

        $slider = Slider::find($id);

      if($slider->slider_image != 'noimage.jpg'){
        Storage::delete('public/slider_images/'.$slider->slider_image);
      }

       $slider->delete();

       
       return redirect('/sliders')->with('status','The Slider has been deleted successfully');

    }

    public function unactivate_slider($id){

        if(!Session::has('admin')){
            return redirect('/loginadmin');
        }

        $slider = Slider::findOrFail($id);

        $slider->status = 0;

        $slider->update();

        return redirect('/sliders')->with('status','The Slider status has been unactivated successfully');
    }
    public function activate_slider($id){
        
        if(!Session::has('admin')){
            return redirect('/loginadmin');
        }

        $slider = Slider::findOrFail($id);

        $slider->status = 1;

        $slider->update();

        return redirect('/sliders')->with('status','The Slider status has been activated successfully');
    }

    
}
