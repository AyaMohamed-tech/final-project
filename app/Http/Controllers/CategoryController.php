<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Category;
use App\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;


class CategoryController extends Controller
{
    public function addcategory()
    {
        if (!Session::has('admin')) {
            return redirect('/loginadmin');
        }
        return view('admin.addcategory');
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

            return redirect('/admin/addcategory')->with('status', 'The ' . $category->category_name . ' Category has been saved successfully');
        } else {
            return redirect('/admin/addcategory')->with('status1', 'The ' . $request->input('category_name') . ' Category already exist');
        }
    }
    public function categories()
    {
        if (!Session::has('admin')) {
            return redirect('/loginadmin');
        }
        $categories = Category::get();
        return view('admin.categories')->with('categories', $categories);
    }
    public function edit($id)
    {
        if (!Session::has('admin')) {
            return redirect('/loginadmin');
        }
        $category = Category::findOrFail($id);
        return view('admin.editcategory')->with('category', $category);
    }

    public function updatecategory(Request $request)
    {
        if (!Session::has('admin')) {
            return redirect('/loginadmin');
        }
        $this->validate($request, [
            'category_name' => 'required',
            'category_image' => 'image|nullable|max:1999'
        ]);

        $category  = Category::find($request->input('id'));
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
                // $oldimage = Product::find($request->input('id'));
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
        return redirect('/admin/categories')->with('status', 'The ' . $category->category_name . ' Category has been updated successfully');
    }
    public function delete($id)
    {
        if (!Session::has('admin')) {
            return redirect('/loginadmin');
        }
        $category = Category::find($id);
        if ($category->product_image != 'noimage.jpg') {
            Storage::delete('/public/category_images/' . $category->category_image);
        }
        $category->delete();

        return redirect('/admin/categories')->with('status', 'The ' . $category->category_name . ' Category has been deleted successfully');
    }

    public function view_by_cat($name)
    {
        $categories = Category::get();
        $products = Product::where('product_category', $name)->get();
        return view('client.shop')->with('products', $products)->with('categories', $categories);
    }
}
