<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Admin;
use App\Order;
use App\Client;
use App\Contact;
use App\User;
use App\Http\Resources\AdminResource;
use App\Http\Resources\ClientsResource;
use App\Http\Resources\ContactResource;
use App\Http\Resources\OrdersResource;
use PhpParser\Node\Expr\AssignOp\Concat;

class AdminController extends Controller
{
    // public function dashboard()
    // {
        
    //     return view('admin.dashboard');
    // }

    public function orders()
    {
       
        // $orders = Order::get();
        $orders = Order::where('status', '1')->get();
        $orders->transform(function ($order, $key) {
            $order->cart = unserialize($order->cart);
            return $order;
        });
        return OrdersResource::collection($orders);
    }

    public function new_orders()
    {
        

        $orders = Order::where('status', '0')->get();
        $orders->transform(function ($order, $key) {
            $order->cart = unserialize($order->cart);
            return $order;
        });
        return OrdersResource::collection($orders);
    }
    public function delivered($id)
    {
        $order = Order::find($id);
        $order->status = 1;
        $order->update();
        return new OrdersResource($order);
    }
    //==========================================================
    // public function login()
    // {
    //     return view('admin.loginadmin');
    // }
    // public function signup()
    // {
    //     return view('admin.signupadmin');
    // }
    public function createaccount(Request $request)
    {

        $this->validate($request, [
            'email' => 'email|required|unique:clients',
            'password' => 'required|min:4'
        ]);
        $admin = new Admin();
        $admin->email = $request->input('email');
        $admin->password = bcrypt($request->input('password'));  //hash password

        $admin->save();

        return new AdminResource($admin);
        
    }

    public function accsesaccount(Request $request)
    {

        $this->validate($request, [
            'email' => 'email|required',
            'password' => 'required'
        ]);
        $admin = Admin::where('email', $request->input('email'))->first(); //email check
        if ($admin) {
            if (Hash::check($request->input('password'), $admin->password)) {
                Session::put('admin', $admin);
                return new AdminResource($admin);

            } else {
                return back()->with('error', 'Wrong Password or Email !');
            }
        } else {
            return back()->with('error', 'You Do not Have account');
        }
    }

    // public function logout()
    // {
    //     Session::forget('admin');
    //     return back();
    // }

    // ----------------clients action-----------------
    public function clients(){
        $clients = User::get();
        return ClientsResource::collection($clients);

    }
    public function activate_client($id)
    {
        
        $client = Client::find($id);
        $client->status = 1;
        $client->update();
        return new ClientsResource($client) ;
    }
    public function unactivate_client($id)
    {
       
        $client = Client::find($id);
        $client->status = 0;
        $client->update();
        return new ClientsResource($client) ;
    }
    //---------------usersMessages------------------------

    public function usersmessages(){
        $contacts = Contact::get();

        return ContactResource::collection($contacts);
    }

    public function delete_message($id){
       

        $contact = Contact::find($id);

        $contact->delete();

       
       return new ContactResource($contact ) ;
    }


}
