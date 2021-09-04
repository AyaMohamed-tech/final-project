<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\DB;
use App\Category;
use App\Product;

class CategoryController extends Controller
{
    public function categories()
    {
        $categories = Category::get();

        return CategoryResource::collection($categories);
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);

        $category->delete();

        return new CategoryResource($category);
    }

    public function savecategory(Request $request)
    {
        $this->validate($request, [
            'category_name' => 'required',
            'category_image' => 'image|nullable|max:1999'
        ]);

        $checkcat = Category::where('category_name', $request->input('category_name'))->first();


        if (!$checkcat) {

            if ($request->hasFile('category_image')) {
                $fileNameWithExt = $request->file('category_image')->getClientOriginalName();
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('category_image')->getClientOriginalExtension();
                $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
                $path = $request->file('category_image')->storeAs('public/category_images', $fileNameToStore);
            } else {
                $fileNameToStore = 'noimage.jpg';
            }

            $category = new Category();
            $category->category_name = $request->input('category_name');
            $category->category_image = $fileNameToStore;
            $category->save();

            return new CategoryResource($category);
        } else {
            return  'Category already exist';
        }
    }

    public function view_by_cat($name)
    {
        $categories = Category::get();
        $products = Product::where('product_category', $name)->get();
        return ProductResource::collection($products);
    }


    public function edit(Request $request, $id)
    {
        
        $this->validate($request, [
            'category_name' => 'required',
            'category_image' => 'image|nullable|max:1999'
        ]);

        $category  = Category::findOrFail($id);
        $old_cat = $category->category_name;
        $oldimage = $category->category_image;

        $category->category_name = $request->input('category_name');
        if ($request->hasFile('category_image')) {
            if ($request->hasFile('category_image')) {
                $fileNameWithExt = $request->file('category_image')->getClientOriginalName();
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('category_image')->getClientOriginalExtension();
                $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
                $path = $request->file('category_image')->storeAs('public/category_images', $fileNameToStore);
                // $oldimage = Product::findOrFail($request->input('id'));
                if ($oldimage != 'noimage.jpg') {
                    Storage::delete('public/category_images/' . $oldimage);
                }
                $category->category_image = $fileNameToStore;
            }
        }
        $data = array();
        $data['product_category'] = $request->input('category_name');

        DB::table('products')
            ->where('product_category', $old_cat)
            ->update($data);
        $category->update();
        return new CategoryResource($category);

    }
}
