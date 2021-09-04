<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


use App\Admin;
use Illuminate\Http\Request;
use App\Order;
use App\Client;
use App\Contact;
use App\User;

use PhpParser\Node\Expr\AssignOp\Concat;

class AdminController extends Controller
{
    public function dashboard()
    {
        if (!Session::has('admin')) {
            return redirect('/loginadmin');
        }
        return view('admin.dashboard');
    }



    public function orders()
    {
        if (!Session::has('admin')) {
            return redirect('/loginadmin');
        }
        // $orders = Order::get();
        $orders = Order::where('status', '1')->get();
        $orders->transform(function ($order, $key) {
            $order->cart = unserialize($order->cart);
            return $order;
        });
        return view('admin.orders')->with('orders', $orders);
    }

    public function new_orders()
    {
        if (!Session::has('admin')) {
            return redirect('/loginadmin');
        }

        $orders = Order::where('status', '0')->get();
        $orders->transform(function ($order, $key) {
            $order->cart = unserialize($order->cart);
            return $order;
        });
        return view('admin.new_orders')->with('orders', $orders);
    }
    public function delivered($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 1;
        $order->update();
        return redirect('/admin/orders')->with('status', 'The ' . $order->id . ' Order has been deliverd Successfuly');
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

    public function logout()
    {
        Session::forget('admin');
        return back();
    }

    // ----------------clients action-----------------
    public function clients()
    {
        $users = User::get();

        return view('admin.clients')->with('users', $users);
    }

    public function activate_client($id)
    {
        if (!Session::has('admin')) {
            return redirect('/loginadmin');
        }
        $user = User::findOrFail($id);
        $user->status = 1;
        $user->update();
        return redirect('/admin/clients')->with('status', 'The ' . $user->name . ' Client status has been Activated Successfuly');
    }

    public function unactivate_client($id)
    {
        if (!Session::has('admin')) {
            return redirect('/loginadmin');
        }
        $user = User::findOrFail($id);
        $user->status = 0;
        $user->update();
        return redirect('/admin/clients')->with('status', 'The ' . $user->name . ' Client status has been Unactivated Successfuly');
    }

    //---------------usersMessages------------------------

    public function usersmessages()
    {
        $contacts = Contact::get();

        return view('admin.usersmessages')->with('contacts', $contacts);
    }

    public function delete_message($id)
    {
        if (!Session::has('admin')) {
            return redirect('/loginadmin');
        }

        $contact = Contact::findOrFail($id);

        $contact->delete();


        return redirect('/admin/usersmessages')->with('status', 'The Message has been deleted successfully');
    }


    public function search()
    {
        $data= product::
        where('name' ,'like' , '%'.$req->input('quey'). '%')->get();
        return view('search' , ['products'=>$data]);
    }

}
