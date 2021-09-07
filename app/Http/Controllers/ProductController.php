<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Product;
use App\Category;
use App\Cart;



class ProductController extends Controller
{
    //

    function addproduct()
    {
        
        $categories = Category::All()->pluck('category_name', 'category_name');
        return view('admin.addproduct')->with('categories', $categories);
    }

    public function saveproduct(Request $request)
    {
       
        $this->validate($request, [
            'product_name' => 'required',
            'product_price' => 'required',
            'product_image' => 'image|nullable|max:1999'
        ]);


        if ($request->input('product_category')) {

            if ($request->hasFile('product_image')) {
                // 1 : get filename with Ext
                $fileNameWithExt = $request->file('product_image')->getClientOriginalName();

                // 2 : get just file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

                // 3 : get just extension
                $extension = $request->file('product_image')->getClientOriginalExtension();

                // 4 : file name to store
                $fileNameToStore = $fileName . '_' . time() . '.' . $extension;

                // 5 : upload image
                $path = $request->file('product_image')->storeAs('public/product_images', $fileNameToStore);
            } else {
                $fileNameToStore = 'noimage.jpg';
            }

            $product = new Product();
            $product->product_name = $request->input('product_name');
            $product->product_price = $request->input('product_price');
            $product->product_category = $request->input('product_category');
            $product->product_image = $fileNameToStore;
            $product->status = 1;

            $product->save();

            return redirect('/admin/addproduct')->with('status', 'The ' . $product->product_name . ' Product has been saved successfully');
        } else {
            return redirect('/admin/addproduct')->with('status1', 'Do select the category please');
        }
    }

    public function products()
    {
        
        $products = product::get();
        return view('admin.products')->with('products', $products);
    }

    public function editproduct($id)
    {
   
        $categories = Category::All()->pluck('category_name', 'category_name');
        $product = product::findOrFail($id);
        return view('admin.editproduct')->with('product', $product)->with('categories', $categories);
    }

    public function updateproduct(Request $request)
    {
       
        $this->validate($request, [
            'product_name' => 'required',
            'product_price' => 'required',
            'product_image' => 'image|nullable|max:1999',
        ]);

        $product = Product::findOrFail($request->input('id'));
        $product->product_name = $request->input('product_name');
        $product->product_price = $request->input('product_price');
        $product->product_category = $request->input('product_category');
        if ($request->hasFile('product_image')) {
            $fileNameWithExt = $request->file('product_image')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extention = $request->file('product_image')->getClientOriginalExtension();
            $fileNameToStore = $fileName . '_' . time() . '.' . $extention;
            $path = $request->file('product_image')->storeAs('public/product_images', $fileNameToStore);
            $oldimage = Product::findOrFail($request->input('id'));
            if ($oldimage->product_image != 'noimage.jpg') {
                Storage::delete('public/product_images/' . $oldimage->product_image);
            }
            $product->product_image = $fileNameToStore;
        }
        $product->update();
        return redirect('/admin/products')->with('status', 'The ' . $request->input('product_name') . ' Product has been Updated Successfuly');
    }

    public function delete_product($id)
    {
       
        $product = Product::findOrFail($id);
        if ($product->product_image != 'noimage.jpg') {
            Storage::delete('/public/product_images/' . $product->product_image);
        }
        $product->delete();
        return redirect('/admin/products')->with('status', 'The ' . $product->product_name . ' Product has been Deleted Successfuly');
    }

    public function activate_product($id)
    {
      
        $product = Product::findOrFail($id);
        $product->status = 1;
        $product->update();
        return redirect('/admin/products')->with('status', 'The ' . $product->product_name . ' Product status has been Activated Successfuly');
    }

    public function unactivate_product($id)
    {
      
        $product = Product::findOrFail($id);
        $product->status = 0;
        $product->update();
        return redirect('/admin/products')->with('status', 'The ' . $product->product_name . ' Product status has been Unactivated Successfuly');
    }
    public function addToCart($id)
    {

        $product = Product::findOrFail($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $id);
        Session::put('cart', $cart);
        return redirect('/shop');
    }
}
