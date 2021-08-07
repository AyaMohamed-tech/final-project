<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;
use App\Slider;
use App\Product;
use App\Category;
// use Session;
use App\Cart;
use App\Client;


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
        if(!Session::has('cart')){
            return redirect ('/cart');
        }
        return view('client.checkout');
    }

    public function postcheckout(){
        if(!Session::has('cart')){
            return redirect ('/cart');
        }
        return view('client.checkout');
    }






    public function login(){
        return view('client.login');
    }
    public function signup(){
        return view('client.signup');
    }
    public function createaccount(Request $request){

        $this->validate($request,['email' => 'email|required|unique:clients' ,
                                  'password' => 'required|min:4' ]);
        $client=new Client();
        $client->email=$request->input('email');
        $client->password=bcrypt($request->input('password'));  //hash password
        
        $client->save();

    //    return back()->with('status' , 'Your account has been created successfully');
       return redirect('/login');
      
      }
      

      

        public function accsesaccount(Request $request){

          $this->validate($request,['email' => 'email|required' ,
                                    'password' => 'required' ]);
          $client=Client::where('email' ,$request->input('email'))->first(); //email check
          if($client){
              if(Hash::check($request->input('password'),$client->password)){
                 Session::put('client',$client);
                 return redirect('/shop');
                 //return back()->with('status','Your Email Is ' .Session::get('client')->email);

              }else{
                return back()->with('error','Wrong Password or Email !');

              }

          }else{
            return back()->with('error','You Do not Have account');

          }
      }
      
      public function logout(){
        Session::forget('client');
        return back();
      }

}











