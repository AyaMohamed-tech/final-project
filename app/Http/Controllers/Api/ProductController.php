<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Product;
use App\Http\Resources\ProductResource;
use App\Category;
use App\Cart;
use Illuminate\Support\Facades\DB;




class ProductController extends Controller
{
    public function products(){
        $products = Product::get();

        return ProductResource::collection($products);
    }


    public function delete_product($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return new ProductResource($product);
    }
    
    public function activate_product($id)
    {
        $product = Product::findOrFail($id);
        $product->status = 1;
        $product->update();
        return new ProductResource($product);
    }

    public function unactivate_product($id)
    {
       
        $product = Product::findOrFail($id);
        $product->status = 0;
        $product->update();
        return new ProductResource($product);
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
            return new ProductResource($product);
        } else {
            // return redirect('/addproduct')->with('status1', 'Do select the category please');
            return  'select category please';

        }
    }

    // public function editproduct(Request $request, Product $id)
    // {

    //     $id->update($request->all());

    //     return response()->json($id, 200);
    // }

    // public function addToCart($id)
    // {

    //     $product = Product::findOrFail($id);
    //     $oldCart = Session::has('cart') ? Session::get('cart') : null;
    //     $cart = new Cart($oldCart);
    //     $cart->add($product, $id);
    //     Session::put('cart', $cart);
    //     return redirect('/shop');
    // }

    

    
}

