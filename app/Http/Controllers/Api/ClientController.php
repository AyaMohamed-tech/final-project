<?php

namespace App\Http\Controllers\Api;

use App\Cart;
use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\HomeResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\SliderResource;
use App\Http\Resources\ContactResource;

use App\Product;
use App\Slider;
use App\Order;
use App\User;
use App\Contact;


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
    public function datacontact(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'email|required|unique:contacts',
            'subject' => 'required|min:4',
            'message' => 'required|min:5'

        ]);
        $contact = new Contact();
        $contact->name = $request->input('name');
        $contact->email = $request->input('email');
        $contact->subject = $request->input('subject');
        $contact->message = $request->input('message');

        $contact->save();
        return new ContactResource($contact);
            
        ;
    }

    

}
