<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slider;
use App\Product;
use App\Category;
use Session;
use App\Cart;

class ClientController extends Controller
{
    public function home(){
        //===== get all products in Product model =========
        $products = Product::get();
        //===== get all sliders in Slider model =========
        $sliders = Slider::get();
        return view('client.home')->with('sliders',$sliders)->with('products',$products);
    }
    public function cart(){
        if(!Session::has('cart')){
            return view('client.cart');
        }

        $oldCart = Session::has('cart')? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        return view('client.cart',['products' => $cart->items]);
        
    }

    public function updateqty(Request $request){

                //print('the product id is '.$request->id.' And the product qty is '.$request->quantity);
                $oldCart = Session::has('cart')? Session::get('cart'):null;
                $cart = new Cart($oldCart);
                $cart->updateQty($request->id, $request->quantity);
                Session::put('cart', $cart);
        
                //dd(Session::get('cart'));
                return redirect('/cart');

    }

    public function removeitem($id){

        $oldCart = Session::has('cart')? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
       
        if(count($cart->items) > 0){
            Session::put('cart', $cart);
        }
        else{
            Session::forget('cart');
        }

        //dd(Session::get('cart'));
        return redirect('/cart');

    }
    public function shop(){
        //===== get all categories in Category model =========
        $categories = Category::get();
        //===== get all products in Product model =========
        $products = Product::get();
        return view('client.shop')->with('products',$products)->with('categories',$categories);
    }
    public function checkout(){
        return view('client.checkout');
    }
    public function login(){
        return view('client.login');
    }
    public function signup(){
        return view('client.signup');
    }
}