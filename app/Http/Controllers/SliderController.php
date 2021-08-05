<?php

namespace App\Http\Controllers;

use App\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    //
   
            public function addslider(){
               
                return view('admin.addslider');
                    }


            public function saveslider(Request $request){

                        $this->validate($request ,
                        [
                        'description_one' => 'required' ,
                        'description_two' => 'required',
                        'slider_image' => 'required'
                    ]);
                    // //if user selected image -------> uploade file <------------
    if($request->hasFile('slider_image')){
        // 1 ====== git file from req =======     File['name']   
        $fileNameWithExt=$request->file('slider_image')->getClientOriginalName();
        // 2 ====== git file name from path =======
        $fileName=pathinfo($fileNameWithExt,PATHINFO_FILENAME);
        // 3 ====== gitfile Extention =======    File['extention'] 
        $extention=$request->file('slider_image')->getClientOriginalExtension();
        // 4 ====== store file ======= 
        $fileNameToStore=$fileName.'_'.time().'.' . $extention;
        // 4 ====== uplode file=======      store at -->storage - app -puplic
        $path=$request->file('slider_image')->storeAs('public/slider_images',$fileNameToStore);
}else{
   $fileNameToStore='noimage.jpg';
}
                        
     // -------------- store in database -----------
    $slider=new Slider();
    $slider->description1=$request->input('description_one');   
    $slider->description2=$request->input('description_two');
    $slider->Slider_image=$fileNameToStore;
    $slider->status=1;

     $slider->save();
     return redirect('/addslider')->with('status' , 'The Slider has been saved successfully');
    
                            }
                            public function sliders(){
                                $sliders=Slider::get();
                                return view('admin.sliders')->with('sliders',$sliders);
                                    }
                                    //=============================================================
                                    
                                    public function edit_slider($id){
                                        $slider=Slider::find($id);
                                        return view('admin.editslider')->with('slider',$slider);
                                    }

                      public function updateslider(Request $request){
                        $slider=Slider::find($request->input('id'));
                       $this->validate($request ,
                        [
                        'description_one' => 'required' ,
                        'description_two' => 'required',
                        'slider_image' => 'required'
                    ]);
                    $slider->description1=($request->input('description_one'));
                    $slider->description2=($request->input('description_two'));
                    if($request->hasFile('slider_image')){
                        // 1 ====== git file from req =======     File['name']   
                        $fileNameWithExt=$request->file('slider_image')->getClientOriginalName();
                        // 2 ====== git file name from path =======
                        $fileName=pathinfo($fileNameWithExt,PATHINFO_FILENAME);
                        // 3 ====== gitfile Extention =======    File['extention'] 
                        $extention=$request->file('slider_image')->getClientOriginalExtension();
                        // 4 ====== store file ======= 
                        $fileNameToStore=$fileName.'_'.time().'.'.$extention;
                        // 4 ====== uplode file=======      store at -->storage - app -puplic
                        $path=$request->file('slider_image')->storeAs('public/slider_images' , $fileNameToStore);
                         }
                        if( $slider->slider_image !='noimage.jpg'){
                           Storage::delete('public/slider_images/'.$slider->slider_image);  //delete from folder storge this pic
                        }
                        $slider->slider_image=$fileNameToStore;
                  
                        $slider->update();
                    return redirect('/sliders')->with('status' , 'The '.$slider->slider_name.' slider has been updated successfully');
                            }
                             
                                             //-------> delete products <------------

                 public function delete_slider($id){
                    $slider=Slider::find($id);  
                    $slider->delete();  
                    return redirect('/sliders')->with('status' , 'The Slider has been deleted successfully');

                        }
                        public function activate_slider($id){
                            $slider=Slider::find($id); 
                             $slider->status=1;    //--------> unconvert from active to active
                             $slider->update();
                             return redirect('/sliders')->with('status' , 'The slider has been Updated successfully to Active');

                          }
                          public function unactivate_slider($id){
                            $slider=Slider::find($id); 
                             $slider->status=0;    
                             $slider->update();
                             return redirect('/sliders')->with('status' , 'The slider has been Updated successfully to Unactive');

                          }
    

}
