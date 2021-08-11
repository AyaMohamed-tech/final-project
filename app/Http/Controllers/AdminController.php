<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


use App\Admin;
use Illuminate\Http\Request;
use App\Order;


class AdminController extends Controller
{
    public function dashboard()
    {
        if(!Session::has('admin')){
            return redirect('/loginadmin');
        }
        return view('admin.dashboard');
    
}



    public function orders()
    {
        if(!Session::has('admin')){
            return redirect('/loginadmin');
        }

        $orders = Order::get();

        $orders->transform(function ($order, $key) {
            $order->cart = unserialize($order->cart);
            return $order;
        });
        return view('admin.orders')->with('orders', $orders);
    }
    //==========================================================


    public function login()
    {
        return view('admin.loginadmin');
    }
    public function signup()
    {
        return view('admin.signupadmin');
    }
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

        //    return back()->with('status' , 'Your account has been created successfully');
        return redirect('/loginadmin');
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
                return redirect('/admin');
                //return back()->with('status','Your Email Is ' .Session::get('client')->email);

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




}
