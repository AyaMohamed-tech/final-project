<?php

namespace App\Http\Controllers;

use DB;
use App\Cart;

use App\User;
use App\Order;
use App\Client;
use App\Slider;
use App\Contact;
use App\Product;
use App\Category;
use Stripe\Charge;
use Stripe\Stripe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Expr\AssignOp\Concat;
use App\Notifications\OrderDelivered;

class ClientController extends Controller
{
    public function home()
    {
        $sliders = Slider::where('status', '1')->get();
        $products = Product::where('status', '1')->paginate(8);
        $categories = Category::get();
        return view('client.home')->with(['sliders' => $sliders, 'products' => $products, 'categories' => $categories]);
    }
    public function cart()
    {
        if (!Session::has('cart')) {
            return view('client.cart');
        }

        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        return view('client.cart', ['products' => $cart->items]);
    }

    public function updateqty(Request $request)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->updateQty($request->id, $request->quantity, $request->part_quantity);
        Session::put('cart', $cart);
        return redirect('/cart');
    }

    public function removeitem($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);

        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }
        return redirect('/cart');
    }

    public function shop()
    {
        $categories = Category::get();
        $products = Product::where('status', '1')->get();
        return view('client.shop')->with('products', $products)->with('categories', $categories);
    }

    public function checkout()
    {
        /* if (!Session::has('client')) {
            return redirect('/login');
        } */
        if (!Session::has('cart')) {
            return redirect('/cart');
        }
        return view('client.checkout');
    }

    public function postcheckout(Request $request)
    {
        if (!Session::has('cart')) {
            return redirect('/cart');
        }
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        Stripe::setApiKey('sk_test_51JLs9OEITolXhvOBPfGxQWcSZ6sBfD9RRhpCB3o4VWmwespXvXSpCiZgZmtztB4u3qTSfKg3H9YbDcQo4c8bxsrK00ZglvFGqc');

        try {
            $charge = Charge::create(array(
                "amount" => $cart->totalPrice * 100,
                "currency" => "usd",
                "source" => $request->input('stripeToken'), // obtainded with Stripe.js
                "description" => "Test Charge"
            ));
            $order = new Order();
            $order->name = $request->input('name');
            $order->address = $request->input('address');
            $order->cart = serialize($cart);
            $order->payment_id = $charge->id;
            $order->save();
        } catch (\Exception $e) {
            Session::put('error', $e->getMessage());
            return redirect('/checkout');
        }

        Session::forget('cart');
        return redirect('/shop')->with('success', 'Purchase accomplished successfully !');
    }


    public function login()
    {
        return view('client.login');
    }
    public function signup()
    {
        return view('client.signup');
    }
    public function createaccount(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'email|required|unique:clients',
            'password' => 'required|min:4',
            'password_confirmation' => 'required_with:password|same:password|min:4',
            'address' => 'required|min:5'
        ]);

        $client = new Client();
        $client->name = $request->input('name');
        $client->email = $request->input('email');
        $client->password = bcrypt($request->input('password'));  //hash password
        $client->password_confirmation = bcrypt($request->input('password_confirmation'));  //hash password
        $client->address = $request->input('address');

        $client->save();

        //    return back()->with('status' , 'Your account has been created successfully');
        return redirect('/login');
    }


    public function accsesaccount(Request $request)
    {

        $this->validate($request, [
            'email' => 'email|required',
            'password' => 'required'
        ]);
        $client = Client::where('email', $request->input('email'))->first(); //email check
        if ($client) {
            if (Hash::check($request->input('password'), $client->password)) {
                Session::put('client', $client);
                return redirect('/checkout');
            } else {
                return back()->with('error', 'Wrong Password or Email !');
            }
        } else {
            return back()->with('error', 'You Do not Have account');
        }
    }

    public function logout()
    {
        Session::forget('client');
        return back();
    }
    //==================================


    public function contactus()
    {

        return view('client.contactus');
    }

    //===================================================
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
        // return view('client.contactus');
        // return view('client.contactus')->with('status' , 'Your Message has been sent successfully');
        return back()->with('status', 'Your Message has been sent successfully');
    }

    //===================about function========================================
    public function about()
    {
        return view('client.about');
    }

    //===================privacypolicy===============================
    public function privacypolicy()
    {
        return view('client.privacypolicy');
    }

    //===================terms===============================
    public function terms()
    {
        return view('client.terms');
    }

    //===================shipping===============================
    public function shipping()
    {
        return view('client.shipping');
    }

    //===================returns===============================
    public function returns()
    {
        return view('client.returns');
    }

    public function profile()
    {
      /*   if (!Session::has('client')) {
            return redirect('/login');
        } */

        $users = User::get();
       
        // dd(Session::get('client')->name);
        $orders = Order::where('name', auth()->user()->name )->get();
        //dd($orders);
        $orders->transform(function ($order, $key) {
            $order->cart = unserialize($order->cart);
            return $order;
        });
        return view('client.profile')->with(['users' => $users, 'orders' => $orders]);
    }

  
    public function search(Request $req)
    {
        $data= product::where('product_name' ,'like' , '%'.$req->input('query').'%')->get();
        
        return view('client.search' , ['products'=>$data]);
    }

    public function delivered($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 3;
        $order->update();

        $admin = User::where('role', 'admin')->first();
        
        $admin->notify(new OrderDelivered($order));

        return redirect('/profile')->with('status', 'The ' . $order->id . ' Order has been deliverd Successfuly');
    }

}
