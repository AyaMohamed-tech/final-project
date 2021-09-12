<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;


class OrderController extends Controller
{
    public function banned()
    {
        $orders = Order::where('status', 0)->get();
        $orders->transform(function ($order, $key) {
            $order->cart = unserialize($order->cart);
            return $order;
        });
        return view('admin.orders.banned_orders', compact('orders'));
    }

    public function in_progress()
    {
        $orders = Order::where('status', 1)->get();
        $orders->transform(function ($order, $key) {
            $order->cart = unserialize($order->cart);
            return $order;
        });

        return view('admin.orders.in_progress', compact('orders'));
    }
    
    public function shipped()
    {
        $orders = Order::where('status', 2)->get();
        $orders->transform(function ($order, $key) {
            $order->cart = unserialize($order->cart);
            return $order;
        });

        return view('admin.orders.shipped', compact('orders'));
    }

    public function delivered()
    {
        $orders = Order::where('status', 3)->get();
        $orders->transform(function ($order, $key) {
            $order->cart = unserialize($order->cart);
            return $order;
        });
        
        return view('admin.orders.delivered', compact('orders'));
    }

    public function up($id)
    {
        $order = Order::find($id);

        $order->update(['status' => ++$order->status]);

        return back()->with('success', 'Order Moved');
    }
}
