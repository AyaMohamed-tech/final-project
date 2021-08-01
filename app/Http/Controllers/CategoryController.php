<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function addcategory(){
        return view('admin.addcategory');
    }
    public function savecategory(Request $request){
        $checkcat = Category::where('category_name',$request->input('category_name'))->first();

        $category = new Category();

        if(!$checkcat){
            $category->category_name = $request->input('category_name');
            $category->save();

            return redirect('/addcategory')->with('status','The '.$category->category_name.' Category has been saved successfully');
        }else{
            return redirect('/addcategory')->with('status1','The '.$request->input('category_name').' Category already exist');
        }
        
    }
    public function categories(){
        $categories = Category::get();
        return view('admin.categories')->with('categories', $categories);
    }
    public function edit($id){
        $category = Category::find($id);

        return view('admin.editcategory')->with('category', $category);

    }

    public function updatecategory(Request $request){

        $category  = Category::find($request->input('id'));
        $category->category_name = $request->input('category_name');
        $category->update();

        return redirect('/categories')->with('status','The '.$category->category_name.' Category has been updated successfully');

    }
    public function delete($id){
        $category = Category::find($id);
        $category->delete();

        return redirect('/categories')->with('status','The '.$category->category_name.' Category has been deleted successfully');
    }
}
