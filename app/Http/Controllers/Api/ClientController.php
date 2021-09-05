<?php

namespace App\Http\Controllers\Api;

use App\Cart;
use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\HomeResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\SliderResource;
use App\Product;
use App\Slider;
use App\Order;
use App\User;


use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\Stripe;


use Illuminate\Support\Facades\Session;


class ClientController extends Controller
{
    public function home()
    {
        $sliders = Slider::where('status', '1')->get();
        $products = Product::where('status', '1')->paginate(8);
        $categories = Category::get();
        return [
            'sliders' => SliderResource::collection($sliders),
            'products' => ProductResource::collection($products),
            'categories' => CategoryResource::collection($categories),
        ];
    }
    public function shop()
    {
        $categories = Category::get();
        $products = Product::where('status', '1')->get();
        return [
            'products' => ProductResource::collection($products),
            'categories' => CategoryResource::collection($categories),
        ];
    }
    public function cart()
    {
       

        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        return $oldCart;
    }


    public function returns()
    {
        return view('client.returns');
    }

    public function profile()
    {
    
        $users = User::get();
       
        // dd(Session::get('client')->name);
        $orders = Order::where('name', auth()->user()->name )->get();
        //dd($orders);
        $orders->transform(function ($order, $key) {
            $order->cart = unserialize($order->cart);
            return $order;
        });
        return $orders;
       
    }

}
